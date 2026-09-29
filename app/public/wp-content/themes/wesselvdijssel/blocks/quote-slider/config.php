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

		'quotes' => [
			'label' => esc_html__('Quotes', 'wesselvandenijssel'),
			'instructions' => esc_html__('Bij één quote verschijnen er geen pijlen. Zet feedback uit het beschermde portfolio alleen op beschermde pagina\'s.', 'wesselvandenijssel'),
			'type' => 'repeater',
			'layout' => 'block',
			'min' => 1,
			'button_label' => esc_html__('Nieuwe quote', 'wesselvandenijssel'),
			'sub_fields' => [
				[
					'key' => 'field_quote-slider_quotes_quote',
					'label' => esc_html__('Quote', 'wesselvandenijssel'),
					'name' => 'quote',
					'type' => 'textarea',
					'rows' => 4,
					'new_lines' => '',
					'required' => true,
				],
				[
					'key' => 'field_quote-slider_quotes_name',
					'label' => esc_html__('Naam', 'wesselvandenijssel'),
					'name' => 'name',
					'type' => 'text',
					'wrapper' => [
						'width' => '50',
					],
				],
				[
					'key' => 'field_quote-slider_quotes_role',
					'label' => esc_html__('Rol of functie', 'wesselvandenijssel'),
					'name' => 'role',
					'type' => 'text',
					'wrapper' => [
						'width' => '50',
					],
				],
				[
					'key' => 'field_quote-slider_quotes_image',
					'label' => esc_html__('Foto (optioneel)', 'wesselvandenijssel'),
					'instructions' => esc_html__('Vierkante foto, minimaal 200 × 200 px. De foto staat naast de naam en is daarom decoratief.', 'wesselvandenijssel'),
					'name' => 'image',
					'type' => 'image',
					'return_format' => 'id',
					'preview_size' => 'thumbnail',
					'mime_types' => 'png,jpeg,jpg,webp',
				],
			],
		],

	],
];
