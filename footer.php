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

</div>

<?php if ((int) get_option('use_icofont') === 1) { ?>
    <a href="#up" class="saturn--up"><i class="icofont-arrow-up"></i></a>
<?php } ?>

</body>
</html>
