<?php
if ( ! defined( 'ABSPATH' ) ) {
     exit;
 }                                           
 ?><div class="vx_div">
      <div class="vx_head">
<div class="crm_head_div"> <?php esc_html_e('3. Map Form Fields to Infusionsoft Fields.',  'wp-infusionsoft-woocommerce' ); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php esc_html_e('Expand / Collapse','wp-infusionsoft-woocommerce') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>

  <div class="vx_group  fields_div" style="padding: 0px; border-width: 0px; background: transparent;">
<?php
 $req_span=" <span class='vx_red vx_required'>(".__('Required','wp-infusionsoft-woocommerce').")</span>";
 $req_span2=" <span class='vx_red vx_required vx_req_parent'>(".__('Required','wp-infusionsoft-woocommerce').")</span>";

  foreach($map_fields as $k=>$v){
  $req=$this->post('req',$v);
  $v['type']=ucfirst($v['type']);
      
  if(isset($v['name_c'])){
  $v['name']=$v['name_c'];      
  $v['label']=__('Custom Field','wp-infusionsoft-woocommerce');      
  } 
if( in_array($v['name'] , array("OwnerId","AccountId","ContractId") )){
    continue;
}
if($module == "Order" && in_array($v['name'] , array("Status" ))){
    continue;
}

  $sel_val=isset($map[$k]['field']) ? $map[$k]['field'] : ""; 
    $val_type=isset($map[$k]['type']) && !empty($map[$k]['type']) ? $map[$k]['type'] : "field";  
  
  $display="none"; $btn_icon="fa-plus";
  if(isset($map[$k][$val_type]) && !empty($map[$k][$val_type])){
    $display="block"; 
    $btn_icon="fa-minus";   
  }

  $req_html=$req == "true" ? $req_span : ""; $k=esc_attr($k);
 ?> 
<div class="crm_panel crm_panel_100">
<div class="crm_panel_head2 ">
<div class="crm_head_div"><span class="crm_head_text"> <?php echo esc_html($v['label'])?></span>
<?php echo wp_kses_post($req_html); ?>
</div>
<div class="crm_btn_div">
<?php
 if(isset($v['name_c']) || ($api_type != 'web' && $req != 'true')){   
?>
<i class="vx_icons vx_remove_btn vx_remove_custom fa fa-trash-o" title="<?php esc_html_e('Delete','wp-infusionsoft-woocommerce'); ?>"></i>
<?php } ?>
<i class="fa crm_toggle_btn vx_btn_inner <?php echo esc_attr($btn_icon) ?>" title="<?php esc_html_e('Expand / Collapse','wp-infusionsoft-woocommerce') ?>"></i>

</div>
<div class="crm_clear"></div> </div>
<div class="more_options crm_panel_content " style="display: <?php echo esc_attr($display) ?>;">
  <?php if(!isset($v['name_c'])){ ?>

  <div class="crm-panel-description">
  <span class="crm-desc-name-div"><?php echo __('Name:','wp-infusionsoft-woocommerce')." ";?><span class="crm-desc-name"><?php echo esc_html($v['name']); ?></span> </span>
  <?php if($this->post('type',$v) !=""){ ?>
    <span class="crm-desc-type-div">, <?php echo __('Type:','wp-infusionsoft-woocommerce')." ";?><span class="crm-desc-type"><?php echo esc_html($v['type']) ?></span> </span>
<?php
   }
  if($this->post('maxlength',$v) !=""){ 
   ?>
   <span class="crm-desc-len-div">, <?php echo __('Max Length:','wp-infusionsoft-woocommerce')." ";?><span class="crm-desc-len"><?php echo esc_html($v['maxlength']); ?></span> </span>
  <?php 
  }  
  if($this->post('eg',$v) !=""){ 
   ?>
   <span class="crm-eg-div">, <?php echo __('e.g:','wp-infusionsoft-woocommerce')." ";?><span class="crm-eg"><?php echo esc_html($v['eg']); ?></span> </span>
  <?php 
  }
  ?>
   </div> 
  <?php
  }
  ?>
<div class="vx_margin">
<?php
    if(isset($v['name_c'])){
?>
<div class="entry_row">
<div class="entry_col1 vx_label"><?php esc_html_e('Field API Name','wp-infusionsoft-woocommerce') ?></div>
<div class="entry_col2">
<input type="text" name="meta[map][<?php echo esc_attr($k) ?>][name_c]" value="<?php echo $v['name_c'] ?>" placeholder="<?php esc_html_e('Field API Name','wp-infusionsoft-woocommerce') ?>" class="vx_input_100">
</div>
<div class="crm_clear"></div>
</div> 
<?php             
    }
?>
<div class="entry_row">
<div class="entry_col1 vx_label"><label for="vx_type_<?php echo esc_attr($k) ?>"><?php esc_html_e('Field Type','wp-infusionsoft-woocommerce') ?></label></div>
<div class="entry_col2">
<select name='meta[map][<?php echo esc_attr($k) ?>][type]' id="vx_type_<?php echo esc_attr($k) ?>"  class='vxc_field_type vx_input_100'>
<?php
  foreach($sel_fields as $f_key=>$f_val){
  $select="";
  if($this->post2($k,'type',$map) == $f_key)
  $select='selected="selected"';
  ?>
  <option value="<?php echo esc_attr($f_key) ?>" <?php echo $select ?>><?php echo esc_html($f_val)?></option>    
  <?php } ?> 
</select>
</div>
<div class="crm_clear"></div>
</div>  

<div class="entry_row entry_row2">
<div class="entry_col1 vx_label">

<div class="vx_label vxc_fields vxc_field_" style="<?php if($this->post2($k,'type',$map) != ''){echo 'display:none';} ?>">
<label for="vx_field_<?php echo esc_attr($k) ?>"><?php esc_html_e('Select Field','wp-infusionsoft-woocommerce') ?></label>
</div>

<div class="vxc_fields vxc_field_custom" style="<?php if($this->post2($k,'type',$map) != 'custom'){echo 'display:none';} ?>">
<label for="vx_custom_<?php echo esc_attr($k) ?>"> <?php esc_html_e('Custom Field','wp-infusionsoft-woocommerce') ?></label>
</div>

<div class="vxc_fields vxc_field_value" style="<?php if($this->post2($k,'type',$map) != 'value'){echo 'display:none';} ?>">
<label for="vx_value_<?php echo esc_attr($k) ?>"> <?php esc_html_e('Custom Value','wp-infusionsoft-woocommerce') ?></label>
</div>

</div>

<div class="entry_col2">


<div class="vxc_fields vxc_field_custom" style="<?php if($this->post2($k,'type',$map) != 'custom'){echo 'display:none';} ?>">
<input type="text" name='meta[map][<?php echo esc_attr($k)?>][custom]' id="vx_custom_<?php echo esc_attr($k) ?>"  value='<?php echo $this->post2($k,'custom',$map)?>' placeholder='<?php esc_html_e("Custom Field Name",'wp-infusionsoft-woocommerce')?>' class='vx_input_100' >
</div>

<div class="vxc_fields vxc_field_value" style="<?php if($this->post2($k,'type',$map) != 'value'){echo 'display:none';} ?>">
<input type="text" name='meta[map][<?php echo esc_attr($k)?>][value]'  id="vx_value_<?php echo esc_attr($k) ?>" value='<?php echo $this->post2($k,'value',$map)?>' placeholder='<?php esc_html_e("Custom Value",'wp-infusionsoft-woocommerce')?>' class='vx_input_100 vxc_field_input'>
<div class="howto"><?php echo sprintf(__('You can add a form field %s in custom value from following form fields','wp-infusionsoft-woocommerce'),'<code>{field_id}</code>')?></div>
</div>

<div class="vxc_fields vxc_field_ vxc_field_standard" style="<?php if($this->post2($k,'type',$map) == 'custom'){echo 'display:none';} ?>">
<select name="meta[map][<?php echo esc_attr($k) ?>][field]"  id="vx_field_<?php echo esc_attr($k) ?>" class="vxc_field_option vx_input_100">
<?php echo $this->wc_select($sel_val);   ?>
</select>
</div>


</div> 

<div class="crm_clear"></div>
</div> 

  </div></div>
  <div class="clear"></div>
  </div>
  <?php
  }
  ?>
