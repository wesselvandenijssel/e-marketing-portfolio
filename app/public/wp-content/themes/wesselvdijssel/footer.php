<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package wesselvandenijssel
 */
?>
<div class="popups">
	<?php footer_popups(); ?>
</div>
</main>

<?php $footer = get_field('footer', 'footer') ?? [];
$footer_columns = array_filter((array) ($footer['footer_column'] ?? []));

if (!empty($footer_columns) || !empty($footer['sub_footer'])) : ?>
	<footer class="footer">

		<?php if (!empty($footer_columns)) : ?>
			<div class="footer__main-wrapper">
				<div class="footer__main">
					<?php foreach ($footer_columns as $column_key => $column) : ?>
						<div class="footer__column <?= esc_attr($column_key); ?>">
							<?php
							if (is_array($column)) {
								foreach ($column as $column_value) :
									component('footer-column', ['column_value' => $column_value ?? []]);
								endforeach;
							} ?>
						</div>

					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="footer__bottom">
			<div class="footer__bottom-wrapper">
				<?= wp_kses_post($footer['sub_footer'] ?? ''); ?>
			</div>

			<a class="footer__top-link" href="#page">
				<span class="screen-reader-text"><?= esc_html__('Terug naar boven', 'wesselvandenijssel'); ?></span>
			</a>
		</div>

	</footer>
<?php endif; ?>

</div>

<?php wp_footer(); ?>

</body>

</html>
