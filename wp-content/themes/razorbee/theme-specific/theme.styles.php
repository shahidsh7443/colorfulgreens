<?php
/**
 * Generate custom CSS
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0
 */

// Return CSS with custom colors and fonts
if (!function_exists('greenthumb_customizer_get_css')) {

	function greenthumb_customizer_get_css($colors=null, $fonts=null, $remove_spaces=true, $only_scheme='') {

		$css = array(
			'fonts' => '',
			'colors' => ''
		);
		
		// Theme fonts
		//---------------------------------------------
		if ($fonts === null) {
			$fonts = greenthumb_get_theme_fonts();
		}
		
		if ($fonts) {

			// Make theme-specific fonts rules
			$fonts = greenthumb_customizer_add_theme_fonts($fonts);

			$rez = array();
			$rez['fonts'] = <<<CSS

body {
	{$fonts['p_font-family']}
	{$fonts['p_font-size']}
	{$fonts['p_font-weight']}
	{$fonts['p_font-style']}
	{$fonts['p_line-height']}
	{$fonts['p_text-decoration']}
	{$fonts['p_text-transform']}
	{$fonts['p_letter-spacing']}
}
p, ul, ol, dl, blockquote, address {
	{$fonts['p_margin-top']}
	{$fonts['p_margin-bottom']}
}

h1, .front_page_section_caption {
	{$fonts['h1_font-family']}
	{$fonts['h1_font-size']}
	{$fonts['h1_font-weight']}
	{$fonts['h1_font-style']}
	{$fonts['h1_line-height']}
	{$fonts['h1_text-decoration']}
	{$fonts['h1_text-transform']}
	{$fonts['h1_letter-spacing']}
	{$fonts['h1_margin-top']}
	{$fonts['h1_margin-bottom']}
}
h2 {
	{$fonts['h2_font-family']}
	{$fonts['h2_font-size']}
	{$fonts['h2_font-weight']}
	{$fonts['h2_font-style']}
	{$fonts['h2_line-height']}
	{$fonts['h2_text-decoration']}
	{$fonts['h2_text-transform']}
	{$fonts['h2_letter-spacing']}
	{$fonts['h2_margin-top']}
	{$fonts['h2_margin-bottom']}
}
h3 {
	{$fonts['h3_font-family']}
	{$fonts['h3_font-size']}
	{$fonts['h3_font-weight']}
	{$fonts['h3_font-style']}
	{$fonts['h3_line-height']}
	{$fonts['h3_text-decoration']}
	{$fonts['h3_text-transform']}
	{$fonts['h3_letter-spacing']}
	{$fonts['h3_margin-top']}
	{$fonts['h3_margin-bottom']}
}
h4 {
	{$fonts['h4_font-family']}
	{$fonts['h4_font-size']}
	{$fonts['h4_font-weight']}
	{$fonts['h4_font-style']}
	{$fonts['h4_line-height']}
	{$fonts['h4_text-decoration']}
	{$fonts['h4_text-transform']}
	{$fonts['h4_letter-spacing']}
	{$fonts['h4_margin-top']}
	{$fonts['h4_margin-bottom']}
}
h5 {
	{$fonts['h5_font-family']}
	{$fonts['h5_font-size']}
	{$fonts['h5_font-weight']}
	{$fonts['h5_font-style']}
	{$fonts['h5_line-height']}
	{$fonts['h5_text-decoration']}
	{$fonts['h5_text-transform']}
	{$fonts['h5_letter-spacing']}
	{$fonts['h5_margin-top']}
	{$fonts['h5_margin-bottom']}
}
h6 {
	{$fonts['h6_font-family']}
	{$fonts['h6_font-size']}
	{$fonts['h6_font-weight']}
	{$fonts['h6_font-style']}
	{$fonts['h6_line-height']}
	{$fonts['h6_text-decoration']}
	{$fonts['h6_text-transform']}
	{$fonts['h6_letter-spacing']}
	{$fonts['h6_margin-top']}
	{$fonts['h6_margin-bottom']}
}

input[type="text"],
input[type="number"],
input[type="email"],
input[type="tel"],
input[type="search"],
input[type="password"],
textarea,
textarea.wp-editor-area,
.select_container,
select,
.select_container select {
	{$fonts['input_font-family']}
	{$fonts['input_font-size']}
	{$fonts['input_font-weight']}
	{$fonts['input_font-style']}
	{$fonts['input_line-height']}
	{$fonts['input_text-decoration']}
	{$fonts['input_text-transform']}
	{$fonts['input_letter-spacing']}
}

button,
input[type="button"],
input[type="reset"],
input[type="submit"],
.theme_button,
.gallery_preview_show .post_readmore,
.post_item .more-link,
div.esg-filter-wrapper .esg-filterbutton > span,
.mptt-navigation-tabs li a,
.greenthumb_tabs .greenthumb_tabs_titles li a {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}

.top_panel .slider_engine_revo .slide_title,
.sc_action_item_default .sc_action_item_title{
	{$fonts['h1_font-family']}
}

blockquote,
mark, ins,
.logo_text,
.post_price.price,
.theme_scroll_down {
	{$fonts['h5_font-family']}
}

.post_meta {
	{$fonts['info_font-family']}
	{$fonts['info_font-size']}
	{$fonts['info_font-weight']}
	{$fonts['info_font-style']}
	{$fonts['info_line-height']}
	{$fonts['info_text-decoration']}
	{$fonts['info_text-transform']}
	{$fonts['info_letter-spacing']}
	{$fonts['info_margin-top']}
	{$fonts['info_margin-bottom']}
}

em, i,
.post-date, .rss-date 
.post_date, .post_meta_item, .post_counters_item,
.comments_list_wrap .comment_date,
.comments_list_wrap .comment_time,
.comments_list_wrap .comment_counters,
.top_panel .slider_engine_revo .slide_subtitle,
.logo_slogan,
fieldset legend,
figure figcaption,
.wp-caption .wp-caption-text,
.wp-caption .wp-caption-dd,
.wp-caption-overlay .wp-caption .wp-caption-text,
.wp-caption-overlay .wp-caption .wp-caption-dd,
.format-audio .post_featured .post_audio_author,
.trx_addons_audio_player .audio_author,
.post_item_single .post_content .post_meta,
.author_bio .author_link,
.comments_list_wrap .comment_posted,
.comments_list_wrap .comment_reply {
	{$fonts['info_font-family']}
}
.search_wrap .search_results .post_meta_item,
.search_wrap .search_results .post_counters_item {
	{$fonts['p_font-family']}
}

.logo_text {
	{$fonts['logo_font-family']}
	{$fonts['logo_font-size']}
	{$fonts['logo_font-weight']}
	{$fonts['logo_font-style']}
	{$fonts['logo_line-height']}
	{$fonts['logo_text-decoration']}
	{$fonts['logo_text-transform']}
	{$fonts['logo_letter-spacing']}
}
.logo_footer_text {
	{$fonts['logo_font-family']}
}

.menu_main_nav_area {
	{$fonts['menu_font-size']}
	{$fonts['menu_line-height']}
}
.menu_main_nav > li,
.menu_main_nav > li > a {
	{$fonts['menu_font-family']}
	{$fonts['menu_font-weight']}
	{$fonts['menu_font-style']}
	{$fonts['menu_text-decoration']}
	{$fonts['menu_text-transform']}
	{$fonts['menu_letter-spacing']}
}
.menu_main_nav > li ul,
.menu_main_nav > li ul > li,
.menu_main_nav > li ul > li > a {
	{$fonts['submenu_font-family']}
	{$fonts['submenu_font-size']}
	{$fonts['submenu_font-weight']}
	{$fonts['submenu_font-style']}
	{$fonts['submenu_line-height']}
	{$fonts['submenu_text-decoration']}
	{$fonts['submenu_text-transform']}
	{$fonts['submenu_letter-spacing']}
}
.menu_mobile .menu_mobile_nav_area > ul > li,
.menu_mobile .menu_mobile_nav_area > ul > li > a {
	{$fonts['menu_font-family']}
}
.menu_mobile .menu_mobile_nav_area > ul > li li,
.menu_mobile .menu_mobile_nav_area > ul > li li > a {
	{$fonts['submenu_font-family']}
}


/* Custom Headers */
.sc_layouts_row,
.sc_layouts_row input[type="text"] {
	{$fonts['menu_font-family']}
	{$fonts['menu_font-size']}
	{$fonts['p_font-weight']}
	{$fonts['menu_font-style']}
	{$fonts['menu_line-height']}
}

.sc_layouts_row .sc_button {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}
.sc_layouts_menu_nav > li,
.sc_layouts_menu_nav > li > a {
	{$fonts['menu_font-family']}
	{$fonts['menu_font-weight']}
	{$fonts['menu_font-style']}
	{$fonts['menu_text-decoration']}
	{$fonts['menu_text-transform']}
	{$fonts['menu_letter-spacing']}
}
.sc_layouts_menu_popup .sc_layouts_menu_nav > li,
.sc_layouts_menu_popup .sc_layouts_menu_nav > li > a,
.sc_layouts_menu_nav > li ul,
.sc_layouts_menu_nav > li ul > li,
.sc_layouts_menu_nav > li ul > li > a {
	{$fonts['submenu_font-family']}
	{$fonts['submenu_font-size']}
	{$fonts['submenu_font-weight']}
	{$fonts['submenu_font-style']}
	{$fonts['submenu_line-height']}
	{$fonts['submenu_text-decoration']}
	{$fonts['submenu_text-transform']}
	{$fonts['submenu_letter-spacing']}
}

/* Custom Fonts */
ol > li:before, .author_subtitle,
.post_item_404.post_item_none_search .page_title,
.sc_services_item_price b, .sc_services_item_price span,
.sc_price_item_price span{
	{$fonts['h1_font-family']}
}
.font_family_title,
.font_family_title > h1,
.font_family_title > h2,
.font_family_title > h3,
.font_family_title > h4,
.font_family_title > h5,
.font_family_title > h6,
.sc_item_subtitle {
	{$fonts['h1_font-family']} !important;
}

h2.sc_item_title.sc_item_title_style_default:not(.sc_item_title_tag),
blockquote p,
.post_layout_classic .post_title,
.post_layout_excerpt .post_title,
.post_layout_chess .post_title,
.author_title, 
.nav-links-single .nav-links .post-title,
.related_wrap_title, .related_wrap .post_title, 
.comments_list_wrap .comments_list_title, .comments_list_wrap .comment_author,
.comments_wrap .comments_form_title,
.format-audio .post_featured .post_audio_title,
.post_item_404 .page_title, .post_item_404.post_item_none_search .page_subtitle,
.widget .widget_title, .widget .widgettitle,
.widget_area .post_item .post_title, .widget .post_item .post_title,
.trx_addons_audio_player .audio_caption,
.sc_layouts_item_details_line1,
.sc_action_item_default .sc_action_item_subtitle,
.sc_icons_item_title, .sc_icons_item_subtitle,
.sc_price_item_subtitle, 
.sc_services_light .sc_services_item_title,
.sc_services_hover .sc_services_item_title,
.sc_skills_counter .sc_skills_total,
.sc_team_item_title, .team_member_page .team_member_position,
.team_member_page .team_member_brief_info_title {
	{$fonts['p_font-family']};
}

.font_family_title p{
	{$fonts['p_font-family']} !important;
}


CSS;
			$rez = apply_filters('greenthumb_filter_get_css', $rez, false, $fonts, '');
			$css['fonts'] = $rez['fonts'];

			
			// Border radius
			//--------------------------------------
			$rad = greenthumb_get_border_radius();
			$rad50 = ' '.$rad != ' 0' ? '50%' : 0;
			$css['fonts'] .= <<<CSS

/* Buttons */
button,
input[type="button"],
input[type="reset"],
input[type="submit"],
.theme_button,
.post_item .post_item .more-link,
.gallery_preview_show .post_readmore,

/* Fields */
input[type="text"],
input[type="number"],
input[type="email"],
input[type="tel"],
input[type="password"],
input[type="search"],
select,
.select_container,
textarea,

/* Search fields */
.widget_search .search-field,

/* Comment fields */
.comments_wrap .comments_field input,
.comments_wrap .comments_field textarea,

/* Select 2 */
.select2-container .select2-choice,
.select2-container .select2-selection,

/* Tags cloud */
.widget_product_tag_cloud a,
.widget_tag_cloud a {

}
.select_container:before {

}
textarea.wp-editor-area {

}

/* Radius 50% or 0 */
.widget li a img {

}

CSS;
		}


		// Theme colors
		//--------------------------------------
		if ($colors !== false) {
			$schemes = empty($only_scheme) ? array_keys(greenthumb_get_list_schemes()) : array($only_scheme);
	
			if (count($schemes) > 0) {
				$rez = array();
				foreach ($schemes as $scheme) {
					// Prepare colors
					if (empty($only_scheme)) $colors = greenthumb_get_scheme_colors($scheme);
	
					// Make theme-specific colors and tints
					$colors = greenthumb_customizer_add_theme_colors($colors);
			
					// Make styles
					$rez['colors'] = <<<CSS

/* Common tags 
------------------------------------------ */
body {
	background-color: {$colors['bg_color']};
}
.scheme_self {
	color: {$colors['text']};
}
h1, h2, h3, h4, h5, h6,
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
li a,
[class*="color_style_"] h1 a, [class*="color_style_"] h2 a, [class*="color_style_"] h3 a, [class*="color_style_"] h4 a, [class*="color_style_"] h5 a, [class*="color_style_"] h6 a, [class*="color_style_"] li a {
	color: {$colors['alter_link']};
}
h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover {
	color: {$colors['text_link']};
}
.color_style_link2 h1 a:hover, .color_style_link2 h2 a:hover, .color_style_link2 h3 a:hover, .color_style_link2 h4 a:hover, .color_style_link2 h5 a:hover, .color_style_link2 h6 a:hover, .color_style_link2 li a:hover {
	color: {$colors['text_link2']};
}
.color_style_link3 h1 a:hover, .color_style_link3 h2 a:hover, .color_style_link3 h3 a:hover, .color_style_link3 h4 a:hover, .color_style_link3 h5 a:hover, .color_style_link3 h6 a:hover, .color_style_link3 li a:hover {
	color: {$colors['text_link3']};
}
.color_style_dark h1 a:hover, .color_style_dark h2 a:hover, .color_style_dark h3 a:hover, .color_style_dark h4 a:hover, .color_style_dark h5 a:hover, .color_style_dark h6 a:hover, .color_style_dark li a:hover {
	color: {$colors['text_link']};
}

dt, b, strong, i, em, mark, ins {	
	color: {$colors['text_dark']};
}

.footer_wrap dt, .footer_wrap b, .footer_wrap strong, .footer_wrap i, 
.footer_wrap em, .footer_wrap mark, .footer_wrap ins,
.scheme_self.footer_wrap dt, .scheme_self.footer_wrap b, .scheme_self.footer_wrap strong, .scheme_self.footer_wrap i, 
.scheme_self.footer_wrap em, .scheme_self.footer_wrap mark, .scheme_self.footer_wrap ins {	
	color: {$colors['inverse_light']};
}

s, strike, del {	
	color: {$colors['text_light']};
}

code {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
}
code a {
	color: {$colors['alter_link']};
}
code a:hover {
	color: {$colors['alter_hover']};
}

a {
	color: {$colors['text_link']};
}
a:hover {
	color: {$colors['text_hover']};
}
.color_style_link2 a {
	color: {$colors['text_link2']};
}
.color_style_link2 a:hover {
	color: {$colors['text_hover2']};
}
.color_style_link3 a {
	color: {$colors['text_link3']};
}
.color_style_link3 a:hover {
	color: {$colors['text_hover3']};
}
.color_style_dark a {
	color: {$colors['text_dark']};
}
.color_style_dark a:hover {
	color: {$colors['text_link']};
}

blockquote {
	color: {$colors['text_dark']};
	background-color: {$colors['extra_bg_color']};
}
blockquote:before {
	color: {$colors['extra_link']};
}
blockquote a {
	color: {$colors['text']};
}
blockquote a:hover {
	color: {$colors['text_hover']};
}
blockquote cite{
	color: {$colors['text']};
}

table th, table th + th, table td + th  {
	border-color: {$colors['extra_bd_color_01']};
}
table td, table th + td, table td + td {
	color: {$colors['text']};
	border-color: {$colors['extra_bd_color_03']};
}
table th {
	color: {$colors['extra_dark']};
}
table thead th{
	background-color: {$colors['text_hover']};
}

table th b, table th strong {
	color: {$colors['extra_dark']};
}
table > tbody > tr:nth-child(2n+1) > td,
table > tbody > tr:nth-child(2n+1) > th {
	background-color: {$colors['extra_light']};
}
table > tbody > tr:nth-child(2n) > td,
table > tbody > tr:nth-child(2n) > th  {
	background-color: {$colors['extra_bg_color']};
}
table th a:hover {
	color: {$colors['extra_dark']};
}
table > thead > tr:first-child > th{
	background-color: {$colors['text_hover']};
}

hr {
	border-color: {$colors['bd_color']};
}
figure figcaption,
.wp-caption .wp-caption-text,
.wp-caption .wp-caption-dd,s
.wp-caption-overlay .wp-caption .wp-caption-text,
.wp-caption-overlay .wp-caption .wp-caption-dd {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_hover_07']};
}
ul > li:before {
	color: {$colors['text']};
}
.widget ul > li:hover:before {
	color: {$colors['alter_link']};
}

ol > li:before{
	color: {$colors['text_hover']};
}


/* Form fields
-------------------------------------------------- */

.widget_search form:after,
.widget_display_search form:after {
	color: {$colors['input_bd_color']};
}
.widget_search form:hover:after,
.widget_display_search form:hover:after {
	color: {$colors['input_text']};
}

/* Field set */
fieldset {
	border-color: {$colors['bd_color']};
}
fieldset legend {
	color: {$colors['text_dark']};
	background-color: {$colors['bg_color']};
}

/* Text fields */
::-webkit-input-placeholder { color: {$colors['text']}; }
::-moz-placeholder          { color: {$colors['text']}; }
:-ms-input-placeholder      { color: {$colors['text']}; }

input[type="text"],
input[type="number"],
input[type="email"],
input[type="tel"],
input[type="search"],
input[type="password"],
.select_container,
.select2-container .select2-choice,
.select2-container .select2-selection,
.select2-container .select2-selection--single .select2-selection__rendered,
.select2-container .select2-selection--multiple,
textarea,
textarea.wp-editor-area {
	color: {$colors['input_text']};
	border-color: {$colors['input_bd_color']};
	background-color: {$colors['input_bg_color']};
}
input[type="text"]:focus,
input[type="number"]:focus,
input[type="email"]:focus,
input[type="tel"]:focus,
input[type="search"]:focus,
input[type="password"]:focus,
.select_container:hover,
select option:hover,
select option:focus,
.select2-container .select2-choice:hover,
.select2-container.select2-container--focus .select2-choice,
.select2-container.select2-container--focus .select2-selection--single .select2-selection__rendered,
.select2-container .select2-selection--single:hover .select2-selection__rendered,
.select2-container .select2-selection--multiple:hover,
.select2-container.select2-container--focus .select2-selection--multiple,
textarea:focus,
textarea.wp-editor-area:focus {
	color: {$colors['input_dark']};
	border-color: {$colors['input_bd_hover']};
	background-color: {$colors['input_bg_hover']};
}

/* Select containers */
.select_container:before {
	color: {$colors['input_text']};
	background-color: {$colors['input_bg_color']};
}
.select_container:focus:before,
.select_container:hover:before {
	color: {$colors['input_dark']};
	background-color: {$colors['input_bg_hover']};
}
.select_container:after {
	color: {$colors['alter_text']};
}
.select_container:focus:after,
.select_container:hover:after {
	color: {$colors['input_dark']};
}
.select_container select,
.widget .select_container select option {
	color: {$colors['input_text']};
	background: {$colors['input_bg_color']} !important;
	border-bottom-color: {$colors['input_bd_color']} !important;
}
.select_container select:focus,
.widget .select_container select:focus option {
	color: {$colors['input_dark']};
	background-color: {$colors['input_bg_hover']} !important;
}

.select2-dropdown,
.select2-container--focus .select2-selection {
	color: {$colors['input_dark']};
	border-color: {$colors['input_bd_hover']};
	background: {$colors['input_bg_hover']};
}
.select2-container .select2-results__option {
	color: {$colors['input_dark']};
	background: {$colors['input_bg_hover']};
}
.select2-dropdown .select2-highlighted,
.select2-container .select2-results__option--highlighted[aria-selected] {
	color: {$colors['inverse_link']};
	background: {$colors['text_link']};
}

input[type="radio"] + label:before,
input[type="checkbox"] + label:before {
	border-color: {$colors['input_bd_color']};
	background-color: {$colors['input_bg_color']};
}


/* Simple button */
.sc_button_simple:not(.sc_button_bg_image),
.sc_button_simple:not(.sc_button_bg_image):before,
.sc_button_simple:not(.sc_button_bg_image):after {
	color:{$colors['text_link']};
}
.sc_button_simple:not(.sc_button_bg_image):hover,
.sc_button_simple:not(.sc_button_bg_image):hover:before,
.sc_button_simple:not(.sc_button_bg_image):hover:after {
	color:{$colors['text_hover']} !important;
}

.sc_button_simple.color_style_link2:not(.sc_button_bg_image),
.sc_button_simple.color_style_link2:not(.sc_button_bg_image):before,
.sc_button_simple.color_style_link2:not(.sc_button_bg_image):after,
.color_style_link2 .sc_button_simple:not(.sc_button_bg_image),
.color_style_link2 .sc_button_simple:not(.sc_button_bg_image):before,
.color_style_link2 .sc_button_simple:not(.sc_button_bg_image):after {
	color:{$colors['text_link2']};
}
.sc_button_simple.color_style_link2:not(.sc_button_bg_image):hover,
.sc_button_simple.color_style_link2:not(.sc_button_bg_image):hover:before,
.sc_button_simple.color_style_link2:not(.sc_button_bg_image):hover:after,
.color_style_link2 .sc_button_simple:not(.sc_button_bg_image):hover,
.color_style_link2 .sc_button_simple:not(.sc_button_bg_image):hover:before,
.color_style_link2 .sc_button_simple:not(.sc_button_bg_image):hover:after {
	color:{$colors['text_hover2']};
}

.sc_button_simple.color_style_link3:not(.sc_button_bg_image),
.sc_button_simple.color_style_link3:not(.sc_button_bg_image):before,
.sc_button_simple.color_style_link3:not(.sc_button_bg_image):after,
.color_style_link3 .sc_button_simple:not(.sc_button_bg_image),
.color_style_link3 .sc_button_simple:not(.sc_button_bg_image):before,
.color_style_link3 .sc_button_simple:not(.sc_button_bg_image):after {
	color:{$colors['text_link3']};
}
.sc_button_simple.color_style_link3:not(.sc_button_bg_image):hover,
.sc_button_simple.color_style_link3:not(.sc_button_bg_image):hover:before,
.sc_button_simple.color_style_link3:not(.sc_button_bg_image):hover:after,
.color_style_link3 .sc_button_simple:not(.sc_button_bg_image):hover,
.color_style_link3 .sc_button_simple:not(.sc_button_bg_image):hover:before,
.color_style_link3 .sc_button_simple:not(.sc_button_bg_image):hover:after {
	color:{$colors['text_hover3']};
}

.sc_button_simple.color_style_dark:not(.sc_button_bg_image),
.sc_button_simple.color_style_dark:not(.sc_button_bg_image):before,
.sc_button_simple.color_style_dark:not(.sc_button_bg_image):after,
.color_style_dark .sc_button_simple:not(.sc_button_bg_image),
.color_style_dark .sc_button_simple:not(.sc_button_bg_image):before,
.color_style_dark .sc_button_simple:not(.sc_button_bg_image):after {
	color:{$colors['text_dark']};
}
.sc_button_simple.color_style_dark:not(.sc_button_bg_image):hover,
.sc_button_simple.color_style_dark:not(.sc_button_bg_image):hover:before,
.sc_button_simple.color_style_dark:not(.sc_button_bg_image):hover:after,
.color_style_dark .sc_button_simple:not(.sc_button_bg_image):hover,
.color_style_dark .sc_button_simple:not(.sc_button_bg_image):hover:before,
.color_style_dark .sc_button_simple:not(.sc_button_bg_image):hover:after {
	color:{$colors['text_link']};
}


/* Bordered button */
.sc_button_bordered:not(.sc_button_bg_image) {
	color:{$colors['text_link']};
	border-color:{$colors['text_link']};
}
.sc_button_bordered:not(.sc_button_bg_image):hover {
	color:{$colors['text_hover']} !important;
	border-color:{$colors['text_hover']} !important;
}
.sc_button_bordered.color_style_link2:not(.sc_button_bg_image) {
	color:{$colors['text_link2']};
	border-color:{$colors['text_link2']};
}
.sc_button_bordered.color_style_link2:not(.sc_button_bg_image):hover {
	color:{$colors['text_hover2']} !important;
	border-color:{$colors['text_hover2']} !important;
}
.sc_button_bordered.color_style_link3:not(.sc_button_bg_image) {
	color:{$colors['text_link3']};
	border-color:{$colors['text_link3']};
}
.sc_button_bordered.color_style_link3:not(.sc_button_bg_image):hover {
	color:{$colors['text_hover3']} !important;
	border-color:{$colors['text_hover3']} !important;
}
.sc_button_bordered.color_style_dark:not(.sc_button_bg_image) {
	color:{$colors['text_dark']};
	border-color:{$colors['text_dark']};
}
.sc_button_bordered.color_style_dark:not(.sc_button_bg_image):hover {
	color:{$colors['text_link']} !important;
	border-color:{$colors['text_link']} !important;
}

/* Normal button */
button,
input[type="reset"],
input[type="submit"],
input[type="button"],
.post_item .more-link,
.comments_wrap .form-submit input[type="submit"],
/* ThemeREX Addons */
.sc_button_default,
.sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image),
.socials_share:not(.socials_type_drop) .social_icon,
.esg-navigationbutton.esg-loadmore {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_hover']};
}
.theme_button {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_link']} !important;
}
.theme_button.color_style_link2 {
	background-color: {$colors['text_link2']} !important;
}
.theme_button.color_style_link3 {
	background-color: {$colors['text_link3']} !important;
}
.theme_button.color_style_dark {
	color: {$colors['inverse_text']} !important;
	background-color: {$colors['text_link']} !important;
}
.sc_price_item_link,
.sc_price_item_link.sc_button,
.sc_price_item .sc_price_item_info .sc_price_item_link.sc_button{
	color: {$colors['text_link']};
	background-color: {$colors['inverse_link']};
}
.sc_button_default.color_style_link2,
.sc_button.color_style_link2:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image) {
	background-color: {$colors['text_link2']};
}
.sc_button_default.color_style_link3,
.sc_button.color_style_link3:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image) {
	background-color: {$colors['text_link3']};
}
.sc_button_default.color_style_dark,
.sc_button.color_style_dark:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image) {
	color: {$colors['extra_text']};
	background-color: {$colors['alter_link']};
}
.search_wrap .search_submit:before {
	color: {$colors['alter_link']};
}

button:hover,
button:focus,
input[type="submit"]:hover,
input[type="submit"]:focus,
input[type="reset"]:hover,
input[type="reset"]:focus,
input[type="button"]:hover,
input[type="button"]:focus,
.post_item .more-link:hover,
.comments_wrap .form-submit input[type="submit"]:hover,
.comments_wrap .form-submit input[type="submit"]:focus,
/* ThemeREX Addons */
.sc_button_default:hover,
.sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover,
.socials_share:not(.socials_type_drop) .social_icon:hover,
.esg-navigationbutton.esg-loadmore:hover {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}
.theme_button:hover,
.theme_button:focus {
	color: {$colors['inverse_text']} !important;
	background-color: {$colors['text_link_blend']} !important;
}
.theme_button.color_style_link2:hover {
	background-color: {$colors['text_hover2']} !important;
}
.theme_button.color_style_link3:hover {
	background-color: {$colors['text_hover3']} !important;
}
.theme_button.color_style_dark:hover {
	color: {$colors['inverse_text']} !important;
	background-color: {$colors['text_link']} !important;
}
.sc_price_item:hover .sc_price_item_link,
.sc_price_item_link:hover {
	color: {$colors['inverse_hover']};
	background-color: {$colors['extra_hover']};
}
.sc_button_default.color_style_link2:hover,
.sc_button.color_style_link2:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover {
	background-color: {$colors['text_hover2']};
}
.sc_button_default.color_style_link3:hover,
.sc_button.color_style_link3:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover {
	background-color: {$colors['text_hover3']};
}
.sc_button_default.color_style_dark:hover,
.sc_button.color_style_dark:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}
.search_wrap .search_submit:hover:before {
	color: {$colors['text_hover']};
}


