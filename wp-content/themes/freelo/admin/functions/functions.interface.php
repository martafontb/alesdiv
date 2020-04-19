<?php 
/**
 * SMOF Interface
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.4.0
 * @author      Syamil MJ
 */
 
 
/**
 * Admin Init
 *
 * @uses wp_verify_nonce()
 * @uses header()
 *
 * @since 1.0.0
 */
function optionsframework_admin_init() 
{
	// Rev up the Options Machine
	global $of_options, $options_machine;
	$options_machine = new Options_Machine($of_options);
}

/**
 * Create Options page
 *
 * @uses add_theme_page()
 * @uses add_action()
 *
 * @since 1.0.0
 */
function optionsframework_add_admin() {

    // Added by IshYoBoy
    $title = esc_html__( 'Theme Options', 'freelo' );

	$of_page = add_theme_page( THEMENAME, $title, 'edit_theme_options', 'optionsframework', 'optionsframework_options_page');

	// Add framework functionality to the head individually
	add_action( 'admin_enqueue_scripts', 'of_load_only');
	add_action( 'admin_enqueue_scripts', 'of_style_only');
	
}


/**
 * Build Options page
 *
 * @since 1.0.0
 */
function optionsframework_options_page(){
	
	global $options_machine;
	
	/*
	//for debugging

	$ishfreelotheme_options = of_get_options();
	print_r($ishfreelotheme_options);

	*/	
	
	include_once( get_template_directory() . '/admin/front-end/options.php' );

}

/**
 * Create Options page
 *
 * @uses wp_enqueue_style()
 *
 * @since 1.0.0
 */
function of_style_only( $current_page ){

	if ( 'appearance_page_optionsframework' == $current_page ) {

		wp_enqueue_style('smof-admin-style', ADMIN_DIR . 'assets/css/admin-style.css');
		wp_enqueue_style('smof-ishyoboy-styles', ADMIN_DIR . 'assets/css/ishyoboy-style.css');
		wp_enqueue_style('smof-color-picker', ADMIN_DIR . 'assets/css/colorpicker.css');
		wp_enqueue_style('smof-jquery-ui-custom-admin', ADMIN_DIR .'assets/css/jquery-ui-custom.css');

	}
}

/**
 * Create Options page
 *
 * @uses add_action()
 * @uses wp_enqueue_script()
 *
 * @since 1.0.0
 */
