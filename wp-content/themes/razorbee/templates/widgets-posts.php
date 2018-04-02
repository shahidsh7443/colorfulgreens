<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0
 */

$greenthumb_post_id    = get_the_ID();
$greenthumb_post_date  = greenthumb_get_date();
$greenthumb_post_title = get_the_title();
$greenthumb_post_link  = get_permalink();
$greenthumb_post_author_id   = get_the_author_meta('ID');
$greenthumb_post_author_name = get_the_author_meta('display_name');
$greenthumb_post_author_url  = get_author_posts_url($greenthumb_post_author_id, '');

$greenthumb_args = get_query_var('greenthumb_args_widgets_posts');
$greenthumb_show_date = isset($greenthumb_args['show_date']) ? (int) $greenthumb_args['show_date'] : 1;
$greenthumb_show_image = isset($greenthumb_args['show_image']) ? (int) $greenthumb_args['show_image'] : 1;
$greenthumb_show_author = isset($greenthumb_args['show_author']) ? (int) $greenthumb_args['show_author'] : 1;
$greenthumb_show_counters = isset($greenthumb_args['show_counters']) ? (int) $greenthumb_args['show_counters'] : 1;
$greenthumb_show_categories = isset($greenthumb_args['show_categories']) ? (int) $greenthumb_args['show_categories'] : 1;

$greenthumb_output = greenthumb_storage_get('greenthumb_output_widgets_posts');

$greenthumb_post_counters_output = '';
if ( $greenthumb_show_counters ) {
	$greenthumb_post_counters_output = '<span class="post_info_item post_info_counters">'
								. greenthumb_get_post_counters('comments')
							. '</span>';
}


$greenthumb_output .= '<article class="post_item with_thumb">';

if ($greenthumb_show_image) {
	$greenthumb_post_thumb = get_the_post_thumbnail($greenthumb_post_id, greenthumb_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($greenthumb_post_thumb) $greenthumb_output .= '<div class="post_thumb">' . ($greenthumb_post_link ? '<a href="' . esc_url($greenthumb_post_link) . '">' : '') . ($greenthumb_post_thumb) . ($greenthumb_post_link ? '</a>' : '') . '</div>';
}

$greenthumb_output .= '<div class="post_content">'
			. ($greenthumb_show_categories 
					? '<div class="post_categories">'
						. greenthumb_get_post_categories()
						. $greenthumb_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($greenthumb_post_link ? '<a href="' . esc_url($greenthumb_post_link) . '">' : '') . ($greenthumb_post_title) . ($greenthumb_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('greenthumb_filter_get_post_info', 
								'<div class="post_info">'
									. ($greenthumb_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($greenthumb_post_link ? '<a href="' . esc_url($greenthumb_post_link) . '" class="post_info_date">' : '') 
											. esc_html($greenthumb_post_date) 
											. ($greenthumb_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($greenthumb_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'greenthumb') . ' ' 
											. ($greenthumb_post_link ? '<a href="' . esc_url($greenthumb_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($greenthumb_post_author_name) 
											. ($greenthumb_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$greenthumb_show_categories && $greenthumb_post_counters_output
										? $greenthumb_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
greenthumb_storage_set('greenthumb_output_widgets_posts', $greenthumb_output);
?>