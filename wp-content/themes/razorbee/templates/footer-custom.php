<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0.10
 */

$greenthumb_footer_scheme =  greenthumb_is_inherit(greenthumb_get_theme_option('footer_scheme')) ? greenthumb_get_theme_option('color_scheme') : greenthumb_get_theme_option('footer_scheme');
$greenthumb_footer_id = str_replace('footer-custom-', '', greenthumb_get_theme_option("footer_style"));
if ((int) $greenthumb_footer_id == 0) {
	$greenthumb_footer_id = greenthumb_get_post_id(array(
												'name' => $greenthumb_footer_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUT_PT') ? TRX_ADDONS_CPT_LAYOUT_PT : 'cpt_layouts'
												)
											);
} else {
	$greenthumb_footer_id = apply_filters('greenthumb_filter_get_translated_layout', $greenthumb_footer_id);
}
$greenthumb_footer_meta = get_post_meta($greenthumb_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($greenthumb_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($greenthumb_footer_id))); 
						if (!empty($greenthumb_footer_meta['margin']) != '') 
							echo ' '.esc_attr(greenthumb_add_inline_css_class('margin-top: '.esc_attr(greenthumb_prepare_css_value($greenthumb_footer_meta['margin'])).';'));
						?> scheme_<?php echo esc_attr($greenthumb_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('greenthumb_action_show_layout', $greenthumb_footer_id);
	?>
</footer><!-- /.footer_wrap -->
