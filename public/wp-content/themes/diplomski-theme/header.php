<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Bojler_Site
 * @since 1.0
 * @version 1.0
 */

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<?php
$body_classes = array( 'customize-support' );

if ( is_user_logged_in() ) {
	$body_classes[] = 'has-adminbar';
}
?>
<body class="<?php echo esc_attr( implode( ' ', $body_classes ) ); ?>">
	<div class="c-offcanvas">
		<div class="c-offcanvas__inner">
			<?php
			$menu = bojlersite_get_nav_menu( true );

			if ( ! empty( $menu ) ) {
				echo $menu; // WPCS: xss ok.
			}
			?>
			<a href="<?php echo esc_url( get_field( 'bojler_source_files', 'option' ) ); ?>" class="c-btn c-btn--md c-btn--gray u-text-md"><?php echo esc_html( 'Download' ); ?></a>
		</div><!-- /.c-offcanvas__inner -->
	</div><!-- /.c-offcanvas -->
	<?php
	$classes          = array( 'c-header' );
	$button_classes   = array( 'c-hamburger-icon', 'c-hamburger-icon--slider', 'js-hamburger-icon', 'js-offcanvas-toggle', 'u-ml-auto', 'u-hidden@lg' );
	$download_classes = array( 'c-btn c-btn--md c-btn--gray u-text-md' );

	if ( is_singular( 'bojler_template' ) ) {
		$classes[]          = 'u-text-white';
		$button_classes[]   = 'c-hamburger-icon--white';
		$download_classes[] = 'c-btn--invert';
	}

	if ( is_front_page() ) {
		$classes[]        = 'u-text-white';
		$button_classes[] = 'c-hamburger-icon--white';
		$download_classes = array( 'c-btn c-btn--md c-btn--white-blue u-text-md' );
	}
	?>
	<header class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div class="o-container">
			<div class="o-row">
				<div class="o-col-12">
					<div class="u-flex u-items-center">
						<h1 class="c-logo u-mb-0 js-logo">
							<a href="<?php echo esc_url( home_url() ); ?>" class="c-logo__link">Bojler</a>
						</h1><!-- /.c-logo -->
						<?php
						$menu = '';

						if ( is_singular( 'bojler_template' ) ) {
							$menu = bojlersite_get_nav_menu( false, false, true );
						} else {
							$menu = bojlersite_get_nav_menu();
						}

						if ( ! empty( $menu ) ) {
							echo $menu; // WPCS: xss ok.
						}
						?>
						<div class="u-ml-5 u-hidden u-block@lg">
							<a href="<?php echo esc_url( get_field( 'get_started_button_link', 'option' ) ); ?>" class="<?php echo esc_attr( implode( ' ', $download_classes ) ); ?>"><?php echo esc_html( 'Get Started' ); ?></a>
						</div>
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
