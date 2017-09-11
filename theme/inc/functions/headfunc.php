<?php
//========================  Template Redirect ========================================================================//
if ( ! function_exists( 'dtdsh_get_header' ) ) :
function dtdsh_get_header() {
	require_once( TFUNC . 'title-and-desc.php' );
}
add_action( 'template_redirect', 'dtdsh_get_header', 99 );
endif;

//========================  Header周り ========================================================================//
if ( ! function_exists( 'dtdsh_header' ) ) :
function dtdsh_header() {
	ob_start();
	get_header();
	$head = ob_get_contents();
	ob_end_clean();
	$head = str_replace( "'", '"', $head );
	$head = str_replace( ' type="text/javascript"', '', $head );
	$head = str_replace( ' type="text/css"', '', $head );
	$head = str_replace( '" />', '">', $head );
	$head = dtdsh_html_format( $head, false );
	echo $head;
}
endif;

// Custom Menu Walker
class Top_Bar_Walker_Nav_Menu extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "\n" . '<ul class="submenu menu vertical is-dropdown-submenu" data-submenu role="menu">' . "\n";
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$classes = 'menu-item-' . $item->object_id;
		if ( ! empty( $item->classes ) ) {
			$classes .= in_array('menu-item-has-children',$item->classes) ? ' is-dropdown-submenu-parent opens-right' : '';
			$classes .= in_array('current-menu-item',$item->classes) ? ' active' : '';
		}
		$class_att = ! empty( $classes ) ? ' class="' . trim( $classes ) . '"' : '';
		if ( $depth ) {
			$output .= '<li' . $class_att . ' role="menuitem" data-is-click="false">';
		} else {
			$output .= '<li' . $class_att . ' role="menuitem">';
		}
		$attributes    = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes    .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target )  . '"' : '';
		$attributes    .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes    .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		$attributes    .= ' class="waves-effect"';
		$item_output   = $args->before;
		$item_output   .= '<a' . $attributes . '>';
		$item_output   .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output   .= '</a>';
		$item_output   .= $args->after;
		$output        .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
class Side_Nav_Walker_Nav_Menu extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "\n" . '<ul class="submenu menu vertical is-dropdown-submenu" data-submenu role="menu">' . "\n";
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$classes = 'menu-item-' . $item->object_id;
		if ( ! empty( $item->classes ) ) {
			$classes .= in_array('menu-item-has-children',$item->classes) ? ' is-dropdown-submenu-parent opens-right' : '';
			$classes .= in_array('current-menu-item',$item->classes) ? ' active' : '';
		}
		$class_att = ! empty( $classes ) ? ' class="' . trim( $classes ) . '"' : '';
		if ( $depth ) {
			$output .= '<li' . $class_att . ' role="menuitem" data-is-click="false">';
		} else {
			$output .= '<li' . $class_att . ' role="menuitem">';
		}
		$attributes    = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes    .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target )  . '"' : '';
		$attributes    .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes    .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		$attributes    .= ' class="waves-effect"';
		$item_output   = $args->before;
		$item_output   .= '<a' . $attributes . '>';
		$item_output   .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output   .= '</a>';
		$item_output   .= $args->after;
		$output        .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
/*
function dtdsh_scope_nav() {
	$menu_name = 'ringo-scopenav';
	$locations = get_nav_menu_locations();
	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	$menu_items = wp_get_nav_menu_items( $menu->term_id );
	foreach ( $menu_items as $key => $menu_item ) {
		$arrayScope[] = [
			'pv'    => get_post_meta( $menu_item->object_id, 'view', true ),
			'id'    => $menu_item->object_id,
			'title' => $menu_item->title,
			'url'   => $menu_item->url
		];
	}
	foreach ( (array) $arrayScope as $key => $value ) {
		$pv[$key] = $value['pv'];
	}
	array_multisort(  $pv, SORT_DESC, $arrayScope );
	$menu_list = '<ul class="menu-wrapper">';
	foreach ( (array) $arrayScope as $item => $val ) {
		$active = ( $val['id'] == get_the_ID() ) ? ' class="current-menu-item"' : '';
		$menu_list .= '<li' . $active . '>';
		$menu_list .= '<a href="' . $val['url'] . '" title="' . $val['title'] . '" class="waves-effect">' . $val['title'] . ' (' . $val['pv'] . ')</a>';
		$menu_list .= '</li>';
	}
	$menu_list .= '</ul>';
	echo $menu_list;
}
*/

