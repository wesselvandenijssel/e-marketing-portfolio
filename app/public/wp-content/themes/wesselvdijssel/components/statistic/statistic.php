<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

$prefix = $prefix ?? '';
$number = $number ?? '';
$end_number = $end_number ?? '';
$suffix = $suffix ?? '';
$label = $label ?? '';
$description = $description ?? '';

if (!is_numeric($number)) return;

$is_range = is_numeric($end_number);

$count_decimals = static function ($value): int {
	$parts = explode('.', (string) $value);

	return isset($parts[1]) ? min(strlen(rtrim($parts[1], '0')), 2) : 0;
};

$decimals = max($count_decimals($number), $is_range ? $count_decimals($end_number) : 0);

$format = static fn($value): string => number_format((float) $value, $decimals, ',', '.');

$visible_value = $is_range ? sprintf('%s-%s', $format($number), $format($end_number)) : $format($number);

$spoken_value = $is_range
	? sprintf(__('%1$s tot %2$s', 'wesselvandenijssel'), $format($number), $format($end_number))
	: $format($number);
$spoken_value = trim(sprintf('%s%s %s', $prefix, $spoken_value, $suffix));

$count_attr = [];
$count_attr['class'][] = 'statistic__count';
$count_attr['data-target'] = (string) ($is_range ? $end_number : $number);
$count_attr['data-decimals'] = (string) $decimals;

if ($is_range) {
	$count_attr['data-start'] = (string) $number;
}
?>

<li class="statistic">
	<p class="statistic__value">
		<span class="screen-reader-text"><?= esc_html($spoken_value); ?></span>

		<span class="statistic__number" aria-hidden="true">
			<?php if ($prefix !== '') : ?>
				<span class="statistic__affix"><?= esc_html($prefix); ?></span>
			<?php endif; ?>

			<span <?php attr($count_attr); ?>><?= esc_html($visible_value); ?></span>

			<?php if ($suffix !== '') : ?>
				<span class="statistic__affix"><?= esc_html($suffix); ?></span>
			<?php endif; ?>
		</span>
	</p>

	<?php if (!empty($label)) : ?>
		<p class="statistic__label"><?= esc_html($label); ?></p>
	<?php endif; ?>

	<?php if (!empty($description)) : ?>
		<p class="statistic__description"><?= nl2br(wp_kses($description, ['a' => ['href' => [], 'target' => [], 'rel' => []]])); ?></p>
	<?php endif; ?>
</li>
