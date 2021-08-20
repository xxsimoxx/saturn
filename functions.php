<?php
require_once 'includes/lighthouse.php';
require_once 'includes/settings.php';
require_once 'includes/meta.php';



/**
 * Custom post types
 */
require_once 'includes/cpt-testimonials.php';
require_once 'includes/cpt-slides.php';

include 'modules/testimonials/testimonials.php';

// Saturn Module: Saturn Slider
if ((int) get_option('use_flickity') === 1) {
    require_once 'blocks/slider/index.php';
    require_once 'modules/slider/slider.php';
}



/**
 * Templates, template variables and block patterns
 */
require_once 'templates/blocks.php';
require_once 'templates/header.php';
require_once 'templates/patterns.php';



/**
 * Saturn Module Loader
 *
 * Loop through all modules array, check for enabled option and include the file
 */
$modules = [
    [
        'module' => 'side-drawer',
        'option' => 'use_side_drawer',
        'path' => 'modules/side-drawer/side-drawer.php'
    ],
    [
        'module' => 'side-panel',
        'option' => 'use_side_panel',
        'path' => 'modules/side-panel/side-panel.php'
    ],
];

foreach ($modules as $module) {
    if ((int) get_option($module['option']) === 1) {
        include $module['path'];
    }
}



function is_post_type($type) {
    global $post;

    if ((string) $type === get_post_type($post->ID)) {
        return true;
    }

    return false;
}




// enqueue admin scripts and styles
add_action('admin_enqueue_scripts', 'saturn_admin_scripts');
function saturn_admin_scripts() {
    $version = wp_get_theme()->get('Version');

    wp_enqueue_style('saturn', get_stylesheet_directory_uri() . '/assets/css/admin.css', [], $version);

    wp_enqueue_script('saturn', get_stylesheet_directory_uri() . '/js/supernova.js', [], $version, true);
}

function saturn_enqueue() {
    $version = wp_get_theme()->get('Version');

    // External stylesheets
    $supernovaExternalResources = get_option('supernova_external_css');

    if (count(array_filter((array) get_option('supernova_external_css'))) > 0) {
        $supernovaExternalResources = array_filter($supernovaExternalResources);

        foreach ($supernovaExternalResources as $resourceId => $resource) {
            if (strpos($resource, 'https://fonts.googleapis.com/css2?') !== false) {
                $resource = str_replace(['https://fonts.googleapis.com/css2?', '&display=swap'], '', $resource);
                $resource = 'https://fonts.googleapis.com/css2?' . urlencode($resource) . '&display=swap';
            }
            wp_enqueue_style('supernova-external-' . $resourceId, $resource, [], $version);
        }
    }

    if ((int) get_option('use_native_fonts') !== 1) {
        wp_enqueue_style('google-fonts', saturn_google_fonts(), [], $version);
    }

    if ((int) get_option('use_icofont') === 1) {
        wp_enqueue_style('icofont', get_stylesheet_directory_uri() . '/assets/fonts/icofont/icofont.min.css', [], $version);
    }

    if ((int) get_option('use_butter') === 1) {
        wp_enqueue_script('butter', get_stylesheet_directory_uri() . '/js/butter/butter.min.js', [], $version, true);
    }

    if ((int) get_option('use_leaflet') === 1) {
        wp_enqueue_style('leaflet', get_stylesheet_directory_uri() . '/assets/js/leaflet/leaflet.css', [], '1.7.1');

        wp_enqueue_script('leaflet', get_stylesheet_directory_uri() . '/assets/js/leaflet/leaflet.js', [], '1.7.1', true);
        wp_enqueue_script('leaflet-bundle', get_stylesheet_directory_uri() . '/assets/js/leaflet-bundle.min.js', ['leaflet'], $version, true);
    }


    wp_enqueue_style('saturn', get_stylesheet_directory_uri() . '/assets/css/main.css', [], $version);
    wp_enqueue_style('patterns', get_stylesheet_directory_uri() . '/assets/css/patterns.css', [], $version);

    wp_enqueue_script('supernova-init', get_stylesheet_directory_uri() . '/js/init.js', [], $version, true);
}
add_action('wp_enqueue_scripts', 'saturn_enqueue');

function supernova_setup() {
    $content_width = (int) get_option('content_width');

	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');

    remove_theme_support('post-formats');

    // Block editor support
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');

    add_theme_support('core-block-patterns');

    add_theme_support('custom-line-height');
    add_theme_support('custom-spacing');
    add_theme_support('woocommerce');

    add_image_size('homepage_hero', 1440, 900, true);
    add_image_size('homepage_grid', 640, 400, true);

	add_theme_support('html5', [
		'script',
        'style',
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
	]);

    add_theme_support('custom-logo', [
        'width' => 180,
        'height' => 48,
        'flex-height' => true,
        'flex-width' => true,
        'header-text' => ['site-title', 'site-description'],
    ]);

	register_nav_menus([
		'main-menu' => 'Primary Menu',

		'primary-pipes' => 'Primary Pipes Menu',

		'mobile-menu' => 'Mobile Menu',
		'footer-menu' => 'Footer Menu'
	]);

    /**
     * Lighthouse
     */
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'shortlink_wp_head', 10, 0);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action('template_redirect', 'wp_shortlink_header', 11, 0);

    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'feed_links', 2);

    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'parent_post_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'start_post_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

    // Remove issues with prefetching adding extra views
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10,0);
}
add_action('after_setup_theme', 'supernova_setup');



