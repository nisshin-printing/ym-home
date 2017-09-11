<?php
// PW保護ページタイトルから「保護中：」を削除
if ( ! function_exists( 'remove_protected' ) ) :
if ( ! is_admin() ) {
	function remove_protected( $title ) {
		return '%s';
	}
}
add_filter( 'protected_title_format', 'remove_protected' );
endif;
// PW記事のテキストを変更する
if ( ! function_exists( 'passpost_form_customize' ) ) :
function passpost_form_customize() {
	global $post;
	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post-ID );
	return '<h2>パスワード保護されています！</h2>
	<p>セミナー資料は、顧問会社様のみが閲覧いただけます。<a href="http://www.hiroshima-kigyo.com/158/" target="_blank" title="顧問契約とは？" class="link-external">顧問契約とは？</a><br>パスワードは、毎回、セミナー終了後に郵送でお知らせしています。<br>ご不明な場合は、お手数ですがお問い合わせください。<br>代表電話　：　082-223-0695</p>
	<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
	<p class="column large-12"><label class="column" for="' . $label . '">パスワード<input type="password" name="post_password" id="' . $label . '" maxlength="20"></label></p><p class="column large-12"><input class="button expand" type="submit" name="Submit" value="' . esc_attr__( "パスワードを認証" ) . '"></p>
	</form>';
}
add_filter( 'the_password_form', 'passpost_form_customize' );
endif;
// パスワード付記事での、パスワードエラーメッセージ
if ( ! function_exists( 'passpost_error_msg' ) ) :
function passpost_error_msg( $form ) {
	if ( ! isset( $_COOKIE['wp-postpass_' . COOKIEHASH] ) ) {
		return $form;
	}
	if ( wp_get_referer() == get_permalink() ) {
		$msg = esc_html__( 'パスワードが違います。', 'ringo' );
		$msg = '<p class="text-center bg-alert">' . $msg . '</p>';
		return $msg . $form;
	}
	return $form;
}
add_filter( 'the_password_form', 'passpost_error_msg' );
endif;

if ( ! function_exists( 'nid_postpass_time' ) ) :
function nid_postpass_time() {
	require_once ABSPATH . 'wp-includes/class-phpass.php';
	$hasher = new PasswordHash( 8, true );
	setcookie( 'wp-postpass_' . COOKIEHASH, $hasher->HashPassword( wp_unslash( $_POST['post_password'] ) ), time() + HOUR_IN_SECONDS, COOKIEPATH );
	wp_safe_redirect( wp_get_referer() );
	exit();
}
add_action( 'login_form_postpass', 'nid_postpass_time' );
endif;
