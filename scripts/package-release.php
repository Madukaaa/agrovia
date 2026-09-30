<?php
/**
 * Agrovia Release Packaging Tool
 *
 * Automates the creation of clean, production-grade release packages for:
 * 1. Agrovia Theme (agrovia.zip)
 * 2. Agrovia Core Companion Plugin (agrovia-core.zip)
 * 3. Elementor Demo Website Kit (agrovia-demo-kit.zip)
 * 4. Master Distribution Package (agrovia-complete-package-v1.0.0.zip)
 *
 * @package Agrovia
 * @since 1.0.0
 */

if ( php_sapi_name() !== 'cli' ) {
	die( "This script can only be run from the command line.\n" );
}

$root_dir    = dirname( __DIR__ );
$release_dir = $root_dir . '/release';

if ( ! is_dir( $release_dir ) ) {
	mkdir( $release_dir, 0755, true );
}

echo "======================================================================\n";
echo "  AGROVIA COMMERCIAL RELEASE PACKAGING TOOL (v1.0.0)\n";
echo "======================================================================\n\n";

/**
 * Add directory recursively to a ZipArchive.
 *
 * @param ZipArchive $zip         ZipArchive instance.
 * @param string     $source_dir  Source directory on disk.
 * @param string     $zip_prefix  Prefix folder inside the zip.
 * @param array      $exclude_patterns Regex/substring patterns to exclude.
 */
function agrovia_zip_dir( $zip, $source_dir, $zip_prefix, $exclude_patterns = array() ) {
	$iterator = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator( $source_dir, RecursiveDirectoryIterator::SKIP_DOTS ),
		RecursiveIteratorIterator::SELF_FIRST
	);

	foreach ( $iterator as $item ) {
		$path     = $item->getPathname();
		$rel_path = ltrim( str_replace( $source_dir, '', $path ), '/' );

		// Check exclusions.
		$skip = false;
		foreach ( $exclude_patterns as $pattern ) {
			if ( strpos( $rel_path, $pattern ) !== false || basename( $path ) === $pattern ) {
				$skip = true;
				break;
			}
		}
		if ( $skip ) {
			continue;
		}

		$zip_entry_name = $zip_prefix ? rtrim( $zip_prefix, '/' ) . '/' . $rel_path : $rel_path;

		if ( $item->isDir() ) {
			$zip->addEmptyDir( $zip_entry_name );
		} elseif ( $item->isFile() ) {
			$zip->addFile( $path, $zip_entry_name );
		}
	}
}

/**
 * Format bytes into human-readable string.
 */
function agrovia_format_size( $bytes ) {
	if ( $bytes >= 1048576 ) {
		return number_format( $bytes / 1048576, 2 ) . ' MB';
	} elseif ( $bytes >= 1024 ) {
		return number_format( $bytes / 1024, 2 ) . ' KB';
	}
	return $bytes . ' bytes';
}

// -------------------------------------------------------------------------
// 1. Build Agrovia Theme Package (agrovia.zip)
// -------------------------------------------------------------------------
echo "1. Building Agrovia Theme ZIP (release/agrovia.zip)...\n";
$theme_zip_path = $release_dir . '/agrovia.zip';
if ( file_exists( $theme_zip_path ) ) {
	unlink( $theme_zip_path );
}

$theme_zip = new ZipArchive();
if ( $theme_zip->open( $theme_zip_path, ZipArchive::CREATE | ZipArchive::OVERWRITE ) !== true ) {
	die( "Error: Unable to create $theme_zip_path\n" );
}

$theme_zip->addEmptyDir( 'agrovia' );

$theme_excludes = array(
	'.git',
	'.DS_Store',
	'.gitignore',
	'node_modules',
	'vendor',
	'companion-plugin',
	'kits',
	'release',
	'scripts',
	'documentation',
	'AI-THEME-SPEC.md',
	'verdant-farms-antigravity.md',
	'package.json',
	'package-lock.json',
);

agrovia_zip_dir( $theme_zip, $root_dir, 'agrovia', $theme_excludes );
$theme_zip->close();
echo "   [SUCCESS] Created release/agrovia.zip (" . agrovia_format_size( filesize( $theme_zip_path ) ) . ")\n\n";

// -------------------------------------------------------------------------
// 2. Build Agrovia Core Companion Plugin Package (agrovia-core.zip)
// -------------------------------------------------------------------------
echo "2. Building Agrovia Core Companion Plugin ZIP (release/agrovia-core.zip)...\n";
$plugin_zip_path = $release_dir . '/agrovia-core.zip';
if ( file_exists( $plugin_zip_path ) ) {
	unlink( $plugin_zip_path );
}

$plugin_zip = new ZipArchive();
if ( $plugin_zip->open( $plugin_zip_path, ZipArchive::CREATE | ZipArchive::OVERWRITE ) !== true ) {
	die( "Error: Unable to create $plugin_zip_path\n" );
}

$plugin_zip->addEmptyDir( 'agrovia-core' );

$plugin_dir      = $root_dir . '/companion-plugin/agrovia-core';
$plugin_excludes = array(
	'.git',
	'.DS_Store',
	'node_modules',
	'vendor',
);

agrovia_zip_dir( $plugin_zip, $plugin_dir, 'agrovia-core', $plugin_excludes );
$plugin_zip->close();
echo "   [SUCCESS] Created release/agrovia-core.zip (" . agrovia_format_size( filesize( $plugin_zip_path ) ) . ")\n\n";

