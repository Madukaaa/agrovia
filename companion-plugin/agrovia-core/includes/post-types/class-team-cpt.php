<?php
/**
 * Agrovia Team & Farmer Profiles Custom Post Type
 *
 * Models farmers, agronomists, and soil specialists behind the harvest.
 *
 * @package AgroviaCore
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

class Agrovia_Team_CPT {

	const POST_TYPE = 'agrovia_team';
	const TAXONOMY  = 'team_department';

	/**
	 * Hook registration into WordPress init.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_cpt' ) );
		add_action( 'init', array( __CLASS__, 'register_taxonomy' ) );
		add_action( 'add_meta_boxes', array( __CLASS__, 'register_meta_boxes' ) );
		add_action( 'save_post_' . self::POST_TYPE, array( __CLASS__, 'save_meta' ), 10, 2 );
	}

	/**
	 * Register Custom Post Type.
	 *
	 * @return void
	 */
	public static function register_cpt() {
		$labels = array(
			'name'                  => _x( 'Farmers & Team', 'Post type general name', 'agrovia-core' ),
			'singular_name'         => _x( 'Team Member', 'Post type singular name', 'agrovia-core' ),
			'menu_name'             => _x( 'Farmers & Team', 'Admin Menu text', 'agrovia-core' ),
			'name_admin_bar'        => _x( 'Team Member', 'Add New on Toolbar', 'agrovia-core' ),
			'add_new'               => __( 'Add New Member', 'agrovia-core' ),
			'add_new_item'          => __( 'Add New Team Member', 'agrovia-core' ),
			'new_item'              => __( 'New Team Member', 'agrovia-core' ),
			'edit_item'             => __( 'Edit Team Member', 'agrovia-core' ),
			'view_item'             => __( 'View Team Member', 'agrovia-core' ),
			'all_items'             => __( 'All Team Members', 'agrovia-core' ),
			'search_items'          => __( 'Search Team Members', 'agrovia-core' ),
			'not_found'             => __( 'No team members found.', 'agrovia-core' ),
			'not_found_in_trash'    => __( 'No team members found in Trash.', 'agrovia-core' ),
			'featured_image'        => _x( 'Member Portrait', 'Overrides the “Featured Image” phrase for this post type', 'agrovia-core' ),
			'set_featured_image'    => _x( 'Set portrait image', 'Overrides the “Set featured image” phrase for this post type', 'agrovia-core' ),
			'remove_featured_image' => _x( 'Remove portrait image', 'Overrides the “Remove featured image” phrase for this post type', 'agrovia-core' ),
			'use_featured_image'    => _x( 'Use as portrait image', 'Overrides the “Use as featured image” phrase for this post type', 'agrovia-core' ),
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Farmer profiles, agronomists, and agricultural specialists.', 'agrovia-core' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'team', 'with_front' => false ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 21,
			'menu_icon'          => 'dashicons-groups',
			'show_in_rest'       => true,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		);

		register_post_type( self::POST_TYPE, $args );
	}

	/**
	 * Register Team Department Taxonomy.
	 *
	 * @return void
	 */
	public static function register_taxonomy() {
		$labels = array(
			'name'              => _x( 'Departments', 'taxonomy general name', 'agrovia-core' ),
			'singular_name'     => _x( 'Department', 'taxonomy singular name', 'agrovia-core' ),
			'search_items'      => __( 'Search Departments', 'agrovia-core' ),
			'all_items'         => __( 'All Departments', 'agrovia-core' ),
			'parent_item'       => __( 'Parent Department', 'agrovia-core' ),
			'parent_item_colon' => __( 'Parent Department:', 'agrovia-core' ),
			'edit_item'         => __( 'Edit Department', 'agrovia-core' ),
			'update_item'       => __( 'Update Department', 'agrovia-core' ),
			'add_new_item'      => __( 'Add New Department', 'agrovia-core' ),
			'new_item_name'     => __( 'New Department Name', 'agrovia-core' ),
			'menu_name'         => __( 'Departments', 'agrovia-core' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'department' ),
		);

		register_taxonomy( self::TAXONOMY, array( self::POST_TYPE ), $args );
	}

	/**
	 * Register meta box for farmer role/designation.
	 *
	 * @return void
	 */
	public static function register_meta_boxes() {
		add_meta_box(
			'agrovia_team_details',
			esc_html__( 'Member Details & Role', 'agrovia-core' ),
			array( __CLASS__, 'render_meta_box' ),
			self::POST_TYPE,
			'side',
			'default'
		);
	}

	/**
	 * Render role meta box.
	 *
	 * @param \WP_Post $post Current post object.
	 * @return void
	 */
	public static function render_meta_box( $post ) {
		wp_nonce_field( 'agrovia_team_meta_save', 'agrovia_team_nonce' );
		$role = get_post_meta( $post->ID, '_agrovia_member_role', true );
		?>
		<p>
			<label for="agrovia_member_role"><strong><?php esc_html_e( 'Role / Title:', 'agrovia-core' ); ?></strong></label>
			<input type="text" id="agrovia_member_role" name="agrovia_member_role" value="<?php echo esc_attr( $role ); ?>" class="widefat" placeholder="<?php esc_attr_e( 'e.g. Lead Crop Manager', 'agrovia-core' ); ?>" />
		</p>
		<?php
	}

	/**
	 * Save role meta securely.
	 *
	 * @param int      $post_id Post ID.
	 * @param \WP_Post $post    Post object.
	 * @return void
	 */
	public static function save_meta( $post_id, $post ) {
		if ( ! isset( $_POST['agrovia_team_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['agrovia_team_nonce'] ), 'agrovia_team_meta_save' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( isset( $_POST['agrovia_member_role'] ) ) {
			update_post_meta( $post_id, '_agrovia_member_role', sanitize_text_field( wp_unslash( $_POST['agrovia_member_role'] ) ) );
		}
	}
}

