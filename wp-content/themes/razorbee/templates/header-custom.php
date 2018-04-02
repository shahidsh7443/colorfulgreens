<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0.06
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

$greenthumb_header_id = str_replace('header-custom-', '', greenthumb_get_theme_option("header_style"));
if ((int) $greenthumb_header_id == 0) {
	$greenthumb_header_id = greenthumb_get_post_id(array(
												'name' => $greenthumb_header_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUT_PT') ? TRX_ADDONS_CPT_LAYOUT_PT : 'cpt_layouts'
												)
											);
} else {
	$greenthumb_header_id = apply_filters('greenthumb_filter_get_translated_layout', $greenthumb_header_id);
}
$greenthumb_header_meta = get_post_meta($greenthumb_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($greenthumb_header_id); 
				?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($greenthumb_header_id)));
				echo !empty($greenthumb_header_image) || !empty($greenthumb_header_video) 
					? ' with_bg_image' 
					: ' without_bg_image';
				if ($greenthumb_header_video!='') 
					echo ' with_bg_video';
				if ($greenthumb_header_image!='') 
					echo ' '.esc_attr(greenthumb_add_inline_css_class('background-image: url('.esc_url($greenthumb_header_image).');'));
				if (!empty($greenthumb_header_meta['margin']) != '') 
					echo ' '.esc_attr(greenthumb_add_inline_css_class('margin-bottom: '.esc_attr(greenthumb_prepare_css_value($greenthumb_header_meta['margin'])).';'));
				if (is_single() && has_post_thumbnail()) 
					echo ' with_featured_image';
				if (greenthumb_is_on(greenthumb_get_theme_option('header_fullheight'))) 
					echo ' header_fullheight greenthumb-full-height';
				?> scheme_<?php echo esc_attr(greenthumb_is_inherit(greenthumb_get_theme_option('header_scheme')) 
												? greenthumb_get_theme_option('color_scheme') 
												: greenthumb_get_theme_option('header_scheme'));
				?>"><?php

	// Background video
	if (!empty($greenthumb_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('greenthumb_action_show_layout', $greenthumb_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>