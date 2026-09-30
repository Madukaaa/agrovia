<?php
/**
 * Agrovia Theme Setup
 *
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'agrovia_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @return void
	 */
	function agrovia_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'agrovia', AGROVIA_DIR . 'languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Custom image crop sizes for editorial agriculture layouts.
		add_image_size( 'agrovia-featured', 1200, 675, true ); // 16:9 widescreen
		add_image_size( 'agrovia-card', 640, 427, true );      // 3:2 editorial card
		add_image_size( 'agrovia-portrait', 600, 750, true );  // 4:5 portrait for produce & farmers

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		/*
		 * Set up the WordPress core custom logo feature.
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'               => 80,
				'width'                => 240,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => false,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line-height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for experimental link color control.
		add_theme_support( 'link-color' );

		// Add support for experimental custom spacing & units.
		add_theme_support( 'custom-spacing' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/editor.css' );
	}
endif;
add_action( 'after_setup_theme', 'agrovia_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 * @return void
 */
function agrovia_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'agrovia_content_width', 1280 );
}
add_action( 'after_setup_theme', 'agrovia_content_width', 0 );

/**
 * Optimize image sizes attribute for responsive card and archive grids.
 *
 * @param string       $sizes A source size value for use in a content image.
 * @param array|string $size  Requested image size.
 * @return string Filtered sizes attribute.
 */
function agrovia_calculate_image_sizes( $sizes, $size ) {
	if ( 'agrovia-card' === $size ) {
		return '(max-width: 640px) 100vw, (max-width: 1024px) 50vw, 33vw';
	} elseif ( 'agrovia-featured' === $size ) {
		return '(max-width: 1280px) 100vw, 1200px';
	} elseif ( 'agrovia-portrait' === $size ) {
		return '(max-width: 640px) 100vw, (max-width: 1024px) 50vw, 25vw';
	}
	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'agrovia_calculate_image_sizes', 10, 2 );

