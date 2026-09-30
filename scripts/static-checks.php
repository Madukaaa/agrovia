<?php
/**
 * Agrovia Static & Automated Checks Runner
 *
 * Runs full-spectrum static analysis, syntax verification, security scanning,
 * internationalization checks, and WordPress theme/plugin standard audits.
 *
 * @package Agrovia
 * @since 1.0.0
 */

if ( php_sapi_name() !== 'cli' ) {
	die( "This script can only be run from the command line.\n" );
}

$root_dir   = dirname( __DIR__ );
$php_binary = '/Applications/Local.app/Contents/Resources/extraResources/lightning-services/php-8.2.29+0/bin/darwin-arm64/bin/php';
if ( ! file_exists( $php_binary ) ) {
	$php_binary = 'php';
}

$passed_count = 0;
$failed_count = 0;
$warnings     = 0;

function print_header( $title ) {
	echo "\n" . str_repeat( '=', 70 ) . "\n";
	echo "  " . strtoupper( $title ) . "\n";
	echo str_repeat( '=', 70 ) . "\n";
}

function test_assert( $name, $condition, $failure_msg = '' ) {
	global $passed_count, $failed_count;
	if ( $condition ) {
		echo "  [PASS] " . $name . "\n";
		$passed_count++;
		return true;
	} else {
		echo "  [FAIL] " . $name . ( $failure_msg ? " - " . $failure_msg : '' ) . "\n";
		$failed_count++;
		return false;
	}
}

// =========================================================================
// SUITE 1: PHP Syntax & Linting
// =========================================================================
print_header( 'Suite 1: PHP Syntax & Linting' );

$php_files = array();
$iterator  = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $root_dir ) );
foreach ( $iterator as $file ) {
	if ( $file->isFile() && $file->getExtension() === 'php' ) {
		$p = $file->getPathname();
		if ( strpos( $p, '/node_modules/' ) === false && strpos( $p, '/vendor/' ) === false && strpos( $p, '/scripts/' ) === false ) {
			$php_files[] = $p;
		}
	}
}
sort( $php_files );

$php_syntax_ok = true;
foreach ( $php_files as $pf ) {
	$rel = str_replace( $root_dir . '/', '', $pf );
	exec( escapeshellcmd( $php_binary ) . ' -l ' . escapeshellarg( $pf ), $out, $ret );
	if ( $ret !== 0 ) {
		$php_syntax_ok = false;
		test_assert( "Syntax check: $rel", false, implode( ' ', $out ) );
	}
}
if ( $php_syntax_ok ) {
	test_assert( "All " . count( $php_files ) . " PHP files passed 'php -l' syntax check with 0 errors", true );
}

// =========================================================================
// SUITE 2: Security & Direct Access Protection
// =========================================================================
print_header( 'Suite 2: WordPress Security & Direct Access Guards' );

$missing_guards = array();
$unsafe_calls   = array();

foreach ( $php_files as $pf ) {
	$rel     = str_replace( $root_dir . '/', '', $pf );
	$content = file_get_contents( $pf );

	// Guard check
	if ( ! preg_match( "/defined\s*\(\s*['\"]ABSPATH['\"]\s*\)\s*\|\|\s*exit/i", $content ) &&
	     ! preg_match( "/if\s*\(\s*!\s*defined\s*\(\s*['\"]ABSPATH['\"]\s*\)\s*\)\s*exit/i", $content ) ) {
		$missing_guards[] = $rel;
	}

	// Check for dangerous functions
	if ( preg_match( '/\b(eval|create_function|passthru|shell_exec|exec|system)\s*\(/i', $content, $matches ) ) {
		$unsafe_calls[] = "$rel uses forbidden function: " . $matches[1];
	}

	// Check for raw SQL query injection patterns
	if ( preg_match( '/\$wpdb->query\s*\(\s*["\'].*\$_(POST|GET|REQUEST)/i', $content ) ) {
		$unsafe_calls[] = "$rel has unsanitized raw SQL execution";
	}
}

