<?php
/**
 * Agrovia Custom Template Tags
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'agrovia_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 *
	 * @return void
	 */
	function agrovia_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated screen-reader-text" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Published on %s', 'post date', 'agrovia' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$allowed_tags = array(
			'a'    => array(
				'href' => array(),
				'rel'  => array(),
			),
			'time' => array(
				'class'    => array(),
				'datetime' => array(),
			),
		);

		echo '<span class="posted-on">' . wp_kses( $posted_on, $allowed_tags ) . '</span>';
	}
endif;

if ( ! function_exists( 'agrovia_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 *
	 * @return void
	 */
	function agrovia_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'agrovia' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		$allowed_tags = array(
			'span' => array(
				'class' => array(),
			),
			'a'    => array(
				'class' => array(),
				'href'  => array(),
			),
		);

		echo '<span class="byline"> ' . wp_kses( $byline, $allowed_tags ) . '</span>';
	}
endif;

if ( ! function_exists( 'agrovia_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 *
	 * @return void
	 */
	function agrovia_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'agrovia' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Categorized in %1$s', 'agrovia' ) . '</span>', wp_kses_post( $categories_list ) );
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'agrovia' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'agrovia' ) . '</span>', wp_kses_post( $tags_list ) );
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'agrovia' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

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
	}
endif;

if ( ! function_exists( 'agrovia_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @param string $size Image size.
	 * @return void
	 */
	function agrovia_post_thumbnail( $size = 'agrovia-card' ) {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'agrovia-featured', array( 'class' => 'img-responsive', 'fetchpriority' => 'high' ) ); ?>
			</div>
		<?php else : ?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					$size,
					array(
						'alt'   => the_title_attribute(
							array(
								'echo' => false,
							)
						),
						'class' => 'img-responsive',
					)
				);
				?>
			</a>
			<?php
		endif;
	}
endif;

if ( ! function_exists( 'agrovia_reading_time' ) ) :
	/**
	 * Estimate reading time in minutes.
	 *
	 * @param int|null $post_id Optional post ID.
	 * @return string Formatted reading time string.
	 */
	function agrovia_reading_time( $post_id = null ) {
		$content    = get_post_field( 'post_content', $post_id );
		$word_count = str_word_count( wp_strip_all_tags( $content ) );
		$reading_m  = ceil( $word_count / 200 ); // average 200 wpm
		$reading_m  = max( 1, (int) $reading_m );

		/* translators: %d: number of minutes. */
		return sprintf( _n( '%d min read', '%d min read', $reading_m, 'agrovia' ), $reading_m );
	}
endif;
