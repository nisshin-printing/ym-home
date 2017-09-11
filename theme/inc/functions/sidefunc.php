<?php
if ( ! function_exists( 'dtdsh_sidebar' ) ) :
function dtdsh_sidebar() {
	ob_start();
	get_sidebar();
	$side = ob_get_contents();
	ob_end_clean();
	$side = dtdsh_html_format( $side, false );
	echo $side;
}
endif;