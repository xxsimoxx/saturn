<?php
get_header();

$area_object = get_queried_object();

$area_name = $area_object->name;
$area_slug = sanitize_title( $area_object->name );

/**
 * Area taxonomy template
 *
 */
?>

<div class="wrap wrap--landing-page">
    <?php
    $reusable_block_id = get_term_meta( $area_object->term_id, 'reusable_block_area_id', true );

    if ( (int) $reusable_block_id > 0 ) {
        $reusable_block_area = get_post( $reusable_block_id );

        echo apply_filters( 'the_content', $reusable_block_area->post_content );
    } else {
        // Filler
        echo '<div style="height:128px" aria-hidden="true" class="wp-block-spacer"></div>';
        echo '<h1>Property in ' . $area_name . '</h1>';
        echo wpautop( $area_object->description );
    }

    echo do_shortcode( '[property-grid location="' . $area_slug . '" count="48"]' );
    ?>
</div>

<?php
get_footer();
