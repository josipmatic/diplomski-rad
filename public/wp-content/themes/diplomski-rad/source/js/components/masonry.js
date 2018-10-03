const $grid = $( '.js-masonry' );

if ( $grid.length ) {
	const sizes = [
		{ columns: 1, gutter: 30 },
		{ mq: '576px', columns: 1, gutter: 30 },
		{ mq: '768px', columns: 1, gutter: 30 },
		{ mq: '992px', columns: 2, gutter: 30 },
		{ mq: '1230px', columns: 2, gutter: 30 },
	];

	// create an instance
	const instance = window.Bricks( {
		container: $grid[ 0 ],
		packed: 'data-packed', // if not prefixed with 'data-', it will be added
		sizes: sizes
	} );

	const createDebouncedFn = function( fn, time ) {
		let timeoutID;
		const later = function() {
			fn.call();
			timeoutID = undefined;
		};

		return function() {
			if ( timeoutID ) {
				clearTimeout( timeoutID );
			}

			timeoutID = setTimeout( later, time );
		};
	};

	instance.resize( true );
	instance.pack();

	const packDebounced = createDebouncedFn( instance.pack, 200 );

	$( window ).on( 'load', packDebounced );
}
