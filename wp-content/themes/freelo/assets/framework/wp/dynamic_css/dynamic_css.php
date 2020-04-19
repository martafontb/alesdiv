<?php

/* *********************************************************************************************************************
 * Theme options
 */

if ( 1 == $ISHFREELOTHEME_DYNAMIC_CSS_COLORS_START ) {
	include( get_template_directory() . '/assets/framework/wp/dynamic_css/inc/dynamic_fonts.php' );
	include( get_template_directory() . '/assets/framework/wp/dynamic_css/inc/dynamic_colors_before.php' );
}

include( get_template_directory() . '/assets/framework/wp/dynamic_css/inc/dynamic_colors.php' );

if ( (int)ISHFREELOTHEME_COLORS_COUNT <= $ISHFREELOTHEME_DYNAMIC_CSS_COLORS_START + ISHFREELOTHEME_DYNAMIC_CSS_COLORS_PER_FILE_COUNT - 1  ) {
	include( get_template_directory() . '/assets/framework/wp/dynamic_css/inc/dynamic_colors_after.php' );
	include( get_template_directory() . '/assets/framework/wp/dynamic_css/inc/dynamic_patterns.php' );
	include( get_template_directory() . '/assets/framework/wp/dynamic_css/inc/dynamic_responsive.php');
	include( get_template_directory() . '/assets/framework/wp/dynamic_css/inc/dynamic_misc.php' );
	if ( ishfreelotheme_woocommerce_plugin_active() ){
		include( get_template_directory() . '/assets/framework/wp/dynamic_css/inc/dynamic_woocommerce.php' );
	}
}
