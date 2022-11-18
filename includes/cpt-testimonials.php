<?php
/**
 * Register custom post type (testimonial)
 */
function saturn_cpt_testimonials() {
    $labels = [
        'name'                  => 'Testimonials',
        'singular_name'         => 'Testimonial',
        'menu_name'             => 'Testimonials',
        'name_admin_bar'        => 'Testimonial',
        'archives'              => 'Testimonial Archives',
        'attributes'            => 'Testimonial Attributes',
        'parent_item_colon'     => 'Parent Testimonial:',
        'all_items'             => 'All Testimonials',
        'add_new_item'          => 'Add New Testimonial',
        'add_new'               => 'Add New',
        'new_item'              => 'New Testimonial',
        'edit_item'             => 'Edit Testimonial',
        'update_item'           => 'Update Testimonial',
        'view_item'             => 'View Testimonial',
        'view_items'            => 'View Testimonials',
        'search_items'          => 'Search Testimonial',
        'not_found'             => 'Not found',
        'not_found_in_trash'    => 'Not found in Trash',
        'featured_image'        => 'Featured Image',
        'set_featured_image'    => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image'    => 'Use as featured image',
        'insert_into_item'      => 'Insert into testimonial',
        'uploaded_to_this_item' => 'Uploaded to this testimonial',
        'items_list'            => 'Testimonials list',
        'items_list_navigation' => 'Testimonials list navigation',
        'filter_items_list'     => 'Filter testimonials list',
    ];

    $args = [
        'label'               => 'Testimonial',
        'description'         => 'Testimonials',
        'labels'              => $labels,
        'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-format-quote',
        'show_in_admin_bar'   => false,
        'show_in_nav_menus'   => false,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => true,
        'rewrite'             => false,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
    ];

    register_post_type( 'testimonial', $args );
}

add_action( 'init', 'saturn_cpt_testimonials', 0 );

/**
 * Register custom taxonomy for testimonials (testimonial type)
 */
function saturn_type_testimonials() {
    $labels = [
        'name'                       => _x( 'Testimonial Types', 'Taxonomy General Name', 'saturn' ),
        'singular_name'              => _x( 'Testimonial Type', 'Taxonomy Singular Name', 'saturn' ),
        'menu_name'                  => __( 'Types', 'saturn' ),
        'all_items'                  => __( 'All Types', 'saturn' ),
        'parent_item'                => __( 'Parent Type', 'saturn' ),
        'parent_item_colon'          => __( 'Parent Type:', 'saturn' ),
        'new_item_name'              => __( 'New Type Name', 'saturn' ),
        'add_new_item'               => __( 'Add New Type', 'saturn' ),
        'edit_item'                  => __( 'Edit Type', 'saturn' ),
        'update_item'                => __( 'Update Type', 'saturn' ),
        'view_item'                  => __( 'View Type', 'saturn' ),
        'separate_items_with_commas' => __( 'Separate types with commas', 'saturn' ),
        'add_or_remove_items'        => __( 'Add or remove types', 'saturn' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'saturn' ),
        'popular_items'              => __( 'Popular Types', 'saturn' ),
        'search_items'               => __( 'Search Types', 'saturn' ),
        'not_found'                  => __( 'Not Found', 'saturn' ),
        'no_terms'                   => __( 'No types', 'saturn' ),
        'items_list'                 => __( 'Types list', 'saturn' ),
        'items_list_navigation'      => __( 'Types list navigation', 'saturn' ),
    ];

    $args = [
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => false,
        'show_tagcloud'     => false,
        'rewrite'           => false,
        'show_in_rest'      => true,
    ];

    register_taxonomy( 'testimonial_type', [ 'testimonial' ], $args );
}

add_action( 'init', 'saturn_type_testimonials', 0 );
