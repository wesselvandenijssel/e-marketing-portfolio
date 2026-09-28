<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

return [
	'fields' => [

		'accordioncontent' => [
			'label' => esc_html__('Inhoud instellingen', 'wesselvandenijssel'),
			'type' => 'accordion',
			'open' => true,
		],

		'order' => [
			'label' => esc_html__('Volgorde', 'wesselvandenijssel'),
			'type' => 'true_false',
			'ui_on_text' => esc_html__('Tekst links, afbeelding rechts', 'wesselvandenijssel'),
			'ui_off_text' => esc_html__('Tekst rechts, afbeelding links', 'wesselvandenijssel'),
			'ui' => true,
		],

		'title' => [
			'label' => esc_html__('Titel', 'wesselvandenijssel'),
			'type' => 'clone',
			'clone' => [
				0 => 'clone_titles_block_title',
			],
			'display' => 'seamless',
		],

		get_flex_content('field_content_image_content'),

		'image' => [
			'label' => esc_html__('Afbeelding', 'wesselvandenijssel'),
			'type' => 'clone',
			'clone' => [
				0 => 'clone_image_image_group',
			],
			'display' => 'seamless',
		],

		'video' => [
			'label' => esc_html__('Video', 'wesselvandenijssel'),
			'type' => 'oembed',
		],
	],
];
