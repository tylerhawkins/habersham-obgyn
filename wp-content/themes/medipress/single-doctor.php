<?php get_header(); ?>
<?php
global $tb_options;
$tb_show_page_title = isset($tb_options['tb_post_show_page_title']) ? $tb_options['tb_post_show_page_title'] : 1;
$tb_show_page_breadcrumb = isset($tb_options['tb_post_show_page_breadcrumb']) ? $tb_options['tb_post_show_page_breadcrumb'] : 1;
$tb_post_show_post_nav = (int) isset($tb_options['tb_recipes_post_show_post_nav']) ?  $tb_options['tb_recipes_post_show_post_nav']: 0;
ro_theme_title_bar($tb_show_page_title, $tb_show_page_breadcrumb, $tb_post_show_post_nav);

?>
	<div class="main-content ro-doctor">
		<div class="container">
			<div class="ro-doctor-detail">
				<?php while ( have_posts() ) { the_post(); $post_id = get_the_ID(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="row">
							<div class="ro-doctor-image col-sm-6">
								<?php 
									$img_extra = get_post_meta($post_id, 'tb_doctor_extra_img', true);
									if(isset($img_extra)){
										echo '<img src="'.esc_url($img_extra).'" title="'.esc_attr(get_the_title()).'"/>';
									}
									else{
										if(has_post_thumbnail()) the_post_thumbnail('full'); 
									}
								?>
							</div>
							<div class="ro-doctor-content col-sm-6">
								<div class="ro-header">
									<h3 class="ro-doctor-title"><?php the_title(); ?></h3>
									<div class="ro-doctor-share"><?php echo ro_theme_social_share_post_render(); ?></div>
									<span class="ro-department"><?php the_terms(get_the_ID(), 'doctor_department', '', ' & ' ); ?></span>
								</div>
								<div class="ro-desciption"><?php the_content(); ?></div>
								<?php $app_link = get_post_meta($post_id, 'tb_appoitment_link', true); ?>
								<div class="ro-btn-appointment"><a class="ro-btn ro-btn-1" href="<?php echo esc_url($app_link); ?>"><?php esc_html_e("Make an appointment", "medipress"); ?></a></div>
								<div class="ro-doctor-qualifications">
									<h5><?php esc_html_e("Qualifications", "medipress"); ?></h5>
									<?php
										$qualiti = explode(',',get_post_meta($post_id, 'tb_doctor_qualifications', true));
										foreach($qualiti as $item){
											echo '<div class="ro-qualiti-item">'.$item.'</div>';
										}
									?>
								</div>
								<div class="ro-doctor-work-hour">
									<h5><?php esc_html_e("Work Hour", "medipress"); ?></h5>
									<?php
										$work = get_post_meta($post_id, 'tb_doctor_working', true);
										echo do_shortcode($work);
									?>
								</div>
							</div>
						</div>
					</article>
				<?php 
				} 
				wp_reset_postdata();
				?>
			</div>
		</div>
		<div class="ro-doctor-related row">
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
					<?php
						echo do_shortcode('[heading tpl="tpl2" text="Related" extra_text="Doctors" sub_text="We provide high-quality health care services for the human. The key is to drink coconut,  fresh coconut, trust me. We don\'t see them, we will never see them."]');	
					?>
					</div>
					<div class="ro-doctor-related-inner col-sm-12">
						<?php 
							// get the custom post type's taxonomy terms
							$custom_taxterms = wp_get_object_terms( $post_id, 'doctor_department', array('fields' => 'ids') );

							// arguments
							$args = array(
							'post_type' => 'doctor',
							'post_status' => 'publish',
							'posts_per_page' => 8,
							'tax_query' => array(
								array(
									'taxonomy' => 'doctor_department',
									'field' => 'id',
									'terms' => $custom_taxterms
								)
							),
							'post__not_in' => array ($post_id),
							);
							$related_items = new WP_Query( $args );
							// loop over query
							if ($related_items->have_posts()) { ?>
								<div class="ro-doctor-slider">
									<?php while ( $related_items->have_posts() ) { $related_items->the_post();?>
									<div class="ro-doctor-slider-item">
										<div class="ro-item-inner">
											<div class="ro-item-image">
												<?php if ( has_post_thumbnail() ) { the_post_thumbnail('full'); } ?>
												<div class="ro-overlay"><a href="<?php the_permalink(); ?>"><span></span></a></div>
											</div>
											<div class="ro-item-content">
												<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
												<div class="ro-meta">
													<?php
														$doctor_department = the_terms(get_the_ID(), 'doctor_department', '', ' & ' );
														if( $doctor_department ) echo '<div class="ro-department">'.$doctor_department.'</div>';
													?>
												</div>
											</div>
										</div>
									</div>
									<?php } ?>
								</div>
								<?php }
								wp_reset_postdata();
							?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>