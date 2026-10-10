<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

if (empty(get_field('project_cta', 'utilities'))) return;

$block_title = get_field('block_title', 'utilities') ?: [];
$buttons_group = get_field('buttons_group', 'utilities') ?: [];

if (empty($block_title['main_title']) && empty($buttons_group)) return;

if (empty($block_title['type']) || $block_title['type'] === 'default') {
	$block_title['type'] = 'h2';
}
?>

<section class="section cta-banner project-cta pad--top-medium pad--bottom-medium">
	<div class="columns-12 center">
		<div class="cta-banner__card cta-banner__card--dark">
			<?php if (!empty($block_title['main_title'])) : ?>
				<div class="cta-banner__content">
					<?php layout('title', [
						'title' => $block_title,
						'block' => ['id' => 'project-cta'],
					]); ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($buttons_group) && is_array($buttons_group)) {
				$buttons = new BlockButtons($buttons_group);
				echo $buttons->get_buttons();
			} ?>
		</div>
	</div>
</section>
