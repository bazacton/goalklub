<?php
/**
 * File Type: Loops Shortcode Elements
 */

//======================================================================
// Clients html form for page builder start
//======================================================================

if ( ! function_exists( 'cs_pb_clients' ) ) {
	function cs_pb_clients($die = 0){
		global $cs_node, $post;
		$shortcode_element = '';
		$filter_element = 'filterdrag';
		$shortcode_view = '';
		$output = array();
		$cs_counter = $_POST['counter'];
		$clients_num = 0;
		if ( isset($_POST['action']) && !isset($_POST['shortcode_element_id']) ) {
			$POSTID = '';
			$shortcode_element_id = '';
		} else {
			$POSTID = $_POST['POSTID'];
			$shortcode_element_id = $_POST['shortcode_element_id'];
			$shortcode_str = stripslashes ($shortcode_element_id);
			$PREFIX = 'cs_clients|clients_item';
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array('cs_client_gray' => '','cs_client_border' => '','cs_client_section_title' => '','cs_client_class' => '','cs_client_animation' => '');
		if(isset($output['0']['atts']))
			$atts = $output['0']['atts'];
		else 
			$atts = array();
		if(isset($output['0']['content']))
			$atts_content = $output['0']['content'];
		else 
			$atts_content = array();
		if(is_array($atts_content))
				$clients_num = count($atts_content);
		$clients_element_size = '25';
		foreach($defaults as $key=>$values){
			if(isset($atts[$key]))
				$$key = $atts[$key];
			else 
				$$key =$values;
		 }
		$name = 'cs_pb_clients';
		$coloumn_class = 'column_'.$clients_element_size;
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
		$randD_id = rand(34, 453453);
	?>
<div id="<?php echo cs_allow_special_char($name.$cs_counter);?>_del" class="column  parentdelete <?php echo cs_allow_special_char($coloumn_class);?> <?php echo cs_allow_special_char($shortcode_view);?>" item="column" data="<?php echo element_size_data_array_index($clients_element_size)?>" >
  <?php cs_element_setting($name,$cs_counter,$clients_element_size,'','weixin');?>
  <div class="cs-wrapp-class-<?php echo cs_allow_special_char($cs_counter)?> <?php echo cs_allow_special_char($shortcode_element);?>" id="<?php echo cs_allow_special_char($name.$cs_counter);?>" style="display: none;">
    <div class="cs-heading-area">
      <h5><?php _e('Edit Clients Options','goalklub');?></h5>
      <a href="javascript:removeoverlay('<?php echo cs_allow_special_char($name.$cs_counter)?>','<?php echo cs_allow_special_char($filter_element);?>')" class="cs-btnclose"><i class="icon-cross3"></i></a> </div>
    <div class="cs-clone-append cs-pbwp-content" >
      <div class="cs-wrapp-tab-box">
        <div id="shortcode-item-<?php echo esc_attr($cs_counter);?>" data-shortcode-template="{{child_shortcode}} [/cs_clients]" data-shortcode-child-template="[clients_item {{attributes}}] {{content}} [/clients_item]">
          <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true" data-template="[cs_clients {{attributes}}]">
            <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
            <ul class="form-elements">
                <li class="to-label"><label><?php _e('Section Title','goalklub');?></label></li>
                <li class="to-field">
                    <input  name="cs_client_section_title[]" type="text"  value="<?php echo cs_allow_special_char($cs_client_section_title);?>"   />
                </li>                  
             </ul>
            
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Gray Scale','goalklub');?></label>
              </li>
              <li class="to-field select-style">
                <select class="cs_client_gray" id="cs_client_gray" name="cs_client_gray[]">
                  <option value="yes" <?php if($cs_client_gray == 'yes'){echo 'selected="selected"';}?>><?php _e('Yes','goalklub');?></option>
                  <option value="no" <?php if($cs_client_gray == 'no'){echo 'selected="selected"';}?>><?php _e('No','goalklub');?></option>
                </select>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Border','goalklub');?></label>
              </li>
              <li class="to-field select-style">
                <select class="cs_client_border" id="cs_client_border" name="cs_client_border[]">
                  <option value="yes" <?php if($cs_client_border == 'yes'){echo 'selected="selected"';}?>><?php _e('Yes','goalklub');?></option>
                  <option value="no" <?php if($cs_client_border == 'no'){echo 'selected="selected"';}?>><?php _e('No','goalklub');?></option>
                </select>
              </li>
            </ul>
            <ul class="form-elements">
                <li class="to-label"><label><?php _e('Custom ID','goalklub');?></label></li>
                <li class="to-field">
                    <input type="text" name="cs_client_class[]" class="txtfield"  value="<?php echo esc_attr($cs_client_class)?>" />
                </li>
             </ul>
            <ul class="form-elements">
                <li class="to-label"><label><?php _e('Animation Class','goalklub');?></label></li>
                <li class="to-field">
                    <div class="select-style">
                        <select class="dropdown" name="cs_client_animation[]">
                            <option value=""><?php _e('Select Animation','goalklub');?></option>
                            <?php 
                                $animation_array = cs_animation_style();
                                foreach($animation_array as $animation_key=>$animation_value){
                                    echo '<optgroup label="'.$animation_key.'">';	
                                    foreach($animation_value as $key=>$value){
                                        $active_class = '';
                                        if($cs_client_animation == $key){$active_class = 'selected="selected"';}
                                        echo '<option value="'.$key.'" '.$active_class.'>'.$value.'</option>';
                                    }
                                }
                             ?>
                          </select>
                      </div>
                </li>
            </ul>
          </div>
          <?php
		  		if ( isset($clients_num) && $clients_num <> '' && isset($atts_content) && is_array($atts_content)){
					$itemCounter  = 0 ;		
					foreach ( $atts_content as $clients_items ){
						$itemCounter++;
						$rand_id = $cs_counter.''.cs_generate_random_string(3);
						$defaults = array('cs_website_url'=>'','cs_client_logo'=>'');
						foreach($defaults as $key=>$values){
							if(isset($clients_items['atts'][$key]))
								$$key = $clients_items['atts'][$key];
							else 
								$$key =$values;
						 }
				?>
                      <div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo cs_allow_special_char($rand_id);?>">
                        <header>
                          <h4><i class='icon-arrows'></i><?php _e('Clients','goalklub');?></h4>
                          <a href='#' class='deleteit_node'><i class='icon-minus8-circle'></i><?php _e('Remove','goalklub');?></a></header>
                         
                      
                        <ul class="form-elements">
                          <li class="to-label">
                            <label><?php _e('Website Link','goalklub');?></label>
                          </li>
                          <li class="to-field">
                            <div class="input-sec">
                              <input type="text" id="cs_website_url" class="" name="cs_website_url[]" value="<?php echo esc_url($cs_website_url);?>" />
                            </div>
                            <div class="left-info">
                              <p>e.g. http://yourdomain.com/</p>
                            </div>
                          </li>
                        </ul>
                        <ul class="form-elements">
                          <li class="to-label">
                            <label><?php _e('Client Logo','goalklub');?></label>
                          </li>
                          <li class="to-field">
                            <input id="cs_client_logo<?php echo cs_allow_special_char($itemCounter)?>" name="cs_client_logo[]" type="hidden" class="" value="<?php echo cs_allow_special_char($cs_client_logo);?>"/>
                            <input name="cs_client_logo<?php echo cs_allow_special_char($itemCounter)?>"  type="button" class="uploadMedia left" value="<?php _e('Browse','goalklub');?>"/>
                          </li>
                        </ul>
                        <div class="page-wrap" style="overflow:hidden; display:<?php echo cs_allow_special_char($cs_client_logo) && trim($cs_client_logo) !='' ? 'inline' : 'none';?>" id="cs_client_logo<?php echo cs_allow_special_char($itemCounter)?>_box" >
                          <div class="gal-active">
                            <div class="dragareamain" style="padding-bottom:0px;">
                              <ul id="gal-sortable">
                                <li class="ui-state-default" id="">
                                  <div class="thumb-secs"> <img src="<?php echo cs_allow_special_char($cs_client_logo);?>"  id="cs_client_logo<?php echo cs_allow_special_char($itemCounter)?>_img" width="100" height="150"  />
                                    <div class="gal-edit-opts"> <a   href="javascript:del_media('cs_client_logo<?php echo cs_allow_special_char($itemCounter)?>')" class="delete"></a> </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
          <?php }
			 }
			?>
        </div>
        <div class="hidden-object">
          <input type="hidden" name="clients_num[]" value="<?php echo (int)$clients_num;?>" class="fieldCounter"  />
        </div>
        <div class="wrapptabbox no-padding-lr">
          <div class="opt-conts">
            <ul class="form-elements noborder">
              <li class="to-field"> <a href="#" class="add_servicesss cs-main-btn" onclick="cs_shortcode_element_ajax_call('clients', 'shortcode-item-<?php echo cs_allow_special_char($cs_counter);?>', '<?php echo cs_allow_special_char(admin_url('admin-ajax.php'));?>')"><i class="icon-plus7"></i><?php _e('Add Client','goalklub');?></a> </li>
               <div id="loading" class="shortcodeload"></div>
            </ul>
          </div>
          <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){?>
          <ul class="form-elements insert-bg">
            <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo cs_allow_special_char(str_replace('cs_pb_','',$name));?>','shortcode-item-<?php echo cs_allow_special_char($cs_counter);?>','<?php echo cs_allow_special_char($filter_element);?>')" ><?php _e('Insert','goalklub');?></a> </li>
          </ul>
          <div id="results-shortocde"></div>
          <?php } else {?>
          <ul class="form-elements noborder no-padding-lr">
            <li class="to-label"></li>
            <li class="to-field">
              <input type="hidden" name="cs_orderby[]" value="clients" />
              <input type="button" value="Save" style="margin-right:10px;" onclick="javascript:_removerlay(jQuery(this))" />
            </li>
          </ul>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
		if ( $die <> 1 ) die();
	}
	add_action('wp_ajax_cs_pb_clients', 'cs_pb_clients');
}
// Clients Html form for page builder End

//======================================================================
// Content Slider html form for page builder start
//======================================================================
if ( ! function_exists( 'cs_pb_contentslider' ) ) {
	function cs_pb_contentslider($die = 0){
		global $cs_node, $post;
		$shortcode_element = '';
		$filter_element = 'filterdrag';
		$shortcode_view = '';
		$output = array();
		$counter = $_POST['counter'];
		$cs_counter = $_POST['counter'];
		if ( isset($_POST['action']) && !isset($_POST['shortcode_element_id']) ) {
			$POSTID = '';
			$shortcode_element_id = '';
		} else {
			$POSTID = $_POST['POSTID'];
			$shortcode_element_id = $_POST['shortcode_element_id'];
			$shortcode_str = stripslashes ($shortcode_element_id);
			$PREFIX = 'cs_contentslider';
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array('cs_contentslider_title' => '','cs_contentslider_dcpt_cat'=>'','cs_contentslider_orderby'=>'DESC','cs_contentslider_description'=>'yes','cs_contentslider_excerpt'=>'255', 'cs_contentslider_num_post'=>get_option("posts_per_page"),'cs_contentslider_class' => '','cs_contentslider_animation' => '');
			if(isset($output['0']['atts']))
				$atts = $output['0']['atts'];
			else 
				$atts = array();

			$contentslider_element_size = '50';
			foreach($defaults as $key=>$values){
				if(isset($atts[$key]))
					$$key = $atts[$key];
				else 
					$$key =$values;
			 }
			$name = 'cs_pb_contentslider';
			$coloumn_class = 'column_'.$contentslider_element_size;
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
	?>
<div id="<?php echo esc_attr($name.$cs_counter)?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class);?> <?php echo esc_attr($shortcode_view);?>" item="blog" data="<?php echo element_size_data_array_index($contentslider_element_size)?>">
      <?php cs_element_setting($name,$cs_counter,$contentslider_element_size,'','newspaper-o');?>
      <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter)?> <?php echo esc_attr($shortcode_element);?>" id="<?php echo esc_attr($name.$cs_counter);?>" data-shortcode-template="[cs_contentslider {{attributes}}]"  style="display: none;">
        <div class="cs-heading-area">
          <h5><?php _e('Edit Content Slider Options','goalklub');?></h5>
          <a href="javascript:removeoverlay('<?php echo esc_attr($name.$cs_counter);?>','<?php echo esc_attr($filter_element);?>')" class="cs-btnclose"><i class="icon-cross3"></i></a> </div>
        <div class="cs-pbwp-content">
         <div class="cs-wrapp-clone cs-shortcode-wrapp">
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Section Title','goalklub');?></label>
          </li>
          <li class="to-field">
            <div class="input-sec">
              <input type="text" name="cs_contentslider_title[]" class="txtfield" value="<?php echo cs_allow_special_char(htmlspecialchars($cs_contentslider_title));?>" />
            </div>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Select Category','goalklub');?></label>
          </li>
          <li class="to-field">
            <div class="input-sec">
              <div class="select-style">
                <select name="cs_contentslider_dcpt_cat[]" class="dropdown"  >
                  <option value="0"><?php _e('-- Select Category --','goalklub');?></option>
                      <?php show_all_cats('', '',$cs_contentslider_dcpt_cat, "category");?>
                </select>
              </div>
            </div>
          </li>
        </ul>
        <div id="Blog-listing">
          <ul class="form-elements">
            <li class="to-label">
              <label><?php _e('Post Order','goalklub');?></label>
            </li>
            <li class="to-field">
              <div class="input-sec">
                <div class="select-style">
                  <select name="cs_contentslider_orderby[]" class="dropdown" >
                    <option <?php if($cs_contentslider_orderby=="ASC")echo "selected";?> value="ASC"><?php _e('Asc','goalklub');?></option>
                    <option <?php if($cs_contentslider_orderby=="DESC")echo "selected";?> value="DESC"><?php _e('DESC','goalklub');?></option>
                  </select>
                </div>
              </div>
            </li>
          </ul>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php _e('Post Description','goalklub');?></label>
            </li>
            <li class="to-field">
              <div class="input-sec">
                <div class="select-style">
                  <select name="cs_contentslider_description[]" class="dropdown" >
                    <option <?php if($cs_contentslider_description=="yes")echo "selected";?> value="yes"><?php _e('Yes','goalklub');?></option>
                    <option <?php if($cs_contentslider_description=="no")echo "selected";?> value="no"><?php _e('No','goalklub');?></option>
                  </select>
                </div>
              </div>
            </li>
          </ul>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php _e('Length of Excerpt','goalklub');?></label>
            </li>
            <li class="to-field">
              <div class="input-sec">
                <input type="text" name="cs_contentslider_excerpt[]" class="txtfield" value="<?php echo esc_attr($cs_contentslider_excerpt);?>" />
              </div>
              <div class="left-info">
                <p><?php _e('Enter number of character for short description text','goalklub');?></p>
              </div>
            </li>
          </ul>
        </div>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('No. of Post Per Page','goalklub');?></label>
          </li>
          <li class="to-field">
            <div class="input-sec">
              <input type="text" name="cs_contentslider_num_post[]" class="txtfield" value="<?php echo esc_attr($cs_contentslider_num_post); ?>" />
            </div>
          </li>
        </ul>
        <?php 
			if ( function_exists( 'cs_shortcode_custom_classes' ) ) {
				cs_shortcode_custom_dynamic_classes($cs_contentslider_class,$cs_contentslider_animation,'','cs_contentslider');
			}
			?>
      </div>
      <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){?>
      <ul class="form-elements insert-bg">
        <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('cs_pb_','',$name));?>','<?php echo esc_js($name.$cs_counter)?>','<?php echo esc_js($filter_element);?>')" ><?php _e('Insert','goalklub');?></a> </li>
      </ul>
      <div id="results-shortocde"></div>
      <?php } else {?>
      <ul class="form-elements noborder">
        <li class="to-label"></li>
        <li class="to-field">
          <input type="hidden" name="cs_orderby[]" value="contentslider" />
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
	add_action('wp_ajax_cs_pb_contentslider', 'cs_pb_contentslider');
}
// Content Slider html form for page builder end

//======================================================================
// Blog html form for page builder start
//======================================================================
if ( ! function_exists( 'cs_pb_blog' ) ) {
	function cs_pb_blog($die = 0){
		global $cs_node, $post;
		$shortcode_element = '';
		$filter_element = 'filterdrag';
		$shortcode_view = '';
		$output = array();
		$counter = $_POST['counter'];
		$cs_counter = $_POST['counter'];
		if ( isset($_POST['action']) && !isset($_POST['shortcode_element_id']) ) {
			$POSTID = '';
			$shortcode_element_id = '';
		} else {
			$POSTID = $_POST['POSTID'];
			$shortcode_element_id = $_POST['shortcode_element_id'];
			$shortcode_str = stripslashes ($shortcode_element_id);
			$PREFIX = 'cs_blog';
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array('cs_blog_section_title'=>'','cs_blog_view'=>'','cs_blog_cat'=>'','cs_blog_orderby'=>'DESC','orderby'=>'ID','cs_blog_description'=>'yes','cs_blog_excerpt'=>'255', 'cs_blog_filterable'=>'','cs_blog_num_post'=>'10','blog_pagination'=>'','cs_blog_class' => '','cs_blog_animation' => '');
			if(isset($output['0']['atts']))
				$atts = $output['0']['atts'];
			else 
				$atts = array();
			$blog_element_size = '50';
			foreach($defaults as $key=>$values){
				if(isset($atts[$key]))
					$$key = $atts[$key];
				else 
					$$key =$values;
			 }
			$name = 'cs_pb_blog';
			$coloumn_class = 'column_'.$blog_element_size;
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
	?>
<div id="<?php echo esc_attr($name.$cs_counter)?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class);?> <?php echo esc_attr($shortcode_view);?>" item="blog" data="<?php echo element_size_data_array_index($blog_element_size)?>">
      <?php cs_element_setting($name,$cs_counter,$blog_element_size,'','newspaper-o');?>
      <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter)?> <?php echo esc_attr($shortcode_element);?>" id="<?php echo esc_attr($name.$cs_counter);?>" data-shortcode-template="[cs_blog {{attributes}}]"  style="display: none;">
        <div class="cs-heading-area">
          <h5><?php _e('Edit Blog Options','goalklub');?></h5>
          <a href="javascript:removeoverlay('<?php echo esc_attr($name.$cs_counter);?>','<?php echo esc_attr($filter_element);?>')" class="cs-btnclose"><i class="icon-cross3"></i></a> </div>
        <div class="cs-pbwp-content">
          <div class="cs-wrapp-clone cs-shortcode-wrapp">
            <?php
             if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
            <ul class="form-elements">
                <li class="to-label"><label><?php _e('Section Title','goalklub');?></label></li>
                <li class="to-field">
                    <input  name="cs_blog_section_title[]" type="text"  value="<?php echo cs_allow_special_char($cs_blog_section_title)?>"   />
                </li>                  
             </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Choose Category','goalklub');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
                    <select name="cs_blog_cat[]" class="dropdown">
                      <option value="0"><?php _e('-- Select Category --','goalklub');?></option>
                      <?php show_all_cats('', '', $cs_blog_cat, "category");?>
                    </select>
                  </div>
                </div>
                <div class="left-info">
                  <p><?php _e('Please select category to show posts. If you dont select category it will display all posts','goalklub');?></p>
                </div>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Blog Design Views','goalklub');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
                    <select name="cs_blog_view[]" class="dropdown">
                      <option value="default" <?php if($cs_blog_view == 'default'){echo 'selected="selected"';}?>><?php _e('Default','goalklub');?></option>
                      <option value="timeline" <?php if($cs_blog_view == 'timeline'){echo 'selected="selected"';}?>><?php _e('Timeline','goalklub');?></option>
                      <option value="small" <?php if($cs_blog_view == 'small'){echo 'selected="selected"';}?>><?php _e('Small','goalklub');?></option>
                      <option value="clean" <?php if($cs_blog_view == 'clean'){echo 'selected="selected"';}?>><?php _e('Clean','goalklub');?></option>
                      <option value="medium" <?php if($cs_blog_view == 'medium'){echo 'selected="selected"';}?>><?php _e('Medium','goalklub');?></option>
                      <option value="grid" <?php if($cs_blog_view == 'grid'){echo 'selected="selected"';}?>><?php _e('Grid','goalklub');?></option>
                      <option value="masonry" <?php if($cs_blog_view == 'masonry'){echo 'selected="selected"';}?>><?php _e('Masonry','goalklub');?></option>
                      <option value="boxed" <?php if($cs_blog_view == 'boxed'){echo 'selected="selected"';}?>><?php _e('Boxed','goalklub');?></option>
                    </select>
                  </div>
                </div>
                <div class="left-info">
                  <p><?php _e('Please select category to show posts. If you dont select category it will display all posts','goalklub');?></p>
                </div>
              </li>
            </ul>
            <div id="Blog-listing<?php echo esc_attr($cs_counter);?>" >
              <ul class="form-elements">
                <li class="to-label">
                  <label><?php _e('Post Order','goalklub');?></label>
                </li>
                <li class="to-field">
                  <div class="input-sec">
                    <div class="select-style">
                      <select name="cs_blog_orderby[]" class="dropdown" >
                        <option <?php if($cs_blog_orderby=="ASC")echo "selected";?> value="ASC"><?php _e('Asc','goalklub');?></option>
                        <option <?php if($cs_blog_orderby=="DESC")echo "selected";?> value="DESC"><?php _e('DESC','goalklub');?></option>
                      </select>
                    </div>
                  </div>
                </li>
              </ul>
              <ul class="form-elements">
                <li class="to-label">
                  <label><?php _e('Post Description','goalklub');?></label>
                </li>
                <li class="to-field">
                  <div class="input-sec">
                    <div class="select-style">
                      <select name="cs_blog_description[]" class="dropdown" >
                        <option <?php if($cs_blog_description=="yes")echo "selected";?> value="yes"><?php _e('Yes','goalklub');?></option>
                        <option <?php if($cs_blog_description=="no")echo "selected";?> value="no"><?php _e('No','goalklub');?></option>
                      </select>
                    </div>
                  </div>
                </li>
              </ul>
              <ul class="form-elements">
                  <li class="to-label">
                    <label>
                      <?php _e('Filterable','goalklub'); ?>
                    </label>
                  </li>
                  <li class="to-field">
                    <div class="input-sec">
                      <div class="select-style">
                        <select name="cs_blog_filterable[]" class="dropdown">
                          <option value="yes" <?php if($cs_blog_filterable=="yes")echo "selected";?> >
                          <?php _e('Yes','goalklub'); ?>
                          </option>
                          <option value="no" <?php if($cs_blog_filterable=="no")echo "selected";?> >
                          <?php _e('No','goalklub'); ?>
                          </option>
                        </select>
                      </div>
                    </div>
                  </li>
              </ul>
              <ul class="form-elements">
                <li class="to-label">
                  <label><?php _e('Length of Excerpt','goalklub');?></label>
                </li>
                <li class="to-field">
                  <div class="input-sec">
                    <input type="text" name="cs_blog_excerpt[]" class="txtfield" value="<?php echo esc_attr($cs_blog_excerpt);?>" />
                  </div>
                  <div class="left-info">
                    <p><?php _e('Enter number of character for short description text','goalklub');?></p>
                  </div>
                </li>
              </ul>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('No. of Post Per Page','goalklub');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <input type="text" name="cs_blog_num_post[]" class="txtfield" value="<?php echo esc_attr($cs_blog_num_post); ?>" />
                </div>
                <div class="left-info">
                  <p><?php _e('To display all the records, leave this field blank','goalklub');?></p>
                </div>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Pagination','goalklub');?></label>
              </li>
              <li class="to-field select-style">
                <select name="blog_pagination[]" class="dropdown">
                  <option <?php if($blog_pagination=="Show Pagination")echo "selected";?> ><?php _e('Show Pagination','goalklub');?></option>
                  <option <?php if($blog_pagination=="Single Page")echo "selected";?> ><?php _e('Single Page','goalklub');?></option>
                </select>
              </li>
            </ul>
            <?php 
                if ( function_exists( 'cs_shortcode_custom_classes' ) ) {
                    cs_shortcode_custom_dynamic_classes($cs_blog_class,$cs_blog_animation,'','cs_blog');
                }
            ?>
            <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){?>
            <ul class="form-elements insert-bg">
              <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('cs_pb_','',$name));?>','<?php echo esc_js($name.$cs_counter)?>','<?php echo esc_js($filter_element);?>')" ><?php _e('Insert','goalklub');?></a> </li>
            </ul>
            <div id="results-shortocde"></div>
            <?php } else {?>
            <ul class="form-elements">
              <li class="to-label"></li>
              <li class="to-field">
                <input type="hidden" name="cs_orderby[]" value="blog" />
                <input type="button" value="Save" style="margin-right:10px;" onclick="javascript:_removerlay(jQuery(this))" />
              </li>
            </ul>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
<?php
		if ( $die <> 1 ) die();
	}
	add_action('wp_ajax_cs_pb_blog', 'cs_pb_blog');
}
// Blog html form for page builder end

