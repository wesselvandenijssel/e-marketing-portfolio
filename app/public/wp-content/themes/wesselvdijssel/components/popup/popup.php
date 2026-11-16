<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

$popup_id = $popup_id ?? '';
$title = $title ?? '';
$content = $content ?? [];

if (empty($popup_id)) return;

$popup = [];
$popup['class'][] = 'popup';
$popup['data-popup'] = (string) $popup_id;

if (!empty($title)) {
	$popup['aria-labelledby'] = 'popup-title-' . $popup_id;
} else {
	$popup['aria-label'] = __('Popup', 'wesselvandenijssel');
}
?>

<dialog <?php attr($popup); ?>>
	<button type="button" class="popup__close" aria-label="<?= esc_attr__('Sluit popup', 'wesselvandenijssel'); ?>"></button>
	<div class="popup__content">
		<?php if (!empty($title)) : ?>
			<div class="titles">
				<h2 class="h2" id="popup-title-<?= esc_attr($popup_id); ?>">
					<?= wp_kses_post($title); ?>
				</h2>
			</div>
		<?php endif; ?>

		<?php if (!empty($content)) {
			layout("content", [
				'content' => $content,
			]);
		}; ?>
	</div>
</dialog>
