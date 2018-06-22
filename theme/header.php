<?php
/**
 * Header file common to all
 * templates
 *
 */
?>
<!doctype html>
<html lang="ja" dir="ltr">
<head>
	<?php // Google Tag Manager ?>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-MM3VKH');</script>
	<?php // End Google Tag Manager ?>
	
	<meta charset="UFT-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chorme=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
<![endif]-->


<?php // replace the no-js class with js on the html element ?>
	<script>document.documentElement.className=document.documentElement.className.replace(/\bno-js\b/,'js')</script>

	<?php // load the core js polyfills ?>
	<script async defer src="<?php echo get_template_directory_uri(), '/assets/js/core.js'; ?>"></script>

	<?php wp_head(); ?>
</head>
<body id="js-body" <?php body_class(); ?>>
<?php // <body> closes in footer.php ?>

<?php // Google Tag Manager (noscript) ?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MM3VKH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<?php // End Google Tag Manager (noscript) ?>


<?php // common header content goes here ?>
	<header id="top">
		<div class="top-bar">
			<button class="column sidenav--trigger__header">
				<a href="#" class="js--sidenav--button sidenav--trigger">
					<span></span>
					<span></span>
					<span></span>
				</a>
			</button>
			<div class="column small-10 large-9">
				<p class="top-bar--title"><a href="<?php echo home_url(); ?>"><img src="//www.law-yamashita.com/wp-content/uploads/2016/04/title-logo-1.png" alt="広島最大級の弁護士事務所、山下江法律事務所のロゴ"></a></p>
				<p class="top-bar--desc">広島最大級の弁護士事務所へご相談ください。</p>
			</div>
			<div class="top-bar--button column large-3 show-for-large">
				<p class="free-call"><a href="tel:0120783409"><?php NID_SVG::icon( 'phone', array( 'class' => 'free-call--icon', '電話する' ) ); ?>0120-
				<ruby>
					<rb>7834</rb>
					<rp>
						<rt>なやみよ</rt>
					</rp>
				</ruby>-
				<ruby>
					<rb>09</rb>
					<rp>
						<rt>まるく</rt>
					</rp>
				</ruby></a></p>
				<a href="<?php echo home_url(), '/contact'; ?>" class="free-call_button button hollow secondary">お問い合わせ</a>
			</div>
		</div>
		<?php
			NID_Menu::nav_menu( 'primary', array(
				'container' => 'nav',
				'items_wrap' => '<ul class="%2$s dropdown" role="menu" data-dropdown-menu>%3$s</ul>'
			) );
		?>
	</header>
	<div class="sidenav--overlay js--sidenav--button"></div>
