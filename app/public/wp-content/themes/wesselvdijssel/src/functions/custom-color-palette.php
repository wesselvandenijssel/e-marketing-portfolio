<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

// add colors to color pallete in Gutenberg
function add_custom_text_color_pallete() {

	// Brand colors from src/styles/partials/_variables.scss. $hue-accent-1 (#00a3e0) is left out on purpose:
	// this palette is used for text too, and #00a3e0 fails 4.5:1 as a text color on light backgrounds.
	$newColorPalette = [
		[
			'name' => esc_html__('Navy', 'wesselvandenijssel'),
			'slug' => 'navy',
			'color' => '#00244d',
		],
		[
			'name' => esc_html__('Blauw (tekst)', 'wesselvandenijssel'),
			'slug' => 'blauw-tekst',
			'color' => '#0077a8',
		],
		[
			'name' => esc_html__('Grijs', 'wesselvandenijssel'),
			'slug' => 'grijs',
			'color' => '#475569',
		],
		[
			'name' => esc_html__('Lichtblauw', 'wesselvandenijssel'),
			'slug' => 'lichtblauw',
			'color' => '#e5f6fc',
		],
		[
			'name' => esc_html__('Lichtgrijs', 'wesselvandenijssel'),
			'slug' => 'lichtgrijs',
			'color' => '#f8fafc',
		],
		[
			'name' => esc_html__('Wit', 'wesselvandenijssel'),
			'slug' => 'wit',
			'color' => '#ffffff',
		],
	];

	// Apply the color palette containing the new colors:
	add_theme_support('editor-color-palette', $newColorPalette);
}
add_action('after_setup_theme', 'add_custom_text_color_pallete');

// add gradients to color pallete in Gutenberg
function add_custom_gradient_color_pallete() {

	$newColorPalette = [
		[
			'name' => esc_html__('Dark to Light', 'wesselvandenijssel'),
			'gradient' => 'linear-gradient(135deg, #00244d 0%, #e5f6fc 100%)',
			'slug' => 'dark-to-light',
		],
	];

	// Apply the color palette containing the new colors:
	add_theme_support('editor-gradient-presets', $newColorPalette);
}
// Disabled by default
// add_action('after_setup_theme', 'add_custom_gradient_color_pallete');
