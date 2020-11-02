<?php
function wppd_import_reviews() {
    $wppd_google_places_api = get_option('wppd_google_places_api');
    $wppd_google_place_id = get_option('wppd_google_place_id');

    $url = 'https://maps.googleapis.com/maps/api/place/details/json?placeid=' . $wppd_google_place_id . '&key=' . $wppd_google_places_api;

    try {
        $reviewsArray = wp_remote_get($url, [
            'timeout' => 600,
            'httpversion' => '2.0'
        ]);
        $reviewsArray = wp_remote_retrieve_body($reviewsArray);
        $reviewsArray = json_decode($reviewsArray);
    } catch (Exception $e) {
        echo 'Whoops, looks like something ain\'t quite right.';
    }

    foreach ($reviewsArray->result->reviews as $review) {
        // Check if review already exists
        $reviewExists = get_page_by_title(wp_strip_all_tags($review->author_name), OBJECT, 'review');

        // If it doesn't, create it
        if (is_null($reviewExists)) {
            $googleReview = [
                'post_title' => wp_strip_all_tags($review->author_name),
                'post_content' => '<!-- wp:paragraph -->' . $review->text . '<!-- /wp:paragraph -->',
                'post_status' => 'publish',
                'post_author' => 1,
                'post_type' => 'review',
                'post_date' => date('Y-m-d H:i:s', $review->time),
            ];
        
            $reviewId = wp_insert_post($googleReview);

            add_post_meta($reviewId, '_rating', $review->rating);
            add_post_meta($reviewId, '_source', 'google');
        }
    }
}



function wppd_display_reviews($atts) {
    $attributes = shortcode_atts([
        'count' => -1
    ], $atts);

    $out = '';

    $args = [
        'post_type' => 'review',
        'posts_per_page' => $attributes['count'],
        'meta_query' => [
            [
                'key' => '_rating',
                'value' => '5',
                'compare' => '='
            ]
        ]
    ];

    $reviewsQuery = new WP_Query($args);

    if ($reviewsQuery->have_posts()) {
        $out = '<div class="homepage-grid wrap">';
            while ($reviewsQuery->have_posts()) {
                $reviewsQuery->the_post();

                $rating = '';
                $stars = get_post_meta(get_the_ID(), '_rating', true);
                if ((int) $stars > 0) {
                    for ($i = 1; $i <= (int) $stars; $i++) {
                        $rating .= '⭐';
                    }
                }

                $out .= '<blockquote class="wp-block-quote is-style-default">
                    ' . get_the_content() . '
                    <cite>' . $rating . ' ' . get_the_title() . '</cite>
                </blockquote>';
            }
        $out .= '</div>';
    }

    return $out;
}


add_shortcode('reviews', 'wppd_display_reviews');
