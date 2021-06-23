<?php

/**
 * Single post partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
$persentase = number_format(((int)get_donation('total', $post->ID) ?? 0 / (int)get_field('donation_goals') ?? 0 * 100), 2, '.', '');
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
			<h6><?php echo $persentase; ?>%</h6>
		</div>
		<div class="progress">
			<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persentase; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persentase; ?>%;"></div>
		</div>
		<div class="progress-wrap-nominal">
			<div class="float-left">
				<h6>Raised:</h6> <span>Rp. <?php echo number_format(get_donation('total', $post->ID) ?? 0, 0, ',', '.'); ?></span>
			</div>
			<div class="float-right">
				<h6>Goal:</h6> <span>Rp. <?php echo number_format(get_field('donation_goals') ?? 0, 0, ',', '.'); ?></span>
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
			<div class="modal-body">
				<div class="wrap-close-btn">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="wrap-donation-content">
					<form action="/pembayaran/" method="post">
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div class="input-group-text">IDR</div>
							</div>
							<input type="number" class="form-control" name="nominal" id="nominal">
						</div>
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label for="first_name">First name</label>
								<input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name" value="" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="last_name">Last name</label>
								<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name" value="" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-12 mb-3">
								<label for="email">Email Address</label>
								<input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-12 mb-3">
								<select class="form-control" name="va_banks" id="va_banks">

									<?php
									$getVABanks = \Xendit\VirtualAccounts::getVABanks();
									foreach ($getVABanks as $va) : ?>
										<option value="<?php echo $va['code']; ?>"><?php echo $va['name']; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="wrap-donate-btn">
							<button type="submit" class="btn btn-primary">Donate Now</button>
							<input type="hidden" name="post_id" value="<?php echo $post->ID; ?>">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>