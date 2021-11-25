<?php
get_header();

$areaObject = get_queried_object();

$areaName = $areaObject->name;
$areaSlug = sanitize_title($areaObject->name);

/**
 * Area taxonomy template
 *
 */
?>

<div class="wrap wrap--landing-page">
    <?php
    $reusableBlockAreaId = get_term_meta($areaObject->term_id, 'reusable_block_area_id', true);
    if ((int) $reusableBlockAreaId > 0) {
        $reusableBlockArea = get_post($reusableBlockAreaId);

        echo apply_filters('the_content', $reusableBlockArea->post_content);
    } else {
        // Filler
        echo '<div style="height:128px" aria-hidden="true" class="wp-block-spacer"></div>';
        echo '<h1>Property in ' . $areaName . '</h1>';
        echo wpautop($areaObject->description);
    }

    echo do_shortcode('[property-grid location="' . $areaSlug . '" count="48"]');
    ?>
</div>

<?php get_footer();
