<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('greenthumb_mailchimp_get_css')) {
	add_filter('greenthumb_filter_get_css', 'greenthumb_mailchimp_get_css', 10, 4);
	function greenthumb_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		
			
			$rad = greenthumb_get_border_radius();
			$css['fonts'] .= <<<CSS

.mc4wp-form .mc4wp-form-fields input[type="email"],
.mc4wp-form .mc4wp-form-fields input[type="submit"] {

}

CSS;
		}

		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

.mc4wp-form input[type="email"],
.scheme_self .mc4wp-form input[type="email"]{
	background-color: transparent;
	border-color: {$colors['input_bd_color']};
	color: {$colors['alter_link']};
}
.custom_emailer .mc4wp-form input[type="email"]{
	border-color: {$colors['inverse_text']};
}


.mc4wp-form .mc4wp-alert {
	background-color: {$colors['text_link']};
	border-color: {$colors['input_bd_color']};
	color: {$colors['inverse_text']};
}
CSS;
		}

		return $css;
	}
}
?>