<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

get_header();

// Check if Elementor Theme Builder renders the single location.
if ( function_exists( 'agrovia_elementor_do_location' ) && agrovia_elementor_do_location( 'single' ) ) {
	get_footer();
	return;
}
?>

<main id="primary" class="site-main site-main-single">
	<div class="agrovia-container single-container">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'single' );

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( '&larr; Previous Story', 'agrovia' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Story &rarr;', 'agrovia' ) . '</span> <span class="nav-title">%title</span>',
					'class'     => 'agrovia-post-navigation mt-3xl',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				?>
				<div class="comments-section mt-3xl">
					<?php comments_template(); ?>
				</div>
				<?php
			endif;

		endwhile; // End of the loop.
		?>
	</div><!-- .agrovia-container -->
</main><!-- #primary -->

<?php
get_footer();
