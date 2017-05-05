<?php
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}
$updater = new EDD_Theme_Updater_Admin(
	$config = array(
		'remote_api_url' => 'https://masthemes.com',
		'item_name' => 'Diddli',
		'theme_slug' => get_template(),
		'version' => '1.1.1', 
		'author' => 'MasThemes',
		'download_id' => '',
		'renew_url' => ''
	),
	$strings = array(
		'theme-license' => __( 'Theme License', 'edd-theme-updater' ),
		'enter-key' => __( 'Enter your theme license key.', 'edd-theme-updater' ),
		'license-key' => __( 'License Key', 'edd-theme-updater' ),
		'license-action' => __( 'License Action', 'edd-theme-updater' ),
		'deactivate-license' => __( 'Deactivate License', 'edd-theme-updater' ),
		'activate-license' => __( 'Activate License', 'edd-theme-updater' ),
		'status-unknown' => __( 'License status is unknown.', 'edd-theme-updater' ),
		'renew' => __( 'Renew?', 'edd-theme-updater' ),
		'unlimited' => __( 'unlimited', 'edd-theme-updater' ),
		'license-key-is-active' => __( 'License key is active.', 'edd-theme-updater' ),
		'expires%s' => __( 'Expires %s.', 'edd-theme-updater' ),
		'%1$s/%2$-sites' => __( 'You have %1$s / %2$s sites activated.', 'edd-theme-updater' ),
		'license-key-expired-%s' => __( 'License key expired %s.', 'edd-theme-updater' ),
		'license-key-expired' => __( 'License key has expired.', 'edd-theme-updater' ),
		'license-keys-do-not-match' => __( 'License keys Active', 'edd-theme-updater' ),
		'license-is-inactive' => __( 'License is inactive.', 'edd-theme-updater' ),
		'license-key-is-disabled' => __( 'License key is disabled.', 'edd-theme-updater' ),
		'site-is-inactive' => __( 'Site is inactive.', 'edd-theme-updater' ),
		'license-status-unknown' => __( 'License status is unknown.', 'edd-theme-updater' ),
		'update-notice' => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'edd-theme-updater' ),
		'update-available' => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'edd-theme-updater' )
	)

);