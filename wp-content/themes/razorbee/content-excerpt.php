<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0
 */

$greenthumb_post_format = get_post_format();
$greenthumb_post_format = empty($greenthumb_post_format) ? 'standard' : str_replace('post-format-', '', $greenthumb_post_format);
$greenthumb_animation = greenthumb_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($greenthumb_post_format) ); ?>
	<?php echo (!greenthumb_is_off($greenthumb_animation) ? ' data-animation="'.esc_attr(greenthumb_get_animation_classes($greenthumb_animation)).'"' : ''); ?>
	><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	greenthumb_show_post_featured(array( 'thumb_size' => greenthumb_get_thumb_size( strpos(greenthumb_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));

	// Title and post meta
	if (get_the_title() != '') {
		?>
		<div class="post_header entry-header">
			<?php
			do_action('greenthumb_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

			do_action('greenthumb_action_before_post_meta'); 

			// Post meta
			$greenthumb_components = greenthumb_is_inherit(greenthumb_get_theme_option_from_meta('meta_parts')) 
										? 'categories,date,counters,edit'
										: greenthumb_array_get_keys_by_value(greenthumb_get_theme_option('meta_parts'));
			$greenthumb_counters = greenthumb_is_inherit(greenthumb_get_theme_option_from_meta('counters')) 
										? 'views,likes,comments'
										: greenthumb_array_get_keys_by_value(greenthumb_get_theme_option('counters'));

			if (!empty($greenthumb_components))
				greenthumb_show_post_meta(apply_filters('greenthumb_filter_post_meta_args', array(
					'components' => $greenthumb_components,
					'counters' => $greenthumb_counters,
					'seo' => false
					), 'excerpt', 1)
				);
			?>
		</div><!-- .post_header --><?php
	}
	
	// Post content
	?><div class="post_content entry-content"><?php
		if (greenthumb_get_theme_option('blog_content') == 'fullpost') {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'greenthumb' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'greenthumb' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$greenthumb_show_learn_more = !in_array($greenthumb_post_format, array('link', 'aside', 'status', 'quote'));

			// Post content area
			?><div class="post_content_inner"><?php
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($greenthumb_post_format, array('link', 'aside', 'status'))) {
					the_content();
				} else if ($greenthumb_post_format == 'quote') {
					if (($quote = greenthumb_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
						greenthumb_show_layout(wpautop($quote));
					else
						the_excerpt();
				} else if (substr(get_the_content(), 0, 1)!='[') {
					the_excerpt();
				}
			?></div><?php
			// More button
			if ( $greenthumb_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'greenthumb'); ?></a></p><?php
			}

		}
	?></div><!-- .entry-content -->
</article>