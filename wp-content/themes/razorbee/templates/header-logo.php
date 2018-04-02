<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0
 */

$greenthumb_args = get_query_var('greenthumb_logo_args');

// Site logo
$greenthumb_logo_image  = greenthumb_get_logo_image(isset($greenthumb_args['type']) ? $greenthumb_args['type'] : '');
$greenthumb_logo_text   = greenthumb_is_on(greenthumb_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$greenthumb_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($greenthumb_logo_image) || !empty($greenthumb_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($greenthumb_logo_image)) {
			$greenthumb_attr = greenthumb_getimagesize($greenthumb_logo_image);
			echo '<img src="'.esc_url($greenthumb_logo_image).'" alt=""'.(!empty($greenthumb_attr[3]) ? sprintf(' %s', $greenthumb_attr[3]) : '').'>';
		} else {
			greenthumb_show_layout(greenthumb_prepare_macros($greenthumb_logo_text), '<span class="logo_text">', '</span>');
			greenthumb_show_layout(greenthumb_prepare_macros($greenthumb_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>