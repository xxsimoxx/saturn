<?php
get_header();

if (have_posts()): while (have_posts()): the_post(); ?>
    <div class="wrap-inner">
        <div class="wrap-content">
			<div class="attachment-image">
				<?php
				$imageSize = apply_filters('wporg_attachment_size', 'saturn-fullwidth');

				echo wp_get_attachment_image(get_the_ID(), $imageSize);
				?>
			</div>

			<?php the_content(); ?>
        </div>
    </div>
<?php
endwhile; endif;

get_footer();
