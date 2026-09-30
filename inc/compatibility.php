<?php
/**
 * Agrovia Compatibility Safeguards
 *
 * Prevents execution errors on older PHP or WordPress versions.
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

/**
 * Checks minimum environment requirements.
 *
 * @return bool
 */
function agrovia_check_requirements() {
	$min_php = '7.4.0';
	$min_wp  = '6.0';

	if ( version_compare( PHP_VERSION, $min_php, '<' ) ) {
		add_action( 'admin_notices', 'agrovia_php_version_notice' );
		return false;
	}

	global $wp_version;
	if ( version_compare( $wp_version, $min_wp, '<' ) ) {
		add_action( 'admin_notices', 'agrovia_wp_version_notice' );
		return false;
	}

	return true;
}

/**
 * Admin notice for unsupported PHP versions.
 *
 * @return void
 */
function agrovia_php_version_notice() {
	printf(
		'<div class="notice notice-error"><p>%s</p></div>',
		sprintf(
			/* translators: 1: PHP version, 2: current version */
			esc_html__( 'Agrovia requires at least PHP version %1$s. You are running version %2$s. Please upgrade your PHP configuration.', 'agrovia' ),
			'7.4.0',
			esc_html( PHP_VERSION )
		)
	);
}

/**
 * Admin notice for unsupported WordPress versions.
 *
 * @return void
 */
function agrovia_wp_version_notice() {
	global $wp_version;
	printf(
		'<div class="notice notice-error"><p>%s</p></div>',
		sprintf(
			/* translators: 1: WordPress version, 2: current version */
			esc_html__( 'Agrovia requires at least WordPress version %1$s. You are running version %2$s. Please update WordPress.', 'agrovia' ),
			'6.0',
			esc_html( $wp_version )
		)
	);
}

agrovia_check_requirements();