// PW保護ページタイトルから「保護中：」を削除
if ( ! is_admin() ) {
	add_filter( 'protected_title_format', 'remove_protected' );
	function remove_protected( $title ) {
		return '%s';
	}
}

// PW記事のテキストを変更する
// add_filter( 'the_password_form', 'passpost_form_customize' );

// ソーシャルリンクのリスト
function dtdsh_get_sociallist() {
	$facebook = '<li class="social-item"><a class="color-facebook hover-bg-facebook" href="https://www.facebook.com/yamashitakolawoffice" target="_blank"><i class="fa fa-facebook"></i></a></li>';
	$googleplus = '<li class="social-item"><a class="hover-bg-googleplus color-googleplus" href="https://plus.google.com/118124010942091667362?hl=ja" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
	$youtube = '<li class="social-item"><a class="hover-bg-youtube color-youtube" href="https://www.youtube.com/channel/UCQepvNppunUj6BSQgAtbx1g" target="_blank"><i class="fa fa-youtube"></i></a></li>';
	echo '<ul class="social-box no-bullet clearfix">', $facebook, $googleplus, $youtube, '</ul>';
}

//========================  Breadcrumbs ========================================================================//
if ( ! function_exists( 'breadcrumbs' ) ) :
function breadcrumbs( $args = array() ){
	global $post;
	$str ='';
	$defaults = array(
		'id'         => 'breadcrumbs',
		'home'       => 'トップページ',
		'search'     => 'で検索した結果',
		'tag'        => 'タグ',
		'author'     => 'タグ',
		'notfound'   => 'ページがありません！',
		'liOption'   => 'itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"',
		'aOption'    => 'itemscope itemtype="http://schema.org/Thing" itemprop="item"',
		'spanOption' => 'itemprop="name"',
		'metaOption' => 'itemprop="position"',
	);
	$args = wp_parse_args( $args, $defaults );
	extract( $args, EXTR_SKIP );
	if ( ! is_front_page() && ! is_admin() ){
		$str .= '<ul class="' . $id . '" itemscope itemtype="http://schema.org/BreadcrumbList">';
		$str .= '<li ' . $liOption . '>';
		$str .= '<a href="' . DTDSH_HOME_URL . '" ' . $aOption . '><span ' . $spanOption . '>' . $home . '</span></a><meta ' . $metaOption . ' content="1"></li>';
		$my_taxonomy = get_query_var( 'taxonomy' );
		$cpt = get_query_var( 'post_type' );

		// カスタムタクソノミー
		if ( $my_taxonomy && is_tax( $my_taxonomy ) ) {
			$my_tax = get_queried_object();
			$post_types = get_taxonomy( $my_taxonomy )->object_type;
			$cpt = $post_types[0];
			$str .= '<li ' . $liOption . '><a href="' . get_post_type_archive_link( $cpt ) . '" ' . $aOption . '><span ' . $spanOption . '>' . get_post_type_object( $cpt )->label . '</span></a><meta ' . $metaOption . ' content="2"></li>';
			$count = 3;
			if ( $my_tax->parent != 0 ) {
				$ancestors = array_reverse( get_ancestors( $my_tax->term_id, $my_tax->taxonomy ) );
				$ancestor_Num = count( $ancestors );
				$count = $ancestor_Num + 2;
				while ( $count < $ancestor_Num + 3 ) {
					$str .= '<li ' . $liOption . '><a href="' . get_term_link( $ancestors[$count - 3], $my_tax->taxonomy ) . '" ' . $aOption . '><span ' . $spanOption . '>' . get_term( $ancestors[$count - 3], $my_tax->taxonomy )->name . '</span></a><meta ' . $metaOption . ' content="' . $count . '"></li>';
					$count++;
				}
			}
			$str .= '<li class="current hide-for-small-only" ' . $liOption . '><span ' . $spanOption . '>' . $my_tax->name . '</span><meta ' . $metaOption . ' content="' . $count . '"></li>';

		//カテゴリー - Archive
		} elseif ( is_category() ) {
			$cat = get_queried_object();
			$str .= '<li ' . $liOption . '><a href="' . DTDSH_HOME_URL . 'topics/" ' . $aOption . '><span ' . $spanOption . '>トピックス</span></a><meta ' . $metaOption . ' content="2"></li>';
			$count = 3;
			if ( $cat->parent != 0 ){
				$ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) );
				$ancestor_Num = count( $ancestors );
				$count = $ancestor_Num + 2;
				while ( $count < $ancestor_Num + 3 ) {
					$str .= '<li ' . $liOption . '><a href="' . get_category_link( $ancestors[$count - 3] ) . '" ' . $aOption . '><span ' . $spanOption . '>' . get_cat_name( $ancestors[$count - 3] ) . '</span></a><meta ' . $metaOption . ' content="' . $count . '"></li>';
					$count++;
				}
			}
			$str .= '<li class="current hide-for-small-only" ' . $liOption . '><span ' . $spanOption . '>' . $cat->name . '</span><meta ' . $metaOption . ' content="' . $count . '"></li>';

		//カスタム投稿 - Archive
		} elseif ( is_post_type_archive() ) {
			$cpt = get_query_var( 'post_type' );
			$str .= '<li class="current hide-for-small-only" ' . $liOption . '><span ' . $spanOption . '>' . get_post_type_object( $cpt )->label . '</span><meta ' . $metaOption . ' content="2"></li>';

		// メンバー - Single
		} elseif( is_singular( 'members' ) ) {
			$str .= '<li ' . $liOption . '><a ' . $aOption . ' href="' . get_page_link( '125' ) . '"><span ' . $spanOption . '>' . get_post_type_object( get_post_type() )->label . '</span></a><meta ' . $metaOption . ' content="2"></li><li class="current hide-for-small-only" ' . $liOption . '><span ' . $spanOption . '>' . $post->post_title . '</span><meta ' . $metaOption . ' content="3"></li>';

		// カスタム投稿 - Single
		} elseif ( $cpt && is_singular( $cpt ) ) {
			$taxes = get_object_taxonomies( $cpt );
			$mytax = $taxes[0];
			$str .= '<li ' . $liOption . '><a href="' . get_post_type_archive_link( $cpt ) . '" ' . $aOption . '><span ' . $spanOption . '>' . get_post_type_object( $cpt )->label . '</span></a><meta ' . $metaOption . ' content="2"></li>';
			$count = 3;
			if ( has_term( '', $mytax ) ) {
				$taxes = get_the_terms( $post->ID, $mytax );
				$tax = get_youngest_tax( $taxes, $mytax );
				if ( $tax->parent != 0 ) {
					$ancestors = array_reverse( get_ancestors( $tax->term_id, $mytax ) );
					$ancestor_Num = count( $ancestors );
					$count = $ancestor_Num + 2;
					while ( $count < $ancestor_Num + 3 ) {
						$str .= '<li ' . $liOption . '><a href="' . get_term_link( $ancestors[$count - 3], $mytax ) . '" ' . $aOption . '><span ' . $spanOption . '>' . get_term( $ancestors[$count - 3], $mytax )->name . '</span></a><meta ' . $metaOption . ' content="' . $count . '"></li>';
						$count++;
					}
				}
				$str .= '<li ' . $liOption . '><a href="' . get_term_link( $tax, $mytax ) . '" ' . $aOption . '><span ' . $spanOption . '>' . $tax->name . '</span></a><meta ' . $metaOption . ' content="' . $count . '"></li>';
				$count++;
			}
			$str .= '<li class="current hide-for-small-only" ' . $liOption . '><span ' . $spanOption . '>' . $post->post_title . '</span><meta ' . $metaOption . ' content="' . $count . '"></li>';
			
		// Single
		} elseif ( is_single() ) {
			$str .= '<li ' . $liOption . '><a href="' . DTDSH_HOME_URL . 'topics" ' . $aOption . '><span ' . $spanOption . '>トピックス</span></a><meta ' . $metaOption . ' content="2"></li>';
			$count = 3;
			if ( has_category() ) {
				$categories = get_the_category( $post->ID );
				$cat = get_youngest_cat( $categories );
				if ( $cat->parent != 0 ) {
					$ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) );
					$ancestor_Num = count( $ancestors );
					$count = $ancestor_Num + 2;
					while ( $count < $ancestor_Num + 3 ) {
						$str .= '<li ' . $liOption . '><a href="' . get_category_link( $ancestors[$count - 3] ) . '" ' . $aOption . '><span ' . $spanOption . '>' . get_cat_name( $ancestors[$count - 3] ) . '</span></a><meta ' . $metaOption . ' content="' . $count . '"></li>';
						$count++;
					}
				}
				$str .= '<li ' . $liOption . '><a href="' . get_category_link( $cat->term_id ) . '" ' . $aOption . '><span ' . $spanOption . '>' . $cat->cat_name . '</span></a><meta ' . $metaOption . ' content="' . $count . '"></li>';
				$count++;
			}
			$str.= '<li class="current hide-for-small-only" ' . $liOption . '><span ' . $spanOption . '>' . $post->post_title . '</span><meta ' . $metaOption . ' content="' . $count . '"></li>';
			
		// Page
		} elseif ( is_page() ) {
			$count = 2;
			if ( $post->post_parent != 0 ) {
				$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
				$ancestor_Num = count( $ancestors );
				$count = $ancestor_Num + 1;
				while ( $count < $ancestor_Num + 2 ) {
					$str .= '<li ' . $liOption . '><a href="' . get_permalink( $ancestors[$count - 2] ) . '" ' . $aOption . '><span ' . $spanOption . '>' . get_the_title( $ancestors[$count - 2] ) . '</span></a><meta ' . $metaOption . ' content="' . $count . '"></li>';
					$count++;
				}
			}
			$str .= '<li class="current hide-for-small-only" ' . $liOption . '><span ' . $spanOption . '>' . $post->post_title . '</span><meta ' . $metaOption . ' content="' . $count . '"></li>';

		// 日付 - Archive
		} elseif ( is_date() ) {
			$str .= '<li ' . $liOption . '><a href="' . DTDSH_HOME_URL . 'topics/" ' . $aOption . '><span ' . $spanOption . '>トピックス</span></a></li>';
			if ( get_query_var( 'day' ) != 0 ){
				$str .= '<li ' . $liOption . '><a href="'. get_year_link( get_query_var( 'year' ) ) . '" ' . $aOption . '><span ' . $spanOption . '>' . get_query_var( 'year' ) . '年</span></a><meta ' . $metaOption . ' content="2"></li>';
				$str .= '<li ' . $liOption . '><a href="' . get_month_link( get_query_var( 'year' ), get_query_var( 'monthnum' ) ) . '" ' . $aOption . '><span ' . $spanOption . '>'. get_query_var( 'monthnum' ) .'月</span></a><meta ' . $metaOption . ' content="3"></li>';
				$str .= '<li class="current hide-for-small-only" ' . $liOption . '><span ' . $spanOption . '>'. get_query_var( 'day' ) . '日</span><meta ' . $metaOption . ' content="4"></li>';
			} elseif ( get_query_var( 'monthnum' ) != 0 ) {
				$str .= '<li ' . $liOption . '><a href="' . get_year_link( get_query_var( 'year' ) ) . '" ' . $aOption . '><span ' . $spanOption . '>' . get_query_var( 'year' ) . '年</span></a><meta ' . $metaOption . ' content="2"></li>';
				$str .= '<li class="current hide-for-small-only" ' . $liOption . '><span ' . $spanOption . '>' . get_query_var( 'monthnum' ) . '月</span><meta ' . $metaOption . ' content="3"></li>';
			} else {
				$str .= '<li class="current hide-for-small-only" ' . $liOption . '><span ' . $spanOption . '>' . get_query_var( 'year' ) . '年</span><meta ' . $metaOption . ' content="2"></li>';
			}

		// 検索結果 - Search
		} elseif ( is_search() ) {
			$str .= '<li class="current hide-for-small-only" ' . $liOption . '><span ' . $spanOption . '>「' . get_search_query() . '」' . $search . '</span><meta ' . $metaOption . ' content="2"></li>';
		
		// 投稿者 - Archive
		} elseif ( is_author() ) {
			$str .= '<li class="current hide-for-small-only" ' . $liOption . '><span ' . $spanOption . '>' . $author . ' : ' . get_the_author_meta( 'display_name', get_query_var( 'author' ) ) . '</span><meta ' . $metaOption . ' content="2"></li>';

		// タグ - Archive
		} elseif ( is_tag() ) {
			$str .= '<li ' . $liOption . '><a href="' . DTDSH_HOME_URL . 'topics" ' . $aOption . '><span ' . $spanOption . '>トピックス</span></a><meta ' . $metaOption . ' content="2"></li>';
			$str .= '<li class="current hide-for-small-only" ' . $liOption . '><span ' . $spanOption . '>' . $tag . ' : ' . single_tag_title( '' , false ) . '</span><meta ' . $metaOption . ' content="3"></li>';
			
		// 添付ファイル - Archive
		} elseif ( is_attachment() ) {
			$str.= '<li class="current hide-for-small-only" ' . $liOption . '><span ' . $spanOption . '>' . $post->post_title . '</span><meta ' . $metaOption . ' content="2"></li>';
			
		// 404 Not Found
		} elseif ( is_404() ) {
			$str .= '<li class="current hide-for-small-only" ' . $liOption . '><span ' . $spanOption . '>' . $notfound . '</span><meta ' . $metaOption . ' content="2"></li>';
			
		// Home - Archive
		} elseif ( is_home() ) {
			$str .= '<li class="current hide-for-small-only" ' . $liOption . '><span ' . $spanOption . '>トピックス</span><meta ' . $metaOption . ' content="2"></li>';
			
		// Else
		} else{
			$str .= '<li class="current hide-for-small-only" ' . $liOption . '><span ' . $spanOption . '>' . wp_title( '', false ) . '</span><meta ' . $metaOption . ' content="2"></li>';
		}
		$str .= '</ul>';
	}
	echo $str;
}
endif;
if ( ! function_exists( 'get_youngest_cat' ) ) :
//一番下の階層のカテゴリーを返す関数
function get_youngest_cat( $categories ) {
	global $post;
	if ( count( $categories ) == 1 ) {
		$youngest = $categories[0];
	} else {
		$count = 0;
		foreach ( $categories as $category ) {
			$children = get_term_children( $category->term_id, 'category' );
			if ( $children ) {
				if ( $count < count( $children ) ) {
					$count = count( $children );
					$lot_children = $children;
					foreach( $lot_children as $child ) {
						if( in_category( $child, $post->ID ) ){
							$youngest = get_category( $child );
						}
					}
				}
			} else {
				$youngest = $category;
			}
		}
	}
	return $youngest;
}
endif;
if ( ! function_exists( 'get_youngest_tax' ) ) :
//一番下の階層のタクソノミーを返す関数
function get_youngest_tax( $taxes, $mytaxonomy ) {
	global $post;
	if( count( $taxes ) == 1 ) {
		$youngest = $taxes[key( $taxes )];
	} else {
		$count = 0;
		foreach ( $taxes as $tax ) {
			$children = get_term_children( $tax->term_id, $mytaxonomy );
			if( $children ) {
				if ( $count < count( $children ) ) {
					$count = count( $children );
					$lot_children = $children;
					foreach( $lot_children as $child ) {
						if ( is_object_in_term( $post->ID, $mytaxonomy ) ) {
							$youngest = get_term( $child, $mytaxonomy );
						}
					}
				}
			} else {
				$youngest = $tax;
			}
		}
	}
	return $youngest;
}
endif;


