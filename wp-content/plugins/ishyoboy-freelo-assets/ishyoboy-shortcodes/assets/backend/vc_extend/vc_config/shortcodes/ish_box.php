<?php


class WPBakeryShortCode_Ish_Box extends WPBakeryShortCodesContainer  {

	public function contentAdmin($atts, $content = null) {
		$width = $el_class = '';
		$output = parent::contentAdmin( $atts, $content );

		$title = '<span class="ish-tabs-title-holder">' . esc_html__( $this->settings['name'] , 'ishyoboy_assets' ) . '</span>';

		//$search = '<div '.$this->containerHtmlBlockParams($width, 1).'>';
		$search = '<div class="wpb_element_wrapper">';
		$replace = $search . '<h4 class="wpb_element_title">' . $title . '</h4>';

		// Replace the content just once!
		$pos = strpos( $output,$search );
		if ($pos !== false) {
			$output = substr_replace( $output, $replace, $pos, strlen($search) );
		}

		return $output;
	}

}

vc_map( array(
	'name' => esc_html__( 'Box', 'ishyoboy_assets' ),
	'base' => 'ish_box',
	'as_parent' => array( 'only' => 'vc_row' ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	'as_child' => array('except' => 'vc_column_inner'),
	'show_settings_on_create' => true,
	'description' => esc_html__( 'Colored content box', 'ishyoboy_assets' ),
	'category' => Array( esc_html__('Content', 'js_composer'), esc_html__('IshYoBoy', 'ishyoboy_assets') ),
	'is_container' => false,
	'icon' => 'ish-icon-stop',
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_color_selector',
				'heading' => esc_html__( 'Background Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'std' => 'color5',
				'value' => array_merge( array( esc_html__( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Background Opacity', 'ishyoboy_assets' ),
				'param_name' => 'bg_opacity',
				'value' => '', //__( '100', 'ishyoboy_assets' ),
				'description' => esc_html__( 'Number (0 - 100) representing the row opacity in %. 100 - visible, 0 - invisible.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'color', 'value_not_equal_to' => Array( '', 'none' ) ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => esc_html__( 'Text Color', 'ishyoboy_assets' ),
				'param_name' => 'text_color',
				'std' => 'color4',
				'value' => array_merge( array( esc_html__( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => esc_html__( 'Border Color', 'ishyoboy_assets' ),
				'param_name' => 'border_color',
				'std' => '',
				'value' => array_merge( array( esc_html__( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Width', 'ishyoboy_assets' ),
				'param_name' => 'border_width',
				'value' => '3',
				'description' => esc_html__( 'Border width in pixels. Set "0" to remove it completely.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'border_color', 'value_not_equal_to' => Array( '', 'none' ) ),
			),
			array(
				'type' => 'ish_css_fields',
				'heading' => esc_html__( 'Inner Padding', 'ishyoboy_assets' ),
				'param_name' => 'inner_padding',
				'value' => '60#60#60#60',
				'description' => esc_html__( 'Width in pixels to add inner padding. Set "0" to remove it completely.', 'ishyoboy_assets' )
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => esc_html__( 'Stretch to Full-width', 'ishyoboy_assets' ),
				'param_name' => 'stretch_box',
				'value' => array(
					'Yes' => '',
					'No' => 'no'
				),
				'description' => esc_html__( 'Stretch the box to full width.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => esc_html__( 'Box Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'value' => $ish_alignmment_params,
				//'description' => esc_html__( 'Align element', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'stretch_box', 'value' => 'no' ),
				'admin_label' => false,
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Background Image', 'ishyoboy_assets'),
				'param_name' => 'bg_image',
				'description' => ''
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Background Repeat', 'ishyoboy_assets'),
				'param_name' => 'bg_image_repeat',
				'std' => '',
				'value' => array(
					__( 'Default', 'ishyoboy_assets') => '',
					__( 'Cover', 'ishyoboy_assets') => 'cover',
					__( 'Contain', 'ishyoboy_assets') => 'contain',
					__( 'No Repeat', 'ishyoboy_assets') => 'no-repeat'
				),
				'description' => '',
				'dependency' => Array('element' => 'bg_image', 'not_empty' => true )
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => esc_html__( 'Same Height Boxes', 'ishyoboy_assets' ),
				'param_name' => 'same_height',
				'value' => array(
					'No' => '',
					'Yes' => 'yes'
				),
				'description' => esc_html__( 'Make all boxes in this row, which have this option set to "yes", have the same height.', 'ishyoboy_assets' ),
			),
			array(
				// Also update in vc_row
				'type' => 'ish_buttons_selector',
				'heading' => esc_html__( 'Vertical Content Align', 'ishyoboy_assets' ),
				'param_name' => 'vertical_align',
				'value' => Array(
					__( 'Default Alignment', 'ishyoboy_assets') => '',
					__( 'Top', 'ishyoboy_assets') => 'top',
					__( 'Middle', 'ishyoboy_assets') => 'middle',
					__( 'Bottom', 'ishyoboy_assets') => 'bottom',
				),
				'description' => 'Vertical alignment of the content in this box.', //__( '', 'ishyoboy_assets' ),
				'dependency' => Array('element' => 'same_height', 'not_empty' => true )
			),
		),
		$ish_global_params
	),
	'default_content' => '
	[vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner]
	',
	'js_view' => 'IshBoxView',
) );