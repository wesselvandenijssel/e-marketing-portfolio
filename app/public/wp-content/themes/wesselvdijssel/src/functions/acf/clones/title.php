<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.


if (function_exists('acf_add_local_field_group')) :

	acf_add_local_field_group([
		'key' => 'clone_titles',
		'title' => esc_html__('Kloon: Titel', 'wesselvandenijssel'),
		'fields' => [
			[
				'key' => 'clone_titles_block_title',
				'label' => esc_html__('Titel', 'wesselvandenijssel'),
				'name' => 'block_title',
				'type' => 'group',
				'layout' => 'block',
				'sub_fields' => [
					[
						'key' => 'clone_titles_block_title_main_title',
						'label' => esc_html__('Titel', 'wesselvandenijssel'),
						'name' => 'main_title',
						'type' => 'wysiwyg',
						'tabs' => 'visual',
						'toolbar' => 'title',
						'media_upload' => false,
						'delay' => true,
						'wrapper' => [
							'width' => '50',
						],
					],
					[
						'key' => 'clone_titles_block_title_subtitle',
						'label' => esc_html__('Ondertitel', 'wesselvandenijssel'),
						'name' => 'subtitle',
						'type' => 'wysiwyg',
						'tabs' => 'visual',
						'toolbar' => 'title',
						'delay' => true,
						'media_upload' => false,
						'wrapper' => [
							'width' => '50',
						],
					],
					[
						'key' => 'clone_titles_block_title_group_title_type',
						'label' => esc_html__('Type titel', 'wesselvandenijssel'),
						'name' => 'type',
						'type' => 'select',
						'wrapper' => [
							'width' => '50',
						],
						'choices' => [
							'default' => esc_html__('Standaard', 'wesselvandenijssel'),
							'h1' => esc_html__('h1', 'wesselvandenijssel'),
							'h2' => esc_html__('h2', 'wesselvandenijssel'),
							'h3' => esc_html__('h3', 'wesselvandenijssel'),
						],
						'default_value' => 'default',
						'return_format' => 'value',
					],
				],
			],
		],
	]);
endif;