<div id="vx_field_temp" style="display:none">
<div class="crm_panel crm_panel_100 vx_fields">
<div class="crm_panel_head2">
<div class="crm_head_div"><span class="crm_head_text">  <label class="crm_text_label"><?php esc_html_e('Custom Field','wp-infusionsoft-woocommerce');?></label></span></div>
<div class="crm_btn_div">
<i class="vx_icons vx_remove_btn vx_remove_custom fa fa-trash-o" data-tip="<?php esc_html_e('Delete','wp-infusionsoft-woocommerce'); ?>"></i>
<i class="fa crm_toggle_btn vx_btn_inner fa-minus " title="<?php esc_html_e('Expand / Collapse','wp-infusionsoft-woocommerce') ?>"></i>
</div>
<div class="crm_clear"></div> </div>
<div class="more_options crm_panel_content" style="display: block;">
<?php
    if($api_type  != 'web'){
?>

  <div class="crm-panel-description">
  <span class="crm-desc-name-div"><?php echo __('Name:','wp-infusionsoft-woocommerce')." ";?><span class="crm-desc-name"></span> </span>
  <span class="crm-desc-type-div">, <?php echo __('Type:','wp-infusionsoft-woocommerce')." ";?><span class="crm-desc-type"></span> </span>
  <span class="crm-desc-len-div">, <?php echo __('Max Length:','wp-infusionsoft-woocommerce')." ";?><span class="crm-desc-len"></span> </span>
  <span class="crm-eg-div">, <?php echo __('eg:','wp-infusionsoft-woocommerce')." ";?><span class="crm-eg"></span> </span>

   </div> 

<?php
    }
