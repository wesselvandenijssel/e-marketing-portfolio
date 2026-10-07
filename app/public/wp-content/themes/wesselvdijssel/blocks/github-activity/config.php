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

		'username' => [
			'label' => esc_html__('GitHub-gebruikersnaam', 'wesselvandenijssel'),
			'type' => 'text',
			'default_value' => 'wesselvandenijssel',
			'required' => true,
		],
	],
];
