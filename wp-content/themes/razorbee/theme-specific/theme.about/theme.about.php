<?php
/**
 * Information about this theme
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0.30
 */


// Redirect to the 'About Theme' page after switch theme
if (!function_exists('greenthumb_about_after_switch_theme')) {
	add_action('after_switch_theme', 'greenthumb_about_after_switch_theme', 1000);
	function greenthumb_about_after_switch_theme() {
		update_option('greenthumb_about_page', 1);
	}
}
if ( !function_exists('greenthumb_about_after_setup_theme') ) {
	add_action( 'init', 'greenthumb_about_after_setup_theme', 1000 );
	function greenthumb_about_after_setup_theme() {
		if (get_option('greenthumb_about_page') == 1) {
			update_option('greenthumb_about_page', 0);
			wp_safe_redirect(admin_url().'themes.php?page=greenthumb_about');
			exit();
		}
	}
}


// Add 'About Theme' item in the Appearance menu
if (!function_exists('greenthumb_about_add_menu_items')) {
	add_action( 'admin_menu', 'greenthumb_about_add_menu_items' );
	function greenthumb_about_add_menu_items() {
		$theme = wp_get_theme();
		$theme_name = $theme->name . (GREENTHUMB_THEME_FREE ? ' ' . esc_html__('Free', 'greenthumb') : '');
		add_theme_page(
			sprintf(esc_html__('About %s', 'greenthumb'), $theme_name),	//page_title
			sprintf(esc_html__('About %s', 'greenthumb'), $theme_name),	//menu_title
			'manage_options',											//capability
			'greenthumb_about',											//menu_slug
			'greenthumb_about_page_builder',								//callback
			'dashicons-format-status',									//icon
			''															//menu position
		);
	}
}


// Load page-specific scripts and styles
if (!function_exists('greenthumb_about_enqueue_scripts')) {
	add_action( 'admin_enqueue_scripts', 'greenthumb_about_enqueue_scripts' );
	function greenthumb_about_enqueue_scripts() {
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen) && $screen->id == 'appearance_page_greenthumb_about') {
			// Scripts
			wp_enqueue_script( 'jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true );
			if ( ($fdir = greenthumb_get_file_url('theme-specific/theme.about/theme.about.js')) != '' )
				wp_enqueue_script( 'greenthumb-about', $fdir, array('jquery'), null, true );
			
			if (function_exists('greenthumb_plugins_installer_enqueue_scripts'))
				greenthumb_plugins_installer_enqueue_scripts();
			
			// Styles
			wp_enqueue_style( 'greenthumb-icons',  greenthumb_get_file_url('css/font-icons/css/fontello-embedded.css') );
			if ( ($fdir = greenthumb_get_file_url('theme-specific/theme.about/theme.about.css')) != '' )
				wp_enqueue_style( 'greenthumb-about',  $fdir, array(), null );
		}
	}
}


