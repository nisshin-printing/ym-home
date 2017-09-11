<?php
// 交通事故CTA
function cta( $text ) {
	echo '<div class="bg-jiko cta-lp">',
	'<p>'.$text.'</p>',
	'<ul>',
	'<li class="bg-white"><a class="waves-effect" href="tel:0120783409"><img src="'. TIMG . 'header-tel.jpg" alt="受付時間　平日9時～19時　土曜日10時～17時"></a></li>',
	'<li><a class="waves-effect button" href="#contact" title="お問い合わせフォームから">お問い合わせフォーム</a></li>',
	'</ul></div>';
}
echo '<style>', file_get_contents( TCSS . 'lp-jiko.css' ), '</style>';
?>
<header class="header-lp text-center">
	<h1 class="row">
		<a href="#contact" title="無料相談の予約をする"><img src="<?php echo TIMG, 'traffic-acc-header.png'; ?>" alt="<?php the_title(); ?>"></a>
	</h1>
	<nav id="sticky-topbar" class="bg-jiko color-white menu" data-magellan>
		<dl class="sub-nav">
			<dt class="show-for-medium"><i class="fa fa-bars mr1"></i>目次 :</dt>
			<dd><a href="#section-1" title="解決事例">解決事例</a></dd>
			<dd><a href="#section-2" title="増額の理由">増額の理由</a></dd>
			<dd><a href="#section-3" title="サポート内容">サポート内容</a></dd>
			<dd><a href="#section-4" title="お客様の声">お客様の声</a></dd>
			<dd><a href="#section-5" title="事務所案内">事務所案内</a></dd>
			<dd><a href="#contact" title="無料相談予約">無料相談予約</a></dd>
		</dl>
	</nav>
</header>
<section class="content-header">
	<div class="row text-center">
		<h2>交通事故問題解決のプロが教えます！</h2>
		<div class="caution">
			<h3 class="bg-jiko color-white">ご存知ですか？</h3>
			<p class="bg-snow">死亡事故や後遺症が残る事故では<br>弁護士を入れることで、保険会社からの提示より<br>賠償金額が多くなることがほとんどです！</p>
		</div>
	</div>
	<?php cta('この事実を知らない方がまだまだ多いのです。<br>だから気軽にご相談いただくために<span>相談料無料！</span>'); ?>
</section>
<section id="section-1" data-magellan-target="section-1">
	<div class="title-block row">
		<h2>解決事例</h2>
		<h3>保険会社提示の示談金は、果たして適正な値段なのか</h3>
		<p>相談料も着手金も無料！交通事故に遭ったら損をしないために山下江法律事務所へご相談ください！</p>
	</div>
	<div class="row cases">
		<h4>後遺障害の事故</h4>
		<div class="img-wrapper"><img src="<?php echo TIMG, 'traffic-acc-cases_02.png'; ?>" alt="1010万円の増額"></div>
		<p>　依頼者は、タクシー乗車中にタクシーが交通事故に遭い、局部に神経症状を残すとして、<span class="bg-line">14級の後遺障害認定</span>を受けた。加害者の任意保険会社は、治療費等すでに約310万を支払済みであったところ、症状が固定したので、賠償金として残金200万円を支払って示談を成立させたい旨を提案してきた（<span class="bg-line">保険会社基準では損害額合計は約500万円ということ</span>）。<br>　当事務所において、<span class="bg-line">裁判基準</span>に基づいて計算し、<span class="bg-line">担当弁護士が保険会社と交渉。</span>結果、保険会社提示額の残金200万円から、<span class="bg-line">300万円</span>増額し、残金500万円で示談が成立した。</p>
	</div>
	<div class="row cases">
		<h4>後遺障害の事故</h4>
		<div class="img-wrapper"><img src="<?php echo TIMG, 'traffic-acc-cases_04.png'; ?>" alt="300万円の増額"></div>
		<p>　依頼者が自転車で横断中、トラックが側面から衝突、依頼者には<span class="bg-line">右足関節の機能障害他の後遺障害</span>が残り、<span class="bg-line">併合11級と認定</span>された。保険会社は未払分として<span class="bg-line">保険金520万円</span>を提示した。<br>　労働能力喪失率が後遺障害に伴う損害に影響を与えるので、この点につき、保険会社と粘り強く交渉し、<span class="bg-line">保険金850万円</span>の支払いを勝ち取った。</p>
	</div>
	<div class="row cases">
		<h4>死亡事故</h4>
		<div class="img-wrapper"><img src="<?php echo TIMG, 'traffic-acc-cases_01.png'; ?>" alt="330万円の増額"></div>
		<p>　被害者（80代半ば。無職）は、信号のない交差点にて横断歩道を歩行中に、左方より乗用車にはねられた。<span class="bg-line">当方過失ゼロ。</span>頭部打撲裂創、外傷性くも膜下出血。約5ヶ月入院後、死亡。<span class="bg-line">当事務所において裁判基準に基づいて計算</span>したところ、<span class="bg-line">保険会社提示額より1,000万円強の増額</span>となり、保険会社もこれを認めた。</p>
	</div>
	<div class="row cases">
		<h4>バイク対自動車</span></h4>
		<div class="img-wrapper"><img src="<?php echo TIMG, 'traffic-acc-cases_03.png'; ?>" alt="330万円の増額"></div>
		<p>　依頼者は、バイクで交差点を直進中、右折中の自動車と衝突し、<span class="bg-line">左腕神経麻痺・機能障害と右手首骨折・機能障害等の重症</span>を負った。<span class="bg-line">後遺障害等級5級</span>が認められたので、これにしたがって、当事務所で最大限の損害額を見積もり、請求した。<br>　他方、過失割合も争いになっていたが、依頼者が認めざるを得ない最小限の割合にとどめ、和解した。<span class="bg-line">最終的な和解額は、約6,400万円。</span>このうち、治療費等で既に支払われている額を差し引いて、依頼者は約4,700万円を得ることができた。（※左胸のほか、手首にも後遺障害あり）</p>
	</div>
	<p class="text-center">その他、交通事故関係の解決事例は<a href="<?php echo DTDSH_HOME_URL; ?>cases-category/traffic-acc" target="_blank" title="解決事例　カテゴリー：交通事故" class="link-external">解決事例　カテゴリー：交通事故</a>に多数掲載しております。</p>
	<?php cta('きちんとした補償を受けるためには、適切な対応が不可欠！<br><span>相談料無料</span>だから交渉の余地があるかどうかの確認だけでも無料でサポート！'); ?>
