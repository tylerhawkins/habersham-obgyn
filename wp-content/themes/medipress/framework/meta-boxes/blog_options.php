<div id="tb-blog-metabox" class='tb_metabox' style="display: none;">
	<div id="tb-tab-blog" class='categorydiv'>
		<ul class='category-tabs'>
			<li class='tb-tab'><a href="#tabs-layout"><i class="dashicons dashicons-admin-settings"></i> <?php echo _e('Layout','medipress');?></a></li>
		   <li class='tb-tab'><a href="#tabs-header"><i class="dashicons dashicons-admin-settings"></i> <?php echo _e('Header','medipress');?></a></li>
			<li class='tb-tab'><a href="#tabs-footer"><i class="dashicons dashicons-admin-settings"></i> <?php echo _e('Footer','medipress');?></a></li>
		</ul>
		<div class='tb-tabs-panel'>
			<div id="tabs-layout">
				<p class="tb_layout tb-title-mb"><i class="dashicons dashicons-menu"></i><?php echo _e('Layout Setting','medipress'); ?></p>
				<?php
					$layout = array('no' => 'No', 'yes' => 'Yes');
					$this->select('layout',
							'Layout Boxed',
							$layout,
							'',
							''
					);
				?>
			</div>
			<div id="tabs-header">
				<p class="tb_header tb-title-mb"><i class="dashicons dashicons-menu"></i><?php echo _e('Header Setting','medipress'); ?></p>
				<?php
					$headers = array('global' => 'Global', 'header-v1' => 'Header V1','header-v2' => 'Header V2','header-v3' => 'Header V3');
					$this->select('header',
							'Header',
							$headers,
							'',
							''
					);
				?>
			</div>
			<div id="tabs-footer">
				<p class="tb_footer tb-title-mb"><i class="dashicons dashicons-menu"></i><?php echo _e('Footer Setting','medipress'); ?></p>
				<?php
					$footers = array('global' => 'Global', 'footer-v1' => 'Footer V1','footer-v2' => 'Footer V2','footer-v3' => 'Footer V3');
					$this->select('footer',
							'Footer',
							$footers,
							'',
							''
					);
				?>
			</div>
		</div>
	</div>
</div>