test_assert( "Direct access prevention guard defined('ABSPATH') || exit in all " . count( $php_files ) . " files", empty( $missing_guards ), implode( ', ', $missing_guards ) );
test_assert( "No forbidden execution functions (eval, system, passthru, etc.)", empty( $unsafe_calls ), implode( ', ', $unsafe_calls ) );

// =========================================================================
// SUITE 3: Internationalization (i18n) & Text Domains
// =========================================================================
print_header( 'Suite 3: Internationalization (i18n) & Text Domains' );

$i18n_funcs = array( '__', '_e', '_x', '_ex', '_n', '_nx', 'esc_attr__', 'esc_attr_e', 'esc_attr_x', 'esc_html__', 'esc_html_e', 'esc_html_x' );
$domain_errors = array();

foreach ( $php_files as $pf ) {
	$rel = str_replace( $root_dir . '/', '', $pf );
	$is_plugin = ( strpos( $rel, 'companion-plugin' ) !== false );
	$expected_domain = $is_plugin ? 'agrovia-core' : 'agrovia';

	$tokens = token_get_all( file_get_contents( $pf ) );
	$count  = count( $tokens );

	for ( $i = 0; $i < $count; $i++ ) {
		if ( is_array( $tokens[ $i ] ) && $tokens[ $i ][0] === T_STRING && in_array( $tokens[ $i ][1], $i18n_funcs, true ) ) {
			$func = $tokens[ $i ][1];

			// Inspect arguments
			$paren_depth = 0;
			$args = array();
			$current = '';
			for ( $j = $i + 1; $j < $count; $j++ ) {
				$tok = $tokens[ $j ];
				$str = is_array( $tok ) ? $tok[1] : $tok;
				if ( $str === '(' ) {
					$paren_depth++;
					if ( $paren_depth === 1 ) continue;
				} elseif ( $str === ')' ) {
					$paren_depth--;
					if ( $paren_depth === 0 ) {
						if ( '' !== trim( $current ) ) $args[] = trim( $current );
						break;
					}
				} elseif ( $str === ',' && $paren_depth === 1 ) {
					$args[] = trim( $current );
					$current = '';
					continue;
				}
				if ( $paren_depth >= 1 ) {
					$current .= $str;
				}
			}

			$expected_args = 2;
			if ( in_array( $func, array( '_x', 'esc_html_x', 'esc_attr_x' ), true ) ) $expected_args = 3;
			elseif ( $func === '_n' ) $expected_args = 4;
			elseif ( $func === '_nx' ) $expected_args = 5;

			if ( count( $args ) < $expected_args ) {
				$domain_errors[] = "$rel:$func missing text domain argument";
			} else {
				$dom = trim( $args[ $expected_args - 1 ], "'\" " );
				if ( $dom !== $expected_domain && $dom !== 'woocommerce' ) {
					$domain_errors[] = "$rel:$func domain '$dom' does not match expected '$expected_domain'";
				}
			}
		}
	}
}

test_assert( "Strict literal text domain verification across all translation calls", empty( $domain_errors ), implode( "\n    ", $domain_errors ) );

// Check POT files
$theme_pot = $root_dir . '/languages/agrovia.pot';
$plugin_pot = $root_dir . '/companion-plugin/agrovia-core/languages/agrovia-core.pot';

test_assert( "Theme POT catalog exists (languages/agrovia.pot)", file_exists( $theme_pot ) );
test_assert( "Theme POT catalog is non-empty (>50 strings)", file_exists( $theme_pot ) && substr_count( file_get_contents( $theme_pot ), 'msgid ' ) > 50 );
test_assert( "Plugin POT catalog exists (agrovia-core/languages/agrovia-core.pot)", file_exists( $plugin_pot ) );
test_assert( "Plugin POT catalog is non-empty (>150 strings)", file_exists( $plugin_pot ) && substr_count( file_get_contents( $plugin_pot ), 'msgid ' ) > 150 );

