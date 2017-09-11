<?php
function dtdsh_photon_img( $id, $case, $size = 'full' ) {
	$get = wp_get_attachment_image_src( $id, $size );
	if ( 'src' == $case ) {
		echo preg_replace( '/\?fit=(?:\S+)/', '', $get[0] );
	} elseif ( 'width' == $case ) {
		echo $get[1];
	} elseif ( 'height' == $case ) {
		echo $get[2];
	}
}
// 検索キーワードをハイライト
function wps_highlight_results( $text ) {
	if ( is_search() ) {
		$sr   = get_query_var( 's' );
		$keys = explode( ' ', $sr );
		$text = preg_replace( '/('.implode('|', $keys) .')/iu', '<span class="bg-line">' . $sr . '</span>', $text );
	}
	return $text;
}
add_filter('the_content', 'wps_highlight_results');
add_filter('the_excerpt', 'wps_highlight_results');
// 解決事例のカテゴリ別新着

function ringotheme_return_array( $posttype, $post_status ) {
	$op 	= array();
	$myargs = array(
		'posts_per_page'   	=> -1,
		'post_type'			=>$posttype,
		'post_status' 		=> $post_status
	);
	$my_newquery = get_posts( $myargs );
	foreach ( $my_newquery as $mynewpost ){
		$op[] =  $mynewpost->ID;
	}
	return $op;
}
/**
 * FUNCTION : ringotheme_processmetas  -
 *
 * @access public
 * @version   1.0
 * @since     1.0
 * @uses      format a collection of metabox values
 */
function ringotheme_processmetas($args, $id) {
  $id = (is_numeric($id)) ? $id : 0 ;
  $returnarray = array();
  foreach ($args as $value) {
	$returnarray[] = (get_post_meta( $id, $value, true ) != '')?  get_post_meta( $id, $value, true ) : '' ;
  }
  return $returnarray;
}
/**
 * The ringo Paging function
 *
 * @access public
 * @return array
 */
if ( ! function_exists( 'dtdsh_paging' ) ) :
function dtdsh_paging( $pages = '', $range = 4 ) {
	$showitems = ( $range * 2 ) + 1;
	global $paged;
	if ( empty( $paged ) ) $paged = 1;
	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( ! $pages ) {
			$pages = 1;
		}
	}
	if ( 1 != $pages ) {
		echo '<div class="pagination" id="js-infinity-nav">';
		if ( $paged < $pages ) {
			echo '<p><a href="' . get_pagenum_link( $paged + 1 ) . '" class="waves-effect" id="js-infinity-next" aria-label="' . ( $paged + 1 ) . '" title="次の' . $wp_query->post_count . '件を見る">次の' . $wp_query->post_count . '件を見る<i class="fa fa-angle-right"></i></a></p>';
		}
		echo '<ul aria-label="Pagination" role="navigation">';
		if ( $paged >= 2 ) {
			echo '<li class="first"><a href="' . get_pagenum_link( 1 ) . '"><i class="fa fa-fast-backward"></i></a></li>';
		} else {
			echo '<li class="first disabled"><i class="fa fa-fast-backward"></i></li>';
		}
		if ( $paged > 1 ) {
			echo '<li class="prev pagination-previous"><a href="' . get_pagenum_link( $paged-1 ) . '" aria-label="Page ' . ( $paged - 1 ) . '"><i class="fa fa-angle-left"></i></a></li>';
		} else {
			echo '<li class="prev pagination-previous disabled"><i class="fa fa-angle-left"></i></li>';
		}
		for( $i=1; $i <= $pages; $i++ ) {
			if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				if ( $paged == $i ) {
					echo '<li class="current">Page ' . $i . ' of ' . $pages .'</li>';
				} else {
					echo '<li><a href="' . get_pagenum_link( $i ) . '" aria-label="Page ' . $i . '">' . $i . '</a></li>';
				}
			}
		}
		if ( $paged < $pages ) {
			echo '<li class="next pagination-next"><a href="' . get_pagenum_link( $paged + 1 ) . '" aria-label="Page ' . ( $paged + 1 ) .'"><i class="fa fa-angle-right"></i></a></li>';
		} else {
			echo '<li class="next pagination-next disabled"><i class="fa fa-angle-right"></i></li>';
		}
		if ( $paged < $pages ) {
			echo '<li class="last"><a href="' . get_pagenum_link( $pages ) . '" aria-label="Page ' . $pages . '"><i class="fa fa-fast-forward"></i></a></li>';
		} else {
			echo '<li class="last disabled"><i class="fa fa-fast-forward"></i></li>';
		}
		echo '</ul></div>';
	}
}
endif;
/**
 * Add a new frontpage post
 *
 * @access public
 * @return void
 */
