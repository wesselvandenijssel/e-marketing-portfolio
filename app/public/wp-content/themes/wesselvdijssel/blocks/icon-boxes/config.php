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

		'columns' => [
			'label' => esc_html__('Aantal kolommen', 'wesselvandenijssel'),
			'type' => 'button_group',
			'choices' => [
				'2' => esc_html__('2', 'wesselvandenijssel'),
				'3' => esc_html__('3', 'wesselvandenijssel'),
				'4' => esc_html__('4', 'wesselvandenijssel'),
			],
			'default_value' => '3',
			'return_format' => 'value',
		],

		'boxes' => [
			'label' => esc_html__('Icoonblokken', 'wesselvandenijssel'),
			'type' => 'repeater',
			'layout' => 'block',
			'button_label' => esc_html__('Blok toevoegen', 'wesselvandenijssel'),
			'sub_fields' => [
				[
					'key' => 'field_icon-boxes_boxes_icon',
					'label' => esc_html__('Icoon', 'wesselvandenijssel'),
					'name' => 'icon',
					'type' => 'font-awesome',
					'custom_icon_set' => 'ACFFA_custom_icon_list_v6_Icons',
					'icon_sets' => [
						'custom',
					],
					'return_format' => 'value',
					'wrapper' => [
						'width' => '30',
					],
				],
				[
					'key' => 'field_icon-boxes_boxes_title',
					'label' => esc_html__('Titel', 'wesselvandenijssel'),
					'name' => 'title',
					'type' => 'text',
					'wrapper' => [
						'width' => '70',
					],
				],
				[
					'key' => 'field_icon-boxes_boxes_text',
					'label' => esc_html__('Tekst', 'wesselvandenijssel'),
					'name' => 'text',
					'type' => 'textarea',
					'rows' => 3,
					'new_lines' => '',
				],
				[
					'key' => 'field_icon-boxes_boxes_link',
					'label' => esc_html__('Link', 'wesselvandenijssel'),
					'name' => 'link',
					'type' => 'link',
					'instructions' => esc_html__('Optioneel. Met een link wordt het hele blok klikbaar.', 'wesselvandenijssel'),
					'return_format' => 'array',
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
