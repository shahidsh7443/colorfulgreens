<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0
 */


$greenthumb_header_css = $greenthumb_header_image = '';
$greenthumb_header_video = greenthumb_get_header_video();
if (true || empty($greenthumb_header_video)) {
	$greenthumb_header_image = get_header_image();
	if (greenthumb_is_on(greenthumb_get_theme_option('header_image_override')) && apply_filters('greenthumb_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($greenthumb_cat_img = greenthumb_get_category_image()) != '')
				$greenthumb_header_image = $greenthumb_cat_img;
		} else if (is_singular() || greenthumb_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$greenthumb_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($greenthumb_header_image)) $greenthumb_header_image = $greenthumb_header_image[0];
			} else
				$greenthumb_header_image = '';
		}
	}
}

?><header class="top_panel top_panel_default default_header_bg<?php
					echo !empty($greenthumb_header_image) || !empty($greenthumb_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($greenthumb_header_video!='') echo ' with_bg_video';
					if ($greenthumb_header_image!='') echo ' '.esc_attr(greenthumb_add_inline_css_class('background-image: url('.esc_url($greenthumb_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (greenthumb_is_on(greenthumb_get_theme_option('header_fullheight'))) echo ' header_fullheight greenthumb-full-height';
					?> scheme_<?php echo esc_attr(greenthumb_is_inherit(greenthumb_get_theme_option('header_scheme')) 
													? greenthumb_get_theme_option('color_scheme') 
													: greenthumb_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($greenthumb_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (greenthumb_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

?></header>