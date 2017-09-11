<?php
// CTA
function cta($text) {
	echo '<div class="bg-rikon cta-lp">';
	echo '<p>'.$text.'</p>';
	echo '<ul>';
	echo '<li class="bg-white"><a class="waves-effect" href="tel:0120783409"><img src="' . TIMG . 'header-tel.jpg" alt="受付時間　平日9時～19時　土曜日10時～17時"></a></li>',
	'<li><a class="waves-effect button" href="#contact" title="お問い合わせフォームから">お問い合わせフォーム</a></li>',
	'</ul></div>';
}
?>
<header class="header-lp text-center">
	<div class="row">
		<h1 class="column large-6"><img src="<?php echo TIMG, 'rikon_05_03.png'; ?>" alt="<?php the_title(); ?>"></h1>
		<div class="column large-6"><img src="<?php echo TIMG, 'rikon_02.png'; ?>" alt="<?php the_title(); ?>"></div>
		<div class="lp-header-nav large-6 medium-12 column">
			<a class="btn-men button expanded" href="#section-1" title="男性のための離婚相談">男性のための離婚相談<i class="fa fa-caret-down float-right"></i></a>
			<a class="btn-women button expanded" href="#section-2" title="女性のための離婚相談">女性のための離婚相談<i class="fa fa-caret-down float-right"></i></a>
		</div>
	</div>
	<nav id="sticky-topbar" class="bg-rikon color-white magellan" data-magellan>
		<dl class="sub-nav">
			<dt class="show-for-medium"><i class="fa fa-bars mr1"></i>目次 :</dt>
			<dd><a href="#section-1" title="男女別の悩み">男女別の悩み</a></dd>
			<dd><a href="#section-3" title="選ばれる理由">選ばれる理由</a></dd>
			<dd><a href="#section-4" title="お客様の声">お客様の声</a></dd>
			<dd><a href="#section-5" title="事務所案内">事務所案内</a></dd>
			<dd><a href="#contact" title="無料相談予約">無料相談予約</a></dd>
		</dl>
	</nav>
</header>
<section class="content-header">
	<div class="row">
		<div id="section-1" class="medium-6 column" data-magellan-target="section-1">
			<p class="btn-men button no-btn expanded">MEN</p>
			<ul class="no-bullet">
				<li>
					<span class="fa-stack fa-lg color-blue">
						<i class="fa fa-circle fa-stack-2x"></i>
						<span class="fa-stack-1x color-white">1</span>
					</span>
					<p>男性向け・男性視点での話題・情報が少ない</p>
				</li>
				<li>
					<span class="fa-stack fa-lg color-blue">
						<i class="fa fa-circle fa-stack-2x"></i>
						<span class="fa-stack-1x color-white">2</span>
					</span>
					<p>近所や家族、職場にも秘密にしたい</p>
				</li>
				<li>
					<span class="fa-stack fa-lg color-blue">
						<i class="fa fa-circle fa-stack-2x"></i>
						<span class="fa-stack-1x color-white">3</span>
					</span>
					<p>仕事があるので、日中に時間がとれない</p>
				</li>
				<li>
					<span class="fa-stack fa-lg color-blue">
						<i class="fa fa-circle fa-stack-2x"></i>
						<span class="fa-stack-1x color-white">4</span>
					</span>
					<p>仕組みや手続きなどしっかり理解できるまで説明してほしい</p>
				</li>
			</ol>
		</div>
		<div id="section-2" class="medium-6 column">
			<p class="btn-women button no-btn expanded">WOMEN</p>
			<ul class="no-bullet">
				<li>
					<span class="fa-stack fa-lg color-pink">
						<i class="fa fa-circle fa-stack-2x"></i>
						<span class="fa-stack-1x color-white">1</span>
					</span>
					<p>男性弁護士に離婚の相談をしたくない</p>
				</li>
				<li>
					<span class="fa-stack fa-lg color-pink">
						<i class="fa fa-circle fa-stack-2x"></i>
						<span class="fa-stack-1x color-white">2</span>
					</span>
					<p>男性は信用出来ない・嫌悪感がある</p>
				</li>
				<li>
					<span class="fa-stack fa-lg color-pink">
						<i class="fa fa-circle fa-stack-2x"></i>
						<span class="fa-stack-1x color-white">3</span>
					</span>
					<p>女性の価値観で話をしたい・共感してほしい</p>
				</li>
				<li>
					<span class="fa-stack fa-lg color-pink">
						<i class="fa fa-circle fa-stack-2x"></i>
						<span class="fa-stack-1x color-white">4</span>
					</span>
					<p>最初から弁護士に相談したい</p>
				</li>
			</ol>
		</div>
	</div>
	<h2 class="text-center mt4">山下江法律事務所なら<br>すべて解決できます！</h2>
	<p class="text-center"><a href="#section-3"><i class="fa fa-caret-down fa-5x"></i></a></p>
