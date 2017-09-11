<?php
// CTA
function cta($text) {
	echo '<div class="bg-kabarai cta-lp">',
	'<p>'.$text.'</p>',
	'<ul>',
	'<li class="bg-white"><a class="waves-effect" href="tel:0120783409"><img src="' . TIMG . 'header-tel.jpg" alt="受付時間　平日9時～19時　土曜日10時～17時"></a></li>',
	'<li><a class="waves-effect button" href="#contact" title="お問い合わせフォームから">お問い合わせフォーム</a></li>',
	'</ul></div>';
}
function Q_and_A() {
	$qa_array = array(
		array(
			'question' => '過払い金返還請求ができなくなる？',
			'answer' => 'はい、消滅時効により<strong class="bg-line">最後の取引から10年</strong>で取り戻すことができなくなります。'
			),
		array(
			'question' => '去年利用したのですが、過払い金はある？',
			'answer' => '過払い金は<span class="bg-line">2010年以前</span>に利用したことのある人が対象です。'
			),
		array(
			'question' => '完済後、再度借入れた場合、最初の借入れは時効になる？',
			'answer' => '<span class="bg-line">1つの基本契約で、複数回に渡り借入と返済を繰り返したと判断</span>され、返還請求できる可能性があります'
			),
		array(
			'question' => '時効まで時間がない！',
			'answer' => '弁護士がすぐに<span class="bg-line">時効の進行を止めます！</span>'
			),
		array(
			'question' => '弁護士と司法書士はどっちがよい？',
			'answer' => '<span class="bg-line">借金の総額が140万以上</span>の場合や和解が困難な場合は弁護士でなければならなくなります。<span class="bg-line">最初から弁護士に相談されるのが無難だと思います。</span>'
			)
		);
	foreach ( $qa_array as $array ) {
		echo '<li class="column">';
		echo '<span class="fa-stack fa-lg color-blue"><i class="fa fa-circle fa-stack-2x"></i><span class="fa-stack-1x color-white">Q</span></span>';
		echo '<p>' . $array['question'] . '</p>';
		echo '</li>';
		echo '<li class="column">';
		echo '<span class="fa-stack fa-lg color-red"><i class="fa fa-circle fa-stack-2x"></i><span class="fa-stack-1x color-white">A</span></span>';
		echo '<p>' . $array['answer'] . '</p>';
		echo '</li>';

	}
}
?>
<header class="header-lp bg-kabarai text-center">
	<div class="row column-3">
		<div class="column-2-3 p1 valign-wrapper">
			<h1 class="valign color-white">
				時効は10年
				<br>
				まだ過払い金返還請求していない人のために
				<br>
				相談料無料
			</h1>
		</div>
		<div class="column-1-3 valign-wrapper">
			<div id="js-clock">
				<div class="minute-hand"></div>
				<div class="hour-hand"></div>
			<?php
				for ( $i = 0; $i < 3; $i++ ) {
			?>
				<div class="slide-item">
					<img data-lazy="<?php echo TIMG, 'lp-kabarai-00', $i + 1, '.png'; ?>" alt="過払い金返還請求には期限があります！">
				</div>
			<?php
				}
			?>
			</div>
		</div>
	</div>
	<div class="bg-white">
		<div class="row medium-valign-wrapper">
			<div class="img-wrapper column medium-4 valign">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/kabarai-yamashita.png" alt="所長弁護士の山下江先生">
			</div>
			<div class="column medium-8 valign text-left">
				<p>過払い金返還請求の時効は、<span class="bg-line">最後の取引から10年</span>です</p>
				<p>一度でも消費者金融取引の経験がある人は、今すぐお電話を！</p>
			</div>
		</div>
	</div>
	<?php cta('まずは相談して、過払い金があるのか調べてもらおう！'); ?>
	<nav id="sticky-topbar" class="bg-kabarai color-white magellan" data-magellan>
		<dl class="sub-nav">
			<dt class="show-for-medium"><i class="fa fa-bars mr1"></i>目次 :</dt>
			<dd><a href="#section-1" title="過払い金について">過払い金について</a></dd>
			<dd><a href="#section-2" title="選ばれる理由">選ばれる理由</a></dd>
			<dd><a href="#section-3" title="お客様の声">お客様の声</a></dd>
			<dd><a href="#section-4" title="事務所案内">事務所案内</a></dd>
			<dd><a href="#contact" title="無料相談予約">無料相談予約</a></dd>
		</dl>
	</nav>
</header>
<section id="section-1" data-magellan-target="section-1">
	<div class="row">
		<h3 class="bg-kabarai color-white button no-btn expanded">まず、過払い金について</h3>
		<ul class="small-up-1 large-up-2 no-bullet p1"><?php Q_and_A(); ?></ul>
	</div>
	<?php cta('まだ過払い金返還請求していない人のために無料で相談いただけます！'); ?>
