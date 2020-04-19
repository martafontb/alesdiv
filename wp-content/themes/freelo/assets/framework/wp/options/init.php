<?php

require_once( get_template_directory() . '/assets/framework/wp/options/custom-functions.php' );
require_once( get_template_directory() . '/assets/framework/wp/options/init-admin.php' );
require_once( get_template_directory() . '/assets/framework/wp/posts/ishyo-meta-box.php' );

if ( is_admin() ){
	require_once( get_template_directory() . '/assets/framework/wp/posts/custom-meta-boxes.php' );
	require_once( get_template_directory() . '/assets/framework/wp/tinymce/tinymce_plugin.php' );
}