/* Buttons in sidebars */

/* MailChimp */
.mc4wp-form input[type="submit"]{
	color: {$colors['extra_link']};
}
.mc4wp-form input[type="submit"]:hover,
.mc4wp-form input[type="submit"]:focus{
	color: {$colors['text_hover']};
}

.scheme_default .custom_emailer .mc4wp-form::-webkit-input-placeholder { color: {$colors['bg_color']} !important; }
.scheme_default .custom_emailer .mc4wp-form::-moz-placeholder          { color: {$colors['bg_color']} !important; }
.scheme_default .custom_emailer .mc4wp-form:-ms-input-placeholder      { color: {$colors['bg_color']} !important; }
.scheme_default .custom_emailer .mc4wp-form[placeholder]     { color: {$colors['bg_color']} !important; }
.custom_emailer .mc4wp-form .mc4wp-form-fields input[type="email"]::-webkit-input-placeholder  { color: {$colors['bg_color']} !important; }
.custom_emailer .mc4wp-form .mc4wp-form-fields input[type="email"]::-moz-placeholder  { color: {$colors['bg_color']} !important; }
.custom_emailer .mc4wp-form .mc4wp-form-fields input[type="email"]:-ms-input-placeholder  { color: {$colors['bg_color']} !important; }
.custom_emailer .mc4wp-form .mc4wp-form-fields input[type="email"][placeholder] { color: {$colors['bg_color']} !important; }


