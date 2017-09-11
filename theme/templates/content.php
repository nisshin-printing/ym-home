<?php
	if ( is_home() || is_archive() ) {
?>
<article <?php post_class( 'post post--topic' ); ?> itemscope itemtype="http://schema.org/Article" itemref="author-prof">
	<meta itemprop="description" content="<?php the_excerpt(); ?>">
	<ul class="post--meta menu">
		<li class="published" itemprop="datePublished dateCreated" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"></li>
		<li class="updated" itemprop="dateModified" datetime="<?php echo get_the_modified_time( 'Y-m-d' ); ?>"></li>
		<li class="author hide" itemprop="author copyrightHolder editor" itemscope itemtype="http://schema.org/Person"><span class="author" itemprop="name"><?php the_title(); ?></span></li>
	</ul>
	<div class="row align-middle">
		<?php
			if ( has_post_thumbnail() ) :
		?>
		<div class="column small-4"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>
		<div class="column small-8">
		<?php
			else :
		?>
			<div class="column small-12">
		<?php
			endif;
		?>
			<h2 itemprop="about headline" class="entry-title post--title">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
					<span class="title--small title--block"><?php echo $job = ( get_post_meta ( $post->ID, 'subtitle', true ) ) ? get_post_meta ( $post->ID, 'subtitle', true )  : '' ?></span>
				</a>
			</h2>
		</div>
	</div>
	<?php
		$categories = get_the_category( $post->ID );
	?>
	<div class="post--label">
	<?php
		foreach ( $categories as $category ) :
	?>
		<a href="<?php echo get_category_link( $category->cat_ID ); ?>" class="label secondary"><?php echo $category->name; ?></a>
	<?php
			endforeach;
	?>
	</div>
</article>
<?php
	}
