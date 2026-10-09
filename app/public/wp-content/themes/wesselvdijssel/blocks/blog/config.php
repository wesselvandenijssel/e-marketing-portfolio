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

		'selection' => [
			'label' => esc_html__('Selectie', 'wesselvandenijssel'),
			'type' => 'button_group',
			'choices' => [
				'newest' => esc_html__('Nieuwste', 'wesselvandenijssel'),
				'random' => esc_html__('Willekeurig', 'wesselvandenijssel'),
				'specific' => esc_html__('Specifiek', 'wesselvandenijssel'),
				'category' => esc_html__('Categorie', 'wesselvandenijssel'),
			],
			'wrapper' => [
				'width' => '50',
			],
		],

		'posts' => [
			'label' => esc_html__('Berichten', 'wesselvandenijssel'),
			'type' => 'post_object',
			'post_type' => [
				'post',
			],
			'return_format' => 'id',
			'multiple' => true,
			'conditional_logic' => [
				[
					[
						'field' => 'field_blog_selection',
						'operator' => '==',
						'value' => 'specific',
					],
				],
			],
		],

		'category' => [
			'label' => esc_html__('Categorie', 'wesselvandenijssel'),
			'type' => 'taxonomy',
			'taxonomy' => 'category',
			'field_type' => 'select',
			'return_format' => 'id',
			'conditional_logic' => [
				[
					[
						'field' => 'field_blog_selection',
						'operator' => '==',
						'value' => 'category',
					],
				],
			],
		],

		'amount' => [
			'label' => esc_html__('Aantal', 'wesselvandenijssel'),
			'instructions' => wp_kses_post(__('-1 voor alle berichten', 'wesselvandenijssel')),
			'type' => 'number',
			'default_value' => 3,
			'conditional_logic' => [
				[
					[
						'field' => 'field_blog_selection',
						'operator' => '==',
						'value' => 'newest',
					],
				],
				[
					[
						'field' => 'field_blog_selection',
						'operator' => '==',
						'value' => 'random',
					],
				],
			],
		],

		'buttons' => [
			'label' => esc_html__('Button(s)', 'wesselvandenijssel'),
			'type' => 'clone',
			'clone' => [
				'clone_buttons_buttons_group',
			],
			'display' => 'seamless',
		],
	],
];