/* Buttons in WP Editor */
.wp-editor-container input[type="button"] {
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
	color: {$colors['alter_dark']};
	-webkit-box-shadow: 0 1px 0 0 {$colors['bd_color']};
	    -ms-box-shadow: 0 1px 0 0 {$colors['bd_color']};
			box-shadow: 0 1px 0 0 {$colors['bd_color']};	
}
.wp-editor-container input[type="button"]:hover,
.wp-editor-container input[type="button"]:focus {
	background-color: {$colors['alter_hover']};
	border-color: {$colors['alter_hover']};
	color: {$colors['extra_link']};
}


/* WP Standard classes 
-------------------------------------------- */
.sticky {
	border-color: {$colors['text_hover']};
}
.sticky .label_sticky {
	border-top-color: {$colors['text_hover']};
}


/* Custom layouts
--------------------------------- */
.sc_layouts_row,
.scheme_self.sc_layouts_row {
	color: {$colors['text']};
	background-color: {$colors['extra_text']};
}

.footer_wrap .sc_layouts_row,
.scheme_self.footer_wrap .sc_layouts_row {
	color: {$colors['text']};
	background-color: {$colors['extra_text']};
}

.sc_layouts_row_delimiter,
.scheme_self.sc_layouts_row_delimiter {
	border-color: {$colors['extra_light']};
}
.footer_wrap .sc_layouts_row_delimiter,
.footer_wrap .scheme_self.vc_row .sc_layouts_row_delimiter,
.footer_wrap .scheme_self.sc_layouts_row_delimiter,
.scheme_self.footer_wrap .sc_layouts_row_delimiter {
	border-color: {$colors['alter_bd_color']};
}

