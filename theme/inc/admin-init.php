<?php
// ============================== Editor Style ============================================================================= //
if ( ! function_exists( 'dtdsh_editor_settings' ) ) :
function dtdsh_editor_settings( $initArray ) {
	$initArray['body_class'] = 'editor-area';
	$initArray['block_formats'] = '見出し2=h2; 見出し3=h3; 見出し4=h4; 段落=p; グループ=div;';
	// スタイリング用クラス
	$style_formats = array(
		array(
			'title' => '蛍光マーカー',
			'inline' => 'span',
			'classes' => 'bg-line'
		)
	);
	$initArray['style_formats'] = json_encode( $style_formats );
	return $initArray;
}
add_filter( 'tiny_mce_before_init', 'dtdsh_editor_settings' );
endif;
add_editor_style( TCSS . 'editor-style.css' );
// ============================== Dashboard ============================================================================= //
// Recent Posts
function dashboard_admin_init() {
	add_action('pre_get_posts', 'dashboard_site_activity_recent_posts');
}
add_action('admin_init', 'dashboard_admin_init');
function dashboard_site_activity_recent_posts($query) {
	foreach(debug_backtrace() as $trace) {
		if($trace['function'] == 'wp_dashboard_recent_posts') {
			$query->set('post_type', array('cases', 'members', 'voice', 'post', 'page'));
			break;
		}
	}
}
// Glance items
function mytheme_dashboard_glance_items( $elements ) {
	foreach ( array('cases', 'members', 'voice', 'post', 'page') as $post_type ) {
		$num_posts = wp_count_posts( $post_type );
		if ( $num_posts && $num_posts->publish ) {
			$text = number_format_i18n( $num_posts->publish ).'件の投稿';
			$elements[] = sprintf( '<a href="edit.php?post_type=%1$s" class="%1$s-count">%2$s</a>', $post_type, $text );
		}
	}
	return $elements;
}
add_filter( 'dashboard_glance_items', 'mytheme_dashboard_glance_items' );

// WP_Widgets Display None
function unregisterWidgets() {
	/* ---------------------------------------------------------
		// Defalut
		WP_Widget_Archives        : アーカイブ
		WP_Widget_Calendar        : カレンダー
		WP_Widget_Categories      : カテゴリー
		WP_Widget_Links           : リンク
		WP_Widget_Meta            : メタ
		WP_Widget_Pages           : ページ
		WP_Widget_Recent_Comments : 最近のコメント
		WP_Widget_Recent_Posts    : 最近の投稿
		WP_Widget_RSS             : RSS
		WP_Widget_Search          : 検索 (検索フォーム)
		WP_Widget_Tag_Cloud       : タグクラウド
		WP_Widget_Text            : テキスト
		WP_Nav_Menu_Widget        : カスタムメニュー
		// Google Analytics
		GADWP_Frontend_Widget     : サイドバーウィジェット
	--------------------------------------------------------- */
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('GADWP_Frontend_Widget');
}
add_action( 'widgets_init', 'unregisterWidgets', 11 );
