<aside id="js--sidebar" class="sidebar">
	<button class="sidenav--trigger__wrap">
		<a href="#" class="js--sidenav--button sidenav--trigger">
			<span></span>
			<span></span>
			<span></span>
		</a>
	</button>
<?php if ( is_post_type_archive( 'cases' ) || is_singular( 'cases' ) || is_tax( 'cases-cat' ) ) : ?>
	<div class="sidebar--item">
		<h5 class="sidebar--title">解決事例カテゴリー</h5>
		<ul class="menu vertical" role="menu">
		<?php
			$terms = get_terms( 'cases-cat', array(
				'order' => 'DESC',
				'orderby' => 'count'
			) );
			foreach ( $terms as $term ) {
				echo '<li class="menu--item"><a href="' . get_term_link( $term ) . '" class="menu--link">' . $term->name . '</a></li>';
			}
		?>
		</ul>
	</div>
<?php endif; ?>
<?php if ( is_post_type_archive( 'voice' ) || is_singular( 'voice' ) || is_tax( 'voice-cat' ) ) : ?>
	<div class="sidebar--item">
		<h5 class="sidebar--title">分野カテゴリー</h5>
		<ul class="menu vertical" role="menu">
		<?php
			$terms = get_terms( 'voice-cat', array(
				'order' => 'DESC',
				'orderby' => 'count'
			) );
			foreach ( $terms as $term ) {
				echo '<li class="menu--item"><a href="' . get_term_link( $term ) . '" class="menu--link">' . $term->name . '</a></li>';
			}
		?>
		</ul>
	</div>
<?php endif; ?>
<?php if ( is_archive() || is_home() ) : ?>
	<div class="sidebar--item">
		<h5 class="sidebar--title">カテゴリー</h5>
		<ul class="menu vertical" role="menu">
		<?php
			$categoryies = get_categories( array(
				'order' => 'DESC',
				'orderby' => 'count'
			) );
			foreach ( $categoryies as $category ) {
				echo '<li class="menu--item"><a href="' . get_category_link( $category->term_id ) . '" class="menu--link">' . $category->name . '　（' . $category->count . '）</a></li>';
			}
		?>
		</ul>
	</div>
<?php endif; ?>
	<div class="sidebar--item">
		<h5 class="sidebar--title">相談予約</h5>
		<p class="free-call"><a href="tel:0120783409"><?php NID_SVG::icon( 'phone', array( 'class' => 'free-call--icon' ), '電話する' ); ?>0120-7834-09</a></p>
		<p class="free-call--hours">平日9時～18時<br>土曜10時～17時</p>
		<p class="free-call--button"><a href="<?php echo home_url(), '/reserve'; ?>" class="button large">Web予約フォーム</a></p>
	</div>
<?php /*
	<div class="sidebar--item sidebar--banner">
		<nav>
			<ul class="menu vertical">
				<li><img src="//www.law-yamashita.com/wp-content/themes/law-yamashita/assets/img/front-page/sites_jiko.png" alt="テスト用の画像"></li>
				<li><img src="//www.law-yamashita.com/wp-content/themes/law-yamashita/assets/img/front-page/sites_jiko.png" alt="テスト用の画像"></li>
				<li><img src="//www.law-yamashita.com/wp-content/themes/law-yamashita/assets/img/front-page/sites_jiko.png" alt="テスト用の画像"></li>
				<li><img src="//www.law-yamashita.com/wp-content/themes/law-yamashita/assets/img/front-page/sites_jiko.png" alt="テスト用の画像"></li>
			</ul>
		</nav>
	</div>
*/ ?>
	<div class="sidebar--item">
	<h5 class="sidebar--title">メインメニュー</h5>
		<?php
			NID_Menu::nav_menu( 'primary', array(
				'container_class' => 'menu--side__wrap',
				'menu_direction' => 'vertical',
				'show_level_class' => true
			) );
		?>
	</div>
	<div class="sidebar--item sidebar--banner">
		<h5 class="sidebar--title">各種専門サイト</h5>
		<nav>
			<ul class="menu vertical">
				<?php
					include( get_template_directory() . '/config/sites.php' );
					$sites_img = get_template_directory_uri() . '/assets/img/sites/light--';
					foreach ( $sites as $site ) {
						if ( 'another' !== $site['name'] ) {
							$url = ( $site['ssl'] ) ? 'https://hiroshima-' : 'http://www.hiroshima-';
							$url = $url . $site['name'] . '.com';
							$bg = ( $site['bg'] ) ? 'bg-' . $site['name'] : 'bg-else';
							$img = $sites_img . $site['name'] . '.png';
							$alt = ( $site['alt'] ) ? $site['alt'] : '弁護士法人山下江法律事務所の専門サイト';
							echo <<< EOT
<li><a href="$url" target="_blank" class="$bg"><img src="$img" alt="$alt"></a></li>
EOT;
						}
					}
				?>
			</ul>
		</nav>
	</div>
</aside>