.sc_layouts_item_icon {
	color: {$colors['text_hover']};
}
.sc_layouts_item_details_line1,
.scheme_self.sc_layouts_item_details_line1 {
	color: {$colors['alter_link']};
}
.sc_layouts_item_details_line2,
.scheme_self.sc_layouts_item_details_line2  {
	color: {$colors['inverse_light']};
}

.sc_layouts_row.sc_layouts_row_fixed_on,
.scheme_self.sc_layouts_row.sc_layouts_row_fixed_on {
	background-color: {$colors['extra_text']};
}

/* Header Default */
.default_header_bg .sc_layouts_menu_popup .sc_layouts_menu_nav > li > a,
.default_header_bg .sc_layouts_menu_nav > li ul > li > a{
	border-color: {$colors['bd_color']};
}

/* Row type: Narrow */
.sc_layouts_row.sc_layouts_row_type_narrow,
.scheme_self.sc_layouts_row.sc_layouts_row_type_narrow {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
}
.sc_layouts_row_type_narrow .sc_layouts_item,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .sc_layouts_item a,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item a {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .sc_layouts_item a:hover,
.sc_layouts_row_type_narrow .sc_layouts_item a:hover .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item a:hover,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item a:hover .sc_layouts_item_icon {
	color: {$colors['alter_dark']};
}
.sc_layouts_row_type_narrow .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item_icon {
	color: {$colors['text_hover']};
}
.sc_layouts_row_type_narrow .sc_layouts_item_details_line1,
.sc_layouts_row_type_narrow .sc_layouts_item_details_line2,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item_details_line1,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item_details_line2 {
	color: {$colors['alter_link']};
}

.sc_layouts_row_type_narrow .socials_wrap .social_item .social_icon,
.scheme_self.sc_layouts_row_type_narrow .socials_wrap .social_item .social_icon {
	background-color: transparent;
	color: {$colors['alter_link']};
}
.sc_layouts_row_type_narrow .socials_wrap .social_item:hover .social_icon,
.scheme_self.sc_layouts_row_type_narrow .socials_wrap .social_item:hover .social_icon {
	background-color: transparent;
	color: {$colors['inverse_text_06']};
}

.sc_layouts_row_type_narrow .sc_button,
.scheme_self.sc_layouts_row_type_narrow .sc_button {
	background-color: transparent;
	border-color: {$colors['alter_link']};
	color: {$colors['alter_link']};
}
.sc_layouts_row_type_narrow .sc_button:hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button:hover {
	background-color: transparent;
	border-color: {$colors['alter_hover']};
	color: {$colors['alter_hover']} !important;
}
.sc_layouts_row_type_narrow .sc_button.color_style_link2,
.scheme_self.sc_layouts_row_type_narrow .sc_button.color_style_link2 {
	border-color: {$colors['alter_link2']};
	color: {$colors['alter_link2']};
}
.sc_layouts_row_type_narrow .sc_button.color_style_link2:hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button.color_style_link2:hover {
	border-color: {$colors['alter_hover2']};
	color: {$colors['alter_hover2']} !important;
}
.sc_layouts_row_type_narrow .sc_button.color_style_link3,
.scheme_self.sc_layouts_row_type_narrow .sc_button.color_style_link3 {
	border-color: {$colors['alter_link3']};
	color: {$colors['alter_link3']};
}
.sc_layouts_row_type_narrow .sc_button.color_style_link3:hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button.color_style_link2:hover {
	border-color: {$colors['alter_hover3']};
	color: {$colors['alter_hover3']} !important;
}
.sc_layouts_row_type_narrow .sc_button.color_style_dark,
.scheme_self.sc_layouts_row_type_narrow .sc_button.color_style_dark {
	border-color: {$colors['alter_dark']};
	color: {$colors['alter_dark']};
}
.sc_layouts_row_type_narrow .sc_button.color_style_dark:hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button.color_style_dark:hover {
	border-color: {$colors['alter_link']};
	color: {$colors['alter_link']} !important;
}

.sc_layouts_row_type_narrow .search_wrap .search_submit,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_submit {
	background-color: transparent;
	color: {$colors['alter_link']};
}
.sc_layouts_row_type_narrow .search_wrap .search_submit:before,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_submit:before {
	color: {$colors['text_hover']};
}

.sc_layouts_row_type_narrow .search_wrap .search_field,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field::-webkit-input-placeholder{
	color: {$colors['alter_text']};
}
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field::-webkit-input-placeholder {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field::-moz-placeholder{
	color: {$colors['alter_text']};
}
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field::-moz-placeholder {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field:-ms-input-placeholder{
	color: {$colors['alter_text']};
}
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field:-ms-input-placeholder {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field:focus{
	color: {$colors['alter_dark']};
}
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field:focus {
	color: {$colors['alter_dark']};
}


/* Row type: Compact */
.sc_layouts_row_type_compact .sc_layouts_item,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item {
	color: {$colors['text']};
}
.sc_layouts_row_type_compact .sc_layouts_item a:not(.sc_button):not(.button),
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item a:not(.sc_button):not(.button) {
	color: {$colors['alter_link']};
}

.sc_layouts_row_type_compact .sc_layouts_item ul ul a:not(.sc_button):not(.button){
	color: {$colors['text']};
}
.sc_layouts_row_type_compact .sc_layouts_item ul ul a:not(.sc_button):not(.button):hover{
	color: {$colors['extra_hover']};
}

.sc_layouts_row_type_compact.sc_layouts_row_fixed_on .sc_layouts_menu_nav > li.current-menu-item > a:not(.sc_button):not(.button), 
.sc_layouts_row_type_compact.sc_layouts_row_fixed_on .sc_layouts_menu_nav > li.current-menu-parent > a:not(.sc_button):not(.button), 
.sc_layouts_row_type_compact.sc_layouts_row_fixed_on .sc_layouts_menu_nav > li.current-menu-ancestor > a:not(.sc_button):not(.button){
	color: {$colors['text_hover']};
}

.sc_layouts_row_type_compact .sc_layouts_item a:not(.sc_button):not(.button):hover,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item a:not(.sc_button):not(.button):hover,
.sc_layouts_row_type_compact .sc_layouts_item a:hover .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item a:hover .sc_layouts_item_icon {
	color: {$colors['extra_hover']};
}
.sc_layouts_row_type_compact .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item_icon {
	color: {$colors['text_hover']};
}

.sc_layouts_item_icon.trx_addons_icon-menu,
.scheme_self .sc_layouts_item_icon.trx_addons_icon-menu {
	color: {$colors['alter_link']};
}

.sc_layouts_item_icon.trx_addons_icon-menu:hover,
.scheme_self .sc_layouts_item_icon.trx_addons_icon-menu:hover {
	color: {$colors['text_hover']} !important;
}

.with_bg_image .sc_layouts_item_icon.trx_addons_icon-menu,
.with_bg_image .scheme_self .sc_layouts_item_icon.trx_addons_icon-menu,
.header_position_over .sc_layouts_row_type_compact .sc_layouts_item_icon.trx_addons_icon-menu,
.header_position_over .scheme_self.sc_layouts_row_type_compact .sc_layouts_item_icon.trx_addons_icon-menu {
	color: {$colors['alter_link']};
}

.with_bg_image .sc_layouts_item_icon.trx_addons_icon-menu:hover,
.with_bg_image .scheme_self .sc_layouts_item_icon.trx_addons_icon-menu:hover,
.header_position_over .sc_layouts_row_type_compact .sc_layouts_item_icon.trx_addons_icon-menu:hover,
.header_position_over .scheme_self.sc_layouts_row_type_compact .sc_layouts_item_icon.trx_addons_icon-menu:hover {
	color: {$colors['alter_link_06']} !important;
}

.sc_layouts_row_type_compact .sc_layouts_item_details_line1,
.sc_layouts_row_type_compact .sc_layouts_item_details_line2,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item_details_line1,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item_details_line2 {
	color: {$colors['alter_link']};
}

.sc_layouts_row_type_compact .socials_wrap .social_item .social_icon,
.scheme_self.sc_layouts_row_type_compact .socials_wrap .social_item .social_icon {
	background-color: {$colors['text_hover']};
	color: {$colors['inverse_text']};
}
.sc_layouts_row_type_compact .socials_wrap .social_item:hover .social_icon,
.scheme_self.sc_layouts_row_type_compact .socials_wrap .social_item:hover .social_icon {
	color: {$colors['extra_link']};
}

.sc_layouts_row_type_compact .search_wrap .search_submit,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_submit {
	background-color: transparent;
	color: {$colors['text_dark']};
}
.sc_layouts_row_type_compact .search_wrap .search_submit:hover,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_submit:hover {
	background-color: transparent;
	color: {$colors['text_hover']};
}
.sc_layouts_row_type_compact .search_wrap.search_style_normal .search_submit,
.scheme_self.sc_layouts_row_type_compact .search_wrap.search_style_normal .search_submit {
	color: {$colors['text_link']};
}
.sc_layouts_row_type_compact .search_wrap.search_style_normal .search_submit:hover,
.scheme_self.sc_layouts_row_type_compact .search_wrap.search_style_normal .search_submit:hover {
	color: {$colors['text_hover']};
}

.sc_layouts_row_type_compact .search_wrap .search_field::-webkit-input-placeholder,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_field::-webkit-input-placeholder {
	color: {$colors['text']};
}
.sc_layouts_row_type_compact .search_wrap .search_field::-moz-placeholder,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_field::-moz-placeholder {
	color: {$colors['text']};
}
.sc_layouts_row_type_compact .search_wrap .search_field:-ms-input-placeholder,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_field:-ms-input-placeholder {
	color: {$colors['text']};
}


/* Row type: Normal */
.sc_layouts_row_type_normal .sc_layouts_item,
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item {
	color: {$colors['text']};
}
.sc_layouts_row_type_normal .sc_layouts_item a,
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item a {
	color: {$colors['extra_link']};
}
.sc_layouts_row_type_normal .sc_layouts_item a:hover,
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item a:hover,
.sc_layouts_row_type_normal .sc_layouts_item a:hover .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item a:hover .sc_layouts_item_icon {
	color: {$colors['text_hover']};
}

.sc_layouts_row_type_normal .sc_layouts_menu_popup .sc_layouts_menu_nav > li > a, 
.sc_layouts_row_type_normal .sc_layouts_menu_nav > li li > a{
	color: {$colors['text']};
}

.sc_layouts_row_type_normal .search_wrap .search_submit,
.scheme_self.sc_layouts_row_type_normal .search_wrap .search_submit {
	background-color: transparent;
	color: {$colors['input_text']};
}
.sc_layouts_row_type_normal .search_wrap .search_submit:hover,
.scheme_self.sc_layouts_row_type_normal .search_wrap .search_submit:hover {
	background-color: transparent;
	color: {$colors['input_dark']};
}

.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title,
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title,
.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h1, .sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h2, 
.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h3, .sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h4, 
.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h5, .sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h6,
.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h1 a, .sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h2 a, 
.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h3 a, .sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h4 a, 
.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h5 a, .sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h6 a,
.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title li a,
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h1, .scheme_self.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h2, 
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h3, .scheme_self.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h4, 
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h5, .scheme_self.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h6,
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h1 a, .scheme_self.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h2 a, 
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h3 a, .scheme_self.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h4 a, 
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h5 a, .scheme_self.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title h6 a,
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item .sc_layouts_title li a{
	color: {$colors['alter_link']};
}


/* Logo */
.sc_layouts_logo b {
	color: {$colors['text_dark']};
}
.sc_layouts_logo i {
	color: {$colors['text_link']};
}
.sc_layouts_logo_text {
	color: {$colors['text_link']};
}
.sc_layouts_logo:hover .logo_text {
	color: {$colors['text_hover']};
}
.logo_slogan {
	color: {$colors['alter_link']};
}


/* Search style 'Expand' */
.search_style_expand.search_opened {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
}
.search_style_expand.search_opened .search_submit {
	color: {$colors['text']};
}
.search_style_expand .search_submit:hover,
.search_style_expand .search_submit:focus {
	color: {$colors['text_dark']};
}


/* Search style 'Fullscreen' */
.search_style_fullscreen.search_opened .search_form_wrap {
	background-color: {$colors['bg_color_09']};
}
.search_style_fullscreen.search_opened .search_form {
	border-color: {$colors['text_dark']};
}
.search_style_fullscreen.search_opened .search_close,
.search_style_fullscreen.search_opened .search_field,
.search_style_fullscreen.search_opened .search_submit,
.search_style_fullscreen.search_opened .search_close a,
.search_style_fullscreen.search_opened .search_field a,
.search_style_fullscreen.search_opened .search_submit a {
	color: {$colors['text_dark']} !important;
}
.search_style_fullscreen.search_opened .search_close:hover,
.search_style_fullscreen.search_opened .search_field:hover,
.search_style_fullscreen.search_opened .search_field:focus,
.search_style_fullscreen.search_opened .search_submit:hover,
.search_style_fullscreen.search_opened .search_submit:focus,
.search_style_fullscreen.search_opened .search_close a:hover,
.search_style_fullscreen.search_opened .search_field a:hover,
.search_style_fullscreen.search_opened .search_field a:focus,
.search_style_fullscreen.search_opened .search_submit a:hover,
.search_style_fullscreen.search_opened .search_submit a:focus {
	color: {$colors['text_hover']} !important;
}
.search_style_fullscreen.search_opened .search_field::-webkit-input-placeholder {color:{$colors['text_light']}; opacity: 1;}
.search_style_fullscreen.search_opened .search_field::-moz-placeholder          {color:{$colors['text_light']}; opacity: 1;}/* Firefox 19+ */
.search_style_fullscreen.search_opened .search_field:-moz-placeholder           {color:{$colors['text_light']}; opacity: 1;}/* Firefox 18- */
.search_style_fullscreen.search_opened .search_field:-ms-input-placeholder      {color:{$colors['text_light']}; opacity: 1;}


/* Search results */
.search_wrap .search_results {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
}
.search_wrap .search_results:after {
	background-color: {$colors['bg_color']};
	border-left-color: {$colors['bd_color']};
	border-top-color: {$colors['bd_color']};
}
.search_wrap .search_results .search_results_close {
	color: {$colors['text_light']};
}
.search_wrap .search_results .search_results_close:hover {
	color: {$colors['text_hover']};
}
.search_results.widget_area .post_item + .post_item {
	border-top-color: {$colors['bd_color']};
}


/* Page title and breadcrumbs */
.sc_layouts_title .sc_layouts_title_meta,
.sc_layouts_title .post_meta,
.sc_layouts_title .post_meta_item,
.sc_layouts_title .post_meta_item a,
.sc_layouts_title .post_meta_item:before,
.sc_layouts_title .post_meta_item:after,
.sc_layouts_title .post_meta_item:hover:before,
.sc_layouts_title .post_meta_item:hover:after,
.sc_layouts_title .post_meta_item.post_categories,
.sc_layouts_title .post_meta_item.post_categories a,
.sc_layouts_title .post_date a,
.sc_layouts_title .post_date:before,
.sc_layouts_title .post_date:after,
.sc_layouts_title .post_info .post_info_item,
.sc_layouts_title .post_info .post_info_item a,
.sc_layouts_title .post_info_counters .post_counters_item,
.sc_layouts_title .post_counters .socials_share .socials_caption:before,
.sc_layouts_title .post_counters .socials_share .socials_caption:hover:before {
	color: {$colors['extra_link']};
}
.sc_layouts_title .post_date a:hover,
.sc_layouts_title .post_date:hover:after,
.sc_layouts_title a.post_meta_item:hover,
.sc_layouts_title a.post_meta_item:hover:before,
.sc_layouts_title .post_meta_item a:hover,
.sc_layouts_title .post_meta_item a:hover:before,
.sc_layouts_title .post_meta_item.post_categories a:hover,
.sc_layouts_title .post_info .post_info_item a:hover,
.sc_layouts_title .post_info_counters .post_counters_item:hover {
	color: {$colors['text_hover']};
}

.sc_layouts_title .sc_layouts_title_description {
	color: {$colors['extra_link']};
}
.sc_layouts_title_breadcrumbs {
	color: {$colors['extra_link']};
}
.sc_layouts_title_breadcrumbs a {
	color: {$colors['extra_link']} !important;
}
.sc_layouts_title_breadcrumbs a:hover {
	color: {$colors['text_hover']} !important;
}


/* Menu */
.sc_layouts_menu_nav > li > a {
	color: {$colors['alter_link']};
}
.sc_layouts_menu_nav > li > a:hover,
.sc_layouts_menu_nav > li.sfHover > a {
	color: {$colors['extra_hover']};
}

.sc_layouts_menu_nav > li > a:hover,
.sc_layouts_menu_nav > li.current-menu-item > a,
.sc_layouts_menu_nav > li.current-menu-parent > a,
.sc_layouts_menu_nav > li.current-menu-ancestor > a{
	color: {$colors['extra_hover']};
}

.sc_layouts_row_type_normal .sc_layouts_menu_nav > li > a:hover,
.sc_layouts_row_type_normal .sc_layouts_menu_nav > li.current-menu-item > a,
.sc_layouts_row_type_normal .sc_layouts_menu_nav > li.current-menu-parent > a,
.sc_layouts_row_type_normal .sc_layouts_menu_nav > li.current-menu-ancestor > a{
	color: {$colors['text_hover']};
}

.header_position_over .sc_layouts_row_fixed_on .sc_layouts_menu_nav > li.current-menu-item > a,
.header_position_over .sc_layouts_row_fixed_on .sc_layouts_menu_nav > li.current-menu-parent > a,
.header_position_over .sc_layouts_row_fixed_on .sc_layouts_menu_nav > li.current-menu-ancestor > a{
	color: {$colors['text_hover']};
}

.sc_layouts_menu_nav .menu-collapse > a:before {
	color: {$colors['text_hover']};
}
.sc_layouts_menu_nav .menu-collapse > a:after,
.scheme_self .sc_layouts_menu_nav .menu-collapse > a:after  {
	background-color: {$colors['alter_link']};
}
.sc_layouts_menu_nav .menu-collapse > a:hover:before {
	color: {$colors['text_hover']};
}
.sc_layouts_menu_nav .menu-collapse > a:hover:after, 
.sc_layouts_menu_nav .menu-collapse > a:hover:after {
	background-color: {$colors['alter_link']};
}

/* Submenu */
.sc_layouts_menu_popup .sc_layouts_menu_nav,
.sc_layouts_menu_nav > li ul {
	background-color: {$colors['extra_bg_color']};
}
.sc_layouts_menu_popup .sc_layouts_menu_nav > li > a{
	color: {$colors['text']} !important;

}
.sc_layouts_menu_popup .sc_layouts_menu_nav > li > a,
.sc_layouts_menu_nav > li li > a{
	border-color: {$colors['alter_bd_color']};
}
.sc_layouts_menu_popup .sc_layouts_menu_nav > li > a:hover,
.sc_layouts_menu_popup .sc_layouts_menu_nav > li.sfHover > a,
.sc_layouts_menu_nav > li li > a:hover,
.sc_layouts_menu_nav > li li.sfHover > a {
	color: {$colors['text_link']} !important;
	background-color: transparent;
}
.sc_layouts_menu_nav li[class*="columns-"] li.menu-item-has-children > a:hover,
.sc_layouts_menu_nav li[class*="columns-"] li.menu-item-has-children.sfHover > a {
	color: {$colors['text_link']} !important;
	background-color: transparent;
}
.sc_layouts_menu_nav > li li[class*="icon-"]:before {
	color: {$colors['extra_hover']};
}
.sc_layouts_menu_nav > li li[class*="icon-"]:hover:before,
.sc_layouts_menu_nav > li li[class*="icon-"].shHover:before {
	color: {$colors['extra_hover']};
}
.sc_layouts_menu_nav > li li.current-menu-item > a,
.sc_layouts_menu_nav > li li.current-menu-parent > a,
.sc_layouts_menu_nav > li li.current-menu-ancestor > a {
	color: {$colors['text_link']} !important;
}
.sc_layouts_menu_nav > li li.current-menu-item:before,
.sc_layouts_menu_nav > li li.current-menu-parent:before,
.sc_layouts_menu_nav > li li.current-menu-ancestor:before {
	color: {$colors['text_link']} !important;
}

/* Mobile menu */
.scheme_self.menu_side_wrap .menu_side_button {
	color: {$colors['alter_dark']};
	border-color: {$colors['alter_bd_color']};
	background-color: {$colors['alter_bg_color_07']};
}
.scheme_self.menu_side_wrap .menu_side_button:hover {
	color: {$colors['inverse_hover']};
	border-color: {$colors['alter_hover']};
	background-color: {$colors['alter_link']};
}
.menu_side_inner,
.menu_mobile_inner {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
}
.menu_mobile_button {
	color: {$colors['text_dark']};
}
.menu_mobile_button:hover {
	color: {$colors['text_link']};
}
.menu_mobile_close:before,
.menu_mobile_close:after {
	border-color: {$colors['alter_link']};
}
.menu_mobile_close:hover:before,
.menu_mobile_close:hover:after {
	border-color: {$colors['text_hover']};
}
.menu_mobile_inner a,
.menu_mobile_inner .menu_mobile_nav_area li:before {
	color: {$colors['alter_link']};
}
.menu_mobile_inner a:hover,
.menu_mobile_inner .current-menu-ancestor > a,
.menu_mobile_inner .current-menu-item > a,
.menu_mobile_inner .menu_mobile_nav_area li:hover:before,
.menu_mobile_inner .menu_mobile_nav_area li.current-menu-ancestor:before,
.menu_mobile_inner .menu_mobile_nav_area li.current-menu-item:before {
	color: {$colors['text_hover']};
}
.menu_mobile_inner .search_mobile .search_submit {
	color: {$colors['input_light']};
}
.menu_mobile_inner .search_mobile .search_submit:focus,
.menu_mobile_inner .search_mobile .search_submit:hover {
	color: {$colors['input_dark']};
}

.menu_mobile_inner .social_item .social_icon {
	color: {$colors['alter_link']};
	background: transparent;
}
.menu_mobile_inner .social_item:hover .social_icon {
	color: {$colors['alter_dark']};
}


/* Menu hovers */

/* fade box */
.menu_hover_fade_box .sc_layouts_menu_nav > a:hover,
.menu_hover_fade_box .sc_layouts_menu_nav > li > a:hover,
.menu_hover_fade_box .sc_layouts_menu_nav > li.sfHover > a {
	color: {$colors['alter_link']};
	background-color: {$colors['alter_bg_color']};
}

/* slide_line */
.menu_hover_slide_line .sc_layouts_menu_nav > li#blob {
	background-color: {$colors['text_link']};
}

/* slide_box */
.menu_hover_slide_box .sc_layouts_menu_nav > li#blob {
	background-color: {$colors['alter_bg_color']};
}

/* zoom_line */
.menu_hover_zoom_line .sc_layouts_menu_nav > li > a:before {
	background-color: {$colors['text_link']};
}

/* path_line */
.menu_hover_path_line .sc_layouts_menu_nav > li:before,
.menu_hover_path_line .sc_layouts_menu_nav > li:after,
.menu_hover_path_line .sc_layouts_menu_nav > li > a:before,
.menu_hover_path_line .sc_layouts_menu_nav > li > a:after {
	background-color: {$colors['text_link']};
}

/* roll_down */
.menu_hover_roll_down .sc_layouts_menu_nav > li > a:before {
	background-color: {$colors['text_link']};
}

/* color_line */
.menu_hover_color_line .sc_layouts_menu_nav > li > a:before {
	background-color: {$colors['text_dark']};
}
.menu_hover_color_line .sc_layouts_menu_nav > li > a:after,
.menu_hover_color_line .sc_layouts_menu_nav > li.menu-item-has-children > a:after {
	background-color: {$colors['text_link']};
}
.menu_hover_color_line .sc_layouts_menu_nav > li.sfHover > a,
.menu_hover_color_line .sc_layouts_menu_nav > li > a:hover,
.menu_hover_color_line .sc_layouts_menu_nav > li > a:focus {
	color: {$colors['text_link']};
}


/* VC Separator */
.scheme_self.sc_layouts_row .vc_separator.vc_sep_color_grey .vc_sep_line,
.sc_layouts_row .vc_separator.vc_sep_color_grey .vc_sep_line {
	border-color: {$colors['alter_bd_color']};
}


/* Page 
-------------------------------------------- */
#page_preloader,
.scheme_self.header_position_under .page_content_wrap,
.page_wrap {
	background-color: {$colors['bg_color']};
}
.preloader_wrap > div {
	background-color: {$colors['text_link']};
}

/* Header */
.scheme_self.top_panel.with_bg_image:before {
	background-color: {$colors['inverse_dark_03']};
}
.scheme_self.top_panel .slider_engine_revo .slide_subtitle,
.top_panel .slider_engine_revo .slide_subtitle {
	color: {$colors['text_link']};
}
.top_panel_default .top_panel_navi,
.scheme_self.top_panel_default .top_panel_navi {
	background-color: {$colors['extra_text']};
}
.top_panel_default .top_panel_title,
.scheme_self.top_panel_default .top_panel_title {
	background-color: {$colors['alter_bg_color']};
}


/* Tabs */
div.esg-filter-wrapper .esg-filterbutton > span,
.mptt-navigation-tabs li a,
.greenthumb_tabs .greenthumb_tabs_titles li a {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}
div.esg-filter-wrapper .esg-filterbutton > span:hover,
.mptt-navigation-tabs li a:hover,
.greenthumb_tabs .greenthumb_tabs_titles li a:hover {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}
div.esg-filter-wrapper .esg-filterbutton.selected > span,
.mptt-navigation-tabs li.active a,
.greenthumb_tabs .greenthumb_tabs_titles li.ui-state-active a {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}

/* Post layouts */
.post_item {
	color: {$colors['text']};
}
.post_meta,
.post_meta_item,
.post_meta_item a,
.post_meta_item:before,
.post_meta_item:after,
.post_meta_item:hover:before,
.post_meta_item:hover:after,
.post_date a,
.post_date:before,
.post_date:after,
.post_info .post_info_item,
.post_info .post_info_item a,
.post_info_counters .post_counters_item,
.post_counters .socials_share .socials_caption:before,
.post_counters .socials_share .socials_caption:hover:before {
	color: {$colors['text_light']};
}
.post_date a:hover,
a.post_meta_item:hover,
a.post_meta_item:hover:before,
.post_meta_item a:hover,
.post_meta_item a:hover:before,
.post_info .post_info_item a:hover,
.post_info .post_info_item a:hover:before,
.post_info_counters .post_counters_item:hover,
.post_info_counters .post_counters_item:hover:before {
	color: {$colors['text_hover']};
}

.post_item .post_title a,
.scheme_self.sidebar .post_item .post_title a{
	color: {$colors['alter_link']};
}

.post_item .post_title a:hover,
.scheme_self.sidebar .post_item .post_title a:hover {
	color: {$colors['text_hover']};
}

.post_meta_item.post_categories,
.post_meta_item.post_categories a {
	color: {$colors['text_light']};
}
.post_meta_item.post_categories a:hover {
	color: {$colors['text_hover']};
}

.post_meta_item .socials_share .social_items {
	background-color: {$colors['bg_color']};
}
.post_meta_item .social_items,
.post_meta_item .social_items:before {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
	color: {$colors['text_light']};
}

.post_layout_excerpt:not(.sticky) + .post_layout_excerpt:not(.sticky) {
	border-color: {$colors['bd_color']};
}
.post_layout_classic {
	border-color: {$colors['bd_color']};
}

.scheme_self.gallery_preview:before {
	background-color: {$colors['bg_color']};
}
.scheme_self.gallery_preview {
	color: {$colors['text']};
}


/* Post Formats */

/* Audio */
.trx_addons_audio_player .audio_author,
.format-audio .post_featured .post_audio_author {
	color: {$colors['inverse_text']};
}
.format-audio .post_featured.without_thumb .post_audio {
	background-color: {$colors['text_hover']};
}
.format-audio .post_featured.without_thumb .post_audio_title,
.without_thumb .mejs-controls .mejs-currenttime,
.without_thumb .mejs-controls .mejs-duration {
	color: {$colors['inverse_text']};
}

.trx_addons_audio_player.without_cover {
	background-color: {$colors['text_hover']};
}
.trx_addons_audio_player.without_cover .audio_caption,
.trx_addons_audio_player.with_cover .audio_caption {
	color: {$colors['inverse_text']};
}
.trx_addons_audio_player.without_cover .audio_author,
.trx_addons_audio_player.with_cover .audio_author {
	color: {$colors['inverse_text']};
}
.trx_addons_audio_player .mejs-container .mejs-controls .mejs-time {
	color: {$colors['inverse_text']};
}
.trx_addons_audio_player.with_cover .mejs-container .mejs-controls .mejs-time {
	color: {$colors['inverse_text']};
}

.mejs-container .mejs-controls,
.mejs-embed,
.mejs-embed body {
	background: {$colors['text_dark_07']};
}

.mejs-controls .mejs-button,
.mejs-controls .mejs-time-rail .mejs-time-current,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
	color: {$colors['text_hover']};
	background: {$colors['inverse_text']};
}
.mejs-controls .mejs-button:hover {
	color: {$colors['text_hover']};
	background: {$colors['inverse_text_06']};
}
.mejs-controls .mejs-time-rail .mejs-time-total,
.mejs-container .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total {
	background: {$colors['inverse_text_02']};
}
.mejs-controls .mejs-time-rail .mejs-time-loaded{
	background: {$colors['inverse_text_06']};
}

.trx_addons_audio_player .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total:before, 
.trx_addons_audio_player .mejs-controls .mejs-time-rail .mejs-time-total:before {
	background: {$colors['inverse_text_02']};
}


/* Aside */
.format-aside .post_content_inner {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_color']};
}

/* Link and Status */
.format-link .post_content_inner,
.format-status .post_content_inner {
	color: {$colors['text_dark']};
}

/* Chat */
.format-chat p > b,
.format-chat p > strong {
	color: {$colors['text_dark']};
}

/* Gallery */
.image-navigation .nav-previous a:after, .image-navigation .nav-next a:after,
.image-navigation .nav-previous a:hover, .image-navigation .nav-next a:hover,
.image-navigation .nav-previous a:hover:after, .image-navigation .nav-next a:hover:after{
	color: {$colors['text_link']};
	background-color: {$colors['inverse_text']};
}

/* Video */
.trx_addons_video_player.with_cover .video_hover,
.format-video .post_featured.with_thumb .post_video_hover {
	background-color: {$colors['inverse_text']};
	color: {$colors['text_hover']};
}
.trx_addons_video_player.with_cover .video_hover:hover,
.format-video .post_featured.with_thumb .post_video_hover:hover {
	background-color: {$colors['inverse_text_06']};
}
.sidebar_inner .trx_addons_video_player.with_cover .video_hover {
	color: {$colors['alter_link']};
}
.sidebar_inner .trx_addons_video_player.with_cover .video_hover:hover {
	color: {$colors['inverse_hover']};
	background-color: {$colors['alter_link']};
}

/* Chess */
.post_layout_chess .post_content_inner:after {
	background: linear-gradient(to top, {$colors['bg_color']} 0%, {$colors['bg_color_0']} 100%) no-repeat scroll right top / 100% 100% {$colors['bg_color_0']};
}
.post_layout_chess_1 .post_meta:before {
	background-color: {$colors['bd_color']};
}

/* Pagination */
.nav-links-old {
	color: {$colors['text_link']};
}
.nav-links-old a:hover {
	color: {$colors['text_hover']};
}

div.esg-pagination .esg-pagination-button,
.page_links > a,
.comments_pagination .page-numbers,
.nav-links .page-numbers {
	color: {$colors['text_link']};
	background-color: transparent;
}
div.esg-pagination .esg-pagination-button:hover,
div.esg-pagination .esg-pagination-button.selected,
.page_links > a:hover,
.page_links > span:not(.page_links_title),
.comments_pagination a.page-numbers:hover,
.comments_pagination .page-numbers.current,
.nav-links a.page-numbers:hover,
.nav-links .page-numbers.current {
	color: {$colors['text_hover']};
}

/* Single post */
.post_item_single .post_header .post_date {
	color: {$colors['text_light']};
}
.post_item_single .post_header .post_categories,
.post_item_single .post_header .post_categories a {
	color: {$colors['text_link']};
}
.post_item_single .post_header .post_meta_item,
.post_item_single .post_header .post_meta_item:before,
.post_item_single .post_header .post_meta_item a,
.post_item_single .post_header .post_meta_item a:before,
.post_item_single .post_header .post_meta_item .socials_caption,
.post_item_single .post_header .post_meta_item .socials_caption:before,
.post_item_single .post_header .post_edit a {
	color: {$colors['text_light']};
}
.post_item_single .post_meta_item:hover,
.post_item_single .post_header .post_meta_item:hover:before,
.post_item_single .post_header .post_meta_item a:hover:before,
.post_item_single .post_meta_item > a:hover,
.post_item_single .post_meta_item .socials_caption:hover,
.post_item_single .post_edit a:hover {
	color: {$colors['text_hover']};
}
.post_item_single .post_content .post_meta_label,
.post_item_single .post_content .post_meta_item:hover .post_meta_label {
	color: {$colors['text_dark']};
}
.post_item_single .post_content .post_tags{
	color: {$colors['text_link']};
}
.post_item_single .post_content .post_tags a {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}
.post_item_single .post_content .post_tags a:hover {
	background-color: {$colors['text_hover']};
}
.post_item_single .post_content .post_meta .post_share .social_item .social_icon {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_link']};
}
.post_item_single .post_content .post_meta .post_share .social_item:hover .social_icon {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_hover']};
}

.post-password-form input[type="submit"] {
	border-color: {$colors['text_dark']};
}
.post-password-form input[type="submit"]:hover,
.post-password-form input[type="submit"]:focus {
	color: {$colors['bg_color']};
}

/* Single post navi */
.nav-links-single .nav-links {
	border-color: {$colors['bd_color']};
}

.nav-links-single .nav-links .nav-previous .nav-arrow,
.nav-links-single .nav-links .nav-next .nav-arrow{
	background-color: {$colors['alter_bg_color']};	
}
.nav-links-single .nav-links .nav-previous .nav-arrow:before,
.nav-links-single .nav-links .nav-next .nav-arrow:before{
	background-color: {$colors['text_hover']};	
}
.nav-links-single .nav-links .nav-previous .nav-arrow:after,
.nav-links-single .nav-links .nav-next .nav-arrow:after{
	color: {$colors['inverse_text']};	
}
.nav-links-single .nav-links a{
	color: {$colors['text_link']};
}
.nav-links-single .nav-links a .meta-nav {
	color: {$colors['text_light']};
}
.nav-links-single .nav-links a .post_date {
	color: {$colors['text_light']};
}
.nav-links-single .nav-links a:hover .meta-nav,
.nav-links-single .nav-links a:hover .post_date {
	color: {$colors['text_dark']};
}
.nav-links-single .nav-links a .post-title {
	color: {$colors['text_link']};
}
.nav-links-single .nav-links a:hover .post-title {
	color: {$colors['text_hover']};
}

/* Author info */
.author_info {
	color: {$colors['text']};
	background-color: {$colors['alter_bg_color']};
}
.author_info .author_subtitle {
	color: {$colors['text_hover']};
}
.author_info .author_title {
	color: {$colors['text_link']};
}
.author_info a {
	color: {$colors['alter_link']};
}
.author_info a:hover {
	color: {$colors['text_hover']};
}
.author_info .socials_wrap .social_item .social_icon {
	color: {$colors['text_hover']};
}
.author_info .socials_wrap .social_item:hover .social_icon {
	color: {$colors['text_link']};
}

/* Related posts */
.related_wrap .related_item_style_1 .post_header {
	background-color: {$colors['bg_color_07']};
}
.related_wrap .related_item_style_1:hover .post_header {
	background-color: {$colors['bg_color']};
}
.related_wrap .related_item_style_1 .post_date a {
	color: {$colors['text_link']};
}
.related_wrap .related_item_style_1:hover .post_date a {
	color: {$colors['text_link']};
}
.related_wrap .related_item_style_1:hover .post_date a:hover {
	color: {$colors['text_link']};
}

.related_wrap .post_header .post_title a:hover{
	color: {$colors['text_hover']};
}

/* Comments */
.comments_list_wrap,
.comments_list_wrap > ul {
	border-color: {$colors['bd_color']};
}
.comments_list_wrap .comment_body{
	background-color: {$colors['alter_bg_color']};
}
.comments_list_wrap .bypostauthor > .comment_body .comment_author_avatar:after {
	border-color: {$colors['text_hover']};
}
.comments_list_wrap .comment_info {
	color: {$colors['text_dark']};
}
.comments_list_wrap .comment_info .comment_posted{
	color: {$colors['text_light']};
}

.comments_list_wrap .comment_counters a {
	color: {$colors['text_link']};
}
.comments_list_wrap .comment_counters a:before {
	color: {$colors['text_link']};
}
.comments_list_wrap .comment_counters a:hover:before,
.comments_list_wrap .comment_counters a:hover {
	color: {$colors['text_hover']};
}
.comments_list_wrap .comment_text {
	color: {$colors['text']};
}
.comments_list_wrap .comment_reply a {
	color: {$colors['text_hover']};
}
.comments_list_wrap .comment_reply a:hover {
	color: {$colors['alter_link']};
}
.comments_wrap .comments_notes {
	color: {$colors['text_light']};
}
.page_content_wrap .comments_wrap .comments_field input,
.page_content_wrap .comments_wrap .comments_field textarea{
	border-color: {$colors['bd_color']};
}
.comments_list_wrap .comment_text table > tbody > tr:first-child > th{
	background-color: {$colors['text_hover']}; 
}


/* Page 404 */
.post_item_404 .page_title {
	color: {$colors['text_light']};
}
.post_item_404 .page_description {
	color: {$colors['text_link']};
}


/* Sidebar */
.scheme_self.sidebar .sidebar_inner {
	background-color: {$colors['alter_bg_color']};
	color: {$colors['alter_text']};
}
.sidebar_inner .widget + .widget {
	border-color: {$colors['bd_color']};
}
.scheme_self.sidebar .widget + .widget {
	border-color: {$colors['alter_bd_color']};
}
.scheme_self.sidebar h1, .scheme_self.sidebar h2, .scheme_self.sidebar h3, .scheme_self.sidebar h4, .scheme_self.sidebar h5, .scheme_self.sidebar h6,
.scheme_self.sidebar h1 a, .scheme_self.sidebar h2 a, .scheme_self.sidebar h3 a, .scheme_self.sidebar h4 a, .scheme_self.sidebar h5 a, .scheme_self.sidebar h6 a {
	color: {$colors['alter_dark']};
}
.scheme_self.sidebar h1 a:hover, .scheme_self.sidebar h2 a:hover, .scheme_self.sidebar h3 a:hover, .scheme_self.sidebar h4 a:hover, .scheme_self.sidebar h5 a:hover, .scheme_self.sidebar h6 a:hover {
	color: {$colors['alter_link']};
}


/* Widgets */
.scheme_self.sidebar a {
	color: {$colors['alter_link']};
}
.scheme_self.sidebar a:hover {
	color: {$colors['alter_hover']};
}
.scheme_self.sidebar li > a,
.scheme_self.sidebar .post_title > a {
	color: {$colors['text']};
}
.scheme_self.sidebar li > a:hover,
.scheme_self.sidebar .post_title > a:hover {
	color: {$colors['alter_link']};
}

.scheme_self.sidebar .post_info .post_info_item,
.scheme_self.sidebar .post_info .post_info_item a,
.scheme_self.sidebar .post_item .post_categories, 
.scheme_self.sidebar .post_item .post_categories a,
.scheme_self.sidebar .post_info_counters .post_counters_item,
.scheme_self.sidebar .post_counters .socials_share .socials_caption:before{
	color: {$colors['alter_text']};
}

.scheme_self.sidebar .post_info .post_info_item a:hover,
.scheme_self.sidebar .post_info .post_info_item a:hover:before,
.scheme_self.sidebar .post_item .post_categories a:hover,
.scheme_self.sidebar .post_info_counters .post_counters_item:hover,
.scheme_self.sidebar .post_info_counters .post_counters_item:hover:before,
.scheme_self.sidebar .post_counters .socials_share .socials_caption:hover:before{
	color: {$colors['alter_hover']};
}

/* Archive */
.scheme_self.sidebar .widget_archive li {
	color: {$colors['alter_dark']};
}

/* Calendar */
.widget_calendar caption,
.widget_calendar tbody td a,
.widget_calendar th {
	color: {$colors['alter_link']};
}
.scheme_self.sidebar .widget_calendar caption,
.scheme_self.sidebar .widget_calendar tbody td a,
.scheme_self.sidebar .widget_calendar th {
	color: {$colors['text_dark']};
}
.widget_calendar tbody td {
	color: {$colors['text']} !important;
}
.scheme_self.sidebar .widget_calendar tbody td {
	color: {$colors['alter_text']} !important;
}
.widget_calendar tbody td a:hover {
	color: {$colors['text_hover']};
}
.scheme_self.sidebar .widget_calendar tbody td a:hover {
	color: {$colors['text_hover']};
}
.widget_calendar td#today {
	color: {$colors['extra_text']} !important;
}
.widget_calendar td#today a {
	color: {$colors['extra_text']};
}
.widget_calendar td#today a:hover {
	color: {$colors['extra_text']};
}
.scheme_self .widget_calendar td#today:before,
.scheme_self.sidebar .widget_calendar td#today:before,
.scheme_self.footer_wrap .widget_calendar td#today:before{
	background-color: {$colors['alter_link']};
}
.scheme_self .widget_calendar td#today:hover:before,
.scheme_self.sidebar .widget_calendar td#today:hover:before,
.scheme_self.footer_wrap .widget_calendar td#today:hover:before{
	background-color: {$colors['alter_hover']};
}
.scheme_self.footer_wrap .widget_calendar td#today:hover:before{
	color: {$colors['alter_link']} !important;
}