// =========================================================================
// SUITE 4: WordPress Theme Standards & Theme Check Verification
// =========================================================================
print_header( 'Suite 4: WordPress Theme Structure & Standard Requirements' );

$style_css = file_get_contents( $root_dir . '/style.css' );
test_assert( "style.css contains 'Theme Name: Agrovia'", strpos( $style_css, 'Theme Name: Agrovia' ) !== false );
test_assert( "style.css contains 'Text Domain: agrovia'", strpos( $style_css, 'Text Domain: agrovia' ) !== false );
test_assert( "style.css contains 'License:'", strpos( $style_css, 'License:' ) !== false );
test_assert( "style.css contains 'Requires at least:'", strpos( $style_css, 'Requires at least:' ) !== false );
test_assert( "style.css contains 'Requires PHP:'", strpos( $style_css, 'Requires PHP:' ) !== false );

test_assert( "screenshot.png exists in root", file_exists( $root_dir . '/screenshot.png' ) );
test_assert( "readme.txt exists in root", file_exists( $root_dir . '/readme.txt' ) );
test_assert( "comments.php exists in root", file_exists( $root_dir . '/comments.php' ) );
test_assert( "index.php exists in root", file_exists( $root_dir . '/index.php' ) );
test_assert( "functions.php exists in root", file_exists( $root_dir . '/functions.php' ) );

// Hooks in templates
$header_php = file_get_contents( $root_dir . '/header.php' );
$footer_php = file_get_contents( $root_dir . '/footer.php' );
$single_php = file_get_contents( $root_dir . '/single.php' );
$content_single = file_get_contents( $root_dir . '/template-parts/content-single.php' );

test_assert( "header.php calls wp_head()", strpos( $header_php, 'wp_head()' ) !== false );
test_assert( "header.php calls body_class()", strpos( $header_php, 'body_class(' ) !== false );
test_assert( "footer.php calls wp_footer()", strpos( $footer_php, 'wp_footer()' ) !== false );
test_assert( "content-single.php calls post_class()", strpos( $content_single, 'post_class(' ) !== false );
test_assert( "content-single.php calls wp_link_pages()", strpos( $content_single, 'wp_link_pages(' ) !== false );

// =========================================================================
// SUITE 5: Companion Plugin Requirements
// =========================================================================
print_header( 'Suite 5: Companion Plugin Structure & Header Standards' );

$plugin_main = file_get_contents( $root_dir . '/companion-plugin/agrovia-core/agrovia-core.php' );
test_assert( "agrovia-core.php contains 'Plugin Name: Agrovia Core'", strpos( $plugin_main, 'Plugin Name: Agrovia Core' ) !== false );
test_assert( "agrovia-core.php contains 'Text Domain: agrovia-core'", strpos( $plugin_main, 'Text Domain: agrovia-core' ) !== false );
test_assert( "agrovia-core.php contains 'Domain Path: /languages'", strpos( $plugin_main, 'Domain Path: /languages' ) !== false );
test_assert( "agrovia-core.php contains 'License:'", strpos( $plugin_main, 'License:' ) !== false );
test_assert( "companion plugin readme.txt exists", file_exists( $root_dir . '/companion-plugin/agrovia-core/readme.txt' ) );

// =========================================================================
// SUITE 6: JavaScript Syntax Validation
// =========================================================================
print_header( 'Suite 6: JavaScript Syntax Validation' );

$js_files = array(
	'assets/js/navigation.js',
	'assets/js/main.js',
	'assets/js/customizer.js',
);

foreach ( $js_files as $jf ) {
	$full = $root_dir . '/' . $jf;
	test_assert( "File exists: $jf", file_exists( $full ) );
	exec( 'node -c ' . escapeshellarg( $full ) . ' 2>&1', $js_out, $js_ret );
	test_assert( "Syntax check (node -c): $jf", $js_ret === 0, implode( ' ', $js_out ) );
}

