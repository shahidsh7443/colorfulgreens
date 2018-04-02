<?php
/**
 * WP tags and utils
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0
 */

// Theme init
if (!function_exists('greenthumb_wp_theme_setup')) {
	add_action( 'after_setup_theme', 'greenthumb_wp_theme_setup' );
	function greenthumb_wp_theme_setup() {

		// Remove macros from title
		add_filter('wp_title',						'greenthumb_wp_title');
		add_filter('wp_title_parts',				'greenthumb_wp_title');
		add_filter('document_title_parts',			'greenthumb_wp_title');

		// Breadcrumbs link 'All posts'
		add_filter('post_type_archive_link',		'greenthumb_get_template_page_link', 10, 2);
		
		// Comment form fields order
		add_filter('comment_form_fields',			'greenthumb_comment_form_fields');
	}
}


/* Blog utilities
-------------------------------------------------------------------------------- */

// Detect current blog mode to get correspond options (post | page | search | blog | front)
if (!function_exists('greenthumb_detect_blog_mode')) {
	function greenthumb_detect_blog_mode() {
		if (is_front_page())
			$mode = 'front';
		else if (is_single())
			$mode = 'post';
		else if (is_page() && !greenthumb_storage_isset('blog_archive'))
			$mode = 'page';
		else
			$mode = 'blog';
		return apply_filters('greenthumb_filter_detect_blog_mode', $mode);
	}
}
	
// Return ID of the post/page
if (!function_exists('greenthumb_get_post_id')) {
	function greenthumb_get_post_id($args=array()) {
		$args = array_merge(array(
			'posts_per_page' => 1
		), $args);
		$id = 0;
		$query = new WP_Query( $args );
		while ( $query->have_posts() ) { $query->the_post();
			$id = get_the_ID();
			break;
		}
		wp_reset_postdata();
		return $id;
	}
}
	
// Return ID for the page with specified template
if (!function_exists('greenthumb_get_template_page_id')) {
	function greenthumb_get_template_page_id($args=array()) {
		$args = array_merge(array(
			'template' => 'blog.php',
			'post_type' => 'post'
		), $args);
		$q_args = array(
			'post_type' => 'page',
			'post_status' => 'publish',
			'posts_per_page' => 1,
			'meta_query' => array('relation' => 'AND')
			);
		if (!empty($args['template'])) {
			$q_args['meta_query'][] = array(
				'key' => '_wp_page_template',
				'value' => $args['template'],
				'compare' => '='
			);
		}
		if (!empty($args['post_type'])) {
			$q_args['meta_query'][] = array(
				'key' => 'greenthumb_options_post_type',
				'value' => $args['post_type'],
				'compare' => '='
			);
		}
		$q_args['meta_query'][] = array(
			'key' => 'greenthumb_options_parent_cat',
			'value' => 1,
			'compare' => '<'
		);
		return greenthumb_get_post_id($q_args);
	}
}

// Return link to the page with theme specific $post_type archive template page:
// page_template == blog.php and 'post_type'== $post_type and 'parent_cat' == 0
if ( !function_exists( 'greenthumb_get_template_page_link' ) ) {
	//Handler of the add_filter('post_type_archive_link', 'greenthumb_get_template_page_link', 10, 2 );
	function greenthumb_get_template_page_link($link='', $post_type='') {
		if (!empty($post_type)) {
			$id = greenthumb_get_template_page_id(array('post_type'=>$post_type));
			if ($id > 0) $link = get_permalink($id);
		}
		return $link;
	}
}


// Return current site protocol
if (!function_exists('greenthumb_get_protocol')) {
	function greenthumb_get_protocol() {
		return is_ssl() ? 'https' : 'http';
	}
}

// Return internal page link - if is customize mode - full url else only hash part
if (!function_exists('greenthumb_get_hash_link')) {
	function greenthumb_get_hash_link($hash) {
		if (strpos($hash, 'http')!==0) {
			if ($hash[0]!='#') $hash = '#'.$hash;
			if (is_customize_preview()) {
				$url = greenthumb_get_current_url();
				if (($pos=strpos($url, '#'))!==false) $url = substr($url, 0, $pos);
				$hash = $url . $hash;
			}
		}
		return $hash;
	}
}

