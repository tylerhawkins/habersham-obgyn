<?php
vc_map ( array (
		"name" => 'Find Doctor',
		"base" => "find_doctor",
		"icon" => "tb-icon-for-vc",
		"category" => __ ( 'mediPress', 'medipress' ),
		"params" => array (
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Appointment Link", 'medipress'),
						"param_name" => "appoitment_link",
						"value" => "",
						"description" => __ ( "Please, Enter appoitment link.", 'medipress' )
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