.widget_calendar #prev a,
.widget_calendar #next a {
	color: {$colors['alter_link']};
}
.scheme_self.sidebar .widget_calendar #prev a,
.scheme_self.sidebar .widget_calendar #next a {
	color: {$colors['alter_link']};
}
.widget_calendar #prev a:hover,
.widget_calendar #next a:hover {
	color: {$colors['text_hover']};
}
.scheme_self.sidebar .widget_calendar #prev a:hover,
.scheme_self.sidebar .widget_calendar #next a:hover {
	color: {$colors['alter_hover']};
}
.scheme_self .widget_calendar td#prev a:before,
.scheme_self .widget_calendar td#next a:before {
	background-color: {$colors['alter_bg_color']};
}

.scheme_self.sidebar.widget_calendar td#prev a:before,
.scheme_self.sidebar.widget_calendar td#next a:before {
	background-color: {$colors['alter_bg_color']};
}
.scheme_self.sidebar .widget_calendar td#prev a:before,
.scheme_self.sidebar .widget_calendar td#next a:before {
	background-color: {$colors['alter_bg_color']};
}

/* Categories */
.widget_categories li {
	color: {$colors['text_dark']};
}
.scheme_self.sidebar .widget_categories li {
	color: {$colors['alter_dark']};
}

/* Tag cloud */
.widget_product_tag_cloud a,
.widget_tag_cloud a,
.scheme_self.footer_wrap .widget_product_tag_cloud a,
.scheme_self.footer_wrap .widget_tag_cloud a {
	color: {$colors['extra_text']};
	background-color: {$colors['alter_link']};
}
.scheme_self.sidebar .widget_product_tag_cloud a,
.scheme_self.sidebar .widget_tag_cloud a {
	color: {$colors['extra_text']} ;
	background-color: {$colors['alter_link']};
}
.widget_product_tag_cloud a:hover,
.widget_tag_cloud a:hover {
	color: {$colors['inverse_text']} !important;
	background-color: {$colors['text_hover']};
}
.scheme_self.sidebar .widget_product_tag_cloud a:hover,
.scheme_self.sidebar .widget_tag_cloud a:hover {
	background-color: {$colors['alter_hover']};
}

