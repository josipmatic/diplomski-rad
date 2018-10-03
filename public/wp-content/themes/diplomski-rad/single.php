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
?>
	<section class="u-pt-16 u-pb-16">
		<div class="o-container">
			<div class="o-row">
				<div class="o-col-12">
					<?php the_title( '<h2 class="u-font-normal u-font-bold">', '</h2>', true ); ?>
				</div><!-- /.o-col -->
			</div><!-- /.o-row -->
		</div><!-- /.o-container -->
	</section>
<?php
endif;
get_footer();