</section>
<section id="section-2" data-magellan-target="section-2">
	<div class="title-block row">
		<h2>なぜ弁護士が入ると賠償金が多くなるのか</h2>
		<h3>交通事故の賠償金は、弁護士が代理交渉するによって<br>多くのご相談ケースで増額します！</h3>
	</div>
	<div class="row">
		<h4>賠償金額の基準がミソ</h4>
		<ul class="no-bullet bg-grafpaper">
			<li>
				<p>基準点①　自賠責保険</p>
				<p>　自賠責保険とは、加入義務のある保険で、人身事故のみに適用されます。被害者の最低補償を行う保険ですので、<span class="bg-red color-white">この基準に従って損害額を算定すると、低額になります。</span></p>
			</li>
			<li>
				<p>基準点②　任意保険</p>
				<p>　任意保険は、加入義務がない保険です。人身事故や物損事故にも適用されます。<span class="bg-red color-white">上の自賠責保険基準と下の裁判基準の間で算定しますが、現実は上の自賠責保険基準に近いです。</span></p>
			</li>
			<li>
				<p>基準点③　裁判基準</p>
				<p>　過去の交通事故に関する裁判結果（法律用語で判例といいます。）などを踏まえて、損害の内容ごとに基準が示されています。保険会社から示談で提示される保険金（賠償金）は、①②を基準にしていますので、裁判所の基準より低いことが多いです。<br>　「保険会社の人が言うのだから、そうなのだろう」と考えたり、「早く終わらせたい」というお気持ちはよくわかりますが、<span class="bg-red color-white">本来受けとることのできるはずの損害賠償金が受け取れないことになりがちです。</span>適切な賠償金額を受け取るために山下江法律事務所にお任せください。<br>　当事務所では相談料・着手金ともに無料ですので、ぜひご相談ください。</p>
			</li>
		</ul>
	</div>
	<?php cta('弁護士があなたに代わって裁判基準に基づく適切な賠償金を得るための交渉をします！'); ?>
