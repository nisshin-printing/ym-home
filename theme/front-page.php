<?php
get_header();
	echo '<main>';
	get_template_part( './elements/top--special-sites' );
	get_template_part( './elements/fp-topheader' );
	get_template_part( './elements/fp-welcome-mess' );
	get_template_part( './elements/fp-cta' );
	get_template_part( './elements/fp-news' );
	get_template_part( './elements/fp-cases' );
	get_template_part( './elements/fp-special-sites' );
	echo '</main>';
get_footer();
