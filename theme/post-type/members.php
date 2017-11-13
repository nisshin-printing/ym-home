<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$labels = array(
	'name' 					=> _x('メンバー','ringo'),
	'singular_name' 		=> _x('メンバー','ringo'),
	'add_new' 				=> _x('新規追加','ringo'),
	'add_new_item' 			=> _x('新しいメンバーを追加','ringo'),
	'edit_item' 			=> _x('メンバーを編集','ringo'),
	'new_item' 				=> _x('新しいメンバー','ringo'),
	'all_items' 			=> _x('メンバー','ringo'),
	'view_item' 			=> _x('メンバーを見る','ringo'),
	'search_items' 			=> _x('メンバーを検索','ringo'),
	'not_found' 			=> _x('メンバーが見つかりません','ringo'),
	'not_found_in_trash' 	=> _x('ゴミ箱にメンバーポストはありません','ringo'),
	'parent_item_colon' 	=> _x('親アイテム','ringo'),
	'menu_name' 			=> _x('メンバー','ringo'),
	'show_in_rest'       => true
);
register_post_type('members', array(
	'labels' 				=> $labels,
	'public' 				=> true,
	'menu_icon' 			=> 'dashicons-groups',
	'publicly_queryable' 	=> true,
	'show_ui' 				=> true,
	'show_in_menu'          => 'edit.php',
	'show_in_nav_menus' 	=> true,
	'query_var' 			=> true,
	'rewrite' 				=> true,
	'capability_type' 		=> 'post',
	'has_archive' 			=> true,
	'hierarchical' 			=> true,
	'menu_position' 		=> 10,
	'supports' 				=> array('title','editor','thumbnail'),
	'show_in_rest'       => true
));
register_taxonomy(
	"members-cat",
	"members",
	array(
		"label" => __('メンバーカテゴリー'),
		"hierarchical" => true,
		"show_admin_column" => true,
		'rewrite' => array('slug' => 'members-category'),
		'show_in_rest' => true,
		'rest_base' => 'members-category'
	)
);
register_taxonomy(
	"members-hobby",
	"members",
	array(
		"label" => __('趣味'),
		"hierarchical" => false,
		"show_admin_column" => true,
		'show_in_rest' => true
	)
);
register_taxonomy(
	"members-specialty",
	"members",
	array(
		"label" => __('主な取扱分野'),
		"hierarchical" => false,
		"show_admin_column" => true,
		'show_in_rest' => true
	)
);
register_taxonomy(
	"members-group",
	"members",
	array(
		"label" => __('所属団体'),
		"hierarchical" => false,
		"show_admin_column" => true,
		'show_in_rest' => true
	)
);
// Actions
add_action('admin_menu', 'add_subtitle_box');
add_action('save_post', 'save_subtitle_box');

// Custom field inputbox
function add_subtitle_box() {
	add_meta_box(
		'sub-box',
		'詳細データ',
		'mm_add_subtitle',
		'members',
		'normal',
		'high'
	);
}

// HTML / PHP Code Field
function mm_add_subtitle() {
	global $post;
	wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce');
?>
<div id="sub-box">
<p>基本的な情報である肩書や役職名、ふりがな、一言メッセージなど入力することでメンバーページに表示させることができます。</p>
<p>
<label>肩書や役職名<br>
<input type="text" name="subtitle" value="<?php echo esc_html( get_post_meta( $post->ID, 'subtitle', true ) ); ?>" placeholder="肩書や役職名" style="width: 80%">
</label>
</p>
<p>
<label>氏名のふりがな・ローマ字<br>
<input type="text" name="name-rubi" value="<?php echo esc_html( get_post_meta( $post->ID, 'name-rubi', true ) ); ?>" placeholder="氏名のふりがな・ローマ字" style="width: 80%">
</label>
</p>
<p>
<label>ラベル<br>
<input type="text" name="mem-label" value="<?php echo esc_html( get_post_meta( $post->ID, 'mem-label', true ) ); ?>" placeholder="ラベルを入力してください。" style="width: 80%">
</label>
</p>
</div>
<?php
}

function save_subtitle_box( $post_id ) {
	global $post;
	$my_nonce = isset( $_POST['my_nonce'] ) ? $_POST['my_nonce'] : null;
	if ( ! wp_verify_nonce( $my_nonce, wp_create_nonce( __FILE__ ) ) ) {
		return $post_id;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }
	if ( ! current_user_can( 'edit_post', $post->ID ) ) { return $post_id; }

	if ( 'members' == $_POST['post_type'] ) {
		update_post_meta( $post->ID, 'subtitle', $_POST['subtitle'] );
		update_post_meta( $post->ID, 'name-rubi', $_POST['name-rubi'] );
		update_post_meta( $post->ID, 'mem-label', $_POST['mem-label'] );
	}
}




// Actions
add_action('admin_menu', 'add_mmsns_box');
add_action('save_post', 'save_mmsns_box');

