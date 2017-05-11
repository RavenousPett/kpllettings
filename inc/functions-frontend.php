<?php

if ( ! function_exists( 'apustheme_post_tags' ) ) {
	function apustheme_post_tags() {
		$posttags = get_the_tags();
		if ( $posttags ) {
			echo '<span class="entry-tags-list"><strong><i class="fa fa-tags" aria-hidden="true"></i></strong>'.esc_html__('Tags: ','preston');
			$i = 1;
			$size = count( $posttags );
			foreach ( $posttags as $tag ) {
				echo '<a href="' . get_tag_link( $tag->term_id ) . '">';
				echo esc_attr($tag->name);
				echo '</a>';
				if ( $size != $i ) {
					echo ' , ';
				}
				$i ++;
			}
			echo '</span>';
		}
	}
}

if ( ! function_exists( 'apustheme_post_format_link_helper' ) ) {
	function apustheme_post_format_link_helper( $content = null, $title = null, $post = null ) {
		if ( ! $content ) {
			$post = get_post( $post );
			$title = $post->post_title;
			$content = $post->post_content;
		}
		$link = apustheme_get_first_url_from_string( $content );
		if ( ! empty( $link ) ) {
			$title = '<a href="' . esc_url( $link ) . '" rel="bookmark">' . $title . '</a>';
			$content = str_replace( $link, '', $content );
		} else {
			$pattern = '/^\<a[^>](.*?)>(.*?)<\/a>/i';
			preg_match( $pattern, $content, $link );
			if ( ! empty( $link[0] ) && ! empty( $link[2] ) ) {
				$title = $link[0];
				$content = str_replace( $link[0], '', $content );
			} elseif ( ! empty( $link[0] ) && ! empty( $link[1] ) ) {
				$atts = shortcode_parse_atts( $link[1] );
				$target = ( ! empty( $atts['target'] ) ) ? $atts['target'] : '_self';
				$title = ( ! empty( $atts['title'] ) ) ? $atts['title'] : $title;
				$title = '<a href="' . esc_url( $atts['href'] ) . '" rel="bookmark" target="' . $target . '">' . $title . '</a>';
				$content = str_replace( $link[0], '', $content );
			} else {
				$title = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $title . '</a>';
			}
		}
		$out['title'] = '<h2 class="entry-title">' . $title . '</h2>';
		$out['content'] = $content;

		return $out;
	}
}

