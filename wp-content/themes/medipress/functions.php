<?php
/* Define THEME */
if (!defined('URI_PATH')) define('URI_PATH', get_template_directory_uri());
if (!defined('ABS_PATH')) define('ABS_PATH', get_template_directory());
if (!defined('URI_PATH_FR')) define('URI_PATH_FR', URI_PATH.'/framework');
if (!defined('ABS_PATH_FR')) define('ABS_PATH_FR', ABS_PATH.'/framework');
if (!defined('URI_PATH_ADMIN')) define('URI_PATH_ADMIN', URI_PATH_FR.'/admin');
if (!defined('ABS_PATH_ADMIN')) define('ABS_PATH_ADMIN', ABS_PATH_FR.'/admin');
/* Theme Options */
if ( !class_exists( 'ReduxFramework' ) ) {
require_once( ABS_PATH . '/redux-framework/ReduxCore/framework.php' );
}
require_once (ABS_PATH_ADMIN.'/theme-options.php');
require_once (ABS_PATH_ADMIN.'/index.php');
global $tb_options;
global $tb_get_id;
/* Template Functions */
require_once ABS_PATH_FR . '/template-functions.php';
/* Template Functions */
require_once ABS_PATH_FR . '/templates/post-functions.php';
/* Post Type */
require_once ABS_PATH_FR.'/post-type/doctor.php';
require_once ABS_PATH_FR.'/post-type/testimonial.php';
require_once ABS_PATH_FR.'/post-type/pricing.php';
/* Lib resize images */
require_once ABS_PATH_FR.'/includes/resize.php';
/* Function for Framework */
require_once ABS_PATH_FR . '/includes.php';
function _medipress_filter_fw_ext_backups_demos($demos)
	{
		$demos_array = array(
			'medipress' => array(
				'title' => esc_html__('mediPress Demo', 'medipress'),
				'screenshot' => 'http://gavencreative.com/import_demo/medipress/screenshot.jpg',
				'preview_link' => 'http://medipress.jwsuperthemes.com',
			),
		);
        $download_url = 'http://gavencreative.com/import_demo/medipress/download-script/';
		foreach ($demos_array as $id => $data) {
			$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
				'url' => $download_url,
				'file_id' => $id,
			));
			$demo->set_title($data['title']);
			$demo->set_screenshot($data['screenshot']);
			$demo->set_preview_link($data['preview_link']);

			$demos[$demo->get_id()] = $demo;

			unset($demo);
		}

		return $demos;
	}
	add_filter('fw:ext:backups-demo:demos', '_medipress_filter_fw_ext_backups_demos');
