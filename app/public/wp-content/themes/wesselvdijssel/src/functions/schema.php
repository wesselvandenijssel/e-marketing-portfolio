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
