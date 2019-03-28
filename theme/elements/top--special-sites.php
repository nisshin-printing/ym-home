<?php
	include( get_template_directory() . '/config/sites.php' );
	$sites_img = get_template_directory_uri() . '/assets/img/sites/light--';
echo '<div class="sites--wrapper row">',
'<h2 class="column small-12" style="font-size:2em">山下江法律事務所サイトへようこそ。<br>各種専門サイトをご覧ください。</h2></div>',
'<div class="sites--wrapper row small-up-2 medium-up-3 large-up-4">';
foreach ( $sites as $site ) :
	$url = ( $site['ssl'] ) ? 'https://hiroshima-' : 'http://www.hiroshima-';
	if ( 'another' !== $site['name'] ) {
		$bg_class = ( $site['bg'] ) ? 'bg-' . $site['name'] : 'bg-else';
		echo '<div class="column"><a href="', $url, $site['name'], '.com" target="_blank" class="sites--link ', $bg_class, '"><img src="', $sites_img, $site['name'], '.png" class="sites--img"></a></div>';
	} else {
		$url = 'https://www.law-yamashita.com/scope/civil-case';
		echo '<div class="column"><a href="', $url, '" class="sites--link bg-home"><img src="', $sites_img, $site['name'], '.png" class="sites--img"></a></div>';
	}
endforeach;
echo '</div>';
