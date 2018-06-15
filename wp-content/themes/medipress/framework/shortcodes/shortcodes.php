<?php
$elements = array(
	'video',
	'heading',
	'doctor',
	'doctor_slider',
	'find_doctor',
	'blog',
	'blog_slider',
	'blog_grid',
	'pricing_grid',
	'testimonial_slider',
	'award_slider',
	'service_box',
	'info_box',
	'latest_news_slider',
	'page_title',
	'page_breadcrumb',
	'fancy_list',
	'map_v3',
	'counter_up',
	'gallery_grid',
);

foreach ($elements as $element) {
	include($element .'/'. $element.'.php');
}

