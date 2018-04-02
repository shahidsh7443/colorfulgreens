<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($greenthumb_columns).' post_format_'.esc_attr($greenthumb_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!greenthumb_is_off($greenthumb_animation) ? ' data-animation="'.esc_attr(greenthumb_get_animation_classes($greenthumb_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$greenthumb_image_hover = greenthumb_get_theme_option('image_hover');
	// Featured image
	greenthumb_show_post_featured(array(
		'thumb_size' => greenthumb_get_thumb_size(strpos(greenthumb_get_theme_option('body_style'), 'full')!==false || $greenthumb_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $greenthumb_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $greenthumb_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>