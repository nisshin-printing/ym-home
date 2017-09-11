<?php
/*
 *
 * define( 'DTDSH_HOME_URL', home_url( '/' ) );
 * define( 'DTDSH_SITENAME', get_bloginfo( 'name' ) );
 * define( 'DTDSH_DESCRIPTION', get_bloginfo( 'description' ) );
 * define( 'DSEP', DIRECTORY_SEPARATOR );
 * define( 'TPATH', get_template_directory() . DSEP );
 * define( 'TURI', get_template_directory_uri() . DSEP );
 * define( 'INC', TPATH . 'inc' . DSEP );
 * define( 'SURI', get_stylesheet_uri() );
 * define( 'TASSETS', TURI . 'assets' . DSEP );
 * define( 'TIMG', TURI . 'assets' . DSEP . 'img' . DSEP );
 * define( 'TCSS', TURI . 'assets' . DSEP . 'css' . DSEP );
 * define( 'TJS', TURI . 'assets' . DSEP . 'js' . DSEP );
 * define( 'TFRONT', INC . 'front-page' . DSEP );
 * define( 'TADMIN', INC . 'admin' . DSEP );
 * define( 'TFUNC', INC . 'functions' . DSEP );
 *
 *
 */
if ( ! function_exists( 'dtdsh_theme' ) ) :
function dtdsh_theme() {
	require_once( TFUNC . 'headfunc.php' );
	require_once( TFUNC . 'sidefunc.php' );
	require_once( TFUNC . 'footfunc.php' );
	require_once( TFUNC . 'postpassfunc.php' );
	require_once( TFUNC . 'video-thumbnail.php' );
	require_once( TFUNC . 'rss-feed.php' );
	include_once( INC . 'law-yamashita-login.php' );
	require_once( INC . 'dtdsh-func.php' );
	require_once( INC . 'dtdsh-ajax.php' );
	require_once( INC . 'dtdsh-shortcode.php' );
	/*
	 * Debug
	 */
	// require_once( TFUNC . 'dev--enqueued-list.php' );
	if ( is_admin() ) {
		require_once( INC . 'admin-init.php' );
	}
}
add_action( 'after_setup_theme', 'dtdsh_theme' );
endif;


// JetPackは不要
add_filter( 'jetpack_implode_frontend_css', '__return_false' );

// Contact Form 7　のファイルは不要
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );
function dtdshtheme_styles() {
	wp_deregister_style( 'jetpack_css-css' );
	wp_register_style( 'theme-style', TCSS . 'style.css', array(), NULL, false );
	wp_enqueue_style( 'theme-style' );
	if ( function_exists( 'wpcf7_enqueue_styles' ) && is_page( array( '1185', '1172', '1153', '1161', '1167', '1144', '1176', '2528', '1155', '1179' ) ) ) {
		wpcf7_enqueue_styles();
	}
}
add_action( 'wp_enqueue_scripts', 'dtdshtheme_styles' );

function dtdshtheme_scripts() {
	wp_deregister_script( 'devicepx' );
	wp_dequeue_script( 'devicepx' );
	wp_deregister_script( 'devicepx-jetpack' );
	wp_dequeue_script( 'devicepx-jetpack' );

	if ( ! is_admin() ) {
		// wp_deregister_script( 'jquery' );
		// wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', array(), NULL, true );
		// wp_register_script( 'jquery', TJS . 'jquery-2.2.4.min.js', array(), NULL, true );
	}

	wp_register_script( 'theme-app', TJS . 'apps.min.js', array( 'jquery' ), NULL, true );
	wp_register_script( 'google-map', '//maps.googleapis.com/maps/api/js?key=AIzaSyAN4kMQJOMnCR-Y0GR8QylbjAZiHLGm2UE', array(), NULL, false );
	// wp_register_script( 'google-map', TJS . 'google-map.min.js', array(), NULL, false );

	if ( is_page( '281' ) ) {
		wp_enqueue_script( 'google-map' );
	}
	if ( function_exists( 'wpcf7_enqueue_scripts' ) && is_page( array( '1185', '1172', '1153', '1161', '1167', '1144', '1176', '2528', '1155', '1179', '3545' ) ) ) {
		wpcf7_enqueue_scripts();
	}
	wp_enqueue_script( 'theme-app' );
	wp_localize_script( 'theme-app', 'dtdsh_vars', array(
		'homeurl' => DTDSH_HOME_URL,
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	) );
}
add_action( 'wp_enqueue_scripts', 'dtdshtheme_scripts' );

function google_tag_manager_install() {
echo <<< EOT
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MM3VKH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MM3VKH');</script>
<!-- End Google Tag Manager -->
EOT;
}


function dtdsh_favicons() {
	$test = TIMG . 'test-favicon.ico';
	$master = TIMG . 'favicon.ico';
	$favicons_default = ( preg_match( '/dev/', $_SERVER['SERVER_NAME'] ) ) ? $test : $master;
	$faviconarray = '<link rel="icon" href="' . $favicons_default . '">';
	$faviconarray .=  '<link rel="apple-touch-icon" href="' . $favicons_default . '" sizes="76x76">';
	$faviconarray .=  '<link rel="apple-touch-icon"  href="' . $favicons_default . '"  sizes="120x120">';
	$faviconarray .=  '<link rel="apple-touch-icon"  href="' . $favicons_default . '"  sizes="152x152">';
	$faviconarray .=  '<meta name="msapplication-TileImage" content="' . $favicons_default . '"><meta name="msapplication-TileColor"> <meta name="application-name" content="' .  DTDSH_SITENAME . '">';
	$faviconarray .=  '<meta name="msapplication-square70x70logo" content="' . $favicons_default . '">';
	$faviconarray .=  '<meta name="msapplication-square150x150logo" content="' . $favicons_default . '">';
	$faviconarray .=  '<meta name="msapplication-square310x310logo" content="' . $favicons_default . '">';
	echo $faviconarray;
}
add_action( 'wp_head', 'dtdsh_favicons' );
add_action(' admin_head', 'dtdsh_favicons' );

