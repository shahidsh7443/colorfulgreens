<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0
 */

if (greenthumb_sidebar_present()) {
	ob_start();
	$greenthumb_sidebar_name = greenthumb_get_theme_option('sidebar_widgets');
	greenthumb_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($greenthumb_sidebar_name) ) {
		dynamic_sidebar($greenthumb_sidebar_name);
	}
	$greenthumb_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($greenthumb_out)) {
		$greenthumb_sidebar_position = greenthumb_get_theme_option('sidebar_position');
		?>
		<div class="sidebar <?php echo esc_attr($greenthumb_sidebar_position); ?> widget_area<?php if (!greenthumb_is_inherit(greenthumb_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(greenthumb_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'greenthumb_action_before_sidebar' );
				greenthumb_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $greenthumb_out));
				do_action( 'greenthumb_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>