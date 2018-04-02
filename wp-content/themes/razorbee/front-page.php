<?php
/**
 * The Front Page template file.
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0.31
 */

get_header();

// If front-page is a static page
if (get_option('show_on_front') == 'page') {

	// If Front Page Builder is enabled - display sections
	if (greenthumb_is_on(greenthumb_get_theme_option('front_page_enabled'))) {

		if ( have_posts() ) the_post();

		$greenthumb_sections = greenthumb_array_get_keys_by_value(greenthumb_get_theme_option('front_page_sections'), 1, false);
		if (is_array($greenthumb_sections)) {
			foreach ($greenthumb_sections as $greenthumb_section) {
				get_template_part("front-page/section", $greenthumb_section);
			}
		}
	
	// Else - display native page content
	} else
		get_template_part('page');

// Else get index template to show posts
} else
	get_template_part('index');

get_footer();
?>