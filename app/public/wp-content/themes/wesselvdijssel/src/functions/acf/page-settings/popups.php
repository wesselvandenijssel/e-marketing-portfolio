<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

add_action('acf/init', function () {
	acf_add_local_field_group([
		'key' => 'settings_popup',
		'title' => esc_html__('Pop-up instellingen', 'wesselvandenijssel'),
		'fields' => [

			get_flex_content('settings_popup_content'),

		],
		'location' => [
			[
				[
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'popup',
				],
			],
		],
	]);
});
