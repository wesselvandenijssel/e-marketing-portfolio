<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * Quote slider Block Template.
 */

$section = general_section($block, [
	'class' => ['section', 'quote-slider'],
]);

$quotes = $quotes ?? [];
$block_title = $block_title ?? [];

$quotes = array_values(array_filter((array) $quotes, fn($item) => !empty($item['quote'])));

if (empty($quotes)) return;

$is_slider = count($quotes) > 1;

$slider_attr = [];
$slider_attr['class'][] = 'quote-slider__slider';

if ($is_slider) {
	$slider_attr['class'][] = 'swiper';

	$slider_attr['data-label-first'] = __('Dit is de eerste quote', 'wesselvandenijssel');
	$slider_attr['data-label-last'] = __('Dit is de laatste quote', 'wesselvandenijssel');
	$slider_attr['data-label-slide'] = __('Quote {{index}} van {{slidesLength}}', 'wesselvandenijssel');
}

echo !is_admin() ? '[raw]' : '';
?>

<section <?php attr($section); ?>>
	<div class="columns-10 center">

		<?php if (!empty($block_title['main_title'])) {
			layout('title', [
				'title' => $block_title,
				'block' => $block,
				'centered' => true,
			]);
		} ?>

		<div <?php attr($slider_attr); ?>>
			<?php if ($is_slider) : ?>
				<div class="swiper-wrapper">
				<?php endif; ?>

				<?php foreach ($quotes as $item) :
					component('quote-slide', [
						'quote' => $item['quote'] ?? '',
						'name' => $item['name'] ?? '',
						'role' => $item['role'] ?? '',
						'image' => $item['image'] ?? 0,
						'swiper' => $is_slider,
					]);
				endforeach; ?>

				<?php if ($is_slider) : ?>
				</div>

				<div class="quote-slider__buttons swiper-buttons">
					<button type="button" class="quote-slider__button quote-slider__button--prev swiper-button-prev" aria-label="<?= esc_attr__('Vorige', 'wesselvandenijssel'); ?>"></button>
					<button type="button" class="quote-slider__button quote-slider__button--next swiper-button-next" aria-label="<?= esc_attr__('Volgende', 'wesselvandenijssel'); ?>"></button>
				</div>
			<?php endif; ?>
		</div>

	</div>
</section>
<?= !is_admin() ? '[/raw]' : ''; ?>