//========================  リッチスニペット ========================================================================//
add_action( 'wp_head', function() {
	$logo = TURI . 'assets/img/favicon30x30.png';
	if ( is_front_page() ) {
		echo '
<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "WebSite",
	"url": "', DTDSH_HOME_URL, '",
	"potentialAction": {
		"@type": "SearchAction",
		"target": "', DTDSH_HOME_URL, '?s={search_term_string}",
		"query-input": "required name=search_term_string"
	}
}
</script>
';
	}
	if ( is_single() ) {
		$excerpt = preg_replace( '#[\r|\n]#', '', strip_tags( get_the_excerpt() ) );
		$get_lawyer_check = get_post_meta( get_the_ID(), 'charge_lawyer', true );
		if ( has_post_thumbnail() ) {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		} elseif ( dtd_catch_content_img() !== 'none' ) {
			$image = dtd_catch_content_img();
		} else {
			$image = $logo;
		}
		if ( is_array( $get_lawyer_check ) ) {
			foreach ( $get_lawyer_check as $member ) {
				$post_status = get_post_status( $member );
				if ( 'publish' == $post_status ) {
					$authorName = get_the_title( $member );
					$authorImage = get_the_post_thumbnail( $member );
					break;
				}
			}
		} else {
			$authorName = 'none';
		}
		echo '
<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "NewsArticle",
	"mainEntityOfPage": {
		"@type": "WebPage",
		"@id": "', get_the_permalink(), '"
	},
	"headline": "', esc_js( get_the_title() ), '",
	"image": {
		"@type": "ImageObject",
		"url": "', $image, '",
		"width": "250",
		"height": "250"
	},
	"datePublished": "', get_the_date( DateTime::ATOM ), '",
	"dateModified": "', get_the_modified_date( DateTime::ATOM ), '",';
		if ( 'none' !== $authorName ) {
		echo '"author": { "@type": "Person", "name": "', esc_js( $authorName ), '" },';
	}
	echo '
	"publisher": {
		"@type": "Organization",
		"name": "', DTDSH_SITENAME, '",
		"telephone": "0120-7834-09",
		"email": "info@law-yamashita.com",
		"url": "', DTDSH_HOME_URL, '",
		"logo": {
			"@type": "ImageObject",
			"url": "', $logo, '",
			"width": 30,
			"height": 30
		},
		"sameAs": [
			"http://www.hiroshima-jiko.com",
			"http://www.hiroshima-rikon.com",
			"http://www.hiroshima-sozoku.com",
			"http://www.hiroshima-saimu.com",
			"http://www.hiroshima-keiji.com",
			"http://www.hiroshima-fudosan.com",
			"http://www.hiroshima-kigyo.com",
			"http://www.hiroshima-hasan.com",
			"http://www.hiroshima-rosai.com",
			"https://www.facebook.com/yamashitakolawoffice",
			"https://plus.google.com/118124010942091667362?hl=ja",
			"https://www.youtube.com/channel/UCQepvNppunUj6BSQgAtbx1g",
			"http://mbp-hiroshima.com/law-yamashita"
		]
	},
	"description": "', esc_js( $excerpt ), '"
}
</script>
';
	}
	echo '
<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "LocalBusiness",
	"name": "', DTDSH_SITENAME, '",
	"telephone": "0120-7834-09",
	"email": "info@law-yamashita.com",
	"openingHours": [
		"Mo-Fr 09:00-19:00",
		"Sa 10:00-17:00"
	],
	"url": "', DTDSH_HOME_URL, '",
	"logo": "', $logo, '",
	"sameAs": [
		"http://www.hiroshima-jiko.com",
		"http://www.hiroshima-rikon.com",
		"http://www.hiroshima-sozoku.com",
		"http://www.hiroshima-saimu.com",
		"http://www.hiroshima-keiji.com",
		"http://www.hiroshima-fudosan.com",
		"http://www.hiroshima-kigyo.com",
		"http://www.hiroshima-hasan.com",
		"http://www.hiroshima-rosai.com",
		"https://www.facebook.com/yamashitakolawoffice",
		"https://plus.google.com/118124010942091667362?hl=ja",
		"https://www.youtube.com/channel/UCQepvNppunUj6BSQgAtbx1g",
		"http://mbp-hiroshima.com/law-yamashita"
	]
}
</script>
';
});