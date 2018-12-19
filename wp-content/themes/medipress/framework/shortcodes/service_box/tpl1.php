<a href="<?php echo esc_url($ex_link); ?>">
	<div class="ro-service">
		<div class="ro-service-inner">
			<?php 
				if($icon) echo '<i class="'.esc_attr($icon).'"></i>';
				if($title) echo '<h5>'.esc_html($title).'</h5>';
				if($content) echo '<div class="ro-content">'.$content.'</div>';
			?>
		</div>
	</div>
</a>