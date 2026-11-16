<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

$column_value = $column_value ?? [];

if (empty($column_value)) return;
?>

<?php
switch ($column_value['acf_fc_layout']):
	case 'title':

		if (empty($column_value['title'])) break;

		$title_look = !empty($column_value['title_type']) ? $column_value['title_type'] : 'h4'; ?>

		<div class="footer__titles">
			<p class="footer__main-title <?= esc_attr($title_look); ?>"><?= sanitize_title_custom($column_value['title']); ?></p>
		</div>
	<?php break;

	case 'text':
		if (empty($column_value['text'])) break; ?>
		<div class="footer__text"><?= wp_kses_post($column_value['text']); ?></div>
		<?php break;

	case 'image':
		if (!empty($column_value['image'])) {
			echo wp_get_attachment_image($column_value['image'], 'full', false, ['class' => 'footer__image', 'loading' => 'lazy']);
		}
		break;

	case 'contact_details': ?>
		<?php $contact_details_cf = get_field('contact_details', 'options') ?? []; ?>

		<?php if (is_array($column_value['contact_details'])) : ?>
			<div class="footer__cd">
				<?php foreach ($column_value['contact_details'] as $contact_detail) : ?>
					<?php
					switch ($contact_detail):
						case 'phone':
							if (empty($contact_details_cf['phone']) || empty($contact_details_cf['phone_link']))
								continue 2;
					?>
							<a href="<?= esc_url($contact_details_cf['phone_link']['url'] ?? ''); ?>"
								title="<?= esc_attr($contact_details_cf['phone_link']['title'] ?? ''); ?>" class="footer__cd-item footer__cd-item--phone">
								<?= esc_html($contact_details_cf['phone']); ?>
							</a><br>
						<?php
							break;

						case 'email':
							if (empty($contact_details_cf['email']) || empty($contact_details_cf['email_link']))
								continue 2;
						?>
							<a href="<?= esc_url($contact_details_cf['email_link']['url'] ?? ''); ?>"
								title="<?= esc_attr($contact_details_cf['email_link']['title'] ?? ''); ?>" class="footer__cd-item footer__cd-item--email">
								<?= esc_html($contact_details_cf['email']); ?>
							</a><br>
						<?php
							break;

						case 'address':
							$address = $contact_details_cf['address_data'] ?? [];

							if (empty($address['link'])) :
								$address_parts = array_filter([
									$address['street'] ?? '',
									trim(($address['zip'] ?? '') . ' ' . ($address['city'] ?? '')),
								]);

								if (empty($address_parts))
									continue 2;

								$address_parts[] = __('Nederland', 'wesselvandenijssel');
						?>
								<span class="footer__cd-item footer__cd-item--address"><?= esc_html(implode(', ', $address_parts)); ?></span><br>
						<?php
								break;
							endif;
						?>
							<a href="<?= esc_url($contact_details_cf['address_data']['link']['url'] ?? ''); ?>"
								title="<?= esc_attr($contact_details_cf['address_data']['link']['title'] ?? ''); ?>"
								target="_blank"
								rel="noopener noreferrer"
								class="footer__cd-item footer__cd-item--address">
								<?= esc_html($contact_details_cf['address_data']['street'] ?? ''); ?><br>
								<?= esc_html($contact_details_cf['address_data']['zip'] ?? ''); ?>
								<?= esc_html($contact_details_cf['address_data']['city'] ?? ''); ?>
							</a><br>
					<?php
							break;
					endswitch;
					?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<?php
		break;

	case 'social_media':
		component('socials');
		break;

	case 'menu':
		if (!empty($column_value['menu']) && $column_value['menu'] != 'Geen') :

			$visible_amount = (int) ($column_value['visible_amount'] ?? 4);
			$foldable = !empty($column_value['foldable']);

			if ($foldable) {
				$menu_items = wp_get_nav_menu_items($column_value['menu']) ?: [];

				$top_level_amount = count(array_filter($menu_items, function ($menu_item) {
					return empty($menu_item->menu_item_parent);
				}));

				$foldable = $top_level_amount > $visible_amount;
			}

			wp_nav_menu(
				[
					'menu' => $column_value['menu'],
					'container_class' => 'footer__menu',
					'fallback_cb' => false,
					'depth' => 1,
					'walker' => ($foldable ? new Walker_Fold_Menu : ''),
					'visible_amount' => $visible_amount,
				]
			);

			if ($foldable) : ?>
				<button type="button" class="footer__menu-fold-button" aria-expanded="false"><?= esc_html($column_value['foldable_text'] ?? ''); ?></button>
<?php endif;
		endif;
		break;
endswitch; ?>
