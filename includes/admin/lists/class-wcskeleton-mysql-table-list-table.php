<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class WCSkeleton_MySQL_Table_List_Table extends WP_List_Table {
	/**
	 * @since 0.1
	 */
	public function __construct() {
		parent::__construct( array(
			'singular' => 'table',
			'plural'   => 'tables',
			'ajax'     => false,
		) );

		$this->_column_headers = array( $this->get_columns(), array(), array() );
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	public function get_columns() {
		return array(
			'name'      => __( 'Table name', 'woochef-skeleton' ),
			'total_row' => __( 'Row', 'woochef-skeleton' ),
		);
	}

	/**
	 * Prepare customer list items.
	 */
	public function prepare_items() {
		global $wpdb;

		require_wp_db();

		if ( $blog_prefix = $wpdb->get_blog_prefix() ) {
			$tables = $wpdb->get_results( 'SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME LIKE \''. $blog_prefix .'%\' LIMIT ' . (($this->get_pagenum() - 1) * 20) . ',20', ARRAY_N ); 
		} else {
			$tables = $wpdb->get_results( 'SHOW TABLES', ARRAY_N ); 
		}

		$this->items = $tables;

		$this->set_pagination_args( array(
			'total_items' => $wpdb->query( 'SHOW TABLES' ),
			'per_page'    => $blog_prefix ? 20 : count($tables)
		) );
	}

	public function column_name( $item ) {
		return $item[0];
	}

	public function column_total_row( $item ) {
		global $wpdb;

		return $wpdb->get_var( 'SELECT COUNT(*) FROM ' . $item[0] );
	}
}
