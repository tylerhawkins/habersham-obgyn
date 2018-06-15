<div class="container rop-checkout">
    <?php if($post):?>
        <div class="table-responsive">
            <table class="table ro-pricing-table">
                <thead>
                    <tr>
                        <th class="pricing-table-name"><?php esc_html_e('Package',ROP_NAME);?></th>
                        <th class="pricing-table-start"><?php esc_html_e('Start Date',ROP_NAME);?></th>
                        <th class="pricing-table-end"><?php esc_html_e('End Date',ROP_NAME);?></th>
                        <th class="pricing-table-price"><?php esc_html_e('Price',ROP_NAME);?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="ro-pricing-cart">
                        <td class="pricing-table-name"><?php (isset($post->post_title))?esc_attr_e($post->post_title):'';?></td>
                        <td class="pricing-table-start"><?php esc_attr_e(rop_date(date('Y-m-d H:i:s')));?></td>
                        <td class="pricing-table-end"><?php (isset($end_date))?esc_attr_e(rop_date($end_date)):'';?></td>
						<td class="pricing-table-price"><?php print_r(rop_price($price));?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php else:?>
        <div class="ro-pricing-no-item"><?php esc_html_e('No item to checkout.',ROP_NAME);?></div>
    <?php endif;?>
	<?php if($post):?>
        <div class="ro-pricing-cart-detail">
            <div class="ro-pricing-total">
                <h4><?php echo esc_html_e('Cart Totals',ROP_NAME);?></h4>
                <div class="total">
                    <label><?php esc_html_e('Total : ',ROP_NAME);?></label>
                    <?php print_r(rop_price($price));?>
                </div>
                <div class="payment">
                    <?php esc_html_e('Checkout with Paypal',ROP_NAME);?>
                </div>
                <div class="ro-button-wraper">
                    <button class="ro-button <?php echo (empty($class))?'disable':'';?>" <?php echo $class;?>>
                        <?php esc_html_e( 'Process Checkout', ROP_NAME ); ?>
                    </button>
                </div>
            </div>
        </div>
	<?php endif;?>
</div>
