<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0.22
 */

if (!defined("GREENTHUMB_THEME_FREE")) define("GREENTHUMB_THEME_FREE", false);

// Theme storage
$GREENTHUMB_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array_merge(

		// List of plugins for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			// Required plugins
			// DON'T COMMENT OR REMOVE NEXT LINES!
			'trx_addons'					=> esc_html__('ThemeREX Addons', 'greenthumb'),
			
			// Recommended (supported) plugins
			// If plugin not need - comment (or remove) it
			'mailchimp-for-wp'				=> esc_html__('MailChimp for WP', 'greenthumb'),
		),

		// List of plugins for PREMIUM version only
		//-----------------------------------------------------
		GREENTHUMB_THEME_FREE ? array() : array(

			// Recommended (supported) plugins
			// If plugin not need - comment (or remove) it
			'js_composer'					=> esc_html__('Visual Composer', 'greenthumb'),
			'essential-grid'				=> esc_html__('Essential Grid', 'greenthumb'),
			'revslider'						=> esc_html__('Revolution Slider', 'greenthumb')
		)
	),
	
	// Theme-specific URLs (will be escaped in place of the output)
	'theme_demo_url' => 'http://greenthumb.themerex.net',
	'theme_doc_url' => 'http://greenthumb.themerex.net/doc',
	'theme_support_url' => 'https://themerex.ticksy.com',
	'theme_download_url' => 'https://themeforest.net/user/themerex/portfolio'
);

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( !function_exists('greenthumb_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'greenthumb_customizer_theme_setup1', 1 );
	function greenthumb_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		greenthumb_storage_set('settings', array(
			
			'duplicate_options'		=> 'child',		// none  - use separate options for template and child-theme
													// child - duplicate theme options from the main theme to the child-theme only
													// both  - sinchronize changes in the theme options between main and child themes
			
			'custmize_refresh'		=> 'auto',		// Refresh method for preview area in the Appearance - Customize:
													// auto - refresh preview area on change each field with Theme Options
													// manual - refresh only obn press button 'Refresh' at the top of Customize frame
		
			'max_load_fonts'		=> 5,			// Max fonts number to load from Google fonts or from uploaded fonts
		
			'comment_maxlength'		=> 1000,		// Max length of the message from contact form

			'comment_after_name'	=> true,		// Place 'comment' field before the 'name' and 'email'
			
			'socials_type'			=> 'icons',		// Type of socials:
													// icons - use font icons to present social networks
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_type'			=> 'icons',		// Type of other icons:
													// icons - use font icons to present icons
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_selector'		=> 'internal',	// Icons selector in the shortcodes:
													// vc (default) - standard VC icons selector (very slow and don't support images)
													// internal - internal popup with plugin's or theme's icons list (fast)
			'disable_jquery_ui'		=> false,		// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'use_mediaelements'		=> true,		// Load script "Media Elements" to play video and audio
			
			'tgmpa_upload'			=> false,		// Allow upload not pre-packaged plugins via TGMPA
			
			'allow_theme_layouts'	=> true		// Include theme's default headers and footers to the list after custom layouts
													// or leave in the list only custom layouts
		));


		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		greenthumb_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Open Sans',
				'family' => 'sans-serif',
				'styles' => '300,300i,400,400i,600,600i,700,700i'		// Parameter 'style' used only for the Google fonts
				),
			// Font-face packed with theme
			array(
				'name'   => 'Shabrina',
				'family' => 'sans-serif'
				)
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		greenthumb_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tagss
		greenthumb_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'greenthumb'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'greenthumb'),
				'font-family'		=> '"Open Sans",sans-serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.75em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'greenthumb'),
				'font-family'		=> '"Shabrina",sans-serif',
				'font-size' 		=> '6.250em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.85em',
				'margin-bottom'		=> '0.36em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'greenthumb'),
				'font-family'		=> '"Shabrina",sans-serif',
				'font-size' 		=> '5.313em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.753em',
				'margin-bottom'		=> '0.4em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'greenthumb'),
				'font-family'		=> '"Open Sans",sans-serif',
				'font-size' 		=> '3.438em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.025em',
				'margin-top'		=> '1.091em',
				'margin-bottom'		=> '0.8em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'greenthumb'),
				'font-family'		=> '"Open Sans",sans-serif',
				'font-size' 		=> '2.813em',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.111em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.025em',
				'margin-top'		=> '1.3em',
				'margin-bottom'		=> '0.9em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'greenthumb'),
				'font-family'		=> '"Open Sans",sans-serif',
				'font-size' 		=> '1.875em',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.267em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.025em',
				'margin-top'		=> '2em',
				'margin-bottom'		=> '1em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'greenthumb'),
				'font-family'		=> '"Open Sans",sans-serif',
				'font-size' 		=> '1.125em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.667em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.025em',
				'margin-top'		=> '2.8em',
				'margin-bottom'		=> '1.6em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'greenthumb'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'greenthumb'),
				'font-family'		=> '"Open Sans",sans-serif',
				'font-size' 		=> '1.8em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'greenthumb'),
				'font-family'		=> '"Open Sans",sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				),

			'input' => array(
				'title'				=> esc_html__('Input fields', 'greenthumb'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'greenthumb'),
				'font-family'		=> 'inherit',
				'font-size' 		=> '1.5em',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.3em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
			),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'greenthumb'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'greenthumb'),
				'font-family'		=> 'inherit',
				'font-size' 		=> '14px',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0px',
				'margin-bottom'		=> '2em'
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'greenthumb'),
				'description'		=> esc_html__('Font settings of the main menu items', 'greenthumb'),
				'font-family'		=> 'Open Sans",sans-serif',
				'font-size' 		=> '15px',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.625em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.2px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'greenthumb'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'greenthumb'),
				'font-family'		=> '"Open Sans",sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		greenthumb_storage_set('scheme_color_groups', array(
			'main'	=> array(
							'title'			=> __('Main', 'greenthumb'),
							'description'	=> __('Colors of the main content area', 'greenthumb')
							),
			'alter'	=> array(
							'title'			=> __('Alter', 'greenthumb'),
							'description'	=> __('Colors of the alternative blocks (sidebars, etc.)', 'greenthumb')
							),
			'extra'	=> array(
							'title'			=> __('Extra', 'greenthumb'),
							'description'	=> __('Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'greenthumb')
							),
			'inverse' => array(
							'title'			=> __('Inverse', 'greenthumb'),
							'description'	=> __('Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'greenthumb')
							),
			'input'	=> array(
							'title'			=> __('Input', 'greenthumb'),
							'description'	=> __('Colors of the form fields (text field, textarea, select, etc.)', 'greenthumb')
							),
			)
		);
		greenthumb_storage_set('scheme_color_names', array(
			'bg_color'	=> array(
							'title'			=> __('Background color', 'greenthumb'),
							'description'	=> __('Background color of this block in the normal state', 'greenthumb')
							),
			'bg_hover'	=> array(
							'title'			=> __('Background hover', 'greenthumb'),
							'description'	=> __('Background color of this block in the hovered state', 'greenthumb')
							),
			'bd_color'	=> array(
							'title'			=> __('Border color', 'greenthumb'),
							'description'	=> __('Border color of this block in the normal state', 'greenthumb')
							),
			'bd_hover'	=>  array(
							'title'			=> __('Border hover', 'greenthumb'),
							'description'	=> __('Border color of this block in the hovered state', 'greenthumb')
							),
			'text'		=> array(
							'title'			=> __('Text', 'greenthumb'),
							'description'	=> __('Color of the plain text inside this block', 'greenthumb')
							),
			'text_dark'	=> array(
							'title'			=> __('Text dark', 'greenthumb'),
							'description'	=> __('Color of the dark text (bold, header, etc.) inside this block', 'greenthumb')
							),
			'text_light'=> array(
							'title'			=> __('Text light', 'greenthumb'),
							'description'	=> __('Color of the light text (post meta, etc.) inside this block', 'greenthumb')
							),
			'text_link'	=> array(
							'title'			=> __('Link', 'greenthumb'),
							'description'	=> __('Color of the links inside this block', 'greenthumb')
							),
			'text_hover'=> array(
							'title'			=> __('Link hover', 'greenthumb'),
							'description'	=> __('Color of the hovered state of links inside this block', 'greenthumb')
							),
			'text_link2'=> array(
							'title'			=> __('Link 2', 'greenthumb'),
							'description'	=> __('Color of the accented texts (areas) inside this block', 'greenthumb')
							),
			'text_hover2'=> array(
							'title'			=> __('Link 2 hover', 'greenthumb'),
							'description'	=> __('Color of the hovered state of accented texts (areas) inside this block', 'greenthumb')
							),
			'text_link3'=> array(
							'title'			=> __('Link 3', 'greenthumb'),
							'description'	=> __('Color of the other accented texts (buttons) inside this block', 'greenthumb')
							),
			'text_hover3'=> array(
							'title'			=> __('Link 3 hover', 'greenthumb'),
							'description'	=> __('Color of the hovered state of other accented texts (buttons) inside this block', 'greenthumb')
							)
			)
		);
		greenthumb_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'greenthumb'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#ffffff',
					'bd_color'			=> '#d1d1d1',
		
					// Text and links colors
					'text'				=> '#8f8f8f',
					'text_light'		=> '#d1d1d1',
					'text_dark'			=> '#222222',
					'text_link'			=> '#222222',
					'text_hover'		=> '#71a600',
					'text_link2'		=> '#222222',
					'text_hover2'		=> '#71a600',
					'text_link3'		=> '#222222',
					'text_hover3'		=> '#71a600',
		
					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#f0f0f0',
					'alter_bg_hover'	=> '',
					'alter_bd_color'	=> '#e5e5e5',
					'alter_bd_hover'	=> '',
					'alter_text'		=> '#8f8f8f',
					'alter_light'		=> '#b7b7b7',
					'alter_dark'		=> '#1d1d1d',
					'alter_link'		=> '#222222',
					'alter_hover'		=> '#71a600',
					'alter_link2'		=> '#8be77c',
					'alter_hover2'		=> '#80d572',
					'alter_link3'		=> '#eec432',
					'alter_hover3'		=> '#ddb837',
		
					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#f0f0f0',
					'extra_bg_hover'	=> '',
					'extra_bd_color'	=> '#ffffff',
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#ffffff',
					'extra_light'		=> '#e5e5e5',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#222222',
					'extra_hover'		=> '#71a600',
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'	=> 'transparent',
					'input_bg_hover'	=> 'transparent',
					'input_bd_color'	=> '#d1d1d1',
					'input_bd_hover'	=> '#d1d1d1',
					'input_text'		=> '#222222',
					'input_light'		=> '#d0d0d0',
					'input_dark'		=> '#1d1d1d',
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#67bcc1',
					'inverse_bd_hover'	=> '#5aa4a9',
					'inverse_text'		=> '#ffffff',
					'inverse_light'		=> '#8f8f8f',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'greenthumb'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#ffffff',
					'bd_color'			=> '#d1d1d1',
		
					// Text and links colors
					'text'				=> '#8f8f8f',
					'text_light'		=> '#d1d1d1',
					'text_dark'			=> '#222222',
					'text_link'			=> '#222222',
					'text_hover'		=> '#71a600',
					'text_link2'		=> '#222222',
					'text_hover2'		=> '#71a600',
					'text_link3'		=> '#222222',
					'text_hover3'		=> '#71a600',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#222222',
					'alter_bg_hover'	=> '',
					'alter_bd_color'	=> '#e5e5e5',
					'alter_bd_hover'	=> '#3d3d3d',
					'alter_text'		=> '#8f8f8f',
					'alter_light'		=> '#5f5f5f',
					'alter_dark'		=> '#ffffff',
					'alter_link'		=> '#ffffff',
					'alter_hover'		=> '#71a600',
					'alter_link2'		=> '#8be77c',
					'alter_hover2'		=> '#80d572',
					'alter_link3'		=> '#eec432',
					'alter_hover3'		=> '#ddb837',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#f0f0f0',
					'extra_bg_hover'	=> '',
					'extra_bd_color'	=> '#ffffff',
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#222222',
					'extra_light'		=> '#e5e5e5',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#ffffff',
					'extra_hover'		=> '#ffffff',
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'	=> 'transparent',
					'input_bg_hover'	=> 'transparent',
					'input_bd_color'	=> '#434343',
					'input_bd_hover'	=> '#434343',
					'input_text'		=> '#8f8f8f',
					'input_light'		=> '#5f5f5f',
					'input_dark'		=> '#ffffff',
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#e36650',
					'inverse_bd_hover'	=> '#cb5b47',
					'inverse_text'		=> '#ffffff',
					'inverse_light'		=> '#ffffff',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			)
		
		));
		
		// Simple schemes substitution
		greenthumb_storage_set('schemes_simple', array(
			// Main color	// Slave elements and it's darkness koef.
			'text_link'		=> array('alter_hover' => 1,	'extra_link' => 1, 'inverse_bd_color' => 0.85, 'inverse_bd_hover' => 0.7),
			'text_hover'	=> array('alter_link' => 1,		'extra_hover' => 1),
			'text_link2'	=> array('alter_hover2' => 1,	'extra_link2' => 1),
			'text_hover2'	=> array('alter_link2' => 1,	'extra_hover2' => 1),
			'text_link3'	=> array('alter_hover3' => 1,	'extra_link3' => 1),
			'text_hover3'	=> array('alter_link3' => 1,	'extra_hover3' => 1)
		));
	}
}

			
// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('greenthumb_customizer_add_theme_colors')) {
	function greenthumb_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['bg_color_0']  = greenthumb_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_02']  = greenthumb_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_07']  = greenthumb_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bg_color_08']  = greenthumb_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['bg_color_09']  = greenthumb_hex2rgba( $colors['bg_color'], 0.9 );
			$colors['alter_bg_color_07']  = greenthumb_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_04']  = greenthumb_hex2rgba( $colors['alter_bg_color'], 0.4 );
			$colors['alter_bg_color_02']  = greenthumb_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = greenthumb_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['alter_link_06']  = greenthumb_hex2rgba( $colors['alter_link'], 0.6 );
			$colors['extra_bg_color_07']  = greenthumb_hex2rgba( $colors['extra_bg_color'], 0.7 );
			$colors['extra_bd_color_01']  = greenthumb_hex2rgba( $colors['extra_bd_color'], 0.1 );
			$colors['extra_bd_color_03']  = greenthumb_hex2rgba( $colors['extra_bd_color'], 0.3 );
			$colors['extra_hover_05']  = greenthumb_hex2rgba( $colors['extra_hover'], 0.5 );
			$colors['extra_hover_06']  = greenthumb_hex2rgba( $colors['extra_hover'], 0.6 );
			$colors['text_dark_07']  = greenthumb_hex2rgba( $colors['text_dark'], 0.7 );
			$colors['text_link_02']  = greenthumb_hex2rgba( $colors['text_link'], 0.2 );
			$colors['text_link_07']  = greenthumb_hex2rgba( $colors['text_link'], 0.7 );
			$colors['text_hover_07']  = greenthumb_hex2rgba( $colors['text_hover'], 0.7 );
			$colors['inverse_text_02']  = greenthumb_hex2rgba( $colors['inverse_text'], 0.2 );
			$colors['inverse_text_06']  = greenthumb_hex2rgba( $colors['inverse_text'], 0.6 );
			$colors['inverse_text_07']  = greenthumb_hex2rgba( $colors['inverse_text'], 0.7 );
			$colors['inverse_dark_03']  = greenthumb_hex2rgba( $colors['inverse_dark'], 0.3 );
			$colors['text_link_blend'] = greenthumb_hsb2hex(greenthumb_hex2hsb( $colors['text_link'], 2, -5, 5 ));
			$colors['alter_link_blend'] = greenthumb_hsb2hex(greenthumb_hex2hsb( $colors['alter_link'], 2, -5, 5 ));
		} else {
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['bg_color_09'] = '{{ data.bg_color_09 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_link_06'] = '{{ data.alter_link_06 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['extra_bg_color_07'] = '{{ data.extra_bg_color_07 }}';
			$colors['extra_bd_color_01'] = '{{ data.extra_bd_color_01 }}';
			$colors['extra_bd_color_03'] = '{{ data.extra_bd_color_03 }}';
			$colors['extra_hover_05'] = '{{ data.extra_hover_05 }}';
			$colors['extra_hover_06'] = '{{ data.extra_hover_06 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
			$colors['text_hover_07'] = '{{ data.text_hover_07 }}';
			$colors['inverse_text_02'] = '{{ data.inverse_text_02 }}';
			$colors['inverse_text_06'] = '{{ data.inverse_text_06 }}';
			$colors['inverse_text_07'] = '{{ data.inverse_text_07 }}';
			$colors['inverse_dark_03'] = '{{ data.inverse_dark_03 }}';
			$colors['text_link_blend'] = '{{ data.text_link_blend }}';
			$colors['alter_link_blend'] = '{{ data.alter_link_blend }}';
		}
		return $colors;
	}
}


			
// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('greenthumb_customizer_add_theme_fonts')) {
	function greenthumb_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {
			//$rez[$tag] = $font;
			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !greenthumb_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !greenthumb_is_inherit($font['font-size'])
														? 'font-size:' . greenthumb_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !greenthumb_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !greenthumb_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !greenthumb_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !greenthumb_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !greenthumb_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !greenthumb_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !greenthumb_is_inherit($font['margin-top'])
														? 'margin-top:' . greenthumb_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !greenthumb_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . greenthumb_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}




