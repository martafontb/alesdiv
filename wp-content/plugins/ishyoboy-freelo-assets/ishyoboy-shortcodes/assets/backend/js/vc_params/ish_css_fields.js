/**
 * Created by VlooMan on 12.11.2013.
 */

jQuery('.ish_css_fields_container').each( function(){
	var me = jQuery(this);
	var input = me.find('.wpb_vc_param_value');
	var fields = me.find('.ish_css_fields_inner input');

	fields.change(function(e){
		final_value = '';

		fields.each( function() {
			final_value += String(jQuery(this).val()) + '#';
		});

		final_value = final_value.substring(0, final_value.length - 1);

		input.val( final_value );
	});

});