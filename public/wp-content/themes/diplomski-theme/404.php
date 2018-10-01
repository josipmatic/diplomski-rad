<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Bojler_Site
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<section class="u-bg-gray-30 u-pt-17 u-pb-13">
	<div class="o-container">
		<div class="o-row">
			<div class="o-col-12">
				<h1 class="u-mb-1"><?php _e( 'Oops! That page can&rsquo;t be found.', 'bojlersite' ); ?></h1>
				<div class="u-text-md">
					<p><?php _e( 'It looks like nothing was found at this location.', 'bojlersite' ); ?></p>
				</div>
			</div><!-- /.o-col -->
		</div><!-- /.o-row -->
	</div><!-- /.o-container -->
</section>

<?php get_footer();
