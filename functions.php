<?php
/**
 * Agrovia Theme Functions and Definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

/**
 * Define Theme Constants.
 */
define( 'AGROVIA_VERSION', '1.0.0' );
define( 'AGROVIA_DIR', trailingslashit( get_template_directory() ) );
define( 'AGROVIA_URI', trailingslashit( get_template_directory_uri() ) );

/**
 * Load Modular Theme Components.
 */
$agrovia_includes = array(
	'inc/setup.php',              // Theme setup, supports, image sizes, content width.
	'inc/enqueue.php',            // Enqueue CSS, JS, and typography assets.
	'inc/template-functions.php', // Helper functions, body classes, pingbacks.
	'inc/template-tags.php',      // Dynamic metadata, post dates, authors, thumbnails.
	'inc/menus.php',              // Navigation menu registrations.
	'inc/widgets.php',            // Widget areas and sidebars.
	'inc/accessibility.php',      // Accessibility helpers and skip links.
	'inc/compatibility.php',      // PHP/WordPress version compatibility safeguards.
	'inc/customizer.php',         // Theme Customizer branding & options.
	'inc/elementor.php',          // Elementor Theme Builder locations & integration hooks.
	'inc/woocommerce.php',        // WooCommerce theme support & wrappers.
);

foreach ( $agrovia_includes as $file ) {
	$filepath = AGROVIA_DIR . $file;
	if ( file_exists( $filepath ) ) {
		require_once $filepath;
	}
}
