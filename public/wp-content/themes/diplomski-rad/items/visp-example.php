<?php
/**
 * Visp Example Archive Template.
 *
 * @package Diplomski_Rad
 */

global $post;

if ( ! empty( $post ) && ! is_wp_error( $post ) ) :
?>
<div class="o-col-4">
	<h2 class="u-font-normal u-font-bold"><?php echo esc_html( get_the_title() ); ?></h2>
	<a href="<?php echo esc_url( get_permalink() ); ?>" class="c-btn c-btn--blue c-btn--lg u-h6 u-mr-1 u-mb-2"><?php echo esc_html( 'Go To Example' ); ?></a>
</div><!-- /.o-col -->
<?php
endif;
