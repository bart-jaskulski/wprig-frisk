<?php
/**
 * Template part for displaying a post
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<?php

		get_template_part( 'template-parts/content/entry_content', get_post_type() );

	?>
</article><!-- #post-<?php the_ID(); ?> -->
