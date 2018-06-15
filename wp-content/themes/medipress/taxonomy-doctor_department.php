<?php get_header(); ?>
<?php
global $tb_options;
$tb_show_page_title = isset($tb_options['tb_post_show_page_title']) ? $tb_options['tb_post_show_page_title'] : 1;
$tb_show_page_breadcrumb = isset($tb_options['tb_post_show_page_breadcrumb']) ? $tb_options['tb_post_show_page_breadcrumb'] : 1;
ro_theme_title_bar($tb_show_page_title, $tb_show_page_breadcrumb);
?>
	<div class="main-content">
		<div class="container">
			<div class="row">
				<!-- Start Content -->
				<div class="col-md-12 ro-content ro-doctor-items">
					<?php
					if( have_posts() ) {
						while ( have_posts() ) : the_post();
							?>
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<div class="ro-doctor-item clearfix">
										<div class="ro-doctor-image">
											<?php if ( has_post_thumbnail()) { the_post_thumbnail('full'); } ?>
											<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
											<span class="ro-department"><?php the_terms(get_the_ID(), 'doctor_department', '', ' & ' ); ?></span>
										</div>
										<div class="ro-doctor-content">
											<?php 
												_e('<h5>Personal Information</h5>', 'medipress'); 
												the_content();
												
												$doctor_testimonials = get_post_meta( get_the_ID(), 'tb_doctor_testimonials', true );
												if ($doctor_testimonials){
													_e('<h5>Testimonials</h5>', 'medipress');
													echo do_shortcode($doctor_testimonials);													
												}
                                                $appoitment_link = get_post_meta( get_the_ID(), 'tb_appoitment_link', true );
                                                if(!$appoitment_link){
                                                    $appoitment_link = "#";
                                                }
											?>
											<div class="ro-buttons">
												<a class="ro-appointment" href="<?php echo esc_url($appoitment_link); ?>"><?php _e('MAKE AN APPOINTMENT', 'medipress'); ?></a>
												<a class="ro-profile" href="<?php the_permalink(); ?>"><?php _e('VIEW PROFILE', 'medipress'); ?></a>
											</div>
										</div>
									</div>
								</article>
							<?php
						endwhile;
						
						ro_theme_paging_nav();
					}else{
						get_template_part( 'framework/templates/entry', 'none');
					}
					?>
				</div>
				<!-- End Content -->
			</div>
		</div>
	</div>
<?php get_footer(); ?>