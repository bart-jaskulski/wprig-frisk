<?php
/**
 * WP_Rig\WP_Rig\Comments\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Comments;

use WP_Rig\WP_Rig\Component_Interface;
use function add_action;
use function add_filter;
use function remove_action;
use function remove_menu_page;
use function wp_redirect;
use function admin_url;
use function is_admin_bar_showing;
use function get_post_types;
use function post_type_supports;
use function remove_post_type_support;
use function remove_meta_box;

class Component implements Component_Interface {
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'comments_removal';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'admin_init', array( $this, 'action_remove_comments_page' ) );
		// Close comments on the front-end.
		add_filter( 'comments_open', '__return_false', 20, 2 );
		add_filter( 'pings_open', '__return_false', 20, 2 );

		// Hide existing comments.
		add_filter( 'comments_array', '__return_empty_array', 10, 2 );

		// Remove comments pagadd_filter("use_block_editor_for_post_type", "disable_gutenberg_editor");e in menu.
		add_action(
			'admin_menu',
			function () {
				remove_menu_page( 'edit-comments.php' );
			}
		);

		// Remove comments links from admin bar.
		add_action(
			'init',
			function () {
				if ( is_admin_bar_showing() ) {
					remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
				}
			}
		);
	}

	public function action_remove_comments_page() {
		global $pagenow;

		if ( 'edit-comments.php' === $pagenow ) {
			wp_redirect( admin_url() );
			exit;
		}

		// Remove comments metabox from dashboard.
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );

		// Disable support for comments and trackbacks in post types.
		foreach ( get_post_types() as $post_type ) {
			if ( post_type_supports( $post_type, 'comments' ) ) {
				remove_post_type_support( $post_type, 'comments' );
				remove_post_type_support( $post_type, 'trackbacks' );
			}
		}
	}
}
