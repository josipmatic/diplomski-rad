<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package WordPress
 * @subpackage Bojler_Site
 * @since 1.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bojlersite_body_classes( $classes ) {
	// Add class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class if we're viewing the Customizer for easier styling of theme options.
	if ( is_customize_preview() ) {
		$classes[] = 'bojlersite-customizer';
	}

	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'bojlersite-front-page';
	}

	// Add a class if there is a custom header.
	if ( has_header_image() ) {
		$classes[] = 'has-header-image';
	}

	// Add class if sidebar is used.
	if ( is_active_sidebar( 'sidebar-1' ) && ! is_page() ) {
		$classes[] = 'has-sidebar';
	}

	// Add class for one or two column page layouts.
	if ( is_page() || is_archive() ) {
		if ( 'one-column' === get_theme_mod( 'page_layout' ) ) {
			$classes[] = 'page-one-column';
		} else {
			$classes[] = 'page-two-column';
		}
	}

	// Add class if the site title and tagline is hidden.
	if ( 'blank' === get_header_textcolor() ) {
		$classes[] = 'title-tagline-hidden';
	}

	// Get the colorscheme or the default if there isn't one.
	$colors = bojlersite_sanitize_colorscheme( get_theme_mod( 'colorscheme', 'light' ) );
	$classes[] = 'colors-' . $colors;

	return $classes;
}
add_filter( 'body_class', 'bojlersite_body_classes' );

/**
 * Count our number of active panels.
 *
 * Primarily used to see if we have any panels active, duh.
 */
function bojlersite_panel_count() {

	$panel_count = 0;

	/**
	 * Filter number of front page sections in Bojler Site.
	 *
	 * @since Bojler Site 1.0
	 *
	 * @param int $num_sections Number of front page sections.
	 */
	$num_sections = apply_filters( 'bojlersite_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		if ( get_theme_mod( 'panel_' . $i ) ) {
			$panel_count++;
		}
	}

	return $panel_count;
}

/**
 * Checks to see if we're on the homepage or not.
 */
function bojlersite_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Returns nav menu.
 *
 * @param boolean $mobile             Is nav mobile.
 * @param boolean $homepage           Is nav homepage.
 * @param boolean $is_single_template Is nav template single page.
 *
 * @return string|false|void
 */
function bojlersite_get_nav_menu( $mobile = false, $homepage = false, $is_single_template = false ) {
	$menu = '';

	if ( true === $mobile ) {
		$menu = wp_nav_menu( array(
			'theme_location' => 'bojlersite__menu-navbar',
			'menu_id'        => 'primary-menu',
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

	if ( true === $homepage ) {
		$menu = wp_nav_menu( array(
			'theme_location' => 'bojlersite__menu-navbar',
			'menu_id'        => 'primary-menu',
			'menu_class'     => 'c-nav u-hidden u-inline-block@md',
			'link_before'    => '',
			'link_after'     => '',
			'container'      => false,
			'fallback_cb'    => false,
			'echo'           => false,
			'item_spacing'   => 'discard',
		) );

		return $menu;
	}

	if ( true === $is_single_template ) {
		$menu = wp_nav_menu( array(
			'theme_location' => 'bojlersite__menu-navbar',
			'menu_id'        => 'primary-menu',
			'menu_class'     => 'c-nav c-nav--white u-mb-0 u-ml-auto u-hidden u-block@lg',
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
		'theme_location' => 'bojlersite__menu-navbar',
		'menu_id'        => 'primary-menu',
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

/**
 * Modify menu li element classes.
 *
 * @param array $classes Classes.
 */
function bojlersite_menu_classes( $classes ) {
	if (
		in_array( 'menu-item-object-documentation', $classes, true ) &&
		is_singular( 'documentation' )
	) {
		$classes[] = 'current-menu-item';
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'bojlersite_menu_classes', 1, 1 );

/**
 * Filter the content output.
 *
 * @param string $content Content.
 */
function bojlersite_filter_the_content( $content ) {
	if ( ! empty( $content ) ) {
		$new_content = preg_replace(
			'/<table(.*?)>(.*?)<\/table>/s',
			'<div class="o-responsive-table"><table$1>$2</table></div>',
			$content
		);

		if ( ! empty( $new_content ) ) {
			$content = $new_content;
		}
	}

	return $content;
}
add_filter( 'the_content', 'bojlersite_filter_the_content' );
add_filter( 'acf_the_content', 'bojlersite_filter_the_content' );
