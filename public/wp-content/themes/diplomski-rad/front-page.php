<?php
/**
 * Front page.
 *
 * @package Diplomski_Rad
 */

get_header();
?>
<section class="u-bg-blue u-text-white u-pt-16 u-pb-16">
	<div class="o-container">
		<div class="o-row">
			<div class="o-col-10@lg o-col-8@xl o-offset-1@lg">
				<h2 class="u-text-xxl u-font-normal u-font-bold"><?php echo esc_html( 'ViSP Primjeri' ); ?></h2>
				<div class="u-h5 u-mb-3">
					Primjeri za učenje.
				</div>
				<a href="#" class="c-btn c-btn--white-blue c-btn--lg u-h6 u-mr-1 u-mb-2"><?php echo esc_html( 'Započni' ); ?></a>
			</div><!-- /.o-col -->
		</div><!-- /.o-row -->
	</div><!-- /.o-container -->
</section>
<?php
$args = array(
	'post_type'      => 'visp-example',
	'post_status'    => 'publish',
	'posts_per_page' => 9,
);

$examples = new WP_Query( $args );

if ( $examples->have_posts() ) :
?>
<section class="u-pt-16 u-pb-16">
	<div class="o-container">
		<div class="o-row">
		<?php while ( $examples->have_posts() ) : ?>
			<?php
			$examples->the_post();

			?>
			<div class="o-col-4">
				<h2 class="u-font-normal u-font-bold"><?php echo esc_html( get_the_title() ); ?></h2>
			</div><!-- /.o-col -->
		<?php endwhile; ?>
		</div><!-- /.o-row -->
	</div><!-- /.o-container -->
</section>
<?php endif; ?>
<?php
get_footer();
