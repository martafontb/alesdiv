<?php

// Contact form 7 plugin
include_once(ABSPATH . 'wp-admin/includes/plugin.php'); // Require plugin.php to use is_plugin_active() below
if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
	global $wpdb;
	$cf7 = $wpdb->get_results(
		"
  	SELECT ID, post_title
  	FROM $wpdb->posts
  	WHERE post_type = 'wpcf7_contact_form'
  	"
	);
	$contact_forms = array();
	if ($cf7) {
		foreach ( $cf7 as $cform ) {
			$contact_forms[$cform->post_title] = $cform->ID;
		}
	} else {
		$contact_forms["No contact forms found"] = 0;
	}
	vc_map( array(
		'base' => 'ish_cf7',
		'name' => esc_html__("Contact Form 7", "js_composer"),
		'icon' => 'ish-icon-vcard',
		'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
		'weight' => 800,
		"description" => __('Place Contact Form7', 'js_composer'),
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => __("Form title", "js_composer"),
				"param_name" => "title",
				"admin_label" => true,
				"description" => __("What text to use as form title. Leave blank if no title is needed.", "js_composer")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Select contact form", "js_composer"),
				"param_name" => "form_id",
				"value" => $contact_forms,
				"description" => __("Choose previously created contact form from the drop down list.", "js_composer")
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Background Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'std' => 'color6',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Background Text Color', 'ishyoboy_assets' ),
				'param_name' => 'bg_text_color',
				'std' => 'color1',
				'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Text Color', 'ishyoboy_assets' ),
				'param_name' => 'text_color',
				'std' => 'color1',
				'value' => array_merge( array( __( 'Inherit from parent', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Button Color', 'ishyoboy_assets' ),
				'param_name' => 'button_bg_color',
				'std' => 'color5',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Button Text Color', 'ishyoboy_assets' ),
				'param_name' => 'button_text_color',
				'std' => 'color4',
				'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Add Border', 'ishyoboy_assets' ),
				'param_name' => 'border',
				'value' => array(
					__( 'No', 'ishyoboy_assets' ) => '',
					__( 'Yes', 'ishyoboy_assets' ) => 'yes',
				),
				//'description' => __( 'change color of tooltip', 'ishyoboy_assets' ),
			),
			/*array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Button Border', 'ishyoboy_assets' ),
				'param_name' => 'button_border',
				'value' => array(
					__( 'Yes', 'ishyoboy_assets' ) => '',
					__( 'No', 'ishyoboy_assets' ) => 'no',
				),
				//'description' => __( 'change color of tooltip', 'ishyoboy_assets' ),
			),*/
		)
	) );
} // if contact form7 plugin active