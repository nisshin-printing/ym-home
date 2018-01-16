<?php
function cta($text) {
	echo '<div class="bg-kabarai cta-lp">',
	'<p>'.$text.'</p>',
	'<ul>',
	'<li class="bg-white"><a class="waves-effect" href="tel:0120783409"><img src="', get_template_directory_uri(), '/header-tel.jpg" alt="受付時間　平日9時～19時　土曜日10時～17時"></a></li>',
	'<li><a class="waves-effect button" href="#contact" title="お問い合わせフォームから">お問い合わせフォーム</a></li>',
	'</ul></div>';
}
function Q_and_A() {
	$qa_array = array(
		array(
			'question' => '過払い金返還請求ができなくなる？',
			'answer' => 'はい、消滅時効により<strong class="underline">最後の取引から10年</strong>で取り戻すことができなくなります。'
			),
		array(
			'question' => '去年利用したのですが、過払い金はある？',
			'answer' => '過払い金は<span class="underline">2010年以前</span>に利用したことのある人が対象です。'
			),
		array(
			'question' => '完済後、再度借入れた場合、最初の借入れは時効になる？',
			'answer' => '<span class="underline">1つの基本契約で、複数回に渡り借入と返済を繰り返したと判断</span>され、返還請求できる可能性があります'
			),
		array(
			'question' => '時効まで時間がない！',
			'answer' => '弁護士がすぐに<span class="underline">時効の進行を止めます！</span>'
			),
		array(
			'question' => '弁護士と司法書士はどっちがよい？',
			'answer' => '<span class="underline">借金の総額が140万以上</span>の場合や和解が困難な場合は弁護士でなければならなくなります。<span class="underline">最初から弁護士に相談されるのが無難だと思います。</span>'
			)
		);
	foreach ( $qa_array as $array ) {
		echo '<li class="column small-12 large-6">',
				'<span class="bg--circle --question">Q</span>',
				'<p>', $array['question'], '</p>',
				'</li>',
				'<li class="column small-12 large-6">',
				'<span class="bg--circle --answer">A</span>',
				'<p>', $array['answer'], '</p>',
				'</li>';

	}
}
?>
<header class="header--lp header--lp__kabarai">
	<div class="row">
		<div class="column">
			<h1 class="header--title__lp"><img src="<?php echo get_template_directory_uri(), '/assets/img/lp/kabarai/header.png'; ?>" alt=""></h1>
		</div>
	</div>

	<div class="cta--lp --jiko">
		<div class="row align-middle">
			<div class="column small-12 medium-3 large-3 thumb--members"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/kabarai-yamashita.png" alt="所長弁護士の山下江先生" class="thumbnail"></div>
			<div class="column small-12 medium-9 large-6">
				<p class="cta--lp__desc">過払い金返還請求の時効は、<span class="underline">最後の取引から10年</span>です。<br>
				一度でも消費者金融取引の経験がある人は、今すぐお電話を！</p>
			</div>
			<div class="column small-12 large-3 text-center"><a href="#contact" class="button large waves-effect">相談してみる</a></div>
		</div>
	</div>

	<div data-sticky-container>
		<nav class="nav--lp nav--lp__jiko sticky" data-sticky>
			<ul class="menu align-center">
				<li><a href="#section-1" title="過払い金について">過払い金について</a></li>
				<li><a href="#section-2" title="選ばれる理由">選ばれる理由</a></li>
				<li><a href="#section-3" title="解決事例">解決事例</a></li>
				<li><a href="#section-4" title="お客様の声">お客様の声</a></li>
				<li><a href="#contact" title="無料相談予約">無料相談予約</a></li>
			</ul>
		</nav>
	</div>

</header>


<section id="section-1" class="section--lp" data-magellan-target="section-1">
	<div class="row">
		<h2 class="title--section__lp title--border-bottom -center column small-12">まず、過払い金について</h2>
		<ul class="row q-a-a__wrap"><?php Q_and_A(); ?></ul>
	</div>

	<div class="cta--lp --jiko">
		<div class="row align-middle">
			<div class="column small-12 medium-3 large-3 thumb--members"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/kabarai-yamashita.png" alt="所長弁護士の山下江先生" class="thumbnail"></div>
			<div class="column small-12 medium-9 large-6">
				<p class="cta--lp__desc">過払い金返還請求の時効は、<span class="underline">最後の取引から10年</span>です。<br>
				一度でも消費者金融取引の経験がある人は、今すぐお電話を！</p>
			</div>
			<div class="column small-12 large-3 text-center"><a href="#contact" class="button large waves-effect">相談してみる</a></div>
		</div>
	</div>

