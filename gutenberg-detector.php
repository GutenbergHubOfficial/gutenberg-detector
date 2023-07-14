<?php
/*
Plugin Name: Gutenberg Detector
Plugin URI: https://www.gutenberghub.com/
Description: This plugin adds a new column in the WordPress admin post/page table which indicates if the post is using Gutenberg editor.
Version: 1.0.0
Author: MunirKamal
Author URI: https://www.gutenberghub.com/
License: GPL2
*/

// Add new column to post list
add_filter('manage_posts_columns', 'gutenberg_detector_column');
add_filter('manage_pages_columns', 'gutenberg_detector_column');
function gutenberg_detector_column($columns) {
    $columns['gutenberg_detector'] = 'Gutenberg Editor';
    return $columns;
}

// Populate the new column with data
add_action('manage_posts_custom_column', 'gutenberg_detector_column_data', 10, 2);
add_action('manage_pages_custom_column', 'gutenberg_detector_column_data', 10, 2);
function gutenberg_detector_column_data($column, $post_id) {
    if ($column == 'gutenberg_detector') {
        $post_content = get_post_field('post_content', $post_id);
        if (has_blocks($post_content)) {
            echo 'Yes';
        } else {
            echo 'No';
        }
    }
}

// Add CSS to make the new column look better
add_action('admin_head', 'gutenberg_detector_column_style');
function gutenberg_detector_column_style() {
    echo '<style>.column-gutenberg_detector { width: 150px; }</style>';
}
?>
