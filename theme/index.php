<?php

if ( is_post_type_archive( 'cases' ) || is_singular( 'cases' ) ) {
	$title = '解決事例';
} else if ( is_tax( 'cases-cat' ) ) {
	$title = single_cat_title( '解決事例カテゴリ：', false );
} else if ( is_post_type_archive( 'voice' ) || is_singular( 'voice' ) || is_tax( 'voice-cat' ) ) {
	$title = 'お客様の声';
} else if ( is_tax( 'voice-cat' ) ) {
	$title = single_cat_title( 'お客様の声カテゴリ：', false );
} else if ( is_post_type_archive( 'members' ) || is_singular( 'members' ) ) {
	$title = '弁護士等紹介';
} else if ( is_tax( 'members-cat' ) ) {
	$title = single_cat_title( 'メンバーカテゴリ：', false );
} else if ( is_archive() || is_single() || is_home() ) {
	$title = 'トピックス';
} else {
	$title = get_the_title();
}

	get_header();
?>
<main>
	<header class="pageheader">
		<div class="row">
			<div class="column">
				<h1 class="pageheader--title"><?php echo $title; ?></h1>
			</div>
		</div>
	</header>
	<?php
		NID_Crumbs::crumbs();
		if ( is_post_type_archive( 'members' ) || is_tax( 'members-cat' ) || is_singular( 'members' ) ) {
	?>
	<div class="row menu--members__wrap">
		<dl class="column menu--members">
			<dt class="menu--item">一覧：</dt>
			<?php
				$args = array(
					'post_type' => 'members',
					'posts_per_page' => -1,
					'order' => 'ASC',
					'post_status' => 'publish'
				);
				$loop = new WP_Query( $args );
				if ( $loop->have_posts() ) :
					while ( $loop->have_posts() ) :
						$loop->the_post();
			?>
				<dd class="menu--item"><a href="<?php the_permalink(); ?>" class="menu--link"><?php the_title(); ?></a></dd>
			<?php
					endwhile;
				endif;
			?>
		</dl>
	</div>
	<?php
		}
	?>
	<div class="row">
		<div class="column large-3 sidebar--wrap"><?php get_sidebar(); ?></div>
		<div class="sidenav--overlay js--sidenav--button"></div>
		<div class="column contents">
			<?php
				if ( is_post_type_archive( 'members' ) || is_tax( 'members-cat' ) || is_singular( 'members' ) ) {
					if ( have_posts() ) : while ( have_posts() ) : the_post();
						get_template_part( './templates/page--members' );
					endwhile;endif;
				} else if ( is_post_type_archive() || is_tax() ) {
					if ( have_posts() ) : while ( have_posts() ) : the_post();
						get_template_part( './templates/custom-post-type' );
					endwhile;endif;
				} else if ( is_archive() || is_home() ) {
					if ( have_posts() ) : while ( have_posts() ) : the_post();
						get_template_part( './templates/content' );
					endwhile;endif;
				} else if ( is_page() || is_single() ) {
					the_content();
				}
			?>
		</div>
		<div class="column small-12"><?php NID_Pagination::pagination(); ?></div>
	</div>
</main>
<?php
	get_footer();
