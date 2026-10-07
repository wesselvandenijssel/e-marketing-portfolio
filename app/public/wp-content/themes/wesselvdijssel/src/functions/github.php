<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * Returns the public GitHub contribution calendar of a user, cached for 12 hours.
 *
 * @param string $username GitHub username
 * @return array{total: int, days: array<int, array{date: string, level: int, count: int}>}|null
 */
function wesselvandenijssel_github_contributions(string $username): ?array {
	$username = sanitize_user($username, true);

	if ($username === '') return null;

	$cache_key = 'wesselvandenijssel_github_' . md5($username);
	$cached = get_transient($cache_key);

	if (is_array($cached)) return $cached['days'] ? $cached : null;

	$response = wp_remote_get('https://github.com/users/' . rawurlencode($username) . '/contributions', [
		'timeout' => 8,
		'user-agent' => 'Mozilla/5.0 (compatible; wesselvandenijssel.nl)',
	]);

	$html = wp_remote_retrieve_response_code($response) === 200 ? wp_remote_retrieve_body($response) : '';
	$data = ['total' => 0, 'days' => []];

	if ($html) {
		$counts = [];

		preg_match_all('/<tool-tip[^>]*\bfor="([^"]+)"[^>]*>([^<]*)</', $html, $tips, PREG_SET_ORDER);
		foreach ($tips as $tip) {
			$counts[$tip[1]] = preg_match('/^(\d+)\s+contribution/', trim($tip[2]), $m) ? (int) $m[1] : 0;
		}

		preg_match_all('/<td[^>]*data-date="(\d{4}-\d{2}-\d{2})"[^>]*>/', $html, $cells);
		foreach ($cells[0] as $i => $cell) {
			preg_match('/\bid="([^"]+)"/', $cell, $id);
			preg_match('/data-level="(\d)"/', $cell, $level);
			$count = $counts[$id[1] ?? ''] ?? 0;
			$data['days'][] = ['date' => $cells[1][$i], 'level' => (int) ($level[1] ?? 0), 'count' => $count];
			$data['total'] += $count;
		}

		usort($data['days'], fn($a, $b) => strcmp($a['date'], $b['date']));
	}

	set_transient($cache_key, $data, $data['days'] ? 12 * HOUR_IN_SECONDS : HOUR_IN_SECONDS);

	return $data['days'] ? $data : null;
}
