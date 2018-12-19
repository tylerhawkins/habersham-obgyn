<div class="ro-doctor-slider flexslider ro-section-item">
	<ul class="slides">
		<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
		<li class="ro-doctor-slider-item">
			<div class="ro-item-info">
				<?php if ( has_post_thumbnail() && $show_image ) { the_post_thumbnail('full'); } ?>
				<?php if( $show_title ) { ?>
					<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<?php } ?>
				<?php if( $show_meta ) { ?>
					<span class="ro-department"><?php the_terms(get_the_ID(), 'doctor_department', '', ' & ' ); ?></span>
				<?php } ?>
			</div>
			<div class="ro-content">
				<?php if( $show_excerpt ) { ?>
					<?php echo get_post_meta( get_the_ID(), 'tb_doctor_quotes', true ); ?>
					<div class="ro-excerpt"><?php the_excerpt(); ?></div>
				<?php } ?>
			</div>
		</li>
		<?php } ?>
	</ul>
</div>