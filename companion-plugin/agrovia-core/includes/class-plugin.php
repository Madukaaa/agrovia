<?php
/**
 * Agrovia Core Main Plugin Class
 *
 * Coordinates CPTs, taxonomies, translations, and Elementor integration.
 *
 * @package AgroviaCore
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

class Agrovia_Core {

	/**
	 * Single instance.
	 *
	 * @var Agrovia_Core|null
	 */
	private static $instance = null;

	/**
	 * Get Singleton instance.
	 *
	 * @return Agrovia_Core
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->load_dependencies();
		$this->init_hooks();
	}

	/**
	 * Load required class files.
	 *
	 * @return void
	 */
	private function load_dependencies() {
		require_once AGROVIA_CORE_DIR . 'includes/post-types/class-farm-practice-cpt.php';
		require_once AGROVIA_CORE_DIR . 'includes/post-types/class-team-cpt.php';
		require_once AGROVIA_CORE_DIR . 'includes/class-elementor-manager.php';
	}

	/**
	 * Register actions and filters.
	 *
	 * @return void
	 */
	private function init_hooks() {
		add_action( 'plugins_loaded', array( $this, 'on_plugins_loaded' ) );
		add_action( 'init', array( $this, 'load_textdomain' ) );

		// Initialize Custom Post Types.
		Agrovia_Farm_Practice_CPT::init();
		Agrovia_Team_CPT::init();
	}

	/**
	 * Plugin localization.
	 *
	 * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain(
			'agrovia-core',
			false,
			dirname( plugin_basename( AGROVIA_CORE_FILE ) ) . '/languages/'
		);
	}

	/**
	 * Callback for plugins_loaded hook.
	 *
	 * @return void
	 */
	public function on_plugins_loaded() {
		if ( ! Agrovia_Core_Compatibility::check_requirements() ) {
			return;
		}

		// Initialize Elementor integration if Elementor is loaded.
		if ( Agrovia_Core_Compatibility::is_elementor_active() ) {
			Agrovia_Core_Elementor_Manager::instance();
		}
	}
}
