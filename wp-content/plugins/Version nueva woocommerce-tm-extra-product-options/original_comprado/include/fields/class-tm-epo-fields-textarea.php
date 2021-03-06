<?php
class TM_EPO_FIELDS_textarea extends TM_EPO_FIELDS {

	public function display_field( $element=array(), $args=array() ) {
		return array(
				'textbeforeprice' 	=> isset( $element['text_before_price'] )?$element['text_before_price']:"",
				'textafterprice' 	=> isset( $element['text_after_price'] )?$element['text_after_price']:"",
				'hide_amount'  		=> isset( $element['hide_amount'] )?" ".$element['hide_amount']:"",
				'placeholder'  		=> isset( $element['placeholder'] )?esc_attr(  $element['placeholder']  ):'',
				'min_chars'  		=> isset( $element['min_chars'] )?absint( $element['min_chars'] ):'',
				'max_chars'  		=> isset( $element['max_chars'] )?absint( $element['max_chars'] ):'',
				'default_value'  	=> isset( $element['default_value'] )?esc_attr(  $element['default_value']  ):'',
				'quantity' 			=> isset( $element['quantity'] )?$element['quantity']:"",
				'freechars' 		=> isset( $element['freechars'] )?$element['freechars']:"",
			);
	}
	
	public function validate() {

		$passed = true;
		$message = array();
		
		$quantity_once=false;
		foreach ( $this->field_names as $attribute ) {
			if (!$quantity_once && isset($this->epo_post_fields[$attribute]) && $this->epo_post_fields[$attribute]!=="" && isset($this->epo_post_fields[$attribute.'_quantity']) && !$this->epo_post_fields[$attribute.'_quantity']>0){
				$passed = false;
				$quantity_once = true;
				$message[] = sprintf( __( 'The quantity for "%s" must be greater than 0', TM_EPO_TRANSLATION ),  $this->element['label'] );
			}
			if($this->element['required']){
				if ( !isset( $this->epo_post_fields[$attribute] ) ||  $this->epo_post_fields[$attribute]=="" ) {
					$passed = false;
					$message[] = 'required';
					break;
				}
			}
			if($this->element['min_chars']){
				$val=false;
				if ( isset( $this->epo_post_fields[$attribute] ) ) {
					$val = $this->epo_post_fields[$attribute];
				}
				if ($val === false || strlen($val)<intval($this->element['min_chars']) ){
					$passed = false;
					$message[] = sprintf( __( 'You must enter at least %s characters for "%s".', TM_EPO_TRANSLATION ), intval($this->element['min_chars']), $this->element['label'] );
					break;					
				}
			}
			if($this->element['max_chars']){
				$val=false;
				if ( isset( $this->epo_post_fields[$attribute] ) ) {
					$val = $this->epo_post_fields[$attribute];
				}
				if ($val !== false && strlen(utf8_decode( $val ) )>intval($this->element['max_chars']) ){
					$passed = false;
					$message[] = sprintf( __( 'You cannot enter more than %s characters for "%s".', TM_EPO_TRANSLATION ), intval($this->element['max_chars']), $this->element['label'] );
					break;					
				}
			}
		}
		

		return array('passed'=>$passed,'message'=>$message);
	}
	
}