<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * The template for displaying search forms
 *
 * @package wesselvandenijssel
 */
?>
<form role="search" method="get" class="search-form" action="<?= esc_url(home_url('/')); ?>">
	<label>
		<span class="screen-reader-text"><?= esc_html__('Zoek naar:', 'wesselvandenijssel'); ?></span>
		<input type="search" class="search-field" placeholder="<?= esc_attr_x('Zoeken&hellip;', 'placeholder', 'wesselvandenijssel'); ?>" value="<?= esc_attr(get_search_query()); ?>" name="s">
	</label>
	<button type="submit" class="btn btn--primary"><?= esc_html__('Zoek', 'wesselvandenijssel'); ?></button>
</form>
