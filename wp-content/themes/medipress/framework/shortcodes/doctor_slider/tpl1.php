<div class="ro-doctor-slider">
	<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
	<div class="ro-doctor-slider-item">
		<h5>
			<?php
				$icon_doctor = get_post_meta( get_the_ID(), 'tb_doctor_icon', true );
				if( $icon_doctor ) echo '<span class="'.esc_attr($icon_doctor).'"></span>';
			?>
			<?php echo get_post_meta( get_the_ID(), 'tb_doctor_major', true ); ?>
		</h5>
		<div class="ro-item-inner">
			<div class="ro-item-image">
				<?php if ( has_post_thumbnail() && $show_image ) { the_post_thumbnail('full'); } ?>
				<div class="ro-overlay"><a href="<?php the_permalink(); ?>"><span></span></a></div>
			</div>
			<div class="ro-item-content">
				<?php if( $show_title ) { ?>
					<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<?php } ?>
				<?php if( $show_meta ) { ?>
					<div class="ro-meta">
						<?php
							$doctor_department = the_terms(get_the_ID(), 'doctor_department', '', ' & ' );
							if( $doctor_department ) echo '<div class="ro-department">'.$doctor_department.'</div>';
						?>
					</div>
				<?php } ?>
				<?php if( $show_excerpt ) { ?>
					<div class="ro-excerpt"><?php the_excerpt(); ?></div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>
</div>