?>
<div class="vx_margin">
<?php
    if($api_type  == 'web'){
?>
<div class="entry_row">
<div class="entry_col1 vx_label"><?php esc_html_e('Field API Name','wp-infusionsoft-woocommerce') ?></div>
<div class="entry_col2">
<input type="text" name="name_c" placeholder="<?php esc_html_e('Field API Name','wp-infusionsoft-woocommerce') ?>" class="vx_input_100">
</div>
<div class="crm_clear"></div>
</div> 
<?php
    }
?>
<div class="entry_row">
<div class="entry_col1 vx_label"><?php esc_html_e('Field Type','wp-infusionsoft-woocommerce') ?></div>
<div class="entry_col2">
<select name='type' class='vxc_field_type vx_input_100'>
<?php
  foreach($sel_fields as $f_key=>$f_val){
  ?>
  <option value="<?php echo esc_attr($f_key) ?>"><?php echo esc_attr($f_val)?></option>    
  <?php } ?> 
</select>
</div>
<div class="crm_clear"></div>
</div>  

<div class="entry_row entry_row2">
<div class="entry_col1 vx_label">

<div class="vx_label vxc_fields vxc_field_">
<label><?php esc_html_e('Select Field','wp-infusionsoft-woocommerce') ?></label>
</div>

<div class="vxc_fields vxc_field_custom" style="display:none;">
<label> <?php esc_html_e('Custom Field','wp-infusionsoft-woocommerce') ?></label>
</div>

<div class="vxc_fields vxc_field_value" style="display:none;">
<label> <?php esc_html_e('Custom Value','wp-infusionsoft-woocommerce') ?></label>
</div>

</div>

<div class="entry_col2">

<div class="vxc_fields vxc_field_custom" style="display:none;">
<input type="text" name='custom'   value='' placeholder='<?php esc_html_e("Custom Field Name",'wp-infusionsoft-woocommerce')?>' class='vx_input_100' >
</div>

<div class="vxc_fields vxc_field_value" style="display:none">
<input type="text" name="value"  value="" placeholder='<?php esc_html_e("Custom Value",'wp-infusionsoft-woocommerce')?>' class='vx_input_100 vxc_field_input'>
<div class="howto"><?php echo sprintf(__('You can add a form field %s in custom value from following form fields','wp-infusionsoft-woocommerce'),'<code>{field_id}</code>')?></div>
</div>

