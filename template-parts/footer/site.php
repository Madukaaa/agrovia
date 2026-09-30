<?php
/**
 * Template part for displaying the default site footer fallback
 *
 * Used when Elementor Theme Builder is not active or has not assigned a footer template.
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;
?>

<footer id="colophon" class="site-footer">
	<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
		<div class="footer-widgets agrovia-container">
			<?php dynamic_sidebar( 'footer-1' ); ?>
		</div>
	<?php endif; ?>

	<div class="site-footer-bottom agrovia-container">
		<div class="site-info">
			<p class="copyright-text">
				&copy; <?php echo esc_html( date_i18n( _x( 'Y', 'copyright date format', 'agrovia' ) ) ); ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>.
				<span class="copyright-custom-text"><?php echo esc_html( get_theme_mod( 'agrovia_footer_copyright', __( 'Growing food. Restoring nature.', 'agrovia' ) ) ); ?></span>
			</p>
		</div><!-- .site-info -->

		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'agrovia' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'menu_class'     => 'footer-menu',
						'depth'          => 1,
						'container'      => false,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>
		<?php endif; ?>
	</div><!-- .site-footer-bottom -->
</footer><!-- #colophon -->
