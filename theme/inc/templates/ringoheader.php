<?php
	// File Security Check
	if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
		die ( 'このページヘアクセスする権限がありません！　　　You do not have sufficient permissions to access this page!' );
	}
	$typearray = array('post','page','calendar');
	$curquer = $wp_query->get_queried_object();
	$ringo = get_option('ringosh');

	$headerimage = (isset($ringo['rin_headimg'])) ? $ringo['rin_headimg'] : '';
	$imagetile = (isset($ringo['rin_imgtile'])) ? $ringo['rin_imgtile'] : '';
	$headerheights = (isset($ringo['rin_headheight'])) ? $ringo['rin_headheight'] : '';
	$textcolor = (isset($ringo['rin_headtextcol'])) ? $ringo['rin_headtextcol'] : '';
	$maskcolor = (isset($ringo['rin_headmaskcol'])) ? $ringo['rin_headmaskcol'] : '';
	$maskpercent = (isset($ringo['rin_headmask'])) ? $ringo['rin_headmask'] : '';

	if (is_single() && in_array(get_post_type(), $typearray) || is_page() && in_array(get_post_type(), $typearray)) {
		$args = array( 'rin_headimg_src','rin_header_tileformat','rin_headimg_boxheight','rin_headimg_txtcol','rin_headimg_maskcol','rin_headimg_boxmask','rin_header_enabled','rin_header_mapaddress','rin_header_maplat','rin_header_maplng','rin_header_sliderselect');
		$solutions = ringotheme_processmetas($args, $curquer->ID);

	if ($solutions[6] == "2") {
		$att_img = wp_get_attachment_image_src($solutions[0],'full');
		$headerimage = isset($solutions[0])? $att_img[0] : $ringo['rin_headimg'];
		$imagetile = ($solutions[1] != '')? $solutions[1] : $ringo['rin_imgtile'];
		$headerheights = isset($solutions[2])? $solutions[2] : $ringo['rin_headheight'];
		$textcolor = isset($solutions[3])? $solutions[3] : $ringo['rin_headtextcol'];
		$maskcolor = isset($solutions[4])? $solutions[4] : $ringo['rin_headmaskcol'];
		$maskpercent = ($solutions[5] != '1' || $solutions[5] != '')? $solutions[5] : $ringo['rin_headmask'];
	}
		$solutionstring = $solutions[7] . $solutions[8] . $solutions[9];
		if ($solutions[6] == "3" && $solutions[7] . $solutions[8] . $solutions[9] != '' ) {
		$headerheights = ($solutions[2] != '140' || !$solutions[2] != '')? $solutions[2] : $ringo['rin_headheight'];
		$address = ($solutions[7] != '')? $solutions[7] : '';
		$lat= ($solutions[8] != '')? $solutions[8] : '';
		$lng = ($solutions[9] != '')? $solutions[9] : '';
		}
	}

	// get the styling options
	$headerimage = ($headerimage != '')? ' background-image: url(' . $headerimage . '); ' : '';
	$headerheight = ($headerheights != "140")?   ' height: ' . $headerheights . 'px; '  :   '';
	$textcolor= ($textcolor != '')?  ' color: ' . $textcolor . '; '  :  '';
	$maskcolor = ($maskcolor != '')?  ' background: ' . $maskcolor . '; '   :   '';
	$maskpercent = ($maskpercent != '')?  ' opacity: ' . $maskpercent /100 . '; '   :   '';

	switch ($imagetile) {
		case '1':
			$imagetile = ' background-repeat: repeat; ';
		break;

		case '2':
			$imagetile = ' background-repeat: repeat-y; ';
		break;

		case '3':
			$imagetile = ' background-repeat: repeat-x; ';
		break;

		case '4':
			$imagetile = ' background-repeat: no-repeat; background-size: cover; ';
		break;

		case '5':
			$imagetile = ' background-repeat: no-repeat; ';
		break;

	}



	// set the variable
	$ringotitle = '';
	$curquer = $wp_query->get_queried_object();
	if (is_search()) {
		$ringotitle = '「' .get_search_query(). '」で検索した結果';
	} elseif (is_archive()) {
		if( is_day() ) {
			$ringotitle = 'アーカイブ : '.get_the_date('Y年m月d日') ;
		} elseif ( is_month() ) {
			$ringotitle = 'アーカイブ : '.get_the_date('Y年m月') ;
		} elseif ( is_year() ) {
			$ringotitle = 'アーカイブ : '. get_the_date('Y年') ;
		} elseif(is_tag()) {
			$ringotitle = 'タグ : ' .single_cat_title( '', false );
		} elseif(is_category()) {
			$ringotitle = 'カテゴリー : ' .single_cat_title( '', false );
		} elseif(is_tax('cases-cat')) {
			$ringotitle = 'カテゴリー : ' .single_cat_title( '', false );
		} elseif(is_tax('cases-tag')) {
			$ringotitle = 'タグ : ' .single_cat_title( '', false );
		} elseif(is_tax('members-cat')) {
			$ringotitle = 'カテゴリー : ' .single_cat_title( '', false );
		} elseif(is_tax('members-tag')) {
			$ringotitle = 'タグ : ' .single_cat_title( '', false );
		} elseif(is_tax('voice-cat')) {
			$ringotitle = 'カテゴリー : ' .single_cat_title( '', false );
		} elseif(is_tax('voice-tag')) {
			$ringotitle = 'タグ : ' .single_cat_title( '', false );
		} else {
			$ringotitle = post_type_archive_title('', false);
		}
	} elseif (is_author()) {
		$ringotitle = single_cat_title('', false);
	} elseif(is_page()) {
		$ringotitle = get_the_title($post->ID);
	} elseif(is_single()) {
		$ringotitle = (get_post_type($post->ID) == 'post') ? 'お知らせ' : get_post_type_object(get_post_type())->label;
	} elseif(is_home()) {
		$ringotitle = (!empty($curquer)) ? get_the_title($curquer->ID) : 'お知らせ';
	} elseif(is_404()) {
		$ringotitle = 'ページが見つかりませんでした！';
	}

	?>

	<?php if (isset($solutions) && $solutions[6] == "3") {  ?>
		<!-- draw the section -->
		<section id="ringoheader" class="ringo_streetmapheader" style="<?php echo $headerheight; ?>">
		<?php echo do_shortcode( '[ringox-streetmap address="' . $solutions[7] . '" height="' . $headerheights . '" zoom="16" lt="' . $solutions[8] . '"  lg="' .  $solutions[9] . '"]' ); ?>
		<h1 class="rin_cust_font rin_mapheader" style="<?php echo $textcolor; ?>"><?php echo $ringotitle; ?></h1>
		</section>
	<?php } elseif (isset($solutions) && $solutions[6] == "4") {  ?>
		<div style="background: #292C2F; min-height: 200px;">
		<?php 
			if (class_exists('RevSlider')) {
				putRevSlider($solutions[10]); 
			}
		?>
</div>
<?php } else  {  ?>
<section id="ringoheader" style="<?php echo $headerimage; ?> background-position: center top; <?php echo $headerheight; ?> <?php echo $imagetile; ?>">
<div class="rin_headermask" style="<?php echo $maskcolor; ?><?php echo $maskpercent; ?>"></div>
<h1 class="rin_cust_font" style="<?php echo $textcolor; ?>"><span><?php echo $ringotitle; ?></span></h1>
</section>
<?php
	}
	$scope_nav_page = array('5', '1282', '1287', '1289', '1435', '1256', '1265', '1269', '1271', '1274', '1279', '544', '151', '281', '360', '1485', '423', '459', '2512', '2521');
	if(is_page($scope_nav_page) || is_home() && has_nav_menu('ringo-scopenav')) {
?>
<div id="scopenav-wrapper" class="scroll-nav">
<div id="scopenav-scroller">
<?php
	wp_nav_menu(array(
		'theme_location' => 'ringo-scopenav',
		'container_id' => 'scopenav',
		'container_class' => 'scroll-nav-container'
	));
?>
</ul>
</div>
</div>
<?php
	}
?>





