<?php

/**
 * Custom hooks
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('understrap_site_info')) {
	/**
	 * Add site info hook to WP hook library.
	 */
	function understrap_site_info()
	{
		do_action('understrap_site_info');
	}
}

add_action('understrap_site_info', 'understrap_add_site_info');
if (!function_exists('understrap_add_site_info')) {
	/**
	 * Add site info content.
	 */
	function understrap_add_site_info()
	{
		$the_theme = wp_get_theme();

		$site_info = sprintf(

			sprintf( // WPCS: XSS ok.
				/* translators: 1: Theme name, 2: Theme author */
				esc_html__('Copyright © %1$s', 'understrap'),
				'<a href="' . esc_url(__(site_url(), 'understrap')) . '">Carenesia</a>'
			),
			sprintf( // WPCS: XSS ok.
				/* translators: Theme version */
				esc_html__('Version: %1$s', 'understrap'),
				$the_theme->get('Version')
			)
		);

		echo apply_filters('understrap_site_info_content', $site_info); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
