<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('greenthumb_essential_grid_theme_setup9')) {
	add_action( 'after_setup_theme', 'greenthumb_essential_grid_theme_setup9', 9 );
	function greenthumb_essential_grid_theme_setup9() {
		if (greenthumb_exists_essential_grid()) {
			add_action( 'wp_enqueue_scripts', 							'greenthumb_essential_grid_frontend_scripts', 1100 );
			add_filter( 'greenthumb_filter_merge_styles',					'greenthumb_essential_grid_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'greenthumb_filter_tgmpa_required_plugins',		'greenthumb_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'greenthumb_essential_grid_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('greenthumb_filter_tgmpa_required_plugins',	'greenthumb_essential_grid_tgmpa_required_plugins');
	function greenthumb_essential_grid_tgmpa_required_plugins($list=array()) {
		if (greenthumb_storage_isset('required_plugins', 'essential-grid')) {
			$path = greenthumb_get_file_dir('plugins/essential-grid/essential-grid.zip');
			if (!empty($path) || greenthumb_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
						'name' 		=> greenthumb_storage_get_array('required_plugins', 'essential-grid'),
						'slug' 		=> 'essential-grid',
						'source'	=> !empty($path) ? $path : 'upload://essential-grid.zip',
						'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'greenthumb_exists_essential_grid' ) ) {
	function greenthumb_exists_essential_grid() {
		return defined('EG_PLUGIN_PATH');
	}
}
	
// Enqueue plugin's custom styles
if ( !function_exists( 'greenthumb_essential_grid_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'greenthumb_essential_grid_frontend_scripts', 1100 );
	function greenthumb_essential_grid_frontend_scripts() {
		if (greenthumb_is_on(greenthumb_get_theme_option('debug_mode')) && greenthumb_get_file_dir('plugins/essential-grid/essential-grid.css')!='')
			wp_enqueue_style( 'greenthumb-essential-grid',  greenthumb_get_file_url('plugins/essential-grid/essential-grid.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'greenthumb_essential_grid_merge_styles' ) ) {
	//Handler of the add_filter('greenthumb_filter_merge_styles', 'greenthumb_essential_grid_merge_styles');
	function greenthumb_essential_grid_merge_styles($list) {
		$list[] = 'plugins/essential-grid/essential-grid.css';
		return $list;
	}
}
?>