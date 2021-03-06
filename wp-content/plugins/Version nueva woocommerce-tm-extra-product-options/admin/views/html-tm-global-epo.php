<?php
/**
 *
 *   View for displaying saved TM EPOs
 *
 */

// Direct access security
if ( !defined( 'TM_EPO_PLUGIN_SECURITY' ) ) {
    die();
}

global $post, $post_id, $tm_is_ajax, $woocommerce;
$wpml_is_original_product=TM_EPO_WPML()->is_original_product($post_id);
if (!$wpml_is_original_product){
    $tm_meta_cpf=get_post_meta( floatval(TM_EPO_WPML()->get_original_id( $post_id )), 'tm_meta_cpf', true );
}else{
    $tm_meta_cpf=get_post_meta( $post_id, 'tm_meta_cpf', true );    
}
$tm_meta_cpf_mode=isset($tm_meta_cpf['mode'])?$tm_meta_cpf['mode']:'';
?>
<div id="tm_extra_product_options" class="panel wc-metaboxes-wrapper">
    <?php //do_action( 'tm_before_extra_product_options' ); ?>
    <div id="tm_extra_product_options_inner">
        <div class="tm_mode_selector">
            <input type="hidden" value="<?php echo $tm_meta_cpf_mode;?>" id="tm_meta_cpf_mode" name="tm_meta_cpf[mode]" >
            <p class="form-field tm_mode_select title"><?php _e( 'Select mode', TM_EPO_TRANSLATION ); ?></p>
            <p class="form-field tm_mode_select">
                <span class="button button-primary button-large tm_select_mode tm_builder_select"><?php _e( 'BUILDER', TM_EPO_TRANSLATION ); ?></span>
                <span class="button button-primary button-large tm_select_mode tm_local_select"><?php _e( 'LOCAL', TM_EPO_TRANSLATION ); ?></span>
                <span class="button button-primary button-large tm_select_mode tm_settings_select"><?php _e( 'SETTINGS', TM_EPO_TRANSLATION ); ?></span>
            </p> 
        </div>
        <div class="tm_mode_builder">
<?php

    TM_EPO_ADMIN_GLOBAL()->tm_form_fields_builder_meta_box($post);

