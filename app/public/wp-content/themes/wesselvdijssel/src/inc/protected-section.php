<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

const WESSELVANDENIJSSEL_PORTFOLIO_SLUG = 'portfolio-minor';
const WESSELVANDENIJSSEL_REVIEWER_ROLE = 'portfolio_beoordelaar';

/**
 * Registers the reviewer role once: it can read private pages, nothing else.
 */
add_action('init', 'wesselvandenijssel_register_reviewer_role');
function wesselvandenijssel_register_reviewer_role(): void {
	if (get_role(WESSELVANDENIJSSEL_REVIEWER_ROLE)) {
		return;
	}

	add_role(WESSELVANDENIJSSEL_REVIEWER_ROLE, __('Portfolio beoordelaar', 'wesselvandenijssel'), [
		'read' => true,
		'read_private_pages' => true,
	]);
}

/**
 * Checks whether a page belongs to the protected section: the section page itself or one of its descendants.
 *
 * @param int|WP_Post|null $post Post to check, defaults to the current post.
 * @return bool
 */
function wesselvandenijssel_is_portfolio_page($post = null): bool {
	$post = get_post($post);

	if (!$post instanceof WP_Post || $post->post_type !== 'page') {
		return false;
	}

	$ids = array_merge([$post->ID], get_post_ancestors($post));

	foreach ($ids as $id) {
		if (get_post_field('post_name', $id) === WESSELVANDENIJSSEL_PORTFOLIO_SLUG && (int) get_post_field('post_parent', $id) === 0) {
			return true;
		}
	}

	return false;
}

/**
 * Returns the IDs of all pages in the protected section, regardless of status.
 *
 * @return int[]
 */
function wesselvandenijssel_portfolio_page_ids(): array {
	$root = get_page_by_path(WESSELVANDENIJSSEL_PORTFOLIO_SLUG);

	if (!$root instanceof WP_Post) {
		return [];
	}

	$children = get_pages([
		'child_of' => $root->ID,
		'post_status' => ['publish', 'private', 'draft', 'pending', 'future'],
	]);

	return array_merge([$root->ID], wp_list_pluck($children, 'ID'));
}

/**
 * Redirects visitors without access to the login screen (WordPress would show a 404), and sends
 * no-cache and noindex headers for every page of the section.
 */
add_action('template_redirect', 'wesselvandenijssel_portfolio_access', 1);
function wesselvandenijssel_portfolio_access(): void {
	if (is_404() && !current_user_can('read_private_pages')) {
		$request_path = sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI'] ?? ''));
		$path = trim((string) wp_parse_url($request_path, PHP_URL_PATH), '/');
		$home_path = trim((string) wp_parse_url(home_url(), PHP_URL_PATH), '/');

		if ($home_path !== '' && str_starts_with($path, $home_path)) {
			$path = trim(substr($path, strlen($home_path)), '/');
		}

		if ($path === WESSELVANDENIJSSEL_PORTFOLIO_SLUG || str_starts_with($path, WESSELVANDENIJSSEL_PORTFOLIO_SLUG . '/')) {
			$root = get_page_by_path(WESSELVANDENIJSSEL_PORTFOLIO_SLUG);

			// Redirect every path under the section, existing or not, so visitors cannot probe which subpages exist
			if ($root instanceof WP_Post && $root->post_status === 'private') {
				// Use the requested pretty path: get_permalink() gives ?page_id=… for visitors who cannot read the page
				nocache_headers();
				wp_safe_redirect(wp_login_url(home_url('/' . $path . '/')));
				exit;
			}
		}
	}

	if (is_singular('page') && wesselvandenijssel_is_portfolio_page()) {
		// Never cache these pages: not in the browser, not in proxies and not in WP Rocket
		nocache_headers();

		if (!defined('DONOTCACHEPAGE')) {
			define('DONOTCACHEPAGE', true);
		}

		header('X-Robots-Tag: noindex, nofollow', true);
	}
}

/**
 * Noindex/nofollow for the section, in Yoast and in the core robots meta tag.
 */
add_filter('wpseo_robots', 'wesselvandenijssel_portfolio_yoast_robots');
function wesselvandenijssel_portfolio_yoast_robots($robots) {
	return (is_singular('page') && wesselvandenijssel_is_portfolio_page()) ? 'noindex, nofollow' : $robots;
}

