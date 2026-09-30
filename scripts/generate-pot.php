<?php
/**
 * Agrovia POT Generator
 *
 * Scans PHP files in the Agrovia theme and Agrovia Core companion plugin
 * to extract all internationalization strings and generate standard GNU gettext POT files.
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Define execution mode.
if ( php_sapi_name() !== 'cli' ) {
	die( "This script can only be run from the command line.\n" );
}

$root_dir = dirname( __DIR__ );

/**
 * Format a string for PO file output.
 *
 * @param string $str Input string.
 * @return string Formatted string.
 */
function po_escape( $str ) {
	$str = str_replace( array( '\\', '"' ), array( '\\\\', '\"' ), $str );
	$str = str_replace( "\n", "\\n\"\n\"", $str );
	return '"' . $str . '"';
}

/**
 * Extract i18n strings from a directory for a given text domain.
 *
 * @param string $dir           Directory to scan.
 * @param string $target_domain Expected text domain.
 * @param array  $exclude_paths Subpaths to exclude.
 * @return array Extracted entries.
 */
function agrovia_extract_strings( $dir, $target_domain, $exclude_paths = array() ) {
	$iterator = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $dir ) );
	$i18n_funcs = array(
		'__'          => array( 'text', 'domain' ),
		'_e'          => array( 'text', 'domain' ),
		'_x'          => array( 'text', 'context', 'domain' ),
		'_ex'         => array( 'text', 'context', 'domain' ),
		'_n'          => array( 'single', 'plural', 'number', 'domain' ),
		'_nx'         => array( 'single', 'plural', 'number', 'context', 'domain' ),
		'esc_attr__'  => array( 'text', 'domain' ),
		'esc_attr_e'  => array( 'text', 'domain' ),
		'esc_attr_x'  => array( 'text', 'context', 'domain' ),
		'esc_html__'  => array( 'text', 'domain' ),
		'esc_html_e'  => array( 'text', 'domain' ),
		'esc_html_x'  => array( 'text', 'context', 'domain' ),
	);

	$catalog = array();

	foreach ( $iterator as $file ) {
		if ( ! $file->isFile() || $file->getExtension() !== 'php' ) {
			continue;
		}
		$path = $file->getPathname();

		$skip = false;
		foreach ( $exclude_paths as $exclude ) {
			if ( strpos( $path, $exclude ) !== false ) {
				$skip = true;
				break;
			}
		}
		if ( $skip ) {
			continue;
		}

		$tokens = token_get_all( file_get_contents( $path ) );
		$count  = count( $tokens );

		for ( $i = 0; $i < $count; $i++ ) {
			if ( is_array( $tokens[ $i ] ) && $tokens[ $i ][0] === T_STRING && isset( $i18n_funcs[ $tokens[ $i ][1] ] ) ) {
				$func   = $tokens[ $i ][1];
				$schema = $i18n_funcs[ $func ];
				$line   = $tokens[ $i ][2];

				// Parse function arguments within outer parentheses.
				$paren_depth  = 0;
				$args_tokens  = array();
				$current_arg  = array();

				for ( $j = $i + 1; $j < $count; $j++ ) {
					$tok     = $tokens[ $j ];
					$tok_str = is_array( $tok ) ? $tok[1] : $tok;

					if ( $tok_str === '(' ) {
						$paren_depth++;
						if ( $paren_depth === 1 ) {
							continue;
						}
					} elseif ( $tok_str === ')' ) {
						$paren_depth--;
						if ( $paren_depth === 0 ) {
							if ( ! empty( $current_arg ) ) {
								$args_tokens[] = $current_arg;
							}
							break;
						}
					} elseif ( $tok_str === ',' && $paren_depth === 1 ) {
						$args_tokens[] = $current_arg;
						$current_arg   = array();
						continue;
					}

					if ( $paren_depth >= 1 ) {
						$current_arg[] = $tok;
					}
				}

				// Resolve string literal values.
				$eval_tokens = function( $tok_list ) {
					$val = '';
					foreach ( $tok_list as $t ) {
						if ( is_array( $t ) && $t[0] === T_CONSTANT_ENCAPSED_STRING ) {
							$raw = $t[1];
							$quote = $raw[0];
							$inner = substr( $raw, 1, -1 );
							if ( $quote === "'" ) {
								$val .= str_replace( array( "\\\\", "\\'" ), array( '\\', "'" ), $inner );
							} else {
								$val .= stripcslashes( $inner );
							}
						}
					}
					return $val;
				};

				$args_val = array_map( $eval_tokens, $args_tokens );

				$entry = array();
				foreach ( $schema as $idx => $arg_name ) {
					$entry[ $arg_name ] = isset( $args_val[ $idx ] ) ? $args_val[ $idx ] : null;
				}

				if ( isset( $entry['domain'] ) && $entry['domain'] === $target_domain ) {
					$text = isset( $entry['text'] ) ? $entry['text'] : ( isset( $entry['single'] ) ? $entry['single'] : '' );
					if ( '' === $text ) {
						continue;
					}
					$ctxt = isset( $entry['context'] ) ? $entry['context'] : '';
					$key  = $ctxt . "\x04" . $text;

					if ( ! isset( $catalog[ $key ] ) ) {
						$catalog[ $key ] = array(
							'msgid'        => $text,
							'msgid_plural' => isset( $entry['plural'] ) ? $entry['plural'] : null,
							'msgctxt'      => ! empty( $ctxt ) ? $ctxt : null,
							'references'   => array(),
						);
					}

					$rel_path = str_replace( array( realpath( $dir ) . '/', $dir . '/' ), '', $path );
					$ref      = $rel_path . ':' . $line;
					if ( ! in_array( $ref, $catalog[ $key ]['references'], true ) ) {
						$catalog[ $key ]['references'][] = $ref;
					}
				}
			}
		}
	}

	// Sort catalog alphabetically by msgid.
	ksort( $catalog );
	return $catalog;
}

