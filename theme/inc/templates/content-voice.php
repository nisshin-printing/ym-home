<?php
	// File Security Check
	if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
		die ( 'このページヘアクセスする権限がありません！　　　You do not have sufficient permissions to access this page!' );
	}
	$ringo = get_option('ringosh');

	if(is_archive() || is_page() || is_tag() || is_category()) {
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('ringotheme-format-post'); ?>>
<div class="entry">
<p class="cat"><?php the_terms(0, 'voice-cat', '分類 : ', ' / '); ?></p>
<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
<?php the_content(); ?>
</div>
</article>
<?php
	} else {
		if(get_adjacent_post(false, '', true)) {
			$previous_post = get_previous_post();
			$pre_post_title = $previous_post->post_title;
			if(mb_strlen($pre_post_title) > 11 ) {
				$pre_post_title = mb_substr($pre_post_title, 0, 11).'...';
			} else {
				$pre_post_title = $previous_post->post_title;
			}
		}
		if(get_adjacent_post(false, '', false)) {
			$next_post = get_next_post();
			$next_post_title = $next_post->post_title;
			if(mb_strlen($next_post_title) > 11 ) {
				$next_post_title = mb_substr($next_post_title, 0, 11).'...';
			} else {
				$next_post_title = $next_post->post_title;
			}
		}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('ringotheme-format-post'); ?>>
<h1><?php the_title(); ?></h1>
<ul class="meta">
<li itemprop="datePublished" datetime="<?php the_time('c'); ?>"><i class="fa fa-calendar"></i><?php the_time('Y年m月d日'); ?><span class="mono">（<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) .'前'; ?>）</span></li>
<li><i class="fa fa-clock-o"></i>
<?php
	$mycontent = $post->post_content;
	$word = mb_strlen(strip_tags($mycontent));
	$m = floor($word / 600) + 1;
	$est = ($m == 0 ? '' : $m);
	echo $word. '文字（所要時間';
	echo $est. '分）';
?>
</li>
<li><i class="fa fa-archive"></i><?php the_terms(0, 'voice-cat', '分類 : ', ' / '); ?></li>
<?php
	if(has_term('', 'voice-tag', $post)) {
		echo '<li><i class="fa fa-tags"></i>';
		echo the_terms(0, 'voice-tag', 'タグ : ', ' / ');
		echo '</li>';
	}
?>
<?php
	$members = get_post_meta($post->ID, 'charge_lawyer', true);
	if(is_array($members)) {
		echo '<li class="charge-members"><i class="fa fa-user"></i>関連メンバー ： ';
		foreach ($members as $member) {
			$post_status = get_post_status($member);
			if($post_status == 'publish') {
				echo '<a href="'.get_permalink($member).'" title="'.get_the_title($member).'">'.get_the_title($member).'</a>';
			} else {
				echo '<a href="'.get_permalink('125').'" title="メンバー一覧を見る">メンバー一覧を見る</a>';
			}
		}
		echo '</li>';
		unset($member);
	}
?>
</ul>
<div class="entry"><?php the_content(); ?></div>
</article>
<div class="cases-nav-holder">
	<ul class="text-center list-no row">
		<li class="text-left"><?php if(!empty($previous_post)) : ?><a href="<?php echo esc_url(get_permalink($previous_post->ID)); ?>" title="<?php echo $previous_post->post_title; ?>"><i class="fa fa-angle-left"></i><span class="hide-forsmall-only"><?php echo $pre_post_title; ?></span></a><?php endif; ?></li>
		<li class="text-center"><a href="<?php echo get_permalink(get_page_by_path('voice')); ?>" title="<?php echo get_post_type_object(get_post_type())->label; ?>"><i class="fa fa-file-text"></i><span>一覧へ戻る</span></a></li>
		<li class="text-right"><?php if(!empty($next_post)) : ?><a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" title="<?php echo $next_post->post_title; ?>"><span class="hide-forsmall-only"><?php echo $next_post_title; ?></span><i class="fa fa-angle-right"></i></a><?php endif; ?></li>
	</ul>
</div>
<?php }