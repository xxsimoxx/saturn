<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=no">

<?php if ( (int) get_option( 'use_native_fonts' ) !== 1 && ( (string) get_option( 'heading_font' ) !== '0' || (string) get_option( 'body_font' ) !== '0' ) ) { ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php } ?>

<style>
:root {
    <?php if ( (int) get_option( 'use_native_fonts' ) !== 1 && ( (string) get_option( 'heading_font' ) !== '0' || (string) get_option( 'body_font' ) !== '0' ) ) { ?>
        --body_font: "<?php echo str_replace( '+', ' ', get_option( 'body_font' ) ); ?>";
        <?php if ( (string) get_option( 'heading_font' ) !== '0' && (string) get_option( 'heading_font' ) !== '' ) { ?>
            --heading_font: "<?php echo str_replace( '+', ' ', get_option( 'heading_font' ) ); ?>";
        <?php } else { ?>
            --heading_font: "<?php echo str_replace( '+', ' ', get_option( 'body_font' ) ); ?>";
        <?php } ?>
    <?php } else { ?>
        --body_font: var(--font_default);
        --heading_font: var(--font_default);
    <?php } ?>

    --content_width: <?php echo get_option( 'content_width' ); ?>px;
    --wp--style--global--content-size: <?php echo get_option( 'content_width' ); ?>px;
    --wp--style--global--wide-size: 1440px;

    --primarycolor: <?php echo get_option( 'primary_colour' ); ?>;

    --ui-nav-size: <?php echo ( (int) get_option( 'ui_nav_size' ) > 0 ) ? get_option( 'ui_nav_size' ) . 'px' : '14px'; ?>;
    --ui-nav-weight: <?php echo ( (int) get_option( 'ui_nav_weight' ) > 0 ) ? get_option( 'ui_nav_weight' ) : '400'; ?>;
    --ui-nav-align: <?php echo ( (string) get_option( 'ui_nav_align' ) !== '' ) ? get_option( 'ui_nav_align' ) : 'center'; ?>;
    --ui-nav-justify: <?php echo ( (string) get_option( 'ui_nav_justify' ) !== '' ) ? get_option( 'ui_nav_justify' ) : 'flex-end'; ?>;

    --saturn-ui-link-colour: <?php echo get_option( 'saturn_ui_link_colour' ); ?>;
    --saturn-ui-link-colour-hover: <?php echo get_option( 'saturn_ui_link_colour_hover' ); ?>;

    --body-background: <?php echo get_option( 'body_background_colour' ); ?>;
    --body-text: <?php echo get_option( 'body_text_colour' ); ?>;

    --header_menu_text_colour: <?php echo get_option( 'header_menu_text_colour' ); ?>;
    --header_menu_hover_colour: <?php echo get_option( 'header_menu_hover_colour' ); ?>;

    --header_background_colour: <?php echo get_option( 'header_background_colour' ); ?>;

    --footer_background_colour: <?php echo get_option( 'footer_background_colour' ); ?>;
}
</style>

<?php wp_head(); ?>

<style>
<?php
if ( (int) get_option( 'use_minify_css' ) === 1 ) {
    echo saturn_minify_css( stripslashes( get_option( 'supernova_custom_css' ) ) );
} else {
    echo stripslashes( get_option( 'supernova_custom_css' ) );
}
?>
</style>

<?php echo html_entity_decode( get_option( 'supernova_custom_html' ) ); ?>

<?php if ( ! empty( get_option( 'tracking_gtm' ) ) )  { ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo get_option( 'tracking_gtm' ); ?>');</script>
<!-- End Google Tag Manager -->
<?php } ?>

<?php if ( ! empty( get_option( 'tracking_ga' ) ) ) { ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo get_option( 'tracking_ga' ); ?>"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments)}gtag("js",new Date);gtag("config","<?php echo get_option( 'tracking_ga' ); ?>");</script>
<?php } ?>

</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="overlay"></div>
<div id="side-menu">
    <a href="#" class="side-menu-close"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="svg-inline--fa fa-chevron-left fa-fw fa-w-10" data-icon="chevron-left" data-prefix="fas" viewBox="0 0 320 512"><defs/><path fill="currentColor" d="M34.5 239L229 44.7a24 24 0 0134 0l22.6 22.7a24 24 0 010 33.9L131.5 256l154 154.8a24 24 0 010 33.8l-22.7 22.7a24 24 0 01-34 0L34.6 273a24 24 0 010-34z"/></svg> Back</a>
    <?php
    wp_nav_menu(
        [
            'theme_location' => 'mobile-menu',
            'container'      => false,
        ]
    );

    if ( (int) get_option( 'reusable_block_mobile_id' ) > 0 ) {
        $reusable_block_mobile_id = get_post( (int) get_option( 'reusable_block_mobile_id' ) );

        echo '<div class="mobile-menu--inner">';
            echo apply_filters( 'the_content', $reusable_block_mobile_id->post_content );
        echo '</div>';
    }
    ?>
</div>

<i id="up"></i>
<div id="saturn-scroll">

<?php echo get_saturn_header();
