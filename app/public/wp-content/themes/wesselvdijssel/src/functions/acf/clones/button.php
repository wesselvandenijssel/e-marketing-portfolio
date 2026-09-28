<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

if (function_exists('acf_add_local_field_group')) :
	acf_add_local_field_group([
		'key' => 'clone_buttons',
		'title' => esc_html__('Kloon: Button', 'wesselvandenijssel'),
		'fields' => [
			[
				'key' => 'clone_buttons_buttons_group',
				'label' => esc_html__('Button(s)', 'wesselvandenijssel'),
				'name' => 'buttons_group',
				'type' => 'flexible_content',
				'button_label' => esc_html__('Nieuwe button', 'wesselvandenijssel'),
				'layouts' => [
					[
						'key' => 'clone_buttons_buttons_group_primary',
						'name' => 'primary',
						'label' => esc_html__('Button - Primair', 'wesselvandenijssel'),
						'sub_fields' => [
							[
								'key' => 'clone_buttons_buttons_group_primary_button_primary',
								'label' => esc_html__('Button', 'wesselvandenijssel'),
								'name' => 'button_primary',
								'type' => 'clone',
								'clone' => [
									'clone_buttons_singular_button',
								],
								'display' => 'seamless',
								'layout' => 'block',
							],
						],
					],
					[
						'key' => 'clone_buttons_buttons_group_secondary',
						'name' => 'secondary',
						'label' => esc_html__('Button - Secundair', 'wesselvandenijssel'),
						'sub_fields' => [
							[
								'key' => 'clone_buttons_buttons_group_secondary_button_secondary',
								'label' => esc_html__('Button', 'wesselvandenijssel'),
								'name' => 'button_secondary',
								'type' => 'clone',
								'clone' => [
									'clone_buttons_singular_button',
								],
								'display' => 'seamless',
								'layout' => 'block',
							],
						],
					],
					[
						'key' => 'clone_buttons_buttons_group_phone',
						'name' => 'phone',
						'label' => esc_html__('Telefoonnummer', 'wesselvandenijssel'),
						'display' => 'block',
						'sub_fields' => [
							[
								'key' => 'clone_buttons_buttons_group_phone_title_attr',
								'label' => esc_html__('Title attribuut', 'wesselvandenijssel'),
								'name' => 'title_attr',
								'type' => 'text',
							],
						],
					],
				]
			],
			[
				'key' => 'clone_buttons_singular_button',
				'label' => esc_html__('Button', 'wesselvandenijssel'),
				'name' => 'singular_button',
				'type' => 'group',
				'layout' => 'block',
				'sub_fields' => [
					[
						'key' => 'clone_buttons_singular_button_display',
						'label' => esc_html__('Weergave', 'wesselvandenijssel'),
						'name' => 'display',
						'type' => 'select',
						'choices' => [
							'always' => esc_html__('Altijd', 'wesselvandenijssel'),
							'phone' => esc_html__('Alleen op telefoon', 'wesselvandenijssel'),
							'desktop' => esc_html__('Alleen op desktop', 'wesselvandenijssel'),
						],
						'wrapper' => [
							'width' => '50',
						],
					],
					[
						'key' => 'clone_buttons_singular_button_button_type',
						'label' => esc_html__('Type', 'wesselvandenijssel'),
						'name' => 'button_type',
						'type' => 'select',
						'wrapper' => [
							'width' => '50',
						],
						'choices' => [
							'link' => 'link',
							'popup' => 'popup',
						],
						'return_format' => 'value',
					],
					[
						'key' => 'clone_buttons_singular_button_button_text',
						'label' => esc_html__('Tekst', 'wesselvandenijssel'),
						'name' => 'button_text',
						'type' => 'text',
						'wrapper' => [
							'width' => '50',
						],
					],
					[
						'key' => 'clone_buttons_singular_button_button_link',
						'label' => esc_html__('Link', 'wesselvandenijssel'),
						'name' => 'button_link',
						'type' => 'link',
						'conditional_logic' => [
							[
								[
									'field' => 'clone_buttons_singular_button_button_type',
									'operator' => '==',
									'value' => 'link',
								],
							],
						],
						'wrapper' => [
							'width' => '50',
						],
						'return_format' => 'array',
					],
					[
						'key' => 'clone_buttons_singular_button_button_popup',
						'label' => esc_html__('Popup', 'wesselvandenijssel'),
						'name' => 'button_popup',
						'type' => 'select',
						'conditional_logic' => [
							[
								[
									'field' => 'clone_buttons_singular_button_button_type',
									'operator' => '==',
									'value' => 'popup',
								],
							],
						],
						'wrapper' => [
							'width' => '33',
						],
						'choices' => [],
						'return_format' => 'value',
					],
					[
						'key' => 'clone_buttons_singular_button_icon_before',
						'label' => esc_html__('Icoon voor', 'wesselvandenijssel'),
						'name' => 'icon_before',
						'type' => 'font-awesome',
						'custom_icon_set' => 'ACFFA_custom_icon_list_v6_Icons',
						'icon_sets' => [
							'custom',
						],
						'return_format' => 'value',
						'wrapper' => [
							'width' => '50',
						],
					],
					[
						'key' => 'clone_buttons_singular_button_icon_after',
						'label' => esc_html__('Icoon na', 'wesselvandenijssel'),
						'name' => 'icon_after',
						'type' => 'font-awesome',
						'custom_icon_set' => 'ACFFA_custom_icon_list_v6_Icons',
						'icon_sets' => [
							'custom',
						],
						'return_format' => 'value',
						'wrapper' => [
							'width' => '50',
						],
					],
				],
			],
		],
	]);
endif;
