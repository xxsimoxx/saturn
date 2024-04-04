<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_head', 'saturn_mini_css_generate' );

function saturn_mini_css_generate() {
    $output = '';

    if ( is_singular() ) {
        $output .= get_post_meta( get_the_ID(), '_saturn_mini_css', true );
    }

    if ( '' === (string) $output ) {
        return;
    }

    $output = str_replace( [ "\r", "\n" ], '', $output );
    $output = preg_replace( '/\s+/', ' ', $output );

    echo '<style id="saturn-mini-css-output">';
        echo strip_tags( $output );
    echo '</style>';
}

add_action( 'add_meta_boxes', 'saturn_mini_css_metabox' );

function saturn_mini_css_metabox() {
    // Set user role - make filterable
    $allowed = apply_filters( 'saturn_mini_css_metabox_capability', 'activate_plugins' );

    // If not an administrator, don't show the metabox
    if ( ! current_user_can( $allowed ) ) {
        return;
    }

    $args       = [ 'public' => true ];
    $post_types = get_post_types( $args );

    foreach ( $post_types as $type ) {
        add_meta_box(
            'saturn_mini_css_metabox',
            __( 'Custom CSS', 'saturn' ),
            'saturn_mini_css_show_metabox',
            $type,
            'normal',
            'default'
        );
    }
}

function saturn_mini_css_show_metabox( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'saturn_mini_css_nonce' );

    $options = get_post_meta( $post->ID );

    $css = isset( $options['_saturn_mini_css'] ) ? $options['_saturn_mini_css'][0] : false;
    ?>
    <p>These CSS rules will only apply to this post/page.</p>
    <p>
        <textarea style="width:100%;height:300px;" name="_saturn_mini_css" id="saturn-mini-css-textarea" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"><?php echo strip_tags( $css ); ?></textarea>
    </p>
    <?php
}

add_action( 'save_post', 'saturn_mini_css_save_metabox' );

function saturn_mini_css_save_metabox( $post_id ) {
    $is_autosave    = wp_is_post_autosave( $post_id );
    $is_revision    = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST['saturn_mini_css_nonce'] ) && wp_verify_nonce( $_POST['saturn_mini_css_nonce'], basename( __FILE__ ) ) ) ? true : false;

    if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
        return;
    }

    if ( isset( $_POST['_saturn_mini_css'] ) && $_POST['_saturn_mini_css'] !== '' ) {
        update_post_meta( $post_id, '_saturn_mini_css', strip_tags( $_POST['_saturn_mini_css'] ) );
    } else {
        delete_post_meta( $post_id, '_saturn_mini_css' );
    }
}
