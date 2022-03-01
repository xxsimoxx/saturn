<?php
/**
 * Saturn Testimonial Grid
 */
function saturn_testimonials() {
    $args = [
        'post_type' => 'testimonial',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'menu_order'
    ];
    $testimonials = new WP_Query($args);

    $out = '<div class="flex-container-updated">';

    if ($testimonials->have_posts()) {
        while ($testimonials->have_posts()) {
            $testimonials->the_post();

            $testimonialThumbnail = '';
            if (has_post_thumbnail()) {
                $testimonialThumbnail = get_the_post_thumbnail(get_the_ID(), 'homepage_grid');
            }
            $testimonialAuthor = get_post_meta($testimonials->post->ID, 'testimonial-author', true);
            $testimonialContent = get_the_excerpt();

            $out .= '<div class="flex-item-updated flex-item-padding testimonials-grid">
                ' . $testimonialThumbnail . '
                <cite>' . $testimonialContent . '</cite>
                <p><em>&mdash; ' . $testimonialAuthor . '</em></p>
            </div>';
        }
    }
    $out .= '</div>';

    return $out;
}



/**
 * Saturn Testimonials (Blocks)
 */
function saturn_testimonial_blocks() {
    $args = [
        'post_type' => 'testimonial',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'menu_order'
    ];
    $testimonials = new WP_Query($args);

    $out = '';

    if ($testimonials->have_posts()) {
        while ($testimonials->have_posts()) {
            $testimonials->the_post();

            $testimonialID = $testimonials->post->ID;

            $testimonialAuthor = get_post_meta($testimonialID, 'testimonial-author', true);
            $testimonialContent = wpautop(get_the_content($testimonialID));

            $out .= '<h3 class="has-text-align-center">' . get_the_title($testimonialID) . '</h3>
            <blockquote class="wp-block-quote">' .
                $testimonialContent .
                '<cite>' . $testimonialAuthor . '</cite>
            </blockquote>
            <div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>';
        }
    }

    return $out;
}



/**
 * Saturn Testimonials (Blocks, Alt)
 */
function saturn_testimonial_blocks_carousel() {
    $attributes = shortcode_atts([
        'count' => 12
    ], $atts);

    $args = [
        'post_type' => 'testimonial',
        'posts_per_page' => (int) $attributes['count'],
        'order' => 'ASC',
        'orderby' => 'menu_order'
    ];
    $testimonials = new WP_Query($args);

    $out = '';

    if ($testimonials->have_posts()) {
        $out .= '<section class="saturn-testimonial-blocks-carousel main-carousel" data-flickity=\'{"controls": true, "draggable": true, "wrapAround": true }\'>';

            while ($testimonials->have_posts()) {
                $testimonials->the_post();

                $testimonialID = $testimonials->post->ID;

                $testimonialAuthor = get_post_meta($testimonialID, 'testimonial-author', true);
                $testimonialEmail = get_post_meta($testimonialID, 'testimonial-email', true);
                $testimonialLinkedIn = get_post_meta($testimonialID, 'testimonial-linkedin', true);
                $testimonialContent = wpautop(get_the_content($testimonialID));

                $testimonialLinkedIn = ((string) $testimonialLinkedIn !== '') ? ' <a class="saturn-testimonial--linkedin" href="' . $testimonialLinkedIn . '" rel="external noopener" target="_blank"><i class="icofont-linkedin"></i></a>' : '';

                $out .= '<div class="carousel-cell">
                    ' . $testimonialContent . '
                    <div class="wp-block-media-text" style="grid-template-columns:16% auto;">
                        <figure class="wp-block-media-text__media">' . get_the_post_thumbnail($testimonialID, [48, 48]) . '</figure>
                        <div class="wp-block-media-text__content">
                            <p style="line-height:1"><strong>' . get_the_title($testimonialID) . '</strong>' . $testimonialLinkedIn . '</p>
                            <p class="has-small-font-size" style="line-height:1">' . $testimonialAuthor . '</p>
                        </div>
                    </div>
                </div>';
            }

        $out .= '</section>';
    }

    return $out;
}



/**
 * Saturn Testimonial Carousel
 */
function saturn_testimonial_carousel($atts, $content = null) {
    $attributes = shortcode_atts([
        'in' => '',
        'type' => '',
        'autoplay' => ''
    ], $atts);

    $args = [
        'post_type' => 'testimonial',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'menu_order'
    ];

    if ((string) $attributes['type'] !== '') {
        $type = sanitize_title($attributes['type']);

        $args['tax_query'] = [
            [
                'taxonomy' => 'testimonial_type',
                'field'    => 'slug',
                'terms'    => $type
            ]
        ];
    }

    if ((string) $attributes['in'] !== '') {
        $in = explode(',', $attributes['in']);
        $in = array_filter($in);

        $args['post__in'] = $in;
    }

    $testimonials = new WP_Query($args);

    $autoPlay = sanitize_title($attributes['autoplay']);
    $autoPlay = ($autoPlay !== '') ? $autoPlay : 'false';

    $out = '<section class="saturn-testimonials" data-flickity=\'{"adaptiveHeight": true, "pageDots": false, "contain": true, "controls": true, "imagesLoaded": true, "draggable": true, "wrapAround": true, "groupCells": 1, "autoPlay": ' . $autoPlay . ' }\'>';

        if ($testimonials->have_posts()) {
            while ($testimonials->have_posts()) {
                $testimonials->the_post();

                $testimonialThumbnail = '';
                if (has_post_thumbnail()) {
                    $testimonialThumbnail = get_the_post_thumbnail(get_the_ID(), 'thumbnail');
                }
                
                $testimonialAuthor = get_post_meta($testimonials->post->ID, 'testimonial-author', true);
                $testimonialContent = wpautop(get_the_content());

                $out .= '<div class="testimonial-body">
                    <div class="img">' . $testimonialThumbnail . '</div>
                    <div class="testimonial-quote">' . $testimonialContent . '</div>';

                    if ($testimonialAuthor !== '') {
                        $out .= '<p class="testimonial-cite"><em>&mdash; ' . $testimonialAuthor . '</em></p>';
                    }
                $out .= '</div>';
             }
         }

    $out .= '</section>';

    return $out;
}

function new_excerpt_more($more) {
    global $post;

    return '&hellip; <a href="'. get_permalink($post->ID) . '">Read More</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');



add_shortcode('supernova-testimonials', 'saturn_testimonials');
add_shortcode('supernova-testimonial-carousel', 'saturn_testimonial_carousel');
add_shortcode('supernova-testimonial-blocks', 'saturn_testimonial_blocks');
add_shortcode('saturn-testimonial-blocks-carousel', 'saturn_testimonial_blocks_carousel');



// Do not show testimonials in core sitemap
add_action('wp_sitemaps_init', function ($wp_sitemaps) {
    add_filter('wp_sitemaps_post_types', function ($post_types) {
        unset($post_types['testimonial']);

        return $post_types;
    });
});
