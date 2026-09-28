<?php defined('ABSPATH') || exit;

class WESSELVDIJSSEL_CJ_GF_Metabox {

	public static function add_metabox(array $meta_boxes, array $_entry, array $_form): array {

		$meta_boxes['wesselvdijssel_cj'] = [
			'title' => __('Wesselvdijssel Customer Journey', 'wesselvdijssel-customer-journey'),
			'callback' => [__CLASS__, 'render_metabox'],
			'context' => 'side',
		];

		return $meta_boxes;
	}

	public static function render_metabox(array $args): void {

		$entry = $args['entry'];
		$raw = gform_get_meta($entry['id'], WESSELVDIJSSEL_CJ_GravityForms::META_KEY);
		$journey = !empty($raw) ? json_decode($raw, true) : null;

		if (!is_array($journey) || empty($journey)) {
			echo '<p style="color:#999;font-size:12px;">' . esc_html__('No journey data recorded for this entry.', 'wesselvdijssel-customer-journey') . '</p>';
			return;
		}

		echo '<ol style="margin:0;padding-left:1.2em;">';

		foreach ($journey as $step) {
			printf(
				'<li style="margin-bottom:6px;font-size:12px;">'
					. '<a href="%1$s" target="_blank" rel="noopener noreferrer" style="word-break:break-all;">%2$s</a>'
					. '<br><small style="color:#999;">%3$s</small>'
					. '</li>',
				esc_url($step['url']  ?? ''),
				esc_html($step['path'] ?? ''),
				esc_html(WESSELVDIJSSEL_CJ_GravityForms::format_timestamp($step['timestamp'] ?? ''))
			);
		}

		echo '</ol>';

		$count = count($journey);

		printf(
			'<p style="margin-top:8px;font-size:11px;color:#999;">%s</p>',
			esc_html(sprintf(_n('%d page visited', '%d pages visited', $count, 'wesselvdijssel-customer-journey'), $count))
		);
	}
}
