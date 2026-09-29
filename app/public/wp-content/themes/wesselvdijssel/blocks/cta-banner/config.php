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

		'image' => [
			'label' => esc_html__('Afbeelding', 'wesselvandenijssel'),
			'type' => 'image',
			'instructions' => esc_html__('Optioneel. Alleen zichtbaar vanaf tablet liggend. Vul de alt-tekst in de mediabibliotheek in.', 'wesselvandenijssel'),
			'return_format' => 'id',
			'mime_types' => 'svg, png, jpg, jpeg, webp',
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

		'accordionsettings' => [
			'label' => esc_html__('Weergave instellingen', 'wesselvandenijssel'),
			'type' => 'accordion',
		],

		'style' => [
			'label' => esc_html__('Achtergrond', 'wesselvandenijssel'),
			'type' => 'button_group',
			'choices' => [
				'light' => esc_html__('Lichtblauw', 'wesselvandenijssel'),
				'dark' => esc_html__('Donkerblauw', 'wesselvandenijssel'),
			],
			'default_value' => 'light',
			'return_format' => 'value',
		],
	],
];
