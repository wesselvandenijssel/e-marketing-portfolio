<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * Gecentreerde content Block Template.
 */

$section = general_section($block, [
	'class' => ['section', 'centered-content'],
]);

$weeks = [];

if (($variant ?? '') === 'intro') {
	$section['class'][] = 'centered-content--intro';

	$contributions = wesselvandenijssel_github_contributions(wesselvandenijssel_github_username());
	$weeks = array_slice(wesselvandenijssel_github_weeks($contributions['days'] ?? []), -20);
}

if (empty($content)) return;

echo !is_admin() ? '[raw]' : '';
?>

<section <?php attr($section); ?>>
	<div class="columns-12 center">

		<div class="centered-content__wrapper">
			<?php if (!empty($block_title['main_title'])) {
				layout("title", [
					'title' => $block_title,
					'block' => $block,
				]);
			}

			layout("content", [
				'content' => $content,
				'block' => $block,
			]); ?>
		</div>

		<?php if (!empty($weeks)) : ?>
			<div class="centered-content__pattern" aria-hidden="true">
				<?php foreach ($weeks as $week) : ?>
					<span class="centered-content__week">
						<?php foreach ($week as $day) : ?>
							<span class="centered-content__day centered-content__day--<?= $day ? 'level-' . esc_attr((string) (int) $day['level']) : 'empty'; ?>"></span>
						<?php endforeach; ?>
					</span>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>
</section>
<?= !is_admin() ? '[/raw]' : ''; ?>
