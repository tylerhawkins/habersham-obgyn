<div class="container rop-thankyou">
	<?php
		ob_start();
			include( ROP_SHORTCODES . '/templates/ro_pricing_order.php' );
		echo ob_get_clean();
	?>
</div>