//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------

if ( !function_exists('greenthumb_customizer_theme_setup') ) {
	add_action( 'after_setup_theme', 'greenthumb_customizer_theme_setup' );
	function greenthumb_customizer_theme_setup() {

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('greenthumb_filter_add_thumb_sizes', array(
			'greenthumb-thumb-huge'		=> array(1170, 658, true),
			'greenthumb-thumb-big' 		=> array( 760, 428, true),
			'greenthumb-thumb-med' 		=> array( 370, 208, true),
			'greenthumb-thumb-tiny' 		=> array(  90,  90, true),
			'greenthumb-thumb-masonry-big' => array( 760,   0, false),		// Only downscale, not crop
			'greenthumb-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			)
		);
		$mult = greenthumb_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'greenthumb_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}

	}
}

if ( !function_exists('greenthumb_customizer_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'greenthumb_customizer_image_sizes' );
	function greenthumb_customizer_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('greenthumb_filter_add_thumb_sizes', array(
			'greenthumb-thumb-huge'		=> esc_html__( 'Huge image', 'greenthumb' ),
			'greenthumb-thumb-big'			=> esc_html__( 'Large image', 'greenthumb' ),
			'greenthumb-thumb-med'			=> esc_html__( 'Medium image', 'greenthumb' ),
			'greenthumb-thumb-tiny'		=> esc_html__( 'Small square avatar', 'greenthumb' ),
			'greenthumb-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'greenthumb' ),
			'greenthumb-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'greenthumb' ),
			)
		);
		$mult = greenthumb_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'greenthumb' );
		}
		return $sizes;
	}
}