//======================================================================
// Team html form for page builder start
//======================================================================
if ( ! function_exists( 'cs_pb_teams' ) ) {
	function cs_pb_teams($die = 0){
		global $cs_node, $post;
		$shortcode_element = '';
		$filter_element = 'filterdrag';
		$shortcode_view = '';
		$output = array();
		$counter = $_POST['counter'];
		if ( isset($_POST['action']) && !isset($_POST['shortcode_element_id']) ) {
			$POSTID = '';
			$shortcode_element_id = '';
			$cs_counter = $_POST['counter'];
		} else {
			$POSTID = $_POST['POSTID'];
			$cs_counter = $_POST['counter'];
			$PREFIX = 'cs_team';
			$shortcode_element_id = $_POST['shortcode_element_id'];
			$shortcode_str = stripslashes ($shortcode_element_id);
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array( 'cs_team_section_title' => '','cs_team_view' => 'default','cs_team_name' => '','cs_team_designation' => '','cs_team_title' => '','cs_team_profile_image' => '','cs_team_fb_url' => '','cs_team_twitter_url' => '','cs_team_googleplus_url' => '','cs_team_skype_url' => '','cs_team_email' => '','teams_class' => '','teams_animation' => '');

		if(isset($output['0']['atts']))
			$atts = $output['0']['atts'];
		else 
			$atts = array();
		
		if(isset($output['0']['content']))
			$cs_team_description = $output['0']['content'];
		else 
			$cs_team_description = "";
			
		$teams_element_size = '25';
		foreach($defaults as $key=>$values){
			if(isset($atts[$key]))
				$$key = $atts[$key];
			else 
				$$key =$values;
		 }
		$name = 'cs_pb_teams';
		$coloumn_class = 'column_'.$teams_element_size;
	if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
		$shortcode_element = 'shortcode_element_class';
		$shortcode_view = 'cs-pbwp-shortcode';
		$filter_element = 'ajax-drag';
		$coloumn_class = '';
	}
	$rand_counter = rand(888, 9999999);
	?>

<div id="<?php echo esc_attr( $name.$cs_counter)?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class);?> <?php echo esc_attr($shortcode_view);?>" item="blog" data="<?php echo element_size_data_array_index($teams_element_size)?>">
      <?php cs_element_setting($name,$cs_counter,$teams_element_size,'','newspaper-o');?>
      <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter)?> <?php echo esc_attr($shortcode_element);?>" id="<?php echo esc_attr($name.$cs_counter);?>" data-shortcode-template="[cs_team {{attributes}}]{{content}}[/cs_team]"  style="display: none;">
        <div class="cs-heading-area">
          <h5><?php _e('Edit Team Options','goalklub');?></h5>
          <a href="javascript:removeoverlay('<?php echo esc_attr($name.$cs_counter);?>','<?php echo esc_attr($filter_element);?>')" class="cs-btnclose"><i class="icon-cross3"></i></a> </div>
        <div class="cs-pbwp-content">
          <div class="cs-wrapp-clone cs-shortcode-wrapp">
                <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
                <ul class="form-elements">
                    <li class="to-label"><label><?php _e('Section Title','goalklub');?></label></li>
                    <li class="to-field">
                        <input  name="cs_team_section_title[]" type="text"  value="<?php echo cs_allow_special_char($cs_team_section_title)?>"   />
                    </li>                  
                 </ul>
                <ul class="form-elements">
                  <li class="to-label">
                    <label><?php _e('Team Views','goalklub');?></label>
                  </li>
                  <li class="to-field">
                  	<div class="select-style">
                    <select class="cs_size" name="cs_team_view[]">
                      <option value="default" <?php if($cs_team_view == 'default'){echo 'selected="selected"';}?>><?php _e('Default View','goalklub');?></option>
                      <option value="thumb" <?php if($cs_team_view == 'thumb'){echo 'selected="selected"';}?>><?php _e('Thumbnails View','goalklub');?></option>
                    </select>
                    </div>
                  </li>
                </ul>
                <ul class="form-elements">
                  <li class="to-label">
                    <label><?php _e('Name','goalklub');?></label>
                  </li>
                  <li class="to-field">
                    <input type="text" name="cs_team_name[]" value="<?php echo esc_attr($cs_team_name);?>" />
                  </li>
                </ul>
                <ul class="form-elements">
                  <li class="to-label">
                    <label><?php _e('Designation','goalklub');?></label>
                  </li>
                  <li class="to-field">
                    <input type="text" name="cs_team_designation[]" value="<?php echo esc_attr($cs_team_designation);?>" />
                  </li>
                </ul>
              
                 <ul class="form-elements">
                  <li class="to-label">
                    <label><?php _e('short Description','goalklub');?></label>
                  </li>
                  <li class="to-field">
                    <textarea name="cs_team_description[]" rows="8" cols="40" data-content-text="cs-shortcode-textarea"><?php echo esc_textarea($cs_team_description);?></textarea>
                  </li>
                </ul>
             
                <ul class="form-elements">
                  <li class="to-label">
                    <label><?php _e('Team Profile Image','goalklub');?></label>
                  </li>
                  <li class="to-field">
                    <input id="cs_team_profile_image<?php echo esc_attr($rand_counter)?>" name="cs_team_profile_image[]" type="hidden" class="" value="<?php echo esc_url($cs_team_profile_image);?>"/>
                    <input name="cs_team_profile_image<?php echo esc_attr($rand_counter);?>"  type="button" class="uploadMedia left" value="<?php _e('Browse','goalklub');?>"/>
                  </li>
                </ul>
                <div class="page-wrap" style="overflow:hidden; display:<?php echo esc_url($cs_team_profile_image) && trim($cs_team_profile_image) !='' ? 'inline' : 'none';?>" id="cs_team_profile_image<?php echo esc_attr($rand_counter)?>_box" >
                  <div class="gal-active">
                    <div class="dragareamain" style="padding-bottom:0px;">
                      <ul id="gal-sortable">
                        <li class="ui-state-default" id="">
                          <div class="thumb-secs"> <img src="<?php echo esc_url($cs_team_profile_image);?>"  id="cs_team_profile_image<?php echo esc_attr($rand_counter)?>_img" width="100" height="150"  />
                            <div class="gal-edit-opts"> <a href="javascript:del_media('cs_team_profile_image<?php echo esc_attr($rand_counter);?>')" class="delete"></a> </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <ul class="form-elements">
                  <li class="to-label">
                    <label><?php _e('Facebook','goalklub');?></label>
                  </li>
                  <li class="to-field">
                    <input type="text" name="cs_team_fb_url[]" value="<?php echo esc_url($cs_team_fb_url);?>" />
                  </li>
                </ul>
                <ul class="form-elements">
                  <li class="to-label">
                    <label><?php _e('Twitter Url','goalklub');?></label>
                  </li>
                  <li class="to-field">
                    <input type="text" name="cs_team_twitter_url[]" value="<?php echo esc_url($cs_team_twitter_url);?>" />
                  </li>
                </ul>
                <ul class="form-elements">
                  <li class="to-label">
                    <label><?php _e('Google+','goalklub');?></label>
                  </li>
                  <li class="to-field">
                    <input type="text" name="cs_team_googleplus_url[]" value="<?php echo esc_url($cs_team_googleplus_url);?>" />
                  </li>
                </ul>
                <ul class="form-elements">
                  <li class="to-label">
                    <label><?php _e('Skype','goalklub');?></label>
                  </li>
                  <li class="to-field">
                    <input type="text" name="cs_team_skype_url[]" value="<?php echo esc_url($cs_team_skype_url);?>" />
                  </li>
                </ul>
                <ul class="form-elements">
                  <li class="to-label">
                    <label><?php _e('Email','goalklub');?></label>
                  </li>
                  <li class="to-field">
                    <input type="text" name="cs_team_email[]" value="<?php echo sanitize_email($cs_team_email);?>" />
                  </li>
                </ul>
                <ul class="form-elements">
                    <li class="to-label"><label><?php _e('Custom ID','goalklub');?></label></li>
                    <li class="to-field">
                        <input type="text" name="teams_class[]" class="txtfield"  value="<?php echo esc_attr($teams_class)?>" />
                    </li>
                 </ul>
                <ul class="form-elements">
                    <li class="to-label"><label><?php _e('Animation Class','goalklub');?> </label></li>
                    <li class="to-field select-style">
                        <select class="dropdown" name="teams_animation[]">
                            <option value=""><?php _e('Select Animation','goalklub');?></option>
                            <?php 
                                $animation_array = cs_animation_style();
                                foreach($animation_array as $animation_key=>$animation_value){
                                    echo '<optgroup label="'.$animation_key.'">';	
                                    foreach($animation_value as $key=>$value){
                                        $selected = '';
                                        if($teams_animation == $key){$selected = 'selected="selected"';}
                                        echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
                                    }
                                }
                             ?>
                          </select>
                    </li>
                </ul>
              </div>
            <div class="wrapptabbox no-padding-lr">
              <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){?>
              <ul class="form-elements insert-bg">
                <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('cs_pb_','',$name));?>','<?php echo esc_js($name.$cs_counter)?>','<?php echo esc_js($filter_element);?>')" ><?php _e('Insert','goalklub');?></a> </li>
              </ul>
              <div id="results-shortocde"></div>
              <?php } else {
				   ?>
              	<ul class="form-elements noborder">
                <li class="to-label"></li>
                <li class="to-field">
                  <input type="hidden" name="cs_orderby[]" value="teams" />
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
        add_action('wp_ajax_cs_pb_teams', 'cs_pb_teams');
    }
