<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package diplomski-rad
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function diplomski_rad_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'diplomski_rad_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function diplomski_rad_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'diplomski_rad_pingback_header' );

/**
 * Returns nav menu.
 *
 * @param boolean $mobile             Is nav mobile.
 * @param boolean $homepage           Is nav homepage.
 * @param boolean $is_single_template Is nav template single page.
 *
 * @return string|false|void
 */
function diplomski_get_nav_menu( $mobile = false ) {
	$menu = '';

	if ( true === $mobile ) {
		$menu = wp_nav_menu( array(
			'theme_location' => 'diplomski__menu-navbar',
			'menu'           => 'primary-menu',
			'menu_class'     => 'c-nav c-nav--stacked u-mx-auto',
			'link_before'    => '',
			'link_after'     => '',
			'container'      => false,
			'fallback_cb'    => false,
			'echo'           => false,
			'item_spacing'   => 'discard',
		) );

		return $menu;
	}

	$menu = wp_nav_menu( array(
		'theme_location' => 'diplomski__menu-navbar',
		'menu'           => 'primary-menu',
		'menu_class'     => 'c-nav u-mb-0 u-ml-auto u-hidden u-block@lg',
		'link_before'    => '',
		'link_after'     => '',
		'container'      => false,
		'fallback_cb'    => false,
		'echo'           => false,
		'item_spacing'   => 'discard',
	) );

	return $menu;
}