if ( !function_exists('apustheme_get_page_title') ) {
	function apustheme_get_page_title() {
		$title = '';
		if ( !is_front_page() || is_paged() ) {
			global $post;
			$homeLink = esc_url( home_url() );

			if ( is_home() ) {
				$title = esc_html__( 'The Blogs', 'preston' );
			} elseif (is_category()) {
				global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$thisCat = $cat_obj->term_id;
				$thisCat = get_category($thisCat);
				$parentCat = get_category($thisCat->parent);
				$title = esc_html__( 'The Blogs', 'preston' );
			} elseif (is_day()) {
				$title = get_the_time('d');
			} elseif (is_month()) {
				$title = get_the_time('F');
			} elseif (is_year()) {
				$title = get_the_time('Y');
			} elseif (is_single() && !is_attachment()) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;

					$title = get_the_title();
				} else {
					$cat = get_the_category(); $cat = $cat[0];

					$title = esc_html__( 'The Blog', 'preston' );
				}
			} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
				$post_type = get_post_type_object(get_post_type());
				if (is_object($post_type)) {
					$title = $post_type->labels->singular_name;
				}
			} elseif (is_attachment()) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); $cat = $cat[0];
				$title = get_the_title();
			} elseif ( is_page() && !$post->post_parent ) {
				$title = get_the_title();
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<a href="' . esc_url( get_permalink($page->ID) ) . '">' . get_the_title($page->ID) . '</a></li>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				$title = get_the_title();
			} elseif ( is_search() ) {
				$title = esc_html__('Search results for "','preston')  . get_search_query();
			} elseif ( is_tag() ) {
				$title = esc_html__('Posts tagged "', 'preston'). single_tag_title('', false) . '"';
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				$title = esc_html__('Articles posted by ', 'preston') . $userdata->display_name;
			} elseif ( is_404() ) {
				$title = esc_html__('Error 404', 'preston');
			}
		}
		return $title;
	}
}
if ( ! function_exists( 'apustheme_breadcrumbs' ) ) {
	function apustheme_breadcrumbs() {

		$delimiter = ' ';
		$home = esc_html__('Home', 'preston');
		$before = '<li class="active">';
		$after = '</li>';
		
		if ( !is_front_page() || is_paged()) {
			global $post;
			$homeLink = esc_url( home_url() );

			
			echo '<ol class="breadcrumb">';
			echo '<li><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . '</li> ';

			if (is_category()) {
				global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$thisCat = $cat_obj->term_id;
				$thisCat = get_category($thisCat);
				$parentCat = get_category($thisCat->parent);
				if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
				echo trim($before) . single_cat_title('', false) . $after;
			} elseif (is_day()) {
				echo '<li><a href="' . esc_url( get_year_link(get_the_time('Y')) ) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
				echo '<li><a href="' . esc_url( get_month_link(get_the_time('Y'),get_the_time('m')) ) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
				echo trim($before) . get_the_time('d') . $after;
			} elseif (is_month()) {
				echo '<a href="' . esc_url( get_year_link(get_the_time('Y')) ) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
				echo trim($before) . get_the_time('F') . $after;
			} elseif (is_year()) {
				echo trim($before) . get_the_time('Y') . $after;
			} elseif (is_single() && !is_attachment()) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
					echo trim($before) . get_the_title() . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					echo '<li>'.get_category_parents($cat, TRUE, ' ' . $delimiter . ' ').'</li>';
					echo trim($before) . get_the_title() . $after;
				}
			} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
				$post_type = get_post_type_object(get_post_type());

				if (is_tax('amenities') || is_tax('locations') || is_tax('materials') || is_tax('property_types') || is_tax('statuses')) {
					global $wp_query;
					$cat_obj = $wp_query->get_queried_object();
					$thisCat = get_term($cat_obj->term_id);
					
					$parentCat = get_term($thisCat->parent);
					if ($thisCat->parent != 0) {
						echo '<li><a href="' . get_post_type_archive_link( 'property' ) . '">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
						echo '<li>'.get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ').'</li>';
					} else {
						echo '<li><a href="' . get_post_type_archive_link( 'property' ) . '">' . $post_type->labels->singular_name . '</a></li> ';
					}

				} elseif (is_object($post_type)) {
					echo trim($before) . $post_type->labels->singular_name . $after;
					$title = $post_type->labels->singular_name;
				}
			} elseif (is_attachment()) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); $cat = $cat[0];
				echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo '<li><a href="' . esc_url( get_permalink($parent) ) . '">' . $parent->post_title . '</a></li> ' . $delimiter . ' ';
				echo trim($before) . get_the_title() . $after;
			} elseif ( is_page() && !$post->post_parent ) {
				echo trim($before) . get_the_title() . $after;
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<li><a href="' . esc_url( get_permalink($page->ID) ) . '">' . get_the_title($page->ID) . '</a></li>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) {
					echo trim($crumb) . ' ' . $delimiter . ' ';
				}
				echo trim($before) . get_the_title() . $after;
			} elseif ( is_search() ) {
				echo trim($before) . esc_html__('Search results for "','preston')  . get_search_query() . '"' . $after;
			} elseif ( is_tag() ) {
				echo trim($before) . esc_html__('Posts tagged "', 'preston'). single_tag_title('', false) . '"' . $after;
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo trim($before) . esc_html__('Articles posted by ', 'preston') . $userdata->display_name . $after;
			} elseif ( is_404() ) {
				echo trim($before) . esc_html__('Error 404', 'preston') . $after;
			}

			echo '</ol>';
			
		}
	}
}

