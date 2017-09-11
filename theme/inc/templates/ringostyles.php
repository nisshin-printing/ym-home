<?php
	//File Security Check
	if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
		die ( 'このページヘアクセスする権限がありません！　　　You do not have sufficient permissions to access this page!' );
	}
/**
 * Ringotheme computer generated styles
 *
 *
 * @author 		Ringo
 * @package 	templates
 * @version     1.0
 */
	echo $ringo['rin_stylerules'];
?>