<?php
function ro_info_box_func($atts, $content = null) {
    extract(shortcode_atts(array(
		'icon' => '',
		'title' => '',
		'text_link' => '',
        'ex_link' => '#',
        'el_class' => ''
    ), $atts));
	
	$content = wpb_js_remove_wpautop($content, true);
	
    $class = array();
	$class[] = 'ro-info-wrapper';
	$class[] = $el_class;
    ob_start();
    ?>
		<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
			<div class="ro-info">
				<?php 
					if($icon) echo '<i class="'.esc_attr($icon).'"></i>';
					if($title) echo '<h4>'.esc_html($title).'</h4>';
					if($content) echo '<div class="ro-content">'.$content.'</div>';
					if($text_link) echo '<a class="ro-link" href="'. esc_url($ex_link) .'">'. esc_html($text_link) .'</a>';
				?>
			</div>
		</div>
		
    <?php
    return ob_get_clean();
}
if(function_exists('insert_shortcode')) { insert_shortcode('info_box', 'ro_info_box_func');}
