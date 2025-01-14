<?php
if ( ! defined( 'ABSPATH' ) ) {
     exit;
 }                                            
 ?>  <h3><?php esc_html_e('Uninstall WooCommerce Infusionsoft Plugin','wp-infusionsoft-woocommerce'); ?></h3>
  <?php
  if(isset($_POST[$this->id.'_uninstall'])){ 
  ?>
  <div class="vxc_alert updated  below-h2">
  <h3><?php esc_html_e('Success','wp-infusionsoft-woocommerce'); ?></h3>
  <p><?php esc_html_e('WooCommerce Infusionsoft Plugin has been successfully uninstalled','wp-infusionsoft-woocommerce'); ?></p>
  <p>
  <a class="button button-hero button-primary" href="plugins.php"><?php esc_html_e("Go to Plugins Page",'wp-infusionsoft-woocommerce'); ?></a>
  </p>
  </div>
  <?php
  }else{
  ?>
  <div class="vxc_alert error below-h2">
  <h3><?php esc_html_e("Warning",'wp-infusionsoft-woocommerce'); ?></h3>
  <p><?php esc_html_e('This Operation will delete all Infusionsoft logs and feeds.','wp-infusionsoft-woocommerce'); ?></p>
  <p><button class="button button-hero button-secondary" id="vx_uninstall" type="submit" onclick="return confirm('<?php esc_html_e("Warning! ALL Infusionsoft Feeds and Logs will be deleted. This cannot be undone. OK to delete, Cancel to stop.", 'wp-infusionsoft-woocommerce')?>');" name="<?php echo esc_attr($this->id) ?>_uninstall" title="<?php esc_html_e("Uninstall",'wp-infusionsoft-woocommerce'); ?>" value="yes"><?php esc_html_e("Uninstall",'wp-infusionsoft-woocommerce'); ?></button></p>
  </div>
  <?php
  } ?>