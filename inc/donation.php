<?php

/**
 * Donation functions
 *
 * @package donation
 */

add_filter('manage_donasi_posts_columns', 'karisma_filter_donasi_posts_columns');
function karisma_filter_donasi_posts_columns($columns)
{
    $columns['image'] = __('Image');
    $columns['current_amount'] = __('Terkumpul', 'smashing');
    $columns['target_amount'] = __('Target', 'smashing');
    return $columns;
}

add_action('manage_donasi_posts_custom_column', 'karisma_donasi_column', 10, 2);
function karisma_donasi_column($column, $post_id)
{
    // Image column
    if ('image' === $column) {
        echo get_the_post_thumbnail($post_id, array(80, 80));
    }

    if ('current_amount' === $column) {
        echo 'RP. ' . number_format(get_donation('total', $post_id) ?? 0, 0, ',', '.');
    }

    if ('target_amount' === $column) {
        echo 'RP. ' . number_format(get_field('donation_goals', $post_id) ?? 0, 0, ',', '.');
    }
}
