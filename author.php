<?php
get_header();

$curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) );
?>

<div class="wrap-inner">
    <div class="wrap-content" data-title="<?php echo get_the_title(); ?>">
        <h1 class="entry-title"><?php echo $curauth->display_name; ?></h1>

        <div class="wrap-content-inner">

            <?php
            if ( function_exists( 'yoast_breadcrumb' ) && ! empty( get_option( 'wpseo_titles' )['breadcrumbs-enable'] ) ) {
                yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
            }

            if ( ! empty( $curauth->user_description ) ) {
                ?>
                <p><?php echo $curauth->user_description; ?></p>
                <?php
            }

            if ( ! empty( $curauth->user_url ) ) {
                ?>
                <p><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></p>
                <?php
            }
            ?>

            <h2>Posts by <?php echo $curauth->display_name; ?>:</h2>

            <ul>
                <?php
                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        ?>
                        <li>
                            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                            <br><small><?php the_time( 'd M Y' ); ?> in <?php the_category( ', ' ); ?></small>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <p><?php _e( 'No posts by this author.' ); ?></p>
                    <?php
                }
                ?>
            </ul>

        </div>
    </div>
</div>

<script type="application/ld+json">
{
    "@context": "https://schema.org/",
    "@type": "Person",
    "name": "<?php echo $curauth->display_name; ?>",
    "url": "<?php echo $curauth->user_url; ?>",
    "image": "<?php echo get_avatar( $curauth->user_email ); ?>",
    "worksFor": {
        "@type": "Organization",
        "name": "<?php echo get_bloginfo( 'name' ); ?>"
    }
}
</script>

<?php
get_footer();
