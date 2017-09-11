<?php
// Custom login page
if ( ! function_exists( 'custom_login' ) ) :
function custom_login() {
?>
<style>.login #login h1 a { width: 300px; height: 100px; background: url(<?php echo TIMG; ?>logo.png) no-repeat center center; background-size: contain; }</style>
<?php
}
add_action( 'login_enqueue_scripts', 'custom_login' );
endif;
// Change logo url
if ( ! function_exists( 'custom_login_logo_url' ) ) :
function custom_login_logo_url() {
	return DTDSH_HOME_URL;
}
add_filter("login_headerurl", "custom_login_logo_url");
endif;
// Change logo title
if ( ! function_exists( 'custom_login_logo_title' ) ) :
function custom_login_logo_title() {
	return "Produced by Nisshin Inc.";
}
add_filter("login_headertitle", "custom_login_logo_title");
endif;