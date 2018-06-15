<?php
function ro_page_title_bar_func($atts) {
    extract(shortcode_atts(array(
		'title' => '',
        'desc' => '',
        'el_class' => ''
    ), $atts));

    $class = array();
	$class[] = 'ro-page-title';
	$class[] = $el_class;
    ob_start();
    ?>
		<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
			<h2><?php if( $title ) { echo esc_html( $title ); } else { echo ro_theme_page_title(); } ?></h2>
			<?php if( $desc ) echo '<p>'.esc_html( $desc ).'</p>' ?>
		</div>
		
    <?php
    return ob_get_clean();
}
if(function_exists('insert_shortcode')) { insert_shortcode('page_title_bar', 'ro_page_title_bar_func');}
