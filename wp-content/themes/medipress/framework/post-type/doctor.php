<?php
// Register Custom Post Type
function tb_add_post_type_doctor() {
	// Register department
	$labels = array(
            'name'              => _x( 'Doctor Department', 'taxonomy general name', 'medipress' ),
            'singular_name'     => _x( 'Doctor Department', 'taxonomy singular name', 'medipress' ),
            'search_items'      => __( 'Search Doctor Department', 'medipress' ),
            'all_items'         => __( 'All Doctor Department', 'medipress' ),
            'parent_item'       => __( 'Parent Doctor Department', 'medipress' ),
            'parent_item_colon' => __( 'Parent Doctor Department:', 'medipress' ),
            'edit_item'         => __( 'Edit Doctor Department', 'medipress' ),
            'update_item'       => __( 'Update Doctor Department', 'medipress' ),
            'add_new_item'      => __( 'Add New Doctor Department', 'medipress' ),
            'new_item_name'     => __( 'New Doctor Department Name', 'medipress' ),
            'menu_name'         => __( 'Doctor Department', 'medipress' ),
    );
	
	$args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'doctor_department' ),
    );
    if(function_exists('custom_reg_taxonomy')) {
        custom_reg_taxonomy( 'doctor_department', array( 'doctor' ), $args );
    }
	
    //Register tags
    $labels = array(
            'name'              => _x( 'Doctor Tag', 'taxonomy general name', 'medipress' ),
            'singular_name'     => _x( 'Doctor Tag', 'taxonomy singular name', 'medipress' ),
            'search_items'      => __( 'Search Doctor Tag', 'medipress' ),
            'all_items'         => __( 'All Doctor Tag', 'medipress' ),
            'parent_item'       => __( 'Parent Doctor Tag', 'medipress' ),
            'parent_item_colon' => __( 'Parent Doctor Tag:', 'medipress' ),
            'edit_item'         => __( 'Edit Doctor Tag', 'medipress' ),
            'update_item'       => __( 'Update Doctor Tag', 'medipress' ),
            'add_new_item'      => __( 'Add New Doctor Tag', 'medipress' ),
            'new_item_name'     => __( 'New Doctor Tag Name', 'medipress' ),
            'menu_name'         => __( 'Doctor Tag', 'medipress' ),
    );

    $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'doctor_tag' ),
    );
    
    if(function_exists('custom_reg_taxonomy')) {
        custom_reg_taxonomy( 'doctor_tag', array( 'doctor' ), $args );
    }
    
    //Register post type doctor
    $labels = array(
            'name'                => _x( 'Doctor', 'Post Type General Name', 'medipress' ),
            'singular_name'       => _x( 'Doctor Item', 'Post Type Singular Name', 'medipress' ),
            'menu_name'           => __( 'Doctor', 'medipress' ),
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
            'label'               => __( 'Doctor', 'medipress' ),
            'description'         => __( 'Doctor Description', 'medipress' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions' ),
            'taxonomies'          => array( 'doctor_department', 'doctor_tag' ),
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
        custom_reg_post_type( 'doctor', $args );
    }
    
}

// Hook into the 'init' action
add_action( 'init', 'tb_add_post_type_doctor', 0 );
