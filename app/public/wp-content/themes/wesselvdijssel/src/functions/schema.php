<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

add_filter('wpseo_schema_person', 'wesselvandenijssel_schema_person', 11);

/**
 * Adds the profile details from the option "wesselvandenijssel_person_schema" to the Yoast Person node.
 *
 * @param array $data The Person node
 */
function wesselvandenijssel_schema_person(array $data): array {
	$extra = get_option('wesselvandenijssel_person_schema', []);

	if (!is_array($extra) || empty($extra)) return $data;

	foreach ($extra as $key => $value) {
		if ($key === 'sameAs') {
			$data['sameAs'] = array_values(array_unique(array_merge((array) ($data['sameAs'] ?? []), (array) $value)));
			continue;
		}

		$data[$key] = $value;
	}

	return $data;
}

add_filter('wpseo_schema_graph', 'wesselvandenijssel_schema_project', 10, 2);

/**
 * Marks a project page as a CreativeWork made by the site's Person, so search engines see the project as Wessel's work.
 *
 * @param array $graph The Yoast schema graph
 * @param object $context The Yoast meta tags context
 */
function wesselvandenijssel_schema_project(array $graph, $context): array {
	if (!is_singular('project')) return $graph;

	$post_id = get_queried_object_id();
	$url = get_permalink($post_id);
	$webpage_id = $context->main_schema_id ?? $url;
	$person_id = '';

	foreach ($graph as $node) {
		if (in_array('Person', (array) ($node['@type'] ?? []), true)) {
			$person_id = $node['@id'];
			break;
		}
	}

	$work = [
		'@type' => 'CreativeWork',
		'@id' => $url . '#creativework',
		'name' => get_the_title($post_id),
		'url' => $url,
		'mainEntityOfPage' => ['@id' => $webpage_id],
		'inLanguage' => get_bloginfo('language'),
	];

	$description = get_post_meta($post_id, '_yoast_wpseo_metadesc', true) ?: get_the_excerpt($post_id);

	if (!empty($description)) {
		$work['description'] = wp_strip_all_tags($description);
	}

	if (has_post_thumbnail($post_id)) {
		$work['image'] = ['@id' => $url . '#primaryimage'];
	}

	if (!empty($person_id)) {
		$work['creator'] = ['@id' => $person_id];
	}

	$terms = get_the_terms($post_id, 'project_category');

	if (!empty($terms) && !is_wp_error($terms)) {
		$work['genre'] = wp_list_pluck($terms, 'name');
	}

	foreach ($graph as &$node) {
		if (($node['@id'] ?? '') === $webpage_id) {
			$node['mainEntity'] = ['@id' => $work['@id']];
		}
	}
	unset($node);

	$graph[] = $work;

	return $graph;
}
