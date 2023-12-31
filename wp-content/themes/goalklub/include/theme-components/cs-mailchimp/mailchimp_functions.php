<?php
/**
 * @package LMS
 * @copyright Copyright (c) 2014, Chimp Studio 
 */
 
/** 
 * @Mailchimp List
 */
if ( ! function_exists( 'cs_mailchimp_list' ) ) {
	function cs_mailchimp_list($apikey){
		global $cs_theme_options;
		$MailChimp = new MailChimp($apikey);
		$mailchimp_list = $MailChimp->call('lists/list');
		return $mailchimp_list;
	}
}

/** 
 * @custom mail chimp form
 */
if ( ! function_exists( 'cs_custom_mailchimp' ) ) {
	function cs_custom_mailchimp(){
		global $cs_theme_options;
		$counter = 1;
		?>
          <div class="signup">
			<div class="user-signup">
			  <form action="javascript:cs_mailchimp_submit('<?php echo get_template_directory_uri()?>','<?php echo esc_js($counter); ?>','<?php echo admin_url('admin-ajax.php'); ?>')" id="mcform_<?php echo intval($counter);?>" method="post">
				<div id="newsletter_mess_<?php echo intval($counter);?>" style="display:none"></div>
				<fieldset>
                  <label>
                  <i class="icon-envelope4"></i>
				  <input id="cs_list_id" type="hidden" name="cs_list_id" value="<?php if(isset($cs_theme_options['cs_mailchimp_list'])){ echo esc_attr($cs_theme_options['cs_mailchimp_list']); }?>" />
				  <input class="form-control" id="mc_email" type="text" name="mc_email" value="<?php _e('Signup weekly newsletter','goalklub'); ?>" onblur="if(this.value == '') { this.value ='<?php _e('Signup weekly newsletter','goalklub'); ?>'; }" onfocus="if(this.value =='<?php _e('Signup weekly newsletter','goalklub'); ?>') { this.value = ''; }"  />
                  </label>
				  <input type="submit" id="btn_newsletter_<?php echo intval($counter);?>" class="btn_newsletter" name="submit" value="<?php _e('Submit','goalklub');?>"  />
				  <div id="process_<?php echo intval($counter);?>"></div>
				</fieldset>
			  </form>
			</div>
         </div>
		<?php
		$counter++;
	}
}

/** 
 * @custom mail chimp form
 */
if ( ! function_exists( 'cs_custom_mailchimp_maintenance' ) ) {
	function cs_custom_mailchimp_maintenance(){
		global $cs_theme_options;
		$counter = 1;
		?>
          <div class="cs-search-area">
			  <form action="javascript:cs_mailchimp_submit('<?php echo get_template_directory_uri()?>','<?php echo esc_js($counter); ?>','<?php echo admin_url('admin-ajax.php'); ?>')" id="mcform_<?php echo intval($counter);?>" method="post">
				<div id="newsletter_mess_<?php echo intval($counter);?>" style="display:none"></div>
				<fieldset>
                  
				  <input id="cs_list_id" type="hidden" name="cs_list_id" value="<?php if(isset($cs_theme_options['cs_mailchimp_list'])){ echo esc_attr($cs_theme_options['cs_mailchimp_list']); }?>" />
				  <input class="form-control" id="mc_email" type="text" name="mc_email" value="<?php _e('Signup weekly newsletter','goalklub'); ?>" onblur="if(this.value == '') { this.value ='<?php _e('Signup weekly newsletter','goalklub'); ?>'; }" onfocus="if(this.value =='<?php _e('Signup weekly newsletter','goalklub'); ?>') { this.value = ''; }"  />
                  <label>
				  <input type="submit" id="btn_newsletter_<?php echo intval($counter);?>" class="btn_newsletter" name="submit" value="<?php _e('Submit','goalklub');?>"  />
                  </label>
				  <div id="process_<?php echo intval($counter);?>"></div>
				</fieldset>
			  </form>
		</div>
		<?php
		$counter++;
	}
}