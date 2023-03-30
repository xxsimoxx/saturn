<?php
add_filter( 'pre_set_site_transient_update_themes', 'saturn_check_for_update' );

function saturn_check_for_update( $checked_data ) {
    global $wp_version;

    if ( empty( $checked_data->checked ) ) {
        return $checked_data;
    }

    $api_url    = 'https://getbutterfly.com/web/wp/update/';
    $theme_base = 'saturn';

    $request = [
        'slug'    => $theme_base,
        'version' => $checked_data->checked[ $theme_base ],
    ];

    // Start checking for an update
    $send_for_check = [
        'body'       => [
            'action'  => 'theme_update',
            'request' => serialize( $request ),
            'api-key' => md5( get_bloginfo( 'url' ) ),
        ],
        'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo( 'url' ),
    ];

    $raw_response = wp_remote_post( $api_url, $send_for_check );

    if ( ! is_wp_error( $raw_response ) && ( $raw_response['response']['code'] == 200 ) ) {
        $response = unserialize( $raw_response['body'] );
    }

    // Feed the update data into WP updater
    if ( ! empty( $response ) ) {
        $checked_data->response[ $theme_base ] = $response;
    }

    return $checked_data;
}

if ( is_admin() ) {
    $current = get_transient( 'update_themes' );
}



function saturn_auto_update_specific_themes( $update, $item ) {
    // Array of theme slugs to always auto-update
    $themes = [
        'saturn',
    ];

    if ( in_array( $item->slug, $themes ) ) {
        // Always update themes in this array
        return true;
    } else {
        // Else, use the normal API response to decide whether to update or not
        return $update;
    }
}
add_filter( 'auto_update_theme', 'saturn_auto_update_specific_themes', 10, 2 );
