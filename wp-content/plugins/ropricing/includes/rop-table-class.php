<?php

if( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'ROP_table' ) ) {

	class ROP_table {

		function __construct() {

		}

		/**
		* table_data
		*/
		function table_data() {

			$table_data = array(
				'rop_pricing_orders' => array(
					'id mediumint(9) NOT NULL AUTO_INCREMENT',
					'name varchar(255) DEFAULT \'\' NOT NULL',
					'user_id int NOT NULL',
					'post_id int NOT NULL',
					'date datetime DEFAULT \'0000-00-00 00:00:00\' NOT NULL',
					'start_date datetime DEFAULT \'0000-00-00 00:00:00\' NOT NULL',
					'end_date datetime DEFAULT \'0000-00-00 00:00:00\' NOT NULL',
					'type varchar(255) DEFAULT \'\' NOT NULL',
					'trans_id int NOT NULL',
					'price decimal(10,2)',
					'token varchar(255) DEFAULT \'\' NOT NULL',
					'status varchar(20) DEFAULT \'on-hold\' NOT NULL',
					'UNIQUE KEY id (id)',
					)
				);

			return apply_filters( 'ROP_table_data', $table_data );
		}

		/**
		* table_create
		*/
		function table_create() {
			global $wpdb;
			$charset_collate = $wpdb->get_charset_collate();

			foreach( $this->table_data() as $tb_name => $tb_cols ) {
				$str_sql = 'CREATE TABLE ' . $wpdb->prefix . $tb_name . '('. implode( ', ', $tb_cols ) .')' . $charset_collate;
				$wpdb->query( $str_sql );
			}
		}

		/**
		* table_drop
		*/
		function table_drop() {
			global $wpdb;

			foreach( $this->table_data() as $tb_name => $tb_cols ) {
				$str_sql = "DROP TABLE ". $wpdb->prefix . $tb_name;
				$wpdb->query( $str_sql );
			}
		}
	}
}
?>
