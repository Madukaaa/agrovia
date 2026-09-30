<?php
/**
 * Agrovia Core Elementor Manager
 *
 * Handles Elementor widget category registration, widget discovery, and asset hooks.
 *
 * @package AgroviaCore
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

class Agrovia_Core_Elementor_Manager {

	/**
	 * Single instance.
	 *
	 * @var Agrovia_Core_Elementor_Manager|null
	 */
	private static $instance = null;

	/**
	 * Get Singleton instance.
	 *
	 * @return Agrovia_Core_Elementor_Manager
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
		add_action( 'elementor/elements/categories_registered', array( $this, 'register_widget_category' ) );
		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
		add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'enqueue_frontend_styles' ) );
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'enqueue_frontend_styles' ) );
	}

	/**
	 * Register custom Elementor widget category.
	 *
	 * @param \Elementor\Elements_Manager $elements_manager Elements manager.
	 * @return void
	 */
	public function register_widget_category( $elements_manager ) {
		$elements_manager->add_category(
			'agrovia-elements',
			array(
				'title' => esc_html__( 'Agrovia Elements', 'agrovia-core' ),
				'icon'  => 'fa fa-leaf',
			)
		);
	}

	/**
	 * Register custom Elementor widgets.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Widgets manager instance.
	 * @return void
	 */
	public function register_widgets( $widgets_manager ) {
		// Include widget class definitions.
		require_once AGROVIA_CORE_DIR . 'widgets/class-hero-widget.php';
		require_once AGROVIA_CORE_DIR . 'widgets/class-stats-widget.php';
		require_once AGROVIA_CORE_DIR . 'widgets/class-approach-cards-widget.php';
		require_once AGROVIA_CORE_DIR . 'widgets/class-process-timeline-widget.php';
		require_once AGROVIA_CORE_DIR . 'widgets/class-produce-grid-widget.php';
		require_once AGROVIA_CORE_DIR . 'widgets/class-team-widget.php';

		$widgets = array(
			'Agrovia_Hero_Widget',
			'Agrovia_Stats_Widget',
			'Agrovia_Approach_Cards_Widget',
			'Agrovia_Process_Timeline_Widget',
			'Agrovia_Produce_Grid_Widget',
			'Agrovia_Team_Widget',
		);

		foreach ( $widgets as $widget_class ) {
			if ( class_exists( $widget_class ) ) {
				if ( method_exists( $widgets_manager, 'register' ) ) {
					$widgets_manager->register( new $widget_class() );
				} elseif ( method_exists( $widgets_manager, 'register_widget_type' ) ) {
					$widgets_manager->register_widget_type( new $widget_class() );
				}
			}
		}

		do_action( 'agrovia_core/widgets_registered', $widgets_manager );
	}

	/**
	 * Enqueue front-end styles for companion widgets.
	 *
	 * @return void
	 */
	public function enqueue_frontend_styles() {
		if ( file_exists( AGROVIA_CORE_DIR . 'assets/css/widgets.css' ) ) {
			wp_enqueue_style(
				'agrovia-core-widgets',
				AGROVIA_CORE_URL . 'assets/css/widgets.css',
				array(),
				AGROVIA_CORE_VERSION
			);
		}
	}
}
