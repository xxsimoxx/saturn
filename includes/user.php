<?php
add_action('show_user_profile', 'saturn_edit_user');
add_action('edit_user_profile', 'saturn_edit_user');

function saturn_edit_user($user) {
	if (is_admin()) { ?>
		<table class="form-table">
            <tr>
				<th><label for="user_linkedin">LinkedIn Profile URL</label></th>
				<td>
                    <p>
                        <input type="url" name="user_linkedin" id="user_linkedin" value="<?php echo get_the_author_meta('user_linkedin', $user->ID); ?>" class="regular-text">
                    </p>
				</td>
			</tr>
		</table>
	<?php
	}
}

add_action('personal_options_update', 'saturn_save_profile_fields');
add_action('edit_user_profile_update', 'saturn_save_profile_fields');

function saturn_save_profile_fields($userId) {
    if (!current_user_can('edit_user', $userId)) {
        return false;
    }

    update_user_meta($userId, 'user_linkedin', esc_url_raw($_POST['user_linkedin']));
}
