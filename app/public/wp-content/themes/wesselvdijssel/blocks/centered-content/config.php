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
			'label' => esc_html__('Stijl', 'wesselvandenijssel'),
			'instructions' => esc_html__('Gebruik "Pagina-intro" als eerste blok op een pagina zonder hero.', 'wesselvandenijssel'),
			'type' => 'select',
			'choices' => [
				'default' => esc_html__('Standaard', 'wesselvandenijssel'),
				'intro' => esc_html__('Pagina-intro', 'wesselvandenijssel'),
			],
			'default_value' => 'default',
		],

		'title' => [
			'label' => esc_html__('Titel', 'wesselvandenijssel'),
			'type' => 'clone',
			'clone' => [
				'clone_titles_block_title',
			],
			'display' => 'seamless',
		],

		get_flex_content('field_centered_content_content'),

	],
];
