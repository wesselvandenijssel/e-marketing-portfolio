<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

// wp thumbnails
add_theme_support('post-thumbnails');

/**
 * Stops WordPress from generating default sizes the theme doesn't use.
 *
 * @param array $sizes the image size names
 */
function remove_default_img_sizes($sizes) {
	return array_values(array_diff($sizes, ['medium_large', '1536x1536', '2048x2048']));
}
add_filter('intermediate_image_sizes', 'remove_default_img_sizes');

// Thumbnails
add_action('acf/init', 'hook_thumbnail_methods', 20);

/**
 * Hook methods for managing thumbnails.
 */
function hook_thumbnail_methods(): void {
	$image_settings = get_field('image_settings_group', 'utilities');

	if (!empty($image_settings) && !empty($image_settings['thumbnails'])) {
		add_image_size('Author thumb', 80, 80, true);
		add_image_size('Blog detail', 610, 500, true);
		add_image_size('Hero 900', 1920, 900, true);
		add_image_size('Hero 900 medium', 1280, 600, true);
		add_image_size('Hero 900 small', 960, 450, true);
		add_image_size('Hero mobile', 780, 600, true); // 390x300 at 2x for retina phones
		add_image_size('Project hero medium', 1100, 620, true);
		add_image_size('Project hero small', 720, 405, true);
		add_image_size('Post', 400, 270, true);
		add_image_size('Post large', 800, 540, true);
		add_image_size('Project card', 720, 480, true);
		add_image_size('Portrait', 640, 800, true);
		add_image_size('Content', 880, 880, false);
		add_image_size('Menu card', 720, 0, false);
		add_image_size('Avatar', 128, 128, true);
	}
}

add_filter('wp_get_attachment_image_attributes', 'wesselvandenijssel_remove_sizes_without_srcset', 99);

/**
 * Removes the sizes attribute from images without a srcset, which is invalid HTML.
 *
 * @param array $attr The image attributes
 */
function wesselvandenijssel_remove_sizes_without_srcset(array $attr): array {
	if (empty($attr['srcset'])) {
		unset($attr['sizes']);
	}

	return $attr;
}

/**
 * Writes every generated image size of a JPEG upload as WebP. The original file stays a JPEG.
 *
 * @param array $formats Output formats per source MIME type
 * @return array
 */
function wesselvandenijssel_webp_subsizes(array $formats): array {
	$formats['image/jpeg'] = 'image/webp';

	return $formats;
}
add_filter('image_editor_output_format', 'wesselvandenijssel_webp_subsizes');
