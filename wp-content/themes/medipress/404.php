<?php
/*
Template Name: 404 Template
*/
?>
<?php wp_head(); ?>
<body>
	<div class="main-content ro-page-404" style="background-image: url('<?php echo get_template_directory_uri() . '/assets/images/medipress-bg-404.jpg'; ?>')">
		<div class="container">
			<div class="error404-wrap">
				<h1 class="error-code"><?php _e('Oops ','medipress');?><span><?php _e('404','medipress');?></span><?php _e(' Page !','medipress');?></h1>
				<p class="error-message">
					<?php _e('It\'s looking like you may have taken a wrong turn.Don\'t worry...it happens to the best of us.','medipress');?>
				</p>
				<p class="link-go-home">
					<a title="<?php _e('Back to home','medipress');?>" href="<?php echo esc_url( home_url( '/'  ) );?>"><?php _e('Back to home','medipress');?><i class="fa fa-angle-right"></i></a>
				</p>
			</div>
		</div>
	</div>
</body>