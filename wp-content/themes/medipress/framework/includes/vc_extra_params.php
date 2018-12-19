<?php
//Add extra params vc_row
vc_add_param ( "vc_row", array (
		"type" 			=> "textfield",
		"class" 		=> "",
		"heading" 		=> __( "Id One Page", 'medipress' ),
		"param_name" 	=> "id_onepage",
		"value" 		=> "",
		"description" 	=> __( "Please, Enter row id one page.", 'medipress' )
) );
vc_add_param ( 'vc_row', array (
		'type' 			=> 'checkbox',
		'heading' 		=> __("Row Full Height", 'medipress'),
		'param_name' 	=> 'full_height',
		"value" 		=> array (
							__( "Yes, please", 'medipress' )  => 1
						),
		'description' 	=> __("Set full height screen of this row.", 'medipress')
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "dropdown",
		"class" 		=> "",
		"heading" 		=> __( "Type", 'medipress' ),
		"admin_label" 	=> true,
		"param_name" 	=> "type",
		"value" 		=> array (
							"Default" => "default",
							"Background Video" => "custom-bg-video"
						),
		"description" 	=> __( "Select type of this row.", 'medipress' )
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "colorpicker",
		"class" 		=> "",
		"heading" 		=> __( "Text Color", 'medipress' ),
		"param_name" 	=> "text_color",
		"value" 		=> "",
		"description" 	=> __( "Select color for all text in this row.", 'medipress' )
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "colorpicker",
		"class" 		=> "",
		"heading" 		=> __( "Heading Color", 'medipress' ),
		"param_name" 	=> "heading_color",
		"value" 		=> "",
		"description" 	=> __( "Select color for all heading in this row.", 'medipress' )
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "colorpicker",
		"class" 		=> "",
		"heading" 		=> __( "Link Color", 'medipress' ),
		"param_name" 	=> "link_color",
		"value" 		=> "",
		"description" 	=> __( "Select color for all link in this row.", 'medipress' )
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "colorpicker",
		"class" 		=> "",
		"heading" 		=> __( "Link Color Hover", 'medipress' ),
		"param_name" 	=> "link_color_hover",
		"value" 		=> "",
		"description" 	=> __( "Select color for all link hover in this row.", 'medipress' )
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "dropdown",
		"class" 		=> "",
		"heading" 		=> __( "Text Align", 'medipress' ),
		"param_name" 	=> "text_align",
		"value" 		=> array (
							"No" => "text-align-none",
							"Left" => "text-left",
							"Right" => "text-right",
							"Center" => "text-center"
						),
		"description" 	=> __( "Select text align for all columns in this row.", 'medipress' )
) );
vc_add_param ( 'vc_row', array (
		'type' 			=> 'checkbox',
		'heading' 		=> __("Content Full Width", 'medipress'),
		'param_name' 	=> 'full_width',
		"value" 		=> array (
							__( "Yes, please", 'medipress' )  => 1
						),
		'description' 	=> __("Set content full width of this row.", 'medipress')
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "checkbox",
		"class" 		=> "",
		"heading" 		=> __( "Same Height", 'medipress' ),
		"param_name" 	=> "same_height",
		"value" 		=> array (
							__( "Yes, please", 'medipress' )  => 1
						),
		"description" 	=> __( "Set the same height for all column in this row.", 'medipress' )
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "dropdown",
		"class" 		=> "",
		"heading" 		=> __( "Effect", 'medipress' ),
		"param_name" 	=> "animation",
		"value" 		=> array(
							"No" => "animation-none",
							"Top to bottom" => "top-to-bottom",
							"Bottom to top" => "bottom-to-top",
							"Left to right" => "left-to-right",
							"Right to left" => "right-to-left",
							"Appear from center" => "appear"
						),
		"description" 	=> __( "Select effect in this row.", 'medipress' )
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "checkbox",
		"class" 		=> "",
		"heading" 		=> __( "Enable parallax", 'medipress' ),
		"param_name" 	=> "enable_parallax",
		"value" 		=> array (
							__( "Yes, please", 'medipress' )  => 1,
						),
		"dependency" => array (
			"element" => "type",
			"value" => array('default')
		),
		"description" 	=> __( "Enable parallax effect in this row.", 'medipress' )
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "textfield",
		"class" 		=> "",
		"heading" 		=> __( "Parallax speed", 'medipress' ),
		"param_name" 	=> "parallax_speed",
		"value" 		=> "0.5",
		"dependency" => array (
			"element" => "type",
			"value" => array('default')
		),
		"description" 	=> __( "Please, Enter parallax speed in this row.", 'medipress' )
) );