function ringosh_make_pagepost($type) {
// count the current pages and add a new number
$count_pages 	= wp_count_posts('ringoshfronts');
$runningcount = ($count_pages->private) + 1;
// insert a new post
$post_id = wp_insert_post( array(
	'post_type'       => 'ringoshfronts',
	'post_status'     => 'private',
	'comment_status'  => 'closed',
	'post_content'    => '',
	'post_title'      => ringosh_randstring(10),
	'post_author'     => '1'
) );
// add all the needed meta values
add_post_meta($post_id, 'rin_type', $type, '');
add_post_meta($post_id, 'rin_activated', '0', '');
add_post_meta($post_id, 'ringosh_post_order', $runningcount, '');
return $post_id;
}
/**
 * Add a new frontpage post
 *
 * @access public
 * @return void
 */
function ringosh_make_mm_pagepost($left, $right, $title) {
	// count the current pages and add a new number
	$count_pages 	= wp_count_posts('ringoshfronts');
	$runningcount = ($count_pages->private) + 1;
	// insert a new post
	$post_id = wp_insert_post( array(
		'post_type'       => 'ringoshmms',
		'post_status'     => 'private',
		'comment_status'  => 'closed',
		'post_content'    => '',
		'post_title'      => urldecode($title),
		'post_author'     => '1'
	) );
	// add all the needed meta values
	add_post_meta($post_id, 'rin_type1', $left, '');
	 add_post_meta($post_id, 'rin_type2', $right, '');
	add_post_meta($post_id, 'rin_activated', '0', '');
	add_post_meta($post_id, 'ringosh_post_order', $runningcount, '');
	return $post_id;
}
/**
 * Build a random string
 *
 * @access public
 * @return void
 */
function ringosh_randstring($length, $charset='abcdefghijklmnopqrstuvwxyz') {
	$str = '';
	$count = strlen($charset);
	while ($length--) {
		$str .= $charset[mt_rand(0, $count-1)];
	}
	return $str;
}
/**
 * Get the attachement id from the attachment source
 *
 * @access public
 * @return void
 */
function rin_attachment_id_from_src ($image_src) {
	global $wpdb;
	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	$id = $wpdb->get_var($query);
	return $id;
}
/**
 * Return formatted meta
 *
 * @access public
 * @return void
 */
function ringo_meta_part ($id, $meta_label, $before, $after) {
	// get all the meta values to build the argument
	$metatest = stripslashes(html_entity_decode(get_post_meta( $id, $meta_label, true )));
	// if no values were submitted, exit
	if ($metatest == '') { return; }
	if (!isset($metatest) || $metatest == '') { return; }
	// return the values
	return $before . $metatest . $after;
}
/**
 * Return formatted meta as a link
 *
 * @access public
 * @return void
 */
