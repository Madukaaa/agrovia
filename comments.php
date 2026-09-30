<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Agrovia
 * @since 1.0.0
 */

// Prevent direct script access.
defined( 'ABSPATH' ) || exit;

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$agrovia_comment_count = get_comments_number();
			if ( '1' === $agrovia_comment_count ) {
				printf(
					/* translators: 1: title. */
					wp_kses_post( __( 'One response on &ldquo;%1$s&rdquo;', 'agrovia' ) ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: comment count number, 2: title. */
					wp_kses_post( _nx( '%1$s response on &ldquo;%2$s&rdquo;', '%1$s responses on &ldquo;%2$s&rdquo;', $agrovia_comment_count, 'comments title', 'agrovia' ) ),
					esc_html( number_format_i18n( $agrovia_comment_count ) ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size'=> 56,
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'agrovia' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form(
		array(
			'class_submit'  => 'btn',
			'title_reply'   => esc_html__( 'Join the Conversation', 'agrovia' ),
			'title_reply_to'=> esc_html__( 'Leave a Reply to %s', 'agrovia' ),
		)
	);
	?>

</div><!-- #comments -->
