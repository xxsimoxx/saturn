<?php
get_header();

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();

        $saturn_page_title_alignment = (string) get_option( 'saturn_page_title_alignment' ) !== '' ? get_option( 'saturn_page_title_alignment' ) : 'aligncenter';
        ?>
        <div class="wrap-inner">
            <div class="wrap-content" data-title="<?php echo get_the_title(); ?>">
                <h1 class="entry-title <?php echo $saturn_page_title_alignment; ?>"><?php the_title(); ?></h1>

                <div class="wrap-content-inner">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
        <?php
    }
}

get_footer();
