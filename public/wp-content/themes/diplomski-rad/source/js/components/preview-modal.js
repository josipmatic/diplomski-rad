const $jsPreviewModal = $( '.js-preview-modal' );

if ( $jsPreviewModal.length ) {
	$( '.js-preview-modal' ).magnificPopup( {
		type: 'inline',
		closeMarkup:
			'<button title="%title%" type="button" class="mfp-close c-preview-modal__close">' +
			'</button>',
		removalDelay: 200,
		mainClass: 'mfp-fade',
	} );

	$( document ).on( 'click', '.popup-modal-dismiss', function( e ) {
		e.preventDefault();
		$.magnificPopup.close();
	} );
}
