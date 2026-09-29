<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * Logo banner Block Template.
 */

$block_title = $block_title ?? [];
$logos = $logos ?? [];

if (empty($logos) || !is_array($logos)) return;

$section = general_section($block, [
	'class' => ['section', 'logo-banner'],
]);

if (!empty($grayscale)) {
	$section['class'][] = 'logo-banner--grayscale';
}

$logo_args = [
	'logos' => $logos,
	'shuffle' => !empty($shuffle),
	'max_amount' => !empty($max_amount) ? (int) $max_amount : false,
	'swiper' => false,
];

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

		<?php component('logo-wrapper', $logo_args); ?>
	</div>
</section>
<?= !is_admin() ? '[/raw]' : ''; ?>
