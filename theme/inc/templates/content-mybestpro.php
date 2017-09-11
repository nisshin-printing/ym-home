<?php
require_once( ABSPATH . WPINC . '/feed.php' );
$rss = fetch_feed( 'http://mbp-hiroshima.com/_shared/feed/index/54.mbp' );
$maxitems = 0;
if ( ! is_wp_error( $rss ) ) {
	$maxitems = $rss->get_item_quantity( 10 );
	$rss_items = $rss->get_items( 0, 10 );
}
if ( $maxitems == 0 ) {
	echo '<h2>再読み込みしてみてください。</h2>';
} else {
	date_default_timezone_get( 'Asia/Tokyo' );
	foreach ( $rss_items as $item ){
		echo '<article class="card post-list clearfix">',
		'<a class="waves-effect" href="', $item->get_permalink(), '" title="', $item->get_title(), '" target="_blank"></a>',
		'<p class="link-category clearfix"></p>',
		'<div class="card-content">',
		'<p class="card-time"><time datetime="', $item->get_date( 'c' ), '" itemprop="datePublished">', $item->get_date( 'Y.m.d' ), '</time></p>',
		'<p class="card-title color-black">', $item->get_title(), '</p>',
		'</div></article>';
	}
}
?>

