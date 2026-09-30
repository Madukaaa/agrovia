<?php
/**
 * Agrovia WooCommerce Compatibility and Layout Hooks
 *
 * Implements upgrade-safe hooks, custom container wrappers, gallery features,
 * and AJAX mini-cart fragments without introducing fragile template overrides.
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

/**
 * WooCommerce setup function.
 *
 * @return void
 */
function agrovia_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 480,
			'single_image_width'    => 800,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'max_rows'        => 8,
				'default_columns' => 3,
				'min_columns'     => 1,
				'max_columns'     => 4,
			),
		)
	);

	// Gallery features for single product.
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'agrovia_woocommerce_setup' );

/**
 * Check if WooCommerce is active.
 *
 * @return bool
 */
function agrovia_is_woocommerce_active() {
	return class_exists( 'WooCommerce' );
}

/**
 * Remove default WooCommerce wrapper markup and replace with Agrovia semantic containers.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

/**
 * Before Content Wrapper for WooCommerce.
 *
 * @return void
 */
function agrovia_woocommerce_wrapper_before() {
	?>
	<main id="primary" class="site-main site-main-woocommerce">
		<div class="agrovia-container">
	<?php
}
add_action( 'woocommerce_before_main_content', 'agrovia_woocommerce_wrapper_before' );

/**
 * After Content Wrapper for WooCommerce.
 *
 * @return void
 */
function agrovia_woocommerce_wrapper_after() {
	?>
		</div><!-- .agrovia-container -->
	</main><!-- #primary -->
	<?php
}
add_action( 'woocommerce_after_main_content', 'agrovia_woocommerce_wrapper_after' );

/**
 * Customize the number of products displayed per page in the shop.
 *
 * @param int $cols Number of products.
 * @return int
 */
function agrovia_woocommerce_products_per_page( $cols ) {
	return 9;
}
add_filter( 'loop_shop_per_page', 'agrovia_woocommerce_products_per_page', 20 );

/**
 * Set the default number of product columns in the shop.
 *
 * @return int
 */
function agrovia_woocommerce_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'agrovia_woocommerce_loop_columns' );

/**
 * Customize related products count and columns.
 *
 * @param array $args Related products arguments.
 * @return array
 */
function agrovia_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);
	return wp_parse_args( $defaults, $args );
}
add_filter( 'woocommerce_output_related_products_args', 'agrovia_woocommerce_related_products_args' );

/**
 * Update cart link with AJAX fragments when items are added to cart.
 *
 * @param array $fragments Fragments to refresh via AJAX.
 * @return array
 */
function agrovia_woocommerce_cart_link_fragment( $fragments ) {
	ob_start();
	agrovia_woocommerce_cart_link();
	$fragments['a.cart-contents'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'agrovia_woocommerce_cart_link_fragment' );

/**
 * Render the cart link showing count and total.
 *
 * @return void
 */
function agrovia_woocommerce_cart_link() {
	if ( ! agrovia_is_woocommerce_active() ) {
		return;
	}

	$count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
	?>
	<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'agrovia' ); ?>" aria-label="<?php esc_attr_e( 'View your shopping cart', 'agrovia' ); ?>">
		<span class="cart-icon" aria-hidden="true">&#128722;</span>
		<span class="count-badge"><?php echo esc_html( $count ); ?></span>
		<span class="screen-reader-text"><?php esc_html_e( 'items in cart', 'agrovia' ); ?></span>
	</a>
	<?php
}
