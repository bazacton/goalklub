<?php
/**
 * File Type : Login Form Html
 * @copyright Copyright (c) 2014, Chimp Studio 
 */
	
//=====================================================================
// Sign In With Social Media
//=====================================================================
if (!function_exists('cs_social_login_form')) {
	function cs_social_login_form( $args = NULL ) {
		global $cs_theme_options;
		$display_label = false;
		if(get_option('users_can_register')) {
		if( $args == NULL )
			$display_label = true;
		elseif ( is_array( $args ) )
			extract( $args );
		if( !isset( $images_url ) )
			$images_url = wp_directory::plugin_url() . 'directory-login/cs-social-login/media/img/';
		$facebook_app_id = '';
		$facebook_secret = '';
		if(isset($cs_theme_options['cs_dashboard'])){
			$cs_dashboard_link = get_permalink($cs_theme_options['cs_dashboard']);
		}
		$twitter_enabled  = $cs_theme_options['cs_twitter_api_switch'];
		$facebook_enabled = $cs_theme_options['cs_facebook_login_switch'];
		
		if(isset($cs_theme_options['cs_facebook_app_id']))
			$facebook_app_id = $cs_theme_options['cs_facebook_app_id'];
		if(isset($cs_theme_options['cs_facebook_secret']))
			$facebook_secret = $cs_theme_options['cs_facebook_secret'];
		$google_enabled = $cs_theme_options['cs_google_login_switch'];
		if(isset($cs_theme_options['cs_consumer_key']))
			$twitter_app_id = $cs_theme_options['cs_consumer_key'];
		if(isset($cs_theme_options['cs_google_client_id']))
			$google_app_id = $cs_theme_options['cs_google_client_id'];
		if ($twitter_enabled || $facebook_enabled || $google_enabled) :
		$rand_id = cs_generate_random_string(5);
		$isRegistrationOn = get_option('users_can_register');
		   if ( $isRegistrationOn ) {
		  		//cs_social_connect();   
		  ?>
              <div class="hd_sepratore"><span>Or</span></div>
               <?php
               $global_REQUEST_URI = '';
                   if(function_exist('cs_glob_server')){
                       $global_REQUEST_URI = cs_glob_server('REQUEST_URI');
                   }
               ?>
              <div class="footer-element comment-form-social-connect social_login_ui <?php if( strpos( $global_REQUEST_URI, 'wp-signup.php' ) ) echo 'mu_signup'; ?>">
              <div class="social_login_facebook_auth">
                <input type="hidden" name="client_id" value="<?php echo esc_attr($facebook_app_id); ?>" />
                <input type="hidden" name="redirect_uri" value="<?php echo home_url('index.php?social-login=facebook-callback'); ?>" />
              </div>
              <div class="social_login_twitter_auth">
                <input type="hidden" name="client_id" value="<?php echo esc_attr($twitter_app_id); ?>" />
                <input type="hidden" name="redirect_uri" value="<?php echo home_url('index.php?social-login=twitter'); ?>" />
              </div>
              <div class="social_login_google_auth">
                <input type="hidden" name="client_id" value="<?php echo esc_attr($google_app_id); ?>" />
                <input type="hidden" name="redirect_uri" value="<?php  echo cs_google_login_url() . (isset($_GET['redirect_to']) ? '&redirect=' . $_GET['redirect_to'] : '');?>" />
              </div>
              <div class="sg-social">
                  <ul>	 
                  <?php if( $facebook_enabled ) :
                           echo apply_filters('social_login_login_facebook','<li><a href="javascript:void(0);" title="Facebook" id="cs-social-login-'.$rand_id.'fb"  data-original-title="Facebook" class="social_login_login_facebook"><span class="social-mess-top fb-social-login" style="display:none">'.__('Please set API key','goalklub').'</span><i class="icon-facebook2"></i>'.__('Login With Facebook','goalklub').'</a></li>');
                        endif; 
                        if( $twitter_enabled ) :
                            echo apply_filters('social_login_login_twitter','<li><a href="javascript:void(0);" title="Twitter" id="cs-social-login-'.$rand_id.'tw" data-original-title="twitter" class="social_login_login_twitter"><span class="social-mess-top tw-social-login" style="display:none">'.__('Please set API key','goalklub').'</span><i class="icon-twitter6"></i>'.__('Login With twitter','goalklub').'</a></li>');
                        endif; 
                        if( $google_enabled ) :
                            echo apply_filters('social_login_login_google','<li><a  href="javascript:void(0);" rel="nofollow" title="google-plus" id="cs-social-login-'.$rand_id.'gp" data-original-title="google-plus" class="social_login_login_google"><span class="social-mess-top gplus-social-login" style="display:none">
							'.__('Please set API key','goalklub').'</span><i class="icon-google-plus"></i>'.__('Login with Google Plus','goalklub').'</a></li>');
                        endif; 
                    $social_login_provider = isset( $_COOKIE['social_login_current_provider']) ? $_COOKIE['social_login_current_provider'] : '';
                    do_action ('social_login_auth');
                 ?> 
                 </ul> 
              </div>
            </div>
    	<?php }?>
	<!-- End of social_login_ui div -->
	<?php endif;
		}
	}
}
add_action( 'login_form',          'cs_social_login_form', 10 );
add_action( 'social_form',          'cs_social_login_form', 10 );
add_action( 'after_signup_form',   'cs_social_login_form', 10 );
add_action( 'social_login_form', 'cs_social_login_form', 10 );


//=====================================================================
// General Sign In Section ( Form )
//=====================================================================
if ( ! function_exists( 'cs_login_section' ) ) {
	function cs_login_section($cs_login_message= '',$cs_ad = false,$cs_login_class = ''){
		global $current_user,$cs_theme_options;
		$rand_id = rand(5,999999);
		$cs_user_login_method = isset($cs_theme_options['cs_user_login_method']) ? $cs_theme_options['cs_user_login_method'] : '';
		$afterlogin_class = '';
		if(is_user_logged_in()){
			$afterlogin_class = ' afterlogin';
		}else{
			$afterlogin_class = ' cs-signup';	
		}

		?>
         <div class="<?php echo esc_attr($cs_login_class).' '.cs_allow_special_char($afterlogin_class); ?>"> 
          <script>
			jQuery(document).ready(function(){
				jQuery('#ControlForm_<?php echo absint($rand_id);?> input').keydown(function(e) {
				if (e.keyCode == 13) {
					cs_user_authentication('<?php echo admin_url('admin-ajax.php')?>','<?php echo absint($rand_id);?>');
				}
			});
			jQuery("#cs-signup-form-section-favorites-<?php echo esc_js($rand_id);?>").hide();
			jQuery("#accout-already-favorites-<?php echo esc_js($rand_id);?>").hide();
			  jQuery("#signup-now-favorites-<?php echo esc_js($rand_id);?>").click(function(){
				jQuery("#login-from-<?php echo esc_js($rand_id);?>").hide();
				jQuery("#signup-now-favorites-<?php echo esc_js($rand_id);?>").hide();
				jQuery("#cs-signup-form-section-favorites-<?php echo esc_js($rand_id);?>").show();
				jQuery("#accout-already-favorites-<?php echo esc_js($rand_id);?>").show();
			  });
			  jQuery("#accout-already-favorites-<?php echo esc_js($rand_id);?>").click(function(){
				jQuery("#login-from-<?php echo esc_js($rand_id);?>").show();
				jQuery("#signup-now-favorites-<?php echo esc_js($rand_id);?>").show();
				jQuery("#cs-signup-form-section-favorites-<?php echo esc_js($rand_id);?>").hide();
				jQuery("#accout-already-favorites-<?php echo esc_js($rand_id);?>").hide();
			  });
			});
		 </script>			 
		  <section class="sg-header ">
		  <div class="header-element login-from login-form-id-<?php echo absint($rand_id);?>" id="login-from-<?php echo absint($rand_id);?>">
              <button data-dismiss="modal" class="close" type="button">
                <span aria-hidden="true"><i class="icon-times"></i></span><span class="sr-only">Close</span>
            </button>
          	<h6><?php _e('User Sign in','goalklub');?></h6>
          	<?php
				echo '<p>'.$cs_login_message.'</p>';
 			?>
  			<form method="post" class="wp-user-form webkit" id="ControlForm_<?php echo absint($rand_id);?>">
			<fieldset>
			  <span class="status status-message" style="display:none"></span> 
			  <p class="sg-email">
				<span class="iconuser"></span>
				<input type="text" name="user_login" size="20" tabindex="12" onfocus="if(this.value =='<?php _e('Username','goalklub');?>') { this.value = ''; }" onblur="if(this.value == '') { this.value ='<?php _e('Username','goalklub');?>'; }" value="<?php _e('Username','goalklub');?>">
			  </p>
			  <p class="sg-password">
				<span class="iconepassword"></span>
				<input type="password" name="user_pass" size="20" tabindex="12" onfocus="if(this.value =='<?php _e('Password','goalklub');?>') { this.value = ''; }" onblur="if(this.value == '') { this.value ='<?php _e('Password','goalklub');?>'; }" value="<?php _e('Password','goalklub');?>">
				
			  </p>
			  
			  <p>
				<i class="icon-angle-right"></i>
				<input type="button" name="user-submit" class="cs-bgcolor" value="<?php _e('Sign in','goalklub'); ?>" onclick="javascript:cs_user_authentication('<?php echo admin_url('admin-ajax.php')?>','<?php echo absint($rand_id);?>')" />
				<input type="hidden" name="redirect_to" value="<?php the_permalink(); ?>" />
                <?php
				if($cs_ad == true){
				?>
                <input type="hidden" name="redirect_to_ad" value="1" />
                <?php
				}
				?>
				<input type="hidden" name="user-cookie" value="1" />
				<input type="hidden" value="ajax_login" name="action">
				<input type="hidden" name="login" value="login" />
			 </p>
			</fieldset>
		  </form>
		  </div>
		  
		  <div class="user-sign-up" id="cs-signup-form-section-favorites-<?php echo esc_js($rand_id);?>" style="display:none">
			<h6><?php _e('User Sign Up','goalklub');?></h6>
			<form method="post" class="wp-user-form" id="wp_signup_form_<?php echo absint($rand_id);?>" enctype="multipart/form-data">
			<fieldset>
			   <div id="result_<?php echo absint($rand_id);?>" class="status-message"><p class="status"></p></div>
			  <p class="sg-email">
				<span class="iconuser"></span>
				<input type="text" name="user_login" size="20" tabindex="12" onfocus="if(this.value =='<?php _e('Username','goalklub');?>') { this.value = ''; }" onblur="if(this.value == '') { this.value ='<?php _e('Username','goalklub');?>'; }" value="<?php _e('Username','goalklub');?>">
			  </p>
			  <p class="sg-password">
				<span class="iconemail"></span>
				<input type="email" name="user_email" size="20" tabindex="12" onfocus="if(this.value =='<?php _e('E-mail address','goalklub');?>') { this.value = ''; }" onblur="if(this.value == '') { this.value ='<?php _e('E-mail address','goalklub');?>'; }" value="<?php _e('E-mail address','goalklub');?>">
				
			  </p>
			  <p>
				<i class="icon-angle-right"></i>
				 <?php echo do_action('register_form');?>
				<input type="button" name="user-submit"  value="<?php _e('Sign Up','goalklub');?>" class="cs-bgcolor"  onclick="javascript:cs_registration_validation('<?php echo admin_url("admin-ajax.php");?>','<?php echo absint($rand_id);?>')" />
				
				<input type="hidden" name="role" value="member" />
				<input type="hidden" name="action" value="cs_registration_validation" />
			 </p>
			</fieldset>
		  </form>
		  </div>
		  <?php do_action('login_form'); ?>
		</section>
		  <aside class="sg-footer">
		  <a href="<?php echo wp_lostpassword_url(); ?>" class="left-side"><?php _e('Forget Password?','goalklub');?></a>
			<?php  $isRegistrationOn = get_option('users_can_register');
				   if ( $isRegistrationOn ) {?>
				   <p id="signup-now-favorites-<?php echo esc_js($rand_id);?>" class="right-side"><?php _e('New here?','goalklub');?><a href="#"><?php _e('Sign Up','goalklub');?></a></p>
				   <p id="accout-already-favorites-<?php echo esc_js($rand_id);?>" class="right-side"><?php _e('Have Account?','goalklub');?><a href="#" style="font-size:12px;"><?php _e('Sign In','goalklub');?> </a></p>
			<?php }?>
		</aside>
        </div>
 <?php
	}
}

//=====================================================================
// General Sign In Section ( Add to Wishlist Form )
//=====================================================================
if ( ! function_exists( 'cs_userlogin' ) ) {
	function cs_userlogin(){
		global $cs_theme_options;
		$rand_id	 = rand(5,999999);
		$isRegistrationOn = get_option('users_can_register');
		$isRegistrationOnClass	= '';
		if ( !$isRegistrationOn ) {
			$isRegistrationOnClass	= 'no_icon';
		}
		?>
		<!-- Modal -->
        <div class="modal fade model-wishlist <?php echo esc_attr($isRegistrationOnClass); ?>" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                <section class="cs-signup" style="display:block;">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                     <div class="header-element login-from login-form-id-<?php echo absint($rand_id);?>" id="login-from-<?php echo absint($rand_id);?>">
                      <h6>
                        <?php _e('Sign in','goalklub');?>
                      </h6>
                      <form method="post" class="wp-user-form webkit" id="ControlForm_<?php echo absint($rand_id);?>">
                        <fieldset>
                          <p> 
                          	<span class="input-icon"><i class="icon-user"></i>
                            <input type="text" name="user_login" size="20" tabindex="11" onfocus="if(this.value =='<?php _e('User Name','goalklub');?>') { this.value = ''; }" onblur="if(this.value == '') { this.value ='<?php _e('User Name','goalklub');?>'; }" value="<?php _e('User Name','goalklub');?>" />
                            </span> 
                          </p>
                          <p> 
                            <span class="input-icon"><i class="icon-unlock-alt"></i>
                            <input type="password" name="user_pass" size="20" tabindex="12" onfocus="if(this.value =='<?php _e('Password','goalklub');?>') { this.value = ''; }" onblur="if(this.value == '') { this.value ='<?php _e('Password','goalklub');?>'; }" value="<?php _e('Password','goalklub');?>" />
                            </span> 
                          </p>
                          <p>
                            <input name="rememberme" value="forever" type="checkbox">
                            <span class="remember-me">
                            <?php _e('Remember me','goalklub'); ?>
                            </span> <span class="status status-message" style="display:none;"></span> </p>
                          <p>
                            <input type="button" name="user-submit" class="cs-bgcolor" value="<?php _e('login','goalklub'); ?>" onclick="javascript:cs_user_authentication('<?php echo admin_url('admin-ajax.php')?>','<?php echo absint($rand_id);?>')" />
                            <input type="hidden" name="redirect_to" value="<?php the_permalink(); ?>" />
                            <input type="hidden" name="user-cookie" value="1" />
                            <input type="hidden" name="action" value="ajax_login">
                            <input type="hidden" name="login" value="login" />
                          </p>
                          <p><a href="<?php echo wp_lostpassword_url( ); ?>">
                            <?php _e('Forget Password?','goalklub');?>
                            </a>
                          </p>
                        </fieldset>
                      </form>
                    </div>
                  <?php do_action('login_form'); ?>
                </section>
              </div>
            </div>
          </div>
        </div>
	<?php
	}
}

//======================================================================
// Register html form for page builder start
//======================================================================
if ( ! function_exists( 'cs_pb_register' ) ) {
	function cs_pb_register($die = 0){
		global $cs_node, $count_node, $post;
		
		$shortcode_element = '';
		$filter_element = 'filterdrag';
		$shortcode_view = '';
		$output = array();
		$cs_counter = $_POST['counter'];
		$PREFIX = 'cs_register';
		$parseObject 	= new ShortcodeParse();
		$accordion_num = 0;
		if ( isset($_POST['action']) && !isset($_POST['shortcode_element_id']) ) {
			$POSTID = '';
			$shortcode_element_id = '';
		} else {
			$POSTID = $_POST['POSTID'];
			$shortcode_element_id = $_POST['shortcode_element_id'];
			$shortcode_str = stripslashes ($shortcode_element_id);
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		
		$defaults = array('column_size'=>'1/1','register_title'=>'','register_text'=>'','register_role' => 'contributor','cs_register_class'=>'','cs_register_animation'=>'');
		
		if(isset($output['0']['atts']))
			$atts = $output['0']['atts'];
		else 
			$atts = array();
		
		if(isset($output['0']['content']))
			$atts_content = $output['0']['content'];
		else 
			$atts_content = array();
		
		if(is_array($atts_content))
			$register_num = count($atts_content);
			
		$register_element_size = '100';
		foreach($defaults as $key=>$values){
			if(isset($atts[$key]))
				$$key = $atts[$key];
			else 
				$$key =$values;
		 }
		$name = 'cs_pb_register';
		$coloumn_class = 'column_'.$register_element_size;
		
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
	?>
<div id="<?php echo esc_attr($name.$cs_counter)?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class);?> <?php echo esc_attr($shortcode_view);?>" item="blog" data="<?php echo element_size_data_array_index($register_element_size)?>" >
  <?php cs_element_setting($name,$cs_counter,$register_element_size,'','external-link');?>
  <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter)?> <?php echo esc_attr($shortcode_element);?>" id="<?php echo esc_attr($name.$cs_counter)?>" data-shortcode-template="[cs_register {{attributes}}] {{content}} [/cs_register]" style="display: none;">
    <div class="cs-heading-area">
      <h5>Edit Register Form Options</h5>
      <a href="javascript:removeoverlay('<?php echo esc_attr($name.$cs_counter)?>','<?php echo esc_attr($filter_element);?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
      <div class="cs-pbwp-content">
      <div class="cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content">
        <ul class="form-elements">
          <li class="to-label">
            <label>Form Title</label>
          </li>
          <li class="to-field">
            <input type="text" name="register_title[]" class="txtfield" value="<?php echo cs_allow_special_char($register_title)?>" />
          </li>
        </ul>
        
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('User Role','goalklub');?></label>
          </li>
          <li class="to-field select-style">
            <select class="dropdown" name="register_role[]">
                <option value=""><?php _e('Select User Role','goalklub');?></option>
                <option <?php if($register_role == 'subscriber') echo 'selected="selected"'; ?> value="subscriber"><?php _e('Subscriber','goalklub');?></option>
                <option <?php if($register_role == 'staff') echo 'selected="selected"'; ?> value="staff"><?php _e('Staff','goalklub');?></option>
                <option <?php if($register_role == 'member') echo 'selected="selected"'; ?> value="member"><?php _e('Member','goalklub');?></option>
                <option <?php if($register_role == 'instructor') echo 'selected="selected"'; ?> value="instructor"><?php _e('Instructor','goalklub');?></option>
                <option <?php if($register_role == 'shop_manager') echo 'selected="selected"'; ?> value="shop_manager"><?php _e('Shop Manager','goalklub');?></option>
                <option <?php if($register_role == 'customer') echo 'selected="selected"'; ?> value="customer"><?php _e('Customer','goalklub');?></option>
                <option <?php if($register_role == 'contributor') echo 'selected="selected"'; ?> value="contributor"><?php _e('Contributor','goalklub');?></option>
                <option <?php if($register_role == 'author') echo 'selected="selected"'; ?> value="author"><?php _e('Author','goalklub');?></option>
                <option <?php if($register_role == 'editor') echo 'selected="selected"'; ?> value="editor"><?php _e('Editor','goalklub');?></option>
                <option <?php if($register_role == 'administrator') echo 'selected="selected"'; ?> value="administrator"><?php _e('Administrator','goalklub');?></option>
            </select>
          </li>
        </ul>
        
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Content','goalklub');?></label>
          </li>
          <li class="to-field">
            <textarea class='txtfield' data-content-text="cs-shortcode-textarea" name="register_text[]"><?php echo esc_textarea($register_text)?></textarea>
          </li>
        </ul>
        
        <?php 
		if ( function_exists( 'cs_shortcode_custom_dynamic_classes' ) ) {
			cs_shortcode_custom_dynamic_classes($cs_register_class,$cs_register_animation,'','cs_register');
		}
		?>
      </div>
      <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){?>
      <ul class="form-elements insert-bg">
        <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('cs_pb_','',$name));?>','<?php echo esc_js($name.$cs_counter);?>','<?php echo esc_js($filter_element);?>')" ><?php _e('Insert','goalklub');?></a> </li>
      </ul>
      <div id="results-shortocde"></div>
      <?php } else {?>
      <ul class="form-elements noborder">
        <li class="to-label"></li>
        <li class="to-field">
          <input type="hidden" name="cs_orderby[]" value="register" />
          <input type="button" value="Save" style="margin-right:10px;" onclick="javascript:_removerlay(jQuery(this))" />
        </li>
      </ul>
      <?php }?>
    </div>
    </div>
</div>
<?php
		if ( $die <> 1 ) die();
	}
	add_action('wp_ajax_cs_pb_register', 'cs_pb_register');
}
?>