<?php
/**
 * Create the sidebars
 *
 * Contains the main functions to create the sidebars
 *
 * @since 1.0
 * @package	Ringotheme
 * @author Ringotheme
 */
$msidebars = get_option( 'ringosh_sidebars' );
$sidebarsarray = array(
	array(
		'class' => 'rin_sidebarmain',
		'name' => __('メインサイドバー','ringo')
		),
	array(
		'class' => 'rin_casesarchive',
		'name' => __('解決事例アーカイブ用', 'ringo')
		),
	array(
		'class' => 'rin_voicearchive',
		'name' => __('お客様の声アーカイブ用', 'ringo')
		),
	array(
		'class' => 'rin_footleft',
		'name' => __('Footer左','ringo')
		),
	array(
		'class' => 'rin_footcent',
		'name' => __('Footer中央','ringo')
		),
	array(
		'class' => 'rin_footright',
		'name' => __('Footer右','ringo')
		)
	);
foreach ( $sidebarsarray as $val ) {
	register_sidebar( array(
		'name' => $val['name'],
		'id' => $val['class'],
		'before_widget' => '<div class="widget-wrapper %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
}
if ( isset( $msidebars ) && ! empty( $msidebars ) ) {
	foreach ( $msidebars as $rinv ) {
		register_sidebar( array(
			'name' => $rinv,
			'id' => 'rin_' . sanitize_title($rinv),
			'before_widget' => '<div class="widget-wrapper %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
			) );
	}
}