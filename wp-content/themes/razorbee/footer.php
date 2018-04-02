<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0
 */

						// Widgets area inside page content
						greenthumb_create_widgets_area('widgets_below_content');
						?>
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					greenthumb_create_widgets_area('widgets_below_page');

					$greenthumb_body_style = greenthumb_get_theme_option('body_style');
					if ($greenthumb_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->
			<footer class="footer_wrap footer_custom footer_custom_332 footer_custom_footer scheme_dark">
				<div class="vc_row wpb_row vc_row-fluid default_footer vc_custom_1506523610252 vc_row-has-fill sc_layouts_row sc_layouts_row_type_normal scheme_dark"><div class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column sc_layouts_column_align_center sc_layouts_column_icons_position_left"><div class="vc_column-inner "><div class="wpb_wrapper"><div id="sc_content_418472711" class="sc_content color_style_default sc_content_default sc_content_width_1_1 sc_float_center"><div class="sc_content_container"><div class="vc_empty_space" style="height: 4.8em"><span class="vc_empty_space_inner"></span></div>
			<div class="vc_row wpb_row vc_inner vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-4 sc_layouts_column sc_layouts_column_align_right sc_layouts_column_icons_position_right"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="sc_layouts_item"><div id="sc_layouts_iconed_text_845928313" class="sc_layouts_iconed_text"><span class="sc_layouts_item_details sc_layouts_iconed_text_details"><span class="sc_layouts_item_details_line1 sc_layouts_iconed_text_line1">Bangalore</span><span class="sc_layouts_item_details_line2 sc_layouts_iconed_text_line2">Karnataka, India</span></span><!-- /.sc_layouts_iconed_text_details --></div><!-- /.sc_layouts_iconed_text --></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-4 sc_layouts_column sc_layouts_column_align_center sc_layouts_column_icons_position_left"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="sc_layouts_item"><div id="widget_socials_1235695252" class="widget_area sc_widget_socials vc_widget_socials wpb_content_element"><aside id="widget_socials_1235695252_widget" class="widget widget_socials"><div class="socials_wrap sc_align_center"><a target="_blank" href="#" class="social_item social_item_style_icons social_item_type_icons"><span class="social_icon social_facebook-1"><span class="icon-facebook-1"></span></span></a><a target="_blank" href="#" class="social_item social_item_style_icons social_item_type_icons"><span class="social_icon social_twitter-1"><span class="icon-twitter-1"></span></span></a><a target="_blank" href="#" class="social_item social_item_style_icons social_item_type_icons"><span class="social_icon social_vimeo-1"><span class="icon-vimeo-1"></span></span></a></div></aside></div></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-4 sc_layouts_column sc_layouts_column_align_left sc_layouts_column_icons_position_left"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="sc_layouts_item"><div id="sc_layouts_iconed_text_214399124" class="sc_layouts_iconed_text"><span class="sc_layouts_item_details sc_layouts_iconed_text_details"><span class="sc_layouts_item_details_line1 sc_layouts_iconed_text_line1">0123456789</span><span class="sc_layouts_item_details_line2 sc_layouts_iconed_text_line2">8.00 am - 8.00 pm</span></span><!-- /.sc_layouts_iconed_text_details --></div><!-- /.sc_layouts_iconed_text --></div></div></div></div></div><div class="vc_empty_space" style="height: 2em"><span class="vc_empty_space_inner"></span></div>

				<div class="wpb_text_column wpb_content_element ">
					<div class="wpb_wrapper">
						<p style="text-align: center; font-size: 1.067em; font-weight: 600;">Copyright 2018 by <a href="http://www.razorbee.com" target="_blank" rel="noopener">Razorbee Online Solutions</a> ©. All rights reserved.</p>

					</div>
				</div>
			<div class="vc_empty_space" style="height: 4.6em"><span class="vc_empty_space_inner"></span></div>
			</div></div><!-- /.sc_content --></div></div></div></div></footer>
			<!--<?php
			// Footer
			/*$greenthumb_footer_style = greenthumb_get_theme_option("footer_style");
			if (strpos($greenthumb_footer_style, 'footer-custom-')===0)
				$greenthumb_footer_style = greenthumb_is_layouts_available() ? 'footer-custom' : 'footer-default';
			get_template_part( "templates/{$greenthumb_footer_style}");*/
			?>-->

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (greenthumb_is_on(greenthumb_get_theme_option('debug_mode')) && greenthumb_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(greenthumb_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>