/**
 * Snackbar
 */
function supernova_snackbar() {
    $supernovaSnackbarBlockID = (int) get_option('supernova_snackbar_block_id');
    $supernovaSnackbarScrollValue = (int) get_option('supernova_snackbar_scroll_value');
    $supernovaSnackbarClass = ($supernovaSnackbarScrollValue === 0) ? 'snackbar--on' : '';

    $out = '<div id="snackbar" class="snackbar ' . $supernovaSnackbarClass . '" data-scroll="' . $supernovaSnackbarScrollValue . '">';

        $reusableBlockSingleId = get_post($supernovaSnackbarBlockID);

        $out .= apply_filters('the_content', $reusableBlockSingleId->post_content);

    $out .= '</div>';

    echo $out;
}

if ((int) get_option('supernova_snackbar') && (int) get_option('supernova_snackbar_block_id') > 0) {
    add_action('wp_footer', 'supernova_snackbar');
}



/**
 * Add featured image class to body
 *
 * Adds featured image class to body if the current post or page has a featured image attached.
 *
 * @param  array $classes
 * @return array
 */
function supernova_featured_image_body_class($classes) {
    global $post;

    if (isset($post->ID) && get_the_post_thumbnail($post->ID)) {
        $classes[] = 'has-featured-image';
    }

    if ((int) get_option('use_cursor') === 1) {
        $classes[] = 'has-cursor';
    }

    if ((int) get_option('use_butter') === 1) {
        $classes[] = 'has-butter';
    }

    return $classes;
}
add_filter('body_class', 'supernova_featured_image_body_class');



/**
 * Change excerpt length
 *
 * Changes the excerpt length for posts and custom post types.
 *
 * @param  int $length
 * @return int
 */
function supernova_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'supernova_excerpt_length', 999);






function supernova_block_editor_assets() {
    wp_enqueue_style('supernova-editor-style', get_stylesheet_directory_uri() . '/assets/css/editor.css', [], '1.0.1');
}
add_action('enqueue_block_editor_assets', 'supernova_block_editor_assets');



function supernova_body_open() {
    if (!empty(get_option('tracking_gtm'))) {
        echo '<!-- Google Tag Manager (noscript) --><noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . get_option('tracking_gtm') . '" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript><!-- End Google Tag Manager (noscript) -->';
    }
}

add_action('wp_body_open', 'supernova_body_open');



function getSupernovaPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);

    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');

        return '0 views';
    }

    return $count . ' views';
}

function setSupernovaPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);

    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}



function supernova_footer() {
    // Side Drawer
    if ((int) get_option('use_side_drawer') === 1 && function_exists('show_side_drawer')) {
        show_side_drawer();
    }

    // Custom HTML Code
    echo html_entity_decode(get_option('supernova_custom_html_footer'));
}

add_action('wp_footer', 'supernova_footer', 10, 0);



/**
 * Get the formatted HTML content of a given reusable block ID and return it
 *
 * @var    int    $block_id ID of reusable block
 * @return string
 */
function saturn_get_reusable_block($block_id = '') {
    if (empty($block_id)) {
        return;
    }

    $content = get_post_field('post_content', $block_id);

    return apply_filters('the_content', $content);
}

/**
 * Build a custom shortcode using the saturn_get_reusable_block() function
 *
 * @var    array $atts Shortcode attributes
 * @return string
 */
function saturn_reusable_block_shortcode($atts) {
    extract(shortcode_atts([
        'id' => ''
    ], $atts));

    if (empty($id)) {
        return;
    }

    $content = saturn_get_reusable_block($id);

    return $content;
}
add_shortcode('reusable', 'saturn_reusable_block_shortcode');



function saturn_footer_signature() {
    $out = '<div class="footer-signature wrap">
        <small>
            Crafted by <a href="https://getbutterfly.com/">getButterfly</a>. &copy;' . date('Y') . '. All rights reserved.&nbsp;';

            $out .= wp_nav_menu([
                'theme_location' => 'footer-menu',
                'container' => false,
                'echo' => false
            ]);
        $out .= '</small>
    </div>';

    return $out;
}
add_shortcode('footer-signature', 'saturn_footer_signature');



/**
 * Build Google fonts string
 */
function saturn_google_fonts() {
    $fontArray = [];

    $fontArray[] = ((string) get_option('heading_font') !== '0') ? 'family=' . get_option('heading_font') . ':wght@300;400;500;700' : '';
    $fontArray[] = ((string) get_option('body_font') !== '0') ? 'family=' . get_option('body_font') . ':wght@300;400;500;700' : '';

    $fontArray = array_filter($fontArray);
    $fontArray = array_unique($fontArray);
    $fontArray = str_replace(' ', '+', $fontArray);

    $saturnFonts = 'https://fonts.googleapis.com/css2?' . urlencode(implode('&', $fontArray)) . '&display=swap';

    return $saturnFonts;
}
