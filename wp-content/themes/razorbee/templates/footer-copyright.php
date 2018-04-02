<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0.10
 */

// Copyright area
$greenthumb_footer_scheme =  greenthumb_is_inherit(greenthumb_get_theme_option('footer_scheme')) ? greenthumb_get_theme_option('color_scheme') : greenthumb_get_theme_option('footer_scheme');
$greenthumb_copyright_scheme = greenthumb_is_inherit(greenthumb_get_theme_option('copyright_scheme')) ? $greenthumb_footer_scheme : greenthumb_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($greenthumb_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$greenthumb_copyright = greenthumb_prepare_macros(greenthumb_get_theme_option('copyright'));
				if (!empty($greenthumb_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $greenthumb_copyright, $greenthumb_matches)) {
						$greenthumb_copyright = str_replace($greenthumb_matches[1], date(str_replace(array('{', '}'), '', $greenthumb_matches[1])), $greenthumb_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($greenthumb_copyright));
				}
			?></div>
		</div>
	</div>
</div>
