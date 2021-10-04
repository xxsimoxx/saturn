<?php
function saturn_side_panel_enqueue() {
    wp_enqueue_script('side-panel', get_stylesheet_directory_uri() . '/modules/side-panel/side-panel.js', [], '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'saturn_side_panel_enqueue');



function saturn_show_side_panel() {
    $supernovaSidePanelBlockID = (int) get_option('supernova_side_panel_block_id');
    $supernovaSidePanelModal = (int) get_option('supernova_side_panel_modal');

    $sidePanelModal = ($supernovaSidePanelModal === 1) ? 'data-modal="1"' : '';

    $out = '<section id="site-menu" ' . $sidePanelModal . '>
        <section class="site-menu-content">
            <a href="#" class="toggle-nav toggle-nav--close"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-times fa-w-10 fa-2x"><path fill="currentColor" d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z" class=""></path></svg></a>';

            $reusableBlockSingleId = get_post($supernovaSidePanelBlockID);

            $out .= apply_filters('the_content', $reusableBlockSingleId->post_content);
        $out .= '</section>
    </section>';

    echo $out;
}

add_action('wp_footer', 'saturn_show_side_panel');
