<?php
get_header();

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();

        $saturn_page_title_alignment = (string) get_option( 'saturn_page_title_alignment' ) !== '' ? get_option( 'saturn_page_title_alignment' ) : 'aligncenter';
        ?>
        <div class="wrap-inner">
            <h1 class="entry-title <?php echo $saturn_page_title_alignment; ?>"><?php the_title(); ?></h1>

            <div class="wrap-content">
                <?php
                if ( function_exists( 'yoast_breadcrumb' ) ) {
                    yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
                }

                /**
                 * Jetpack sharing buttons
                 */
                if ( function_exists( 'sharing_display' ) ) {
                    echo sharing_display();
                }

                /**
                 * WP-PostRatings
                 */
                if ( function_exists( 'the_ratings' ) ) {
                    the_ratings();
                }

                do_action( 'before_post_content', get_the_ID() );

                the_content();

                if ( (int) get_option( 'use_author_box' ) === 1 ) {
                    ?>
                    <div class="saturn-author-box">
                        <div class="saturn-author-avatar" itemscope itemprop="image" alt="Photo of <?php the_author_meta( 'display_name' ); ?>">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 128 ); ?>
                        </div>
                        <div class="saturn-author-info vcard author" itemprop="url" rel="author">
                            <div class="saturn-author-title" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="fn" itemprop="name">
                                    <span itemprop="author" itemscope itemtype="https://schema.org/Person">
                                        <span itemprop="name"><?php the_author_meta( 'display_name' ); ?></span>
                                    </span>
                                </a>
                            </div>
                            <div class="saturn-author-summary">
                                <p class="saturn-author-description"><?php echo wp_kses( get_the_author_meta( 'description' ), null ); ?></p></div>
                            <div class="saturn-author-links">
                        </div>
                    </div>
                    <?php
                }

                setSaturnPostViews( get_the_ID() );
                ?>
            </div>
        </div>
        <?php
    }
}

get_footer();
