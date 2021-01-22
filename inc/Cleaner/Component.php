<?php
/**
 * WP_Rig\WP_Rig\Cleaner\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Cleaner;

use WP_Rig\WP_Rig\Component_Interface;
use function add_action;
use function remove_action;
use function add_filter;
use function unregister_widget;

class Component implements Component_Interface {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'cleaner';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		add_filter( 'tiny_mce_plugins', array( $this, 'disable_emojicons_tinymce' ) );
		add_filter( 'emoji_svg_url', '__return_false' );
		add_action( 'widgets_init', array( $this, 'action_remove_default_widgets' ) );

		/**
		 * Disable xmlrpc.php
		 */

		add_filter( 'xmlrpc_enabled', '__return_false' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
	}

	public function disable_emojicons_tinymce( $plugins ) {
		return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
	}

	public function action_remove_default_widgets() {
		$widgets = array(
			'WP_Widget_Pages',
			'WP_Widget_Calendar',
			'WP_Widget_Archives',
			'WP_Widget_Links',
			'WP_Widget_Media_Audio',
			'WP_Widget_Media_Image',
			'WP_Widget_Media_Video',
			'WP_Widget_Media_Gallery',
			'WP_Widget_Meta',
			'WP_Widget_Search',
			// 'WP_Widget_Text',
			'WP_Widget_Categories',
			'WP_Widget_Recent_Posts',
			'WP_Widget_Recent_Comments',
			'WP_Widget_RSS',
			'WP_Widget_Tag_Cloud',
			'WP_Nav_Menu_Widget',
			// 'WP_Widget_Custom_HTML',
		);

		array_walk( $widgets, 'unregister_widget' );
	}
}
