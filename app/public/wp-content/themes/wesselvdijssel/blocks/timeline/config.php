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
				0 => 'clone_titles_block_title',
			],
			'display' => 'seamless',
		],

		'intro' => [
			'label' => esc_html__('Introductie', 'wesselvandenijssel'),
			'type' => 'wysiwyg',
			'tabs' => 'visual',
			'toolbar' => 'basic',
			'media_upload' => false,
			'delay' => true,
		],

		'items' => [
			'label' => esc_html__('Items', 'wesselvandenijssel'),
			'instructions' => esc_html__('Eén item per functie, opleiding of datapunt. Zet het meest recente item bovenaan.', 'wesselvandenijssel'),
			'type' => 'repeater',
			'required' => true,
			'min' => 1,
			'layout' => 'block',
			'collapsed' => 'field_timeline_items_title',
			'button_label' => esc_html__('Item toevoegen', 'wesselvandenijssel'),
			'sub_fields' => [
				[
					'key' => 'field_timeline_items_period',
					'name' => 'period',
					'label' => esc_html__('Periode', 'wesselvandenijssel'),
					'instructions' => esc_html__('Bijvoorbeeld: 2023 - heden', 'wesselvandenijssel'),
					'type' => 'text',
					'wrapper' => [
						'width' => '50',
					],
				],
				[
					'key' => 'field_timeline_items_title',
					'name' => 'title',
					'label' => esc_html__('Titel', 'wesselvandenijssel'),
					'instructions' => esc_html__('Functie, opleiding of datapunt.', 'wesselvandenijssel'),
					'type' => 'text',
					'required' => true,
					'wrapper' => [
						'width' => '50',
					],
				],
				[
					'key' => 'field_timeline_items_organisation',
					'name' => 'organisation',
					'label' => esc_html__('Organisatie', 'wesselvandenijssel'),
					'type' => 'text',
					'wrapper' => [
						'width' => '50',
					],
				],
				[
					'key' => 'field_timeline_items_location',
					'name' => 'location',
					'label' => esc_html__('Locatie', 'wesselvandenijssel'),
					'type' => 'text',
					'wrapper' => [
						'width' => '50',
					],
				],
				[
					'key' => 'field_timeline_items_description',
					'name' => 'description',
					'label' => esc_html__('Omschrijving', 'wesselvandenijssel'),
					'type' => 'wysiwyg',
					'tabs' => 'visual',
					'toolbar' => 'basic',
					'media_upload' => false,
					'delay' => true,
				],
				[
					'key' => 'field_timeline_items_link',
					'name' => 'link',
					'label' => esc_html__('Link', 'wesselvandenijssel'),
					'instructions' => esc_html__('Optioneel. Vul een duidelijke linktekst in.', 'wesselvandenijssel'),
					'type' => 'link',
					'return_format' => 'array',
				],
			],
		],

		'buttons' => [
			'label' => esc_html__('Buttons', 'wesselvandenijssel'),
			'type' => 'clone',
			'clone' => [
				0 => 'clone_buttons_buttons_group',
			],
			'display' => 'seamless',
		],
	],
];
