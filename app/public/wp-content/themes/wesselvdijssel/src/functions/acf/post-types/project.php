<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * Registers the fixed project fields (assignment, role, approach, result, images) shown on single-project.php.
 */
add_action('acf/init', 'wesselvandenijssel_project_fields');
function wesselvandenijssel_project_fields(): void {
	acf_add_local_field_group([
		'key' => 'group_project_details',
		'title' => esc_html__('Projectgegevens', 'wesselvandenijssel'),
		'position' => 'acf_after_title',
		'style' => 'default',
		'location' => [
			[
				[
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'project',
				],
			],
		],
		'fields' => [
			[
				'key' => 'project_details_client',
				'name' => 'client',
				'label' => esc_html__('Opdrachtgever', 'wesselvandenijssel'),
				'type' => 'text',
				'wrapper' => ['width' => '50'],
			],
			[
				'key' => 'project_details_period',
				'name' => 'period',
				'label' => esc_html__('Periode', 'wesselvandenijssel'),
				'type' => 'text',
				'placeholder' => esc_html__('Bijvoorbeeld: maart 2024', 'wesselvandenijssel'),
				'wrapper' => ['width' => '50'],
			],
			[
				'key' => 'project_details_website',
				'name' => 'website',
				'label' => esc_html__('Website', 'wesselvandenijssel'),
				'type' => 'url',
				'wrapper' => ['width' => '50'],
			],
			[
				'key' => 'project_details_tools',
				'name' => 'tools',
				'label' => esc_html__('Tools en technieken', 'wesselvandenijssel'),
				'instructions' => esc_html__('Scheid met komma\'s, bijvoorbeeld: WordPress, ACF, SCSS', 'wesselvandenijssel'),
				'type' => 'text',
				'wrapper' => ['width' => '50'],
			],
			[
				'key' => 'project_details_assignment',
				'name' => 'assignment',
				'label' => esc_html__('De opdracht', 'wesselvandenijssel'),
				'type' => 'wysiwyg',
				'toolbar' => 'basic',
				'media_upload' => false,
				'delay' => true,
			],
			[
				'key' => 'project_details_role',
				'name' => 'role',
				'label' => esc_html__('Mijn rol', 'wesselvandenijssel'),
				'type' => 'wysiwyg',
				'toolbar' => 'basic',
				'media_upload' => false,
				'delay' => true,
			],
			[
				'key' => 'project_details_approach',
				'name' => 'approach',
				'label' => esc_html__('Aanpak', 'wesselvandenijssel'),
				'type' => 'wysiwyg',
				'toolbar' => 'basic',
				'media_upload' => false,
				'delay' => true,
			],
			[
				'key' => 'project_details_result',
				'name' => 'result',
				'label' => esc_html__('Resultaat', 'wesselvandenijssel'),
				'type' => 'wysiwyg',
				'toolbar' => 'basic',
				'media_upload' => false,
				'delay' => true,
			],
			[
				'key' => 'project_details_images',
				'name' => 'images',
				'label' => esc_html__('Beelden', 'wesselvandenijssel'),
				'instructions' => esc_html__('Extra beelden naast de uitgelichte afbeelding. Vul bij elke afbeelding een Nederlandse alt-tekst in.', 'wesselvandenijssel'),
				'type' => 'gallery',
				'return_format' => 'id',
				'mime_types' => 'png,jpeg,jpg,webp',
			],
		],
	]);
}
