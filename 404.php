<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');
get_template_part('section-templates/general/general', 'header');

?>

<div class="wrapper" id="error-404-wrapper">

	<div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main">

					<section class="error-404 not-found">

						<header class="page-header">

							<h1 class="page-title"><?php esc_html_e('Ups, halaman tidak ditemukan', 'understrap'); ?></h1>

						</header><!-- .page-header -->

						<div class="page-content">

							<p><?php esc_html_e('Sepertinya tidak ada yang ditemukan di halaman ini. Mungkin coba cari?', 'understrap'); ?></p>

							<?php get_search_form(); ?>


						</div><!-- .page-content -->

					</section><!-- .error-404 -->

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #error-404-wrapper -->

<?php
get_footer();
