<?php
// 遺産分割協議書の作成見積もりフォーム
add_shortcode( 'sozoku-form', 'add_sozoku_form' );
function add_sozoku_form( $atts ) {
	extract(
		shortcode_atts(
			array(
				'form_num' => 1,
				), $atts
			)
		);
	switch ( $form_num ) {
		case '1':
		$result = <<< EOT
<div id="tesuryo" class="rates-form">
	<h3>遺産分割協議書作成の手数料を簡単に概算できます！</h3>
	<div class="row align-middle">
		<div class="column medium-4">
			<label>相続財産</label>
			<div class="input-group">
				<input type="number" class="num input-group-field">
				<span class="input-group-label">万円</span>
			</div>
		</div>
		<div class="column medium-4">
			<input class="button expanded" style="margin-bottom:0" type="submit" value="計算する">
		</div>
		<div class="column medium-4">
			<label>手数料</label>
			<div class="input-group">
				<input type="text" disabled="disabled" class="result input-group-field">
				<span class="input-group-label">万円</span>
			</div>
		</div>
	</div>
</div>
EOT;
		return $result;
		break;
		case '2':
		// 交渉・調停・裁判
		$result = <<< EOT
<div id="chakusyu" class="rates-form">
	<h3>交渉・調停・裁判の着手金と報酬金を簡単に概算できます！</h3>
	<div class="row align-middle">
		<div class="column medium-6">
			<label>経済的利益</label>
			<div class="input-group">
				<input type="number" class="num input-group-field">
				<span class="input-group-label">万円</span>
			</div>
		</div>
		<div class="column medium-6">
			<input class="button expanded" style="margin-bottom:0" type="submit" value="計算する">
		</div>
	</div>
	<div class="row">
		<div class="column medium-6">
			<label>着手金</label>
			<div class="input-group">
				<input type="text" disabled="disabled" class="result01 input-group-field">
				<span class="input-group-label">万円</span>
			</div>
		</div>
		<div class="column medium-6">
			<label>報酬金</label>
			<div class="input-group">
				<input type="text" disabled="disabled" class="result02 input-group-field">
				<span class="input-group-label">万円</span>
			</div>
		</div>
	</div>
</div>
EOT;
		return $result;
		break;
		case '3':
		// 遺言書作成
		$result = <<< EOT
<div id="igon" class="rates-form">
	<h3>遺言書作成手数料を簡単に概算できます！</h3>
	<div class="row align-middle">
		<div class="column middle-4">
			<label>経済的利益</label>
			<div class="input-group">
				<input type="number" class="num input-group-field">
				<span class="input-group-label">万円</span>
			</div>
		</div>
		<div class="column middle-4">
			<input class="button expanded" style="margin-bottom:0" type="submit" value="計算する">
		</div>
		<div class="column middle-4">
			<label>手数料</label>
			<div class="input-group">
				<input type="text" disabled="disabled" class="result input-group-field">
				<span class="input-group-label">万円</span>
			</div>
		</div>
	</div>
</div>
EOT;
		return $result;
		break;
		case '4':
		// 遺言執行手数料
		$result = <<< EOT
<div id="executor" class="rates-form">
	<h3>遺言執行手数料を簡単に概算できます！</h3>
	<div class="row align-middle">
		<div class="column middle-4">
			<label>経済的利益</label>
			<div class="input-group">
				<input type="number" class="num input-group-field">
				<span class="input-group-label">万円</span>
			</div>
		</div>
		<div class="column middle-4">
			<input class="button expanded" style="margin-bottom:0" type="submit" value="計算する">
		</div>
		<div class="column middle-4">
			<label>手数料</label>
			<div class="input-group">
				<input type="text" disabled="disabled" class="result input-group-field">
				<span class="input-group-label">万円</span>
			</div>
		</div>
	</div>
</div>
EOT;
		return $result;
		break;
	}
}
