<article <?php post_class( 'post post--show' ); ?> itemscope itemtype="http://schema.org/Article" itemref="author-prof">
	<meta itemprop="description" content="<?php the_excerpt(); ?>">
	<ul class="post--meta menu">
		<li class="published" itemprop="datePublished dateCreated" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"></li>
		<li class="updated" itemprop="dateModified" datetime="<?php echo get_the_modified_time( 'Y-m-d' ); ?>"></li>
		<li class="author hide" itemprop="author copyrightHolder editor" itemscope itemtype="http://schema.org/Person"><span class="author" itemprop="name"><?php the_author(); ?></span></li>
	</ul>
	<h2 itemprop="about headline" class="entry-title post--title"><?php the_title(); ?></h2>
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