// Return URL to the current page
if (!function_exists('greenthumb_get_current_url')) {
	function greenthumb_get_current_url() {
		global $wp;
		// Attention! We don't need to process it with esc_url() 
		// since this url is being processed with esc_url() where it's used.
		return home_url(add_query_arg(array(), $wp->request));
	}
}

// Remove macros from the title
if ( !function_exists( 'greenthumb_wp_title' ) ) {
	// Handler of the add_filter( 'wp_title', 'greenthumb_wp_title');
	// Handler of the add_filter( 'wp_title_parts', 'greenthumb_wp_title');
	// Handler of the add_filter( 'document_title_parts', 'greenthumb_wp_title');
	function greenthumb_wp_title( $title ) {
		if (is_array($title)) {
			foreach ($title as $k=>$v)
				$title[$k] = greenthumb_remove_macros($v);
		} else
			$title = greenthumb_remove_macros($title);
		return $title;
	}
}

// Return blog title
if (!function_exists('greenthumb_get_blog_title')) {
	function greenthumb_get_blog_title() {

		if (is_front_page())
			$title = esc_html__( 'Home', 'greenthumb' );
		else if ( is_home() )
			$title = esc_html__( 'All Posts', 'greenthumb' );
		else if ( is_author() ) {
			$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
			$title = sprintf(esc_html__('Author page: %s', 'greenthumb'), $curauth->display_name);
		} else if ( is_404() )
			$title = esc_html__('URL not found', 'greenthumb');
		else if ( is_search() )
			$title = sprintf( esc_html__( 'Search: %s', 'greenthumb' ), get_search_query() );
		else if ( is_day() )
			$title = sprintf( esc_html__( 'Daily Archives: %s', 'greenthumb' ), get_the_date() );
		else if ( is_month() )
			$title = sprintf( esc_html__( 'Monthly Archives: %s', 'greenthumb' ), get_the_date( 'F Y' ) );
		else if ( is_year() )
			$title = sprintf( esc_html__( 'Yearly Archives: %s', 'greenthumb' ), get_the_date( 'Y' ) );
		 else if ( is_category() )
			$title = sprintf( esc_html__( '%s', 'greenthumb' ), single_cat_title( '', false ) );
		else if ( is_tag() )
			$title = sprintf( esc_html__( 'Tag: %s', 'greenthumb' ), single_tag_title( '', false ) );
		else if ( is_tax() )
			$title = sprintf( esc_html__( '%s', 'greenthumb' ), single_term_title( '', false ) );
		else if ( is_attachment() )
			$title = sprintf( esc_html__( 'Attachment: %s', 'greenthumb' ), get_the_title());
		else if ( is_single() || is_page() )
			$title = get_the_title();
		else
			$title = get_the_title();	//get_bloginfo('name', 'raw');
		return apply_filters('greenthumb_filter_get_blog_title', $title);
	}
}

// Comment form fields order
if ( !function_exists( 'greenthumb_comment_form_fields' ) ) {
	// Handler of the add_filter('comment_form_fields', 'greenthumb_comment_form_fields');
	function greenthumb_comment_form_fields($comment_fields) {
		if (greenthumb_get_theme_setting('comment_after_name')) {
			$keys = array_keys($comment_fields);
			if ($keys[0]=='comment') $comment_fields['comment'] = array_shift($comment_fields);
		}
		return $comment_fields;
	}
}

// Return nav menu html
if ( !function_exists( 'greenthumb_get_nav_menu' ) ) {
	function greenthumb_get_nav_menu($location='', $menu = '', $depth=11, $custom_walker=false) {
		static $list = array();
		if (is_array($location)) { $loc = $location; $location = ''; extract($loc); }
		$slug = $location.'_'.$menu;
		if (empty($list[$slug])) {
			$args = array(
					'menu'				=> empty($menu) || $menu=='default' || greenthumb_is_inherit($menu) ? '' : $menu,
					'container'			=> 'nav',
					'container_class'	=> (!empty($location) ? esc_attr($location) : 'menu_main') . '_nav_area' 
											. (!empty($class) ? ' '.esc_attr($class) : ''),
					'container_id'		=> '',
					'items_wrap'		=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'menu_class'		=> 'sc_layouts_menu_nav ' . (!empty($location) ? esc_attr($location) : 'menu_main') . '_nav',
					'menu_id'			=> (!empty($location) ? esc_attr($location) : 'menu_main'),
					'echo'				=> false,
					'fallback_cb'		=> '',
					'before'			=> '',
					'after'				=> '',
					'link_before'       => '<span>',
					'link_after'        => '</span>',
					'depth'             => $depth
					);
			if (!empty($location))
				$args['theme_location'] = $location;
			if ($custom_walker && class_exists('greenthumb_custom_menu_walker'))
				$args['walker'] = new greenthumb_custom_menu_walker;
			// Remove spaces between menu items
			$list[$slug] = preg_replace(array("/>[\r\n\s]*<li/", "/>[\r\n\s]*<\\/ul>/"),
										array("><li", "></ul>"),
										wp_nav_menu(apply_filters('greenthumb_filter_get_nav_menu_args', $args))
										);
			// Add Structured Data Snippet
			$list[$slug] = str_replace("<nav", '<nav itemscope itemtype="http://schema.org/SiteNavigationElement"', $list[$slug]);
		}
		return apply_filters('greenthumb_filter_get_nav_menu', $list[$slug], $location, $menu);
	}
}

