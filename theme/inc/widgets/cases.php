<?php
/**
 * Custom Post Type Recent Posts widget class
 *
 * @since 1.0.0
 */

class ringox_cases_show extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'description' => '「解決事例」の最新記事を表示します。'
		);
		parent::__construct(
			'ringox_cases_show',
			'解決事例',
			$widget_ops
		);
	}

	public function widget( $args, $instance ) {
		extract($args);
		$title = ($instance['title'] !==null ) ? $instance['title'] : '解決事例';
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
			$number = 5;
		}
		$show_date = (isset( $instance['show_date'] )) ? $instance['show_date'] : false;
		$post_type = 'cases';
		$post_tax = 'cases-cat';
		if ( empty( $instance['post_term'] ) || ! $post_term = absint( $instance['post_term'] ) ) {
			$post_term = '0';
		}
		if($post_term !== null && isset($post_term) && $post_term == '0') {
			$args = array(
				'post_type' => $post_type,
				'taxonomy' => $post_tax,
				'posts_per_page' => $number,
				'orderby' => 'modified',
				'order' => 'DESC'
			);
		} elseif($post_term !== null && isset($post_term) && $post_term !== '0') {
			$post_term = get_term_by('id', $post_term, $post_tax);
			$term = $post_term->slug;
			$args = array(
				'post_type' => $post_type,
				'posts_per_page' => $number,
				'orderby' => 'modified',
				'order' => 'DESC',
				'tax_query' => array(
					array(
						'taxonomy' => $post_tax,
						'field' => 'slug',
						'terms' => $term
					),
				),
			);
		}
		$loop = new WP_Query($args);
		echo $before_widget;
		echo '<h3 class="widget-title">'.$title.'</h3>';
		echo '<ul class="no-bullet m0">';
		if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();
?>
<li>
<?php
		if($show_date) {
?>
<span class="post-date"><?php echo get_the_date('Y年m月d日'); ?></span>
<?php
		}
		if($post_term == '0') {
			echo '<p class="widgets-cases-category">';
			the_terms(0, 'cases-cat', '分野 ： ', ' / ');
			echo '</p>';
		}
?>
<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
<?php
		endwhile;
		else:
?>
	<p>準備中です。<br>事例は多く蓄積しておりますので、お問い合わせください。</p>
<?php
		wp_reset_postdata();
		endif;
		echo '</ul>';
		if($post_term !== null && isset($post_term) && $post_term !== '0') {
			$term_link = get_term_link($post_term->term_id, $post_tax);
			echo '<a class="button waves-effect expand" href="'.$term_link.'" title="'.$post_term->name.'の解決事例">もっと見る</a>';
		} else {
			echo '<a class="button waves-effect expand" href="'.get_permalink('490').'" title="解決事例">一覧を見る</a>';
		}
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['post_term'] = $new_instance['post_term'];
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = (isset( $new_instance['show_date'] )) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}

	public function form( $instance ) {
		$title = (isset( $instance['title'] )) ? esc_attr( $instance['title'] ) : '解決事例';
		$number = (isset( $instance['number'] )) ? absint( $instance['number'] ) : 5;
		$show_date = (isset( $instance['show_date'] )) ? (bool) $instance['show_date'] : false;
		$post_tax = 'cases-cat';
		$post_term = (isset($instance['post_term'] )) ? $instance['post_term']: '0';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">タイトル：</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'post_term' ); ?>"></label>
		<select name="<?php echo $this->get_field_name('post_term'); ?>" id="<?php echo $this->get_field_id('post_term'); ?>">
			<option value="0">すべて</option>
		<?php
			$args = array(
				'orderby' => 'count',
				'order' => 'DESC',
				'hide_empty' => false
			);
			$terms = get_terms($post_tax, $args);
			foreach ($terms as $term) {
				echo '<option value="'.$term->term_id.'" '.selected($term->term_id, $post_term).'>'.$term->name.'（'.$term->count.'）</option>';
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
	add_action('widgets_init', create_function('', 'register_widget("ringox_cases_show");'));