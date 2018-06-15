<?php

if( ! defined( 'ABSPATH' ) ) exit;

/**
 * Get full list of currency codes.
 *
 * @return array
 */
if( !function_exists('get_rop_currencies') ) {

	function get_rop_currencies() {
		return array_unique(
			apply_filters( 'rop_currencies',
				array(
					'AED' => __( 'United Arab Emirates Dirham', ROP_NAME ),
					'ARS' => __( 'Argentine Peso', ROP_NAME ),
					'AUD' => __( 'Australian Dollars', ROP_NAME ),
					'BDT' => __( 'Bangladeshi Taka', ROP_NAME ),
					'BGN' => __( 'Bulgarian Lev', ROP_NAME ),
					'BRL' => __( 'Brazilian Real', ROP_NAME ),
					'CAD' => __( 'Canadian Dollars', ROP_NAME ),
					'CHF' => __( 'Swiss Franc', ROP_NAME ),
					'CLP' => __( 'Chilean Peso', ROP_NAME ),
					'CNY' => __( 'Chinese Yuan', ROP_NAME ),
					'COP' => __( 'Colombian Peso', ROP_NAME ),
					'CZK' => __( 'Czech Koruna', ROP_NAME ),
					'DKK' => __( 'Danish Krone', ROP_NAME ),
					'DOP' => __( 'Dominican Peso', ROP_NAME ),
					'EGP' => __( 'Egyptian Pound', ROP_NAME ),
					'EUR' => __( 'Euros', ROP_NAME ),
					'GBP' => __( 'Pounds Sterling', ROP_NAME ),
					'HKD' => __( 'Hong Kong Dollar', ROP_NAME ),
					'HRK' => __( 'Croatia kuna', ROP_NAME ),
					'HUF' => __( 'Hungarian Forint', ROP_NAME ),
					'IDR' => __( 'Indonesia Rupiah', ROP_NAME ),
					'ILS' => __( 'Israeli Shekel', ROP_NAME ),
					'INR' => __( 'Indian Rupee', ROP_NAME ),
					'ISK' => __( 'Icelandic krona', ROP_NAME ),
					'JPY' => __( 'Japanese Yen', ROP_NAME ),
					'KES' => __( 'Kenyan shilling', ROP_NAME ),
					'KRW' => __( 'South Korean Won', ROP_NAME ),
					'LAK' => __( 'Lao Kip', ROP_NAME ),
					'MXN' => __( 'Mexican Peso', ROP_NAME ),
					'MYR' => __( 'Malaysian Ringgits', ROP_NAME ),
					'NGN' => __( 'Nigerian Naira', ROP_NAME ),
					'NOK' => __( 'Norwegian Krone', ROP_NAME ),
					'NPR' => __( 'Nepali Rupee', ROP_NAME ),
					'NZD' => __( 'New Zealand Dollar', ROP_NAME ),
					'PHP' => __( 'Philippine Pesos', ROP_NAME ),
					'PKR' => __( 'Pakistani Rupee', ROP_NAME ),
					'PLN' => __( 'Polish Zloty', ROP_NAME ),
					'PYG' => __( 'Paraguayan Guaraní', ROP_NAME ),
					'RON' => __( 'Romanian Leu', ROP_NAME ),
					'RUB' => __( 'Russian Ruble', ROP_NAME ),
					'SAR' => __( 'Saudi Riyal', ROP_NAME ),
					'SEK' => __( 'Swedish Krona', ROP_NAME ),
					'SGD' => __( 'Singapore Dollar', ROP_NAME ),
					'THB' => __( 'Thai Baht', ROP_NAME ),
					'TRY' => __( 'Turkish Lira', ROP_NAME ),
					'TWD' => __( 'Taiwan New Dollars', ROP_NAME ),
					'UAH' => __( 'Ukrainian Hryvnia', ROP_NAME ),
					'USD' => __( 'US Dollars', ROP_NAME ),
					'VND' => __( 'Vietnamese Dong', ROP_NAME ),
					'ZAR' => __( 'South African rand', ROP_NAME ),
				)
			)
		);
	}
}
/**
 * Get Currency symbol.
 *
 * @param string $currency (default: '')
 * @return string
 */
