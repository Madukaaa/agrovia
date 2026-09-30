<?php
/**
 * Template part for displaying single post content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'agrovia-entry-single' ); ?>>
	<header class="entry-header single-entry-header text-center">
		<div class="entry-categories">
			<?php
			$categories = get_the_category();
			if ( ! empty( $categories ) ) :
				foreach ( $categories as $cat ) :
					?>
					<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="category-badge">
						<?php echo esc_html( $cat->name ); ?>
					</a>
					<?php
				endforeach;
			endif;
			?>
		</div>

		<?php the_title( '<h1 class="entry-title single-title mt-md">', '</h1>' ); ?>

		<div class="entry-meta single-meta mt-md">
			<div class="author-meta-block">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 48, '', '', array( 'class' => 'author-avatar-img' ) ); ?>
				<div class="author-meta-text">
					<span class="author-name"><?php echo esc_html( get_the_author() ); ?></span>
					<div class="post-date-reading">
						<?php agrovia_posted_on(); ?>
						<span class="meta-sep">&bull;</span>
						<span class="reading-time"><?php echo esc_html( agrovia_reading_time() ); ?></span>
					</div>
				</div>
			</div>
		</div><!-- .entry-meta -->

		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="entry-featured-media mt-2xl">
				<?php the_post_thumbnail( 'agrovia-featured', array( 'class' => 'img-responsive' ) ); ?>
				<?php if ( get_the_post_thumbnail_caption() ) : ?>
					<figcaption class="wp-caption-text"><?php the_post_thumbnail_caption(); ?></figcaption>
				<?php endif; ?>
			</figure>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content single-content mt-2xl">
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

	<footer class="entry-footer single-footer mt-3xl">
		<?php
		$tags_list = get_the_tag_list( '<div class="post-tags"><span class="tags-title">' . esc_html__( 'Tags:', 'agrovia' ) . '</span> ', ' ', '</div>' );
		if ( $tags_list ) {
			echo wp_kses_post( $tags_list );
		}
		?>

		<div class="author-bio-card mt-2xl">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', '', array( 'class' => 'bio-avatar' ) ); ?>
			<div class="bio-content">
				<h3 class="bio-name"><?php echo esc_html( get_the_author() ); ?></h3>
				<p class="bio-desc">
					<?php
					$bio = get_the_author_meta( 'description' );
					if ( $bio ) {
						echo esc_html( $bio );
					} else {
						esc_html_e( 'Contributor to the Agrovia regenerative farming journal, documenting sustainable agricultural methods and ecosystem restoration.', 'agrovia' );
					}
					?>
				</p>
			</div>
		</div><!-- .author-bio-card -->
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
