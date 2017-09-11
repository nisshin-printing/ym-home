<?php
	// Ringox video widget
	class ringox_video extends WP_Widget {
		public function __construct() {
			parent::__construct(
				'ringox_video',
				'動画',
				array('description' => '動画をサイドバーに追加します')
			);
		}
		public function widget($args, $instance) {
			extract($args);
			$video = $instance['video'];
			$thumb = $instance['thumb'];
			$frame = $instance['frame'];
			$desc = $instance['description'];
			$randomstring = ringox_randstring(4);
			$galclass = ($desc == '') ? 'ringox_nodesc' : '' ;
			if (isset($instance[ 'ids' ])) { $id = $instance[ 'ids' ]; }

			echo $before_widget;
			echo '<img src="' .$thumb. '" alt="image">';
			echo '<div class="ringox_playerbutdiv ringox_videodiv '.$galclass.'" data-rin_actistring="'.$randomstring.'" data-reveal data-reveal-id="'.$randomstring.'">';
			echo '<i class="fa fa-play-circle-o"></i>';
			echo '</div>';
			if($desc) {
				echo '<div class="ringox_videodesc rin_accent">'.$desc.'</div>';
			}
			$vidframe = '</div><div class="ringoxModal reveal-modal large" id="'.$randomstring.'"><div class="flex-video vimeo widescreen">';
			$vidframe .= $frame;
			$vidframe .= '</div><a class="close-reveal-modal"><i class="fa fa-remove"></i></a>';
			echo $vidframe;
			echo $after_widget;
		}
		public function update($new_instance, $old_instance) {
			$instance = array();
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['video'] = esc_attr($new_instance['video']);
			$instance['ids'] = esc_attr($new_instance['ids']);
			$instance['thumb'] = esc_attr($new_instance['thumb']);
			$instance['frame'] = esc_attr($new_instance['frame']);
			$instance['description'] = esc_attr($new_instance['description']);
			$tturi = rin_identifyvideo($instance['video'], $instance['ids']);
			if($tturi != '' && isset($tturi)) {
				$instance['ids'] = $tturi['ids'];
				$instance['thumb'] = $tturi['thumb'];
				$instance['frame'] = $tturi['frame'];
			}
			return $instance;
		}
		public function form($instance) {
			if ( isset( $instance[ 'title' ] ) || isset( $instance[ 'video' ]) || isset( $instance[ 'id' ] ) || isset( $instance[ 'thumb' ])  || isset( $instance[ 'frame' ] )  || isset( $instance[ 'description' ] )) {
				$title = $instance['title'];
				$video = $instance['video'];
				$desc = $instance['description'];
				$ids = $instance['ids'];
				$thumb = $instance['thumb'];
				$frame = $instance['frame'];
			} else {
				$title = '';
				$video = '';
				$desc = '';
				$ids = '';
				$frame = '';
				$thumb = '';
			}
?>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>">名前:<br>（表示はされません。わかりやすい名前をつけてください。）</label>
<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" placeholder="名前">
</p>
<p>
<label for="<?php echo $this->get_field_id('video'); ?>">動画のリンク: </label>
<input type="url" class="widefat" id="<?php echo $this->get_field_id('video'); ?>" name="<?php echo $this->get_field_name('video'); ?>" value="<?php echo esc_attr($video); ?>" placeholder="https://youtu.be/ZtLlhSb8ngE">
</p>
<p>
<label for="<?php echo $this->get_field_id('description'); ?>">動画のタイトル<br>（表示されます）: </label>
<input type="text" class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" value="<?php echo esc_attr($desc); ?>">
</p>
<p>
<label for="<?php echo $this->get_field_id('ids'); ?>"></label>
<input type="hidden" class="widefat" id="<?php echo $this->get_field_id('ids'); ?>" name="<?php echo $this->get_field_name('ids'); ?>" value="<?php echo esc_attr($ids); ?>">
</p>
<p>
<label for="<?php echo $this->get_field_id('thumb'); ?>"></label>
<input type="hidden" class="widefat" id="<?php echo $this->get_field_id('thumb'); ?>" name="<?php echo $this->get_field_name('thumb'); ?>" value="<?php echo esc_attr($thumb); ?>">
</p>
<p>
<label for="<?php echo $this->get_field_id('frame'); ?>"></label>
<input type="hidden" class="widefat" id="<?php echo $this->get_field_id('frame'); ?>" name="<?php echo $this->get_field_name('frame'); ?>" value="<?php echo esc_attr($frame); ?>">
</p>
<?php
		}
	}
	add_action('widgets_init', create_function('', 'register_widget("ringox_video");'));
?>