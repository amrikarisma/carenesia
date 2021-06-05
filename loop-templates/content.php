<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$container = get_theme_mod( 'understrap_container_type' );

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="wrap-image-blog-list">
			<a href="<?php  _e( get_permalink() ) ?>" rel="bookmark">'
				<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
			</a>
		</div>

		<header class="entry-header">

			<?php
			the_title(
				sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
				'</a></h3>'
			);
			?>

			<?php if ( 'post' === get_post_type() ) : ?>

				<div class="entry-meta">
					<?php understrap_posted_on(); ?>
				</div><!-- .entry-meta -->

			<?php endif; ?>

		</header><!-- .entry-header -->


		<div class="entry-content">

			<?php the_excerpt(); ?>

			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
					'after'  => '</div>',
				)
			);
			?>

		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<div class="wrap-entry-meta-footer">
					<?php echo get_the_tag_list('<div class="wrap-taglist">',', ','</div>'); ?>
					<?php

						get_template_part( 'loop-templates/meta', 'share' );

					?>
			</div>

		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->
