<?php
function ro_fancy_list_func($params) {
    extract(shortcode_atts(array(
        'icon1' => '',
        'text1' => '',
		'icon2' => '',
        'text2' => '',
		'icon3' => '',
        'text3' => '',
		'icon4' => '',
        'text4' => '',
		'icon5' => '',
        'text5' => '',
		'icon6' => '',
        'text6' => '',
		'icon7' => '',
        'text7' => '',
		'icon8' => '',
        'text8' => '',
		'icon9' => '',
        'text9' => '',
		'icon10' => '',
        'text10' => '',
        'el_class' => '',
    ), $params));
    ob_start();
	$class = array();
    $class[] = 'ro-fancy-list';
    $class[] = $el_class;
	
    ?>
    <div class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<ul class="ro-fancy-list">
			<?php if($text1) { ?>
				<li class="ro-fancy-item clearfix">
					<?php if($icon1) echo '<i class="'.esc_attr($icon1).'"></i> '; echo esc_html($text1 ); ?>
				</li>
			<?php } ?>
			<?php if($text2) { ?>
				<li class="ro-fancy-item clearfix">
					<?php if($icon2) echo '<i class="'.esc_attr($icon2).'"></i> '; echo esc_html($text2 ); ?>
				</li>
			<?php } ?>
			<?php if($text3) { ?>
				<li class="ro-fancy-item clearfix">
					<?php if($icon3) echo '<i class="'.esc_attr($icon3).'"></i> '; echo esc_html($text3 ); ?>
				</li>
			<?php } ?>
			<?php if($text4) { ?>
				<li class="ro-fancy-item clearfix">
					<?php if($icon4) echo '<i class="'.esc_attr($icon4).'"></i> '; echo esc_html($text4 ); ?>
				</li>
			<?php } ?>
			<?php if($text5) { ?>
				<li class="ro-fancy-item clearfix">
					<?php if($icon5) echo '<i class="'.esc_attr($icon5).'"></i> '; echo esc_html($text5 ); ?>
				</li>
			<?php } ?>
			<?php if($text6) { ?>
				<li class="ro-fancy-item clearfix">
					<?php if($icon6) echo '<i class="'.esc_attr($icon6).'"></i> '; echo esc_html($text6 ); ?>
				</li>
			<?php } ?>
			<?php if($text7) { ?>
				<li class="ro-fancy-item clearfix">
					<?php if($icon7) echo '<i class="'.esc_attr($icon7).'"></i> '; echo esc_html($text7 ); ?>
				</li>
			<?php } ?>
			<?php if($text8) { ?>
				<li class="ro-fancy-item clearfix">
					<?php if($icon8) echo '<i class="'.esc_attr($icon8).'"></i> '; echo esc_html($text8 ); ?>
				</li>
			<?php } ?>
			<?php if($text9) { ?>
				<li class="ro-fancy-item clearfix">
					<?php if($icon9) echo '<i class="'.esc_attr($icon9).'"></i> '; echo esc_html($text9 ); ?>
				</li>
			<?php } ?>
			<?php if($text10) { ?>
				<li class="ro-fancy-item clearfix">
					<?php if($icon10) echo '<i class="'.esc_attr($icon10).'"></i> '; echo esc_html($text10 ); ?>
				</li>
			<?php } ?>
		</ul>
	</div>
    <?php
    return ob_get_clean();
}

if(function_exists('insert_shortcode')) { insert_shortcode('fancy_list', 'ro_fancy_list_func'); }