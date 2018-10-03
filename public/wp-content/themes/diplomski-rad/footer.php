<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Bojler_Site
 * @since 1.0
 * @version 1.2
 */

$classes = array( 'u-text-gray-100', 'u-text-sm' );
?>
		<footer class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<div class="o-container">
				<div class="o-row">
					<div class="o-col-12 u-mt-6 u-mt-8@md u-mb-4 u-mb-6@md">
						<p>Open source visual servoing platform library.</p>
					</div><!-- /.o-col -->
				</div><!-- /.o-row -->
			</div><!-- /.o-container -->
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
