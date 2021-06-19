<?php

/**
 * Single post partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>


<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="wrap-featured-iamge">
		<?php echo get_the_post_thumbnail($post->ID, 'large'); ?>
		<div class="wrap-donation-btn">
			<button class="btn btn-primary" data-toggle="modal" data-target="#modalDonation">Donate</button>
		</div>
	</div>
	<div class="wrapper-progress">
		<div class="progress-persentase">
			<h6>100%</h6>
		</div>
		<div class="progress">
			<div class="progress-bar w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
		<div class="progress-wrap-nominal">
			<div class="float-left">
				<h6>Raised:</h6> <span>$1 billion</span>
			</div>
			<div class="float-right">
				<h6>Goal:</h6> <span>$1,000</span>
			</div>
		</div>
	</div>
	<header class="entry-header">

		<?php the_title('<h3 class="entry-title">', '</h3>'); ?>

		<div class="entry-meta">

			<?php //understrap_posted_on(); 
			?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->
	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __('Pages:', 'understrap'),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->

<!-- Modal -->
<div class="modal-donation modal fade" id="modalDonation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>