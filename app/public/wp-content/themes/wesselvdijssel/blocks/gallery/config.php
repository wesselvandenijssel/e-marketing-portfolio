<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

return [
	'fields' => [

		'accordioncontent' => [
			'label' => esc_html__('Inhoud instellingen', 'wesselvandenijssel'),
			'type' => 'accordion',
			'open' => true,
		],

		'title' => [
			'label' => esc_html__('Titel', 'wesselvandenijssel'),
			'type' => 'clone',
			'clone' => [
				'clone_titles_block_title',
			],
			'display' => 'seamless',
		],

		'layout' => [
			'label' => esc_html__('Weergave', 'wesselvandenijssel'),
			'instructions' => esc_html__('Uitgelicht toont één grote en twee kleine afbeeldingen. De rest opent in de lightbox.', 'wesselvandenijssel'),
			'type' => 'button_group',
			'choices' => [
				'grid' => esc_html__('Raster', 'wesselvandenijssel'),
				'featured' => esc_html__('Uitgelicht', 'wesselvandenijssel'),
			],
			'default_value' => 'grid',
			'wrapper' => [
				'width' => '33',
			],
		],

		'columns' => [
			'label' => esc_html__('Kolommen', 'wesselvandenijssel'),
			'type' => 'button_group',
			'choices' => [
				'2' => '2',
				'3' => '3',
				'4' => '4',
			],
			'default_value' => '3',
			'wrapper' => [
				'width' => '33',
			],
			'conditional_logic' => [
				[
					[
						'field' => 'field_gallery_layout',
						'operator' => '==',
						'value' => 'grid',
					],
				],
			],
		],

		'fit' => [
			'label' => esc_html__('Afbeeldingen', 'wesselvandenijssel'),
			'instructions' => esc_html__('Kies "Volledig tonen" voor certificaten, zodat er niets wegvalt.', 'wesselvandenijssel'),
			'type' => 'button_group',
			'choices' => [
				'cover' => esc_html__('Bijsnijden', 'wesselvandenijssel'),
				'contain' => esc_html__('Volledig tonen', 'wesselvandenijssel'),
			],
			'default_value' => 'cover',
			'wrapper' => [
				'width' => '33',
			],
			'conditional_logic' => [
				[
					[
						'field' => 'field_gallery_layout',
						'operator' => '==',
						'value' => 'grid',
					],
				],
			],
		],

		'show_captions' => [
			'label' => esc_html__('Bijschrift tonen', 'wesselvandenijssel'),
			'instructions' => esc_html__('Het bijschrift komt uit de mediabibliotheek. In de lightbox staat het altijd.', 'wesselvandenijssel'),
			'type' => 'true_false',
			'ui' => true,
			'default_value' => false,
			'conditional_logic' => [
				[
					[
						'field' => 'field_gallery_layout',
						'operator' => '==',
						'value' => 'grid',
					],
				],
			],
		],

		'items' => [
			'label' => esc_html__('Afbeeldingen', 'wesselvandenijssel'),
			'instructions' => esc_html__('Vul de alt-tekst en het bijschrift in de mediabibliotheek in.', 'wesselvandenijssel'),
			'type' => 'repeater',
			'layout' => 'table',
			'min' => 1,
			'button_label' => esc_html__('Nieuwe afbeelding', 'wesselvandenijssel'),
			'sub_fields' => [
				[
					'key' => 'field_gallery_items_image',
					'label' => esc_html__('Afbeelding', 'wesselvandenijssel'),
					'name' => 'image',
					'type' => 'image',
					'return_format' => 'id',
					'preview_size' => 'thumbnail',
					'mime_types' => 'png,jpg,jpeg,webp',
					'required' => true,
				],
				[
					'key' => 'field_gallery_items_video',
					'label' => esc_html__('Video (optioneel)', 'wesselvandenijssel'),
					'instructions' => esc_html__('YouTube- of Vimeo-link. De afbeelding wordt dan de voorvertoning.', 'wesselvandenijssel'),
					'name' => 'video',
					'type' => 'oembed',
				],
			],
		],

	],
];
