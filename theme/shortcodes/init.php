<?php
// メンバーページに関連記事を表示
add_shortcode( 'have-posts', 'have_relate_posts' );
function have_relate_posts() {
	global $post;
	$member_id = $post->ID;
	$args = array(
		'posts_per_page' => -1,
		'meta_key' => 'charge_lawyer',
		'meta_value_num' => $member_id,
		'order' => 'ASC'
	);
	$posts = new WP_Query( $args );
	$return = '<div id="test">';
	if ( $posts->have_posts() ) : while ( $posts->have_posts() ) : $posts->the_post();
	$return .= '<a href="' . get_the_permalink( $member_id ) . '">' . get_the_title( $member_id ) . '</a>';
	endwhile; endif;
	$return .= '</div>';
	return $return;
}
// 記事にメンバーが言っている風な画像と「」を表示させたい
add_shortcode( 'speak-member', 'members_speak_message' );
function members_speak_message( $atts ) {
	extract(
		shortcode_atts(
		array(
		'who'  => '',
		'text' => null,
	),
		$atts
	)
	);
	$thumb = get_the_post_thumbnail( $who, array( 80, 80 ) );
	$text  = ( empty( $text ) ) ? '' : '「' . $text . '」';
	$return = '<div class="speak-member c-table"><div class="img-wrapper c-table-cell ver-middle pr1">' . $thumb . '</div><p class="c-table-cell ver-middle">' . $text . '</p></div>';
	return $return;
}
// 取扱範囲に解決事例・お客様の声を表示させたい
add_shortcode( 'post-list', 'ym_post_list' );
function ym_post_list( $atts ) {
	extract(
		shortcode_atts(
			array(
				'limit' => 7,
				'type' => 'post',
				'cat' => '',
				'tax' => ''
				),
			$atts
			)
		);
	$args = array(
		'posts_per_page' => $limit,
		'post_type' => $type,
		'order' => 'DESC',
		'orderby' => 'modified',
		$cat => $tax
		);
	$postList = '';
	$loop = new WP_Query( $args );
	$postList = '<div class="accordion" data-accordion>';
	if ( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post();
	$postList .= '<article class="accordion-item" data-accordion-item><a class="accordion-title">' . get_the_title() . '</a>';
	$postList .= '<div class="accordion-content" data-tab-content><p>' . get_the_content() . '</p></div>';
	$postList .= '</article>';
	endwhile;
	wp_reset_postdata();
	endif;
	$postList .= '</div>';
	return $postList;
}
// 慰謝料請求の解決事例
add_shortcode( 'isyaryo-case', 'isyaryo_case_list' );
function isyaryo_case_list( $tax = '324' ) {
	$args = array(
		'posts_per_page' => 7,
		'post_type' => 'cases',
		'order' => 'DESC',
		'orderby' => 'modified',
		'tax_query' => array(
			array(
				'taxonomy' => 'cases-tag',
				'field' => 'term_id',
				'terms' => $tax
			)
		)
	);
	$returnList = '';
	$loop = new WP_Query( $args );
	$returnList = '<div class="accordion" data-accordion>';
	if ( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post();
	$returnList .= '<article class="accordion-item" data-accordion-item><a class="accordion-title">' . get_the_title() . '</a>';
	$returnList .= '<div class="accordion-content" data-tab-content><p>' . get_the_content() . '</p></div>';
	$returnList .= '</article>';
	endwhile;
	wp_reset_postdata();
	endif;
	$returnList .= '</div>';
	return $returnList;
}

// 事務所の雰囲気についてのお客様の声を表示
add_shortcode( 'feel-voice', 'show_feeling_voice' );
function show_feeling_voice() {
	$show_voice_id = array( '2715', '2713', '2707', '2756' );
	$returnVoice = '<h3>お越しいただいたお客様の声</h3>';
	$returnVoice .= '<div class="accordion" data-accordion>';
	foreach ( $show_voice_id as $id ) :
		$article = get_post( $id );
		$returnVoice .= '<article class="accordion-item" data-accordion-item><a class="accordion-title">' . $article->post_title . '</a>';
		$returnVoice .= '<div class="accordion-content" data-tab-content><p>' . $article->post_content . '</p></div>';
		$returnVoice .= '</article>';
	endforeach;
	$returnVoice .= '</div>';
	return $returnVoice;
}

// 希望弁護士の選択モーダルを表示させたい
add_action( 'wpcf7_init', 'On_wpcf7_add_shortcode' );
function On_wpcf7_add_shortcode() {
	wpcf7_add_form_tag( 'select_members', 'memberSelect', true );
}
function memberSelect() {
	$args1 = array(
		'post_type'      => 'members',
		'posts_per_page' => '-1',
		'orderby'        => 'ID',
		'order'          => 'ASC',
		'post_status'    => 'publish',
		'tax_query'      => array(
			array(
				'taxonomy' => 'members-cat',
				'field'    => 'term_id',
				'terms'    => '53'
				)
			)
		);
	$args2 = array(
		'post_type'      => 'members',
		'posts_per_page' => '-1',
		'orderby'        => 'ID',
		'order'          => 'ASC',
		'post_status'    => 'publish',
		'tax_query'      => array(
			array(
				'taxonomy' => 'members-cat',
				'field'    => 'term_id',
				'terms'    => '54'
				)
			)
		);
	$lawyers = new WP_Query( $args1 );
	$advisers = new WP_Query( $args2 );
	$result = '<p class="mb0"><a class="button expanded waves-effect js-select-modal" data-open="select-member" title="弁護士やアドバイザーを指名する">弁護士やアドバイザーを指名する</a></p>';
	$result .= '<div id="select-member" class="reveal full" data-reveal><button type="button" class="close-button" aria-label="Close" data-close>&times;</button>';
	$result .= '<h2 class="text-center">弁護士やアドバイザーを選択</h2>';
	$result .= '<p><a class="close-select-members button expanded waves-effect" title="指名しない" data-close>指名をやめる</a></p>';
	$result .= '<div class="row small-up-1 medium-up-2 large-up-4 text-center m1-auto">';
	if ( $lawyers->have_posts() ) : while ( $lawyers->have_posts() ) : $lawyers->the_post();
	$img_id = get_post_thumbnail_id( get_the_ID() );
	$img_url = wp_get_attachment_image_src( $img_id, 'full', true );
	if ( '548' == get_the_ID() ) {
		$d_name = get_post_meta( get_the_ID(), 'subtitle', true ) . ' - ' . get_the_title() . '（相談料1時間3万円）';
	} else {
		$d_name = get_post_meta( get_the_ID(), 'subtitle', true ) . ' - ' . get_the_title();
	}
	$result .= '<article class="column bg-mask-wrapper" data-name="' . $d_name . '">';
	$result .= '<a class="bg-mask waves-effect" title="' . get_the_title() . '"></a>';
	$result .= '<div class="img-wrapper"><img src="' . $img_url[0] . '" alt="' . get_the_title() . '" width="' . $img_url[1] . '" height="' . $img_url[2] . '"></div>';
	$result .= '<p class="name"><span class="subtitle">' . get_post_meta( get_the_ID(), 'subtitle', true ) . '</span>' . get_the_title() . '</p>';
	$result .= '</article>';
	endwhile; endif;
	wp_reset_postdata();
	if ( $advisers->have_posts() ) : while ( $advisers->have_posts() ) : $advisers->the_post();
	$img_id = get_post_thumbnail_id( get_the_ID() );
	$img_url = wp_get_attachment_image_src( $img_id, 'full', true );
	$a_name = get_post_meta( get_the_ID(), 'subtitle', true ) . ' - ' . get_the_title();
	$result .= '<article class="column bg-mask-wrapper" data-name="' . $a_name . '">';
	$result .= '<a class="bg-mask waves-effect" title="' . get_the_title() . '"></a>';
	$result .= '<div class="img-wrapper"><img src="' . $img_url[0] . '" alt="' . get_the_title() . '" width="' . $img_url[1] . '" height="' . $img_url[2] . '"></div>';
	$result .= '<p class="name"><span class="subtitle">' . get_post_meta( get_the_ID(), 'subtitle', true ) . '</span>' . get_the_title() . '</p>';
	$result .= '</article>';
	endwhile; endif;
	wp_reset_postdata();
	$result .= '</div><p><a class="close-select-members button expanded waves-effect" title="指名しない">指名をやめる</a></p>';
	$result .= '</div>';
	return $result;
}

/*
 * 離婚ページに女性弁護士リンクを挿入するためだけのショートコード
 */
add_shortcode( 'link-women', 'cta_women_post_link' );
function cta_women_post_link() {
	$posts = array( '560', '562', '4092', '4087' );
	$result = '<h2>女性のための女性弁護士はこんな人です</h2>';
	$result .= '<div id="cta-member-carousel">';
	foreach ( $posts as $post ) {
		$result .= '<div class="slide-item bg-mask-wrapper">';
		$result .= '<a href="' . get_permalink( $post ) . '" title="' . get_the_title( $post ) . '" class="waves-effect bg-mask"></a>';
		$img_id = get_post_thumbnail_id( $post );
		$img_url = wp_get_attachment_image_src( $img_id, 'full', true );
		$result .= '<div class="img-wrapper"><img data-lazy="' . $img_url[0] . '" alt="' . get_the_title() . '" width="' . $img_url[1] . '" height="' . $img_url[2] . '"></div>';
		$result .= '<div class="meta-name"><span class="meta-works">' .get_post_meta( $post, 'subtitle', true ) . '</span>' . get_the_title( $post ) . '</div>';
		$result .= '</div>';
	}
	$result .= '</div>';
	$result .= '<p><a href="' . get_page_link( '125' ) . '" class="button expanded waves-effect" title="' . get_the_title( '125' ) . '">' . get_the_title( '125' ) . 'の一覧</a></p>';
	return $result;
}
/*
 * 相続関連ページにアドバイザーリンクを挿入するためだけのショートコード
 */
if ( ! function_exists( 'cta_adviser_post_link' ) ) :
function cta_adviser_post_link() {
	$posts = array( '2370', '2378' );
	$result = '<h2>認定を受けた相続アドバイザー・上級アドバイザーが<br>相続手続全般のご相談・サポートを行っております。</h2>';
	$result .= '<div id="cta-member-carousel">';
	foreach ( $posts as $post ) {
		$result .= '<div class="slide-item bg-mask-wrapper">';
		$result .= '<a href="' . get_permalink( $post ) . '" title="' . get_the_title( $post ) . '" class="waves-effect bg-mask"></a>';
		$img_id = get_post_thumbnail_id( $post );
		$img_url = wp_get_attachment_image_src( $img_id, 'full', true );
		$result .= '<div class="img-wrapper"><img data-lazy="' . $img_url[0] . '" alt="' . get_the_title() . '" width="' . $img_url[1] . '" height="' . $img_url[2] . '"></div>';
		$result .= '<div class="meta-name"><span class="meta-works">' .get_post_meta( $post, 'subtitle', true ) . '</span>' . get_the_title( $post ) . '</div>';
		$result .= '</div>';
	}
	$result .= '</div>';
	$result .= '<p><a href="' . get_page_link( '125' ) . '" class="button expanded waves-effect" title="' . get_the_title( '125' ) . '">' . get_the_title( '125' ) . 'の一覧</a></p>';
	return $result;
}
add_shortcode( 'link-adviser', 'cta_adviser_post_link' );
endif;
/*
 * 離婚後の生活設計ページ
 */
if ( ! function_exists( 'cta_aftersupport_link' ) ) :
function cta_aftersupport_link() {
	$posts = array( '2370', '3810', '4105' );
	$result = '<h2>私たちが離婚後の生活設計をサポートします</h2>';
	$result .= '<div id="cta-member-carousel">';
	foreach ( $posts as $post ) {
		$result .= '<div class="slide-item bg-mask-wrapper">';
		$result .= '<a href="' . get_permalink( $post ) . '" title="' . get_the_title( $post ) . '" class="waves-effect bg-mask"></a>';
		$img_id = get_post_thumbnail_id( $post );
		$img_url = wp_get_attachment_image_src( $img_id, 'full', true );
		$result .= '<div class="img-wrapper"><img data-lazy="' . $img_url[0] . '" alt="' . get_the_title() . '" width="' . $img_url[1] . '" height="' . $img_url[2] . '"></div>';
		$result .= '<div class="meta-name"><span class="meta-works">' .get_post_meta( $post, 'subtitle', true ) . '</span>' . get_the_title( $post ) . '</div>';
		$result .= '</div>';
	}
	$result .= '</div>';
	$result .= '<p><a href="' . get_page_link( '125' ) . '" class="button expanded secondary waves-effect" title="' . get_the_title( '125' ) . '">メンバーの一覧</a></p>';
	return $result;
}
add_shortcode( 'link-supporter', 'cta_aftersupport_link' );
endif;
include( 'seminar.php' );
include( 'sozoku-form.php' );
