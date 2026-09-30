<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main">
	<div class="agrovia-container site-main-inner">
		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header class="page-header journal-header">
				<h1 class="page-title"><?php single_post_title(); ?></h1>
				<p class="page-subtitle"><?php esc_html_e( 'Journal, stories, and scientific insights from our regenerative farm.', 'agrovia' ); ?></p>
			</header>
		<?php endif; ?>

		<?php
		if ( have_posts() ) :
			?>
			<div class="posts-grid">
				<?php
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;
				?>
			</div><!-- .posts-grid -->

			<?php
			get_template_part( 'template-parts/pagination' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
	</div><!-- .agrovia-container -->
</main><!-- #primary -->

<?php
get_footer();
