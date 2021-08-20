<?php
/**
 * Get custom header structure based on user selection.
 *
 * Get a custom header structure and display it in various locations
 * based on user selection.
 *
 * @param int  $type  Header type.
 */
function get_supernova_header() {
    // Initialise container
    $out = '';

    // Initialise options
    $headerBoxedNav = (int) get_option('boxed_nav');
    $headerType = (int) get_option('header_type');

    $headerBoxedNav = ($headerBoxedNav === 1) ? 'wrap' : '';

    $primaryPipes = wp_nav_menu([
        'theme_location' => 'primary-pipes',
        'menu_class' => 'wrap',
        'container' => false,
        'echo' => false
    ]);
    $primaryMenu = wp_nav_menu([
        'theme_location' => 'main-menu',
        'menu_class' => 'wrap',
        'container' => false,
        'echo' => false
    ]);

    switch ($headerType) {
        case 1:
            $headerClass = 'header-top';
            break;
        case 2:
            $headerClass = 'header-sticky-modern';
            break;
    }

    if ((int) get_option('padded_nav') === 1) {
        $headerClass .= ' header-padded';
    }
    if ((int) get_option('rounded_nav') === 1) {
        $headerClass .= ' header-rounded';
    }
    if ((int) get_option('transparent_nav') === 1) {
        $headerClass .= ' header-transparent';
    }
    if ((int) get_option('noshadow_nav') === 1) {
        $headerClass .= ' header-noshadow';
    }


    $out .= '<header class="' . $headerClass . ' ' . $headerBoxedNav . '">
        <nav>
            ' . $primaryPipes . '
            ' . $primaryMenu . '
        </nav>
    </header>';

    return $out;
}

function supernova_custom_menu_item($items, $args) {
    if ($args->theme_location === 'main-menu') {
        $current_items = $items;
        $items = '<li class="menu-logo-container"><a href="' . home_url() . '" class="menu-logo-large">' . get_bloginfo('name') . '</a></li>';
        if (has_custom_logo()) {
            $items = '<li class="pull-left">' . get_custom_logo() . '</li>';
        }
        $items .= $current_items;

        if ((int) get_option('use_icofont') === 1) {
            $items .= '<li class="menu-item menu-toggle">
                <a href="#">
                    <i class="icofont-navigation-menu side-menu-close" style="font-size: 24px;"></i>
                </a>
            </li>';
        } else {
            if ((int) get_option('navicon_type') === 1) {
                // Black icon
                $items .= '<li class="menu-item menu-toggle">
                    <a href="#">
                        <i class="icofont-navigation-menu side-menu-close"></i>
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYAQAAAADIDABVAAAAAnRSTlMAAQGU/a4AAAAXSURBVHjaY/j//z8DOj7AwAzGlIoDMQD2pDpdsSi2QgAAAABJRU5ErkJggg==" alt="Menu" class="side-menu-close">
                    </a>
                </li>';
            } else if ((int) get_option('navicon_type') === 2) {
                // White icon
                $items .= '<li class="menu-item menu-toggle">
                    <a href="#">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYAQAAAADIDABVAAAAAnRSTlMAAHaTzTgAAAAUSURBVHjaY2DAAuz//wFjSsWBAAB9UA1dOzf0zgAAAABJRU5ErkJggg==" alt="Menu" class="side-menu-close">
                    </a>
                </li>';
            }
        }

        if ((int) get_option('use_dark_mode') === 1) {
            if ((int) get_option('use_icofont') === 1) {
                $items .= '<li class="menu-item menu-theme-container">
                    <a class="toggle-container" href="#">
                        <input type="checkbox" id="switch" name="theme"><label for="switch" aria-label="Dark Mode"><i class="icofont-sun"></i><i class="icofont-moon"></i></label>
                    </a>
                </li>';
            } else {
                $items .= '<li class="menu-item menu-theme-container">
                    <a class="toggle-container" href="#">
                        <input type="checkbox" id="switch" name="theme"><label for="switch" aria-label="Dark Mode"></label>
                    </a>
                </li>';
            }
        }
    }

    return $items;
}

add_filter('wp_nav_menu_items', 'supernova_custom_menu_item', 10, 2);
