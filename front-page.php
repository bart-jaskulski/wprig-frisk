<?php
/**
 * Render your site front page, whether the front page displays the blog posts index or a static page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#front-page-display
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

get_header();

// Use grid layout if blog index is displayed.
if ( is_home() ) {
	wp_rig()->print_styles( 'wp-rig-content', 'wp-rig-front-page' );
} else {
	wp_rig()->print_styles( 'wp-rig-content' );
}

?>
	<main id="primary" class="site-main">
		<?php the_content(); ?>
		<section class="alignfull address-container">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2464.7046458387795!2d19.389381316149105!3d51.84808957969269!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471bb5cea59485ad%3A0x9ec9137d22b9547b!2sAndrzeja%20Struga%2039%2C%2095-100%20Zgierz!5e0!3m2!1sen!2spl!4v1612007536461!5m2!1sen!2spl" width="1000" height="550" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
			<?php wp_rig()->display_address_sidebar(); ?>
		</section>
	</main><!-- #primary -->
<?php
get_footer();
