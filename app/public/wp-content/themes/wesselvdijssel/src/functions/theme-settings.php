<?php

defined('ABSPATH') || exit('Forbidden');

add_action('acf/init', function () {
	acf_add_options_page([
		'page_title' => esc_html__('Thema-instellingen', 'wesselvandenijssel'),
		'menu_title' => esc_html__('Thema-instellingen', 'wesselvandenijssel'),
		'menu_slug' => 'theme-settings',
		'icon_url' => 'dashicons-admin-generic',
		'redirect' => true
	]);

	// Basic details
	acf_add_options_page([
		'page_title' => esc_html__('Basisgegevens', 'wesselvandenijssel'),
		'menu_title' => esc_html__('Basisgegevens', 'wesselvandenijssel'),
		'menu_slug' => 'basic-details',
		'capability' => 'edit_posts',
		'parent_slug' => 'theme-settings',
	]);

	acf_add_local_field_group([
		'key' => 'theme_settings_basic_details',
		'title' => esc_html__('Basisgegevens', 'wesselvandenijssel'),
		'fields' => [
			[
				'key' => 'theme_settings_logo',
				'name' => 'logo',
				'label' => esc_html__('Logo', 'wesselvandenijssel'),
				'type' => 'image',
				'mime_types' => 'svg, png, jpg, jpeg, webp',
				'return_format' => 'id',
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'theme_settings_contact_details',
				'name' => 'contact_details',
				'label' => esc_html__('Contactgegevens', 'wesselvandenijssel'),
				'type' => 'group',
				'sub_fields' => [
					[
						'key' => 'theme_settings_contact_details_phone',
						'name' => 'phone',
						'type' => 'text',
						'label' => esc_html__('Telefoonnummer', 'wesselvandenijssel'),
						'wrapper' => [
							'width' => '25',
						],
					],

					[
						'key' => 'theme_settings_contact_details_phone_link',
						'name' => 'phone_link',
						'type' => 'link',
						'label' => esc_html__('Telefoonnummer (link)', 'wesselvandenijssel'),
						'wrapper' => [
							'width' => '25',
						],
					],

					[
						'key' => 'theme_settings_contact_details_email',
						'name' => 'email',
						'type' => 'email',
						'label' => esc_html__('E-mailadres', 'wesselvandenijssel'),
						'wrapper' => [
							'width' => '25',
						],
					],

					[
						'key' => 'theme_settings_contact_details_email_link',
						'name' => 'email_link',
						'type' => 'link',
						'label' => esc_html__('E-mailadres (link)', 'wesselvandenijssel'),
						'wrapper' => [
							'width' => '25',
						],
					],

					[
						'key' => 'theme_settings_contact_details_address_data',
						'name' => 'address_data',
						'label' => esc_html__('Adresgegevens', 'wesselvandenijssel'),
						'type' => 'group',
						'sub_fields' => [

							[
								'key' => 'theme_settings_contact_details_address_data_street',
								'name' => 'street',
								'type' => 'text',
								'label' => esc_html__('Straatnaam + huisnummer', 'wesselvandenijssel'),
								'wrapper' => [
									'width' => '20',
								],
							],

							[
								'key' => 'theme_settings_contact_details_address_data_city',
								'name' => 'city',
								'type' => 'text',
								'label' => esc_html__('Plaatsnaam', 'wesselvandenijssel'),
								'wrapper' => [
									'width' => '20',
								],
							],

							[
								'key' => 'theme_settings_contact_details_address_data_county',
								'name' => 'county',
								'type' => 'text',
								'label' => esc_html__('Provincie', 'wesselvandenijssel'),
								'wrapper' => [
									'width' => '20',
								],
							],

							[
								'key' => 'theme_settings_contact_details_address_data_zip',
								'name' => 'zip',
								'type' => 'text',
								'label' => esc_html__('Postcode', 'wesselvandenijssel'),
								'wrapper' => [
									'width' => '20',
								],
							],

							[
								'key' => 'theme_settings_contact_details_address_data_link',
								'name' => 'link',
								'type' => 'link',
								'label' => esc_html__('Link', 'wesselvandenijssel'),
								'wrapper' => [
									'width' => '20',
								],
							],
						],
					],

				],
			],
			[
				'key' => 'theme_settings_awards',
				'name' => 'awards',
				'label' => esc_html__('Awards', 'wesselvandenijssel'),
				'type' => 'repeater',
				'sub_fields' => [
					[
						'key' => 'theme_settings_awards_award',
						'name' => 'award',
						'type' => 'text',
						'label' => esc_html__('Award', 'wesselvandenijssel'),
					],
				],
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'theme_settings_founder',
				'name' => 'founder',
				'label' => esc_html__('Oprichter', 'wesselvandenijssel'),
				'type' => 'user',
				'wrapper' => [
					'width' => '25',
				],
			],
			[
				'key' => 'theme_settings_founding_year',
				'name' => 'founding_year',
				'label' => esc_html__('Oprichtingsjaar', 'wesselvandenijssel'),
				'type' => 'number',
				'wrapper' => [
					'width' => '25',
				],
			],
			[
				'key' => 'theme_settings_social_media',
				'name' => 'social_media',
				'label' => esc_html__('Social media', 'wesselvandenijssel'),
				'type' => 'group',
				'sub_fields' => [
					[
						'key' => 'theme_settings_social_media_facebook',
						'name' => 'facebook',
						'type' => 'link',
						'label' => esc_html__('Facebook', 'wesselvandenijssel'),
						'wrapper' => [
							'width' => '25',
						],
					],

					[
						'key' => 'theme_settings_social_media_instagram',
						'name' => 'instagram',
						'type' => 'link',
						'label' => esc_html__('Instagram', 'wesselvandenijssel'),
						'wrapper' => [
							'width' => '25',
						],
					],

					[
						'key' => 'theme_settings_social_media_linkedin',
						'name' => 'linkedin',
						'type' => 'link',
						'label' => esc_html__('LinkedIn', 'wesselvandenijssel'),
						'wrapper' => [
							'width' => '25',
						],
					],

					[
						'key' => 'theme_settings_social_media_twitter',
						'name' => 'twitter',
						'type' => 'link',
						'label' => esc_html__('Twitter', 'wesselvandenijssel'),
						'wrapper' => [
							'width' => '25',
						],
					],

					[
						'key' => 'theme_settings_social_media_tiktok',
						'name' => 'tiktok',
						'type' => 'link',
						'label' => esc_html__('TikTok', 'wesselvandenijssel'),
						'wrapper' => [
							'width' => '25',
						],
					],
				]
			],
		],

		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'basic-details',
				],
			],
		],
	]);


	// Footer
	acf_add_options_page([
		'page_title' => esc_html__('Footer', 'wesselvandenijssel'),
		'menu_title' => esc_html__('Footer', 'wesselvandenijssel'),
		'menu_slug' => 'footer',
		'post_id' => 'footer',
		'parent_slug' => 'theme-settings',
	]);

	acf_add_local_field_group([
		'key' => 'theme_settings_footer',
		'title' => esc_html__('Footer', 'wesselvandenijssel'),
		'fields' => [
			[
				'key' => 'theme_settings_footer_group',
				'label' => esc_html__('Footer', 'wesselvandenijssel'),
				'name' => 'footer',
				'type' => 'group',
				'layout' => 'block',
				'sub_fields' => [
					[
						'key' => 'theme_settings_footer_group_column',
						'type' => 'group',
						'label' => esc_html__('Footer groepen', 'wesselvandenijssel'),
						'name' => 'footer_column',
						'sub_fields' => [
							[
								'key' => 'theme_settings_footer_group_column_column_one',
								'label' => esc_html__('Kolom 1', 'wesselvandenijssel'),
								'name' => 'column_1',
								'type' => 'clone',
								'clone' => ['clone_footer_column'],
								'prefix_name' => true,
							],
							[
								'key' => 'theme_settings_footer_group_column_column_two',
								'label' => esc_html__('Kolom 2', 'wesselvandenijssel'),
								'name' => 'column_2',
								'type' => 'clone',
								'clone' => ['clone_footer_column'],
								'prefix_name' => true,
							],
							[
								'key' => 'theme_settings_footer_group_column_column_three',
								'label' => esc_html__('Kolom 3', 'wesselvandenijssel'),
								'name' => 'column_3',
								'type' => 'clone',
								'clone' => ['clone_footer_column'],
								'prefix_name' => true,
							],
							[
								'key' => 'theme_settings_footer_group_column_column_four',
								'label' => esc_html__('Kolom 4', 'wesselvandenijssel'),
								'name' => 'column_4',
								'type' => 'clone',
								'clone' => ['clone_footer_column'],
								'prefix_name' => true,
							],
						],
					],
					[
						'key' => 'theme_settings_footer_group_sub_footer',
						'label' => esc_html__('Subfooter', 'wesselvandenijssel'),
						'name' => 'sub_footer',
						'type' => 'wysiwyg',
						'delay' => true,
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'footer',
				],
			],
		],
	]);


	// Header
	acf_add_options_page([
		'page_title' 	=> esc_html__('Header', 'wesselvandenijssel'),
		'menu_title'	=> esc_html__('Header', 'wesselvandenijssel'),
		'menu_slug' 	=> 'header',
		'capability'	=> 'edit_posts',
		'parent_slug'	=> 'theme-settings',
	]);

	acf_add_local_field_group([
		'key' => 'theme_settings_header',
		'title' => esc_html__('Header', 'wesselvandenijssel'),
		'fields' => [
			[
				'key' => 'theme_settings_header_group',
				'name' => 'header',
				'label' => esc_html__('Header', 'wesselvandenijssel'),
				'type' => 'group',
				'sub_fields' => [
					[
						'key' => 'theme_settings_header_group_usps',
						'label' => esc_html__('USP\'s', 'wesselvandenijssel'),
						'name' => 'usps',
						'type' => 'repeater',
						'button_label' => esc_html__('Nieuwe USP', 'wesselvandenijssel'),
						'sub_fields' => [
							[
								'key' => 'theme_settings_header_group_usps_usp',
								'label' => esc_html__('USP', 'wesselvandenijssel'),
								'name' => 'usp',
								'type' => 'text',
							],
							[
								'key' => 'theme_settings_header_group_usps_link',
								'label' => esc_html__('Link', 'wesselvandenijssel'),
								'name' => 'link',
								'type' => 'link',
							],
						],
					],
					[
						'key' => 'theme_settings_header_group_buttons',
						'label' => esc_html__('Button(s)', 'wesselvandenijssel'),
						'name' => 'buttons_clone',
						'type' => 'clone',
						'clone' => [
							'clone_buttons_buttons_group',
						],
					],
				]
			],
		],

		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'header',
				],
			],
		],
	]);


	// Notification
	acf_add_options_page([
		'page_title' => esc_html__('Melding', 'wesselvandenijssel'),
		'menu_title' => esc_html__('Melding', 'wesselvandenijssel'),
		'menu_slug' => 'notification',
		'capability' => 'edit_posts',
		'parent_slug' => 'theme-settings',
	]);

	acf_add_local_field_group([
		'key' => 'theme_settings_notification',
		'title' => esc_html__('Melding', 'wesselvandenijssel'),
		'fields' => [
			[
				'key' => 'theme_settings_notification_group',
				'label' => esc_html__('Melding', 'wesselvandenijssel'),
				'name' => 'notification',
				'type' => 'group',
				'sub_fields' => [
					[
						'key' => 'theme_settings_notification_group_text',
						'label' => esc_html__('Tekst', 'wesselvandenijssel'),
						'name' => 'text',
						'type' => 'text',
						'wrapper' => [
							'width' => 50,
						],
					],
					[
						'key' => 'theme_settings_notification_group_show_from',
						'label' => esc_html__('Weergeven van', 'wesselvandenijssel'),
						'name' => 'show_from',
						'type' => 'date_time_picker',
						'wrapper' => [
							'width' => '25',
						],
						'display_format' => 'd-m-Y H:i:s',
						'return_format' => 'd-m-Y H:i:s',
					],
					[
						'key' => 'theme_settings_notification_group_show_until',
						'label' => esc_html__('Weergeven tot', 'wesselvandenijssel'),
						'name' => 'show_until',
						'type' => 'date_time_picker',
						'wrapper' => [
							'width' => '25',
						],
						'display_format' => 'd-m-Y H:i:s',
						'return_format' => 'd-m-Y H:i:s',
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'notification',
				],
			],
		],
	]);


	// Not found
	acf_add_options_page([
		'page_title' => esc_html__('Niet gevonden pagina', 'wesselvandenijssel'),
		'menu_title' => esc_html__('Niet gevonden pagina', 'wesselvandenijssel'),
		'menu_slug' => 'not_found',
		'capability' => 'edit_posts',
		'parent_slug' => 'theme-settings',
	]);

	acf_add_local_field_group([
		'key' => 'theme_settings_not_found',
		'title' => esc_html__('Niet gevonden pagina', 'wesselvandenijssel'),
		'fields' => [
			[
				'key' => 'theme_settings_not_found_group',
				'label' => esc_html__('Niet gevonden pagina', 'wesselvandenijssel'),
				'name' => 'not_found',
				'type' => 'group',
				'layout' => 'block',
				'sub_fields' => [
					get_flex_content('theme_settings_not_found_group')
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'not_found',
				],
			],
		],
	]);


	// Scripts
	acf_add_options_page([
		'page_title' => esc_html__('Scripts', 'wesselvandenijssel'),
		'menu_title' => esc_html__('Scripts', 'wesselvandenijssel'),
		'menu_slug' => 'scripts',
		'post_id' => 'scripts',
		'parent_slug' => 'theme-settings',
	]);

	acf_add_local_field_group([
		'key' => 'theme_settings_scripts',
		'title' => esc_html__('Scripts', 'wesselvandenijssel'),
		'fields' => [
			[
				'key' => 'theme_settings_scripts_head',
				'label' => esc_html__('&lt;head&gt;-scripts', 'wesselvandenijssel'),
				'instructions' => wp_kses_post(__('Dit veld wordt bovenaan de &lt;head&gt; geplaatst.', 'wesselvandenijssel')),
				'name' => 'head',
				'type' => 'textarea',
				'new_lines' => '',
				'wrapper' => [
					'width' => '50',
				],
			],
			[
				'key' => 'theme_settings_scripts_body',
				'label' => esc_html__('&lt;body&gt;-scripts', 'wesselvandenijssel'),
				'instructions' => wp_kses_post(__('Dit veld wordt bovenaan de &lt;body&gt; geplaatst.', 'wesselvandenijssel')),
				'name' => 'body',
				'type' => 'textarea',
				'new_lines' => '',
				'wrapper' => [
					'width' => '50',
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'scripts',
				],
			],
		],
	]);

	// Basic details
	acf_add_options_page([
		'page_title' => esc_html__('Utilities', 'wesselvandenijssel'),
		'menu_title' => esc_html__('Utilities', 'wesselvandenijssel'),
		'menu_slug' => 'utilities',
		'post_id' => 'utilities',
		'parent_slug' => 'theme-settings',
	]);

	acf_add_local_field_group([
		'key' => 'theme_settings_utilities',
		'title' => esc_html__('Utilities', 'wesselvandenijssel'),
		'fields' => [
			[
				'key' => 'theme_settings_utilities_image_settings_group',
				'label' => esc_html__('Instellingen', 'wesselvandenijssel'),
				'name' => 'image_settings_group',
				'type' => 'group',
				'sub_fields' => [
					[
						'key' => 'theme_settings_utilities_image_settings_group_focuspoint',
						'type' => 'true_false',
						'label' => esc_html__('Focuspoint aanzetten', 'wesselvandenijssel'),
						'name' => 'focuspoint',
						'ui' => true,
						'default_value' => true,
					],
					[
						'key' => 'theme_settings_utilities_image_settings_group_webp',
						'type' => 'true_false',
						'label' => esc_html__('Webp optimalisatie aanzetten', 'wesselvandenijssel'),
						'name' => 'webp',
						'ui' => true,
						'default_value' => true,
						'instructions' => esc_html__('Alle verkleinde bestanden worden omgezet naar webP formaat, de originele afbeelding blijft ook nog beschikbaar', 'wesselvandenijssel'),
					],
					[
						'key' => 'theme_settings_utilities_image_settings_group_thumbnails',
						'type' => 'true_false',
						'label' => esc_html__('Thumbnails inschakelen', 'wesselvandenijssel'),
						'name' => 'thumbnails',
						'ui' => true,
						'default_value' => false,
					],
				],
			],
			[
				'key' => 'theme_settings_utilities_blocks',
				'label' => esc_html__('ACF Blocks', 'wesselvandenijssel'),
				'name' => 'blocks',
				'type' => 'group',
				'sub_fields' => [
					[
						'key' => 'theme_settings_utilities_blocks_version',
						'label' => esc_html__('Block versie', 'wesselvandenijssel'),
						'name' => 'version',
						'type' => 'button_group',
						'choices' => [
							2 => esc_html__('V2', 'wesselvandenijssel'),
							3 => esc_html__('V3', 'wesselvandenijssel'),
						],
						'default_value' => 3,
					],
				],
			],
			[
				'key' => 'theme_settings_utilities_preconnect',
				'label' => __('Preconnect hints', 'wesselvandenijssel'),
				'name' => 'preconnect',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => __('URL toevoegen', 'wesselvandenijssel'),
				'instructions' => __('Externe domeinen waarmee de browser vroegtijdig verbinding maakt, bijv. https://consentcdn.cookiebot.eu of https://tagging.domein.nl', 'wesselvandenijssel'),
				'sub_fields' => [
					[
						'key' => 'theme_settings_utilities_preconnect_url',
						'label' => __('URL', 'wesselvandenijssel'),
						'name' => 'url',
						'type' => 'url',
					],
				],
			],
		],

		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'utilities',
				],
			],
		],
	]);
});
