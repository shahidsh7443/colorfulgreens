<div class="front_page_section front_page_section_googlemap<?php
			$greenthumb_scheme = greenthumb_get_theme_option('front_page_googlemap_scheme');
			if (!greenthumb_is_inherit($greenthumb_scheme)) echo ' scheme_'.esc_attr($greenthumb_scheme);
			echo ' front_page_section_paddings_'.esc_attr(greenthumb_get_theme_option('front_page_googlemap_paddings'));
		?>"<?php
		$greenthumb_css = '';
		$greenthumb_bg_image = greenthumb_get_theme_option('front_page_googlemap_bg_image');
		if (!empty($greenthumb_bg_image)) 
			$greenthumb_css .= 'background-image: url('.esc_url(greenthumb_get_attachment_url($greenthumb_bg_image)).');';
		if (!empty($greenthumb_css))
			echo " style=\"{$greenthumb_css}\"";
?>><?php
	// Add anchor
	$greenthumb_anchor_icon = greenthumb_get_theme_option('front_page_googlemap_anchor_icon');	
	$greenthumb_anchor_text = greenthumb_get_theme_option('front_page_googlemap_anchor_text');	
	if ((!empty($greenthumb_anchor_icon) || !empty($greenthumb_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_googlemap"'
										. (!empty($greenthumb_anchor_icon) ? ' icon="'.esc_attr($greenthumb_anchor_icon).'"' : '')
										. (!empty($greenthumb_anchor_text) ? ' title="'.esc_attr($greenthumb_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_googlemap_inner<?php
			if (greenthumb_get_theme_option('front_page_googlemap_fullheight'))
				echo ' greenthumb-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$greenthumb_css = '';
			$greenthumb_bg_mask = greenthumb_get_theme_option('front_page_googlemap_bg_mask');
			$greenthumb_bg_color = greenthumb_get_theme_option('front_page_googlemap_bg_color');
			if (!empty($greenthumb_bg_color) && $greenthumb_bg_mask > 0)
				$greenthumb_css .= 'background-color: '.esc_attr($greenthumb_bg_mask==1
																	? $greenthumb_bg_color
																	: greenthumb_hex2rgba($greenthumb_bg_color, $greenthumb_bg_mask)
																).';';
			if (!empty($greenthumb_css))
				echo " style=\"{$greenthumb_css}\"";
	?>>
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap<?php
			$greenthumb_layout = greenthumb_get_theme_option('front_page_googlemap_layout');
			if ($greenthumb_layout != 'fullwidth')
				echo ' content_wrap';
		?>">
			<?php
			// Content wrap with title and description
			$greenthumb_caption = greenthumb_get_theme_option('front_page_googlemap_caption');
			$greenthumb_description = greenthumb_get_theme_option('front_page_googlemap_description');
			if (!empty($greenthumb_caption) || !empty($greenthumb_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				if ($greenthumb_layout == 'fullwidth') {
					?><div class="content_wrap"><?php
				}
					// Caption
					if (!empty($greenthumb_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
						?><h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo !empty($greenthumb_caption) ? 'filled' : 'empty'; ?>"><?php
							echo wp_kses_post($greenthumb_caption);
						?></h2><?php
					}
				
					// Description (text)
					if (!empty($greenthumb_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
						?><div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo !empty($greenthumb_description) ? 'filled' : 'empty'; ?>"><?php
							echo wpautop(wp_kses_post($greenthumb_description));
						?></div><?php
					}
				if ($greenthumb_layout == 'fullwidth') {
					?></div><?php
				}
			}

			// Content (text)
			$greenthumb_content = greenthumb_get_theme_option('front_page_googlemap_content');
			if (!empty($greenthumb_content) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				if ($greenthumb_layout == 'columns') {
					?><div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} else if ($greenthumb_layout == 'fullwidth') {
					?><div class="content_wrap"><?php
				}
	
				?><div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo !empty($greenthumb_content) ? 'filled' : 'empty'; ?>"><?php
					echo wp_kses_post($greenthumb_content);
				?></div><?php
	
				if ($greenthumb_layout == 'columns') {
					?></div><div class="column-2_3"><?php
				} else if ($greenthumb_layout == 'fullwidth') {
					?></div><?php
				}
			}
			
			// Widgets output
			?><div class="front_page_section_output front_page_section_googlemap_output"><?php 
				if (is_active_sidebar('front_page_googlemap_widgets')) {
					dynamic_sidebar( 'front_page_googlemap_widgets' );
				} else if (current_user_can( 'edit_theme_options' )) {
					if (!greenthumb_exists_trx_addons())
						greenthumb_customizer_need_trx_addons_message();
					else
						greenthumb_customizer_need_widgets_message('front_page_googlemap_caption', 'ThemeREX Addons - Google map');
				}
			?></div><?php

			if ($greenthumb_layout == 'columns' && (!empty($greenthumb_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div></div><?php
			}
			?>			
		</div>
	</div>
</div>