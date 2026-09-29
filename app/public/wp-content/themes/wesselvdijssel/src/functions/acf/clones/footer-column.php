<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

add_action('acf/init', function () {
	acf_add_local_field_group([
		'key' => 'clone_footer_column',
		'title' => esc_html__('Kloon: Footer kolom', 'wesselvandenijssel'),
		'fields' => [
			[
				'key' => 'clone_footer_column_content',
				'label' => esc_html__('Footer kolom', 'wesselvandenijssel'),
				'name' => 'footer_column',
				'type' => 'flexible_content',
				'button_label' => esc_html__('Nieuwe contentregel', 'wesselvandenijssel'),
				'layouts' => [
					[
						'key' => 'clone_footer_column_content_layout_title',
						'name' => 'title',
						'label' => esc_html__('Titel', 'wesselvandenijssel'),
						'display' => 'block',
						'sub_fields' => [
							[
								'key' => 'clone_footer_column_content_layout_title_title',
								'label' => esc_html__('Titel', 'wesselvandenijssel'),
								'name' => 'title',
								'type' => 'wysiwyg',
								'tabs' => 'visual',
								'toolbar' => 'title',
								'media_upload' => false,
								'delay' => true,
							],

							[
								'key' => 'clone_footer_column_content_layout_title_title_type',
								'label' => esc_html__('Type titel', 'wesselvandenijssel'),
								'name' => 'title_type',
								'type' => 'select',
								'wrapper' => [
									'width' => '50',
								],
								'choices' => [
									'default' => esc_html__('Standaard', 'wesselvandenijssel'),
									'h1' => esc_html__('h1', 'wesselvandenijssel'),
									'h2' => esc_html__('h2', 'wesselvandenijssel'),
									'h3' => esc_html__('h3', 'wesselvandenijssel'),
									'h4' => esc_html__('h4', 'wesselvandenijssel'),
								],
								'default_value' => 'h4',
								'return_format' => 'value',
							],
						],
					],

					[
						'key' => 'clone_footer_column_content_layout_text',
						'name' => 'text',
						'label' => esc_html__('Tekst', 'wesselvandenijssel'),
						'display' => 'block',
						'sub_fields' => [
							[
								'key' => 'clone_footer_column_content_layout_text_text',
								'label' => esc_html__('Tekst', 'wesselvandenijssel'),
								'name' => 'text',
								'type' => 'wysiwyg',
								'tabs' => 'visual',
								'toolbar' => 'basic',
								'media_upload' => false,
								'delay' => true,
							],
						],
					],

					[
						'key' => 'clone_footer_column_content_layout_image',
						'name' => 'image',
						'label' => esc_html__('Afbeelding', 'wesselvandenijssel'),
						'display' => 'block',
						'sub_fields' => [
							[
								'key' => 'clone_footer_column_content_layout_image_image',
								'label' => esc_html__('Afbeelding', 'wesselvandenijssel'),
								'type' => 'clone',
								'clone' => [
									'clone_image_image_group',
								],
								'name' => 'image',

							],
						],
					],
					[
						'key' => 'clone_footer_column_content_layout_contact_details',
						'name' => 'contact_details',
						'label' => esc_html__('Contactgegevens', 'wesselvandenijssel'),
						'display' => 'block',
						'sub_fields' => [
							[
								'key' => 'clone_footer_column_content_layout_contact_details_checkbox',
								'label' => esc_html__('Contactgegevens', 'wesselvandenijssel'),
								'name' => 'contact_details',
								'type' => 'checkbox',
								'choices' => [
									'phone' => esc_html__('Telefoonnummer', 'wesselvandenijssel'),
									'email' => esc_html__('E-mailadres', 'wesselvandenijssel'),
									'address' => esc_html__('Adres', 'wesselvandenijssel'),
								],
								'layout' => 'vertical',
								'return_format' => 'value',
							],
						],
					],
					[
						'key' => 'clone_footer_column_content_layout_social_media',
						'name' => 'social_media',
						'label' => esc_html__('Social media', 'wesselvandenijssel'),
						'display' => 'block',
					],
					[
						'key' => 'clone_footer_column_content_layout_menu',
						'name' => 'menu',
						'label' => esc_html__('Menu', 'wesselvandenijssel'),
						'display' => 'block',
						'sub_fields' => [
							[
								'key' => 'clone_footer_column_content_layout_menu_menu',
								'label' => esc_html__('Menu', 'wesselvandenijssel'),
								'name' => 'menu',
								'type' => 'select',
								'choices' => array_merge(
									['none' => esc_html__('Geen', 'wesselvandenijssel')],
									wp_get_nav_menus([
										'fields' => 'names'
									])
								),
								'return_format' => 'label',
								'wrapper' => [
									'width' => '25',
								],
							],
							[
								'key' => 'clone_footer_column_content_layout_menu_foldable',
								'label' => esc_html__('Uitklapbaar', 'wesselvandenijssel'),
								'name' => 'foldable',
								'type' => 'true_false',
								'ui_on_text' => esc_html__('Ja', 'wesselvandenijssel'),
								'ui_off_text' => esc_html__('Nee', 'wesselvandenijssel'),
								'ui' => true,
								'wrapper' => [
									'width' => '25',
								],
							],
							[
								'key' => 'clone_footer_column_content_layout_menu_foldable_text',
								'label' => esc_html__('"Toon meer" tekst', 'wesselvandenijssel'),
								'name' => 'foldable_text',
								'type' => 'text',
								'default_value' => esc_html__('Toon meer', 'wesselvandenijssel'),
								'wrapper' => [
									'width' => '25',
								],
								'conditional_logic' => [
									[
										[
											'field' => 'clone_footer_column_content_layout_menu_foldable',
											'operator' => '==',
											'value' => 1,
										],
									],
								],
							],
							[
								'key' => 'clone_footer_column_content_layout_menu_visible_amount',
								'label' => esc_html__('Aantal zichtbare menu-items', 'wesselvandenijssel'),
								'name' => 'visible_amount',
								'type' => 'number',
								'default_value' => 4,
								'wrapper' => [
									'width' => '25',
								],
								'conditional_logic' => [
									[
										[
											'field' => 'clone_footer_column_content_layout_menu_foldable',
											'operator' => '==',
											'value' => 1,
										],
									],
								],
							],
						],
					],
				],
			],
		],
	]);
});
