<?php
if ( ! defined( 'ABSPATH' ) ) {
     exit;
 } 
 if(!isset($info['custom_app'])){
  $info['custom_app']=!isset($info['access_token']) ? 'yes' : '';  
}                                        
 ?><h3><?php echo sprintf(__("Account ID# %d",'wp-infusionsoft-woocommerce'),esc_attr($id));
if($new_account_id != $id){
 ?> <a href="<?php echo esc_url($new_account); ?>" title="<?php esc_html_e('Add New Account','wp-infusionsoft-woocommerce'); ?>" class="add-new-h2"><?php esc_html_e("Add New Account",'wp-infusionsoft-woocommerce'); ?></a> 
 <?php
}
$name=$this->post('name',$info);    
 ?>
 <a href="<?php echo esc_url($link) ?>" class="add-new-h2" title="<?php esc_html_e('Back to Accounts','wp-infusionsoft-woocommerce'); ?>"><?php esc_html_e('Back to Accounts','wp-infusionsoft-woocommerce'); ?></a></h3>
  <div class="crm_fields_table">
    <div class="crm_field">
  <div class="crm_field_cell1"><label for="vx_name"><?php esc_html_e("Account Name",'wp-infusionsoft-woocommerce'); ?></label>
  </div>
  <div class="crm_field_cell2">
  <input type="text" name="crm[name]" value="<?php echo !empty($name) ? esc_html($name) : esc_html('Account #'.$id); ?>" id="vx_name" class="crm_text">

  </div>
  <div class="clear"></div>
  </div>
  <script type="text/javascript">
  jQuery(document).ready(function($){
  /*  $('#vx_dc').change(function(){
        var val=$(this).val();
        var btn=$('.sf_login');
      var url='https://accounts.zoho.'+val+'/';
      var dc=btn.attr('data-url');  
  btn.attr('href',url+dc); 
    })*/
   // var elem=$('#mainform');
    var elem=$('.crm_fields_table :input');
    var form=elem.serialize();
      $('.sf_login').click(function(e){
      var form2=elem.serialize(); 
      if(form != form2){
         e.preventDefault();
        alert('Please "Save Changes" first');  
      }
      });  
  })
  </script>
    <div class="crm_field">
  <div class="crm_field_cell1">
  <label for="vx_dc_type"><?php esc_html_e('Infusionsoft App','wp-infusionsoft-woocommerce'); ?></label>
  </div>
  <div class="crm_field_cell2">
<select name="crm[custom_app]" class="crm_text" id="vx_dc_type" data-save="no" <?php if( !empty($info['access_token'])){ echo 'disabled="disabled"'; } ?> >
 <?php 
$ops=array('yes'=>__('Use Own Infusionsoft Developer App (Recommended)','wp-infusionsoft-woocommerce'),''=>__('Use Shared Infusionsoft Developer App (Recommended for testing only)','wp-infusionsoft-woocommerce')); 
  foreach($ops as $k=>$v){  
       $sel='';
if( $info['custom_app'] == $k){ $sel='selected="selected"'; }
echo '<option value="'.$k.'" '.$sel.'>'.$v.'</option>';
  }
 ?>
 </select>
 <div class="howto"><?php esc_html_e(' If you want to connect one Infusionsoft account to multiple sites then use a separate Infusionsoft App for each site','wp-infusionsoft-woocommerce'); ?></div>
 
  </div>
  <div class="clear"></div>
  </div>

  <div id="vx_shared_app_div" style="<?php if($this->post('custom_app',$info) != ""){echo 'display:none';} ?>">
  
   <div class="crm_field">
  <div class="crm_field_cell1">
  <label for="vx_dc"><?php esc_html_e('Shared App','wp-infusionsoft-woocommerce'); ?></label>
  </div>
  <div class="crm_field_cell2">
