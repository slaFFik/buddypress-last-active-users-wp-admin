<?php
/**
 * Plugin Name: BuddyPress Last Active Users (wp-admin)
 * Plugin URI:  https://github.com/slaFFik/buddypress-last-active-users-wp-admin
 * Description: Display BuddyPress last active date for a user on `wp-admin/users.php` page
 * Author:      slaFFik
 * Author URI:  http://ovirium.com
 * Version:     1.1
 * Text Domain: bplau
 * Domain Path: /langs/
 * License:     GPLv2 or later
 */

function bplau_init() {
	add_filter( 'manage_users_columns', 'bplau_users_add_last_active_column' );
	add_filter( 'wpmu_users_columns', 'bplau_users_add_last_active_column' );
	add_action( 'manage_users_custom_column', 'bplau_users_show_last_active_column_content', 10, 3 );
}

add_action( 'bp_init', 'bplau_init' );

/**
 * Register column on Users page in wp-admin area
 *
 * @param array $columns
 *
 * @return array
 */
function bplau_users_add_last_active_column( $columns ) {
	$columns['bp_last_active'] = __( 'Last Active', 'buddypress' );

	return $columns;
}

/**
 * Display the last active date
 *
 * @param string $value
 * @param string $column_name
 * @param int $user_id
 *
 * @return string
 */
function bplau_users_show_last_active_column_content( $value, $column_name, $user_id ) {
	$last_active = bp_get_last_activity( $user_id );

	if ( 'bp_last_active' == $column_name ) {
		return $last_active;
	}

	return $value;
}
