<?php
get_header();

$saturn_page_title_alignment = (string) get_option( 'saturn_page_title_alignment' ) !== '' ? get_option( 'saturn_page_title_alignment' ) : 'aligncenter';
?>

<div class="wrap-inner">
    <h1 class="entry-title <?php echo $saturn_page_title_alignment; ?>"><?php echo single_cat_title(); ?></h1>
    <div class="has-medium-font-size"><?php echo category_description(); ?></div>

    <?php if ( (int) get_option( 'use_blog_search' ) === 1 ) { ?>
        <form action="<?php echo home_url( '/' ); ?>" class="search-form" method="get">
            <p>
                <input type="search" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Quick search...">
                <input type="hidden" value="post" name="post_type" id="post_type">
                <input type="submit" value="Search">
            </p>
        </form>
    <?php } ?>

    <div class="flex-container-updated">
        <?php
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();
                ?>
                <div class="saturn-blog-item flex-item-updated flex-item-padding">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'homepage_grid' ); ?>
                    </a>
                    <h3>
                        <a href="<?php the_permalink(); ?>" class="saturn-blog-link"><?php the_title(); ?></a>
                        <span class="saturn-blog-meta">
                            <?php echo getSaturnPostViews( get_the_ID() ); ?>
                        </span>
                        <?php echo get_the_category_list(); ?>
                    </h3>

                    <div class="saturn-blog-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <div class="saturn-cat-pagination">
        <?php previous_posts_link(); ?>
        <?php next_posts_link(); ?>
    </div>
</div>

<?php
get_footer();
