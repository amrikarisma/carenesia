<?php
/**
 * Template Name: Member Template
 *
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();


while ( have_posts() ) :
	the_post();
	get_template_part( 'section-templates/general/general', 'header' );
	get_template_part( 'section-templates/member/member', 'list' );
endwhile;

get_footer();
