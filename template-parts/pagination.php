<?php
/**
 * Template part for displaying numeric pagination
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

the_posts_pagination(
	array(
		'mid_size'           => 2,
		'prev_text'          => sprintf(
			'<span class="nav-prev-text" aria-hidden="true">&larr; %s</span><span class="screen-reader-text">%s</span>',
			esc_html__( 'Previous', 'agrovia' ),
			esc_html__( 'Previous page', 'agrovia' )
		),
		'next_text'          => sprintf(
			'<span class="nav-next-text" aria-hidden="true">%s &rarr;</span><span class="screen-reader-text">%s</span>',
			esc_html__( 'Next', 'agrovia' ),
			esc_html__( 'Next page', 'agrovia' )
		),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'agrovia' ) . ' </span>',
		'class'              => 'agrovia-pagination',
	)
);