// Return string with categories links
if (!function_exists('greenthumb_get_post_categories')) {
	function greenthumb_get_post_categories($delimiter=', ', $id=false) {
		$output = '';
		$categories = get_the_category($id);
		if ( !empty( $categories ) ) {
			foreach( $categories as $category )
				$output .= ($output ? $delimiter : '') . '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . sprintf( esc_attr__( 'View all posts in %s', 'greenthumb' ), $category->name ) . '">' . esc_html( $category->name ) . '</a>';
		}
		return $output;
	}
}

// Return string with terms links
if (!function_exists('greenthumb_get_post_terms')) {
	function greenthumb_get_post_terms($delimiter=', ', $id=false, $taxonomy='category') {
		$output = '';
		$terms = get_the_terms($id, $taxonomy);
		if ( !empty( $terms ) ) {
			foreach( $terms as $term )
				$output .= ($output ? $delimiter : '') . '<a href="' . esc_url( get_term_link( $term->term_id, $taxonomy ) ) . '" title="' . sprintf( esc_attr__( 'View all posts in %s', 'greenthumb' ), $term->name ) . '">' . esc_html( $term->name ) . '</a>';
		}
		return $output;
	}
}

// Return taxonomy for current post type
if ( !function_exists( 'greenthumb_get_post_type_taxonomy' ) ) {
	function greenthumb_get_post_type_taxonomy($post_type='') {
		if (empty($post_type)) $post_type = get_post_type();
		return $post_type == 'post' ? 'category' : apply_filters( 'greenthumb_filter_post_type_taxonomy',	'', $post_type );
	}
}


/* Query manipulations
-------------------------------------------------------------------------------- */

// Add sorting parameter in query arguments
if (!function_exists('greenthumb_query_add_sort_order')) {
	function greenthumb_query_add_sort_order($args, $orderby='date', $order='desc') {
		if (!empty($orderby) && (empty($args['orderby']) || $orderby != 'none')) {
			$q = apply_filters('greenthumb_filter_query_sort_order', array(), $orderby, $order);
			$q['order'] = $order=='asc' ? 'asc' : 'desc';
			if (empty($q['orderby'])) {
				if ($orderby == 'none') {
					$q['orderby'] = 'none';
				} else if ($orderby == 'ID') {
					$q['orderby'] = 'ID';
				} else if ($orderby == 'comments') {
					$q['orderby'] = 'comment_count';
				} else if ($orderby == 'title' || $orderby == 'alpha') {
					$q['orderby'] = 'title';
				} else if ($orderby == 'rand' || $orderby == 'random')  {
					$q['orderby'] = 'rand';
				} else {
					$q['orderby'] = 'post_date';
				}
			}
			foreach ($q as $mk=>$mv) {
				if (is_array($args))
					$args[$mk] = $mv;
				else
					$args->set($mk, $mv);
			}
		}
		return $args;
	}
}

