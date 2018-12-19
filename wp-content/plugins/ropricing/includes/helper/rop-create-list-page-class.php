<?php

if( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'ROP_create_list_page' ) ) {
	class ROP_create_list_page {
		private $slug_page;
		public $items;

		function __construct() {

		}

		/**
		* setup_page
		* @param array $params
		* @param string $query
		* @param function call back $template_item_func
		* @param number $post_per_page
		* @param string $slug_page
		* @param Boolean $pagination (true/false)
		*/
		function setup_page( $params ) {
			extract( $params );

			/* set default params */
			$post_per_page = isset( $post_per_page ) ? $post_per_page : -1;
			$this->slug_page = isset( $slug_page ) ? $slug_page : '';

			$result = array();
			$paged = isset( $_GET['paged'] ) ? $_GET['paged'] : 1;

			/* set limit */
			if( $post_per_page !== -1 ) :
				$query['limit']['start'] = $post_per_page * ( $paged - 1 );
				$query['limit']['count'] = $post_per_page;
			endif;

			/* query */
			$items = $this->query( $query );

			/* params */
			$params = ( isset( $params ) ) ? $params : array();

			/* make list item */
			array_push( $result, $this->make_list_item( $items, $template_item_func, $params ) );

			/* make pagination */
			if( isset( $pagination ) && $pagination == true && $post_per_page !== -1 ) :
				unset( $query['limit'] );
				$items_pagination = $this->query( $query );
				if( count( $items_pagination ) > $post_per_page ) :
					$num_pages = ceil( count( $items_pagination ) / $post_per_page );
					$current_page = $paged;
					array_push( $result, $this->make_pagination( $num_pages, $current_page, $this->slug_page ) );
				endif;
			endif;

			return implode( '', $result );
		}

		/**
		* @param array $query
		*/
		function query( $query ) {
			$db = new ROP_db;
			$this->items = $db->query( $query );

			return $this->items;
		}

		/**
		* @param object $items
		* @param function call back $template_item_func
		* @param array $params
		*/
		function make_list_item( $items, $template_item_func, $params ) {
			$result = array();

			if( ! isset( $items ) || count( $items ) <= 0 || empty( $template_item_func ) ) :
				array_push( $result, __( 'Not item', ROP_NAME ) );
				return;
			endif;

			foreach( $items as $k => $item ) :
				array_push( $result, call_user_func( $template_item_func, $item, $k, $params ) );
			endforeach;

			return implode( '', $result );
		}

		/**
		* @param number $num_pages
		* @param number $current_page
		*/
		function make_pagination( $num_pages, $current_page ,$slug_page, $data_url = array()) {

			$result = array();
			array_push( $result, '<ul class=\'rop-pagination\'>' );
			for( $i = 1; $i <= $num_pages; ++$i ) :

				$data['page'] = $slug_page;
				if(!empty($data_url)){
					foreach($data_url AS $k=>$val){
						$data[$k] = $val;
					}
				}
				$data['paged'] = $i;

				$num_page_url = add_query_arg( $data, admin_url('admin.php'));

				$is_num_page = ( $i == $current_page )
					? '<span class=\'current\'>' . $i . '</span>'
					: '<a href=\'' . $num_page_url . '\'>' . $i . '</a>';

				array_push( $result, '<li>' . $is_num_page . '</li>' );

			endfor;
			array_push( $result, '</ul>' );

			return implode( '', $result );
		}
	}
}
?>
