<?php
/**
 * Filter hook to set which plugins or themes should override WP.org for updating
 * 
 * @return array
 */
add_filter('github_updater_override_dot_org', function () {
    return [
        // 'plugin-name/plugin-name.php', // plugin format
        'saturn' // theme slug
    ];
});



function supernova_register_required_plugins($pluginArray) {
    $action = 'install-plugin';

    foreach ($pluginArray as $recommendedPlugin) {
        $name = $recommendedPlugin['name'];
        $slug = $recommendedPlugin['slug'];
        $file = $recommendedPlugin['file'];

        $link = wp_nonce_url(
            add_query_arg([
                'action' => $action,
                'plugin' => $slug
            ],
            admin_url('update.php')),
            $action . '_' . $slug
        );

        $status = ' ❌';
        $buttonStatus = '';
        if (file_exists(WP_PLUGIN_DIR . '/' . $file)) {
            $status = (is_plugin_active($file)) ? ' ✔️' : ' ✖️';
            $buttonStatus = (is_plugin_active($file)) ? 'button-active' : 'button-inactive';
        }

        echo '<a href="' . $link . '" class="button button-secondary ' . $buttonStatus . '">' . $name . $status . '</a> ';
    }
}



require_once 'includes/lighthouse.php';
require_once 'includes/settings.php';
require_once 'includes/meta.php';



/**
 * Custom post types
 */
require_once 'includes/cpt-testimonials.php';

include 'modules/testimonials/testimonials.php';



/**
 * Templates and template variables
 */
require_once 'templates/blocks.php';
require_once 'templates/header.php';



/**
 * Supernova Module Loader
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
add_action('admin_enqueue_scripts', 'supernova_admin_scripts');
function supernova_admin_scripts() {
    wp_enqueue_style('supernova', get_stylesheet_directory_uri() . '/assets/css/admin.css', ['wp-codemirror']);

    wp_enqueue_script('supernova', get_stylesheet_directory_uri() . '/js/supernova.js', ['wp-theme-plugin-editor'], false, true);

    // CodeMirror for Custom CSS
    $cm_settings['codeEditor'] = wp_enqueue_code_editor([]);

    wp_localize_script('supernova', 'cm_settings', $cm_settings);
}

function supernova_enqueue() {
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
        wp_enqueue_style('google-fonts', supernova_google_fonts(), [], $version);
    }

    wp_enqueue_style('supernova', get_stylesheet_directory_uri() . '/assets/css/main.css', [], $version);

    wp_enqueue_script('supernova-init', get_stylesheet_directory_uri() . '/js/init.js', [], $version, true);
}
add_action('wp_enqueue_scripts', 'supernova_enqueue');

function supernova_setup() {
    global $content_width;

    $contentWidth = (int) get_option('content_width');
    if (!isset($content_width)) {
        $content_width = $contentWidth;
    }

	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');

    remove_theme_support('post-formats');

    // Block editor support
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_theme_support('core-block-patterns');

    add_image_size('homepage_hero', 1440, 900, true);

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
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10,0);
}
add_action('after_setup_theme', 'supernova_setup');



function supernova_disable_srcset($sources) {
    return false;
}
//add_filter('wp_calculate_image_srcset', 'supernova_disable_srcset');



function supernova_remove_default_image_sizes($sizes) {
    unset($sizes['1536x1536']);
    unset($sizes['2048x2048']);

    return $sizes;
}
//add_filter('intermediate_image_sizes_advanced', 'supernova_remove_default_image_sizes');



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

    // Detect IE (IE11 or below)
    if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || preg_match('~Trident/7.0(; Touch)?; rv:11.0~',$_SERVER['HTTP_USER_AGENT'])) {
        echo '<div class="unsupported-browser"><b>Unsupported Browser!</b> This website will offer limited functionality in this browser. We only support the recent versions of major browsers like Chrome, Firefox, Safari, and Edge.</div>';
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
// Remove issues with prefetching adding extra views
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);



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
function supernova_get_reusable_block($block_id = '') {
    if (empty($block_id)) {
        return;
    }

    $content = get_post_field('post_content', $block_id);

    return apply_filters('the_content', $content);
}

/**
 * Build a custom shortcode using the supernova_get_reusable_block() function
 *
 * @var    array $atts Shortcode attributes
 * @return string
 */
