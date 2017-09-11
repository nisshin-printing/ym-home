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
<div class="section row bg-snow br1 bl1 rates-form tesuryo">
	<h3 class="ml1">遺産分割協議書作成の手数料を簡単に概算できます！</h3>
	<div class="column">
		<label>相続財産</label>
		<div class="input-group">
			<input type="number" class="num input-group-field">
			<span class="input-group-label">万円</span>
		</div>
	</div>
	<div class="column">
		<input class="button expanded waves-effect" type="submit" value="計算する">
	</div>
	<div class="column">
		<label>手数料</label>
		<div class="input-group">
			<input type="text" disabled="disabled" class="result input-group-field">
			<span class="input-group-label">万円</span>
		</div>
	</div>
</div>
EOT;
		return $result;
		break;
		case '2':
		// 交渉・調停・裁判
		$result = <<< EOT
<div class="section row bg-snow br1 bl1 rates-form chakusyu">
	<h3 class="ml1">交渉・調停・裁判の着手金と報酬金を簡単に概算できます！</h3>
	<div class="column">
		<div class="m0-auto">
			<label>経済的利益</label>
			<div class="input-group">
				<input type="number" class="num input-group-field">
				<span class="input-group-label">万円</span>
			</div>
		</div>
		<div class="m0-auto">
			<input class="button expanded waves-effect" type="submit" value="計算する">
		</div>
	</div>
	<div class="column row">
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
<div class="section row bg-snow br1 bl1 rates-form igon">
	<h3 class="ml1">遺言書作成手数料を簡単に概算できます！</h3>
	<div class="column row">
		<div class="column">
			<label>経済的利益</label>
			<div class="input-group">
				<input type="number" class="num input-group-field">
				<span class="input-group-label">万円</span>
			</div>
		</div>
	</div>
	<div class="column">
		<input class="button expanded waves-effect" type="submit" value="計算する">
	</div>
	<div class="column">
		<label>手数料</label>
		<div class="input-group">
			<input type="text" disabled="disabled" class="result input-group-field">
			<span class="input-group-label">万円</span>
		</div>
	</div>
</div>
EOT;
		return $result;
		break;
		case '4':
		// 遺言執行手数料
		$result = <<< EOT
<div class="section row bg-snow br1 bl1 rates-form executor">
	<h3 class="ml1">遺言執行手数料を簡単に概算できます！</h3>
	<div class="column">
		<label>経済的利益</label>
		<div class="input-group">
			<input type="number" class="num input-group-field">
			<span class="input-group-label">万円</span>
		</div>
	</div>
	<div class="column">
		<input class="button expanded waves-effect" type="submit" value="計算する">
	</div>
	<div class="column">
		<label>手数料</label>
		<div class="input-group">
			<input type="text" disabled="disabled" class="result input-group-field">
			<span class="input-group-label">万円</span>
		</div>
	</div>
</div>
EOT;
		return $result;
		break;
	}
}