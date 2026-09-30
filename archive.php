<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

get_header();

// Check if Elementor Theme Builder renders the archive location.
if ( function_exists( 'agrovia_elementor_do_location' ) && agrovia_elementor_do_location( 'archive' ) ) {
	get_footer();
	return;
}
?>

<main id="primary" class="site-main site-main-archive">
	<div class="agrovia-container">
		<?php if ( have_posts() ) : ?>

			<header class="page-header archive-header text-center mb-2xl">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description lead text-muted mt-sm">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="posts-grid">
				<?php
				while ( have_posts() ) :
					the_post();
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
