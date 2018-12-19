<?php
function ro_service_box_func($atts, $content = null) {
    extract(shortcode_atts(array(
		'tpl' => 'tpl1',
		'img' => '',
		'icon' => '',
		'title' => '',
        'desc' => '',
        'ex_link' => '#',
        'el_class' => ''
    ), $atts));

	$content = wpb_js_remove_wpautop($content, true);
	
    $class = array();
	$class[] = 'ro-service-wrap';
	$class[] = $tpl;
	$class[] = $el_class;
    ob_start();
    ?>
		<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
			<?php include $tpl.'.php'; ?>
		</div>
		
    <?php
    return ob_get_clean();
}
if(function_exists('insert_shortcode')) { insert_shortcode('service_box', 'ro_service_box_func');}
