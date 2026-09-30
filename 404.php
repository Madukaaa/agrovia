<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#404-never-found
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main site-main-404 text-center">
	<div class="agrovia-container">
		<section class="error-404 not-found">
			<span class="category-badge"><?php esc_html_e( '404 Error', 'agrovia' ); ?></span>
			<h1 class="page-title mt-sm"><?php esc_html_e( 'Page Not Found in the Field', 'agrovia' ); ?></h1>
			<p class="lead text-muted mt-md max-w-prose mx-auto">
				<?php esc_html_e( 'The page you requested may have been relocated, harvested, or does not exist in our farm records. Try searching below or return to the home page.', 'agrovia' ); ?>
			</p>

			<div class="error-search-box mt-2xl mx-auto" style="max-width: 480px; margin-left: auto; margin-right: auto;">
				<?php get_search_form(); ?>
			</div>

			<div class="error-actions mt-2xl">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn">
					<?php esc_html_e( 'Return to Home', 'agrovia' ); ?>
				</a>
			</div>
		</section><!-- .error-404 -->
	</div><!-- .agrovia-container -->
</main><!-- #primary -->

<?php
get_footer();
