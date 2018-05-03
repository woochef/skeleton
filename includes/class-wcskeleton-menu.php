<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class WCSkeleton_Menu {
	/*
	 * @since 0.1
	 */
	public function register_admin_menu() {
		add_menu_page( __( 'Skeleton', 'woochef-skeleton' ), __( 'Skeleton', 'woochef-skeleton' ), 'manage_options', 'skeleton', array( 'WCSkeleton_Admin', 'action_index' ) );
	}
}
