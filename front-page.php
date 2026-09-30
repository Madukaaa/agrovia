<?php
/**
 * The front page template file
 *
 * Displays the static front page or the front page blog stream according
 * to the WordPress Reading settings. Fully supports Elementor canvas & containers.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#front-page-display
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main site-main-front">
	<?php
	// If a static page is designated as the front page.
	if ( 'page' === get_option( 'show_on_front' ) ) :

		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'front-page-article' ); ?>>
				<div class="entry-content">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'agrovia' ),
							'after'  => '</div>',
						)
					);
					?>
				</div><!-- .entry-content -->
			</article>
			<?php
		endwhile;

	else :
		// Fallback when "Your latest posts" is chosen for the front page.
		?>
		<div class="agrovia-container">
			<header class="page-header front-page-header text-center">
				<span class="category-badge"><?php esc_html_e( 'Sustainable Agriculture', 'agrovia' ); ?></span>
				<h1 class="page-title mt-sm"><?php bloginfo( 'name' ); ?></h1>
				<p class="lead text-muted"><?php bloginfo( 'description' ); ?></p>
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
		<?php
	endif;
	?>
</main><!-- #primary -->

<?php
get_footer();
