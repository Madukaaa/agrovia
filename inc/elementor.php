<?php
/**
 * Agrovia Elementor Compatibility & Theme Builder Location Registration
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

/**
 * Register Elementor Theme Builder Locations.
 *
 * @param \ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager Theme manager instance.
 * @return void
 */
function agrovia_register_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_all_core_location();
}
add_action( 'elementor/theme/register_locations', 'agrovia_register_elementor_locations' );

/**
 * Check if Elementor rendered a given Theme Builder location.
 *
 * @param string $location Location name (header, footer, single, archive).
 * @return bool True if Elementor rendered the location, false otherwise.
 */
function agrovia_elementor_do_location( $location ) {
	if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( $location ) ) {
		return true;
	}
	return false;
}

/**
 * Check if Elementor core plugin is active.
 *
 * @return bool
 */
function agrovia_is_elementor_active() {
	return did_action( 'elementor/loaded' ) > 0;
}

/**
 * Check if Elementor Pro plugin is active.
 *
 * @return bool
 */
function agrovia_is_elementor_pro_active() {
	return defined( 'ELEMENTOR_PRO_VERSION' );
}

/**
 * Check if current view is inside the Elementor editor or preview.
 *
 * @return bool
 */
function agrovia_is_elementor_preview() {
	if ( ! agrovia_is_elementor_active() ) {
		return false;
	}

	return \Elementor\Plugin::$instance->preview->is_preview_mode() || \Elementor\Plugin::$instance->editor->is_edit_mode();
}

/**
 * Check if a post or page was built using Elementor.
 *
 * @param int|null $post_id Post ID. Defaults to current post.
 * @return bool
 */
function agrovia_is_built_with_elementor( $post_id = null ) {
	if ( ! agrovia_is_elementor_active() ) {
		return false;
	}

	$post_id = $post_id ? $post_id : get_the_ID();
	if ( ! $post_id ) {
		return false;
	}

	$document = \Elementor\Plugin::$instance->documents->get( $post_id );
	return $document && $document->is_built_with_elementor();
}

/**
 * Add Elementor-specific body classes for full-width layout control.
 *
 * @param array $classes Body classes.
 * @return array
 */
function agrovia_elementor_body_classes( $classes ) {
	if ( agrovia_is_elementor_active() ) {
		$classes[] = 'elementor-ready';

		if ( is_singular() && agrovia_is_built_with_elementor() ) {
			$classes[] = 'agrovia-elementor-page';

			$template = get_page_template_slug();
			if ( 'elementor_header_footer' === $template || '' === $template ) {
				$classes[] = 'agrovia-elementor-full-width';
			}
		}
	}

	return $classes;
}
add_filter( 'body_class', 'agrovia_elementor_body_classes' );