function 	ringo_meta_makelink ( $id, $link, $label, $color, $bg, $target, $wrapper_before, $wrapper_after ) {
	// return empty if there's no link
	if (get_post_meta( $id, $link, true ) == '') {return;}
	// set the label
	$label = (get_post_meta( $id, $link, true ) != '')? stripslashes(html_entity_decode(get_post_meta( $id, $label, true ))) :  __('More Info','ringo');
	// set the color settings
	$color 	= ($color != '' && get_post_meta( $id, $color, true ) != '')? ' color: '  . get_post_meta( $id, $color, true )  .  '; ' : '' ;
	$bg 	= ($bg != '' && get_post_meta( $id, $bg, true ) != '')? ' background: '  . get_post_meta( $id, $bg, true )  .  '; ' : '' ;
	$style 	= ($color.$bg != '')? 'style=" ' .  $color  .  $bg  .  ' "' : '' ;
	// set the target
	$target = ($target == '_blank')? 'target="_blank"' : '' ;
	return $wrapper_before . '<a href="' . get_post_meta( $id, $link, true ) . '" ' . $style . ' ' . $target . '>' .  $label  .  '</a>' . $wrapper_after;
}
/**
 * Return formatted meta as a link
 *
 * @access public
 * @return void
 */
function ringo_meta_makeinfolink ( $id, $link, $label, $color, $bg, $target, $wrapper_before, $wrapper_after ) {
	// set the label
	$label = (get_post_meta( $id, $label, true ) != '')? stripslashes(html_entity_decode(get_post_meta( $id, $label, true ))) :  __('More Info','ringo');
	// set the color settings
	$color 	= ($color != '' && get_post_meta( $id, $color, true ) != '')? ' color: '  . get_post_meta( $id, $color, true )  .  '; ' : '' ;
	$bg 	= ($bg != '' && get_post_meta( $id, $bg, true ) != '')? ' background: '  . get_post_meta( $id, $bg, true )  .  '; ' : '' ;
	$style 	= ($color.$bg != '')? 'style=" ' .  $color  .  $bg  .  ' "' : '' ;
	// set the target
	$target = ($target == '_blank')? 'target="_blank"' : '' ;
	if (get_post_meta( $id, $link, true ) == '') {
		return $wrapper_before .   $label   . $wrapper_after;
	} else {
		return $wrapper_before . '<a href="' . get_post_meta( $id, $link, true ) . '" ' . $style . ' ' . $target . '>' .  $label  .  '</a>' . $wrapper_after;
	}
}
/**
 * Return formatted meta as background style
 *
 * @access public
 * @return void
 */
function ringo_meta_makebgstyle ( $id, $image, $size ) {
	$image_id 		= rin_attachment_id_from_src (get_post_meta( $id, $image, true ));
	$image_src 		= wp_get_attachment_image_src( $image_id, $size);
	if (isset($image_src[0]) && $image_src[0] != '') {
		return ' background: url(' . $image_src[0] . ') no-repeat center; background-size: contain; ';
	} else {
		return ' background: url(' . get_post_meta( $id, $image, true ) . ') no-repeat center; background-size: contain; ';
	}
}
/**
 * Return formatted a image mask
 *
 * @access public
 * @return void
 */
function rin_makemask($id, $bg, $col){
	$color 	= get_post_meta( $id, $col, true );
	$bg 	= get_post_meta( $id, $bg, true );
	$color 	= ($color != '')? ' background:  '  . $color . '  ; ' : '' ;
	$bg 	= ($bg != '')? ' opacity:  ' . $bg/100 . ' ' : '' ;
	if ($color . $bg!= '') {
		return '<div class="rin_maskdiv" style="' . $color . $bg . '"></div>';
	} else {
		return;
	}
}
/**
 * Return a link from formatted meta
 *
 * @access public
 * @return void
 */
