<?php
	// Front Page Slider
	$slides_args = array(
		'post_type' => 'dtdsh-slides',
		'posts_per_page' => -1,
		'post_status' => 'publish'
	);
	$slider = new WP_Query( $slides_args );
?>
	<section class="fp--topheader">
		<div class="row align-middle">
			<div class="column small-12 medium-6 slider--wrapper">
				<div id="js--top-slider" class="slick-slider">
					<?php
				if ( $slider->have_posts() ) :
					while ( $slider->have_posts() ) :
						$slider->the_post();
							$img_id = get_post_thumbnail_id();
							$thumb = wp_get_attachment_image_src( $img_id, 'full' );
							$img = $thumb[0];
							$width = $thumb[1];
							$height = $thumb[2];
							$link_src = get_post_meta( $id, 'slider_link', true );
							$link_title = ( get_post_meta( $id, 'slider_link_title', true ) ) ? get_post_meta( $id, 'slider_link_title', true ) : get_the_title();
				?>
						<article class="slick-slide slide--item card">
							<div class="card--img">
								<img data-lazy="<?php echo $img; ?>" alt="<?php the_title(); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>">
							</div>
							<div class="card--content">
								<p class="card--title">
									<?php the_title(); ?>
								</p>
								<p>
									<?php
							if ( '' !== $post->post_content ) {
								the_content();
							} else {
								echo "<a href=\"$link_src\" title=\"$link_title\" class=\"button\">$link_title</a>";
							}
						?>
								</p>
							</div>
						</article>
						<?php
						endwhile;
					endif;
				?>
						<div id="slide--button"></div>
				</div>
			</div>
			<div class="column small-12 medium-6 copy--top">
				<h1 class="copy--title">法律問題に直面して、
					<br>探しているのは頼れる
					<ruby>
						<rb>弁護士</rb>
						<rp>
							<rt>みかた</rt>
						</rp>
					</ruby>。</h1>
				<div class="copy--desc">
					<p>相談件数20,000件以上。
						<small>※</small>
						<br>選ぶなら広島最大級。
						<br>個人のお客様なら
						<strong style="background:yellow;color:red">初回相談無料</strong>
					</p>
					<small>※　2018年12月末時点（事務所総数）</small>
				</div>
				<p class="topheader--button">
					<a href="tel:0120783409" title="電話する" class="button hollow expanded">
						<img src="<?php echo get_template_directory_uri(), '/assets/img/header-tel.jpg'; ?>" alt="">
					</a>
				</p>
				<p class="topheader--button">
					<a href="<?php echo home_url( '/' ), 'reserve'; ?>" class="button hollow expanded" title="Web予約フォーム">
						<?php NID_SVG::icon( 'mail', array( 'class' => 'button--icon' ), 'メール' ); ?>Web予約フォーム</a>
				</p>
				<p class="topheader--button">
					<a href="https://tokyo.law-yamashita.com/" class="button hollow expanded" title="東京虎ノ門オフィス開設">東京虎ノ門オフィス開設</a>
				</p>
				<p class="topheader--button">
					<a href="<?php echo home_url( '/' ), 'seminar'; ?>" class="button hollow expanded" title="セミナーのご案内">
						<?php NID_SVG::icon( 'megaphone', array( 'class' => 'button--icon' ), 'セミナー案内' ); ?>セミナーのご案内</a>
				</p>
			</div>
		</div>
	</section>