// Clients Html form for page builder End

//======================================================================
// Club History for page builder start
//======================================================================
if ( ! function_exists( 'cs_pb_club_history' ) ) {
	function cs_pb_club_history($die = 0){
		global $cs_node, $count_node, $post;
		
		$shortcode_element = '';
		$filter_element = 'filterdrag';
		$shortcode_view = '';
		$output = array();
		$cs_counter = $_POST['counter'];
		$PREFIX = 'cs_club_history|club_history_item';
		$parseObject 	= new ShortcodeParse();
		$club_history_num = 0;
		if ( isset($_POST['action']) && !isset($_POST['shortcode_element_id']) ) {
			$POSTID = '';
			$shortcode_element_id = '';
		} else {
			$POSTID = $_POST['POSTID'];
			$shortcode_element_id = $_POST['shortcode_element_id'];
			$shortcode_str = stripslashes ($shortcode_element_id);
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		
		$defaults = array('column_size'=>'1/2','cs_club_history_section_title' => '','cs_club_history_view' => '','cs_club_history_class' => '','cs_club_history_animation' => '');
		
		if(isset($output['0']['atts']))
			$atts = $output['0']['atts'];
		else 
			$atts = array();
		
		if(isset($output['0']['content']))
			$atts_content = $output['0']['content'];
		else 
			$atts_content = array();
		
		if(is_array($atts_content))
			$club_history_num = count($atts_content);
			
		$club_history_element_size = '50';
		foreach($defaults as $key=>$values){
			if(isset($atts[$key]))
				$$key = $atts[$key];
			else 
				$$key =$values;
		 }
		$name = 'cs_pb_club_history';
		$coloumn_class = 'column_'.$club_history_element_size;
		
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
	?>
<div id="<?php echo cs_allow_special_char($name.$cs_counter)?>_del" class="column  parentdelete <?php echo cs_allow_special_char($coloumn_class);?> <?php echo cs_allow_special_char($shortcode_view);?>" item="club_history" data="<?php echo element_size_data_array_index($club_history_element_size)?>" >
  <?php cs_element_setting($name,$cs_counter,$club_history_element_size,'','list-ul');?>
  <div class="cs-wrapp-class-<?php echo cs_allow_special_char($cs_counter)?> <?php echo cs_allow_special_char($shortcode_element);?>" id="<?php echo cs_allow_special_char($name.$cs_counter)?>" data-shortcode-template="[cs_club_history {{attributes}}]" style="display: none;">
    <div class="cs-heading-area">
      <h5><?php _e('Edit Club History Options','goalklub');?></h5>
      <a href="javascript:removeoverlay('<?php echo cs_allow_special_char($name.$cs_counter)?>','<?php echo cs_allow_special_char($filter_element);?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
      <div class="cs-clone-append cs-pbwp-content">
       <div class="cs-wrapp-tab-box">
        <div id="shortcode-item-<?php echo cs_allow_special_char($cs_counter);?>" data-shortcode-template="{{child_shortcode}}[/cs_club_history]" data-shortcode-child-template="[club_history_item {{attributes}}] {{content}} [/club_history_item]">
          <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[cs_club_history {{attributes}}]">
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Section Title','goalklub');?></label>
              </li>
              <li class="to-field">
                <div class='input-sec'><input  name="cs_club_history_section_title[]" type="text"  value="<?php echo cs_allow_special_char($cs_club_history_section_title)?>" /></div>
                <div class='left-info'>
                  <p> <?php _e('This is used for the one page navigation, to identify the section below. Give a title','goalklub');?></p>
                </div>
              </li>
            </ul>
            <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
            
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('View','goalklub');?></label>
              </li>
              <li class="to-field select-style">
                <select id="cs_club_history_view" name="cs_club_history_view[]">
                  <option value="list" <?php if($cs_club_history_view == 'list'){echo 'selected="selected"';}?>><?php _e('List View','goalklub');?></option>
                  <option value="grid" <?php if($cs_club_history_view == 'grid'){echo 'selected="selected"';}?>><?php _e('Grid View','goalklub');?></option>
                </select>
              </li>
            </ul>
        
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Custom ID','goalklub');?></label>
              </li>
              <li class="to-field">
                <div class='input-sec'><input type="text" name="cs_club_history_class[]" class="txtfield"  value="<?php echo cs_allow_special_char($cs_club_history_class);?>" /></div>
                <div class='left-info'>
                  <p><?php _e('Use this option if you want to use specified  id for this element','goalklub');?></p>
                </div>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Animation Class','goalklub');?> </label>
              </li>
              <li class="to-field select-style">
              	<div class='input-sec select-style'>
                <select class="dropdown" name="cs_club_history_animation[]">
                  <option value=""><?php _e('Select Animation','goalklub');?></option>
                  <?php 
						$animation_array = cs_animation_style();
						foreach($animation_array as $animation_key=>$animation_value){
							echo '<optgroup label="'.$animation_key.'">';	
							foreach($animation_value as $key=>$value){
								$active_class = '';
								if($cs_club_history_animation == $key){$active_class = 'selected="selected"';}
								echo '<option value="'.$key.'" '.$active_class.'>'.$value.'</option>';
							}
						}
					
					 ?>
                </select>
                </div>
                <div class='left-info'>
                  <p><?php _e('Select Entrance animation type from the dropdown','goalklub');?> </p>
                </div>
              </li>
            </ul>
          </div>
          <?php
			if ( isset($club_history_num) && $club_history_num <> '' && isset($atts_content) && is_array($atts_content)){
				foreach ( $atts_content as $club_history ){
					$rand_id = $cs_counter.''.cs_generate_random_string(3);
					$rand_counter = rand(36, 36858);
					$club_history_text = $club_history['content'];
					$defaults = array( 'club_history_title' => 'Title', 'cs_club_history_image' => '', 'club_history_year' => '');
					foreach($defaults as $key=>$values){
						if(isset($club_history['atts'][$key]))
							$$key = $club_history['atts'][$key];
						else 
							$$key =$values;
					 }
					
					?>
          <div class='cs-wrapp-clone cs-shortcode-wrapp  cs-pbwp-content'  id="cs_infobox_<?php echo cs_allow_special_char($rand_id);?>">
            <header>
              <h4><i class='icon-arrows'></i><?php _e('Club History','goalklub');?></h4>
              <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php _e('Remove','goalklub');?></a></header>
            
            <ul class='form-elements'>
              <li class='to-label'>
                <label><?php _e('Title','goalklub');?></label>
              </li>
              <li class='to-field'>
                <div class='input-sec'>
                  <div class='input-sec'><input class='txtfield' type='text' name='club_history_title[]' value="<?php echo cs_allow_special_char($club_history_title);?>" /></div>
                  <div class='left-info'>
                    <p><?php _e('Enter Club History title','goalklub');?></p>
                  </div>
                </div>
              </li>
            </ul>
            
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Image','goalklub');?></label>
              </li>
              <li class="to-field">
                <input id="club_history_image<?php echo esc_attr($rand_counter);?>" name="cs_club_history_image[]" type="hidden" class="" value="<?php echo esc_url($cs_club_history_image);?>"/>
                <input name="club_history_image<?php echo esc_attr($rand_counter);?>" type="button" class="uploadMedia left" value="<?php _e('Browse','goalklub');?>"/>
              </li>
            </ul>
            <div class="page-wrap" style="overflow:hidden; display:<?php echo esc_url($cs_club_history_image) && trim($cs_club_history_image) !='' ? 'inline' : 'none';?>" id="club_history_image<?php echo esc_attr($rand_counter);?>_box" >
              <div class="gal-active">
                <div class="dragareamain" style="padding-bottom:0px;">
                  <ul id="gal-sortable">
                    <li class="ui-state-default" id="">
                      <div class="thumb-secs"> <img src="<?php echo esc_url($cs_club_history_image);?>" id="club_history_image<?php echo esc_attr($rand_counter);?>_img" width="100" height="150"  />
                        <div class="gal-edit-opts"> <a   href="javascript:del_media('club_history_image<?php echo esc_attr($rand_counter);?>')" class="delete"></a> </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          
            <ul class='form-elements'>
              <li class='to-label'>
                <label><?php _e('Year','goalklub');?></label>
              </li>
              <li class='to-field'>
                <div class='input-sec'>
                  <div class='input-sec'><input class='txtfield' type='text' name='club_history_year[]' value="<?php echo cs_allow_special_char($club_history_year);?>" /></div>
                  <div class='left-info'>
                    <p><?php _e('Enter Club History Year','goalklub');?></p>
                  </div>
                </div>
              </li>
            </ul>
            
            <ul class='form-elements'>
              <li class='to-label'>
                <label><?php _e('Text','goalklub');?></label>
              </li>
              <li class='to-field'>
                <div class='input-sec'>
                  <textarea class='txtfield' data-content-text="cs-shortcode-textarea" name='club_history_text[]'><?php echo cs_allow_special_char($club_history_text);?></textarea>
                  <div class='left-info'>
                    <p><?php _e('Enter your content','goalklub');?></p>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <?php
			}
		}
		?>
        </div>
        <div class="hidden-object">
          <input type="hidden" name="club_history_num[]" value="<?php echo cs_allow_special_char($club_history_num);?>" class="fieldCounter"  />
        </div>
        <div class="wrapptabbox">
          <div class="opt-conts">
            <ul class="form-elements noborder">
              <li class="to-field"> <a href="#" class="add_servicesss cs-main-btn" onclick="cs_shortcode_element_ajax_call('club_history', 'shortcode-item-<?php echo cs_allow_special_char($cs_counter);?>', '<?php echo cs_allow_special_char(admin_url('admin-ajax.php'));?>')"><i class="icon-plus-circle"></i><?php _e('Add Item','goalklub');?></a> </li>
               <div id="loading" class="shortcodeload"></div>
            </ul>
            <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){?>
            <ul class="form-elements insert-bg">
              <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('cs_pb_','',$name));?>','shortcode-item-<?php echo cs_allow_special_char($cs_counter);?>','<?php echo cs_allow_special_char($filter_element);?>')" ><?php _e('Insert','goalklub');?></a> </li>
            </ul>
            <div id="results-shortocde"></div>
            <?php } else {?>
            <ul class="form-elements noborder">
              <li class="to-label"></li>
              <li class="to-field">
                <input type="hidden" name="cs_orderby[]" value="club_history" />
                <input type="button" value="Save" style="margin-right:10px;" onclick="javascript:_removerlay(jQuery(this))" />
              </li>
            </ul>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
		if ( $die <> 1 ) die();
	}
	add_action('wp_ajax_cs_pb_club_history', 'cs_pb_club_history');
}

