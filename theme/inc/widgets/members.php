<?php
/**
 * Members Link widget class
 *
 * @since 1.0.0
 */

class ringox_mem_link extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'description' => '指定した分野に力を入れているメンバーのリンクを表示させます。'
		);
		parent::__construct(
			'ringox_mem_link',
			'メンバーのリンク',
			$widget_ops
		);
	}

	public function widget( $args, $instance ) {
		extract($args);
		$title = ($instance['title'] !==null ) ? $instance['title'] : 'この分野に力を入れているメンバー';
		$term_category = (!empty($instance['term_category'])) ? $instance['term_category'] : 0;
		$term_specialty = ($instance['term_specialty'] !== null ) ? $instance['term_specialty'] : 0;
		$term_hobby = ($instance['term_hobby'] !== null ) ? $instance['term_hobby'] : 0;
		$term_group = ($instance['term_group'] !== null ) ? $instance['term_group'] : 0;
		$post_type = 'members';
		if($term_category !== 0 && $term_specialty !== 0 && $term_hobby !== 0 && $term_group !== 0) {
			$args = array(
				'post_type' => $post_type,
				'orderby' => 'rand',
				'posts_per_page' => '-1',
				'post_status' => 'publish',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'members-cat',
						'field' => 'term_id',
						'terms' => $term_category
					),
					array(
						'taxonomy' => 'members-specialty',
						'field' => 'term_id',
						'terms' => $term_specialty
					),
					array(
						'taxonomy' => 'members-hobby',
						'field' => 'term_id',
						'terms' => $term_hobby
					),
					array(
						'taxonomy' => 'members-group',
						'field' => 'term_id',
						'terms' => $term_group
					)
				)
			);
		} elseif($term_category !== 0 && $term_specialty !== 0 && $term_hobby !== 0 && $term_group == 0) {
			$args = array(
				'post_type' => $post_type,
				'orderby' => 'rand',
				'posts_per_page' => '-1',
				'post_status' => 'publish',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'members-cat',
						'field' => 'term_id',
						'terms' => $term_category
					),
					array(
						'taxonomy' => 'members-specialty',
						'field' => 'term_id',
						'terms' => $term_specialty
					),
					array(
						'taxonomy' => 'members-hobby',
						'field' => 'term_id',
						'terms' => $term_hobby
					)
				)
			);
		} elseif($term_category !== 0 && $term_specialty !== 0 && $term_hobby == 0 && $term_group !== 0) {
			$args = array(
				'post_type' => $post_type,
				'orderby' => 'rand',
				'posts_per_page' => '-1',
				'post_status' => 'publish',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'members-cat',
						'field' => 'term_id',
						'terms' => $term_category
					),
					array(
						'taxonomy' => 'members-specialty',
						'field' => 'term_id',
						'terms' => $term_specialty
					),
					array(
						'taxonomy' => 'members-group',
						'field' => 'term_id',
						'terms' => $term_group
					)
				)
			);
		} elseif($term_category !== 0 && $term_specialty !== 0 && $term_hobby == 0 && $term_group == 0) {
			$args = array(
				'post_type' => $post_type,
				'orderby' => 'rand',
				'posts_per_page' => '-1',
				'post_status' => 'publish',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'members-cat',
						'field' => 'term_id',
						'terms' => $term_category
					),
					array(
						'taxonomy' => 'members-specialty',
						'field' => 'term_id',
						'terms' => $term_specialty
					)
				)
			);
		} elseif($term_category !== 0 && $term_specialty == 0 && $term_hobby !== 0 && $term_group !== 0) {
			$args = array(
				'post_type' => $post_type,
				'orderby' => 'rand',
				'posts_per_page' => '-1',
				'post_status' => 'publish',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'members-cat',
						'field' => 'term_id',
						'terms' => $term_category
					),
					array(
						'taxonomy' => 'members-hobby',
						'field' => 'term_id',
						'terms' => $term_hobby
					),
					array(
						'taxonomy' => 'members-group',
						'field' => 'term_id',
						'terms' => $term_group
					)
				)
			);
		} elseif($term_category !== 0 && $term_specialty == 0 && $term_hobby !== 0 && $term_group == 0) {
			$args = array(
				'post_type' => $post_type,
				'orderby' => 'rand',
				'posts_per_page' => '-1',
				'post_status' => 'publish',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'members-cat',
						'field' => 'term_id',
						'terms' => $term_category
					),
					array(
						'taxonomy' => 'members-hobby',
						'field' => 'term_id',
						'terms' => $term_hobby
					)
				)
			);
		} elseif($term_category !== 0 && $term_specialty == 0 && $term_hobby == 0 && $term_group !== 0) {
			$args = array(
				'post_type' => $post_type,
				'orderby' => 'rand',
				'posts_per_page' => '-1',
				'post_status' => 'publish',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'members-cat',
						'field' => 'term_id',
						'terms' => $term_category
					),
					array(
						'taxonomy' => 'members-group',
						'field' => 'term_id',
						'terms' => $term_group
					)
				)
			);
		} elseif($term_category !== 0 && $term_specialty == 0 && $term_hobby == 0 && $term_group == 0) {
			$args = array(
				'post_type' => $post_type,
				'orderby' => 'rand',
				'posts_per_page' => '-1',
				'post_status' => 'publish',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'members-cat',
						'field' => 'term_id',
						'terms' => $term_category
					)
				)
			);
		} elseif($term_category == 0 && $term_specialty !== 0 && $term_hobby !== 0 && $term_group !== 0) {
			$args = array(
				'post_type' => $post_type,
				'orderby' => 'rand',
				'posts_per_page' => '-1',
				'post_status' => 'publish',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'members-specialty',
						'field' => 'term_id',
						'terms' => $term_specialty
					),
					array(
						'taxonomy' => 'members-hobby',
						'field' => 'term_id',
						'terms' => $term_hobby
					),
					array(
						'taxonomy' => 'members-group',
						'field' => 'term_id',
						'terms' => $term_group
					)
				)
			);
		} elseif($term_category == 0 && $term_specialty !== 0 && $term_hobby !== 0 && $term_group == 0) {
			$args = array(
				'post_type' => $post_type,
				'orderby' => 'rand',
				'posts_per_page' => '-1',
				'post_status' => 'publish',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'members-specialty',
						'field' => 'term_id',
						'terms' => $term_specialty
					),
					array(
						'taxonomy' => 'members-hobby',
						'field' => 'term_id',
						'terms' => $term_hobby
					)
				)
			);
		} elseif($term_category == 0 && $term_specialty !== 0 && $term_hobby == 0 && $term_group !== 0) {
			$args = array(
				'post_type' => $post_type,
				'orderby' => 'rand',
				'posts_per_page' => '-1',
				'post_status' => 'publish',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'members-specialty',
						'field' => 'term_id',
						'terms' => $term_specialty
					),
					array(
						'taxonomy' => 'members-group',
						'field' => 'term_id',
						'terms' => $term_group
					)
				)
			);
		} elseif($term_category == 0 && $term_specialty !== 0 && $term_hobby == 0 && $term_group == 0) {
			$args = array(
				'post_type' => $post_type,
				'orderby' => 'rand',
				'posts_per_page' => '-1',
				'post_status' => 'publish',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'members-specialty',
						'field' => 'term_id',
						'terms' => $term_specialty
					)
				)
			);
		} elseif($term_category == 0 && $term_specialty == 0 && $term_hobby !== 0 && $term_group !== 0) {
			$args = array(
				'post_type' => $post_type,
				'orderby' => 'rand',
				'posts_per_page' => '-1',
				'post_status' => 'publish',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'members-hobby',
						'field' => 'term_id',
						'terms' => $term_hobby
					),
					array(
						'taxonomy' => 'members-group',
						'field' => 'term_id',
						'terms' => $term_group
					)
				)
			);
		} elseif($term_category == 0 && $term_specialty == 0 && $term_hobby !== 0 && $term_group == 0) {
			$args = array(
				'post_type' => $post_type,
				'orderby' => 'rand',
				'posts_per_page' => '-1',
				'post_status' => 'publish',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'members-hobby',
						'field' => 'term_id',
						'terms' => $term_hobby
					)
				)
			);
		} elseif($term_category == 0 && $term_specialty == 0 && $term_hobby == 0 && $term_group !== 0) {
			$args = array(
				'post_type' => $post_type,
				'orderby' => 'rand',
				'posts_per_page' => '-1',
				'post_status' => 'publish',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'members-group',
						'field' => 'term_id',
						'terms' => $term_group
					)
				)
			);
		} else {
			$args = array(
				'post_type' => $post_type,
				'orderby' => 'rand',
				'posts_per_page' => '-1',
				'post_status' => 'publish'
			);
		}
		$loop = new WP_Query($args);
		echo $before_widget;
		echo '<h3 class="widget-title">'.$title.'</h3>';
		echo '<div class="sidebar-carousel">';
		if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();
