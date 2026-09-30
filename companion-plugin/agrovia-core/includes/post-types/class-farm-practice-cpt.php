<?php
/**
 * Agrovia Farm Practice Custom Post Type
 *
 * Models sustainable agricultural methods (Soil Health, Water Conservation,
 * Renewable Energy, Biodiversity, Waste Reduction).
 *
 * @package AgroviaCore
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

class Agrovia_Farm_Practice_CPT {

	const POST_TYPE = 'agrovia_practice';
	const TAXONOMY  = 'practice_category';

	/**
	 * Hook registration into WordPress init.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_cpt' ) );
		add_action( 'init', array( __CLASS__, 'register_taxonomy' ) );
	}

	/**
	 * Register Custom Post Type.
	 *
	 * @return void
	 */
	public static function register_cpt() {
		$labels = array(
			'name'                  => _x( 'Farm Practices', 'Post type general name', 'agrovia-core' ),
			'singular_name'         => _x( 'Farm Practice', 'Post type singular name', 'agrovia-core' ),
			'menu_name'             => _x( 'Farm Practices', 'Admin Menu text', 'agrovia-core' ),
			'name_admin_bar'        => _x( 'Farm Practice', 'Add New on Toolbar', 'agrovia-core' ),
			'add_new'               => __( 'Add New Practice', 'agrovia-core' ),
			'add_new_item'          => __( 'Add New Farm Practice', 'agrovia-core' ),
			'new_item'              => __( 'New Farm Practice', 'agrovia-core' ),
			'edit_item'             => __( 'Edit Farm Practice', 'agrovia-core' ),
			'view_item'             => __( 'View Farm Practice', 'agrovia-core' ),
			'all_items'             => __( 'All Farm Practices', 'agrovia-core' ),
			'search_items'          => __( 'Search Farm Practices', 'agrovia-core' ),
			'parent_item_colon'     => __( 'Parent Practice:', 'agrovia-core' ),
			'not_found'             => __( 'No farm practices found.', 'agrovia-core' ),
			'not_found_in_trash'    => __( 'No farm practices found in Trash.', 'agrovia-core' ),
			'featured_image'        => _x( 'Practice Cover Image', 'Overrides the “Featured Image” phrase for this post type', 'agrovia-core' ),
			'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type', 'agrovia-core' ),
			'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type', 'agrovia-core' ),
			'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type', 'agrovia-core' ),
			'archives'              => _x( 'Practice Archives', 'The post type archive label used in nav menus', 'agrovia-core' ),
			'filter_items_list'     => _x( 'Filter practices list', 'Screen reader text for the filter links', 'agrovia-core' ),
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Sustainable agriculture practices and regenerative farming methods.', 'agrovia-core' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'practices', 'with_front' => false ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 20,
			'menu_icon'          => 'dashicons-palmtree',
			'show_in_rest'       => true, // Enables Gutenberg block editor.
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'custom-fields' ),
		);

		register_post_type( self::POST_TYPE, $args );
	}

	/**
	 * Register Practice Category Taxonomy.
	 *
	 * @return void
	 */
	public static function register_taxonomy() {
		$labels = array(
			'name'              => _x( 'Practice Categories', 'taxonomy general name', 'agrovia-core' ),
			'singular_name'     => _x( 'Practice Category', 'taxonomy singular name', 'agrovia-core' ),
			'search_items'      => __( 'Search Practice Categories', 'agrovia-core' ),
			'all_items'         => __( 'All Categories', 'agrovia-core' ),
			'parent_item'       => __( 'Parent Category', 'agrovia-core' ),
			'parent_item_colon' => __( 'Parent Category:', 'agrovia-core' ),
			'edit_item'         => __( 'Edit Category', 'agrovia-core' ),
			'update_item'       => __( 'Update Category', 'agrovia-core' ),
			'add_new_item'      => __( 'Add New Category', 'agrovia-core' ),
			'new_item_name'     => __( 'New Category Name', 'agrovia-core' ),
			'menu_name'         => __( 'Categories', 'agrovia-core' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'practice-category' ),
		);

		register_taxonomy( self::TAXONOMY, array( self::POST_TYPE ), $args );
	}
}
