<?php

/*
 * フィードの記事本文と抜粋にアイキャッチ画像を出力
 */
function rss_post_thumbnail( $content ) {
	global $post;
	if ( has_post_thumbnail( $post->ID ) ) {
		$content = '<p>' . get_the_post_thumbnail( $post->ID ) . '</p>' . $content;
	}
	return $content;
}
add_filter( 'the_excerpt_rss', 'rss_post_thumbnail' );
add_filter( 'the_content_feed', 'rss_post_thumbnail' );