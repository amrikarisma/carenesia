<?php

/**
 * UnderStrap enqueue scripts
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('understrap_scripts')) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function understrap_scripts()
	{
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get('Version');
		$css_version = $theme_version . '.' . filemtime(get_template_directory() . '/css/theme.min.css');

		wp_enqueue_style('carousel-theme-styles', get_template_directory_uri() . '/css/owl.theme.default.min.css', array(), $css_version);
		wp_enqueue_style('carousel-styles', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), $css_version);

		wp_enqueue_style('understrap-styles', get_template_directory_uri() . '/css/theme.min.css', array(), $css_version);

		wp_enqueue_script('jquery');

		$js_version = $theme_version . '.' . filemtime(get_template_directory() . '/js/theme.min.js');

		wp_enqueue_script('sweetalert2', '//cdn.jsdelivr.net/npm/sweetalert2@11', array(), $js_version, true);
		wp_enqueue_script('carousel-scripts', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), $js_version, true);
		wp_enqueue_script('understrap-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $js_version, true);

		wp_localize_script('understrap-scripts', 'ajax_carenesia', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'security' => wp_create_nonce('carenesia')
		));

		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}
} // End of if function_exists( 'understrap_scripts' ).

add_action('wp_enqueue_scripts', 'understrap_scripts');