/**
 * Write a POT file from extracted entries.
 *
 * @param string $output_file Output POT file path.
 * @param array  $catalog     Catalog entries.
 * @param string $project_name Project name.
 * @param string $domain      Text domain.
 */
function agrovia_write_pot_file( $output_file, $catalog, $project_name, $domain ) {
	$header = '# Copyright (C) ' . date( 'Y' ) . " Maduka Karunathilake\n"
		. "# This file is distributed under the GPL-2.0-or-later.\n"
		. "msgid \"\"\n"
		. "msgstr \"\"\n"
		. "\"Project-Id-Version: " . $project_name . " 1.0.0\\n\"\n"
		. "\"Report-Msgid-Bugs-To: https://agrovia.local\\n\"\n"
		. "\"Last-Translator: Maduka Karunathilake <support@agrovia.local>\\n\"\n"
		. "\"Language-Team: English <support@agrovia.local>\\n\"\n"
		. "\"MIME-Version: 1.0\\n\"\n"
		. "\"Content-Type: text/plain; charset=UTF-8\\n\"\n"
		. "\"Content-Transfer-Encoding: 8bit\\n\"\n"
		. "\"POT-Creation-Date: " . date( 'c' ) . "\\n\"\n"
		. "\"PO-Revision-Date: YEAR-MO-DA HO:MI+ZONE\\n\"\n"
		. "\"X-Generator: Agrovia POT Generator 1.0.0\\n\"\n"
		. "\"X-Domain: " . $domain . "\\n\"\n\n";

	$body = '';

	foreach ( $catalog as $entry ) {
		foreach ( $entry['references'] as $ref ) {
			$body .= '#: ' . $ref . "\n";
		}
		if ( ! empty( $entry['msgctxt'] ) ) {
			$body .= 'msgctxt ' . po_escape( $entry['msgctxt'] ) . "\n";
		}
		$body .= 'msgid ' . po_escape( $entry['msgid'] ) . "\n";
		if ( ! empty( $entry['msgid_plural'] ) ) {
			$body .= 'msgid_plural ' . po_escape( $entry['msgid_plural'] ) . "\n";
			$body .= "msgstr[0] \"\"\n";
			$body .= "msgstr[1] \"\"\n\n";
		} else {
			$body .= "msgstr \"\"\n\n";
		}
	}

	$dir = dirname( $output_file );
	if ( ! is_dir( $dir ) ) {
		mkdir( $dir, 0755, true );
	}

	file_put_contents( $output_file, $header . $body );
}

echo "=== Agrovia POT Generator ===\n\n";

// 1. Generate Theme POT.
echo "1. Scanning Agrovia Theme PHP files...\n";
$theme_catalog = agrovia_extract_strings(
	$root_dir,
	'agrovia',
	array( '/node_modules/', '/vendor/', '/companion-plugin/', '/scripts/' )
);
$theme_pot = $root_dir . '/languages/agrovia.pot';
agrovia_write_pot_file( $theme_pot, $theme_catalog, 'Agrovia', 'agrovia' );
echo "   Extracted " . count( $theme_catalog ) . " strings to " . $theme_pot . "\n";

// 2. Generate Companion Plugin POT.
echo "2. Scanning Agrovia Core Plugin PHP files...\n";
$plugin_dir = $root_dir . '/companion-plugin/agrovia-core';
$plugin_catalog = agrovia_extract_strings(
	$plugin_dir,
	'agrovia-core',
	array( '/node_modules/', '/vendor/' )
);
$plugin_pot = $plugin_dir . '/languages/agrovia-core.pot';
agrovia_write_pot_file( $plugin_pot, $plugin_catalog, 'Agrovia Core', 'agrovia-core' );
echo "   Extracted " . count( $plugin_catalog ) . " strings to " . $plugin_pot . "\n";

echo "\nPOT Generation completed successfully!\n";
