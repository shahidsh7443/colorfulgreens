<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0
 */

// Page (category, tag, archive, author) title

if ( greenthumb_need_page_title() ) {
	greenthumb_sc_layouts_showed('title', true);
	greenthumb_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( false && is_single() )  {
							?><div class="sc_layouts_title_meta"><?php
								greenthumb_show_post_meta(apply_filters('greenthumb_filter_post_meta_args', array(
									'components' => 'categories,date,counters,edit',
									'counters' => 'views,comments,likes',
									'seo' => true
									), 'header', 1)
								);
							?></div><?php
						}
						
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$greenthumb_blog_title = greenthumb_get_blog_title();
							$greenthumb_blog_title_text = $greenthumb_blog_title_class = $greenthumb_blog_title_link = $greenthumb_blog_title_link_text = '';
							if (is_array($greenthumb_blog_title)) {
								$greenthumb_blog_title_text = $greenthumb_blog_title['text'];
								$greenthumb_blog_title_class = !empty($greenthumb_blog_title['class']) ? ' '.$greenthumb_blog_title['class'] : '';
								$greenthumb_blog_title_link = !empty($greenthumb_blog_title['link']) ? $greenthumb_blog_title['link'] : '';
								$greenthumb_blog_title_link_text = !empty($greenthumb_blog_title['link_text']) ? $greenthumb_blog_title['link_text'] : '';
							} else
								$greenthumb_blog_title_text = $greenthumb_blog_title;
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr($greenthumb_blog_title_class); ?>"><?php
								$greenthumb_top_icon = greenthumb_get_category_icon();
								if (!empty($greenthumb_top_icon)) {
									$greenthumb_attr = greenthumb_getimagesize($greenthumb_top_icon);
									?><img src="<?php echo esc_url($greenthumb_top_icon); ?>" alt="" <?php if (!empty($greenthumb_attr[3])) greenthumb_show_layout($greenthumb_attr[3]);?>><?php
								}
								echo wp_kses_data($greenthumb_blog_title_text);
							?></h1>
							<?php
							if (!empty($greenthumb_blog_title_link) && !empty($greenthumb_blog_title_link_text)) {
								?><a href="<?php echo esc_url($greenthumb_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($greenthumb_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'greenthumb_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>