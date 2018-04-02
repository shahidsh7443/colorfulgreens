<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0
 */

$greenthumb_blog_style = explode('_', greenthumb_get_theme_option('blog_style'));
$greenthumb_columns = empty($greenthumb_blog_style[1]) ? 2 : max(2, $greenthumb_blog_style[1]);
$greenthumb_post_format = get_post_format();
$greenthumb_post_format = empty($greenthumb_post_format) ? 'standard' : str_replace('post-format-', '', $greenthumb_post_format);
$greenthumb_animation = greenthumb_get_theme_option('blog_animation');
$greenthumb_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($greenthumb_columns).' post_format_'.esc_attr($greenthumb_post_format) ); ?>
	<?php echo (!greenthumb_is_off($greenthumb_animation) ? ' data-animation="'.esc_attr(greenthumb_get_animation_classes($greenthumb_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($greenthumb_image[1]) && !empty($greenthumb_image[2])) echo intval($greenthumb_image[1]) .'x' . intval($greenthumb_image[2]); ?>"
	data-src="<?php if (!empty($greenthumb_image[0])) echo esc_url($greenthumb_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$greenthumb_image_hover = 'icon';	//greenthumb_get_theme_option('image_hover');
	if (in_array($greenthumb_image_hover, array('icons', 'zoom'))) $greenthumb_image_hover = 'dots';
	$greenthumb_components = greenthumb_is_inherit(greenthumb_get_theme_option_from_meta('meta_parts')) 
								? 'categories,date,counters,share'
								: greenthumb_array_get_keys_by_value(greenthumb_get_theme_option('meta_parts'));
	$greenthumb_counters = greenthumb_is_inherit(greenthumb_get_theme_option_from_meta('counters')) 
								? 'comments'
								: greenthumb_array_get_keys_by_value(greenthumb_get_theme_option('counters'));
	greenthumb_show_post_featured(array(
		'hover' => $greenthumb_image_hover,
		'thumb_size' => greenthumb_get_thumb_size( strpos(greenthumb_get_theme_option('body_style'), 'full')!==false || $greenthumb_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. (!empty($greenthumb_components)
										? greenthumb_show_post_meta(apply_filters('greenthumb_filter_post_meta_args', array(
											'components' => $greenthumb_components,
											'counters' => $greenthumb_counters,
											'seo' => false,
											'echo' => false
											), $greenthumb_blog_style[0], $greenthumb_columns))
										: '')
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'greenthumb') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>