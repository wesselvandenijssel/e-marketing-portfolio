<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

add_action('acf/init', function () {
	acf_add_local_field_group([
		'key' => 'settings_author',
		'title' => esc_html__('Auteur instellingen', 'wesselvandenijssel'),
		'fields' => [
			[
				'key' => 'settings_author_image',
				'name' => 'image',
				'type' => 'image',
				'label' => esc_html__('Portretfoto', 'wesselvandenijssel'),
				'return_format' => 'id',
				'mime_types' => 'jpg,jpeg,png,webp,svg',
				'wrapper' => [
					'width' => '25',
				],
			],
			[
				'key' => 'settings_author_excerpt',
				'name' => 'excerpt',
				'type' => 'textarea',
				'label' => esc_html__('Korte bio', 'wesselvandenijssel'),
				'wrapper' => [
					'width' => '75',
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'user_form',
					'operator' => '==',
					'value' => 'all',
				],
			],
		],
	]);
});
