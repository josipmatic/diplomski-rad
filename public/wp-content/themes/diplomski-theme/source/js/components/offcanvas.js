( function( $ ) {
	$( '.js-offcanvas-toggle' ).on( 'click', function() {
		$( '.c-offcanvas' ).toggleClass( 'is-active' );
		$( '.js-logo' ).toggleClass( 'u-text-gray-300' );
	} );
}( jQuery ) );
