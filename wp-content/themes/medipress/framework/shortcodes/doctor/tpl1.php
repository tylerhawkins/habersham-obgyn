<div class="ro-doctor-item ro-doctor-grid-style1">
	<div class="ro-doctor-inner">
		<div class="ro-doctor-image">
			<?php 
				if ( has_post_thumbnail() && $show_image ) { the_post_thumbnail('full'); } 							
			?>
			<div class="ro-doctor-overlay"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fa fa-link"></i></a></div>
		</div>
		<div class="ro-doctor-content">
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
		</div>
	</div>
	<div class="ro-doctor-description">
		<?php if( $show_excerpt ) { ?>
			<div class="ro-excerpt"><?php the_excerpt(); ?></div>
		<?php } ?>
	</div>
</div>