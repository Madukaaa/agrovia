<?php
/**
 * Agrovia Enqueue Scripts and Styles
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

/**
 * Register Google Fonts resource hints for performance.
 *
 * @param array  $urls          Array of resources and their attributes.
 * @param string $relation_type The relation type the URLs are for.
 * @return array
 */
function agrovia_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'agrovia-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.googleapis.com',
			'crossorigin',
		);
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'agrovia_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 *
 * @return void
 */
function agrovia_scripts() {
	// Google Fonts: Cormorant Garamond (Editorial Serif) & Inter (Clean UI Sans).
	$fonts_url = 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600;700&display=swap';
	wp_enqueue_style( 'agrovia-fonts', $fonts_url, array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

	// Base stylesheet (reset, tokens, layout foundations).
	if ( file_exists( AGROVIA_DIR . 'assets/css/base.css' ) ) {
		wp_enqueue_style(
			'agrovia-base',
			AGROVIA_URI . 'assets/css/base.css',
			array( 'agrovia-fonts' ),
			filemtime( AGROVIA_DIR . 'assets/css/base.css' )
		);
	}

	// Components stylesheet (cards, buttons, forms, nav).
	if ( file_exists( AGROVIA_DIR . 'assets/css/components.css' ) ) {
		wp_enqueue_style(
			'agrovia-components',
			AGROVIA_URI . 'assets/css/components.css',
			array( 'agrovia-base' ),
			filemtime( AGROVIA_DIR . 'assets/css/components.css' )
		);
	}

	// Utilities stylesheet (grid, spacing, visibility).
	if ( file_exists( AGROVIA_DIR . 'assets/css/utilities.css' ) ) {
		wp_enqueue_style(
			'agrovia-utilities',
			AGROVIA_URI . 'assets/css/utilities.css',
			array( 'agrovia-components' ),
			filemtime( AGROVIA_DIR . 'assets/css/utilities.css' )
		);
	}

	// Main theme header stylesheet.
	wp_enqueue_style(
		'agrovia-style',
		get_stylesheet_uri(),
		array(),
		AGROVIA_VERSION
	);

	// WooCommerce stylesheet (only loaded on store pages when active).
	if ( function_exists( 'agrovia_is_woocommerce_active' ) && agrovia_is_woocommerce_active() ) {
		if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
			if ( file_exists( AGROVIA_DIR . 'assets/css/woocommerce.css' ) ) {
				wp_enqueue_style(
					'agrovia-woocommerce',
					AGROVIA_URI . 'assets/css/woocommerce.css',
					array( 'agrovia-style' ),
					filemtime( AGROVIA_DIR . 'assets/css/woocommerce.css' )
				);
			}
		}
	}

	// Navigation script (responsive toggle, keyboard navigation, a11y).
	if ( file_exists( AGROVIA_DIR . 'assets/js/navigation.js' ) ) {
		wp_enqueue_script(
			'agrovia-navigation',
			AGROVIA_URI . 'assets/js/navigation.js',
			array(),
			filemtime( AGROVIA_DIR . 'assets/js/navigation.js' ),
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
	}

	// Main theme front-end script.
	if ( file_exists( AGROVIA_DIR . 'assets/js/main.js' ) ) {
		wp_enqueue_script(
			'agrovia-main',
			AGROVIA_URI . 'assets/js/main.js',
			array(),
			filemtime( AGROVIA_DIR . 'assets/js/main.js' ),
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);

		// Localize script for dynamic client-side helpers.
		wp_localize_script(
			'agrovia-main',
			'agroviaData',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'agrovia_nonce' ),
				'i18n'    => array(
					'expand'   => esc_html__( 'Expand menu', 'agrovia' ),
					'collapse' => esc_html__( 'Collapse menu', 'agrovia' ),
				),
			)
		);
	}

	// Threaded comment reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'agrovia_scripts' );

/**
 * Enqueue block editor assets.
 *
 * @return void
 */
function agrovia_block_editor_assets() {
	$fonts_url = 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap';
	wp_enqueue_style( 'agrovia-editor-fonts', $fonts_url, array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

	if ( file_exists( AGROVIA_DIR . 'assets/css/editor.css' ) ) {
		wp_enqueue_style(
			'agrovia-block-editor-style',
			AGROVIA_URI . 'assets/css/editor.css',
			array( 'agrovia-editor-fonts' ),
			filemtime( AGROVIA_DIR . 'assets/css/editor.css' )
		);
	}
}
add_action( 'enqueue_block_editor_assets', 'agrovia_block_editor_assets' );

/**
 * Add defer attribute to non-blocking theme scripts.
 *
 * @param string $tag    The <script> tag for the enqueued script.
 * @param string $handle The script's registered handle.
 * @return string Modified script tag.
 */
function agrovia_defer_scripts( $tag, $handle ) {
	$defer_scripts = array( 'agrovia-navigation', 'agrovia-main' );
	if ( in_array( $handle, $defer_scripts, true ) ) {
		if ( false === strpos( $tag, 'defer' ) ) {
			return str_replace( ' src', ' defer src', $tag );
		}
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'agrovia_defer_scripts', 10, 2 );

/**
 * Remove unnecessary default header tags for performance and security.
 *
 * @return void
 */
function agrovia_cleanup_head() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
}
add_action( 'init', 'agrovia_cleanup_head' );

