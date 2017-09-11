<?php
/**
 * Custom Post Type Recent Posts widget class
 *
 * @since 1.0.0
 */

class ringox_voice_show extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'description' => '「お客様の声」の最新記事を表示します。'
		);
		parent::__construct(
			'ringox_voice_show',
			'お客様の声',
			$widget_ops
		);
	}

	public function widget( $args, $instance ) {
		extract($args);
		$title = ($instance['title'] !==null ) ? $instance['title'] : 'お客様の声';
		if(empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
			$number = 5;
		}
		$show_date = (isset( $instance['show_date'] )) ? $instance['show_date'] : false;
		if ( empty( $instance['client_term'] ) || ! $client_term = absint( $instance['client_term'] ) ) {
			$client_term = '0';
		}
		if ( empty( $instance['advice_term'] ) || ! $advice_term = absint( $instance['advice_term'] ) ) {
			$advice_term = '0';
		}
		echo $before_widget;
		echo '<h3 class="widget-title">'.$title.'</h3>';
		echo '<ul class="tabs" data-tab>';
		echo '<li class="tab-title"><a class="waves-effect no-js" href="#tabs-advice" title="ご相談者様の声">ご相談者様</a></li>';
		echo '<li class="tab-title active"><a class="waves-effect no-js" href="#tabs-client" title="ご依頼者様の声">ご依頼者様</a></li>';
		echo '</ul><div class="tabs-content">';
		echo '<div id="tabs-advice" class="content"><ul class="no-bullet">';
		if($advice_term !== null && isset($advice_term) && $advice_term == '0') {
			$args = array(
				'post_type' => 'advice',
				'posts_per_page' => $number,
				'orderby' => 'modified',
				'order' => 'DESC'
			);
		} elseif($advice_term !== null && isset($advice_term) && $advice_term !== '0') {
			$advice_term = get_term_by('id', $advice_term, 'advice-cat');
			$term = $advice_term->slug;
			$args = array(
				'post_type' => 'advice',
				'posts_per_page' => $number,
				'orderby' => 'modified',
				'order' => 'DESC',
				'tax_query' => array(
					array(
						'taxonomy' => 'advice-cat',
						'field' => 'slug',
						'terms' => $term
					),
				),
			);
		}
		$loop = new WP_Query($args);
		if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();
?>
<li>
<?php
		if($show_date) {
?>
<span class="post-date"><?php echo get_the_date('Y年m月d日'); ?></span>
<?php
		}
?>
<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
<?php
		endwhile;
	else:
?>
<p>
	随時追加中！<br>
	多くの「声」を蓄積しておりますので、お問い合わせください。
</p>
<?php
		wp_reset_postdata();
		endif;
		echo '</ul>';
/*		if($advice_term !== null && isset($advice_term) && $advice_term !== '0') {
			$term_link = get_term_link($advice_term->term_id, 'advice-cat');
			echo '<a class="button waves-effect expand mb0" href="'.$term_link.'" title="'.$advice_term->name.'でご相談されたお客様の声をもっと見る">もっと見る</a>';
		} else {
			echo '<a class="button waves-effect expand mb0" href="'.get_post_type_archive_link('advice').'" title="ご相談様の声の一覧を見る">一覧を見る</a>';
		}
*/		echo '</div>';
		echo '<div id="tabs-client" class="content active"><ul class="no-bullet">';
		if($client_term !== null && isset($client_term) && $client_term == '0') {
			$args = array(
				'post_type' => 'voice',
				'posts_per_page' => $number,
				'orderby' => 'modified',
				'order' => 'DESC'
			);
		} elseif($client_term !== null && isset($client_term) && $client_term !== '0') {
			$client_term = get_term_by('id', $client_term, 'voice-cat');
			$term = $client_term->slug;
			$args = array(
				'post_type' => 'voice',
				'posts_per_page' => $number,
				'orderby' => 'modified',
				'order' => 'DESC',
				'tax_query' => array(
					array(
						'taxonomy' => 'voice-cat',
						'field' => 'slug',
						'terms' => $term
					),
				),
			);
		}
		$loop = new WP_Query($args);
		if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();
?>
<li>
<?php
		if($show_date) {
?>
<span class="post-date"><?php echo get_the_date('Y年m月d日'); ?></span>
<?php
		}
		if($client_term == '0') {
			echo '<p class="widgets-cases-category">';
			the_terms(0, 'voice-cat', '分野 ： ', ' / ');
			echo '</p>';
		}

?>
<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
<?php
		endwhile;
	else:
?>
<p>
	随時追加中！<br>
	多くの「声」を蓄積しておりますので、お問い合わせください。
</p>
<?php
		wp_reset_postdata();
		endif;
		echo '</ul>';
		if($client_term !== '0' && $loop->have_posts()) {
			$term_link = get_term_link($client_term->term_id, 'voice-cat');
			echo '<a class="button waves-effect expand mb0" href="'.$term_link.'" title="'.$client_term->name.'でご依頼されたお客様の声をもっと見る">もっと見る</a>';
		} else {
			echo '<a class="button waves-effect expand mb0" href="'.get_post_type_archive_link('voice').'" title="ご依頼者の声の一覧">一覧を見る</a>';
		}
		echo '</div></div>';
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['client_term'] = $new_instance['client_term'];
		$instance['advice_term'] = $new_instance['advice_term'];
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = (isset( $new_instance['show_date'] )) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}

	public function form( $instance ) {
		$title = (isset( $instance['title'] )) ? esc_attr( $instance['title'] ) : 'お客様の声';
		$number = (isset( $instance['number'] )) ? absint( $instance['number'] ) : 5;
		$show_date = (isset( $instance['show_date'] )) ? (bool) $instance['show_date'] : false;
		$advice_term = (isset($instance['advice_term'] )) ? $instance['advice_term']: '0';
		$client_term = (isset($instance['client_term'] )) ? $instance['client_term']: '0';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">タイトル：</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'client_term' ); ?>">ご相談者様の声：</label>
		<select name="<?php echo $this->get_field_name('client_term'); ?>" id="<?php echo $this->get_field_id('client_term'); ?>">
			<option value="0">すべて</option>
		<?php
			$args = array(
				'orderby' => 'count',
				'order' => 'DESC',
				'hide_empty' => false
			);
			$terms = get_terms('advice-cat', $args);
			foreach ($terms as $term) {
				echo '<option value="'.$term->term_id.'" '.selected($term->term_id, $client_term).'>'.$term->name.'（'.$term->count.'）</option>';
			}
		?>
		</select>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'client_term' ); ?>">ご依頼者様の声：</label>
		<select name="<?php echo $this->get_field_name('client_term'); ?>" id="<?php echo $this->get_field_id('client_term'); ?>">
			<option value="0">すべて</option>
		<?php
			$args = array(
				'orderby' => 'count',
				'order' => 'DESC',
				'hide_empty' => false
			);
			$terms = get_terms('voice-cat', $args);
			foreach ($terms as $term) {
				echo '<option value="'.$term->term_id.'" '.selected($term->term_id, $client_term).'>'.$term->name.'（'.$term->count.'）</option>';
			}
		?>
		</select>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>">表示件数：</label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>">投稿日時を表示</label></p>
<?php
	}
}
	add_action('widgets_init', create_function('', 'register_widget("ringox_voice_show");'));