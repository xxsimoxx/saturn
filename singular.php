<?php
get_header();

if (have_posts()): while (have_posts()): the_post(); ?>
    <div class="wrap-inner">
        <h1 class="entry-title"><?php the_title(); ?></h1>

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
<?php
endwhile; endif;

get_footer();
