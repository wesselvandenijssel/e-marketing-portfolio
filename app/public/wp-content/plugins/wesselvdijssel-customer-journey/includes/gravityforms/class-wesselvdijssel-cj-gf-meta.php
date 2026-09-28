<?php defined('ABSPATH') || exit;

class WESSELVDIJSSEL_CJ_GF_Meta {

	public static function register_entry_meta(array $entry_meta, $_form_id): array {

		$entry_meta[WESSELVDIJSSEL_CJ_GravityForms::META_KEY] = [
			'label' => __('Wesselvdijssel | Customer Journey', 'wesselvdijssel-customer-journey'),
			'is_numeric' => false,
			'is_default_column' => false,
		];

		return $entry_meta;
	}
}
