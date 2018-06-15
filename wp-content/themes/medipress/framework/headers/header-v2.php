<?php
	global $tb_options;
	$cl_stick = $tb_options['tb_stick_header'] ? 'ro-menu-stick': '';
?>
<!-- Start Header -->
<header>
	<div class="ro-header-v2">
		
		<div class="ro-section-top hidden-xs hidden-sm">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php if (is_active_sidebar("tbtheme-header-top-sidebar")) { dynamic_sidebar("Header Top Sidebar"); } ?>
					</div>
				</div>
			</div>
		</div>
		
		<div class="ro-section-logo">
			<div class="container">
				<div class="row">
					<div class="col-md-2 ro-logo">
						<a href="<?php echo esc_url(home_url()); ?>">
							<?php ro_theme_logo(); ?>
						</a>
					</div>
					<div class="col-md-10 ro-infomation hidden-xs hidden-sm">
						<?php if (is_active_sidebar("tbtheme-header-2-sidebar")) { dynamic_sidebar("Header 2 Sidebar"); } ?>
					</div>
				</div>
				<div id="ro-hamburger" class="ro-hamburger visible-xs visible-sm"><i class="icon icon-menu"></i></div>
			</div>
		</div>
		
		<div class="ro-section-menu">
			<div class="<?php echo esc_attr($cl_stick); ?>">
				<div class="container">	
					<div class="row">
						<div class="col-md-12">
							<?php
							$manage_location = $tb_options['tb_manage_location'];
							$arr = array(
								'theme_location' => $manage_location,
								'menu_id' => 'nav',
								'menu' => '',
								'container_class' => 'ro-menu-list ro-menu-sidebar-active hidden-xs hidden-sm',
								'echo'            => true,
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth'           => 0,
							);
							if ($manage_location) {
								wp_nav_menu( $arr );
							} else { ?>
							<div class="menu-list-default">
								<?php wp_page_menu();?>
							</div>    
							<?php } ?>
							
							<div class="ro-menu-sidebar hidden-xs hidden-sm">
								<?php
									if (is_active_sidebar("tbtheme-search-on-menu-sidebar")) echo '<a id="ro-search-form" href="javascript:void(0)"><i class="fa fa-search"></i></a>';
									if (is_active_sidebar("tbtheme-menu-canvas-sidebar")) echo '<a id="ro-canvas-menu" href="javascript:void(0)"><i class="icon icon-menu"></i></a>';
								?>
							</div>
							<div class="ro-button-sidebar hidden-xs hidden-sm">
								<?php if (is_active_sidebar("tbtheme-header-2-sidebar-navigation")) { dynamic_sidebar("Header 2 Sidebar Navigation"); } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			if (is_active_sidebar("tbtheme-search-on-menu-sidebar")) {
				echo '<div id="ro-search-form-popup" class="ro-search-form hidden-xs hidden-sm"><div class="container"><div class="btn-search-close"><span class="btn-close"></span></div>';
					dynamic_sidebar("Search On Menu Sidebar"); 
				echo '</div></div>';
			}
		?>
	</div>
</header>
<!-- End Header -->