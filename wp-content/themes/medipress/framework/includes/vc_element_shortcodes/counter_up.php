<?php
vc_map(array(
	"name" => __("Counter Up", 'medipress'),
	"base" => "counter_up",
	"category" => __('mediPress', 'medipress'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Icon", 'medipress'),
			"param_name" => "icon",
			"value" => "",
			"description" => __("Please, enter class icon in this element.", 'medipress')
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Number", 'medipress'),
			"param_name" => "number",
			"value" => "",
			"description" => __("Please, enter number in this element.", 'medipress')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Title", 'medipress'),
			"param_name" => "title",
			"value" => "",
			"description" => __("Please, enter title in this element.", 'medipress')
		),
		array(
			"type" => "textarea_html",
			"class" => "",
			"heading" => __("Description", 'medipress'),
			"param_name" => "content",
			"value" => "",
			"description" => __("Please, enter description in this element.", 'medipress')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Extra Class", 'medipress'),
			"param_name" => "el_class",
			"value" => "",
			"description" => __ ( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'medipress' )
		),
	)
));
