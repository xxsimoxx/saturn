<?php
/**
 * Register Custom Block Styles
 */
function saturn_patterns_register_block_patterns() {
    /**
     * Register block patterns
     */
    register_block_pattern_category('saturn', [
        'label' => __('Saturn', 'saturn')
    ]);

    register_block_pattern('saturn-gutenberg-block-patterns/tall-splash', [
        'title' => __('Tall Splash', 'saturn-gutenberg-block-patterns'),
        'description' => _x('A tall splash cover section, with title, description and a generic button.', 'Block pattern description', 'saturn'),
        'categories' => ['saturn'],
        'keywords' => ['hero', 'splash', 'cover', 'saturn'],

        'content' => '<!-- wp:cover {"url":"' . esc_url(get_theme_file_uri('content/cover-porto.jpg')) . '","id":3588,"dimRatio":70,"minHeight":600,"customGradient":"linear-gradient(110deg,rgb(25,42,234) 0%,rgb(24,98,249) 100%)","align":"full","className":"saturn-tall-splash"} --><div class="wp-block-cover alignfull has-background-dim-70 has-background-dim has-background-gradient saturn-tall-splash" style="background-image:url(' . esc_url(get_theme_file_uri('content/cover-porto.jpg')) . ');min-height:600px"><span aria-hidden="true" class="wp-block-cover__gradient-background" style="background:linear-gradient(110deg,rgb(25,42,234) 0%,rgb(24,98,249) 100%)"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"align":"center","level":3,"className":"wrap wrap-narrow"} --><h3 class="has-text-align-center wrap wrap-narrow">Welcome to Our Site!</h3><!-- /wp:heading --><!-- wp:heading {"align":"center","level":6,"className":"wrap wrap-narrow"} --><h6 class="has-text-align-center wrap wrap-narrow">Welcome to Our Site!</h6><!-- /wp:heading --><!-- wp:spacer {"height":24} --><div style="height:24px" aria-hidden="true" class="wp-block-spacer"></div><!-- /wp:spacer --><!-- wp:paragraph {"align":"center","className":"wrap wrap-narrow","fontSize":"medium"} --><p class="has-text-align-center wrap wrap-narrow has-medium-font-size">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><!-- /wp:paragraph --><!-- wp:spacer {"height":72} --><div style="height:72px" aria-hidden="true" class="wp-block-spacer"></div><!-- /wp:spacer --><!-- wp:buttons {"align":"center"} --><div class="wp-block-buttons aligncenter"><!-- wp:button {"textColor":"white","className":"is-style-outline"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-white-color has-text-color">Get in touch</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div></div><!-- /wp:cover -->',
    ]);



    register_block_pattern('saturn-gutenberg-block-patterns/highlighted-columns', [
        'title' => __('Highlighted Columns', 'saturn-gutenberg-block-patterns'),
        'description' => _x('A set of balanced column sections, suitable for highlighted content.', 'Block pattern description', 'saturn'),
        'categories' => ['saturn'],
        'keywords' => ['content', 'columns', 'highlight', 'saturn'],

        'content' => '<!-- wp:columns --><div class="wp-block-columns"><!-- wp:column {"width":"40%"} --><div class="wp-block-column" style="flex-basis:40%"><!-- wp:image {"id":3583,"sizeSlug":"large","linkDestination":"none"} --><figure class="wp-block-image size-large"><img src="' . esc_url(get_theme_file_uri('content/cover-specimen.jpg')) . '" alt="" class="wp-image-3583"/><figcaption>Lorem ipsum dolor sit amet</figcaption></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column {"width":"10%"} --><div class="wp-block-column" style="flex-basis:10%"></div><!-- /wp:column --><!-- wp:column {"width":"50%"} --><div class="wp-block-column" style="flex-basis:50%"><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --><!-- wp:cover {"customOverlayColor":"#f1f1f1","align":"full"} --><div class="wp-block-cover alignfull has-background-dim" style="background-color:#f1f1f1"><div class="wp-block-cover__inner-container"><!-- wp:columns {"className":"wrap"} --><div class="wp-block-columns wrap"><!-- wp:column {"width":"40%"} --><div class="wp-block-column" style="flex-basis:40%"><!-- wp:heading {"textColor":"black"} --><h2 class="has-black-color has-text-color">‘Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse’.</h2><!-- /wp:heading --></div><!-- /wp:column --><!-- wp:column {"width":"10%"} --><div class="wp-block-column" style="flex-basis:10%"></div><!-- /wp:column --><!-- wp:column {"width":"50%"} --><div class="wp-block-column" style="flex-basis:50%"><!-- wp:paragraph {"textColor":"black"} --><p class="has-black-color has-text-color">Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --></div></div><!-- /wp:cover -->',
    ]);



    /**
     * Advanced Intro #1
     */
    register_block_pattern('saturn-gutenberg-block-patterns/advanced-intro-1', [
        'title' => __('Advanced Intro #1', 'saturn-gutenberg-block-patterns'),
        'description' => _x('A two-column intro block with highlighted content on the left and descriptive content on the right.', 'Block pattern description', 'saturn'),
        'categories' => ['saturn'],
        'keywords' => ['content', 'columns', 'intro', 'saturn'],

        'content' => '<!-- wp:columns {"className":"saturn-advanced-intro-1"} --><div class="wp-block-columns saturn-advanced-intro-1"><!-- wp:column {"width":33.33} --><div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:paragraph {"style":{"typography":{"fontSize":32}}} --><p style="font-size:32px">Welcome to<br>Our Business</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column {"width":66.66} --><div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:paragraph --><p><strong>Experience our business difference.</strong></p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Our compact operation makes for a personal service focused on ensuring that client and project alike receive the dedicated attention they deserve. The successful marketing and sale of your assets is, of course, important to you, but when you engage us, you will discover that it is also important to us!</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>And that’s our difference.</strong></p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Many years of extensive experience of the industry market means that our expertise is unsurpassed. Our professional sales team know the market, have a close understanding of the prices that are achievable, and we get results.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns -->',
    ]);



    /**
     * Content Columns #1
     */
    register_block_pattern('saturn-gutenberg-block-patterns/content-columns-1', [
        'title' => __('Content Columns #1', 'saturn-gutenberg-block-patterns'),
        'description' => _x('A two-column intro block with highlighted content on the left and descriptive content on the right.', 'Block pattern description', 'saturn'),
        'categories' => ['saturn'],
        'keywords' => ['content', 'columns', 'intro', 'saturn'],

        'content' => '<!-- wp:columns --><div class="wp-block-columns"><!-- wp:column {"width":40} --><div class="wp-block-column" style="flex-basis:40%"><!-- wp:image {"id":3583,"sizeSlug":"large"} --><figure class="wp-block-image size-large"><img src="' . esc_url(get_theme_file_uri('content/cover-specimen.jpg')) . '" alt="" class="wp-image-3583"/><figcaption>Lorem ipsum dolor sit amet</figcaption></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column {"width":10} --><div class="wp-block-column" style="flex-basis:10%"></div><!-- /wp:column --><!-- wp:column {"width":50} --><div class="wp-block-column" style="flex-basis:50%"><!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --><!-- wp:cover {"customOverlayColor":"#f1f1f1","align":"full"} --><div class="wp-block-cover alignfull has-background-dim" style="background-color:#f1f1f1"><div class="wp-block-cover__inner-container"><!-- wp:columns {"className":"wrap"} --><div class="wp-block-columns wrap"><!-- wp:column {"width":40} --><div class="wp-block-column" style="flex-basis:40%"><!-- wp:heading {"textColor":"black"} --><h2 class="has-black-color has-text-color">‘Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse’.</h2><!-- /wp:heading --></div><!-- /wp:column --><!-- wp:column {"width":10} --><div class="wp-block-column" style="flex-basis:10%"></div><!-- /wp:column --><!-- wp:column {"width":50} --><div class="wp-block-column" style="flex-basis:50%"><!-- wp:paragraph {"textColor":"black"} --><p class="has-black-color has-text-color">Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --><!-- wp:paragraph --><p></p><!-- /wp:paragraph --></div></div>',
    ]);



    /**
     * Content Columns #1
     */
    register_block_pattern('saturn-gutenberg-block-patterns/special-title', [
        'title' => __('Special Title', 'saturn-gutenberg-block-patterns'),
        'description' => _x('A two-column intro block with highlighted content on the left and descriptive content on the right.', 'Block pattern description', 'saturn'),
        'categories' => ['saturn'],
        'keywords' => ['content', 'columns', 'intro', 'saturn'],

        'content' => '<!-- wp:heading {"align":"center","className":"special-title"} --><h2 class="has-text-align-center special-title"><small>AWARD WINNING</small>Studio</h2>',
    ]);
}
add_action('init', 'saturn_patterns_register_block_patterns');