</section>
<section id="section-3" data-magellan-target="section-3">
	<div class="row">
		<div class="title-block large-12">
			<h2>山下江法律事務所が選ばれる理由</h2>
			<p>2014年度　離婚相談実績<span class="js-countup color-rikon" data-countup-start="0" data-countup-end="476">0</span>件</p>
		</div>
		<ul class="small-up-1 medium-up-2 medium-up-3 no-bullet">
			<li class="column text-center">
				<span class="fa-stack fa-5x">
					<i class="fa fa-circle fa-stack-2x color-rikon"></i>
					<i class="fa fa-jpy fa-stack-1x color-white"></i>
				</span>
				<p class="text-left">
					弁護士による相談が<span class="bg-line">無料</span>！<br>
					最初から<span class="bg-line">弁護士に無料で相談</span>できるから<br>
					早期解決が見込めます！
				</p>
			</li>
			<li class="column text-center">
				<span class="fa-stack fa-5x">
					<i class="fa fa-circle fa-stack-2x color-rikon"></i>
					<i class="fa fa-calendar-check-o fa-stack-1x color-white"></i>
				</span>
				<p class="text-left">
					<span class="bg-line">月曜夜間・土曜日の相談</span>もやっています！<br>
					お仕事などで日中に時間が取れない方も<br>
					<span class="bg-line">無料</span>でご相談いただけます！<br>
					※他の曜日の夜間や日曜日も可能な場合もありますのでお問い合わせください。
				</p>
			</li>
			<li class="column text-center">
				<span class="fa-stack fa-5x">
					<i class="fa fa-circle fa-stack-2x color-rikon"></i>
					<i class="fa fa-shield fa-stack-1x color-white"></i>
				</span>
				<p class="text-left">
					無料の相談とはいえ、プライバシーを厳守します！<br>
					ご近所の方、ご家族、職場の方々へ<br>
					<span class="bg-line">秘密にお手続きをするためのノウハウ</span>があります。<br>
					お客様の社会的な信用に不用意な傷がつかないよう<br>
					サポートさせていただきます！
				</p>
			</li>
			<li class="column text-center">
				<span class="fa-stack fa-5x">
					<i class="fa fa-circle fa-stack-2x color-rikon"></i>
					<i class="fa fa-venus fa-stack-1x color-white"></i>
				</span>
				<p class="text-left">
					女性の気持ち・悩みを解決するには<br>
					女性弁護士に相談しましょう！<br>
					<span class="bg-line">女性弁護士による女性のための<br>
					離婚相談</span>を設けております。
				</p>
			</li>
			<li class="column text-center">
				<span class="fa-stack fa-5x">
					<i class="fa fa-circle fa-stack-2x color-rikon"></i>
					<i class="fa fa-mars fa-stack-1x color-white"></i>
				</span>
				<p class="text-left">
					男性向け・男性視点での情報が少ないから<br>
					<span class="bg-line">経験豊富な弁護士・スタッフと<br>
					多数の事例を蓄積している山下江法律事務所</span>が選ばれる！
				</p>
			</li>
			<li class="column text-center">
				<span class="fa-stack fa-5x">
					<i class="fa fa-circle fa-stack-2x color-rikon"></i>
					<i class="fa fa-heart fa-stack-1x color-white"></i>
				</span>
				<p class="text-left">
					法的な解決だけじゃない！<br>
					<span class="bg-line">精神的な問題・離婚後の生活に関する問題</span>まで<br>
					解決策を全力で考える弁護士にご相談ください！
				</p>
			</li>
		</ul>
	</div>
	<?php cta('まずは弁護士に相談して、無料で解決策をおしえてもらおう！'); ?>
</section>
<section id="section-4" data-magellan-target="section-4">
	<div class="row">
		<div class="title-block">
			<h2>お客様の声</h2>
			<p>相談料が<span class="bg-line">無料</span>で、精神的な問題・離婚後の生活に関する問題までサポート！<br>だから多くの方々にご満足いただいております。</p>
		</div>
		<div class="voices accordion" data-accordion>
