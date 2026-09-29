<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

$quote = $quote ?? '';
$name = $name ?? '';
$role = $role ?? '';
$image = $image ?? 0;
$swiper = $swiper ?? false;

if (empty($quote)) return;

$slide_attr = [];
$slide_attr['class'][] = 'quote-slide';

if (!empty($swiper)) {
	$slide_attr['class'][] = 'swiper-slide';
}

$has_caption = !empty($name) || !empty($role) || !empty($image);
?>

<figure <?php attr($slide_attr); ?>>
	<blockquote class="quote-slide__quote">
		<p><?= nl2br(esc_html($quote)); ?></p>
	</blockquote>

	<?php if ($has_caption) : ?>
		<figcaption class="quote-slide__caption">
			<?php if (!empty($image)) :
				echo wp_get_attachment_image((int) $image, 'Avatar', false, [
					'class' => 'quote-slide__image',
					'alt' => '',
					'loading' => 'lazy',
					'sizes' => '64px',
				]);
			endif; ?>

			<?php if (!empty($name) || !empty($role)) : ?>
				<span class="quote-slide__person">
					<?php if (!empty($name)) : ?>
						<span class="quote-slide__name"><?= esc_html($name); ?></span>
					<?php endif; ?>

					<?php if (!empty($role)) : ?>
						<span class="quote-slide__role"><?= esc_html($role); ?></span>
					<?php endif; ?>
				</span>
			<?php endif; ?>
		</figcaption>
	<?php endif; ?>
</figure>
