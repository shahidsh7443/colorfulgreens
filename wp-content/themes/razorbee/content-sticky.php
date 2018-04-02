<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0
 */

$greenthumb_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$greenthumb_post_format = get_post_format();
$greenthumb_post_format = empty($greenthumb_post_format) ? 'standard' : str_replace('post-format-', '', $greenthumb_post_format);
$greenthumb_animation = greenthumb_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($greenthumb_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($greenthumb_post_format) ); ?>
	<?php echo (!greenthumb_is_off($greenthumb_animation) ? ' data-animation="'.esc_attr(greenthumb_get_animation_classes($greenthumb_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	greenthumb_show_post_featured(array(
		'thumb_size' => greenthumb_get_thumb_size($greenthumb_columns==1 ? 'big' : ($greenthumb_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($greenthumb_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			greenthumb_show_post_meta(apply_filters('greenthumb_filter_post_meta_args', array(), 'sticky', $greenthumb_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>