<?php
define( 'ROP_ADMIN_VIEW_DIR', ROP_ADMIN . '/views' );
define( 'ROP_INCLUDES_ADMIN', ROP_DIR . '/includes/admin' );

if( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'ROP_admin' ) ) {

	class ROP_admin {

		function __construct() {

			$this->init();
			$this->hook_init();
		}

		function includes() {
			/* rop-setting-class.php */
			require_once( ROP_INCLUDES_ADMIN . '/rop-setting-class.php' );
		}

		function init() {
			$this->includes();

			/* class setup */
			$this->ROP_settings = new ROP_settings();
		}

		/**
		* hook_init
		*/
		function hook_init() {

			/* Order Ro Pricing  */
			add_action( 'admin_menu', array( &$this, 'admin_menu_setup' ) );
			/* load_wp_media_files */
			add_action( 'admin_enqueue_scripts', array( &$this, 'load_wp_media_files' ) );

		}

		/**
		* Load media files needed for Uploader
		*/
		function load_wp_media_files() {
		  	wp_enqueue_media();
		}

		/**
		* load_script
		*/
		function load_script() {
		}

		/**
		* admin_menu_setup
		*/
		function admin_menu_setup() {

			/* load list order pricing */
			$this->load_list_order();
			/* load setting */
			$this->load_setting_menu();
			/* load setting default */
			$this->rop_setting_default();
		}

		/**
		* load_list_order
		*/
		function load_list_order() {
			$page_title 	= esc_html__( 'Ro Pricing Order', ROP_NAME );
			$menu_title 	= esc_html__( 'Ro Pricing Order', ROP_NAME );
			$capability 	= __( 'manage_options' );
			$menu_slug 		= __( 'rop-orders' );
			$function 		= array( &$this, 'rop_list_pricing' );
			$icon_url 		= __( 'dashicons-clipboard' );
			$position 		= 26;

			add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
		}

		/**
		* restaurant_place_menu
		*/
		function rop_list_pricing() {

			/* list page */
			$db = new ROP_db;
			$list = $db->get_orders();

			$this->load_script();
			ob_start();
			include( ROP_ADMIN_VIEW_DIR . '/rop_list_pricing.php' );
			$content = ob_get_clean();

			echo $content;
		}

		/**
		* load_setting_menu_pages
		*/
		function load_setting_menu() {
			$parent_slug	= __( 'rop-orders' );
			$page_title		= esc_html__( 'Settings', ROP_NAME );
			$menu_title		= esc_html__( 'Settings', ROP_NAME );
			$capability		= __( 'manage_options' );
			$menu_slug		= __( 'rop-setting' );
			$function		= array( &$this, 'rop_setting' );

			add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
		}

		function rop_setting() {
			$this->load_script();
			$rop_option = get_option('rop_option', array());
			$options = (!empty($rop_option))?(array)json_decode($rop_option):$rop_option;

			if( !empty($_POST) && isset($options) && !empty($options) ) {
				update_option('rop_option', json_encode((array)$_POST));
			}

			$data = (!empty($rop_option))?(array)json_decode($rop_option):$rop_option;
			$setting_fields = $this->ROP_settings->fields_setup();

			ob_start();
			include( ROP_ADMIN_VIEW_DIR . '/rop-setting-page.php' );
			$content = ob_get_clean();

			echo $content;
		}

		/**
		* setting default
		*/
		function rop_setting_default(){
			$rop_option = get_option('rop_option', array());
			$options = (!empty($rop_option))?(array)json_decode($rop_option):$rop_option;
			$setting_fields = $this->ROP_settings->fields_setup();
			/*get options default*/
			if(empty($options)){
				$arrays = get_rop_option($setting_fields);
				add_option('rop_option', json_encode($arrays));
			}
			return true;
		}

	}
}
?>
