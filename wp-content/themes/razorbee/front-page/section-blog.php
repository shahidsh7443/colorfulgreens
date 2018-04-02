<div class="front_page_section front_page_section_blog<?php
			$greenthumb_scheme = greenthumb_get_theme_option('front_page_blog_scheme');
			if (!greenthumb_is_inherit($greenthumb_scheme)) echo ' scheme_'.esc_attr($greenthumb_scheme);
			echo ' front_page_section_paddings_'.esc_attr(greenthumb_get_theme_option('front_page_blog_paddings'));
		?>"<?php
		$greenthumb_css = '';
		$greenthumb_bg_image = greenthumb_get_theme_option('front_page_blog_bg_image');
		if (!empty($greenthumb_bg_image)) 
			$greenthumb_css .= 'background-image: url('.esc_url(greenthumb_get_attachment_url($greenthumb_bg_image)).');';
		if (!empty($greenthumb_css))
			echo " style=\"{$greenthumb_css}\"";
?>><?php
	// Add anchor
	$greenthumb_anchor_icon = greenthumb_get_theme_option('front_page_blog_anchor_icon');	
	$greenthumb_anchor_text = greenthumb_get_theme_option('front_page_blog_anchor_text');	
	if ((!empty($greenthumb_anchor_icon) || !empty($greenthumb_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_blog"'
										. (!empty($greenthumb_anchor_icon) ? ' icon="'.esc_attr($greenthumb_anchor_icon).'"' : '')
										. (!empty($greenthumb_anchor_text) ? ' title="'.esc_attr($greenthumb_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_blog_inner<?php
			if (greenthumb_get_theme_option('front_page_blog_fullheight'))
				echo ' greenthumb-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$greenthumb_css = '';
			$greenthumb_bg_mask = greenthumb_get_theme_option('front_page_blog_bg_mask');
			$greenthumb_bg_color = greenthumb_get_theme_option('front_page_blog_bg_color');
			if (!empty($greenthumb_bg_color) && $greenthumb_bg_mask > 0)
				$greenthumb_css .= 'background-color: '.esc_attr($greenthumb_bg_mask==1
																	? $greenthumb_bg_color
																	: greenthumb_hex2rgba($greenthumb_bg_color, $greenthumb_bg_mask)
																).';';
			if (!empty($greenthumb_css))
				echo " style=\"{$greenthumb_css}\"";
	?>>
		<div class="front_page_section_content_wrap front_page_section_blog_content_wrap content_wrap">
			<?php
			// Caption
			$greenthumb_caption = greenthumb_get_theme_option('front_page_blog_caption');
			if (!empty($greenthumb_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_blog_caption front_page_block_<?php echo !empty($greenthumb_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post($greenthumb_caption); ?></h2><?php
			}
		
			// Description (text)
			$greenthumb_description = greenthumb_get_theme_option('front_page_blog_description');
			if (!empty($greenthumb_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_blog_description front_page_block_<?php echo !empty($greenthumb_description) ? 'filled' : 'empty'; ?>"><?php echo wpautop(wp_kses_post($greenthumb_description)); ?></div><?php
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_blog_output"><?php 
				if (is_active_sidebar('front_page_blog_widgets')) {
					dynamic_sidebar( 'front_page_blog_widgets' );
				} else if (current_user_can( 'edit_theme_options' )) {
					if (!greenthumb_exists_trx_addons())
						greenthumb_customizer_need_trx_addons_message();
					else
						greenthumb_customizer_need_widgets_message('front_page_blog_caption', 'ThemeREX Addons - Blogger');
				}
			?></div>
		</div>
	</div>
</div>