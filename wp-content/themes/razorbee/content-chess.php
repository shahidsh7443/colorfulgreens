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
$greenthumb_columns = empty($greenthumb_blog_style[1]) ? 1 : max(1, $greenthumb_blog_style[1]);
$greenthumb_expanded = !greenthumb_sidebar_present() && greenthumb_is_on(greenthumb_get_theme_option('expand_content'));
$greenthumb_post_format = get_post_format();
$greenthumb_post_format = empty($greenthumb_post_format) ? 'standard' : str_replace('post-format-', '', $greenthumb_post_format);
$greenthumb_animation = greenthumb_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($greenthumb_columns).' post_format_'.esc_attr($greenthumb_post_format) ); ?>
	<?php echo (!greenthumb_is_off($greenthumb_animation) ? ' data-animation="'.esc_attr(greenthumb_get_animation_classes($greenthumb_animation)).'"' : ''); ?>>

	<?php
	// Add anchor
	if ($greenthumb_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	greenthumb_show_post_featured( array(
											'class' => $greenthumb_columns == 1 ? 'greenthumb-full-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => greenthumb_get_thumb_size(
																	strpos(greenthumb_get_theme_option('body_style'), 'full')!==false
																		? ( $greenthumb_columns > 1 ? 'huge' : 'original' )
																		: (	$greenthumb_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('greenthumb_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			
			do_action('greenthumb_action_before_post_meta'); 

			// Post meta
			$greenthumb_components = greenthumb_is_inherit(greenthumb_get_theme_option_from_meta('meta_parts')) 
										? 'categories,date'.($greenthumb_columns < 3 ? ',counters' : '').($greenthumb_columns == 1 ? ',edit' : '')
										: greenthumb_array_get_keys_by_value(greenthumb_get_theme_option('meta_parts'));
			$greenthumb_counters = greenthumb_is_inherit(greenthumb_get_theme_option_from_meta('counters')) 
										? 'comments'
										: greenthumb_array_get_keys_by_value(greenthumb_get_theme_option('counters'));
			$greenthumb_post_meta = empty($greenthumb_components) 
										? '' 
										: greenthumb_show_post_meta(apply_filters('greenthumb_filter_post_meta_args', array(
												'components' => $greenthumb_components,
												'counters' => $greenthumb_counters,
												'seo' => false,
												'echo' => false
												), $greenthumb_blog_style[0], $greenthumb_columns)
											);
			greenthumb_show_layout($greenthumb_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$greenthumb_show_learn_more = !in_array($greenthumb_post_format, array('link', 'aside', 'status', 'quote'));
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
				?>
			</div>
			<?php
			// Post meta
			if (in_array($greenthumb_post_format, array('link', 'aside', 'status', 'quote'))) {
				greenthumb_show_layout($greenthumb_post_meta);
			}
			// More button
			if ( $greenthumb_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'greenthumb'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>