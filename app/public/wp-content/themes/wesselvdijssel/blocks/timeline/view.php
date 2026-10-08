<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * Timeline Block Template.
 */

$section = general_section($block, [
	'class' => ['section', 'timeline'],
]);

$block_title = $block_title ?? [];
$intro = $intro ?? '';
$items = $items ?? [];
$buttons_group = $buttons_group ?? [];

$items = array_filter((array) $items, fn($item) => !empty($item['title']));

if (empty($items)) return;

$title_type = $block_title['type'] ?? 'default';
$title_level = in_array($title_type, ['h1', 'h2', 'h3'], true) ? (int) substr($title_type, 1) : calculate_title_element($block);

$item_level = !empty($block_title['main_title']) ? min($title_level + 1, 6) : 2;
$item_heading = 'h' . $item_level;

echo !is_admin() ? '[raw]' : '';
?>

<section <?php attr($section); ?>>
	<div class="columns-10 center">

		<?php if (!empty($block_title['main_title']) || !empty($intro)) : ?>
			<div class="timeline__header">
				<?php if (!empty($block_title['main_title'])) {
					layout("title", [
						'title' => $block_title,
						'block' => $block,
					]);
				} ?>

				<?php if (!empty($intro)) : ?>
					<div class="timeline__intro content-layout">
						<?= wp_kses_post($intro); ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<ol class="timeline__list">
			<?php foreach ($items as $item) :
				$period = $item['period'] ?? '';
				$organisation = $item['organisation'] ?? '';
				$location = $item['location'] ?? '';
				$description = $item['description'] ?? '';
				$link = $item['link'] ?? [];
				$image = (int) ($item['image'] ?? 0);
			?>
				<li class="timeline__item<?= $image ? ' timeline__item--has-image' : ''; ?>">
					<?php if ($image) : ?>
						<figure class="timeline__media">
							<?= wp_get_attachment_image($image, 'full', false, [
								'class' => 'timeline__image',
								'loading' => 'lazy',
								'sizes' => '(min-width: 980px) 60vw, 100vw',
							]); ?>
						</figure>
					<?php endif; ?>

					<div class="timeline__card">
						<<?= $item_heading; ?> class="timeline__title h4"><?= esc_html($item['title']); ?></<?= $item_heading; ?>>

						<?php if (!empty($period)) : ?>
							<p class="timeline__period"><?= esc_html($period); ?></p>
						<?php endif; ?>

						<?php if (!empty($organisation) || !empty($location)) : ?>
							<p class="timeline__meta">
								<?php if (!empty($organisation)) : ?>
									<span class="timeline__organisation"><?= esc_html($organisation); ?></span>
								<?php endif; ?>
								<?php if (!empty($location)) : ?>
									<span class="timeline__location"><?= esc_html($location); ?></span>
								<?php endif; ?>
							</p>
						<?php endif; ?>

						<?php if (!empty($description)) : ?>
							<div class="timeline__description content-layout">
								<?= wp_kses_post($description); ?>
							</div>
						<?php endif; ?>

						<?php if (!empty($link['url'])) :
							$link_attr = [
								'class' => ['timeline__link'],
								'href' => esc_url($link['url']),
							];

							if (($link['target'] ?? '') === '_blank') {
								$link_attr['target'] = '_blank';
								$link_attr['rel'] = 'noopener noreferrer';
							}
						?>
							<a <?php attr($link_attr); ?>>
								<?= esc_html(!empty($link['title']) ? $link['title'] : $link['url']); ?>
								<?php if (($link['target'] ?? '') === '_blank') : ?>
									<span class="screen-reader-text"><?= esc_html__('(opent in een nieuw venster)', 'wesselvandenijssel'); ?></span>
								<?php endif; ?>
							</a>
						<?php endif; ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>

		<?php if (!empty($buttons_group)) : ?>
			<div class="timeline__buttons">
				<?= (new BlockButtons($buttons_group))->get_buttons(); ?>
			</div>
		<?php endif; ?>

	</div>
</section>
<?= !is_admin() ? '[/raw]' : ''; ?>
