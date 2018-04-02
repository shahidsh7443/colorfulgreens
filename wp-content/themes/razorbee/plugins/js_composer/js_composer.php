<?php
/* Visual Composer support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('greenthumb_vc_theme_setup9')) {
	add_action( 'after_setup_theme', 'greenthumb_vc_theme_setup9', 9 );
	function greenthumb_vc_theme_setup9() {
		if (greenthumb_exists_visual_composer()) {
			add_action( 'wp_enqueue_scripts', 								'greenthumb_vc_frontend_scripts', 1100 );
			add_filter( 'greenthumb_filter_merge_styles',						'greenthumb_vc_merge_styles' );
	
			// Add/Remove params in the standard VC shortcodes
			//-----------------------------------------------------
			add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,					'greenthumb_vc_add_params_classes', 10, 3 );
			
			// Color scheme
			$scheme = array(
				"param_name" => "scheme",
				"heading" => esc_html__("Color scheme", 'greenthumb'),
				"description" => wp_kses_data( __("Select color scheme to decorate this block", 'greenthumb') ),
				"group" => esc_html__('Colors', 'greenthumb'),
				"admin_label" => true,
				"value" => array_flip(greenthumb_get_list_schemes(true)),
				"type" => "dropdown"
			);
			vc_add_param("vc_section", $scheme);
			vc_add_param("vc_row", $scheme);
			vc_add_param("vc_row_inner", $scheme);
			vc_add_param("vc_column", $scheme);
			vc_add_param("vc_column_inner", $scheme);
			vc_add_param("vc_column_text", $scheme);
			
			// Alter height and hide on mobile for Empty Space
			vc_add_param("vc_empty_space", array(
				"param_name" => "alter_height",
				"heading" => esc_html__("Alter height", 'greenthumb'),
				"description" => wp_kses_data( __("Select alternative height instead value from the field above", 'greenthumb') ),
				"admin_label" => true,
				"value" => array(
					esc_html__('Tiny', 'greenthumb') => 'tiny',
					esc_html__('Small', 'greenthumb') => 'small',
					esc_html__('Medium', 'greenthumb') => 'medium',
					esc_html__('Large', 'greenthumb') => 'large',
					esc_html__('Huge', 'greenthumb') => 'huge',
					esc_html__('From the value above', 'greenthumb') => 'none'
				),
				"type" => "dropdown"
			));
			vc_add_param("vc_empty_space", array(
				"param_name" => "hide_on_mobile",
				"heading" => esc_html__("Hide on mobile", 'greenthumb'),
				"description" => wp_kses_data( __("Hide this block on the mobile devices, when the columns are arranged one under another", 'greenthumb') ),
				"admin_label" => true,
				"std" => 0,
				"value" => array(
					esc_html__("Hide on mobile", 'greenthumb') => "1",
					esc_html__("Hide on tablet", 'greenthumb') => "3",
					esc_html__("Hide on notebook", 'greenthumb') => "2" 
					),
				"type" => "checkbox"
			));
			
			// Add Narrow style to the Progress bars
			vc_add_param("vc_progress_bar", array(
				"param_name" => "narrow",
				"heading" => esc_html__("Narrow", 'greenthumb'),
				"description" => wp_kses_data( __("Use narrow style for the progress bar", 'greenthumb') ),
				"std" => 0,
				"value" => array(esc_html__("Narrow style", 'greenthumb') => "1" ),
				"type" => "checkbox"
			));
			
			// Add param 'Closeable' to the Message Box
			vc_add_param("vc_message", array(
				"param_name" => "closeable",
				"heading" => esc_html__("Closeable", 'greenthumb'),
				"description" => wp_kses_data( __("Add 'Close' button to the message box", 'greenthumb') ),
				"std" => 0,
				"value" => array(esc_html__("Closeable", 'greenthumb') => "1" ),
				"type" => "checkbox"
			));
		}
		if (is_admin()) {
			add_filter( 'greenthumb_filter_tgmpa_required_plugins',		'greenthumb_vc_tgmpa_required_plugins' );
			add_filter( 'vc_iconpicker-type-fontawesome',				'greenthumb_vc_iconpicker_type_fontawesome' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'greenthumb_vc_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('greenthumb_filter_tgmpa_required_plugins',	'greenthumb_vc_tgmpa_required_plugins');
	function greenthumb_vc_tgmpa_required_plugins($list=array()) {
		if (greenthumb_storage_isset('required_plugins', 'js_composer')) {
			$path = greenthumb_get_file_dir('plugins/js_composer/js_composer.zip');
			if (!empty($path) || greenthumb_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> greenthumb_storage_get_array('required_plugins', 'js_composer'),
					'slug' 		=> 'js_composer',
					'source'	=> !empty($path) ? $path : 'upload://js_composer.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if Visual Composer installed and activated
if ( !function_exists( 'greenthumb_exists_visual_composer' ) ) {
	function greenthumb_exists_visual_composer() {
		return class_exists('Vc_Manager');
	}
}

// Check if Visual Composer in frontend editor mode
if ( !function_exists( 'greenthumb_vc_is_frontend' ) ) {
	function greenthumb_vc_is_frontend() {
		return (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true')
			|| (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline');
		//return function_exists('vc_is_frontend_editor') && vc_is_frontend_editor();
	}
}
	
// Enqueue VC custom styles
if ( !function_exists( 'greenthumb_vc_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'greenthumb_vc_frontend_scripts', 1100 );
	function greenthumb_vc_frontend_scripts() {
		if (greenthumb_exists_visual_composer()) {
			if (greenthumb_is_on(greenthumb_get_theme_option('debug_mode')) && greenthumb_get_file_dir('plugins/js_composer/js_composer.css')!='')
				wp_enqueue_style( 'greenthumb-js_composer',  greenthumb_get_file_url('plugins/js_composer/js_composer.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'greenthumb_vc_merge_styles' ) ) {
	//Handler of the add_filter('greenthumb_filter_merge_styles', 'greenthumb_vc_merge_styles');
	function greenthumb_vc_merge_styles($list) {
		$list[] = 'plugins/js_composer/js_composer.css';
		return $list;
	}
}
	
// Add theme icons into VC iconpicker list
if ( !function_exists( 'greenthumb_vc_iconpicker_type_fontawesome' ) ) {
	//Handler of the add_filter( 'vc_iconpicker-type-fontawesome',	'greenthumb_vc_iconpicker_type_fontawesome' );
	function greenthumb_vc_iconpicker_type_fontawesome($icons) {
		$list = greenthumb_get_list_icons();
		if (!is_array($list) || count($list) == 0) return $icons;
		$rez = array();
		foreach ($list as $icon)
			$rez[] = array($icon => str_replace('icon-', '', $icon));
		return array_merge( $icons, array(esc_html__('Theme Icons', 'greenthumb') => $rez) );
	}
}



// Shortcodes support
//------------------------------------------------------------------------

// Add params to the standard VC shortcodes
if ( !function_exists( 'greenthumb_vc_add_params_classes' ) ) {
	//Handler of the add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'greenthumb_vc_add_params_classes', 10, 3 );
	function greenthumb_vc_add_params_classes($classes, $sc, $atts) {
		if (in_array($sc, array('vc_section', 'vc_row', 'vc_row_inner', 'vc_column', 'vc_column_inner', 'vc_column_text'))) {
			if (!empty($atts['scheme']) && !greenthumb_is_inherit($atts['scheme']))
				$classes .= ($classes ? ' ' : '') . 'scheme_' . $atts['scheme'];
		} else if (in_array($sc, array('vc_empty_space'))) {
			if (!empty($atts['alter_height']) && !greenthumb_is_off($atts['alter_height']))
				$classes .= ($classes ? ' ' : '') . 'height_' . $atts['alter_height'];
			if (!empty($atts['hide_on_mobile'])) {
				if (strpos($atts['hide_on_mobile'], '1')!==false)	$classes .= ($classes ? ' ' : '') . 'hide_on_mobile';
				if (strpos($atts['hide_on_mobile'], '2')!==false)	$classes .= ($classes ? ' ' : '') . 'hide_on_notebook';
				if (strpos($atts['hide_on_mobile'], '3')!==false)	$classes .= ($classes ? ' ' : '') . 'hide_on_tablet';
			}
		} else if (in_array($sc, array('vc_progress_bar'))) {
			if (!empty($atts['narrow']) && (int) $atts['narrow']==1)
				$classes .= ($classes ? ' ' : '') . 'vc_progress_bar_narrow';
		} else if (in_array($sc, array('vc_message'))) {
			if (!empty($atts['closeable']) && (int) $atts['closeable']==1)
				$classes .= ($classes ? ' ' : '') . 'vc_message_box_closeable';
		}
		return $classes;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (greenthumb_exists_visual_composer()) { require_once GREENTHUMB_THEME_DIR . 'plugins/js_composer/js_composer.styles.php'; }
?>