<?php
/**
 * Created by PhpStorm.
 * User: VlooMan
 * Date: 12.11.2013
 * Time: 11:03
 */

$value = $param_value;
$value = htmlspecialchars($value);

// Explode all 4 values (top, right, bottom, left);
$four_values = explode( '#', $value);
for ( $i = 0; $i < 4; $i++ ){
	if ( ! isset( $four_values[$i] ) ){
		$four_values[$i] = '';
	}
}



$param_line .= '<div class="'.$param['type'].'_container">';
$param_line .= '<input name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$param['param_name'].' '.$param['type'].'" type="hidden" value="'.$value.'" />';

$param_line .= '<div class="'.$param['type'].'_inner vc_clearfix">';

$param_line .= '<div>';
$param_line .= '<span class="vc_description">' . __( 'Top:', 'ishyoboy_assets') . ' </span>';
$param_line .= '<input name="'.$param['type'].'_values" class="wpb-textinput '.$param['param_name'].' '.$param['type'].'" type="text" value="'.$four_values[0].'" />';
$param_line .= '</div>';

$param_line .= '<div>';
$param_line .= '<span class="vc_description"> ' . __( 'Right:', 'ishyoboy_assets') . ' </span>';
$param_line .= '<input name="'.$param['type'].'_values" class="wpb-textinput '.$param['param_name'].' '.$param['type'].'" type="text" value="'.$four_values[1].'" />';
$param_line .= '</div>';

$param_line .= '<div>';
$param_line .= '<span class="vc_description"> ' . __( 'Bottom:', 'ishyoboy_assets') . ' </span>';
$param_line .= '<input name="'.$param['type'].'_values" class="wpb-textinput '.$param['param_name'].' '.$param['type'].'" type="text" value="'.$four_values[2].'" />';
$param_line .= '</div>';

$param_line .= '<div>';
$param_line .= '<span class="vc_description"> ' . __( 'Left:', 'ishyoboy_assets') . ' </span>';
$param_line .= '<input name="'.$param['type'].'_values" class="wpb-textinput '.$param['param_name'].' '.$param['type'].'" type="text" value="'.$four_values[3].'" />';
$param_line .= '</div>';

$param_line .= '</div>';

$param_line .= '</div>';

// Do not forget to echo the variable
echo apply_filters( 'ishfreelotheme_vc_custom_param_output', $param_line);