<?php
	$args = array(
		'post_type' => 'voice',
		'posts_per_page' => 7,
		'voice-cat' => 'divorce',
		'order' => 'DESC',
		'orderby' => 'modified'
	);
	$loop = new WP_Query($args);
	if ( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post();
?>
			<article class="accordion-item" data-accordion-item>
				<a class="accordion-title"><?php the_title(); ?></a>
				<div class="accordion-content" data-tab-content>
					<div class="img-wrapper"><?php the_post_thumbnail(); ?></div>
					<p><?php the_content(); ?></p>
				</div>
			</article>
<?php
	endwhile;
	wp_reset_postdata();
	endif;
?>
		</div>
		<p class="text-center">離婚などの男女トラブルで<span class="bg-line">ご依頼</span>いただいたお客様の声は<a href="<?php echo get_term_link('divorce', 'voice-cat'); ?>" target="_blank" title="離婚相談 | 依頼者カテゴリ" class="link-external">離婚相談 | 依頼者カテゴリ</a>に多数掲載しております。</p>
	</div>
</section>
<?php cta('山下江法律事務所なら相談料無料！<br>離婚を経て、幸せな人生をおくるためにご相談ください。'); ?>
<section id="section-5" data-magellan-target="section-5">
	<div class="title-block row">
		<h2>事務所案内</h2>
		<h3>もっと身近な相談者に弁護士を。その一心から相談料無料！</h3>
		<p>大規模事務所の利点を生かし、男女トラブル解決チームがあなたの人生を応援します。</p>
	</div>
	<div class="row bg-snow p2">
		<p class="text-center">山下江法律事務所では、広島最大級の利点を最大限に生かし、どのようなご相談にも対応いたします。<br>どこに相談してよいのかわからないときでも、ぜひご相談ください。</p>
		<dl class="dt-info">
			<dt>営業時間</dt>
			<dd>平日　9：00 ～ 18：00</dd>
			<dt class="inner-float">相談受付時間</dt>
			<dl class="inner">
				<dt>電話受付</dt>
				<dd>平日　9：00 ～ 19：00<span>土曜　10：00 ～ 17：00</span></dd>
				<dt>メール受付</dt>
				<dd>24時間対応</dd>
			</dl>
			<dt>相談時間</dt>
			<dd>
				月曜　　　　9：00 ～ 21：00（夜間相談あり）<br>
				火曜～金曜　9：00 ～ 18：00<br>
				土曜　　　　10：00 ～ 17：00<br>
			</dd>
			<p>
				※日曜日や上記以外の時間帯でも対応可能な弁護士がいれば、相談時間を設けることが可能です。
				<br>
				　ご希望の方はお問い合わせください。
			</p>
			<p>※ご相談には、原則面談が必要です。</p>
		</dl>
	</div>
</section>
<section id="contact" data-magellan-target="contact">
	<div class="title-block row">
		<h2>お問い合わせ</h2>
		<p>
			法律相談の場合には、ご予約の上、ご来所いただくことになります。<br>
			当日、翌営業日の相談をご希望の場合は、お電話にてご連絡下さい。<br>
			お問い合わせの内容が、<span class="bg-line">法律相談の場合には、メール、電話でのご回答はいたしかねます。</span>あらかじめご了承ください。<br>
			お電話受付は、平日９時～１９時、土曜日１０時～１７時で対応しております。
			是非お電話もご利用ください。
		</p>
		<p><a href="tel:0120783409"><img src="<?php echo TIMG, 'header-tel.jpg'; ?>" alt="受付時間　平日9時～19時　土曜日10時～17時"></a></p>
	</div>
<?php
		$get_form = get_post_meta( $post->ID, 'lp_form', true );
		$get_form_title = get_the_title( $get_form );
		echo do_shortcode('[contact-form-7 id="' . esc_attr( $get_form ) . '" title="' . $get_form_title . '"]');
	?>
</section>
<ul class="no-bullet m0 link-external-block text-center">
	<li>山下江法律事務所の離婚・男女トラブル専門サイトもごらんください！</li>
	<li><a class="link-external img" href="http://www.hiroshima-rikon.com/" target="_blank" title="山下江法律事務所の離婚・男女トラブルサイト"><img src="<?php echo TIMG, 'external-links-2.png'; ?>" alt="離婚・男女トラブルの専門サイト"></a></li>
</ul>