/* RSS */
.widget_rss .widget_title a:first-child {
	color: {$colors['alter_link']};
}
.scheme_self.sidebar .widget_rss .widget_title a:first-child {
	color: {$colors['alter_link']};
}
.widget_rss .widget_title a:first-child:hover {
	color: {$colors['text_hover']};
}
.scheme_self.sidebar .widget_rss .widget_title a:first-child:hover {
	color: {$colors['text_hover']};
}
.widget_rss .rss-date {
	color: {$colors['text_light']};
}
.scheme_self.sidebar .widget_rss .rss-date {
	color: {$colors['alter_light']};
}

/* Footer */
.scheme_self.footer_wrap,
.footer_wrap .scheme_self.vc_row {
	background-color: {$colors['alter_bg_color']};
	color: {$colors['alter_link']};
}
.scheme_self.footer_wrap .widget,
.scheme_self.footer_wrap .sc_content .wpb_column,
.footer_wrap .scheme_self.vc_row .widget,
.footer_wrap .scheme_self.vc_row .sc_content .wpb_column {
	border-color: {$colors['alter_bd_color']};
}
.scheme_self.footer_wrap h1, .scheme_self.footer_wrap h2, .scheme_self.footer_wrap h3,
.scheme_self.footer_wrap h4, .scheme_self.footer_wrap h5, .scheme_self.footer_wrap h6,
.scheme_self.footer_wrap h1 a, .scheme_self.footer_wrap h2 a, .scheme_self.footer_wrap h3 a,
.scheme_self.footer_wrap h4 a, .scheme_self.footer_wrap h5 a, .scheme_self.footer_wrap h6 a,
.footer_wrap .scheme_self.vc_row h1, .footer_wrap .scheme_self.vc_row h2, .footer_wrap .scheme_self.vc_row h3,
.footer_wrap .scheme_self.vc_row h4, .footer_wrap .scheme_self.vc_row h5, .footer_wrap .scheme_self.vc_row h6,
.footer_wrap .scheme_self.vc_row h1 a, .footer_wrap .scheme_self.vc_row h2 a, .footer_wrap .scheme_self.vc_row h3 a,
.footer_wrap .scheme_self.vc_row h4 a, .footer_wrap .scheme_self.vc_row h5 a, .footer_wrap .scheme_self.vc_row h6 a {
	color: {$colors['alter_link']};
}
.scheme_self.footer_wrap h1 a:hover, .scheme_self.footer_wrap h2 a:hover, .scheme_self.footer_wrap h3 a:hover,
.scheme_self.footer_wrap h4 a:hover, .scheme_self.footer_wrap h5 a:hover, .scheme_self.footer_wrap h6 a:hover,
.footer_wrap .scheme_self.vc_row h1 a:hover, .footer_wrap .scheme_self.vc_row h2 a:hover, .footer_wrap .scheme_self.vc_row h3 a:hover,
.footer_wrap .scheme_self.vc_row h4 a:hover, .footer_wrap .scheme_self.vc_row h5 a:hover, .footer_wrap .scheme_self.vc_row h6 a:hover {
	color: {$colors['alter_link']};
}
.scheme_self.footer_wrap .widget li:before,
.footer_wrap .scheme_self.vc_row .widget li:before {
	background-color: transparent;
	color: {$colors['alter_link']};
}
.scheme_self.footer_wrap .widget li:hover:before,
.footer_wrap .scheme_self.vc_row .widget li:hover:before {
	color: {$colors['extra_hover_06']};
}
.scheme_self.footer_wrap a,
.footer_wrap .scheme_self.vc_row a {
	color: {$colors['alter_link']};
}
.scheme_self.footer_wrap a:hover,
.footer_wrap .scheme_self.vc_row a:hover {
	color: {$colors['extra_hover_06']};
}

