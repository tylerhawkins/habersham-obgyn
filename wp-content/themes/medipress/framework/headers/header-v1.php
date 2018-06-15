<?php
	global $tb_options;
	$cl_stick = $tb_options['tb_stick_header'] ? 'ro-header-stick': '';
?>
<!-- Start Header -->
<header>
	<div class="ro-header-v1 <?php echo esc_attr($cl_stick); ?>">
		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<a class="ro-logo" href="<?php echo esc_url(home_url()); ?>">
						<?php ro_theme_logo(); ?>
					</a>
					<div id="ro-hamburger" class="ro-hamburger visible-xs visible-sm"><i class="icon icon-menu"></i></div>
				</div>
				<div class="col-md-10 ro-header-right">
					<?php
					$manage_location = $tb_options['tb_manage_location'];
					$arr = array(
						'theme_location' => $manage_location,
						'menu_id' => 'nav',
						'menu' => '',
						'container_class' => 'ro-menu-list ro-menu-sidebar-active hidden-xs hidden-sm',
						'menu_class'      => 'text-right',
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
						?>
					</div>
					<div class="ro-social-sidebar hidden-xs hidden-sm">
						<?php if (is_active_sidebar("tbtheme-header-1-sidebar-navigation")) { dynamic_sidebar("Header 1 Sidebar Navigation"); } ?>
					</div>
				</div>
				<?php
					if (is_active_sidebar("tbtheme-search-on-menu-sidebar")) {
						echo '<div id="ro-search-form-popup" class="ro-search-form hidden-xs hidden-sm"><div class="search-overlay"></div><div class="container"><div class="btn-search-close"><span class="btn-close"></span></div>';
							dynamic_sidebar("Search On Menu Sidebar"); 
						echo '</div></div>';
					}
				?>
			</div>
		</div>
	</div>
</header>
<!-- End Header -->