<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Sliders Post type
$labels = array(
	'name'                  => _x('スライド','dtdsh'),
	'singular_name'         => _x('スライド','dtdsh'),
	'add_new'               => _x('新規追加','dtdsh'),
	'add_new_item'          => _x('新しいスライドを追加','dtdsh'),
	'edit_item'             => _x('スライドを編集','dtdsh'),
	'new_item'              => _x('新しいスライド','dtdsh'),
	'all_items'             => _x('スライド','dtdsh'),
	'view_item'             => _x('スライドを見る','dtdsh'),
	'search_items'          => _x('スライドを検索','dtdsh'),
	'not_found'             => _x('スライドが見つかりません','dtdsh'),
	'not_found_in_trash'    => _x('ゴミ箱にスライドはありません','dtdsh'),
	'parent_item_colon'     => _x('親アイテム','dtdsh'),
	'menu_name'             => _x('スライド','dtdsh'),
);
register_post_type('dtdsh-slides', array(
	'labels'                => $labels,
	'public'                => false,
	'menu_icon'             => 'dashicons-images-alt2',
	'publicly_queryable'    => false,
	'exclude_from_search'   => true,
	'show_ui'               => true,
	'show_in_menu'          => 'edit.php',
	'show_in_nav_menus'     => false,
	'query_var'             => true,
	'rewrite'               => true,
	'capability_type'       => 'post',
	'has_archive'           => false,
	'hierarchical'          => false,
	'menu_position'         => 10,
	'supports'              => array( 'title', 'editor', 'thumbnail' )
));
register_taxonomy(
	"dtdsh-sliders",
	"dtdsh-slides",
	array(
		"label"             => __( 'スライダー', 'dtdsh' ),
		"hierarchical"      => false,
		"show_admin_column" => true
	)
);
add_action( 'admin_menu', 'add_sliders_options' );
add_action( 'save_post', 'save_sliders_options' );
function save_sliders_options( $post_id ) {
	global $post;
	$my_nonce = isset( $_POST['my_nonce'] ) ? $_POST['my_nonce'] : null;
	if ( ! wp_verify_nonce( $my_nonce, wp_create_nonce( __FILE__ ) ) ) {
		$post_id = isset( $_GET['post_id'] ) ? htmlspecialchars( $_GET['post_id'] ) : null;
		return $post_id;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }
	if ( ! current_user_can( 'edit_post', $post->ID ) ) { return $post_id; }
	if ( 'dtdsh-slides' == $_POST['post_type'] ) {
		update_post_meta( $post->ID, 'slider_link', $_POST['slider_link'] );
		update_post_meta( $post->ID, 'slider_link_title', $_POST['slider_link_title'] );
	}
}
function add_sliders_options() {
	add_meta_box(
		'sliders-options',
		'スライダーオプション',
		'add_sliders_metabox',
		'dtdsh-slides',
		'normal',
		'high'
	);
}
function add_sliders_metabox() {
	global $post;
	wp_nonce_field( wp_create_nonce( __FILE__ ), 'my_nonce' );
?>
<div id="sliders-options">
	<p>スライダーのオプション設定です。</p>
	<p>
		<label>スライドにリンクを設定できます。</label>
		<input type="url" name="slider_link" value="<?php echo esc_url( get_post_meta( $post->ID, 'slider_link', true ) ); ?>" placeholder="スライドのリンク先" style="width: 100%;">
	</p>
	<p>
		<label>スライドリンクのtitleを設定できます。</label>
		<input type="text" name="slider_link_title" value="<?php echo esc_attr( get_post_meta( $post->ID, 'slider_link_title', true ) ); ?>" placeholder="スライドのリンクのタイトル" style="width: 100%;">
	</p>
</div>
<?php
}