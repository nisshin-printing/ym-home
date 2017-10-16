<?php
	if ( is_single() ) {
?>
<article <?php post_class( 'post post--members' ); ?> itemscope itemtype="http://schema.org/Article" itemref="author-prof">
	<meta itemprop="description" content="<?php the_excerpt(); ?>">
	<ul class="post--meta menu">
		<li class="published" itemprop="datePublished dateCreated" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"></li>
		<li class="updated" itemprop="dateModified" datetime="<?php echo get_the_modified_time( 'Y-m-d' ); ?>"></li>
		<li class="author hide" itemprop="author copyrightHolder editor" itemscope itemtype="http://schema.org/Person"><span class="author" itemprop="name"><?php the_title(); ?></span></li>
	</ul>
	<div class="row align-middle">
		<div class="column small-4"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>
		<div class="column small-8">
			<h2 itemprop="about headline" class="entry-title post--title">
				<span class="title--small title--block"><?php echo $job = ( get_post_meta ( $post->ID, 'subtitle', true ) ) ? get_post_meta ( $post->ID, 'subtitle', true )  : '' ?></span>
				<?php the_title(); ?>
				<span class="title--small title--block"><?php echo $ruby = ( get_post_meta ( $post->ID, 'name-rubi', true ) ) ? get_post_meta ( $post->ID, 'name-rubi', true )  : '' ?></span>
			</h2>
			<?php $singleSNS = array( 'facebook', 'twitter', 'linkedin', 'flickr', 'foursquare', 'instagram', 'googleplus', 'pinterest', 'youtube', 'tumblr', 'blog', 'cus1', 'cus2' ); ?>
			<div class="post--label post--sns">
			<?php
				foreach ( $singleSNS as $sns ) {
					if ( get_post_meta( $post->ID, $sns, true ) ) {
						if ( in_array( $sns, array( 'blog', 'cus1', 'cus2' ), true ) ) {
							$sns_title = $sns . '-title';
							echo '<a href="', get_post_meta( $post->ID, $sns, true ), '" class="label secondary">', get_post_meta( $post->ID, $sns_title, true ), '</a>';
						} else {
							echo '<a href="', get_post_meta( $post->ID, $sns, true ), '" class="label bg-', $sns,'">', $sns, '</a>';
						}
					}
				}
			?>
			</div>
		</div>
	</div>
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
	<div class="entry"><?php the_content(); ?></div>
</article>
<?php
		$args = array(
			'before'           => '<p class="button--next-page">',
			'after'            => '</p>',
			'next_or_number'   => 'next',
			'nextpagelink'     => get_the_title() . 'についてもっと見る　▶',
			'previouspagelink' => '◀　前のページに戻る'
		);
		wp_link_pages( $args );
	?>
	<h3>弁護士の人柄で選んでください！</h3>
	<div class="cta--select-members">
		<div class="row align-middle">
			<div class="column small-2 medium-4"><a href="<?php echo get_page_link( '1126' ); ?>" title="<?php echo get_the_title( '1126' ); ?>"><?php the_post_thumbnail(); ?></a></div>
			<div class="column small-10 medium-8"><a href="<?php echo get_page_link( '1126' ); ?>" class="cta--link__text"><?php the_title(); ?>に相談する</a></div>
		</div>
	</div>
<?php
	} else {
?>
<article <?php post_class( 'post post--members' ); ?> itemscope itemtype="http://schema.org/Article" itemref="author-prof">
	<meta itemprop="description" content="<?php the_excerpt(); ?>">
	<ul class="post--meta menu">
		<li class="published" itemprop="datePublished dateCreated" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"></li>
		<li class="updated" itemprop="dateModified" datetime="<?php echo get_the_modified_time( 'Y-m-d' ); ?>"></li>
		<li class="author hide" itemprop="author copyrightHolder editor" itemscope itemtype="http://schema.org/Person"><span class="author" itemprop="name"><?php the_title(); ?></span></li>
	</ul>
	<div class="row align-middle">
		<div class="column small-2"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>
		<div class="column small-10">
			<h2 itemprop="about headline" class="entry-title post--title">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
					<span class="title--small title--block"><?php echo $job = ( get_post_meta ( $post->ID, 'subtitle', true ) ) ? get_post_meta ( $post->ID, 'subtitle', true )  : '' ?></span>
				</a>
			</h2>
		</div>
	</div>
</article>
<?php
	}
?>