<select name="crm[dc]" class="crm_text" id="vx_dc" data-save="no" <?php if( !empty($info['access_token'])){ echo 'disabled="disabled"'; } ?> >
  <?php 
  for($i=1; $i<6; $i++){  
       $sel='';
if(!empty($info['dc']) && $info['dc'] == $i){ $sel='selected="selected"'; }
echo '<option value="'.$i.'" '.$sel.'>Shared App - site '.$i.'</option>';
  }
 ?>
 </select>
  </div>
  <div class="clear"></div>
  </div>
  
  </div>
  
  <div id="vx_custom_app_div" style="<?php if($this->post('custom_app',$info) != "yes"){echo 'display:none';} ?>">
     <div class="crm_field">
  <div class="crm_field_cell1"><label for="app_id"><?php esc_html_e("Client ID",'wp-infusionsoft-woocommerce'); ?></label></div>
  <div class="crm_field_cell2">
     <div class="vx_tr">
  <div class="vx_td">
  <input type="password" id="app_id" name="crm[app_id]" class="crm_text" placeholder="<?php esc_html_e("Client ID",'wp-infusionsoft-woocommerce'); ?>" value="<?php echo esc_html($this->post('app_id',$info)); ?>">
  </div><div class="vx_td2">
  <a href="#" class="button vx_toggle_btn vx_toggle_key" title="<?php esc_html_e('Toggle Consumer Key','wp-infusionsoft-woocommerce'); ?>"><?php esc_html_e('Show Key','wp-infusionsoft-woocommerce') ?></a>
  
  </div></div>
  <div class="howto"><?php echo sprintf(__('You can create own developer App - %sView ScreenShots%s ','wp-infusionsoft-woocommerce'),'<a href="https://www.crmperks.com/connect-wordpress-to-infusionsoft/" target="_blank">','</a>'); ?></div>