.footer_logo_inner {
	border-color: {$colors['alter_bd_color']};
}
.footer_logo_inner:after {
	background-color: {$colors['alter_text']};
}
.footer_socials_inner .social_item .social_icon {
	color: {$colors['alter_text']};
}
.footer_socials_inner .social_item:hover .social_icon {
	color: {$colors['alter_dark']};
}
.menu_footer_nav_area ul li a {
	color: {$colors['alter_link']};
}
.menu_footer_nav_area ul li a:hover {
	color: {$colors['alter_link_06']};
}

.menu_footer_nav_area ul li ul li a {
	color: {$colors['alter_link']};
}
.menu_footer_nav_area ul li ul li a:hover {
	color: {$colors['alter_link_06']};
}
.menu_footer_nav_area ul li+li:before {
	border-color: {$colors['alter_light']};
}
.menu_footer_nav_area > ul > li ul,
.footer_wrap .sc_layouts_menu > ul > li ul {
	border-color: {$colors['extra_bd_color']};
}

.footer_copyright_inner {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
	color: {$colors['text_dark']};
}
.footer_copyright_inner a {
	color: {$colors['text_dark']};
}
.footer_copyright_inner a:hover {
	color: {$colors['text_link']};
}
.footer_copyright_inner .copyright_text {
	color: {$colors['text']};
}

