<?php get_header(); ?>

<div class="wrap-inner">
    <?php if ( have_posts() ) : while (have_posts()): the_post(); ?>
        <div class="saturn-blog-item one_third">
            <?php the_post_thumbnail('thumbnail'); ?>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

            <div class="saturn-excerpt">
                <?php echo the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>">Read more</a>
            </div>
        </div>
    <?php endwhile; endif; ?>

    <div class="clearboth"></div>
</div>

<?php get_footer();
