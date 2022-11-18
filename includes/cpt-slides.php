<?php
function saturn_cpt_slides() {
    $labels = [
        'name'                  => 'Slides',
        'singular_name'         => 'Slide',
        'menu_name'             => 'Slides',
        'name_admin_bar'        => 'Slide',
        'archives'              => 'Slide Archives',
        'attributes'            => 'Slide Attributes',
        'parent_item_colon'     => 'Parent Slide:',
        'all_items'             => 'All Slides',
        'add_new_item'          => 'Add New Slide',
        'add_new'               => 'Add New',
        'new_item'              => 'New Slide',
        'edit_item'             => 'Edit Slide',
        'update_item'           => 'Update Slide',
        'view_item'             => 'View Slide',
        'view_items'            => 'View Slides',
        'search_items'          => 'Search Slide',
        'not_found'             => 'Not found',
        'not_found_in_trash'    => 'Not found in Trash',
        'featured_image'        => 'Featured Image',
        'set_featured_image'    => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image'    => 'Use as featured image',
        'insert_into_item'      => 'Insert into slide',
        'uploaded_to_this_item' => 'Uploaded to this slide',
        'items_list'            => 'Slides list',
        'items_list_navigation' => 'Slides list navigation',
        'filter_items_list'     => 'Filter slides list',
    ];

    $args = [
        'label'               => 'Slide',
        'description'         => 'Slide',
        'labels'              => $labels,
        'supports'            => [ 'title', 'thumbnail', 'editor', 'custom-fields', 'page-attributes' ],
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-slides',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => true,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
    ];

    register_post_type( 'slide', $args );
}

add_action( 'init', 'saturn_cpt_slides', 0 );

/**
 * Custom thumbnail and video columns
 */
function saturn_slides_columns( $defaults ) {
    $defaults['saturn_slide_thumbnail'] = 'Featured Image<br><small>Mandatory</small>';
    $defaults['saturn_slide_video']     = 'Featured Video<br><small>Optional</small>';
    $defaults['saturn_slide_id']        = 'ID<br><small>Use this ID for the slider shortcode</small>';

    return $defaults;
}

function saturn_slides_custom_columns( $column_name, $id ) {
    if ( $column_name === 'saturn_slide_thumbnail' ) {
        echo the_post_thumbnail( 'thumbnail' );
    } elseif ( $column_name === 'saturn_slide_video' ) {
        if ( ! empty( get_post_meta( $id, 'slide-video', true ) ) ) {
            echo '<a href="' . get_post_meta( $id, 'slide-video', true ) . '" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="svg-inline--fa fa-video fa-w-18" data-icon="video" data-prefix="fas" viewBox="0 0 576 512"><path fill="currentColor" d="M336.2 64H47.8A47.8 47.8 0 0 0 0 111.8v288.4A47.8 47.8 0 0 0 47.8 448h288.4a47.8 47.8 0 0 0 47.8-47.8V111.8A47.8 47.8 0 0 0 336.2 64zm189.4 37.7L416 177.3v157.4l109.6 75.5c21.2 14.6 50.4-.3 50.4-25.8V127.5c0-25.4-29.1-40.4-50.4-25.8z"/></svg></a>';
        }
    } elseif ( $column_name === 'saturn_slide_id' ) {
        echo $id;
    }
}

add_filter( 'manage_slide_posts_columns', 'saturn_slides_columns', 5 );
add_action( 'manage_slide_posts_custom_column', 'saturn_slides_custom_columns', 5, 2 );
