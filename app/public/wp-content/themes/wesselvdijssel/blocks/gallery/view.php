<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * Galerij Block Template.
 */

$section = general_section($block, [
	'class' => ['section', 'gallery'],
]);

$items = $items ?? [];
$block_title = $block_title ?? [];
$layout = in_array($layout ?? '', ['grid', 'featured'], true) ? $layout : 'grid';
$columns = in_array((string) ($columns ?? ''), ['2', '3', '4'], true) ? (string) $columns : '3';
$fit = ($fit ?? '') === 'contain' ? 'contain' : 'cover';
$show_captions = !empty($show_captions) && $layout === 'grid';

$items = array_values(array_filter((array) $items, fn($item) => !empty($item['image'])));

if (empty($items)) return;

$total = count($items);

$visible_items = $layout === 'featured' ? array_slice($items, 0, 3) : $items;
$hidden_items = $layout === 'featured' ? array_slice($items, 3) : [];
$hidden_count = count($hidden_items);

$group = sprintf('%s-gallery', $block['id'] ?? 'gallery');

$grid_attr = [];
$grid_attr['class'][] = 'gallery__grid';
$grid_attr['class'][] = 'gallery__grid--' . $layout;

if ($layout === 'grid') {
	$grid_attr['class'][] = 'gallery__grid--cols-' . $columns;
	$grid_attr['class'][] = 'gallery__grid--' . $fit;
} else {
	$grid_attr['class'][] = 'gallery__grid--count-' . count($visible_items);
}

$sizes = match ($layout === 'grid' ? $columns : 'featured') {
	'2' => '(min-width: 740px) 50vw, 100vw',
	'4' => '(min-width: 980px) 25vw, 50vw',
	'featured' => '(min-width: 740px) 66vw, 100vw',
	default => '(min-width: 980px) 33vw, 50vw',
};

$get_link_attr = static function (array $item, string $group): array {
	$image_id = (int) $item['image'];
	$caption = wp_get_attachment_caption($image_id);

	$link_attr = [];
	$link_attr['class'][] = 'gallery__link';
	$link_attr['href'] = (string) wp_get_attachment_image_url($image_id, 'full');
	$link_attr['data-fancybox'] = $group;
	wp_enqueue_script('wesselvandenijssel-fancybox');
	$link_attr['data-thumb-src'] = (string) wp_get_attachment_image_url($image_id, 'Avatar');

	if (!empty($caption)) {
		$link_attr['data-caption'] = wp_strip_all_tags($caption);
	}

	$loop_id = wistia_media_id((string) ($item['loop_video'] ?? ''));

	if ($loop_id) {
		$link_attr['class'][] = 'gallery__link--loop';
		$link_attr['href'] = $link_attr['data-src'] = 'https://fast.wistia.net/embed/iframe/' . $loop_id . '?autoPlay=true';
		$link_attr['data-type'] = 'iframe';
		$link_attr['data-ratio'] = (string) wistia_video_ratio($loop_id);
		$link_attr['data-wistia-loop'] = $loop_id;
	} elseif (!empty($item['video'])) {
		$link_attr = video_in_fancybox($item['video'], $link_attr);

		if (!empty($link_attr['data-src'])) {
			$link_attr['href'] = $link_attr['data-src'];
		}
	}

	return $link_attr;
};

$has_loops = !empty(array_filter($visible_items, static fn(array $item): bool => wistia_media_id((string) ($item['loop_video'] ?? '')) !== ''));

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

		<?php if ($has_loops) : ?>
			<button type="button" class="gallery__motion-toggle" hidden><?= esc_html__("Video's pauzeren", 'wesselvandenijssel'); ?></button>
		<?php endif; ?>

		<ul <?php attr($grid_attr); ?>>
			<?php foreach ($visible_items as $index => $item) :
				$link_attr = $get_link_attr($item, $group);
				$is_video = isset($link_attr['data-type']);
				$caption = $show_captions ? wp_get_attachment_caption((int) $item['image']) : '';
				$show_more = $hidden_count > 0 && $index === count($visible_items) - 1;

				$label = $is_video
					? sprintf(__('Bekijk video %1$d van %2$d', 'wesselvandenijssel'), $index + 1, $total)
					: sprintf(__('Vergroot afbeelding %1$d van %2$d', 'wesselvandenijssel'), $index + 1, $total);

				$image = wp_get_attachment_image((int) $item['image'], 'Content', false, [
					'class' => 'gallery__image',
					'loading' => 'lazy',
					'sizes' => ($layout === 'featured' && $index > 0) ? '(min-width: 740px) 33vw, 50vw' : $sizes,
				]);
			?>
				<li class="gallery__item">
					<figure class="gallery__figure">
						<a <?php attr($link_attr); ?>>
							<span class="screen-reader-text"><?= esc_html($label); ?></span>

							<?= $image; ?>

							<?php if ($show_more) : ?>
								<span class="gallery__more" aria-hidden="true">+<?= esc_html((string) $hidden_count); ?></span>
								<span class="screen-reader-text"><?= esc_html(sprintf(_n('(nog %d afbeelding in de lightbox)', '(nog %d afbeeldingen in de lightbox)', $hidden_count, 'wesselvandenijssel'), $hidden_count)); ?></span>
							<?php endif; ?>
						</a>

						<?php if (!empty($caption)) : ?>
							<figcaption class="gallery__caption"><?= esc_html(wp_strip_all_tags($caption)); ?></figcaption>
						<?php endif; ?>
					</figure>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php if (!empty($hidden_items)) : ?>
			<div class="gallery__hidden" hidden>
				<?php foreach ($hidden_items as $item) :
					$link_attr = $get_link_attr($item, $group);
					$link_attr['tabindex'] = '-1';
				?>
					<a <?php attr($link_attr); ?>></a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>
</section>
<?= !is_admin() ? '[/raw]' : ''; ?>
