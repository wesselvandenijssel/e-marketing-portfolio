<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * None Post Content Template
 */
?>

<div class="post post--empty">
	<h2 class="post__title">
		<?= esc_html__('Niets gevonden', 'wesselvandenijssel'); ?>
	</h2>

	<p class="post__excerpt">
		<?= esc_html__('Er zijn geen resultaten voor je zoekopdracht. Probeer het opnieuw met andere zoekwoorden.', 'wesselvandenijssel'); ?>
	</p>

	<div class="buttons">
		<a class="btn btn--primary" href="<?= esc_url(home_url('/')); ?>">
			<?= esc_html__('Naar de homepagina', 'wesselvandenijssel'); ?>
		</a>
	</div>
</div>
