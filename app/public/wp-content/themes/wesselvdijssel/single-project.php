<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * The Template for displaying a single project.
 *
 * @package wesselvandenijssel
 */

if (!function_exists('get_field')) {
	echo 'Activate ACF for this theme to work';
	return;
}

// The overview lives on the page "Projecten"; fall back to its expected URL when the page is missing
$projects_page = get_page_by_path('projecten');
$projects_url = $projects_page instanceof WP_Post ? get_permalink($projects_page) : home_url('/projecten/');

get_header(); ?>

<div id="primary" class="content-area">

	<?php while (have_posts()) : the_post();
		// Keep the categories and image of a password-protected project hidden until it is unlocked
		$is_locked = post_password_required();
		$project_categories = get_the_terms(get_the_ID(), 'project_category');
		$project_categories = (!$is_locked && !empty($project_categories) && !is_wp_error($project_categories)) ? $project_categories : [];
		?>

		<div class="entry-content">
			<?php component('breadcrumb'); ?>

			<section class="section centered-content pad--top-large">
				<div class="columns-12 center">
					<div class="centered-content__wrapper">

						<div class="titles">
							<h1 class="main-title default"><?= esc_html(get_the_title()); ?></h1>
						</div>

						<?php if (!empty($project_categories) || (!$is_locked && has_post_thumbnail())) : ?>
							<div class="content-layout">
								<?php if (!empty($project_categories)) : ?>
									<p class="single__categories">
										<?= esc_html(_n('Categorie:', 'Categorieën:', count($project_categories), 'wesselvandenijssel')); ?>
										<strong><?= esc_html(implode(', ', wp_list_pluck($project_categories, 'name'))); ?></strong>
									</p>
								<?php endif; ?>

								<?php if (!$is_locked && has_post_thumbnail()) : ?>
									<div class="image">
										<?= wp_get_attachment_image(get_post_thumbnail_id(), 'Hero 900', false, ['class' => 'single__image', 'fetchpriority' => 'high']); ?>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>

					</div>
				</div>
			</section>

			<?php if (!$is_locked) : ?>
				<section class="section centered-content pad--top-medium">
					<div class="columns-12 center">
						<div class="centered-content__wrapper">
							<div class="content-layout">
								<?php component('project-details', ['post_id' => get_the_ID()]); ?>
							</div>
						</div>
					</div>
				</section>
			<?php endif; ?>

			<div id="read-more" class="single__content">
				<?php the_content(); ?>
			</div>

			<section class="section centered-content pad--bottom-medium">
				<div class="columns-12 center">
					<div class="centered-content__wrapper">
						<div class="content-layout">
							<div class="single__footer">
								<div class="single__return">
									<a class="btn btn--read-more" href="<?= esc_url($projects_url); ?>">
										<?= esc_html__('Terug naar projecten', 'wesselvandenijssel'); ?>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

	<?php endwhile; ?>

</div>
<?php get_footer(); ?>
