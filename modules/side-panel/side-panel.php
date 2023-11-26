<?php
function saturn_side_panel_enqueue() {
    // Add custom styles
    $custom_side_panel_css = '<style>';

    if ( (int) get_option( 'saturn_side_panel_fullscreen' ) === 1 ) {
        $custom_side_panel_css .= '#site-menu { opacity: 0.75; transition: 1750ms cubic-bezier(0.16, 1, 0.3, 1) all; }';
        $custom_side_panel_css .= '#site-menu.show-nav { width: 100%; opacity: 1; box-shadow: none; }';
    }

    if ( ! empty( (string) get_option( 'saturn_side_panel_background_colour' ) ) )  {
        $custom_side_panel_css .= '#site-menu { background-color: ' . get_option( 'saturn_side_panel_background_colour' ) . '; }';
    }

    if ( ! empty( (string) get_option( 'saturn_side_panel_text_colour' ) ) ) {
        $custom_side_panel_css .= '#site-menu { color: ' . get_option( 'saturn_side_panel_text_colour' ) . '; }';
    }

    if ( ! empty( (string) get_option( 'saturn_side_panel_link_colour' ) ) ) {
        $custom_side_panel_css .= '#site-menu a { color: ' . get_option( 'saturn_side_panel_link_colour' ) . '; }';
    }

    if ( ! empty( (string) get_option( 'saturn_side_panel_link_hover_colour' ) ) ) {
        $custom_side_panel_css .= '#site-menu a:hover { color: ' . get_option( 'saturn_side_panel_link_hover_colour' ) . '; }';
    }

    $custom_side_panel_css .= '</style>';

    echo $custom_side_panel_css;
}

add_action( 'wp_head', 'saturn_side_panel_enqueue' );



function saturn_show_side_panel() {
    $supernova_side_panel_block_id = (int) get_option( 'supernova_side_panel_block_id' );
    $supernova_side_panel_modal    = (int) get_option( 'supernova_side_panel_modal' );

    $side_panel_modal = ( $supernova_side_panel_modal === 1 ) ? 'data-modal="1"' : '';

    $out = '<section id="site-menu" ' . $side_panel_modal . '>
        <section class="site-menu-content">
            <a href="#" class="toggle-nav toggle-nav--close"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-times fa-w-10 fa-2x"><path fill="currentColor" d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z" class=""></path></svg></a>';

            $reusable_block_id = get_post( $supernova_side_panel_block_id );

            $out .= apply_filters( 'the_content', $reusable_block_id->post_content );

        $out .= '</section>
    </section>';

    echo $out;
}

add_action( 'wp_footer', 'saturn_show_side_panel' );
