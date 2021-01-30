<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wp-rig' ); ?></a>

	<header id="masthead" class="site-header">
		<nav class="site-navigation">
			<?php
			if ( has_custom_logo() ) :
				the_custom_logo();
			else :
				?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="brand-logo"><?php bloginfo( 'name' ); ?></a>
	<?php	endif; ?>
<button class="menu-toggle js-menu-toggle"><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/menu-black-36dp.svg' ) ); ?>"></button>
<?php
			wp_rig()->display_primary_nav_menu(
				array(
					'menu_class' => 'header-menu menu js-menu-open',
				)
			);
			?>

		</nav>
	</header><!-- #masthead -->