?>
<div class="carousel-item bg-mask-wrapper">
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="waves-effect bg-mask"></a>
<div class="img-wrapper">
<?php
	$img_id = get_post_thumbnail_id();
	$img_url = wp_get_attachment_image_src($img_id, true);
?>
<img data-lazy="<?php echo $img_url[0]; ?>" alt="<?php the_title(); ?>">
</div>
<div class="meta-name">
<?php
	global $post;
	if(get_post_meta($post->ID, 'subtitle', true)) {
		echo '<span class="meta-works">' .get_post_meta($post->ID, 'subtitle', true). '</span>';
	}
	the_title();
?>
</div>
</div>
<?php
		endwhile;
		wp_reset_postdata();
		endif;
		echo '</div>';
		echo '<a class="button expand" href="'.get_permalink('125').'" title="メンバーの一覧を見る">メンバーの一覧</a>';
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['term_category'] = (int) $new_instance['term_category'];
		$instance['term_specialty'] = (int) $new_instance['term_specialty'];
		$instance['term_hobby'] = (int) $new_instance['term_hobby'];
		$instance['term_group'] = (int) $new_instance['term_group'];
		return $instance;
	}

	public function form( $instance ) {
		$title = (isset( $instance['title'] )) ? esc_attr( $instance['title'] ) : 'この分野に力を入れているメンバー';
		$term_category = (isset( $instance['term_category'] )) ? absint( $instance['term_category'] ) : 0;
		$term_specialty = (isset( $instance['term_specialty'] )) ? absint( $instance['term_specialty'] ) : 0;
		$term_hobby = (isset( $instance['term_hobby'] )) ? absint( $instance['term_hobby'] ) : 0;
		$term_group = (isset( $instance['term_group'] )) ? absint( $instance['term_group'] ) : 0;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">タイトル：</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'term_category' ); ?>">役職など：</label>
		<select name="<?php echo $this->get_field_name('term_category'); ?>" id="<?php echo $this->get_field_id('term_category'); ?>">
			<option value="0">すべて</option>
		<?php
			$args = array(
				'orderby' => 'ID',
				'order' => 'ASC',
				'hide_empty' => false
			);
			$terms = get_terms('members-cat', $args);
			foreach ($terms as $term) {
				echo '<option value="'.$term->term_id.'" '.selected($term->term_id, $term_category).'>'.$term->name.'（'.$term->count.'）</option>';
			}
		?>
		</select>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'term_specialty' ); ?>">主な取扱分野：</label>
		<select name="<?php echo $this->get_field_name('term_specialty'); ?>" id="<?php echo $this->get_field_id('term_specialty'); ?>">
			<option value="0">すべて</option>
		<?php
			$args = array(
				'orderby' => 'ID',
				'order' => 'ASC',
				'hide_empty' => false
			);
			$terms = get_terms('members-specialty', $args);
			foreach ($terms as $term) {
				echo '<option value="'.$term->term_id.'" '.selected($term->term_id, $term_specialty).'>'.$term->name.'（'.$term->count.'）</option>';
			}
		?>
		</select>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'term_group' ); ?>">所属団体：</label>
		<select name="<?php echo $this->get_field_name('term_group'); ?>" id="<?php echo $this->get_field_id('term_group'); ?>">
			<option value="0">すべて</option>
		<?php
			$args = array(
				'orderby' => 'ID',
				'order' => 'ASC',
				'hide_empty' => false
			);
			$terms = get_terms('members-group', $args);
			foreach ($terms as $term) {
				echo '<option value="'.$term->term_id.'" '.selected($term->term_id, $term_group).'>'.$term->name.'（'.$term->count.'）</option>';
			}
		?>
		</select>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'term_hobby' ); ?>">趣味：</label>
		<select name="<?php echo $this->get_field_name('term_hobby'); ?>" id="<?php echo $this->get_field_id('term_hobby'); ?>">
			<option value="0">すべて</option>
		<?php
			$args = array(
				'orderby' => 'ID',
				'order' => 'ASC',
				'hide_empty' => false
			);
			$terms = get_terms('members-hobby', $args);
			foreach ($terms as $term) {
				echo '<option value="'.$term->term_id.'" '.selected($term->term_id, $term_hobby).'>'.$term->name.'（'.$term->count.'）</option>';
			}
		?>
		</select>
		</p>
<?php
	}
}
	add_action('widgets_init', create_function('', 'register_widget("ringox_mem_link");'));