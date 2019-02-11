<?php
/**
 * Front page.
 *
 * @package Diplomski_Rad
 */

get_header();

$args = array(
	'post_type'      => 'visp-example',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
);

$examples = new WP_Query( $args );

if ( $examples->have_posts() ) :
?>
<section class="u-pt-16 u-pb-16">
	<div class="c-visp-items">
	<?php
	while ( $examples->have_posts() ) :
		$examples->the_post();

		get_template_part( 'items/visp-example' );
	endwhile;
	?>
	</div><!-- /.c-visp-items -->
</section>
<?php endif; ?>
<?php
get_footer();
