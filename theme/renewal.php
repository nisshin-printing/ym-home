<?php
function quick_maintenance_mode() {
	if ( ! current_user_can( 'edit_themes' ) || ! is_user_logged_in() ) {
		wp_die( '
			<h1>ただいまメンテナンス中です</h1>
			<p>大変ご迷惑をおかけいたしますが、しばらくしてから再度アクセスをお願いいたします。<br>なお、お問い合わせや法律相談のご予約は下記の窓口で承っております。</p>
			<ul>
				<li>法律相談専用の無料ダイヤル<br><a href="tel:0120783409">0120-7834-09</a></li>
				<li>メールで相談予約<br><a href="mailto:info@law-yamashita.com">info@law-yamashita.com</a></li>
				<li>事務所の代表回線<br><a href="tel:0822230695">082-223-0695</a></li>
				<li>アクセスをグーグルマップで見る<br><a href="https://goo.gl/maps/RJUDyMEpiND2">Google Map</a></li>
			</ul>
		', 'メンテナンス中です。 - 山下江法律事務所' );
	}
}
add_action( 'get_header', 'quick_maintenance_mode' );