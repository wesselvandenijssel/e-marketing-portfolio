<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * Statistieken Block Template.
 */

$section = general_section($block, [
	'class' => ['section', 'statistics'],
]);

$statistics = $statistics ?? [];
$block_title = $block_title ?? [];

$statistics = array_values(array_filter((array) $statistics, fn($item) => isset($item['number']) && is_numeric($item['number'])));

if (empty($statistics)) return;

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

		<ul class="statistics__grid" role="list">
			<?php foreach ($statistics as $statistic) :
				component('statistic', [
					'prefix' => $statistic['prefix'] ?? '',
					'number' => $statistic['number'],
					'end_number' => $statistic['end_number'] ?? '',
					'suffix' => $statistic['suffix'] ?? '',
					'label' => $statistic['label'] ?? '',
					'description' => $statistic['description'] ?? '',
				]);
			endforeach; ?>
		</ul>

	</div>
</section>
<?= !is_admin() ? '[/raw]' : ''; ?>
