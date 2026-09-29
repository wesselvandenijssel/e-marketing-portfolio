<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * Projecten Block Template.
 */

$section = general_section($block, [
	'class' => ['section', 'projects'],
]);

$block_title = $block_title ?? [];
$selection = !empty($selection) ? $selection : 'newest';
$projects = $projects ?? [];
$category = $category ?? 0;
$amount = (isset($amount) && $amount !== '') ? intval($amount) : 3;
$show_filter = !empty($show_filter);
$buttons_group = $buttons_group ?? [];

if ($amount === 0 || $amount < -1) $amount = 3;

$posts_per_page = 12;
$block_id = !empty($block['id']) ? (string) $block['id'] : '';

$is_overview = in_array($selection, ['newest', 'category'], true) && $amount === -1;
$has_filter = $show_filter && $is_overview && $selection === 'newest';

$args = [
	'post_type' => 'project',
	'post_status' => 'publish',
	'has_password' => false,
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => $amount,
	'ignore_sticky_posts' => true,
	'no_found_rows' => !$is_overview,
];

if (get_the_ID()) {
	$args['post__not_in'] = [get_the_ID()];
}

switch ($selection) {
	case 'specific':
		$project_ids = array_filter(array_map('absint', (array) $projects));

		$args['post__in'] = !empty($project_ids) ? $project_ids : [0];
		$args['orderby'] = 'post__in';
		$args['posts_per_page'] = -1;
		break;

	case 'category':
		if (!empty($category)) {
			$args['tax_query'] = [
				[
					'taxonomy' => 'project_category',
					'field' => 'term_id',
					'terms' => [absint($category)],
				],
			];
		}
		break;
}

$active_term = null;
$filter_terms = [];

if ($has_filter) {
	$filter_terms = get_terms([
		'taxonomy' => 'project_category',
		'hide_empty' => true,
	]);

	if (is_wp_error($filter_terms)) $filter_terms = [];

	if (isset($_GET['categorie'])) {
		$category_slug = sanitize_title(wp_unslash($_GET['categorie']));
		$term = $category_slug !== '' ? get_term_by('slug', $category_slug, 'project_category') : false;

		if ($term instanceof WP_Term) {
			$active_term = $term;
			$args['tax_query'] = [
				[
					'taxonomy' => 'project_category',
					'field' => 'term_id',
					'terms' => [$term->term_id],
				],
			];
		}
	}
}

if ($is_overview) {
	$args['posts_per_page'] = $posts_per_page;
	$args['paged'] = isset($_GET['pagina']) ? max(1, absint($_GET['pagina'])) : 1;
}

$query = new WP_Query($args);

$card_heading_level = 2;

if (!empty($block_title['main_title'])) {
	$title_type = $block_title['type'] ?? 'default';
	$title_level = in_array($title_type, ['h1', 'h2', 'h3'], true)
		? (int) substr($title_type, 1)
		: calculate_title_element($block);

	$card_heading_level = min($title_level + 1, 6);
}

$page_url = get_permalink();
$anchor = $block_id !== '' ? '#' . $block_id : '';

$overview_attr = [];
$overview_attr['class'][] = 'projects__overview';

if ($block_id !== '') {
	$overview_attr['id'] = $block_id;
}

echo !is_admin() ? '[raw]' : '';
?>

<section <?php attr($section); ?>>
	<div class="columns-12 center">
		<?php if (!empty($block_title['main_title'])) {
			layout('title', [
				'title' => $block_title,
				'block' => $block,
			]);
		} ?>

		<div <?php attr($overview_attr); ?>>
			<?php if ($has_filter && !empty($filter_terms)) : ?>
				<nav class="projects__filter" aria-label="<?= esc_attr__('Filter projecten op categorie', 'wesselvandenijssel'); ?>">
					<ul class="projects__filter-list">
						<?php
						$filter_items = [
							[
								'label' => __('Alle', 'wesselvandenijssel'),
								'url' => $page_url,
								'active' => empty($active_term),
							],
						];

						foreach ($filter_terms as $filter_term) {
							$filter_items[] = [
								'label' => $filter_term->name,
								'url' => add_query_arg('categorie', $filter_term->slug, $page_url),
								'active' => !empty($active_term) && $active_term->term_id === $filter_term->term_id,
							];
						}

						foreach ($filter_items as $filter_item) :
							$filter_attr = [];
							$filter_attr['class'][] = 'btn__filter';
							$filter_attr['href'] = esc_url($filter_item['url']) . $anchor;

							if ($filter_item['active']) {
								$filter_attr['class'][] = 'btn__filter--active';
								$filter_attr['aria-current'] = 'true';
							} ?>

							<li class="projects__filter-item">
								<a <?php attr($filter_attr); ?>><?= esc_html($filter_item['label']); ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>
			<?php endif; ?>

			<?php if ($query->have_posts()) : ?>
				<ul class="projects__grid">
					<?php while ($query->have_posts()) : $query->the_post();
						$project_categories = get_the_terms(get_the_ID(), 'project_category');
						?>
						<li class="projects__item">
							<?php component('project-card', [
								'title' => get_the_title(),
								'url' => get_permalink(),
								'image' => get_post_thumbnail_id(),
								'categories' => (!empty($project_categories) && !is_wp_error($project_categories)) ? $project_categories : [],
								'excerpt' => get_the_excerpt(),
								'heading_level' => $card_heading_level,
							]); ?>
						</li>
					<?php endwhile; ?>
				</ul>
			<?php else : ?>
				<p class="projects__empty">
					<?= !empty($active_term)
						? esc_html__('Er zijn nog geen projecten in deze categorie.', 'wesselvandenijssel')
						: esc_html__('Er zijn nog geen projecten.', 'wesselvandenijssel'); ?>
				</p>
			<?php endif; ?>

			<?php wp_reset_postdata(); ?>

			<?php
			if ($is_overview) wpex_pagination_outside_query($query->max_num_pages, $block_id);
			?>
		</div>

		<?php if (!empty($buttons_group) && is_array($buttons_group)) {
			$button_group = new BlockButtons($buttons_group);
			echo $button_group->get_buttons();
		} ?>
	</div>
</section>
<?= !is_admin() ? '[/raw]' : ''; ?>
