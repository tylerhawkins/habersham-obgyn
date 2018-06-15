<?php if(count($orders['orders']) > 0):?>
	<ul>
		<li>
			<label><?php esc_html_e('Title : ',ROP_NAME);?></label>
			<span><?php (isset($orders['orders'][0]->name))?esc_attr_e($orders['orders'][0]->name):'';?></span>
		</li>
		<li>
			<label><?php esc_html_e('Start Date : ',ROP_NAME);?></label>
			<span><?php (isset($orders['orders'][0]->start_date))?esc_attr_e(rop_date($orders['orders'][0]->start_date)):'';?></span>
		</li>
		<li>
			<label><?php esc_html_e('End Date : ',ROP_NAME);?></label>
			<span><?php (isset($orders['orders'][0]->end_date))?esc_attr_e(rop_date($orders['orders'][0]->end_date)):'';?></span>
		</li>
		<li>
			<label><?php esc_html_e('Price : ',ROP_NAME);?></label>
			<span><?php (isset($orders['orders'][0]->end_date))?print_r(rop_price($orders['orders'][0]->price)):'';?></span>
		</li>
		<?php if(isset($orders['orders'][0]->token)){?>
		<li>
			<label><?php esc_html_e('Token : ',ROP_NAME);?></label>
			<span><?php esc_attr_e($orders['orders'][0]->token);?></span>
		</li>
		<?php }?>
		<li>
			<label><?php esc_html_e('Status: ',ROP_NAME);?></label>
			<span><?php (isset($orders['orders'][0]->status))?esc_attr_e($orders['orders'][0]->status):'';?></span>
		</li>
	</ul>
<?php endif;?>
