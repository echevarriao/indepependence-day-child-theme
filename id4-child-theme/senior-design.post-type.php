<?php

// Register Custom Post Type
function senior_design_project_type() {

	$labels = array(
		'name'                  => _x( 'Senior Design Projects', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Senior Design Project', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Senior Design Projects', 'text_domain' ),
		'name_admin_bar'        => __( 'Senior Design Project', 'text_domain' ),
		'archives'              => __( 'Senior Design Project Archives', 'text_domain' ),
		'attributes'            => __( 'Senior Design Project Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Senior Design Project:', 'text_domain' ),
		'all_items'             => __( 'All Senior Design Projects', 'text_domain' ),
		'add_new_item'          => __( 'Add New Senior Design Project', 'text_domain' ),
		'add_new'               => __( 'Add Senior Design Project', 'text_domain' ),
		'new_item'              => __( 'New Senior Design Project', 'text_domain' ),
		'edit_item'             => __( 'Edit Senior Design Project', 'text_domain' ),
		'update_item'           => __( 'Update Senior Design Project', 'text_domain' ),
		'view_item'             => __( 'View Senior Design Project', 'text_domain' ),
		'view_items'            => __( 'View Senior Design Projects', 'text_domain' ),
		'search_items'          => __( 'Search Senior Design Project', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Senior Design Project Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set Senior Design Project featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove Senior Design Project featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as Senior Design Project featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Senior Design Project', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Senior Design Project', 'text_domain' ),
		'items_list'            => __( 'Senior Design Projects list', 'text_domain' ),
		'items_list_navigation' => __( 'Senior Design Projects list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Senior Design Projects list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Senior Design Project', 'text_domain' ),
		'description'           => __( 'Post Type Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'author' ),
		'taxonomies'            => array( 'senior-design' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-generic',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'senior-design-projects',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'seniordesignproject', $args );

}

// add_action( 'init', 'senior_design_project_type', 0 );