?>
        </div>
        <div class="tm_mode_local tm_wrapper">
        <?php 
            if (TM_EPO_WPML()->is_original_product($post_id)){
                include ('html-tm-epo.php'); 
            }else{?>
                <div id="message" class="tm-inner inline woocommerce-message">
                <?php echo __( 'To translate the strings for the local options please use WPML interface.', TM_EPO_TRANSLATION );?>
                </div><?php
            }
        ?>
        </div>
        <div class="tm_mode_settings tm_options_group woocommerce_options_panel tm_wrapper">
        <?php
        if (TM_EPO_WPML()->is_original_product($post_id)){
            /* Include additional Global forms */
            $args = array(
                    'post_type'     => TM_EPO_GLOBAL_POST_TYPE,
                    'post_status'   => array( 'publish' ), // get only enabled global extra options
                    'numberposts'   => -1,
                    'orderby'       => 'title',
                    'order'         => 'asc'
                );
            $tmp_tmglobalprices  = get_posts( $args );
            echo '<div class="message0x0 tc-clearfix">'.
                    '<div class="message2x1">'.
                        '<label for="tm_meta_cpf_exclude"><span>'.__( 'Include additional Global forms', TM_EPO_TRANSLATION ).'</span></label>'.
                        '<span class="woocommerce-help-tip" data-tip="'.esc_attr(__( 'The forms you choose will be displayed alongside with the forms that the product already has.', TM_EPO_TRANSLATION )).'"></span>'.
                        '<div class="messagexdesc">&nbsp;</div>'.
                    '</div>'.
                    '<div class="message2x2">';        
            if ( $tmp_tmglobalprices ) {
                echo '<div class="wp-tab-panel"><ul>';
                $wpml_tmp_tmglobalprices=array();
                $wpml_tmp_tmglobalprices_added=array();
                foreach ( $tmp_tmglobalprices as $price ) {
                    $original_product_id = floatval(TM_EPO_WPML()->get_original_id( $price->ID,$price->post_type ));
                    if ($original_product_id==$price->ID){
                        $tm_global_forms=(isset($tm_meta_cpf['global_forms']) && is_array($tm_meta_cpf['global_forms']))?in_array($price->ID, $tm_meta_cpf['global_forms']):false;
                        echo '<li><label>';
                        echo '<input type="checkbox" value="'.$price->ID.'" id="tm_meta_cpf_global_forms_'.$price->ID.'" name="tm_meta_cpf[global_forms][]" class="checkbox" '.checked(  $tm_global_forms , true ,0) .'>';
                        echo ' '.$price->post_title.'</label></li>';
                    }
                }
                echo '</ul></div>';
            }        
            echo    '</div>'.
                '</div>';

            /* Ouput Exclude */
            $tm_exclude=isset($tm_meta_cpf['exclude'])?$tm_meta_cpf['exclude']:'';
            echo '<div class="message0x0 tc-clearfix">'.
                    '<div class="message2x1">'.
                        '<label for="tm_meta_cpf_exclude"><span>'.__( 'Exclude from Global Extra Product Options', TM_EPO_TRANSLATION ).'</span></label>'.
                        '<span class="woocommerce-help-tip" data-tip="'.esc_attr(__( 'THis will exclude any global forms assigned to this product except those defined in the previous setting.', TM_EPO_TRANSLATION )).'"></span>'.
                        '<div class="messagexdesc">&nbsp;</div>'.
                    '</div>'.
                    '<div class="message2x2">'.
                        '<input type="checkbox" value="1" id="tm_meta_cpf_exclude" name="tm_meta_cpf[exclude]" class="checkbox" '.checked(  $tm_exclude , '1' ,0) .'>'.
                    '</div>'.
                '</div>';

            /* Ouput Override display */
            $tm_override_display=isset($tm_meta_cpf['override_display'])?$tm_meta_cpf['override_display']:'';
            echo '<div class="message0x0 tc-clearfix">'.
                    '<div class="message2x1">'.
                        '<label for="tm_meta_cpf_override_display"><span>'.__( 'Override global display', TM_EPO_TRANSLATION ).'</span></label>'.
                        '<span class="woocommerce-help-tip" data-tip="'.esc_attr(__( 'This will override the display method only for this product.', TM_EPO_TRANSLATION )).'"></span>'.
                        '<div class="messagexdesc">&nbsp;</div>'.
                    '</div>'.
                    '<div class="message2x2">'.
                        '<select id="tm_meta_cpf_override_display" name="tm_meta_cpf[override_display]">'.
                            '<option value="" '.selected(  $tm_override_display , '' ,0) .'>' . __( 'Use global setting', TM_EPO_TRANSLATION ) . '</option>'.
                            '<option value="normal" '.selected(  $tm_override_display , 'normal' ,0) .'>' . __( 'Always show', TM_EPO_TRANSLATION ) . '</option>'.
                            '<option value="action" '.selected(  $tm_override_display , 'action' ,0) .'>' . __( 'Show only with action hook', TM_EPO_TRANSLATION ) . '</option>'.
                        '</select>'.
                    '</div>'.
                '</div>';

            /* Ouput Override totals box */
            $tm_override_final_total_box=isset($tm_meta_cpf['override_final_total_box'])?$tm_meta_cpf['override_final_total_box']:'';
            echo '<div class="message0x0 tc-clearfix">'.
                    '<div class="message2x1">'.
                        '<label for="tm_meta_cpf_override_final_total_box"><span>'.__( 'Override Final total box', TM_EPO_TRANSLATION ).'</span></label>'.
                        '<span class="woocommerce-help-tip" data-tip="'.esc_attr(__( 'This will override the totals box display only for this product.', TM_EPO_TRANSLATION )).'"></span>'.
                        '<div class="messagexdesc">&nbsp;</div>'.
                    '</div>'.
                    '<div class="message2x2">'.
                            '<select id="tm_meta_cpf_override_final_total_box" name="tm_meta_cpf[override_final_total_box]">'.
                                '<option value="" '.selected(  $tm_override_final_total_box , '' ,0) .'>' . __( 'Use global setting', TM_EPO_TRANSLATION ) . '</option>'.
                                '<option value="normal" '.selected(  $tm_override_final_total_box , 'normal' ,0) .'>' . __( 'Show Both Final and Options total box', TM_EPO_TRANSLATION ) . '</option>'.
                                '<option value="final" '.selected(  $tm_override_final_total_box , 'final' ,0) .'>' . __( 'Show only Final box', TM_EPO_TRANSLATION ) . '</option>'.
                                '<option value="hideoptionsifzero" '.selected(  $tm_override_final_total_box , 'hideoptionsifzero' ,0) .'>' . __( 'Show Final box and hide Options if zero', TM_EPO_TRANSLATION ) . '</option>'.
                                '<option value="hideifoptionsiszero" '.selected(  $tm_override_final_total_box , 'hideifoptionsiszero' ,0) .'>' . __( 'Hide Final total box if Options total is zero', TM_EPO_TRANSLATION ) . '</option>'.
                                '<option value="hide" '.selected(  $tm_override_final_total_box , 'hide' ,0) .'>' . __( 'Hide Final total box', TM_EPO_TRANSLATION ) . '</option>'.
                                '<option value="pxq" '.selected(  $tm_override_final_total_box , 'pxq' ,0) .'>' . __( 'Always show only Final total (Price x Quantity)', TM_EPO_TRANSLATION ) . '</option>'.
                            '</select>'.
                    '</div>'.
                '</div>';

            /* Ouput Override enabled roles */
            $tm_override_enabled_roles=isset($tm_meta_cpf['override_enabled_roles'])?$tm_meta_cpf['override_enabled_roles']:'';
            if (!is_array($tm_override_enabled_roles)){
                $tm_override_enabled_roles=array($tm_override_enabled_roles);
            }
            $options = '';
            $roles = tm_get_roles();
            foreach ( $roles as $option_key => $option_text ) {
                $options .= '<option value="' . esc_attr( $option_key ) . '" '. selected( in_array( $option_key, $tm_override_enabled_roles ), 1, false ) . '>' . esc_attr( $option_text ) .'</option>';
            }

            echo '<div class="message0x0 tc-clearfix">'.
                    '<div class="message2x1">'.
                        '<label for="tm_meta_cpf_override_enabled_roles"><span>'.__( 'Override enabled roles for this product', TM_EPO_TRANSLATION ).'</span></label>'.
                        '<span class="woocommerce-help-tip" data-tip="'.esc_attr(__( 'This will override which roles can see the options for this product.', TM_EPO_TRANSLATION )).'"></span>'.
                        '<div class="messagexdesc">&nbsp;</div>'.
                    '</div>'.
                    '<div class="message2x2">'.
                            '<select id="tm_meta_cpf_override_enabled_roles" name="tm_meta_cpf[override_enabled_roles]" class="multiselect wc-enhanced-select" multiple="multiple">'.
                            $options.
                            '</select>'.
                    '</div>'.
                '</div>';

            /* Ouput Override disabled roles */
            $tm_override_disabled_roles=isset($tm_meta_cpf['override_disabled_roles'])?$tm_meta_cpf['override_disabled_roles']:'';
            if (!is_array($tm_override_disabled_roles)){
                $tm_override_disabled_roles=array($tm_override_disabled_roles);
            }
            $options = '';
            $roles = tm_get_roles();
            foreach ( $roles as $option_key => $option_text ) {
                $options .= '<option value="' . esc_attr( $option_key ) . '" '. selected( in_array( $option_key, $tm_override_disabled_roles ), 1, false ) . '>' . esc_attr( $option_text ) .'</option>';
            }

            echo '<div class="message0x0 tc-clearfix">'.
                    '<div class="message2x1">'.
                        '<label for="tm_meta_cpf_override_disabled_roles"><span>'.__( 'Override disabled roles for this product', TM_EPO_TRANSLATION ).'</span></label>'.
                        '<span class="woocommerce-help-tip" data-tip="'.esc_attr(__( 'This will override which roles cannot see the options for this product. This setting has priority over the enabled roles one.', TM_EPO_TRANSLATION )).'"></span>'.                        
                        '<div class="messagexdesc">&nbsp;</div>'.
                    '</div>'.
                    '<div class="message2x2">'.
                            '<select id="tm_meta_cpf_override_disabled_roles" name="tm_meta_cpf[override_disabled_roles]" class="multiselect wc-enhanced-select" multiple="multiple">'.
                            $options.
                            '</select>'.
                    '</div>'.
                '</div>';
        }
        ?>
        </div>
    </div>
</div>