// -------------------------------------------------------------------------
// 3. Build Elementor Website Kit Package (agrovia-demo-kit.zip)
// -------------------------------------------------------------------------
echo "3. Building Elementor Demo Website Kit ZIP (release/agrovia-demo-kit.zip)...\n";
$kit_zip_path = $release_dir . '/agrovia-demo-kit.zip';
if ( file_exists( $kit_zip_path ) ) {
	unlink( $kit_zip_path );
}

$kit_zip = new ZipArchive();
if ( $kit_zip->open( $kit_zip_path, ZipArchive::CREATE | ZipArchive::OVERWRITE ) !== true ) {
	die( "Error: Unable to create $kit_zip_path\n" );
}

$kit_dir = $root_dir . '/kits/agrovia-demo';
agrovia_zip_dir( $kit_zip, $kit_dir, '', array( '.DS_Store' ) );
$kit_zip->close();
echo "   [SUCCESS] Created release/agrovia-demo-kit.zip (" . agrovia_format_size( filesize( $kit_zip_path ) ) . ")\n\n";

// -------------------------------------------------------------------------
// 4. Build Complete Master Distribution Package (agrovia-complete-package-v1.0.0.zip)
// -------------------------------------------------------------------------
echo "4. Building Master Distribution Package (release/agrovia-complete-package-v1.0.0.zip)...\n";
$master_zip_path = $release_dir . '/agrovia-complete-package-v1.0.0.zip';
if ( file_exists( $master_zip_path ) ) {
	unlink( $master_zip_path );
}

$master_zip = new ZipArchive();
if ( $master_zip->open( $master_zip_path, ZipArchive::CREATE | ZipArchive::OVERWRITE ) !== true ) {
	die( "Error: Unable to create $master_zip_path\n" );
}

$master_prefix = 'agrovia-complete-package-v1.0.0';
$master_zip->addEmptyDir( $master_prefix );

// Add individual release archives into master package.
$master_zip->addFile( $theme_zip_path, $master_prefix . '/agrovia.zip' );
$master_zip->addFile( $plugin_zip_path, $master_prefix . '/agrovia-core.zip' );
$master_zip->addFile( $kit_zip_path, $master_prefix . '/agrovia-demo-kit.zip' );

// Add core documentation and licenses.
$master_zip->addFile( $root_dir . '/README.md', $master_prefix . '/README.md' );
$master_zip->addFile( $root_dir . '/CHANGELOG.md', $master_prefix . '/CHANGELOG.md' );
$master_zip->addFile( $root_dir . '/LICENSE.md', $master_prefix . '/LICENSE.md' );

// Add full documentation suite.
agrovia_zip_dir( $master_zip, $root_dir . '/documentation', $master_prefix . '/documentation', array( '.DS_Store' ) );

$master_zip->close();
echo "   [SUCCESS] Created release/agrovia-complete-package-v1.0.0.zip (" . agrovia_format_size( filesize( $master_zip_path ) ) . ")\n\n";

// -------------------------------------------------------------------------
// 5. Verification of Generated Packages
// -------------------------------------------------------------------------
echo "5. Verifying archive integrity and contents...\n";

function agrovia_verify_zip( $zip_file, $expected_entries ) {
	$z = new ZipArchive();
	$res = $z->open( $zip_file );
	if ( $res !== true ) {
		echo "   [FAIL] Could not open $zip_file\n";
		return false;
	}
	$found = array();
	for ( $i = 0; $i < $z->numFiles; $i++ ) {
		$stat = $z->statIndex( $i );
		$found[] = $stat['name'];
	}
	$z->close();

	$all_found = true;
	foreach ( $expected_entries as $entry ) {
		if ( ! in_array( $entry, $found, true ) ) {
			echo "   [FAIL] Missing expected entry '$entry' in $zip_file\n";
			$all_found = false;
		}
	}
	return $all_found;
}

$theme_ok  = agrovia_verify_zip( $theme_zip_path, array( 'agrovia/style.css', 'agrovia/index.php', 'agrovia/screenshot.png', 'agrovia/readme.txt', 'agrovia/theme.json' ) );
$plugin_ok = agrovia_verify_zip( $plugin_zip_path, array( 'agrovia-core/agrovia-core.php', 'agrovia-core/readme.txt' ) );
$kit_ok    = agrovia_verify_zip( $kit_zip_path, array( 'manifest.json', 'site-settings.json', 'demo-content.json' ) );
$master_ok = agrovia_verify_zip( $master_zip_path, array( 'agrovia-complete-package-v1.0.0/agrovia.zip', 'agrovia-complete-package-v1.0.0/agrovia-core.zip', 'agrovia-complete-package-v1.0.0/agrovia-demo-kit.zip', 'agrovia-complete-package-v1.0.0/README.md' ) );

if ( $theme_ok && $plugin_ok && $kit_ok && $master_ok ) {
	echo "   [PASS] All 4 release archives passed structural integrity verification!\n\n";
	echo "======================================================================\n";
	echo "  RELEASE PACKAGING COMPLETE (Ready for Distribution)\n";
	echo "======================================================================\n";
	exit( 0 );
} else {
	echo "   [FAIL] One or more archives failed verification.\n";
	exit( 1 );
}
