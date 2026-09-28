<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

// Flush rewrite rules for custom post types
add_action('after_switch_theme', 'bones_flush_rewrite_rules');

// Flush your rewrite rules
function bones_flush_rewrite_rules() {
	flush_rewrite_rules();
}

function custom_product() {
	register_post_type(
		'product', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		[
			'labels' => [
				'name' => esc_html__('Producten', 'wesselvandenijssel'),
				'singular_name' => esc_html__('Product', 'wesselvandenijssel'),
				'all_items' => esc_html__('Alle producten', 'wesselvandenijssel'),
				'add_new' => esc_html__('Nieuw product', 'wesselvandenijssel'),
				'add_new_item' => esc_html__('Nieuw product', 'wesselvandenijssel'),
				'edit' => esc_html__('Bewerken', 'wesselvandenijssel'),
				'edit_item' => esc_html__('Product bewerken', 'wesselvandenijssel'),
				'new_item' => esc_html__('Nieuw product', 'wesselvandenijssel'),
				'view_item' => esc_html__('Product bekijken', 'wesselvandenijssel'),
				'search_items' => esc_html__('Producten zoeken', 'wesselvandenijssel'),
				'not_found' => esc_html__('Geen producten gevonden.', 'wesselvandenijssel'),
				'not_found_in_trash' => esc_html__('Geen producten gevonden', 'wesselvandenijssel'),
				'parent_item_colon' => ''
			],
			'description' => '',
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8,
			'menu_icon' => 'dashicons-store',
			'rewrite' => ['slug' => 'product', 'with_front' => false],
			'has_archive' => '',
			'capability_type' => 'post',
			'hierarchical' => true,
			'show_in_rest' => true,
			'supports' => [
				'title',
				'thumbnail',
				'custom-fields',
				'revisions',
				'page-attributes'
			]
		]
	);
}
// add_action('init', 'custom_product');

/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/

// register_taxonomy(
// 	'product_category',
// 	['product'],
// 	[
// 		'hierarchical' => true, // True for categories, false for tags
// 		'labels' => [
// 			'name' => esc_html__('Productcategorieën', 'wesselvandenijssel'),
// 			'singular_name' => esc_html__('Productcategorie', 'wesselvandenijssel'),
// 			'search_items' => esc_html__('Zoek productcategorie', 'wesselvandenijssel'),
// 			'all_items' => esc_html__('Alle productcategorieën', 'wesselvandenijssel'),
// 			'parent_item' => esc_html__('Parent productcategorie', 'wesselvandenijssel'),
// 			'parent_item_colon' => esc_html__('Parent productcategorie:', 'wesselvandenijssel'),
// 			'edit_item' => esc_html__('Productcategorie bewerken', 'wesselvandenijssel'),
// 			'update_item' => esc_html__('Productcategorie updaten', 'wesselvandenijssel'),
// 			'add_new_item' => esc_html__('Nieuwe productcategorie', 'wesselvandenijssel'),
// 			'new_item_name' => esc_html__('Nieuwe productcategorie', 'wesselvandenijssel')
// 		],
// 		'show_admin_column' => true,
// 		'show_in_rest' => true,
// 		'show_ui' => true,
// 		'query_var' => true,
// 	]
// );

// register_taxonomy(
// 	'product_tag',
// 	['product'],
// 	[
// 		'hierarchical' => false, // True for categories, false for tags
// 		'labels' => [
// 			'name' => esc_html__('Tags', 'wesselvandenijssel'),
// 			'singular_name' => esc_html__('Tag', 'wesselvandenijssel'),
// 			'search_items' => esc_html__('Zoek tag', 'wesselvandenijssel'),
// 			'all_items' => esc_html__('Alle tags', 'wesselvandenijssel'),
// 			'parent_item' => esc_html__('Parent tag', 'wesselvandenijssel'),
// 			'parent_item_colon' => esc_html__('Parent tag:', 'wesselvandenijssel'),
// 			'edit_item' => esc_html__('Tag bewerken', 'wesselvandenijssel'),
// 			'update_item' => esc_html__('Tag updaten', 'wesselvandenijssel'),
// 			'add_new_item' => esc_html__('Nieuwe tag', 'wesselvandenijssel'),
// 			'new_item_name' => esc_html__('Nieuwe tag', 'wesselvandenijssel')
// 		],
// 		'show_admin_column' => true,
// 		'show_in_rest' => true,
// 		'show_ui' => true,
// 		'query_var' => true,
// 	]
// );


function custom_popups() {
	register_post_type(
		'popup', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		[
			'labels' => [
				'name' => esc_html__('Pop-ups', 'wesselvandenijssel'),
				'singular_name' => esc_html__('Pop-up', 'wesselvandenijssel'),
				'all_items' => esc_html__('Alle pop-ups', 'wesselvandenijssel'),
				'add_new' => esc_html__('Nieuwe pop-up', 'wesselvandenijssel'),
				'add_new_item' => esc_html__('Nieuwe pop-up', 'wesselvandenijssel'),
				'edit' => esc_html__('Bewerken', 'wesselvandenijssel'),
				'edit_item' => esc_html__('Pop-up bewerken', 'wesselvandenijssel'),
				'new_item' => esc_html__('Nieuwe pop-up', 'wesselvandenijssel'),
				'view_item' => esc_html__('Pop-up bekijken', 'wesselvandenijssel'),
				'search_items' => esc_html__('Pop-ups zoeken', 'wesselvandenijssel'),
				'not_found' => esc_html__('Geen pop-ups gevonden.', 'wesselvandenijssel'),
				'not_found_in_trash' => esc_html__('Geen pop-ups gevonden', 'wesselvandenijssel'),
				'parent_item_colon' => ''
			],
			'description' => '',
			'public' => false,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8,
			'menu_icon' => 'dashicons-slides',
			'rewrite' => ['slug' => 'popup', 'with_front' => false],
			'has_archive' => '',
			'capability_type' => 'post',
			'hierarchical' => true,
			'show_in_rest' => false,
			'supports' => [
				'title',
			]
		]
	);
}
add_action('init', 'custom_popups');
