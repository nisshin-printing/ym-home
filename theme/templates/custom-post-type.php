<?php
if ( is_post_type_archive( 'voice' ) || is_tax( 'voice-cat' ) ) :

	$is_client = $is_advice = $is_komon = 'button';
	if ( is_tax( 'voice-cat', 'client' ) ) {
		$is_client = 'button hollow';
	} else if ( is_tax( 'voice-cat', 'advice' ) ) {
		$is_advice = 'button hollow';
	} else if ( is_tax( 'voice-cat', 'interview' ) ) {
		$is_komon = 'button hollow';
	}

	?>
<p class="text-center"><img src="<?php echo get_template_directory_uri(), '/assets/img/voice/voice-top.png'; ?>" alt="お客様アンケートでの満足度"></p>

<div class="row align-center menu--voice-cat">
	<div class="column"><a class="<?php echo $is_client; ?>" href="<?php echo get_term_link( 'client', 'voice-cat' ); ?>">依頼者様の声</a></div>
	<div class="column"><a class="<?php echo $is_advice; ?>" href="<?php echo get_term_link( 'advice', 'voice-cat' ); ?>">相談者様の声</a></div>
	<div class="column"><a class="<?php echo $is_komon; ?>" href="https://hiroshima-kigyo.com/category/interview" target="_blank">顧問先インタビュー</a></div>
</div>
<?php
endif;
if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<article <?php post_class( 'post post--show' ); ?> itemscope itemtype="http://schema.org/Article" itemref="author-prof">
	<meta itemprop="description" content="<?php the_excerpt(); ?>">
	<ul class="post--meta menu">
		<li class="published" itemprop="datePublished dateCreated" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"></li>
		<li class="updated" itemprop="dateModified" datetime="<?php echo get_the_modified_time( 'Y-m-d' ); ?>"></li>
		<li class="author hide" itemprop="author copyrightHolder editor" itemscope itemtype="http://schema.org/Person"><span class="author" itemprop="name"><?php the_author(); ?></span></li>
	</ul>
	<h2 itemprop="about headline" class="entry-title post--title"><?php
		the_title();
		$boxNum = get_post_meta( $post->ID, 'box_numbers', true );
		if ( is_user_logged_in() && isset( $boxNum ) ) {
			echo '<span class="label">', $boxNum, '</span>';
		}
	?></h2>
	<?php
	$post_type = $post->post_type;
	$taxonomies = get_object_taxonomies( $post_type, 'objects' );
	?>
	<div class="post--label">
		<?php
			foreach ( $taxonomies as $taxonomy_slug => $taxonomy ) :
				$terms = get_the_terms( $post->ID, $taxonomy_slug );
				if ( ! empty( $terms ) ) :
					foreach ( $terms as $term ) :
		?>
		<a href="<?php echo get_term_link( $term->slug, $taxonomy_slug ); ?>" class="label secondary"><?php echo $term->name; ?></a>
		<?php
					endforeach;
				endif;
			endforeach;
		?>
	</div>
	<div class="content-post content-cases"><?php the_content(); ?></div>
</article>
<?php
endwhile;endif;
