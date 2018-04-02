<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0.10
 */

// Logo
if (greenthumb_is_on(greenthumb_get_theme_option('logo_in_footer'))) {
	$greenthumb_logo_image = '';
	if (greenthumb_is_on(greenthumb_get_theme_option('logo_retina_enabled')) && greenthumb_get_retina_multiplier(2) > 1)
		$greenthumb_logo_image = greenthumb_get_theme_option( 'logo_footer_retina' );
	if (empty($greenthumb_logo_image)) 
		$greenthumb_logo_image = greenthumb_get_theme_option( 'logo_footer' );
	$greenthumb_logo_text   = get_bloginfo( 'name' );
	if (!empty($greenthumb_logo_image) || !empty($greenthumb_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($greenthumb_logo_image)) {
					$greenthumb_attr = greenthumb_getimagesize($greenthumb_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($greenthumb_logo_image).'" class="logo_footer_image" alt=""'.(!empty($greenthumb_attr[3]) ? sprintf(' %s', $greenthumb_attr[3]) : '').'></a>' ;
				} else if (!empty($greenthumb_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($greenthumb_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>