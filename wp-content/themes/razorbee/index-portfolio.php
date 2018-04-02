<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0
 */

greenthumb_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'imagesloaded' );
wp_enqueue_script( 'masonry' );
wp_enqueue_script( 'classie', greenthumb_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'greenthumb-gallery-script', greenthumb_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$greenthumb_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$greenthumb_sticky_out = greenthumb_get_theme_option('sticky_style')=='columns' 
							&& is_array($greenthumb_stickies) && count($greenthumb_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$greenthumb_cat = greenthumb_get_theme_option('parent_cat');
	$greenthumb_post_type = greenthumb_get_theme_option('post_type');
	$greenthumb_taxonomy = greenthumb_get_post_type_taxonomy($greenthumb_post_type);
	$greenthumb_show_filters = greenthumb_get_theme_option('show_filters');
	$greenthumb_tabs = array();
	if (!greenthumb_is_off($greenthumb_show_filters)) {
		$greenthumb_args = array(
			'type'			=> $greenthumb_post_type,
			'child_of'		=> $greenthumb_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'number'		=> '',
			'taxonomy'		=> $greenthumb_taxonomy,
			'pad_counts'	=> false
		);
		$greenthumb_portfolio_list = get_terms($greenthumb_args);
		if (is_array($greenthumb_portfolio_list) && count($greenthumb_portfolio_list) > 0) {
			$greenthumb_tabs[$greenthumb_cat] = esc_html__('All', 'greenthumb');
			foreach ($greenthumb_portfolio_list as $greenthumb_term) {
				if (isset($greenthumb_term->term_id)) $greenthumb_tabs[$greenthumb_term->term_id] = $greenthumb_term->name;
			}
		}
	}
	if (count($greenthumb_tabs) > 0) {
		$greenthumb_portfolio_filters_ajax = true;
		$greenthumb_portfolio_filters_active = $greenthumb_cat;
		$greenthumb_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters greenthumb_tabs greenthumb_tabs_ajax">
			<ul class="portfolio_titles greenthumb_tabs_titles">
				<?php
				foreach ($greenthumb_tabs as $greenthumb_id=>$greenthumb_title) {
					?><li><a href="<?php echo esc_url(greenthumb_get_hash_link(sprintf('#%s_%s_content', $greenthumb_portfolio_filters_id, $greenthumb_id))); ?>" data-tab="<?php echo esc_attr($greenthumb_id); ?>"><?php echo esc_html($greenthumb_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$greenthumb_ppp = greenthumb_get_theme_option('posts_per_page');
			if (greenthumb_is_inherit($greenthumb_ppp)) $greenthumb_ppp = '';
			foreach ($greenthumb_tabs as $greenthumb_id=>$greenthumb_title) {
				$greenthumb_portfolio_need_content = $greenthumb_id==$greenthumb_portfolio_filters_active || !$greenthumb_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $greenthumb_portfolio_filters_id, $greenthumb_id)); ?>"
					class="portfolio_content greenthumb_tabs_content"
					data-blog-template="<?php echo esc_attr(greenthumb_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(greenthumb_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($greenthumb_ppp); ?>"
					data-post-type="<?php echo esc_attr($greenthumb_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($greenthumb_taxonomy); ?>"
					data-cat="<?php echo esc_attr($greenthumb_id); ?>"
					data-parent-cat="<?php echo esc_attr($greenthumb_cat); ?>"
					data-need-content="<?php echo (false===$greenthumb_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($greenthumb_portfolio_need_content) 
						greenthumb_show_portfolio_posts(array(
							'cat' => $greenthumb_id,
							'parent_cat' => $greenthumb_cat,
							'taxonomy' => $greenthumb_taxonomy,
							'post_type' => $greenthumb_post_type,
							'page' => 1,
							'sticky' => $greenthumb_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		greenthumb_show_portfolio_posts(array(
			'cat' => $greenthumb_cat,
			'parent_cat' => $greenthumb_cat,
			'taxonomy' => $greenthumb_taxonomy,
			'post_type' => $greenthumb_post_type,
			'page' => 1,
			'sticky' => $greenthumb_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>