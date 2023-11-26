<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<div class="wrap wrap-inner">
    <?php
    /**
     * woocommerce_before_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
     */
    do_action( 'woocommerce_before_main_content' );
    ?>

    <?php while ( have_posts() ) : ?>
        <?php the_post(); ?>

        <?php wc_get_template_part( 'content', 'single-product' ); ?>

    <?php endwhile; // end of the loop. ?>

    <?php
    /**
     * Cross-sell products
     */
    ?>

    <div class="related">
        <?php
        // Customised: Show cross-sells on single product pages, under the attributes and short description
        global $post;

        $crosssells = get_post_meta( $post->ID, '_crosssell_ids', true );

        if ( $crosssells ) {
            echo '<h2>Related products</h2>';
            echo '<ul>';
            foreach ($crosssells as $item) {
                // WP_Query arguments
                $args = array (
                    'p'                      => $item,
                    'post_type'              => array( 'product' ),
                    'post_status'            => array( 'publish' ),
                );
                // The Query
                $related = new WP_Query( $args );
                // The Loop
                if ( $related->have_posts() ) {
                    while ( $related->have_posts() ) {
                        $related->the_post();
                        ?>
                            <li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
                        <?php
                    }
                } else {
                    // no posts found
                }
                // Restore original Post Data
                wp_reset_postdata();
            }
            echo '</ul>';
        }
        ?>
    </div>

    <?php
    /**
     * woocommerce_after_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action( 'woocommerce_after_main_content' );
    ?>
</div>

<?php
get_footer( 'shop' );
