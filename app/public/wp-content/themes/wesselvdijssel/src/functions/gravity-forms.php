<?php
defined('ABSPATH') || exit('Forbidden'); // Exit if accessed directly.

/**
 * Safely get and validate encrypted entry ID from $_GET parameter
 *
 * @return int|false Entry ID if valid, false otherwise
 */
function get_validated_entry_id() {
	if (!isset($_GET['entry']) || empty($_GET['entry'])) {
		return false;
	}

	// Verify nonce if present (for forms with nonce protection)
	if (isset($_GET['_wpnonce']) && !wp_verify_nonce($_GET['_wpnonce'], 'gf_entry_' . sanitize_text_field($_GET['entry']))) {
		return false;
	}

	$encrypted_entry = sanitize_text_field($_GET['entry']);
	$entry_id = encrypt_decrypt('decrypt', $encrypted_entry);

	// Validate that entry_id is numeric and exists
	if (!is_numeric($entry_id)) {
		return false;
	}

	return (int) $entry_id;
}

/* Gravity Forms anker */
add_filter('gform_confirmation_anchor', '__return_true');

// Slaat GF inzendingen in op zonder returns
// https://docs.gravityforms.com/gform_export_field_value/ --> 7
add_filter('gform_export_field_value', 'decode_export_values');
function decode_export_values($value) {
	$value = str_replace(["\n", "\t", "\r"], ' ', $value);
	return $value;
}

/**
 * Filters the next, previous and submit buttons.
 * Replaces the forms <input> buttons with <button> while maintaining attributes from original <input>.
 *
 * @param string $button Contains the <input> tag to be filtered.
 * @param object $form Contains all the properties of the current form.
 *
 * @return string The filtered button.
 */
add_filter('gform_next_button', 'input_to_button', 10, 2);
add_filter('gform_previous_button', 'input_to_button', 10, 2);
add_filter('gform_submit_button', 'input_to_button', 10, 2);
function input_to_button($button, $form) {
	$dom = new DOMDocument();
	$dom->loadHTML($button);
	$input = $dom->getElementsByTagName('input')->item(0);
	if (!$input) {
		return $button;
	}
	$new_button = $dom->createElement('button');
	$new_button->appendChild($dom->createTextNode($input->getAttribute('value')));
	$input->removeAttribute('value');
	foreach ($input->attributes as $attribute) {
		$new_button->setAttribute($attribute->name, $attribute->value);
	}
	$input->parentNode->replaceChild($new_button, $input);

	return $dom->saveHtml($new_button);
}

// Translate default form confirmation
function gform_spam_notification_translation($translated_text, $text, $domain) {
	$translated_text = match ($translated_text) {
		'Thanks for contacting us! We will get in touch with you shortly.!' => __('Er lijkt iets mis te gaan met de inzending... Probeer het nog eens of neem contact op per telefoon.', 'woocommerce'),
		'Bedankt voor je bericht! We zullen binnenkort contact met je opnemen.' => __('Er lijkt iets mis te gaan met de inzending... Probeer het nog eens of neem contact op per telefoon.', 'woocommerce'),
		default => $translated_text,
	};
	return $translated_text;
}
add_filter('gettext', 'gform_spam_notification_translation', 20, 3);

// Disable GF theme styling
add_filter('gform_disable_css', '__return_true');

// Shortcode to get a Gravity Forms field value from the entry parameter
function get_entry_value($atts) {
	$a = shortcode_atts([
		'field_id' => 0,
	], $atts);

	$entry_id = get_validated_entry_id();

	if (empty($entry_id) || !function_exists('gravity_form') || empty($a))
		return;

	$entry = GFAPI::get_entry($entry_id);

	if (is_wp_error($entry)) {
		return '';
	}

	return $entry[$a['field_id']] ?? '';
}
add_shortcode('get_entry_value', 'get_entry_value');

