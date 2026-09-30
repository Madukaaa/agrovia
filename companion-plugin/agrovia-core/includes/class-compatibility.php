<?php
/**
 * Agrovia Core Compatibility Checker
 *
 * Verifies system requirements and plugin dependencies.
 *
 * @package AgroviaCore
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

class Agrovia_Core_Compatibility {

	const MIN_PHP = '7.4.0';
	const MIN_WP  = '6.0';

	/**
	 * Check environment compatibility.
	 *
	 * @return bool
	 */
	public static function check_requirements() {
		$compatible = true;

		if ( version_compare( PHP_VERSION, self::MIN_PHP, '<' ) ) {
			add_action( 'admin_notices', array( __CLASS__, 'php_version_notice' ) );
			$compatible = false;
		}

		global $wp_version;
		if ( version_compare( $wp_version, self::MIN_WP, '<' ) ) {
			add_action( 'admin_notices', array( __CLASS__, 'wp_version_notice' ) );
			$compatible = false;
		}

		return $compatible;
	}

	/**
	 * Admin notice for unsupported PHP version.
	 *
	 * @return void
	 */
	public static function php_version_notice() {
		printf(
			'<div class="notice notice-error"><p>%s</p></div>',
			sprintf(
				/* translators: 1: required PHP version, 2: current version */
				esc_html__( 'Agrovia Core requires PHP version %1$s or higher. Your server is running version %2$s. Please upgrade your PHP configuration.', 'agrovia-core' ),
				self::MIN_PHP,
				esc_html( PHP_VERSION )
			)
		);
	}

	/**
	 * Admin notice for unsupported WordPress version.
	 *
	 * @return void
	 */
	public static function wp_version_notice() {
		global $wp_version;
		printf(
			'<div class="notice notice-error"><p>%s</p></div>',
			sprintf(
				/* translators: 1: required WP version, 2: current version */
				esc_html__( 'Agrovia Core requires WordPress version %1$s or higher. You are running version %2$s. Please update WordPress.', 'agrovia-core' ),
				self::MIN_WP,
				esc_html( $wp_version )
			)
		);
	}

	/**
	 * Check if Elementor is loaded.
	 *
	 * @return bool
	 */
	public static function is_elementor_active() {
		return did_action( 'elementor/loaded' ) > 0;
	}
}