// Remove some thumb-sizes from the ThemeREX Addons list
if ( !function_exists( 'greenthumb_customizer_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'greenthumb_customizer_trx_addons_add_thumb_sizes');
	function greenthumb_customizer_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// and replace removed styles with theme-specific thumb size
if ( !function_exists( 'greenthumb_customizer_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'greenthumb_customizer_trx_addons_get_thumb_size');
	function greenthumb_customizer_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'greenthumb-thumb-huge',
							'greenthumb-thumb-huge-@retina',
							'greenthumb-thumb-big',
							'greenthumb-thumb-big-@retina',
							'greenthumb-thumb-med',
							'greenthumb-thumb-med-@retina',
							'greenthumb-thumb-tiny',
							'greenthumb-thumb-tiny-@retina',
							'greenthumb-thumb-masonry-big',
							'greenthumb-thumb-masonry-big-@retina',
							'greenthumb-thumb-masonry',
							'greenthumb-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}




//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'greenthumb_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'greenthumb_importer_set_options', 9 );
	function greenthumb_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url(greenthumb_get_protocol() . '://greenthumb.themerex.net/demo/');
			// Required plugins
			$options['required_plugins'] = array_keys(greenthumb_storage_get('required_plugins'));
			// Default demo
			$options['files']['default']['title'] = esc_html__('Greenthumb - Gardening - Demo', 'greenthumb');
			$options['files']['default']['domain_dev'] = '';		// Developers domain
			$options['files']['default']['domain_demo']= esc_url(greenthumb_get_protocol().'://greenthumb.themerex.net');		// Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter
			// For example:
			// 		$options['files']['dark_demo'] = $options['files']['default'];
			// 		$options['files']['dark_demo']['title'] = esc_html__('Dark Demo', 'greenthumb');
		}
		return $options;
	}
}




// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('greenthumb_create_theme_options')) {

	function greenthumb_create_theme_options() {

		// Message about options override. 
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = __('<b>Attention!</b> Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages', 'greenthumb');

		greenthumb_storage_set('options', array(
		
			// 'Logo & Site Identity'
			'title_tagline' => array(
				"title" => esc_html__('Logo & Site Identity', 'greenthumb'),
				"desc" => '',
				"priority" => 10,
				"type" => "section"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo in the header', 'greenthumb'),
				"desc" => '',
				"priority" => 20,
				"type" => "info",
				),
			'logo_text' => array(
				"title" => esc_html__('Use Site Name as Logo', 'greenthumb'),
				"desc" => wp_kses_data( __('Use the site title and tagline as a text logo if no image is selected', 'greenthumb') ),
				"class" => "greenthumb_column-1_2 greenthumb_new_row",
				"priority" => 30,
				"std" => 1,
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_retina_enabled' => array(
				"title" => esc_html__('Allow retina display logo', 'greenthumb'),
				"desc" => wp_kses_data( __('Show fields to select logo images for Retina display', 'greenthumb') ),
				"class" => "greenthumb_column-1_2",
				"refresh" => false,
				"std" => 0,
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo' => array(
				"title" => esc_html__('Logo', 'greenthumb'),
				"desc" => wp_kses_data( __('Select or upload site logo', 'greenthumb') ),
				"class" => "greenthumb_column-1_2 greenthumb_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'greenthumb'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'greenthumb') ),
				"class" => "greenthumb_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile' => array(
				"title" => esc_html__('Logo mobile', 'greenthumb'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile menu', 'greenthumb') ),
				"class" => "greenthumb_column-1_2 greenthumb_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_retina' => array(
				"title" => esc_html__('Logo mobile for Retina', 'greenthumb'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'greenthumb') ),
				"class" => "greenthumb_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'greenthumb'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'greenthumb') ),
				"class" => "greenthumb_column-1_2 greenthumb_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'greenthumb'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'greenthumb') ),
				"class" => "greenthumb_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "image"
				),
			
		
		
			// 'General settings'
			'general' => array(
				"title" => esc_html__('General Settings', 'greenthumb'),
				"desc" => wp_kses_data( __('Settings for the entire site', 'greenthumb') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"priority" => 20,
				"type" => "section",
				),

			'general_layout_info' => array(
				"title" => esc_html__('Layout', 'greenthumb'),
				"desc" => '',
				"type" => "info",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'greenthumb'),
				"desc" => wp_kses_data( __('Select width of the body content', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'greenthumb')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => array(
					'boxed'		=> esc_html__('Boxed',		'greenthumb'),
					'wide'		=> esc_html__('Wide',		'greenthumb'),
					'fullwide'	=> esc_html__('Fullwide',	'greenthumb'),
					'fullscreen'=> esc_html__('Fullscreen',	'greenthumb')
				),
				"type" => "select"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'greenthumb'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'greenthumb') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'greenthumb')
				),
				"std" => '',
				"hidden" => true,
				"type" => "image"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'greenthumb'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'greenthumb')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),

			'general_sidebar_info' => array(
				"title" => esc_html__('Sidebar', 'greenthumb'),
				"desc" => '',
				"type" => "info",
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'greenthumb'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'greenthumb')
				),
				"std" => 'right',
				"options" => array(),
				"type" => "switch"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'greenthumb'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'greenthumb')
				),
				"dependency" => array(
					'sidebar_position' => array('left', 'right')
				),
				"std" => 'sidebar_widgets',
				"options" => array(),
				"type" => "select"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'greenthumb'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'greenthumb') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),


			'general_widgets_info' => array(
				"title" => esc_html__('Additional widgets', 'greenthumb'),
				"desc" => '',
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "info",
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets at the top of the page', 'greenthumb'),
				"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'greenthumb')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'greenthumb'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'greenthumb')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'greenthumb'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'greenthumb')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets at the bottom of the page', 'greenthumb'),
				"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'greenthumb')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "select"
				),

			'general_effects_info' => array(
				"title" => esc_html__('Design & Effects', 'greenthumb'),
				"desc" => '',
				"type" => "info",
				),
			'border_radius' => array(
				"title" => esc_html__('Border radius', 'greenthumb'),
				"desc" => wp_kses_data( __('Specify the border radius of the form fields and buttons in pixels or other valid CSS units', 'greenthumb') ),
				"std" => 0,
				"type" => "hidden"
				),

			'general_misc_info' => array(
				"title" => esc_html__('Miscellaneous', 'greenthumb'),
				"desc" => '',
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "info",
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'greenthumb'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'greenthumb') ),
				"std" => 0,
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "checkbox"
				),
		
		
			// 'Header'
			'header' => array(
				"title" => esc_html__('Header', 'greenthumb'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 30,
				"type" => "section"
				),

			'header_style_info' => array(
				"title" => esc_html__('Header style', 'greenthumb'),
				"desc" => '',
				"type" => "info"
				),
			'header_style' => array(
				"title" => esc_html__('Header style', 'greenthumb'),
				"desc" => wp_kses_data( __('Select style to display the site header', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'greenthumb')
				),
				"std" => 'header-default',
				"options" => array(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'greenthumb'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'greenthumb')
				),
				"std" => 'default',
				"options" => array(),
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "switch"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'greenthumb'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'greenthumb')
				),
				"std" => 0,
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'greenthumb'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'greenthumb')
				),
				"dependency" => array(
					'header_style' => array('header-default')
				),
				"std" => 1,
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_widgets_info' => array(
				"title" => esc_html__('Header widgets', 'greenthumb'),
				"desc" => wp_kses_data( __('Here you can place a widget slider, advertising banners, etc.', 'greenthumb') ),
				"type" => "info"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'greenthumb'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'greenthumb'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'greenthumb') ),
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'greenthumb'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'greenthumb')
				),
				"dependency" => array(
					'header_style' => array('header-default'),
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => greenthumb_get_list_range(0,6),
				"type" => "select"
				),

			'menu_info' => array(
				"title" => esc_html__('Main menu', 'greenthumb'),
				"desc" => wp_kses_data( __('Select main menu style, position, color scheme and other parameters', 'greenthumb') ),
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'greenthumb'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'greenthumb')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'greenthumb')
				),
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "switch"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'greenthumb'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'greenthumb')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 0,
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'greenthumb'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'greenthumb')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'greenthumb'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'greenthumb') ),
				"std" => 1,
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_image_info' => array(
				"title" => esc_html__('Header image', 'greenthumb'),
				"desc" => '',
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "info"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'greenthumb'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'greenthumb') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'greenthumb')
				),
				"std" => 0,
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "checkbox"
				),


		
			// 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'greenthumb'),
				"desc" => wp_kses_data( __('Select set of widgets and columns number in the site footer', 'greenthumb') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"priority" => 50,
				"type" => "section"
				),
			'footer_style' => array(
				"title" => esc_html__('Footer style', 'greenthumb'),
				"desc" => wp_kses_data( __('Select style to display the site footer', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'greenthumb')
				),
				"std" => 'footer-default',
				"options" => array(),
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'greenthumb'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'greenthumb')
				),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 'footer_widgets',
				"options" => array(),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'greenthumb'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'greenthumb')
				),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'footer_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => greenthumb_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'greenthumb'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'greenthumb') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'greenthumb')
				),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'greenthumb'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'greenthumb') ),
				'refresh' => false,
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'greenthumb'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'greenthumb') ),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'logo_in_footer' => array(1)
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'greenthumb'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'greenthumb') ),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'logo_in_footer' => array(1),
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'greenthumb'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'greenthumb') ),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'greenthumb'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'greenthumb') ),
				"std" => esc_html__('Copyright 2017 by ThemeREX &copy; {Y}. All rights reserved.', 'greenthumb'),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"refresh" => false,
				"type" => "textarea"
				),
			
		
		
			// 'Blog'
			'blog' => array(
				"title" => esc_html__('Blog', 'greenthumb'),
				"desc" => wp_kses_data( __('Options of the the blog archive', 'greenthumb') ),
				"priority" => 70,
				"type" => "panel",
				),
		
				// Blog - Posts page
				'blog_general' => array(
					"title" => esc_html__('Posts page', 'greenthumb'),
					"desc" => wp_kses_data( __('Style and components of the blog archive', 'greenthumb') ),
					"type" => "section",
					),
				'blog_general_info' => array(
					"title" => esc_html__('General settings', 'greenthumb'),
					"desc" => '',
					"type" => "info",
					),
				'blog_style' => array(
					"title" => esc_html__('Blog style', 'greenthumb'),
					"desc" => '',
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'greenthumb')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"std" => 'excerpt',
					"options" => array(),
					"type" => "select"
					),
				'first_post_large' => array(
					"title" => esc_html__('First post large', 'greenthumb'),
					"desc" => wp_kses_data( __('Make your first post stand out by making it bigger', 'greenthumb') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'greenthumb')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
						'blog_style' => array('classic', 'masonry')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				"blog_content" => array( 
					"title" => esc_html__('Posts content', 'greenthumb'),
					"desc" => wp_kses_data( __("Display either post excerpts or the full post content", 'greenthumb') ),
					"std" => "excerpt",
					"dependency" => array(
						'blog_style' => array('excerpt')
					),
					"options" => array(
						'excerpt'	=> esc_html__('Excerpt',	'greenthumb'),
						'fullpost'	=> esc_html__('Full post',	'greenthumb')
					),
					"type" => "switch"
					),
				'excerpt_length' => array(
					"title" => esc_html__('Excerpt length', 'greenthumb'),
					"desc" => wp_kses_data( __("Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged", 'greenthumb') ),
					"dependency" => array(
						'blog_style' => array('excerpt'),
						'blog_content' => array('excerpt')
					),
					"std" => 60,
					"type" => "text"
					),
				'blog_columns' => array(
					"title" => esc_html__('Blog columns', 'greenthumb'),
					"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'greenthumb') ),
					"std" => 2,
					"options" => greenthumb_get_list_range(2,4),
					"type" => "hidden"
					),
				'post_type' => array(
					"title" => esc_html__('Post type', 'greenthumb'),
					"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'greenthumb') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'greenthumb')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"linked" => 'parent_cat',
					"refresh" => false,
					"hidden" => true,
					"std" => 'post',
					"options" => array(),
					"type" => "select"
					),
				'parent_cat' => array(
					"title" => esc_html__('Category to show', 'greenthumb'),
					"desc" => wp_kses_data( __('Select category to show in the blog archive', 'greenthumb') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'greenthumb')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"refresh" => false,
					"hidden" => true,
					"std" => '0',
					"options" => array(),
					"type" => "select"
					),
				'posts_per_page' => array(
					"title" => esc_html__('Posts per page', 'greenthumb'),
					"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'greenthumb') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'greenthumb')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"hidden" => true,
					"std" => '',
					"type" => "text"
					),
				"blog_pagination" => array( 
					"title" => esc_html__('Pagination style', 'greenthumb'),
					"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'greenthumb') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'greenthumb')
					),
					"std" => "pages",
					"options" => array(
						'pages'	=> esc_html__("Page numbers", 'greenthumb'),
						'links'	=> esc_html__("Older/Newest", 'greenthumb'),
						'more'	=> esc_html__("Load more", 'greenthumb'),
						'infinite' => esc_html__("Infinite scroll", 'greenthumb')
					),
					"type" => "select"
					),
				'show_filters' => array(
					"title" => esc_html__('Show filters', 'greenthumb'),
					"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'greenthumb') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'greenthumb')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
						'blog_style' => array('portfolio', 'gallery')
					),
					"hidden" => true,
					"std" => 0,
					"type" => GREENTHUMB_THEME_FREE ? "hidden" : "checkbox"
					),
	
				'blog_sidebar_info' => array(
					"title" => esc_html__('Sidebar', 'greenthumb'),
					"desc" => '',
					"type" => "info",
					),
				'sidebar_position_blog' => array(
					"title" => esc_html__('Sidebar position', 'greenthumb'),
					"desc" => wp_kses_data( __('Select position to show sidebar', 'greenthumb') ),
					"std" => 'right',
					"options" => array(),
					"type" => "switch"
					),
				'sidebar_widgets_blog' => array(
					"title" => esc_html__('Sidebar widgets', 'greenthumb'),
					"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'greenthumb') ),
					"dependency" => array(
						'sidebar_position_blog' => array('left', 'right')
					),
					"std" => 'sidebar_widgets',
					"options" => array(),
					"type" => "select"
					),
				'expand_content_blog' => array(
					"title" => esc_html__('Expand content', 'greenthumb'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'greenthumb') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
	
	
				'blog_widgets_info' => array(
					"title" => esc_html__('Additional widgets', 'greenthumb'),
					"desc" => '',
					"type" => GREENTHUMB_THEME_FREE ? "hidden" : "info",
					),
				'widgets_above_page_blog' => array(
					"title" => esc_html__('Widgets at the top of the page', 'greenthumb'),
					"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'greenthumb') ),
					"std" => 'hide',
					"options" => array(),
					"type" => GREENTHUMB_THEME_FREE ? "hidden" : "select"
					),
				'widgets_above_content_blog' => array(
					"title" => esc_html__('Widgets above the content', 'greenthumb'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'greenthumb') ),
					"std" => 'hide',
					"options" => array(),
					"type" => GREENTHUMB_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_content_blog' => array(
					"title" => esc_html__('Widgets below the content', 'greenthumb'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'greenthumb') ),
					"std" => 'hide',
					"options" => array(),
					"type" => GREENTHUMB_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_page_blog' => array(
					"title" => esc_html__('Widgets at the bottom of the page', 'greenthumb'),
					"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'greenthumb') ),
					"std" => 'hide',
					"options" => array(),
					"type" => GREENTHUMB_THEME_FREE ? "hidden" : "select"
					),

				'blog_advanced_info' => array(
					"title" => esc_html__('Advanced settings', 'greenthumb'),
					"desc" => '',
					"type" => "info",
					),
				'no_image' => array(
					"title" => esc_html__('Image placeholder', 'greenthumb'),
					"desc" => wp_kses_data( __('Select or upload an image used as placeholder for posts without a featured image', 'greenthumb') ),
					"std" => '',
					"type" => "image"
					),
				'time_diff_before' => array(
					"title" => esc_html__('Easy Readable Date Format', 'greenthumb'),
					"desc" => wp_kses_data( __("For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'greenthumb') ),
					"std" => 0,
					"type" => "text"
					),
				'sticky_style' => array(
					"title" => esc_html__('Sticky posts style', 'greenthumb'),
					"desc" => wp_kses_data( __('Select style of the sticky posts output', 'greenthumb') ),
					"std" => 'inherit',
					"options" => array(
						'inherit' => esc_html__('Decorated posts', 'greenthumb'),
						'columns' => esc_html__('Mini-cards',	'greenthumb')
					),
					"type" => GREENTHUMB_THEME_FREE ? "hidden" : "select"
					),
				"blog_animation" => array( 
					"title" => esc_html__('Animation for the posts', 'greenthumb'),
					"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'greenthumb') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'greenthumb')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"std" => "none",
					"options" => array(),
					"type" => GREENTHUMB_THEME_FREE ? "hidden" : "select"
					),
				'meta_parts' => array(
					"title" => esc_html__('Post meta', 'greenthumb'),
					"desc" => wp_kses_data( __("If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page.", 'greenthumb') )
								. '<br>'
								. wp_kses_data( __("<b>Tip:</b> Drag items to change their order.", 'greenthumb') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'greenthumb')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=1|date=1|counters=0|author=0|share=0|edit=0',
					"options" => array(
						'categories' => esc_html__('Categories', 'greenthumb'),
						'date'		 => esc_html__('Post date', 'greenthumb'),
						'author'	 => esc_html__('Post author', 'greenthumb'),
						'counters'	 => esc_html__('Views, Likes and Comments', 'greenthumb'),
						'share'		 => esc_html__('Share links', 'greenthumb'),
						'edit'		 => esc_html__('Edit link', 'greenthumb')
					),
					"type" => GREENTHUMB_THEME_FREE ? "hidden" : "checklist"
				),
				'counters' => array(
					"title" => esc_html__('Views, Likes and Comments', 'greenthumb'),
					"desc" => wp_kses_data( __("Likes and Views are available only if ThemeREX Addons is active", 'greenthumb') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'greenthumb')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'views=1|likes=1|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'greenthumb'),
						'likes' => esc_html__('Likes', 'greenthumb'),
						'comments' => esc_html__('Comments', 'greenthumb')
					),
					"type" => GREENTHUMB_THEME_FREE ? "hidden" : "checklist"
				),

				
				// Blog - Single posts
				'blog_single' => array(
					"title" => esc_html__('Single posts', 'greenthumb'),
					"desc" => wp_kses_data( __('Settings of the single post', 'greenthumb') ),
					"type" => "section",
					),
				'hide_featured_on_single' => array(
					"title" => esc_html__('Hide featured image on the single post', 'greenthumb'),
					"desc" => wp_kses_data( __("Hide featured image on the single post's pages", 'greenthumb') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'greenthumb')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				'hide_sidebar_on_single' => array(
					"title" => esc_html__('Hide sidebar on the single post', 'greenthumb'),
					"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'greenthumb') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'show_post_meta' => array(
					"title" => esc_html__('Show post meta', 'greenthumb'),
					"desc" => wp_kses_data( __("Display block with post's meta: date, categories, counters, etc.", 'greenthumb') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'meta_parts_post' => array(
					"title" => esc_html__('Post meta', 'greenthumb'),
					"desc" => wp_kses_data( __("Meta parts for single posts.", 'greenthumb') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=1|date=1|counters=1|author=0|share=0|edit=1',
					"options" => array(
						'categories' => esc_html__('Categories', 'greenthumb'),
						'date'		 => esc_html__('Post date', 'greenthumb'),
						'author'	 => esc_html__('Post author', 'greenthumb'),
						'counters'	 => esc_html__('Views, Likes and Comments', 'greenthumb'),
						'share'		 => esc_html__('Share links', 'greenthumb'),
						'edit'		 => esc_html__('Edit link', 'greenthumb')
					),
					"type" => GREENTHUMB_THEME_FREE ? "hidden" : "checklist"
				),
				'counters_post' => array(
					"title" => esc_html__('Views, Likes and Comments', 'greenthumb'),
					"desc" => wp_kses_data( __("Likes and Views are available only if ThemeREX Addons is active", 'greenthumb') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'views=1|likes=1|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'greenthumb'),
						'likes' => esc_html__('Likes', 'greenthumb'),
						'comments' => esc_html__('Comments', 'greenthumb')
					),
					"type" => GREENTHUMB_THEME_FREE ? "hidden" : "checklist"
				),
				'show_share_links' => array(
					"title" => esc_html__('Show share links', 'greenthumb'),
					"desc" => wp_kses_data( __("Display share links on the single post", 'greenthumb') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'show_author_info' => array(
					"title" => esc_html__('Show author info', 'greenthumb'),
					"desc" => wp_kses_data( __("Display block with information about post's author", 'greenthumb') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'blog_single_related_info' => array(
					"title" => esc_html__('Related posts', 'greenthumb'),
					"desc" => '',
					"type" => "info",
					),
				'show_related_posts' => array(
					"title" => esc_html__('Show related posts', 'greenthumb'),
					"desc" => wp_kses_data( __("Show section 'Related posts' on the single post's pages", 'greenthumb') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'greenthumb')
					),
					"std" => 1,
					"type" => "checkbox"
					),
				'related_posts' => array(
					"title" => esc_html__('Related posts', 'greenthumb'),
					"desc" => wp_kses_data( __('How many related posts should be displayed in the single post? If 0 - no related posts shown.', 'greenthumb') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => greenthumb_get_list_range(1,9),
					"type" => GREENTHUMB_THEME_FREE ? "hidden" : "select"
					),
				'related_columns' => array(
					"title" => esc_html__('Related columns', 'greenthumb'),
					"desc" => wp_kses_data( __('How many columns should be used to output related posts in the single page (from 2 to 4)?', 'greenthumb') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => greenthumb_get_list_range(1,4),
					"type" => GREENTHUMB_THEME_FREE ? "hidden" : "switch"
					),
				'related_style' => array(
					"title" => esc_html__('Related posts style', 'greenthumb'),
					"desc" => wp_kses_data( __('Select style of the related posts output', 'greenthumb') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => greenthumb_get_list_styles(1,2),
					"type" => GREENTHUMB_THEME_FREE ? "hidden" : "switch"
					),
			'blog_end' => array(
				"type" => "panel_end",
				),
			
		
		
			// 'Colors'
			'panel_colors' => array(
				"title" => esc_html__('Colors', 'greenthumb'),
				"desc" => '',
				"priority" => 300,
				"type" => "section"
				),

			'color_schemes_info' => array(
				"title" => esc_html__('Color schemes', 'greenthumb'),
				"desc" => wp_kses_data( __('Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'greenthumb') ),
				"type" => "info",
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'greenthumb'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'greenthumb')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'greenthumb'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'greenthumb')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'greenthumb'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'greenthumb')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Menu Color Scheme', 'greenthumb'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'greenthumb')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "switch"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'greenthumb'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'greenthumb')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),

			'color_scheme_editor_info' => array(
				"title" => esc_html__('Color scheme editor', 'greenthumb'),
				"desc" => wp_kses_data(__('Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'greenthumb') ),
				"type" => "info",
				),
			'scheme_storage' => array(
				"title" => esc_html__('Color scheme editor', 'greenthumb'),
				"desc" => '',
				"std" => '$greenthumb_get_scheme_storage',
				"refresh" => false,
				"colorpicker" => "tiny",
				"type" => "scheme_editor"
				),


			// 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'greenthumb'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'greenthumb') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'greenthumb')
				),
				"hidden" => true,
				"std" => '',
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'greenthumb'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'greenthumb') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'greenthumb')
				),
				"hidden" => true,
				"std" => '',
				"type" => GREENTHUMB_THEME_FREE ? "hidden" : "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"type" => "hidden",
				),

			'last_option' => array(
				"title" => '',
				"desc" => '',
				"std" => 1,
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// 'Fonts'
			'fonts' => array(
				"title" => esc_html__('Typography', 'greenthumb'),
				"desc" => '',
				"priority" => 200,
				"type" => "panel"
				),

			// Fonts - Load_fonts
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'greenthumb'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'greenthumb') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'greenthumb') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'greenthumb'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'greenthumb') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'greenthumb') ),
				"class" => "greenthumb_column-1_3 greenthumb_new_row",
				"refresh" => false,
				"std" => '$greenthumb_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=greenthumb_get_theme_setting('max_load_fonts'); $i++) {
			if (greenthumb_get_value_gp('page') != 'theme_options') {
				$fonts["load_fonts-{$i}-info"] = array(
					"title" => esc_html(sprintf(__('Font %s', 'greenthumb'), $i)),
					"desc" => '',
					"type" => "info",
					);
			}
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'greenthumb'),
				"desc" => '',
				"class" => "greenthumb_column-1_3 greenthumb_new_row",
				"refresh" => false,
				"std" => '$greenthumb_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'greenthumb'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'greenthumb') )
							: '',
				"class" => "greenthumb_column-1_3",
				"refresh" => false,
				"std" => '$greenthumb_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'greenthumb'),
					'serif' => esc_html__('serif', 'greenthumb'),
					'sans-serif' => esc_html__('sans-serif', 'greenthumb'),
					'monospace' => esc_html__('monospace', 'greenthumb'),
					'cursive' => esc_html__('cursive', 'greenthumb'),
					'fantasy' => esc_html__('fantasy', 'greenthumb')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'greenthumb'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'greenthumb') )
								. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'greenthumb') )
							: '',
				"class" => "greenthumb_column-1_3",
				"refresh" => false,
				"std" => '$greenthumb_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = greenthumb_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								: esc_html(sprintf(__('%s settings', 'greenthumb'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'greenthumb'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = array();
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'greenthumb'),
						'100' => esc_html__('100 (Light)', 'greenthumb'), 
						'200' => esc_html__('200 (Light)', 'greenthumb'), 
						'300' => esc_html__('300 (Thin)',  'greenthumb'),
						'400' => esc_html__('400 (Normal)', 'greenthumb'),
						'500' => esc_html__('500 (Semibold)', 'greenthumb'),
						'600' => esc_html__('600 (Semibold)', 'greenthumb'),
						'700' => esc_html__('700 (Bold)', 'greenthumb'),
						'800' => esc_html__('800 (Black)', 'greenthumb'),
						'900' => esc_html__('900 (Black)', 'greenthumb')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'greenthumb'),
						'normal' => esc_html__('Normal', 'greenthumb'), 
						'italic' => esc_html__('Italic', 'greenthumb')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'greenthumb'),
						'none' => esc_html__('None', 'greenthumb'), 
						'underline' => esc_html__('Underline', 'greenthumb'),
						'overline' => esc_html__('Overline', 'greenthumb'),
						'line-through' => esc_html__('Line-through', 'greenthumb')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'greenthumb'),
						'none' => esc_html__('None', 'greenthumb'), 
						'uppercase' => esc_html__('Uppercase', 'greenthumb'),
						'lowercase' => esc_html__('Lowercase', 'greenthumb'),
						'capitalize' => esc_html__('Capitalize', 'greenthumb')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"class" => "greenthumb_column-1_5",
					"refresh" => false,
					"std" => '$greenthumb_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters to Theme Options
		greenthumb_storage_set_array_before('options', 'panel_colors', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			greenthumb_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'greenthumb'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'greenthumb') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'greenthumb')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}
	}
}


