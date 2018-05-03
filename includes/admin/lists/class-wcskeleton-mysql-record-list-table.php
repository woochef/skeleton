<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class WCSkeleton_MySQL_Record_List_Table extends WP_List_Table {
	/**
	 * @since 0.1
	 * @var   array  Of table's column structure.
	 */	
	protected $structure = array();

	protected $table;

	/**
	 * @since 0.1
	 */
	public function __construct( $table ) {
		parent::__construct( array(
			'singular' => 'record',
			'plural'   => 'records',
			'ajax'     => false,
		) );

		$this->table = $table;
		$this->set_column_structure();

		// echo $this->table;
		$this->_column_headers = array( $this->get_columns(), array(), array() );
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	public function get_columns() {
		$colums = array();

		foreach ( $this->structure as $value ) {
			$colums[ $value['field'] ] = $value['field'];
		}

		return $colums;
	}

	/**
	 * Prepare customer list items.
	 */
	public function prepare_items() {
		global $wpdb;

		$this->items = $wpdb->get_results( 'SELECT * FROM ' . $this->table. ' LIMIT ' . ( ( $this->get_pagenum() - 1 ) * 20 ) . ',20' );

		$this->set_pagination_args( array(
			'total_items' => $wpdb->query( 'SELECT * FROM ' . $this->table ),
			'per_page'    => 20
		) );
	}

	/**
	 * @param object $item
	 * @param string $column_name
	 */
	protected function column_default( $item, $column_name ) {
		return $item->$column_name;
	}

	protected function set_column_structure() {
		global $wpdb;

		$columns = $wpdb->get_results( 'SHOW COLUMNS FROM ' . $this->table, ARRAY_A );

		foreach ( $columns as $value ) {
			$this->structure[] = array_change_key_case( $value );
		}
	}
}