add_filter('gform_confirmation', 'add_encrypted_entry_id_to_confirmation_url', 10, 4);
function add_encrypted_entry_id_to_confirmation_url($confirmation, $form, $entry, $is_ajax) {
	if (is_array($confirmation) && isset($confirmation['redirect'])) {
		$entry_id_encrypted = encrypt_decrypt('encrypt', $entry['id']);
		$confirmation['redirect'] = add_query_arg('entry', $entry_id_encrypted, $confirmation['redirect']);
	}
	return $confirmation;
}

add_action('wp_footer', 'enqueue_datalayer_script_on_redirect');
function enqueue_datalayer_script_on_redirect() {
	$entry_id = get_validated_entry_id();

	if (!$entry_id)
		return;

	$entry = GFAPI::get_entry($entry_id);

	if (is_wp_error($entry))
		return;

	$form = GFAPI::get_form($entry['form_id']);
	$email_fields = [];

	foreach ($form['fields'] as $field) {
		if ($field->type !== 'email')
			continue;

		$field_id = $field->id;
		$label = $field->label;
		$value = rgar($entry, $field_id);

		$email_fields[] = [
			'id' => $field_id,
			'label' => $label,
			'value' => $value
		];
	}

	if (empty($email_fields))
		return;

	$datalayer = [
		'event' => 'formSubmission',
		'formId' => $form['id'],
		'formName' => $form['title'],
		'entryIdEncrypted' => encrypt_decrypt('encrypt', $entry_id),
		'emailFields' => $email_fields
	];

	$datalayer_json = json_encode($datalayer);
	$storage_key = 'formSubmission_' . $entry_id;

	echo "
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				if (!localStorage.getItem('$storage_key')) {
					window.dataLayer = window.dataLayer || [];
					var dataLayerData = $datalayer_json;
					window.dataLayer.push(dataLayerData);
					localStorage.setItem('$storage_key', 'true');
				}
			});
		</script>
	";
}


add_filter('gform_custom_merge_tags', 'custom_merge_tags', 10, 4);
function custom_merge_tags($merge_tags, $form_id, $fields, $element_id) {
	$merge_tags[] = [
		'label' => __('Formulier velden ({form_fields exclude="1,3,4"})', 'wesselvandenijssel'),
		'tag' => '{form_fields}',
	];

	$merge_tags[] = [
		'label' => __('Reply mail heading', 'wesselvandenijssel'),
		'tag' => '{reply_heading}',
	];

	$merge_tags[] = [
		'label' => __('Reply mail footer', 'wesselvandenijssel'),
		'tag' => '{reply_footer}',
	];

	return $merge_tags;
}

add_filter('gform_replace_merge_tags', 'replace_form_fields_merge_tag', 10, 7);
/**
 * Replaces {form_fields}, {reply_heading} and {reply_footer} with the branded reply mail markup.
 *
 * @param string $text The notification text
 * @param array|false $form The current form
 * @param array|false $entry The current entry
 * @param bool $url_encode Whether to URL encode the values
 * @param bool $esc_html Whether to escape the values
 * @param bool $nl2br Whether to convert new lines
 * @param string $format The output format
 * @return string
 */
