<?php
/*
 * Make the list of enqueued resources.
 */
/*
function dtdsh_get_dependency( $dependency ) {
	$dep = '';
	if ( is_a( $dependency, '_WP_Dependency' ) ) {
		$dep .= '$dependency->handle';
		$dep .= ' [' . implode( ' ', $dependency->deps ) . ']';
		$dep .= ' ' . $dependency->src;
		$dep .= ' ' . $dependency->ver;
		$dep .= ' ' . $dependency->args;
		$dep .= ' (' . implode( ' ', $dependency->extra ) . ')';
	}
	return $dep;
}

function dtdsh_style_queues() {
	global $wp_styles;
	echo '<!-- WP_Dependencies for styles ';
	foreach ( $wp_styles->queue as $val ) {
		echo dtdsh_get_dependency( $wp_styles->registered[ $val ] );
	}
	echo ' -->';
}


function dtdsh_script_queues() {
	global $wp_scripts;
	echo '<!-- WP_Dependencies for scripts ';
	foreach ( $wp_scripts->queue as $val ) {
		echo dtdsh_get_dependency( $wp_scripts->registered[ $val ] );
	}
	echo ' -->';
}
add_action( 'wp_print_styles', 'dtdsh_style_queues', 9999 );
add_action( 'wp_print_scripts', 'dtdsh_style_queues', 9999 );
*/

/**
 * Make the list of enqueued resources
 **/
function my_get_dependency( $dependency ) {
	$dep = "";
	if ( is_a( $dependency, "_WP_Dependency" ) ) {
		$dep .= " handle: '$dependency->handle'";
		$dep .= " deps: [" . implode( " ", $dependency->deps ) . "]";
		$dep .= " src: '$dependency->src'";
		$dep .= " ver: '$dependency->ver'";
		$dep .= " args: '$dependency->args'";
		$dep .= " extra: (" . implode( " ", $dependency->extra ) . ")";
	}
	return "$dep\n";
}

function my_style_queues() {
	global $wp_styles;
	echo "<!-- WP_Dependencies for styles\n";
	foreach ( $wp_styles->queue as $val ) {
		echo my_get_dependency( $wp_styles->registered[ $val ] );
	}
	echo "-->\n";
}
add_action( 'wp_print_styles', 'my_style_queues', 9999 );

function my_script_queues() {
	global $wp_scripts;
	echo "<!-- WP_Dependencies for scripts\n";
	foreach ( $wp_scripts->queue as $val ) {
		echo my_get_dependency( $wp_scripts->registered[ $val ] );
	}
	echo "-->\n";
}
add_action( 'wp_print_scripts', 'my_script_queues', 9999 );