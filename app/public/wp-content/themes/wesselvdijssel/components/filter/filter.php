<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

$terms = $terms ?? [];
$name = $name ?? 'category';
$anchor = $anchor ?? '';
$all_label = $all_label ?? __('Toon alles', 'wesselvandenijssel');
$select_label = $select_label ?? __('Filter', 'wesselvandenijssel');

if (empty($terms) || is_wp_error($terms)) return;

$active = '*';

if (isset($_GET[$name])) {
	$active = sanitize_text_field(wp_unslash($_GET[$name]));
}

$action = get_the_permalink();

if (!empty($anchor)) {
	$action = '#' . $anchor;
}
?>

<div class="filter">
	<form class="filter__buttons" method="GET" action="<?= esc_attr($action); ?>">
		<button type="submit" name="<?= esc_attr($name); ?>" value="*" class="btn__filter<?= $active === '*' ? ' btn__filter--active" aria-current="true' : ''; ?>">
			<?= esc_html($all_label); ?>
		</button>

		<?php foreach ($terms as $term) : ?>
			<button type="submit" name="<?= esc_attr($name); ?>" value="<?= esc_attr($term->slug); ?>" class="btn__filter<?= $active === $term->slug ? ' btn__filter--active" aria-current="true' : ''; ?>">
				<?= esc_html($term->name); ?>
			</button>
		<?php endforeach; ?>
	</form>

	<form class="filter__mobile" method="GET" action="<?= esc_attr($action); ?>">
		<div class="filter__field">
			<select class="filter__select" name="<?= esc_attr($name); ?>" aria-label="<?= esc_attr($select_label); ?>">
				<option value="*" <?= $active === '*' ? 'selected' : ''; ?>>
					<?= esc_html($all_label); ?>
				</option>

				<?php foreach ($terms as $term) : ?>
					<option value="<?= esc_attr($term->slug); ?>" <?= $active === $term->slug ? 'selected' : ''; ?>>
						<?= esc_html($term->name); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>

		<button type="submit" class="btn btn--primary filter__submit"><span><?= esc_html__('Filteren', 'wesselvandenijssel'); ?></span></button>
	</form>
</div>
