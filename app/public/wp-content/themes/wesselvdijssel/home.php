<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * The posts page (Settings > Reading): renders the blocks of the page set as posts page.
 *
 * @package wesselvandenijssel
 */

if (!function_exists('get_field')) {
	echo 'Activate ACF for this theme to work';
	return;
}

get_header(); ?>

<div id="primary" class="content-area">
	<?php
	$blog_page = get_post((int) get_option('page_for_posts'));

	if ($blog_page instanceof WP_Post) {
		global $post;
		$post = $blog_page;
		setup_postdata($post);
		get_template_part('content', 'page');
		wp_reset_postdata();
	}
	?>
</div>

<?php get_footer(); ?>
