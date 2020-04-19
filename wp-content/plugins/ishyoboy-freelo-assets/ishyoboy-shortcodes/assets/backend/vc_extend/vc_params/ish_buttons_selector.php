<?php
/**
 * Created by PhpStorm.
 * User: VlooMan
 * Date: 12.11.2013
 * Time: 11:03
 */

$value = __($param_value, 'ishyoboy_assets');
$value = htmlspecialchars($value);
//$value = $param_value;
$param_line .= '<div class="'.$param['type'].'_container ish_btnlist_container">';
$param_line .= '<input name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$param['param_name'].' '.$param['type'].'" type="hidden" value="'.$value.'" />';
$param_line .= '<ul class="'.$param['type'].'_list ish_btnlist_list">';

foreach ( $param['value'] as $key => $val ) {
	if ( '' == $val ){
		$class = 'ish-icon-noneselected';
	}
	else{
		$class = '';
	}

	if ( $value == $val){
		$param_line .= '<li class="active">';
	}
	else{
		$param_line .= '<li>';
	}

	$text = ('' == $val) ? '' : $key;
	$param_line .= '<a class="'.$param['type'].'_item ish_btnlist_item ' . $class . '" data-ish-value="' . $val . '" href="#" title="' . $key . '">' . $text . '</a></li>';
}

$param_line .= '</ul>';
$param_line .= '</div>';



// Do not forget to echo the variable
echo apply_filters( 'ishfreelotheme_vc_custom_param_output', $param_line);