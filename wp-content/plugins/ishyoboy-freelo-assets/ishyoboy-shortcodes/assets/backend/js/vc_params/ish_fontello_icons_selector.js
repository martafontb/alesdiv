/**
 * Created by VlooMan on 12.11.2013.
 */

jQuery('.ish_fontello_icons_selector_container').each( function(){
    var me = jQuery(this);
    var input = me.find('input');

    me.find('.ish_btnlist_item').click(function(e){
        e.preventDefault();
        var icon = jQuery(this);
        input.val( icon.attr('data-ish-value') );
        input.trigger('change');
        me.find('li').removeClass('active');
        icon.parent().addClass('active');
    });

	me.click( function(){
		if ( ! me.hasClass('ish-opened') ) {
			jQuery(this).addClass('ish-opened');
			clearTimeout(jQuery(this).data('timeout'));
		}
	});


	me.hover(function() {
		var me = jQuery(this);

		if ( ! me.hasClass('ish-opened') ){
			var t = setTimeout(function() {
				me.addClass('ish-opened');
			}, 600);
			jQuery(this).data('timeout', t);
		}

	}, function() {
		var me = jQuery(this);
		clearTimeout(me.data('timeout'));
	});

});