function ringo_meta_createlink($id, $address, $label, $default, $class, $wrap) {
	// get all the meta values
	$metalink 	= get_post_meta( $id, $address, true );
	$metalabel 	= get_post_meta( $id, $label, true );
	$metalabel 	= ($metalabel != '')?  $metalabel:  $default;
	// should the function be wrapped in a paragraph?
	if ($wrap == 'yes' ) {
		$wrapstart = '<p class="' . $class  . '_p">';
		$wrapend = '</p>';
	} else {
		$wrapstart = '';
		$wrapend = '';
	}
	// return empty or return a complete string
	if ($metalink == '') { return; }
	return $wrapstart . '<a class="' . $class  . '" href="' . $metalink . '" title="' .  $metalabel . '" alt="' .  $metalabel . '">' .  $metalabel . '</a>' . $wrapend;
}
/**
 * Fonticon list
 *
 * @access public
 * @return void
 */
function get_fonticons() {
	return array('glass,music,search,envelope-alt,heart,star,star-empty,user,film,th-large,th,th-list,ok,remove,
		zoom-in,zoom-out,power-off,off,signal,gear,cog,trash,home,file-alt,time,road,download-alt,download,upload,inbox,play-circle,
rotate-right,repeat,refresh,list-alt,lock,flag,headphones,volume-off,volume-down,volume-up,qrcode,barcode,tag,tags,
book,bookmark,print,camera,font,bold,italic,text-height,text-width,align-left,align-center,align-right,
align-justify,list,indent-left,indent-right,facetime-video,picture,pencil,map-marker,adjust,tint,edit,share,check,
move,step-backward,fast-backward,backward,play,pause,stop,forward,fast-forward,step-forward,eject,chevron-left,
chevron-right,plus-sign,minus-sign,remove-sign,ok-sign,question-sign,info-sign,screenshot,remove-circle,ok-circle,
ban-circle,arrow-left,arrow-right,arrow-up,arrow-down,mail-forward,share-alt,resize-full,resize-small,plus,minus,
asterisk,exclamation-sign,gift,leaf,fire,eye-open,eye-close,warning-sign,plane,calendar,random,comment,magnet,
chevron-up,chevron-down,retweet,shopping-cart,folder-close,folder-open,resize-vertical,resize-horizontal,bar-chart,
twitter-sign,facebook-sign,camera-retro,key,gears,cogs,comments,thumbs-up-alt,thumbs-down-alt,star-half,
heart-empty,signout,linkedin-sign,pushpin,external-link,signin,trophy,github-sign,upload-alt,lemon,phone,unchecked,
check-empty,bookmark-empty,phone-sign,twitter,facebook,github,unlock,credit-card,rss,hdd,bullhorn,bell,certificate,
hand-right,hand-left,hand-up,hand-down,circle-arrow-left,circle-arrow-right,circle-arrow-up,circle-arrow-down,globe,
wrench,tasks,filter,briefcase,fullscreen,group,link,cloud,beaker,cut,copy,paperclip,paper-clip,save,sign-blank,
reorder,list-ul,list-ol,strikethrough,underline,table,magic,truck,pinterest,pinterest-sign,google-plus-sign,
google-plus,money,caret-down,caret-up,caret-left,caret-right,columns,sort,sort-down,sort-up,envelope,linkedin,
rotate-left,undo,legal,dashboard,comment-alt,comments-alt,bolt,sitemap,umbrella,paste,lightbulb,exchange,
cloud-download,cloud-upload,user-md,stethoscope,suitcase,bell-alt,coffee,food,file-text-alt,building,hospital,
ambulance,medkit,fighter-jet,beer,h-sign,plus-sign-alt,double-angle-left,double-angle-right,double-angle-up,
double-angle-down,angle-left,angle-right,angle-up,angle-down,desktop,laptop,tablet,mobile-phone,circle-blank,
quote-left,quote-right,spinner,circle,mail-reply,reply,github-alt,folder-close-alt,folder-open-alt,expand-alt,
collapse-alt,smile,frown,meh,gamepad,keyboard,flag-alt,flag-checkered,terminal,code,reply-all,mail-reply-all,
star-half-full,star-half-empty,location-arrow,,rinp,code-fork,unlink,question,minfo,exclamation,superscript,
subscript,eraser,puzzle-piece,mirinphone,,mirinphone-off,shield,calendar-empty,fire-extinguisher,rocket,maxcdn,
chevron-sign-left,chevron-sign-right,,chevron-sign-up,chevron-sign-down,html5,css3,anchor,unlock-alt,bullseye,
ellipsis-horizontal,,ellipsis-vertical,rss-sign,play-sign,ticket,minus-sign-alt,check-minus,level-up,level-down,
check-sign,edit-sign,external-link-sign,share-sign,compass,collapse,collapse-top,expand,euro,eur,gbp,dollar,usd,
rupee,inr,yen,jpy,renminbi,cny,won,krw,bitcoin,btc,file,file-text,sort-by-alphabet,sort-by-alphabet-alt,
sort-by-attributes,sort-by-attributes-alt,sort-by-order,sort-by-order-alt,thumbs-up,thumbs-down,youtube-sign,
youtube,xing,xing-sign,youtube-play,dropbox,stackexchange,instagram,flickr,adn,bitbucket,bitbucket-sign,tumblr,
tumblr-sign,long-arrow-down,long-arrow-up,long-arrow-left,long-arrow-right,apple,windows,android,linux,dribbble,
skype,foursquare,trello,female,male,gittip,sun,moon,archive,bug,vk,weibo,renren
	');
}
/**
 * Fonticon list
 *
 * @access public
 * @return void
 */
/**
 * Return a list of all gallery items for a post.
 *
 * @access public
 * @return void
 */
function rin_get_gallerylist($id) {
	$retarray = array();
	// if there's no valid post number return
	if (!is_numeric($id)) {return $retarray;}
	// get the gallery post content & match to regexes
	$gallery_content 	= get_post( $id );
	preg_match ('/'. get_shortcode_regex() .'/s', $gallery_content->post_content, $gallery_matches);
	// search for the gallery id's among all the strings of shortcodes and return only the ids.
	foreach ( $gallery_matches as $value ) {
		if ( strpos( $value, 'ids="' ) !== FALSE ){
			$subval = explode( " ", $value );
			foreach ( $subval as $vv ) {
				if ( strpos( $vv, 'ids="' ) !== FALSE ){
					$ids[] = $vv;
				}
			}
		}
	}
	// sort to make sure unique post id's are returned
	$result 		= implode( ",", array_unique($ids,SORT_NUMERIC) ) ;
	$result 		= explode(",",str_replace(array('ids="','"'), "", $result));
	$retarray 		= array_unique($result,SORT_NUMERIC) ;
	return $retarray;
}
function rinc_url($year, $month) {
		global $wp_rewrite;
		$year_month_value = $year . $month;
		$year_month_path = $year . "/" . $month;
		$url = home_url() . "/?m=" . $year_month_value . "&post_type=mediacast";
		if ($wp_rewrite->using_permalinks()) {
			$cat_pos = strpos($wp_rewrite->permalink_structure, "%mediacast%");
			if ($cat_pos != false) {
				// if %category% is in the permalink structure, figure out if year is before or after it
				$year_pos = strpos($wp_rewrite->permalink_structure, "%year%");
				if ($year_pos != false) {
					$url = home_url() . "/";
					if ($cat_pos < $year_pos) {
						$url .= "mediacast/" . $year_month_path . "/";
					} else {
						$url .=  $year_month_path . "/mediacast/";
					}
				}
			}
		}
		return ($url);
	}
// Default image links to none
function rin_default_noimagelink() {
	$rin_default_noimagelink = get_option( 'image_default_link_type' );
	if ( $rin_default_noimagelink !== 'none' ) {
		update_option( 'image_default_link_type', 'none' );
	}
}
add_action( 'admin_init', 'rin_default_noimagelink', 10 );

// img srcの記述を拾って画像を取得し表示する
function dtd_catch_content_img() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = isset($matches[1][0]) ? $matches[1][0] : '';
	if(empty($first_img)) {
		$first_img = 'none';
	}
	return $first_img;
}