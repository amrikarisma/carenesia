<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>
<section class="header" style="background-image:url('https://goodwish.qodeinteractive.com/elementor/wp-content/uploads/2017/03/team-parallax-img-1.jpg');    height: 280px;">
	<div class="wrap-title">
		<div class="container">
			<h2 class="title"><?php the_title(); ?></h2>
		</div>
	</div>
</section>
<?php 
while ( have_posts() ) :
	the_post(); ?>

<div class="wrapper" id="single-wrapper">

	<div id="content" tabindex="-1">

			<main class="site-main" id="main">
					<?php

						get_template_part( 'loop-templates/content', get_post_format() );
					
					?>

			</main><!-- #main -->
			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
endwhile;
get_footer();
