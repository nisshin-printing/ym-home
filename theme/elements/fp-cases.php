<div class="fp--cases">
	<h2 class="cases--title title--border-bottom -center">解決事例</h2>
	<a class="row small-up-1 medium-up-2 large-up-4">
		<?php
			$terms = get_terms( 'cases-cat' );
			foreach ( $terms as $term ) {
				$args = array(
					'posts_per_page' => 1,
					'post_type' => 'cases',
					'post_status' => 'publish',
					'orderby' => 'modified',
					'order' => 'DESC',
					'tax_query' => array(
						array(
							'taxonomy' => 'cases-cat',
							'field' => 'slug',
							'terms' => $term->slug
						)
					)
				);
				$loop = new WP_Query( $args );
				if ( $loop->have_posts() ) :
					while ( $loop->have_posts() ) :
						$loop->the_post();
		?>
		<article class="column">
			<h3><a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a></h3>
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		</article>
		<?php
		endwhile;
	endif;
			}
		?>
		</div>
		<p class="text-center"><a href="<?php echo home_url(), '/cases'; ?>" class="button">一覧を見る</article></p>
	</div>
</div>
