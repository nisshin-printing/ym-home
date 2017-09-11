<?php
	$is_posttype = get_post_type( $post->ID ); 
	if ( 'cases' === $is_posttype ) {
		$cat = 'cases-cat';
		$tag = 'cases-tag';
	} elseif ( 'voice' === $is_posttype ) {
		$cat = 'voice-cat';
		$tag = 'voice-tag';
	} elseif ( 'advice' === $is_posttype ) {
		$cat = 'advice-cat';
		$tag = 'advice-tag';
	}
?>
<article id="post-<?php the_ID(); ?>" class="l-archive_showpost">
	<?php
	if ( $user_ID && get_post_meta( $post->ID, 'box_numbers', true ) ) {
		echo '<p class="meta-inbox"><i class="fa fa-inbox"></i>' . get_post_meta( $post->ID, 'box_numbers', true ) . '</p>';
	}
	$is_admin = ( 0 === $user_ID ) ? ' class="hide"' : '';
	?>
	<h1><?php the_title(); ?></h1>
	<ul class="post-meta">
		<li itemprop="datePublished" datetime="<?php the_time( 'c' ); ?>"<?php echo $is_admin; ?>><i class="fa fa-calendar"></i><?php the_time( 'Y年m月d日' ); ?><span class="count-text">（<?php echo human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . '前'; ?>）</span></li>
		<?php
		echo get_the_term_list( $post->ID, $cat, '<li><i class="fa fa-archive"></i>', ' / ', '</li>' );
		echo get_the_term_list( $post->ID, $tag, '<li><i class="fa fa-tags"></i>', ' / ', '</li>' );
		$members = get_post_meta( $post->ID, 'charge_lawyer', true );
		if ( is_array( $members ) ) {
			echo '<li><i class="fa fa-user"></i>関連メンバー : ';
			foreach ( $members as $member ) {
				$post_status = get_post_status( $member );
				if ( 'publish' == $post_status ) {
					echo '<a href="' . get_permalink( $member ) . '" title="' . get_the_title( $member ) . '">' . get_the_title( $member ) . '</a>';
				}
			}
			echo '</li>';
			unset( $member );
		}
		?>
	</ul>
	<div class="content-post content-cases">
		<?php
		the_content();
		?>
	</div>
</article>