</section>
<section id="section-3" data-magellan-target="section-3">
	<div class="title-block row">
		<h2>サポート内容</h2>
		<h3>交渉の余地があるのか、解決までの流れを完璧にアドバイス</h3>
		<p>相談料も着手金も無料！報酬は取得した金額・増額した金額から<br>だから相談数・解決実績数が広島最大級！</p>
	</div>
	<div class="row">
		<h4>山下江法律事務所がお手伝いします！</h4>
		<ul class="no-bullet bg-grafpaper">
			<li>
				<p>アドバイス</p>
				<p>　解決までの流れを丁寧にご説明いたします。</p>
			</li>
			<li>
				<p>賠償額の適正チェック</p>
				<p>　保険会社の提案額は、裁判所の基準等から考えると相当程度低いと言わざるを得ません。<br>まずは、交渉の余地があるのかご確認いたします。</p>
			</li>
			<li>
				<p>症状固定</p>
				<p>　治療を続けても大幅な改善が見込めなくなった段階のことを「症状固定」といいます。<br>この症状固定は、事故による損害賠償の額に大きく影響するため、非常に大きな意味を持ちます。<br>最悪の場合、治療継続が必要なのに、治療費を打ち切られて、訴訟になっても裁判所が認めてくれないこともあります。<br>とても重要な判断ですから、<span class="bg-red color-white">専門家である弁護士のアドバイス</span>を受けるべきです。</p>
			</li>
			<li>
				<p>後遺障害認定手続き</p>
				<p>　適切な等級を獲得するためにはどのような書類を用意すべきか、適切な記述があるか<br>これらを判断するのには一定の知識・経験が必要です。<br>準備が不十分であったために等級を獲得できなかったといった事態を避けるため、等級認定手続を経る前に、<span class="bg-red color-white">弁護士に一度相談されることをお勧め致します。</span></p>
			</li>
			<li>
				<p>必要に応じて医師面談</p>
				<p>　医師に診断書の内容について理解を求めることもあります。<br>実際に、そうした病院（医師）への同行により、それまで認定されなかった後遺障害についての認定を得た事例もあります。</p>
			</li>
			<li>
				<p>すでに後遺障害認定結果を出してしまった方でも見直し可能！</p>
				<p>　すでに後遺障害認定結果を出してしまった方でも、それが適切ではない場合、認定結果の見直しを求められます！<br>もちろん相応の準備が必要ですが、適切な書類を用意するなど万全の体制で見直しを求めることが可能です。</p>
			</li>
			<li>
				<p>費用という負担をなくしました！</p>
				<p>　弁護士に頼むと多額の費用がかかるのではないかというご心配を解消すべく、相談料無料・着手金無料で問題解決をお任せいただけます！</p>
			</li>
			<li>
				<p>賠償金の増額には「交渉」が不可欠</p>
				<p>　保険会社との粘り強い交渉が不可欠ですが、「交渉」ができるのは弁護士のみです。<br>また、弁護士が介入することにより、ほとんどの場合に保険金の増額が得られますので、依頼者は弁護士報酬を支払っても、弁護士不介入の場合に比べて多くの賠償金を得ることができると思います。</p>
			</li>
		</ul>
	</div>
	<?php cta('交通事故相談は、弁護士に相談すべきであると断言できます！<br>費用のご心配も解消！　相談料無料だからまずは、相談ください！'); ?>
</section>
<section id="section-4" data-magellan-target="section-4" class="row">
	<div class="title-block">
		<h2>お客様の声</h2>
		<h3>本来受け取れるはずの損害賠償金の最大限を追求</h3>
		<p>相談料も着手金も無料で解決まで完全サポート！<br>だから多くの方々にご満足いただいております。</p>
	</div>
	<div class="voices accordion" data-accordion>
		<?php
		$args = array(
			'post_type' => 'voice',
			'posts_per_page' => 7,
			'voice-cat' => 'traffic-acc',
			'order' => 'DESC',
			'orderby' => 'modified'
			);
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
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
	<p class="text-center">その他、交通事故関係のお客様の声は<a href="<?php home_url(); ?>/client-category/traffic-acc" target="_blank" title="ご依頼者様の声　カテゴリー：交通事故" class="link-external">ご依頼者様の声　カテゴリー：交通事故</a>に多数掲載しております。</p>
</section>
<?php cta('山下江法律事務所なら相談料無料！着手金も無料！<br>適切な賠償金を受け取るために弁護士へご相談ください'); ?>
<section id="section-5" data-magellan-target="section-5">
	<div class="title-block row">
		<h2>事務所案内</h2>
		<h3>大規模事務所の利点を生かし、交通事故チームがあなたの人生を応援します。</h3>
		<p>本来受け取れる賠償金を得るために、弁護士を。その一心から相談料も着手金も無料！</p>
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
			お問い合わせの内容が、法律相談の場合には、メール、電話でのご回答はいたしかねます。あらかじめご了承ください。<br>
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
	<li>山下江法律事務所の交通事故専門サイトもごらんください！</li>
	<li><a class="link-external img" href="http://www.hiroshima-jiko.com/" target="_blank" title="山下江法律事務所の交通事故サイト"><img src="<?php echo DTDSH_HOME_URL; ?>/wp-content/uploads/2015/05/external-links-1.png" alt="賠償金額が増額するケースが大半！交通事故の専門サイト"></a></li>
</ul>
