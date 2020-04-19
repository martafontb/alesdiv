/**
 * Created by VlooMan on 7.11.2013.
 */

jQuery('.ish_color_selector_container').each( function(){
    var me = jQuery(this);
    var input = me.find('input');
	var color_preview = me.find('.ish-cs-color-preview');
	var open_btn = me.find('.ish-cs-opener');
	var the_popup = me.find('.ish_cs_popup');
	var timer;

	// Pop-Up open/close
	me.find('.ish-cs-color-preview, .ish-cs-opener').click(function(e){
		e.preventDefault();
		if ( the_popup.is(":visible") ){
			the_popup.fadeOut(300);
		} else{
			the_popup.fadeIn(300, function(){
				jQuery(this).focus();
			});
		}
	});

	var mouse_inside = false;

	// PopUp disappear
	the_popup.mouseleave( function(){
		timer = setTimeout(function() {
			the_popup.fadeOut(300)
		}, 200);
		mouse_inside = false;
	});
	the_popup.mouseenter( function(){
		clearTimeout(timer);
		mouse_inside = true;
	});

	the_popup.on('blur',function(){
		if ( !mouse_inside ) {
			jQuery(this).fadeOut(300);
		}
	});

    me.find('.ish_cs_popup .ish_btnlist_item').click(function(e){
        e.preventDefault();
        var item = jQuery(this);
        input.val( item.attr('data-ish-value') );
        input.trigger('change');
        /*me.find('li').removeClass('active');
        item.parent().addClass('active');*/

	    // Set the color to color preview
	    color_preview.attr('data-ish-value', item.attr('data-ish-value') );
	    color_preview.attr('title', item.attr('title') );
	    color_preview.text( item.text() );

	    // Set Classes correctly
	    if ( item.hasClass('ish-icon-noneselected') ){
		    color_preview.attr('class', 'ish-cs-color-preview ish_color_selector_item ish_btnlist_item ish-icon-noneselected');
	    }
	    else{
		    color_preview.attr('class', 'ish-cs-color-preview ish_color_selector_item ish_btnlist_item');
	    }

	    the_popup.fadeOut(300);

    });

});