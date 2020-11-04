<?php
function slider_enqueue() {
    wp_enqueue_style('slider', get_stylesheet_directory_uri() . '/modules/slider/slider.css', [], '1.0.1');

    wp_enqueue_script('flickity', get_stylesheet_directory_uri() . '/modules/slider/flickity.pkgd.min.js', [], '2.2.1', true);

    wp_enqueue_script('slider', get_stylesheet_directory_uri() . '/slider.js', ['flickity'], '1.0.1', true);
    wp_localize_script('slider', 'ajaxVar', [
        'ajaxurl' => admin_url('admin-ajax.php')
    ]);
}
add_action('wp_enqueue_scripts', 'slider_enqueue');



function show_slider($atts) {
    $attributes = shortcode_atts([
        'mobile' => 0,
        'controls' => 'yes',
        'fullheight' => 'no',
        'fullwidth' => 'yes',
        'fullsize' => 'no',
        'zoom' => 'no',
        'ids' => '',
        'interval' => 5000,
        'height' => 600
    ], $atts);

    $out = '<div class="slider-wrap">
        ' . simple_slider_helper($attributes['ids'], $attributes['mobile'], $attributes['height'], $attributes['zoom'], $attributes['fullheight'], $attributes['fullwidth'], $attributes['fullsize'], $attributes['controls'], $attributes['interval']) . '
    </div>';

    return $out;
}

add_shortcode('slider', 'show_slider');



function simple_slider_helper($ids, $mobileIds, $height, $zoom, $fullheight, $fullwidth, $fullsize, $controls, $interval) {
    $out = '';

    $idArray = [];
    $mobileIdArray = [];

    if ((string) $ids !== '') {
        $idArray = array_map('trim', explode(',', $ids));
        $idArray = array_filter($idArray);
    }

    if ((string) $mobileIds !== '') {
        $mobileIdArray = array_map('trim', explode(',', $mobileIds));
        $mobileIdArray = array_filter($mobileIdArray);
    }

    $controls = ((string) $controls === 'yes') ? 'true' : 'false';
    $interval = (int) $interval;

    $homepageHeroHeight = ((string) $fullheight === 'yes') ? 'fullvh' : '';
    $homepageHeroWidth = ((string) $fullwidth === 'yes') ? 'supernova-fullwidth' : '';

    $height = ($height > 0) ? $height : 600;

    $out .= '<style>.slider-wrap { min-height: ' . $height . 'px; } .slider .slide { height: ' . $height . 'px; }</style>';

    $out .= '<div class="slider ' . $homepageHeroWidth . ' homepage-hero ' . $homepageHeroHeight . '">
        <div class="homepage-hero-slider" data-flickity=\'{ "contain": true, "imagesLoaded": true, "adaptiveHeight": false, "lazyLoad": true, "pageDots": false, "pauseAutoPlayOnHover": false, "wrapAround": true, "fade": true, "groupCells": true, "groupCells": 1, "fullscreen": false, "autoPlay": ' . $interval . ', "prevNextButtons": ' . $controls . ' }\'>';
            $args = [
                'post_type' => 'slide',
                'posts_per_page' => 16,
                'order' => 'ASC',
                'orderby' => 'menu_order',
                'no_found_rows' => true,
                'update_post_term_cache' => false
            ];

            if (wp_is_mobile() && (string) $mobileIdArray !== '') {
                $args['post__in'] = $mobileIdArray;
            } else {
                if ((string) $ids !== '') {
                    $args['post__in'] = $idArray;
                }
            }

            $the_query = new WP_Query($args);

            if ($the_query->have_posts()) {
                while ($the_query->have_posts()) {
                    $the_query->the_post();

                    $heroSize = 'homepage_hero';
                    if ((string) $fullsize === 'yes') {
                        $heroSize = 'full';
                    }
                    $hero = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $heroSize);
                    $hero = $hero[0];
                    if ((string) get_post_meta(get_the_ID(), '_hero_property_image', true) !== '') {
                        $hero = get_post_meta(get_the_ID(), '_hero_property_image', true);
                    }

                    $dataVideo = '';
                    $slideContent = do_shortcode(get_the_content(get_the_ID()));
                    if (!empty(get_post_meta(get_the_ID(), 'slide-video', true))) {
                        $dataVideo = '<video playsinline autoplay muted loop src="' . trim(get_post_meta(get_the_ID(), 'slide-video', true)) . '" poster="' . $hero . '" type="video/mp4" width="100%" height="100%"></video>';
                    }
                    $zoomContent = ((string) $zoom === 'yes') ? '<div class="slide-inner-zoom" style="background: url(' . $hero . ') no-repeat center center; background-size: cover;"></div>' : '';

                    $out .= '<div class="slide slide-' . get_the_ID() . ' block" style="background: url(' . $hero . ') no-repeat center center; background-size: cover;">' .
                        $zoomContent .
                        $dataVideo .

                        '<div class="wrap">' .
                            $slideContent .
                        '</div>
                    </div>';
                }
            }

        $out .= '</div>
    </div>';

    return $out;
}



