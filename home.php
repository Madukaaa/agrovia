<?php
/**
 * The home template file (Blog / Journal Index)
 *
 * Used for the posts page when a static front page is designated in Settings > Reading.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#home-page-display
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main site-main-journal">
	<div class="agrovia-container">
		<header class="page-header journal-header text-center">
			<span class="category-badge"><?php esc_html_e( 'Agrovia Journal', 'agrovia' ); ?></span>
			<h1 class="page-title mt-sm"><?php single_post_title(); ?></h1>
			<p class="lead text-muted"><?php esc_html_e( 'Field updates, soil science, regenerative practices, and stories from our harvest.', 'agrovia' ); ?></p>
		</header>

		<?php
		if ( have_posts() ) :
			?>
			<div class="posts-grid mt-2xl">
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
