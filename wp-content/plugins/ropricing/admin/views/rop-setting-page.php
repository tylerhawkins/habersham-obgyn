<?php

if( ! defined( 'ABSPATH' ) ) exit;
?>

<div id="viewWrapper" class="view_wrapper">
	<div class="wrap">
	<form method="post" action="">
		<div class="ro-container">
			<div class="ro-container-inner rop-header-title">
				<h3 class="rop-title"><?php esc_html_e( 'Ro Pricing Settings', ROP_NAME ) ?></h3>
			</div>
		</div>

			<div class="rop-container-setting">
				<div class="rop-header-tabs" data-ro-tab>
					<?php
					foreach ($setting_fields as $key => $value) {
						$current_tab = ($key == 0) ? 'current' : '';

						echo <<<HEADERTAB
						<a class="ro-header-tab {$current_tab}" data-ro-tab-id="#{$value['id']}" href="#{$value['id']}">{$value['group_name']}</a>
HEADERTAB;
					}
					?>
				</div>
				<div class="rop-body-tabs">
					<?php
					$Ro_html = new Ro_html();
					$template = <<<FIELDTEMPLATE
					<div class="ro-group-field">
						<label for="[name]">[title]</label>
						<div class="ro-field">
							[field]
							<div class="ro-field-des">[des]</div>
						</div>
					</div>
FIELDTEMPLATE;
					$Ro_html->template = $template;

					foreach ($setting_fields as $key => $value) {
						$current_tab = ($key == 0) ? 'current' : '';
						$fields = $value['fields'];
						$content = array();

						if( isset( $fields ) && count( $fields ) > 0 ) {
							foreach( $fields as $field ) {
								if(!empty($data) && (isset($data[$field['name']]))){
									$field['value'] = $data[$field['name']];
								}
								array_push( $content, $Ro_html->form_field( $field ) );
							}
						}

						$content = implode( '', $content );

						echo <<<BODYTAB
						<div class="ro-body-tab {$current_tab}" id="{$value['id']}">
							<div class="ro-container">
								<div class="ro-container-inner">
									{$content}
								</div>
							</div>
						</div>
BODYTAB;
					}?>
				</div>
			</div>
			<div class="rop-content-btn ro-text-right">
				<?php submit_button( __( 'Save Changes' ), 'primary', 'Update' ); ?>
			</div>
		</form>
	</div>
</div>