function of_load_only( $current_page )
{

	if ( 'appearance_page_optionsframework' == $current_page ){

		add_action( 'admin_head', 'of_admin_head');

		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_script('smof-jquery-input-mask', ADMIN_DIR .'assets/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
		wp_enqueue_script('smof-tipsy', ADMIN_DIR .'assets/js/jquery.tipsy.js', array( 'jquery' ));
		wp_enqueue_script('smof-color-picker', ADMIN_DIR .'assets/js/colorpicker.js', array('jquery'));
		wp_enqueue_script('smof-cookie', ADMIN_DIR . 'assets/js/cookie.js', 'jquery');
		wp_enqueue_script('smof-smof', ADMIN_DIR .'assets/js/smof.js', array( 'jquery' ));

		/**
		 * Enqueue scripts for file uploader
		 */

		if ( function_exists( 'wp_enqueue_media' ) ) { wp_enqueue_media(); }

	}
}

/**
 * Front end inline jquery scripts
 *
 * @since 1.0.0
 */
function of_admin_head() { ?>
		
	<script type="text/javascript" language="javascript">

	jQuery.noConflict();
	jQuery(document).ready(function($){
	
		// COLOR Picker			
		$('.colorSelector').each(function(){
			var Othis = this; //cache a copy of the this variable for use inside nested function
            var default_value = jQuery(this).next('input').val();
				
			$(this).ColorPicker({
					color: default_value,
					onShow: function (colpkr) {
						$(colpkr).stop(true,true).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						$(colpkr).stop(true,true).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						$(Othis).children('div').css('backgroundColor', '#' + hex);
						$(Othis).next('input').attr('value','#' + hex);
					}
			});

            jQuery(this).next('input').bind('keyup', function(){
                var picker = $(Othis);
                var clr = jQuery(this).val();
                picker.ColorPickerSetColor(clr);
                picker.children('div').css('backgroundColor', clr);
            });
				  
		}); //end color picker
		
	}); //end doc ready
	
	</script>
	
<?php }

/**
 * Ajax Save Options
 *
 * @uses get_option()
 *
 * @since 1.0.0
 */
function of_ajax_callback()
{
	global $options_machine, $of_options;

	$nonce=$_POST['security'];
	
	if (! wp_verify_nonce($nonce, 'of_ajax_nonce') ) die('-1'); 
			
	//get options array from db
	$all = of_get_options();
	
	$save_type = $_POST['type'];

	//Uploads
	if($save_type == 'upload')
	{
		
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		 
			$upload_tracking[] = $clickedID;
				
			//update $options array w/ image URL			  
			$upload_image = $all; //preserve current data
			
			$upload_image[$clickedID] = $uploaded_file['url'];
			
			of_save_options($upload_image);
		
				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
		 else { echo esc_url($uploaded_file['url']); } // Is the Response
		 
	}
	elseif($save_type == 'image_reset')
	{
			
			$id = $_POST['data']; // Acts as the name
			
			$delete_image = $all; //preserve rest of data
			$delete_image[$id] = ''; //update array key with empty value	 
			of_save_options($delete_image ) ;
	
	}
	elseif($save_type == 'backup_options')
	{
			
		$backup = $all;
		$backup['backup_log'] = date('r');

        echo BACKUPS;
		
		of_save_options($backup, BACKUPS) ;
			
		die('1');
	}
	elseif($save_type == 'restore_options')
	{
			
		$ishfreelotheme_options = get_option(BACKUPS);

		update_option(OPTIONS, $ishfreelotheme_options);

		of_save_options($ishfreelotheme_options);
		
		die('1'); 
	}
	elseif($save_type == 'import_options'){

        $ishfreelotheme_options = $_POST['data'];
        $ishfreelotheme_options = unserialize(base64_decode($ishfreelotheme_options)); //100% safe - ignore theme check nag
		of_save_options($ishfreelotheme_options);

		die('1');
	}
	elseif ($save_type == 'save')
	{

		$_POST['data'] = str_replace('ish-rplc_open', '<script', $_POST['data'] );
		$_POST['data'] = str_replace('ish-rplc_close', '</script>', $_POST['data'] );

		wp_parse_str(stripslashes($_POST['data']), $ishfreelotheme_options);

        //**********************
        // Changed by IshYoBoy
            if ('' == $ishfreelotheme_options['color1']){ $ishfreelotheme_options['color1'] = ISHFREELOTHEME_COLOR_1; }
            if ('' == $ishfreelotheme_options['color2']){ $ishfreelotheme_options['color2'] = ISHFREELOTHEME_COLOR_2; }
            if ('' == $ishfreelotheme_options['color3']){ $ishfreelotheme_options['color3'] = ISHFREELOTHEME_COLOR_3; }
            if ('' == $ishfreelotheme_options['color4']){ $ishfreelotheme_options['color4'] = ISHFREELOTHEME_COLOR_4; }

		unset($ishfreelotheme_options['security']);
		unset($ishfreelotheme_options['of_save']);

		if ( isset( $_POST['force_skin_change'] ) && 'true' === $_POST['force_skin_change']  ) {
			$ishfreelotheme_options['force_skin_change'] = true;
		}

		of_save_options(apply_filters( 'of_options_before_save_only_save', $ishfreelotheme_options));


		die('1');
	}
	elseif ($save_type == 'reset')
	{
		of_save_options($options_machine->Defaults);
		
        die('1'); //options reset
	}
	elseif ($save_type == 'flush')
	{

		flush_rewrite_rules();

		die('1');
	}

  	die();
}