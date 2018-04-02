<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0.10
 */


// Socials
if ( greenthumb_is_on(greenthumb_get_theme_option('socials_in_footer')) && ($greenthumb_output = greenthumb_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php greenthumb_show_layout($greenthumb_output); ?>
		</div>
	</div>
	<?php
}
?>