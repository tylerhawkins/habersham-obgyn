<?php if($atts['post_id']){ ?>
<div class="ro-button-wraper">
	<button class="rop-pricing-button ro-button <?php echo (empty($class))?'disable':'';?>" <?php echo $class;?>>
	<?php echo ($atts['title'])?$atts['title']:esc_html( 'Buy now', ROP_NAME ); ?>
	</button>
</div>
<?php } ?>
