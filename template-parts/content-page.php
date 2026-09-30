<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'agrovia-entry-page' ); ?>>
	<?php
	// Check if this page is edited with Elementor. If Elementor is active for this post, let Elementor manage the layout without an unwanted theme title.
	$is_elementor_page = false;
	if ( class_exists( '\Elementor\Plugin' ) ) {
		$document = \Elementor\Plugin::$instance->documents->get( get_the_ID() );
		if ( $document && $document->is_built_with_elementor() ) {
			$is_elementor_page = true;
		}
	}
	?>

	<?php if ( ! $is_elementor_page ) : ?>
		<header class="entry-header page-header agrovia-container">
			<?php the_title( '<h1 class="entry-title page-title">', '</h1>' ); ?>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="entry-thumbnail mt-lg">
					<?php the_post_thumbnail( 'agrovia-featured', array( 'class' => 'img-responsive' ) ); ?>
				</div>
			<?php endif; ?>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<div class="entry-content <?php echo $is_elementor_page ? '' : 'agrovia-container'; ?>">
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

	<?php if ( get_edit_post_link() && ! $is_elementor_page ) : ?>
		<footer class="entry-footer agrovia-container">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'agrovia' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
