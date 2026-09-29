<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * Icoonblokken Block Template.
 */

$section = general_section($block, [
	'class' => ['section', 'icon-boxes'],
]);

$block_title = $block_title ?? [];
$boxes = $boxes ?? [];
$buttons_group = $buttons_group ?? [];

if (empty($boxes) || !is_array($boxes)) return;

$columns = in_array((string) ($columns ?? ''), ['2', '3', '4'], true) ? (string) $columns : '3';

$box_heading = 'h3';

if (!empty($block_title['main_title'])) {
	$title_level = (!empty($block_title['type']) && $block_title['type'] !== 'default')
		? (int) substr($block_title['type'], 1)
		: calculate_title_element($block);

	$box_heading = 'h' . min($title_level + 1, 6);
}

echo !is_admin() ? '[raw]' : '';
?>

<section <?php attr($section); ?>>
	<div class="columns-12 center">

		<?php if (!empty($block_title['main_title'])) {
			layout('title', [
				'title' => $block_title,
				'block' => $block,
				'centered' => true,
			]);
		} ?>

		<div class="icon-boxes__grid icon-boxes__grid--cols-<?= esc_attr($columns); ?>">
			<?php foreach ($boxes as $box) :
				$box_title = $box['title'] ?? '';
				$box_text = $box['text'] ?? '';
				$box_icon = $box['icon'] ?? '';
				$box_link = $box['link'] ?? [];

				if (empty($box_title) && empty($box_text)) continue;

				$has_link = !empty($box_link['url']);
				$tag = $has_link ? 'a' : 'div';

				$box_attr = [];
				$box_attr['class'][] = 'icon-boxes__box';

				if ($has_link) {
					$box_attr['class'][] = 'icon-boxes__box--link';
					$box_attr['href'] = esc_url($box_link['url']);

					if (!empty($box_link['title'])) {
						$box_attr['title'] = esc_attr($box_link['title']);
					}

					if (!empty($box_link['target']) && $box_link['target'] === '_blank') {
						$box_attr['target'] = '_blank';
						$box_attr['rel'] = 'noopener noreferrer';
					}
				}
			?>
				<<?= $tag; ?> <?php attr($box_attr); ?>>
					<?php if (!empty($box_icon) && $box_icon !== 'none') : ?>
						<span class="icon-boxes__icon" aria-hidden="true"><?= wp_kses_post($box_icon); ?></span>
					<?php endif; ?>

					<?php if (!empty($box_title)) : ?>
						<<?= $box_heading; ?> class="icon-boxes__title"><?= esc_html($box_title); ?></<?= $box_heading; ?>>
					<?php endif; ?>

					<?php if (!empty($box_text)) : ?>
						<p class="icon-boxes__text"><?= nl2br(esc_html($box_text)); ?></p>
					<?php endif; ?>
				</<?= $tag; ?>>
			<?php endforeach; ?>
		</div>

		<?php if (!empty($buttons_group)) {
			$buttons = new BlockButtons($buttons_group);
			echo $buttons->get_buttons();
		} ?>

	</div>
</section>
<?= !is_admin() ? '[/raw]' : ''; ?>