vc_add_param ( "vc_row", array (
		"type" => "attach_image",
		"class" => "",
		"heading" => __( "Video poster", 'medipress' ),
		"param_name" => "poster",
		"value" => "",
		"dependency" => array (
				"element" => "type",
				"value" => array('custom-bg-video')
		)
) );
vc_add_param ( "vc_row", array (
		"type" => "checkbox",
		"class" => "",
		"heading" => __( "Loop", 'medipress' ),
		"param_name" => "loop",
		"value" => array (
				__( "Yes, please", 'medipress' )  => true,
		),
		"dependency" => array (
			"element" => "type",
			"value" => array('custom-bg-video')
		)
) );
vc_add_param ( "vc_row", array (
		"type" => "checkbox",
		"class" => "",
		"heading" => __( "Autoplay", 'medipress' ),
		"param_name" => "autoplay",
		"value" => array (
				__( "Yes, please", 'medipress' )  => true,
		),
		"dependency" => array (
			"element" => "type",
			"value" => array('custom-bg-video')
		)
) );
vc_add_param ( "vc_row", array (
		"type" => "checkbox",
		"class" => "",
		"heading" => __( "Muted", 'medipress' ),
		"param_name" => "muted",
		"value" => array (
				__( "Yes, please", 'medipress' )  => true,
		),
		"dependency" => array (
			"element" => "type",
			"value" => array('custom-bg-video')
		)
) );
vc_add_param ( "vc_row", array (
		"type" => "checkbox",
		"class" => "",
		"heading" => __( "Controls", 'medipress' ),
		"param_name" => "controls",
		"value" => array (
				__( "Yes, please", 'medipress' )  => true,
		),
		"dependency" => array (
			"element" => "type",
			"value" => array('custom-bg-video')
		)
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "textfield",
		"class" 		=> "",
		"heading" 		=> __( "Video background (mp4)", 'medipress' ),
		"param_name" 	=> "bg_video_src_mp4",
		"value" 		=> "",
		"dependency" 	=> array (
							"element" 	=> "type",
							"value" 	=> array('custom-bg-video')
						),
		"description" 	=> __( "Please, Enter url video (mp4) for background in this row.", 'medipress' )
) );

vc_add_param ( "vc_row", array (
		"type" 			=> "textfield",
		"class" 		=> "",
		"heading" 		=> __( "Video background (ogv)", 'medipress' ),
		"param_name" 	=> "bg_video_src_ogv",
		"value" 		=> "",
		"dependency" 	=> array (
							"element" 	=> "type",
							"value" 	=> array('custom-bg-video')
						),
		"description" 	=> __( "Please, Enter url video (ogv) for background in this row.", 'medipress' )
) );

vc_add_param ( "vc_row", array (
		"type" 			=> "textfield",
		"class" 		=> "",
		"heading" 		=> __( "Video background (webm)", 'medipress' ),
		"param_name" 	=> "bg_video_src_webm",
		"value" 		=> "",
		"dependency" 	=> array (
							"element" 	=> "type",
							"value" 	=> array('custom-bg-video')
						),
		"description" 	=> __( "Please, Enter url video (webm) for background in this row.", 'medipress' )
) );

//Add extra params vc_column
vc_add_param ( "vc_column", array (
		"type" 			=> "dropdown",
		"class" 		=> "",
		"heading" 		=> __( "Effect", 'medipress' ),
		"param_name" 	=> "animation",
		"value" 		=> array(
							"No" => "animation-none",
							"Top to bottom" => "top-to-bottom",
							"Bottom to top" => "bottom-to-top",
							"Left to right" => "left-to-right",
							"Right to left" => "right-to-left",
							"Appear from center" => "appear"
						),
		"description" 	=> __( "Select effect in this column.", 'medipress' )
) );
vc_add_param ( "vc_column", array (
		"type" 			=> "dropdown",
		"class" 		=> "",
		"heading" 		=> __( "Text Align", 'medipress' ),
		"param_name" 	=> "text_align",
		"value" 		=> array (
							"No" => "text-align-none",
							"Left" => "text-left",
							"Right" => "text-right",
							"Center" => "text-center"
						),
		"description" 	=> __( "Select text align in this column.", 'medipress' )
) );