function apustheme_property_breadcrumbs() {
	$delimiter = ' ';
	$home = esc_html__('Home', 'preston');
	global $post;
	$homeLink = esc_url( home_url() );

	echo '<ol class="breadcrumb">';
		echo '<li><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . '</li> ';
		echo '<li><a href="'.get_post_type_archive_link( 'property' ).'">'.esc_html__( 'Property', 'preston' ).'</a> ' . $delimiter . '</li> ';
		
		
		$term_list = wp_get_post_terms(
			$post->ID,
			'property_types',
			array(
				"fields" => "all",
				'orderby' => 'parent',
			)
		);

		if ( ! empty( $term_list ) && ! is_wp_error( $term_list ) ) {
			$main_term = $term_list[0];
			$ancestors = get_ancestors( $main_term->term_id, 'property_types' );
			$ancestors = array_reverse( $ancestors );

			$count = 0;
			foreach ( $ancestors as $ancestor ) {
				$ancestor = get_term( $ancestor, 'property_types' );

				if ( ! is_wp_error( $ancestor ) && $ancestor ) {
					echo '<li><a href="' . esc_url( get_term_link( $ancestor ) ) . '">' . $ancestor->name . '</a>';
						echo trim($delimiter);
					echo '</li> ';
				}
				$count++;
			}
			echo '<li><a href="' . esc_url( get_term_link( $main_term ) ) . '">' . $main_term->name . '</a>';
			echo '</li> ';

		}
	echo '</ol>';
}

if ( ! function_exists( 'apustheme_render_breadcrumbs' ) ) {
	function apustheme_render_breadcrumbs() {
		global $post;

		$show = true;
		$style = array();
		if ( is_page() && is_object($post) ) {
			$show = get_post_meta( $post->ID, 'apus_page_show_breadcrumb', true );
			if ( $show == 'no' ) {
				return ''; 
			}
			$bgimage = get_post_meta( $post->ID, 'apus_page_breadcrumb_image', true );
			$bgcolor = get_post_meta( $post->ID, 'apus_page_breadcrumb_color', true );
			$style = array();
			if ( $bgcolor ) {
				$style[] = 'background-color:'.$bgcolor;
			}
			if ( $bgimage ) { 
				$style[] = 'background-image:url(\''.esc_url($bgimage).'\')';
			}

		} elseif ( is_singular('post') || is_category() || is_home() ) {
			$show = apustheme_get_config('show_blog_breadcrumbs', true);
			if ( !$show  ) {
				return ''; 
			}
			$breadcrumb_img = apustheme_get_config('blog_breadcrumb_image');
	        $breadcrumb_color = apustheme_get_config('blog_breadcrumb_color');
	        $style = array();
	        if ( $breadcrumb_color ) {
	            $style[] = 'background-color:'.$breadcrumb_color;
	        }
	        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
	            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
	        }
		} elseif ( is_singular('agent') || is_post_type_archive('agent') ) {
			$show = apustheme_get_config('show_agent_breadcrumbs', true);
			if ( !$show  ) {
				return ''; 
			}
			$breadcrumb_img = apustheme_get_config('agent_breadcrumb_image');
	        $breadcrumb_color = apustheme_get_config('agent_breadcrumb_color');
	        $style = array();
	        if ( $breadcrumb_color ) {
	            $style[] = 'background-color:'.$breadcrumb_color;
	        }
	        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
	            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
	        }
		} elseif ( is_singular('agency') || is_post_type_archive('agency') ) {
			$show = apustheme_get_config('show_agency_breadcrumbs', true);
			if ( !$show  ) {
				return ''; 
			}
			$breadcrumb_img = apustheme_get_config('agency_breadcrumb_image');
	        $breadcrumb_color = apustheme_get_config('agency_breadcrumb_color');
	        $style = array();
	        if ( $breadcrumb_color ) {
	            $style[] = 'background-color:'.$breadcrumb_color;
	        }
	        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
	            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
	        }
		}
		
		$estyle = !empty($style)? ' style="'.implode(";", $style).'"':"";

		echo '<section id="apus-breadscrumb" class="apus-breadscrumb"'.$estyle.'><div class="container"><div class="wrapper-breads"><div class="breadscrumb-inner">';
			apustheme_breadcrumbs();
			$title = apustheme_get_page_title();
			echo '<h2 class="bread-title">'.$title.'</h2>';
		echo '</div></div></div></section>';
	}
}

