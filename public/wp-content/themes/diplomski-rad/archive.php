<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Diplomski_Rad
 */

get_header();
	if ( have_posts() ) :
		?>
		<section class="u-pt-16 u-pb-16">
			<div class="o-container">
				<div class="o-row">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'items/visp-example' );

				endwhile;
				?>
				</div><!-- /.o-row -->
			</div><!-- /.o-container -->
		</section>
		<?php
	endif;
get_footer();
