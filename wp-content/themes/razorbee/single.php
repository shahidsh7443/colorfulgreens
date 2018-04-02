<?php
/**
 * The template to display single post
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0
 */

get_header();

while ( have_posts() ) { the_post();

	get_template_part( 'content', get_post_format() );

	// Related posts
	if ((int) greenthumb_get_theme_option('show_related_posts') && ($greenthumb_related_posts = (int) greenthumb_get_theme_option('related_posts')) > 0) {
		greenthumb_show_related_posts(array('orderby' => 'rand',
										'posts_per_page' => max(1, min(9, $greenthumb_related_posts)),
										'columns' => max(1, min(4, greenthumb_get_theme_option('related_columns')))
										),
									greenthumb_get_theme_option('related_style')
									);
	}

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}

get_footer();
?>