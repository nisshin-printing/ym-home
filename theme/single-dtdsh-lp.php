<?php
get_header();
while( have_posts() ) : the_post();
?>
<div class="layout-lp">
<?php
	if ( '2915' == $post->ID ) {
		get_template_part( 'inc/templates/lp/jiko' );
	} elseif( '2916' == $post->ID ) {
		get_template_part( 'inc/templates/lp/rikon' );
	} elseif( '2917' == $post->ID ) {
		get_template_part( 'inc/templates/lp/sozoku' );
	} elseif( '2918' == $post->ID ) {
		get_template_part( 'inc/templates/lp/kabarai' );
	} elseif ( '4136' == $post->ID ) {
		get_template_part( 'inc/templates/lp/e-hiroshima' );
	} elseif ( '4137' == $post->ID ) {
		get_template_part( 'inc/templates/lp/kure' );
	}
?>
</div>
<?php
endwhile;
get_footer();
