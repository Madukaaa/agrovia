<?php
/**
 * Agrovia Accessibility Helpers & Enhancements
 *
 * Implements WCAG 2.1 AA compliant features: skip links, keyboard navigation,
 * aria-current landmarks, and accessible form labels.
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

/**
 * Render the skip-to-content link immediately after <body>.
 *
 * @return void
 */
function agrovia_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#primary">' . esc_html__( 'Skip to content', 'agrovia' ) . '</a>';
}
add_action( 'wp_body_open', 'agrovia_skip_link', 5 );

/**
 * Add aria-current="page" to active navigation menu items.
 *
 * @param array    $atts The HTML attributes applied to the menu item's <a> element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @param int      $depth Depth of menu item.
 * @return array Modified attributes array.
 */
function agrovia_nav_menu_aria_current( $atts, $item, $args, $depth = 0 ) {
	if ( ! empty( $item->current ) ) {
		$atts['aria-current'] = 'page';
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'agrovia_nav_menu_aria_current', 10, 4 );

/**
 * Enhance post navigation previous/next links with accessible ARIA context.
 *
 * @param string $template The template string for navigation.
 * @param string $class    The class string.
 * @return string Modified navigation markup.
 */
function agrovia_accessible_post_nav( $template, $class ) {
	return str_replace(
		'<nav class="navigation ',
		'<nav aria-label="' . esc_attr__( 'Posts navigation', 'agrovia' ) . '" class="navigation ',
		$template
	);
}
add_filter( 'navigation_markup_template', 'agrovia_accessible_post_nav', 10, 2 );

/**
 * Sanitize and structure archive titles for screen reader clarity.
 *
 * @param string $title Archive title.
 * @return string Filtered title.
 */
function agrovia_accessible_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'agrovia_accessible_archive_title' );

/**
 * Enhance default comment form fields for WCAG accessibility.
 *
 * @param array $defaults Default comment form arguments.
 * @return array Filtered arguments.
 */
function agrovia_accessible_comment_form( $defaults ) {
	$defaults['title_reply_before'] = '<h2 id="reply-title" class="comment-reply-title">';
	$defaults['title_reply_after']  = '</h2>';
	return $defaults;
}
add_filter( 'comment_form_defaults', 'agrovia_accessible_comment_form' );