//======================================================================
// Twitter html form for page builder start
//======================================================================
if ( ! function_exists( 'cs_pb_tweets' ) ) {
	function cs_pb_tweets($die = 0){
		global $cs_node, $post;
		$shortcode_element = '';
		$filter_element = 'filterdrag';
		$shortcode_view = '';
		$output = array();
		$counter = $_POST['counter'];
		$cs_counter = $_POST['counter'];
		if ( isset($_POST['action']) && !isset($_POST['shortcode_element_id']) ) {
			$POSTID = '';
			$shortcode_element_id = '';
		} else {
			$POSTID = $_POST['POSTID'];
			$shortcode_element_id = $_POST['shortcode_element_id'];
			$shortcode_str = stripslashes ($shortcode_element_id);
			$PREFIX = 'cs_tweets';
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array( 'cs_tweets_section_title' => '','cs_tweets_user_name' => 'default','cs_no_of_tweets' => '','cs_tweets_color'=>'','cs_tweets_class' => '','cs_tweets_animation' => '');
		if(isset($output['0']['atts']))
			$atts = $output['0']['atts'];
		else 
			$atts = array();
		$tweets_element_size = '25';
		foreach($defaults as $key=>$values){
			if(isset($atts[$key]))
				$$key = $atts[$key];
			else 
				$$key =$values;
		 }
		$name = 'cs_pb_tweets';
		$coloumn_class = 'column_'.$tweets_element_size;
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
	?>
<div id="<?php echo esc_attr($name.$cs_counter)?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class);?> <?php echo esc_attr($shortcode_view);?>" item="blog" data="<?php echo element_size_data_array_index($tweets_element_size)?>" >
		<?php cs_element_setting($name,$cs_counter,$tweets_element_size,'','twitter');?>
			<div class="cs-wrapp-class-<?php echo esc_attr($cs_counter)?> <?php echo esc_attr($shortcode_element);?>" id="<?php echo esc_attr($name.$cs_counter)?>" data-shortcode-template="[cs_tweets {{attributes}}]" style="display: none;">
				<div class="cs-heading-area">
					<h5><?php _e('Edit Twitter Options','goalklub');?></h5>
					<a href="javascript:removeoverlay('<?php echo esc_attr($name.$cs_counter)?>','<?php echo esc_attr($filter_element);?>')" class="cs-btnclose"><i class="icon-cross3"></i></a>
				</div>
				<div class="cs-pbwp-content">
                 	<div class="cs-wrapp-clone cs-shortcode-wrapp">
                       <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
                   
                            <ul class="form-elements">
                              <li class="to-label">
                                <label><?php _e('User Name','goalklub');?></label>
                              </li>
                              <li class="to-field">
                                <input type="text" name="cs_tweets_user_name[]" value="<?php echo esc_attr($cs_tweets_user_name);?>" />
                              </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label"><label><?php _e('Text Color','goalklub');?></label></li>
                                <li class="to-field">
                                    <input type="text" name="cs_tweets_color[]" class="bg_color"  value="<?php echo esc_attr($cs_tweets_color)?>" />
                                </li>
                            </ul>
                            <ul class="form-elements">
                              <li class="to-label">
                                <label><?php _e('No of Tweets','goalklub');?></label>
                              </li>
                              <li class="to-field">
                                <input type="text" name="cs_no_of_tweets[]" value="<?php echo (int)$cs_no_of_tweets;?>" />
                              </li>
                            </ul>
                              <?php 
                                if ( function_exists( 'cs_shortcode_custom_dynamic_classes' ) ) {
                                   cs_shortcode_custom_dynamic_classes($cs_tweets_class,$cs_tweets_animation,'','cs_tweets');
                                }
                              ?>
                      </div>
					  <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){?>
							<ul class="form-elements insert-bg">
								<li class="to-field">
									<a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('cs_pb_','',$name));?>','<?php echo esc_js($name.$cs_counter)?>','<?php echo esc_js($filter_element);?>')" ><?php _e('Insert','goalklub');?></a>
								</li>
							</ul>
							<div id="results-shortocde"></div>
						<?php } else {?>
							<ul class="form-elements noborder">
								<li class="to-label"></li>
								<li class="to-field">
									<input type="hidden" name="cs_orderby[]" value="tweets" />
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
        add_action('wp_ajax_cs_pb_tweets', 'cs_pb_tweets');
    }
// Twitter Html form for page builder End