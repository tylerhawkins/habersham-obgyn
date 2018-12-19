<?php

if( ! defined ( 'ABSPATH' ) ) exit;

if( ! class_exists( 'ROP_ajax' ) ) {
	class ROP_ajax {

		function __construct() {
			/* rop_del_order */
			add_action( 'wp_ajax_rop_del_order', array( &$this, 'rop_del_order' ) );
			add_action( 'wp_ajax_nopriv_rop_del_order', array( &$this, 'rop_del_order' ) );

			/* rop_checkout */
			add_action( 'wp_ajax_rop_checkout', array( &$this, 'rop_checkout' ) );
			add_action( 'wp_ajax_nopriv_rop_checkout', array( &$this, 'rop_checkout' ) );

			/* rop_process_checkout */
			add_action( 'wp_ajax_rop_process_checkout', array( &$this, 'rop_process_checkout' ) );
			add_action( 'wp_ajax_nopriv_rop_process_checkout', array( &$this, 'rop_process_checkout' ) );

		}

		/**
		** rop_del_order
		*/
		function rop_del_order() {
			extract($_POST);
			if(!empty($order)){
				$db = new ROP_db;
				$db->clean_orders($order);
			}
			$link = admin_url( 'admin.php?page=rop-orders' );
			wp_redirect( $link );
			exit;
		}

		/**
		** checkout
		**/
		function rop_checkout(){
			extract($_POST);
			$array = array();
			$post_id = (isset($post_id))?$post_id:'';
			# Set COOKIE
			setcookie( 'post_id', base64_encode(serialize($post_id)), time()+3600*24*100, COOKIEPATH, COOKIE_DOMAIN );

			#get link checkout
			$options = (array)json_decode(get_option('rop_option', array()));
			$checkout_page_id = ($options['rop_checkout_page_id'])?$options['rop_checkout_page_id']:get_option('rop_checkout_page_id');
			$redirect = (!empty($checkout_page_id))?esc_url( get_permalink($checkout_page_id)):home_url();
			$array['redirect'] = $redirect;

			print_r(json_encode( $array ));die;
		}

		/**
		** process checkout
		**/
		function rop_process_checkout(){
			$db = new ROP_db;
			$array['result'] = '';
			$array['redirect'] = '';
			# get user
			$user_id = get_current_user_id();
			# Check user login
			if(!empty($user_id)){
				# get option plugin
				$options = (array)json_decode(get_option('rop_option', array()));
				# Get COOKIE
				$data = (isset($_COOKIE['post_id']))?unserialize(base64_decode($_COOKIE['post_id'])):0;
				#expiration
				$order = $db->check_expiration($user_id,$data);
				if(!empty($order)){
					$array['result'] = esc_html('Please order item after the date expires.', ROP_NAME);
					print_r(json_encode( $array ));die;
				}
				# get post
				$post = get_post( $data );
				# get post meta
				$post_meta = rop_post_meta( $data );
				# calculation total price
				$type = $post_meta['tb_pricing_type'];
				# End date
				if($type == 'weekly'){
					$end_date = date('Y-m-d H:i:s', strtotime('+7 days'));
				}elseif($type == 'monthly'){
					$end_date = date('Y-m-d H:i:s', strtotime('+1 month'));
				}elseif($type == 'three'){
					$end_date = date('Y-m-d H:i:s', strtotime('+3 month'));
				}elseif($type == 'six'){
					$end_date = date('Y-m-d H:i:s', strtotime('+6 month'));
				}else{
					$end_date = date('Y-m-d H:i:s', strtotime('+12 month'));
				}
				# Price
				$price =  $post_meta['tb_pricing_price'];
				# save order
				$data_arr = array(
					'id' 				=> '',
					'name' 				=> (isset($post->post_title))?esc_attr($post->post_title):'',
					'post_id' 			=> $data,
					'user_id'			=> $user_id,
					'date'				=> date("Y-m-d H:i:s"),
					'start_date'		=> date("Y-m-d H:i:s"),
					'end_date'			=> $end_date,
					'type'				=> (isset($post_meta['type']))?esc_attr($post_meta['type']):'',
					'price'				=> esc_attr($price),
					);
				$order_id = $db->save( 'rop_pricing_orders', $data_arr );
				#payment
				if(!empty($order_id)){
					if(!empty($options['rop_enable_paypal']) && !empty($options['rop_paypal_api_username']) && !empty($options['rop_paypal_api_password']) && !empty($options['rop_paypal_api_signature'])){
						$result = $this->rop_process_payment($order_id, $options);
						# Redirect to success/confirmation/payment page
						print_r(json_encode( $result ));die;
					}else{
						# send mail
						if(!empty($options['rop_send_mail']) && !empty($options['rop_user_subject']) && !empty($options['rop_user_body']) && !empty($options['rop_mail_address']) && !empty($options['rop_admin_body']) && !empty($options['rop_admin_subject'])){
							$this->rop_send_mail($order_id);
						}else{
							$thankyou_page_id = ($options['rop_thankyou_page_id'])?$options['rop_thankyou_page_id']:get_option('rop_thankyou_page_id');
							$array['result'] = 'success';
							$array['redirect'] = (!empty($thankyou_page_id))?esc_url( get_permalink($thankyou_page_id)):home_url();
						}
					}
				}else{
					# can't save order
					$array['result'] = esc_html('Please check data again', ROP_NAME);
				}
			}else{
				# Login & return checkout page
				$checkout_page_id = ($options['rop_checkout_page_id'])?$options['rop_checkout_page_id']:get_option('rop_checkout_page_id');
				$array['result'] = '<a href="'.wp_login_url( get_permalink($checkout_page_id) ).'">'.esc_html('Login', ROP_NAME).'</a>'.esc_html(' before payment, please!', ROP_NAME);
			}

			print_r(json_encode( $array ));die;
		}
		/**
		** Payment
		**/
		function rop_process_payment( $order_id, $options ) {

			require_once (ROP_INCLUDES . '/rop-paypal-class.php');

			/*get order data*/
			$db = new ROP_db;
			$list = $db->get_orders('id', 'ASC', $order_id);
			$order = (!empty($list))?$list['orders'][0]:array();

			if(!empty($order)){
				/*Total cost*/
				$total_price = $order->price;

				#get link thank you
				$thankyou_page_id = (!empty($options['rop_thankyou_page_id']))?$options['rop_thankyou_page_id']:get_option('rop_thankyou_page_id');

				/*get options plugin*/
				$sandbox = (!empty($options['rop_paypal_testmode']))?'.sandbox':'';
				$username = (!empty($options['rop_paypal_api_username']))?$options['rop_paypal_api_username']:'';
				$password = (!empty($options['rop_paypal_api_password']))?$options['rop_paypal_api_password']:'';
				$signature = (!empty($options['rop_paypal_api_signature']))?$options['rop_paypal_api_signature']:'';

				$return_url = (!empty($thankyou_page_id))?esc_url( get_permalink($thankyou_page_id)):home_url();
				$cancel_url = (!empty($options['rop_paypal_cancel']))?esc_url( get_permalink($options['rop_paypal_cancel'])):home_url();

				$request_url = 'https://www'.$sandbox.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=';
				$api_url = 'https://api-3t'.$sandbox.'.paypal.com/nvp';

				$paypal = new ROP_Paypal_Class(); //Create an object

				/*Set Info*/
				$paypal->setUsername($username);
				$paypal->setPassword($password);
				$paypal->setApiSignature($signature);
				$paypal->setPayPalAPIUrl($api_url);

				$requestParams = array(
					'RETURNURL' => esc_url($return_url),//My URL
					'CANCELURL' => esc_url($cancel_url),//My URL
					'NOSHIPPING' => '1',//I do not want shipping
					'ALLOWNOTE' => '1',//I do not want to allow notes
					'MAXAMT' => '100',//Set max transaction amount
				);
				$orderParams = array(
					'PAYMENTREQUEST_0_CURRENCYCODE' => get_rop_currency(),
					'PAYMENTREQUEST_0_AMT' => $total_price,//Total cost of the transaction to the buyer
					'PAYMENTREQUEST_0_ITEMAMT' => $total_price,//Sum of cost of all items in this order
					'PAYMENTREQUEST_0_PAYMENTACTION' => "Sale",
					'PAYMENTREQUEST_0_INVNUM' => 'ROP-'.$order_id,//Order id
				);
				$item = array(
					'L_PAYMENTREQUEST_0_NAME0' => 'Items',
					'L_PAYMENTREQUEST_0_AMT0' => $total_price,
					'L_PAYMENTREQUEST_0_QTY0' => '1',
				);
				$response = $paypal->SetExpressCheckout($requestParams + $orderParams + $item);

				if (is_array($response) && ($response['ACK'] == "Success" || $response['ACK'] == "SuccessWithWarning")) { //Request successful
					//Now we have to redirect user to the PayPal
					$paypalurl = $request_url . urldecode($response['TOKEN']);
					return array(
						'result'   => 'success',
						'redirect' => $paypalurl
					);
				} else if (is_array($response) && ($response['ACK'] == "Failure" || $response['ACK'] == "FailureWithWarning")) {
					return array(
						'result'   => urldecode($response["L_LONGMESSAGE0"]),
						'redirect' => ''
					);
				}
			}else{
				return array(
					'result'   => esc_html('Empty order', ROP_NAME),
					'redirect' => ''
				);
			}
		}
	}
}
