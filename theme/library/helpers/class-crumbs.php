<?php

class NID_Crumbs {


	public static function crumbs( $options = array() ) {
		echo self::get_crumbs( $options );
	}


	
	public static function get_crumbs( $options = array() ) {
		$breadcrumbs_items = self::get_crumbs_array( $options );
		if ( ! $breadcrumbs_items || empty( $breadcrumbs_items ) ) {
			return '';
		}

		ob_start();
		?>
		<div class="row">
			<nav class="column" aria-label="あなたはここにいます!!" role="navigation">
				<ul class="breadcrumbs">
					<?php foreach ( $breadcrumbs_items as $item ) : ?>

						<li>
							<?php
								$classes = '';
								if ( $item['current'] ) {
									$classes .= 'current';
								}

								$tag   = 'span';
								$attrs = array( 'class' => $classes );
								if ( $item['link'] && '#' !== $item['link'] ) {
									$tag           = 'a';
									$attrs['href'] = $item['link'];
								}

								NID_Html::element( $tag, $attrs, $item['text'] );
							?>
						</li>

					<?php endforeach; ?>
				</ul>
			</nav>
		</div>

		<?php
		return ob_get_clean();
	}



	public static function get_crumbs_array( $options = array() ) {
		$clean_options = wp_parse_args( $options, array(
			'home_title'   => 'トップ'
		) );

		$current_item = self::get_current_crumb_item();
		$crumbs = array( $current_item );

		if ( 'single' === $current_item['type'] || 'page' === $current_item['type'] || 'taxonomy' === $current_item['type'] ) {
			$parents = self::get_parent_crumb_items( $current_item );
			if ( $parents ) $crumbs = array_merge( $parents, $crumbs );
		}

		if ( ! is_front_page() ) {
			array_unshift( $crumbs, self::job_crumb_item( 'home', home_url(), $clean_options['home_title'], array(
				'type' => 'home'
			) ) );
		}

		return apply_filters( 'NID_crumbs_array', $crumbs, $options );
	}



	public static function get_parent_crumb_items( $current_item ) {
		global $post;
		$crumbs = array();

		switch ( $current_item['type'] ) :
			case 'single':
				$post_type = get_post_type( $post->ID );
				// POST
				if ( 'post' === $post_type ) {
					
					// 本体サイト用トピックスリンク
					$crumbs[] = self::job_crumb_item(
						'544',
						get_page_link( '544' ),
						get_the_title( '544' )
					);
					
					// カテゴリーを表示
					$categories = get_the_category( $post->ID );
					$cat = self::get_youngest_cat( $categories );
					if ( 0 !== $cat->parent ) {
						$ancestors = array_reverse( get_ancestors( $cat->cat_id, 'category' ) );
						foreach ( $ancestors as $ancestor ) {
							$crumbs[] = self::job_crumb_item(
								$ancestor,
								get_category_link( $ancestor ),
								get_cat_name( $ancestor )
							);
						}
					}
					$crumbs[] = self::job_crumb_item(
						$cat->cat_id,
						get_category_link( $cat->cat_id ),
						get_cat_name( $cat->cat_id )
					);

				// カスタム投稿タイプ
				} else {
					// カスタム投稿アーカイブ
					$crumbs[] = self::job_crumb_item(
						$post_type,
						get_post_type_archive_link( $post_type ),
						get_post_type_object( $post_type )->label
					);

					$taxonomy = get_object_taxonomies( $post_type )[0];
					$taxes = get_the_terms( $post->ID, $taxonomy );
					$tax = self::get_youngest_tax( $taxes, $taxonomy );
					if ( 0 !== $tax->parent ) {
						$ancestors = array_reverse( get_ancestors( $tax->term_id, $taxonomy ) );
						foreach ( $ancestors as $ancestor ) {
							$crumbs[] = self::job_crumb_item(
								$ancestor,
								get_term_link( $ancestor, $taxonomy ),
								get_term( $ancestor, $taxonomy )
							);
						}
					}
					$crumbs[] = self::job_crumb_item(
						$tax->term_id,
						get_term_link( $tax, $taxonomy ),
						$tax->name
					);
				}
				return $crumbs;
				break;

			case 'taxonomy':
				$is_taxonomy = get_queried_object( 'taxonomy' );
				$cpt = get_query_var( 'taxonomy' );
				if ( 'category' !== $is_taxonomy->taxonomy ) {
					$taxonomy = get_queried_object();
					$post_types = get_taxonomy( $cpt )->object_type;
					$post_type = $post_types[0];

					// カスタム投稿アーカイブ
					$crumbs[] = self::job_crumb_item(
						$post_type,
						get_post_type_archive_link( $post_type ),
						get_post_type_object( $post_type )->label
					);

					// 親があれば表示
					if ( 0 !== $taxonomy->parent ) {
						$ancestors = array_reverce( get_ancestors( $taxonomy->term_id, $taxonomy->taxonomy ) );
						foreach ( $ancestors as $ancestor ) {
							$crumbs[] = self::job_crumb_item(
								$ancestor,
								get_term_link( $ancestor, $taxonomy ),
								get_term( $ancestor, $taxonomy )
							);
						}
					}
					return $crumbs;
				} else {
					// 本体サイト用トピックスリンク
					$crumbs[] = self::job_crumb_item(
						'544',
						get_page_link( '544' ),
						get_the_title( '544' )
					);
					
					// カテゴリーを表示
					$cat = get_queried_object();
					if ( 0 !== $cat->parent ) {
						$ancestors = array_reverse( get_ancestors( $cat->cat_id, 'category' ) );
						foreach ( $ancestors as $ancestor ) {
							$crumbs[] = self::job_crumb_item(
								$ancestor,
								get_category_link( $ancestor ),
								get_cat_name( $ancestor )
							);
						}
					}
					return $crumbs;
				}
				break;
			
			case 'page':
				if ( 0 !== $post->post_parent ) {
					$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
					foreach ( $ancestors as $ancestor ) {
						$crumbs[] = self::job_crumb_item(
							$ancestor,
							get_permalink( $ancestor ),
							get_the_title( $ancestor )
						);
					}
				}
				return $crumbs;
				break;

			endswitch;
	}


