<?php
/**
 * Add meta box
 *
 * @param post $post The post object
 */
function supernova_add_meta_boxes($post) {
    add_meta_box('slide_meta_box', __('Slide Settings', 'supernova'), 'slide_build_meta_box', ['slide'], 'side', 'low');
    /*
    add_meta_box(
        'agent_meta_box',
        'Agent Settings',
        'agent_build_meta_box',
        ['agent'],
        'side',
        'low',
        [
            '__block_editor_compatible_meta_box' => true,
            '__back_compat_meta_box' => false
        ]
    );
    /**/
    add_meta_box('testimonial_meta_box', __('Testimonial Settings', 'supernova'), 'testimonial_build_meta_box', ['testimonial'], 'side', 'low');
}



/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function testimonial_build_meta_box($post) {
	wp_nonce_field(basename(__FILE__), 'testimonial_meta_box_nonce');

    $currentTestimonialAuthor = get_post_meta($post->ID, 'testimonial-author', true);
	?>
    <div class="inside">
        <p>
            <label for="testimonial-author">Author/Cite</label>
            <input type="text" name="testimonial_author" id="testimonial-author" class="regular-text" style="width: 100%;" value="<?php echo $currentTestimonialAuthor; ?>">
        </p>
	</div>
	<?php
}

/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 */
function testimonial_save_meta_box_data($post_id) {
    if (!isset($_POST['testimonial_meta_box_nonce']) || !wp_verify_nonce($_POST['testimonial_meta_box_nonce'], basename(__FILE__))) {
		return;
	}
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

    $testimonialAuthor = isset($_POST['testimonial_author']) ? trim($_POST['testimonial_author']) : '';

    update_post_meta($post_id, 'testimonial-author', $testimonialAuthor);
}

/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function slide_build_meta_box($post) {
	wp_nonce_field(basename(__FILE__), 'slide_meta_box_nonce');

    $currentSlideVideo = get_post_meta($post->ID, 'slide-video', true);
	?>
    <div class="inside">
        <p>
            <label for="slide-video">Video URL (.mp4)</label>
            <input type="url" name="slide_video" id="slide-video" class="regular-text" style="width: 100%;" value="<?php echo $currentSlideVideo; ?>">
        </p>
	</div>
	<?php
}

/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 */
function slide_save_meta_box_data($post_id) {
    if (!isset($_POST['slide_meta_box_nonce']) || !wp_verify_nonce($_POST['slide_meta_box_nonce'], basename(__FILE__))) {
		return;
	}
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

    $slideVideo = isset($_POST['slide_video']) ? $_POST['slide_video'] : '';

    update_post_meta($post_id, 'slide-video', $slideVideo);
}



/**
 * Hide WordPress Custom Fields section
 */
function supernova_meta_boxes() {
    remove_meta_box('postcustom', 'testimonial', 'normal');
}

add_action('admin_init', 'supernova_meta_boxes');

add_action('add_meta_boxes', 'supernova_add_meta_boxes');

add_action('save_post', 'testimonial_save_meta_box_data');
add_action('save_post', 'slide_save_meta_box_data');




/**
 * Remove Yoast SEO meta box from bid CPT
 */
function supernova_remove_yoast_metabox() {
    remove_meta_box('wpseo_meta', ['bid'], 'normal');
}
add_action('add_meta_boxes', 'supernova_remove_yoast_metabox', 11);
