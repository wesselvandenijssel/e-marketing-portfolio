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

		'logos' => [
			'label' => esc_html__('Logo\'s', 'wesselvandenijssel'),
			'type' => 'repeater',
			'layout' => 'table',
			'button_label' => esc_html__('Logo toevoegen', 'wesselvandenijssel'),
			'instructions' => esc_html__('Vul voor elk logo de alt-tekst in de mediabibliotheek in, bijvoorbeeld de naam van de tool of het certificaat.', 'wesselvandenijssel'),
			'sub_fields' => [
				[
					'key' => 'field_logo-banner_logos_logo',
					'label' => esc_html__('Logo', 'wesselvandenijssel'),
					'name' => 'logo',
					'type' => 'image',
					'mime_types' => 'svg, png, jpg, jpeg, webp',
					'return_format' => 'id',
					'preview_size' => 'thumbnail',
					'wrapper' => [
						'width' => '50',
					],
				],
				[
					'key' => 'field_logo-banner_logos_link',
					'label' => esc_html__('Link', 'wesselvandenijssel'),
					'name' => 'link',
					'type' => 'link',
					'return_format' => 'array',
					'wrapper' => [
						'width' => '50',
					],
				],
			],
		],

		'accordionsettings' => [
			'label' => esc_html__('Weergave instellingen', 'wesselvandenijssel'),
			'type' => 'accordion',
		],

		'shuffle' => [
			'label' => esc_html__('Logo\'s in willekeurige volgorde', 'wesselvandenijssel'),
			'type' => 'true_false',
			'ui' => true,
			'wrapper' => [
				'width' => '50',
			],
		],

		'grayscale' => [
			'label' => esc_html__('Logo\'s zwart-wit weergeven', 'wesselvandenijssel'),
			'type' => 'true_false',
			'ui' => true,
			'wrapper' => [
				'width' => '50',
			],
		],

		'max_amount' => [
			'label' => esc_html__('Maximum aantal', 'wesselvandenijssel'),
			'type' => 'number',
			'instructions' => esc_html__('Maximaal aantal logo\'s om weer te geven (leeg = alle).', 'wesselvandenijssel'),
			'min' => 1,
			'wrapper' => [
				'width' => '50',
			],
		],
	],
];
