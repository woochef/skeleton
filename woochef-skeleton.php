<?php
/**
 * Plugin Name: WooChef: Skeleton
 * Plugin URI:  https://github.com/woochef/skeleton
 * Description: WooChef: Skeleton is a tool to analyze database, by querying and displaying it out at the WordPress admin page.
 * Version:     0.1
 * Author:      WooChef and contributors
 * Author URI:  https://github.com/woochef/skeleton/graphs/contributors
 * Text Domain: woochef-skeleton
 * License:     MIT
 * License URI: https://opensource.org/licenses/MIT
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

final class WooChef_Skeleton {
	/**
	 * WooChef_Skeleton version.
	 *
	 * @var string
	 */
	public $version = '0.1';

	/**
	 * The single instance of the class.
	 *
	 * @since 0.1
	 *
	 * @var   WooChef_Skeleton
	 */
	protected static $instance = null;

	/**
	 * WooChef_Skeleton Instance.
	 *
	 * @since 0.1
	 *
	 * @static
	 *
	 * @return WooChef_Skeleton  the instance.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @since 0.1
	 */
	public function __construct() {
		do_action( 'woochef_skeleton_initiating' );

		$this->load_classes();

		add_action( 'admin_menu', array( 'WCSkeleton_Menu', 'register_admin_menu' ) );

		do_action( 'woochef_skeleton_initiated' );
	}

	/**
	 * @since 0.1
	 */
	public function load_classes() {
		if ( is_admin() ) {
			require __DIR__ . '/admin/class-wcskeleton-admin.php';
			require __DIR__ . '/includes/admin/lists/class-wcskeleton-mysql-record-list-table.php';
			require __DIR__ . '/includes/admin/lists/class-wcskeleton-mysql-table-list-table.php';
			require __DIR__ . '/includes/class-wcskeleton-menu.php';
		}
	}
}

/**
 * @since  0.1
 *
 * @return WooChef_Skeleton  the instance.
 */
function woochef_skeleton() {
	return WooChef_Skeleton::instance();
}

woochef_skeleton();
