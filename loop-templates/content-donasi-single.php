<?php

/**
 * Single post partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
if ((int)get_donation('total', $post->ID)) {
	$persentase = number_format((((int)get_donation('total', $post->ID) ?? 0) / ((int)get_field('donation_goals') ?? 0) * 100), 2, '.', '');
} else {
	$persentase = 0;
}
?>


<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="wrap-featured-iamge">
		<?php echo get_the_post_thumbnail($post->ID, 'large'); ?>
		<div class="wrap-donation-btn">
			<button class="btn btn-primary" data-toggle="modal" data-target="#modalDonation">Donasi</button>
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
					<form action="<?php echo site_url('/pembayaran/'); ?>" method="post" id="payment-form">
						<div class="row">
							<div class="col-md-12" id="section_form_donatur">
								<div class="form-row">
									<div class="col-md-12 mb-3">
										<label for="nominal">Jumlah Nominal</label>
										<input type="number" class="form-control" name="nominal" id="nominal" required>
										<div class="valid-feedback">
											Looks good!
										</div>
									</div>
									<div class="col-md-6 mb-3">
										<label for="first_name">Nama Depan</label>
										<input type="text" class="form-control" name="first_name" id="first_name" placeholder="Nama Depan" value="" required>
										<div class="valid-feedback">
											Looks good!
										</div>
									</div>
									<div class="col-md-6 mb-3">
										<label for="last_name">Nama Belakang</label>
										<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Nama Belakang" value="" required>
										<div class="valid-feedback">
											Looks good!
										</div>
									</div>
									<div class="col-md-12 mb-3">
										<label for="email">Email</label>
										<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="" required>
										<div class="valid-feedback">
											Looks good!
										</div>
									</div>
									<div class="col-md-12 mb-3">
										<label for="payment_method">Metode Pembayaran</label>
										<select class="form-control" name="payment_method" id="payment_method">
											<option value="">Pilih Metode Pembayaran</option>
											<option value="credit_card">Kartu Kredit</option>
											<option value="bank">Transfer Bank</option>
										</select>
									</div>
									<div class="col-md-12 mb-3" id="wrap_va_banks" style="display: none;">
										<label for="va_banks">Daftar Bank</label>
										<select class="form-control" name="va_banks" id="va_banks">
											<?php
											$getVABanks = \Xendit\VirtualAccounts::getVABanks();
											foreach ($getVABanks as $va) : ?>
												<option value="<?php echo $va['code']; ?>"><?php echo $va['name']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6" id="credit_card_form" style="display: none;">
								<div class="card">
									<div class="card-header">
										<div class="row">
											<div class="col-md-6"> <span>CREDIT/DEBIT CARD PAYMENT</span> </div>
											<div class="col-md-6 text-right" style="margin-top: -5px;"> <img src="https://img.icons8.com/color/36/000000/visa.png"> <img src="https://img.icons8.com/color/36/000000/mastercard.png"> <img src="https://img.icons8.com/color/36/000000/amex.png"> </div>
										</div>
									</div>
									<div class="card-body" style="height: 350px">
										<div class="form-group">
											<label for="cc-number" class="control-label">CARD NUMBER</label>
											<input id="cc-number" type="tel" class="input-lg form-control cc-number" autocomplete="cc-number" placeholder="•••• •••• •••• ••••">
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="cc-exp" class="control-label">CARD EXPIRY</label>
													<input id="cc-exp" type="tel" class="input-lg form-control cc-exp" autocomplete="cc-exp" placeholder="•• / ••">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="cc-cvc" class="control-label">CARD CVC</label>
													<input id="cc-cvc" type="tel" class="input-lg form-control cc-cvc" name="cc-cvc" autocomplete="off" placeholder="••••">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="numeric" class="control-label">CARD HOLDER NAME</label>
											<input type="text" class="input-lg form-control">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="wrap-donate-btn">
							<button type="submit" class="btn btn-primary submit">Donasi Sekarang</button>
							<input type="hidden" name="post_id" value="<?php echo $post->ID; ?>">
							<input type="hidden" name="token_id" value="">
							<input type="hidden" name="authentication_id" value="">
						</div>
					</form>
					<div id="error" style="display: none;">
						<pre></pre>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>