<?php
get_header();

if (have_posts()): while (have_posts()): the_post(); ?>
    <div class="wrap-inner">
        <h1 class="entry-title"><?php the_title(); ?></h1>

        <div class="wrap-content">
            <div class="item-thumbnail" style="text-align: center; padding: 24px;"><?php echo get_the_post_thumbnail(get_the_ID(), 'large'); ?></div>

            <div class="item-date"><?php echo get_the_date(get_option('date_format_custom')); ?> <a href="<?php echo get_permalink(); ?>">#</a></div>

            <?php the_content(); ?>
        </div>
    </div>
<?php
endwhile; endif;

get_footer();
