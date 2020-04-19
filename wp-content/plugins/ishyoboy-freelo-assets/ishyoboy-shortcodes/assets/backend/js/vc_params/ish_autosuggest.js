/**
 * Created by VlooMan on 12.11.2013.
 */

jQuery('.ish_autosuggest_container').each( function(){
    var me = jQuery(this);
    var input_real = me.find('input.ish-real-field');
    var input_visible = me.find('input.ish-visible-field');
    var data_source = window[ input_visible.attr('data-source') ];
    var data_source_sorted = data_source.slice();
    var searching;

    // Sort array from longest to shortest for further replacement
    data_source_sorted.sort( compare_lengths );

    // Used not to replace last set category with new one
    searching = false;

    /*var data_source =[
        { label:'Category A', value:'a' },
        { label:'Category B', value:'b' },
        ...
    ];*/

    function split( val ) {
        return val.split( /,\s*/ );
    }
    function extractLast( term ) {
        return split( term ).pop();
    }

    function compare_lengths(a,b) {
        if (a.label.length < b.label.length)
            return 1;
        if (a.label.length > b.label.length)
            return -1;
        return 0;
    }




    input_visible
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            searching = true
            if ( event.keyCode === jQuery.ui.keyCode.TAB &&
                jQuery( this ).data( "ui-autocomplete" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 0,
            source: function( request, response ) {
                // delegate back to autocomplete, but extract the last term
                response( jQuery.ui.autocomplete.filter(
                    data_source, extractLast( request.term ) ) );
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {

                var terms = split( this.value );

                // remove the current input
                if ( searching ){
                    terms.pop();
                }
                else if ( terms[ terms.length - 1 ] == '' ){
                    terms.pop();
                }

                // add the selected item
                terms.push( '"' + ui.item.label + '"' );

                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                this.value = terms.join( ", " );

                searching = false;

                return false;
            },
            change : function() {

                var terms_string = input_visible.val();

                var valid_keys = Array();

                // Loop trough the sorted list of available categories and replace the labels inside the visible string with keys
                for ( var key in data_source_sorted) {
	                var label = String(data_source_sorted[key].label);
	                label = label.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
                    var regexp = new RegExp( label, "g" );
                    terms_string = terms_string.replace( regexp, data_source_sorted[key].value );
                    valid_keys[ data_source_sorted[key].value ] = true;
                }

                // Split the string values into an array
                var terms = terms_string.split(',');

                // Prepare the final string (joining the values) for the real input
                var final_string = '';
                for (var i in terms) {
                    var term = terms[i].trim();
                    if ( '"' == term[0]) { term = term.slice(1, -1); }
                    if ( '' != term  && true === valid_keys[term]){
                        final_string += term + ", ";
                    }
                }

                // Remove the last comma
                final_string = final_string.slice(0, -2);

                // Set the id's into the real field.
                input_real.val( final_string );
                return false;
            }
        })
        .focus( function(){
            jQuery(this).autocomplete('search', '');
        });
});