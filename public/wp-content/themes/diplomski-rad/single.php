<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package diplomski-rad
 */

get_header();

if ( have_posts() ) :
	the_post();

	$embeded_video_url = get_field( 'video' );

	$video_id  = null;
	$url_query = wp_parse_url( $embeded_video_url, PHP_URL_QUERY );

	if ( ! empty( $url_query ) ) {
		parse_str( $url_query, $url_query_params );

		if ( ! empty( $url_query_params ) && ! empty( $url_query_params['v'] ) ) {
			$video_id = $url_query_params['v'];
		}
	}
	?>
	<section class="u-pt-16 u-pb-16">
		<div class="o-container">
			<div class="o-row">
				<div class="o-col-12">
				<?php the_title( '<h2>', '</h2>', true ); ?>
				<?php if ( ! empty( $video_id ) ) : ?>
					<div class="c-video">
						<iframe width="100%" height="100%" src="<?php echo esc_url( 'https://www.youtube-nocookie.com/embed/' . $video_id . '?rel=0&amp;showinfo=0' ); ?>" frameborder="0" allowfullscreen class="u-mb-2"></iframe>
					</div><!-- /.c-video -->
				<?php endif; ?>
				</div><!-- /.o-col -->
			</div><!-- /.o-row -->
		</div><!-- /.o-container -->
	</section>
	<?php
endif;
get_footer();