// Add post type and posts list or categories list in query arguments
if (!function_exists('greenthumb_query_add_posts_and_cats')) {
	function greenthumb_query_add_posts_and_cats($args, $ids='', $post_type='', $cat='', $taxonomy='') {
		if (!empty($ids)) {
			$args['post_type'] = empty($args['post_type']) 
									? (empty($post_type) ? array('post', 'page') : $post_type)
									: $args['post_type'];
			$args['post__in'] = explode(',', str_replace(' ', '', $ids));
			if (empty($args['orderby']) || $args['orderby'] == 'none') {
				$args['orderby'] = 'post__in';
				if (isset($args['order'])) unset($args['order']);
			}
		} else {
			$args['post_type'] = empty($args['post_type']) 
									? (empty($post_type) ? 'post' : $post_type)
									: $args['post_type'];
			$post_type = is_array($args['post_type']) ? $args['post_type'][0] : $args['post_type'];
			if (!empty($cat)) {
				$cats = !is_array($cat) ? explode(',', $cat) : $cat;
				if (empty($taxonomy)) 
					$taxonomy = greenthumb_get_post_type_taxonomy($post_type);
				if ($taxonomy == 'category') {				// Add standard categories
					if (is_array($cats) && count($cats) > 1) {
						$cats_ids = array();
						foreach($cats as $c) {
							$c = trim($c);
							if (empty($c)) continue;
							if ((int) $c == 0) {
								$cat_term = get_term_by( 'slug', $c, $taxonomy, OBJECT);
								if ($cat_term) $c = $cat_term->term_id;
							}
							if ($c==0) continue;
							$cats_ids[] = (int) $c;
							$children = get_categories( array(
								'type'                     => $post_type,
								'child_of'                 => $c,
								'hide_empty'               => 0,
								'hierarchical'             => 0,
								'taxonomy'                 => $taxonomy,
								'pad_counts'               => false
							));
							if (is_array($children) && count($children) > 0) {
								foreach($children as $c) {
									if (!in_array((int) $c->term_id, $cats_ids)) $cats_ids[] = (int) $c->term_id;
								}
							}
						}
						if (count($cats_ids) > 0) {
							$args['category__in'] = $cats_ids;
						}
					} else {
						if ((int) $cat > 0) 
							$args['cat'] = (int) $cat;
						else
							$args['category_name'] = $cat;
					}
				} else {									// Add custom taxonomies
					if (!isset($args['tax_query']))
						$args['tax_query'] = array();
					$args['tax_query']['relation'] = 'AND';
					$args['tax_query'][] = array(
						'taxonomy' => $taxonomy,
						'include_children' => true,
						'field'    => (int) $cats[0] > 0 ? 'id' : 'slug',
						'terms'    => $cats
					);
				}
			}
		}
		return $args;
	}
}

// Add filters (meta parameters) in query arguments
if (!function_exists('greenthumb_query_add_filters')) {
	function greenthumb_query_add_filters($args, $filters=false) {
		if (!empty($filters)) {
			if (!is_array($filters)) $filters = array($filters);
			foreach ($filters as $v) {
				$found = false;
				if ($v=='thumbs') {							// Filter with meta_query
					if (!isset($args['meta_query']))
						$args['meta_query'] = array();
					else {
						for ($i=0; $i<count($args['meta_query']); $i++) {
							if ($args['meta_query'][$i]['meta_filter'] == $v) {
								$found = true;
								break;
							}
						}
					}
					if (!$found) {
						$args['meta_query']['relation'] = 'AND';
						if ($v == 'thumbs') {
							$args['meta_query'][] = array(
								'meta_filter' => $v,
								'key' => '_thumbnail_id',
								'value' => false,
								'compare' => '!='
							);
						}
					}
				} else if (in_array($v, array('video', 'audio', 'gallery'))) {			// Filter with tax_query
					if (!isset($args['tax_query']))
						$args['tax_query'] = array();
					else {
						for ($i=0; $i<count($args['tax_query']); $i++) {
							if ($args['tax_query'][$i]['tax_filter'] == $v) {
								$found = true;
								break;
							}
						}
					}
					if (!$found) {
						$args['tax_query']['relation'] = 'AND';
						if ($v == 'video') {
							$args['tax_query'][] = array(
								'tax_filter' => $v,
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => array( 'post-format-video' )
							);
						} else if ($v == 'audio') {
							$args['tax_query'] = array(
								'tax_filter' => $v,
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => array( 'post-format-audio' )
							);
						} else if ($v == 'gallery') {
							$args['tax_query'] = array(
								'tax_filter' => $v,
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => array( 'post-format-gallery' )
							);
						}
					}
				}
			}
		}
		return $args;
	}
}



	
/* Widgets utils
------------------------------------------------------------------------------------- */