</section>
<section id="section-2" data-magellan-target="section-2">
	<div class="row">
		<div class="title-block large-12">
			<h2>山下江法律事務所が選ばれる理由</h2>
			<p>2014年度　過払金・自己破産・任意整理など借金についての相談実績<span class="js-countup color-kabarai" data-countup-start="0" data-countup-end="191">191</span>件</p>
		</div>
		<ul class="no-bullet small-up-1 medium-up-2 large-up-3">
			<li class="column text-center">
				<span class="fa-stack fa-5x">
					<i class="fa fa-circle fa-stack-2x color-kabarai"></i>
					<i class="fa fa-jpy fa-stack-1x color-white"></i>
				</span>
				<p class="text-left">
					<strong class="bg-line">まだ過払い金返還請求していない人</strong>のために無料で相談いただけます。<br>
					一度でも<span class="bg-line">消費者金融</span>や<span class="bg-line">キャッシングカード</span>を利用した方は、過払い金があるか調査しましょう！
				</p>
			</li>
			<li class="column text-center">
				<span class="fa-stack fa-5x">
					<i class="fa fa-circle fa-stack-2x color-kabarai"></i>
					<i class="fa fa-calendar-check-o fa-stack-1x color-white"></i>
				</span>
				<p class="text-left">
					<span class="bg-line">月曜夜間・土曜日の相談</span>もやっています！
					お仕事などで日中に時間が取れない方も<span class="bg-line">無料</span>でご相談いただけます！<br>
					※他の曜日の夜間や日曜日も可能な場合もありますのでお問い合わせください。
				</p>
			</li>
			<li class="column text-center">
				<span class="fa-stack fa-5x">
					<i class="fa fa-circle fa-stack-2x color-kabarai"></i>
					<i class="fa fa-heart fa-stack-1x color-white"></i>
				</span>
				<p class="text-left">
					過払い金がなくても、借金の減額などの任意整理や個人再生・取り立てを止めさせたり、<strong class="bg-line">住宅を手放さずに借金の整理</strong>をしたりなど最後までサポートいたします！
				</p>
			</li>
			<li class="column text-center">
				<span class="fa-stack fa-5x">
					<i class="fa fa-circle fa-stack-2x color-kabarai"></i>
					<i class="fa fa-balance-scale fa-stack-1x color-white"></i>
				</span>
				<p class="text-left">
					司法書士も総額140万円以内であれば、任意整理・過払い金返還請求の依頼を受けることができますが、任意での和解が難しい場合や、そもそも総額は140万円を超える場合、弁護士に依頼することになります。<br>
					まだ、<span class="bg-line">過払い金の金額がわからない</span>ときは、まず弁護士に相談したほうが無難です！
				</p>
			</li>
			<li class="column text-center">
				<span class="fa-stack fa-5x">
					<i class="fa fa-circle fa-stack-2x color-kabarai"></i>
					<i class="fa fa-fast-forward fa-stack-1x color-white"></i>
				</span>
				<p class="text-left">
					弁護士なら借金の総額が140万円を超えていも、交渉権が認められています。<br>
					また、地方裁判所に訴訟を提起することで、貸金業者も弁護士に依頼せざるを得ず、弁護士費用を抑えるために<strong class="bg-line">早期の和解</strong>に応じることが多くあります！
					<br>こういう実務テクニックを使い、早期解決を狙えるのも弁護士のメリットです！
				</p>
			</li>
			<li class="column text-center">
				<span class="fa-stack fa-5x">
					<i class="fa fa-circle fa-stack-2x color-kabarai"></i>
					<i class="fa fa-users fa-stack-1x color-white"></i>
				</span>
				<p class="text-left">
					広島最大級の山下江法律事務所では、これまでに約<span class="bg-line">7,000</span>名以上の借金問題を解決してきました！<br>
					事務所の方針である「親切な相談」「適切な解決」と適切な対応をすれば、早期に解決できる場合もあります。<br>
					安心と経験を兼ね備えた当事務所をお選びください！
				</p>
			</li>
		</ul>
	</div>
	<?php cta('まずは相談して、無料で解決策をおしえてもらおう！'); ?>
</section>
<section id="section-3" data-magellan-target="section-3">
	<div class="row">
		<div class="title-block">
			<h2>お客様の声</h2>
			<h3>山下江法律事務所なら良き相談相手となれます！</h3>
			<p>相談料が<span class="bg-line">無料</span>。しかも全力で対応！だから多くの方々に<span class="bg-line">ご満足</span>いただいております。</p>
		</div>
		<div class="accordion voices" data-accordion>
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
</section>
<?php cta('山下江法律事務所なら相談料無料！<br>過払い金返還請求できなくなる前にご相談ください。'); ?>
<section id="section-4" data-magellan-target="section-4">
	<div class="title-block row">
		<h2>事務所案内</h2>
		<h3>もっと身近な相談者に弁護士を。その一心から相談料無料！</h3>
		<p>大規模事務所の利点を生かし、あなたの人生を応援します。</p>
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
<section id="contact" data-magellan-target="contact" class="bg-white">
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
	<li>山下江法律事務所の自己破産・任意整理などの借金専門サイトもごらんください！</li>
	<li><a class="link-external img waves-effect" href="http://www.hiroshima-saimu.com/" target="_blank" title="山下江法律事務所の自己破産・任意整理などの借金専門サイト"><img src="<?php echo DTDSH_HOME_URL; ?>/wp-content/uploads/2015/05/external-links-4.png" alt="過払い金・任意整理などの借金専門サイト"></a></li>
</ul>
<footer>