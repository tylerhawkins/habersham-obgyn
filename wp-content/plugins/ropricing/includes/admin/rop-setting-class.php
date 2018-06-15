<?php

if( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'ROP_settings' ) ) {
	class ROP_settings {

		function __construct() {

		}

		/**
		* fields_setup
		*/
		function fields_setup() {

			$currency_code_options = get_rop_currencies();

			foreach ( $currency_code_options as $code => $name ) {
				$currency_code_options[ $code ] = $name . ' (' . get_rop_currency_symbol( $code ) . ')';
			}

			$fields = array(
				array(
					'group_name' 	=> esc_html__( 'General', ROP_NAME ),
					'id'			=> 'rop_general',
					'fields'		=> array(
						array(
							'title'		=> esc_html__( 'Send Mail', ROP_NAME ),
							'name' 		=> 'rop_send_mail',
							'type' 		=> 'radio',
							'des'		=> '',
							'value'		=> '0',
							'options'	=> array(
								'1' => esc_html__( 'Yes', ROP_NAME ),
								'0' => esc_html__( 'No', ROP_NAME ),
							)
						),
						array(
							'title'    => __( 'Admin Email', ROP_NAME ),
							'des'     => '',
							'name'       => 'rop_mail_address',
							'type'     => 'text',
							'value'	   => '',
						),
						array(
							'title'    => __( 'Date Format', ROP_NAME ),
							'des'     => '',
							'name'       => 'rop_date_format',
							'type'     => 'text',
							'value'	   => 'j F, Y',
						),
					),
				),
				array(
					'group_name' 	=> esc_html__( 'Currency', ROP_NAME ),
					'id'			=> 'rop_currencies',
					'fields'		=> array(

						array(
							'title'    => __( 'Currency', ROP_NAME ),
							'des'     => __( 'This controls what currency prices are listed at in the catalog and which currency gateways will take payments in.', ROP_NAME ),
							'name'       => 'rop_currency',
							'css'      => 'min-width:350px;',
							'type'     => 'select',
							'class'    => 'wc-enhanced-select',
							'value'	   => 'USD',
							'options'  => $currency_code_options
						),

						array(
							'title'    => __( 'Currency Position', ROP_NAME ),
							'des'     => __( 'This controls the position of the currency symbol.', ROP_NAME ),
							'name'       => 'rop_currency_pos',
							'css'      => 'min-width:350px;',
							'class'    => 'wc-enhanced-select',
							'type'     => 'select',
							'value'	   => 'left',
							'options'  => array(
								'left'        => __( 'Left', ROP_NAME ) . ' (' . get_rop_currency_symbol() . '99.99)',
								'right'       => __( 'Right', ROP_NAME ) . ' (99.99' . get_rop_currency_symbol() . ')',
								'left_space'  => __( 'Left with space', ROP_NAME ) . ' (' . get_rop_currency_symbol() . ' 99.99)',
								'right_space' => __( 'Right with space', ROP_NAME ) . ' (99.99 ' . get_rop_currency_symbol() . ')'
							),
						),

						array(
							'title'    => __( 'Thousand Separator', ROP_NAME ),
							'des'     => __( 'This sets the thousand separator of displayed prices.', ROP_NAME ),
							'name'       => 'rop_price_thousand_sep',
							'css'      => 'width:50px;',
							'type'     => 'text',
							'value'	   => ',',
						),

						array(
							'title'    => __( 'Decimal Separator', ROP_NAME ),
							'des'     => __( 'This sets the decimal separator of displayed prices.', ROP_NAME ),
							'name'       => 'rop_price_decimal_sep',
							'css'      => 'width:50px;',
							'type'     => 'text',
							'value'	   => '.',
						),

						array(
							'title'    => __( 'Number of Decimals', ROP_NAME ),
							'des'     => __( 'This sets the number of decimal points shown in displayed prices.', ROP_NAME ),
							'name'       => 'rop_price_num_decimals',
							'css'      => 'width:50px;',
							'type'     => 'number',
							'value'	   => '2',
							'custom_attributes' => 'min="0" step="1"',
						),
					),
				),
				array(
					'group_name' 	=> esc_html__( 'Emails', ROP_NAME ),
					'id'			=> 'rop_mail',
					'fields'		=> array(
						array(
							'title'		=> esc_html__( 'To admin', ROP_NAME ),
							'name'		=> '',
							'type' 		=> 'label',
							'des'		=> '',
							'value'		=> '',
							),
						array(
							'title'		=> esc_html__( 'Subject', ROP_NAME ),
							'name' 		=> 'rop_admin_subject',
							'type' 		=> 'text',
							'value'		=> 'Pricing confirmed for {today}',
							),
						array(
							'title'		=> esc_html__( 'Body', ROP_NAME ),
							'name' 		=> 'rop_admin_body',
							'type' 		=> 'editor',
							'des'		=> 'Use tag: {order} to appear table order fields in content Email',
							'other'		=> '{order}',
							'default'	=> '',
							'value'		=> "<div style='margin-bottom: 10px;'>Dear admin,</div>
<div>Your customer has new order. Please find and check order information details below.</div>
<div>{order}</div>
<div>For order information above, please contact your customers once again to confirm and guide customers to pay in advance for this order. And let's careful prepare to serve customers better</div>
<div>Regards,</div>",
							),
						array(
							'title'		=> esc_html__( 'To user', ROP_NAME ),
							'name'		=> '',
							'type' 		=> 'label',
							'des'		=> '',
							'value'		=> '',
							),
						array(
							'title'		=> esc_html__( 'Subject', ROP_NAME ),
							'name' 		=> 'rop_user_subject',
							'type' 		=> 'text',
							'des'		=> '',
							'default'	=> '',
							'value'		=> 'Pricing confirmed for {today}',
							),
						array(
							'title'		=> esc_html__( 'ReplyTo', ROP_NAME ),
							'name' 		=> 'rop_user_replyto',
							'type' 		=> 'text',
							'des'		=> '',
							'value'		=> '',
							'default'	=> '',
							),
						array(
							'title'		=> esc_html__( 'Body', ROP_NAME ),
							'name' 		=> 'rop_user_body',
							'type' 		=> 'editor',
							'des'		=> 'Use tag: {order} to appear table order fields in content Email',
							'other'		=> '{order}',
							'default'	=> '',
							'value'		=> "<div style='margin-bottom: 10px;'>Dear {name},</div>
<div>Thank you for your order. Please check your order details below.</div>
<div>Should your plans change, please let us know. We look forward to serving you.</div>
<div><strong>Your order details: </strong></div>
<div>{order}</div>
<div style='margin-bottom: 10px;'>Thank you for choosing Ro Pricing. We've confirmed your order. Our employees will make calls to your phone number to confirm again.
For any enquiries please contact pricing@rotheme.com or call us on 02211 222 333</div>
<div>Regards,</div>",
							),
					),
				),
				array(
					'group_name' 	=> esc_html__( 'Payment', ROP_NAME ),
					'id'			=> 'rop_paypal',
					'fields'		=> array(
						array(
							'title'		=> esc_html__( 'Checkout Pages', ROP_NAME ),
							'name'		=> '',
							'type' 		=> 'label',
							'des'		=> '',
							'value'		=> '',
						),
						array(
							'title'   	=> esc_html__( 'Checkout Page', ROP_NAME ),
							'name'		=> 'rop_checkout_page_id',
							'type'     	=> 'single_select_page',
							'des'     	=> '',
							'value'  	=> __( get_option('rop_checkout_page_id') ),
							'class'    	=> '',
							'default'    => '',
							'css'      	=> 'min-width:300px;',
						),
						array(
							'title'   	=> esc_html__( 'Thank you Page', ROP_NAME ),
							'name'		=> 'rop_thankyou_page_id',
							'type'     	=> 'single_select_page',
							'des'     	=> '',
							'value'  	=> __( get_option('rop_thankyou_page_id') ),
							'default'    => '',
							'class'    	=> '',
							'css'      	=> 'min-width:300px;',
						),
						array(
							'title'		=> esc_html__( 'Cancel Page', ROP_NAME ),
							'name' 		=> 'rop_paypal_cancel',
							'type' 		=> 'single_select_page',
							'des'     	=> '',
							'default'    => '',
							'value'  	=> __( get_option('page_on_front') ),
							'class'    	=> '',
							'css'      	=> 'min-width:300px;',
							),
						array(
							'title'		=> esc_html__( 'Paypal', ROP_NAME ),
							'name'		=> '',
							'type' 		=> 'label',
							'des'		=> '',
							'value'		=> '',
						),
						array(
							'title'		=> esc_html__( 'Enable/Disable', ROP_NAME ),
							'name' 		=> 'rop_enable_paypal',
							'label' 	=> esc_html__( 'Enable Payment standard', ROP_NAME ),
							'type' 		=> 'checkbox',
							'des'		=> '',
							'value'		=> '',
						),
						array(
							'title'		=> esc_html__( 'Name', ROP_NAME ),
							'name' 		=> 'rop_paypal_name',
							'type' 		=> 'text',
							'des'		=> '',
							'value'		=> '',
							'default'	=> '',
							'css'      	=> 'width:25em;',
							),
						array(
							'title'		=> esc_html__( 'Email', ROP_NAME ),
							'name' 		=> 'rop_paypal_email',
							'type' 		=> 'text',
							'des'		=> '',
							'value'		=> '',
							'default'	=> '',
							'css'     	=> 'width:25em;',
							),
						array(
							'title'		=> esc_html__( 'PayPal Sandbox', ROP_NAME ),
							'name' 		=> 'rop_paypal_testmode',
							'label' 	=> esc_html__( 'Enable PayPal sandbox', ROP_NAME ),
							'type' 		=> 'checkbox',
							'des'		=> wp_kses( __('PayPal sandbox can be used to test payments. Sign up for a developer account <a href="https://developer.paypal.com/">here</a>.',ROP_NAME), array( 'a' => array( 'href' => array('https://developer.paypal.com/') ) ) ),
							'value'		=> '',
						),
						array(
							'title'		=> esc_html__( 'API Credentials', ROP_NAME ),
							'name' 		=> '',
							'type' 		=> 'label',
							'des'		=> wp_kses( __('Enter your PayPal API credentials to process refunds via PayPal. Learn how to access your PayPal API Credentials <a href="https://developer.paypal.com/webapps/developer/docs/classic/api/apiCredentials/#creating-classic-api-credentials">here</a>.',ROP_NAME), array( 'a' => array( 'href' => array('https://developer.paypal.com/webapps/developer/docs/classic/api/apiCredentials/#creating-classic-api-credentials') ) ) ),
							),
						array(
							'title'		=> esc_html__( 'API Username', ROP_NAME ),
							'name' 		=> 'rop_paypal_api_username',
							'type' 		=> 'text',
							'des'		=> '',
							'value'		=> '',
							'default'	=> '',
							'css'     	=> 'width:25em;',
						),
						array(
							'title'		=> esc_html__( 'API Password', ROP_NAME ),
							'name' 		=> 'rop_paypal_api_password',
							'type' 		=> 'text',
							'des'		=> '',
							'value'		=> '',
							'default'	=> '',
							'css'     	=> 'width:25em;',
						),
						array(
							'title'		=> esc_html__( 'API Signature', ROP_NAME ),
							'name' 		=> 'rop_paypal_api_signature',
							'type' 		=> 'text',
							'des'		=> '',
							'value'		=> '',
							'default'	=> '',
							'css'     	=> 'width:25em;',
						),
					),
				),
			);

			return apply_filters( 'setting_fields_setup', $fields );
		}
	}
}
?>
