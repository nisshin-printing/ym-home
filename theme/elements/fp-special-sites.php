<?php
	include( get_template_directory() . '/config/sites.php' );
?>
<div class="fp--sites">
	<h2 class="title--border-bottom -center text-center">特設専門サイト</h2>
	<div class="small-up-1 medium-up-2 large-up-3 row">
		<?php
			foreach ( $sites as $site ) :
				if ( 'another' !== $site['name'] ) {
					$img = get_template_directory_uri() . '/assets/img/sites/' . $site['name'] . '.png';
					$url = ( $site['ssl'] ) ? 'https://hiroshima-' : 'http://www.hiroshima-';
					$url = $url . $site['name'] . '.com';
					$alt = ( $site['alt'] ) ? $site['alt'] : '弁護士法人山下江法律事務所の専門サイト';
					echo <<< EOT
<div class="column">
	<a href="$url" target="_blank">
		<img src="$img" alt="$alt">
	</a>
</div>
EOT;
				}
			endforeach;
?>
	</div>
</div>
