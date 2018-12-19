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