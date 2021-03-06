<?php
/**
 * Created by PhpStorm.
 * User: VlooMan
 * Date: 12.11.2013
 * Time: 11:03
 */
$value = $param_value;

$icon_sets = $this->get_available_icon_sets_array();

$param_line .= '<div class="'.$param['type'].'_container ish_btnlist_container">';
$param_line .= '<input name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$param['param_name'].' '.$param['type'].'" type="hidden" value="'.esc_attr( $value ).'" />';

$subline = '<ul class="'.$param['type'].'_list ish_btnlist_list">';
// $subline .= '<li><a class="'.$param['type'].'_item ish_btnlist_item ish-icon-noneselected" data-ish-value="" href="#" title="' . __( 'No icon', 'ishyoboy_assets' ) . '"></a></li>';

foreach ( $icon_sets as $foldername => $icons ) {
	foreach ( $icons as $key => $icon_data ) {

		$val = $icon_data['icon'];
		$path_id = $icon_data['path'];

		if ( '' == $value ){
			$value = $path_id . '/' . $foldername . '/' . $val;
		}

		if ( $value == $path_id . '/' . $foldername . '/' . $val){
			$subline .= '<li class="active">';
		}
		else{
			$subline .= '<li>';
		}

		$content = $style = '';
		if ( '' != $val ){
			//$content= '<img src="' . $this->get_icon_sets_icon_uri( $foldername . '/' . $val ) .  '" height="28" width="28" />';
			$style= ' style="background-image: url(\'' . $this->get_icon_sets_icon_uri( $path_id . '/' . $foldername . '/' . $val ) .  '\');"';
		}

		//$subline .= '<a class="'.$param['type'].'_item ish_btnlist_item" data-ish-value="' . esc_attr( $foldername . '/' . $val ) . '" href="#" title="' . $val . '">' . $content . '</a></li>';
		$subline .= '<a class="'.$param['type'].'_item ish_btnlist_item" data-ish-value="' . esc_attr( $path_id . '/' . $foldername . '/' . $val ) . '" href="#" title="' . $val . '"' . $style. '></a></li>';
	}
	$subline .= '</ul>';
	$param_line .= '<span class="' . $param['type'] . '_heading description clear">' . $foldername . ' ' . __( 'Set', 'ishyoboy_assets' ) . ':' . '</span>';
	$param_line .= $subline;
	$subline = '<ul class="'.$param['type'].'_list ish_btnlist_list">';
}

$param_line .= '</ul>';
$param_line .= '</div>';



// Do not forget to echo the variable
echo apply_filters( 'ishfreelotheme_vc_custom_param_output', $param_line);