if( !function_exists('get_rop_currency_symbol') ) {

	function get_rop_currency_symbol( $currency = '' ) {
		if ( ! $currency ) {
			$currency = get_rop_currency();
		}

		$symbols = apply_filters( 'rop_currency_symbols', array(
			'AED' => 'د.إ',
			'ARS' => '&#36;',
			'AUD' => '&#36;',
			'BDT' => '&#2547;&nbsp;',
			'BGN' => '&#1083;&#1074;.',
			'BRL' => '&#82;&#36;',
			'CAD' => '&#36;',
			'CHF' => '&#67;&#72;&#70;',
			'CLP' => '&#36;',
			'CNY' => '&yen;',
			'COP' => '&#36;',
			'CZK' => '&#75;&#269;',
			'DKK' => 'DKK',
			'DOP' => 'RD&#36;',
			'EGP' => 'EGP',
			'EUR' => '&euro;',
			'GBP' => '&pound;',
			'HKD' => '&#36;',
			'HRK' => 'Kn',
			'HUF' => '&#70;&#116;',
			'IDR' => 'Rp',
			'ILS' => '&#8362;',
			'INR' => '&#8377;',
			'ISK' => 'Kr.',
			'JPY' => '&yen;',
			'KES' => 'KSh',
			'KRW' => '&#8361;',
			'LAK' => '&#8365;',
			'MXN' => '&#36;',
			'MYR' => '&#82;&#77;',
			'NGN' => '&#8358;',
			'NOK' => '&#107;&#114;',
			'NPR' => '&#8360;',
			'NZD' => '&#36;',
			'PHP' => '&#8369;',
			'PKR' => '&#8360;',
			'PLN' => '&#122;&#322;',
			'PYG' => '&#8370;',
			'RMB' => '&yen;',
			'RON' => 'lei',
			'RUB' => '&#8381;',
			'SAR' => '&#x631;.&#x633;',
			'SEK' => '&#107;&#114;',
			'SGD' => '&#36;',
			'THB' => '&#3647;',
			'TRY' => '&#8378;',
			'TWD' => '&#78;&#84;&#36;',
			'UAH' => '&#8372;',
			'USD' => '&#36;',
			'VND' => '&#8363;',
			'ZAR' => '&#82;',
		) );

		$currency_symbol = isset( $symbols[ $currency ] ) ? $symbols[ $currency ] : '';

		return apply_filters( 'woocommerce_currency_symbol', $currency_symbol, $currency );
	}
}


/**
 * Get Base Currency Code.
 *
 * @return string
 */
if( !function_exists('get_rop_currency') ) {
	function get_rop_currency() {
		$rop_option = get_option('rop_option', array());
		$options = (!empty($rop_option))?(array)json_decode($rop_option):$rop_option;
		if(isset($options['rop_currency'])){
			return apply_filters( 'rop_currency', $options['rop_currency'] );
		}else{return apply_filters( 'rop_currency', 'USD' );}
	}
}
/**
 * Return the decimal separator for prices.
 * @since  2.3
 * @return string
 */
if( !function_exists('rop_get_price_decimal_separator') ) {
	function rop_get_price_decimal_separator() {
		$rop_option = get_option('rop_option', array());
		$options = (!empty($rop_option))?(array)json_decode($rop_option):$rop_option;
		$separator = (!empty($options))?stripslashes( $options['rop_price_decimal_sep'] ):'.';
		return $separator;
	}
}

/**
 * Return the thousand separator for prices.
 * @since  2.3
 * @return string
 */
if( !function_exists('rop_get_price_thousand_separator') ) {
	function rop_get_price_thousand_separator() {
		$rop_option = get_option('rop_option', array());
		$options = (!empty($rop_option))?(array)json_decode($rop_option):$rop_option;
		$separator = (!empty($options))?stripslashes( $options['rop_price_thousand_sep']):',';
		return $separator;
	}
}

/**
 * Return the number of decimals after the decimal point.
 * @since  2.3
 * @return int
 */
if( !function_exists('rop_get_price_decimals') ) {
	function rop_get_price_decimals() {
		$rop_option = get_option('rop_option', array());
		$options = (!empty($rop_option))?(array)json_decode($rop_option):$rop_option;
		return (!empty($options))?absint( $options['rop_price_num_decimals'] ):'2';
	}
}

/**
 * Get the price format depending on the currency position.
 *
 * @return string
 */
if( !function_exists('get_rop_price_format') ) {
	function get_rop_price_format() {
		$options = (array)json_decode(get_option('rop_option', array()));
		$currency_pos = $options['rop_currency_pos'];
		$format = '%1$s%2$s';

		switch ( $currency_pos ) {
			case 'left' :
				$format = '%1$s%2$s';
			break;
			case 'right' :
				$format = '%2$s%1$s';
			break;
			case 'left_space' :
				$format = '%1$s&nbsp;%2$s';
			break;
			case 'right_space' :
				$format = '%2$s&nbsp;%1$s';
			break;
		}

		return apply_filters( 'rop_price_format', $format, $currency_pos );
	}
}

/**
 * Trim trailing zeros off prices.
 *
 * @param mixed $price
 * @return string
 */
if( !function_exists('rop_trim_zeros') ) {
	function rop_trim_zeros( $price ) {
		return preg_replace( '/' . preg_quote( rop_get_price_decimal_separator(), '/' ) . '0++$/', '', $price );
	}
}

