<?php
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
add_shortcode( 'members-link', 'cta_members_link' );
function cta_members_link( $atts ) {
	extract(
		shortcode_atts(
			array(
				'title' => '女性のための女性弁護士はこんな人です',
				'members' => '562,4087,4092'
			), $atts
		)
	);
	$members = explode( ',', $members );
	$result = "<h2>$title</h2>";
	foreach ( $members as $member ) {
		$job = ( get_post_meta ( $member, 'subtitle', true ) ) ? get_post_meta ( $member, 'subtitle', true )  : '';
		$result .= '<article class="post post--members" itemscope itemtype="http://schema.org/Article" itemref="author-prof">
	<meta itemprop="description" content="' . get_the_excerpt( $member ) . '">
	<ul class="post--meta menu">
		<li class="published" itemprop="datePublished dateCreated" datetime="' . get_the_date( 'Y-m-d', $member ) . '"></li>
		<li class="updated" itemprop="dateModified" datetime="' . get_the_modified_time( 'Y-m-d', $member ) . '"></li>
		<li class="author hide" itemprop="author copyrightHolder editor" itemscope itemtype="http://schema.org/Person"><span class="author" itemprop="name">' . get_the_title( $member ) . '</span></li>
	</ul>
	<div class="row align-middle">
		<div class="column small-3"><a href="' . get_the_permalink( $member ) . '">' . get_the_post_thumbnail( $member ) . '</a></div>
		<div class="column small-9">
			<h3 itemprop="about headline" class="entry-title post--title">
				<a href="' . get_the_permalink( $member ) . '">' . get_the_title( $member ) . '<span class="title--small title--block">' . $job . '</span>
				</a>
			</h3>
		</div>
	</div>
</article>';
	}
	$result .= '<p><a href="' . get_page_link( '125' ) . '" class="button expanded" title="' . get_the_title( '125' ) . '">' . get_the_title( '125' ) . 'の一覧</a></p>';
	return $result;
}

// 各オフィスへのアクセス
add_shortcode( 'office-access', 'office_access' );
function office_access() {
	$return = <<< EOT
<h2>広島・呉・東広島・福山・岩国・東京虎ノ門でご相談できます</h2>
<h3>広島本部</h3>
<p>広島本部長：　<a href="https://www.law-yamashita.com/members/shin-tanaka">田中伸</a></p>
<p><a href="https://www.law-yamashita.com/firm/access" class="button">広島本部へのアクセス</a></p>
<h3>呉支部</h3>
<p>呉支部長：　<a href="https://www.law-yamashita.com/members/%e5%ae%ae%e9%83%a8%e6%98%8e%e5%85%b8">宮部明典</a></p>
<p><a href="https://www.law-yamashita.com/lp/4137" class="button">呉支部の特設ページ</a></p>
<h3>東広島支部</h3>
<p>東広島支部長：　<a href="https://www.law-yamashita.com/members/%e5%b0%8f%e6%9e%97%e5%b9%b9%e5%a4%a7">小林幹大</a></p>
<p><a href="https://www.law-yamashita.com/lp/3674" class="button">東広島支部の特設ページ</a></p>
<h3>福山支部</h3>
<p>福山支部長：　<a href="https://www.law-yamashita.com/members/akiko-watanabe">渡辺晃子</a></p>
<p><a href="https://www.law-yamashita.com/lp/5585" class="button">福山支部の特設ページ</a></p>
<h3>岩国支部</h3>
<p>岩国支部長：　<a href="https://www.law-yamashita.com/members/mayumi-hirota">廣田麻由美</a></p>
<p><a href="https://iwakuni.law-yamashita.com" class="button">岩国支部サイト</a></p>
<h3>東京虎ノ門オフィス</h3>
<p>東京支部長：　<a href="https://www.law-yamashita.com/members/atsushi-oka">岡篤志</a></p>
<p><a href="https://tokyo.law-yamashita.com" class="button">東京虎ノ門オフィスサイト</a></p>
EOT;
	return $return;
}

include( 'seminar.php' );
include( 'sozoku-form.php' );
