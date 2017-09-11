<?php
// Like Box
class MyLikeBox extends WP_Widget {
	function MyLikeBox() {
		parent::__construct(
			'MyLikeBox',
			'Facebook Page Plugin',
			array('description' => 'FacebookのPage PluginとSNSリンク')
		);
	}
	function widget($args, $instance) {
		extract($args);
		$ringo = get_option('ringosh');
		$facebook_page_url = '';
		$likebox_height = '';
		$facebook_page_url = $ringo['rin_facebook'];
		$likebox_height = (isset($instance['likebox_height'])) ? $instance['likebox_height'] : 300;
		$hide_cover = ($instance['hide_cover'] == 'false') ? $instance['hide_cover'] : null;
		$show_face = ($instance['show_face'] == 'true') ? $instance['show_face'] : null;
		$show_posts = ($instance['show_posts'] == 'false') ? $instance['show_posts'] : null;
		$small_header = ($instance['small_header'] == 'true') ? $instance['small_header'] : null;
		$adapt_width = ($instance['adapt_width'] == 'true') ? $instance['adapt_width'] : null;
		echo $before_widget;
?>
<?php
	if(isset($likebox_height) && $likebox_height !== ''){
?>
<div class="fb-page" data-href="<?php echo $facebook_page_url; ?>" data-height=<?php echo $likebox_height; ?> data-hide-cover="<?php $hide_cover; ?>" data-show-facepile="<?php $show_face; ?>" data-show-posts="<?php $show_posts; ?>" data-small-header="<?php $small_header; ?>" data-adapt-container-width="<?php $adapt_width; ?>">
</div>
<?php } ?>
<ul class="side-sns small-up-3">
<li class="column"><a class="waves-effect button expand bg-googleplus hover-color-googleplus btn-sns" title="<?php bloginfo('name'); ?>のGoogle+を見る" href="<?php echo esc_url($ringo['rin_googleplus']); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
<li class="column"><a class="waves-effect button expand bg-facebook hover-color-facebook btn-sns" title="<?php bloginfo('name'); ?>のFacebookを見る" href="<?php echo esc_url($ringo['rin_facebook']); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
<li class="column"><a class="waves-effect button expand bg-youtube hover-color-youtube btn-sns" title="<?php bloginfo('name'); ?>のYoutubeを見る" href="<?php echo esc_url($ringo['rin_youtube']); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
</ul>
<?php
	echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['likebox_height'] = trim($new_instance['likebox_height']);
		$instance['hide_cover'] = trim($new_instance['hide_cover']);
		$instance['show_face'] = trim($new_instance['show_face']);
		$instance['show_posts'] = trim($new_instance['show_posts']);
		$instance['small_header'] = trim($new_instance['small_header']);
		$instance['adapt_width'] = trim($new_instance['adapt_width']);
		return $instance;
	}
	function form($instance) {
		$likebox_height = (isset($instance['likebox_height']) && $instance['likebox_height'] !== '') ?  esc_attr($instance['likebox_height']) : "300";
		$hide_cover = (isset($instance['hide_cover']) && $instance['hide_cover'] !== 'false') ?  esc_attr($instance['hide_cover']) : "false";
		$show_face = (isset($instance['show_face']) && $instance['show_face'] !== 'true') ?  esc_attr($instance['show_face']) : "true";
		$show_posts = (isset($instance['show_posts']) && $instance['show_posts'] !== 'false') ?  esc_attr($instance['show_posts']) : "false";
		$small_header = (isset($instance['small_header']) && $instance['small_header'] !== 'false') ?  esc_attr($instance['small_header']) : "false";
		$adapt_width = (isset($instance['adapt_width']) && $instance['adapt_width'] !== 'true') ?  esc_attr($instance['adapt_width']) : "true";
?>
<p>
<label for="<?php echo $this->get_field_id('likebox_height'); ?>">Widgetの高さ（最低70px, 単位はpxで指定）: </label>
<input class="widefat" id="<?php echo $this->get_field_id('likebox_height'); ?>" name="<?php echo $this->get_field_name('likebox_height'); ?>" type="text" value="<?php echo $likebox_height; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('hide_cover') . $this->number; ?>">ヘッダーの背景画像を隠す: </label>
<input class="widefat" id="<?php echo $this->get_field_id('hide_cover'); ?>" name="<?php echo $this->get_field_name('hide_cover'); ?>" type="checkbox" value="false" <?php checked($hide_cover, "false");?> />
</p>
<p>
<label for="<?php echo $this->get_field_id('show_face') . $this->number; ?>">「いいね！」している友達の顔写真を見せる: </label>
<input class="widefat" id="<?php echo $this->get_field_id('show_face'); ?>" name="<?php echo $this->get_field_name('show_face'); ?>" type="checkbox" value="true" <?php checked($show_face, "true");?> />
</p>
<p>
<label for="<?php echo $this->get_field_id('small_header') . $this->number; ?>">スモールヘッダーを使用する: </label>
<input class="widefat" id="<?php echo $this->get_field_id('small_header'); ?>" name="<?php echo $this->get_field_name('small_header'); ?>" type="checkbox" value="false" <?php checked($small_header, "false");?> />
</p>
<p>
<label for="<?php echo $this->get_field_id('adapt_width') . $this->number; ?>">幅をレスポンシブにする: </label>
<input class="widefat" id="<?php echo $this->get_field_id('adapt_width'); ?>" name="<?php echo $this->get_field_name('adapt_width'); ?>" type="checkbox" value="true" <?php checked($adapt_width, "true");?> />
</p>
<p>
<label for="<?php echo $this->get_field_id('show_posts') . $this->number; ?>">ページポストを表示する: </label>
<input class="widefat" id="<?php echo $this->get_field_id('show_posts'); ?>" name="<?php echo $this->get_field_name('show_posts'); ?>" type="checkbox" value="true" <?php checked($show_posts, "true");?> />
</p>
<?php
	}//form
}
add_action('widgets_init', create_function('', 'return register_widget("MyLikeBox");'));