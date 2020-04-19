function createUpdaterCookie( name, value, days ) {
	var expires;

	if ( days ) {
		var date = new Date();
		date.setTime( date.getTime() + ( days * 24 * 60 * 60 * 1000 ) );
		expires = "; expires=" + date.toGMTString();
	} else {
		expires = "";
	}
	document.cookie = encodeURIComponent( name ) + "=" + encodeURIComponent( value ) + expires + "; path=/";
}

jQuery( window ).on( "load", function() {
	jQuery( '#license-nag .notice-dismiss' ).click( function( e ) {
		createUpdaterCookie( theme.slug + '-license-nag-dismissed', theme.version , 7 );
	});

	jQuery( '.ish-updater-confirm-link' ).click( function( e ) {

		if ( confirm( theme.update_notice ) ) {
			return true;
		}

		return false;
	});
});
