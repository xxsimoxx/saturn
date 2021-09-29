<?php
add_action('init', 'saturn_init', 3);

function saturn_init() {
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



/**
 * Remove Yoast SEO Social Profiles From All Users
 */
add_filter('user_contactmethods', 'saturn_remove_yoast_user_social');

function saturn_remove_yoast_user_social($contactmethods) {
    unset($contactmethods['facebook']);
    unset($contactmethods['instagram']);
    //unset($contactmethods['linkedin']);
    unset($contactmethods['myspace']);
    unset($contactmethods['pinterest']);
    unset($contactmethods['soundcloud']);
    unset($contactmethods['tumblr']);
    unset($contactmethods['twitter']);
    unset($contactmethods['youtube']);
    unset($contactmethods['wikipedia']);

    return $contactmethods;
}
