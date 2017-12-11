<?php
get_header();
	echo '<main>';

	echo <<< EOT
<div class="js--modal-ajax">
	<p><button class="js--modal-button button" data-toggle="modal">Clicke me for a modal</button></p>
	<div class="reveal" id="modal" data-reveal data-ajax="https://www.law-yamashita.com/wp-json/wp/v2/posts/5427">読み込み中...</div>
</div>
EOT;

	// Side Menu
	echo '<div class="sidebar--wrap front">';
	get_sidebar();
	echo '</div>';
	get_template_part( './elements/top--special-sites' );
	get_template_part( './elements/fp-topheader' );
	get_template_part( './elements/cta--recruit' );
	get_template_part( './elements/fp-welcome-mess' );
	get_template_part( './elements/cta--jiko-lp' );
	get_template_part( './elements/fp-news' );
	get_template_part( './elements/fp-cases' );
	get_template_part( './elements/fp-special-sites' );
	echo '</main>';
get_footer();
