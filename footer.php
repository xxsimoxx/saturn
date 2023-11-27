<footer class="alignfull">
    <div class="wrap">
        <?php
        if ( (int) get_option( 'reusable_block_footer_id' ) > 0 ) {
            $reusable_block_footer_id = get_post( (int) get_option( 'reusable_block_footer_id' ) );

            echo do_blocks( $reusable_block_footer_id->post_content );
        }
        ?>
    </div>
</footer>

<?php
if ( (int) get_option( 'gdpr_privacy_policy_page' ) > 0 ) {
    $gdpr_privacy_policy_page = (int) get_option( 'gdpr_privacy_policy_page' );
    ?>

    <div class="element-privacy">
        <a href="<?php echo get_permalink( $gdpr_privacy_policy_page ); ?>" title="We and our partners use technology such as cookies on our site to personalise content and analyse our traffic. By using this website, you consent to the use of this technology across the web according to our Privacy Policy">Privacy Policy</a>
    </div>
<?php } ?>

<?php wp_footer(); ?>

</div>

</body>
</html>
