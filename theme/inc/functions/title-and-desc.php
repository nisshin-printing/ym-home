<?php
//========================  OGP挿入 ========================================================================//
if ( ! function_exists( 'dtdsh_load_ogp' ) && ! is_admin() ) :
function dtdsh_load_ogp() {
	global $post;
	$url = '';
	$title = wp_get_document_title();
	$site_name = DTDSH_SITENAME . ' - 広島の弁護士による無料相談';
	if ( is_singular() ) {
		$cont = $post->post_content;
		$preg = '/<img.*?src=(["\'])(.+?)\1.*?>i/';
		$url = get_the_permalink();
		$og_img = get_post_meta( $post->ID, 'og_img', true );
		$post_thumbnail = has_post_thumbnail();
		if ( ! empty( $post_thumbnail ) ) {
			$img_id = get_post_thumbnail_id();
			$img_arr = wp_get_attachment_image_src( $img_id, 'full' );
			$img = $img_arr[0];
		} elseif ( preg_match( $preg, $cont, $img_url ) ) {
			$img = $img_url[2];
		} else {
			$img = TURI . '/assets/img/og.png';
		}
	} else {
		$url = DTDSH_HOME_URL;
		if ( get_header_image() ) {
			$img = get_header_image();
		} else {
			$img = TURI . '/assets/img/og.png';
		}
	}
	$desc = '探しているのは「頼れる」広島の弁護士。「無料相談」「弁護士指名制度」「チーム制」「プライバシー保護」など中四国最大規模で最善の解決へ導きます。弁護士の業務広告に関する規定に違反する疑いのある裏付けのない「ナンバーワン」「専門制」「特化」などの言葉にご注意ください。';
?>
<meta property="og:type" content="<?php echo ( is_singular() ? 'article' : 'website' ); ?>">
<meta property="og:url" content="<?php echo $url; ?>">
<meta property="og:title" content="<?php echo $title; ?>">
<meta property="og:description" content="<?php echo $desc; ?>">
<meta property="og:image" content="<?php echo $img; ?>">
<meta property="og:site_name" content="<?php echo $site_name; ?>">
<meta property="og:locale" content="ja_JP">
<meta property="fb:app_id" content="1469026710042384">
<?php
if( is_singular() ) :
	$published_time = get_post( $post->ID )->post_date;
	$published_time = str_replace( ' ', 'T', $published_time ) . 'Z';
	$modified_time = get_post( $post->ID )->post_modified;
	$modified_time = str_replace( ' ', 'T', $modified_time ) . 'Z';
?>
<meta property="article:published_time" content="<?php echo $published_time ?>">
<meta property="article:modified_time" content="<?php echo $modified_time ?>"><?php
endif;
}
add_filter( 'wp_head', 'dtdsh_load_ogp', 3 );
endif;