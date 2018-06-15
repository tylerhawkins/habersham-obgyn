<div class="container rop-user-orders">
	<?php if (!empty($user_id)){?>
			<table>
				<thead>
					<tr>
						<th><?php esc_html_e( 'ID', ROP_NAME );?></th>
						<th><?php esc_html_e( 'Name', ROP_NAME );?></th>
						<th><?php esc_html_e( 'Start Date', ROP_NAME );?></th>
						<th>
							<a class="<?php esc_attr_e($order);?>" href="<?php echo esc_url(add_query_arg( $query_arg , get_permalink()));?>">
								<?php esc_html_e( 'End Date ', ROP_NAME );
								echo $icon;?>
							</a>
						</th>
						<th><?php esc_html_e( 'Price', ROP_NAME );?></th>
						<th><?php esc_html_e( 'Status', ROP_NAME );?></th>
						<th><?php esc_html_e( 'Active', ROP_NAME );?></th>
					</tr>
				</thead>
				<tbody>
					<?php if ( count($orders['orders'])>0 ):
						foreach($orders['orders'] AS $order) :?>
							<tr>
								<td><?php esc_attr_e($order->id);?></td>
								<td><?php echo (!empty($order->post_title))?esc_attr($order->post_title):esc_attr($order->name);?></td>
								<td><?php esc_attr_e(rop_date( $order->start_date ));?></td>
								<td><?php esc_attr_e(rop_date( $order->end_date ));?></td>
								<td><?php print_r(rop_price($order->price));?></td>
								<td><?php esc_attr_e($order->status);?></td>
								<td><?php if(empty($db->check_expiration($user_id,$order->post_id))):?>
										<div class="ro-button-wraper template-ro_button">
											<button class="rop-pricing-button ro-button btn-primary" data-post-pricing="<?php echo $order->post_id;?>">
											<?php esc_html_e( 'Re-orders', ROP_NAME ); ?>
											</button>
										</div>
									<?php endif;?>
								</td>
							</tr>
				<?php	endforeach;
					else:?>
						<tr>
							<td colspan="9"><?php esc_html_e( 'No items.', ROP_NAME );?></td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
			<?php printf($orders['pagination']);?>
	<?php }else{
		echo '<a href="'.wp_login_url( get_permalink() ).'">'.esc_html('Login', ROP_NAME).'</a>'.esc_html( ' before payment, please!  ', ROP_NAME );
	}?>
</div>
