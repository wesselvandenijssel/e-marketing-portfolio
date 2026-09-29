<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

// Required classes
require_once('src/classes/button.php');
require_once('src/classes/flex-content.php');
require_once('src/classes/popup.php');
require_once('src/classes/title.php');
require_once('src/classes/walker-menu.php');
require_once('src/classes/walker-menu-fold.php');

// Required functions
require_once(get_template_directory() . '/src/functions/screenshots-api.php');
require_once(get_template_directory() . '/src/functions/theme-helpers.php');
require_once(get_template_directory() . '/src/functions/theme-support.php');
require_once(get_template_directory() . '/src/functions/video-helpers.php');
require(get_template_directory() . '/src/functions/autoload.php');

require_once(get_template_directory() . '/src/inc/protected-section.php');

function wesselvandenijssel_setup() {
	// let's get language support going, if you need it
	load_theme_textdomain('wesselvandenijssel', get_template_directory() . '/src/languages');

	// launching operation cleanup
	add_action('init', 'wesselvandenijssel_head_cleanup');
	// A better title
	add_filter('wp_title', 'rw_title', 10, 3);
	// remove WP version from RSS
	add_filter('the_generator', 'wesselvandenijssel_rss_version');
	// remove pesky injected css for recent comments widget
	add_filter('wp_head', 'wesselvandenijssel_remove_wp_widget_recent_comments_style', 1);
	// clean up comment styles in the head
	add_action('wp_head', 'wesselvandenijssel_remove_recent_comments_style', 1);

	// enqueue base scripts and styles
	add_action('wp_enqueue_scripts', 'wesselvandenijssel_scripts_and_styles', 999);

	// cleaning up random code around images
	add_filter('the_content', 'wesselvandenijssel_filter_ptags_on_images');
	// cleaning up excerpt
	add_filter('excerpt_more', 'wesselvandenijssel_excerpt_more');
}

// let's get this party started
add_action('after_setup_theme', 'wesselvandenijssel_setup');
