<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$container = get_theme_mod('understrap_container_type');
?>

<footer>

	<?php get_template_part('sidebar-templates/sidebar', 'footerfull'); ?>

	<div class="wrapper" id="wrapper-footer">

		<div class="<?php echo esc_attr($container); ?>">

			<div class="row">

				<div class="col-md-12">

					<footer class="site-footer" id="colophon">

						<div class="site-info">

							<?php understrap_site_info(); ?>

						</div><!-- .site-info -->

					</footer><!-- #colophon -->

				</div>
				<!--col end -->

			</div><!-- row end -->

		</div><!-- container end -->

	</div><!-- wrapper end -->

</footer>

</div><!-- #page we need this extra closing tag here -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/3.0.0/jquery.payment.min.js"></script>

<script type="text/javascript" src="https://js.xendit.co/v1/xendit.min.js"></script>
<?php wp_footer(); ?>
<script type="text/javascript">
	Xendit.setPublishableKey('<?php echo XENDIT_PUBLIC_API_KEY; ?>');
</script>

</body>

</html>