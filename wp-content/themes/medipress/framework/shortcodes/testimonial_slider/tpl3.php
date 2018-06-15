<div class="ro-testimonial-slider">
	<?php while ( $wp_query->have_posts() ) { $wp_query->the_post(); ?>
		<?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail', false); ?>
		<div class="ro-testimonial-slider-item" data-thumb="<?php echo esc_url($attachment_image[0]); ?>">
			<div class="ro-content">
				<div class="ro-meta">
					<div class="ro-testimonial-image">
						<?php if( has_post_thumbnail() ) the_post_thumbnail(); ?>
					</div>
					<div class="ro-testimonial-title">
						<?php if( $show_title ) { ?>
							<h5 class="tes-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
						<?php } ?>
						<?php if( $show_position ) { ?>
							<div class="tes-position"><?php echo get_post_meta( get_the_ID(), 'tb_testimonial_position', true ); ?></div>
						<?php } ?>
					</div>
				</div>
				<?php if( $show_excerpt ) { ?>
					<div class="ro-excerpt"><?php echo ro_custom_excerpt(20, ''); ?></div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
</div>