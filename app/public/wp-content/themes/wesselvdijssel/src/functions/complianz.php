<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * Block the customer journey tracking until the visitor gives marketing consent in Complianz.
 *
 * The script stores every page view in localStorage and attaches it to Gravity Forms entries,
 * which links the browsing history to a name and email address. That needs consent (D-069).
 *
 * @param array $tags Scripts Complianz blocks before consent
 * @return array
 */
function wesselvandenijssel_block_customer_journey(array $tags): array {
	$tags[] = [
		'name' => 'Klantreis',
		'category' => 'marketing',
		'urls' => ['wesselvdijssel-customer-journey/assets/js/tracking.js'],
		'enable_placeholder' => 0,
	];

	return $tags;
}
add_filter('cmplz_known_script_tags', 'wesselvandenijssel_block_customer_journey');