</section>


<section id="section-2" class="section--lp" data-magellan-target="section-2">
	<div class="row">

		<h2 class="title--section__lp column small-12">山下江法律事務所が選ばれる理由</h2>
		<p class="title--section__sub title--border-bottom -center column small-12">2014年度　過払金・自己破産・任意整理など借金についての相談実績<strong class="--big">191</strong>件</p>

		<ul class="no-bullet row">
			<li class="column small-12">
				<h3>1.</h3>
				<p class="text-left">
					<strong class="underline">まだ過払い金返還請求していない人</strong>のために無料で相談いただけます。<br>
					一度でも<span class="underline">消費者金融</span>や<span class="underline">キャッシングカード</span>を利用した方は、過払い金があるか調査しましょう！
				</p>
			</li>
			<li class="column small-12">
				<h3>2.</h3>
				<p class="text-left">
					<span class="underline">月曜夜間・土曜日の相談</span>もやっています！
					お仕事などで日中に時間が取れない方も<span class="underline">無料</span>でご相談いただけます！<br>
					※他の曜日の夜間や日曜日も可能な場合もありますのでお問い合わせください。
				</p>
			</li>
			<li class="column small-12">
				<h3>3.</h3>
				<p class="text-left">
					過払い金がなくても、借金の減額などの任意整理や個人再生・取り立てを止めさせたり、<strong class="underline">住宅を手放さずに借金の整理</strong>をしたりなど最後までサポートいたします！
				</p>
			</li>
			<li class="column small-12">
				<h3>4.</h3>
				<p class="text-left">
					司法書士も総額140万円以内であれば、任意整理・過払い金返還請求の依頼を受けることができますが、任意での和解が難しい場合や、そもそも総額は140万円を超える場合、弁護士に依頼することになります。<br>
					まだ、<span class="underline">過払い金の金額がわからない</span>ときは、まず弁護士に相談したほうが無難です！
				</p>
			</li>
			<li class="column small-12">
				<h3>5.</h3>
				<p class="text-left">
					弁護士なら借金の総額が140万円を超えていも、交渉権が認められています。<br>
					また、地方裁判所に訴訟を提起することで、貸金業者も弁護士に依頼せざるを得ず、弁護士費用を抑えるために<strong class="underline">早期の和解</strong>に応じることが多くあります！
					<br>こういう実務テクニックを使い、早期解決を狙えるのも弁護士のメリットです！
				</p>
			</li>
			<li class="column small-12">
				<h3>6.</h3>
				<p class="text-left">
					広島最大級の山下江法律事務所では、これまでに約<span class="underline">7,000</span>名以上の借金問題を解決してきました！<br>
					事務所の方針である「親切な相談」「適切な解決」と適切な対応をすれば、早期に解決できる場合もあります。<br>
					安心と経験を兼ね備えた当事務所をお選びください！
				</p>
			</li>
		</ul>
	</div>
	
	<div class="cta--lp --jiko">
		<div class="row align-middle">
			<div class="column small-12 medium-3 large-3 thumb--members"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/kabarai-yamashita.png" alt="所長弁護士の山下江先生" class="thumbnail"></div>
			<div class="column small-12 medium-9 large-6">
				<p class="cta--lp__desc">過払い金返還請求の時効は、<span class="underline">最後の取引から10年</span>です。<br>
				一度でも消費者金融取引の経験がある人は、今すぐお電話を！</p>
			</div>
			<div class="column small-12 large-3 text-center"><a href="#contact" class="button large waves-effect">相談してみる</a></div>
		</div>
	</div>

</section>


