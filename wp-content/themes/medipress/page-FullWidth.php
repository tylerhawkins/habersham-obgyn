<?php
/*
Template Name: Content Fullwidth Template
*/
?>
<?php tb_layout($post->ID); ?>
<?php get_header(); ?>
<?php
global $tb_options;
$tb_show_page_title = isset($tb_options['tb_page_show_page_title']) ? $tb_options['tb_page_show_page_title'] : 1;
$tb_show_page_breadcrumb = isset($tb_options['tb_page_show_page_breadcrumb']) ? $tb_options['tb_page_show_page_breadcrumb'] : 1;
ro_theme_title_bar($tb_show_page_title, $tb_show_page_breadcrumb);

$tb_show_page_comment = (int) isset($tb_options['tb_page_show_page_comment']) ?  $tb_options['tb_page_show_page_comment']: 1;
?>
	<div class="main-content container-fluid">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>
			<div class="clear"></div>
			<?php if($tb_show_page_comment){ ?>
				
					<?php if ( comments_open() || get_comments_number() ) comments_template(); ?>
				
			<?php } ?>

		<?php endwhile; // end of the loop. ?>
	</div>
<?php get_footer(); ?>