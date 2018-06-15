<?php
vc_map ( array (
		"name" => 'Pricing Grid',
		"base" => "pricing_grid",
		"icon" => "tb-icon-for-vc",
		"category" => __ ( 'mediPress', 'medipress' ), 
		'admin_enqueue_js' => array(URI_PATH_FR.'/admin/assets/js/customvc.js'),
		"params" => array (
					array (
							"type" => "textfield",
							"heading" => __ ( 'Count', 'medipress' ),
							"param_name" => "posts_per_page",
							'value' => '',
							"description" => __ ( 'The number of posts to display on each page. Set to "-1" for display all posts on the page.', 'medipress' )
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Show Pagination", 'medipress'),
						"param_name" => "show_pagination",
						"value" => array (
							__ ( "Yes, please", 'medipress' ) => true
						),
						"description" => __("Show or not show pagination in this element.", 'medipress')
					),
					array (
							"type" => "dropdown",
							"heading" => __ ( 'Order by', 'medipress' ),
							"param_name" => "orderby",
							"value" => array (
									"None" => "none",
									"Title" => "title",
									"Date" => "date",
									"ID" => "ID"
							),
							"description" => __ ( 'Order by ("none", "title", "date", "ID").', 'medipress' )
					),
					array (
							"type" => "dropdown",
							"heading" => __ ( 'Order', 'medipress' ),
							"param_name" => "order",
							"value" => Array (
									"None" => "none",
									"ASC" => "ASC",
									"DESC" => "DESC"
							),
							"description" => __ ( 'Order ("None", "Asc", "Desc").', 'medipress' )
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Extra Class", 'medipress'),
						"param_name" => "el_class",
						"value" => "",
						"description" => __ ( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'medipress' )
					),
					array (
							"type" => "tb_taxonomy",
							"taxonomy" => "pricing_tag",
							"heading" => __ ( "Categories", 'medipress' ),
							"param_name" => "category",
							"description" => __ ( "Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'medipress' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Template", 'medipress'),
						"param_name" => "tpl",
						"value" => array(
							"Template 1" => "tpl1",
							"Template 2" => "tpl2",
							"Template 3" => "tpl3",
						),
						"group" => __("Template", 'medipress'),
						"description" => __('Select template in this element.', 'medipress')
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Show Title", 'medipress'),
						"param_name" => "show_title",
						"value" => array (
							__ ( "Yes, please", 'medipress' ) => true
						),
						"group" => __("Template", 'medipress'),
						"description" => __("Show or not title of post in this element.", 'medipress')
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Show Description", 'medipress'),
						"param_name" => "show_description",
						"value" => array (
							__ ( "Yes, please", 'medipress' ) => true
						),
						"group" => __("Template", 'medipress'),
						"description" => __("Show or not description in this element.", 'medipress')
					),
		)
));