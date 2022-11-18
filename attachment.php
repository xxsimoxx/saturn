<?php
get_header();

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        ?>
        <div class="wrap-inner">
            <div class="wrap-content">
                <div class="attachment-image">
                    <?php
                    $image_size = apply_filters( 'wporg_attachment_size', 'saturn-fullwidth' );

                    echo wp_get_attachment_image( get_the_ID(), $image_size );
                    ?>
                </div>

                <?php the_content(); ?>
            </div>
        </div>
        <?php
    }
}

get_footer();