<section id="section-3" class="section--lp" data-magellan-target="section-3">
	<div class="row">
		<h2 class="title--section__lp title--border-bottom -center column small-12">過払い金を獲得した事例</h2>

		<div class="accordion" data-accordion>
			<?php
			$args = array(
				'post_type' => 'cases',
				'posts_per_page' => 7,
				'cases-cat' => 'debts',
				'order' => 'DESC',
				'orderby' => 'modified'
				);
			$loop = new WP_Query($args);
			if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();
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
	</div>

</section>

<section id="section-4" class="section--lp" data-magellan-target="section-3">
	<div class="row">
		<h2 class="title--section__lp column small-12">過払い金を獲得した依頼者の声</h2>
		<p class="title--section__sub column small-12">山下江法律事務所なら良き相談相手となれます！</p>
		<p class="title--section__sub title--border-bottom -center column small-12">相談料が<span class="underline">無料</span>。しかも全力で対応！だから多くの方々に<span class="underline">ご満足</span>いただいております。</p>

		<div class="accordion" data-accordion>
			<?php
			$args = array(
				'post_type' => 'voice',
				'posts_per_page' => 7,
				'voice-cat' => 'debts',
				'order' => 'DESC',
				'orderby' => 'modified'
				);
			$loop = new WP_Query($args);
			if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();
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
	</div>

	<div class="cta--lp --jiko">
		<div class="row align-middle">
			<div class="column small-12 medium-3 large-3 thumb--members"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/kabarai-yamashita.png" alt="所長弁護士の山下江先生" class="thumbnail"></div>
			<div class="column small-12 medium-9 large-6">
				<p class="cta--lp__desc">過払い金返還請求の時効は、<span class="underline">最後の取引から10年</span>です。<br>
				一度でも消費者金融取引の経験がある人は、今すぐお電話を！</p>
			</div>
			<div class="column small-12 large-3 text-center"><a href="#contact" class="button large waves-effect">相談してみる</a></div>
		</div>
	</div>

</section>


<section id="contact" class="section--lp" data-magellan-target="contact">
	<div class="row contents">
		<div class="column small-12">
			<h2 class="title--section__lp column small-12">過払い金返還請求の無料相談</h2>
			<div class="article-body">
				<p>法律相談は、ご予約の上、当事務所までお越しいただくことになります。<br />
 <strong><span style="color: #ff0000;">メールでのご回答はいたしかねますので、あらかじめご了承ください。</span></strong></p>
<p><a id="a-tel-contact" class="button" href="https://www.law-yamashita.com/consultation-flow#sec-3" target="_blank" rel="noopener">電話での相談をご希望の方</a></p>
<p>なお、お問い合わせ内容により、回答にお時間がかかる場合がございます。</p>
<p><a class="button secondary" href="https://www.law-yamashita.com/rates#sec-12" target="_blank" rel="noopener">他事務所からの弁護士交替のご依頼などについて</a></p>
<h2>当日や翌営業日ご希望の方、お急ぎの方へ</h2>
				<h3>当日や翌営業日ご希望の方、お急ぎの方へ</h3>
				<table>
					<thead>
						<tr>
							<th>お問い合わせ先</th>
							<th>電話番号</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>法律相談のご予約専用ダイヤル</td>
							<td><a title="ご予約専用ダイヤル" href="tel:0120783409"><img class="alignnone size-full wp-image-1131" src="//www.law-yamashita.com/wp-content/uploads/2015/07/header-tel.jpg" alt="法律相談ご予約専用ダイヤル" width="344" height="44" /></a></td>
						</tr>
					</tbody>
				</table>
				<h3>メールでのご相談予約</h3>
				<?php echo do_shortcode( '[contact-form-7 id="1152" title="法律相談のご予約"]' ); ?>
			</div>
		</div>
	</div>
</section>


<ul class="no-bullet m0 link-external-block text-center">
	<li>山下江法律事務所の自己破産・任意整理などの借金専門サイトもごらんください！</li>
	<li><a class="link-external img waves-effect" href="http://www.hiroshima-saimu.com/" target="_blank" title="山下江法律事務所の自己破産・任意整理などの借金専門サイト"><img src="<?php echo home_url(); ?>/wp-content/uploads/2015/05/external-links-4.png" alt="過払い金・任意整理などの借金専門サイト"></a></li>
</ul>
