<div class="front_page_section front_page_section_about<?php
			$greenthumb_scheme = greenthumb_get_theme_option('front_page_about_scheme');
			if (!greenthumb_is_inherit($greenthumb_scheme)) echo ' scheme_'.esc_attr($greenthumb_scheme);
			echo ' front_page_section_paddings_'.esc_attr(greenthumb_get_theme_option('front_page_about_paddings'));
		?>"<?php
		$greenthumb_css = '';
		$greenthumb_bg_image = greenthumb_get_theme_option('front_page_about_bg_image');
		if (!empty($greenthumb_bg_image)) 
			$greenthumb_css .= 'background-image: url('.esc_url(greenthumb_get_attachment_url($greenthumb_bg_image)).');';
		if (!empty($greenthumb_css))
			echo " style=\"{$greenthumb_css}\"";
?>><?php
	// Add anchor
	$greenthumb_anchor_icon = greenthumb_get_theme_option('front_page_about_anchor_icon');	
	$greenthumb_anchor_text = greenthumb_get_theme_option('front_page_about_anchor_text');	
	if ((!empty($greenthumb_anchor_icon) || !empty($greenthumb_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_about"'
										. (!empty($greenthumb_anchor_icon) ? ' icon="'.esc_attr($greenthumb_anchor_icon).'"' : '')
										. (!empty($greenthumb_anchor_text) ? ' title="'.esc_attr($greenthumb_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_about_inner<?php
			if (greenthumb_get_theme_option('front_page_about_fullheight'))
				echo ' greenthumb-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$greenthumb_css = '';
			$greenthumb_bg_mask = greenthumb_get_theme_option('front_page_about_bg_mask');
			$greenthumb_bg_color = greenthumb_get_theme_option('front_page_about_bg_color');
			if (!empty($greenthumb_bg_color) && $greenthumb_bg_mask > 0)
				$greenthumb_css .= 'background-color: '.esc_attr($greenthumb_bg_mask==1
																	? $greenthumb_bg_color
																	: greenthumb_hex2rgba($greenthumb_bg_color, $greenthumb_bg_mask)
																).';';
			if (!empty($greenthumb_css))
				echo " style=\"{$greenthumb_css}\"";
	?>>
		<div class="front_page_section_content_wrap front_page_section_about_content_wrap content_wrap">
			<?php
			// Caption
			$greenthumb_caption = greenthumb_get_theme_option('front_page_about_caption');
			if (!empty($greenthumb_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_about_caption front_page_block_<?php echo !empty($greenthumb_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post($greenthumb_caption); ?></h2><?php
			}
		
			// Description (text)
			$greenthumb_description = greenthumb_get_theme_option('front_page_about_description');
			if (!empty($greenthumb_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_about_description front_page_block_<?php echo !empty($greenthumb_description) ? 'filled' : 'empty'; ?>"><?php echo wpautop(wp_kses_post($greenthumb_description)); ?></div><?php
			}
			
			// Content
			$greenthumb_content = greenthumb_get_theme_option('front_page_about_content');
			if (!empty($greenthumb_content) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_content front_page_section_about_content front_page_block_<?php echo !empty($greenthumb_content) ? 'filled' : 'empty'; ?>"><?php
					$greenthumb_page_content_mask = '%%CONTENT%%';
					if (strpos($greenthumb_content, $greenthumb_page_content_mask) !== false) {
						$greenthumb_content = preg_replace(
									'/(\<p\>\s*)?'.$greenthumb_page_content_mask.'(\s*\<\/p\>)/i',
									sprintf('<div class="front_page_section_about_source">%s</div>',
												apply_filters('the_content', get_the_content())),
									$greenthumb_content
									);
					}
					greenthumb_show_layout($greenthumb_content);
				?></div><?php
			}
			?>
		</div>
	</div>
</div>