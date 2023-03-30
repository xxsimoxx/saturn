<?php
get_header();

$county_object = get_queried_object();

$county_name = $county_object->name;
$county_slug = sanitize_title( $county_object->name );

/**
 * County taxonomy template
 *
 */
?>

<div class="wrap wrap--landing-page">
    <?php
    $reusable_block_id = get_term_meta( $county_object->term_id, 'reusable_block_county_id', true );

    if ( (int) $reusable_block_id > 0 ) {
        $reusable_block_county = get_post( $reusable_block_id );

        echo apply_filters( 'the_content', $reusable_block_county->post_content );
    } else {
        // Filler
        echo '<div style="height:128px" aria-hidden="true" class="wp-block-spacer"></div>';
        echo '<h1>Property in ' . $county_name . '</h1>';
        echo wpautop( $county_object->description );
    }

    echo do_shortcode( '[property-grid county="' . $county_slug . '" count="48"]' );
    ?>
</div>

<?php
get_footer();