function show_flickity_gallery($propertyId) {
    $imageArray = get_post_meta($propertyId, 'detail_images_array', true);
    $imageArray = array_map('trim', explode(',', $imageArray));
    $imageArray = array_filter($imageArray);

    $imageTitle = get_the_title($propertyId);

    $wrapAround = ((int) get_option('flickity_wrapAround') === 1) ? 'true' : 'false';
    $groupCells = ((int) get_option('flickity_groupCells') === 1) ? 'true' : 'false';
    $groupCellsValue = ((int) get_option('flickity_groupCellsValue') > 0) ? (int) get_option('flickity_groupCellsValue') : 'false';
    $autoPlay = ((int) get_option('flickity_autoPlay') > 0) ? (int) get_option('flickity_autoPlay') : 'false';

    $out = '<div class="flickity-carousel supernova-fullwidth" data-flickity=\'{ "contain": true, "imagesLoaded": true, "adaptiveHeight": false, "lazyLoad": true, "pageDots": false, "wrapAround": ' . $wrapAround . ', "groupCells": ' . $groupCells . ', "groupCells": ' . $groupCellsValue . ', "fullscreen": true, "autoplay": ' . $autoPlay . ' }\'>';
        foreach ($imageArray as $imageUri) {
            $imageUri = wppd_image_downsize($imageUri, false, ['h' => '720']);

            $out .= '<div class="carousel-cell">
                <img loading="eager" src="' . $imageUri . '" height="480" alt="' . $imageTitle . '" title="' . $imageTitle . '">
            </div>';
        }
    $out .= '</div>';

    echo $out;
}

function show_flickity_parsley_gallery($propertyId) {
    $imageArray = get_post_meta($propertyId, 'detail_images_array', true);
    $imageArray = array_map('trim', explode(',', $imageArray));
    $imageArray = array_filter($imageArray);

    $imageTitle = get_the_title($propertyId);

    $autoPlay = ((int) get_option('flickity_autoPlay') > 0) ? (int) get_option('flickity_autoPlay') : 'false';

    $out = '<div class="flickity-carousel-parsley--wrap">';

    $out .= '<div class="flickity-carousel flickity-carousel-parsley supernova-fullwidth" data-flickity=\'{ "contain": true, "imagesLoaded": true, "adaptiveHeight": false, "lazyLoad": true, "pageDots": false, "wrapAround": true, "groupCells": true, "groupCells": 1, "fullscreen": true, "autoplay": ' . $autoPlay . ' }\'>';
        foreach ($imageArray as $imageUri) {
            $imageUri = wppd_remove_var($imageUri, 'w');
            $imageUri = wppd_remove_var($imageUri, 'h');
            $imageUri = wppd_add_var($imageUri, 'w', '1920');
            $imageUri = wppd_add_var($imageUri, 'h', '1440');

            $out .= '<div class="carousel-cell">
                <img loading="eager" src="' . $imageUri . '" height="720" alt="' . $imageTitle . '" title="' . $imageTitle . '">
            </div>';
        }
    $out .= '</div>';
    $out .= '<div class="flickity-carousel-parsley--elements">
        <ul>
            <li class="flickity-view-fullscreen--wrap"><a href="#" id="flickity-view-fullscreen">Gallery</a></li>
            <li>' . get_map_modal($propertyId) . '</li>
    </div>';
    $out .= '</div>';

    echo $out;
}
