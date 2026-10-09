<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * Modify video attributes for lazy loading and YouTube parameters
 *
 * This function checks if the video is a YouTube link and modifies the src attribute
 * to include parameters that disable related videos and adds lazy loading if not already present.
 *
 * @param string $video The video iframe HTML
 * @return string Modified video HTML with updated src and lazy loading attribute
 */
function modify_video_attributes($video) {
	if (!preg_match('/src="(.+?)"/', $video, $matches)) return $video;

	$src = $matches[1];

	// Check if the source is a YouTube link
	if (strpos($src, 'youtube.com') !== false || strpos($src, 'youtu.be') !== false) {
		$params = [
			'rel' => 0,
		];

		$new_src = add_query_arg($params, $src);
		$video = str_replace($src, $new_src, $video);

		// Add lazy loading to iframe if not already present
		if (strpos($video, 'loading=') === false) {
			$video = preg_replace('/<iframe(.*?)>/', '<iframe loading="lazy"$1>', $video);
		}
	}

	return $video;
}

/**
 * Extracts the Wistia media ID from an embed code, a Wistia URL or a bare media ID.
 *
 * @param string $value Embed code, URL or media ID
 * @return string The media ID, or an empty string when none is found
 */
function wistia_media_id(string $value): string {
	$value = trim($value);

	if ($value === '') return '';

	$patterns = [
		'/media-id=["\']([a-z0-9]{10})["\']/i',
		'/(?:medias|embed|iframe)\/([a-z0-9]{10})/i',
		'/^([a-z0-9]{10})$/i',
	];

	foreach ($patterns as $pattern) {
		if (preg_match($pattern, $value, $matches)) return strtolower($matches[1]);
	}

	return '';
}

/**
 * Returns the width/height ratio of a Wistia video from its oEmbed data, cached for a week.
 *
 * @param string $media_id The Wistia media ID
 * @return float The aspect ratio, 16:9 when Wistia does not answer
 */
function wistia_video_ratio(string $media_id): float {
	$cache_key = 'wesselvandenijssel_wistia_ratio_' . $media_id;
	$cached = get_transient($cache_key);

	if ($cached !== false) return (float) $cached;

	$response = wp_remote_get('https://fast.wistia.com/oembed?url=' . rawurlencode('https://home.wistia.com/medias/' . $media_id), ['timeout' => 5]);
	$data = json_decode((string) wp_remote_retrieve_body($response), true);
	$width = (float) ($data['width'] ?? 0);
	$height = (float) ($data['height'] ?? 0);
	$ratio = $width > 0 && $height > 0 ? round($width / $height, 4) : 0;

	set_transient($cache_key, $ratio ?: 16 / 9, $ratio ? WEEK_IN_SECONDS : DAY_IN_SECONDS);

	return $ratio ?: 16 / 9;
}

/**
 * Process video URL and add fancybox attributes to wrapper
 *
 * This function extracts YouTube URL from iframe, applies video attributes modification,
 * and returns the modified attributes array with fancybox data attributes.
 *
 * @param string $video The video iframe HTML
 * @param array $attrs attributes array
 * @return array Modified attributes array with fancybox data
 */
function video_in_fancybox($video, $attrs = []) {
	if (empty($video)) {
		return $attrs;
	}

	$modified_video = modify_video_attributes($video);
	$modified_video_url = '';

	if (preg_match('/src="([^"]*)"/', $modified_video, $mod_matches)) {
		$modified_video_url = $mod_matches[1];
	}
	if (!empty($modified_video_url)) {
		$attrs['class'][] = 'video-in-fancybox';
		$attrs['data-src'] = esc_url($modified_video_url);
		$attrs['data-type'] = 'iframe';
		$attrs['data-width'] = '1280';
		$attrs['data-height'] = '720';
	}

	return $attrs;
}
