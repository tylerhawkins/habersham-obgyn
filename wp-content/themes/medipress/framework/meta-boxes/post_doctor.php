<div id="tb_doctor_metabox" class='tb-doctor-metabox'>
	<?php
	$this->text('doctor_qualifications',
			'Qualifications',
			'',
			__('Enter qualifications in this post.','medipress')
	);
    $this->text('appoitment_link',
			'Appointment Link',
			'',
			__('Enter appointment link in this post.','medipress')
	);
	$this->upload('doctor_extra_img', 
			'Extra Image',
			__('Choose extra image in this post.','medipress')
			);
	$this->textarea('doctor_working',
			'Working Hour',
			'',
			__('Enter working hour in this post.','medipress')
	);
	?>
</div>
