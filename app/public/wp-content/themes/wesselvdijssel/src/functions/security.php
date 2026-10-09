<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * Removes the user endpoints from the REST API for visitors who are not logged in.
 *
 * @param array $endpoints The registered REST routes
 * @return array
 */
function wesselvandenijssel_hide_rest_users(array $endpoints): array {
	if (is_user_logged_in()) return $endpoints;

	foreach (array_keys($endpoints) as $route) {
		if (str_starts_with($route, '/wp/v2/users')) {
			unset($endpoints[$route]);
		}
	}

	return $endpoints;
}
add_filter('rest_endpoints', 'wesselvandenijssel_hide_rest_users');

add_filter('xmlrpc_enabled', '__return_false');

/**
 * Removes the XML-RPC discovery links from the page head, since XML-RPC is disabled.
 */
function wesselvandenijssel_remove_xmlrpc_links(): void {
	remove_action('wp_head', 'rsd_link');
}
add_action('init', 'wesselvandenijssel_remove_xmlrpc_links');

/**
 * Blocks every XML-RPC request, including system.multicall, which the xmlrpc_enabled filter does not cover.
 *
 * @param array $methods The available XML-RPC methods
 * @return array
 */
function wesselvandenijssel_disable_xmlrpc_methods(array $methods): array {
	return [];
}
add_filter('xmlrpc_methods', 'wesselvandenijssel_disable_xmlrpc_methods', 99);