// Build 'About Theme' page
if (!function_exists('greenthumb_about_page_builder')) {
	function greenthumb_about_page_builder() {
		$theme = wp_get_theme();
		?>
		<div class="greenthumb_about">
			<div class="greenthumb_about_header">
				<div class="greenthumb_about_logo"><?php
					$logo = greenthumb_get_file_url('theme-specific/theme.about/logo.jpg');
					if (empty($logo)) $logo = greenthumb_get_file_url('screenshot.jpg');
					if (!empty($logo)) {
						?><img src="<?php echo esc_url($logo); ?>"><?php
					}
				?></div>
				
				<?php if (GREENTHUMB_THEME_FREE) { ?>
					<a href="<?php echo esc_url(greenthumb_storage_get('theme_download_url')); ?>"
										   target="_blank"
										   class="greenthumb_about_pro_link button button-primary"><?php
											esc_html_e('Get PRO version', 'greenthumb');
										?></a>
				<?php } ?>
				<h1 class="greenthumb_about_title"><?php
					echo sprintf(esc_html__('Welcome to %s %s v.%s', 'greenthumb'),
								$theme->name,
								GREENTHUMB_THEME_FREE ? __('Free', 'greenthumb') : '',
								$theme->version
								);
				?></h1>
				<div class="greenthumb_about_description">
					<?php
					if (GREENTHUMB_THEME_FREE) {
						?><p><?php
							echo wp_kses_data(sprintf(__('Now you are using Free version of <a href="%s">%s Pro Theme</a>.', 'greenthumb'),
														esc_url(greenthumb_storage_get('theme_download_url')),
														$theme->name
														)
												);
							echo '<br>' . wp_kses_data(sprintf(__('This version is SEO- and Retina-ready. It also has a built-in support for parallax and slider with swipe gestures. %s Free is compatible with many popular plugins, such as %s', 'greenthumb'),
														$theme->name,
														greenthumb_about_get_supported_plugins()
														)
												);
						?></p>
						<p><?php
							echo wp_kses_data(sprintf(__('We hope you have a great acquaintance with our themes. If you are looking for a fully functional website, you can get the <a href="%s">Pro Version here</a>', 'greenthumb'),
														esc_url(greenthumb_storage_get('theme_download_url'))
														)
												);
						?></p><?php
					} else {
						?><p><?php
							echo wp_kses_data(sprintf(__('%s is a Premium WordPress theme. It has a built-in support for parallax, slider with swipe gestures, and is SEO- and Retina-ready', 'greenthumb'),
														$theme->name
														)
												);
						?></p>
						<p><?php
							echo wp_kses_data(sprintf(__('The Premium Theme is compatible with many popular plugins, such as %s', 'greenthumb'),
														greenthumb_about_get_supported_plugins()
														)
												);
						?></p><?php
					}
					?>
				</div>
			</div>
			<div id="greenthumb_about_tabs" class="greenthumb_tabs greenthumb_about_tabs">
				<ul>
					<li><a href="#greenthumb_about_section_start"><?php esc_html_e('Getting started', 'greenthumb'); ?></a></li>
					<li><a href="#greenthumb_about_section_actions"><?php esc_html_e('Recommended actions', 'greenthumb'); ?></a></li>
					<?php if (GREENTHUMB_THEME_FREE) { ?>
						<li><a href="#greenthumb_about_section_pro"><?php esc_html_e('Free vs PRO', 'greenthumb'); ?></a></li>
					<?php } ?>
				</ul>
				<div id="greenthumb_about_section_start" class="greenthumb_tabs_section greenthumb_about_section"><?php
				
					// Install required plugins
					if (!greenthumb_exists_trx_addons()) {
						?><div class="greenthumb_about_block"><div class="greenthumb_about_block_inner">
							<h2 class="greenthumb_about_block_title">
								<i class="dashicons dashicons-admin-plugins"></i>
								<?php esc_html_e('ThemeREX Addons', 'greenthumb'); ?>
							</h2>
							<div class="greenthumb_about_block_description"><?php
								echo esc_html(sprintf(__('It is highly recommended that you install the companion plugin "ThemeREX Addons" to have access to the layouts builder, awesome shortcodes, team and testimonials, services and slider, and many other features ...', 'greenthumb'), $theme->name));
							?></div>
							<?php greenthumb_plugins_installer_get_button_html('trx_addons'); ?>
						</div></div><?php
					}
					
					// Install recommended plugins
					?><div class="greenthumb_about_block"><div class="greenthumb_about_block_inner">
						<h2 class="greenthumb_about_block_title">
							<i class="dashicons dashicons-admin-plugins"></i>
							<?php esc_html_e('Recommended plugins', 'greenthumb'); ?>
						</h2>
						<div class="greenthumb_about_block_description"><?php
							echo esc_html(sprintf(__('Theme %s is compatible with a large number of popular plugins. You can install only those that are going to use in the near future.', 'greenthumb'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>"
						   class="greenthumb_about_block_link button button-primary"><?php
							esc_html_e('Install plugins', 'greenthumb');
						?></a>
					</div></div><?php
					
					// Customizer or Theme Options
					?><div class="greenthumb_about_block"><div class="greenthumb_about_block_inner">
						<h2 class="greenthumb_about_block_title">
							<i class="dashicons dashicons-admin-appearance"></i>
							<?php esc_html_e('Setup Theme options', 'greenthumb'); ?>
						</h2>
						<div class="greenthumb_about_block_description"><?php
							esc_html_e('Using the WordPress Customizer you can easily customize every aspect of the theme. If you want to use the standard theme settings page - open Theme Options and follow the same steps there.', 'greenthumb');
						?></div>
						<a href="<?php echo esc_url(admin_url().'customize.php'); ?>"
						   class="greenthumb_about_block_link button button-primary"><?php
							esc_html_e('Customizer', 'greenthumb');
						?></a>
						<?php esc_html_e('or', 'greenthumb'); ?>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>"
						   class="greenthumb_about_block_link button"><?php
							esc_html_e('Theme Options', 'greenthumb');
						?></a>
					</div></div><?php
					
					// Documentation
					?><div class="greenthumb_about_block"><div class="greenthumb_about_block_inner">
						<h2 class="greenthumb_about_block_title">
							<i class="dashicons dashicons-book"></i>
							<?php esc_html_e('Read full documentation', 'greenthumb');	?>
						</h2>
						<div class="greenthumb_about_block_description"><?php
							echo esc_html(sprintf(__('Need more details? Please check our full online documentation for detailed information on how to use %s.', 'greenthumb'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(greenthumb_storage_get('theme_doc_url')); ?>"
						   target="_blank"
						   class="greenthumb_about_block_link button button-primary"><?php
							esc_html_e('Documentation', 'greenthumb');
						?></a>
					</div></div><?php
					
					// Support
					if (!GREENTHUMB_THEME_FREE) {
						?><div class="greenthumb_about_block"><div class="greenthumb_about_block_inner">
							<h2 class="greenthumb_about_block_title">
								<i class="dashicons dashicons-sos"></i>
								<?php esc_html_e('Support', 'greenthumb'); ?>
							</h2>
							<div class="greenthumb_about_block_description"><?php
								echo esc_html(sprintf(__('We want to make sure you have the best experience using %s and that is why we gathered here all the necessary informations for you.', 'greenthumb'), $theme->name));
							?></div>
							<a href="<?php echo esc_url(greenthumb_storage_get('theme_support_url')); ?>"
							   target="_blank"
							   class="greenthumb_about_block_link button button-primary"><?php
								esc_html_e('Support', 'greenthumb');
							?></a>
						</div></div><?php
					}
					
					// Online Demo
					?><div class="greenthumb_about_block"><div class="greenthumb_about_block_inner">
						<h2 class="greenthumb_about_block_title">
							<i class="dashicons dashicons-images-alt2"></i>
							<?php esc_html_e('On-line demo', 'greenthumb'); ?>
						</h2>
						<div class="greenthumb_about_block_description"><?php
							echo esc_html(sprintf(__('Visit the Demo Version of %s to check out all the features it has', 'greenthumb'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(greenthumb_storage_get('theme_demo_url')); ?>"
						   target="_blank"
						   class="greenthumb_about_block_link button button-primary"><?php
							esc_html_e('View demo', 'greenthumb');
						?></a>
					</div></div>
					
				</div>



				<div id="greenthumb_about_section_actions" class="greenthumb_tabs_section greenthumb_about_section"><?php
				
					// Install required plugins
					if (!greenthumb_exists_trx_addons()) {
						?><div class="greenthumb_about_block"><div class="greenthumb_about_block_inner">
							<h2 class="greenthumb_about_block_title">
								<i class="dashicons dashicons-admin-plugins"></i>
								<?php esc_html_e('ThemeREX Addons', 'greenthumb'); ?>
							</h2>
							<div class="greenthumb_about_block_description"><?php
								echo esc_html(sprintf(__('It is highly recommended that you install the companion plugin "ThemeREX Addons" to have access to the layouts builder, awesome shortcodes, team and testimonials, services and slider, and many other features ...', 'greenthumb'), $theme->name));
							?></div>
							<?php greenthumb_plugins_installer_get_button_html('trx_addons'); ?>
						</div></div><?php
					}
					
					// Install recommended plugins
					?><div class="greenthumb_about_block"><div class="greenthumb_about_block_inner">
						<h2 class="greenthumb_about_block_title">
							<i class="dashicons dashicons-admin-plugins"></i>
							<?php esc_html_e('Recommended plugins', 'greenthumb'); ?>
						</h2>
						<div class="greenthumb_about_block_description"><?php
							echo esc_html(sprintf(__('Theme %s is compatible with a large number of popular plugins. You can install only those that are going to use in the near future.', 'greenthumb'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>"
						   class="greenthumb_about_block_link button button button-primary"><?php
							esc_html_e('Install plugins', 'greenthumb');
						?></a>
					</div></div><?php
					
					// Customizer or Theme Options
					?><div class="greenthumb_about_block"><div class="greenthumb_about_block_inner">
						<h2 class="greenthumb_about_block_title">
							<i class="dashicons dashicons-admin-appearance"></i>
							<?php esc_html_e('Setup Theme options', 'greenthumb'); ?>
						</h2>
						<div class="greenthumb_about_block_description"><?php
							esc_html_e('Using the WordPress Customizer you can easily customize every aspect of the theme. If you want to use the standard theme settings page - open Theme Options and follow the same steps there.', 'greenthumb');
						?></div>
						<a href="<?php echo esc_url(admin_url().'customize.php'); ?>"
						   target="_blank"
						   class="greenthumb_about_block_link button button-primary"><?php
							esc_html_e('Customizer', 'greenthumb');
						?></a>
						<?php esc_html_e('or', 'greenthumb'); ?>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>"
						   class="greenthumb_about_block_link button"><?php
							esc_html_e('Theme Options', 'greenthumb');
						?></a>
					</div></div>
					
				</div>



				<?php if (GREENTHUMB_THEME_FREE) { ?>
					<div id="greenthumb_about_section_pro" class="greenthumb_tabs_section greenthumb_about_section">
						<table class="greenthumb_about_table" cellpadding="0" cellspacing="0" border="0">
							<thead>
								<tr>
									<td class="greenthumb_about_table_info">&nbsp;</td>
									<td class="greenthumb_about_table_check"><?php echo esc_html(sprintf(__('%s Free', 'greenthumb'), $theme->name)); ?></td>
									<td class="greenthumb_about_table_check"><?php echo esc_html(sprintf(__('%s PRO', 'greenthumb'), $theme->name)); ?></td>
								</tr>
							</thead>
							<tbody>
	
	
								<?php
								// Responsive layouts
								?>
								<tr>
									<td class="greenthumb_about_table_info">
										<h2 class="greenthumb_about_table_info_title">
											<?php esc_html_e('Mobile friendly', 'greenthumb'); ?>
										</h2>
										<div class="greenthumb_about_table_info_description"><?php
											esc_html_e('Responsive layout. Looks great on any device.', 'greenthumb');
										?></div>
									</td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Built-in slider
								?>
								<tr>
									<td class="greenthumb_about_table_info">
										<h2 class="greenthumb_about_table_info_title">
											<?php esc_html_e('Built-in posts slider', 'greenthumb'); ?>
										</h2>
										<div class="greenthumb_about_table_info_description"><?php
											esc_html_e('Allows you to add beautiful slides using the built-in shortcode/widget "Slider" with swipe gestures support.', 'greenthumb');
										?></div>
									</td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Revolution slider
								if (greenthumb_storage_isset('required_plugins', 'revslider')) {
								?>
								<tr>
									<td class="greenthumb_about_table_info">
										<h2 class="greenthumb_about_table_info_title">
											<?php esc_html_e('Revolution Slider Compatibility', 'greenthumb'); ?>
										</h2>
										<div class="greenthumb_about_table_info_description"><?php
											esc_html_e('Our built-in shortcode/widget "Slider" is able to work not only with posts, but also with slides created  in "Revolution Slider".', 'greenthumb');
										?></div>
									</td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<?php } ?>
	
								<?php
								// SiteOrigin Panels
								if (greenthumb_storage_isset('required_plugins', 'siteorigin-panels')) {
								?>
								<tr>
									<td class="greenthumb_about_table_info">
										<h2 class="greenthumb_about_table_info_title">
											<?php esc_html_e('Free PageBuilder', 'greenthumb'); ?>
										</h2>
										<div class="greenthumb_about_table_info_description"><?php
											esc_html_e('Full integration with a nice free page builder "SiteOrigin Panels".', 'greenthumb');
										?></div>
									</td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<tr>
									<td class="greenthumb_about_table_info">
										<h2 class="greenthumb_about_table_info_title">
											<?php esc_html_e('Additional widgets pack', 'greenthumb'); ?>
										</h2>
										<div class="greenthumb_about_table_info_description"><?php
											esc_html_e('A number of useful widgets to create beautiful homepages and other sections of your website with SiteOrigin Panels.', 'greenthumb');
										?></div>
									</td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<?php } ?>
	
								<?php
								// Visual Composer
								?>
								<tr>
									<td class="greenthumb_about_table_info">
										<h2 class="greenthumb_about_table_info_title">
											<?php esc_html_e('Visual Composer', 'greenthumb'); ?>
										</h2>
										<div class="greenthumb_about_table_info_description"><?php
											esc_html_e('Full integration with a very popular page builder "Visual Composer". A number of useful shortcodes and widgets to create beautiful homepages and other sections of your website.', 'greenthumb');
										?></div>
									</td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<tr>
									<td class="greenthumb_about_table_info">
										<h2 class="greenthumb_about_table_info_title">
											<?php esc_html_e('Additional shortcodes pack', 'greenthumb'); ?>
										</h2>
										<div class="greenthumb_about_table_info_description"><?php
											esc_html_e('A number of useful shortcodes to create beautiful homepages and other sections of your website with Visual Composer.', 'greenthumb');
										?></div>
									</td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Layouts builder
								?>
								<tr>
									<td class="greenthumb_about_table_info">
										<h2 class="greenthumb_about_table_info_title">
											<?php esc_html_e('Headers and Footers builder', 'greenthumb'); ?>
										</h2>
										<div class="greenthumb_about_table_info_description"><?php
											esc_html_e('Powerful visual builder of headers and footers! No manual code editing - use all the advantages of drag-and-drop technology.', 'greenthumb');
										?></div>
									</td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// WooCommerce
								if (greenthumb_storage_isset('required_plugins', 'woocommerce')) {
								?>
								<tr>
									<td class="greenthumb_about_table_info">
										<h2 class="greenthumb_about_table_info_title">
											<?php esc_html_e('WooCommerce Compatibility', 'greenthumb'); ?>
										</h2>
										<div class="greenthumb_about_table_info_description"><?php
											esc_html_e('Ready for e-commerce. You can build an online store with this theme.', 'greenthumb');
										?></div>
									</td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<?php } ?>
	
								<?php
								// Easy Digital Downloads
								if (greenthumb_storage_isset('required_plugins', 'easy-digital-downloads')) {
								?>
								<tr>
									<td class="greenthumb_about_table_info">
										<h2 class="greenthumb_about_table_info_title">
											<?php esc_html_e('Easy Digital Downloads Compatibility', 'greenthumb'); ?>
										</h2>
										<div class="greenthumb_about_table_info_description"><?php
											esc_html_e('Ready for digital e-commerce. You can build an online digital store with this theme.', 'greenthumb');
										?></div>
									</td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<?php } ?>
	
								<?php
								// Other plugins
								?>
								<tr>
									<td class="greenthumb_about_table_info">
										<h2 class="greenthumb_about_table_info_title">
											<?php esc_html_e('Many other popular plugins compatibility', 'greenthumb'); ?>
										</h2>
										<div class="greenthumb_about_table_info_description"><?php
											esc_html_e('PRO version is compatible (was tested and has built-in support) with many popular plugins.', 'greenthumb');
										?></div>
									</td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Support
								?>
								<tr>
									<td class="greenthumb_about_table_info">
										<h2 class="greenthumb_about_table_info_title">
											<?php esc_html_e('Support', 'greenthumb'); ?>
										</h2>
										<div class="greenthumb_about_table_info_description"><?php
											esc_html_e('Our premium support is going to take care of any problems, in case there will be any of course.', 'greenthumb');
										?></div>
									</td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="greenthumb_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Get PRO version
								?>
								<tr>
									<td class="greenthumb_about_table_info">&nbsp;</td>
									<td class="greenthumb_about_table_check" colspan="2">
										<a href="<?php echo esc_url(greenthumb_storage_get('theme_download_url')); ?>"
										   target="_blank"
										   class="greenthumb_about_block_link greenthumb_about_pro_link button button-primary"><?php
											esc_html_e('Get PRO version', 'greenthumb');
										?></a>
									</td>
								</tr>
	
							</tbody>
						</table>
					</div>
				<?php } ?>
				
			</div>
		</div>
		<?php
	}
}


// Utils
//------------------------------------

// Return supported plugin's names
if (!function_exists('greenthumb_about_get_supported_plugins')) {
	function greenthumb_about_get_supported_plugins() {
		return '"' . join('", "', array_values(greenthumb_storage_get('required_plugins'))) . '"';
	}
}

require_once GREENTHUMB_THEME_DIR . 'includes/plugins.installer/plugins.installer.php';
?>