<?php
	// File Security Check
	if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
		die ( 'このページヘアクセスする権限がありません！　　　You do not have sufficient permissions to access this page!' );
	}
	$ringo = get_option('ringosh');
	$args = array(
		'post_type' => 'voice',
		'posts_per_page' => -1,
		'orderby' => 'modified',
		'order' => 'DESC'
	);
	$loop = new WP_Query($args);
	if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();
?>
<?php endwhile; endif; ?>