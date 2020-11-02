<?php
function supernova_disable_emojis_tinymce($plugins) {
    if (is_array($plugins)) {
        return array_diff($plugins, ['wpemoji']);
    } else {
        return [];
    }
}

add_action('init', 'supernova_init', 3);

function supernova_init() {
    remove_action('set_comment_cookies', 'wp_set_comment_cookies');
    remove_filter('the_content', 'prepend_attachment');

    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    remove_action('init', 'smilies_init', 5);

    remove_filter('comment_text', 'make_clickable', 9);
    remove_filter('the_content', 'convert_bbcode');
    remove_filter('the_content', 'convert_gmcode');
    remove_filter('the_content', 'convert_smilies');
    remove_filter('the_content', 'convert_chars');

    add_filter('option_use_smilies', function(){ return false; });
    add_filter('emoji_svg_url', '__return_false');
}

global $wp_taxonomies;

unset($wp_taxonomies['link_category']);
unset($wp_taxonomies['post_format']);

remove_filter('the_title', 'capital_P_dangit', 11);
remove_filter('the_content', 'capital_P_dangit', 11);
remove_filter('comment_text', 'capital_P_dangit', 31);

remove_action('do_pings', 'do_all_pings');
add_filter('bloginfo_url', 'supernova_remove_pingback_url', 10, 2);
add_filter('wp_headers', 'supernova_remove_x_pingback');

add_filter('use_default_gallery_style', '__return_false');

function supernova_remove_x_pingback($headers) {
    unset($headers['X-Pingback']);

    return $headers;
}
function supernova_remove_pingback_url($output, $show) {
    if ($show == 'pingback_url') {
        $output = '';
    }

    return $output;
}



/**
 * Remove Yoast SEO Social Profiles From All Users
 */
add_filter('user_contactmethods', 'saturn_remove_yoast_user_social');

function saturn_remove_yoast_user_social ($contactmethods) {
    unset($contactmethods['facebook']);
    unset($contactmethods['instagram']);
    unset($contactmethods['linkedin']);
    unset($contactmethods['myspace']);
    unset($contactmethods['pinterest']);
    unset($contactmethods['soundcloud']);
    unset($contactmethods['tumblr']);
    unset($contactmethods['twitter']);
    unset($contactmethods['youtube']);
    unset($contactmethods['wikipedia']);

    return $contactmethods;
}
