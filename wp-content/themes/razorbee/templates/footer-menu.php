<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0.10
 */

// Footer menu
$greenthumb_menu_footer = greenthumb_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($greenthumb_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php greenthumb_show_layout($greenthumb_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>