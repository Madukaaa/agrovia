<?php
/**
 * Template part for displaying the default site header fallback
 *
 * Used when Elementor Theme Builder is not active or has not assigned a header template.
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;
?>

<header id="masthead" class="site-header">
	<div class="site-header-inner agrovia-container">
		<div class="site-branding">
			<?php
			if ( has_custom_logo() ) :
				the_custom_logo();
			else :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
				$agrovia_description = get_bloginfo( 'description', 'display' );
				if ( $agrovia_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo esc_html( $agrovia_description ); ?></p>
					<?php
				endif;
			endif;
			?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'agrovia' ); ?>">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation menu', 'agrovia' ); ?>">
				<span class="menu-toggle-icon" aria-hidden="true"></span>
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'agrovia' ); ?></span>
			</button>

			<div class="menu-drawer-wrapper">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'primary-menu nav-menu',
						'container'      => false,
						'fallback_cb'    => 'agrovia_default_menu',
						'walker'         => class_exists( 'Agrovia_Nav_Walker' ) ? new Agrovia_Nav_Walker() : null,
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					)
				);
				?>
			</div><!-- .menu-drawer-wrapper -->
		</nav><!-- #site-navigation -->

		<?php
		$cta_enable = get_theme_mod( 'agrovia_header_cta_enable', true );
		$cta_text   = get_theme_mod( 'agrovia_header_cta_text', __( 'Contact', 'agrovia' ) );
		$cta_url    = get_theme_mod( 'agrovia_header_cta_url', '#contact' );

		if ( $cta_enable && ! empty( $cta_text ) ) :
			?>
			<div class="header-actions">
				<a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn-header-cta">
					<?php echo esc_html( $cta_text ); ?>
					<span class="cta-arrow" aria-hidden="true">&rarr;</span>
				</a>
			</div>
		<?php endif; ?>

		<div class="menu-backdrop" aria-hidden="true"></div>
	</div><!-- .site-header-inner -->
</header><!-- #masthead -->
