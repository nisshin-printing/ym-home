<?php
add_shortcode( 'seminar-list', 'show_seminar_lists' );
function show_seminar_lists() {
	$seminar_array = array(
		array(
			'num'       => '1',
			'time'      => '2011年1月25日',
			'title'     => '残業代請求の対応について<br>―　残業代請求への企業防衛策の確立を実践的に目指す',
			'lawyer'    => '山下江',
			'lawyer_id' => '548',
			'resume'    => '01-resume.pdf',
		),
		array(
			'num'       => '2',
			'time'      => '2011年5月24日',
			'title'     => '取締役の経営責任と企業の社会的責任（CSR）',
			'lawyer'    => '山下江',
			'lawyer_id' => '548',
			'resume'    => '02-resume.pdf',
		),
		array(
			'num'       => '3',
			'time'      => '2011年9月27日',
			'title'     => '中小企業のための独占禁止法',
			'lawyer'    => '山下江',
			'lawyer_id' => '548',
			'resume'    => '03-resume.pdf',
		),
		array(
			'num'       => '4',
			'time'      => '2012年1月26日',
			'title'     => '民事介入暴力への対応',
			'lawyer'    => '柴橋修',
			'lawyer_id' => '550',
			'resume'    => '04-resume.pdf',
		),
		array(
			'num'       => '5',
			'time'      => '2012年5月24日',
			'title'     => '役に立つ債権回収の法律実務',
			'lawyer'    => '山下江',
			'lawyer_id' => '548',
			'resume'    => '05-resume.pdf',
		),
		array(
			'num'       => '6',
			'time'      => '2012年9月27日',
			'title'     => '契約書作成について',
			'lawyer'    => '田中伸',
			'lawyer_id' => '549',
			'resume'    => '06-resume.pdf',
			'document'  => '06-template.pdf',
			'comment'  => '06-comment.pdf',
		),
		array(
			'num'       => '7',
			'time'      => '2013年1月24日',
			'title'     => '不動産取引における注意点',
			'lawyer'    => '柴橋修',
			'lawyer_id' => '550',
			'resume'    => '07-resume.pdf',
		),
		array(
			'num'       => '8',
			'time'      => '2013年5月23日',
			'title'     => '職場を原因とするうつ病と会社の責任<br>―　メンタルヘルスについて',
			'lawyer'    => '山下江',
			'lawyer_id' => '548',
			'resume'    => '08-resume.pdf',
		),
		array(
			'num'       => '9',
			'time'      => '2013年9月26日',
			'title'     => '不正競争防止法ってなに？',
			'lawyer'    => '田中伸',
			'lawyer_id' => '549',
			'resume'    => '09-resume.pdf',
		),
		array(
			'num'       => '10',
			'time'      => '2014年1月23日',
			'title'     => 'CSR経営におけるクレーム対応のポイント<br>―　社員と会社の信用を守る',
			'lawyer'    => '山下江',
			'lawyer_id' => '548',
			'resume'    => '10-resume.pdf',
		),
		array(
			'num'       => '11',
			'time'      => '2014年5月22日',
			'title'     => 'セクハラ、パワハラなど社内トラブル対処法',
			'lawyer'    => '柴橋修',
			'lawyer_id' => '550',
			'resume'    => '11-resume.pdf',
		),
		array(
			'num'       => '12',
			'time'      => '2014年9月25日',
			'title'     => '時効にかけない債権管理術',
			'lawyer'    => '田中伸',
			'lawyer_id' => '549',
			'resume'    => '12-resume.pdf',
		),
		array(
			'num'       => '13',
			'time'      => '2015年3月26日',
			'title'     => '民事裁判シミュレーション<br>―　もしもあなたの会社が訴えられたら',
			'lawyer'    => '加藤泰',
			'lawyer_id' => '554',
			'resume'    => '13-resume.pdf',
			'document'  => '13-document.pdf',
		),
		array(
			'num'       => '14',
			'time'      => '2015年7月23日',
			'title'     => '企業におけるメンタルヘルス対策とマイナンバー制度の対応について',
			'lawyer'    => 'フクシマ社会保険労務士法人　代表社員　福島省三',
			'resume'    => '14-resume.pdf',
		),
		array(
			'num'       => '15',
			'time'      => '2015年11月26日',
			'title'     => 'パート、派遣等非正規社員の雇用の注意点',
			'lawyer'    => '笠原輔',
			'lawyer_id' => '553',
			'resume'    => '15-resume.pdf',
			'audio'     => '15-audio.mp3',
		),
		array(
			'num'       => '16',
			'time'      => '2016年3月24日',
			'title'     => '従業員の解雇に関する留意点',
			'lawyer'    => '稲垣洋之',
			'lawyer_id' => '551',
			'resume'    => '16-resume.pdf',
			'audio'     => '16-audio.mp3',
		),
		array(
			'num'       => '17',
			'time'      => '2016年7月28日',
			'title'     => 'ポイント解説！有期労働契約の更新・雇止め',
			'lawyer'    => '田中伸',
			'lawyer_id' => '549',
			'resume'    => '17-resume.pdf',
			'audio'     => '17-audio.mp3',
		),
		array(
			'num'       => '18',
			'time'      => '2016年11月24日',
			'title'     => '契約書の作法 - 取引先から苦笑いされないために',
			'lawyer'    => '加藤泰',
			'lawyer_id' => '554',
			'resume'    => '18-resume.pdf',
			'audio'     => '18-audio.mp3',
		),
		array(
			'num'       => '19',
			'time'      => '2017年3月23日',
			'title'     => '企業のための過労死、ハラスメント対策 - 「憂鬱でなければ、仕事じゃない」とも言うけれど',
			'lawyer'    => '笠原輔',
			'lawyer_id' => '553',
			'resume'    => '19-resume.pdf',
			'audio'     => '19-audio.mp3',
		),
	);
	$seminar_array = array_reverse( $seminar_array );
	$html = '';
	foreach ( $seminar_array as $seminar ) {
		if ( ! empty( $seminar["lawyer_id"] ) ) {
			$member_img = get_the_post_thumbnail( $seminar["lawyer_id"] );
		} else {
			$member_img = '';
		}
		$html .= '<article class="seminar-list card">';
		$html .= '<h3>第' . $seminar["num"] . '回 - ' . $seminar["title"] . '</h3>';
		if ( ! empty( $member_img ) ) {
			$html .= '<div class="card-img">' . $member_img . '</div>';
		}
		$html .= '<div class="seminar-content"><p class="time">開催日：　' . $seminar["time"] . '</p>';
		if ( ! empty( $seminar["lawyer_id"] ) ) {
			$html .= '<p class="lawyer">講　師：　<a href="' . get_permalink( $seminar["lawyer_id"] ) . '" title="' . get_the_title( $seminar["lawyer_id"] ) . '" target="_blank">' . $seminar["lawyer"] . '</a></p>';
		} else {
			$html .= '<p class="lawyer">講　師：　' . $seminar["lawyer"] . '</p>';
		}
		$html .= '<div class="button-group text-left">';
		$html .= '<a href="https://www.law-yamashita.com/downloads/seminar/' . $seminar["resume"] . '" class="waves-effect button" title="' . $seminar["title"] . '-' . $seminar["lawyer"] . '" target="_blank">セミナー資料</a>';
		if ( ! empty( $seminar["document"] ) ) {
			$html .= '<a href="https://www.law-yamashita.com/downloads/seminar/' . $seminar["document"] . '" class="waves-effect button" title="' . $seminar["title"] . '-' . $seminar["lawyer"] . '" target="_blank">資料集</a>';
		}
		if ( ! empty( $seminar["comment"] ) ) {
			$html .= '<a href="https://www.law-yamashita.com/downloads/seminar/' . $seminar["comment"] . '" class="waves-effect button" title="' . $seminar["title"] . '-' . $seminar["lawyer"] . '" target="_blank">基本契約書（見本）におけるコメント</a>';
		}
		$html .= '</div>';
		if ( ! empty( $seminar["audio"] ) ) {
			$html .= '<audio src="' . TAUDIO . $seminar["audio"] . '" controls><p>音声を再生するには、サポートするブラウザが必要です。</p></audio>';
		}
		$html .= '</div></article>';
	}
	return $html;
}