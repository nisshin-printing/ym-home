<?php
	$curquer = $wp_query->get_queried_object();
	$header_title = '';
	if ( is_search() ) {
		$header_title = '「' . get_search_query() . '」' . 'で検索した結果';
	} elseif ( is_archive() ) {
		if ( is_day() ) {
			$header_title = 'アーカイブ : ' . get_the_date( 'Y年m月d日' );
		} elseif ( is_month() ) {
			$header_title = 'アーカイブ : ' . get_the_date( 'Y年m月' );
		} elseif ( is_year() ) {
			$header_title = 'アーカイブ : ' . get_the_date( 'Y年' );
		} elseif ( is_tag() ) {
			$header_title = 'タグ : ' . single_cat_title( '', false );
		} elseif ( is_category() || is_tax() ) {
			$header_title = single_cat_title( '', false );
		} else {
			$header_title = post_type_archive_title( '', false );
		}
	} elseif ( is_author() ) {
		$header_title = single_cat_title( '', false );
	} elseif ( is_page() ) {
		$header_title = get_the_title( $post->ID );
	} elseif ( is_single() ) {
		$header_title = ( get_post_type( $post->ID ) == 'post' ) ? 'コラム' : get_post_type_object( get_post_type() )->label;
	} elseif ( is_404() ) {
		$header_title = __( 'ページが見つかりませんでした！', 'dtdsh' );
	} elseif ( is_home() ) {
		$header_title = __( 'トピックス', 'dtdsh' );
	}
?>
<div class="header-wrapper">
	<h1><?php echo $header_title; ?></h1>
</div>
<?php
	echo breadcrumbs();
	if ( is_page( 'members' ) || is_singular( 'members' ) ) {
?>
<dl class="sub-nav">
	<dt>メンバー ：</dt>
<?php
	$mem_args = array(
		'posts_per_page' => '-1',
		'order'          => 'ASC',
		'post_status'    => 'publish',
		'post_type'      => 'members',
	);
	$loop = new WP_Query( $mem_args );
	if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
		$is_active = ( is_single( $id ) ) ? ' class="active"' : '';
?>
		<dd><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"<?php echo $is_active; ?>><?php the_title(); ?></a></dd>
<?php
	endwhile;
	endif;
?>
</dl>
<?php
	}