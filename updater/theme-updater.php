<?php
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://getbutterfly.com', // Site where EDD is hosted
		'item_name'      => 'Saturn', // Name of theme
		'theme_slug'     => 'saturn', // Theme slug
		'version'        => wp_get_theme()->get('Version'), // The current version of this theme
		'author'         => 'getButterfly', // The author of this theme
		'download_id'    => 106352, // Optional, used for generating a license renewal link
		'renew_url'      => '', // Optional, allows for a custom license renewal link
		'beta'           => false, // Optional, set to true to opt into beta versions
		'item_id'        => 106352,
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Theme License', 'saturn' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'saturn' ),
		'license-key'               => __( 'License Key', 'saturn' ),
		'license-action'            => __( 'License Action', 'saturn' ),
		'deactivate-license'        => __( 'Deactivate License', 'saturn' ),
		'activate-license'          => __( 'Activate License', 'saturn' ),
		'status-unknown'            => __( 'License status is unknown.', 'saturn' ),
		'renew'                     => __( 'Renew?', 'saturn' ),
		'unlimited'                 => __( 'unlimited', 'saturn' ),
		'license-key-is-active'     => __( 'License key is active.', 'saturn' ),
		'expires%s'                 => __( 'Expires %s.', 'saturn' ),
		'expires-never'             => __( 'Lifetime License.', 'saturn' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'saturn' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'saturn' ),
		'license-key-expired'       => __( 'License key has expired.', 'saturn' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'saturn' ),
		'license-is-inactive'       => __( 'License is inactive.', 'saturn' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'saturn' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'saturn' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'saturn' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'saturn' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'saturn' ),
	)

);
