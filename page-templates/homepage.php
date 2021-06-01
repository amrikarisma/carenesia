<?php
/**
 * Template Name: Homepage Template
 *
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

get_template_part( 'section-templates/home/home', 'slider' );
get_template_part( 'section-templates/home/home', 'banner' );
get_template_part( 'section-templates/home/home', 'about' );
get_template_part( 'section-templates/home/home', 'fullwidth' );
get_template_part( 'section-templates/home/home', 'donation' );
get_template_part( 'section-templates/home/home', 'fullwidth-counter' );
get_template_part( 'section-templates/home/home', 'planner' );
get_template_part( 'section-templates/home/home', 'testimoni' );
get_template_part( 'section-templates/home/home', 'newsletter' );

get_footer();