add_filter('wp_robots', 'wesselvandenijssel_portfolio_core_robots');
function wesselvandenijssel_portfolio_core_robots(array $robots): array {
	if (is_singular('page') && wesselvandenijssel_is_portfolio_page()) {
		$robots['noindex'] = true;
		$robots['nofollow'] = true;
	}

	return $robots;
}

/**
 * Removes Open Graph and Twitter tags from the section, so a shared link reveals no title or description.
 */
add_filter('wpseo_frontend_presenters', 'wesselvandenijssel_portfolio_social_tags');
function wesselvandenijssel_portfolio_social_tags(array $presenters): array {
	if (!is_singular('page') || !wesselvandenijssel_is_portfolio_page()) {
		return $presenters;
	}

	return array_values(array_filter($presenters, function ($presenter) {
		$class = get_class($presenter);

		return strpos($class, 'Open_Graph') === false && strpos($class, 'Twitter') === false;
	}));
}

/**
 * Second line of defence: keep the section out of the Yoast and core XML sitemaps even if a page is ever published.
 */
add_filter('wpseo_exclude_from_sitemap_by_post_ids', 'wesselvandenijssel_portfolio_sitemap_exclude');
function wesselvandenijssel_portfolio_sitemap_exclude(array $ids): array {
	return array_merge($ids, wesselvandenijssel_portfolio_page_ids());
}

add_filter('wp_sitemaps_posts_query_args', 'wesselvandenijssel_portfolio_core_sitemap_exclude', 10, 2);
function wesselvandenijssel_portfolio_core_sitemap_exclude(array $args, string $post_type): array {
	if ($post_type === 'page') {
		$args['post__not_in'] = array_merge($args['post__not_in'] ?? [], wesselvandenijssel_portfolio_page_ids());
	}

	return $args;
}

/**
 * Second line of defence: hide menu items of the section from visitors without access.
 */
add_filter('wp_nav_menu_objects', 'wesselvandenijssel_portfolio_menu_items');
function wesselvandenijssel_portfolio_menu_items(array $items): array {
	if (current_user_can('read_private_pages')) {
		return $items;
	}

	return array_values(array_filter($items, fn($item) => !($item->object === 'page' && wesselvandenijssel_is_portfolio_page((int) $item->object_id))));
}

/**
 * Shows the plain title instead of "Privé: …" on the section.
 */
add_filter('private_title_format', 'wesselvandenijssel_portfolio_title_format', 10, 2);
function wesselvandenijssel_portfolio_title_format(string $format, $post = null): string {
	return wesselvandenijssel_is_portfolio_page($post) ? '%s' : $format;
}

/**
 * Checks whether the current user only has the reviewer role (not an editor or admin who also reviews).
 */
function wesselvandenijssel_is_reviewer(): bool {
	$user = wp_get_current_user();

	return $user->exists() && in_array(WESSELVANDENIJSSEL_REVIEWER_ROLE, (array) $user->roles, true) && !current_user_can('edit_posts');
}

/**
 * Reviewers land on the section after login and never see wp-admin or the admin bar.
 */
add_filter('login_redirect', 'wesselvandenijssel_reviewer_login_redirect', 10, 3);
function wesselvandenijssel_reviewer_login_redirect($redirect_to, $requested, $user) {
	if ($user instanceof WP_User && in_array(WESSELVANDENIJSSEL_REVIEWER_ROLE, (array) $user->roles, true) && !user_can($user, 'edit_posts')) {
		$section = get_page_by_path(WESSELVANDENIJSSEL_PORTFOLIO_SLUG);
		$section_url = $section instanceof WP_Post ? get_permalink($section) : home_url('/');

		// Keep a requested page of the section, send everything else (wp-admin, profile) to the section
		return (!empty($requested) && strpos($requested, '/' . WESSELVANDENIJSSEL_PORTFOLIO_SLUG . '/') !== false) ? $requested : $section_url;
	}

	return $redirect_to;
}

add_action('admin_init', 'wesselvandenijssel_reviewer_block_admin');
function wesselvandenijssel_reviewer_block_admin(): void {
	if (wp_doing_ajax() || !wesselvandenijssel_is_reviewer()) {
		return;
	}

	wp_safe_redirect(home_url('/' . WESSELVANDENIJSSEL_PORTFOLIO_SLUG . '/'));
	exit;
}

add_filter('show_admin_bar', 'wesselvandenijssel_reviewer_admin_bar');
function wesselvandenijssel_reviewer_admin_bar($show) {
	return wesselvandenijssel_is_reviewer() ? false : $show;
}
