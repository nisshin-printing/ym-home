<?php
if ( ! function_exists( 'cases_post_list' ) ) :
function cases_post_list( $cat_slug ) {
	$args = array(
		'post_type'      => 'cases',
		'posts_per_page' => 1,
		'orderby'        => 'modified',
		'post_status'    => 'published',
		'tax_query'      => array(
			'taxonomy' => 'cases-cat',
			'field'    => 'slug',
			'terms'    => $cat_slug
		)
	);
	$casesposts = new WP_Query( $args );
	if ( $casesposts->have_posts() ) :
		while ( $casesposts->have_posts() ) :
			$casesposts->the_post();
?>
<article class="column cases-<?php echo $cat_slug; ?>">
	<div class="cases--category">
		<h3 class="cases--category-title"><?php single_tag_title(); ?></h3>
		<a href="" class="cases--category-link"><?php echo get_term_by( 'slug', $cat_slug, 'cases-cat' )->term_id; ?></a>
	</div>
	<div class="cases--content">
		<h4 class="cases--content-title"><a href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>"><?php the_title(); ?></a></h4>
		<p class="cases--content-excerpt"><a href="<?php the_permalink(); ?>" rel="nofollow"><?php the_excerpt(); ?></a></p>
	</div>
</article>
<?php
			endwhile;
?>
<article class="column cases-<?php echo $cat_slug; ?>">
	<div class="cases--category">
		<h3 class="cases--category-title"><?php single_tag_title(); ?></h3>
		<a href="<?php echo get_term_link( get_term_by( 'slug', $cat_slug, 'cases-cat' )->term_id ); ?>" title="<?php echo get_term_by( 'slug', $cat_slug, 'cases-cat' )->name; ?>" class="cases--category-link">></a>
	</div>
	<div class="cases--content">
		<p class="cases--content-excerpt">まだ解決事例が登録されていません。</p>
	</div>
</article>
<?php
	endif;
}
endif;
?>
<section class="fp--cases">
	<h2 class="cases--title title--border-bottom -center">解決事例</h2>
	<div class="row small-up-1 medium-up-2 large-up-4">
		<?php
			cases_post_list( 'traffic-acc' );
			cases_post_list( 'divorce' );
			cases_post_list( 'inheritance' );
			cases_post_list( 'debts' );
			cases_post_list( 'criminal-case' );
			cases_post_list( 'real-eatate' );
			cases_post_list( 'corporation' );
			cases_post_list( 'civil-case' );
		?>
		</div>
		<p class="text-center"><a href="<?php echo DTDSH_HOME_URL, 'cases'; ?>" class="button">一覧を見る</a></p>
	</div>
</section>
