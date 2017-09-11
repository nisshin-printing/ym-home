<?php
// A function for parsing Vimeo and Youtube Video's
function dtdsh_parsevideo( $string, $type ) {
$matches 	= array();
$ipart1 	= 'ifr';
$ipart2 	= $ipart1 . 'ame';
// large regex to identify youtube videos
$youtubestring = '~								# Match Youtube link and embed code
(?: 								# Group to match embed codes
(?:<' .  $ipart2  . ' [^>]*src=")?	# If iframe match up to first quote of src
	|(?:				 				# Group to match if older embed
	(?:<object .*>)?					# Match opening Object tag
	(?:<param .*</param>)*				# Match all param tags
	(?:<embed [^>]*src=")?				# Match embed tag to the first quote of src
	)?									# End older embed code group
	)?									# End embed code groups
	(?:									# Group youtube url
	https?:\/\/		         			# Either http or https
	(?:[\w]+\.)*		        		# Optional subdomains
	(?:               	        		# Group host alternatives.
	youtu\.be/      	        		# Either youtu.be,
	| youtube\.com		 				# or youtube.com
	| youtube-nocookie\.com	 			# or youtube-nocookie.com
	)				 					# End Host Group
	(?:\S*[^\w\-\s])?       			# Extra stuff up to VIDEO_ID
	([\w\-]{11})		        		# $1: VIDEO_ID is numeric
	[^\s]*								# Not a space
	)				 					# End group
	"?				 					# Match end quote if part of src
	(?:[^>]*>)?			 				# Match any extra stuff up to close brace
	(?:				 					# Group to match last embed code
	</' .  $ipart2  . '>		        # Match the end of the iframe
	|</embed></object>	        		# or Match the end of the older embed
)?				 					# End Group of last bit of embed code
~ix';
// large regex to identify vimeo videos
$vimeostring = '~  								# Match Vimeo link and embed code
(?:<' .  $ipart2  . ' [^>]*src=")? 	# If iframe match up to first quote of src
	(?:									# Group vimeo url
	https?:\/\/							# Either http or https
	(?:[\w]+\.)*						# Optional subdomains
	vimeo\.com							# Match vimeo.com
	(?:[\/\w]*\/videos?)?				# Optional video sub directory this handles groups links also
	\/									# Slash before Id
	([0-9]+)							# $1: VIDEO_ID is numeric
	[^\s]*								# Not a space
	)									# End group
	"?									# Match end quote if part of src
	(?:[^>]*></' .  $ipart2  . '>)?		# Match the end of the iframe
(?:<p>.*</p>)?		        		# Match any title information stuff
~ix';
// return code for either youtube or vime obased on the regex result.
if ( $type  == 'youtube' ) {
preg_match( $youtubestring, $string, $matches );
} else {
preg_match( $vimeostring, $string, $matches );
}
return $matches;
}
// A function for identifying Vimeo and Youtube Video's amongst different link types
function dtdsh_identifyvideo( $url, $id = 0 ) {
// register the variables
$returninfo 	= $vinf = array();
$service 		= '';
$vidno 			= $url;
$ipart1 		= 'ifr';
$ipart2 		= $ipart1 . 'ame';
// QUICKLY DETERMINE WHICH TYPE OF SERVICE WE WILL NEED TO ACCESS.
if ( !is_numeric( $url ) ) {
$service 		= 'youtube';
if ( strpos( $url, 'vimeo' ) !== false ) {
$service 	= 'vimeo';
$vinf 		= dtdsh_parsevideo( $url, 'vimeo' );
} else {
$vinf 		= dtdsh_parsevideo( $url, 'youtube' );
}
} else {
$service 		= 'vimeo';
}
// extract the video number
if ( isset( $vinf[1] ) && $vinf != '' ) {
$vidno = $vinf[1];
}
if ( $vidno !== $id ) {
switch ( $service ) {
// setup an array for vimeo videos
case 'vimeo':
$response 		= wp_remote_get( esc_url_raw( 'http://vimeo.com/api/v2/video/' . $vidno . '.php' ), array( 'User-Agent' => 'wordpress' ) );
$response_code 	= wp_remote_retrieve_response_code( $response );
if ( 200 == $response_code ) {
$videoinfo 				= unserialize( wp_remote_retrieve_body( $response ) );
$returninfo['thumb'] 	=  $videoinfo[0]['thumbnail_large'];
$returninfo['id'] 		=  $vidno;
$returninfo['frame'] 	= '<' .  $ipart2  . ' src="http://player.vimeo.com/video/' .  $vidno . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="600" height="350" allowFullScreen></' .  $ipart2  . '>';
}
break;
// setup an array for youtube videos
case 'youtube':
$returninfo['thumb'] 	=  'http://img.youtube.com/vi/' . $vidno  . '/mqdefault.jpg';
$returninfo['id'] 		=  $vidno;
		$returninfo['frame'] 	= '<' .  $ipart2  . ' width="600" height="250" src="https://www.youtube.com/embed/' . $vidno . '?rel=0" framebordoer="0" allowfullscreen></' .  $ipart2  . '>';
break;
}
// return the array for the video
return $returninfo;
} else {
return '';
}
}
// RevealのIDを自動生成
function dtdsh_randstring( $length, $charset = 'abcdefghijklmnopqrstuvwxyz' ) {
	$str = '';
	$count = strlen( $charset );
	while ( $length-- ) {
		$str .= $charset[mt_rand( 0, $count - 1 )];
	}
	return $str;
}


// ビデオのサムネイルとRevealを返す関数
function dtdsh_videoThumbnail_return( $url ) {
	$video = $url;
	$tturi = dtdsh_identifyvideo( $video );
	$randomstring = dtdsh_randstring(4);
	$thumb = $tturi['thumb'];
	$frame = $tturi['frame'];
	$html = '<div class="row"><div class="column medium-6 text-center"><a class="c-video-reveal title="動画を再生する" data-open="' . $randomstring . '"><img src="' . $thumb . '" alt="Youtube動画のサムネイル画像"><i class="fa fa-play-circle-o"></i></a></div>
	<div class="reveal" id="' . $randomstring . '" data-reveal><div class="flex-video">' . $frame . '</div><button class="close-button" data-close type="button">&times;</button></div>';
	return $html;
}



// ショートコード
add_shortcode( 'video-thumbnail', 'shortcode_videoThumbnail' );
function shortcode_videoThumbnail( $atts ) {
	extract(
		shortcode_atts(
			array(
				'url' => '',
				'desc' => ''
			),
			$atts
		)
	);
	$html = dtdsh_videoThumbnail_return( $url );
	$html .= '<div class="column medium-6">' . $desc . '</div></div>';
	return $html;
}