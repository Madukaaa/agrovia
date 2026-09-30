<?php
/**
 * Agrovia Functions which enhance the theme by hooking into WordPress
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function agrovia_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Elementor check.
	if ( did_action( 'elementor/loaded' ) ) {
		$classes[] = 'elementor-supported';
	}

	// JavaScript detection class.
	$classes[] = 'agrovia-no-js';

	return $classes;
}
add_filter( 'body_class', 'agrovia_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 *
 * @return void
 */
function agrovia_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'agrovia_pingback_header' );

/**
 * Replace agrovia-no-js with agrovia-js on DOM load.
 *
 * @return void
 */
function agrovia_detect_js_inline() {
	echo "<script>(function(){document.documentElement.classList.remove('agrovia-no-js');document.documentElement.classList.add('agrovia-js');})();</script>\n";
}
add_action( 'wp_head', 'agrovia_detect_js_inline', 1 );

/**
 * Custom excerpt length.
 *
 * @param int $length Default length.
 * @return int
 */
function agrovia_excerpt_length( $length ) {
	return is_admin() ? $length : 30;
}
add_filter( 'excerpt_length', 'agrovia_excerpt_length', 999 );

/**
 * Custom excerpt more string.
 *
 * @param string $more Default string.
 * @return string
 */
function agrovia_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}
	return '&hellip;';
}
add_filter( 'excerpt_more', 'agrovia_excerpt_more' );
