<?php
	if (!defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Sliders Post type
	$labels = array(
		'name'                  => _x( 'CTA','dtdsh' ),
		'singular_name'         => _x( 'CTA','dtdsh' ),
		'add_new'               => _x( '新規追加','dtdsh' ),
		'add_new_item'          => _x( '新しいCTAを追加','dtdsh' ),
		'edit_item'             => _x( 'CTAを編集','dtdsh' ),
		'new_item'              => _x( '新しいCTA','dtdsh' ),
		'all_items'             => _x( 'CTA','dtdsh' ),
		'view_item'             => _x( 'CTAを見る','dtdsh' ),
		'search_items'          => _x( 'CTAを検索','dtdsh' ),
		'not_found'             => _x( 'CTAが見つかりません','dtdsh' ),
		'not_found_in_trash'    => _x( 'ゴミ箱にCTAはありません','dtdsh' ),
		'parent_item_colon'     => _x( '親アイテム','dtdsh' ),
		'menu_name'             => _x( 'CTA','dtdsh' ),
		);
	register_post_type('dtdsh-cta', array(
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
			'slug' => 'cta'
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
	add_action('admin_menu', 'add_cta_options');
	add_action('save_post', 'save_cta_options');
	function save_cta_options( $post_id ) {
		global $post;
		$my_nonce = isset( $_POST['my_nonce']) ? $_POST['my_nonce'] : null;
		if ( ! wp_verify_nonce( $my_nonce, wp_create_nonce( __FILE__ ) ) ) {
			$post_id = isset( $_GET['post_id'] ) ? htmlspecialchars( $_GET['post_id'] ) : null;
			return $post_id;
		}
		if (  defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }
		if ( ! current_user_can( 'edit_post', $post->ID ) ) { return $post_id; }
		if ( 'dtdsh-cta' == $_POST['post_type'] ) {
			update_post_meta( $post->ID, 'cta_link', $_POST['cta_link'] );
			update_post_meta( $post->ID, 'cta_link_title', $_POST['cta_link_title'] );
		}
	}
	function add_cta_options() {
		add_meta_box(
			'cta-options',
			'CTA設定',
			'add_cta_metabox',
			'dtdsh-cta',
			'normal',
			'high'
			);
	}
	function add_cta_metabox() {
		global $post;
		wp_nonce_field( wp_create_nonce( __FILE__ ), 'my_nonce' );
		?>
		<div id="cta-options">
			<p>CTAの設定をしてください。CTAとはコール・トゥ・アクションの略で訪問者をランディングページやお問い合わせページなどへ誘導するためのものです。</p>
			<p>
				<label>リンク先のURLを入力してください。</label>
				<input type="url" name="cta_link" value="<?php echo esc_url( get_post_meta( $post->ID, 'cta_link', true ) ); ?>" placeholder="CTAのリンク先" style="width: 100%;">
			</p>
			<p>
				<label>CTAのリンク先ボタンのテキスト</label>
				<input type="text" name="cta_link_title" value="<?php echo esc_attr( get_post_meta( $post->ID, 'cta_link_title', true ) ); ?>" placeholder="CTAリンクのテキスト" style="width: 100%;">
			</p>
		</div>
		<?php
	}