<div class="vxc_fields vxc_field_ vxc_field_standard">
<select name="field" class="vxc_field_option vx_input_100">
<?php echo $this->wc_select();  ?>
</select>
</div>


</div> 

<div class="crm_clear"></div>
</div>  
<i class="vx_icons-h  vx vx-bin-2" data-tip="Delete"></i>    
 
  </div></div>
  <div class="clear"></div>
  </div>
  
  </div>
  <?php
  if($api_type =="web"){ ?>
  <div class="vx_fields_footer">
  <div class="vx_row">
  <div class="vx_col1"> &nbsp;</div><div class="vx_col2">
  <button type="button" class="button button-default" id="xv_add_custom_field"><i class=" fa fa-plus-circle" ></i> <?php esc_html_e('Add Custom Field','wp-infusionsoft-woocommerce')?></button></div>
  <div class="clear"></div></div>
   </div>
 <?php }else{ ?> 
<div class="crm_panel crm_panel_100 vx_fields">
<div class="crm_panel_head2">
<div class="crm_head_div"><span class="crm_head_text">  <label class="crm_text_label"><?php esc_html_e('Add New Field','wp-infusionsoft-woocommerce');?></label></span></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn vx_btn_inner fa-minus" style="display: none;" title="<?php esc_html_e('Expand / Collapse','wp-infusionsoft-woocommerce') ?>"></i></div>
<div class="crm_clear"></div> </div>
<div class="more_options crm_panel_content" style="display: block;">

<div class="vx_margin">

<div class="vx_tr">
<div class="vx_td">
<select id="vx_add_fields_select" class="vx_input_100" style="width: 100%" autocomplete="off">
<option value=""></option>
<?php
$json_fields=array();
 foreach($fields as $k=>$v){
     $v['type']=ucfirst($v['type']);
     $json_fields[$k]=$v;
   $disable='';
   if(isset($map_fields[$k])){
    $disable='disabled="disabled"';   
   } 
echo '<option value="'.esc_attr($k).'" '.$disable.' >'.esc_html($v['label']).'</option>';    
} ?>
</select>
</div>
<div class="vx_td2">
 <button type="button" class="button button-default" style="vertical-align: middle;" id="xv_add_custom_field"><i class="fa fa-plus-circle" ></i> <?php esc_html_e('Add Field','wp-infusionsoft-woocommerce')?></button>
 </div>
</div> 
<div class="entry_row vxc_fields vxc_field_custom" style="text-align: center;">
 
</div> 

<i class="vx_icons-h  vx vx-bin-2" data-tip="Delete"></i>    
 
  </div></div>
  <div class="clear"></div>
</div>
<script type="text/javascript">
var crm_fields=<?php echo json_encode($json_fields); ?>;
</script> 
 <?php
 }
 ?>
  </div> 
 <!---fields end--->
  </div>
  <div class="vx_div ">
    <div class="vx_head ">
<div class="crm_head_div"> <?php esc_html_e('4. When to Send the Order to Infusionsoft.',  'wp-infusionsoft-woocommerce' ); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php esc_html_e('Expand / Collapse','wp-infusionsoft-woocommerce') ?>"></i></div>
<div class="crm_clear"></div> 
  </div> 
  <div class="vx_group ">
  <div class="vx_row">
  <div class="vx_col1">
  <label for="vxc_event"><?php esc_html_e('Select Event','wp-infusionsoft-woocommerce'); $this->tooltip($tooltips['manual_export']); ?></label>
  </div>
  <div class="vx_col2">
  <select id="vxc_event" name="meta[event]" class="vx_sel" autocomplete="off">
  <?php  
  foreach($events as $f_key=>$f_val){
  $select="";
  if($this->post('event',$feed) == $f_key)
  $select='selected="selected"';
  echo '<option value="'.esc_attr($f_key).'" '.$select.'>'.esc_html($f_val).'</option>';    
  }    
  ?>
  </select> 
