<?php
get_header();

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        ?>
        <div class="wrap-inner ip-main">
            <div id="post-<?php the_ID(); ?>" <?php post_class( 'wrap-content' ); ?>>
                <?php
                /* BEGIN IMAGEPRESS CODE */
                /* main image display (required) */
                if ( function_exists( 'imagepress_main' ) ) {
                    imagepress_main( get_the_ID() );
                }

                /* related images (optional, can be placed in the sidebar) */
                if ( function_exists( 'imagepress_related' ) ) {
                    echo imagepress_related( get_the_ID() );
                }
                /* END IMAGEPRESS CODE */
                ?>
            </div>
        </div>
        <?php
    }
}

get_footer();
