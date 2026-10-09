<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * @package wesselvandenijssel
 */
?>

<a href="<?= esc_url(get_permalink()); ?>" title="<?= esc_attr(get_the_title()); ?>" class="search-result">
	<div class="search-result__content">
		<h2 class="search-result__title h3">
			<?= esc_html(get_the_title()); ?>
		</h2>

		<div class="buttons search-result__buttons">
			<span class="btn btn--read-more">
				<?= esc_html__('Lees meer', 'wesselvandenijssel'); ?>
			</span>
		</div>
	</div>
</a>