</div>
<div class="clear"></div>
</div>
  <div style="margin-top: 10px; padding-top: 10px; border-top: 1px dashed #ccc">
  <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_optin"><?php esc_html_e('Custom Filter', 'wp-infusionsoft-woocommerce'); $this->tooltip($tooltips['optin_condition']);?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="crm_optin" class="crm_toggle_check" name="meta[optin_enabled]" value="1" <?php echo !empty($feed['optin_enabled']) ? 'checked="checked"' : ''?> autocomplete="off"/>
    <label for="crm_optin"><?php esc_html_e('Enable', 'wp-infusionsoft-woocommerce'); ?></label>
  
  </div>
  <div class="clear"></div>
  </div>
  <div id="crm_optin_div" style="margin: 10px auto; width: 90%;<?php echo empty($feed['optin_enabled']) ? 'display:none' : ''?>">
  
        <div>
            <?php
            $sno=0; 
                foreach($filters as $filter_k=>$filter_v){ $filter_k=esc_attr($filter_k);
  $sno++;
                    ?>
  <div class="vx_filter_or" data-id="<?php echo esc_attr($filter_k) ?>"> 
  <?php if($sno>1){ ?>
  <div class="vx_filter_label">OR</div>
  <?php } ?>                 
  <div class="vx_filter_div">
  <?php
  if(is_array($filter_v)){
  $sno_i=0;
   foreach($filter_v as $s_k=>$s_v){   $s_k=esc_attr($s_k);   
  $sno_i++;
  
  ?> 
      <div class="vx_filter_and">
      <?php if($sno_i>1){ ?>
  <div class="vx_filter_label">AND</div>
  <?php } ?>   
     <div class="vx_filter_field vx_filter_field1">    
     <select id="crm_optin_field" name="meta[filters][<?php echo esc_attr($filter_k) ?>][<?php echo esc_attr($s_k) ?>][field]"><?php 
  echo $this->wc_select($this->post('field',$s_v));
      ?></select></div>
       <div class="vx_filter_field vx_filter_field2">   
    <select name="meta[filters][<?php echo esc_attr($filter_k) ?>][<?php echo esc_attr($s_k) ?>][op]" >
    <?php
       foreach($vx_op as $k=>$v){
  $sel="";
  if($this->post('op',$s_v) == $k)
  $sel='selected="selected"';
         echo "<option value='".esc_attr($k)."' $sel >".esc_html($v)."</option>";
     } 
    ?>
            </select></div>
             <div class="vx_filter_field vx_filter_field3">    
           <input type="text" class="vxc_filter_text" placeholder="<?php esc_html_e('Value','wp-infusionsoft-woocommerce') ?>" value="<?php echo $this->post('value',$s_v) ?>" name="meta[filters][<?php echo esc_attr($filter_k) ?>][<?php echo esc_attr($s_k) ?>][value]"> 
            </div>
                <?php if( $sno_i>1){ ?> 
  <div class="vx_filter_field vx_filter_field4"><i class="vx_icons-h vx_trash_and fa fa-trash-o"></i></div>
           <?php } ?>
           <div style="clear: both;"></div> 
           </div>
           <?php
  } }
           ?>
           <div class="vx_btn_div">
           <button class="button button-default button-small vx_add_and"><i class="vx_trash_and fa fa-hand-o-right"></i> <?php esc_html_e('Add AND Filter','wp-infusionsoft-woocommerce') ?></button>
           <?php if($sno>1){ ?>
  <i class="vx_icons-h fa fa-trash-o vx_trash_or"></i>
  <?php } ?> 
        
           </div>
        </div>
        </div>
                    <?php
                }
            ?>
  
          <div class="vx_btn_div">
  <button class="button button-default  vx_add_or"><i class="vx_trash_and fa fa-check"></i> <?php esc_html_e('Add OR Filter','wp-infusionsoft-woocommerce') ?></button></div>
        </div>
    </div>
  <div style="display: none;" id="vx_filter_temp">
  <div class="vx_filter_or"> 
  <div class="vx_filter_label">OR</div>
  <div class="vx_filter_div"> 
      <div class="vx_filter_and">  
      <div class="vx_filter_label vx_filter_label_and">AND</div> 
     <div class="vx_filter_field vx_filter_field1">    
     <select id="crm_optin_field" name="field" class='optin_selecta'><?php 
    echo $this->wc_select($this->post('field',$s_v));
      ?></select></div>
       <div class="vx_filter_field vx_filter_field2">    
    <select name="op" >
    <?php
       foreach($vx_op as $k=>$v){
  
         echo "<option value='".esc_attr($k)."' >".esc_html($v)."</option>";
     } 
    ?>
            </select></div>
             <div class="vx_filter_field vx_filter_field3">    
           <input type="text" class="vxc_filter_text" placeholder="<?php esc_html_e('Value','wp-infusionsoft-woocommerce') ?>" name="value"> 
            </div>
           <div class="vx_filter_field vx_filter_field4"><i class="vx_icons-h vx_trash_and fa fa-trash-o"></i></div>
           <div style="clear: both;"></div> 
           </div>
           <div class="vx_btn_div">
           <button class="button button-default button-small vx_add_and"><i class=" vx_trash_and fa fa-hand-o-right"></i> <?php esc_html_e('Add AND Filter','wp-infusionsoft-woocommerce') ?></button>
           <i class="vx_icons-h vx_trash_and fa fa-trash-o vx_trash_or"></i>
           </div>
        </div>
        </div>
        </div>
  <?php 
  if($module != 'Order'){ 
             $settings=get_option($this->type.'_settings',array());
         if(!empty($settings['notes'])){ 
  ?>
    <div style="margin-top: 10px; padding-top: 10px; border-top: 1px dashed #ccc">
  <div class="vx_row">
  <div class="vx_col1">
  <label for="vx_notes"><?php esc_html_e('Order Notes', 'wp-infusionsoft-woocommerce'); $this->tooltip($tooltips['vx_order_notes']);?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="vx_notes" class="crm_toggle_check" name="meta[order_notes]" value="1" <?php echo !empty($feed['order_notes']) ? 'checked="checked"' : ''?> autocomplete="off"/>
    <label for="vx_notes"><?php esc_html_e('Add / Delete Notes to Infusionsoft when added / deleted in WooCommerce', 'wp-infusionsoft-woocommerce'); ?></label>
  
  </div>
  <div class="clear"></div>
  </div></div>
  <?php
         }
      }
  ?>
      
  </div>  
  </div>  
  </div>  
  <?php
  $panel_count=4;
   $s_fields=array();
   if(is_array($fields)){
       foreach($fields as $k=>$v){
        if(!empty($v['search'])){
      $s_fields[$k]=$v;      
        }   
       }
   }
