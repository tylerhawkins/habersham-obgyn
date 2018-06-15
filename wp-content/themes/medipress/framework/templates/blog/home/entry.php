<?php
global $tb_options;
$tb_blog_show_post_image = (int) isset($tb_options['tb_blog_show_post_image']) ? $tb_options['tb_blog_show_post_image'] : 1;
$tb_blog_show_post_title = (int) isset($tb_options['tb_blog_show_post_title']) ? $tb_options['tb_blog_show_post_title'] : 1;
$tb_blog_show_post_meta = (int) isset($tb_options['tb_blog_show_post_meta']) ? $tb_options['tb_blog_show_post_meta'] : 1;
$tb_blog_show_post_excerpt = (int) isset($tb_options['tb_blog_show_post_excerpt']) ? $tb_options['tb_blog_show_post_excerpt'] : 1;
$tb_blog_post_readmore_text = (int) isset($tb_options['tb_blog_post_readmore_text']) ? $tb_options['tb_blog_post_readmore_text'] : 'Read more';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="ro-blog-sub-article">
		<div class="ro-blog-media">
			<?php if ( has_post_thumbnail() && $tb_blog_show_post_image ) { ?>
				<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('medipress-blog-thumbnail'); ?></a>
				<div class="publish">
					<span class="date"><?php echo get_the_date('d'); ?></span>
					<span class="month"><?php echo get_the_date('M'); ?></span>
				</div>
			<?php } ?>
		</div>
		<?php if ( $tb_blog_show_post_title ) { ?>
			<h4 class="ro-uppercase"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
		<?php } ?>
		<?php if ( $tb_blog_show_post_meta ) { ?>
			<div class="ro-blog-meta">
				<?php if ( is_sticky() ) { ?>
					<span class="publish"><?php _e('<i class="fa fa-thumb-tack"></i> Sticky', 'medipress'); ?></span>
				<?php } ?>
				<span class="author"><?php esc_html_e('Post by ', 'medipress'); echo '<span class="auhtor-name">' .get_the_author() .'</span>'; ?></span>
				<span class="comment-count"><a href="<?php the_permalink(); ?>#comment"><?php echo comments_number('0','1','%'); ?></a><?php echo esc_html__(' Comments', 'medipress'); ?></span>
			</div>
		<?php } ?>
		<?php if ( $tb_blog_show_post_excerpt ) { ?> 
			<div class="ro-sub-content clearfix">
				<?php
					echo ro_custom_excerpt(100, ''); 
					echo '<a class="ro-readmore-btn" href="'.get_the_permalink().'">Read more</a>';
					wp_link_pages(array(
						'before' => '<div class="page-links">' . __('Pages:', 'medipress'),
						'after' => '</div>',
					));
				?>
			</div>
		<?php } ?>
	</div>
</article>