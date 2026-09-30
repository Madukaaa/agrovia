<?php
/**
 * Plugin Name: Agrovia Core
 * Plugin URI: https://agrovia.local
 * Description: Essential companion functionality for the Agrovia Sustainable Agriculture WordPress Theme. Registers agricultural post types (Farm Practices, Team) and provides custom Elementor widgets.
 * Version: 1.0.0
 * Author: Maduka Karunathilake
 * Author URI: https://agrovia.local
 * Text Domain: agrovia-core
 * Domain Path: /languages
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package AgroviaCore
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

/**
 * Define Plugin Constants.
 */
define( 'AGROVIA_CORE_VERSION', '1.0.0' );
define( 'AGROVIA_CORE_FILE', __FILE__ );
define( 'AGROVIA_CORE_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'AGROVIA_CORE_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );

/**
 * Require Plugin Architecture Classes.
 */
require_once AGROVIA_CORE_DIR . 'includes/class-compatibility.php';
require_once AGROVIA_CORE_DIR . 'includes/class-plugin.php';

/**
 * Plugin Activation Callback.
 * Flushes rewrite rules cleanly when the plugin is activated.
 *
 * @return void
 */
function agrovia_core_activate() {
	// Require CPTs to ensure they are registered prior to rewrite flush.
	require_once AGROVIA_CORE_DIR . 'includes/post-types/class-farm-practice-cpt.php';
	require_once AGROVIA_CORE_DIR . 'includes/post-types/class-team-cpt.php';

	Agrovia_Farm_Practice_CPT::register_cpt();
	Agrovia_Team_CPT::register_cpt();

	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'agrovia_core_activate' );

/**
 * Plugin Deactivation Callback.
 *
 * @return void
 */
function agrovia_core_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'agrovia_core_deactivate' );

/**
 * Launch Agrovia Core.
 *
 * @return Agrovia_Core
 */
function agrovia_core() {
	return Agrovia_Core::instance();
}

// Bootstrap plugin instance.
agrovia_core();
