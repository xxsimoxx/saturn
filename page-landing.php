<?php
/*
 * Template Name: Landing Page
 */

get_header();

if (have_posts()): while (have_posts()): the_post(); ?>

<div class="wrap wrap--landing-page">
    <?php the_content(); ?>
</div>

<?php
endwhile; endif;

get_footer();
