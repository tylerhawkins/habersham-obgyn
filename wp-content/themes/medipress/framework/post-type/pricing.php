<?php
// Register Custom Post Type
function tb_add_post_type_pricing() {
	//Register tags
	$labels = array(
            'name'              => _x( 'Pricing Tag', 'taxonomy general name', 'medipress' ),
            'singular_name'     => _x( 'Pricing Tag', 'taxonomy singular name', 'medipress' ),
            'search_items'      => __( 'Search Pricing Tag', 'medipress' ),
            'all_items'         => __( 'All Pricing Tag', 'medipress' ),
            'parent_item'       => __( 'Parent Pricing Tag', 'medipress' ),
            'parent_item_colon' => __( 'Parent Pricing Tag:', 'medipress' ),
            'edit_item'         => __( 'Edit Pricing Tag', 'medipress' ),
            'update_item'       => __( 'Update Pricing Tag', 'medipress' ),
            'add_new_item'      => __( 'Add New Pricing Tag', 'medipress' ),
            'new_item_name'     => __( 'New Pricing Tag Name', 'medipress' ),
            'menu_name'         => __( 'Pricing Tag', 'medipress' ),
    );

    $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'pricing_tag' ),
    );
    
    if(function_exists('custom_reg_taxonomy')) {
        custom_reg_taxonomy( 'pricing_tag', array( 'pricing' ), $args );
    }
    //Register post type Pricing
    $labels = array(
            'name'                => _x( 'Pricing', 'Post Type General Name', 'medipress' ),
            'singular_name'       => _x( 'Pricing Item', 'Post Type Singular Name', 'medipress' ),
            'menu_name'           => __( 'Pricing', 'medipress' ),
            'parent_item_colon'   => __( 'Parent Item:', 'medipress' ),
            'all_items'           => __( 'All Items', 'medipress' ),
            'view_item'           => __( 'View Item', 'medipress' ),
            'add_new_item'        => __( 'Add New Item', 'medipress' ),
            'add_new'             => __( 'Add New', 'medipress' ),
            'edit_item'           => __( 'Edit Item', 'medipress' ),
            'update_item'         => __( 'Update Item', 'medipress' ),
            'search_items'        => __( 'Search Item', 'medipress' ),
            'not_found'           => __( 'Not found', 'medipress' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'medipress' ),
    );
    $args = array(
            'label'               => __( 'Pricing', 'medipress' ),
            'description'         => __( 'Pricing Description', 'medipress' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', ),
			'taxonomies'          => array( 'pricing_tag' ),
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-pressthis',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
    );
    
    if(function_exists('custom_reg_post_type')) {
        custom_reg_post_type( 'pricing', $args );
	}
    
}

// Hook into the 'init' action
add_action( 'init', 'tb_add_post_type_pricing', 0 );
