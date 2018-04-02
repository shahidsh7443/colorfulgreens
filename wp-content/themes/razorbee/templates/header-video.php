<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0.14
 */
$greenthumb_header_video = greenthumb_get_header_video();
$greenthumb_embed_video = '';
if (!empty($greenthumb_header_video) && !greenthumb_is_from_uploads($greenthumb_header_video)) {
	if (greenthumb_is_youtube_url($greenthumb_header_video) && preg_match('/[=\/]([^=\/]*)$/', $greenthumb_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$greenthumb_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($greenthumb_header_video) . '[/embed]' ));
			$greenthumb_embed_video = greenthumb_make_video_autoplay($greenthumb_embed_video);
		} else {
			$greenthumb_header_video = str_replace('/watch?v=', '/embed/', $greenthumb_header_video);
			$greenthumb_header_video = greenthumb_add_to_url($greenthumb_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$greenthumb_embed_video = '<iframe src="' . esc_url($greenthumb_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php greenthumb_show_layout($greenthumb_embed_video); ?></div><?php
	}
}
?>