if ( ! function_exists( 'apustheme_render_idx_breadcrumbs' ) ) {
	function apustheme_render_idx_breadcrumbs() {
		global $post;

		$show = true;
		$style = array();

		$show = apustheme_get_config('show_page_idx_breadcrumbs', true);
		if ( !$show  ) {
			return ''; 
		}
		$breadcrumb_img = apustheme_get_config('page_idx_breadcrumb_image');
        $breadcrumb_color = apustheme_get_config('page_idx_breadcrumb_color');
        $style = array();
        if ( $breadcrumb_color ) {
            $style[] = 'background-color:'.$breadcrumb_color;
        }
        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
        }
		
		$estyle = !empty($style)? ' style="'.implode(";", $style).'"':"";

		echo '<section id="apus-breadscrumb" class="apus-breadscrumb"'.$estyle.'><div class="container"><div class="wrapper-breads"><div class="breadscrumb-inner">';
			$title = apustheme_get_page_title();
			echo '<h2 class="bread-title">'.$title.'</h2>';
		echo '</div></div></div></section>';
	}
}

if ( ! function_exists( 'apustheme_paging_nav' ) ) {
	function apustheme_paging_nav() {
		global $wp_query, $wp_rewrite;

		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $wp_query->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => esc_html__( '', 'preston' ),
			'next_text' => esc_html__( '', 'preston' ),
		) );

		if ( $links ) :

		?>
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="screen-reader-text hidden"><?php esc_html_e( 'Posts navigation', 'preston' ); ?></h1>
			<div class="apus-pagination">
				<?php echo trim($links); ?>
			</div><!-- .pagination -->
		</nav><!-- .navigation -->
		<?php
		endif;
	}
}

if ( ! function_exists( 'apustheme_post_nav' ) ) {
	function apustheme_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}

		?>
		<nav class="navigation post-navigation" role="navigation">
			<h3 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'preston' ); ?></h3>
			<div class="nav-links clearfix">
				<?php
				if ( is_attachment() ) :
					previous_post_link( '%link','<div class="col-lg-6"><span class="meta-nav">'. esc_html__('Published In', 'preston').'</span></div>');
				else :
					previous_post_link( '%link','<div class="pull-left"><span class="meta-nav">'. esc_html__('Previous Post', 'preston').'</span></div>' );
					next_post_link( '%link', '<div class="pull-right"><span class="meta-nav">' . esc_html__('Next Post', 'preston').'</span><span></span></div>');
				endif;
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}

if ( !function_exists('apustheme_pagination') ) {
    function apustheme_pagination($per_page, $total, $max_num_pages = '') {
    	global $wp_query, $wp_rewrite;
        ?>
        <div class="apus-pagination">
        	<?php
        	$prev = esc_html__('Previous','preston');
        	$next = esc_html__('Next','preston');
        	$pages = $max_num_pages;
        	$args = array('class'=>'pull-left');

        	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	        if ( empty($pages) ) {
	            global $wp_query;
	            $pages = $wp_query->max_num_pages;
	            if ( !$pages ) {
	                $pages = 1;
	            }
	        }
	        $pagination = array(
	            'base' => @add_query_arg('paged','%#%'),
	            'format' => '',
	            'total' => $pages,
	            'current' => $current,
	            'prev_text' => $prev,
	            'next_text' => $next,
	            'type' => 'array'
	        );

	        if( $wp_rewrite->using_permalinks() ) {
	            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
	        }
	        
	        if ( isset($_GET['s']) ) {
	            $cq = $_GET['s'];
	            $sq = str_replace(" ", "+", $cq);
	        }
	        
	        if ( !empty($wp_query->query_vars['s']) ) {
	            $pagination['add_args'] = array( 's' => $sq);
	        }
	        $paginations = paginate_links( $pagination );
	        if ( !empty($paginations) ) {
	            echo '<ul class="pagination '.esc_attr( $args["class"] ).'">';
	                foreach ($paginations as $key => $pg) {
	                    echo '<li>'. $pg .'</li>';
	                }
	            echo '</ul>';
	        }
        	?>
            
        </div>
    <?php
    }
}

