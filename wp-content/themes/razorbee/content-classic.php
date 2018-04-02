<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0
 */

$greenthumb_blog_style = explode('_', greenthumb_get_theme_option('blog_style'));
$greenthumb_columns = empty($greenthumb_blog_style[1]) ? 2 : max(2, $greenthumb_blog_style[1]);
$greenthumb_expanded = !greenthumb_sidebar_present() && greenthumb_is_on(greenthumb_get_theme_option('expand_content'));
$greenthumb_post_format = get_post_format();
$greenthumb_post_format = empty($greenthumb_post_format) ? 'standard' : str_replace('post-format-', '', $greenthumb_post_format);
$greenthumb_animation = greenthumb_get_theme_option('blog_animation');
$greenthumb_components = greenthumb_is_inherit(greenthumb_get_theme_option_from_meta('meta_parts')) 
							? 'categories,date,counters'.($greenthumb_columns < 3 ? ',edit' : '')
							: greenthumb_array_get_keys_by_value(greenthumb_get_theme_option('meta_parts'));
$greenthumb_counters = greenthumb_is_inherit(greenthumb_get_theme_option_from_meta('counters')) 
							? 'comments'
							: greenthumb_array_get_keys_by_value(greenthumb_get_theme_option('counters'));

?><div class="<?php echo $greenthumb_blog_style[0] == 'classic' ? 'column' : 'masonry_item masonry_item'; ?>-1_<?php echo esc_attr($greenthumb_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_format_'.esc_attr($greenthumb_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($greenthumb_columns)
					. ' post_layout_'.esc_attr($greenthumb_blog_style[0]) 
					. ' post_layout_'.esc_attr($greenthumb_blog_style[0]).'_'.esc_attr($greenthumb_columns)
					); ?>
	<?php echo (!greenthumb_is_off($greenthumb_animation) ? ' data-animation="'.esc_attr(greenthumb_get_animation_classes($greenthumb_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	greenthumb_show_post_featured( array( 'thumb_size' => greenthumb_get_thumb_size($greenthumb_blog_style[0] == 'classic'
													? (strpos(greenthumb_get_theme_option('body_style'), 'full')!==false 
															? ( $greenthumb_columns > 2 ? 'big' : 'huge' )
															: (	$greenthumb_columns > 2
																? ($greenthumb_expanded ? 'med' : 'small')
																: ($greenthumb_expanded ? 'big' : 'med')
																)
														)
													: (strpos(greenthumb_get_theme_option('body_style'), 'full')!==false 
															? ( $greenthumb_columns > 2 ? 'masonry-big' : 'full' )
															: (	$greenthumb_columns <= 2 && $greenthumb_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($greenthumb_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('greenthumb_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

			do_action('greenthumb_action_before_post_meta'); 

			// Post meta
			if (!empty($greenthumb_components))
				greenthumb_show_post_meta(apply_filters('greenthumb_filter_post_meta_args', array(
					'components' => $greenthumb_components,
					'counters' => $greenthumb_counters,
					'seo' => false
					), $greenthumb_blog_style[0], $greenthumb_columns)
				);

			do_action('greenthumb_action_after_post_meta'); 
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$greenthumb_show_learn_more = true; //!in_array($greenthumb_post_format, array('link', 'aside', 'status', 'quote'));
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($greenthumb_post_format, array('link', 'aside', 'status'))) {
				$greenthumb_show_learn_more = false;
				the_content();
			} else if ($greenthumb_post_format == 'quote') {
				$greenthumb_show_learn_more = false;
				if (($quote = greenthumb_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
					greenthumb_show_layout(wpautop($quote));
				else
					the_excerpt();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($greenthumb_post_format, array('link', 'aside', 'status', 'quote'))) {
			if (!empty($greenthumb_components))
				greenthumb_show_post_meta(apply_filters('greenthumb_filter_post_meta_args', array(
					'components' => $greenthumb_components,
					'counters' => $greenthumb_counters
					), $greenthumb_blog_style[0], $greenthumb_columns)
				);
		}
		// More button
		if ( $greenthumb_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'greenthumb'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>