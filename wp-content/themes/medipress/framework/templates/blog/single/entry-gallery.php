<?php
global $tb_options;
$tb_post_show_post_image = (int) isset($tb_options['tb_post_show_post_image']) ? $tb_options['tb_post_show_post_image'] : 1;
$tb_post_show_post_title = (int) isset($tb_options['tb_post_show_post_title']) ? $tb_options['tb_post_show_post_title'] : 1;
$tb_post_show_post_meta = (int) isset($tb_options['tb_post_show_post_meta']) ? $tb_options['tb_post_show_post_meta'] : 1;
$tb_post_show_post_desc = (int) isset($tb_options['tb_post_show_post_desc']) ? $tb_options['tb_post_show_post_desc'] : 1;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="ro-blog-sub-article">
		<?php if ( has_post_thumbnail() && $tb_post_show_post_image ) { ?>
			<?php the_post_thumbnail('full'); ?>
		<?php } ?>
		<div class="wp-post-media">
			<?php
			$date = time() . '_' . uniqid(true);
			$gallery_ids = ro_theme_grab_ids_from_gallery()->ids;
			if ( !empty($gallery_ids) ) {
			?>
				<div id="carousel-generic<?php echo esc_attr( $date ); ?>" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<?php
							$i = 0;
							foreach ($gallery_ids as $image_id){
								$attachment_image = wp_get_attachment_image_src($image_id, 'full', false);
								if($attachment_image[0]){
									?>
									<div class="item tb-blog-gallery <?php echo ($i==0)?'active':''; ?>">
										<img class="width_100"> src="<?php echo esc_url($attachment_image[0]);?>" alt="" />
									</div>
									<?php
									$i++;
								}
							}
						?>
					</div>
					<a class="left carousel-control" href="#carousel-generic<?php echo esc_attr( $date ); ?>" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left ion-ios7-arrow-left"></span>
					</a>
					<a class="right carousel-control" href="#carousel-generic<?php echo esc_attr( $date ); ?>" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right ion-ios7-arrow-right"></span>
					</a>
				</div>
			<?php } ?>
		</div>
		<?php if ( $tb_post_show_post_title ) { ?>
			<h4 class="ro-uppercase"><?php the_title(); ?></h4>
		<?php } ?>
		<?php if ( $tb_post_show_post_meta ) { ?>
			<div class="ro-blog-meta">
				<?php if ( is_sticky() ) { ?>
					<span class="publish"><?php _e('<i class="fa fa-thumb-tack"></i> Sticky', 'medipress'); ?></span>
				<?php } ?>
				<span class="publish"><?php _e('<i class="fa fa-clock-o"></i> ', 'medipress'); echo get_the_date(); ?></span>
				<span class="author"><?php _e('<i class="fa fa-user"></i> ', 'medipress'); echo get_the_author(); ?></span>
				<span class="categories"><?php the_terms(get_the_ID(), 'category', __('<i class="fa fa-folder-open"></i> ', 'medipress') , ', ' ); ?></span>
				<span class="tags"><?php the_tags( __('<i class="fa fa-tags"></i> ', 'medipress'), ', ', '' ); ?> </span>
			</div>
		<?php } ?>
		<?php if ( $tb_post_show_post_desc ) { ?> 
			<div class="ro-sub-content clearfix">
				<?php
					the_content();
					wp_link_pages(array(
						'before' => '<div class="page-links">' . __('Pages:', 'medipress'),
						'after' => '</div>',
					));
				?>
			</div>
		<?php } ?>
	</div>
</article>
