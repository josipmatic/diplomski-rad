<?php
/**
 * Video shortcode.
 *
 * @package Diplomski_Rad
 */

/**
 * Video shortcode function
 *
 * @param  array  $atts Shortcode attributes.
 * @param  string $content Shortcode content.
 * @return string
 */
function diplomski_video_shortcode( $atts = null, $content = null ) {
	$atts = shortcode_atts(
		array(
			'source' => '',
		),
		$atts
	);

	ob_start();

	if ( ! empty( $atts['source'] ) ) :
	?>
	<?php
	$video_id  = null;
	$url_query = wp_parse_url( $atts['source'], PHP_URL_QUERY );

	if ( ! empty( $url_query ) ) {
		parse_str( $url_query, $url_query_params );

		if ( ! empty( $url_query_params ) && ! empty( $url_query_params['v'] ) ) {
			$video_id = $url_query_params['v'];
		}
	}

		if ( ! empty( $video_id ) ) :
		?>
		<div class="c-video--small">
			<iframe width="100%" height="100%" src="<?php echo esc_url( 'https://www.youtube-nocookie.com/embed/' . $video_id . '?rel=0&amp;showinfo=0' ); ?>" frameborder="0" allowfullscreen class="u-mb-2"></iframe>
		</div><!-- /.c-video--small -->
		<?php
		endif;
	endif;

	return ob_get_clean();
}
add_shortcode( 'video', 'diplomski_video_shortcode' );
