<?php
class TM_EPO_FIELDS_color extends TM_EPO_FIELDS {

	public function display_field( $element=array(), $args=array() ) {
		return array(
				'textbeforeprice' 	=> isset( $element['text_before_price'] )?$element['text_before_price']:"",
				'textafterprice' 	=> isset( $element['text_after_price'] )?$element['text_after_price']:"",
				'hide_amount'  		=> isset( $element['hide_amount'] )?" ".$element['hide_amount']:"",
				'default_value'  	=> isset( $element['default_value'] )?esc_attr(  $element['default_value']  ):'',
				'quantity' 			=> isset( $element['quantity'] )?$element['quantity']:"",
			);
	}

	public function validate() {

		$passed = true;
		$message = array();
		
		if($this->element['required']){
			foreach ( $this->field_names as $attribute ) {
				if ( !isset( $this->epo_post_fields[$attribute] ) ||  $this->epo_post_fields[$attribute]=="" ) {
					$passed = false;
					$message[] = 'required';
					break;
				}										
			}
		}

		return array('passed'=>$passed,'message'=>$message);
	}
	
}