<?php
/**
 * Agrovia Theme Customizer
 *
 * Provides site identity and branding controls without duplicating Elementor styles.
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function agrovia_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'agrovia_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'agrovia_customize_partial_blogdescription',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'agrovia_footer_copyright',
			array(
				'selector'        => '.copyright-custom-text',
				'render_callback' => 'agrovia_customize_partial_copyright',
			)
		);
	}

	/*
	 * Section: Agrovia Header CTA
	 */
	$wp_customize->add_section(
		'agrovia_header_section',
		array(
			'title'       => esc_html__( 'Header Options', 'agrovia' ),
			'priority'    => 40,
			'description' => esc_html__( 'Manage the header CTA button without editing PHP files.', 'agrovia' ),
		)
	);

	// Enable Header CTA.
	$wp_customize->add_setting(
		'agrovia_header_cta_enable',
		array(
			'default'           => true,
			'sanitize_callback' => 'agrovia_sanitize_checkbox',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'agrovia_header_cta_enable',
		array(
			'label'    => esc_html__( 'Show Header CTA Button', 'agrovia' ),
			'section'  => 'agrovia_header_section',
			'type'     => 'checkbox',
		)
	);

	// Header CTA Label.
	$wp_customize->add_setting(
		'agrovia_header_cta_text',
		array(
			'default'           => esc_html__( 'Contact', 'agrovia' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'agrovia_header_cta_text',
		array(
			'label'    => esc_html__( 'Header CTA Button Label', 'agrovia' ),
			'section'  => 'agrovia_header_section',
			'type'     => 'text',
		)
	);

	// Header CTA URL.
	$wp_customize->add_setting(
		'agrovia_header_cta_url',
		array(
			'default'           => '#contact',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'agrovia_header_cta_url',
		array(
			'label'    => esc_html__( 'Header CTA Button URL', 'agrovia' ),
			'section'  => 'agrovia_header_section',
			'type'     => 'url',
		)
	);

	/*
	 * Section: Agrovia Footer Settings
	 */
	$wp_customize->add_section(
		'agrovia_footer_section',
		array(
			'title'       => esc_html__( 'Footer Settings', 'agrovia' ),
			'priority'    => 120,
			'description' => esc_html__( 'Customize the footer copyright text.', 'agrovia' ),
		)
	);

	$wp_customize->add_setting(
		'agrovia_footer_copyright',
		array(
			'default'           => esc_html__( 'Growing food. Restoring nature.', 'agrovia' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'agrovia_footer_copyright',
		array(
			'label'    => esc_html__( 'Footer Tagline / Copyright', 'agrovia' ),
			'section'  => 'agrovia_footer_section',
			'type'     => 'text',
		)
	);
}
add_action( 'customize_register', 'agrovia_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function agrovia_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function agrovia_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render footer copyright for selective refresh.
 *
 * @return void
 */
function agrovia_customize_partial_copyright() {
	echo esc_html( get_theme_mod( 'agrovia_footer_copyright', __( 'Growing food. Restoring nature.', 'agrovia' ) ) );
}

/**
 * Sanitize checkbox inputs.
 *
 * @param bool|string $checked Input value.
 * @return bool
 */
function agrovia_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true === (bool) $checked ) ? true : false );
}

/**
 * Binds JS handlers to instantly make Theme Customizer preview reload changes asynchronously.
 *
 * @return void
 */
function agrovia_customize_preview_js() {
	if ( file_exists( AGROVIA_DIR . 'assets/js/customizer.js' ) ) {
		wp_enqueue_script(
			'agrovia-customizer',
			AGROVIA_URI . 'assets/js/customizer.js',
			array( 'customize-preview' ),
			filemtime( AGROVIA_DIR . 'assets/js/customizer.js' ),
			true
		);
	}
}
add_action( 'customize_preview_init', 'agrovia_customize_preview_js' );

