<?php
// スライダー
include_once( 'post-type/slides.php' );
// メンバー
include_once( 'post-type/members.php' );
// 解決事例
include_once( 'post-type/cases.php' );
// 相談者の声
include_once( 'post-type/advice.php' );
// 依頼者の声
include_once( 'post-type/client.php' );
// CTA
include_once( 'post-type/cta.php' );
// LP
include_once( 'post-type/lp.php' );

// POSTに関連するメンバー選択欄を追加
add_action( 'admin_menu', 'add_relate_members' );
add_action( 'save_post', 'save_relate_members' );
function save_relate_members( $post_id ) {
	global $post;
	$my_nonce = isset( $_POST['my_nonce'] ) ? $_POST['my_nonce'] : null;
	if ( ! wp_verify_nonce( $my_nonce, wp_create_nonce( __FILE__ ) ) ) {
		$post_id = isset( $_GET['post_id'] ) ? htmlspecialchars( $_GET['post_id'] ) : null;
		return $post_id;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }
	if ( ! current_user_can('edit_post', $post->ID ) ) { return $post_id; }
	if ( 'post' == $_POST['post_type'] && isset( $_POST['charge_lawyer'] ) ) {
		update_post_meta( $post->ID, 'charge_lawyer', $_POST['charge_lawyer'] );
	} else {
		update_post_meta( $post->ID, 'charge_lawyer', null );
	}
}
function add_relate_members() {
	add_meta_box(
		'relate-members',
		'関連するメンバー',
		'box_add_relate_members',
		'post',
		'side',
		'default'
	);
}
function box_add_relate_members() {
	global $post;
	wp_nonce_field( wp_create_nonce( __FILE__ ), 'my_nonce' );
	$get_lawyer_check = get_post_meta( $post->ID, 'charge_lawyer', true );
echo '<div id="relate-members">
	<p>関連するメンバーを選択してください。</p>
	<p><label><div id="mem-search-panel">
		<select name="charge_lawyer[]" multiple size="5" style="width: 100%; height: 10em;">';
	$args = array(
		'post_type' => 'members',
		'posts_per_page' => -1,
		'orderby' => 'ID',
		'order' => 'ASC'
	);
	$loop = new WP_Query( $args );
	if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
		$checked = ( FALSE !== array_search( $post->ID, $get_lawyer_check ) && null !== array_search( $post->ID, $get_lawyer_check ) ) ? ' selected' : '';
	echo '<option value="', get_the_ID(), '"', $checked, '>', get_the_title(), '</option>';
	endwhile;
	wp_reset_postdata();
	endif;
	echo '</select>
		</div></label></p>
	</div>';
}