<?php
// Register Custom Post Type
function tb_add_post_type_testimonial() {
    // Register taxonomy
    $labels = array(
            'name'              => _x( 'Testimonial Category', 'taxonomy general name', 'medipress' ),
            'singular_name'     => _x( 'Testimonial Category', 'taxonomy singular name', 'medipress' ),
            'search_items'      => __( 'Search Testimonial Category', 'medipress' ),
            'all_items'         => __( 'All Testimonial Category', 'medipress' ),
            'parent_item'       => __( 'Parent Testimonial Category', 'medipress' ),
            'parent_item_colon' => __( 'Parent Testimonial Category:', 'medipress' ),
            'edit_item'         => __( 'Edit Testimonial Category', 'medipress' ),
            'update_item'       => __( 'Update Testimonial Category', 'medipress' ),
            'add_new_item'      => __( 'Add New Testimonial Category', 'medipress' ),
            'new_item_name'     => __( 'New Testimonial Category Name', 'medipress' ),
            'menu_name'         => __( 'Testimonial Category', 'medipress' ),
    );

    $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'testimonial_category' ),
    );
    if(function_exists('custom_reg_taxonomy')) {
        custom_reg_taxonomy( 'testimonial_category', array( 'testimonial' ), $args );
    }
    //Register tags
    $labels = array(
            'name'              => _x( 'Testimonial Tag', 'taxonomy general name', 'medipress' ),
            'singular_name'     => _x( 'Testimonial Tag', 'taxonomy singular name', 'medipress' ),
            'search_items'      => __( 'Search Testimonial Tag', 'medipress' ),
            'all_items'         => __( 'All Testimonial Tag', 'medipress' ),
            'parent_item'       => __( 'Parent Testimonial Tag', 'medipress' ),
            'parent_item_colon' => __( 'Parent Testimonial Tag:', 'medipress' ),
            'edit_item'         => __( 'Edit Testimonial Tag', 'medipress' ),
            'update_item'       => __( 'Update Testimonial Tag', 'medipress' ),
            'add_new_item'      => __( 'Add New Testimonial Tag', 'medipress' ),
            'new_item_name'     => __( 'New Testimonial Tag Name', 'medipress' ),
            'menu_name'         => __( 'Testimonial Tag', 'medipress' ),
    );

    $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'testimonial_tag' ),
    );
    
    if(function_exists('custom_reg_taxonomy')) {
        custom_reg_taxonomy( 'testimonial_tag', array( 'testimonial' ), $args );
    }
    
    //Register post type Testimonial
    $labels = array(
            'name'                => _x( 'Testimonial', 'Post Type General Name', 'medipress' ),
            'singular_name'       => _x( 'Testimonial Item', 'Post Type Singular Name', 'medipress' ),
            'menu_name'           => __( 'Testimonial', 'medipress' ),
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
            'label'               => __( 'Testimonial', 'medipress' ),
            'description'         => __( 'Testimonial Description', 'medipress' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', ),
            'taxonomies'          => array( 'testimonial_category', 'testimonial_tag' ),
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
        custom_reg_post_type( 'testimonial', $args );
    }
    
}

// Hook into the 'init' action
add_action( 'init', 'tb_add_post_type_testimonial', 0 );