function supernova_reusable_block_shortcode($atts) {
    extract(shortcode_atts([
        'id' => ''
    ], $atts));

    if (empty($id)) {
        return;
    }

    $content = supernova_get_reusable_block($id);

    return $content;
}
add_shortcode('reusable', 'supernova_reusable_block_shortcode');



function supernova_footer_signature() {
    $out = '<div class="footer-signature wrap">
        <small>
            Crafted by <a href="https://www.4property.com/">4Property</a>. &copy;' . date('Y') . '. All rights reserved. <a href="' . wp_login_url() . '">Login</a>.&nbsp;';

            $out .= wp_nav_menu([
                'theme_location' => 'footer-menu',
                'container' => false,
                'echo' => false
            ]);
        $out .= '</small>
    </div>';

    return $out;
}
add_shortcode('footer-signature', 'supernova_footer_signature');



function supernova_remove_jp_sharing() {
    if ( is_singular( 'post' ) && function_exists( 'sharing_display' ) ) {
        remove_filter( 'the_content', 'sharing_display', 19 );
        remove_filter( 'the_excerpt', 'sharing_display', 19 );
    }
}
add_action( 'loop_start', 'supernova_remove_jp_sharing' );



/**
 * Build Google fonts string
 */
function supernova_google_fonts() {
    $fontArray = [];

    $fontArray[] = ((string) get_option('heading_font') !== '0') ? 'family=' . get_option('heading_font') . ':wght@300;400;500;700' : '';
    $fontArray[] = ((string) get_option('body_font') !== '0') ? 'family=' . get_option('body_font') . ':wght@300;400;500;700' : '';

    $fontArray = array_filter($fontArray);
    $fontArray = str_replace(' ', '+', $fontArray);

    $supernovaFonts = 'https://fonts.googleapis.com/css2?' . urlencode(implode('&', $fontArray)) . '&display=swap';

    return $supernovaFonts;
}




/**
 * Register Custom Block Styles
 */
function mels_patterns_register_block_patterns() {
    //if ( function_exists( 'register_pattern' ) ) {
    /**
    * Register block patterns
    */register_block_pattern_category(
    'hero',
    array( 'label' => __( 'Hero', 'my-plugin' ) )
);

        register_block_pattern(
            'mels-gutenberg-block-patterns/intro-two-columns',
            array(
                'title'   => __( 'Intro paragraph with two columns', 'mels-gutenberg-block-patterns' ),
                'description' => _x( 'Two horizontal buttons, the left button is filled in, and the right button is outlined.', 'Block pattern description', 'wpdocs-my-plugin' ),
                'categories' => ['hero'],
                'keywords' => ['test'],
                'content' => "<!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column {\"width\":70} -->\n<div class=\"wp-block-column\" style=\"flex-basis:80%\"><!-- wp:paragraph {\"customFontSize\":28} -->\n<p style=\"font-size:28px\">Driving empathy maps and possibly surprise and delight. Target mobile-first design with the aim to build ROI.</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"width\":33.33} -->\n<div class=\"wp-block-column\" style=\"flex-basis:33.33%\"></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->\n\n<!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:paragraph -->\n<p>Informing innovation and then surprise and delight. Driving custom solutions and possibly think outside the box. Create awareness with a goal to funnel users. Lead relevant and engaging content with the possibility to infiltrate new markets.</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:paragraph -->\n<p>Amplifying innovation with the possibility to target the low hanging fruit. Consider dark social but innovate. Creating a holistic approach in order to be on brand. Leading empathy maps but be CMSable. Repurposing branding.</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->",
            )
        );
    //}
}
add_action( 'init', 'mels_patterns_register_block_patterns' );
