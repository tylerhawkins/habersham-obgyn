<?php global $tb_options; ?>
		<div class="top-ro-footer-2">
			<?php if (is_active_sidebar("tbtheme-footer-top-2")) { 
				dynamic_sidebar("Footer Top 2"); 
			} ?>
		</div>
		<footer id="footer" class="ro-footer">
			<!-- Start Footer Top -->
			<?php if($tb_options['tb_footer_top_2_column']){ ?>
			<div class="ro-footer-top-2">
				<div class="container">
					<div class="row same-height">
						<!-- Start Footer Sidebar Top 1 -->
						<?php if($tb_options['tb_footer_top_2_column']>=1){ ?>
							<div class="<?php echo esc_attr($tb_options['tb_footer_top_2_col1']); ?>">
								<?php if (is_active_sidebar("tbtheme-footer-top-2-widget")) { dynamic_sidebar("Footer Top 2 Widget 1"); } ?>
							</div>
						<?php } ?>
						<!-- End Footer Sidebar Top 1 -->
						<!-- Start Footer Sidebar Top 2 -->
						<?php if($tb_options['tb_footer_top_2_column']>=2){ ?>
							<div class="<?php echo esc_attr($tb_options['tb_footer_top_2_col2']); ?>">
								<?php if (is_active_sidebar("tbtheme-footer-top-2-widget-2")) { dynamic_sidebar("Footer Top 2 Widget 2"); } ?>
							</div>
						<?php } ?>
						<!-- End Footer Sidebar Top 2 -->
						<!-- Start Footer Sidebar Top 3 -->
						<?php if($tb_options['tb_footer_top_2_column']>=3){ ?>
							<div class="<?php echo esc_attr($tb_options['tb_footer_top_2_col3']); ?>">
								<?php if (is_active_sidebar("tbtheme-footer-top-2-widget-3")) { dynamic_sidebar("Footer Top 2 Widget 3"); } ?>
							</div>
						<?php } ?>
						<!-- End Footer Sidebar Top 3 -->
						<!-- Start Footer Sidebar Top 4 -->
						<?php if($tb_options['tb_footer_top_2_column']>=4){ ?>
							<div class="<?php echo esc_attr($tb_options['tb_footer_top_2_col4']); ?>">
								<?php if (is_active_sidebar("tbtheme-footer-top-2-widget-4")) { dynamic_sidebar("Footer Top 2 Widget 4"); } ?>
							</div>
						<?php } ?>
						<!-- End Footer Sidebar Top 4 -->
					</div>
				</div>
			</div>
			<?php } ?>
			<!-- End Footer Top -->
			<!-- Start Footer Bottom -->
			<?php if($tb_options['tb_footer_bottom_column']){ ?>
			<div class="ro-footer-bottom">
				<div class="container">
					<div class="row">
						<!-- Start Footer Sidebar Bottom Left -->
						<?php if($tb_options['tb_footer_bottom_column']>=1){ ?>
							<div class="<?php echo esc_attr($tb_options['tb_footer_bottom_col1']); ?>">
								<?php if (is_active_sidebar("tbtheme-footer-bottom-widget")) { dynamic_sidebar("Footer Bottom Widget 1"); } ?>
							</div>
						<?php } ?>
						<!-- Start Footer Sidebar Bottom Left -->
						<!-- Start Footer Sidebar Bottom Right -->
						<?php if($tb_options['tb_footer_bottom_column']>=2){ ?>
							<div class="<?php echo esc_attr($tb_options['tb_footer_bottom_col2']); ?>">
								<?php if (is_active_sidebar("tbtheme-footer-bottom-widget-2")) { dynamic_sidebar("Footer Bottom Widget 2"); } ?>
							</div>
						<?php } ?>
						<!-- Start Footer Sidebar Bottom Right -->
					</div>
				</div>
			</div>
			<?php } ?>
			<!-- End Footer Bottom -->
		</footer>