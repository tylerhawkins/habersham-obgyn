<?php
/*
Plugin Name: Ro Pricing Order
Plugin URI: http://rotheme.com
Description: Ro Pricing Order plugin wordpress.
Version: 1.0.0
Author: Rotheme
Author URI: http://rotheme.com
License: GPLv2 or later
Text Domain: rop
*/

define( 'ROP_NAME', 'rop' );
define( 'ROP_DIR', plugin_dir_path( __FILE__ ) );
define( 'ROP_URI', plugin_dir_url( __FILE__ ) );

define( 'ROP_ADMIN', ROP_DIR . 'admin' );
define( 'ROP_SHORTCODES', ROP_DIR . 'shortcodes' );
define( 'ROP_INCLUDES', ROP_DIR . 'includes' );
define( 'ROP_HELPER', ROP_INCLUDES . '/helper' );

define( 'ROP_ASSETS', ROP_URI . 'assets' );
define( 'ROP_IMG', ROP_ASSETS . '/images' );
define( 'ROP_CSS', ROP_ASSETS . '/css' );
define( 'ROP_JS', ROP_ASSETS . '/js' );

class ROP_main {

	function __construct() {

		$this->init();
		$this->init_hook();
	}

	/**
	* includes
	*/
	function includes() {
		/* admin class */
		require_once( ROP_ADMIN . '/rop-admin-class.php' );
		/* helper html */
		require_once( ROP_HELPER . '/ro-html-class.php' );
		/* create list page */
		require_once( ROP_HELPER . '/rop-create-list-page-class.php' );
		/* rop helper */
		require_once( ROP_HELPER . '/rop-helper.php' );
		/* db class */
		require_once( ROP_INCLUDES . '/rop-db-class.php' );
		/* table class */
		require_once( ROP_INCLUDES . '/rop-table-class.php' );
		/* ajax class */
		require_once( ROP_INCLUDES . '/rop-ajax-class.php' );
		/* shortcode */
		require_once( ROP_SHORTCODES . '/rop-shortcodes.php' );
	}

	/**
	* init
	*/
	function init() {
		$this->includes();

		/* setup Class */
		$this->ROP_admin = new ROP_admin();
		$this->ROP_table = new ROP_table();
		$this->ROP_ajax = new ROP_ajax();
		$this->ROP_Shortcodes = new ROP_Shortcodes();
	}

	/**
	* init_hook
	*/
	function init_hook() {
		/* plugin active hook */
		register_activation_hook( __FILE__, array( &$this, 'active' ) );

		/* plugin deactive hook */
		register_deactivation_hook( __FILE__, array( 'ROP_main', 'deactive' ) );

		/* plugin unistall hook */
		register_uninstall_hook( __FILE__, array( 'ROP_main', 'unistall' ) );

		/* init hook */
		add_action( 'admin_init', array( &$this, 'admin_init_hook' ) );

	}


	/**
	* register_script
	*/
	function register_script() {
		/* datetime picker */
		wp_enqueue_style( 'datetime-picker', ROP_CSS . '/jquery.datetimepicker.css' );
		wp_enqueue_script( 'datetime-picker', ROP_JS . '/jquery.datetimepicker.js', array( 'jquery' ) );
		/* ro script */
		wp_enqueue_style( 'ro-script', ROP_CSS . '/ro-style.css' );
		wp_enqueue_script( 'ro-script', ROP_JS . '/ro-script.js', array( 'jquery' ) );
		wp_enqueue_script('ro-jquery-shuffle', ROP_JS. 'jquery.shuffle.ro.js', array('jquery-shuffle'));
		wp_enqueue_script('jquery-shuffle', ROP_JS . 'jquery.shuffle.js', array('jquery','modernizr','imagesloaded'));
		wp_enqueue_script( 'rop-admin-script', ROP_JS . '/rop-admin-script.js', array( 'jquery' ) );

		/*format datetime*/
		$options = (array)json_decode(get_option('rop_option', array()));
		$date_format = (isset($options['rop_date_format']))?$options['rop_date_format']:'d/m/Y';
		wp_localize_script( 'rop-admin-script', 'rop_admin_object', array(
				'formatdate' => $date_format,
				) );
		/* fontawesome */
		wp_enqueue_style('fontawesome', ROP_CSS . '/font-awesome.min.css', array(), '4.5.0');
	}

	/**
	* admin_init_hook
	*/
	function admin_init_hook() {

		$this->register_script();
	}

	/**
	* active
	*/
	function active() {

		$this->ROP_table->table_create();

		/* auto create page */
		$this->rop_create_checkout_page();
		$this->rop_create_thankyou_page();
	}

	/**
	* deactive
	*/
	public static function deactive() {

		$ROP_table = new ROP_table();
		$ROP_table->table_drop();
		self::delete_pages();
		#remove option
		delete_option('rop_option');
	}

	/**
	* unistall
	*/
	function unistall() {

		$ROP_table = new ROP_table();
		$ROP_table->table_drop();
		self::delete_pages();
		#remove option
		delete_option('rop_option');
	}

	/**
	** Create pages checkout and thank you
	**/
	function create_page($post, $page_id){
		$rop_page_id = get_option($page_id);
		if (!$rop_page_id) {
			//create a new page and automatically assign the page template
			$postID = wp_insert_post($post, false);
			update_option($page_id, $postID);
		}
	}
	function rop_create_checkout_page() {
		$page_id = "rop_checkout_page_id";
		$post = array(
			'post_title' => "ROP Checkout",
			'post_content' => "[ro_pricing_checkout]",
			'post_status' => "publish",
			'post_type' => 'page',
		);
		$this->create_page($post, $page_id);
	}
	function rop_create_thankyou_page() {
		$page_id = "rop_thankyou_page_id";
		$post = array(
			'post_title' => "ROP Thank you",
			'post_content' => "[ro_pricing_thankyou]",
			'post_status' => "publish",
			'post_type' => 'page',
		);
		$this->create_page($post, $page_id);
	}

	/**
	** Delete pages checkout and thank you
	**/
	public static function delete_pages(){
		$checkout_page_id = get_option("rop_checkout_page_id");
		$thankyou_page_id = get_option("rop_thankyou_page_id");
		if (isset($checkout_page_id)) {
			$checkout_page = get_post($checkout_page_id);
			if(!empty($checkout_page)){
				wp_delete_post($checkout_page_id);
			}
			delete_option("rop_checkout_page_id");
		}
		if (isset($thankyou_page_id)) {
			$thankyou_page = get_post($thankyou_page_id);
			if(!empty($thankyou_page)){
				wp_delete_post($thankyou_page_id);
			}
			delete_option("rop_thankyou_page_id");
		}
	}
}

$ro_pricing = new ROP_main();
