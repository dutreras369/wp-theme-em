<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blog-theme
 */

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

	<?php if (have_comments()) : ?>
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			if ('1' === $comment_count) {
				printf(
					esc_html__('One comment on &ldquo;%s&rdquo;', 'tiendavirtual'),
					get_the_title()
				);
			} else {
				printf(
					esc_html(_nx('%1$s comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'tiendavirtual')),
					number_format_i18n($comment_count),
					get_the_title()
				);
			}
			?>
		</h2>

		<ul class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ul',
					'short_ping' => true,
					'avatar_size' => 60,
				)
			);
			?>
		</ul>

		<?php
		the_comments_navigation();

		if (! comments_open()) :
		?>
			<p class="no-comments"><?php esc_html_e('Comments are closed.', 'tiendavirtual'); ?></p>
	<?php
		endif;

	endif; // Check for have_comments().

	comment_form();
	?>

</div><!-- #comments -->