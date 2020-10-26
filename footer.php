<footer class="supernova-fullwidth">
    <div class="wrap">
        <?php
        if ((int) get_option('reusable_block_footer_id') > 0) {
            $reusableBlockFooterId = get_post((int) get_option('reusable_block_footer_id'));

            echo apply_filters('the_content', $reusableBlockFooterId->post_content);
        }
        ?>
    </div>
</footer>

<?php if ((int) get_option('gdpr_privacy_policy_page') > 0) {
    $gdprPrivacyPolicyPage = (int) get_option('gdpr_privacy_policy_page'); ?>

    <div class="element-privacy">
        <a href="<?php echo get_permalink($gdprPrivacyPolicyPage); ?>" title="We and our partners use technology such as cookies on our site to personalise content and analyse our traffic. By using this website, you consent to the use of this technology across the web according to our Privacy Policy">Privacy Policy</a>
    </div>
<?php } ?>

<?php wp_footer(); ?>

<div class="shapes-bg skrollable skrollable-between" data-bottom-top="transform:translateY(300px);" data--100-end="transform:translateY(1000px);" style="transform: translateY(0px);">
    <div class="shapes-wrap shapes-background-parallax" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; position: relative; pointer-events: none;">
        <div data-depth="0.30" class="shape-white layer" style="transform: translate3d(-17.8px, -11.7px, 0px) rotate(46deg); transform-style: preserve-3d; backface-visibility: hidden; position: absolute; display: block; left: 0px; top: 0px;"></div>
        <div data-depth="0.20" class="shape-white-reverse layer" style="transform: translate3d(18.6px, -0.7px, 0px) rotate(46deg); transform-style: preserve-3d; backface-visibility: hidden; position: absolute; display: block; left: 0px; top: 0px;"></div>
    </div>
</div>

</body>
</html>