// Custom field inputbox
function add_mmsns_box() {
	add_meta_box(
		'sns-url',
		'ソーシャルリンク',
		'mm_add_meta_box',
		'members',
		'normal',
		'high'
	);
}

// HTML / PHP Code Field
function mm_add_meta_box() {
	global $post;
	wp_nonce_field( wp_create_nonce( __FILE__ ), 'my_nonce' );
?>
<div id="sns-url">
<p>個人アカウントのSNSのリンクを入力することで各メンバーページにそのSNSのロゴを表示し、リンクを設定させることができます。</p>


<!-- Facebook -->
<p>
<label><i class="fa fa-facebook" style="color: #3B5998; margin-right: 1em; font-size: 2em; position: relative; top: .25em;"></i>Facebook<br>
<p>ここに入力されたURLはFacebookのロゴマークにリンクが設定されます。</p>
<input type="url" name="facebook" value="<?php echo esc_html( get_post_meta( $post->ID, 'facebook', true ) ); ?>" placeholder="FacebookのURL" style="width: 80%">
</label>
</p>

<!-- Twitter -->
<p>
<label><i class="fa fa-twitter" style="color: #55ACEE; margin-right: 1em; font-size: 2em; position: relative; top: .25em;"></i>Twitter<br>
<p>ここに入力されたURLはTwitterのロゴマークにリンクが設定されます。</p>
<input type="url" name="twitter" value="<?php echo esc_html( get_post_meta( $post->ID, 'twitter', true ) ); ?>" placeholder="TwitterのURL" style="width: 80%">
</label>
</p>

<!-- Linkedin -->
<p>
<label><i class="fa fa-linkedin" style="color: #0077B5; margin-right: 1em; font-size: 2em; position: relative; top: .25em;"></i>Linkedin<br>
<p>ここに入力されたURLはLinkedinのロゴマークにリンクが設定されます。</p>
<input type="url" name="linkedin" value="<?php echo esc_html( get_post_meta( $post->ID, 'linkedin', true ) ); ?>" placeholder="LinkedinのURL" style="width: 80%">
</label>
</p>

<!-- Flickr -->
<p>
<label><i class="fa fa-flickr" style="color: #FF0084; margin-right: 1em; font-size: 2em; position: relative; top: .25em;"></i>Flickr<br>
<p>ここに入力されたURLはFlickrのロゴマークにリンクが設定されます。</p>
<input type="url" name="flickr" value="<?php echo esc_html( get_post_meta( $post->ID, 'flickr', true ) ); ?>" placeholder="FlickrのURL" style="width: 80%">
</label>
</p>

<!-- Foursquare -->
<p>
<label><i class="fa fa-foursquare" style="color: #0CBADF; margin-right: 1em; font-size: 2em; position: relative; top: .25em;"></i>Foursquare<br>
<p>ここに入力されたURLはFoursquareのロゴマークにリンクが設定されます。</p>
<input type="url" name="foursquare" value="<?php echo esc_html( get_post_meta( $post->ID, 'foursquare', true ) ); ?>" placeholder="FoursquareのURL" style="width: 80%">
</label>
</p>

<!-- Instagram -->
<p>
<label><i class="fa fa-instagram" style="color: #3F729B; margin-right: 1em; font-size: 2em; position: relative; top: .25em;"></i>Instagram<br>
<p>ここに入力されたURLはInstagramのロゴマークにリンクが設定されます。</p>
<input type="url" name="instagram" value="<?php echo esc_html( get_post_meta( $post->ID, 'instagram', true ) ); ?>" placeholder="InstagramのURL" style="width: 80%">
</label>
</p>

<!-- Google+ -->
<p>
<label><i class="fa fa-google-plus" style="color: #DD4B39; margin-right: 1em; font-size: 2em; position: relative; top: .25em;"></i>Google+<br>
<p>ここに入力されたURLはGoogle+のロゴマークにリンクが設定されます。</p>
<input type="url" name="googleplus" value="<?php echo esc_html( get_post_meta( $post->ID, 'googleplus', true ) ); ?>" placeholder="Google+のURL" style="width: 80%">
</label>
</p>

<!-- Pinterest -->
<p>
<label><i class="fa fa-pinterest" style="color: #CC2127; margin-right: 1em; font-size: 2em; position: relative; top: .25em;"></i>Pinterest<br>
<p>ここに入力されたURLはPinterestのロゴマークにリンクが設定されます。</p>
<input type="url" name="pinterest" value="<?php echo esc_html( get_post_meta( $post->ID, 'pinterest', true ) ); ?>" placeholder="PinterestのURL" style="width: 80%">
</label>
</p>

<!-- Youtube -->
<p>
<label><i class="fa fa-youtube" style="color: #CD201F; margin-right: 1em; font-size: 2em; position: relative; top: .25em;"></i>Youtube<br>
<p>ここに入力されたURLはYoutubeのロゴマークにリンクが設定されます。</p>
<input type="url" name="youtube" value="<?php echo esc_html( get_post_meta( $post->ID, 'youtube', true ) ); ?>" placeholder="YoutubeのURL" style="width: 80%">
</label>
</p>

<!-- Tumblr -->
<p>
<label><i class="fa fa-tumblr" style="color: #35465C; margin-right: 1em; font-size: 2em; position: relative; top: .25em;"></i>Tumblr<br>
<p>ここに入力されたURLはTumblrのロゴマークにリンクが設定されます。</p>
<input type="url" name="tumblr" value="<?php echo esc_html( get_post_meta( $post->ID, 'tumblr', true ) ); ?>" placeholder="TumblrのURL" style="width: 80%">
</label>
</p>

<!-- その他ブログなど -->
<p>
<label style="border: 3px solid #333; border-radius: 3px; color: #333; padding: 5px 10px">その他ブログなど<br>
<p>ここに入力されたテキストにリンクが設定されます。</p>
<input type="text" name="blog-title" value="<?php echo esc_html( get_post_meta( $post->ID, 'blog-title', true ) ); ?>" placeholder="タイトル" style="width: 80%">
<input type="url" name="blog" value="<?php echo esc_html( get_post_meta( $post->ID, 'blog', true ) ); ?>" placeholder="その他ブログなどのURL" style="width: 80%">
</label>
</p>

<!-- その他 - 1 -->
<p>
<label style="border: 3px solid #333; border-radius: 3px; color: #333; padding: 5px 10px">その他 - 1<br>
<p>ここに入力されたテキストにリンクが設定されます。</p>
<input type="text" name="cus1-title" value="<?php echo esc_html( get_post_meta( $post->ID, 'cus1-title', true ) ); ?>" placeholder="タイトル" style="width: 80%">
<input type="url" name="cus1" value="<?php echo esc_html( get_post_meta( $post->ID, 'cus1', true ) ); ?>" placeholder="その他 - 1のURL" style="width: 80%">
</label>
</p>

<!-- その他 - 2 -->
<p>
<label style="border: 3px solid #333; border-radius: 3px; color: #333; padding: 5px 10px">その他 - 2<br>
<p>ここに入力されたテキストにリンクが設定されます。</p>
<input type="text" name="cus2-title" value="<?php echo esc_html( get_post_meta( $post->ID, 'cus2-title', true ) ); ?>" placeholder="タイトル" style="width: 80%">
<input type="url" name="cus2" value="<?php echo esc_html( get_post_meta( $post->ID, 'cus2', true ) ); ?>" placeholder="その他 - 2のURL" style="width: 80%">
</label>
</p>
</div>
<?php
}

