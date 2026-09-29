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
				'specific' => esc_html__('Handmatig', 'wesselvandenijssel'),
				'category' => esc_html__('Categorie', 'wesselvandenijssel'),
			],
			'default_value' => 'newest',
			'wrapper' => [
				'width' => '50',
			],
		],

		'projects' => [
			'label' => esc_html__('Projecten', 'wesselvandenijssel'),
			'type' => 'relationship',
			'post_type' => [
				'project',
			],
			'filters' => [
				'search',
				'taxonomy',
			],
			'return_format' => 'id',
			'conditional_logic' => [
				[
					[
						'field' => 'field_projects_selection',
						'operator' => '==',
						'value' => 'specific',
					],
				],
			],
		],

		'category' => [
			'label' => esc_html__('Categorie', 'wesselvandenijssel'),
			'type' => 'taxonomy',
			'taxonomy' => 'project_category',
			'field_type' => 'select',
			'allow_null' => false,
			'add_term' => false,
			'save_terms' => false,
			'load_terms' => false,
			'return_format' => 'id',
			'conditional_logic' => [
				[
					[
						'field' => 'field_projects_selection',
						'operator' => '==',
						'value' => 'category',
					],
				],
			],
			'wrapper' => [
				'width' => '50',
			],
		],

		'amount' => [
			'label' => esc_html__('Aantal', 'wesselvandenijssel'),
			'instructions' => esc_html__('-1 voor alle projecten, met paginering', 'wesselvandenijssel'),
			'type' => 'number',
			'default_value' => 3,
			'min' => -1,
			'conditional_logic' => [
				[
					[
						'field' => 'field_projects_selection',
						'operator' => '==',
						'value' => 'newest',
					],
				],
				[
					[
						'field' => 'field_projects_selection',
						'operator' => '==',
						'value' => 'category',
					],
				],
			],
			'wrapper' => [
				'width' => '50',
			],
		],

		'show_filter' => [
			'label' => esc_html__('Categoriefilter tonen', 'wesselvandenijssel'),
			'instructions' => esc_html__('Alleen bij "Nieuwste" met aantal -1.', 'wesselvandenijssel'),
			'type' => 'true_false',
			'ui' => true,
			'default_value' => false,
			'conditional_logic' => [
				[
					[
						'field' => 'field_projects_selection',
						'operator' => '==',
						'value' => 'newest',
					],
					[
						'field' => 'field_projects_amount',
						'operator' => '==',
						'value' => '-1',
					],
				],
			],
			'wrapper' => [
				'width' => '50',
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
