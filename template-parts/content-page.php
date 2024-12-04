<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blog-theme
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="bg-white">
	<header class="entry-header my-4">
		<?php 
			if(!is_front_page()){
				the_title( '<h1 class="entry-title h1_tsn text-center tex-gold">', '</h1>' );
			}
		?>
	</header><!-- .entry-header -->

	<?php if (has_post_thumbnail()) { ?>
		<div class="text-center p-5">
			<?php the_post_thumbnail('full', array('class' => 'img-ajust')); ?>	
		</div>
	<?php } ?>

	<div class="entry-content text-justify">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tiendavirtual' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'tiendavirtual' ),
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