	public static function get_youngest_cat( $categories ) {
		if ( 1 === count( $categories ) ) {
			$youngest = $categories[0];
		} else {
			$count = 0;
			foreach ( $categories as $category ) {
				$children = get_term_children( $category->term_id, 'category' );
				if ( $children ) {
					if ( $count < count( $children ) ) {
						$count = $count( $children );
						$lot_children = $children;
						foreach ( $lot_children as $child ) {
							if ( in_category( $child, $post->ID ) ) {
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


	public static function get_youngest_tax( $taxes, $taxonomy ) {
		if ( 1 === count( $taxes ) ) {
			$youngest = $taxes[key($taxes)];
		} else {
			$count = 0;
			foreach ( $taxes as $tax ) {
				$children = get_term_children( $tax->term_id, $taxonomy );
				if ( $children ) {
					if ( $count < count( $children ) ) {
						$count = $count( $children );
						$lot_children = $children;
						foreach ( $lot_children as $child ) {
							if ( is_object_in_term( $post->ID, $taxonomy ) ) {
								$youngest = get_term( $child, $taxonomy );
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


	public static function get_current_crumb_item() {
		$item_id = $type = $url = $title = false;

		if ( is_search() ) {
			$url     = get_search_link();
			$title   = '「' . wp_specialchars( $s, 1 ) . '」で検索した結果';
			$type    = 'search';

		} else if ( is_author() ) {
			/* @var $user WP_User */
			$user    = get_queried_object();

			$item_id = $user->ID;
			$url     = get_author_posts_url( $user->ID );
			$title   = $user->display_name;
			$type    = 'author';

		} else if ( is_post_type_archive() ) {
			$item_id = get_post_type();
			$url     = get_post_type_archive_link( $item_id );
			$title   = post_type_archive_title( '', false );
			$type    = 'archive';

		} else if ( is_archive() ) {
			$term    = get_queried_object();

			$item_id = $term->term_id;
			$url     = get_term_link( $item_id, $term->taxonomy );
			$title   = single_term_title( '', false );
			$type    = 'taxonomy';

		} else if ( is_single() ) {
			$item_id = get_the_ID();
			$url     = get_permalink();
			$title   = get_the_title();
			$type    = 'single';

		} else if ( is_page() ) {
			$item_id = get_the_ID();
			$url     = get_permalink();
			$title   = get_the_title();
			$type    = 'page';
		}

		return self::job_crumb_item( $item_id, $url, $title, array(
			'current' => true,
			'type'    => $type
		) );
	}


	/**
	 * Return a single normalized
	 * breadcrumb properties array
	 *
	 * @param string $item_id
	 * @param string $link
	 * @param string $text
	 * @param array  $flags
	 *
	 * @return array
	 */
	protected static function job_crumb_item( $item_id, $link, $text, $flags = array() ) {
		$flags = wp_parse_args( $flags, array(
			'current'   => true,
			'parent'    => true,
			'type'      => true
		) );

		return array_merge( array(
			'id'   => $item_id,
			'link' => $link,
			'text' => $text,
		), $flags );
	}
}
