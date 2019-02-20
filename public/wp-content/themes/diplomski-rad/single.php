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
				<div class="u-mt-4">
					<?php the_content(); ?>
				</div>
				<?php
				$source_code = get_field( 'source_code' );

				if ( ! empty( $source_code ) ) :
				?>
				<div class="c-download-code">
					<a class="c-download-code__icon" href="<?php echo esc_url( $source_code ); ?>"><?php echo file_get_contents( trailingslashit( get_stylesheet_directory() ) . "assets/images/icons/code.svg" ); // WPCS: xss ok. ?></a>
					<a class="c-download-code__text" href="<?php echo esc_url( $source_code ); ?>">Download source code</a>
				</div>
				<?php endif; ?>
				</div><!-- /.o-col -->
			</div><!-- /.o-row -->
		</div><!-- /.o-container -->
	</section>
	<?php
endif;
get_footer();
