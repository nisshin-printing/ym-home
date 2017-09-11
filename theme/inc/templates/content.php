<?php
if ( is_page() ) {
	the_content();
} elseif ( is_single() ) {
	if ( get_adjacent_post( false, '', true ) ) {
		$pre_post = get_previous_post();
		$pre_post_title = $pre_post->post_title;
		if ( mb_strlen( $pre_post_title ) > 10 ) {
			$pre_post_title = mb_substr( $pre_post_title, 0, 10 ) . '...';
		}
	}
	if ( get_adjacent_post( false, '', false ) ) {
		$next_post = get_next_post();
		$next_post_title = $next_post->post_title;
		if ( mb_strlen( $next_post_title ) > 10 ) {
			$next_post_title = mb_substr( $next_post_title, 0, 10 ) . '...';
		}
	}
	$get_lawyer_check = get_post_meta( $post->ID, 'charge_lawyer', true );
?>
<article id="post-<?php the_ID(); ?>">
	<h1><?php the_title(); ?></h1>
	<ul class="post-meta">
		<li itemprop="datePublished" datetime="<?php the_time( 'c' ); ?>">
			<i class="fa fa-calendar"></i>
			<?php the_time( 'Y年m月d日' ); ?><span class="count-text ml1">（<?php echo human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . '前'; ?>）</span>
		</li>
		<li>
			<i class="fa fa-clock-o"></i>
			<?php
				$post_content = $post->post_content;
				$word = mb_strlen( strip_tags( $post_content ) );
				$m = floor( $word / 600 ) + 1;
				$est = ( $m == 0 ? '' : $m );
				echo $word . '文字数（所要時間';
				echo $est . '分）';
			?>
		</li>
		<li>
			<i class="fa fa-archive"></i>
			<?php the_category( ' / ', 'multiple' ); ?>
		</li>
		<?php
			if ( has_tag() ) {
				echo '<li><i class="fa fa-tags"></i>';
				echo the_tags( 'タグ : ', ' / ' );
				echo '</li>';
			}
		?>
	<?php
		if ( is_array( $get_lawyer_check ) ) {
			echo '<li><i class="fa fa-user"></i>このコラムを書いた人<br>';
			foreach ( $get_lawyer_check as $member ) {
				$post_status = get_post_status( $member );
				if ( 'publish' == $post_status ) {
					echo '<div class="relate-members">', get_the_post_thumbnail( $member, array( 100, 100 ) ), '<a href="' . get_permalink( $member ) . '" title="' . get_the_title( $member ) . 'を詳しく知る">' . get_the_title( $member ) . '</a></div>';
				}
			}
			echo '</li>';
		}
	?>
	</ul>
	<div class="content-post">
		<?php the_content(); ?>
	</div>
</article>
<?php
if ( is_array( $get_lawyer_check ) ) :
echo '<div class="section">
	<h3>担当者がわからないまま相談するのは不安...</h3>
	<div class="cta-select-members">
		<a href="', get_page_link( '1126' ), '" title="', get_the_title( '1126' ), '" class="waves-effect">ご希望の担当者に法律相談できます！</a>
	</div>
</div>';
endif;
?>
<div class="nav-prenext">
	<ul>
		<li>
			<?php
				if ( ! empty( $pre_post ) ) {
					echo '<a href="' . get_permalink( $pre_post->ID ) . '" title="' . $pre_post->post_title . '"><i class="fa fa-angle-left"></i><span class="hide-forsmall-only">' . $pre_post_title . '</span></a>';
				}
			?>
		</li>
		<li>
			<a href="<?php echo get_permalink( '544' ); ?>" title="<?php echo get_the_title( '544' ); ?>"><i class="fa fa-file-text"></i><span class="block-for-small-up">一覧へ戻る</span></a>
		</li>
		<li>
			<?php
				if ( ! empty( $next_post ) ) {
					echo '<a href="' . get_permalink( $next_post->ID ) . '" title="' . $next_post->post_title . '"><span class="hide-forsmall-only">' . $next_post_title . '</span><i class="fa fa-angle-right"></i></a>';
				}
			?>
		</li>
	</ul>
</div>
<?php
	} else {
		$get_lawyer_check = get_post_meta( $post->ID, 'charge_lawyer', true );
?>
<article class="card post-list clearfix">
	<a class="waves-effect" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
	<?php
		if ( has_post_thumbnail() ) {
			$img_id = get_post_thumbnail_id();
			echo '<figure class="card-img">
			<img src="', dtdsh_photon_img( $img_id, 'src' ), '" alt="', get_the_title(), '" width="', dtdsh_photon_img( $img_id, 'width' ), '" height="', dtdsh_photon_img( $img_id, 'height' ), '">
			</figure>';
		} elseif ( is_array( $get_lawyer_check ) ) {
			$img_id = get_post_thumbnail_id( $get_lawyer_check[0] );
			echo '<figure class="card-img">
			<img src="', dtdsh_photon_img( $img_id, 'src', array( 200, 200 ) ), '" width="', dtdsh_photon_img( $img_id, 'width', array( 200, 200 ) ), '" height="', dtdsh_photon_img( $img_id, 'height', array( 200, 200 ) ), '" alt="', get_the_title(), '">
			</figure>';
		} elseif ( dtd_catch_content_img() != 'none' ) {
			echo '<figure class="card-img">
			<img src="', dtd_catch_content_img(), '" alt="', get_the_title(), '">
			</figure>';
		}
	?>
	<div class="card-content">
		<p class="card-time">
			<time datetime="<?php the_time( 'c' ); ?>" itemprop="datePublished"><?php the_time( 'Y.m.d' ); ?></time>
		</p>
		<p class="card-title color-black"><?php the_title(); ?></p>
	</div>
</article>
<?php
	}
?>