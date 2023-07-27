<?php
/**
 * File Type: Content Blockd Shortcode Elements
 */

/** 
 * @Information Box html form for page builder
 */
if ( ! function_exists( 'cs_pb_infobox' ) ) {
	function cs_pb_infobox($die = 0){
		global $cs_node, $post;
		$shortcode_element = '';
		$filter_element = 'filterdrag';
		$shortcode_view = '';
		$output = array();
		$cs_counter = $_POST['counter'];
		$info_list_num = 0;
		if ( isset($_POST['action']) && !isset($_POST['shortcode_element_id']) ) {
			$POSTID = '';
			$shortcode_element_id = '';
		} else {
			$POSTID = $_POST['POSTID'];
			$shortcode_element_id = $_POST['shortcode_element_id'];
			$shortcode_str = stripslashes ($shortcode_element_id);
			$PREFIX = 'cs_infobox|infobox_item';
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array('column_size'=>'1/1', 'cs_infobox_section_title' => '', 'cs_infobox_title' => '','cs_infobox_bg_color' => '','cs_infobox_list_text_color'=>'','cs_infobox_class' => '','cs_infobox_animation' => '');
			if(isset($output['0']['atts']))
				$atts = $output['0']['atts'];
			else 
				$atts = array();
			if(isset($output['0']['content']))
				$atts_content = $output['0']['content'];
			else 
				$atts_content = array();
			if(is_array($atts_content))
					$info_list_num = count($atts_content);
			$infobox_element_size = '25';
			foreach($defaults as $key=>$values){
				if(isset($atts[$key]))
					$$key = $atts[$key];
				else 
					$$key =$values;
			 }
			$name = 'cs_pb_infobox';
			$coloumn_class = 'column_'.$infobox_element_size;
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
	?>

<div id="<?php echo cs_allow_special_char($name.$cs_counter)?>_del" class="column  parentdelete <?php echo cs_allow_special_char($coloumn_class);?> <?php echo esc_attr($shortcode_view);?>" item="infobox" data="<?php echo element_size_data_array_index($infobox_element_size)?>" >
  <?php cs_element_setting($name,$cs_counter,$infobox_element_size,'','info-circle');?>
  <div class="cs-wrapp-class-<?php echo cs_allow_special_char($cs_counter)?> <?php echo cs_allow_special_char($shortcode_element);?>" id="<?php echo cs_allow_special_char($name.$cs_counter)?>" style="display: none;">
    <div class="cs-heading-area">
      <h5><?php _e('Edit Infobox Options','goalklub');?></h5>
      <a href="javascript:removeoverlay('<?php echo cs_allow_special_char($name.$cs_counter)?>','<?php echo cs_allow_special_char($filter_element);?>')" class="cs-btnclose"><i class="icon-cross3"></i></a> </div>
     <div class="cs-clone-append cs-pbwp-content" >
       <div class="cs-wrapp-tab-box">
        <div id="shortcode-item-<?php echo esc_attr($cs_counter);?>" data-shortcode-template="{{child_shortcode}} [/cs_infobox]" data-shortcode-child-template="[infobox_item {{attributes}}] {{content}} [/infobox_item]">
          <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true" data-template="[cs_infobox {{attributes}}]">
            <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Section Title','goalklub');?></label>
              </li>
              <li class="to-field">
                <input  name="cs_infobox_section_title[]" type="text"  value="<?php echo cs_allow_special_char($cs_infobox_section_title);?>"   />
                <p> <?php _e('This is used for the one page navigation, to identify the section below. Give a title','goalklub');?>  </p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Title','goalklub');?></label>
              </li>
              <li class="to-field">
                <input type="text" name="cs_infobox_title[]" class="txtfield" value="<?php echo cs_allow_special_char($cs_infobox_title);?>" />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Background Color','goalklub');?></label>
              </li>
              <li class="to-field">
                <input type="text" name="cs_infobox_bg_color[]" class="bg_color" value="<?php echo esc_attr($cs_infobox_bg_color);?>" />
                <div class="left-box">
                	<p><?php _e('Provide a hex background colour code here (include #)','goalklub');?></p>
                </div>
              </li>
            </ul>
            <ul class='form-elements'>
              <li class='to-label'>
                <label><?php _e('Text Color','goalklub');?></label>
              </li>
              <li class='to-field'>
                <div class='input-sec'>
                  <input class='bg_color' type='text' name='cs_infobox_list_text_color[]' value="<?php echo esc_attr($cs_infobox_list_text_color); ?>" />
                  <div class="left-box">
                  	<p><?php _e('Provide a hex colour code here (include #) if you want to override the default','goalklub');?> </p>
                  </div>
                </div>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Class','goalklub');?></label>
              </li>
              <li class="to-field">
                <input type="text" name="cs_infobox_class[]" class="txtfield"  value="<?php echo esc_attr($cs_infobox_class)?>" />
                <p><?php _e('Use this option if you want to use specified id for this element','goalklub');?></p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Animation Class','goalklub');?></label>
              </li>
              <li class="to-field select-style">
                <select class="dropdown" name="cs_infobox_animation[]">
                  <option value=""><?php _e('Select Animation','goalklub');?></option>
                  <?php 
						$animation_array = cs_animation_style();
						foreach($animation_array as $animation_key=>$animation_value){
							echo '<optgroup label="'.$animation_key.'">';	
							foreach($animation_value as $key=>$value){
								$active_class = '';
								if($cs_infobox_animation == $key){$active_class = 'selected="selected"';}
								echo '<option value="'.$key.'" '.$active_class.'>'.$value.'</option>';
							}
						}
					?>
                </select>
                <p><?php _e('Select Entrance animation type from the dropdown','goalklub');?> </p>
              </li>
            </ul>
          </div>
          <?php
		  if ( isset($info_list_num) && $info_list_num <> '' && isset($atts_content) && is_array($atts_content)){
							
			foreach ( $atts_content as $infobox_item ){
				
				$rand_id = $cs_counter.''.cs_generate_random_string(3);
				$cs_infobox_list_description = $infobox_item['content'];
				$defaults = array('cs_infobox_list_icon'=>'','cs_infobox_list_color'=>'','cs_infobox_list_title'=>'');
				foreach($defaults as $key=>$values){
					if(isset($infobox_item['atts'][$key]))
						$$key = $infobox_item['atts'][$key];
					else 
						$$key =$values;
				 }
			?>
          <div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo cs_allow_special_char($rand_id);?>">
            <header>
              <h4><i class='icon-arrows'></i><?php _e('Infobox Item(s)','goalklub');?></h4>
              <a href='#' class='deleteit_node'><i class='icon-minus8-circle'></i><?php _e('Remove','goalklub');?></a></header>
            <ul class='form-elements'>
              <li class='to-label'>
                <label><?php _e('Info Box IconMoon','goalklub');?></label>
              </li>
             <li class="to-field">
                <?php cs_fontawsome_icons_box($cs_infobox_list_icon,$rand_id,'cs_infobox_list_icon');?>
              </li>
            </ul>
            <ul class='form-elements'>
              <li class='to-label'>
                <label><?php _e('Icon Color','goalklub');?></label>
              </li>
              <li class='to-field'>
                <div class='input-sec'>
                  <input class='bg_color' type='text' name='cs_infobox_list_color[]' value="<?php echo cs_allow_special_char($cs_infobox_list_color); ?>" />
                </div>
              </li>
            </ul>
            <ul class='form-elements'>
              <li class='to-label'>
                <label><?php _e('Title','goalklub');?></label>
              </li>
              <li class='to-field'>
                <div class='input-sec'>
                  <input class='txtfield' type='text' name='cs_infobox_list_title[]' value="<?php echo cs_allow_special_char($cs_infobox_list_title); ?>" />
                </div>
              </li>
            </ul>
            <ul class='form-elements'>
              <li class='to-label'>
                <label><?php _e('Short Description','goalklub');?></label>
              </li>
              <li class='to-field'>
                <div class='input-sec'>
                  <textarea name='cs_infobox_list_description[]' rows="8" cols="20" data-content-text="cs-shortcode-textarea"><?php echo cs_allow_special_char($cs_infobox_list_description);?></textarea>
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
          <input type="hidden" name="info_list_num[]" value="<?php echo (int)$info_list_num;?>" class="fieldCounter"  />
        </div>
        <div class="wrapptabbox" style="padding:0">
          <div class="opt-conts">
            <ul class="form-elements noborder">
              <li class="to-field"> <a href="#" class="add_servicesss cs-main-btn" onclick="cs_shortcode_element_ajax_call('infobox_items', 'shortcode-item-<?php echo cs_allow_special_char($cs_counter);?>', '<?php echo cs_allow_special_char(admin_url('admin-ajax.php'));?>')"><i class="icon-plus7"></i><?php _e('Add Item','goalklub');?></a> </li>
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
                <input type="hidden" name="cs_orderby[]" value="infobox" />
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
	add_action('wp_ajax_cs_pb_infobox', 'cs_pb_infobox');
}

/** 
 * @Icons html form for page builder
 */ 
if ( ! function_exists( 'cs_pb_icons' ) ) {
	function cs_pb_icons($die = 0){
		global $cs_node, $count_node, $post;
		$shortcode_element = '';
		$filter_element = 'filterdrag';
		$shortcode_view = '';
		$output = array();
		$cs_counter = $_POST['counter'];
		if ( isset($_POST['action']) && !isset($_POST['shortcode_element_id']) ) {
			$POSTID = '';
			$shortcode_element_id = '';
		} else {
			$POSTID = $_POST['POSTID'];
			$shortcode_element_id = $_POST['shortcode_element_id'];
			$shortcode_str = stripslashes ($shortcode_element_id);
			$PREFIX = 'cs_icons';
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array( 'font_type' => '','icon_view' => '','font_size' => '','icon_color' => '','icon_bg_color' => '','font_icon' => '','cs_icons_class' => '','cs_icons_animation' => '');
			if(isset($output['0']['atts']))
				$atts = $output['0']['atts'];
			else 
				$atts = array();
			
			$icons_element_size = '25';
			foreach($defaults as $key=>$values){
				if(isset($atts[$key]))
					$$key = $atts[$key];
				else 
					$$key =$values;
			 }
			$name = 'cs_pb_icons';
			$coloumn_class = 'column_'.$icons_element_size;
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
		$rand_counter = cs_generate_random_string(10);
	?>
<script>
	cs_toggle_alerts();
</script>
<div id="<?php echo esc_attr($name.$cs_counter);?>_del" class="column parentdelete <?php echo esc_attr($coloumn_class);?> <?php echo esc_attr($shortcode_view);?>" item="icons" data="<?php echo element_size_data_array_index($icons_element_size)?>" >
  <?php cs_element_setting($name,$cs_counter,$icons_element_size,'','empire');?>
  <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter)?> <?php echo esc_attr($shortcode_element);?>" id="<?php echo esc_attr($name.$cs_counter)?>" data-shortcode-template="[cs_icons {{attributes}}]" style="display: none;">
    <div class="cs-heading-area">
      <h5><?php _e('Edit Icon Options','goalklub');?></h5>
      <a href="javascript:removeoverlay('<?php echo esc_attr($name.$cs_counter)?>','<?php echo esc_attr($filter_element);?>')" class="cs-btnclose"><i class="icon-cross3"></i></a> </div>
    <div class="cs-pbwp-content">
      <div class="cs-wrapp-clone cs-shortcode-wrapp">
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('choose view','goalklub');?></label>
          </li>
          <li class="to-field select-style">
            <select class="icon_view" id="icon_view" name="icon_view[]" onchange="cs_icon_toggle_view(this.value,'<?php echo esc_attr($rand_counter);?>', jQuery(this))">
              <option <?php if($icon_view == 'bg_style'){echo 'selected="selected"';}?> value="bg_style"><?php _e('Background Style','goalklub');?></option>
              <option <?php if($icon_view == 'border_style'){echo 'selected="selected"';}?> value="border_style"><?php _e('Border Style','goalklub');?></option>
            </select>
          </li>
        </ul>
        
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Icon Type','goalklub');?></label>
          </li>
          <li class="to-field select-style">
            <select class="font_type" id="font_type" name="font_type[]">
              <option <?php if($font_type == 'circle'){echo 'selected="selected"';}?> value="circle"><?php _e('Circle','goalklub');?></option>
              <option <?php if($font_type == 'square'){echo 'selected="selected"';}?> value="square"><?php _e('Square','goalklub');?></option>
            </select>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Font Size','goalklub');?></label>
          </li>
          <li class="to-field select-style">
            <select class="font_size" id="font_size" name="font_size[]">
              <option <?php if($font_size == 'small'){echo 'selected="selected"';}?> value="small"><?php _e('Small','goalklub');?></option>
              <option <?php if($font_size == 'medium'){echo 'selected="selected"';}?> value="medium"><?php _e('Medium','goalklub');?></option>
              <option <?php if($font_size == 'large'){echo 'selected="selected"';}?> value="large"><?php _e('Large','goalklub');?></option>
            </select>
            <p><?php _e('Select font size','goalklub');?></p>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Icon Color','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" name="icon_color[]" class="txtfield bg_color" value="<?php echo esc_attr($icon_color);?>" />
            <div class="left-info">
            <p><?php _e('Provide a hex colour code, If you want to override the default','goalklub');?></p>
            </div>
          </li>
        </ul>
        <ul class="form-elements" id="selected_icon_view_<?php echo esc_attr($rand_counter)?>">
          <li class="to-label">
            <label><div id="label-icon"><?php echo trim($icon_view) == '' || $icon_view == 'bg_style' ? 'Icon Background Color' : 'Border Color' ;?></div></label>
            
          </li>
          <li class="to-field">
            <input type="text" name="icon_bg_color[]" class="txtfield bg_color" value="<?php echo esc_attr($icon_bg_color)?>" />
            <div class="left-info">
            <p><?php _e('Add a hex background colour code, If you want to override the default','goalklub');?></p>
            </div>
          </li>
        </ul>
        <ul class='form-elements' id="cs_infobox_<?php echo esc_attr($name.$cs_counter);?>">
          <li class='to-label'>
            <label><?php _e('Choose Icon','goalklub');?></label>
          </li>
          <li class="to-field">
            <?php cs_fontawsome_icons_box($font_icon,$name.$cs_counter,'font_icon');?>
            <div class="left-info">
            <p><?php _e('select the IcoMoon Icons you would like to add to your menu items','goalklub');?> </p>
            </div>
          </li>
        </ul>
        <?php 
		if ( function_exists( 'cs_shortcode_custom_dynamic_classes' ) ) {
			cs_shortcode_custom_dynamic_classes($cs_icons_class,$cs_icons_animation,'','cs_icons');
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
          <input type="hidden" name="cs_orderby[]" value="icons" />
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
	add_action('wp_ajax_cs_pb_icons', 'cs_pb_icons');
}

/** 
 * @ Contactinfo for page builder
 */ 
if ( ! function_exists( 'cs_pb_contactinfo' ) ) {
	function cs_pb_contactinfo($die = 0){
		global $cs_node, $count_node, $post;
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
			$PREFIX = 'cs_contactinfo';
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array( 'column_size'=>'1/1', 'cs_contact_section_title' => '', 'cs_contact_image' => '', 'cs_contact_email' => '', 'cs_contact_phone' => '', 'cs_contact_fax' => '', 'cs_contact_web' => '', 'cs_contact_class' => '', 'cs_contact_animation' => '' );
						
			if(isset($output['0']['atts']))
			$atts = $output['0']['atts'];
			else 
				$atts = array();
			if(isset($output['0']['content']))
				$cs_contact_address = $output['0']['content'];
			else 
				$cs_contact_address = '';
			
			$contactinfo_element_size = '25';
			foreach($defaults as $key=>$values){
				if(isset($atts[$key]))
					$$key = $atts[$key];
				else 
					$$key =$values;
			 }
			$name = 'cs_pb_contactinfo';
			$coloumn_class = 'column_'.$contactinfo_element_size;
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
		$rand_string = cs_generate_random_string(10);
		$rand_counter = cs_generate_random_string(10);
	?>

<div id="<?php echo esc_attr($name.$cs_counter);?>_del" class="column parentdelete <?php echo esc_attr($coloumn_class);?> <?php echo esc_attr($shortcode_view);?>" item="contactinfo" data="<?php echo element_size_data_array_index($contactinfo_element_size)?>" >
  <?php cs_element_setting($name,$cs_counter,$contactinfo_element_size,'','empire');?>
  <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter)?> <?php echo esc_attr($shortcode_element);?>" id="<?php echo esc_attr($name.$cs_counter)?>" data-shortcode-template="[cs_contactinfo {{attributes}}] {{content}} [/cs_contactinfo]" style="display: none;">
    <div class="cs-heading-area">
      <h5><?php _e('Edit Contact Info Options','goalklub');?></h5>
      <a href="javascript:removeoverlay('<?php echo esc_attr($name.$cs_counter)?>','<?php echo esc_attr($filter_element);?>')" class="cs-btnclose"><i class="icon-cross3"></i></a> </div>
    <div class="cs-pbwp-content">
      <div class="cs-wrapp-clone cs-shortcode-wrapp">
      	<?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Section Title','goalklub');?></label>
          </li>
          <li class="to-field">
            <input  name="cs_contact_section_title[]" type="text"  value="<?php echo cs_allow_special_char($cs_contact_section_title);?>"   />
            <p> <?php _e('This is used for the one page navigation, to identify the section below. Give a title','goalklub');?>  </p>
          </li>
        </ul>
        
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Image','goalklub');?></label>
          </li>
          <li class="to-field">
            <input id="cs_contact_image<?php echo esc_attr($rand_string)?>" name="cs_contact_image[]" type="hidden" class="" value="<?php echo esc_url($cs_contact_image);?>"/>
            <input name="cs_contact_image<?php echo esc_attr($rand_string)?>"  type="button" class="uploadMedia left" value="<?php _e('Browse','goalklub');?>"/>
          </li>
        </ul>
        <div class="page-wrap" style="overflow:hidden; display:<?php echo esc_url($cs_contact_image) && trim($cs_contact_image) !='' ? 'inline' : 'none';?>" id="cs_contact_image<?php echo esc_attr($rand_string);?>_box" >
          <div class="gal-active">
            <div class="dragareamain" style="padding-bottom:0px;">
              <ul id="gal-sortable">
                <li class="ui-state-default" id="">
                  <div class="thumb-secs"> <img src="<?php echo esc_url($cs_contact_image);?>"  id="cs_contact_image<?php echo esc_attr($rand_string);?>_img" width="100" height="150"  />
                    <div class="gal-edit-opts"> <a href="javascript:del_media('cs_contact_image<?php echo esc_attr($rand_string);?>')" class="delete"></a> </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Address','goalklub');?></label>
          </li>
          <li class="to-field">
            <textarea name="cs_contact_address[]" data-content-text="cs-shortcode-textarea"><?php echo esc_textarea($cs_contact_address)?></textarea>
            <div class="left-info">
            </div>
          </li>
        </ul>
        
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Email','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" name="cs_contact_email[]" value="<?php echo cs_allow_special_char($cs_contact_email)?>" />
            <div class="left-info">
            </div>
          </li>
        </ul>
        
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Phone','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" name="cs_contact_phone[]" value="<?php echo cs_allow_special_char($cs_contact_phone)?>" />
            <div class="left-info">
            </div>
          </li>
        </ul>
        
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Fax','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" name="cs_contact_fax[]" value="<?php echo cs_allow_special_char($cs_contact_fax)?>" />
            <div class="left-info">
            </div>
          </li>
        </ul>
        
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Website','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" name="cs_contact_web[]" value="<?php echo cs_allow_special_char($cs_contact_web)?>" />
            <div class="left-info">
            </div>
          </li>
        </ul>
        
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Class','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" name="cs_contact_class[]" class="txtfield"  value="<?php echo esc_attr($cs_contact_class)?>" />
            <p><?php _e('Use this option if you want to use specified id for this element','goalklub');?></p>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Animation Class','goalklub');?></label>
          </li>
          <li class="to-field select-style">
            <select class="dropdown" name="cs_contact_animation[]">
              <option value=""><?php _e('Select Animation','goalklub');?></option>
              <?php 
                    $animation_array = cs_animation_style();
                    foreach($animation_array as $animation_key=>$animation_value){
                        echo '<optgroup label="'.$animation_key.'">';	
                        foreach($animation_value as $key=>$value){
                            $active_class = '';
                            if($cs_contact_animation == $key){$active_class = 'selected="selected"';}
                            echo '<option value="'.$key.'" '.$active_class.'>'.$value.'</option>';
                        }
                    }
                ?>
            </select>
            <p><?php _e('Select Entrance animation type from the dropdown','goalklub');?> </p>
          </li>
        </ul>
            
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
          <input type="hidden" name="cs_orderby[]" value="contactinfo" />
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
	add_action('wp_ajax_cs_pb_contactinfo', 'cs_pb_contactinfo');
}

/** 
 * @Google map html form for page builder start
 */
if ( ! function_exists( 'cs_pb_map' ) ) {
	function cs_pb_map($die = 0){
		global $cs_node, $post;
		$shortcode_element = '';
		$filter_element = 'filterdrag';
		$shortcode_view = '';
		$output = array();
		$cs_counter = $_POST['counter'];
 		if ( isset($_POST['action']) && !isset($_POST['shortcode_element_id']) ) {
			$POSTID = '';
			$shortcode_element_id = '';
		} else {
			$POSTID = $_POST['POSTID'];
			$shortcode_element_id = $_POST['shortcode_element_id'];
			$shortcode_str = stripslashes ($shortcode_element_id);
			$PREFIX = 'cs_map';
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array('cs_map_section_title'=>'','map_title'=>'','map_height'=>'','map_lat'=>'-0.127758','map_lon'=>'51.507351','map_zoom'=>'','map_type'=>'','map_info'=>'','map_info_width'=>'','map_info_height'=>'','map_marker_icon'=>'','map_show_marker'=>'true','map_controls'=>'','map_draggable' => '','map_scrollwheel' => '','map_conactus_content' => '','map_border' => '','map_color' => '','map_border_color' => '','cs_map_class' => '','cs_map_animation' => '');
			if(isset($output['0']['atts']))
				$atts = $output['0']['atts'];
			else 
				$atts = array();
			if(isset($output['0']['content']))
				$atts_content = $output['0']['content'];
			else 
				$atts_content = array();
 			$map_element_size = '25';
			foreach($defaults as $key=>$values){
				if(isset($atts[$key]))
					$$key = $atts[$key];
				else 
					$$key =$values;
			 }
			$name = 'cs_pb_map';
			$coloumn_class = 'column_'.$map_element_size;
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
	$rand_string = $cs_counter.''.cs_generate_random_string(3);	
	?>
<div id="<?php echo esc_attr($name.$cs_counter)?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class);?> <?php echo esc_attr($shortcode_view);?>" item="blog" data="<?php echo element_size_data_array_index($map_element_size)?>" >
  <?php cs_element_setting($name,$cs_counter,$map_element_size,'','globe');?>
  <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter);?> <?php echo esc_attr($shortcode_element);?>" id="<?php echo esc_attr($name.$cs_counter)?>" data-shortcode-template="[cs_map {{attributes}}]" style="display: none;">
    <div class="cs-heading-area">
      <h5><?php _e('Edit Map Options','goalklub');?></h5>
      <a href="javascript:removeoverlay('<?php echo esc_js($name.$cs_counter)?>','<?php echo esc_js($filter_element);?>')" class="cs-btnclose"><i class="icon-cross3"></i></a> </div>
    <div class="cs-pbwp-content">
      <div class="cs-wrapp-clone cs-shortcode-wrapp">
        <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Section Title','goalklub');?></label>
          </li>
          <li class="to-field">
            <input  name="cs_map_section_title[]" type="text"  value="<?php echo cs_allow_special_char($cs_map_section_title)?>"   />
            <p><?php _e('This is used for the one page navigation, to identify the section below. Give a title','goalklub');?> </p>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Title','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" name="map_title[]" class="txtfield" value="<?php echo cs_allow_special_char($map_title)?>" />
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Map Height','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" name="map_height[]" class="txtfield" value="<?php echo esc_attr($map_height)?>" />
            <p><?php _e('Map height set here','goalklub');?></p>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Latitude','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" name="map_lat[]" class="txtfield" value="<?php echo esc_attr($map_lat)?>" />
            <p><?php _e('The map will appear only if this field is filled correctly','goalklub');?></p>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Longitude','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" name="map_lon[]" class="txtfield" value="<?php echo esc_attr($map_lon)?>" />
            <p><?php _e('The map will appear only if this field is filled correctly','goalklub');?></p>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Zoom','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" name="map_zoom[]" class="txtfield" value="<?php echo esc_attr($map_zoom)?>" />
            <p></p>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Map Types','goalklub');?></label>
          </li>
          <li class="to-field select-style">
            <select name="map_type[]" class="dropdown" >
              <option value="ROADMAP" <?php if($map_type=="ROADMAP")echo "selected";?> ><?php _e('ROADMAP','goalklub');?></option>
              <option value="HYBRID" <?php if($map_type=="HYBRID")echo "selected";?> ><?php _e('HYBRID','goalklub');?></option>
              <option value="SATELLITE" <?php if($map_type=="SATELLITE")echo "selected";?> ><?php _e('SATELLITE','goalklub');?></option>
              <option value="TERRAIN" <?php if($map_type=="TERRAIN")echo "selected";?> ><?php _e('TERRAIN','goalklub');?></option>
            </select>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Info Text','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" name="map_info[]" class="txtfield" value="<?php echo esc_attr($map_info)?>" />
            <p><?php _e('Enter the marker content','goalklub');?></p>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Info Max Width','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" name="map_info_width[]" class="txtfield" value="<?php echo esc_attr($map_info_width)?>" />
            <p><?php _e('set max width for the google map','goalklub');?></p>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Info Max Height','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" name="map_info_height[]" class="txtfield" value="<?php echo esc_attr($map_info_height)?>" />
            <p><?php _e('set max height for the google map','goalklub');?></p>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Marker Icon Path','goalklub');?></label>
          </li>
          <li class="to-field">
            <input id="map_marker_icon<?php echo esc_attr($rand_string)?>" name="map_marker_icon[]" type="hidden" class="" value="<?php echo esc_attr($map_marker_icon);?>"/>
            <label class="browse-icon"><input name="map_marker_icon<?php echo esc_attr($rand_string)?>"  type="button" class="uploadMedia left" value="<?php _e('Browse','goalklub');?>"/></label>
            <div class="left-info"><p><?php _e('Give a link for your marker icon','goalklub');?></p></div>
          </li>
        </ul>
        <div class="page-wrap" style="overflow:hidden; display:<?php echo esc_attr($map_marker_icon) && trim($map_marker_icon) !='' ? 'inline' : 'none';?>" id="map_marker_icon<?php echo esc_attr($rand_string);?>_box" >
          <div class="gal-active">
            <div class="dragareamain" style="padding-bottom:0px;">
              <ul id="gal-sortable">
                <li class="ui-state-default" id="">
                  <div class="thumb-secs"> <img src="<?php echo esc_url($map_marker_icon);?>"  id="map_marker_icon<?php echo esc_attr($rand_string);?>_img" width="100" height="150"  />
                    <div class="gal-edit-opts"> <a   href="javascript:del_media('map_marker_icon<?php echo esc_js($rand_string)?>')" class="delete"></a> </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Show Marker','goalklub');?></label>
          </li>
          <li class="to-field select-style">
            <select name="map_show_marker[]" class="dropdown" >
              <option value="true" <?php if($map_show_marker=="true")echo "selected";?> ><?php _e('On','goalklub');?></option>
              <option value="false" <?php if($map_show_marker=="false")echo "selected";?> ><?php _e('Off','goalklub');?></option>
            </select>
            <p><?php _e('Set marker on/off for the map','goalklub');?></p>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Disable Map Controls','goalklub');?></label>
          </li>
          <li class="to-field select-style">
            <select name="map_controls[]" class="dropdown" >
              <option value="false" <?php if($map_controls=="false")echo "selected";?> ><?php _e('Off','goalklub');?></option>
              <option value="true" <?php if($map_controls=="true")echo "selected";?> ><?php _e('On','goalklub');?></option>
            </select>
            <p><?php _e('You can set map control disable/enable','goalklub');?></p>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Draggable','goalklub');?></label>
          </li>
          <li class="to-field select-style">
            <select name="map_draggable[]" class="dropdown" >
              <option value="true" <?php if($map_draggable=="true")echo "selected";?> ><?php _e('On','goalklub');?></option>
              <option value="false" <?php if($map_draggable=="false")echo "selected";?> ><?php _e('Off','goalklub');?></option>
            </select>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Scroll Wheel','goalklub');?></label>
          </li>
          <li class="to-field select-style">
            <select name="map_scrollwheel[]" class="dropdown" >
              <option value="true" <?php if($map_scrollwheel=="true")echo "selected";?> ><?php _e('On','goalklub');?></option>
              <option value="false" <?php if($map_scrollwheel=="false")echo "selected";?> ><?php _e('Off','goalklub');?></option>
            </select>
            <p><?php _e('Set scroll wheel','goalklub');?></p>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Border','goalklub');?></label>
          </li>
          <li class="to-field select-style">
            <select class="dropdown" name="map_border[]">
              <option <?php if($map_border == 'yes'){echo 'selected="selected"';}?> value="yes"><?php _e('Yes','goalklub');?></option>
              <option <?php if($map_border == 'no'){echo 'selected="selected"';}?> value="no"><?php _e('No','goalklub');?></option>
            </select>
            <p><?php _e('Set border for map','goalklub');?></p>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Border Color','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" name="map_border_color[]" class="bg_color" value="<?php echo esc_attr($map_border_color);?>" />
            <div class="left-info">
            <p><?php _e('If you will select a border than select the border color','goalklub');?></p>
            </div>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Map Color','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" name="map_color[]" class="bg_color" value="<?php echo esc_attr($map_color);?>" />
            <div class="left-info">
            <p></p>
            </div>
          </li>
        </ul>
        <?php 
		if ( function_exists( 'cs_shortcode_custom_dynamic_classes' ) ) {
			cs_shortcode_custom_dynamic_classes($cs_map_class,$cs_map_animation,'','cs_map');
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
          <input type="hidden" name="cs_orderby[]" value="map" />
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
add_action('wp_ajax_cs_pb_map', 'cs_pb_map');
}

/** 
 * @Offer Slider html form for page builder start
 */
if ( ! function_exists( 'cs_pb_offerslider' ) ) {
	function cs_pb_offerslider($die = 0){
		global $cs_node, $post;
		$shortcode_element = '';
		$filter_element = 'filterdrag';
		$shortcode_view = '';
		$output = array();
		$cs_counter = $_POST['counter'];
 		if ( isset($_POST['action']) && !isset($_POST['shortcode_element_id']) ) {
			$POSTID = '';
			$shortcode_element_id = '';
		} else {
			$POSTID = $_POST['POSTID'];
			$shortcode_element_id = $_POST['shortcode_element_id'];
			$shortcode_str = stripslashes ($shortcode_element_id);
			$PREFIX = 'cs_offerslider|offer_item';
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array('column_size'=>'1/1','cs_offerslider_section_title' => '','cs_offerslider_class' => '','cs_offerslider_animation' => '');
		if(isset($output['0']['atts']))
			$atts = $output['0']['atts'];
		else 
			$atts = array();
			
		if(isset($output['0']['content']))
			$atts_content = $output['0']['content'];
		else 
			$atts_content = array();
			
		if(is_array($atts_content))
				$offerslider_num = count($atts_content);
					
		$offerslider_element_size = '50';
		foreach($defaults as $key=>$values){
			if(isset($atts[$key]))
				$$key = $atts[$key];
			else 
				$$key =$values;
		 }
		
		$name = 'cs_pb_offerslider';
		$coloumn_class = 'column_'.$offerslider_element_size;
		
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
	?>
<div id="<?php echo esc_attr($name.$cs_counter);?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class);?> <?php echo esc_attr($shortcode_view);?>" item="offerslider" data="<?php echo element_size_data_array_index($offerslider_element_size)?>" >
			<?php cs_element_setting($name,$cs_counter,$offerslider_element_size, '', 'trophy',$type='');?>
			<div class="cs-wrapp-class-<?php echo esc_attr($cs_counter)?> <?php echo esc_attr($shortcode_element);?>" id="<?php echo esc_attr($name.$cs_counter);?>" style="display: none;">
				<div class="cs-heading-area">
					<h5><?php _e('Edit Offer Slider Options','goalklub');?></h5>
					<a href="javascript:removeoverlay('<?php echo esc_js($name.$cs_counter);?>','<?php echo esc_js($filter_element);?>')" class="cs-btnclose"><i class="icon-cross3"></i></a>
				</div>
					<div class="cs-clone-append cs-pbwp-content">
                    <div class="cs-wrapp-tab-box">
                        	<div id="shortcode-item-<?php echo esc_attr($cs_counter);?>" data-shortcode-template="{{child_shortcode}} [/cs_offerslider]" data-shortcode-child-template="[offer_item {{attributes}}] {{content}} [/offer_item]">
                        		<div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true" data-template="[cs_offerslider {{attributes}}]">
                                <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
									?>
                                    <ul class="form-elements">
                                        <li class="to-label"><label><?php _e('Size','goalklub');?></label></li>
                                        <li class="to-field select-style">
                                            <select class="column_size" id="column_size" name="column_size[]">
                                                <option value="1/1" <?php if($column_size == '1/1'){echo 'selected="selected"';}?>><?php _e('Full width','goalklub');?></option>
                                                <option value="1/2" <?php if($column_size == '1/2'){echo 'selected="selected"';}?>><?php _e('One half','goalklub');?></option>
                                                <option value="2/3" <?php if($column_size == '2/3'){echo 'selected="selected"';}?>><?php _e('Two third','goalklub');?></option>
                                                <option value="3/4" <?php if($column_size == '3/4'){echo 'selected="selected"';}?>><?php _e('Three fourth','goalklub');?></option>
                                            </select>
                                            <p><?php _e('Select column width. This width will be calculated depend page width','goalklub');?></p>
                                        </li>                  
                                    </ul>
                                    <?php
									}
									?>
                               <ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Section Title','goalklub');?></label>
                                  </li>
                                  <li class="to-field">
                                    <input  name="cs_offerslider_section_title[]" type="text"  value="<?php echo cs_allow_special_char($cs_offerslider_section_title);?>"   />
                                    <p> <?php _e('This is used for the one page navigation, to identify the section below. Give a title','goalklub');?> </p>
                                  </li>
                                </ul>
                               <?php  
							   	if ( function_exists( 'cs_shortcode_custom_dynamic_classes' ) ) {
									cs_shortcode_custom_dynamic_classes($cs_offerslider_class,$cs_offerslider_animation,'','cs_offerslider');
								}
								?>
                        	</div>
                            <?php
							if ( isset($offerslider_num) && $offerslider_num <> '' && isset($atts_content) && is_array($atts_content)){
							
								foreach ( $atts_content as $offerslider){
									
									$rand_string = $cs_counter.''.cs_generate_random_string(3);
									$offerslider_text = $offerslider['content'];
									$defaults = array( 'cs_slider_image' => '','cs_slider_title' => '','cs_slider_contents' => '','cs_readmore_link' => '','cs_offerslider_link_title' => '');
									
									foreach($defaults as $key=>$values){
										if(isset($offerslider['atts'][$key]))
											$$key = $offerslider['atts'][$key];
										else 
											$$key =$values;
									 }
									?>
									<div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo esc_attr($rand_string);;?>">
										<header><h4><i class='icon-arrows'></i><?php _e('Testimonial','goalklub');?></h4> <a href='#' class='deleteit_node'><i class='icon-minus8-circle'></i><?php _e('Remove','goalklub');?></a></header>
										<ul class="form-elements">
                                          <li class="to-label">
                                            <label><?php _e('Image','goalklub');?></label>
                                          </li>
                                          <li class="to-field">
                                            <input id="cs_slider_image<?php echo esc_attr($rand_string)?>" name="cs_slider_image[]" type="hidden" class="" value="<?php echo esc_url($cs_slider_image);?>"/>
                                            <input name="cs_slider_image<?php echo esc_attr($rand_string)?>"  type="button" class="uploadMedia left" value="<?php _e('Browse','goalklub');?>"/>
                                          </li>
                                        </ul>
                                        <div class="page-wrap" style="overflow:hidden; display:<?php echo esc_url($cs_slider_image) && trim($cs_slider_image) !='' ? 'inline' : 'none';?>" id="cs_slider_image<?php echo esc_attr($cs_counter);?>_box" >
                                          <div class="gal-active">
                                            <div class="dragareamain" style="padding-bottom:0px;">
                                              <ul id="gal-sortable">
                                                <li class="ui-state-default" id="">
                                                  <div class="thumb-secs"> <img src="<?php echo esc_url($cs_slider_image);?>"  id="cs_slider_image<?php echo esc_attr($rand_string);?>_img" width="100" height="150"  />
                                                    <div class="gal-edit-opts"> <a   href="javascript:del_media('cs_slider_image<?php echo esc_attr($rand_string);?>')" class="delete"></a> </div>
                                                  </div>
                                                </li>
                                              </ul>
                                            </div>
                                          </div>
                                        </div>
                                        <ul class="form-elements">
                                          <li class="to-label">
                                            <label><?php _e('Title','goalklub');?></label>
                                          </li>
                                          <li class="to-field">
                                            <input type="text" name="cs_slider_title[]" class="txtfield" value="<?php echo cs_allow_special_char($cs_slider_title);?>" />
                                          </li>
                                        </ul>
                                        <ul class="form-elements">
                                          <li class="to-label">
                                            <label><?php _e('Content(s)','goalklub');?></label>
                                          </li>
                                          <li class="to-field">
                                            <textarea name="cs_slider_contents[]" data-content-text="cs-shortcode-textarea"><?php echo esc_textarea($offerslider_text);?></textarea>
                                            <p><?php _e('Enter your content','goalklub');?></p>
                                          </li>
                                        </ul>
                                        <ul class="form-elements">
                                          <li class="to-label">
                                            <label><?php _e('Read More Link','goalklub');?></label>
                                          </li>
                                          <li class="to-field">
                                            <input type="text" name="cs_readmore_link[]" class="txtfield" value="<?php echo esc_attr($cs_readmore_link)?>" />
                                          </li>
                                        </ul>
                                        <ul class="form-elements">
                                          <li class="to-label">
                                            <label><?php _e('Link Title','goalklub');?></label>
                                          </li>
                                          <li class="to-field">
                                            <input type="text" name="cs_offerslider_link_title[]" class="txtfield" value="<?php echo cs_allow_special_char($cs_offerslider_link_title);?>" />
                                            <p><?php _e('give the link title here','goalklub');?></p>
                                          </li>
                                        </ul>
                                        
								</div>
							<?php
								}
							}
							?>
                        </div>
                   		<div class="hidden-object"><input type="hidden" name="offerslider_num[]" value="<?php echo (int)$offerslider_num?>" class="fieldCounter"/></div>
                        <div class="wrapptabbox" style="padding:0">
                            <div class="opt-conts">
                                <ul class="form-elements noborder">
                                    <li class="to-field">
                                    <a href="#" class="add_servicesss cs-main-btn" onclick="cs_shortcode_element_ajax_call('offerslider', 'shortcode-item-<?php echo esc_attr($cs_counter);?>', '<?php echo admin_url('admin-ajax.php');?>')"><i class="icon-plus7"></i><?php _e('Add Offer','goalklub');?></a>
                                     <div id="loading" class="shortcodeload"></div>
                                    </li>
                                </ul>
                                <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){?>
                                        <ul class="form-elements insert-bg">
                                            <li class="to-field">
                                                <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('cs_pb_','',$name));?>','shortcode-item-<?php echo esc_js($cs_counter);?>','<?php echo esc_js($filter_element);?>')" ><?php _e('Insert','goalklub');?></a>
                                            </li>
                                        </ul>
                                        <div id="results-shortocde"></div>
                                    <?php } else {?>
                                    <ul class="form-elements noborder">
                                        <li class="to-label"></li>
                                        <li class="to-field">
                                            <input type="hidden" name="cs_orderby[]" value="offerslider" />
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
	add_action('wp_ajax_cs_pb_offerslider', 'cs_pb_offerslider');
}

/** 
 * @Spacer html form for page builder
 */
if ( ! function_exists( 'cs_pb_spacer' ) ) {
	function cs_pb_spacer($die = 0){
		global $cs_node, $post;
		$shortcode_element = '';
		$filter_element = 'filterdrag';
		$shortcode_view = '';
		$output = array();
		$cs_counter = $_POST['counter'];
 		if ( isset($_POST['action']) && !isset($_POST['shortcode_element_id']) ) {
			$POSTID = '';
			$shortcode_element_id = '';
		} else {
			$POSTID = $_POST['POSTID'];
			$shortcode_element_id = $_POST['shortcode_element_id'];
			$shortcode_str = stripslashes ($shortcode_element_id);
			$PREFIX = 'cs_spacer';
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
			$defaults = array('cs_spacer_height'=>'25');
			if(isset($output['0']['atts']))
				$atts = $output['0']['atts'];
			else 
				$atts = array();
			
			foreach($defaults as $key=>$values){
				if(isset($atts[$key]))
					$$key = $atts[$key];
				else 
					$$key =$values;
			 }
			$name = 'cs_pb_spacer';
			$coloumn_class = 'column_100';
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
?>
<div id="<?php echo esc_attr($name.$cs_counter)?>_del" class="column  parentdelete column_100 column_100 <?php echo esc_attr($shortcode_view);?>" item="spacer" data="0" >
  <?php cs_element_setting($name,$cs_counter,'column_100','','arrows-v');?>
  <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter);?> <?php echo esc_attr($shortcode_element);?>" id="<?php echo esc_attr($name.$cs_counter)?>" data-shortcode-template="[cs_spacer {{attributes}}]" style="display: none;">
    <div class="cs-heading-area">
      <h5><?php _e('Edit Spacer Options','goalklub');?></h5>
      <a href="javascript:removeoverlay('<?php echo esc_js($name.$cs_counter)?>','<?php echo esc_js($filter_element);?>')" class="cs-btnclose"><i class="icon-cross3"></i></a> </div>
    <div class="cs-pbwp-content">
      <div class="cs-wrapp-clone cs-shortcode-wrapp">
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Height','goalklub');?></label>
          </li>
          <li class="to-field">
            <div class="cs-drag-slider" data-slider-min="1" data-slider-max="100" data-slider-step="1" data-slider-value="<?php echo esc_attr($cs_spacer_height);?>"></div>
            <input  class="cs-range-input"  name="cs_spacer_height[]" type="text" value="<?php echo esc_attr($cs_spacer_height);?>"   />
          </li>
        </ul>
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
          <input type="hidden" name="cs_orderby[]" value="spacer" />
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
	add_action('wp_ajax_cs_pb_spacer', 'cs_pb_spacer');
}
?>
