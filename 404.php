<?php
header("HTTP/1.0 404 Not Found");

get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post(); ?>
        <div class="wrap-inner">
            <div class="wrap-content" data-title="<?php echo get_the_title(); ?>">
                <h1 class="entry-title">404 Not Found</h1>

                <div class="wrap-content-inner">
                    <p>Ooops, looks like the page you are trying to reach is no longer available. Please check the URL for proper spelling and capitalisation.</p>
                    <p>If you're having trouble locating a destination, go to the home page or search below.</p>

                    <form action="/" method="get">
                        <label for="search">Search in <?php echo home_url('/'); ?></label>
                        <input type="text" name="s" id="search" value="<?php the_search_query(); ?>">
                        <input type="submit" alt="Search" value="Search">
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
}

get_footer();
