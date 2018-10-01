<?php
/**
 * Bojler Site functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Bojler_Site
 * @since 1.0
 */

/**
 * Returns true if we should load webpack.
 *
 * @return boolean
 */
function bojlersite_should_load_webpack() {
	return ( defined( 'BOJLERSITE_LOAD_WEBPACK' ) && BOJLERSITE_LOAD_WEBPACK );
}

/**
 * Returns true if local dev is active.
 *
 * @return boolean
 */
function bojlersite_is_local_dev() {
	return ( defined( 'BOJLERSITE_LOCAL_DEV' ) && BOJLERSITE_LOCAL_DEV );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bojlersite_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/bojlersite
	 * If you're building a theme based on Bojler Site, use a find and replace
	 * to change 'bojlersite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'bojlersite' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'bojlersite-featured-image', 2000, 1200, true );

	add_image_size( 'bojlersite-thumbnail-avatar', 100, 100, true );

	add_image_size( 'bojlersite-template-library-image', 770, 310, true );
	add_image_size( 'bojlersite-template-library-image-x2', 1540, 620, true );

	add_image_size( 'bojlersite-template-image', 520, 320, true );
	add_image_size( 'bojlersite-template-image-x2', 1040, 640, true );

	add_image_size( 'bojlersite-template-bundle-image', 250, 170, true );
	add_image_size( 'bojlersite-template-bundle-image-x2', 500, 340, true );

	add_image_size( 'bojlersite-template-mobile-image', 220, 450, true );
	add_image_size( 'bojlersite-template-mobile-image-x2', 440, 900, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'bojlersite__menu-navbar'    => __( 'Primary', 'bojlersite' ),
		'bojlersite__menu-footer'    => __( 'Footer', 'bojlersite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'bojlersite' ),
				'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'bojlersite' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'bojlersite' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'bojlersite' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 'bojlersite' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Bojler Site array of starter content.
	 *
	 * @since Bojler Site 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'bojlersite_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'bojlersite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bojlersite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bojlersite_content_width', 640 );
}
add_action( 'template_redirect', 'bojlersite_content_width', 0 );

/**
 * Add preconnect for Google Fonts.
 *
 * @since Bojler Site 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function bojlersite_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'bojlersite-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'bojlersite_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function bojlersite_scripts() {
	if ( bojlersite_should_load_webpack() && file_exists( trailingslashit( get_template_directory() ) . '.webpack-dev' ) ) {
		wp_enqueue_script(
			'bojlersite-styles',
			'//bojler-site.test:9000/assets/js/styles.js',
			array(),
			null,
			false
		);

		wp_enqueue_script(
			'bojlersite-main',
			'//bojler-site.test:9000/assets/js/main.js',
			array(),
			null,
			true
		);
	} else {
		wp_enqueue_style(
			'bojlersite-style',
			get_template_directory_uri() . '/assets/css/styles.css',
			array(),
			'201803151520'
		);

		wp_enqueue_script(
			'bojlersite-main',
			get_template_directory_uri() . '/assets/js/main.js',
			array(),
			'201803151520',
			true
		);
	}

	wp_enqueue_style(
		'ibm-plex-sans',
		'https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,400i,500,500i,700,700i',
		false
	);

	wp_enqueue_style(
		'ibm-plex-mono',
		'https://fonts.googleapis.com/css?family=IBM+Plex+Mono',
		false
	);
}
add_action( 'wp_enqueue_scripts', 'bojlersite_scripts' );

/**
 * Includes.
 */
require get_template_directory() . '/inc/inc.php';
