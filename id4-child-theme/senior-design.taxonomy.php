<?php

// Register Custom Taxonomy
function senior_design_proj_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Project Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Project Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Project Categories', 'text_domain' ),
		'all_items'                  => __( 'All Project Categories', 'text_domain' ),
		'parent_item'                => __( 'Parent Project Category', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Project Category:', 'text_domain' ),
		'new_item_name'              => __( 'New Project Category', 'text_domain' ),
		'add_new_item'               => __( 'Add New Project Category', 'text_domain' ),
		'edit_item'                  => __( 'Edit Project Category', 'text_domain' ),
		'update_item'                => __( 'Update Project Category', 'text_domain' ),
		'view_item'                  => __( 'View Project Category', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Project Categories with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Project Categories', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Project Categories', 'text_domain' ),
		'search_items'               => __( 'Search Project Categories', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Project Categories list', 'text_domain' ),
		'items_list_navigation'      => __( 'Project Categories list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'senior-design', array( 'seniordesignproject' ), $args );

}
//add_action( 'init', 'senior_design_proj_taxonomy', 0 );