</div>
  <div class="clear"></div>
  </div>
     <div class="crm_field">
  <div class="crm_field_cell1"><label for="app_secret"><?php esc_html_e("Client Secret",'wp-infusionsoft-woocommerce'); ?></label></div>
  <div class="crm_field_cell2">
       <div class="vx_tr" >
  <div class="vx_td">
 <input type="password" id="app_secret" name="crm[app_secret]" class="crm_text"  placeholder="<?php esc_html_e("Client Secret",'wp-infusionsoft-woocommerce'); ?>" value="<?php echo esc_html($this->post('app_secret',$info)); ?>">
  </div><div class="vx_td2">
  <a href="#" class="button vx_toggle_btn vx_toggle_key" title="<?php esc_html_e('Toggle Consumer Secret','wp-infusionsoft-woocommerce'); ?>"><?php esc_html_e('Show Key','wp-infusionsoft-woocommerce') ?></a>
  
  </div></div>
  </div>
  <div class="clear"></div>
  </div>
       <div class="crm_field">
  <div class="crm_field_cell1"><label for="app_url"><?php esc_html_e("Redirect URL",'wp-infusionsoft-woocommerce'); ?></label></div>
  <div class="crm_field_cell2"><input type="text" id="app_url" name="crm[app_url]" class="crm_text" placeholder="<?php esc_html_e("Redirect URL",'wp-infusionsoft-woocommerce'); ?>" value="<?php echo esc_html($this->post('app_url',$info)); ?>"> 
  <div class="howto"><?php echo sprintf(__('Use %s or %s ','wp-infusionsoft-woocommerce'),'<code>https://www.crmperks.com/nimble_auth/</code>','<code>'.admin_url().'?'.$this->id.'_tab_action=get_code').'</code>'; ?></div>

  </div>
  <div class="clear"></div>
  </div>
  </div>
  <div class="crm_field">
  <div class="crm_field_cell1"><label><?php esc_html_e('Infusionsoft Access','wp-infusionsoft-woocommerce'); ?></label></div>
  <div class="crm_field_cell2">
  <?php if(isset($info['access_token'])  && $info['access_token']!="") {
  ?>
  <div style="padding-bottom: 8px;" class="vx_green"><i class="fa fa-check"></i> <?php
  echo sprintf(__("Authorized Connection to %s on %s",'wp-infusionsoft-woocommerce'),'<code>Infusionsoft</code>',date('F d, Y h:i:s A',$info['_time']));
        ?></div>
  <?php
  }else{
  ?>
  <a class="button button-default button-hero sf_login" data-id="<?php echo esc_html($client['client_id']) ?>" href="https://signin.infusionsoft.com/app/oauth/authorize?scope=full&response_type=code&state=<?php echo urlencode( str_replace('&','-__-',$link.'&'.$this->id."_tab_action=get_token&vx_action=redirect&id=".$id."&vx_nonce=".$nonce));?>&client_id=<?php echo esc_html($client['client_id']) ?>&redirect_uri=<?php echo $client['call_back'] ?>"  title="<?php esc_html_e("Login with Infusionsoft",'wp-infusionsoft-woocommerce'); ?>" > <i class="fa fa-lock"></i> <?php esc_html_e("Login with Infusionsoft",'wp-infusionsoft-woocommerce'); ?></a>
  <?php
  }
  ?></div>
  <div class="clear"></div>
  </div>                  
    <?php if(isset($info['access_token'])  && $info['access_token']!="") {
  ?>
    <div class="crm_field">
  <div class="crm_field_cell1"><label><?php esc_html_e("Revoke Access",'wp-infusionsoft-woocommerce'); ?></label></div>
  <div class="crm_field_cell2">  <a class="button button-secondary" id="vx_revoke" href="<?php echo esc_url($link."&".$this->id."_tab_action=get_token&vx_nonce=".$nonce.'&id='.$id);?>"><i class="fa fa-unlock"></i> <?php esc_html_e("Revoke Access",'wp-infusionsoft-woocommerce'); ?></a>
  </div>
  <div class="clear"></div>
  </div> 
<div class="crm_field">
  <div class="crm_field_cell1"><label><?php esc_html_e("Test Connection",'wp-infusionsoft-woocommerce'); ?></label></div>
  <div class="crm_field_cell2">      <button type="submit" class="button button-secondary" name="vx_test_connection"><i class="fa fa-refresh"></i> <?php esc_html_e("Test Connection",'wp-infusionsoft-woocommerce'); ?></button>
  </div>
  <div class="clear"></div>
  </div>
  <?php
    }
  ?>

  <div class="crm_field">
  <div class="crm_field_cell1"><label for="vx_error_email"><?php esc_html_e("Notify by Email on Errors",'wp-infusionsoft-woocommerce'); ?></label></div>
  <div class="crm_field_cell2"><textarea name="crm[error_email]" id="vx_error_email" placeholder="<?php esc_html_e("Enter comma separated email addresses",'wp-infusionsoft-woocommerce'); ?>" class="crm_text" style="height: 70px"><?php echo isset($info['error_email']) ? esc_html($info['error_email']) : ""; ?></textarea>
  <span class="howto"><?php esc_html_e("Enter comma separated email addresses. An email will be sent to these email addresses if an order is not properly added to Infusionsoft. Leave blank to disable.",'wp-infusionsoft-woocommerce'); ?></span>
  </div>
  <div class="clear"></div>
  </div> 
  <button type="submit" value="save" class="button-primary" title="<?php esc_html_e('Save Changes','wp-infusionsoft-woocommerce'); ?>" name="save"><?php esc_html_e('Save Changes','wp-infusionsoft-woocommerce'); ?></button>  
  </div>  

  <script type="text/javascript">

  jQuery(document).ready(function($){


  $(".vx_tabs_radio").click(function(){
  $(".vx_tabs").hide();   
  $("#tab_"+this.id).show();   
  }); 

  $(".sf_login").click(function(e){
    if($("#vx_dc_type").val() == 'yes'){
    var client_id=$(this).data('id');
    var new_id=$("#app_id").val();
    if(client_id!=new_id){
          e.preventDefault();   
     alert("<?php esc_html_e('Infusionsoft Client ID Changed.Please save new changes first','gravity-forms-infusionsoft-crm') ?>");   
    }    
    }
})
  $("#vx_dc_type").change(function(){
      var val=$(this).val();
     if(val == 'yes'){
         $("#vx_custom_app_div").show();
         $("#vx_shared_app_div").hide();
     }else{
          $("#vx_custom_app_div").hide();
         $("#vx_shared_app_div").show();
     } 
  });
  
    $(document).on('click','#vx_revoke',function(e){
  
  if(!confirm('<?php esc_html_e('Notification - Remove Connection?','wp-infusionsoft-woocommerce'); ?>')){
  e.preventDefault();   
  }
  })   
  })
  </script>  