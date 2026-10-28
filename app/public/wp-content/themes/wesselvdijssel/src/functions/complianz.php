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

/**
 * Rewrites the generated cookie policy in the first person singular ("ik" instead of "wij"), removes
 * the webshop sentence and the cookiedatabase.org sync line, and translates the screen reader label.
 *
 * @param string $html The generated document HTML
 * @param string $type The document type
 * @return string
 */
function wesselvandenijssel_cookie_policy_text(string $html, string $type): string {
	if ($type !== 'cookie-statement') return $html;

	$html = str_replace([
		'Op onze site,',
		'door ons zijn ingeschakeld',
		'informeren wij je over het gebruik van cookies op onze site',
		'naar onze servers',
		'om onze site goed',
		'op onze server,',
		'zorgen wij ervoor dat je onze site',
		'bij een bezoek aan onze site en is het onder andere mogelijk dat de items in je winkelwagen bewaard blijven tot dat je hebt afgerekend.',
		'Deze cookies mogen wij plaatsen',
		'Wij gebruiken statistieken cookies om de beleving voor onze gebruikers te optimaliseren.',
		'Wij krijgen door middel van statistieken cookies inzicht in het gebruik van onze site.',
		'Wij vragen je toestemming om statistieken cookies te plaatsen.',
		'Wanneer je onze site voor het eerst bezoekt, tonen wij',
		'geef je ons toestemming',
		'dat onze site dan',
		'Let op: onze site',
		'bij een nieuw bezoek aan onze site.',
		'de gegevens die we van je verwerken',
		'Als je ons toestemming geeft',
		'je kan bezwaar maken',
		'Wij komen hieraan tegemoet',
		'neem contact met ons op',
		'hoe we met je gegevens omgaan, horen we graag van je',
		'met betrekking tot ons cookiebeleid en deze verklaring kun je contact met ons opnemen',
		'Consent to service ',
	], [
		'Op mijn site,',
		'door mij zijn ingeschakeld',
		'informeer ik je over het gebruik van cookies op mijn site',
		'naar mijn servers',
		'om mijn site goed',
		'op mijn server,',
		'zorg ik ervoor dat je mijn site',
		'bij een bezoek aan mijn site.',
		'Deze cookies mag ik plaatsen',
		'Ik gebruik statistiekcookies om de website beter te maken.',
		'Met statistiekcookies zie ik hoe bezoekers mijn site gebruiken.',
		'Ik vraag je toestemming om statistiekcookies te plaatsen.',
		'Wanneer je mijn site voor het eerst bezoekt, toon ik',
		'geef je mij toestemming',
		'dat mijn site dan',
		'Let op: mijn site',
		'bij een nieuw bezoek aan mijn site.',
		'de gegevens die ik van je verwerk',
		'Als je mij toestemming geeft',
		'je kunt bezwaar maken',
		'Ik kom hieraan tegemoet',
		'neem contact met mij op',
		'hoe ik met je gegevens omga, hoor ik graag van je',
		'over mijn cookiebeleid en deze verklaring kun je contact met mij opnemen',
		'Toestemming voor ',
	], $html);

	$html = preg_replace_callback('/We gebruiken (.+?) voor (\S)/u', fn(array $match): string => 'Ik gebruik ' . $match[1] . ' voor ' . mb_strtolower($match[2]), $html);

	return preg_replace('/<p>[^<]*gesynchroniseerd met <a[^>]*>cookiedatabase\.org<\/a>[^<]*<\/p>\s*/u', '', $html);
}
add_filter('cmplz_document_html', 'wesselvandenijssel_cookie_policy_text', 10, 2);
