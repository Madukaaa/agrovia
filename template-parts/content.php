<?php
/**
 * Template part for displaying posts in index/archive listings
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'agrovia-card agrovia-card-post' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="card-media">
			<?php agrovia_post_thumbnail( 'agrovia-card' ); ?>
		</div>
	<?php endif; ?>

	<div class="card-content">
		<header class="entry-header">
			<div class="entry-meta-top">
				<?php
				$categories = get_the_category();
				if ( ! empty( $categories ) ) :
					?>
					<span class="category-badge">
						<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>">
							<?php echo esc_html( $categories[0]->name ); ?>
						</a>
					</span>
				<?php endif; ?>
				<span class="reading-time"><?php echo esc_html( agrovia_reading_time() ); ?></span>
			</div>

			<?php
			the_title(
				sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
				'</a></h2>'
			);
			?>

			<div class="entry-meta">
				<?php agrovia_posted_on(); ?>
				<?php agrovia_posted_by(); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<footer class="entry-footer card-footer">
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more-link" aria-label="<?php echo esc_attr( sprintf( __( 'Read more about %s', 'agrovia' ), get_the_title() ) ); ?>">
				<?php esc_html_e( 'Read Article', 'agrovia' ); ?>
				<span class="arrow" aria-hidden="true">&rarr;</span>
			</a>
		</footer><!-- .entry-footer -->
	</div><!-- .card-content -->
</article><!-- #post-<?php the_ID(); ?> -->