//Progress bar
vc_add_param ( "vc_progress_bar", array (
		"type" => "dropdown",
		"class" => "",
		"heading" => __( "Style", 'medipress' ),
		"admin_label" => true,
		"param_name" => "style",
		"value" => array (
				"Default" => "default",
				"Style 1" => "style1"
		),
		"description" => __( "Select style progress bar.", 'medipress' )
) );
vc_add_param ( "vc_progress_bar", array (
		"type" => "dropdown",
		"class" => "",
		"heading" => __( "Size", 'medipress' ),
		"admin_label" => true,
		"param_name" => "size",
		"value" => array (
				"Small" => "small",
				"Medium" => "medium",
				"Large" => "large"
		),
                "dependency" => array(
                    "element" => "style",
                    "value" => "style1"
                ),
		"description" => __( "Select size progress bar.", 'medipress' )
) );
vc_add_param ( "vc_progress_bar", array (
		"type" => "dropdown",
		"class" => "",
		"heading" => __( "Unit Align", 'medipress' ),
		"admin_label" => true,
		"param_name" => "align_unit",
		"value" => array (
				"None" => "none",
				"Inline" => "inline",
				"Right" => "right"
		),
		"description" => __( "Select position unit in progerss bar.", 'medipress' )
) );
//Button
vc_add_param ( "vc_button", array (
		"type" => "dropdown",
		"class" => "",
		"heading" => __( "Type", 'medipress' ),
		"admin_label" => true,
		"param_name" => "type",
		"value" => array (
				"Rounded" => "rounded",
				"Radius" => "radius"
		),
		"description" => __( "Select type of button.", 'medipress' )
) );
//Pie & Counter
vc_add_param ( "vc_pie", array (
		"type" => "dropdown",
		"class" => "",
		"heading" => __( "Type", 'medipress' ),
		"admin_label" => true,
		"param_name" => "type",
		"value" => array (
				"Pie" => "pie",
				"Counter" => "counter"
		),
		"description" => __( "Select type.", 'medipress' )
) );
vc_add_param ( "vc_pie", array (
		"type" => "textfield",
		"class" => "",
		"heading" => __( "Title Size", 'medipress' ),
		"param_name" => "title_size",
		"value" => "",
		"description" => __( "Select font size of title widget.", 'medipress' )
) );
vc_add_param ( "vc_pie", array (
		"type" => "textfield",
		"class" => "",
		"heading" => __( "Font Size", 'medipress' ),
		"param_name" => "font_size",
		"value" => "",
		"dependency" => array (
				"element" => "type",
				"value" => array('counter')
		),
		"description" => __( "Select font size of counter value.", 'medipress' )
) );
vc_add_param ( "vc_pie", array (
		"type" => "attach_image",
		"class" => "",
		"heading" => __( "Image", 'medipress' ),
		"param_name" => "image",
		"value" => "",
		"dependency" => array (
				"element" => "type",
				"value" => array('pie')
		),
		"description" => __( "Select image of pie.", 'medipress' )
) );
//Add extra params vc_tab
vc_add_param ( "vc_tab", array (
		"type" => "textfield",
		"class" => "",
		"heading" => __( "Icon", 'medipress' ),
		"param_name" => "icon",
		"value" => "",
		"description" => __( "Icon class.", 'medipress' )
) );
//Add extra params vc_accordion
vc_add_param ( "vc_accordion", array (
		"type" => "dropdown",
		"class" => "",
		"heading" => __( "Style", 'medipress' ),
		"admin_label" => true,
		"param_name" => "style",
		"value" => array (
				"Default" => "default",
				"Border Text" => "border-text"
		),
		"description" => __( "Select Style of accordion.", 'medipress' )
) );