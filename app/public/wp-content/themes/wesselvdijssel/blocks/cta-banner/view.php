<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * CTA banner Block Template.
 */

$section = general_section($block, [
	'class' => ['section', 'cta-banner'],
]);

$block_title = $block_title ?? [];
$image = $image ?? '';
$buttons_group = $buttons_group ?? [];

if (empty($block_title['main_title']) && empty($buttons_group)) return;

$style = in_array($style ?? '', ['light', 'dark'], true) ? $style : 'light';

$card = [];
$card['class'][] = 'cta-banner__card';
$card['class'][] = 'cta-banner__card--' . $style;

echo !is_admin() ? '[raw]' : '';
?>

<section <?php attr($section); ?>>
	<div class="columns-12 center">
		<div <?php attr($card); ?>>
			<?php if (!empty($block_title['main_title'])) : ?>
				<div class="cta-banner__content">
					<?php layout('title', [
						'title' => $block_title,
						'block' => $block,
					]); ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($image)) : ?>
				<div class="cta-banner__image-wrapper">
					<?= wp_get_attachment_image($image, 'Content', false, ['loading' => 'lazy', 'class' => 'cta-banner__image']); ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($buttons_group)) {
				$buttons = new BlockButtons($buttons_group);
				echo $buttons->get_buttons();
			} ?>
		</div>
	</div>
</section>
<?= !is_admin() ? '[/raw]' : ''; ?>
