<?php
extract(shortcode_atts(array(
    'el_class'        		=> '',
	'id_onepage'			=> '', 
    'bg_image'        		=> '',
    'bg_color'        		=> '',
    'bg_image_repeat' 		=> '',
    'font_color'      		=> '',
    'padding'         		=> '',
    'margin_bottom'   		=> '',
    'css'					=> '',
	'type' 					=> '',
	'text_color' 			=> '',
	'heading_color' 		=> '',
	'link_color' 			=> '',
	'link_color_hover' 		=> '',
	'text_align' 			=> '',
    'full_width' 			=> '',
    'full_height' 			=> '',
    'equal_height' 			=> '',
    'animation' 			=> '',
    'enable_parallax' 		=> '',
    'parallax_speed' 		=> '',
	'poster' => '',
	'autoplay' => false,
	'muted' => false,
	'loop' => false,
	'controls' => false,
	'preload' => 'none',
	'bg_video_src_mp4' 		=> '',
	'bg_video_src_ogv' 		=> '',
	'bg_video_src_webm' 	=> '',
	
), $atts));
// wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
// wp_enqueue_style('js_composer_custom_css');
$el_class = $this->getExtraClass($el_class);
$cl_custom = vc_shortcode_custom_css_class( $css, '.' );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) .  $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);

//Row Animation
if($animation != 'animation-none') $css_class .= $this->getCSSAnimation($animation);
/* Heading & Link Color */
$color_style = "";
$row_custom = uniqid('vc_row');
$row_custom_class = '.'.$row_custom;
$cl_custom = $cl_custom!=''?$cl_custom:$row_custom_class;
if($text_color || $heading_color || $link_color || $link_color_hover){
    $color_style .= '<style type="text/css" scoped>';
	if($text_color){
        $color_style .= "$cl_custom{color: $text_color;}";
    }
    if($heading_color){
        $color_style .= "$cl_custom h1,$cl_custom h2,$cl_custom h3,$cl_custom h4,$cl_custom h5,$cl_custom h6{color: $heading_color;}";
    }
    if($link_color){
		$color_style .= "$cl_custom a{color: $link_color;}";
    }
    if($link_color_hover){
		$color_style .= "$cl_custom a:hover{color: $link_color_hover;}";
    }
    $color_style .= '</style>';
}
//Row Text Align
$css_class .= ' '.esc_attr($text_align);

//Row Content Full width
$cl_full_width = $full_width ? 'no-container' : 'container';

//Get Image Height
$img_info = $data_image_height = null;
if(isset($url[0])){
    $img_info = @getimagesize($url[0]);
    $data_image_height = " data-background-height='{$img_info[1]}' data-background-width='{$img_info[0]}'";
}

//Parallax
$stripe_classes = array();
$stripe_classes[] = $type;
$stripe_classes[] = $row_custom;
$data_attr = null;
if ($enable_parallax) {
    $parallax_speed = floatval($parallax_speed);
    if (!$parallax_speed) {
        $parallax_speed = 0.5;
    }
    $stripe_classes[] = $type=='default'?'stripe-parallax-bg':'stripe-parallax-video';
    $data_attr = ' data-parallax-speed="' . $parallax_speed . '"' .$data_image_height;
}
//Same Height For All Column In This Row
if ($equal_height) {
    $stripe_classes[] = 'same-height';
}
/*Row full height screen*/
if ($full_height) {
    $stripe_classes[] = 'full-height';
}
/*Row id Onepage*/
$id_row = '';
if ( $id_onepage ) {
	$id_row = ' id="'.esc_attr($id_onepage).'"';
}
if (!empty($css_class)) {
    $stripe_classes[] = $css_class;
}

//Custom BG
$bg_video = null;
if ($type=='custom-bg-video') {
    $bg_video_args = array();
	if(is_numeric($poster)) {
		$image_src = wp_get_attachment_url( $poster );
	}else {
		$image_src = $poster;
	}
    $stripe_classes[] = 'ro-relative';
    if ($bg_video_src_mp4) {
        $bg_video_args['mp4'] = $bg_video_src_mp4;
    }
    if ($bg_video_src_ogv) {
        $bg_video_args['ogv'] = $bg_video_src_ogv;
    }
    if ($bg_video_src_webm) {
        $bg_video_args['webm'] = $bg_video_src_webm;
    }
    $uniqid = uniqid('video');
    if (!empty($bg_video_args)) {
        $attr_strings = array(
            'id="'.$uniqid.'"',
            'data-id="'.$uniqid.'"',
        );
		if (!empty($image_src)) {
			$attr_strings[] = 'poster="'.$image_src.'"';
		}
		if ($autoplay==true) {
			$attr_strings[] = 'autoplay';
		}
		if ($muted==true) {
			$attr_strings[] = 'muted';
		}
		if ($loop==true) {
			$attr_strings[] = 'loop';
		}
		if ($controls==true) {
			$attr_strings[] = 'controls="controls"';
		}
		if ($preload) {
			$attr_strings[] = 'preload="'.$preload.'"';
		}
        $bg_video .= sprintf('<div class="ro-overlay-bg ro-video-bg-wrapper"><video data-ratio="1.22222222222" onloadeddata="javascript:{jQuery(this).attr(\'data-ratio\',this.videoWidth/this.videoHeight)}" class="ro-video-bg video-parallax" %s >', join(' ', $attr_strings));
        $source = '<source type="%s" src="%s" />';
        foreach ($bg_video_args as $video_type => $video_src) {
            $video_type = wp_check_filetype($video_src, wp_get_mime_types());
            $bg_video .= sprintf($source, $video_type['type'], esc_url($video_src));
        }
        $bg_video .= '</video></div>';
    }
	$detect = new Mobile_Detect;
	if ( $detect->isMobile() && $detect->isMobile() ){
		$bg_video = '<div class="ro-overlay-bg"><img src="'.esc_url($image_src).'" alt="Image Poster" style="min-height: 800px;" /></div>';
	}
    $output .= '<div'.$id_row.' class="' . esc_attr(implode(' ', $stripe_classes)) . '"' . $data_attr  . '>';
	$output .= $bg_video;
} else {
	$output .= '<div'.$id_row.' class="' . esc_attr(implode(' ', $stripe_classes)) . '"' . $data_attr  . '>';
}
$output .= $color_style;
$output .='<div class="'.esc_attr($cl_full_width).'"><div class="row main-row" '.$style.'>';
$output .= wpb_js_remove_wpautop($content);
$output .='</div></div>';
$output .= '</div>'.$this->endBlockComment('row');
echo ''.$output;