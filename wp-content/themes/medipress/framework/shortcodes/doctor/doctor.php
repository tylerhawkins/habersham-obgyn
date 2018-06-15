<?php
function ro_doctor_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'category' => '',
		'posts_per_page' => -1,
		'columns' =>  3,
		'orderby' => 'none',
        'order' => 'none',
        'animation' => '',
        'el_class' => '',
		'tpl' => 'tpl1',
		'show_image' => 0,
        'show_title' => 0,
        'show_excerpt' => 0,
        'show_meta' => 0,
		'show_pagination' => 1,
    ), $atts));
			
    $class = array();
    $class[] = 'ro-doctor-wrapper clearfix';
    $class[] = $el_class;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => $orderby,
        'order' => $order,
        'post_type' => 'doctor',
        'post_status' => 'publish');
    if (isset($category) && $category != '') {
        $cats = explode(',', $category);
        $category = array();
        foreach ((array) $cats as $cat) :
        $category[] = trim($cat);
        endforeach;
        $args['tax_query'] = array(
                                array(
                                    'taxonomy' => 'doctor_department',
                                    'field' => 'id',
                                    'terms' => $category
                                )
                        );
    }
    $wp_query = new WP_Query($args);
	
    ob_start();
	
	if ( $wp_query->have_posts() ) {
		$class_columns = '';
		switch ($columns) {
			case 1:
				$class_columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
				break;
			case 2:
				$class_columns = 'col-xs-12 col-sm-12 col-md-6 col-lg-6';
				break;
			case 3:
				$class_columns = 'col-xs-12 col-sm-6 col-md-4 col-lg-4';
				break;
			case 4:
				$class_columns = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
				break;
			default:
				$class_columns = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
				break;
		}
    ?>
	<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<div class="row">
			<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
				<div class="<?php echo esc_attr($class_columns); ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php include $tpl.'.php'; ?>
					</article>
				</div>
			<?php } ?>
		</div>

		<div class="tb-doctor-footer">
				 <?php $paged = is_front_page() ? get_query_var('page') : get_query_var('paged'); $paged = max(1, $paged); if($show_pagination == 'number'){ ?>
					<nav class="ro-pagination <?php echo esc_attr($pos_pagination); ?>" role="navigation">
						<?php
							$big = 999999999; // need an unlikely integer

							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, $paged ),
								'total' => $wp_query->max_num_pages,
								'type'               => 'plain',
								'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'medipress' ),
								'next_text' => __( '<i class="fa fa-angle-right"></i>', 'medipress' ),
							) );
						?>
					</nav>
				<?php } ?>
				<?php if($show_pagination == 'ajax'){ 
					$args['posts_per_page'] = '-1';
					$wp_query_pagination = new WP_Query($args);
					$all_post = count($wp_query_pagination->posts);
					$max_page_num =  round(($all_post / $posts_per_page) + 0.4);

					if($all_post > $posts_per_page){
						wp_enqueue_script('doctor.page.ajax', URI_PATH.'/framework/shortcodes/doctor/ajax-page.js');
						wp_localize_script( 'doctor.page.ajax', 'variable_js', array(
							'ajax_url' => admin_url( 'admin-ajax.php' )
						));
						$data_params = $atts;
						?>
						<nav class="pagination blog <?php echo esc_attr($show_pagination); ?>" role="navigation">
							<a class="btn-pre-v2" href="#" data-params="<?php echo esc_attr(json_encode($data_params)); ?>" data-max-page="<?php echo esc_attr($max_page_num); ?>" data-next-page="<?php echo esc_attr('2'); ?>"><?php esc_html_e('View More', 'medipress'); ?></a>
						</nav>
						<?php
						} 
					}	
				wp_reset_postdata(); ?>
		</div>
	</div>

    <?php
	}
    return ob_get_clean();
}

if(function_exists('insert_shortcode')) { insert_shortcode('doctor', 'ro_doctor_func'); }

add_action( 'wp_ajax_nopriv_render_doctor_grid', 'render_doctor_grid' );
add_action( 'wp_ajax_render_doctor_grid', 'render_doctor_grid' );

function render_doctor_grid(){
	extract($_POST['params']);
	$paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
	
    $args = array(

        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => $orderby,
        'order' => $order,
        'post_type' => 'doctor',
        'post_status' => 'publish');

    if (isset($category) && $category != '') {
        $cats = explode(',', $category);
        $category = array();
        foreach ((array) $cats as $cat) :
        $category[] = trim($cat);
        endforeach;
        $args['tax_query'] = array(
                                array(
                                    'taxonomy' => 'doctor_department',
                                    'field' => 'id',
                                    'terms' => $category
                                )
                        );
    }

    $wp_query = new WP_Query($args);
    ob_start();

	if ( $wp_query->have_posts() ) {
		$class_columns = '';
		switch ($columns) {
			case 1:
				$class_columns = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
				break;
			case 2:
				$class_columns = 'col-xs-12 col-sm-12 col-md-6 col-lg-6';
				break;
			case 3:
				$class_columns = 'col-xs-12 col-sm-6 col-md-4 col-lg-4';
				break;
			case 4:
				$class_columns = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
				break;
			default:
				$class_columns = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
				break;
		}
    ?>
	<div class="row">
		<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
			<div class="<?php echo esc_attr($class_columns); ?>">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php include $tpl.'.php'; ?>
				</article>
			</div>
		<?php } ?>
	</div>
	<?php
	wp_reset_postdata();
    $blog_items = ob_get_clean();
    echo ro_theme_filtercontent($blog_items); exit;
    }
}
