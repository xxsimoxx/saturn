<?php
get_header();

$countyObject = get_queried_object();

$countyName = $countyObject->name;
$countySlug = sanitize_title($countyObject->name);

/**
 * County taxonomy template
 *
 */
?>

<div class="wrap wrap--landing-page">
    <?php
    $reusableBlockCountyId = get_term_meta($countyObject->term_id, 'reusable_block_county_id', true);
    if ((int) $reusableBlockCountyId > 0) {
        $reusableBlockCounty = get_post($reusableBlockCountyId);

        echo apply_filters('the_content', $reusableBlockCounty->post_content);
    } else {
        // Filler
        echo '<div style="height:128px" aria-hidden="true" class="wp-block-spacer"></div>';
        echo '<h1>Property in ' . $countyName . '</h1>';
        echo wpautop($countyObject->description);
    }

    echo do_shortcode('[property-grid county="' . $countySlug . '" count="48"]');
    ?>
</div>

<?php get_footer();
