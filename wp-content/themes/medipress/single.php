<?php get_header(); ?>
<?php
global $tb_options;
$tb_show_page_title = isset($tb_options['tb_post_show_page_title']) ? $tb_options['tb_post_show_page_title'] : 1;
$tb_show_page_breadcrumb = isset($tb_options['tb_post_show_page_breadcrumb']) ? $tb_options['tb_post_show_page_breadcrumb'] : 1;
$tb_post_show_post_nav = (int) isset($tb_options['tb_post_show_post_nav']) ?  $tb_options['tb_post_show_post_nav']: 0;
ro_theme_title_bar($tb_show_page_title, $tb_show_page_breadcrumb);

$tb_post_show_post_tags = (int) isset($tb_options['tb_post_show_post_tags']) ? $tb_options['tb_post_show_post_tags'] : 1;
$tb_post_show_post_author = (int) isset($tb_options['tb_post_show_post_author']) ? $tb_options['tb_post_show_post_author'] : 1;
$tb_post_show_post_comment = (int) isset($tb_options['tb_post_show_post_comment']) ?  $tb_options['tb_post_show_post_comment']: 1;
?>
	<div class="main-content ro-blog-sub-article-container-3">
		<div class="container">
			<div class="row">
				<?php
				$tb_blog_layout = isset($tb_options['tb_post_layout']) ? $tb_options['tb_post_layout'] : '2cr';
				$sb_left = isset($tb_options['tb_post_left_sidebar']) ? $tb_options['tb_post_left_sidebar'] : 'Main Sidebar';
				$cl_sb_left = isset($tb_options['tb_post_left_sidebar_col']) ? $tb_options['tb_post_left_sidebar_col'] : 'col-xs-12 col-sm-4 col-md-4 col-lg-4';
				$cl_content = isset($tb_options['tb_post_content_col']) ? $tb_options['tb_post_content_col'] : ( is_active_sidebar('tbtheme-main-sidebar') ? 'col-xs-12 col-sm-8 col-md-8 col-lg-8' : 'col-xs-12 col-sm-12 col-md-12 col-lg-12' );
				if ( !is_active_sidebar('tbtheme-main-sidebar') && !is_active_sidebar('tbtheme-left-sidebar') && !is_active_sidebar('tbtheme-left-sidebar') ) {
					$cl_content = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
				}
				$sb_right = isset($tb_options['tb_post_right_sidebar']) ? $tb_options['tb_post_right_sidebar'] : 'Main Sidebar';
				$cl_sb_right = isset($tb_options['tb_post_right_siedebar_col']) ? $tb_options['tb_post_right_siedebar_col'] : 'col-xs-12 col-sm-4 col-md-4 col-lg-4';
				?>
				<!-- Start Left Sidebar -->
				<?php if ( $tb_blog_layout == '2cl' ) { ?>
					<div class="<?php echo esc_attr($cl_sb_left) ?> sidebar-left">
						<?php if (is_active_sidebar('tbtheme-left-sidebar') || is_active_sidebar('tbtheme-main-sidebar')) { dynamic_sidebar($sb_left); } ?>
					</div>
				<?php } ?>
				<!-- End Left Sidebar -->
				<!-- Start Content -->
				<div class="<?php echo esc_attr($cl_content) ?> content tb-blog">
					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'framework/templates/blog/single/entry', get_post_format());
						echo '<div class="ro-bottom-blog">';
						if ( $tb_post_show_post_author ) { echo '<span class="auhtor-name">' .get_the_author() .'</span>'; }
					 	echo ro_theme_social_share_post_render();
					 	if ( $tb_post_show_post_tags ) { the_tags('<div class="ro-blog-tag clearfix ro-uppercase"><span class="ro-tag-title">Tags : </span><span>', '</span><span>', '</span></div>');}
						echo '</div>';
						if ( (comments_open() && $tb_post_show_post_comment) || (get_comments_number() && $tb_post_show_post_comment) ) comments_template();
					endwhile;
					?>
				</div>
				<!-- End Content -->
				<!-- Start Right Sidebar -->
				<?php if ( $tb_blog_layout == '2cr' ) { ?>
					<div class="<?php echo esc_attr($cl_sb_right) ?> sidebar-right">
						<?php if (is_active_sidebar('tbtheme-right-sidebar') || is_active_sidebar('tbtheme-main-sidebar')) { dynamic_sidebar($sb_right); } ?>
					</div>
				<?php } ?>
				<!-- End Right Sidebar -->
			</div>
		</div>
	</div>
<?php get_footer(); ?>