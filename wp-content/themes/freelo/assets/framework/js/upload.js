jQuery(document).ready(function(jQuery) {

    /*
     * Post types
     */

    // Post-types Show/Hide
    radios = jQuery('#post-formats-select input');

    if ( !(jQuery('input[value="ishyoboy_slides"]').length > 0) ){
        jQuery('[id^=iyb_meta_post_]').hide();
        var val = jQuery('#post-formats-select input:checked').val();
        jQuery('#iyb_meta_post_' + val ).show();
    }
    radios.change( function() {

        var val = jQuery(this).val();

        if ( jQuery('[id^=iyb_meta_post_]:visible').length > 0 ){
            jQuery('[id^=iyb_meta_post_]:visible').slideUp(300, function(){
                jQuery('#iyb_meta_post_' + val ).slideDown(300);
            });
        }
        else{
            jQuery('#iyb_meta_post_' + val ).slideDown(300);
        }
    });

    if ( jQuery('#_ishmb_post_embedded_video').length > 0){

        if ( jQuery('#_ishmb_post_embedded_video').is( ":checked" ) ){
            jQuery('tr').has('#_ishmb_post_video').show();
            jQuery('tr').has('#_ishmb_post_video_mp4, ' +
                '#_ishmb_post_video_webm, ' +
                '#_ishmb_post_video_poster').hide();
        }else{
            jQuery('tr').has('#_ishmb_post_video').hide();
            jQuery('tr').has('#_ishmb_post_video_mp4, ' +
                '#_ishmb_post_video_webm, ' +
                '#_ishmb_post_video_poster').show();
        }

        jQuery('#_ishmb_post_embedded_video').change(function(){
            if ( jQuery(this).is( ":checked" ) ){
                jQuery('tr').has('#_ishmb_post_video_mp4, ' +
                    '#_ishmb_post_video_webm, ' +
                    '#_ishmb_post_video_poster').fadeOut(300,function(){
                        jQuery('tr').has('#_ishmb_post_video').fadeIn(300);
                    });


            }else{
                jQuery('tr').has('#_ishmb_post_video').fadeOut(300, function(){
                    jQuery('tr').has('#_ishmb_post_video_mp4, ' +
                        '#_ishmb_post_video_webm, ' +
                        '#_ishmb_post_video_poster').fadeIn(300);
                });
            }
        });
    }

    /*
     * Lead section
     */

	if ( jQuery('#_ishmb_hide_title').length > 0) {

		if ( jQuery('#_ishmb_hide_title').is( ":checked" ) ){

            jQuery('#_ishmb_hide_title').parents('tr').siblings().hide();

		}else{

			if ( jQuery('#_ishmb_use_taglines').is( ":checked" ) ){
				jQuery('tr').has('#_ishmb_tagline_1').show();
				jQuery('tr').has('#_ishmb_tagline_2').show();
				jQuery('tr').has('#_ishmb_tagline_additional').show();
			}else{
				jQuery('tr').has('#_ishmb_tagline_1').hide();
				jQuery('tr').has('#_ishmb_tagline_2').hide();
				jQuery('tr').has('#_ishmb_tagline_additional').hide();
			}

            if ( jQuery('#_ishmb_use_colors').is( ":checked" ) ){
                jQuery('tr').has('#_ishmb_title_color').show();
                jQuery('tr').has('#_ishmb_title_text_color').show();
                jQuery('tr').has('#_ishmb_title_color_opacity').show();
            }else{
                jQuery('tr').has('#_ishmb_title_color').hide();
                jQuery('tr').has('#_ishmb_title_text_color').hide();
                jQuery('tr').has('#_ishmb_title_color_opacity').hide();
            }

            if ( jQuery('#_ishmb_use_bg_image').is( ":checked" ) ){
                jQuery('tr').has('#_ishmb_bg_image_parallax').show();
            }else{
                jQuery('tr').has('#_ishmb_bg_image_parallax').hide();
            }



		}


		jQuery('#_ishmb_hide_title').change(function(){
			if ( jQuery(this).is( ":checked" ) ){
                jQuery('#_ishmb_hide_title').parents('tr').siblings().fadeOut(300);
			}else{

				jQuery('tr').has('#_ishmb_title_area_style').fadeIn(300);

				jQuery('tr').has('#_ishmb_use_taglines').fadeIn(300);

                    if ( jQuery('#_ishmb_use_taglines').is( ":checked" ) ){
                        jQuery('tr').has('#_ishmb_tagline_1').fadeIn(300);
                        jQuery('tr').has('#_ishmb_tagline_2').fadeIn(300);
                        jQuery('tr').has('#_ishmb_tagline_additional').fadeIn(300);
                    }

				jQuery('tr').has('#_ishmb_use_bg_image').fadeIn(300);

                if ( jQuery('#_ishmb_use_bg_image').is( ":checked" ) ){
                    jQuery('tr').has('#_ishmb_bg_image_parallax').fadeIn(300);
                }

				jQuery('tr').has('#_ishmb_use_colors').fadeIn(300);

                    if ( jQuery('#_ishmb_use_colors').is( ":checked" ) ){
                        jQuery('tr').has('#_ishmb_title_color').fadeIn(300);
                        jQuery('tr').has('#_ishmb_title_text_color').fadeIn(300);
                        jQuery('tr').has('#_ishmb_title_color_opacity').fadeIn(300);
                    }

			}
		});


		jQuery('#_ishmb_use_taglines').change(function(){
			if ( jQuery(this).is( ":checked" ) ){
				jQuery('tr').has('#_ishmb_tagline_1').fadeIn(300);
				jQuery('tr').has('#_ishmb_tagline_2').fadeIn(300);
				jQuery('tr').has('#_ishmb_tagline_additional').fadeIn(300);
			}else{
				jQuery('tr').has('#_ishmb_tagline_1').fadeOut(300);
				jQuery('tr').has('#_ishmb_tagline_2').fadeOut(300);
				jQuery('tr').has('#_ishmb_tagline_additional').fadeOut(300);
			}
		});

        // Custom Colors opacity
        if ( jQuery('#_ishmb_use_taglines').length > 0){

            jQuery('#_ishmb_use_colors').change(function(){
                if ( jQuery(this).is( ":checked" ) ){
                    jQuery('tr').has('#_ishmb_title_color').fadeIn(300);
                    jQuery('tr').has('#_ishmb_title_text_color').fadeIn(300);
                    jQuery('tr').has('#_ishmb_title_color_opacity').fadeIn(300);
                }else{
                    jQuery('tr').has('#_ishmb_title_color').fadeOut(300);
                    jQuery('tr').has('#_ishmb_title_text_color').fadeOut(300);
                    jQuery('tr').has('#_ishmb_title_color_opacity').fadeOut(300);
                }
            });
        }

        // Image Parallax
        if ( jQuery('#_ishmb_use_bg_image').length > 0){

            jQuery('#_ishmb_use_bg_image').change(function(){
                if ( jQuery(this).is( ":checked" ) ){
                    jQuery('tr').has('#_ishmb_bg_image_parallax').fadeIn(300);
                }else{
                    jQuery('tr').has('#_ishmb_bg_image_parallax').fadeOut(300);
                }
            });
        }




	}


    /*
     *   Color picker activation
     */
    jQuery('.color_box').each(function(){
        var _this = this;
        var default_value = jQuery(this).next('input').val();
        jQuery(this).ColorPicker({
            color: default_value,
            onShow: function (colpkr) {
                jQuery(colpkr).stop(true,true).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                jQuery(colpkr).stop(true,true).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                jQuery(_this).css('backgroundColor', '#' + hex);
                jQuery(_this).next('input').attr('value','#' + hex);
            }
        });
    });

    /*
     *   Font selector activation
     */
    jQuery('select.font-select').change(function(){
        jQuery('head').append( "<link class='link-body' href='//fonts.googleapis.com/css?family=" + jQuery(this).val() + "' rel='stylesheet' type='text/css'>" );
        var preview = jQuery(this).next('.font-preview');

        if ( !preview.is(":visible") ){
            preview.fadeIn(300);
        }

        jQuery(this).parent().find('h3 > span').html( jQuery(this).val() );
        preview.css('font-family', jQuery(this).val());
    });

    jQuery('select.font-select').each(function(){
        jQuery('head').append( "<link class='link-body' href='//fonts.googleapis.com/css?family=" + jQuery(this).val() + "' rel='stylesheet' type='text/css'>" );
        var preview = jQuery(this).next('.font-preview');

        if ( !preview.is(":visible") ){
            preview.fadeIn(300);
        }

        jQuery(this).parent().find('h3 > span').html( jQuery(this).val() );
        preview.css('font-family', jQuery(this).val());
    });


    /*
     *   Sidebar position
     */
    if ( jQuery('#_ishmb_sb_pos').length > 0){

        jQuery('#_ishmb_sb_pos').change(function(){
            $val = jQuery(this).val();
            if ('left' == $val || 'right' == $val){
                jQuery('#_ishmb_sidebar_boxitem').fadeIn(300);
            }
            else{
                jQuery('#_ishmb_sidebar_boxitem').fadeOut(300);
            }
        });

        jQuery('#_ishmb_sb_pos').each(function(){
            $val = jQuery(this).val();
            if ('left' == $val || 'right' == $val){
                jQuery('#_ishmb_sidebar_boxitem').show();
            }
            else{
                jQuery('#_ishmb_sidebar_boxitem').hide();
            }
        });
    }

    /*
     *   Main Navigation Position
     */
    if ( jQuery('#_ishmb_mainnav_pos').length > 0){

        jQuery('#_ishmb_mainnav_pos').change(function(){
            $val = jQuery(this).val();
            if ( ('left' == $val) || ('right' == $val) ){
                jQuery('#_ishmb_mainnav_sidebar_boxitem').fadeIn(300);
            }
            else{
                jQuery('#_ishmb_mainnav_sidebar_boxitem').fadeOut(300);
            }
        });

        jQuery('#_ishmb_mainnav_pos').each(function(){
            $val = jQuery(this).val();
            if ( ('left' == $val) || ('right' == $val) ){
                jQuery('#_ishmb_mainnav_sidebar_boxitem').show();
            }
            else{
                jQuery('#_ishmb_mainnav_sidebar_boxitem').hide();
            }
        });
    }


    /*
     *   Expandable header
     */
    if ( jQuery('#_ishmb_use_header_sidebar').length > 0){

        jQuery('#_ishmb_use_header_sidebar').change(function(){
            $val = jQuery(this).val();
            if ('1' == $val){
                jQuery('#_ishmb_header_sidebar_boxitem').fadeIn(300);
                jQuery('#_ishmb_header_sidebar_on_boxitem').fadeIn(300);
            }
            else{
                jQuery('#_ishmb_header_sidebar_boxitem').fadeOut(300);
                jQuery('#_ishmb_header_sidebar_on_boxitem').fadeOut(300);
            }
        });

        jQuery('#_ishmb_use_header_sidebar').each(function(){
            $val = jQuery(this).val();
            if ('1' == $val){
                jQuery('#_ishmb_header_sidebar_boxitem').show();
                jQuery('#_ishmb_header_sidebar_on_boxitem').show();
            }
            else{
                jQuery('#_ishmb_header_sidebar_boxitem').hide();
                jQuery('#_ishmb_header_sidebar_on_boxitem').hide();
            }
        });
    }

    /*
     *   Footer widget area box
     */
    if ( jQuery('#_ishmb_use_fw_area').length > 0){
        jQuery('#_ishmb_use_fw_area').change(function(){
            $val = jQuery(this).val();
            if ('1' == $val){
                jQuery('#_ishmb_footer_sidebar_boxitem').fadeIn(300);
            }
            else{
                jQuery('#_ishmb_footer_sidebar_boxitem').fadeOut(300);
            }
        });

        jQuery('#_ishmb_use_fw_area').each(function(){
            $val = jQuery(this).val();
            if ('1' == $val){
                jQuery('#_ishmb_footer_sidebar_boxitem').show();
            }
            else{
                jQuery('#_ishmb_footer_sidebar_boxitem').hide();
            }
        });
    }


    /*
     *   Color Selector Metabox
     */
    jQuery('.ish_color_selector_container').each( function(){
        var me = jQuery(this);
        var input = me.find('input.ish_color_selector');

        me.find('.ish_btnlist_item').click(function(e){
            e.preventDefault();
            var item = jQuery(this);
            input.val( item.attr('data-ish-value') );
            input.trigger('change');
            me.find('li').removeClass('active');
            item.parent().addClass('active');
        });

    });

    /*jQuery('.ish-color-field').each(function(){
        var _this = jQuery(this);
        _this.wpColorPicker({
            change: function(event, ui){
                var new_color = ui.color.toString();
                var input = jQuery(this).parents( '.ish_color_selector_container' ).find( 'input.ish_color_selector' );
                var current_colors = input.val().split(',');
                var new_val = current_colors[0] + ',' + new_color;
                input.val( new_val );
            }
        });
    });*/

    jQuery('.color_box').each(function(){
        var _this = this;
        var default_value = jQuery(this).next('input').val();
        jQuery(this).ColorPicker({
            color: default_value,
            onShow: function (colpkr) {
                jQuery(colpkr).stop(true,true).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                jQuery(colpkr).stop(true,true).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                jQuery(_this).css('backgroundColor', '#' + hex);
                jQuery(_this).next('input').attr('value','#' + hex);
            }
        });
    });

	/*
	 *   MegaMenu
	 */

	var ish_megamenu_timeout;

	function megamenu_refresh_onmouseup() {
		jQuery(document).on( 'mouseup', '.menu-item-bar', function(event, ui)
		{

			if( ! jQuery(event.target).is('a') )
			{
				clearTimeout( ish_megamenu_timeout);
				ish_megamenu_timeout = setTimeout( megamenu_refresh, 300);
			}
		});
	}

	function megamenu_refresh() {

		var menuItems = jQuery('.menu-item');

		menuItems.each( function(i) {

			var item = jQuery(this),
				megaMenuCheckbox = jQuery('.menu-item-ish-megamenu', this);

			if( !item.is('.menu-item-depth-0') ) {

				var checkItem = menuItems.filter(':eq(' + (i-1) + ')');
				if ( checkItem.is( '.ish-megamenu-active' ) ) {
					item.addClass( 'ish-megamenu-active' );
					megaMenuCheckbox.attr( 'checked', 'checked' );
				} else {
					item.removeClass( 'ish-megamenu-active' );
					megaMenuCheckbox.attr( 'checked', '' );
				}

			}

		});
	}

	var megamenu_checkbox = jQuery('.menu-item-ish-megamenu');

	if ( megamenu_checkbox.length > 0){

		megamenu_checkbox.change(function(){

			var me = jQuery(this);
			var me_parent = me.parents('.menu-item:eq(0)');

			if ( me.is(':checked') ) {
				me_parent.addClass('ish-megamenu-active');
			} else {
				me_parent.removeClass('ish-megamenu-active');
			}

			// Refresh all visual changes
			megamenu_refresh();

		});

		megamenu_refresh();
		megamenu_refresh_onmouseup();
	}


});