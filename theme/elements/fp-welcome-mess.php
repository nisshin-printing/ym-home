<?php
	$yamashita = get_post_thumbnail_id( '548', 'thumbnail' );
	$tanaka = get_post_thumbnail_id( '549', 'thumbnail' );
?>
<section class="fp--message">
	<div class="message message--primary">
		<div class="row align-middle">
			<div class="column small-12 medium-6 large-4 message--image">
				<picture>
					<source media="(max-width: 639px)" srcset="<?php echo wp_get_attachment_image_src( $yamashita, 'full' )[0]; ?>" sizes="210px">
					<img class="thumbnail" src="<?php echo wp_get_attachment_image_src( '4041', 'full' )[0]; ?>" width="<?php echo wp_get_attachment_image_src( '4041', 'full' )[1]; ?>" height="<?php echo wp_get_attachment_image_src( '4041', 'full' )[2]; ?>" alt="代表・弁護士の山下江の写真">
				</picture>
			</div>
			<div class="column small-12 medium-6 large-8">
				<h2 class="title--border-bottom">代表あいさつ</h2>
				<div class="message--paragraph">
					<p>山下江法律事務所サイトへのご訪問ありがとうございます。<br>お悩みやお困りごとがありましたら，お気軽に当事務所にご連絡ください。</p>
					<p>当事務所は，平成7年7月11日創立以来「親切な相談」「適切な解決」をモットーに業務に励んできました。<br>平成２９年１月には弁護士法人を設立し、広島本部のほか、<a href="<?php echo home_url( '/' ), 'lp/3674'; ?>" title="東広島支部" target="_blank">東広島支部</a>と<a href="<?php echo home_url( '/' ), 'lp/4137'; ?>" title="呉支部" target="_blank">呉支部</a>を開設しました。</p>
					<p>トラブルに巻き込まれた場合，法律的にはどうなるのだろうというご質問に的確にお答えし，法律で保証された権利を依頼者様に寄り添いながら実現していきます。さらに，法律的には困難な場合でも，どのようにすれば依頼者様にとっての最善の道に向かうのかについて，依頼者様に寄り添い一緒に考え，闘います。</p>
					<p>あなたは一人ではありません。<br>私たち弁護士・秘書があなたを全力で支えます。私たちはあなたの味方です。<br>一人で悩まず，まずは当事務所までご連絡ください。</p>
					<p class="text-right"><a href="<?php echo get_permalink( '548' ); ?>" class="button" title="山下江について">山下江について　></a></p>
				</div>
			</div>
		</div>
	</div>
	<div class="message message--secondary">
		<div class="row align-middle">
			<div class="column small-12 medium-6 large-4 message--image">
				<picture>
					<source media="(max-width: 639px)" srcset="<?php echo wp_get_attachment_image_src( $tanaka, 'full' )[0]; ?>" sizes="210px">
					<img class="thumbnail" src="<?php echo wp_get_attachment_image_src( '4040', 'full' )[0]; ?>" width="<?php echo wp_get_attachment_image_src( '4040', 'full' )[1]; ?>" height="<?php echo wp_get_attachment_image_src( '4040', 'full' )[2]; ?>" alt="副代表・広島本部長・弁護士の田中伸">
				</picture>
			</div>
			<div class="column small-12 medium-6 large-8">
				<h2 class="title--border-bottom">副代表あいさつ</h2>
				<div class="message--paragraph">
					<p>山下江法律事務所の副代表を務めております，弁護士の田中伸です。</p>
					<p>当事務所では，さまざまな分野の法律問題を取り扱っていますが，その中でも，<a href="<?php echo get_page_link( '1256' ); ?>">「交通事故」</a>，<a href="<?php echo get_page_link( '1269' ); ?>">「相続」</a>及び<a href="<?php echo get_page_link( '1435' ); ?>">「企業法務」</a>の各分野については，専門チームを設けて，日々研鑽に努めています。</p>
					<p>「親切な相談」と「適切な解決」をモットーに，皆さまのお役に立てるよう業務に取り組んでまいりますので，法的なことで何かお困りごとがございましたら，当事務所にご相談ください。</p>
					<p class="text-right"><a href="<?php echo get_permalink( '549' ); ?>" class="button" title="副代表の田中伸について">田中伸について　></a></p>
				</div>
			</div>
		</div>
	</div>
</section>
