<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'このページヘアクセスする権限がありません！　　　You do not have sufficient permissions to access this page!' );
}
?>
<?php
/*
 * Ajax
 */
function view_sitename() {
	echo get_bloginfo( 'name' );
	die();
}
add_action( 'wp_ajax_view_sitename', 'view_sitename' );
add_action( 'wp_ajax_nopriv_view_sitename', 'view_sitename' );