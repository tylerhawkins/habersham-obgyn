<div id="tb_pricing_metabox" class='tb-pricing-metabox'>
	<?php
	$this->text('pricing_price',
			'Price',
			'',
			''
	);
	$this->select('pricing_type',
			'Type',
			array(
					'weekly' 	=> 'Weekly',
					'monthly' 	=> 'Monthly',
					'three' 	=> '3 Monthly',
					'six' 	=> '6 Monthly',
					'yearly'    => 'Yearly',
			),
			'',
			''
	);
	$this->text('pricing_button',
			'Button Text',
			'',
			''
	);
	$this->select('pricing_featured',
			'Set Featured',
			array(
					'no' 	=> 'No',
					'yes' 	=> 'Yes',
			),
			'',
			''
	);
	$this->textarea('pricing_description',
			'Description',
			'',
			''
	);
	?>
</div>