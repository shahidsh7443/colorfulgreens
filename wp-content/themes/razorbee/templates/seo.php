<?php
/**
 * The template to display the Structured Data Snippets
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0.30
 */

// Structured data snippets
if (greenthumb_is_on(greenthumb_get_theme_option('seo_snippets'))) {
	?><div class="structured_data_snippets">
		<meta itemprop="headline" content="<?php echo esc_attr(get_the_title()); ?>">
		<meta itemprop="datePublished" content="<?php echo esc_attr(get_the_date('Y-m-d')); ?>">
		<meta itemprop="dateModified" content="<?php echo esc_attr(get_the_modified_date('Y-m-d')); ?>">
		<div itemscope itemprop="publisher" itemtype="https://schema.org/Organization">
			<meta itemprop="name" content="<?php echo esc_attr(get_bloginfo( 'name' )); ?>">
			<meta itemprop="telephone" content="">
			<meta itemprop="address" content="">
			<?php
			$greenthumb_logo_image = greenthumb_get_retina_multiplier() > 1 
								? greenthumb_get_theme_option( 'logo_retina' )
								: greenthumb_get_theme_option( 'logo' );
			if (!empty($greenthumb_logo_image)) {
				?><meta itemprop="logo" itemtype="https://schema.org/logo" content="<?php echo esc_url($greenthumb_logo_image); ?>"><?php
			}
			?>
		</div>
	</div>
	<?php
}
?>