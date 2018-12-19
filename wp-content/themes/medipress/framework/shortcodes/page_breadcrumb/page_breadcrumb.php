<?php
function ro_page_breadcrumb_func($atts) {
    extract(shortcode_atts(array(
        'delimiter' => '/',
        'el_class' => ''
    ), $atts));

    $class = array();
	$class[] = 'ro-page-breadcrumb';
	$class[] = $el_class;
    ob_start();
    ?>
		<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
			<div class="ro-path"><?php echo ro_theme_page_breadcrumb($delimiter); ?></div>
		</div>
		
    <?php
    return ob_get_clean();
}
if(function_exists('insert_shortcode')) { insert_shortcode('page_breadcrumb', 'ro_page_breadcrumb_func');}
