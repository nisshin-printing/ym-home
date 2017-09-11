<?php
if(!defined('ABSPATH'))exit;
$labels = array(
	'name' 					=> _x('相談者様の声','ringo'),
	'singular_name' 		=> _x('相談者様の声','ringo'),
	'add_new' 				=> _x('新規追加','ringo'),
	'add_new_item' 			=> _x('新しい相談者様の声を追加','ringo'),
	'edit_item' 			=> _x('相談者様の声を編集','ringo'),
	'new_item' 				=> _x('新しい相談者様の声','ringo'),
	'all_items' 			=> _x('相談者様の声','ringo'),
	'view_item' 			=> _x('相談者様の声を見る','ringo'),
	'search_items' 			=> _x('相談者様の声を検索','ringo'),
	'not_found' 			=> _x('相談者様の声が見つかりません','ringo'),
	'not_found_in_trash' 	=> _x('ゴミ箱に相談者様の声はありません','ringo'),
	'parent_item_colon' 	=> _x('親アイテム','ringo'),
	'menu_name' 			=> _x('相談者様の声','ringo'),
);
register_post_type('advice', array(
	'labels' 				=> $labels,
	'public' 				=> true,
	'menu_icon' 			=> 'dashicons-format-chat',
	'publicly_queryable' 	=> true,
	'show_ui' 				=> true,
	'show_in_menu'          => 'edit.php',
	'show_in_nav_menus' 	=> true,
	'query_var' 			=> true,
	'rewrite' 				=> true,
	'capability_type' 		=> 'post',
	'has_archive' 			=> true,
	'hierarchical' 			=> true,
	'menu_position' 		=> 6,
	'supports' 				=> array('title','editor','thumbnail')
));
register_taxonomy(
	"advice-cat",
	"advice",
	array(
		"label" => __('相談者様カテゴリー'),
		"hierarchical" => true,
		"show_admin_column" => true,
		'rewrite' => array('slug' => 'advice-category')
	)
);
register_taxonomy(
	"advice-tag",
	"advice",
	array(
		"label" => __('相談者様タグ'),
		"hierarchical" => false,
		"show_admin_column" => true
	)
);

// Custom field inputbox
add_action('admin_menu', 'add_advice_box');
add_action('save_post', 'save_advice_box');
function save_advice_box( $post_id ) {
	global $post;
	$my_nonce = isset( $_POST['my_nonce'] ) ? $_POST['my_nonce'] : null;
	if ( ! wp_verify_nonce( $my_nonce, wp_create_nonce( __FILE__ ) ) ) {
		$post_id = isset( $_GET['post_id'] ) ? htmlspecialchars( $_GET['post_id'] ) : null;
		return $post_id;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }
	if ( ! current_user_can( 'edit_post', $post->ID ) ) { return $post_id; }
	if ( 'advice' == $_POST['post_type'] && isset( $_POST['charge_lawyer'] ) ) {
		update_post_meta( $post->ID, 'charge_lawyer', $_POST['charge_lawyer'] );
	} else {
		update_post_meta( $post->ID, 'charge_lawyer', null );
	}
}
function add_advice_box() {
	add_meta_box(
		'advice-charge-lawyer',
		'関連するメンバー',
		'advice_add_charge_lawyer',
		'advice',
		'normal',
		'high'
	);
}
function advice_add_charge_lawyer() {
	global $post;
	wp_nonce_field( wp_create_nonce( __FILE__ ), 'my_nonce' );
	$get_lawyer_check = get_post_meta( $post->ID, 'charge_lawyer', true );
?>
<div id="cases-charge-lawyer">
<p>担当弁護士・アドバイザーを選択してください。</p>
<p>
<label>
<div id="mem-search-panel">
<select name="charge_lawyer[]" multiple size="5" style="width: 80%; height: 10em;">
<?php
	$args = array(
		'post_type' => 'members',
		'posts_per_page' => '-1',
		'orderby' => 'ID',
		'order' => 'ASC'
	);
	$loop = new WP_Query($args);
	if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();
	if(array_search($post->ID, $get_lawyer_check) !== FALSE && array_search($post->ID, $get_lawyer_check) !== null ) {
		$checked = ' selected';
	} else {
		$checked = '';
	}
?>
<option value="<?php the_ID(); ?>"<?php echo $checked; ?>><?php the_title(); ?></option>
<?php endwhile; endif; ?>
</select>
</div>
</label>
</p>
</div>
<?php }