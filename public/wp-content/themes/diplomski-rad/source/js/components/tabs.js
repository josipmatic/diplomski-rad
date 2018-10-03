( function( $ ) {
	$( '.js-tabs-group > .c-tabs__content-item' ).hide();
	$( '.js-tabs-group > .c-tabs__content-item:first-of-type' ).show();
	$( '.js-tabs-nav .c-tabs__nav-link' ).click( function( event ) {
		event.preventDefault();
		var $this = $( this ),
				tabsGroup = '#' + $this.parents( '.js-tabs-nav' ).data( 'tabgroup' ),
				others = $this.closest( 'li' ).siblings().children( '.c-tabs__nav-link' ),
				target = $this.attr( 'href' );
		others.removeClass( 'is-active' );
		$this.addClass( 'is-active' );
		$( tabsGroup ).children( 'div' ).hide();
		$( target ).show();
	} );
}( jQuery ) );
