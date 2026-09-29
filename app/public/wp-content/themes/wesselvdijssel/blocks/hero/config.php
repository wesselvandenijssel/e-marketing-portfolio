<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

return [
	'fields' => [

		'accordioncontent' => [
			'label' => esc_html__('Inhoud instellingen', 'wesselvandenijssel'),
			'type' => 'accordion',
			'open' => true,
		],

		'variant' => [
			'label' => esc_html__('Weergave', 'wesselvandenijssel'),
			'type' => 'button_group',
			'choices' => [
				'background' => esc_html__('Beeld als achtergrond', 'wesselvandenijssel'),
				'portrait' => esc_html__('Portret naast tekst', 'wesselvandenijssel'),
			],
			'default_value' => 'background',
		],

		'type' => [
			'label' => esc_html__('Type', 'wesselvandenijssel'),
			'type' => 'button_group',
			'choices' => [
				'image' => esc_html__('Afbeelding', 'wesselvandenijssel'),
				'video' => esc_html__('Video', 'wesselvandenijssel'),
			],
			'wrapper' => [
				'width' => '50',
			],
			'conditional_logic' => [
				[
					[
						'field' => 'field_hero_variant',
						'operator' => '==',
						'value' => 'background',
					],
				],
			],
		],

		'size' => [
			'label' => esc_html__('Grootte', 'wesselvandenijssel'),
			'type' => 'button_group',
			'choices' => [
				'900' => esc_html__('900px hoog', 'wesselvandenijssel'),
			],
			'wrapper' => [
				'width' => '50',
			],
			'conditional_logic' => [
				[
					[
						'field' => 'field_hero_variant',
						'operator' => '==',
						'value' => 'background',
					],
				],
			],
		],

		'image' => [
			'label' => esc_html__('Afbeelding', 'wesselvandenijssel'),
			'instructions' => esc_html__('Bij "Portret naast tekst": een staande foto, minimaal 800 × 1000 px. Vul de alt-tekst in de mediabibliotheek in.', 'wesselvandenijssel'),
			'type' => 'image',
			'return_format' => 'id',
			'mime_types' => 'png,jpeg,jpg,webp',
			'conditional_logic' => [
				[
					[
						'field' => 'field_hero_variant',
						'operator' => '==',
						'value' => 'background',
					],
					[
						'field' => 'field_hero_type',
						'operator' => '==',
						'value' => 'image',
					],
				],
				[
					[
						'field' => 'field_hero_variant',
						'operator' => '==',
						'value' => 'portrait',
					],
				],
			],
		],

		'video' => [
			'label' => esc_html__('Video', 'wesselvandenijssel'),
			'type' => 'textarea',
			'conditional_logic' => [
				[
					[
						'field' => 'field_hero_variant',
						'operator' => '==',
						'value' => 'background',
					],
					[
						'field' => 'field_hero_type',
						'operator' => '==',
						'value' => 'video',
					],
				],
			],
		],

		'title' => [
			'label' => esc_html__('Titel', 'wesselvandenijssel'),
			'type' => 'clone',
			'clone' => [
				'clone_titles_block_title',
			],
			'display' => 'seamless',
		],

		get_flex_content('field_hero_content'),

	],
];
