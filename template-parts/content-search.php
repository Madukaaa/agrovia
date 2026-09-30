<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'agrovia-card agrovia-card-search' ); ?>>
	<div class="card-content">
		<header class="entry-header">
			<div class="entry-meta-top">
				<span class="category-badge">
					<?php
					$post_type = get_post_type_object( get_post_type() );
					echo esc_html( $post_type ? $post_type->labels->singular_name : get_post_type() );
					?>
				</span>
				<?php if ( 'post' === get_post_type() ) : ?>
					<span class="reading-time"><?php echo esc_html( agrovia_reading_time() ); ?></span>
				<?php endif; ?>
			</div>

			<?php
			the_title(
				sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
				'</a></h2>'
			);
			?>

			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php agrovia_posted_on(); ?>
				</div>
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<footer class="entry-footer card-footer">
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more-link" aria-label="<?php echo esc_attr( sprintf( __( 'View result: %s', 'agrovia' ), get_the_title() ) ); ?>">
				<?php esc_html_e( 'View Result', 'agrovia' ); ?>
				<span class="arrow" aria-hidden="true">&rarr;</span>
			</a>
		</footer>
	</div><!-- .card-content -->
</article><!-- #post-<?php the_ID(); ?> -->