// HTML_Format
if ( ! function_exists( 'dtdsh_html_format' ) ) :
function dtdsh_html_format( $contents, $on_s = true ) {
	// 連続改行削除
	if ( ! $on_s ) {
		$contents = preg_replace( '/(\n|\r|\r\n)+/us', "", $contents );
	} else {
		$contents = preg_replace( '/(\n|\r|\r\n)+/us', "\n", $contents );
	}
	// 行頭の余計な空白削除
	$contents = preg_replace( '/\n+\s*</', "\n" . '<', $contents );
	// タグ間の余計な空白や改行の削除
	$contents = preg_replace( '/>\s*?</', '><',$contents );
	// タブの削除
	$contents = str_replace( "\t", '', $contents );
	// ?ver= と ?=fit の除去
	$contents = preg_replace( '/\?(?:ver|fit)=(?:\S+)([\'|\"])/', '\1', $contents );
	return $contents;
}
add_filter( 'wp_nav_menu', 'dtdsh_html_format', 10, 2 );
endif;

// バージョン番号のせいで、キャッシュができない...
// 全部消せます！　そう、日進印刷ならね。
if ( ! function_exists( 'remove_url_version' ) ) :
function remove_url_version( $arg ) {
	if ( strpos( $arg, '?ver=' ) ) {
		$arg = esc_url( remove_query_arg( 'ver', $arg ) );
	}
	return $arg;
}
apply_filters( 'style_loader_src', 'remove_url_version', 99 );
apply_filters( 'script_loader_src', 'remove_url_version', 99 );
endif;

// page-404 をキャッシュさせる
function remove_nocache_404() {
	if ( is_404() ) {
		header_remove( "Pragma" );
		header_remove( "Cache-Control" );
		header_remove( "Expires" );
	}
}
add_action( 'wp', 'remove_nocache_404' );

/*
 * WordPressが生成するタグを削除
 * WordPressよ。<head>内を汚すな。
 */
//========================  WordPress ========================================================================//
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles', 10 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

//========================  Admin ========================================================================//
// Wordpress update disappear
if ( ! current_user_can( 'administrator' ) ) {
	add_filter( 'pre_site_transient_update_core', create_function( '$a', 'return null;' ) );
}
// Wordpress admin bar disappear
function wp_admin_bar_disappear() {
	global $wp_admin_bar;
	$wp_admin_bar -> remove_menu( 'wp-logo' );
	$wp_admin_bar -> remove_menu( 'update' );
	$wp_admin_bar -> remove_menu( 'comments' );
}
add_action( 'wp_before_admin_bar_render', 'wp_admin_bar_disappear' );
// Admin page at Footer disappear
function custom_admin_footer() {
	echo '<div id="wpfooter" role="contentinfo"><p id="footer-left" class="alignleft"><span id="footer-thankyou">Ringo+ for Law-Yamashita</span></p><p id="footer-upgrade" class="alignright"><p id="footer-upgrade" class="alignright">' .apply_filters( 'update_footer', '' ).'</p><div class="clear"></div></div>';
}
add_filter( 'admin_footer_text', 'custom_admin_footer' );
/*
 * テストサイトの場合、canonical属性を削除し、本番環境URLを挿入
 */
if ( preg_match( '/dev/', $_SERVER['SERVER_NAME'] ) && ! is_admin() ) {
	remove_action( 'wp_head', 'rel_canonical' );
	add_action( 'wp_head', function() {
		echo '<link rel="canonical" href="https://www.law-yamashita.com', $_SERVER['REQUEST_URI'], '">';
	});
}

/*
 * DNSプリフェッチ
 */
function dtdsh_dns_prefetch() {
	$urls = array(
		/* Developement */
		'dev.law-yamashita',
		'7834-09.law-yamashita',

		/* Jucer */
		'juicer-201510231014-logserverstack-s3improvement-1ae9o7c4djwtf.s3-ap-northeast-1.amazonaws.com',
		'kitchen.juicer.cc',

		/* google */
		'maps.googleapis.com',
		'apis.google.com',
		'ajax.googleapis.com',
		'maps.gstatic.com',
		'ssl.gstatic.com',
		'csi.gstatic.com',
		'fonts.gstatic.com',
		's.ytimg.com',
		'www.youtube.com',
		'www.google.com',
		'www.google-analytics.com',
		'www.googleadservices.com',
		'fonts.googleapis.com',
		'www.google.co.jp',
		'accounts.google.com',
		'www.googletagmanager.com',
		'yt3.ggpht.com',
		'lh3.googleusercontent.com',
		'lh4.googleusercontent.com',
		'googleads.g.doubleclick.net',
		'stats.g.doubleclick.net',

		/* facebook */
		'static.xx.fbcdn.net',
		'scontent.xx.fbcdn.net',
		'external.xx.fbcdn.net',
		'www.facebook.com',
		'staticxx.facebook.com',
		'connect.facebook.net',
		'graph.facebook.com',

		/* MyBestPro */
		'mbp-hiroshima.com',

		// CDN
		'cdn.jsdelivr.net',
		'maxcdn.bootstrapcdn.com',
	);
	foreach ( $urls as $url ) {
		printf( '<link rel="dns-prefetch" href="//%s">', esc_attr( $url ) );
	}
}
add_action( 'wp_head', 'dtdsh_dns_prefetch', 0, 0 );
