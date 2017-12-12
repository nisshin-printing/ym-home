<?php
get_header();
	echo '<main>';

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
