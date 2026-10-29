<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

$title = $title ?? '';
$url = $url ?? '';
$image = $image ?? 0;
$categories = $categories ?? [];
$excerpt = $excerpt ?? '';
$role = $role ?? '';
$tools = $tools ?? '';
$tool_list = array_slice(array_filter(array_map('trim', explode(',', $tools))), 0, 3);
$heading_level = isset($heading_level) ? max(2, min(6, absint($heading_level))) : 3;
$eager = !empty($eager);

if (empty($title) || empty($url)) return;

$heading = 'h' . $heading_level;
?>

<article class="project-card">
	<?php if (!empty($image)) : ?>
		<div class="project-card__media">
			<?= wp_get_attachment_image($image, 'Project card', false, [
				'class' => 'project-card__image',
				'loading' => $eager ? 'eager' : 'lazy',
				'fetchpriority' => $eager ? 'high' : 'auto',
				'sizes' => '(min-width: 980px) 33vw, (min-width: 740px) 50vw, 100vw',
			]); ?>
		</div>
	<?php else : ?>
		<div class="project-card__media project-card__media--empty" aria-hidden="true"></div>
	<?php endif; ?>

	<div class="project-card__content">
		<?php if (!empty($categories)) : ?>
			<ul class="project-card__labels" aria-label="<?= esc_attr__('Categorieën', 'wesselvandenijssel'); ?>">
				<?php foreach ($categories as $category) : ?>
					<li class="project-card__label"><?= esc_html($category->name); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<<?= $heading; ?> class="project-card__title h3">
			<a class="project-card__link" href="<?= esc_url($url); ?>"><?= esc_html($title); ?></a>
		</<?= $heading; ?>>

		<?php if (!empty($role) || !empty($tool_list)) : ?>
			<p class="project-card__meta">
				<?php if (!empty($role)) : ?>
					<span class="project-card__role"><?= esc_html($role); ?></span>
				<?php endif; ?>
				<?php if (!empty($tool_list)) : ?>
					<span class="project-card__tools"><?= esc_html(implode(', ', $tool_list)); ?></span>
				<?php endif; ?>
			</p>
		<?php endif; ?>

		<?php if (!empty($excerpt)) : ?>
			<p class="project-card__excerpt"><?= esc_html(wp_strip_all_tags($excerpt)); ?></p>
		<?php endif; ?>
	</div>
</article>
