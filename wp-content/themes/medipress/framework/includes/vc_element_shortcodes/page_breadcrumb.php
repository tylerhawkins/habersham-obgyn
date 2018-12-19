<?php
vc_map(array(
	"name" => __("Page Breadcrumb", 'medipress'),
	"base" => "page_breadcrumb",
	"category" => __('mediPress', 'medipress'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
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
