<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * Blog Block Template.
 */

$section = general_section($block, [
	'class' => ['section', 'blog'],
]);

if (empty($selection)) return;

$posts_per_page = 12;

$is_overview = ($selection === 'newest' || $selection === 'random') && intval($amount) === -1;

$args = [
	'post_type' => 'post',
	'post_status' => 'publish',
	'orderby' => 'date',
	'post__not_in' => [get_the_ID()],
	'posts_per_page' => $amount ?? $posts_per_page,
	'meta_query' => [
		[
			'key' => '_thumbnail_id',
			'compare' => 'EXISTS',
		],
	],
];

switch ($selection) {
	case 'random':
		$args['orderby'] = 'rand';
		break;

	case 'specific':
		$args['post__in'] = $posts ?? [];
		$args['orderby'] = 'post__in';
		$args['posts_per_page'] = -1;
		break;

	case 'category':
		if (isset($_GET['category']) && $_GET['category'] !== '*') break;

		$args['tax_query'] = [
			[
				'taxonomy' => 'category',
				'field' => 'term_id',
				'terms'	=> $category ?? 0,
				'operator' => 'IN',
			],
		];
		break;
}

if ($is_overview) {
	$args['posts_per_page'] = $posts_per_page;

	if (isset($_GET['category']) && $_GET['category'] !== '*') {
		$args['tax_query'] = [
			[
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => sanitize_text_field($_GET['category']),
				'operator' => 'IN',
			],
		];
	}

	if (isset($_GET['pagina'])) {
		$pagina = absint($_GET['pagina']);
		if ($pagina > 0) {
			$args['offset'] = $pagina * $posts_per_page - $posts_per_page;
		}
	}
}

$query = new WP_Query($args);

$total = $query->max_num_pages;

$post_heading_level = 2;

if (!empty($block_title['main_title'])) {
	$title_type = $block_title['type'] ?? 'default';
	$title_level = in_array($title_type, ['h1', 'h2', 'h3'], true)
		? (int) substr($title_type, 1)
		: calculate_title_element($block);

	$post_heading_level = min($title_level + 1, 6);
}

echo !is_admin() ? '[raw]' : '';
?>

<section <?php attr($section); ?>>
	<div class="columns-12 center">
		<?php if (!empty($block_title['main_title'])) {
			layout("title", [
				'title' => $block_title,
				'block' => $block,
			]);
		} ?>

		<?php if ($is_overview) {
			component('filter', [
				'terms' => get_terms(['taxonomy' => 'category', 'hide_empty' => true]),
				'name' => 'category',
				'anchor' => $block['id'] ?? '',
				'all_label' => __('Toon alle artikelen', 'wesselvandenijssel'),
				'select_label' => __('Filter op categorie', 'wesselvandenijssel'),
			]);
		} ?>

		<?php
		$blog_grid_attr = [];
		$blog_grid_attr['class'][] = 'blog__grid';

		if (!$is_overview) {
			$blog_grid_attr['class'][] = 'blog__grid--swiper';
			$blog_grid_attr['class'][] = 'swiper';
		} else {
			$blog_grid_attr['class'][] = 'blog__grid--overview';
		}

		if (!empty($block['id'])) {
			$blog_grid_attr['id'] = $block['id'];
		}
		?>

		<div <?php attr($blog_grid_attr); ?>>
			<?php if (!$is_overview) : ?>
				<div class="swiper-wrapper">
				<?php endif; ?>

				<?php if ($query->have_posts()) :
					while ($query->have_posts()) : $query->the_post();
						component('post', [
							'title' => get_the_title(),
							'image' => get_post_thumbnail_id(),
							'categories' => get_the_terms(get_the_ID(), 'category') ?: [],
							'link' => [
								'url' => get_permalink(),
								'title' => get_the_title(),
								'target' => '_self',
							],
							'date' => get_the_date('c'),
							'swiper' => !$is_overview,
							'heading_level' => $post_heading_level,
						]);
					endwhile;
				else : ?>
					<p class="blog__empty"><?= esc_html__('Er zijn nog geen berichten.', 'wesselvandenijssel'); ?></p>
				<?php endif; ?>
				<?php if (!$is_overview) : ?>
				</div>

				<div class="blog__swiper-scrollbar swiper-scrollbar"></div>
			<?php endif; ?>
		</div>
		<?php wp_reset_postdata(); ?>

		<?php if ($is_overview) {
			$pagination_args = [];

			if (isset($_GET['category']) && $_GET['category'] !== '*') {
				$pagination_args['category'] = sanitize_text_field(wp_unslash($_GET['category']));
			}

			wpex_pagination_outside_query($total, $block['id'], $pagination_args);
		} ?>

		<?php if (!empty($buttons_group) && is_array($buttons_group)) {
			$button_group = new BlockButtons($buttons_group);
			echo $button_group->get_buttons();
		} ?>
	</div>
</section>
<?= !is_admin() ? '[/raw]' : ''; ?>
