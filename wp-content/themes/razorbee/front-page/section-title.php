<?php
if (($greenthumb_slider_sc = greenthumb_get_theme_option('front_page_title_shortcode')) != '' && strpos($greenthumb_slider_sc, '[')!==false && strpos($greenthumb_slider_sc, ']')!==false) {

	?><div class="front_page_section front_page_section_title front_page_section_slider front_page_section_title_slider"><?php
		// Add anchor
		$greenthumb_anchor_icon = greenthumb_get_theme_option('front_page_title_anchor_icon');	
		$greenthumb_anchor_text = greenthumb_get_theme_option('front_page_title_anchor_text');	
		if ((!empty($greenthumb_anchor_icon) || !empty($greenthumb_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
			echo do_shortcode('[trx_sc_anchor id="front_page_section_title"'
											. (!empty($greenthumb_anchor_icon) ? ' icon="'.esc_attr($greenthumb_anchor_icon).'"' : '')
											. (!empty($greenthumb_anchor_text) ? ' title="'.esc_attr($greenthumb_anchor_text).'"' : '')
											. ']');
		}
		// Show slider (or any other content, generated by shortcode)
		echo do_shortcode($greenthumb_slider_sc);
	?></div><?php

} else {

	?><div class="front_page_section front_page_section_title<?php
				$greenthumb_scheme = greenthumb_get_theme_option('front_page_title_scheme');
				if (!greenthumb_is_inherit($greenthumb_scheme)) echo ' scheme_'.esc_attr($greenthumb_scheme);
				echo ' front_page_section_paddings_'.esc_attr(greenthumb_get_theme_option('front_page_title_paddings'));
			?>"<?php
			$greenthumb_css = '';
			$greenthumb_bg_image = greenthumb_get_theme_option('front_page_title_bg_image');
			if (!empty($greenthumb_bg_image)) 
				$greenthumb_css .= 'background-image: url('.esc_url(greenthumb_get_attachment_url($greenthumb_bg_image)).');';
			if (!empty($greenthumb_css))
				echo " style=\"{$greenthumb_css}\"";
	?>><?php
		// Add anchor
		$greenthumb_anchor_icon = greenthumb_get_theme_option('front_page_title_anchor_icon');	
		$greenthumb_anchor_text = greenthumb_get_theme_option('front_page_title_anchor_text');	
		if ((!empty($greenthumb_anchor_icon) || !empty($greenthumb_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
			echo do_shortcode('[trx_sc_anchor id="front_page_section_title"'
											. (!empty($greenthumb_anchor_icon) ? ' icon="'.esc_attr($greenthumb_anchor_icon).'"' : '')
											. (!empty($greenthumb_anchor_text) ? ' title="'.esc_attr($greenthumb_anchor_text).'"' : '')
											. ']');
		}
		?>
		<div class="front_page_section_inner front_page_section_title_inner<?php
			if (greenthumb_get_theme_option('front_page_title_fullheight'))
				echo ' greenthumb-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
				$greenthumb_css = '';
				$greenthumb_bg_mask = greenthumb_get_theme_option('front_page_title_bg_mask');
				$greenthumb_bg_color = greenthumb_get_theme_option('front_page_title_bg_color');
				if (!empty($greenthumb_bg_color) && $greenthumb_bg_mask > 0)
					$greenthumb_css .= 'background-color: '.esc_attr($greenthumb_bg_mask==1
																		? $greenthumb_bg_color
																		: greenthumb_hex2rgba($greenthumb_bg_color, $greenthumb_bg_mask)
																	).';';
				if (!empty($greenthumb_css))
					echo " style=\"{$greenthumb_css}\"";
		?>>
			<div class="front_page_section_content_wrap front_page_section_title_content_wrap content_wrap">
				<?php
				// Caption
				$greenthumb_caption = greenthumb_get_theme_option('front_page_title_caption');
				if (!empty($greenthumb_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h1 class="front_page_section_caption front_page_section_title_caption front_page_block_<?php echo !empty($greenthumb_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post($greenthumb_caption); ?></h1><?php
				}
			
				// Description (text)
				$greenthumb_description = greenthumb_get_theme_option('front_page_title_description');
				if (!empty($greenthumb_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_title_description front_page_block_<?php echo !empty($greenthumb_description) ? 'filled' : 'empty'; ?>"><?php echo wpautop(wp_kses_post($greenthumb_description)); ?></div><?php
				}
				
				// Buttons
				if (greenthumb_get_theme_option('front_page_title_button1_link')!='' || greenthumb_get_theme_option('front_page_title_button2_link')!='') {
					?><div class="front_page_section_buttons front_page_section_title_buttons"><?php
						greenthumb_show_layout(greenthumb_customizer_partial_refresh_front_page_title_button1_link());
						greenthumb_show_layout(greenthumb_customizer_partial_refresh_front_page_title_button2_link());
					?></div><?php
				}
				?>
			</div>
		</div>
	</div>
	<?php
}