if ( !function_exists('apustheme_comment_form') ) {
	function apustheme_comment_form($arg, $class = 'btn-theme ') {
		global $post;
		if ('open' == $post->comment_status) {
			ob_start();
	      	comment_form($arg);
	      	$form = ob_get_clean();
	      	?>
	      	<div class="commentform row reset-button-default">
		    	<div class="col-sm-12">
			    	<?php
			      	echo str_replace('id="submit"','id="submit" class="btn '.$class.'"', $form);
			      	?>
		      	</div>
	      	</div>
	      	<?php
	      }
	}
}

if (!function_exists('apustheme_list_comment') ) {
	function apustheme_list_comment($comment, $args, $depth) {
		if ( is_file(get_template_directory().'/list_comments.php') ) {
	        require get_template_directory().'/list_comments.php';
      	}
	}
}

function apustheme_display_footer_builder($footer) {
	global $footer_builder;
	$footer_builder = true;
	$args = array(
		'name'        => $footer,
		'post_type'   => 'apus_footer',
		'post_status' => 'publish',
		'numberposts' => 1
	);
	$posts = get_posts($args);

	foreach ( $posts as $post ) {
		$class = get_post_meta( $post->ID, 'apus_footer_style_class', true );
		echo '<div class="footer-builder-wrapper '. esc_attr($class) .'">';
		if (function_exists('kc_do_shortcode')) {
		    $raw_content = kc_raw_content($post->ID);
		    echo kc_do_shortcode($raw_content);
		} else {
		    echo do_shortcode ($post->post_content);
		}
		echo '</div>';
	}
	$footer_builder = false;
}

function apustheme_get_blog_item_style() {
	$item_style = apustheme_get_config('blog_item_style', 'grid');
	$item_style = !empty($item_style) ? $item_style : 'grid';
	return $item_style;
}

function apustheme_get_blogs_layout_type() {
	$layout = apustheme_get_config( 'blog_display_mode', 'grid' );
	$layout = !empty($layout) ? $layout : 'grid';
	return $layout;
}

function apustheme_get_blog_thumbsize() {
	$thumbsize = apustheme_get_config( 'blog_item_thumbsize', '' );
	return $thumbsize;
}

/*
 * create placeholder
 * var size: array( width, height )
 */
function apustheme_create_placeholder($size) {
	if ( class_exists('Apus_Create_Placeholder') ) {
		return Apus_Create_Placeholder::create($size);
	} else {
		return "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 ".$size[0]." ".$size[1]."'%2F%3E";
	}
}

function apustheme_display_image($img) {
	if ( !empty($img) && isset($img[0]) ) {
		if (apustheme_get_config('image_lazy_loading')) {
			$placeholder_image = apustheme_create_placeholder(array($img[1], $img[2]));
			?>
			<div class="image-wrapper">
				<img src="<?php echo trim($placeholder_image); ?>" data-src="<?php echo esc_url_raw($img[0]); ?>" alt="" class="unveil-image">
			</div>
			<?php
		} else {
			?>
			<div class="image-wrapper">
				<img src="<?php echo esc_url_raw($img[0]); ?>" alt="">
			</div>
			<?php
		}
	}
}
function apustheme_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'apustheme_comment_field_to_bottom' );

// block content
if ( !function_exists('apustheme_get_block_content_profiles') ) {
	function apustheme_get_block_content_profiles() {
		$args = array(
            'posts_per_page'   => -1,
            'post_type'        => 'apus_block_content',
            'post_status'      => 'publish'
        );
        $posts = get_posts( $args );
        $returns = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $returns[$post->post_name] = $post->post_title;
            }
        }
        return $returns;
	}
}

function apustheme_display_block_content($slug) {
	$args = array(
		'name'        => $slug,
		'post_type'   => 'apus_block_content',
		'post_status' => 'publish',
		'numberposts' => 1
	);
	$posts = get_posts($args);

	foreach ( $posts as $post ) {
		echo '<div class="block-content-wrapper">';
		if (function_exists('kc_do_shortcode')) {
		    $raw_content = kc_raw_content($post->ID);
		    echo kc_do_shortcode($raw_content);
		} else {
		    echo do_shortcode ($post->post_content);
		}
		echo '</div>';
	}
}