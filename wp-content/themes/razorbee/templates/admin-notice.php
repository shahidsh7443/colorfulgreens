<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0.1
 */
 
$greenthumb_theme_obj = wp_get_theme();
?>
<div class="update-nag" id="greenthumb_admin_notice">
	<h3 class="greenthumb_notice_title"><?php echo sprintf(esc_html__('Welcome to %s v.%s', 'greenthumb'), $greenthumb_theme_obj->name.(GREENTHUMB_THEME_FREE ? ' '.esc_html__('Free', 'greenthumb') : ''), $greenthumb_theme_obj->version); ?></h3>
	<?php
	if (!greenthumb_exists_trx_addons()) {
		?><p><?php echo wp_kses_data(__('<b>Attention!</b> Plugin "ThemeREX Addons is required! Please, install and activate it!', 'greenthumb')); ?></p><?php
	}
	?><p>
		<a href="<?php echo esc_url(admin_url().'themes.php?page=greenthumb_about'); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> <?php echo sprintf(esc_html__('About %s', 'greenthumb'), $greenthumb_theme_obj->name); ?></a>
		<?php
		if (greenthumb_get_value_gp('page')!='tgmpa-install-plugins') {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'greenthumb'); ?></a>
			<?php
		}
		if (function_exists('greenthumb_exists_trx_addons') && greenthumb_exists_trx_addons() && class_exists('trx_addons_demo_data_importer')) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Data', 'greenthumb'); ?></a>
			<?php
		}
		?>
        <a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'greenthumb'); ?></a>
		<span> <?php esc_html_e('or', 'greenthumb'); ?> </span>
        <a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Options', 'greenthumb'); ?></a>
        <a href="#" class="button greenthumb_hide_notice"><i class="dashicons dashicons-dismiss"></i> <?php esc_html_e('Hide Notice', 'greenthumb'); ?></a>
	</p>
</div>