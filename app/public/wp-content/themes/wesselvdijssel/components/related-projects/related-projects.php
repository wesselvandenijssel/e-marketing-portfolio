<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

$post_id = isset($post_id) ? absint($post_id) : 0;

if (empty($post_id)) return;

$project_ids = get_posts([
	'post_type' => 'project',
	'post_status' => 'publish',
	'has_password' => false,
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => -1,
	'fields' => 'ids',
	'no_found_rows' => true,
]);

$position = array_search($post_id, $project_ids, true);

if ($position !== false) {
	$project_ids = array_merge(array_slice($project_ids, $position + 1), array_slice($project_ids, 0, $position));
}

$related_ids = array_slice($project_ids, 0, 3);

if (empty($related_ids)) return;
?>

<div class="section background has-background has-lichtblauw-background-color">
	<section class="section projects related-projects pad--top-medium pad--bottom-medium">
		<div class="columns-12 center">
			<?php layout('title', [
				'title' => [
					'main_title' => __('Andere projecten', 'wesselvandenijssel'),
					'type' => 'h2',
				],
				'block' => ['id' => 'related-projects'],
			]); ?>

			<ul class="projects__grid">
				<?php foreach ($related_ids as $related_id) :
					$project_categories = get_the_terms($related_id, 'project_category');
					?>
					<li class="projects__item">
						<?php component('project-card', [
							'title' => get_the_title($related_id),
							'url' => get_permalink($related_id),
							'image' => get_post_thumbnail_id($related_id),
							'categories' => (!empty($project_categories) && !is_wp_error($project_categories)) ? $project_categories : [],
							'excerpt' => get_the_excerpt($related_id),
							'role' => get_field('card_role', $related_id) ?: '',
							'tools' => get_field('tools', $related_id) ?: '',
							'heading_level' => 3,
						]); ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
</div>