/* Third-party plugins */

.mfp-bg {
	background-color: {$colors['bg_color_07']};
}
.mfp-image-holder .mfp-close,
.mfp-iframe-holder .mfp-close,
.mfp-close-btn-in .mfp-close {
	color: {$colors['text_dark']};
	background-color: transparent;
}
.mfp-image-holder .mfp-close:hover,
.mfp-iframe-holder .mfp-close:hover,
.mfp-close-btn-in .mfp-close:hover {
	color: {$colors['text_link']};
}

/* Essential Grid */
.esg-grid h1, .esg-grid h2, .esg-grid h3, .esg-grid h4, .esg-grid h5, .esg-grid h6, 
.esg-grid h1 a, .esg-grid h2 a, .esg-grid h3 a, .esg-grid h4 a, .esg-grid h5 a, .esg-grid h6 a, 
.esg-grid a {
color: {$colors['inverse_text']};
}
.esg-grid a:hover{
	color: {$colors['inverse_text_06']};
}

.esg-grid .eg-greenthumb-skin-2-wrapper:nth-child(2n) .eg-greenthumb-skin-2-container{
	background-color: {$colors['text_hover_07']} !important;
}


CSS;
				
					$rez = apply_filters('greenthumb_filter_get_css', $rez, $colors, false, $scheme);
					$css['colors'] .= $rez['colors'];
				}
			}
		}
				
		$css_str = (!empty($css['fonts']) ? $css['fonts'] : '')
				. (!empty($css['colors']) ? $css['colors'] : '');
		return apply_filters( 'greenthumb_filter_prepare_css', $css_str, $remove_spaces );
	}
}
?>