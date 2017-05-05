<?php
/*
Plugin Name: Enlaces - MasThemes
Plugin URI: https://masthemes.com/
Description: Plugin de enlaces by MasThemes.
Author: MasThemes
Author URI: https://masthemes.com/
Version: 1.0
Text Domain: enlaces-masthemes
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

global $mt_db_version;
$mt_db_version = '1.0';
function mt_install() {
	global $wpdb;
	global $mt_db_version;
	$table_name = $wpdb->prefix . 'dlmt';
	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE $table_name (
		LID int(11) NOT NULL AUTO_INCREMENT,
		PID int(11) NULL,
		Tipo int(1) NULL,
		Enlace varchar(200) NULL,
		Idioma varchar(50) NULL,
		Calidad varchar(50) NULL,
		UNIQUE KEY id (LID)
	) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	add_option( 'mt_db_version', $mt_db_version );
}
register_activation_hook( __FILE__, 'mt_install' );