/* Register Sidebar */
if (!function_exists('ro_RegisterSidebar')) {
	function ro_RegisterSidebar(){
		register_sidebar(array(
			'name' => __('Main Sidebar', 'medipress'),
			'id' => 'tbtheme-main-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Blog Left Sidebar', 'medipress'),
			'id' => 'tbtheme-left-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Blog Right Sidebar', 'medipress'),
			'id' => 'tbtheme-right-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebars(4, array(
			'name' => __('Custom Sidebar %d', 'medipress'),
			'id' => 'tbtheme-custom-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '<div style="clear:both;"></div></div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Header Top Sidebar', 'medipress'),
			'id' => 'tbtheme-header-top-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Header 1 Sidebar Navigation', 'medipress'),
			'id' => 'tbtheme-header-1-sidebar-navigation',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Header 2 Sidebar', 'medipress'),
			'id' => 'tbtheme-header-2-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Header 2 Sidebar Navigation', 'medipress'),
			'id' => 'tbtheme-header-2-sidebar-navigation',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Header 3 Sidebar Navigation', 'medipress'),
			'id' => 'tbtheme-header-3-sidebar-navigation',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Search On Menu Sidebar', 'medipress'),
			'id' => 'tbtheme-search-on-menu-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Menu Canvas Sidebar', 'medipress'),
			'id' => 'tbtheme-menu-canvas-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="wg-title">',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => __('Footer Top 1', 'medipress'),
			'id' => 'tbtheme-footer-top-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="wg-title">',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => __('Footer Top 2', 'medipress'),
			'id' => 'tbtheme-footer-top-2',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="wg-title">',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => __('Footer Top 3', 'medipress'),
			'id' => 'tbtheme-footer-top-3',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="wg-title">',
			'after_title' => '</h3>',
		));
		register_sidebars(4, array(
			'name' => __('Footer Top 1 Widget %d', 'medipress'),
			'id' => 'tbtheme-footer-top-1-widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '<div style="clear:both;"></div></div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
		register_sidebars(4, array(
			'name' => __('Footer Top 2 Widget %d', 'medipress'),
			'id' => 'tbtheme-footer-top-2-widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '<div style="clear:both;"></div></div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
		register_sidebars(4, array(
			'name' => __('Footer Top 3 Widget %d', 'medipress'),
			'id' => 'tbtheme-footer-top-3-widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '<div style="clear:both;"></div></div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
		register_sidebars(2, array(
			'name' => __('Footer Bottom Widget %d', 'medipress'),
			'id' => 'tbtheme-footer-bottom-widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '<div style="clear:both;"></div></div>',
			'before_title' => '<h5 class="wg-title">',
			'after_title' => '</h5>',
		));
	}
}
add_action( 'init', 'ro_RegisterSidebar' );
/* Add Stylesheet And Script */
function ro_theme_enqueue_style() {
	global $tb_options;
	wp_enqueue_style( 'bootstrap.min', URI_PATH.'/assets/css/bootstrap.min.css', false );
	wp_enqueue_style('flexslider.css', URI_PATH . "/assets/css/flexslider.css",array(),"");
	wp_enqueue_style('slick.css', URI_PATH . "/assets/css/slick.css",array(),"");
	wp_enqueue_style('font-awesome', URI_PATH.'/assets/css/font-awesome.min.css', array(), '4.1.0');
	wp_enqueue_style('font-ionicons', URI_PATH.'/assets/css/ionicons.min.css', array(), '1.5.2');
	wp_enqueue_style('medipress_icon', URI_PATH.'/assets/css/medipress_icon.css', array(), '1.0.0');
	wp_enqueue_style( 'tb.core.min', URI_PATH.'/assets/css/tb.core.min.css', false );
	wp_enqueue_style( 'style', URI_PATH.'/style.css', false );	
	wp_enqueue_style( 'pretty', URI_PATH.'/assets/css/prettyPhoto.css', false );	
}
add_action( 'wp_enqueue_scripts', 'ro_theme_enqueue_style' );

function ro_theme_enqueue_script() {
	global $tb_options;
	$tb_smoothscroll =& $tb_options['tb_smoothscroll'];
	wp_enqueue_script( 'bootstrap.min', URI_PATH.'/assets/js/bootstrap.min.js', array('jquery'), '', true  );
	wp_enqueue_script( 'datepicker.min', URI_PATH.'/assets/js/datepicker.min.js', array('jquery'), '', true  );
	wp_enqueue_script( 'menu', URI_PATH.'/assets/js/menu.js', array('jquery'), '', true  );
	wp_enqueue_script( 'jquery.flexslider-min', URI_PATH.'/assets/js/jquery.flexslider-min.js', array('jquery'), '', true  );
	wp_enqueue_script( 'parallax', URI_PATH.'/assets/js/parallax.js', array('jquery'), '', true  );
	if($tb_smoothscroll){
		wp_enqueue_script( 'SmoothScroll', URI_PATH.'/assets/js/SmoothScroll.js', array('jquery'), '', true );
	}
	wp_enqueue_script( 'main', URI_PATH.'/assets/js/main.js', array('jquery'), '', true  );
	wp_enqueue_script( 'pretty', URI_PATH.'/assets/js/jquery.prettyPhoto.js', array('jquery'), '3.1.6', true  );
	wp_enqueue_script( 'slick', URI_PATH.'/assets/js/slick.min.js', array('jquery'), '', true  );
}
add_action( 'wp_enqueue_scripts', 'ro_theme_enqueue_script' );

function ro_theme_filtercontent($variable){
	return $variable;
}


function tb_Header() {
    global $tb_options,$post, $tb_get_id;
	$tb_get_id = $post->ID;
    $header_layout = $tb_options["tb_header_layout"];
    if($post){
        $tb_header = get_post_meta($post->ID, 'tb_header', true)?get_post_meta($post->ID, 'tb_header', true):'global';
        $header_layout = $tb_header=='global'?$header_layout:$tb_header;
    }
    switch ($header_layout) {
        case 'header-v1':
            get_template_part('framework/headers/header', 'v1');
            break;
		case 'header-v2':
            get_template_part('framework/headers/header', 'v2');
            break;
		default :
			get_template_part('framework/headers/header', 'v3');
			break;
    }
}

function tb_Footer() {
    global $tb_options, $tb_get_id;
    $footer_layout = $tb_options["tb_footer_layout"];
    if($tb_get_id){
        $tb_footer = get_post_meta($tb_get_id, 'tb_footer', true)?get_post_meta($tb_get_id, 'tb_footer', true):'global';
        $footer_layout = $tb_footer=='global'?$footer_layout:$tb_footer;
    }
    switch ($footer_layout) {
        case 'footer-v1':
            get_template_part('framework/footers/footer', 'v1');
            break;
		case 'footer-v2':
            get_template_part('framework/footers/footer', 'v2');
            break;
		case 'footer-v3':
            get_template_part('framework/footers/footer', 'v3');
            break;
		default :
			get_template_part('framework/footers/footer', 'v1');
			break;
    }
}
function tb_layout($post_id){
	global $tb_options, $custom_css;
	$custom_style = null;
	$tb_post_layout = get_post_meta($post_id, 'tb_layout', true);
	$tb_boxed_layout =& $tb_options['tb_boxed'];
	$tb_boxed_background_color =& $tb_options['tb_background_boxed']['background-color'];
	$tb_boxed_background_image =& $tb_options['tb_background_boxed']['background-image'];
    $tb_boxed_background_repeat =& $tb_options['tb_background_boxed']['background-repeat'];
    $tb_boxed_background_position =& $tb_options['tb_background_boxed']['background-position'];
    $tb_boxed_background_size =& $tb_options['tb_background_boxed']['background-size'];
    $tb_boxed_background_attachment =& $tb_options['tb_background_boxed']['background-attachment'];
	$tb_body_width = $tb_options['tb_body_width'].'px';
	if($tb_boxed_layout == 1){
		$custom_style .= "body{ background-color: $tb_boxed_background_color;}";
		if($tb_boxed_background_image){
			$custom_style .= "body{ background: url('$tb_boxed_background_image') $tb_boxed_background_repeat $tb_boxed_background_attachment $tb_boxed_background_position;background-size: $tb_boxed_background_size;}";
		}
		$custom_style .= "body #ro-main { width: $tb_body_width; margin: auto; background-color: #ffffff;}";
		$custom_style .= ".ro-stick-active .ro-header-stick { max-width: $tb_body_width;}";
		$custom_style .= ".ro-header-stick { max-width: $tb_body_width;}";
	}
	elseif($tb_post_layout == 'yes'){
		$custom_style .= "body { background-color: $tb_boxed_background_color;}";
		if($tb_boxed_background_image){
			$custom_style .= "body{ background: url('$tb_boxed_background_image') $tb_boxed_background_repeat $tb_boxed_background_attachment $tb_boxed_background_position;background-size: $tb_boxed_background_size;}";
		}
		$custom_style .= "body #ro-main { width: $tb_body_width; margin: auto; background-color: #ffffff;}";
		$custom_style .= ".ro-stick-active .ro-header-stick{ max-width: $tb_body_width;}";
		$custom_style .= ".ro-header-stick{ max-width: $tb_body_width;}";
	}
	$custom_css =  $custom_style;
}
/** remove redux menu under the tools **/
	add_action( 'admin_menu', 'ro_theme_remove_redux_menu',12 );
	function ro_theme_remove_redux_menu() {
		remove_submenu_page('tools.php','redux-about');
	}	
/* Style Inline */
function ro_add_style_inline() {
    global $tb_options, $custom_css;
    $custom_style = $custom_css;
    if ($tb_options['custom_css_code']) {
        $custom_style .= "{$tb_options['custom_css_code']}";
    }
	$path = URI_PATH;
    wp_enqueue_style('wp_custom_style', URI_PATH . '/assets/css/wp_custom_style.css',array('style'));
    
	/* Body background */
    $tb_background_color =& $tb_options['tb_background']['background-color'];
    $tb_background_image =& $tb_options['tb_background']['background-image'];
    $tb_background_repeat =& $tb_options['tb_background']['background-repeat'];
    $tb_background_position =& $tb_options['tb_background']['background-position'];
    $tb_background_size =& $tb_options['tb_background']['background-size'];
    $tb_background_attachment =& $tb_options['tb_background']['background-attachment'];
	$custom_style .= "body{ background-color: $tb_background_color;}";
	if($tb_background_image){
		$custom_style .= "body{ background: url('$tb_background_image') $tb_background_repeat $tb_background_attachment $tb_background_position;background-size: $tb_background_size;}";
	}
	
	/* Title bar background */
    $tb_title_bar_bg_color =& $tb_options['tb_title_bar_bg']['background-color'];
    $title_bar_bg_image =& $tb_options['tb_title_bar_bg']['background-image'];
    $title_bar_bg_repeat =& $tb_options['tb_title_bar_bg']['background-repeat'];
    $title_bar_bg_position =& $tb_options['tb_title_bar_bg']['background-position'];
    $title_bar_bg_size =& $tb_options['tb_title_bar_bg']['background-size'];
    $title_bar_bg_attachment =& $tb_options['tb_title_bar_bg']['background-attachment'];
	$custom_style .= ".ro-blog-header { background-color: $tb_title_bar_bg_color;}";
	if($title_bar_bg_image){
		$custom_style .= ".ro-blog-header { background: url('$title_bar_bg_image') $title_bar_bg_repeat $title_bar_bg_attachment $title_bar_bg_position;background-size: $title_bar_bg_size;}";
	}
    wp_add_inline_style( 'wp_custom_style', $custom_style );
    /*End Font*/
}
add_action( 'wp_enqueue_scripts', 'ro_add_style_inline' );
add_filter('widget_text', 'do_shortcode');
/* Less */
if(isset($tb_options['tb_less'])&&$tb_options['tb_less']){
    require_once ABS_PATH_FR.'/presets.php';
}
/* Widgets */
require_once ABS_PATH_FR.'/widgets/abstract-widget.php';
require_once ABS_PATH_FR.'/widgets/widgets.php';
