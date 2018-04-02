<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0.10
 */

// Footer sidebar
$greenthumb_footer_name = greenthumb_get_theme_option('footer_widgets');
$greenthumb_footer_present = !greenthumb_is_off($greenthumb_footer_name) && is_active_sidebar($greenthumb_footer_name);
if ($greenthumb_footer_present) { 
	greenthumb_storage_set('current_sidebar', 'footer');
	$greenthumb_footer_wide = greenthumb_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($greenthumb_footer_name) ) {
		dynamic_sidebar($greenthumb_footer_name);
	}
	$greenthumb_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($greenthumb_out)) {
		$greenthumb_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $greenthumb_out);
		$greenthumb_need_columns = true;	//or check: strpos($greenthumb_out, 'columns_wrap')===false;
		if ($greenthumb_need_columns) {
			$greenthumb_columns = max(0, (int) greenthumb_get_theme_option('footer_columns'));
			if ($greenthumb_columns == 0) $greenthumb_columns = min(4, max(1, substr_count($greenthumb_out, '<aside ')));
			if ($greenthumb_columns > 1)
				$greenthumb_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($greenthumb_columns).' widget ', $greenthumb_out);
			else
				$greenthumb_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($greenthumb_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row  sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$greenthumb_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($greenthumb_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'greenthumb_action_before_sidebar' );
				greenthumb_show_layout($greenthumb_out);
				do_action( 'greenthumb_action_after_sidebar' );
				if ($greenthumb_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$greenthumb_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>