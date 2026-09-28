<?php defined('ABSPATH') || exit;

class WESSELVDIJSSEL_CJ_GravityForms {

	const META_KEY = '_wesselvdijssel_cj_journey';
	const POST_FIELD = 'wesselvdijssel_cj_journey';

	public static function format_timestamp(string $raw): string {

		if (empty($raw)) {
			return '—';
		}

		$unix = strtotime($raw);

		if ($unix === false) {
			return $raw;
		}

		$dt = new DateTime("@$unix");
		$dt->setTimezone(new DateTimeZone('Europe/Amsterdam'));
		return $dt->format('d M Y, H:i');
	}

	public static function register_hooks(): void {

		if (!class_exists('GFForms')) {
			return;
		}

		add_filter('gform_entry_meta', ['WESSELVDIJSSEL_CJ_GF_Meta', 'register_entry_meta'], 10, 2);
		add_action('gform_entry_created', ['WESSELVDIJSSEL_CJ_GF_Submission', 'save_journey_meta'], 10, 2);
		add_filter('gform_entry_detail_meta_boxes', ['WESSELVDIJSSEL_CJ_GF_Metabox', 'add_metabox'], 10, 3);
		add_filter('gform_entries_column_filter', ['WESSELVDIJSSEL_CJ_GF_Column', 'format_column_value'], 10, 5);
		add_filter('gform_custom_merge_tags', ['WESSELVDIJSSEL_CJ_GF_Merge_Tags', 'register_merge_tag'], 10, 4);
		add_filter('gform_notification', ['WESSELVDIJSSEL_CJ_GF_Merge_Tags', 'process_notification'], 10, 3);
		add_filter('gform_replace_merge_tags', ['WESSELVDIJSSEL_CJ_GF_Merge_Tags', 'replace_merge_tag'], 10, 7);
	}
}

// Sub-classes are loaded after WESSELVDIJSSEL_CJ_GravityForms so they can reference its constants.
require_once __DIR__ . '/class-wesselvdijssel-cj-gf-meta.php';
require_once __DIR__ . '/class-wesselvdijssel-cj-gf-submission.php';
require_once __DIR__ . '/class-wesselvdijssel-cj-gf-metabox.php';
require_once __DIR__ . '/class-wesselvdijssel-cj-gf-merge-tags.php';
require_once __DIR__ . '/class-wesselvdijssel-cj-gf-column.php';
