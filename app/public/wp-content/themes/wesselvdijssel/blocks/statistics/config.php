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

		'statistics' => [
			'label' => esc_html__('Statistieken', 'wesselvandenijssel'),
			'type' => 'repeater',
			'layout' => 'block',
			'min' => 1,
			'button_label' => esc_html__('Nieuwe statistiek', 'wesselvandenijssel'),
			'sub_fields' => [
				[
					'key' => 'field_statistics_statistics_prefix',
					'label' => esc_html__('Voorvoegsel', 'wesselvandenijssel'),
					'instructions' => esc_html__('Optioneel, bijvoorbeeld + of €.', 'wesselvandenijssel'),
					'name' => 'prefix',
					'type' => 'text',
					'maxlength' => 5,
					'wrapper' => [
						'width' => '20',
					],
				],
				[
					'key' => 'field_statistics_statistics_number',
					'label' => esc_html__('Getal', 'wesselvandenijssel'),
					'instructions' => esc_html__('Bijvoorbeeld 20000 of 7.5. Gebruik een punt voor decimalen.', 'wesselvandenijssel'),
					'name' => 'number',
					'type' => 'number',
					'step' => 'any',
					'required' => true,
					'wrapper' => [
						'width' => '30',
					],
				],
				[
					'key' => 'field_statistics_statistics_end_number',
					'label' => esc_html__('Tot (optioneel)', 'wesselvandenijssel'),
					'instructions' => esc_html__('Vul dit in voor een bereik, bijvoorbeeld 15 tot 25.', 'wesselvandenijssel'),
					'name' => 'end_number',
					'type' => 'number',
					'step' => 'any',
					'wrapper' => [
						'width' => '30',
					],
				],
				[
					'key' => 'field_statistics_statistics_suffix',
					'label' => esc_html__('Achtervoegsel', 'wesselvandenijssel'),
					'instructions' => esc_html__('Optioneel, bijvoorbeeld % of /10.', 'wesselvandenijssel'),
					'name' => 'suffix',
					'type' => 'text',
					'maxlength' => 10,
					'wrapper' => [
						'width' => '20',
					],
				],
				[
					'key' => 'field_statistics_statistics_label',
					'label' => esc_html__('Label', 'wesselvandenijssel'),
					'instructions' => esc_html__('Wat het getal betekent, bijvoorbeeld "Score eindmeting".', 'wesselvandenijssel'),
					'name' => 'label',
					'type' => 'text',
					'required' => true,
				],
				[
					'key' => 'field_statistics_statistics_description',
					'label' => esc_html__('Toelichting (optioneel)', 'wesselvandenijssel'),
					'name' => 'description',
					'type' => 'textarea',
					'rows' => 2,
					'new_lines' => '',
				],
			],
		],

	],
];
