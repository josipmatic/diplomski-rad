<?php
/**
 * VISP example custom post type.
 *
 * @package VISP_Examples
 */

/**
 * Register visp example custom post type.
 */
function visp_example_cpt() {
	$labels = array(
		'name'                  => _x( 'VISP Examples', 'Post Type General Name', 'visp-examples' ),
		'singular_name'         => _x( 'VISP Example', 'Post Type Singular Name', 'visp-examples' ),
		'menu_name'             => __( 'VISP Examples', 'visp-examples' ),
		'name_admin_bar'        => __( 'VISP Example', 'visp-examples' ),
		'archives'              => __( 'Item Archives', 'visp-examples' ),
		'attributes'            => __( 'Item Attributes', 'visp-examples' ),
		'parent_item_colon'     => __( 'Parent Item:', 'visp-examples' ),
		'all_items'             => __( 'All Items', 'visp-examples' ),
		'add_new_item'          => __( 'Add New Item', 'visp-examples' ),
		'add_new'               => __( 'Add New', 'visp-examples' ),
		'new_item'              => __( 'New Item', 'visp-examples' ),
		'edit_item'             => __( 'Edit Item', 'visp-examples' ),
		'update_item'           => __( 'Update Item', 'visp-examples' ),
		'view_item'             => __( 'View Item', 'visp-examples' ),
		'view_items'            => __( 'View Items', 'visp-examples' ),
		'search_items'          => __( 'Search Item', 'visp-examples' ),
		'not_found'             => __( 'Not found', 'visp-examples' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'visp-examples' ),
		'featured_image'        => __( 'Featured Image', 'visp-examples' ),
		'set_featured_image'    => __( 'Set featured image', 'visp-examples' ),
		'remove_featured_image' => __( 'Remove featured image', 'visp-examples' ),
		'use_featured_image'    => __( 'Use as featured image', 'visp-examples' ),
		'insert_into_item'      => __( 'Insert into item', 'visp-examples' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'visp-examples' ),
		'items_list'            => __( 'Items list', 'visp-examples' ),
		'items_list_navigation' => __( 'Items list navigation', 'visp-examples' ),
		'filter_items_list'     => __( 'Filter items list', 'visp-examples' ),
	);

	$args = array(
		'label'               => __( 'VISP Example', 'visp-examples' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 25,
		'menu_icon'           => 'dashicons-media-code',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'show_in_rest'        => false,
	);

	register_post_type( 'visp-example', $args );
}
add_action( 'init', 'visp_example_cpt', 0 );
