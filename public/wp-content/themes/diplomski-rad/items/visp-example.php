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
<a class="c-visp-item" href="<?php echo esc_url( get_permalink() ); ?>">
		<?php
		if ( ! empty( $thumbnail_url ) ) :
		?>
		<div class="c-visp-item__image">
			<img src="<?php echo esc_url( $thumbnail_url ); ?>" />
		</div><!-- /.c-visp-item__image -->
		<?php endif; ?>
	<div class="c-visp-item__details">
		<?php the_title( '<h2 class="c-visp-item__title">', '</h2>' ); ?>
		<div class="c-visp-item__description">
			<?php the_excerpt(); ?>
		</div><!-- /.c-visp-item__description -->
	</div>
</a><!-- /.c-visp-item -->
<?php
endif;
