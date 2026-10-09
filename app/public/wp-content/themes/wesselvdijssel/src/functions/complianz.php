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

/**
 * Removes defer and async from scripts that Complianz blocked as type="text/plain".
 *
 * @param string $html The page HTML after the Complianz cookie blocker
 * @return string
 */
function wesselvandenijssel_clean_blocked_scripts(string $html): string {
	return preg_replace_callback('/<script\b[^>]*\btype="text\/plain"[^>]*>/i', function (array $match): string {
		return preg_replace('/\s(?:defer|async|data-wp-strategy="[^"]*")(?=[\s>])/i', '', $match[0]);
	}, $html);
}
add_filter('cmplz_cookie_blocker_output', 'wesselvandenijssel_clean_blocked_scripts');
