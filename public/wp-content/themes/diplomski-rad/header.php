<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package diplomski-rad
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<div class="c-offcanvas">
		<div class="c-offcanvas__inner">
			<?php
			$menu = diplomski_get_nav_menu( true );

			if ( ! empty( $menu ) ) {
				echo $menu; // WPCS: xss ok.
			}
			?>
		</div><!-- /.c-offcanvas__inner -->
	</div><!-- /.c-offcanvas -->

	<?php
	$classes          = array( 'c-header' );
	$button_classes   = array( 'c-hamburger-icon', 'c-hamburger-icon--slider', 'js-hamburger-icon', 'js-offcanvas-toggle', 'u-ml-auto', 'u-hidden@lg' );
	$download_classes = array( 'c-btn c-btn--md c-btn--gray u-text-md' );
	?>
	<header class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div class="o-container">
			<div class="o-row">
				<div class="o-col-12">
					<div class="u-flex u-items-center">
						<h1 class="c-logo u-mb-0 js-logo">
							<a href="<?php echo esc_url( home_url() ); ?>" class="c-logo__link">ViSP Examples</a>
						</h1><!-- /.c-logo -->
						<?php
						$menu = '';

						$menu = diplomski_get_nav_menu();

						if ( ! empty( $menu ) ) {
							echo $menu; // WPCS: xss ok.
						}
						?>
						<button class="<?php echo esc_attr( implode( ' ', $button_classes ) ); ?>" type="button">
							<span class="c-hamburger-icon__box">
								<span class="c-hamburger-icon__inner"></span>
							</span><!-- /.c-hamburger-icon__box -->
						</button><!-- /.c-hamburger-icon -->
					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.o-container -->
	</header><!-- /.c-header -->

	<div id="content" class="site-content">
