<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

// wp menus
add_theme_support('menus');

add_action('init', function () {
	register_nav_menus([
		'primary' => esc_html__('Hoofdmenu', 'wesselvandenijssel'),
		'primary_mobile' => esc_html__('Hoofdmenu mobiel', 'wesselvandenijssel'),
		'top' => esc_html__('Topbar menu', 'wesselvandenijssel'),
	]);
});

// Populate header block with menus
add_filter('acf/load_field/key=field_623313af249bc', 'acf_load_menu_choices');

// Setup the WordPress core custom background feature.
add_theme_support(
	'custom-background',
	apply_filters(
		'wesselvandenijssel_custom_background_args',
		[
			'default-color' => 'ffffff',
			'default-image' => '',
		]
	)
);

// rss
add_theme_support('automatic-feed-links');

// Enable support for HTML5 markup.
add_theme_support(
	'html5',
	[
		'comment-list',
		'search-form',
		'comment-form',
		'script',
		'style',
	]
);
ob_start(function ($buffer) {
	$buffer = str_replace(array('type="text/javascript"', "type='text/javascript'"), '', $buffer);
	return $buffer;
});


// Add title attribute to breadcrumb
add_filter('wpseo_breadcrumb_single_link', 'breadcrumb_add_title_attribute', 10, 2);
function breadcrumb_add_title_attribute($link_output, $link) {
	$element = '';
	$element = esc_attr(apply_filters('wpseo_breadcrumb_single_link_wrapper', $element));
	$link_output = $element;
	if (!empty($link['url'])) {
		$link_output .= '<a href="' .
			esc_url($link['url']) . '" title="' . $link['text'] . '">' .

			esc_html($link['text']) . '</a>';
	}
	return $link_output;
}

/**
 * Adds the Projecten page between Home and a project, in the breadcrumb and in Yoast's BreadcrumbList schema.
 *
 * @param array $links The breadcrumb links
 * @return array
 */
add_filter('wpseo_breadcrumb_links', 'wesselvandenijssel_project_breadcrumb');
function wesselvandenijssel_project_breadcrumb(array $links): array {
	if (!is_singular('project') || get_post_status(220) !== 'publish') return $links;

	array_splice($links, 1, 0, [['url' => get_permalink(220), 'text' => get_the_title(220), 'id' => 220]]);

	return $links;
}

function acf_load_menu_choices($field) {
	// reset choices
	$field['choices'] = [];

	$choices = wp_get_nav_menus();

	// loop through array and add to field 'choices'
	if (is_array($choices)) {
		$field['choices']['none'] = 'Geen menu';
		foreach ($choices as $key => $value) {
			$field['choices'][$value->term_id] = $value->name;
		}
	}

	// return the field
	return $field;
}

// Add a unqiue block ID to every block
add_filter(
	'acf/pre_save_block',
	function ($attributes) {
		if (empty($attributes['id'])) {
			$attributes['id'] = 'block_acf-block-' . uniqid();
		}
		return $attributes;
	}
);
