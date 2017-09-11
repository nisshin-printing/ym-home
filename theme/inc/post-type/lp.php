<?php
	if (!defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Sliders Post type
$labels = array(
	'name'                  => _x( 'LP','dtdsh' ),
	'singular_name'         => _x( 'LP','dtdsh' ),
	'add_new'               => _x( '新規追加','dtdsh' ),
	'add_new_item'          => _x( '新しいLPを追加','dtdsh' ),
	'edit_item'             => _x( 'LPを編集','dtdsh' ),
	'new_item'              => _x( '新しいLP','dtdsh' ),
	'all_items'             => _x( 'LP','dtdsh' ),
	'view_item'             => _x( 'LPを見る','dtdsh' ),
	'search_items'          => _x( 'LPを検索','dtdsh' ),
	'not_found'             => _x( 'LPが見つかりません','dtdsh' ),
	'not_found_in_trash'    => _x( 'ゴミ箱にLPはありません','dtdsh' ),
	'parent_item_colon'     => _x( '親アイテム','dtdsh' ),
	'menu_name'             => _x( 'LP','dtdsh' ),
);
register_post_type('dtdsh-lp', array(
	'labels'                => $labels,
	'public'                => true,
	'menu_icon'             => false,
	'publicly_queryable'    => true,
	'exclude_from_search'   => true,
	'show_ui'               => true,
	'show_in_menu'          => 'edit.php',
	'show_in_nav_menus'     => false,
	'query_var'             => true,
	'rewrite'               => array(
		'slug' => 'lp'
	),
	'capability_type'       => 'post',
	'has_archive'           => false,
	'hierarchical'          => false,
	'menu_position'         => 10,
	'supports'              => array(
		'title',
		'editor',
		'thumbnail'
	)
) );
add_action('admin_menu', 'add_lp_options');
add_action('save_post', 'save_lp_options');
function save_lp_options() {
	global $post;
	$my_nonce = isset($_POST['my_nonce']) ? $_POST['my_nonce'] : null;
	if(!wp_verify_nonce($my_nonce, wp_create_nonce(__FILE__))) {
		$post_id = isset($_GET['post_id']) ? htmlspecialchars($_GET['post_id']) : null;
		return $post_id;
	}
	if(define('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return $post_id; }
	if(!current_user_can('edit_post', $post->ID)) { return $post_id; }
	if($_POST['post_type'] == 'dtdsh-lp') {
		update_post_meta($post->ID, 'lp_form', $_POST['lp_form']);
	}
}
function add_lp_options() {
	add_meta_box(
		'lp-options',
		'フォーム設定',
		'add_lp_metabox',
		'dtdsh-lp',
		'normal',
		'high'
	);
}
function add_lp_metabox() {
	global $post;
	wp_nonce_field( wp_create_nonce( __FILE__ ), 'my_nonce' );
	$get_form_check = get_post_meta( $post->ID, 'lp_form', true );
?>
<div id="lp-options">
	<p>クロージングとなるお問い合わせフォームを選択してください。</p>
	<p>まだ作成していない・選ぶものがない場合は、<a href="<?php echo admin_url( 'admin.php?page=wpcf7' ); ?>" title="お問い合わせフォーム作成画面" target="_blank">こちら</a>よりお問い合わせフォームを作成してください。</p>
	<p>
		<label for="lp_form">表示したいフォームを選択してください。</label>
		<select name="lp_form" id="lp_form" style="width: 100%;">
			<?php
				$args = array(
					'orderby' => 'ID',
					'order' => 'ASC',
					'post_status' => 'publish',
					'posts_per_page' => '-1',
					'post_type' => 'wpcf7_contact_form'
				);
				$loop = new WP_Query( $args );
				if ( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post();
					$selected = ( $get_form_check == get_the_ID() ) ? 'selected' : '';
			?>
			<option value="<?php the_ID(); ?>" <?php echo $selected; ?>><?php the_title(); ?></option>
			<?php
				endwhile; else:
				echo '<option value="0">フォームがまだありません。作成してください。</option>';
				endif;
			?>
		</select>
	</p>
</div>
<?php
}