// Create widgets area
if (!function_exists('greenthumb_create_widgets_area')) {
	function greenthumb_create_widgets_area($name, $add_classes='') {
		$widgets_name = greenthumb_get_theme_option($name);
		if (!greenthumb_is_off($widgets_name) && is_active_sidebar($widgets_name)) { 
			greenthumb_storage_set('current_sidebar', $name);
			ob_start();
			dynamic_sidebar($widgets_name);
			$out = trim(ob_get_contents());
			ob_end_clean();
			if (!empty($out)) {
				$out = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $out);
				$need_columns = strpos($out, 'columns_wrap')===false;
				if ($need_columns) {
					$columns = min(3, max(1, substr_count($out, '<aside ')));
					$out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($columns).' widget ', $out);
				}
				?>
				<div class="<?php echo esc_attr($name); ?> <?php echo esc_attr($name); ?>_wrap widget_area">
					<div class="<?php echo esc_attr($name); ?>_inner <?php echo esc_attr($name); ?>_inner widget_area_inner">
						<?php
						do_action( 'greenthumb_action_before_sidebar' );
						greenthumb_show_layout($out,
										true==$need_columns ? '<div class="columns_wrap">' : '',
                                        true==$need_columns ? '</div>' : ''
                                        );
						do_action( 'greenthumb_action_after_sidebar' );
						?>
					</div> <!-- /.widget_area_inner -->
				</div> <!-- /.widget_area -->
				<?php
			}
		}
	}
}

// Check if sidebar present
if (!function_exists('greenthumb_sidebar_present')) {
	function greenthumb_sidebar_present() {
		global $wp_query;
		$sidebar_position = greenthumb_get_theme_option('sidebar_position');
		$sidebar_name = greenthumb_get_theme_option('sidebar_widgets');
		return apply_filters('greenthumb_filter_sidebar_present', 
					!greenthumb_is_off($sidebar_position) 
					&& !greenthumb_is_off($sidebar_name) 
					&& is_active_sidebar($sidebar_name)
					&& !is_404() 
					&& (!is_search() || $wp_query->found_posts > 0) 
					&& (!is_single() || greenthumb_is_off(greenthumb_get_theme_option('hide_sidebar_on_single'))) 
					);
	}
}



	
/* Inline styles and scripts
------------------------------------------------------------------------------------- */

// Add inline styles and return class for it
if (!function_exists('greenthumb_add_inline_css_class')) {
	function greenthumb_add_inline_css_class($css, $suffix='') {
		$class_name = sprintf('greenthumb_inline_%d', mt_rand());
		greenthumb_add_inline_css(sprintf('.%s%s{%s}', $class_name, !empty($suffix) ? ":{$suffix}" : '', $css));
		return $class_name;
	}
}

// Add inline styles
if (!function_exists('greenthumb_add_inline_css')) {
	function greenthumb_add_inline_css($css) {
		if (function_exists('trx_addons_add_inline_css'))
			trx_addons_add_inline_css($css);
		else
			greenthumb_storage_concat( 'inline_styles', $css );
	}
}

// Return inline styles
if (!function_exists('greenthumb_get_inline_css')) {
	function greenthumb_get_inline_css() {
		return greenthumb_storage_get('inline_styles');
	}
}



/* Date & Time
----------------------------------------------------------------------------------------------------- */

// Return post date
if (!function_exists('greenthumb_get_date')) {
	function greenthumb_get_date($dt='', $format='') {
		global $wp_query;
		if ($dt == '')
			$dt = get_the_time('U', $wp_query->current_post>=0 ? null : $wp_query->post->ID);
		if (date('U') - $dt > intval(greenthumb_get_theme_option('time_diff_before'))*24*3600)
			$dt = date($format=='' ? get_option('date_format') : $format, $dt);
		else
			$dt = sprintf( esc_html__('%s ago', 'greenthumb'), human_time_diff($dt) );
		return $dt;
	}
}



/* Structured Data
----------------------------------------------------------------------------------------------------- */

// Return markup schema
if (!function_exists('greenthumb_get_markup_schema')) {
	function greenthumb_get_markup_schema() {
	if (is_single())										// Is single post
		$type = "Article";
	else if (is_home() || is_archive() || is_category())	// Is blog home, archive or category
		$type = "Blog";
	else if(is_front_page())								// Is static front page
		$type = "Website";
	else													// Is a general page
		$type = 'WebPage';
	return $type;
	}
}
?>