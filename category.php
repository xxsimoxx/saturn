<?php get_header(); ?>

<div class="wrap-inner">
    <h1 class="entry-title"><?php echo single_cat_title(); ?></h1>
    <div class="has-medium-font-size"><?php echo category_description(); ?></div>

    <div class="flex-container-updated">
        <?php if (have_posts()) : while (have_posts()): the_post(); ?>
            <div class="supernova-blog-item flex-item-updated flex-item-padding">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('homepage_grid'); ?>
                </a>
                <h3>
                    <a href="<?php the_permalink(); ?>" class="supernova-blog-link"><?php the_title(); ?></a>
                    <span class="supernova-blog-meta">
                        <?php echo getSupernovaPostViews(get_the_ID()); ?>
                        <?php if (function_exists('the_ratings')) {
                            /*
                            $average = get_post_meta(get_the_ID(), 'ratings_average', true);
                            $score = get_post_meta(get_the_ID(), 'ratings_score', true);
                            /**/
                            $totalVotes = get_post_meta(get_the_ID(), 'ratings_users', true);
                            $totalVotes = !empty($totalVotes) ? $totalVotes : 0;
                            $totalVotesRatings = ((int) $totalVotes === 1) ? ' rating' : ' ratings';

                            echo ' | ' . $totalVotes . $totalVotesRatings;
                        } ?>
                    </span>
                    <?php echo get_the_category_list(); ?>
                </h3>

                <div class="supernova-blog-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            </div>
        <?php endwhile; endif; ?>
    </div>

    <div class="supernova-cat-pagination">
        <?php previous_posts_link(); ?>
        <?php next_posts_link(); ?>
    </div>
</div>

<?php get_footer();