// =========================================================================
// SUITE 7: CSS Architecture & Syntax Integrity
// =========================================================================
print_header( 'Suite 7: CSS Architecture & Syntax Integrity' );

$css_files = array(
	'style.css',
	'assets/css/base.css',
	'assets/css/components.css',
	'assets/css/utilities.css',
	'assets/css/woocommerce.css',
	'assets/css/editor.css',
	'companion-plugin/agrovia-core/assets/css/widgets.css',
);

foreach ( $css_files as $cf ) {
	$full = $root_dir . '/' . $cf;
	if ( ! file_exists( $full ) ) {
		test_assert( "CSS File exists: $cf", false, "Missing" );
		continue;
	}
	$content = file_get_contents( $full );
	$open_b  = substr_count( $content, '{' );
	$close_b = substr_count( $content, '}' );
	$open_c  = substr_count( $content, '/*' );
	$close_c = substr_count( $content, '*/' );

	test_assert( "Balanced braces and comments: $cf", ( $open_b === $close_b && $open_c === $close_c ), "Braces {$open_b}/{$close_b}, Comments {$open_c}/{$close_c}" );
}

// =========================================================================
// SUITE 8: JSON Schema & Integrity
// =========================================================================
print_header( 'Suite 8: JSON Integrity & Kit Schema Validation' );

$json_files = array(
	'theme.json',
	'design/tokens.json',
	'package.json',
	'kits/agrovia-demo/manifest.json',
	'kits/agrovia-demo/site-settings.json',
	'kits/agrovia-demo/demo-content.json',
	'kits/agrovia-demo/templates/header.json',
	'kits/agrovia-demo/templates/footer.json',
	'kits/agrovia-demo/templates/single-post.json',
	'kits/agrovia-demo/templates/archive.json',
	'kits/agrovia-demo/templates/404.json',
	'kits/agrovia-demo/templates/single-product.json',
);

foreach ( $json_files as $jf ) {
	$full = $root_dir . '/' . $jf;
	if ( ! file_exists( $full ) ) {
		test_assert( "JSON file exists: $jf", false, "Missing" );
		continue;
	}
	$decoded = json_decode( file_get_contents( $full ), true );
	test_assert( "Valid JSON: $jf", json_last_error() === JSON_ERROR_NONE, json_last_error_msg() );
}

// Check theme.json version 3
$theme_json = json_decode( file_get_contents( $root_dir . '/theme.json' ), true );
test_assert( "theme.json has version 3", isset( $theme_json['version'] ) && 3 === $theme_json['version'] );

// Check tokens.json has all required token groups
$tokens = json_decode( file_get_contents( $root_dir . '/design/tokens.json' ), true );
test_assert( "tokens.json contains color tokens", isset( $tokens['colors'] ) || isset( $tokens['color'] ) );
test_assert( "tokens.json contains typography tokens", isset( $tokens['typography'] ) );
test_assert( "tokens.json contains spacing tokens", isset( $tokens['spacing'] ) );
test_assert( "tokens.json contains layout tokens", isset( $tokens['layout'] ) );
test_assert( "tokens.json contains radius tokens", isset( $tokens['radii'] ) || isset( $tokens['radius'] ) );

// =========================================================================
// SUMMARY
// =========================================================================
print_header( 'Static Checks Summary' );
echo "  Total Tests Executed : " . ( $passed_count + $failed_count ) . "\n";
echo "  Total Tests Passed   : " . $passed_count . "\n";
echo "  Total Tests Failed   : " . $failed_count . "\n";

if ( $failed_count === 0 ) {
	echo "\n  >>> [SUCCESS] All automated static checks PASSED without error! <<<\n\n";
	exit( 0 );
} else {
	echo "\n  >>> [FAILURE] One or more static checks failed. Review output above. <<<\n\n";
	exit( 1 );
}
