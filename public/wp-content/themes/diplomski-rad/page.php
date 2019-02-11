<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package diplomski-rad
 */

get_header();
?>
<div class="o-container u-mt-4">
	<div class="o-row">
		<div class="o-col">
		<?php
		while ( have_posts() ) :
			the_post();

			the_content();

		endwhile; // End of the loop.
		?>
		</div><!-- /.o-col -->
	</div><!-- /.o-row -->
</div><!-- /.o-container -->
<?php
get_footer();
