<?php

if( ! defined('ABSPATH') ) exit;

if( ! class_exists( 'Ro_html' ) ) {
	class Ro_html{
		public $template = '';

		function __construct() {

		}

		/**
		* form_field
		* @param array $params
		*/
		function form_field( $params ) {
			if( ! $params ) return;
			$field = array();
			$result = '';
			$attributes = '';

			extract( $params );

			$_attrs = array(
				'type' 		=>	$type,
				'name'		=> 	( isset( $name ) ) ? $name : '',
				'id'		=> 	( isset( $id ) ) ? $id : $name,
				'value'		=> 	( isset( $value ) ) ? $value : '',
				'style'		=>  ( isset( $css ) ) ? $css : '',
				'class'		=>  ( isset( $class ) ) ? $class : '',
				'label'		=>  ( isset( $label ) ) ? $label : '',
				'custom_attributes'		=> ( isset( $custom_attributes ) ) ? $custom_attributes : '',
			);

			if( isset( $attrs ) && count( $attrs ) > 0 )
				array_merge($_attrs, $attrs);

			$field_attrs = $this->make_attrs( $_attrs );

			switch ( $type ) {
				case 'select':
					$_options = array();
					$selected = '';
					foreach( $options as $k => $v ) {
						if( isset( $value ) ) $selected = ( $k === $value ) ? 'selected' : '';

						array_push( $_options, '<option value=\''. $k .'\' '. $selected .'>'. $v .'</option>');
					}
					unset( $params['options'] );
					array_push( $field, '<select '. implode( ' ', $field_attrs ) .' >' . implode( '', $_options ) .'</select>' );
					break;

				case 'textarea':
					array_push( $field, '<textarea '. implode( ' ', $field_attrs ) .'>'. $value .'</textarea>' );
					break;

				case 'radio':
					$_options = array();
					unset( $field_attrs['id'] );
					$checked = '';
					foreach( $options as $k => $v ) {
						$field_attrs['value'] = 'value=\''. $k .'\'';
						if( isset( $value ) ) $checked = ( $k == $value ) ? 'checked' : '';

						array_push( $_options, '<label><input '. implode( ' ', $field_attrs ) .' '. $checked .' /> '. $v .'</label>' );
					}
					unset( $params['options'] );
					array_push( $field, implode( ' ', $_options ) );
					break;

				case 'checkbox':
					if( $value == 1 || $value == true )
						array_push( $field_attrs, 'checked' );

					array_push( $field, '<input '. implode( ' ', $field_attrs ) .' /> '.$label );
					break;

				case 'editor':
					$quicktags_settings = array( 'buttons' => 'strong,em,link,block,del,ins,img,ul,ol,li,code,close' );
					$settings = array(
						'quicktags' => $quicktags_settings,
						'tinymce' => true,
						'textarea_rows' => 20,
						'editor_height' => 200,
						'textarea_name' => $_attrs['name'],
					);

					ob_start();
						wp_editor( stripslashes($value), $_attrs['id'], $settings);
					$editor = ob_get_clean();
					array_push( $field, $editor );

					break;
				// Single page selects
				case 'single_select_page' :
					$_attrs['sort_column'] 	= 'menu_order';
					$_attrs['sort_order'] 	= 'ASC';
					$_attrs['echo'] 		= 0;
					$_attrs['selected'] 		= (isset( $value ))?$value:get_option( $_attrs['id'] );
					array_push( $field,  str_replace(' id=', " data-placeholder='" . esc_attr__( 'Select a page&hellip;', ROP_NAME ) .  "' style='" . $css . "' class='" . $class . "' id=", wp_dropdown_pages( $_attrs ) ) );
					break;

				case 'label':
					array_push( $field, '' );
					break;
				case 'number':

				default:
					$label = ( isset( $label ) ) ? $label : '';
					array_push( $field, '<input '. implode( ' ', $field_attrs ) .' />'.$label );
					break;
			}

			$result = implode( '', $field );

			if( ! empty( $this->template ) ) {
				unset( $params['attrs'] );
				$replace_arr = array( '[field]' => $result );

				foreach( $params as $k => $v )
					$replace_arr['['. $k .']'] = $v;

				if($type=='label'){
					$template = '
							<div class="ro-group-field">
								<h3>[title]</h3>
							</div>';
					$result = str_replace( array_keys( $replace_arr ), array_values( $replace_arr ), $template );
				}else{
					$result = str_replace( array_keys( $replace_arr ), array_values( $replace_arr ), $this->template );
				}
			}

			return $result;
		}

		function make_attrs( $data_arr ) {
			$attrs_arr = array();

			if( $data_arr && count( $data_arr ) > 0 ) {
				foreach( $data_arr as $k => $v ) {
					if($k == 'custom_attributes'){
						$attrs_arr[$k] = $v;
					}else{
						$attrs_arr[$k] = "$k='{$v}'";
					}
				}
			}

			return $attrs_arr;
		}

	}
}
?>
