<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main site-main-search">
	<div class="agrovia-container">
		<?php if ( have_posts() ) : ?>

			<header class="page-header search-header text-center mb-2xl">
				<span class="category-badge"><?php esc_html_e( 'Search Results', 'agrovia' ); ?></span>
				<h1 class="page-title mt-sm">
					<?php
					printf(
						/* translators: %s: search query. */
						esc_html__( 'Results for: “%s”', 'agrovia' ),
						esc_html( get_search_query() )
					);
					?>
				</h1>
			</header><!-- .page-header -->

			<div class="posts-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'search' );
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
