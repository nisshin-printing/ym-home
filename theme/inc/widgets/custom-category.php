<?php
	// Ringox Custom Post Type Taxonomy Display
	class ringox_taxonomy_all extends WP_Widget {
		public function __construct() {
			parent::__construct(
				'ringox_taxonomy_all',
				'カスタム投稿タイプのカテゴリーリスト',
				array('description' => 'カスタム投稿タイプのカテゴリーリスト')
			);
		}
		public function widget($args, $instance) {
			extract($args);
			$title = (isset($instance['title']) && $instance['title'] !== null) ? esc_attr($instance['title']) : '解決事例';
			$post_type = (isset($instance['post_type']) && $instance['post_type'] !== null) ? esc_attr($instance['post_type']) : 'cases-cat';
			switch ( $post_type ) {
				case 'cases-cat':
					$cat_url = 'cases';
					break;
				
				case 'voice-cat':
					$cat_url = 'client';
					break;

				case 'advice-cat':
					$cat_url = 'advice';
					break;
			}
?>
<div class="widget-wrapper widget-cases-category">
<h3 class="widget-title"><?php echo $title; ?></h3>
<ul>
<?php
	$args = array(
		'orderby' => 'count',
		'order' => 'DESC',
		'hide_empty' => true
	);
	$terms = get_terms($post_type, $args);
	foreach ($terms as $term) {
		echo '<li class="cat-item"><a href="'.get_home_url().'/' . $cat_url . '-category/'.$term->slug.'" title="'.$term->name.'">'.$term->name.'</a></li>';
	}
?>
</ul>
</div>
<?php
		}
		public function update($new_instance, $old_instance) {
			$instance = array();
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['post_type'] = trim($new_instance['post_type']);
			return $instance;
		}
		public function form($instance) {
			$title = (isset($instance['title']) && $instance['title'] !== null) ? strip_tags($instance['title']) : '解決事例';
			$post_type = (isset($instance['post_type']) && $instance['post_type'] !== null) ? esc_attr($instance['post_type']) : 'cases-cat';
?>
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>">タイトル：</label>
	<input type="text" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" class="widefat" value="<?php echo $title; ?>">
</p>
<p>
	<label for="<?php echo $this->get_field_id('post_type'); ?>">表示させたい投稿タイプ</label>
	<select name="<?php echo $this->get_field_name('post_type'); ?>" id="<?php echo $this->get_field_id('post_type') ?>" class="widefat">
		<option value="">- 選択 -</option>
		<option value="cases-cat" <?php selected($post_type, 'cases-cat'); ?>>解決事例</option>
		<option value="members-cat" <?php selected($post_type, 'members-cat'); ?>>メンバー</option>
		<option value="voice-cat" <?php selected($post_type, 'voice-cat'); ?>>お客様の声</option>
	</select>
</p>
<?php
		}
	}
	add_action('widgets_init', create_function('', 'register_widget("ringox_taxonomy_all");'));