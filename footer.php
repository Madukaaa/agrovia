<?php
/**
 * The template for displaying the footer
 *
 * Closes the #content div and renders the footer through Elementor Theme Builder
 * when available, with a modular fallback to template-parts/footer/site.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;
?>
	</div><!-- #content -->

	<?php
	// Check if Elementor Theme Builder renders the footer location.
	if ( function_exists( 'agrovia_elementor_do_location' ) && agrovia_elementor_do_location( 'footer' ) ) {
		// Elementor rendered the footer location.
	} else {
		get_template_part( 'template-parts/footer/site' );
	}
	?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
