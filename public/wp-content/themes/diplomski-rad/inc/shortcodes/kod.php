<?php
/**
 * Kod shortcode.
 *
 * @package Diplomski_Rad
 */

/**
 * Kod shortcode function
 *
 * @param  array  $atts Shortcode attributes.
 * @param  string $content Shortcode content.
 * @return string
 */
function diplomski_kod_shortcode( $atts = null, $content = null ) {
	if ( null === $content ) {
		return;
	}

	ob_start();

	?>
	<div class="c-kod">
		<pre>
			<code>
				<?php echo $content; // WPCS: xss ok. ?>
			</code>
		</pre>
	</div><!-- /.c-kod -->
	<?php

	return ob_get_clean();
}
add_shortcode( 'kod', 'diplomski_kod_shortcode' );
