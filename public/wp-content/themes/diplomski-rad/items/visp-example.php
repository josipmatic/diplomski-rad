<?php
/**
 * Visp Example Archive Template.
 *
 * @package Diplomski_Rad
 */

global $post;

if ( ! empty( $post ) && ! is_wp_error( $post ) ) :

	$thumbnail_url = get_the_post_thumbnail_url( $post, 'full' );
?>
<div class="c-visp-items">
	<a class="c-visp-item" href="<?php echo esc_url( get_permalink() ); ?>">
			<?php
			if ( ! empty( $thumbnail_url ) ) :
			?>
				<img class="c-visp-item__image" src="<?php echo esc_url( $thumbnail_url ); ?>" />
			<?php endif; ?>
		<div class="c-visp-item__details js-show-on-hover">
			<?php the_title( '<h2 class="c-visp-item__title">', '</h2>' ); ?>
			<div class="c-visp-item__description">
				<?php the_excerpt(); ?>
			</div><!-- /.c-visp-item__description -->
		</div>
	</a><!-- /.c-visp-item -->
</div><!-- /.c-visp-items -->
<?php
endif;
