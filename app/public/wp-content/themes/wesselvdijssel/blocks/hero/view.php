<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * Hero Block Template.
 */

$section = general_section($block, [
	'class' => ['section', 'hero'],
]);

$type = $type ?? '';
$size = $size ?? '';
$image = $image ?? '';
$video = $video ?? '';
$content = $content ?? [];
$block_title = $block_title ?? [];
$cutout = !empty($cutout);

$variant = !empty($variant) ? $variant : 'background';
$section['class'][] = 'hero--' . $variant;

if ($variant === 'portrait') {
	if (empty($image) && empty($block_title['main_title'])) return;
} else {
	if (empty($size)) return;

	$section['class'][] = 'hero--' . $size;

	switch ($type) {
		case 'image':
			if (empty($image))
				return;
			break;

		case 'video':
			if (empty($video))
				return;
			break;

		default:
			return;
			break;
	}

	$thumbnail = match ($size) {
		900 => 'Hero 900',
		default => 'Hero 900',
	};
}

echo !is_admin() ? '[raw]' : '';
?>

<section <?php attr($section); ?>>
	<?php if ($variant === 'portrait') : ?>
		<div class="hero__inner columns-12 center">
			<div class="hero__content">
				<?php if (!empty($block_title['main_title'])) {
					layout("title", [
						'title' => $block_title,
						'block' => $block,
					]);
				}

				if (!empty($content)) {
					layout("content", [
						'content' => $content,
						'block' => $block,
					]);
				} ?>
			</div>

			<?php if (!empty($image)) : ?>
				<?php $portrait = wesselvandenijssel_hero_portrait_image($cutout); ?>
				<div class="hero__portrait<?= $cutout ? ' hero__portrait--cutout' : ''; ?>">
					<?= wp_get_attachment_image($image, $portrait['size'], false, [
						'class' => 'hero__portrait-image',
						'fetchpriority' => 'high',
						'loading' => 'eager',
						'sizes' => $portrait['sizes'],
					]); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php else : ?>
		<div class="hero__media-wrapper">
			<?php
			switch ($type):
				case 'image':
					echo wp_get_attachment_image($image, $thumbnail, false, ['class' => 'hero__media hero__media--image hero__media--desktop', 'fetchpriority' => 'high']);
					echo wp_get_attachment_image($image, 'Hero mobile', false, ['class' => 'hero__media hero__media--image hero__media--mobile', 'fetchpriority' => 'high']);
					break;

				case 'video': ?>
					<div class="hero__media hero__media--video"><?= $video; ?></div>
			<?php
					break;

			endswitch;
			?>
		</div>

		<div class="hero__content columns-12 center">
			<?php if (!empty($block_title['main_title'])) {
				layout("title", [
					'title' => $block_title,
					'block' => $block,
				]);
			}

			if (!empty($content)) {
				layout("content", [
					'content' => $content,
					'block' => $block,
				]);
			} ?>
		</div>
	<?php endif; ?>
</section>

<?= !is_admin() ? '[/raw]' : ''; ?>
