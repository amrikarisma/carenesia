<?php

/**
 * The template for displaying all single posts
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('understrap_container_type');
?>
<?php
while (have_posts()) :
	the_post();
	get_template_part('section-templates/general/general', 'header');
?>
	<div class="wrapper" id="single-wrapper">

		<div id="content" tabindex="-1">

			<main class="site-main" id="main">
				<?php

				get_template_part('loop-templates/content', 'tim-single');
				// get_template_part( 'loop-templates/meta', 'share' );
				understrap_post_nav();


				?>

			</main><!-- #main -->

		</div><!-- #content -->
		<div class="<?php echo esc_attr($container); ?>">
			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) {
				comments_template();
			}
			?>
		</div>
	</div><!-- #single-wrapper -->

<?php
endwhile;
get_footer();
