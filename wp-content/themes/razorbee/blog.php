<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the Visual Composer to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$greenthumb_content = '';
$greenthumb_blog_archive_mask = '%%CONTENT%%';
$greenthumb_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $greenthumb_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (($greenthumb_content = apply_filters('the_content', get_the_content())) != '') {
		if (($greenthumb_pos = strpos($greenthumb_content, $greenthumb_blog_archive_mask)) !== false) {
			$greenthumb_content = preg_replace('/(\<p\>\s*)?'.$greenthumb_blog_archive_mask.'(\s*\<\/p\>)/i', $greenthumb_blog_archive_subst, $greenthumb_content);
		} else
			$greenthumb_content .= $greenthumb_blog_archive_subst;
		$greenthumb_content = explode($greenthumb_blog_archive_mask, $greenthumb_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) greenthumb_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$greenthumb_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$greenthumb_args = greenthumb_query_add_posts_and_cats($greenthumb_args, '', greenthumb_get_theme_option('post_type'), greenthumb_get_theme_option('parent_cat'));
$greenthumb_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($greenthumb_page_number > 1) {
	$greenthumb_args['paged'] = $greenthumb_page_number;
	$greenthumb_args['ignore_sticky_posts'] = true;
}
$greenthumb_ppp = greenthumb_get_theme_option('posts_per_page');
if ((int) $greenthumb_ppp != 0)
	$greenthumb_args['posts_per_page'] = (int) $greenthumb_ppp;
// Make a new query
query_posts( $greenthumb_args );
// Set a new query as main WP Query
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

// Set query vars in the new query!
if (is_array($greenthumb_content) && count($greenthumb_content) == 2) {
	set_query_var('blog_archive_start', $greenthumb_content[0]);
	set_query_var('blog_archive_end', $greenthumb_content[1]);
}

get_template_part('index');
?>