function replace_form_fields_merge_tag($text, $form, $entry, $url_encode, $esc_html, $nl2br, $format) {
	preg_match('/\{form_fields(?:\s+exclude="([^"]*)")?\}/', $text, $matches);
	$merge_tag = $matches[0] ?? '{form_fields}';
	$excluded_ids = [];

	if (!empty($matches[1])) {
		$excluded_ids = array_map('intval', array_map('trim', explode(',', $matches[1])));
	}

	if ((strpos($text, $merge_tag) === false && strpos($text, '{reply_heading}') === false && strpos($text, '{reply_footer}') === false) || empty($entry) || empty($form)) {
		return $text;
	}

	$font = "font-family:'Helvetica Neue',Helvetica,Arial,sans-serif";
	$navy = '#00244d';
	$link = '#0077a8';
	$grey = '#475569';

	$rows = [];

	foreach ($form['fields'] as $field) {
		$field_id = $field['id'];

		if (in_array($field_id, $excluded_ids)) continue;

		if ($field['type'] === 'consent') {
			if (rgar($entry, $field_id . '.1')) {
				$rows[] = [$field['label'], esc_html__('Akkoord', 'wesselvandenijssel')];
			}

			continue;
		}

		$field_value = rgar($entry, $field_id);

		if (is_array($field_value)) {
			$field_value = implode(', ', $field_value);
		}

		if (!empty($field_value)) {
			if ($field['type'] === 'fileupload') {
				$value_html = '<a href="' . esc_url($field_value) . '" target="_blank" style="color:' . $link . ';">' . esc_html(basename($field_value)) . '</a>';
			} else {
				$value_html = nl2br(esc_html($field_value));
			}

			$rows[] = [$field['label'], $value_html];
		} elseif (($field['type'] === 'checkbox' || $field['type'] === 'multi_choice') && !empty($field['choices'])) {
			$checked = $field->get_value_export($entry);

			if ($checked !== '') {
				$rows[] = [$field['label'], esc_html($checked)];
			}
		} elseif (!empty($field['inputs'])) {
			$input_values = [];

			foreach ($field['inputs'] as $input) {
				$input_value = rgar($entry, $input['id']);

				if (!empty($input_value)) {
					$input_values[] = $input_value;
				}
			}

			if (!empty($input_values)) {
				$rows[] = [$field['label'], esc_html(implode(', ', $input_values))];
			}
		}
	}

	$form_fields = '';

	if (!empty($rows)) {
		$form_fields = '<table role="presentation" width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color:#e5f6fc;border-radius:12px;margin:8px 0 28px;">';

		foreach ($rows as $index => $row) {
			$padding_top = $index === 0 ? '20px' : '14px';
			$form_fields .= '<tr><td style="padding:' . $padding_top . ' 24px 0;' . $font . ';font-size:13px;line-height:1.4;font-weight:600;color:' . $grey . ';">' . esc_html($row[0]) . '</td></tr>';
			$form_fields .= '<tr><td style="padding:2px 24px 0;' . $font . ';font-size:16px;line-height:1.6;color:' . $navy . ';word-break:break-word;">' . $row[1] . '</td></tr>';
		}

		$form_fields .= '<tr><td style="height:20px;line-height:20px;font-size:0;">&nbsp;</td></tr></table>';
	}

	$site_name = get_bloginfo('name');
	$home_url = home_url('/');
	$site_host = wp_parse_url($home_url, PHP_URL_HOST);
	$person_schema = get_option('wesselvandenijssel_person_schema', []);
	$job_title = is_array($person_schema) ? ($person_schema['jobTitle'] ?? '') : '';
	$contact_details = get_field('contact_details', 'options') ?: [];
	$social_media = get_field('social_media', 'options') ?: [];

	$contact_links = [];

	if (!empty($contact_details['email'])) {
		$contact_links[] = '<a href="mailto:' . esc_attr($contact_details['email']) . '" style="color:' . $link . ';text-decoration:underline;white-space:nowrap;">' . esc_html($contact_details['email']) . '</a>';
	}

	if (!empty($contact_details['phone']) && !empty($contact_details['phone_link']['url'])) {
		$contact_links[] = '<a href="' . esc_url($contact_details['phone_link']['url']) . '" style="color:' . $link . ';text-decoration:underline;white-space:nowrap;">' . esc_html($contact_details['phone']) . '</a>';
	}

	if (!empty($social_media['linkedin']['url'])) {
		$contact_links[] = '<a href="' . esc_url($social_media['linkedin']['url']) . '" style="color:' . $link . ';text-decoration:underline;white-space:nowrap;">LinkedIn</a>';
	}

	$contact_links[] = '<a href="' . esc_url($home_url) . '" style="color:' . $link . ';text-decoration:underline;white-space:nowrap;">' . esc_html($site_host) . '</a>';

	$reply_heading_html = '<!doctype html>
<html lang="nl" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="color-scheme" content="light">
	<meta name="supported-color-schemes" content="light">
	<title>' . esc_html__('Bevestiging van je bericht', 'wesselvandenijssel') . '</title>
	<!--[if mso]><noscript><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml></noscript><![endif]-->
	<style type="text/css">
		body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
		table, td { border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
		a { color: ' . $link . '; }
		@media only screen and (max-width: 480px) {
			.mail-pad { padding-left: 20px !important; padding-right: 20px !important; }
			.mail-outer { padding: 16px 8px !important; }
		}
	</style>
</head>
<body style="margin:0;padding:0;background-color:#f8fafc;">
	<table role="presentation" width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color:#f8fafc;">
		<tr>
			<td class="mail-outer" align="center" style="padding:32px 16px;">
				<!--[if mso]><table role="presentation" width="600" border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
				<table role="presentation" width="100%" border="0" cellpadding="0" cellspacing="0" style="max-width:600px;background-color:#ffffff;border-radius:16px;overflow:hidden;">
					<tr>
						<td class="mail-pad" style="background-color:' . $navy . ';padding:28px 32px;' . $font . ';">
							<a href="' . esc_url($home_url) . '" style="' . $font . ';font-size:20px;line-height:1.3;font-weight:600;color:#ffffff;text-decoration:none;">' . esc_html($site_name) . '</a>'
		. ($job_title ? '<div style="' . $font . ';font-size:14px;line-height:1.5;color:#e5f6fc;padding-top:4px;">' . esc_html($job_title) . '</div>' : '') . '
						</td>
					</tr>
					<tr>
						<td style="height:4px;line-height:4px;font-size:0;background-color:#00a3e0;">&nbsp;</td>
					</tr>
					<tr>
						<td class="mail-pad" style="padding:32px 32px 8px;' . $font . ';font-size:16px;line-height:1.6;color:' . $navy . ';">
';

	$reply_footer_html = '
						</td>
					</tr>
					<tr>
						<td class="mail-pad" style="padding:0 32px 28px;' . $font . ';font-size:16px;line-height:1.6;color:' . $navy . ';">
							' . esc_html__('Met vriendelijke groet,', 'wesselvandenijssel') . '<br>
							<strong style="font-weight:600;">' . esc_html($site_name) . '</strong>
						</td>
					</tr>
					<tr>
						<td class="mail-pad" style="padding:20px 32px 24px;border-top:1px solid #e2e8f0;' . $font . ';font-size:14px;line-height:1.8;color:' . $grey . ';">
							' . implode(' &nbsp;&middot;&nbsp; ', $contact_links) . '
						</td>
					</tr>
				</table>
				<!--[if mso]></td></tr></table><![endif]-->
				<p style="margin:16px 0 0;' . $font . ';font-size:13px;line-height:1.5;color:' . $grey . ';text-align:center;">
					' . sprintf(esc_html__('Je krijgt deze mail omdat je het contactformulier op %s hebt ingevuld.', 'wesselvandenijssel'), '<span style="white-space:nowrap;">' . esc_html($site_host) . '</span>') . '
				</p>
			</td>
		</tr>
	</table>
</body>
</html>';

	$text = str_replace('{reply_heading}', $reply_heading_html, $text);
	$text = str_replace('{reply_footer}', $reply_footer_html, $text);

	return str_replace($merge_tag, $form_fields, $text);
}

/**
 * Tracks whether a Gravity Form was rendered on the current page, and loads the reCAPTCHA scripts only then.
 */
add_action('gform_enqueue_scripts', 'wesselvandenijssel_enqueue_recaptcha');
function wesselvandenijssel_enqueue_recaptcha(): void {
	$GLOBALS['wesselvandenijssel_has_form'] = true;

	if (wp_script_is('gforms_recaptcha_recaptcha', 'registered')) {
		wp_enqueue_script('gforms_recaptcha_recaptcha');
		wp_enqueue_script('gforms_recaptcha_frontend');
	}
}

/**
 * Removes the reCAPTCHA scripts that the add-on enqueued for every page, unless a form already asked for them.
 */
add_action('wp_enqueue_scripts', 'wesselvandenijssel_dequeue_recaptcha', 20);
function wesselvandenijssel_dequeue_recaptcha(): void {
	if (!empty($GLOBALS['wesselvandenijssel_has_form'])) return;

	wp_dequeue_script('gforms_recaptcha_recaptcha');
	wp_dequeue_script('gforms_recaptcha_frontend');
}
