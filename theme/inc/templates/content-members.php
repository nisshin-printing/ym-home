<?php
if ( is_page() ) {
?>
<div class="accordion" data-accordion>
	<div class="accordion-item btn-members-filter" data-accordion-item><a class="accordion-title"><i class="fa fa-filter"></i>フィルター</a>
		<div class="accordion-content" data-tab-content>
			<div class="row">
				<div class="filter-wrapper large-6 column">
					<label for="f-post">役職</label>
					<select id="f-post" class="filter-group" data-filter-group="post">
						<option value="" selected="selected">すべて表示</option>
					<?php
						$args = array(
							'orderby' => 'count',
							'order' => 'DESC'
							);
						$terms = get_terms('members-cat', $args);
						if(!empty($terms)) {
							foreach ($terms as $term) {
								echo '<option value=".members-cat-'.$term->term_id.'">'.$term->name.'('.$term->count.')</option>';
							}
						}
					?>
					</select>
				</div>
				<div class="filter-wrapper large-6 column">
					<label for="f-specialty">力を入れたい取扱分野（主な取扱範囲）</label>
					<select id="f-specialty" class="filter-group" data-filter-group="specialty">
						<option value="" selected="selected">すべて表示</option>
						<?php
						$args = array(
							'orderby' => 'count',
							'order' => 'DESC'
							);
						$terms = get_terms('members-specialty', $args);
						if(!empty($terms)) {
							foreach ($terms as $term) {
								echo '<option value=".members-specialty-'.$term->term_id.'">'.$term->name.'('.$term->count.')</option>';
							}
						}
						?>
					</select>
				</div>
				<div class="filter-wrapper large-6 column">
					<label for="f-hobby">趣味</label>
					<select id="f-hobby" class="filter-group" data-filter-group="hobby">
						<option value="" selected="selected">すべて表示</option>
						<?php
						$args = array(
							'orderby' => 'count',
							'order' => 'DESC'
							);
						$terms = get_terms('members-hobby', $args);
						if(!empty($terms)) {
							foreach ($terms as $term) {
								echo '<option value=".members-hobby-'.$term->term_id.'">'.$term->name.'('.$term->count.')</option>';
							}
						}
						?>
					</select>
				</div>
				<div class="filter-wrapper large-6 column">
					<label for="f-group">所属団体</label>
					<select id="f-group" class="filter-group" data-filter-group="group">
						<option value="" selected="selected">すべて表示</option>
						<?php
						$args = array(
							'orderby' => 'count',
							'order' => 'DESC'
							);
						$terms = get_terms('members-group', $args);
						if(!empty($terms)) {
							foreach ($terms as $term) {
								echo '<option value=".members-group-'.$term->term_id.'">'.$term->name.'('.$term->count.')</option>';
							}
						}
					?>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="grid-members">
	<div class="row">
		<?php
			$mem_args = array(
				'post_type'      => 'members',
				'posts_per_page' => '-1',
				'post_status'    => 'publish',
			);
			$loop = new WP_Query( $mem_args );
			if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();
		?>
		<article <?php post_class( 'grid-item bg-mask-wrapper' ); ?>>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="bg-mask waves-effect"></a>
			<div class="img-wrapper m0-auto"><?php echo get_post_meta( $post->ID, 'mem-label', true ); the_post_thumbnail(); ?></div>
			<h2>
				<?php
				if(get_post_meta($post->ID, 'subtitle', true)) {
					echo '<span class="subtitle">' .get_post_meta($post->ID, 'subtitle', true). '</span>';
				}
				?>
				<?php the_title(); ?>
			</h2>
		</article>
		<?php
			endwhile;
			endif;
		?>
</div>
</div>
<?php
} else {
	?>
	<article>
		<header class="row">
			<div class="large-4 columns img-wrapper m0-auto"><?php the_post_thumbnail('full'); ?></div>
			<div class="large-8 columns members-header text-center">
				<p class="meta-job"><?php echo $job = (get_post_meta ( $post->ID, 'subtitle', true ) ) ? get_post_meta ( $post->ID, 'subtitle', true )  : '' ?></span></p>
				<h1><?php the_title(); ?></h1>
				<p class="meta-name"><?php echo $furigana = (get_post_meta ( $post->ID, 'name-rubi', true ) ) ? get_post_meta ( $post->ID, 'name-rubi', true )  : '' ?></p>
				<?php
				if (
					get_post_meta( $post->ID, 'facebook', true ) ||
					get_post_meta( $post->ID, 'twitter', true ) ||
					get_post_meta( $post->ID, 'linkedin', true ) ||
					get_post_meta( $post->ID, 'flickr', true ) ||
					get_post_meta( $post->ID, 'foursquare', true ) ||
					get_post_meta( $post->ID, 'instagram', true ) ||
					get_post_meta( $post->ID, 'googleplus', true ) ||
					get_post_meta( $post->ID, 'pinterest', true ) ||
					get_post_meta( $post->ID, 'youtube', true ) ||
					get_post_meta( $post->ID, 'tumblr', true ) ||
					get_post_meta( $post->ID, 'blog-title', true ) ||
					get_post_meta( $post->ID, 'cus1-title', true ) ||
					get_post_meta( $post->ID, 'cus2-title', true )
					) {
						?>
						<div class="meta-links">
							<?php
							if ( get_post_meta ( $post->ID, 'facebook', true ) ) {
								echo '<a class="button waves-effect btn-facebook" href="' . get_post_meta ( $post->ID, 'facebook', true ) . '" target="_blank" title="facebook"><i class="fa fa-facebook"></i></a>';
							}
							if ( get_post_meta ( $post->ID, 'twitter', true ) ) {
								echo '<a class="button waves-effect btn-twitter" href="' . get_post_meta ( $post->ID, 'twitter', true ) . '" target="_blank" title="twitter"><i class="fa fa-twitter"></i></a>';
							}
							if ( get_post_meta ( $post->ID, 'linkedin', true ) ) {
								echo '<a class="button waves-effect btn-linkedin" href="' . get_post_meta ( $post->ID, 'linkedin', true ) . '" target="_blank" title="linkedin"><i class="fa fa-linkedin"></i></a>';
							}
							if ( get_post_meta ( $post->ID, 'flickr', true ) ) {
								echo '<a class="button waves-effect btn-flickr" href="' . get_post_meta ( $post->ID, 'flickr', true ) . '" target="_blank" title="flickr"><i class="fa fa-flickr"></i></a>';
							}
							if ( get_post_meta ( $post->ID, 'foursquare', true ) ) {
								echo '<a class="button waves-effect btn-foursquare" href="' . get_post_meta ( $post->ID, 'foursquare', true ) . '" target="_blank" title="foursquare"><i class="fa fa-foursquare"></i></a>';
							}
							if ( get_post_meta ( $post->ID, 'instagram', true ) ) {
								echo '<a class="button waves-effect btn-instagram" href="' . get_post_meta ( $post->ID, 'instagram', true ) . '" target="_blank" title="instagram"><i class="fa fa-instagram"></i></a>';
							}
							if ( get_post_meta ( $post->ID, 'googleplus', true ) ) {
								echo '<a class="button waves-effect btn-googleplus" href="' . get_post_meta ( $post->ID, 'googleplus', true ) . '" target="_blank" title="google+"><i class="fa fa-google-plus"></i></a>';
							}
							if ( get_post_meta ( $post->ID, 'pinterest', true ) ) {
								echo '<a class="button waves-effect btn-pinterest" href="' . get_post_meta ( $post->ID, 'pinterest', true ) . '" target="_blank" title="pinterest"><i class="fa fa-pinterest"></i></a>';
							}
							if ( get_post_meta ( $post->ID, 'youtube', true ) ) {
								echo '<a class="button waves-effect btn-youtube" href="' . get_post_meta ( $post->ID, 'youtube', true ) . '" target="_blank" title="youtube"><i class="fa fa-youtube"></i></a>';
							}
							if ( get_post_meta ( $post->ID, 'tumblr', true ) ) {
								echo '<a class="button waves-effect btn-tumblr" href="' . get_post_meta ( $post->ID, 'tumblr', true ) . '" target="_blank" title="tumblr"><i class="fa fa-tumblr"></i></a>';
							}
							if ( get_post_meta ( $post->ID, 'blog-title', true )  && get_post_meta ( $post->ID, 'blog', true ) ) {
								echo '<a class="button waves-effect" href="' . get_post_meta ( $post->ID, 'blog', true ) . '" target="_blank" title="' . get_post_meta ( $post->ID, 'blog-title', true ) . '">' . get_post_meta ( $post->ID, 'blog-title', true ) . '</a></li>';
							}
							if ( get_post_meta ( $post->ID, 'cus1-title', true )  && get_post_meta ( $post->ID, 'cus1', true ) ) {
								echo '<a class="button waves-effect" href="' . get_post_meta ( $post->ID, 'cus1', true ) . '" target="_blank" title="' . get_post_meta ( $post->ID, 'cus1-title', true ) . '">' . get_post_meta ( $post->ID, 'cus1-title', true ) . '</a></li>';
							}
							if ( get_post_meta ( $post->ID, 'cus2-title', true )  && get_post_meta ( $post->ID, 'cus2', true ) ) {
								echo '<a class="button waves-effect" href="' . get_post_meta ( $post->ID, 'cus2', true ) . '" target="_blank" title="' . get_post_meta ( $post->ID, 'cus2-title', true ) . '">' . get_post_meta ( $post->ID, 'cus2-title', true ) . '</a></li>';
							}
							?>
						</div>
						<?php } ?>
					</div>
				</header>
				<div class="entry"><?php the_content(); ?></div>
			</article>
			<?php
		}
		?>