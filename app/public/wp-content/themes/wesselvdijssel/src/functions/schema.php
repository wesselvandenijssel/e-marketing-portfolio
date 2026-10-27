<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

add_filter('wpseo_schema_person', 'wesselvandenijssel_schema_person', 11);

/**
 * Adds the profile details from the option "wesselvandenijssel_person_schema" to the Yoast Person node,
 * and drops this site's own URL from sameAs (Yoast adds the user's website there).
 *
 * @param array $data The Person node
 */
function wesselvandenijssel_schema_person(array $data): array {
	$contact = get_field('contact_details', 'options') ?: [];

	if (!empty($contact['email']) && get_post_status(12) === 'publish') {
		$data['contactPoint'] = [
			'@type' => 'ContactPoint',
			'contactType' => 'contact',
			'email' => $contact['email'],
			'url' => get_permalink(12),
			'availableLanguage' => ['nl', 'en'],
		];
	}

	$extra = get_option('wesselvandenijssel_person_schema', []);

	if (is_array($extra)) {
		foreach ($extra as $key => $value) {
			if ($key === 'sameAs') {
				$data['sameAs'] = array_values(array_unique(array_merge((array) ($data['sameAs'] ?? []), (array) $value)));
				continue;
			}

			$data[$key] = $value;
		}
	}

	if (!empty($data['sameAs'])) {
		$home = untrailingslashit(set_url_scheme(home_url(), 'https'));
		$data['sameAs'] = array_values(array_filter((array) $data['sameAs'], fn($url) => untrailingslashit(set_url_scheme((string) $url, 'https')) !== $home));

		if (empty($data['sameAs'])) unset($data['sameAs']);
	}

	return $data;
}

add_filter('wpseo_schema_article_type', 'wesselvandenijssel_schema_article_type', 10, 2);

/**
 * Types blog posts as BlogPosting instead of the generic Article.
 *
 * @param string|string[] $type The Article type
 * @param object $indexable The Yoast indexable
 * @return string|string[]
 */
function wesselvandenijssel_schema_article_type($type, $indexable) {
	if (($indexable->object_sub_type ?? '') === 'post' && $type === 'Article') return 'BlogPosting';

	return $type;
}

add_filter('wpseo_schema_article', 'wesselvandenijssel_schema_article_modified', 10, 2);

/**
 * Always adds dateModified to a blog post. Yoast leaves it out until a post has been edited after publishing.
 *
 * @param array $data The Article node
 * @param object $context The Yoast meta tags context
 */
function wesselvandenijssel_schema_article_modified(array $data, $context): array {
	if (empty($data['dateModified']) && !empty($context->post->post_modified_gmt)) {
		$data['dateModified'] = YoastSEO()->helpers->date->format($context->post->post_modified_gmt);
	}

	return $data;
}

add_filter('wpseo_schema_webpage', 'wesselvandenijssel_schema_profile_page', 10, 2);

/**
 * Marks Over mij as a ProfilePage with the site's Person as its main entity.
 *
 * @param array $data The WebPage node
 * @param object $context The Yoast meta tags context
 */
function wesselvandenijssel_schema_profile_page(array $data, $context): array {
	if (!is_page(218) || ($context->site_represents ?? '') !== 'person') return $data;

	$person_id = YoastSEO()->helpers->schema->id->get_user_schema_id($context->site_user_id, $context);

	if (empty($person_id)) return $data;

	$data['@type'] = array_values(array_unique(array_merge((array) $data['@type'], ['ProfilePage'])));
	$data['about'] = ['@id' => $person_id];
	$data['mainEntity'] = ['@id' => $person_id];

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
