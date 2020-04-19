(function() {

    function ishAddSingle (object, editor, e, a, atribs, icon) {

        var atts = '';
        var icn = '';

        for (var key in atribs) {
            atts += ' '+ key + '="'+ atribs[key] + '"';
        }

        if (icon ) {
            icn = 'ish-' + icon;
        }

        // Prepare the JSON Object item
        var item = {};
        item['text'] = e;
        item['icon'] = icn;
        item['onclick'] = function () {
            editor.insertContent('['+ a + atts + ']');
        }

        // Add the item to the JSON object
        object.push(item);
    }

    function ishAddPair (object, editor, e, a, atribs, message, cbefore, cafter, icon ) {

        var atts = '';
        var cb = '';
        var ca = '';
        var msg = 'Enter your content here.'
        var icn = '';

        if (cbefore){
            cb = cbefore;
        }
        if (cafter){
            ca = cafter;
        }
        if (message){
            msg = message;
        }

        for (var key in atribs) {
            atts += ' '+ key + '="'+ atribs[key] + '"';
        }

        if (icon ) {
            icn = 'ish-' + icon;
        }

        // Prepare the JSON Object item
        var item = {};
        item['text'] = e;
        item['icon'] = icn;
        item['onclick'] = function () {
            if ( editor.selection.getContent() != '' ){
                editor.insertContent('['+ a + atts + ']'+ editor.selection.getContent() + '[/'+ a + ']');
                //tinyMCE.activeEditor.execCommand("mceInsertContent", false, '['+ a + atts + ']'+ tinyMCE.activeEditor.selection.getContent() + '[/'+ a + ']');
            }
            else{
                editor.insertContent('['+ a + atts + ']'+ cb + msg + ca + '[/'+ a + ']');
                //tinyMCE.activeEditor.execCommand("mceInsertContent", false, '['+ a + atts + ']'+ cb + msg + ca + '[/'+ a + ']') ;
            }
        }

        // Add the item to the JSON object
        object.push(item);
    }

    function ishAddBlockPair (object, editor, e, a, atribs, message, cbefore, cafter, icon ) {

        var atts = '';
        var cb = '';
        var ca = '';
        var msg = 'Enter your content here.'
        var icn = '';

        if (cbefore){
            cb = cbefore;
        }
        if (cafter){
            ca = cafter;
        }
        if (message){
            msg = message;
        }

        for (var key in atribs) {
            atts += ' '+ key + '="'+ atribs[key] + '"';
        }

        if (icon) {
            icn = 'ish-' + icon;
        }

        // Prepare the JSON Object item
        var item = {};
        item['text'] = e;
        item['icon'] = icn;
        item['onclick'] = function () {
            if ( editor.selection.getContent() != '' ){
                editor.insertContent('<p>['+ a + atts + ']</p>'+ editor.selection.getContent() + '<p>[/'+ a + ']</p>');
            }
            else{
                editor.insertContent('<p>['+ a + atts + ']</p>'+ cb + msg + ca + '<p>[/'+ a + ']</p>');
            }
        }

        // Add the item to the JSON object
        object.push(item);
    }

    function ishAddFree(object, editor, e, content , icon ) {

        var icn = '';

        if (icon) {
            icn = 'ish-' + icon;
        }

        // Prepare the JSON Object item
        var item = {};
        item['text'] = e;
        item['icon'] = icn;
        item['onclick'] = function () {
            if ( editor.selection.getContent() != '' ){
                editor.insertContent( content );
            }
            else{
                editor.insertContent( content );
            }
        }

        // Add the item to the JSON object
        object.push(item);
    }

    function ishAddPairHTML (object, editor, e, a, atribs, message, cbefore, cafter, icon ) {

        var atts = '';
        var cb = '';
        var ca = '';
        var msg = 'Enter your content here.'
        var icn = '';

        if (cbefore){
            cb = cbefore;
        }
        if (cafter){
            ca = cafter;
        }
        if (message){
            msg = message;
        }

        for (var key in atribs) {
            atts += ' '+ key + '="'+ atribs[key] + '"';
        }

        if (icon ) {
            icn = 'ish-' + icon;
        }

        // Prepare the JSON Object item
        var item = {};
        item['text'] = e;
        item['icon'] = icn;
        item['onclick'] = function () {
            if ( editor.selection.getContent() != '' ){
                editor.insertContent('<'+ a + atts + '>'+ editor.selection.getContent() + '</'+ a + '>');
            }
            else{
                editor.insertContent('<'+ a + atts + '>'+ cb + msg + ca + '</'+ a + '>');
            }
        }

        // Add the item to the JSON object
        object.push(item);
    }

    function ishAddSubmenu(object, editor, title, icon, itemsObject ) {
        var icn = '';

        if (icon ) {
            icn = 'ish-' + icon;
        }

        // Prepare the JSON Object item
        var item = {};
        item['text'] = title;
        item['icon'] = icn;
        item['menu'] = itemsObject;

        // Add the item to the JSON object
        object.push(item);
    }

    function ishAddSeparator(object) {

        // Prepare the JSON Object item
        var item = {};
        item['text'] = '-';

        // Add the item to the JSON object
        object.push(item);
    }


    tinymce.PluginManager.add( 'ishyoboy_text_highlight', function( editor, url ) {

        var ish_sc_content = '';
        var buttonMenu = [];

        /*
         * 5: THEME COLORS
         */
        buttonMenu = [];

        // Theme colors  *************************************************************************************
        ish_sc_content = '';
        for ( var key in ishfreelotheme_globals.ISHFREELOTHEME_COLORS ) {
            ish_sc_content = key;
            //ishAddFree(buttonMenu, editor, key , ish_sc_content, 'color_' + key );
            ishAddPairHTML(buttonMenu, editor, key, 'span', {'class': 'ish-highlight ish-text-'+ key}, 'Color Highlight', '', '', 'color_' + key );
        }

        // BUTTON 5
        editor.addButton( 'ishyoboy_color_palette' , {
            title: 'Theme Colors',
            tooltip: 'Theme Colors',
            icon: 'ishyoboy_color_palette',
            type: 'menubutton',
            menu: buttonMenu
        });







    });

})();