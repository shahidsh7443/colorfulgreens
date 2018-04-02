<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0
 */

// Header sidebar
$greenthumb_header_name = greenthumb_get_theme_option('header_widgets');
$greenthumb_header_present = !greenthumb_is_off($greenthumb_header_name) && is_active_sidebar($greenthumb_header_name);
if ($greenthumb_header_present) { 
	greenthumb_storage_set('current_sidebar', 'header');
	$greenthumb_header_wide = greenthumb_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($greenthumb_header_name) ) {
		dynamic_sidebar($greenthumb_header_name);
	}
	$greenthumb_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($greenthumb_widgets_output)) {
		$greenthumb_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $greenthumb_widgets_output);
		$greenthumb_need_columns = strpos($greenthumb_widgets_output, 'columns_wrap')===false;
		if ($greenthumb_need_columns) {
			$greenthumb_columns = max(0, (int) greenthumb_get_theme_option('header_columns'));
			if ($greenthumb_columns == 0) $greenthumb_columns = min(6, max(1, substr_count($greenthumb_widgets_output, '<aside ')));
			if ($greenthumb_columns > 1)
				$greenthumb_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($greenthumb_columns).' widget ', $greenthumb_widgets_output);
			else
				$greenthumb_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($greenthumb_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$greenthumb_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($greenthumb_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'greenthumb_action_before_sidebar' );
				greenthumb_show_layout($greenthumb_widgets_output);
				do_action( 'greenthumb_action_after_sidebar' );
				if ($greenthumb_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$greenthumb_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>