// Returns a list of options that can be overridden for CPT
if (!function_exists('greenthumb_options_get_list_cpt_options')) {
	function greenthumb_options_get_list_cpt_options($cpt, $title='') {
		if (empty($title)) $title = ucfirst($cpt);
		return array(
					"header_info_{$cpt}" => array(
						"title" => esc_html__('Header', 'greenthumb'),
						"desc" => '',
						"type" => "info",
						),
					"header_style_{$cpt}" => array(
						"title" => esc_html__('Header style', 'greenthumb'),
						"desc" => wp_kses_data( sprintf(__('Select style to display the site header on the %s pages', 'greenthumb'), $title) ),
						"std" => 'inherit',
						"options" => array(),
						"type" => GREENTHUMB_THEME_FREE ? "hidden" : "select"
						),
					"header_position_{$cpt}" => array(
						"title" => esc_html__('Header position', 'greenthumb'),
						"desc" => wp_kses_data( sprintf(__('Select position to display the site header on the %s pages', 'greenthumb'), $title) ),
						"std" => 'inherit',
						"options" => array(),
						"type" => GREENTHUMB_THEME_FREE ? "hidden" : "switch"
						),
					"header_image_override_{$cpt}" => array(
						"title" => esc_html__('Header image override', 'greenthumb'),
						"desc" => wp_kses_data( __("Allow override the header image with the post's featured image", 'greenthumb') ),
						"std" => 0,
						"type" => GREENTHUMB_THEME_FREE ? "hidden" : "checkbox"
						),
					"header_widgets_{$cpt}" => array(
						"title" => esc_html__('Header widgets', 'greenthumb'),
						"desc" => wp_kses_data( sprintf(__('Select set of widgets to show in the header on the %s pages', 'greenthumb'), $title) ),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
						
					"sidebar_info_{$cpt}" => array(
						"title" => esc_html__('Sidebar', 'greenthumb'),
						"desc" => '',
						"type" => "info",
						),
					"sidebar_position_{$cpt}" => array(
						"title" => esc_html__('Sidebar position', 'greenthumb'),
						"desc" => wp_kses_data( sprintf(__('Select position to show sidebar on the %s pages', 'greenthumb'), $title) ),
						"refresh" => false,
						"std" => 'left',
						"options" => array(),
						"type" => "switch"
						),
					"sidebar_widgets_{$cpt}" => array(
						"title" => esc_html__('Sidebar widgets', 'greenthumb'),
						"desc" => wp_kses_data( sprintf(__('Select sidebar to show on the %s pages', 'greenthumb'), $title) ),
						"dependency" => array(
							"sidebar_position_{$cpt}" => array('left', 'right')
						),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
					"hide_sidebar_on_single_{$cpt}" => array(
						"title" => esc_html__('Hide sidebar on the single pages', 'greenthumb'),
						"desc" => wp_kses_data( __("Hide sidebar on the single page", 'greenthumb') ),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"footer_info_{$cpt}" => array(
						"title" => esc_html__('Footer', 'greenthumb'),
						"desc" => '',
						"type" => "info",
						),
					'footer_style_{$cpt}' => array(
						"title" => esc_html__('Footer style', 'greenthumb'),
						"desc" => wp_kses_data( __('Select style to display the site footer', 'greenthumb') ),
						"std" => 'inherit',
						"options" => array(),
						"type" => GREENTHUMB_THEME_FREE ? "hidden" : "select"
						),
					"footer_widgets_{$cpt}" => array(
						"title" => esc_html__('Footer widgets', 'greenthumb'),
						"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'greenthumb') ),
						"std" => 'footer_widgets',
						"options" => array(),
						"type" => "select"
						),
					"footer_columns_{$cpt}" => array(
						"title" => esc_html__('Footer columns', 'greenthumb'),
						"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'greenthumb') ),
						"dependency" => array(
							"footer_widgets_{$cpt}" => array('^hide')
						),
						"std" => 0,
						"options" => greenthumb_get_list_range(0,6),
						"type" => "select"
						),
					"footer_wide_{$cpt}" => array(
						"title" => esc_html__('Footer fullwide', 'greenthumb'),
						"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'greenthumb') ),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"widgets_info_{$cpt}" => array(
						"title" => esc_html__('Additional panels', 'greenthumb'),
						"desc" => '',
						"type" => GREENTHUMB_THEME_FREE ? "hidden" : "info",
						),
					"widgets_above_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the top of the page', 'greenthumb'),
						"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'greenthumb') ),
						"std" => 'hide',
						"options" => array(),
						"type" => GREENTHUMB_THEME_FREE ? "hidden" : "select"
						),
					"widgets_above_content_{$cpt}" => array(
						"title" => esc_html__('Widgets above the content', 'greenthumb'),
						"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'greenthumb') ),
						"std" => 'hide',
						"options" => array(),
						"type" => GREENTHUMB_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_content_{$cpt}" => array(
						"title" => esc_html__('Widgets below the content', 'greenthumb'),
						"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'greenthumb') ),
						"std" => 'hide',
						"options" => array(),
						"type" => GREENTHUMB_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the bottom of the page', 'greenthumb'),
						"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'greenthumb') ),
						"std" => 'hide',
						"options" => array(),
						"type" => GREENTHUMB_THEME_FREE ? "hidden" : "select"
						)
					);
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('greenthumb_options_get_list_choises')) {
	add_filter('greenthumb_filter_options_get_list_choises', 'greenthumb_options_get_list_choises', 10, 2);
	function greenthumb_options_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'header_style')===0)
				$list = greenthumb_get_list_header_styles(strpos($id, 'header_style_')===0);
			else if (strpos($id, 'header_position')===0)
				$list = greenthumb_get_list_header_positions(strpos($id, 'header_position_')===0);
			else if (strpos($id, 'header_widgets')===0)
				$list = greenthumb_get_list_sidebars(strpos($id, 'header_widgets_')===0, true);
			else if (substr($id, -7) == '_scheme')
				$list = greenthumb_get_list_schemes($id!='color_scheme');
			else if (strpos($id, 'sidebar_widgets')===0)
				$list = greenthumb_get_list_sidebars(strpos($id, 'sidebar_widgets_')===0, true);
			else if (strpos($id, 'sidebar_position')===0)
				$list = greenthumb_get_list_sidebars_positions(strpos($id, 'sidebar_position_')===0);
			else if (strpos($id, 'widgets_above_page')===0)
				$list = greenthumb_get_list_sidebars(strpos($id, 'widgets_above_page_')===0, true);
			else if (strpos($id, 'widgets_above_content')===0)
				$list = greenthumb_get_list_sidebars(strpos($id, 'widgets_above_content_')===0, true);
			else if (strpos($id, 'widgets_below_page')===0)
				$list = greenthumb_get_list_sidebars(strpos($id, 'widgets_below_page_')===0, true);
			else if (strpos($id, 'widgets_below_content')===0)
				$list = greenthumb_get_list_sidebars(strpos($id, 'widgets_below_content_')===0, true);
			else if (strpos($id, 'footer_style')===0)
				$list = greenthumb_get_list_footer_styles(strpos($id, 'footer_style_')===0);
			else if (strpos($id, 'footer_widgets')===0)
				$list = greenthumb_get_list_sidebars(strpos($id, 'footer_widgets_')===0, true);
			else if (strpos($id, 'blog_style')===0)
				$list = greenthumb_get_list_blog_styles(strpos($id, 'blog_style_')===0);
			else if (strpos($id, 'post_type')===0)
				$list = greenthumb_get_list_posts_types();
			else if (strpos($id, 'parent_cat')===0)
				$list = greenthumb_array_merge(array(0 => esc_html__('- Select category -', 'greenthumb')), greenthumb_get_list_categories());
			else if (strpos($id, 'blog_animation')===0)
				$list = greenthumb_get_list_animations_in();
			else if ($id == 'color_scheme_editor')
				$list = greenthumb_get_list_schemes();
			else if (strpos($id, '_font-family') > 0)
				$list = greenthumb_get_list_load_fonts(true);
		}
		return $list;
	}
}
?>