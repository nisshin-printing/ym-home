<?php
$args = array(
	'post_type'      => 'post',
	'posts_per_page' => 4,
	'post_status'    => 'publish'
);
$news = new WP_Query( $args );
if ( $news->have_posts() ) :
?>
<section class="fp--news">
	<div class="row align-middle">
		<div class="column small-12 large-4">
			<h2 class="news--block-title">最新情報<span>NEWS</span></h2>
			<a href="<?php echo home_url( '/' ),'topics' ?>" class="button expanded hollow news--link" title="一覧を見る">一覧を見る</a>
		</div>
		<ul class="column small-12 large-8 news--list no-bullet">
			<?php
				while ( $news->have_posts() ) : $news->the_post();
			?>
			<li itemscope itemtype="http://schema.org/Article" itemref="author-prof">
				<meta itemprop="description" content="<?php the_excerpt(); ?>">
				<time class="news--date published" itemprop="datePublished dateCreated" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>
				<time class="news--date updated hide" itemprop="dateModified" datetime="<?php echo get_the_modified_time('Y-m-d'); ?>"><?php echo get_the_modified_time('Y-m-d'); ?></time>
				<p class="news--author author hide" itemprop="author copyrightHolder editor" itemscope="" itemtype="http://schema.org/Person"><span class="news--author" itemprop="name">山下江法律事務所</span></p>
				<?php
					$cat = get_the_category();
					$cat = $cat[0];
				?>
				<a class="label news--category <?php echo '-', $cat->category_nicename; ?>" href="<?php echo get_category_link( $cat->term_id ); ?>" title="<?php echo $cat->nat_name; ?>の一覧を見る"><?php echo $cat->cat_name; ?></a>
				<p class="news--title entry-title" itemprop="about headline"><a class="news--title-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>を見る"><?php the_title(); ?></a>
			</li>
			<?php
				endwhile;
			?>
		</ul>
	</div>
</section>
<?php
endif;