if(!empty($s_fields)){

      $panel_count++;
  ?>     
  <div class="vx_div"> 
  <div class="vx_head ">
<div class="crm_head_div"> <?php  echo sprintf(__('%s. Choose Primary Key.',  'wp-infusionsoft-woocommerce' ),$panel_count); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php esc_html_e('Expand / Collapse','wp-infusionsoft-woocommerce') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                    
  <div class="vx_group ">
  <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_primary_field"><?php esc_html_e('Select Primary Key','wp-infusionsoft-woocommerce') ?></label>
  </div><div class="vx_col2">
  <select id="crm_primary_field" name="meta[primary_key]" class="vx_sel" autocomplete="off">
  <?php echo $this->crm_select($s_fields,$this->post('primary_key',$feed) ); ?>
  </select> 
  <div class="description" style="float: none; width: 90%"><?php esc_html_e('If you want to update a pre-existing object, select what should be used as a unique identifier ("Primary Key"). For example, this may be an email address, lead ID, or address. When a new order comes in with the same "Primary Key" you select, a new object will not be created, instead the pre-existing object will be updated.', 'wp-infusionsoft-woocommerce'); ?></div>
  </div>
  <div class="clear"></div>
  </div>
  <div class="vx_row">
  <div class="vx_col1">
  <label for="vx_update">
  <?php esc_html_e('Update Entry', 'wp-infusionsoft-woocommerce'); ?>
  </label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="vx_update" class="crm_toggle_check" name="meta[update]" value="1" <?php echo !empty($feed['update']) ? "checked='checked'" : ""?>/>
  <label for="vx_update">
  <?php esc_html_e('Do not update entry, if already exists', 'wp-infusionsoft-woocommerce'); ?>
  </label>
  </div>
  <div style="clear: both;"></div>
  </div>
  </div>

  </div>
  
  <?php
}
 if($module != 'Order'){
 $users=$this->post('users',$meta); 
 $tags=$this->post('tags',$meta);   
  ?>
<div class="vx_div">
     <div class="vx_head">
<div class="crm_head_div"> <?php echo sprintf(__('%s. Add Note.', 'wp-infusionsoft-woocommerce'),$panel_count+=1); ?></div>
<div class="crm_btn_div" title="<?php esc_html_e('Expand / Collapse','wp-infusionsoft-woocommerce') ?>"><i class="fa crm_toggle_btn fa-minus"></i></div>
<div class="crm_clear"></div> 
  </div>


  <div class="vx_group">

    <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_note">
  <?php esc_html_e("Add Note", 'wp-infusionsoft-woocommerce'); ?>
  <?php $this->tooltip($tooltips["vx_entry_note"]) ?>
  </label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="crm_note" class="crm_toggle_check" name="meta[note_check]" value="1" <?php echo !empty($feed['note_check']) ? "checked='checked'" : ""?>/>
  <label for="crm_note_div">
  <?php esc_html_e("Enable", 'wp-infusionsoft-woocommerce'); ?>
  </label>
  </div>
  <div style="clear: both;"></div>
  </div>
  <div id="crm_note_div" style="margin-top: 16px; <?php echo empty($feed["note_check"]) ? "display:none" : ""?>">
  <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_note_fields">
  <?php esc_html_e( 'Note Fields', 'wp-infusionsoft-woocommerce' ); $this->tooltip($tooltips["vx_note_fields"]) ?>
  </label>
  </div>
  <div class="vx_col2 entry_col2" style="width: 70%">
  <textarea name="meta[note_val]"  placeholder="<?php esc_html_e("{field-id} text",'wp-infusionsoft-woocommerce')?>" class="vx_input_100 vxc_field_input" style="height: 60px"><?php
   echo $this->post('note_val',$feed); ?></textarea>
<div class="howto"><?php echo sprintf(__('You can add a form field %s in custom value from following form fields','wp-infusionsoft-woocommerce'),'<code>{field_id}</code>')?></div>

<select name="field"  class="vxc_field_option vx_input_100">
<?php echo $this->wc_select('');  ?>
</select>
   </div>
  <div style="clear: both;"></div>
  </div>
  
  <?php
      if(in_array($module,array('Contact','Company'))){
  ?>  
    <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_type_note">
  <?php esc_html_e( 'Add Note to ', 'wp-infusionsoft-woocommerce' ); ?>
  </label>
  </div>
  <div class="vx_col2">
  
  <select id="crm_type_note" class="vx_input_100" name="meta[send_note_to]">
<?php
$ops=array(''=>'Notes List','field'=>'Note Field');
foreach($ops as $k=>$v){
  $sel="";
  if($this->post('send_note_to',$feed) == $k){
  $sel='selected="selected"';
  }
echo "<option value='".esc_attr($k)."' $sel >".esc_html($v)."</option>";
} 
?>
</select>
    
   </div>
  <div style="clear: both;"></div>
  </div>
<?php
      }
  ?>
  
  <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_disable_note">
  <?php esc_html_e( 'Disable Note', 'wp-infusionsoft-woocommerce' ); $this->tooltip($tooltips["vx_disable_note"]) ?>
  </label>
  </div>
  <div class="vx_col2">
  
  <input type="checkbox" style="margin-top: 0px;" id="crm_disable_note" class="crm_toggle_check" name="meta[disable_entry_note]" value="1" <?php echo !empty($feed['disable_entry_note']) ? "checked='checked'" : ""?>/>
  <label for="crm_disable_note">
  <?php esc_html_e('Do not Add Note if entry already exists in Infusionsoft', 'wp-infusionsoft-woocommerce'); ?>
  </label>
    
   </div>
  <div style="clear: both;"></div>
  </div>
  
  </div>
  
  </div>
  </div>  
  <!-------------------------- lead owner -------------------->
<div class="vx_div vx_refresh_panel ">    
      <div class="vx_head ">
<div class="crm_head_div"> <?php echo sprintf(__('%s. Object Owner',  'wp-infusionsoft-woocommerce' ),++$panel_count); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php esc_html_e('Expand / Collapse','wp-infusionsoft-woocommerce') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                 
    <div class="vx_group ">
   <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="crm_owner"><?php esc_html_e("Assign Owner", 'wp-infusionsoft-woocommerce'); $this->tooltip($tooltips['vx_owner_check']);?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="crm_owner" class="crm_toggle_check <?php if(empty($users)){echo 'vx_refresh_btn';} ?>" name="meta[owner]" value="1" <?php echo !empty($feed["owner"]) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label for="owner"><?php esc_html_e("Enable", 'wp-infusionsoft-woocommerce'); ?></label>
  </div>
<div class="clear"></div>
</div>
    <div id="crm_owner_div" style="<?php echo empty($feed["owner"]) ? "display:none" : ""?>">
  <div class="vx_row">
  <div class="vx_col1">
  <label><?php esc_html_e('Users List','wp-infusionsoft-woocommerce'); $this->tooltip($tooltips['vx_owners']); ?></label>
  </div>
  <div class="vx_col2">
  <button class="button vx_refresh_data" data-id="refresh_users" type="button" autocomplete="off" style="vertical-align: baseline;">
  <span class="reg_ok"><i class="fa fa-refresh"></i> <?php esc_html_e('Refresh Data','wp-infusionsoft-woocommerce') ?></span>
  <span class="reg_proc"><i class="fa fa-refresh fa-spin"></i> <?php esc_html_e('Refreshing...','wp-infusionsoft-woocommerce') ?></span>
  </button>
  </div> 
   <div class="clear"></div>
  </div> 

  <div class="vx_row">
   <div class="vx_col1">
  <label for="crm_sel_user"><?php esc_html_e('Select User','wp-infusionsoft-woocommerce'); $this->tooltip($tooltips['vx_sel_owner']); ?></label>
</div> 
<div class="vx_col2">

  <select id="crm_sel_user" name="meta[user]" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($users,$this->post('user',$feed),__('Select User','wp-infusionsoft-woocommerce')); ?>
  </select>

   </div>

   <div class="clear"></div>
   </div>
 
  
  </div>
  

  </div>
  </div>
<?php
}

  if($module == 'Contact' ){

$company_feeds=$this->get_object_feeds('Company',$account);
  ?>
    <div class="vx_div vx_refresh_panel ">    
      <div class="vx_head ">
<div class="crm_head_div"> <?php echo sprintf(__('%s. Assign Company',  'wp-infusionsoft-woocommerce' ),++$panel_count); 
?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php esc_html_e('Expand / Collapse','wp-infusionsoft-woocommerce') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                 
    <div class="vx_group ">

        <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="company_check"><?php esc_html_e("Assign Company", 'wp-infusionsoft-woocommerce'); $this->tooltip($tooltips['vx_assign_company']);?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="company_check" class="crm_toggle_check" name="meta[company_check]" value="1" <?php echo !empty($feed["company_check"]) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label for="contact_check"><?php esc_html_e("Enable", 'wp-infusionsoft-woocommerce'); ?></label>
  </div>
<div class="clear"></div>
</div>
    <div id="company_check_div" style="<?php echo empty($feed["company_check"]) ? "display:none" : ""?>">
         <div class="vx_row">
   <div class="vx_col1">
  <label for="object_company"><?php esc_html_e('Select Company Feed','wp-infusionsoft-woocommerce'); $this->tooltip($tooltips['vx_sel_company']); ?></label>
</div> 
<div class="vx_col2">

  <select id="object_company" name="meta[object_company]" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($company_feeds ,$this->post('object_company',$feed),__('Select Company Feed','wp-infusionsoft-woocommerce')); ?>
  </select>

   </div>

   <div class="clear"></div>
   </div>
    </div>

  </div>
  </div>
  <?php
  }

  $file=self::$path.'pro/pro-mapping.php';
if(self::$is_pr && file_exists($file)){
include_once($file);
}  

do_action('vx_plugin_upgrade_notice_plugin_'.$this->type); 