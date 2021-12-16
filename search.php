<?php get_header(); ?>

<div class="wrap-inner">
    <h2 class="saturn-search-header">
        <span class="search-page-title"><?php printf('Search Results for: %s', '<span>' . get_search_query() . '</span>' ); ?></span>
    </h2>
    <p><small><?php echo $wp_query->found_posts; ?> results</small></p>
    <hr>

    <?php if (have_posts()) : while (have_posts()): the_post(); ?>
        <div class="saturn-search-result">
            <div>
                <small><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></small>
            </div>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

            <div class="saturn-search-result-excerpt">
                <?php the_excerpt(); ?>
                <span class="saturn-blog-meta">
                    <?php echo getSaturnPostViews(get_the_ID()); ?>
                </span>
            </div>
        </div>
    <?php endwhile; endif; ?>

    <div class="clearboth"></div>
</div>

<?php get_footer();