function save_mmsns_box( $post_id ) {
	global $post;
	$my_nonce = isset( $_POST['my_nonce'] ) ? $_POST['my_nonce'] : null;
	if( ! wp_verify_nonce( $my_nonce, wp_create_nonce( __FILE__ ) ) ) {
		return $post_id;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }
	if ( ! current_user_can( 'edit_post', $post->ID ) ) { return $post_id; }

	if ( 'members' == $_POST['post_type'] ) {
		update_post_meta( $post->ID, 'facebook', $_POST['facebook'] );
		update_post_meta( $post->ID, 'twitter', $_POST['twitter'] );
		update_post_meta( $post->ID, 'linkedin', $_POST['linkedin'] );
		update_post_meta( $post->ID, 'flickr', $_POST['flickr'] );
		update_post_meta( $post->ID, 'foursquare', $_POST['foursquare'] );
		update_post_meta( $post->ID, 'instagram', $_POST['instagram'] );
		update_post_meta( $post->ID, 'googleplus', $_POST['googleplus'] );
		update_post_meta( $post->ID, 'pinterest', $_POST['pinterest'] );
		update_post_meta( $post->ID, 'youtube', $_POST['youtube'] );
		update_post_meta( $post->ID, 'tumblr', $_POST['tumblr'] );
		update_post_meta( $post->ID, 'blog-title', $_POST['blog-title'] );
		update_post_meta( $post->ID, 'blog', $_POST['blog'] );
		update_post_meta( $post->ID, 'cus1-title', $_POST['cus1-title'] );
		update_post_meta( $post->ID, 'cus1', $_POST['cus1'] );
		update_post_meta( $post->ID, 'cus2-title', $_POST['cus2-title'] );
		update_post_meta( $post->ID, 'cus2', $_POST['cus2'] );
	}
}

function custom_terms_query($atts, $content = null) {
	extract(shortcode_atts(array(
		'tags' => ''
	), $atts));
	global $post;
	$terms = wp_get_object_terms($post->ID, $tags);
	if(!empty($terms)){
		if(!is_wp_error($terms)) {
			echo '<p>';
			foreach ($terms as $term) {
				echo '<a href="'.home_url('/').'members/#filter=.'.$tags.'-'.$term->slug.'%2C%20.'.$tags.'-'.$term->term_id.'" title="'.$term->name.'">'.$term->name.'</a>';
			}
			echo '</p>';
		}
	}

}
add_shortcode('ringo-terms', 'custom_terms_query');
// hobby
// specialty
// group
