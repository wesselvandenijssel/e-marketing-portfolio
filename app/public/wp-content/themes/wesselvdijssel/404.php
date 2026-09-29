<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package wesselvandenijssel
 */

get_header(); ?>

<div id="primary" class="content-area">
	<section class="centered-content error-404 pad--top-medium pad--bottom-medium">
		<div class="columns-12 center">
			<div class="centered-content__wrapper">
				<div class="content-layout">
					<?php $not_found = get_field('not_found', 'options');

					if (!empty($not_found['content'])) :
						layout("content", [
							'content' => $not_found['content'],
							'block' => [],
						]);

					else :

						$title = new BlockTitle(esc_html__('Deze pagina bestaat niet', 'wesselvandenijssel'));
						$title->setSubtitle(esc_html__('Foutcode 404', 'wesselvandenijssel'));
						$title->setType('h1');
						echo $title->getTitle();

						$projects_page = get_page_by_path('projecten');
						$contact_page = get_page_by_path('contact');
					?>

						<p><?= esc_html__('De pagina die je zoekt is verplaatst of verwijderd. Ga terug naar de homepagina, bekijk mijn projecten of neem contact met me op.', 'wesselvandenijssel'); ?></p>

						<div class="buttons">
							<?php
							$home_button = new BlockButton(esc_html__('Naar de homepagina', 'wesselvandenijssel'));
							$home_button->set_type('btn btn--primary');
							$home_button->set_link(home_url('/'), esc_attr__('Naar de homepagina', 'wesselvandenijssel'), '');
							echo $home_button->get_button();

							if ($projects_page instanceof WP_Post) {
								$projects_button = new BlockButton(esc_html__('Bekijk mijn projecten', 'wesselvandenijssel'));
								$projects_button->set_type('btn btn--secondary');
								$projects_button->set_link(get_permalink($projects_page), esc_attr__('Bekijk mijn projecten', 'wesselvandenijssel'), '');
								echo $projects_button->get_button();
							}

							if ($contact_page instanceof WP_Post) {
								$contact_button = new BlockButton(esc_html__('Neem contact op', 'wesselvandenijssel'));
								$contact_button->set_type('btn btn--secondary');
								$contact_button->set_link(get_permalink($contact_page), esc_attr__('Neem contact op', 'wesselvandenijssel'), '');
								echo $contact_button->get_button();
							}
							?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
</div>

<?php get_footer(); ?>
