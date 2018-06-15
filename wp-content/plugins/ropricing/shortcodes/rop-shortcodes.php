<?php

class ROP_Shortcodes {

	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( &$this, 'register_script_shortcode' ) );

		/*Add shortcodes*/
		$shortcodes = array(
			'ro_pricing'                    => __CLASS__ . '::ro_pricing',
			'ro_pricing_checkout'           => __CLASS__ . '::ro_pricing_checkout',
			'ro_pricing_thankyou'           => __CLASS__ . '::ro_pricing_thankyou',
			'ro_pricing_dashboard'           => __CLASS__ . '::ro_pricing_dashboard',
		);

		foreach ( $shortcodes as $shortcode => $function ) {
			add_shortcode( apply_filters( "{$shortcode}_shortcode_tag", $shortcode ), $function );
		}
	}
	/**
	* register_script_shortcode
	*/
	function register_script_shortcode(){
		# css
		wp_enqueue_style( 'rop-style', ROP_CSS . '/rop-style.css', false );
		wp_enqueue_style( 'ro-script', ROP_CSS . '/ro-style.css' );

		# ro script
		wp_enqueue_script( 'ro-script', ROP_JS . '/ro-script.js', array( 'jquery' ) );

		# rop js
		wp_enqueue_script( 'rop-script', ROP_JS . '/rop-script.js', array( 'jquery' ) , '');
		wp_localize_script( 'rop-script', 'rop_object', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'image_default' => ROP_IMG . '/no_image.gif',
				) );
	}

	/**
	 * Display a rop_pricing.
	 *
	 * @param array $atts
	 * @return string
	 */

	public static function ro_pricing($atts){
		$db = new ROP_db();
		$class = 'data-post-pricing="'.$atts['post_id'].'"';
		$user_id = get_current_user_id();

		#expiration
		if(!empty($user_id)){
			$order = $db->check_expiration($user_id,$atts['post_id']);
			if(!empty($order)){
				$class = '';
			}
		}

		ob_start();
		include( ROP_SHORTCODES . '/templates/rop_pricing.php' );
		$html = ob_get_clean();
		return $html;
	}

	/**
	 * Display a ro_pricing_checkout.
	 *
	 * @param array $atts
	 * @return string
	 */

	public static function ro_pricing_checkout($atts, $content = null){
		# Get COOKIE
		$data = (isset($_COOKIE['post_id']))?unserialize(base64_decode($_COOKIE['post_id'])):0;
		#get post
		$post = get_post( $data );
		#get post meta
		$post_meta = rop_post_meta( $data );
		extract($post_meta);
        if(isset($options)){
            $options = unserialize($options);
        }
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

		#expiration
		$db = new ROP_db();
		$user_id = get_current_user_id();
		$class = 'data-rop-checkout="1"';
		if(!empty($user_id)){
			$order = $db->check_expiration($user_id,$data);
			if(!empty($order)){
				$class = '';
			}
		}

		ob_start();
		include( ROP_SHORTCODES . '/templates/ro_pricing_checkout.php' );
		$html = ob_get_clean();
		return $html;
	}

	/**
	 * Display a ro_pricing_thankyou.
	 *
	 * @param array $atts
	 * @return string
	 */

	public static function ro_pricing_thankyou($atts, $content = null){
		require_once (ROP_INCLUDES . '/rop-paypal-class.php');
		$order_id = 0;
		$html = '';
		$db = new ROP_db();
		$paypal = new ROP_Paypal_Class();
		$options = (array)json_decode(get_option('rop_option', array()));
		$return_url = (isset($options['rop_paypal_return']))?$options['rop_paypal_return']:home_url();

		# get options plugin
		$sandbox = (isset($options['rop_paypal_testmode']))?'.sandbox':'';
		$username = (isset($options['rop_paypal_api_username']))?$options['rop_paypal_api_username']:'';
		$password = (isset($options['rop_paypal_api_password']))?$options['rop_paypal_api_password']:'';
		$signature = (isset($options['rop_paypal_api_signature']))?$options['rop_paypal_api_signature']:'';
		$api_url = 'https://api-3t'.$sandbox.'.paypal.com/nvp';

		# Set Info
		$paypal->setUsername($username);
		$paypal->setPassword($password);
		$paypal->setApiSignature($signature);
		$paypal->setPayPalAPIUrl($api_url);

		if(isset($_GET['token'])){
			$checkoutDetails = $paypal->GetExpressCheckoutDetails(array('TOKEN' => $_GET['token']));

			if (is_array($checkoutDetails) && ($checkoutDetails['ACK'] == "Success" || $checkoutDetails['ACK'] == "SuccessWithWarning")) {

				# Complete the checkout transaction
				$requestParams = array(
					'TOKEN' => urldecode($_GET['token']),
					'PAYMENTACTION' => 'Sale',
					'PAYERID' => urldecode($_GET['PayerID']),
					'PAYMENTREQUEST_0_AMT' => urldecode($checkoutDetails['AMT']), // Same amount as in the original request
					'PAYMENTREQUEST_0_CURRENCYCODE' => get_rop_currency() // Same currency as the original request
				);
				$response = $paypal->DoExpressCheckoutPayment($requestParams);

				# update status payment
				if(isset($checkoutDetails['INVNUM'])){
					$order_id = str_replace('ROP-','',urldecode($checkoutDetails['INVNUM']));
					$data = array(
						'id'			=> (int)$order_id,
						'date' 			=> (isset($checkoutDetails['TIMESTAMP']))?date('Y-m-d H:i:s',strtotime(urldecode($checkoutDetails['TIMESTAMP']))):'',
						'trans_id' 		=> (isset($response['PAYMENTINFO_0_TRANSACTIONID']))?urldecode($response['PAYMENTINFO_0_TRANSACTIONID']):'',
						'token' 		=> (isset($checkoutDetails['TOKEN']))?urldecode($checkoutDetails['TOKEN']):''
					);
					if(isset($response['PAYMENTINFO_0_PAYMENTSTATUS'])) {
						$data['status'] = urldecode($response['PAYMENTINFO_0_PAYMENTSTATUS']);
					}
					$db->save( 'rop_pricing_orders', $data );
					# send mail
					if(!empty($options['rop_send_mail']) && !empty($options['rop_user_subject']) && !empty($options['rop_user_body']) && !empty($options['rop_mail_address']) && !empty($options['rop_admin_body']) && !empty($options['rop_admin_subject'])){
						rop_send_mail($order_id);
					}
				}
			}

			$orders = $db->get_orders( 'id', 'DESC', $order_id );
			ob_start();
			include( ROP_SHORTCODES . '/templates/ro_pricing_thankyou.php' );
			$html = ob_get_clean();
		}
		return $html;
	}

	/**
	 * Display a ro_pricing_dashboard.
	 *
	 * @param array $atts
	 * @return string
	 */

	public static function ro_pricing_dashboard($atts, $content = null){
		$db = new ROP_db();
		$options = (array)json_decode(get_option('rop_option', array()));
		# get user
		$user_id = get_current_user_id();
		if (!empty($user_id)):
			$orders = $db->get_orders( 'id', 'DESC', '', $user_id );
			/*create link*/
			$query_arg['orderby'] = 'end_date';
			$order = (isset($_GET['order'])&&($_GET['order']=='asc')) ?'desc':'asc';
			$query_arg['order'] = $order;
			(!empty($date)) ? $query_arg['date'] = $date : '';
			isset( $_GET['paged'] ) ? $query_arg['paged'] = $_GET['paged'] : '';
			$icon = (isset($_GET['order'])&&($_GET['order']=='asc')) ?'<i class="fa fa-caret-up"></i>':'<i class="fa fa-caret-down"></i>';

		endif;

		ob_start();
		include( ROP_SHORTCODES . '/templates/ro_pricing_dashboard.php' );
		$html = ob_get_clean();

		return $html;
	}
}
