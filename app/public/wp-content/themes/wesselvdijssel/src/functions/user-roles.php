<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * Registers the "Subbeheerder" role: all administrator capabilities except those that install or edit code.
 */
function register_subadmin_role(): void {
	if (get_option('subadmin_role_version') === '2') return;

	$administrator = get_role('administrator');

	if (!$administrator) return;

	$excluded = [
		'activate_plugins',
		'delete_plugins',
		'edit_plugins',
		'install_plugins',
		'update_plugins',
		'upload_plugins',
		'delete_themes',
		'edit_themes',
		'install_themes',
		'switch_themes',
		'update_themes',
		'upload_themes',
		'edit_files',
		'update_core',
	];

	$capabilities = array_diff_key($administrator->capabilities, array_flip($excluded));
	$capabilities['gform_full_access'] = true;

	remove_role('subadmin');
	add_role('subadmin', 'Subbeheerder', $capabilities);
	update_option('subadmin_role_version', '2');
}
add_action('init', 'register_subadmin_role');

/**
 * Hides the Administrator role from role dropdowns for non-administrators.
 *
 * @param array $roles the editable roles
 */
function hide_administrator_editable_roles(array $roles): array {
	if (!in_array('administrator', (array) wp_get_current_user()->roles, true)) {
		unset($roles['administrator']);
	}

	return $roles;
}
add_filter('editable_roles', 'hide_administrator_editable_roles');

/**
 * Stops non-administrators from editing, promoting or deleting administrator accounts.
 *
 * @param array $caps the primitive capabilities required
 * @param string $cap the meta capability being checked
 * @param int $user_id the user being checked
 * @param array $args the target user ID as the first item
 */
function protect_administrator_accounts(array $caps, string $cap, int $user_id, array $args): array {
	if (!in_array($cap, ['edit_user', 'delete_user', 'promote_user', 'remove_user'], true) || empty($args[0])) return $caps;

	$target = get_userdata((int) $args[0]);
	$current = get_userdata($user_id);

	if ($target && in_array('administrator', $target->roles, true) && (!$current || !in_array('administrator', $current->roles, true))) {
		$caps[] = 'do_not_allow';
	}

	return $caps;
}
add_filter('map_meta_cap', 'protect_administrator_accounts', 10, 4);

/**
 * Rejects a default role the current user may not assign.
 *
 * @param mixed $value the new default role
 * @param mixed $old_value the current default role
 */
function restrict_default_role($value, $old_value) {
	if (!is_user_logged_in()) return $value;

	if (!function_exists('get_editable_roles')) {
		require_once ABSPATH . 'wp-admin/includes/user.php';
	}

	return array_key_exists($value, get_editable_roles()) ? $value : $old_value;
}
add_filter('pre_update_option_default_role', 'restrict_default_role', 10, 2);

/**
 * Gives subadmins access to WP Schema Pro.
 *
 * @param array $roles the roles with access
 */
function wp_schema_pro_access($roles) {
	return array_merge((array) $roles, ['subadmin']);
}
add_filter('wp_schema_pro_role', 'wp_schema_pro_access');
