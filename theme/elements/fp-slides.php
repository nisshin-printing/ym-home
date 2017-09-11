<?php
// Front Page Slider
$slides_args = array(
	'post_type' => 'dtdsh-slides',
	'posts_per_page' => -1,
	'orderby' => 'date',
	'order' => 'ASC',
	);
$slider = new WP_Query( $slides_args );
?>
<section class="fp-slider">
	<div id="top-slides" class="row">
<?php
if ( $slider->have_posts() ) :
	while ( $slider->have_posts() ) : $slider->the_post();
		$link_src = get_post_meta( $id, 'slider_link', true );
		$link_title = ( get_post_meta( $id, 'slider_link_title', true ) ) ? get_post_meta( $id, 'slider_link_title', true ) : get_the_title();
		$img_id = get_post_thumbnail_id( $post );
		$img_url = wp_get_attachment_image_src( $img_id, 'full', true );
		echo '<article class="slide-item card">',
			'<div class="card-img"><img src="' . $img_url[0] . '" alt="' . get_the_title() . '" width="' . $img_url[1] . '" height="' . $img_url[2] . '"></div>',
			'<div class="card-content">',
				'<p class="card-title">' . get_the_title() . '</p>',
				'<p class="text-right"><a class="waves-effect" href="' . $link_src . '" title="' . $link_title . '">' . $link_title . '</a></p>',
			'</div>',
		'</article>';
	endwhile;
endif;
echo '<ul id="slides-btn"></ul>',
	'</div></section>';


