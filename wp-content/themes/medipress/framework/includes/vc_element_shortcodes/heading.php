<?php
vc_map(array(
	"name" => __("Heading", 'medipress'),
	"base" => "heading",
	"class" => "title",
	"category" => __('mediPress', 'medipress'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Template", 'medipress'),
			"param_name" => "tpl",
			"value" => array(
				"Template 1" => "tpl1",
				"Template 2" => "tpl2"
			),
			"description" => __("Select select template in this element.", 'medipress')
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Text", 'medipress'),
			"param_name" => "text",
			"value" => "",
			"description" => __("Please, Enter text in this element.", 'medipress')
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Extra Text", 'medipress'),
			"param_name" => "extra_text",
			"value" => "",
			"description" => __("Please, Enter extra text in this element.", 'medipress')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Sub Text", 'medipress'),
			"param_name" => "sub_text",
			"value" => "",
			"description" => __("Please, Enter sub text in this element.", 'medipress')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Extra Class", 'medipress'),
			"param_name" => "el_class",
			"value" => "",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'medipress')
		),
	)
));
