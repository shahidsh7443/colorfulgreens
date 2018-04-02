<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('greenthumb_mailchimp_theme_setup9')) {
	add_action( 'after_setup_theme', 'greenthumb_mailchimp_theme_setup9', 9 );
	function greenthumb_mailchimp_theme_setup9() {
		if (greenthumb_exists_mailchimp()) {
			add_action( 'wp_enqueue_scripts',							'greenthumb_mailchimp_frontend_scripts', 1100 );
			add_filter( 'greenthumb_filter_merge_styles',					'greenthumb_mailchimp_merge_styles');
		}
		if (is_admin()) {
			add_filter( 'greenthumb_filter_tgmpa_required_plugins',		'greenthumb_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'greenthumb_mailchimp_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('greenthumb_filter_tgmpa_required_plugins',	'greenthumb_mailchimp_tgmpa_required_plugins');
	function greenthumb_mailchimp_tgmpa_required_plugins($list=array()) {
		if (greenthumb_storage_isset('required_plugins', 'mailchimp-for-wp')) {
			$list[] = array(
				'name' 		=> greenthumb_storage_get_array('required_plugins', 'mailchimp-for-wp'),
				'slug' 		=> 'mailchimp-for-wp',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'greenthumb_exists_mailchimp' ) ) {
	function greenthumb_exists_mailchimp() {
		return function_exists('__mc4wp_load_plugin') || defined('MC4WP_VERSION');
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue custom styles
if ( !function_exists( 'greenthumb_mailchimp_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'greenthumb_mailchimp_frontend_scripts', 1100 );
	function greenthumb_mailchimp_frontend_scripts() {
		if (greenthumb_exists_mailchimp()) {
			if (greenthumb_is_on(greenthumb_get_theme_option('debug_mode')) && greenthumb_get_file_dir('plugins/mailchimp-for-wp/mailchimp-for-wp.css')!='')
				wp_enqueue_style( 'greenthumb-mailchimp-for-wp',  greenthumb_get_file_url('plugins/mailchimp-for-wp/mailchimp-for-wp.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'greenthumb_mailchimp_merge_styles' ) ) {
	//Handler of the add_filter( 'greenthumb_filter_merge_styles', 'greenthumb_mailchimp_merge_styles');
	function greenthumb_mailchimp_merge_styles($list) {
		$list[] = 'plugins/mailchimp-for-wp/mailchimp-for-wp.css';
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (greenthumb_exists_mailchimp()) { require_once GREENTHUMB_THEME_DIR . 'plugins/mailchimp-for-wp/mailchimp-for-wp.styles.php'; }
?>