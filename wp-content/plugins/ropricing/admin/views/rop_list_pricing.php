<?php
if( ! defined( 'ABSPATH' ) ) exit;
$date = isset( $_GET['date'] ) ? $_GET['date'] : '';
/*create link*/
$query_arg = array( 'page' => 'rop-orders' );
$query_arg['orderby'] = 'end_date';
$order = (isset($_GET['order'])&&($_GET['order']=='asc')) ?'desc':'asc';
$query_arg['order'] = $order;
(!empty($date)) ? $query_arg['date'] = $date : '';
isset( $_GET['paged'] ) ? $query_arg['paged'] = $_GET['paged'] : '';
$icon = (isset($_GET['order'])&&($_GET['order']=='asc')) ?'<i class="fa fa-caret-up"></i>':'<i class="fa fa-caret-down"></i>';
?>

<div id="viewWrapper" class="view_wrapper">
	<div class="wrap">
		<div class="ro-container">
			<div class="ro-container-inner rop-header-title">
				<h3 class="rop-title"><?php esc_html_e( 'List Orders', ROP_NAME ) ?></h3>
			</div>
		</div>
		<form method="POST" action="<?php echo esc_url(admin_url( 'admin-ajax.php?action=rop_del_order' ));?>" class="rop-form form-inline">
			<div id="posts-filter">
				<div class="wp-filter">
					<div class="filter-items">
						<input id="orders-filter-date" name="orders-filter-date" value="<?php esc_attr_e($date);?>" placeholder="<?php esc_html_e( 'All Date ', ROP_NAME ) ?>"/>
						<input class="button orders-filter-button" type="button" value="<?php esc_html_e( 'Filter', ROP_NAME ) ?>"/>
					</div>
					<div class="orders-delete-item">
						<input class="rop-btn rop-btn-primary rop-primary-active" type="submit" value="<?php esc_html_e( 'Delete', ROP_NAME ) ?>"/>
					</div>
				</div>
			</div>

			<div class="ro-container rop-groups-container">
				<div class="rop-groups-container-inner">
					<table class="wp-list-table widefat fixed striped rop-orders">
						<thead>
							<tr>
								<th><?php esc_html_e( 'Name', ROP_NAME );?></th>
								<th><?php esc_html_e( 'User', ROP_NAME );?></th>
								<th><?php esc_html_e( 'Date', ROP_NAME );?></th>
								<th><?php esc_html_e( 'Start Date', ROP_NAME );?></th>
								<th>
									<a class="<?php esc_attr_e($order);?>" href="<?php echo esc_url(add_query_arg( $query_arg , admin_url('admin.php')));?>">
										<?php esc_html_e( 'End Date ', ROP_NAME );
										echo $icon;?>
									</a>
								</th>
								<th><?php esc_html_e( 'Price', ROP_NAME );?></th>
								<th><?php esc_html_e( 'Token', ROP_NAME );?></th>
								<th><?php esc_html_e( 'Status', ROP_NAME );?></th>
								<th><?php esc_html_e( 'ID', ROP_NAME );?></th>
								<th class="check-item"><input id="order-checkAll" type="checkbox" value="" /></th>
							</tr>
						</thead>
						<tbody id="the-list">
							<?php if ( count($list['orders'])>0 ):
								foreach($list['orders'] AS $order) :?>
									<tr>
										<td><?php echo (!empty($order->post_title))?esc_attr($order->post_title):esc_attr($order->name);?></td>
										<td><?php echo (!empty($order->user_id))?get_user_by('id',$order->user_id)->data->display_name:'';?></td>
										<td><?php esc_attr_e(rop_date( $order->date ));?></td>
										<td><?php esc_attr_e(rop_date( $order->start_date ));?></td>
										<td><?php esc_attr_e(rop_date( $order->end_date ));?></td>
										<td><?php print_r(rop_price($order->price));?></td>
										<td><?php esc_attr_e($order->token);?></td>
										<td><?php esc_attr_e($order->status);?></td>
										<td><?php esc_attr_e($order->id);?></td>
										<td class="check-item"><input type="checkbox" value="<?php esc_attr_e($order->id);?>" name="order[]" /></td>
									</tr>
						<?php	endforeach;
							else:?>
								<tr>
									<td colspan="9"><?php esc_html_e( 'No items.', ROP_NAME );?></td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
				<?php printf($list['pagination']);?>
			</div>
		</form>
	</div>
</div>
<!-- modal -->
<div id="rop-modal-general" class="ro-modal ro-modal-wrapper">
	<div id="rop-modal-content" class="ro-modal-inner rop-orders-items">
		<!-- Layout ajax -->
	</div>
</div>
<!-- end modal -->
