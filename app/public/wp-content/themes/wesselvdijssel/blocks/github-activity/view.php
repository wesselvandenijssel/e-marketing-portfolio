<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * GitHub-activiteit Block Template.
 */

$data = wesselvandenijssel_github_contributions((string) $username);

if (empty($data)) return;

$section = general_section($block, [
	'class' => ['section', 'github-activity'],
]);

$weeks = wesselvandenijssel_github_weeks($data['days']);

$total = number_format_i18n($data['total']);
$profile_url = 'https://github.com/' . rawurlencode($username);

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

		<p class="github-activity__total">
			<?= wp_kses_post(sprintf(__('%s bijdragen op GitHub in het afgelopen jaar', 'wesselvandenijssel'), '<strong>' . esc_html($total) . '</strong>')); ?>
		</p>

		<div class="github-activity__scroll">
			<div class="github-activity__grid" role="img" aria-label="<?= esc_attr(sprintf(__('Kalender met %s bijdragen op GitHub in het afgelopen jaar', 'wesselvandenijssel'), $total)); ?>">
				<?php foreach ($weeks as $days) : ?>
					<div class="github-activity__week">
						<?php foreach ($days as $day) :
							if (empty($day)) : ?>
								<span class="github-activity__day github-activity__day--empty"></span>
							<?php continue;
							endif;

							$tooltip = sprintf(
								_n('%1$s bijdrage op %2$s', '%1$s bijdragen op %2$s', $day['count'], 'wesselvandenijssel'),
								number_format_i18n($day['count']),
								wp_date('j F Y', strtotime($day['date']))
							); ?>
							<span class="github-activity__day github-activity__day--level-<?= esc_attr((string) $day['level']); ?>" title="<?= esc_attr($tooltip); ?>"></span>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="github-activity__footer">
			<div class="github-activity__legend" aria-hidden="true">
				<span><?= esc_html__('Minder', 'wesselvandenijssel'); ?></span>
				<?php for ($level = 0; $level <= 4; $level++) : ?>
					<span class="github-activity__day github-activity__day--level-<?= esc_attr((string) $level); ?>"></span>
				<?php endfor; ?>
				<span><?= esc_html__('Meer', 'wesselvandenijssel'); ?></span>
			</div>

			<a class="btn btn--secondary" href="<?= esc_url($profile_url); ?>" target="_blank" rel="noopener noreferrer"><?= esc_html__('Bekijk mijn GitHub', 'wesselvandenijssel'); ?></a>
		</div>
	</div>
</section>
<?= !is_admin() ? '[/raw]' : ''; ?>
