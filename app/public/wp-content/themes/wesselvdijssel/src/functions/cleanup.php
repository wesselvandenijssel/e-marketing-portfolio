<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

function wesselvandenijssel_head_cleanup() {
	// EditURI link
	remove_action('wp_head', 'rsd_link');
	// windows live writer
	remove_action('wp_head', 'wlwmanifest_link');
	// previous link
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	// start link
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	// links for adjacent posts
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	// WP version
	remove_action('wp_head', 'wp_generator');
}

// remove WP version from RSS
function wesselvandenijssel_rss_version() {
	return '';
}

// remove injected CSS for recent comments widget
function wesselvandenijssel_remove_wp_widget_recent_comments_style() {
	if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
		remove_filter('wp_head', 'wp_widget_recent_comments_style');
	}
}

// remove injected CSS from recent comments widget
function wesselvandenijssel_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (!empty($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action('wp_head', [$wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style']);
	}
}

add_filter('body_class', 'wesselvandenijssel_remove_blog_body_class');

/**
 * Removes the "blog" body class WordPress adds to the posts page, because it collides with the blog block's .blog styles.
 *
 * @param array $classes The body classes
 */
function wesselvandenijssel_remove_blog_body_class(array $classes): array {
	return array_values(array_diff($classes, ['blog']));
}
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

add_action('wp_enqueue_scripts', 'wesselvandenijssel_dequeue_classic_theme_styles', 20);
function wesselvandenijssel_dequeue_classic_theme_styles() {
	wp_dequeue_style('classic-theme-styles');
}

remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_footer', 'wp_enqueue_global_styles', 1);
