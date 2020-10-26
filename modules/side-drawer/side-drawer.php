<?php
function side_drawer_enqueue() {
    wp_enqueue_style('side-drawer', get_stylesheet_directory_uri() . '/modules/side-drawer/side-drawer.css', [], '1.1.0');
    wp_enqueue_script('side-drawer', get_stylesheet_directory_uri() . '/modules/side-drawer/side-drawer.js', [], '1.1.0', true);
}
add_action('wp_enqueue_scripts', 'side_drawer_enqueue');



function show_side_drawer() {
    $drawerHandleTitle = get_option('side_drawer_handle_title');

    $out = '<nav class="off-canvas-drawer">';
        $out .= '<div class="off-canvas-drawer--inner">';
            $out .= '<button class="drawer-handle">' . $drawerHandleTitle . '</button>
            <span class="drawer-close"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="svg-inline--fa fa-times fa-w-10" data-icon="times" data-prefix="fal" viewBox="0 0 320 512"><defs/><path fill="currentColor" d="M194 256l102.5-102.6 21.1-21.1a8 8 0 000-11.3L295 98.3a8 8 0 00-11.3 0L160 222.1 36.3 98.3a8 8 0 00-11.3 0L2.3 121a8 8 0 000 11.3L126.1 256 2.3 379.7a8 8 0 000 11.3L25 413.6a8 8 0 0011.3 0L160 290l102.6 102.6 21.1 21.1a8 8 0 0011.3 0l22.6-22.6a8 8 0 000-11.3L194 256z"/></svg></span>';

            if ((int) get_option('supernova_drawer_block_id') > 0) {
                $reusableBlockDrawerId = get_post((int) get_option('supernova_drawer_block_id'));

                $out .= apply_filters('the_content', $reusableBlockDrawerId->post_content);
            }

        $out .= '</div>';
    $out .= '</nav>';

    echo $out;
}
