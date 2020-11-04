<?php
/**
 * Template Name: Has Sidebar
 * Template Post Type: post
 */

get_header();

if (have_posts()): while (have_posts()): the_post(); ?>
    <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'supernova-fullwidth hidden']); ?>

    <div class="wrap-inner wrap-inner-has-sidebar thin-ui-grid">
        <div class="thin-ui-col-12">
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </div>

        <div class="thin-ui-col-8">
            <div class="wrap-content">
                <?php
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                }

                /**
                 * Jetpack sharing buttons
                 */
                if (function_exists('sharing_display')) {
                    echo sharing_display();
                }

                the_content();

                setSupernovaPostViews(get_the_ID());
                ?>
            </div>
        </div>
        <div class="thin-ui-col-4">
            <?php
            if ((int) get_option('reusable_block_post_sidebar_id') > 0) {
                $reusableBlockPostSidebarId = get_post((int) get_option('reusable_block_post_sidebar_id'));

                echo apply_filters('the_content', $reusableBlockPostSidebarId->post_content);
            }
            ?>
        </div>
    </div>
<?php
endwhile; endif;

get_footer();
