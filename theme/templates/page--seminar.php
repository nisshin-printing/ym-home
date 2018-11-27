<?php
	$pass = 'christmas';
	if ( $pass !== $_POST['pass'] || empty( $_POST['pass'] ) ) {
		if ( $_POST['pass'] ) {
			echo '<div class="callout alert"><p>パスワードが古いか違います。顧問先企業様はお問い合わせください。</p></div>';
		}
		echo '<form action="', str_replace( '%7E', '~', $_SERVER['REQUEST_URI']), '" method="POST">',
			'このページは顧問先限定ページです。詳しくはお問い合わせください。<br>',
			'<div class="input-group">',
			'<input class="input-group-field" type="password" name="pass" value="">',
			'<div class="input-group-button">',
			'<input type="submit" class="button" value="送信">',
			'</div></div>',
		'</form>';
	} else {
		echo do_shortcode( '[seminar-list]' );
	}
?>
