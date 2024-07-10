<?php
/**
 * Register a custom post type called 'Template Part'.
 */
function saturn_register_template_part_cpt() {
    $labels = [
        'name'               => _x( 'Template Parts', 'Post type general name', 'saturn' ),
        'singular_name'      => _x( 'Template Part', 'Post type singular name', 'saturn' ),
        'menu_name'          => _x( 'Template Parts', 'Admin Menu text', 'saturn' ),
        'name_admin_bar'     => _x( 'Template Part', 'Add New on Toolbar', 'saturn' ),
        'add_new'            => __( 'Add New', 'saturn' ),
        'add_new_item'       => __( 'Add New Template Part', 'saturn' ),
        'new_item'           => __( 'New Template Part', 'saturn' ),
        'edit_item'          => __( 'Edit Template Part', 'saturn' ),
        'view_item'          => __( 'View Template Part', 'saturn' ),
        'all_items'          => __( 'All Template Parts', 'saturn' ),
        'search_items'       => __( 'Search Template Parts', 'saturn' ),
        'not_found'          => __( 'No Template Parts found.', 'saturn' ),
        'not_found_in_trash' => __( 'No Template Parts found in Trash.', 'saturn' ),
    ];

    $args = [
        'labels'              => $labels,
        'public'              => false,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => false,
        'rewrite'             => false,
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-welcome-add-page',
        'supports'            => [ 'title', 'editor', 'revisions' ],
        'show_in_rest'        => true,
        'exclude_from_search' => true,
    ];

    register_post_type( 'template_part', $args );
}

add_action( 'init', 'saturn_register_template_part_cpt' );
