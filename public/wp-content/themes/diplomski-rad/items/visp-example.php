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
<div class="o-col-4">
	<a href="<?php echo esc_url( get_permalink() ); ?>">
		<h2 class="u-font-normal u-font-bold"><?php echo esc_html( get_the_title() ); ?></h2>
		<?php
		if ( ! empty( $thumbnail_url ) ) :
		?>
			<img src="<?php echo esc_url( $thumbnail_url ); ?>" />
		<?php endif; ?>
		<div class="u-mt-1">
			<?php the_excerpt(); ?>
		</div>
		<a href="<?php echo esc_url( get_permalink() ); ?>" class="c-btn c-btn--blue c-btn--lg u-h6 u-mr-1 u-mb-2"><?php echo esc_html( 'Go To Example' ); ?></a>
	</a>
</div><!-- /.o-col -->
<?php
endif;
