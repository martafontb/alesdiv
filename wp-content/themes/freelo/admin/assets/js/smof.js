/**
 * SMOF js
 *
 * contains the core functionalities to be used
 * inside SMOF
 */

jQuery.noConflict();

var ish_import = {};
var ish_force_skin_change = false;

/** Fire up jQuery - let's dance! 
 */
jQuery(document).ready(function($){
	
	//(un)fold options in a checkbox-group
  	jQuery('.fld').click(function() {
    	var $fold='.f_'+this.id;
    	$($fold).slideToggle('normal', "swing");
  	});
	
	//hides warning if js is enabled			
	$('#js-warning').hide();
	
	//Tabify Options			
	$('.group').hide();
	
	// Display last current tab	
	if ($.cookie("of_current_opt") === null) {
		$('.group:first').fadeIn('fast');	
		$('#of-nav li:first').addClass('current');
	} else {
	
		var hooks = $('#hooks').html();
		hooks = jQuery.parseJSON(hooks);
		
		$.each(hooks, function(key, value) { 
		
			if ($.cookie("of_current_opt") == '#of-option-'+ value) {
				$('.group#of-option-' + value).fadeIn();
				$('#of-nav li.' + value).addClass('current');
			}
			
		});
	
	}
				
	//Current Menu Class
	$('#of-nav li a').click(function(evt){
	// event.preventDefault();
				
		$('#of-nav li').removeClass('current');
		$(this).parent().addClass('current');
							
		var clicked_group = $(this).attr('href');
		
		$.cookie('of_current_opt', clicked_group, { expires: 7, path: '/' });
			
		$('.group').hide();
							
		$(clicked_group).fadeIn('fast');
		return false;
						
	});

	//Expand Options 
	var flip = 0;
				
	$('#expand_options').click(function(){
		if(flip == 0){
			flip = 1;
			$('#of_container #of-nav').hide();
			$('#of_container #content').width(755);
			$('#of_container .group').add('#of_container .group h2').show();
	
			$(this).removeClass('expand');
			$(this).addClass('close');
			$(this).text('Close');
					
		} else {
			flip = 0;
			$('#of_container #of-nav').show();
			$('#of_container #content').width(595);
			$('#of_container .group').add('#of_container .group h2').hide();
			$('#of_container .group:first').show();
			$('#of_container #of-nav li').removeClass('current');
			$('#of_container #of-nav li:first').addClass('current');
					
			$(this).removeClass('close');
			$(this).addClass('expand');
			$(this).text('Expand');
				
		}
			
	});
	
	//Update Message popup
	$.fn.center = function () {
		this.animate({"top":( $(window).height() - this.height() - 200 ) / 2+$(window).scrollTop() + "px"},100);
		this.css("left", 250 );
		return this;
	}
		
			
	$('#of-popup-save').center();
	$('#of-popup-reset').center();
	$('#of-popup-fail').center();
			
	$(window).scroll(function() { 
		$('#of-popup-save').center();
		$('#of-popup-reset').center();
		$('#of-popup-fail').center();
	});
			

	//Masked Inputs (images as radio buttons)
	$('.of-radio-img-img').click(function(){
        $(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
        $(this).addClass('of-radio-img-selected');
    });
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
	
	//Masked Inputs (background images as radio buttons)
	$('.of-radio-tile-img').click(function(){
		$(this).parent().parent().find('.of-radio-tile-img').removeClass('of-radio-tile-selected');
		$(this).addClass('of-radio-tile-selected');
	});
	$('.of-radio-tile-label').hide();
	$('.of-radio-tile-img').show();
	$('.of-radio-tile-radio').hide();

    var skin_section = jQuery('#section-skin');
    var skin_orig = skin_section.find('.of-radio-img-selected').attr('src');
    var skin_curr = skin_orig;

    // SKIN SWITCHER
    skin_section.find('.of-radio-img-img').off('click');
    skin_section.find('.of-radio-img-img').click(function(){
        skin_curr = $(this).attr('src');
        if ( '' == skin_orig ) { skin_orig = skin_curr; }

        var answer = confirm("Changing the skin will reset all your set Theme Options. Are you sure you want to continue?");

        //ajax reset
        if (answer){
            $(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
            $(this).addClass('of-radio-img-selected');
	        ish_force_skin_change = true;
            $('#of_save').click();
        }
    });
			
	// Style Select
	(function ($) {
	styleSelect = {
		init: function () {
		$('.select_wrapper').each(function () {
			$(this).prepend('<span>' + $(this).find('.select option:selected').text() + '</span>');
		});
		$('.select').live('change', function () {
			$(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
		});
		$('.select').bind($.browser.msie ? 'click' : 'change', function(event) {
			$(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
		}); 
		}
	};
	$(document).ready(function () {
		styleSelect.init()
	})
	})(jQuery);
	
	
	/** Aquagraphite Slider MOD */
	
	//Hide (Collapse) the toggle containers on load
	$(".slide_body").hide(); 

	//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
	$(".slide_edit_button").live( 'click', function(){
		$(this).parent().toggleClass("active").next().slideToggle("fast");
		return false; //Prevent the browser jump to the link anchor
	});	
	
	// Update slide title upon typing		
	function update_slider_title(e) {
		var element = e;
		if ( this.timer ) {
			clearTimeout( element.timer );
		}
		this.timer = setTimeout( function() {
			$(element).parent().prev().find('strong').text( element.value );
		}, 100);
		return true;
	}
	
	$('.of-slider-title').live('keyup', function(){
		update_slider_title(this);
	});
		
	
	//Remove individual slide
	$('.slide_delete_button').live('click', function(){
	// event.preventDefault();
	var agree = confirm("Are you sure you wish to delete this slide?");
		if (agree) {
			var $trash = $(this).parents('li');
			$trash.animate({
					opacity: 0.25,
					height: 0
				}, 500, function() {
					$(this).remove();
			});
			return false; //Prevent the browser jump to the link anchor
		} else {
		return false;
		}	
	});
	
	//Add new slide
	$(".slide_add_button").live('click', function(){		
		var slidesContainer = $(this).prev();
		var sliderId = slidesContainer.attr('id');
		var sliderInt = $('#'+sliderId).attr('rel');
		
		var numArr = $('#'+sliderId +' li').find('.order').map(function() { 
			var str = this.id; 
			str = str.replace(/\D/g,'');
			str = parseFloat(str);
			return str;			
		}).get();
		
		var maxNum = Math.max.apply(Math, numArr);
		if (maxNum < 1 ) { maxNum = 0};
		var newNum = maxNum + 1;
		
		var newSlide = '<li class="temphide"><div class="slide_header"><strong>Slide ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><label>Image URL</label><input class="upload slide of-input" name="' + sliderId + '[' + newNum + '][url]" id="' + sliderId + '_' + newNum + '_slide_url" value=""><div class="upload_button_div"><span class="button media_upload_button" id="' + sliderId + '_' + newNum + '">Upload</span><span class="button remove-image hide" id="reset_' + sliderId + '_' + newNum + '" title="' + sliderId + '_' + newNum + '">Remove</span></div><div class="screenshot"></div><label>Link URL (optional)</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][link]" id="' + sliderId + '_' + newNum + '_slide_link" value=""><label>Description (optional)</label><textarea class="slide of-input" name="' + sliderId + '[' + newNum + '][description]" id="' + sliderId + '_' + newNum + '_slide_description" cols="8" rows="8"></textarea><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';

        slidesContainer.append(newSlide);
		$('.temphide').fadeIn('fast', function() {
			$(this).removeClass('temphide');
		});

        optionsframework_file_bindings(); // re-initialise upload image..
		
		return false; //prevent jumps, as always..
	});	
	
	//Sort slides
	jQuery('.slider').find('ul').each( function() {
		var id = jQuery(this).attr('id');
		$('#'+ id).sortable({
			placeholder: "placeholder",
			opacity: 0.6
		});	
	});
	
	
	/**	Sorter (Layout Manager) */
	jQuery('.sorter').each( function() {
		var id = jQuery(this).attr('id');
		$('#'+ id).find('ul').sortable({
			items: 'li',
			placeholder: "placeholder",
			connectWith: '.sortlist_' + id,
			opacity: 0.6,
			update: function() {
				$(this).find('.position').each( function() {
				
					var listID = $(this).parent().attr('id');
					var parentID = $(this).parent().parent().attr('id');
					parentID = parentID.replace(id + '_', '')
					var optionID = $(this).parent().parent().parent().attr('id');
					$(this).prop("name", optionID + '[' + parentID + '][' + listID + ']');
					
				});
			}
		});	
	});
	
	
	/**	Ajax Backup & Restore MOD */
	//backup button
	$('#of_backup_button').live('click', function(){
	
		var answer = confirm("Click OK to backup your current saved options.")
		
		if (answer){
	
			var clickedObject = $(this);
			var clickedID = $(this).attr('id');
					
			var nonce = $('#security').val();
            var wpml_lang = $('#wpml_lang').val();
		
			var data = {
				action: 'of_ajax_post_action',
				type: 'backup_options',
                wpml_lang: wpml_lang,
				security: nonce
			};
						
			$.post(ajaxurl, data, function(response) {
							
				//check nonce
				if(response==-1){ //failed
								
					var fail_popup = $('#of-popup-fail');
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();                        
					}, 2000);
				}
							
				else {
							
					var success_popup = $('#of-popup-save');
					success_popup.fadeIn();
					window.setTimeout(function(){
						location.reload();                        
					}, 1000);
				}
							
			});
			
		}
		
	return false;
					
	}); 
	
	//restore button
	$('#of_restore_button').live('click', function(){
	
		var answer = confirm("'Warning: All of your current options will be replaced with the data from your last backup! Proceed?")
		
		if (answer){
	
			var clickedObject = $(this);
			var clickedID = $(this).attr('id');
					
			var nonce = $('#security').val();
            var wpml_lang = $('#wpml_lang').val();
		
			var data = {
				action: 'of_ajax_post_action',
				type: 'restore_options',
                wpml_lang: wpml_lang,
				security: nonce
			};
						
			$.post(ajaxurl, data, function(response) {
			
				//check nonce
				if(response==-1){ //failed
								
					var fail_popup = $('#of-popup-fail');
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();                        
					}, 2000);
				}
							
				else {
							
					var success_popup = $('#of-popup-save');
					success_popup.fadeIn();
					window.setTimeout(function(){
						location.reload();                        
					}, 1000);
				}	
						
			});
	
		}
	
	return false;
					
	});
	
	/**	Ajax Transfer (Import/Export) Option */
	$('#of_import_button').live('click', function(){
	
		var answer = confirm("Click OK to import options.")
		
		if (answer){
	
			var clickedObject = $(this);
			var clickedID = $(this).attr('id');
					
			var nonce = $('#security').val();
			
			var import_data = $('#export_data').val();
            var wpml_lang = $('#wpml_lang').val();
		
			var data = {
				action: 'of_ajax_post_action',
				type: 'import_options',
                wpml_lang: wpml_lang,
				security: nonce,
				data: import_data
			};
						
			$.post(ajaxurl, data, function(response) {
				var fail_popup = $('#of-popup-fail');
				var success_popup = $('#of-popup-save');
				
				//check nonce
				if(response==-1){ //failed
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();                        
					}, 2000);
				}		
				else 
				{
					success_popup.fadeIn();
					window.setTimeout(function(){
						location.reload();                        
					}, 100);
				}
							
			});
			
		}
		
	return false;
					
	});
	
	/** AJAX Save Options */
	$('#of_save').live('click',function() {
			
		var nonce = $('#security').val();
					
		$('.ajax-loading-img').fadeIn();

		var original_values = Array();

		// Fixing fields which contain sript tags so that the request is not blocked by the server
		$('#of_form #tracking_script, #of_form #addthis_share').each( function( index ){
			var me = $(this);

			// Save the original field value
			original_values[ index ] = me.val();

			// replace the script tags
			me.val(
				original_values[ index ].replace('<script', 'ish-rplc_open').replace('</script>', 'ish-rplc_close')
			);
		});

		//get serialized data from all our option fields			
		var serializedReturn = $('#of_form :input[name][name!="security"][name!="of_reset"][name!="wpml_lang"]').serialize();
        // Added by IshYoBoy - WPML admin language transferred through ajax calls as well.
        var wpml_lang = $('#wpml_lang').val();

		// Fixing fields which contain sript tags so that the request is not blocked by the server
		$('#of_form #tracking_script, #of_form #addthis_share').each( function( index ){
			var me = $(this);

			// Restore Original values
			me.val(
				original_values[ index ]
			);
		});
						
		var data = {
			type: 'save',
			action: 'of_ajax_post_action',
            // Added by IshYoBoy - WPML admin language transferred through ajax calls as well.
            wpml_lang: wpml_lang,
			force_skin_change: ish_force_skin_change,
			security: nonce,
			data: serializedReturn
		};
					
		$.post(ajaxurl, data, function(response) {
			var success = $('#of-popup-save');
			var fail = $('#of-popup-fail');
			var loading = $('.ajax-loading-img');
			loading.fadeOut();  
						
			if (response==1) {
				success.fadeIn();
			} else { 
				fail.fadeIn();
			}

			// added by IshYoBoy
			// post a request to flush rewrite rules and don't care about the result
			data.type = 'flush';
			data.data = '';
			$.post( ajaxurl, data );

            if (skin_curr != skin_orig || ish_force_skin_change ){
                window.setTimeout(function(){
                    window.location.reload();
                }, 200);

            }
						
			window.setTimeout(function(){
				success.fadeOut(); 
				fail.fadeOut();				
			}, 2000);
		});
			
	return false; 
					
	});   
	
	
	/* AJAX Options Reset */	
	$('#of_reset').click(function() {
		
		//confirm reset
		var answer = confirm("Click OK to reset. All settings will be lost and replaced with default settings!");

		//ajax reset
		if (answer){
			
			var nonce = $('#security').val();
						
			$('.ajax-reset-loading-img').fadeIn();

            //Added by IshYoBoy
            var wpml_lang = $('#wpml_lang').val();
							
			var data = {
			
				type: 'reset',
				action: 'of_ajax_post_action',
                wpml_lang: wpml_lang,
				security: nonce
			};
						
			$.post(ajaxurl, data, function(response) {
				var success = $('#of-popup-reset');
				var fail = $('#of-popup-fail');
				var loading = $('.ajax-reset-loading-img');
				loading.fadeOut();  
							
				if (response==1)
				{
					success.fadeIn();
					window.setTimeout(function(){
						location.reload();                        
					}, 1000);
				} 
				else 
				{ 
					fail.fadeIn();
					window.setTimeout(function(){
						fail.fadeOut();				
					}, 2000);
				}
							

			});
			
		}
			
	return false;
		
	});

    /* Font List change */

    var google_selected_values = [];
    var google_font_select = $('.google_font_select');

    google_font_select.change(function() {
        var self = $(this);
        var self_id = self.attr('id');
        var google_variant_select = $('#' + self_id + '_variant');
        google_selected_values[self_id] = self.val();
        google_selected_values[self_id + '_variant'] = google_variant_select.val();

        var obj = jQuery.parseJSON(ish_google_fonts);
        var gstyles = '';
        $.each(obj, function(key , value) {
            if ( google_selected_values[self_id] == key){
                var selected;
                var all_variants = '';
                $.each(value.variants, function(skey , svalue) {
                    if (svalue == google_selected_values[self_id + '_variant']) {selected = ' selected="selected"'} else {selected = ''}
                    all_variants += svalue + ',';
                    gstyles += '<option value="' + svalue + '"' + selected +'>' + svalue + '</option>'
                });

                GoogleFontSelectVariants(self, self_id, all_variants);

                google_variant_select.html(gstyles);

                var option = google_variant_select.children('option').filter(":selected");
                var val = option.val();
                if (val){
                    google_variant_select.parent().children('span').html(option.text());
                    google_variant_select.change();
                }
            }
        });
    });

    var google_variant_select = $('select[name*="_google_variant"]');

    google_variant_select.change(function() {
        var self = $(this);
        var self_id = self.attr('id');
        var google_font_preview = $('.' + self_id.substr(0, self_id.length -8) + '_ggf_previewer');
        var google_font_select = $('#' + self_id.substr(0, self_id.length -8));

        var val = self.val();
        var _selected = google_font_select.children('option').filter(":selected").val();

        var _linkclass = 'style_link_'+ google_font_select.attr('id');
        var _previewer = google_font_select.attr('id') +'_ggf_previewer';

        switch (val){
            case '100' :
                google_font_preview.css('font-weight', val );
                google_font_preview.css('font-style', 'normal' );
                break;
            case '100italic' :
                google_font_preview.css('font-weight', '100' );
                google_font_preview.css('font-style', 'italic' );
                break;
            case '200' :
                google_font_preview.css('font-weight', val );
                google_font_preview.css('font-style', 'normal' );
                break;
            case '200italic' :
                google_font_preview.css('font-weight', '200' );
                google_font_preview.css('font-style', 'italic' );
                break;
            case '300' :
                google_font_preview.css('font-weight', val );
                google_font_preview.css('font-style', 'normal' );
                break;
            case '300italic' :
                google_font_preview.css('font-weight', '300' );
                google_font_preview.css('font-style', 'italic' );
                break;
            case 'regular' :
                google_font_preview.css('font-weight', '400' );
                google_font_preview.css('font-style', 'normal' );
                break;
            case 'italic' :
                google_font_preview.css('font-weight', '400' );
                google_font_preview.css('font-style', 'italic' );
                break;
            case '500' :
                google_font_preview.css('font-weight', val );
                google_font_preview.css('font-style', 'normal' );
            break;
            case '500italic' :
                google_font_preview.css('font-weight', '500' );
                google_font_preview.css('font-style', 'italic' );
                break;
            case '600' :
                google_font_preview.css('font-weight', val );
                google_font_preview.css('font-style', 'normal' );
            break;
            case '600italic' :
                google_font_preview.css('font-weight', '600' );
                google_font_preview.css('font-style', 'italic' );
                break;
            case '700' :
                google_font_preview.css('font-weight', val );
                google_font_preview.css('font-style', 'normal' );
            break;
            case '700italic' :
                google_font_preview.css('font-weight', '700' );
                google_font_preview.css('font-style', 'italic' );
                break;
            case '800' :
                google_font_preview.css('font-weight', val );
                google_font_preview.css('font-style', 'normal' );
            break;
            case '800italic' :
                google_font_preview.css('font-weight', '800' );
                google_font_preview.css('font-style', 'italic' );
                break;
            case '900' :
                google_font_preview.css('font-weight', val );
                google_font_preview.css('font-style', 'normal' );
            break;
            case '900italic' :
                google_font_preview.css('font-weight', '900' );
                google_font_preview.css('font-style', 'italic' );
                break;
        }
    });

    google_font_select.each(function() {
        $(this).change();
    });


    /*
    var ish_font_type = $('.ish-font-type input');
    ish_font_type.change(function() {

        var ish_id = $(this).attr('id').split("-", 1);
        var ish_font_face_select = $('#section-' + ish_id + ' .of-typography-face');
        var backup = '';


        if ('regular' == $(this).val()){
            // SELECTING REGULAR FONTS
            backup = ish_font_face_select.html();
            ish_font_face_select.html(ish_regular_fonts)

        }else{
            // SELECTING GOOGLE FONTS
            backup = ish_font_face_select.html();
            var obj = jQuery.parseJSON(ish_google_fonts);
            var gfonts = '';
            $.each(obj, function(key , value) {
                gfonts += '<option value="' + key + '">' + key + '</option>'
            });
            ish_font_face_select.html(gfonts);
        }

        var option =ish_font_face_select.children().eq(0);
        var val = option.val();
        ish_font_face_select.val(val);
        ish_font_face_select.parent().children('span').html(option.text());
        ish_font_face_select.change();

    });


    var ish_font_face = $('.ish-font-typography .of-typography-face');
    ish_font_face.change(function() {

        var id = $(this).attr('id');
        var ish_id = id.substr(0, id.length -5);
        var type = $('#section-' + ish_id + '-type.ish-font-type input:checked').val()
        var ish_font_style_select = $('#section-' + ish_id + ' .of-typography-style');
        var ish_font_face_select = $('#section-' + ish_id + ' .of-typography-face');
        var ish_font_face_select_val = ish_font_face_select.val();

        if ('regular' == type){
            // SELECTING REGULAR FONTS
            ish_font_style_select.html('<option value="normal">Normal</option><option value="italic">Italic</option><option value="bold">Bold</option><option value="bold italic">Bold Italic</option>');

        }else{
            // SELECTING GOOGLE FONTS
            var obj = jQuery.parseJSON(ish_google_fonts);
            var gstyles = '';
            $.each(obj, function(key , value) {
                if ( ish_font_face_select_val == key){
                    $.each(value.variants, function(skey , svalue) {
                        gstyles += '<option value="' + svalue + '">' + svalue + '</option>'
                    });
                    ish_font_style_select.html(gstyles);
                }
            });
        }

        var option = ish_font_style_select.children().eq(0);
        var val = option.val();
        ish_font_style_select.val(val);
        ish_font_style_select.parent().children('span').html(option.text());

    });
    /**/



	/**	Tipsy @since v1.3 */
	if (jQuery().tipsy) {
		$('.typography-size, .typography-height, .typography-face, .typography-style, .of-typography-color').tipsy({
			fade: true,
			gravity: 's',
			opacity: 0.7
		});
	}
	
	
	/**
	  * JQuery UI Slider function
	  * Dependencies 	 : jquery, jquery-ui-slider
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 03.17.2013
	  */
	jQuery('.smof_sliderui').each(function() {
		
		var obj   = jQuery(this);
		var sId   = "#" + obj.data('id');
		var val   = parseInt(obj.data('val'));
		var min   = parseInt(obj.data('min'));
		var max   = parseInt(obj.data('max'));
		var step  = parseInt(obj.data('step'));
		
		//slider init
		obj.slider({
			value: val,
			min: min,
			max: max,
			step: step,
			slide: function( event, ui ) {
				jQuery(sId).val( ui.value );
			}
		});
		
	});
	
	
	/**
	  * Switch
	  * Dependencies 	 : jquery
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 03.17.2013
	  */
	jQuery(".cb-enable").click(function(){
		var parent = $(this).parents('.switch-options');
		jQuery('.cb-disable',parent).removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery('.main_checkbox',parent).attr('checked', true);
		
		//fold/unfold related options
		var obj = jQuery(this);
		var $fold='.f_'+obj.data('id');
		jQuery($fold).slideDown('normal', "swing");

        //*****************
        //Added by IshYoBoy
        var $fold2='.f_off_'+obj.data('id');
        if (jQuery($fold2).length > 0){
            jQuery($fold2).slideUp('normal', "swing");
        }
	});
	jQuery(".cb-disable").click(function(){
		var parent = $(this).parents('.switch-options');
		jQuery('.cb-enable',parent).removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery('.main_checkbox',parent).attr('checked', false);
		
		//fold/unfold related options
		var obj = jQuery(this);
		var $fold='.f_'+obj.data('id');
		jQuery($fold).slideUp('normal', "swing");

        //*****************
        //Added by IshYoBoy
        var $fold2='.f_off_'+obj.data('id');
        if (jQuery($fold2).length > 0){
            jQuery($fold2).slideDown('normal', "swing");
        }
	});

    //*****************
    //Added by IshYoBoy

	//disable text select(for modern chrome, safari and firefox is done via CSS)
	if (($.browser.msie && $.browser.version < 10) || $.browser.opera) { 
		$('.cb-enable span, .cb-disable span').find().attr('unselectable', 'on');
	}
	
	
	/**
	  * Google Fonts
	  * Dependencies 	 : google.com, jquery
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 03.17.2013
	  */
	function GoogleFontSelect( slctr, mainID ){
		
		var _selected = $(slctr).val(); 						//get current value - selected and saved
		var _linkclass = 'style_link_'+ mainID;
		var _previewer = mainID +'_ggf_previewer';
		
		if( _selected ){ //if var exists and isset
			
			//Check if selected is not equal with "Select a font" and execute the script.
			if ( _selected !== 'none' && _selected !== 'Select a font' ) {
				
				//remove other elements crested in <head>
				$( '.'+ _linkclass ).remove();
				
				//replace spaces with "+" sign
				var the_font = _selected.replace(/\s+/g, '+');
				
				//add reference to google font family
				$('head').append('<link href="//fonts.googleapis.com/css?family='+ the_font +'" rel="stylesheet" type="text/css" class="'+ _linkclass +'">');
				
				//show in the preview box the font
				$('.'+ _previewer ).css('font-family', _selected +', sans-serif' );
				
			}else{
				
				//if selected is not a font remove style "font-family" at preview box
				$('.'+ _previewer ).css('font-family', '' );
				
			}
		
		}
	
	}

    function GoogleFontSelectVariants( slctr, mainID, variants ){

        var _selected = $(slctr).val(); 						//get current value - selected and saved
        var _linkclass = 'style_link_'+ mainID;
        var _previewer = mainID +'_ggf_previewer';

        if( _selected ){ //if var exists and isset

            //Check if selected is not equal with "Select a font" and execute the script.
            if ( _selected !== 'none' && _selected !== 'Select a font' ) {

                //remove other elements crested in <head>
                $( '.'+ _linkclass ).remove();

                //replace spaces with "+" sign
                var the_font = _selected.replace(/\s+/g, '+');

                //add reference to google font family
                $('head').append('<link href="//fonts.googleapis.com/css?family='+ the_font + ':' + variants + '" rel="stylesheet" type="text/css" class="'+ _linkclass +'">');

                //show in the preview box the font
                $('.'+ _previewer ).css('font-family', _selected +', sans-serif' );

            }else{

                //if selected is not a font remove style "font-family" at preview box
                $('.'+ _previewer ).css('font-family', '' );

            }

        }

    }
	
	//init for each element
	jQuery( '.google_font_select' ).each(function(){ 
		//var mainID = jQuery(this).attr('id');
		//GoogleFontSelect( this, mainID );
	});
	
	//init when value is changed
	jQuery( '.google_font_select' ).change(function(){ 
		//var mainID = jQuery(this).attr('id');
		//GoogleFontSelect( this, mainID );
	});



	/*
	 * Ish Theme Skins - switch .controls & .exlpain
	 */
	if ( jQuery('#of_container #section-skin').length > 0 ) {
		var ish_controls = jQuery('#of_container #section-skin .controls');
		var ish_exlpain = jQuery('#of_container #section-skin .explain');

		ish_controls.before(ish_exlpain);
	}


    /*
     * Ish Demo Importer
     */

	if ( $.cookie('ish_demo_import_refresh') === 'true'){
		// Update process has finished so we need to display success message
		jQuery('.next-step-cta-holder').hide();
		jQuery('.import-box .import-success-holder').show();
		$.cookie('ish_demo_import_refresh', '', {expires: -1, path: '/'});
	}


	function attempt_import(){

		if ( ( !ish_import.import_done || !ish_import.after_import_done ) && (ish_import.cur_attempt <= ish_import.max_attempts) ){

			$.ajax({
				type: "POST",
				url: ajaxurl,
				data:
				{
					action: 'ishfreelotheme_ajax_demo_import',
					_ajax_nonce: jQuery('input[name=ishyoboy-demo-import-nonce]').val(),
					demo_content: jQuery('input[name=demo_import_skin]:checked').val(),
					import_done: ish_import.import_done,
					after_import_done: ish_import.after_import_done
				},
				beforeSend: function()
				{
					if ( 1 == ish_import.cur_attempt ) {
						jQuery('.ish-step-3').fadeOut(300);
						jQuery('.next-step-cta-holder').fadeOut(300, function () {
							jQuery('.import-box .import-started-message').fadeIn();
						});
					}
				},
				error: function()
				{
					jQuery('.import-box .import-started-message').fadeOut(300, function(){
						jQuery('.import-box .import-error-holder').fadeIn();
					});
				},
				success: function( response )
				{

					if ( 'object' === jQuery.type(response) ) {

						if ( response.data.demo_data_imported ){
							ish_import.import_done = true;
						}
						else if ( response.data.demo_data_after_import_done ) {
							ish_import.after_import_done = true;
						}

						// Set the new nonce
						jQuery('input[name=ishyoboy-demo-import-nonce]').val( response.data._ajax_nonce );
					}

					if ( ish_import.import_done && ish_import.after_import_done )
					{
						// BOTH IMPORT && MANUAL SETTINGS DONE

						// SKIN Switch only after demo data import
						var skin_section = jQuery('#section-skin');
						if ( skin_section.length > 0 ) {

							// Change the skin
							var demo = jQuery('input[name=demo_import_skin]:checked').val();
							var new_skin = skin_section.find("input[value='" + demo + ".php']");
							skin_section.find('input').prop('checked', false);
							new_skin.prop("checked", true);
							skin_section.find('.of-radio-img-img').removeClass('of-radio-img-selected');
							new_skin.parent().find('.of-radio-img-img').addClass('of-radio-img-selected');
							skin_curr = new_skin.parent().find('.of-radio-img-img').attr('src');

							/*if ( skin_curr == skin_orig ){
								// SHOW ALL DONE STEP
								jQuery('.import-box .import-started-message').fadeOut(300, function(){
									jQuery('.import-box .import-success-holder').fadeIn();
								});
							}else{*/

								// Set cookie so "All Done" message will be displayed after refresh.
								$.cookie('ish_demo_import_refresh', 'true', {expires: 1, path: '/'});
								ish_force_skin_change = true;
								jQuery('<p>Changing Skin & Refreshing Options...</p>').appendTo('.import-box .import-started-message');
							/*}*/

							// Save all Settings and change skin if necessary
							$('#of_save').click();

						}else{
							// SHOW ALL DONE STEP
							jQuery('.import-box .import-started-message').fadeOut(300, function(){
								jQuery('.import-box .import-success-holder').fadeIn();
							});
						}
					}
					else if ( ish_import.cur_attempt >= ish_import.max_attempts )
					{
						// MAX ATTEMPTS EXCEEDED

						if ( 'object' !== jQuery.type(response) ) {
							response = response.
								replace('demo_data_imported', '').
								replace('demo_data_after_import_done', '').
								replace('ish_pages_set', '').
								replace('ish_menus_set', '').
								replace('ish_widgets_set', '').
								replace('ish_permalinks_set', '').
								replace('<p>Remember to update the passwords and roles of imported users.</p>', '');
						} else{
							response = 'The maximum script execution time might be too short to finalize the import process. Please contact your hosting support team to increase it and try again.';
						}

						jQuery('.import-box .import-started-message').fadeOut(300, function(){
							jQuery('.import-box .import-error-message').html( '<p>The script returned the following message:</p>' + response );
							jQuery('.import-box .import-error-holder').fadeIn();
						});
					}
					else {
						// MAKE ANOTHER ATTEMPT
						if ( !ish_import.import_done ) {
							jQuery('<p>Something went wrong. Trying to import demo content again...</p>').appendTo('.import-box .import-started-message');
						}
						attempt_import();
					}

				},
				complete: function( response )
				{

				}
			});

			ish_import.cur_attempt++;
		}

	}

    var import_btn = jQuery('#run_import');
    if ( import_btn.length > 0 ) {
        import_btn.click( function(e){
            e.preventDefault();

            var answer = confirm( 'Are you sure you want to import the demo data? This may change your Theme Options and duplicate some content if it exists already.');
            if ( ! answer ){ return false }

	        ish_import.max_attempts = 6;
	        ish_import.cur_attempt = 1;
	        ish_import.import_done = false;
	        ish_import.after_import_done = false;

	        attempt_import();

            return false;

        });
    }

	/*
	 * Ish Demo Importer - Next step;
	 */
	var next_step_btn = jQuery('#demo_import_next_step');
	var prev_step_btn = jQuery('#demo_import_previous_step');

	// NEXT BTN
	if ( next_step_btn.length > 0 ) {

		var me = jQuery(this);

		next_step_btn.click( function(e){

			e.preventDefault();

			// Set up steps
			var val = 0;
			if ( typeof jQuery.data( me, 'step' ) == 'undefined' ) {
				jQuery.data(me, 'step', 1);
			}
			else{
				val = jQuery.data( me, 'step');
				jQuery.data( me, 'step', val + 1 );
			}
			val = jQuery.data( me, 'step');

			// Previous and next steps
			var prev = jQuery('.ish-step-' + (val - 1) );
			var next = jQuery('.ish-step-' + val);

			// The actual switching
			if ( 1 == val ){
				next.fadeIn(300);
				prev_step_btn.fadeIn(300).css( 'display', 'inline-block'); // necessary otherwise jQuery will display it inline
			}
			else{
				if (3 == val){  }
				prev.fadeOut(300, function(){
					if (3 == val){
						next_step_btn.hide();
						import_btn.show().css( 'display', 'inline-block'); // necessary otherwise jQuery will display it inline
					}
					next.fadeIn(300);
				});
			}

		});
	}

	// PREV BTN
	if ( prev_step_btn.length > 0 ) {

		var me = jQuery(this);

		prev_step_btn.click( function(e){
			e.preventDefault();

			// Set up steps
			var val = 0;
			if ( typeof jQuery.data( me, 'step' ) == 'undefined' ) {
				jQuery.data(me, 'step', 1);
			}
			else{
				val = jQuery.data( me, 'step');
				jQuery.data( me, 'step', val);
			}
			val = jQuery.data( me, 'step');
			if ( val !== 'undefined' ) {

				// Previous and next steps
				var prev = jQuery('.ish-step-' + (val - 1));
				var cur = jQuery('.ish-step-' + val);

				// The actual switching
				if (1 == val) {
					prev_step_btn.fadeOut(300);
				}
				cur.fadeOut(300, function () {
					if (3 == val) {
						import_btn.hide();
						next_step_btn.show().css('display', 'inline-block'); // necessary otherwise jQuery will display it inline
					}
					prev.fadeIn(300);
				});

				jQuery.data(me, 'step', val - 1);
			}

		});
	}



	/*
	 * Toggle for admin styling options - paterns / fonts
	 */
	/*var patterns_fonts = {
		pBackground: jQuery(
			'#section-use_background_pattern,' +
			'#section-background_bg_pattern,' +
			'#section-background_bg_image,' +
			'#section-background_bg_image_cover'),
		pHeader: jQuery(
			'#section-use_header_pattern,' +
			'#section-header_bg_pattern,' +
			'#section-header_bg_image'),
		pLead: jQuery(
			'#section-use_lead_pattern,' +
			'#section-lead_bg_pattern,' +
			'#section-lead_bg_image'),
		pContent: jQuery(
			'#section-use_content_pattern,' +
			'#section-content_bg_pattern,' +
			'#section-content_bg_image'),
		pFooter: jQuery(
			'#section-use_footer_pattern,' +
			'#section-footer_bg_pattern,' +
			'#section-footer_bg_image'),
		fBody: jQuery(
			'#section-body_font_use_google_font,' +
			'#section-body_font_google,' +
			'#section-body_font_google_variant,' +
			'#section-body_font_regular,' +
			'#section-body_font_regular_variant,' +
			'#section-body_font_size,' +
			'#section-body_font_line_height'),
		fBody2: jQuery(
			'#section-body_font_2_use_google_font,' +
			'#section-body_font_2_google,' +
			'#section-body_font_2_google_variant,' +
			'#section-body_font_2_regular,' +
			'#section-body_font_2_regular_variant,' +
			'#section-body_font_2_size,' +
			'#section-body_font_2_line_height'),
		fHeader: jQuery(
			'#section-header_font_use_google_font,' +
			'#section-header_font_google,' +
			'#section-header_font_google_variant,' +
			'#section-header_font_regular,' +
			'#section-header_font_regular_variant,' +
			'#section-header_font_size,' +
			'#section-header_font_line_height'),
		fh1: jQuery('' +
			'#section-h1_font_use_google_font, ' +
			'#section-h1_font_google,' +
			'#section-h1_font_google_variant,' +
			'#section-h1_font_regular,' +
			'#section-h1_font_regular_variant,' +
			'#section-h1_font_size,' +
			'#section-h1_font_line_height'),
		fh2: jQuery('' +
			'#section-h2_font_use_google_font,' +
			'#section-h2_font_google,' +
			'#section-h2_font_google_variant,' +
			'#section-h2_font_regular,' +
			'#section-h2_font_regular_variant,' +
			'#section-h2_font_size,' +
			'#section-h2_font_line_height'),
		fh3: jQuery('' +
			'#section-h3_font_use_google_font,' +
			'#section-h3_font_google,' +
			'#section-h3_font_google_variant,' +
			'#section-h3_font_regular,' +
			'#section-h3_font_regular_variant,' +
			'#section-h3_font_size,' +
			'#section-h3_font_line_height'),
		fh4: jQuery('' +
			'#section-h4_font_use_google_font,' +
			'#section-h4_font_google,' +
			'#section-h4_font_google_variant,' +
			'#section-h4_font_regular,' +
			'#section-h4_font_regular_variant,' +
			'#section-h4_font_size,' +
			'#section-h4_font_line_height'),
		fh5: jQuery('' +
			'#section-h5_font_use_google_font,' +
			'#section-h5_font_google,' +
			'#section-h5_font_google_variant,' +
			'#section-h5_font_regular,' +
			'#section-h5_font_regular_variant,' +
			'#section-h5_font_size,' +
			'#section-h5_font_line_height'),
		fh6: jQuery('' +
			'#section-h6_font_use_google_font,' +
			'#section-h6_font_google,' +
			'#section-h6_font_google_variant,' +
			'#section-h6_font_regular,' +
			'#section-h6_font_regular_variant,' +
			'#section-h6_font_size,' +
			'#section-h6_font_line_height')
	};

	jQuery.each(patterns_fonts, function(name, value) {
		value.wrapAll('<div class="ish-styling-toggle"><div class="ish-styling-toggle-item"></div></div>');

		var tgg = value.parents('.ish-styling-toggle');
		var tggItem = value.parent('.ish-styling-toggle-item');
		var opened = false;

		tggItem.before( value.find('h3.heading') );

		var tggTitle = tgg.find('.heading');

		tggTitle.click(function() {
			if ( !opened ) {
				$(this).parent().find('.ish-styling-toggle-item').slideDown();
				opened = true;
			}
			else {
				$(this).parent().find('.ish-styling-toggle-item').slideUp();
				opened = false;
			}
		});
	});*/



	// Sticky save options button --------------------------------------------------------------------------------------
	var ib = jQuery('#info_bar');
	if ( ib.length > 0 ) {
		jQuery(window).scroll(function() {
			var ibHeaderHeight = 200;
			var ibScrollPos = jQuery(this).scrollTop();
			var lastScrollTop = 0;

			if ( ibScrollPos > lastScrollTop ) {
				// Scroll down
				if ( ibScrollPos > ( ibHeaderHeight / 2 ) ) { ib.css({ 'position': 'fixed', 'width': '757', 'top': '31px', 'z-index': '99999' }); }
			} else {
				// Scroll top
				if ( ibScrollPos < ibHeaderHeight / 2 ) { ib.css({ 'position': 'relative', 'top': '0' }); }
			}
			lastScrollTop = ibScrollPos;
		});
	}

    /**
     * Media Uploader
     * Dependencies 	 : jquery, wp media uploader
     * Feature added by : Smartik - http://smartik.ws/
     * Date 			 : 05.28.2013
     */
    function optionsframework_add_file(event, selector) {

        var upload = $(".uploaded-file"), frame;
        var $el = $(this);

        event.preventDefault();

        // If the media frame already exists, reopen it.
        if ( frame ) {
            frame.open();
            return;
        }

        // Create the media frame.
        frame = wp.media({
            // Set the title of the modal.
            title: $el.data('choose'),

            // Customize the submit button.
            button: {
                // Set the text of the button.
                text: $el.data('update'),
                // Tell the button not to close the modal, since we're
                // going to refresh the page when the image is selected.
                close: false
            }
        });

        // When an image is selected, run a callback.
        frame.on( 'select', function() {
            // Grab the selected attachment.
            var attachment = frame.state().get('selection').first();
            frame.close();
            selector.find('.upload').val(attachment.attributes.url);
            if ( attachment.attributes.type == 'image' ) {
                selector.find('.screenshot').empty().hide().append('<img class="of-option-image" src="' + attachment.attributes.url + '">').slideDown('fast');
            }
            selector.find('.media_upload_button').unbind();
            selector.find('.remove-image').show().removeClass('hide');//show "Remove" button
            selector.find('.of-background-properties').slideDown();
            optionsframework_file_bindings();
        });

        // Finally, open the modal.
        frame.open();
    }

    function optionsframework_remove_file(selector) {
        selector.find('.remove-image').hide().addClass('hide');//hide "Remove" button
        selector.find('.upload').val('');
        selector.find('.of-background-properties').hide();
        selector.find('.screenshot').slideUp();
        selector.find('.remove-file').unbind();
        // We don't display the upload button if .upload-notice is present
        // This means the user doesn't have the WordPress 3.5 Media Library Support
        if ( $('.section-upload .upload-notice').length > 0 ) {
            $('.media_upload_button').remove();
        }
        optionsframework_file_bindings();
    }

    function optionsframework_file_bindings() {
        $('.remove-image, .remove-file').on('click', function() {
            optionsframework_remove_file( $(this).parents('.section-upload, .section-media, .slide_body') );
        });

        $('.media_upload_button').unbind('click').click( function( event ) {
            optionsframework_add_file(event, $(this).parents('.section-upload, .section-media, .slide_body'));
        });
    }

    optionsframework_file_bindings();

}); //end doc ready