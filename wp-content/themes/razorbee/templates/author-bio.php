<?php
/**
 * The template to display the Author bio
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0
 */
?>

<div class="author_info author vcard" itemprop="author" itemscope itemtype="http://schema.org/Person">

	<div class="author_avatar" itemprop="image">
		<?php 
		$greenthumb_mult = greenthumb_get_retina_multiplier();
		echo get_avatar( get_the_author_meta( 'user_email' ), 150*$greenthumb_mult );
		?>
	</div><!-- .author_avatar -->

	<div class="author_description">
		<span class="author_subtitle"><?php esc_html_e('About Author', 'greenthumb'); ?></span>
		<h5 class="author_title" itemprop="name">
			<a class="author_link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_the_author(); ?></a>
		</h5>

		<div class="author_bio" itemprop="description">
			<?php echo wp_kses_post(wpautop(get_the_author_meta( 'description' ))); ?>
			<?php do_action('greenthumb_action_user_meta'); ?>
		</div><!-- .author_bio -->

	</div><!-- .author_description -->

</div><!-- .author_info -->
