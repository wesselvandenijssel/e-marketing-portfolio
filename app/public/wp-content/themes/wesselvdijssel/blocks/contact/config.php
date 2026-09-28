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

		'form' => [
			'label' => esc_html__('Formulier', 'wesselvandenijssel'),
			'instructions' => wp_kses_post(__('Selecteer hier het contact formulier', 'wesselvandenijssel')),
			'type' => 'select',
			'choices' => get_all_forms(),
		],

		'selection' => [
			'label' => esc_html__('Selectie', 'wesselvandenijssel'),
			'type' => 'radio',
			'choices' => [
				'none' => esc_html__('Geen', 'wesselvandenijssel'),
				'contact_details' => esc_html__('Contactgegevens', 'wesselvandenijssel'),
				'content' => esc_html__('Content', 'wesselvandenijssel'),
			],
		],

		'order' => [
			'label' => esc_html__('Volgorde', 'wesselvandenijssel'),
			'type' => 'true_false',
			'ui_on_text' => esc_html__('Formulier links, content rechts', 'wesselvandenijssel'),
			'ui_off_text' => esc_html__('Formulier rechts, content links', 'wesselvandenijssel'),
			'ui' => true,
			'conditional_logic' => [
				[
					[
						'field' => 'field_contact_selection',
						'operator' => '!=',
						'value' => 'none',
					],
				],
			],
		],

		'content' => [
			'label' => esc_html__('Content', 'wesselvandenijssel'),
			'type' => 'group',
			'sub_fields' => [
				get_flex_content('field_contact_content_content'),
			],
			'conditional_logic' => [
				[
					[
						'field' => 'field_contact_selection',
						'operator' => '==',
						'value' => 'content',
					],
				],
			],
		],

	],
];
