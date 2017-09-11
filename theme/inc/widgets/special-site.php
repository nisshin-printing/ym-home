<?php
	// Ringox special site widget
	class ringox_sitelink extends WP_Widget {
		public function __construct() {
			parent::__construct(
				'ringox_sitelink',
				'専門サイトリンク',
				array( 'description' => '選択した専門サイトへのリンクのみサイドバーへ追加されます。' )
			);
		}
		public function widget($args, $instance) {
			extract($args);
			$title = $instance['title'];
			$site01 = ($instance['site01'] == 'true') ? $instance['site01'] : null;
			$site02 = ($instance['site02'] == 'true') ? $instance['site02'] : null;
			$site03 = ($instance['site03'] == 'true') ? $instance['site03'] : null;
			$site04 = ($instance['site04'] == 'true') ? $instance['site04'] : null;
			$site05 = ($instance['site05'] == 'true') ? $instance['site05'] : null;
			$site06 = ($instance['site06'] == 'true') ? $instance['site06'] : null;
			$site07 = ($instance['site07'] == 'true') ? $instance['site07'] : null;
			$site08 = ($instance['site08'] == 'true') ? $instance['site08'] : null;
			$site09 = ($instance['site09'] == 'true') ? $instance['site09'] : null;

			echo $before_widget;
			echo '<h3 class="widget-title">'.$title.'</h3>';
			if($site01 == null && $site02 == null && $site03 == null && $site04 == null && $site05 == null && $site06 == null && $site07 == null && $site08 == null) {
				echo '<ul class="no-bullet external-links-block small-block-grid-1 medium-block-grid-2 large-block-grid-1">';
			} else {
				echo '<ul class="no-bullet external-links-block">';
			}
			if($site01 !== null) {
				echo '<li class="grid-item"><a target="_blank" class="link-external img" href="http://www.hiroshima-jiko.com/" title="賠償金額が増額するケースが大半！交通事故の専門サイト"><img src="'.home_url().'/wp-content/uploads/2015/05/external-links-1.png" alt="賠償金額が増額するケースが大半！交通事故の専門サイト"></a></li>';
			}
			if($site02 !== null) {
				echo '<li class="grid-item"><a target="_blank" class="link-external img" href="http://www.hiroshima-rikon.com/" title="女性弁護士3名所属！離婚・男女トラブルの専門サイト"><img src="'.home_url().'/wp-content/uploads/2015/05/external-links-2.png" alt="女性弁護士3名所属！離婚・男女トラブルの専門サイト"></a></li>';
			}
			if($site03 !== null) {
				echo '<li class="grid-item"><a target="_blank" class="link-external img" href="http://www.hiroshima-sozoku.com/" title="相続アドバイザーがサポート！相続・遺言の専門サイト"><img src="'.home_url().'/wp-content/uploads/2015/05/external-links-3.png" alt="相続アドバイザーがサポート！相続・遺言の専門サイト"></a></li>';
			}
			if($site04 !== null) {
				echo '<li class="grid-item"><a target="_blank" class="link-external img" href="http://www.hiroshima-saimu.com/" title="女性専用の相談もあります！借金問題の専門サイト"><img src="'.home_url().'/wp-content/uploads/2015/10/external-links-4.png" alt="女性専用の相談もあります！借金問題の専門サイト"></a></li>';
			}
			if($site05 !== null) {
				echo '<li class="grid-item"><a target="_blank" class="link-external img" href="http://www.hiroshima-keiji.com/" title="手遅れになる前にご相談ください。刑事事件の専門サイト"><img src="'.home_url().'/wp-content/uploads/2015/05/external-links-5.png" alt="手遅れになる前にご相談ください。刑事事件の専門サイト"></a></li>';
			}
			if($site06 !== null) {
				echo '<li class="grid-item"><a target="_blank" class="link-external img black" href="http://www.hiroshima-fudosan.com/" title="不動産トラブルを弁護士が解決！不動産トラブルの専門サイト"><img src="'.home_url().'/wp-content/uploads/2015/10/external-links-6.png" alt="不動産トラブルを弁護士が解決！不動産トラブルの専門サイト"></a></li>';
			}
			if($site07 !== null) {
				echo '<li class="grid-item"><a target="_blank" class="link-external img black" href="http://www.hiroshima-kigyo.com/" title="メリットが多い！顧問契約のススメ　企業法務の専門サイト"><img src="'.home_url().'/wp-content/uploads/2015/10/external-links-7.png" alt="メリットが多い！顧問契約のススメ　企業法務の専門サイト"></a></li>';
			}
			if($site08 !== null) {
				echo '<li class="grid-item"><a target="_blank" class="link-external img black" href="http://www.hiroshima-hasan.com/" title="破産は経営者の再出発！会社の破産・整理の専門サイト"><img src="'.home_url().'/wp-content/uploads/2015/10/external-links-8.png" alt="破産は経営者の再出発！会社の破産・整理の専門サイト"></a></li>';
			}
			if($site09 !== null) {
				echo '<li class="grid-item"><a target="_blank" class="link-external img" href="http://www.hiroshima-rosai.com/" title="賠償金が増額できる場合があります！労働災害の専門サイト"><img src="'.home_url().'/wp-content/uploads/2015/09/external-links-9.png" alt="賠償金が増額できる場合があります！労働災害の専門サイト"></a></li>';
			}
			echo '</ul>';
			echo $after_widget;
		}
		public function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['site01'] = trim($new_instance['site01']);
			$instance['site02'] = trim($new_instance['site02']);
			$instance['site03'] = trim($new_instance['site03']);
			$instance['site04'] = trim($new_instance['site04']);
			$instance['site05'] = trim($new_instance['site05']);
			$instance['site06'] = trim($new_instance['site06']);
			$instance['site07'] = trim($new_instance['site07']);
			$instance['site08'] = trim($new_instance['site08']);
			$instance['site09'] = trim($new_instance['site09']);
			return $instance;
		}
		public function form($instance) {
				$title = (isset($instance['title']) && $instance['title'] !== null) ? strip_tags($instance['title']) : '特設専門サイト';
				$site01 = (isset($instance['site01']) && $instance['site01'] !== 'false') ? esc_attr($instance['site01']) : 'false';
				$site02 = (isset($instance['site02']) && $instance['site02'] !== 'false') ? esc_attr($instance['site02']) : 'false';
				$site03 = (isset($instance['site03']) && $instance['site03'] !== 'false') ? esc_attr($instance['site03']) : 'false';
				$site04 = (isset($instance['site04']) && $instance['site04'] !== 'false') ? esc_attr($instance['site04']) : 'false';
				$site05 = (isset($instance['site05']) && $instance['site05'] !== 'false') ? esc_attr($instance['site05']) : 'false';
				$site06 = (isset($instance['site06']) && $instance['site06'] !== 'false') ? esc_attr($instance['site06']) : 'false';
				$site07 = (isset($instance['site07']) && $instance['site07'] !== 'false') ? esc_attr($instance['site07']) : 'false';
				$site08 = (isset($instance['site08']) && $instance['site08'] !== 'false') ? esc_attr($instance['site08']) : 'false';
				$site09 = (isset($instance['site09']) && $instance['site09'] !== 'false') ? esc_attr($instance['site09']) : 'false';
?>
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>">タイトル：</label>
	<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>">
</p>
<p>
	専門サイトを選択： <br>
	<input type="checkbox" id="<?php echo $this->get_field_id('site01'); ?>" name="<?php echo $this->get_field_name('site01'); ?>" class="widefat" value="true" <?php checked($site01, 'true'); ?>>
	<label for="<?php echo $this->get_field_id('site01'); ?>">交通事故サイト</label>
	<span>　</span>
	<input type="checkbox" id="<?php echo $this->get_field_id('site02'); ?>" name="<?php echo $this->get_field_name('site02'); ?>" class="widefat" value="true" <?php checked($site02, 'true'); ?>>
	<label for="<?php echo $this->get_field_id('site02'); ?>">離婚サイト</label>
	<span>　</span>
	<input type="checkbox" id="<?php echo $this->get_field_id('site03'); ?>" name="<?php echo $this->get_field_name('site03'); ?>" class="widefat" value="true" <?php checked($site03, 'true'); ?>>
	<label for="<?php echo $this->get_field_id('site03'); ?>">相続サイト</label>
	<span>　</span>
	<input type="checkbox" id="<?php echo $this->get_field_id('site04'); ?>" name="<?php echo $this->get_field_name('site04'); ?>" class="widefat" value="true" <?php checked($site04, 'true'); ?>>
	<label for="<?php echo $this->get_field_id('site04'); ?>">債務サイト</label>
	<span>　</span>
	<input type="checkbox" id="<?php echo $this->get_field_id('site05'); ?>" name="<?php echo $this->get_field_name('site05'); ?>" class="widefat" value="true" <?php checked($site05, 'true'); ?>>
	<label for="<?php echo $this->get_field_id('site05'); ?>">刑事サイト</label>
	<span>　</span>
	<input type="checkbox" id="<?php echo $this->get_field_id('site06'); ?>" name="<?php echo $this->get_field_name('site06'); ?>" class="widefat" value="true" <?php checked($site06, 'true'); ?>>
	<label for="<?php echo $this->get_field_id('site06'); ?>">不動産サイト</label>
	<span>　</span>
	<input type="checkbox" id="<?php echo $this->get_field_id('site07'); ?>" name="<?php echo $this->get_field_name('site07'); ?>" class="widefat" value="true" <?php checked($site07, 'true'); ?>>
	<label for="<?php echo $this->get_field_id('site07'); ?>">企業法務</label>
	<span>　</span>
	<input type="checkbox" id="<?php echo $this->get_field_id('site08'); ?>" name="<?php echo $this->get_field_name('site08'); ?>" class="widefat" value="true" <?php checked($site08, 'true'); ?>>
	<label for="<?php echo $this->get_field_id('site08'); ?>">会社再生</label>
	<span>　</span>
	<input type="checkbox" id="<?php echo $this->get_field_id('site09'); ?>" name="<?php echo $this->get_field_name('site09'); ?>" class="widefat" value="true" <?php checked($site09, 'true'); ?>>
	<label for="<?php echo $this->get_field_id('site09'); ?>">労災サイト</label>
</p>
<?php
		}
	}
	add_action('widgets_init', create_function('', 'return register_widget("ringox_sitelink");'));
?>