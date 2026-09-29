<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

$post_id = $post_id ?? get_the_ID();

$client = get_field('client', $post_id) ?: '';
$period = get_field('period', $post_id) ?: '';
$website = get_field('website', $post_id) ?: '';
$tools = get_field('tools', $post_id) ?: '';
$images = get_field('images', $post_id) ?: [];

$sections = [
	'assignment' => __('De opdracht', 'wesselvandenijssel'),
	'role' => __('Mijn rol', 'wesselvandenijssel'),
	'approach' => __('Aanpak', 'wesselvandenijssel'),
	'result' => __('Resultaat', 'wesselvandenijssel'),
];

$tool_list = array_filter(array_map('trim', explode(',', $tools)));
$has_facts = $client || $period || $website || $tool_list;
?>

<div class="project-details">
	<?php if ($has_facts) : ?>
		<dl class="project-details__facts">
			<?php if ($client) : ?>
				<div class="project-details__fact">
					<dt><?= esc_html__('Opdrachtgever', 'wesselvandenijssel'); ?></dt>
					<dd><?= esc_html($client); ?></dd>
				</div>
			<?php endif; ?>

			<?php if ($period) : ?>
				<div class="project-details__fact">
					<dt><?= esc_html__('Periode', 'wesselvandenijssel'); ?></dt>
					<dd><?= esc_html($period); ?></dd>
				</div>
			<?php endif; ?>

			<?php if ($website) : ?>
				<div class="project-details__fact">
					<dt><?= esc_html__('Website', 'wesselvandenijssel'); ?></dt>
					<dd>
						<a href="<?= esc_url($website); ?>" target="_blank" rel="noopener noreferrer">
							<?= esc_html(preg_replace('#^https?://(www\.)?#', '', untrailingslashit($website))); ?>
							<span class="screen-reader-text"><?= esc_html__('(opent in een nieuw venster)', 'wesselvandenijssel'); ?></span>
						</a>
					</dd>
				</div>
			<?php endif; ?>

			<?php if ($tool_list) : ?>
				<div class="project-details__fact project-details__fact--tools">
					<dt><?= esc_html__('Tools en technieken', 'wesselvandenijssel'); ?></dt>
					<dd>
						<ul class="project-details__tools" role="list">
							<?php foreach ($tool_list as $tool) : ?>
								<li class="project-details__tool"><?= esc_html($tool); ?></li>
							<?php endforeach; ?>
						</ul>
					</dd>
				</div>
			<?php endif; ?>
		</dl>
	<?php endif; ?>

	<?php foreach ($sections as $name => $label) :
		$text = get_field($name, $post_id);
		if (empty($text)) continue; ?>
		<section class="project-details__section">
			<h2 class="project-details__heading h3"><?= esc_html($label); ?></h2>
			<div class="project-details__text"><?= wp_kses_post($text); ?></div>
		</section>
	<?php endforeach; ?>

	<?php if (!empty($images)) : ?>
		<section class="project-details__section">
			<h2 class="project-details__heading h3"><?= esc_html__('Beelden', 'wesselvandenijssel'); ?></h2>
			<ul class="project-details__images" role="list">
				<?php foreach ($images as $index => $image_id) :
					$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
					$label = sprintf(__('Vergroot afbeelding %1$d van %2$d', 'wesselvandenijssel'), $index + 1, count($images)); ?>
					<li class="project-details__image-item">
						<a class="project-details__image-link" href="<?= esc_url((string) wp_get_attachment_image_url($image_id, 'full')); ?>" data-fancybox="project-<?= esc_attr((string) $post_id); ?>" data-caption="<?= esc_attr($alt); ?>">
							<span class="screen-reader-text"><?= esc_html($label); ?></span>
							<?= wp_get_attachment_image($image_id, 'Content', false, ['class' => 'project-details__image', 'loading' => 'lazy']); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</section>
	<?php endif; ?>
</div>
