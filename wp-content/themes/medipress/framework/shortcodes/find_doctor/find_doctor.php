<?php
function ro_find_doctor_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'appointment_link' => '#',
        'el_class' => '',
    ), $atts));
			
    $class = array();
    $class[] = 'ro-find-doctor-wrapper clearfix';
    $class[] = $el_class;
	
	$doctor_department = $doctor_name = $doctor_name_alphabet = '';
	$doctor_hospital = array();
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	if(isset($_POST['ro-doctor-department'])) {
		$doctor_department = 	$_POST['ro-doctor-department'];
        if(isset($_POST['ro-doctor-name']))        
		      $doctor_name = $_POST['ro-doctor-name'];
        if(isset($_POST['ro-doctor-name-alphabet']))              
		      $doctor_name_alphabet = $_POST['ro-doctor-name-alphabet'];
		
		$terms = get_terms('doctor_hospital', 'orderby=count&hide_empty=0');
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
			foreach($terms as $term) {
				if(isset($_POST['ro-doctor-hospital-'.$term->term_id])){
					$doctor_hospital[] = 		$_POST['ro-doctor-hospital-'.$term->term_id];
				}
			}
		}

		$args = array(
			'posts_per_page' => -1,
			'paged' => $paged,
			'post_type' => 'doctor',
			's' => $doctor_name,
			'post_status' => 'publish');
		
		if ($doctor_department != '') {
			$args['tax_query'] = array(
									array(
										'taxonomy' => 'doctor_department',
										'field' => 'id',
										'terms' => $doctor_department
									)
							);
		}
		if (!empty($doctor_hospital)) {
			$args['tax_query'] = array(
									array(
										'taxonomy' => 'doctor_hospital',
										'field' => 'id',
										'terms' => $doctor_hospital
									)
							);
		}
		
	} else {

		$args = array(
			'posts_per_page' => -1,
			'paged' => $paged,
			'post_type' => 'doctor',
			'post_status' => 'publish');
	}
	$wp_query = new WP_Query($args);
    ob_start();
	
    ?>
	
	<div class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<div class="ro-find-doctor-form">
			<form action="" method="post">
				<div class="row">
					<div class="col-md-6">
						<h6 class="ro-color-main"><?php _e('Search by Department', 'medipress') ?></h6>
						<select class="ro-doctor-department" name="ro-doctor-department">
							<option value=""><?php _e('All Department', 'medipress') ?></option>
							<?php
								$terms = get_terms('doctor_department', 'orderby=count&hide_empty=0');
								if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
									foreach($terms as $term) {
										if($doctor_department == $term->term_id) {
											echo '<option selected="selected" value="'.esc_attr($term->term_id).'">'.esc_html($term->name).'</option>';
										} else {
											echo '<option value="'.esc_attr($term->term_id).'">'.esc_html($term->name).'</option>';
										}
									}
								}
							?>
						</select>
					</div>
					<div class="col-md-6">
						<h6><?php _e('Search by Doctor\'s name', 'medipress') ?></h6>
						<input class="ro-doctor-name" type="text" value="<?php echo esc_html($doctor_name); ?>" name="ro-doctor-name">
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<h6 class="ro-color-main"><?php _e('Alphabetical Search', 'medipress') ?></h6>
						<div class="ro-doctor-name-alphabet">
							<span><input type="radio"<?php if($doctor_name_alphabet == 'A') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="A"><label>A</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'B') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="B"><label>B</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'C') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="C"><label>C</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'D') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="D"><label>D</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'E') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="E"><label>E</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'F') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="F"><label>F</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'G') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="G"><label>G</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'H') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="H"><label>H</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'I') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="I"><label>I</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'J') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="J"><label>J</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'K') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="K"><label>K</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'L') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="L"><label>L</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'M') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="M"><label>M</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'N') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="N"><label>N</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'O') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="O"><label>O</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'P') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="P"><label>P</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'Q') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="Q"><label>K</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'R') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="R"><label>R</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'S') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="S"><label>S</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'T') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="T"><label>T</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'U') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="U"><label>U</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'V') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="V"><label>V</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'X') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="W"><label>W</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'W') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="X"><label>X</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'Y') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="Y"><label>Y</label></span>
							<span><input type="radio"<?php if($doctor_name_alphabet == 'Z') echo ' checked="checked"'; ?> name="ro-doctor-name-alphabet" value="Z"><label>Z</label></span>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<h6 class="ro-color-main"><?php _e('Select Hospital', 'medipress') ?></h6>
						<?php
						$terms = get_terms('doctor_hospital', 'orderby=count&hide_empty=0');
						if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
							foreach($terms as $term) {
								if (in_array($term->term_id, $doctor_hospital)) {
									echo '<span class="ro-checkbox-item"><input class="ro-doctor-hospital" type="checkbox" checked="checked" value="'.esc_attr($term->term_id).'" name="ro-doctor-hospital-'.esc_attr($term->term_id).'"><label>'.esc_html($term->name).'</label></span>';
								} else {
									echo '<span class="ro-checkbox-item"><input class="ro-doctor-hospital" type="checkbox" value="'.esc_attr($term->term_id).'" name="ro-doctor-hospital-'.esc_attr($term->term_id).'"><label>'.esc_html($term->name).'</label></span>';
								}
							}
						}
					?>
					</div>
					
				</div>
				
				<div class="row">
					<div class="col-md-12 text-center">
						<input type="submit" class="ro-submit" value="SEARCH">
						<input type="reset" class="ro-reset" value="CLEAR ALL">
					</div>
				</div>
			</form>
		</div>
		<div class="ro-find-doctor-result">
			<?php if(isset($_POST['ro-doctor-department'])) { ?>
				
				<?php if($wp_query->have_posts()) { $count_result = 0;?>
					
					<?php if($doctor_name_alphabet) { ?>
						<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
							<?php
								if(substr(get_the_title(), 0, 1) == $doctor_name_alphabet) {
									$count_result++;
								}
							?>
						<?php } ?>
					<?php } ?>
					<div class="ro-header clearfix">
						<h4 class="pull-left"><?php _e('SEARCH RESULT', 'medipress') ?></h4>
						<?php echo $count_result ? '<span class="pull-right">'.$count_result.' Result(s) found</span>': '<span class="pull-right">'.$wp_query->post_count.' Result(s) found</span>'; ?>
					</div>
					
					<?php if($doctor_name_alphabet) { $count_result = $result_msg = 0; ?>
						<div class="ro-content ro-doctor-items">
							<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
								<?php
									if(substr(get_the_title(), 0, 1) == $doctor_name_alphabet) {
										$count_result++;
										$result_msg = 1;
										include 'tpl1.php';
									}
								
								?>
								
							<?php } ?>
						</div>
					<?php } else { ?>
						<div class="ro-content ro-doctor-items">
							<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
								<?php
									$result_msg = 1;
									include 'tpl1.php';
								?>
								
							<?php } ?>
						</div>
					<?php } ?>
					
					<?php if($result_msg == 0) echo '<h1>Nothing Found</h1>'; ?>
					
				<?php }else { ?>
					<h1><?php _e('Nothing Found', 'medipress') ?></h1>
				<?php } ?>
			<?php } else { ?>
				<?php if($wp_query->have_posts()) { ?>
					<div class="ro-header clearfix">
						<h4 class="pull-left"><?php _e('ALL RESULT', 'medipress') ?></h4>
						<?php echo '<span class="pull-right">'.$wp_query->post_count.' Result(s) found</span>'; ?>
					</div>
					<div class="ro-content ro-doctor-items">
						<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
							<?php include 'tpl1.php'; ?>
						<?php } ?>
					</div>
					<div class="clear"></div>
					<nav class="ro-pagination" role="navigation">
						<?php
							$big = 999999999; // need an unlikely integer

							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $wp_query->max_num_pages,
								'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'medipress' ),
								'next_text' => __( '<i class="fa fa-angle-right"></i>', 'medipress' ),
							) );
						?>
					</nav>
				<?php }else { ?>
					<h1><?php _e('Nothing Found', 'medipress') ?></h1>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
    <?php
    return ob_get_clean();
}

if(function_exists('insert_shortcode')) { insert_shortcode('find_doctor', 'ro_find_doctor_func'); }
