<div class="front_page_section front_page_section_woocommerce<?php
			$greenthumb_scheme = greenthumb_get_theme_option('front_page_woocommerce_scheme');
			if (!greenthumb_is_inherit($greenthumb_scheme)) echo ' scheme_'.esc_attr($greenthumb_scheme);
			echo ' front_page_section_paddings_'.esc_attr(greenthumb_get_theme_option('front_page_woocommerce_paddings'));
		?>"<?php
		$greenthumb_css = '';
		$greenthumb_bg_image = greenthumb_get_theme_option('front_page_woocommerce_bg_image');
		if (!empty($greenthumb_bg_image)) 
			$greenthumb_css .= 'background-image: url('.esc_url(greenthumb_get_attachment_url($greenthumb_bg_image)).');';
		if (!empty($greenthumb_css))
			echo " style=\"{$greenthumb_css}\"";
?>><?php
	// Add anchor
	$greenthumb_anchor_icon = greenthumb_get_theme_option('front_page_woocommerce_anchor_icon');	
	$greenthumb_anchor_text = greenthumb_get_theme_option('front_page_woocommerce_anchor_text');	
	if ((!empty($greenthumb_anchor_icon) || !empty($greenthumb_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_woocommerce"'
										. (!empty($greenthumb_anchor_icon) ? ' icon="'.esc_attr($greenthumb_anchor_icon).'"' : '')
										. (!empty($greenthumb_anchor_text) ? ' title="'.esc_attr($greenthumb_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_woocommerce_inner<?php
			if (greenthumb_get_theme_option('front_page_woocommerce_fullheight'))
				echo ' greenthumb-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$greenthumb_css = '';
			$greenthumb_bg_mask = greenthumb_get_theme_option('front_page_woocommerce_bg_mask');
			$greenthumb_bg_color = greenthumb_get_theme_option('front_page_woocommerce_bg_color');
			if (!empty($greenthumb_bg_color) && $greenthumb_bg_mask > 0)
				$greenthumb_css .= 'background-color: '.esc_attr($greenthumb_bg_mask==1
																	? $greenthumb_bg_color
																	: greenthumb_hex2rgba($greenthumb_bg_color, $greenthumb_bg_mask)
																).';';
			if (!empty($greenthumb_css))
				echo " style=\"{$greenthumb_css}\"";
	?>>
		<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
			<?php
			// Content wrap with title and description
			$greenthumb_caption = greenthumb_get_theme_option('front_page_woocommerce_caption');
			$greenthumb_description = greenthumb_get_theme_option('front_page_woocommerce_description');
			if (!empty($greenthumb_caption) || !empty($greenthumb_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($greenthumb_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo !empty($greenthumb_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post($greenthumb_caption);
					?></h2><?php
				}
			
				// Description (text)
				if (!empty($greenthumb_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo !empty($greenthumb_description) ? 'filled' : 'empty'; ?>"><?php
						echo wpautop(wp_kses_post($greenthumb_description));
					?></div><?php
				}
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs"><?php 
				$greenthumb_woocommerce_sc = greenthumb_get_theme_option('front_page_woocommerce_products');
				if ($greenthumb_woocommerce_sc == 'products') {
					$greenthumb_woocommerce_sc_ids = greenthumb_get_theme_option('front_page_woocommerce_products_per_page');
					$greenthumb_woocommerce_sc_per_page = count(explode(',', $greenthumb_woocommerce_sc_ids));
				} else {
					$greenthumb_woocommerce_sc_per_page = max(1, (int) greenthumb_get_theme_option('front_page_woocommerce_products_per_page'));
				}
				$greenthumb_woocommerce_sc_columns = max(1, min($greenthumb_woocommerce_sc_per_page, (int) greenthumb_get_theme_option('front_page_woocommerce_products_columns')));
				echo do_shortcode("[{$greenthumb_woocommerce_sc}"
									. ($greenthumb_woocommerce_sc == 'products' 
											? ' ids="'.esc_attr($greenthumb_woocommerce_sc_ids).'"' 
											: '')
									. ($greenthumb_woocommerce_sc == 'product_category' 
											? ' category="'.esc_attr(greenthumb_get_theme_option('front_page_woocommerce_products_categories')).'"' 
											: '')
									. ($greenthumb_woocommerce_sc != 'best_selling_products' 
											? ' orderby="'.esc_attr(greenthumb_get_theme_option('front_page_woocommerce_products_orderby')).'"'
											  . ' order="'.esc_attr(greenthumb_get_theme_option('front_page_woocommerce_products_order')).'"' 
											: '')
									. ' per_page="'.esc_attr($greenthumb_woocommerce_sc_per_page).'"' 
									. ' columns="'.esc_attr($greenthumb_woocommerce_sc_columns).'"' 
									. ']');
			?></div>
		</div>
	</div>
</div>