/**
 * Format the price with a currency symbol.
 *
 * @param float $price
 * @param array $args (default: array())
 * @return string
 */
 if( !function_exists('rop_price') ) {
	function rop_price( $price, $args = array() ) {
		extract( apply_filters( 'rop_price_args', wp_parse_args( $args, array(
			'ex_tax_label'       => false,
			'currency'           => '',
			'decimal_separator'  => rop_get_price_decimal_separator(),
			'thousand_separator' => rop_get_price_thousand_separator(),
			'decimals'           => rop_get_price_decimals(),
			'price_format'       => get_rop_price_format()
		) ) ) );
		$negative        = $price < 0;
		$price           = apply_filters( 'raw_rop_price', floatval( $negative ? $price * -1 : $price ) );
		$price           = apply_filters( 'formatted_rop_price', number_format( $price, $decimals, $decimal_separator, $thousand_separator ), $price, $decimals, $decimal_separator, $thousand_separator );

		if ( apply_filters( 'rop_price_trim_zeros', false ) && $decimals > 0 ) {
			$price = rop_trim_zeros( $price );
		}
        $price_symbol = '<span class="price-symbol">' . get_rop_currency_symbol( $currency ) . '</span>';
		$formatted_price = ( $negative ? '-' : '' ) . sprintf( $price_format, $price_symbol, $price );
		$return          = '<span class="ro-price">' . $formatted_price . '</span>';

		return apply_filters( 'rop_price', $return, $price, $args );
	}
}

/**
 * Format the price with a currency symbol.
 *
 * @param float $price
 * @param array $args (default: array())
 * @return string
 */
 if( !function_exists('rop_date') ) {
	function rop_date( $date ) {
		$options = (array)json_decode(get_option('rop_option', array()));
		$date_format = (isset($options['rop_date_format']))?$options['rop_date_format']:'d/m/Y';
		if(!empty($date) && $date != '0000-00-00 00:00:00'){
			$datetime = date($date_format, strtotime($date));
		}else {$datetime = '';}
		return $datetime;
	}
}
/*
**get setting plugin
*/
if( !function_exists('get_rop_option') ) {
	function get_rop_option ($setting_fields){
		$rop_option = get_option('rop_option', array());
		if(!empty($rop_option)){
			$settings = (array)json_decode($rop_option);
		}else{
			$settings = array();
			if(!empty($setting_fields)){
				foreach ($setting_fields as $key => $value) {
					$fields = $value['fields'];
					if( isset( $fields ) && count( $fields ) > 0 ) {
						foreach( $fields as $field ) {
							if(isset($field['value'])){
								$settings[$field['name']] = $field['value'];
							}
						}
					}
				}
			}
		}
		return $settings;
	}
}
/*
**get post meta
*/
if( !function_exists('rop_post_meta') ) {
	function rop_post_meta($post_id = null) {
		$post_id = empty($post_id) ? get_the_ID() : $post_id;
		$arr = array();
		$temp = get_post_meta($post_id);
		if (is_array($temp)) {
			foreach ($temp as $key => $value) {
				if (count($value) == 1) {
					$arr[$key] = $value[0];
				} else {
					$arr[$key] = $value;
				}
			}
		}
		return $arr;
	}
}

/*Send mail after payment*/
if( !function_exists('rop_send_mail') ) {
	function rop_send_mail($order_id){

		$db = new rop_db;

		$orders = $db->get_orders('id', 'ASC', $order_id);
		ob_start();
			include( rop_SHORTCODES . '/templates/ro_pricing_order_email.php' );
		$order_details = ob_get_clean();

		#get user current
		$user_info = wp_get_current_user()->data;
		$user_name = $user_info->display_name;

		/*replace string*/
		$array1 = array('{order}', '{name}');
		$array2 = array($order_details, $user_name);

		send_mail_admin($array1, $array2);
		send_mail_user($array1, $array2, $user_info->user_email);

	}
}
/*Send mail to admin*/
if( !function_exists('send_mail_admin') ) {
	function send_mail_admin($array1, $array2){

		$options = (array)json_decode(get_option('rop_option', array()));
		$to = wp_specialchars_decode($options['rop_mail_address'], ENT_QUOTES);
		$subject = str_replace('{today}', rop_date(date('Y-m-d H:i:s')), $options['rop_admin_subject']);
		$message = str_replace($array1, $array2, stripslashes($options['rop_admin_body']));

		$headers[]= "MIME-Version: 1.0\r\n";
		$headers[]= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		/*send the email using wp_mail()*/
		if( !wp_mail($to, $subject, $message, $headers) ) {
			return false;
		}
	}
}
/*Send mail to user*/
if( !function_exists('send_mail_user') ) {
	function send_mail_user($array1, $array2, $email){

		$options = (array)json_decode(get_option('rop_option', array()));
		$admin = wp_specialchars_decode($options['rop_mail_address'], ENT_QUOTES);
		$to = wp_specialchars_decode($email, ENT_QUOTES);
		$subject =  str_replace('{today}', rop_date(date('Y-m-d H:i:s')), $options['rop_user_subject']);
		$replyto = $options['rop_user_replyto'];
		$message = str_replace($array1, $array2, stripslashes($options['rop_user_body']));

		$headers[]= "MIME-Version: 1.0\r\n";
		$headers[]= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		if(!empty($replyto)){
			$headers[] = 'Reply-To: '.$replyto.' <'.$replyto.'>';
		}

		/*send the email using wp_mail()*/
		if( !wp_mail($to, $subject, $message, $headers) ) {
			return false;
		}
	}
}
