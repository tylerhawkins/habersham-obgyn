<?php

if( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'ROP_db' ) ) {
	class ROP_db {

		function __construct() {

		}

		/**
		* @param array $query
		* @param sting $type
		*/
		function query( $query, $type = 'get_results' ) {
			global $wpdb;

			extract( $query );

			/* join */
			if( isset( $join ) && count( $join ) > 0 ) {

				$_join = array();
				foreach( $join as $item ) :

					$table_name_join = $wpdb->prefix . $item['table_name'];
					$join_type = ( isset( $item['type'] ) ) ? $item['type'] : '';
					array_push( $_join, $join_type . ' JOIN '. $table_name_join . ' ON ' . $item['on'] );

				endforeach;
			}

			$table_name = $wpdb->prefix . $table_name;
			/* select */
			$sql = array( 'SELECT '. $select .' FROM ' . $table_name );
			/* join */
			( isset( $_join ) && count( $_join ) > 0 ) ? array_push( $sql, implode( " ", $_join ) ) : '';
			/* where */
			( isset( $where ) ) ? array_push( $sql, 'WHERE ' . $where ) : '';
			/* order by */
			( isset( $order_by ) ) ? array_push( $sql, 'ORDER BY ' . $order_by ) : '';
			/* group by */
			( isset( $group_by ) ) ? array_push( $sql, 'GROUP BY ' . $group_by ) : '';
			/* sql addon */
			( isset( $sql_addon ) ) ? array_push( $sql, $sql_addon ) : '';
			/* limit */
			( isset( $limit ) ) ? array_push( $sql, 'LIMIT ' . $limit['start'] . ', ' . $limit['count'] ) : '';

			switch ($type) {
				case 'get_var': $response = $wpdb->get_var( implode( ' ', $sql ), OBJECT ); break;
				case 'get_row': $response = $wpdb->get_row( implode( ' ', $sql ), OBJECT ); break;
				default: $response = $wpdb->get_results( implode( ' ', $sql ), OBJECT ); break;
			}

			$this->items = $response;

			return $this->items;
		}

		/**
		* save
		* @param string $table_name
		* @param array $fields
		*/
		function save( $table_name, $fields ) {
			global $wpdb;
			extract( $fields );
			unset( $fields['id'] );

			$table_name = $wpdb->prefix . $table_name;
			$sql = '';
			if( ! empty( $id ) || $id != 0 ) :
				/* Update */
				$set = array();
				foreach( $fields as $k => $v )
					array_push($set, "{$k} = '{$v}'");

				$sql .= 'UPDATE ' . $table_name . ' SET ' . implode(', ', $set) . ' WHERE id = ' . $id;
			else:
				/* Insert */
				$sql .= 'INSERT INTO ' . $table_name . ' (' . implode( ', ', array_keys($fields) ) . ') VALUES (\'' . implode( '\', \'', array_values($fields) ) . '\')';
			endif;
			/* query */
			$wpdb->query( $sql );

			/* return id */
			return ( ! empty( $id ) ) ? $id : $wpdb->insert_id;
		}

		/**
		* del
		* @param array $query
		*/
		function del( $query ) {
			global $wpdb;

			extract( $query );

			$table_name = $wpdb->prefix . $table_name;

			$sql = array( 'DELETE FROM '. $table_name );

			/* START where */
			if( isset( $where ) && count( $where ) > 0 ) :

				$_where = array();

				foreach( $where as $field => $value ) :

					if( is_array( $value ) ) :
						array_push( $_where, "{$field} IN(". implode( ', ', $value ) .")" );
					else:
						array_push( $_where, "{$field} = '{$value}'" );
					endif;

				endforeach;

				array_push( $sql, 'WHERE ' . implode( ' AND ', $_where ) );
			endif;
			/* END where */

			return $wpdb->query( implode( ' ', $sql ) );
		}

		/**
		* get list orders
		* @param array $orderby, $sort, $id
		*/
		function get_orders($orderby = 'id', $sort = 'DESC', $id = null, $user_id = null){

			$ROP_create_list_page = new ROP_create_list_page;
			$paged = isset( $_GET['paged'] ) ? $_GET['paged'] : 1;
			$order_by = isset( $_GET['orderby'] ) ? $_GET['orderby'] : $orderby;
			$order = isset( $_GET['order'] ) ? $_GET['order'] : $sort;
			$date = (isset( $_GET['date'] )) ? date('Y-m-d',strtotime(str_replace(',','',$_GET['date']))) :'';
			$data_url = array('orderby'=>$order_by, 'order'=>$order);

			if(!empty($date)){
				$data_url['date'] = $date;
			}

			$where = '';

			$args = array(
					'select'		=> 'distinct a.*, b.post_title',
					'table_name'	=> 'rop_pricing_orders AS a',
					'join'			=> array(
											array(
												'type' 			=> 'left',
												'table_name' 	=> 'posts AS b',
												'on'			=> 'b.id = a.post_id'
												)
										),
					'order_by'		=> 'a.'.$order_by.' '.$order,
			);

			if(!empty($date)){
				$where.= 'DATE(a.start_date) = "'.$date.'" OR DATE(a.end_date) = "'.$date.'"';
			}

			if(!empty($id)){
				$where.= (!empty($where))?' AND ':'';
				$where.= 'a.id ='.(int)$id;
			}

			if(!empty($user_id)){
				$where.= (!empty($where))?' AND ':'';
				$where.= 'a.user_id ='.(int)$user_id;
			}

			(!empty($where))?$args['where'] = $where:'';

			$count_orders = count($this->query( $args, 'get_results' ));

			/* set default params */
			$post_per_page = 20;
			$slug_page = 'rop-orders';


			/* set limit */
			if( $post_per_page !== -1 ) :
				$args['limit']['start'] = $post_per_page * ( $paged - 1 );
				$args['limit']['count'] = $post_per_page;
			endif;

			$orders = $this->query( $args, 'get_results' );

			/*get data*/
			if(!empty($orders)){

			}
			$result = array('orders' => $orders);
			$result['total_items'] = $count_orders;
			$result['pagination'] = '';

			/* make pagination */
			if( $post_per_page !== -1 ) :
				if( $count_orders > $post_per_page ) :
					$num_pages = ceil( $count_orders / $post_per_page );
					$current_page = $paged;
					$result['pagination'] = $ROP_create_list_page->make_pagination( $num_pages, $current_page, $slug_page, $data_url );
				endif;
			endif;
			return $result;
		}

		/**
		* clean_orders
		* @param number $ids
		*/
		function clean_orders( $ids ) {

			/* Del all table orders */
			$args = array(
				'table_name' => 'rop_pricing_orders',
				'where'		 => array( 'id' => $ids ),
				);
			$this->del( $args );

			return true;
		}

		/**
		* check_expiration
		* @param number $user_id, $post_id
		*/
		function check_expiration( $user_id, $post_id ) {
			$order = '';
			if(!empty($post_id)){
				$args = array(
						'select'		=> 'distinct a.*',
						'table_name'	=> 'rop_pricing_orders AS a',
						'order_by'		=> 'a.id DESC',
						'where'			=> 'a.user_id ='.$user_id.'
											AND a.end_date >= CURRENT_TIMESTAMP
											AND a.status LIKE "%Completed%"
											AND a.post_id ='.$post_id,
				);
				$order = $this->query( $args, 'get_row' );
			}
			return $order;
		}
	}
}
