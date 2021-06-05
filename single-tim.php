<?php
/**
 * The template for displaying all single posts
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>
<?php 
while ( have_posts() ) :
	the_post(); ?>
<section class="header" style="background-image:url('https://goodwish.qodeinteractive.com/elementor/wp-content/uploads/2017/03/team-parallax-img-1.jpg');    height: 280px;">
	<div class="wrap-title">
		<div class="container">
			<h2 class="title"><?php the_title(); ?></h2>
		</div>
	</div>
</section>
<div class="wrapper" id="single-wrapper">

	<div id="content" tabindex="-1">

			<main class="site-main" id="main">
					<?php
					
						get_template_part( 'loop-templates/content', 'tim-single' );
						// get_template_part( 'loop-templates/meta', 'share' );
						understrap_post_nav();


					?>

			</main><!-- #main -->

	</div><!-- #content -->
	<div class="<?php echo esc_attr( $container ); ?>">
	<?php
	// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
	?>
	</div>
</div><!-- #single-wrapper -->

<?php
endwhile;
get_footer();
