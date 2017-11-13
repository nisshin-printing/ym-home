<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$labels = array(
	'name'               => _x( '解決事例', 'ringo' ),
	'singular_name'      => _x( '解決事例', 'ringo' ),
	'add_new'            => _x( '新規追加', 'ringo' ),
	'add_new_item'       => _x( '新しい解決事例を追加', 'ringo' ),
	'edit_item'          => _x( '解決事例を編集', 'ringo' ),
	'new_item'           => _x( '新しい解決事例', 'ringo' ),
	'all_items'          => _x( '解決事例', 'ringo' ),
	'view_item'          => _x( '解決事例を見る', 'ringo' ),
	'search_items'       => _x( '解決事例を検索', 'ringo' ),
	'not_found'          => _x( '解決事例が見つかりません', 'ringo' ),
	'not_found_in_trash' => _x( 'ゴミ箱に解決事例はありません', 'ringo' ),
	'parent_item_colon'  => _x( '親アイテム', 'ringo' ),
	'menu_name'          => _x( '解決事例', 'ringo' ),
	'show_in_rest'       => true
);
register_post_type( 'cases', array(
	'labels'             => $labels,
	'public'             => true,
	'menu_icon'          => 'dashicons-book-alt',
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => 'edit.php',
	'show_in_nav_menus'  => true,
	'query_var'          => true,
	'rewrite'            => true,
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => true,
	'menu_position'      => 6,
	'supports'           => array( 'title', 'editor', 'thumbnail' ),
	'show_in_rest'       => true
) );
register_taxonomy(
	"cases-cat",
	"cases",
	array(
		"label" => '解決事例カテゴリー',
		"hierarchical" => true,
		"show_admin_column" => true,
		'rewrite' => array( 'slug' => 'cases-category' ),
		'show_in_rest' => true,
		'rest_base' => 'cases-category'
	)
);
register_taxonomy(
	"cases-tag",
	"cases",
	array(
		"label" => '解決事例タグ',
		"hierarchical" => false,
		"show_admin_column" => true,
		'show_in_rest' => true
	)
);
// Custom field inputbox
add_action('admin_menu', 'add_cases_box');
add_action('save_post', 'save_cases_box');
function save_cases_box( $post_id ) {
	global $post;
	$my_nonce = isset( $_POST['my_nonce'] ) ? $_POST['my_nonce'] : null;
	if ( ! wp_verify_nonce( $my_nonce, wp_create_nonce( __FILE__ ) ) ) {
		$post_id = isset( $_GET['post_id'] ) ? htmlspecialchars( $_GET['post_id'] ) : null;
		return $post_id;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }
	if ( ! current_user_can('edit_post', $post->ID ) ) { return $post_id; }
	if ( 'cases' == $_POST['post_type'] ) {
		update_post_meta( $post->ID, 'duration', $_POST['duration'] );
		update_post_meta( $post->ID, 'box_numbers', $_POST['box_numbers'] );
	}
	if ( 'cases' == $_POST['post_type'] && isset( $_POST['charge_lawyer'] ) ) {
		update_post_meta( $post->ID, 'charge_lawyer', $_POST['charge_lawyer'] );
	} else {
		update_post_meta( $post->ID, 'charge_lawyer', null );
	}
}
function add_cases_box() {
	add_meta_box(
		'cases-duration',
		'解決事例メタ情報',
		'cases_add_duration',
		'cases',
		'normal',
		'high'
	);
	add_meta_box(
		'cases-charge-lawyer',
		'担当弁護士',
		'cases_add_charge_lawyer',
		'cases',
		'normal',
		'high'
	);
}
// HTML / PHP Code Field
function cases_add_duration() {
	global $post;
	wp_nonce_field( wp_create_nonce( __FILE__ ), 'my_nonce' );
?>
<div id="cases-duration">
	<p>解決事例の管理番号を入力してください。</p>
	<p><label>管理番号<br><input type="text" name="box_numbers" value="<?php echo get_post_meta( $post->ID, 'box_numbers', true ); ?>" placeholder="管理番号" style="width: 80%"></label></p>
	<p>
		解決までに実際にかかった期間を月単位で入力してください。<br>
		未記入の場合は、解決までの期間が表示されません。
	</p>
	<p>
		<label>解決にかかった期間<br>
			<input type="text" name="duration" value="<?php echo esc_html( get_post_meta( $post->ID, 'duration', true ) ); ?>" placeholder="解決にかかった期間" style="width: 80%">
		</label>
	</p>
</div>
<?php
}
function cases_add_charge_lawyer() {
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
	if ( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post();
	if ( array_search( $post->ID, $get_lawyer_check ) !== FALSE && array_search( $post->ID, $get_lawyer_check ) !== null ) {
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
