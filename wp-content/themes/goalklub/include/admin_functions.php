<?php
/**
 * Page Builder Functions 
 */
 
/**
 * @Generate Random String
 *
 *
 */
if ( ! function_exists( 'cs_generate_random_string' ) ) {
	function cs_generate_random_string($length = 3) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
}

function cs_slugify_text($str) {
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", '-', $clean);

	return $clean;
}

/**
 * @Page builder Element (shortcode(s))
 *
 *
 */
 if ( ! function_exists( 'cs_element_setting' ) ) {
	function cs_element_setting($name,$cs_counter,$element_size, $element_description='', $page_element_icon = 'icon-star',$type=''){
		$element_title = str_replace("cs_pb_","",$name);
		?>
        <div class="column-in">
          <input type="hidden" name="<?php echo esc_attr($element_title); ?>_element_size[]" class="item" value="<?php echo esc_attr($element_size); ?>" >
          <!--<a href="javascript:;" onclick="javascript:_createclone(jQuery(this),'<?php echo esc_attr($cs_counter)?>', '', '')" class="options"><i class="icon-star"></i></a>--><a href="javascript:;" onclick="javascript:_createpopshort(jQuery(this))" class="options"><i class="icon-edit3"></i></a> <a href="#" class="delete-it btndeleteit"><i class="icon-trash4"></i></a> &nbsp; <a class="decrement" onclick="javascript:decrement(this)"><i class="icon-minus8"></i></a> &nbsp; <a class="increment" onclick="javascript:increment(this)"><i class="icon-plus8"></i></a> 
          <span> <i class="cs-icon <?php echo str_replace("cs_pb_","",$name);?>-icon"></i> 
          <strong><?php echo strtoupper(str_replace('_',' ',str_replace("cs_pb_","",$name)))?></strong><br/>
          <?php echo esc_attr($element_description);?> </span>
        </div>
<?php
	}
}


/**
 * @Page builder Element (shortcode(s))
 *
 */
if ( ! function_exists( 'cs_page_composer_elements' ) ) {
	function cs_page_composer_elements($element='',$icon='accordion-icon',$description='Dribble is community of designers'){
		echo '<i class="fa '.$icon.'"></i><span data-title="'.$element.'"> '.$element.'</span>';
	}
}

/**
 * @Page builder Sorting List
 *
 *
 */
if ( ! function_exists( 'cs_elements_categories' ) ) {
	function cs_elements_categories(){
		return array('typography'=>__('Typography','goalklub'),'commonelements'=>__('Common Elements','goalklub'),'mediaelement'=>__('Media Element','goalklub'),'contentblocks'=>__('Content Blocks','goalklub'),'loops'=>__('Loops','goalklub'),);
	}
}

/**
 * @Page builder Ajax Element (shortcode(s))
 *
 *
 */
 if ( ! function_exists( 'cs_ajax_element_setting' ) ) {
	function cs_ajax_element_setting($name,$cs_counter,$element_size, $shortcode_element_id, $POSTID, $element_description='', $page_element_icon = '',$type=''){
		global $cs_node,$post;
		$element_title = str_replace("cs_pb_","",$name);
		?>
        <div class="column-in">
        <input type="hidden" name="<?php echo esc_attr($element_title); ?>_element_size[]" class="item" value="<?php echo esc_attr($element_size); ?>" >
         <!--<a href="javascript:;" onclick="javascript:_createclone(jQuery(this),'<?php echo esc_attr($cs_counter)?>', '<?php echo esc_attr($shortcode_element_id);?>', '<?php echo absint($POSTID);?>')" class="options"><i class="icon-star"></i></a>--><a title="Edit" href="javascript:;" onclick="javascript:ajax_shortcode_widget_element(jQuery(this),'<?php echo esc_js(admin_url('admin-ajax.php'));?>', '<?php echo esc_js($POSTID);?>','<?php echo esc_js($name);?>')" class="options"><i class="icon-edit3"></i></a><a title="Delete" href="#" class="delete-it btndeleteit"><i class="icon-trash4"></i></a> &nbsp; <a class="decrement" onclick="javascript:decrement(this)"><i class="icon-minus8"></i></a> &nbsp; <a class="increment" onclick="javascript:increment(this)"><i class="icon-plus8"></i></a> 
          <span> <i class="cs-icon <?php echo str_replace("cs_pb_","",$name);?>-icon"></i> 
          <strong>
		  <?php 
		  if($cs_node->getName() == 'page_element'){
				$element_name = $cs_node->element_name;
				$element_name = str_replace("cs-","",$element_name);
			} else {
				$element_name = $cs_node->getName();
			}
		  
		  echo strtoupper(str_replace('_',' ',$element_name));?></strong><br/>
          <?php echo esc_attr($element_description);?> </span>
        </div>
<?php
	}
}

/**
 * @Page builder Section Settings
 *
 *
 */
if ( ! function_exists( 'cs_column_pb' ) ) {
	function cs_column_pb($die = 0, $shortcode=''){
 		global $post, $cs_node, $cs_xmlObject, $cs_count_node, $column_container, $coloum_width;

 		 $total_widget = 0;
		 
		 
		 $i = 1;
		 $cs_page_section_title = $cs_page_section_height = $cs_page_section_width = '';
		 $cs_section_background_option = '';
		 $cs_section_bg_image = '';
		 $cs_section_bg_image_position = '';
		 $cs_section_parallax = '';
		 $cs_section_flex_slider = '';
		 $cs_section_custom_slider = '';
		 $cs_section_video_url = '';
		 $cs_section_video_mute = '';
		 $cs_section_video_autoplay = '';
		 $cs_section_border_bottom = '0';
		 $cs_section_border_top = '0';
		 $cs_section_border_color = '#e0e0e0';
		 $cs_section_padding_top = '30';
		 $cs_section_padding_bottom = '30';
		 $cs_section_margin_top = '0';
		 $cs_section_margin_bottom = '30';
		 $cs_section_css_class = '';
		 $cs_section_css_id = '';
		 $cs_section_view = 'container';
		 $cs_layout = '';
		 
		 $cs_sidebar_left = '';
		 $cs_sidebar_right = ''; 
		 $cs_section_bg_color = '';
		if ( isset( $column_container ) ){
			$column_attributes= $column_container->attributes();
			 $column_class = $column_attributes->class;
			 $cs_section_background_option = $column_attributes->cs_section_background_option;
			 $cs_section_bg_image = $column_attributes->cs_section_bg_image;
			 $cs_section_bg_image_position = $column_attributes->cs_section_bg_image_position;
			 $cs_section_flex_slider = $column_attributes->cs_section_flex_slider;
			 $cs_section_custom_slider = $column_attributes->cs_section_custom_slider;
			 $cs_section_video_url = $column_attributes->cs_section_video_url;	 
			 $cs_section_video_mute = $column_attributes->cs_section_video_mute;
			 $cs_section_video_autoplay = $column_attributes->cs_section_video_autoplay;
			 $cs_section_bg_color = $column_attributes->cs_section_bg_color; 
			 $cs_section_parallax = $column_attributes->cs_section_parallax;
			 $cs_section_padding_top = $column_attributes->cs_section_padding_top;
			 $cs_section_padding_bottom = $column_attributes->cs_section_padding_bottom; 
			 $cs_section_border_bottom = $column_attributes->cs_section_border_bottom;
			 $cs_section_border_top = $column_attributes->cs_section_border_top;
			 $cs_section_border_color = $column_attributes->cs_section_border_color;
			 $cs_section_margin_top = $column_attributes->cs_section_margin_top;
			 $cs_section_margin_bottom = $column_attributes->cs_section_margin_bottom;
			 $cs_section_css_id = $column_attributes->cs_section_css_id;
			 $cs_section_view = $column_attributes->cs_section_view;
			 $cs_layout = $column_attributes->cs_layout;
			 $cs_sidebar_left = $column_attributes->cs_sidebar_left;
			 $cs_sidebar_right = $column_attributes->cs_sidebar_right; 
		}
		$style='';
	
		if ( isset($_POST['action']) ) {
			$name = $_POST['action'];
			$cs_counter = $_POST['counter'];
			$total_column = $_POST['total_column'];
			$column_class = $_POST['column_class'];
			$postID = $_POST['postID'];
			$randomno = cs_generate_random_string('5');
			$rand = rand(1,999);
			$style='';
		} else {
			$postID = $post->ID;
			$name = '';
			$cs_counter = '';
			$total_column = 0;
			$rand = rand(1,999);
			$randomno = cs_generate_random_string('5');
			$name = $_REQUEST['action'];
			$style='style="display:none;"';
		}
		$cs_page_elements_name = cs_shortcode_names();
		$cs_page_categories_name =  cs_elements_categories();
		
	?>
<div class="cs-page-composer composer-<?php echo absint($rand)?>" id="composer-<?php echo absint($rand)?>" style="display:none">
  <div class="page-elements">
    <div class="cs-heading-area">
      <h5> <i class="icon-plus7"></i><?php _e('Add Element','goalklub');?>  </h5>
      <span class='cs-btnclose' onclick='javascript:removeoverlay("composer-<?php echo absint($rand)?>","append")'><i class="icon-cross3"></i></span> </div>
		<script>
            jQuery(document).ready(function($){
                cs_page_composer_filterable('<?php echo absint($rand)?>');
            });
        </script>
    <div class="cs-filter-content">
      <p><input type="text" id="quicksearch<?php echo absint($rand)?>" placeholder="<?php _e('Search','goalklub');?>" /></p>
      <div class="cs-filtermenu-wrap">
        <h6><?php _e('Filter by','goalklub');?></h6>
        <ul class="cs-filter-menu" id="filters<?php echo absint($rand)?>">
          <li data-filter="all" class="active"><?php _e('Show all','goalklub');?></li>
          <?php foreach($cs_page_categories_name as $key=>$value){?>
          <li data-filter="<?php echo esc_attr($key);?>"><?php echo esc_attr($value);?></li>
          <?php }?>
        </ul>
      </div>
      <div class="cs-filter-inner" id="page_element_container<?php echo absint($rand)?>">
        <?php foreach($cs_page_elements_name as $key=>$value){?>
        <div class="element-item <?php echo esc_attr($value['categories']);?>"> <a href='javascript:ajaxSubmitwidget("cs_pb_<?php echo esc_js($value['name']);?>","<?php echo esc_js($rand)?>")'>
          <?php cs_page_composer_elements($value['title'], $value['icon']); ?>
          </a> </div>
        <?php }?>
        
      </div>
    </div>
  </div>
</div>
<?php 
if(isset($shortcode) && $shortcode <> ''){
	?>
	<a class="button" href="javascript:_createpop('composer-<?php echo esc_js($rand)?>', 'filter')"><i class="icon-plus7"></i><?php _e('CS: Insert shortcode','goalklub');?> </a>
<?php
} else {
?>
<div id="<?php echo esc_attr($randomno);?>_del" class="column columnmain parentdeletesection column_100" >
  <div class="column-in"> <a class="button" href="javascript:_createpop('composer-<?php echo esc_js($rand)?>', 'filter')"><i class="icon-plus7"></i><?php _e('Add Element','goalklub');?> </a>
    <p> <a title="Edit" href="javascript:_createpop('<?php echo esc_js($column_class.$randomno);?>','filterdrag')" class="options"><i class="icon-edit3"></i></a> &nbsp; <a href="#" class="delete-it btndeleteitsection"><i class="icon-trash-o"></i></a> &nbsp; </p>
  </div>
  <div class="column column_container page_section <?php echo esc_attr($column_class);?>" >
    <?php
		$parts = explode('_', $column_class);
		if ( $total_column > 0  ){
			for ( $i = 1; $i <= $total_column; $i++ ) {
			?>
    <div class="dragarea" data-item-width="col_width_<?php echo esc_attr($parts[$i]);?>">
      <input name="total_widget[]" type="hidden" value="0" class="textfld" />
      <div class="draginner" id="counter_<?php echo absint($rand)?>"></div>
    </div>
    <?php 
		}
	}
	$i = 1;
	
	if ( isset( $column_container ) ) {
		global $wpdb;
		$total_column = count($column_container->children());
		$section = 0;
		$section_widget_element_num = 0;
		foreach ( $column_container->children() as $column ){
			$section++;
			$total_widget = count($column->children());
			?>
            <div class="dragarea" data-item-width="col_width_<?php echo esc_attr($parts[$i])?>">
              <div class="toparea">
                <input name="total_widget[]" type="hidden" value="<?php echo esc_attr($total_widget)?>" class="textfld page-element-total-widget" />
              </div>
              <div class="draginner" id="counter_<?php echo absint($rand)?>">
                <?php
                    $shortcode_element = '';
                    $abccc_golabal = 'Glo0ab testinggg';
                    $filter_element = 'filterdrag';
                    $shortcode_view = '';
                    $global_array = array();
                    $section_widget__element = 0;
                    foreach ( $column->children() as $cs_node ){
						
                        $section_widget__element++;
                        $shortcode_element_idd = $rand.'_'.$section_widget__element;
                        $global_array[] = $cs_node;
                        $cs_count_node++;
                        $cs_counter = $postID.$cs_count_node;
                        $a = $name = "cs_pb_".$cs_node->getName();
                        $coloumn_class = 'column_'.$cs_node->page_element_size;
                        $abbbbc = (string)$cs_node->cs_shortcode;
						$type = '';
						if($cs_node->getName() == 'page_element'){
							$type = 'page_element';
						}
                        ?>
                    <div id="<?php echo esc_attr($name.$cs_counter);?>_del" class="column  parentdelete  <?php echo esc_attr($coloumn_class);?> <?php echo esc_attr($shortcode_view);?>" item="<?php echo esc_attr($cs_node->getName());?>" data="<?php echo element_size_data_array_index($cs_node->page_element_size)?>" >
                    <?php cs_ajax_element_setting($cs_node->getName(),$cs_counter,$cs_node->page_element_size,$shortcode_element_idd, $postID, $element_description='', $cs_node->getName().'-icon',$type);?>
                        <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter)?> <?php echo esc_attr($shortcode_element);?>" id="<?php echo esc_attr($name.$cs_counter)?>" style="display: none;">
                            <div class="cs-heading-area">
                                <h5>Edit  <?php echo esc_attr($cs_node->getName());?> Options</h5>
                                <a href="javascript:;" onclick="javascript:_removerlay(jQuery(this))" class="cs-btnclose"><i class="icon-cross3"></i></a>
                            </div>
                            <?php 
							echo '<input type="hidden"  class="cs-wiget-element-type"  id="shortcode_'.$name.$cs_counter.'" name="cs_widget_element_num[]" value="shortcode" />';
							?>
                            <div class="pagebuilder-data-load">
								<?php
                                	echo '<input type="hidden" name="cs_orderby[]" value="'.$cs_node->getName().'" />';
                                	echo '<textarea name="shortcode['.$cs_node->getName().'][]" style="display:none;" class="cs-textarea-val">'.wp_specialchars_decode($cs_node->cs_shortcode).'</textarea>';
                                 ?>
                            </div>
                         </div>
                    </div>
                    <?php
                    }
                    ?>
              </div>
            </div>
    <?php
			$i++;
		}
	}
	?>
  </div>
<div id="<?php echo esc_attr($column_class.$randomno);?>" style="display:none">
    <div class="cs-heading-area">
      <h5>Edit Page Section</h5>
      <a href="javascript:removeoverlay('<?php echo esc_js($column_class.$randomno);?>','filterdrag')" class="cs-btnclose"><i class="icon-cross3"></i></a> </div>
    <div class="cs-pbwp-content">
      <ul class="form-elements  noborder">
        <li class="to-label">
          <label><?php _e('Background View','goalklub');?></label>
        </li>
        <li class="to-field">
          <div class="input-sec">
            <div class="select-style">
              <select name="cs_section_background_option[]" class="dropdown" onchange="javascript:cs_section_background_settings_toggle(this.value,'<?php echo esc_attr($randomno);?>')">
                <option <?php if($cs_section_background_option=='no-image') echo "selected";?> value="no-image"><?php _e('None','goalklub');?></option>
                <option <?php if($cs_section_background_option=='section-custom-background-image') echo "selected";?> value="section-custom-background-image"><?php _e('Background Image','goalklub');?></option>
                <option <?php if($cs_section_background_option=='section-custom-slider') echo "selected";?> value="section-custom-slider"><?php _e('Custom Slider','goalklub');?></option>
                <option  <?php if($cs_section_background_option=='section_background_video')echo "selected";?> value="section_background_video" ><?php _e('Video','goalklub');?> </option>
              </select>
            </div>
          </div>
        </li>
      </ul>
      <div class="meta-body noborder section-custom-background-image-<?php echo esc_attr($randomno);?>" style=" <?php if($cs_section_background_option == "section-custom-background-image"){echo "display:block";}else echo "display:none";?>" >
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Background Image','goalklub');?></label>
          </li>
          <li class="to-field">
            <input id="cs_section_bg_image<?php echo absint($rand);?>" name="cs_section_bg_image[]" type="hidden" class="" value="<?php echo esc_url($cs_section_bg_image);?>"/>
            <input name="cs_section_bg_image<?php echo absint($rand);?>"  type="button" class="uploadMedia left" value="<?php _e('Browse','goalklub');?>"/>
          </li>
        </ul>
        <div class="page-wrap" style="overflow:hidden; display:<?php echo esc_attr($cs_section_bg_image) && trim($cs_section_bg_image) !='' ? 'inline' : 'none';?>" id="cs_section_bg_image<?php echo absint($rand);?>_box" >
          <div class="gal-active">
            <div class="dragareamain" style="padding-bottom:0px;">
              <ul id="gal-sortable">
                <li class="ui-state-default" id="">
                  <div class="thumb-secs"> <img src="<?php echo esc_url($cs_section_bg_image);?>"  id="cs_section_bg_image<?php echo absint($rand);?>_img" width="100" height="150"  />
                    <div class="gal-edit-opts"> <a href="javascript:del_media('cs_section_bg_image<?php echo absint($rand);?>')" class="delete"></a> </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="form-elements noborder">
          <li class="to-label">
            <label><?php _e('Background Image Position','goalklub');?></label>
          </li>
          <li class="to-field">
            <div class="input-sec">
              <div class="select-style">
                <select name="cs_section_bg_image_position[]" class="select_dropdown">
                  <option value=""><?php _e('Select position','goalklub');?></option>
                  <option value="left" <?php if ($cs_section_bg_image_position=='light')echo "selected";?>><?php _e('Left','goalklub');?></option>
                  <option value="right" <?php if ($cs_section_bg_image_position=='right')echo "selected";?>><?php _e('Right','goalklub');?></option>
                  <option value="center" <?php if ($cs_section_bg_image_position=='center')echo "selected";?>><?php _e('Center','goalklub');?></option>
                  <option value="repeat" <?php if ($cs_section_bg_image_position=='repeat')echo "selected";?>><?php _e('Repeat','goalklub');?></option>
                </select>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="meta-body noborder section-slider-<?php echo esc_attr($randomno);?>" style=" <?php if($cs_section_background_option == "section-slider"){echo "display:block";}else echo "display:none";?>" >
        <?php //cs_section_slider('section_field_name2');?>
      </div>
      <div class="meta-body noborder section-custom-slider-<?php echo esc_attr($randomno);?>" style=" <?php if($cs_section_background_option == "section-custom-slider"){echo "display:block";}else echo "display:none";?>" >
        <ul class="form-elements noborder">
          <li class="to-label">
            <label><?php _e('Custom Slider','goalklub');?></label>
          </li>
          <li class="to-field">
            <div class="input-sec">
                <input type="text" name="cs_section_custom_slider[]" class="txtfield" value="<?php echo esc_attr($cs_section_custom_slider);;?>" />
            </div>
          </li>
        </ul>
      </div>
      <div class="meta-body noborder section-background-video-<?php echo esc_attr($randomno);?>" style=" <?php if($cs_section_background_option == "section_background_video"){echo "display:block";}else echo "display:none";?>">
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Video Url','goalklub');?></label>
          </li>
          <li class="to-field">
            <div class="input-sec">
              <input id="cs_section_video_url_<?php echo esc_attr($randomno)?>" name="cs_section_video_url[]" value="<?php echo esc_url($cs_section_video_url);;?>" type="text" />
              <label class="cs-browse">
                <input name="cs_section_video_url_<?php echo esc_attr($randomno);?>" type="button" class="uploadMedia left" value="<?php _e('Browse','goalklub');?>" />
              </label>
            </div>
            <div class="left-info">
              <p><?php _e('Please enter Vimeo/Youtube Video url','goalklub');?></p>
            </div>
          </li>
        </ul>
        <ul class="form-elements">
        <li class="to-label">
          <label><?php _e('Enable Mute','goalklub');?></label>
        </li>
        <li class="to-field">
          <div class="input-sec">
            <div class="select-style">
              <select name="cs_section_video_mute[]" class="select_dropdown">
                <option value="yes" <?php if ($cs_section_video_mute=='yes')echo "selected";?>><?php _e('Yes','goalklub');?></option>
                <option value="no" <?php if ($cs_section_video_mute=='no')echo "selected";?>><?php _e('No','goalklub');?></option>
              </select>
            </div>
          </div>
        </li>
      </ul>
      <ul class="form-elements">
        <li class="to-label">
          <label><?php _e('Video Auto Play','goalklub');?></label>
        </li>
        <li class="to-field">
          <div class="input-sec">
            <div class="select-style">
              <select name="cs_section_video_autoplay[]" class="select_dropdown">
                <option value="yes" <?php if ($cs_section_video_autoplay=='yes')echo "selected";?>><?php _e('Yes','goalklub');?></option>
                <option value="no" <?php if ($cs_section_video_autoplay=='no')echo "selected";?>><?php _e('No','goalklub');?></option>
              </select>
            </div>
          </div>
        </li>
      </ul>
      </div>
      <ul class="form-elements noborder">
        <li class="to-label">
          <label><?php _e('Enable Parallax','goalklub');?></label>
        </li>
        <li class="to-field">
          <div class="input-sec">
            <div class="select-style">
              <select name="cs_section_parallax[]" class="select_dropdown">
                <option value="no" <?php if ($cs_section_parallax=='no')echo "selected";?>><?php _e('No','goalklub');?></option>
                <option value="yes" <?php if ($cs_section_parallax=='yes')echo "selected";?>><?php _e('Yes','goalklub');?></option>
              </select>
            </div>
          </div>
        </li>
      </ul>
      <ul class="form-elements">
        <li class="to-label">
          <label><?php _e('Select View','goalklub');?></label>
        </li>
        <li class="to-field">
          <div class="input-sec">
            <div class="select-style">
              <select name="cs_section_view[]" class="select_dropdown">
                <option value="container" <?php if ($cs_section_view=='container')echo "selected";?>><?php _e('Box','goalklub');?></option>
                <option value="wide" <?php if ($cs_section_view=='wide')echo "selected";?>><?php _e('Wide','goalklub');?></option>
              </select>
            </div>
          </div>
        </li>
      </ul>
      <ul class="form-elements noborder">
        <li class="to-label">
          <label><?php _e('Background Color','goalklub');?></label>
        </li>
        <li class="to-field">
          <div class="input-sec">
            <input type="text" name="cs_section_bg_color[]" class="bg_color" value="<?php if(isset($cs_section_bg_color)) echo esc_attr($cs_section_bg_color);?>" />
          </div>
        </li>
      </ul>
      <ul class="form-elements noborder">
        <li class="to-label">
          <label><?php _e('Padding Top','goalklub');?></label>
        </li>
        <li class="to-field">
          <div class="input-sec">
            <div class="cs-drag-slider" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php echo absint($cs_section_padding_top)?>"></div>
            <input  class="cs-range-input"  name="cs_section_padding_top[]" type="text" value="<?php echo absint($cs_section_padding_top)?>"   />
            <p><?php _e('Set the Padding top (In px)','goalklub');?></p>
          </div>
        </li>
      </ul>
      <ul class="form-elements noborder">
        <li class="to-label">
          <label><?php _e('Padding Bottom','goalklub');?></label>
        </li>
        <li class="to-field">
          <div class="input-sec">
            <div class="cs-drag-slider" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php echo absint($cs_section_padding_bottom);?>"></div>
            <input  class="cs-range-input"  name="cs_section_padding_bottom[]" type="text" value="<?php echo absint($cs_section_padding_bottom);?>"   />
            <p><?php _e('Set the Padding Bottom (In px)','goalklub');?></p>
          </div>
        </li>
      </ul>
      <ul class="form-elements noborder">
        <li class="to-label">
          <label><?php _e('Margin Top','goalklub');?></label>
        </li>
        <li class="to-field">
          <div class="input-sec">
            <div class="cs-drag-slider" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo intval($cs_section_margin_top);?>"></div>
            <input  class="cs-range-input"  name="cs_section_margin_top[]" type="text" value="<?php echo intval($cs_section_margin_top);?>"   />
            <p><?php _e('Set the Border Bottom (In px)','goalklub');?></p>
          </div>
        </li>
      </ul>
      <ul class="form-elements noborder">
        <li class="to-label">
          <label><?php _e('Margin Bottom','goalklub');?></label>
        </li>
        <li class="to-field">
          <div class="input-sec">
            <div class="cs-drag-slider" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo intval($cs_section_margin_bottom);?>"></div>
            <input  class="cs-range-input"  name="cs_section_margin_bottom[]" type="text" value="<?php echo intval($cs_section_margin_bottom);?>"   />
            <p><?php _e('Set the Margin Bottom (In px)','goalklub');?></p>
          </div>
        </li>
      </ul>
      <ul class="form-elements noborder">
        <li class="to-label">
          <label><?php _e('Border Top','goalklub');?></label>
        </li>
        <li class="to-field">
          <div class="input-sec">
            <div class="cs-drag-slider" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo absint($cs_section_border_top);?>"></div>
            <input  class="cs-range-input"  name="cs_section_border_top[]" type="text" value="<?php echo absint($cs_section_border_top);?>"   />
            <p><?php _e('Set the Border top (In px)','goalklub');?></p>
          </div>
        </li>
      </ul>
      <ul class="form-elements noborder">
        <li class="to-label">
          <label><?php _e('Border Bottom','goalklub');?></label>
        </li>
        <li class="to-field">
          <div class="input-sec">
            <div class="cs-drag-slider" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo absint($cs_section_border_bottom);?>"></div>
            <input  class="cs-range-input"  name="cs_section_border_bottom[]" type="text" value="<?php echo absint($cs_section_border_bottom);?>"   />
            <p><?php _e('Set the Border Bottom (In px)','goalklub');?></p>
          </div>
        </li>
      </ul>
      <ul class="form-elements noborder">
        <li class="to-label">
          <label><?php _e('Border Color','goalklub');?></label>
        </li>
        <li class="to-field">
          <div class="input-sec">
            <input type="text" name="cs_section_border_color[]" class="bg_color" value="<?php echo esc_attr($cs_section_border_color);?>" />
          </div>
        </li>
      </ul>
      <ul class="form-elements noborder">
        <li class="to-label">
          <label><?php _e('Custom ID','goalklub');?></label>
        </li>
        <li class="to-field">
          <div class="input-sec">
            <input type="text" name="cs_section_css_id[]" class="txtfield" value="<?php echo esc_attr($cs_section_css_id);?>" />
          </div>
        </li>
      </ul>
      <div class="form-elements elementhiddenn">
        <ul class="noborder">
          <li class="to-label">
            <label><?php _e('Select Layout','goalklub');?></label>
          </li>
          <li class="to-field">
            <div class="meta-input">
              <div class="meta-input pattern">
                <div class='radio-image-wrapper'>
                  <input <?php if($cs_layout=="none")echo "checked"?> onclick="show_sidebar('none','<?php echo esc_js($randomno);?>')" type="radio" name="cs_layout[<?php echo esc_attr($rand);?>][]" class="radio_cs_sidebar" value="none" id="radio_1<?php echo esc_attr($randomno);?>" />
                  <label for="radio_1<?php echo esc_attr($randomno)?>"> <span class="ss"><img src="<?php echo esc_url(get_template_directory_uri().'/include/assets/images/no_sidebar.png')?>"  alt="No image" /></span> <span <?php if($cs_layout=="none")echo "class='check-list'"?> id="check-list"></span> </label>
                </div>
                <div class='radio-image-wrapper'>
                  <input <?php if($cs_layout=="right")echo "checked"?> onclick="show_sidebar('right','<?php echo esc_js($randomno)?>')" type="radio" name="cs_layout[<?php echo esc_attr($rand);?>][]" class="radio_cs_sidebar" value="right" id="radio_2<?php echo esc_attr($randomno);?>"  />
                  <label for="radio_2<?php echo esc_attr($randomno)?>"> <span class="ss"><img src="<?php echo esc_url(get_template_directory_uri().'/include/assets/images/sidebar_right.png')?>" alt="No image" /></span> <span <?php if($cs_layout=="right")echo "class='check-list'"?> id="check-list"></span> </label>
                </div>
                <div class='radio-image-wrapper'>
                  <input <?php if($cs_layout=="left")echo "checked"?> onclick="show_sidebar('left','<?php echo esc_attr($randomno);?>')" type="radio" name="cs_layout[<?php echo esc_attr($rand)?>][]" class="radio_cs_sidebar" value="left" id="radio_3<?php echo esc_attr($randomno);?>" />
                  <label for="radio_3<?php echo esc_attr($randomno);?>"> <span class="ss"><img src="<?php echo esc_url(get_template_directory_uri().'/include/assets/images/sidebar_left.png');?>" alt="No image" /></span> <span <?php if($cs_layout=="left")echo "class='check-list'"?> id="check-list"></span> </label>
                </div>
              </div>
            </div>
          </li>
        </ul>
        <ul class="meta-body" style=" <?php if($cs_layout == "left"){echo "display:block";}else echo "display:none";?>" id="<?php echo esc_attr($randomno);?>_sidebar_left" >
          <li class="to-label">
            <label><?php _e('Select Left Sidebar','goalklub');?></label>
          </li>
          <li class="to-field">
            <select name="cs_sidebar_left[]" class="select_dropdown">
              <?php
			  		 global $wpdb, $cs_theme_options;
					 //$cs_theme_option = $cs_theme_options;
				$cs_theme_option = get_option('cs_theme_options');
				if ( isset($cs_theme_options['sidebar']) and count($cs_theme_options['sidebar']) > 0 ) {
					foreach ( $cs_theme_options['sidebar'] as $sidebar ){?>
				<option <?php if ($cs_sidebar_left==$sidebar)echo "selected";?> ><?php echo esc_attr($sidebar);;?></option>
				<?php
					}
				}
			 ?>
            </select>
            <p><?php _e('Add New Sidebar','goalklub');?>  <a href="<?php echo admin_url();?>themes.php?page=cs_theme_options#tab-manage-sidebars-show" target="_blank"><?php _e('Click Here','goalklub');?></a></p>
          </li>
        </ul>
        <ul class="meta-body" style=" <?php if($cs_layout == "right"){echo "display:block";}else echo "display:none";?>" id="<?php echo esc_attr($randomno);?>_sidebar_right" >
          <li class="to-label">
            <label><?php _e('Select Right Sidebar','goalklub');?></label>
          </li>
          <li class="to-field">
            <select name="cs_sidebar_right[]" class="select_dropdown">
              <?php
				if ( isset($cs_theme_options['sidebar']) and count($cs_theme_options['sidebar']) > 0 ) {
					foreach ( $cs_theme_options['sidebar'] as $sidebar ){
					?>
              <option <?php if ($cs_sidebar_right==$sidebar)echo "selected";?> ><?php echo esc_attr($sidebar);?></option>
              <?php
					}
				}
				?>
            </select>
            <p><?php _e('Add New Sidebar','goalklub');?><a href="<?php echo esc_url(admin_url('themes.php?page=cs_theme_options#tab-manage-sidebars-show'));?>" target="_blank"><?php _e('Click Here','goalklub');?></a></p>
          </li>
        </ul>
      </div>
      <ul class="form-elements noborder">
        <li class="to-label"></li>
        <li class="to-field">
          <input type="button" value="Save" style="margin-right:10px;" onclick="javascript:removeoverlay('<?php echo esc_js($column_class.$randomno);?>','filterdrag')" />
        </li>
      </ul>
    </div>
  </div>
  <input type="hidden" name="column_rand_id[]" value="<?php echo esc_attr($rand);?>" />
  <input type="hidden" name="column_class[]" value="<?php echo esc_attr($column_class);?>" />
  <input type="hidden" name="total_column[]" value="<?php echo esc_attr($total_column);?>" />
</div>
<?php

		}
	
		if ( $die <> 1 ) die();
	}
	add_action('wp_ajax_cs_column_pb', 'cs_column_pb');
}

/**
 * @Media Pagination for slider/gallery in admin side
 *
 *
 */
if ( ! function_exists( 'media_pagination' ) ) {
	function media_pagination($id='',$func='clone'){
		foreach ( $_REQUEST as $keys=>$values) {
			$$keys = $values;
		}
		$records_per_page = 18;
		if ( empty($page_id) ) $page_id = 1;
		$offset = $records_per_page * ($page_id-1);
	
	?>
<ul class="gal-list">
  <?php
		$query_images_args = array('post_type' => 'attachment', 'post_mime_type' =>'image', 'post_status' => 'inherit', 'posts_per_page' => -1,);
		$query_images = new WP_Query( $query_images_args );
		if ( empty($total_pages) ) $total_pages = count( $query_images->posts );
		$query_images_args = array('post_type' => 'attachment', 'post_mime_type' =>'image', 'post_status' => 'inherit', 'posts_per_page' => $records_per_page, 'offset' => $offset,);
		$query_images = new WP_Query( $query_images_args );
		$images = array();
		foreach ( $query_images->posts as $image) {
			$image_path = wp_get_attachment_image_src((int) $image->ID, array( get_option("thumbnail_size_w"),get_option("thumbnail_size_h") ) );

		?>
  <li style="cursor:pointer"><img src="<?php echo esc_url($image_path[0]);?>" onclick="javascript:<?php echo esc_attr($func);?>('<?php echo esc_js($image->ID)?>','gal-sortable-<?php echo esc_js($id);?>')" alt="No image" /></li>
  <?php } ?>
</ul>
<br />
<div class="pagination-cus">
  <ul>
    <?php
		if ( $page_id > 1 ) echo "<li><a href='javascript:show_next(".($page_id-1).",$total_pages)'>Prev</a></li>";
			for ( $i = 1; $i <= ceil($total_pages/$records_per_page); $i++ ) {
				if ( $i <> $page_id ) echo "<li><a href='javascript:show_next($i,$total_pages)'>" . $i . "</a></li> ";
				else echo "<li class='active'><a>" . $i . "</a></li>";
			}
		if ( $page_id < $total_pages/$records_per_page ) echo "<li><a href='javascript:show_next(".($page_id+1).",$total_pages)'>Next</a></li>";
	?>
  </ul>
</div>
<?php
		if ( isset($_POST['action']) ) die();
	}
	add_action('wp_ajax_media_pagination', 'media_pagination');
}

/**
 * @Media Slider Pagination
 *
 *
 */
if ( ! function_exists( 'slider_media_pagination' ) ) {
	function slider_media_pagination($id='',$func='clone'){
  	
		foreach ( $_REQUEST as $keys=>$values) {
			$$keys = $values;
		}
		$records_per_page = 18;
		if ( empty($page_id) ) $page_id = 1;
		$offset = $records_per_page * ($page_id-1);
	
	?>
<ul class="gal-list">
  <?php
		$query_images_args = array('post_type' => 'attachment', 'post_mime_type' =>'image', 'post_status' => 'inherit', 'posts_per_page' => -1,);
		$query_images = new WP_Query( $query_images_args );
		if ( empty($total_pages) ) $total_pages = count( $query_images->posts );
		$query_images_args = array('post_type' => 'attachment', 'post_mime_type' =>'image', 'post_status' => 'inherit', 'posts_per_page' => $records_per_page, 'offset' => $offset,);
		$query_images = new WP_Query( $query_images_args );
		$images = array();
		foreach ( $query_images->posts as $image) {
			$image_path = wp_get_attachment_image_src((int)$image->ID, array( get_option("thumbnail_size_w"),get_option("thumbnail_size_h") ) );
		?>
  <li style="cursor:pointer"><img src="<?php echo esc_url($image_path[0]);?>" onclick="javascript:slider('<?php echo esc_js($image->ID)?>','gal-sortable-<?php echo esc_js($id);?>')" alt="No image" /></li>
  <?php  } ?>
</ul>
<br />
<div class="pagination-cus">
  <ul>
    <?php
		if ( $page_id > 1 ) echo "<li><a href='javascript:slider_show_next(".($page_id-1).",$total_pages)'>Prev</a></li>";
			for ( $i = 1; $i <= ceil($total_pages/$records_per_page); $i++ ) {
				if ( $i <> $page_id ) echo "<li><a href='javascript:slider_show_next($i,$total_pages)'>" . $i . "</a></li> ";
				else echo "<li class='active'><a>" . $i . "</a></li>";
			}
		if ( $page_id < $total_pages/$records_per_page ) echo "<li><a href='javascript:slider_show_next(".($page_id+1).",$total_pages)'>Next</a></li>";

		?>
  </ul>
</div>
<?php
		if ( isset($_POST['action']) ) die();
	}
	add_action('wp_ajax_slider_media_pagination', 'slider_media_pagination');
}
/**
 * @Make a copy of media image for slider start
 *
 *
 */
if ( ! function_exists( 'cs_slider_clone' ) ) {
	function cs_slider_clone(){
		global $cs_node, $cs_counter;
		if( isset($_POST['action']) ) {
			$cs_node = new stdClass();
			$cs_node->cs_slider_title = '';
			$cs_node->cs_slider_description = '';
			$cs_node->cs_slider_link = '';
			$cs_node->cs_slider_link_target = '';
			$cs_node->slider_use_image_as = '';
			$cs_node->slider_video_code = '';
		}
		if ( isset($_POST['counter']) ) $cs_counter = $_POST['counter'];
		if ( isset($_POST['path']) ) $cs_node->cs_slider_path = $_POST['path'];
	
	?>
<li class="ui-state-default" id="<?php echo esc_attr($cs_counter)?>">
  <div class="thumb-secs">
    <?php $image_path = wp_get_attachment_image_src((int)$cs_node->cs_slider_path, array( get_option("thumbnail_size_w"),get_option("thumbnail_size_h") ) );?>
    <img src="<?php echo esc_url($image_path[0])?>" alt="No image">
    <div class="gal-edit-opts"> 
      <a href="javascript:slidedit(<?php echo esc_attr($cs_counter)?>)" class="edit"></a> <a href="javascript:del_this('inside_post_thumb_slider',<?php echo esc_js($cs_counter)?>)" class="delete"></a> </div>
  </div>
  <div class="poped-up" id="edit_<?php echo esc_attr($cs_counter)?>">
    <div class="cs-heading-area">
      <h5><?php _e('Edit Options','goalklub');?></h5>
      <a href="javascript:slideclose(<?php echo esc_js($cs_counter)?>)" class="closeit">&nbsp;</a>
      <div class="clear"></div>
    </div>
    <div class="cs-pbwp-content">
      <ul class="form-elements">
        <li class="to-label">
          <label><?php _e('Image Title','goalklub');?></label>
        </li>
        <li class="to-field">
          <input type="text" name="cs_slider_title[]" value="<?php echo htmlspecialchars($cs_node->cs_slider_title)?>" class="txtfield" />
        </li>
      </ul>
      <ul class="form-elements">
        <li class="to-label">
          <label><?php _e('Image Description','goalklub');?></label>
        </li>
        <li class="to-field">
          <textarea class="txtarea" name="cs_slider_description[]"><?php echo htmlspecialchars($cs_node->cs_slider_description)?></textarea>
        </li>
      </ul>
      <ul class="form-elements">
        <li class="to-label">
          <label><?php _e('Link','goalklub');?></label>
        </li>
        <li class="to-field">
          <input type="text" name="cs_slider_link[]" value="<?php echo htmlspecialchars($cs_node->cs_slider_link)?>" class="txtfield" />
        </li>
      </ul>
      <ul class="form-elements">
        <li class="to-label">
          <label><?php _e('Link Target','goalklub');?></label>
        </li>
        <li class="to-field">
          <select name="cs_slider_link_target[]" class="select_dropdown">
            <option <?php if($cs_node->link_target=="_self")echo "selected";?> >_self</option>
            <option <?php if($cs_node->link_target=="_blank")echo "selected";?> >_blank</option>
          </select>
          <p><?php _e('Please select image target','goalklub');?></p>
        </li>
      </ul>
      <ul class="form-elements">
        <li class="to-label"></li>
        <li class="to-field">
          <input type="hidden" name="cs_slider_path[]" value="<?php echo esc_attr($cs_node->cs_slider_path)?>" />
          <input type="button" value="<?php _e('Submit','goalklub');?>" onclick="javascript:slideclose(<?php echo esc_js($cs_counter)?>)" class="close-submit" />
        </li>
      </ul>
      <div class="clear"></div>
    </div>
  </div>
</li>
<?php
		if ( isset($_POST['action']) ) die();
	}
	add_action('wp_ajax_slider_clone', 'cs_slider_clone');
}


/**
 * @Make a copy of media image for gallery start
 *
 *
 */
if ( ! function_exists( 'cs_gallery_clone' ) ) {
	function cs_gallery_clone($clone_field_name = ''){
	
		global $cs_node, $cs_counter;
		if( isset($_POST['action']) ) {
			$cs_node = new stdClass();
			$cs_node->title = "";
			$cs_node->use_image_as = "";
			$cs_node->video_code = "";
			$cs_node->link_url = "";
			$cs_node->use_image_as_db = "";
			$cs_node->link_url_db = '';
		}
		if ( isset($_POST['counter']) ) $cs_counter = $_POST['counter'];
		if ( isset($_POST['path']) ) $cs_node->path = $_POST['path'];
	
	?>
<li class="ui-state-default" id="<?php echo esc_attr($cs_counter);?>">
  <div class="thumb-secs">
    <?php $image_path = wp_get_attachment_image_src((int)$cs_node->path, array( get_option("thumbnail_size_w"),get_option("thumbnail_size_h") ) );?>
    <img src="<?php echo esc_url($image_path[0]);?>" alt="No image">
    <div class="gal-edit-opts"> 
      <a href="javascript:galedit(<?php echo esc_js($cs_counter)?>)" class="edit"></a> <a href="javascript:del_this('post_thumb_slider',<?php echo esc_js($cs_counter);?>)" class="delete"></a> </div>
  </div>
  <div class="poped-up" id="edit_<?php echo esc_attr($cs_counter);?>">
    <div class="cs-heading-area">
      <h5><?php _e('Edit Options','goalklub');?></h5>
      <a href="javascript:galclose(<?php echo esc_attr($cs_counter);?>)" class="closeit">&nbsp;</a> </div>
    <div class="cs-pbwp-content">
      <ul class="form-elements">
        <li class="to-label">
          <label><?php _e('Image Title','goalklub');?></label>
        </li>
        <li class="to-field">
          <input type="text" name="<?php echo esc_attr($clone_field_name);?>title[]" value="<?php echo htmlspecialchars($cs_node->title)?>" class="txtfield" />
        </li>
      </ul>
      <ul class="form-elements">
        <li class="to-label">
          <label><?php _e('Use Image As','goalklub');?></label>
        </li>
        <li class="to-field">
          <select name="<?php echo esc_attr($clone_field_name);?>use_image_as[]" class="select_dropdown" onchange="cs_toggle_gal(this.value, <?php echo esc_js($cs_counter)?>)">
            <option <?php if($cs_node->use_image_as=="0")echo "selected";?> value="0"><?php _e('LightBox to current thumbnail','goalklub');?></option>
            <option <?php if($cs_node->use_image_as=="1")echo "selected";?> value="1"><?php _e('LightBox to Video','goalklub');?></option>
            <option <?php if($cs_node->use_image_as=="2")echo "selected";?> value="2"><?php _e('Url','goalklub');?></option>
          </select>
          <p><?php _e('Please select Image link where it will go','goalklub');?></p>
        </li>
      </ul>
      <ul class="form-elements" id="video_code<?php echo esc_attr($cs_counter);?>" <?php if($cs_node->use_image_as=="0" or $cs_node->use_image_as=="" or $cs_node->use_image_as=="2")echo 'style="display:none"';?> >
        <li class="to-label">
          <label><?php _e('Video Url','goalklub');?></label>
        </li>
        <li class="to-field">
          <input type="text" name="<?php echo esc_attr($clone_field_name);?>video_code[]" value="<?php echo htmlspecialchars($cs_node->video_code)?>" class="txtfield" />
          <p><?php _e('(Enter Specific Video Url Youtube or Vimeo)','goalklub');?></p>
        </li>
      </ul>
      <ul class="form-elements" id="<?php echo esc_attr($clone_field_name);?>link_url<?php echo esc_attr($cs_counter)?>" <?php if($cs_node->use_image_as=="0" or $cs_node->use_image_as=="" or $cs_node->use_image_as=="1")echo 'style="display:none"';?> >
        <li class="to-label">
          <label><?php _e('Url','goalklub');?></label>
        </li>
        <li class="to-field">
          <input type="text" name="<?php echo esc_attr($clone_field_name);?>link_url[]" value="<?php echo htmlspecialchars($cs_node->link_url)?>" class="txtfield" />
          <p><?php _e('(Enter Specific link','goalklub');?></p>
        </li>
      </ul>
      <ul class="form-elements">
        <li class="to-label"></li>
        <li class="to-field">
          <input type="hidden" name="<?php echo esc_attr($clone_field_name);?>path[]" value="<?php echo esc_attr($cs_node->path);?>" />
          <input type="button" onclick="javascript:galclose(<?php echo esc_attr($cs_counter);?>)" value="<?php _e('Submit','goalklub');?>" class="close-submit" />
        </li>
      </ul>
      <div class="clear"></div>
    </div>
  </div>
</li>
<?php
		if ( isset($_POST['action']) ) die();
	}
	add_action('wp_ajax_gallery_clone', 'cs_gallery_clone');
}
/**
 * @add Team Scoial function
 *
 *
 */ 
if ( ! function_exists( 'cs_add_social_to_list' ) ) {
	function cs_add_social_to_list(){
		global $counter_social, $var_cp_title, $var_cp_image_url , $var_cp_team_text;
		foreach ($_POST as $keys=>$values) {
			$$keys = $values;
		}
	?>
<tr id="edit_track<?php echo esc_attr($counter_social);?>">
  <td id="album-title<?php echo esc_attr($counter_social);?>" style="width:80%;"><?php echo esc_attr($var_cp_title);?></td>
  <td class="centr" style="width:20%;"><a href="javascript:openpopedup('edit_track_form<?php echo esc_js($counter_social);?>')" class="actions edit">&nbsp;</a> <a onclick="javascript:return confirm('Are you sure! You want to delete this social icon')" href="javascript:cs_div_remove('edit_track<?php echo esc_attr($counter_social);?>')" class="actions delete">&nbsp;</a>
    <div class="poped-up" id="edit_track_form<?php echo esc_attr($counter_social);?>">
      <div class="cs-heading-area">
        <h5><?php _e('Settings','goalklub');?></h5>
        <a href="javascript:removeoverlay('edit_track_form<?php echo esc_js($counter_social);?>','append')" class="closeit">&nbsp;</a>
        <div class="clear"></div>
      </div>
      <ul class="form-elements">
        <li class="to-label">
          <label><?php _e('Title','goalklub');?></label>
        </li>
        <li class="to-field">
          <input type="text" name="var_cp_title[]" value="<?php echo htmlspecialchars($var_cp_title)?>" id="var_cp_title<?php echo esc_attr($counter_social);?>" />
        </li>
      </ul>
      <ul class="form-elements">
        <li class="to-label">
          <label><?php _e('icon/image Link','goalklub');?></label>
        </li>
        <li class="to-field">
          <input id="var_cp_image_url<?php echo esc_attr($counter_social)?>" name="var_cp_image_url[]" value="<?php echo htmlspecialchars($var_cp_image_url)?>" type="text" class="small" />
          <input id="var_cp_image_url<?php echo esc_attr($counter_social);?>" name="var_cp_image_url<?php echo esc_attr($counter_track)?>" type="button" class="uploadfile left" value="<?php _e('Browse','goalklub');?>"/>
          <p><?php _e('Put Fontawsome icon/image url. You can get fontawsome icons from','goalklub');?> <a href="<?php _e('http://fortawesome.github.io/Font-Awesome/icons/','goalklub')?>"><?php _e('here','goalklub');?></a></p>
        </li>
      </ul>
      <ul class="form-elements">
        <li class="to-label">
          <label><?php _e('Text','goalklub');?></label>
        </li>
        <li class="to-field">
          <textarea name="var_cp_team_text[]" rows="5" cols="20"><?php echo htmlspecialchars($var_cp_team_text)?></textarea>
        </li>
      </ul>
      <ul class="form-elements noborder">
        <li class="to-label">
          <label></label>
        </li>
        <li class="to-field">
          <input type="button" value="Update Personal Information" onclick="update_title(<?php echo esc_js($counter_social);?>); removeoverlay('edit_track_form<?php echo esc_js($counter_social);?>','append')" />
        </li>
      </ul>
    </div></td>
</tr>
<?php
		if ( isset($action) ) die();
	}
	add_action('wp_ajax_cs_add_social_to_list', 'cs_add_social_to_list');
}

/**
 * @Section element Size(s)
 *
 *
 */
if ( ! function_exists( 'element_size_data_array_index' ) ) {
	function element_size_data_array_index($size){
		if ( $size == "" or $size == 100 ) return 0;
		else if ( $size == 75 ) return 1;
		else if ( $size == 67 ) return 2;
		else if ( $size == 50 ) return 3;
		else if ( $size == 33 ) return 4;
		else if ( $size == 25 ) return 5;
	
	}
}

/**
 * @Get  all Categories of posts or Custom posts
 *
 *
 */
if ( ! function_exists( 'show_all_cats' ) ) {
	function show_all_cats($parent, $separator, $selected = "", $taxonomy) {
		if ($parent == "") {
			global $wpdb;
			$parent = 0;
		}
		else
		$separator .= " &ndash; ";
		$args = array(
			'parent' => $parent,
			'hide_empty' => 0,
			'taxonomy' => $taxonomy
		);
		$categories = get_categories($args);
		foreach ($categories as $category) {
			?>
		<option <?php if ($selected == $category->slug) echo "selected"; ?> value="<?php echo esc_attr($category->slug); ?>"><?php echo esc_attr($separator . $category->cat_name); ?></option>
<?php
		show_all_cats($category->term_id, $separator, $selected, $taxonomy);
		}
	}
}

/**
 * @Get  all Categories of posts or Custom posts
 *
 *
 */
if ( ! function_exists( 'show_all_categories' ) ) {
	function show_all_categories($parent, $separator, $selected = "", $taxonomy) {
		if ($parent == "") {
			global $wpdb;
			$parent = 0;
		}
		else
		$separator .= " &ndash; ";
		$args = array(
			'parent' => $parent,
			'hide_empty' => 0,
			'taxonomy' => $taxonomy
		);
		 
		$cats='';
		$categories = get_categories($args);
		foreach ($categories as $category) {
			if ($selected == $category->slug) { $select = "selected";}else{$select ='';}
		$cats.='<option '.$select.' value="'.esc_attr($category->slug).'">'. esc_attr($separator . $category->cat_name).'</option>';
		show_all_categories($category->term_id, $separator, $selected, $taxonomy);
		}
		return $cats;
	}
}
/**
 * @Page builder Members Shortcode 
 *
 *
 */
if ( ! function_exists( 'cs_pb_members' ) ) {
	function cs_pb_members($die = 0){
		global $cs_node, $post, $wp_roles;
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
			$PREFIX = 'cs_members';
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array('var_pb_members_title' => '','var_pb_members_profile_inks'=>'','var_pb_members_roles'=>'','var_pb_members_filterable'=>'','var_pb_members_pagination'=>'','var_pb_members_all_tab'=>'', 'var_pb_members_per_page'=>get_option("posts_per_page"),'var_pb_member_view'=>'','cs_members_class' => '','cs_members_animation' => '');
			if(isset($output['0']['atts']))
				$atts = $output['0']['atts'];
			else 
				$atts = array();
			$members_element_size = '50';
			foreach($defaults as $key=>$values){
				if(isset($atts[$key]))
					$$key = $atts[$key];
				else 
					$$key =$values;
			 }
			$name = 'cs_pb_members';
			$coloumn_class = 'column_'.$members_element_size;
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
		if ($var_pb_members_roles){
			$var_pb_members_roles = explode(",", $var_pb_members_roles);
			echo '<script type="text/javascript">
					jQuery(".multiselect").multiselect();
			</script>';
		}
	?>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/include/assets/scripts/ui_multiselect.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri();?>/include/assets/css/jquery_ui.css" />
<link type="text/css" rel="stylesheet"  href="<?php echo get_template_directory_uri();?>/include/assets/css/ui_multiselect.css" />
<link type="text/css" rel="stylesheet"  href="<?php echo get_template_directory_uri();?>/include/assets/css/common.css" />
<script type="text/javascript">
	jQuery(function($){
		jQuery(".multiselect").multiselect();
	});
</script>
<div id="<?php echo esc_attr($name.$cs_counter);?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class);?> <?php echo esc_attr($shortcode_view);?>" item="column" data="<?php echo element_size_data_array_index($members_element_size)?>" >
  <?php cs_element_setting($name,$cs_counter,$members_element_size);?>
  <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter);?> <?php echo esc_attr($shortcode_element);?>" id="<?php echo esc_attr($name.$cs_counter);?>" data-shortcode-template="[cs_members {{attributes}}]"  style="display: none;">
    <div class="cs-heading-area">
      <h5><?php _e('Edit Members Options','goalklub');?></h5>
      <a href="javascript:removeoverlay('<?php echo esc_js($name.$cs_counter);?>','<?php echo esc_js($filter_element);?>')" class="cs-btnclose"><i class="icon-cross3"></i></a> </div>
    <div class="cs-pbwp-content">
      <div class="cs-wrapp-clone cs-shortcode-wrapp">
        <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Section Title','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" name="var_pb_members_title[]" class="txtfield" value="<?php echo htmlspecialchars($var_pb_members_title)?>" />
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Member Views','goalklub');?></label>
          </li>
          <li class="to-field select-style">
            <select class="cs_size" name="var_pb_member_view[]">
              <option value="default" <?php if($var_pb_member_view == 'default'){echo 'selected="selected"';}?>><?php _e('Number View','goalklub');?></option>
              <option value="grid" <?php if($var_pb_member_view == 'grid'){echo 'selected="selected"';}?>><?php _e('Grid View','goalklub');?></option>
            </select>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Member Roles','goalklub');?></label>
          </li>
          <li class="to-field">
            <select name="var_pb_members_roles[<?php echo esc_attr($cs_counter);?>][]" multiple="multiple" class="multiselect" style="min-height:100px;">
              <?php 
				 foreach($var_pb_members_roles as $role){
					echo '<option value="'.$role.'" selected="selected">'.$role.'</option>';	 
				 }
				 $roles = $wp_roles->get_names();
				foreach($roles as $role_key=>$role){
					if(!in_array($role_key,$var_pb_members_roles)) {
						echo '<option value="'.$role_key.'" >'.$role.'</option>';
				  } 
				}
			 ?>
            </select>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Filterable','goalklub');?></label>
          </li>
          <li class="to-field select-style">
            <select name="var_pb_members_filterable[]" onchange="cs_members_all_tab(this.value, <?php echo esc_js($cs_counter);?>)">
              <option value="on" <?php if($var_pb_members_filterable=="on")echo "selected";?>><?php _e('On','goalklub');?></option>
              <option value="off" <?php if($var_pb_members_filterable=="off")echo "selected";?>><?php _e('Off','goalklub');?></option>
            </select>
          </li>
        </ul>
        <ul class="form-elements" id="members_all_tab<?php echo esc_attr($cs_counter);?>" <?php if($var_pb_members_filterable=="on"){ echo 'style="display: block;"';} else { echo 'style="display: none;"';}?>>
          <li class="to-label">
            <label><?php _e('Show All Tab','goalklub');?></label>
          </li>
          <li class="to-field select-style">
            <select name="var_pb_members_all_tab[]">
              <option value="on" <?php if($var_pb_members_all_tab=="on")echo "selected";?>><?php _e('On','goalklub');?></option>
              <option value="off" <?php if($var_pb_members_all_tab=="off")echo "selected";?>><?php _e('Off','goalklub');?></option>
            </select>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Profiles Link On/Off','goalklub');?></label>
          </li>
          <li class="to-field select-style">
            <select name="var_pb_members_profile_inks[]">
              <option value="on" <?php if($var_pb_members_profile_inks=="on")echo "selected";?>><?php _e('On','goalklub');?></option>
              <option value="off" <?php if($var_pb_members_profile_inks=="off")echo "selected";?>><?php _e('Off','goalklub');?></option>
            </select>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Pagination','goalklub');?></label>
          </li>
          <li class="to-field select-style">
            <select name="var_pb_members_pagination[]" class="dropdown" >
              <option <?php if($var_pb_members_pagination=="Show Pagination")echo "selected";?> ><?php _e('Show Pagination','goalklub');?></option>
              <option <?php if($var_pb_members_pagination=="Single Page")echo "selected";?> ><?php _e('Single Page','goalklub');?></option>
            </select>
          </li>
        </ul>
        <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('No. of Members Per Page','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" name="var_pb_members_per_page[]" class="txtfield" value="<?php echo esc_attr($var_pb_members_per_page);?>" />
            <p><?php _e('To display all the records, leave this field blank','goalklub');?></p>
          </li>
        </ul>
        <?php 
			if ( function_exists( 'cs_shortcode_custom_dynamic_classes' ) ) {
				cs_shortcode_custom_dynamic_classes($cs_members_class,$cs_members_animation,'','cs_members');
			}
		?>
        <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){?>
        <ul class="form-elements">
          <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo str_replace('cs_pb_','',$name);?>','<?php echo esc_attr($name.$cs_counter);?>','<?php echo esc_attr($filter_element);?>')" ><?php _e('Insert','goalklub');?></a> </li>
        </ul>
        <div id="results-shortocde"></div>
        <?php } else {?>
        <ul class="form-elements noborder">
          <li class="to-label"></li>
          <li class="to-field">
            <input type="hidden" name="cs_orderby[]" value="members" />
            <input type="hidden" name="cs_members_counter[]" value="<?php echo esc_attr($cs_counter);?>" />
            <input type="button" value="Save" style="margin-right:10px;" onclick="javascript:removeoverlay('<?php echo esc_js($name.$cs_counter)?>','<?php echo esc_js($filter_element);?>')" />
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
	add_action('wp_ajax_cs_pb_members', 'cs_pb_members');
}

/**
 * @Add FAQ List
 *
 *
 */
if ( ! function_exists( 'cs_add_faq_to_list' ) ) {
	function cs_add_faq_to_list(){
		global $counter_faq, $faq_title,$faq_description;
		foreach ($_POST as $keys=>$values) {
			$$keys = $values;
		}
	?>
    <tr class="parentdelete" id="edit_track<?php echo esc_attr($counter_faq)?>">
      <td id="subject-title<?php echo esc_attr($counter_faq)?>" style="width:80%;"><?php echo esc_attr($faq_title);?></td>
      <td class="centr" style="width:20%;"><a href="javascript:_createpop('edit_track_form<?php echo esc_js($counter_faq)?>','filter')" class="actions edit">&nbsp;</a> <a href="#" class="delete-it btndeleteit actions delete">&nbsp;</a></td>
      <td style="width:0"><div  id="edit_track_form<?php echo esc_attr($counter_faq);?>" style="display: none;" class="table-form-elem">
          <div class="cs-heading-area">
            <h5 style="text-align: left;"><?php _e('FAQ Settings','goalklub');?></h5>
            <span onclick="javascript:removeoverlay('edit_track_form<?php echo esc_js($counter_faq)?>','append')" class="cs-btnclose"> <i class="icon-cross3"></i></span>
            <div class="clear"></div>
          </div>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php _e('FAQ Title','goalklub');?></label>
            </li>
            <li class="to-field">
              <input type="text" name="faq_title_array[]" value="<?php echo htmlspecialchars($faq_title)?>" id="faq_track_title<?php echo esc_attr($counter_faq)?>" />
            </li>
          </ul>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php _e('FAQ Description','goalklub');?></label>
            </li>
            <li class="to-field">
              <textarea name="faq_description_array[]" rows="5"  id="faq_track_description<?php echo esc_attr($counter_faq);?>" cols="20"><?php echo htmlspecialchars($faq_description)?></textarea>
            </li>
          </ul>
          <ul class="form-elements noborder">
            <li class="to-label">
              <label></label>
            </li>
            <li class="to-field">
              <input type="button" value="Update FAQ" onclick="update_title(<?php echo esc_js($counter_faq);?>); removeoverlay('edit_track_form<?php echo esc_js($counter_faq);?>','append')" />
            </li>
          </ul>
        </div></td>
    </tr>
<?php
		if ( isset($action) ) die();
	}
	add_action('wp_ajax_cs_add_faq_to_list', 'cs_add_faq_to_list');
}

/**
 * @Add Social Icons
 *
 *
 */
$counter_icon = 0;
if ( ! function_exists( 'add_social_icon' ) ) {
	function add_social_icon(){
	
		$template_path = get_template_directory_uri() . '/include/assets/scripts/media_upload.js';
	
		wp_enqueue_script('my-upload2', $template_path, array('jquery', 'media-upload', 'thickbox', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-slider', 'wp-color-picker'));
		if($_POST['social_net_awesome']){
			 
			$icon_awesome = $_POST['social_net_awesome'];
		}
		$socail_network=get_option('cs_social_network');
		echo '<tr id="del_' .str_replace(' ','-',$_POST['social_net_tooltip']).'">
	
			<td>';if(isset($icon_awesome) and $icon_awesome<>''){;echo '<i style="color:'.$_POST['social_font_awesome_color'].'!important;" class="fa '.$_POST['social_net_awesome'].' fa-2x"></i>';}else{;echo '<img width="50" src="' .$_POST['social_net_icon_path']. '">';}echo '</td> 
			
			<td>' .$_POST['social_net_tooltip']. '</td> 
	
			<td><a href="#">' .$_POST['social_net_url'].'</a></td> 
	
			<td class="centr"> 
				<a class="remove-btn" onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:social_icon_del(\''.str_replace(' ','-',$_POST['social_net_tooltip']).'\')"><i class="icon-cross3"></i></a>
				 <a href="javascript:cs_toggle(\''.str_replace(' ','-',$_POST['social_net_tooltip']).'\')"><i class="icon-pencil6"></i></a>
			</td></tr>
	
		</tr>';
		
		echo '<tr id="'.str_replace(' ','-',$_POST['social_net_tooltip']).'" style="display:none">
				<td colspan="3"><ul class="form-elements">
				<li><a onclick="cs_toggle(\''.str_replace(' ','-',$_POST['social_net_tooltip']).'\')"><img src="'.get_template_directory_uri().'/include/assets/images/close-red.png" /></a></li>
				  <li class="to-label">
					  <label>"'.__('Title','goalklub').'"</label>
					</li>
					<li class="to-field">
					  <input class="small" type="text" id="social_net_tooltip" name="social_net_tooltip[]" value="'.$_POST['social_net_tooltip'].'"  />
					  <p>"'.__('Please enter text for icon tooltip','goalklub').'"</p>
					</li>
					<li class="to-label">
					  <label>"'.__('Url','goalklub').'"</label>
					</li>
					<li class="to-field">
					  <input class="small" type="text" id="social_net_url" name="social_net_url[]" value="'.$_POST['social_net_url'].'"/>
					  <p>"'.__('Please enter Full Url','goalklub').'"</p>
					</li>
					<li class="full">&nbsp;</li>
					<li class="to-label">
					  <label>"'.__('Icon Path','goalklub').'"</label>
					</li>
					<li class="to-field">
					  <input id="social_net_icon_path'.$counter_icon.'" name="social_net_icon_path[]" value="'.$_POST['social_net_icon_path'].'" type="text" class="small" />
					  <label class="browse-icon"><input id="social_net_icon_path'.$counter_icon.'" name="social_net_icon_path'.$i.'" type="button" class="uploadMedia left" value="Browse"/></label>
					</li>
					
					<li style="padding: 10px 0px 20px;" class="full">
					   <ul id="cs_infobox_networks'.$counter_icon.'">
						  <li class="to-label">
							<label>Choose Icon:</label>
						  </li>
						  <li class="to-field">'.cs_fontawsome_theme_options($_POST['social_net_awesome'],"networks".$counter_icon).'
							<input id="social_net_awesome'.$counter_icon.'" type="hidden" class="cs-search-icon-hidden" name="social_net_awesome[]" value="'.$_POST['social_net_awesome'].'">
						  </li>
					   </ul>
					  </li>
					<li class="to-label">
					  <label>Icon Color<span></span></label>
					</li>
					<li class="to-field">
					  <div class="input-sec">
					  <input type="text" name="social_font_awesome_color[]" id="social_font_awesome_color" value="'.$_POST['social_font_awesome_color'].'" class="bg_color" data-default-color="'.$_POST['social_font_awesome_color'].'" /></div>
					  <div class="left-info">
						  <p></p>
					  </div>
					</li>
					<li class="full">&nbsp;</li>
					
				  </ul></td>
			  </tr>';
			  $counter_icon++;
		die;
	
	}
	add_action('wp_ajax_add_social_icon', 'add_social_icon');
}

/**
 * @Add Player Fields
 *
 *
 */
$counter_icon = 0;
if ( ! function_exists( 'cs_add_player_fields' ) ) {
	function cs_add_player_fields(){
	
		$template_path = get_template_directory_uri() . '/include/assets/scripts/media_upload.js';
	
		wp_enqueue_script('my-upload2', $template_path, array('jquery', 'media-upload', 'thickbox', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-slider', 'wp-color-picker'));
		if($_POST['player_field']){
			 
			$player_field = $_POST['player_field'];
		}
		echo '<tr id="del_' .cs_slugify_text($_POST['player_field']).'">
	
			<td>' .$_POST['player_field']. '</td> 
	
			<td>' .$_POST['player_field_value'].'</td> 
	
			<td class="centr"> 
				<a class="remove-btn" onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:social_icon_del(\''.cs_slugify_text($_POST['player_field']).'\')"><i class="icon-cross3"></i></a>
				 <a href="javascript:cs_toggle(\''.cs_slugify_text($_POST['player_field']).'\')"><i class="icon-pencil6"></i></a>
			</td></tr>
	
		</tr>';
		
		echo '<tr id="'.cs_slugify_text($_POST['player_field']).'" style="display:none">
				<td colspan="3"><ul class="form-elements">
				<li><a onclick="cs_toggle(\''.cs_slugify_text($_POST['player_field']).'\')"><img src="'.get_template_directory_uri().'/include/assets/images/close-red.png" /></a></li>
				  <li class="to-label">
					  <label>'.__('Field','goalklub').'</label>
					</li>
					<li class="to-field">
					  <input class="small" type="text" id="player_fields" name="player_fields[]" value="'.$_POST['player_field'].'" />
					  <p>'.__('Please enter Player Field Name','goalklub').'</p>
					</li>
					<li class="to-label">
					  <label>'.__('Value','goalklub').'</label>
					</li>
					<li class="to-field">
					  <input class="small" type="text" id="player_field_values" name="player_field_values[]" value="'.$_POST['player_field_value'].'" />
					  <p>'.__('Please enter Player Field Value','goalklub').'</p>
					</li>
					<li class="full">&nbsp;</li>
				  </ul></td>
			  </tr>';
			  $counter_icon++;
		die;
	
	}
	add_action('wp_ajax_cs_add_player_fields', 'cs_add_player_fields');
}

/**
 * @Add Table Points Columns
 *
 *
 */
$add_table_column_counter = 0;
if ( ! function_exists( 'cs_add_table_columns' ) ) {
	function cs_add_table_columns(){
	
		$template_path = get_template_directory_uri() . '/include/assets/scripts/media_upload.js';
	
		wp_enqueue_script('my-upload2', $template_path, array('jquery', 'media-upload', 'thickbox', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-slider', 'wp-color-picker'));
		
		echo '<tr id="del_'.cs_slugify_text($_POST['table_points_columns']).'">
	
			<td>' .$_POST['table_points_columns']. '</td> 
	
			<td class="centr"> 
				<a class="remove-btn" onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:social_icon_del(\''.cs_slugify_text($_POST['table_points_columns']).'\')"><i class="icon-cross3"></i></a>
				 <a href="javascript:cs_toggle(\''.cs_slugify_text($_POST['table_points_columns']).'\')"><i class="icon-pencil6"></i></a>
			</td></tr>
	
		</tr>';
		
		echo '<tr id="'.cs_slugify_text($_POST['table_points_columns']).'" style="display:none">
				<td colspan="3"><ul class="form-elements">
				<li><a onclick="cs_toggle(\''.cs_slugify_text($_POST['table_points_columns']).'\')"><img src="'.get_template_directory_uri().'/include/assets/images/close-red.png" /></a></li>
					<li class="to-label">
					  <label>'.__('Column Title','goalklub').'</label>
					</li>
					<li class="to-field">
					  <input class="small" type="text" id="table_points_columns" name="table_points_columns[]" value="'.$_POST['table_points_columns'].'" />
					</li>
					<li class="full">&nbsp;</li>
					<li class="to-label">
					  <label>'.__('Table Column Title 1','goalklub').'</label>
					</li>
					<li class="to-field">
					  <input class="small" type="text" id="table_column_title1" name="table_column_title1[]" value="'.$_POST['table_column_title1'].'" />
					</li>
					<li class="full">&nbsp;</li>
					<li class="to-label">
					  <label>'.__('Table Column Title 1','goalklub').'</label>
					</li>
					<li class="to-field">
					  <input class="small" type="text" id="table_column_title2" name="table_column_title2[]" value="'.$_POST['table_column_title2'].'" />
					</li>
					<li class="full">&nbsp;</li>
					<li class="to-label">
					  <label>'.__('Table Column Title 1','goalklub').'</label>
					</li>
					<li class="to-field">
					  <input class="small" type="text" id="table_column_title3" name="table_column_title3[]" value="'.$_POST['table_column_title3'].'" />
					</li>
					<li class="full">&nbsp;</li>
					<li class="to-label">
					  <label>'.__('Table Column Title 1','goalklub').'</label>
					</li>
					<li class="to-field">
					  <input class="small" type="text" id="table_column_title4" name="table_column_title4[]" value="'.$_POST['table_column_title4'].'" />
					</li>
					<li class="full">&nbsp;</li>
					<li class="to-label">
					  <label>'.__('Table Column Title 1','goalklub').'</label>
					</li>
					<li class="to-field">
					  <input class="small" type="text" id="table_column_title5" name="table_column_title5[]" value="'.$_POST['table_column_title5'].'" />
					</li>
					<li class="full">&nbsp;</li>
					<li class="to-label">
					  <label>'.__('Table Column Title 1','goalklub').'</label>
					</li>
					<li class="to-field">
					  <input class="small" type="text" id="table_column_title6" name="table_column_title6[]" value="'.$_POST['table_column_title6'].'" />
					</li>
					<li class="full">&nbsp;</li>
					<li class="to-label">
					  <label>'.__('Table Column Title 1','goalklub').'</label>
					</li>
					<li class="to-field">
					  <input class="small" type="text" id="table_column_title7" name="table_column_title7[]" value="'.$_POST['table_column_title7'].'" />
					</li>
					<li class="full">&nbsp;</li>
					<li class="to-label">
					  <label>'.__('Table Column Title 1','goalklub').'</label>
					</li>
					<li class="to-field">
					  <input class="small" type="text" id="table_column_title8" name="table_column_title8[]" value="'.$_POST['table_column_title8'].'" />
					</li>
					<li class="full">&nbsp;</li>
					<li class="to-label">
					  <label>'.__('Table Column Title 1','goalklub').'</label>
					</li>
					<li class="to-field">
					  <input class="small" type="text" id="table_column_title9" name="table_column_title9[]" value="'.$_POST['table_column_title9'].'" />
					</li>
					<li class="full">&nbsp;</li>
					<li class="to-label">
					  <label>'.__('Table Column Title 1','goalklub').'</label>
					</li>
					<li class="to-field">
					  <input class="small" type="text" id="table_column_title10" name="table_column_title10[]" value="'.$_POST['table_column_title10'].'" />
					</li>
					<li class="full">&nbsp;</li>
				  </ul></td>
			  </tr>';
			  $add_table_column_counter++;
		die;
	
	}
	add_action('wp_ajax_cs_add_table_columns', 'cs_add_table_columns');
}

// Fontawsome icon box
if ( ! function_exists( 'cs_fontawsome_icons_box') ) {
	function cs_fontawsome_icons_box($icon_value='',$id='',$name=''){
		ob_start();
		?>
		<script>
            jQuery(document).ready(function($) {
			var e9_element = $('#e9_element_<?php echo cs_allow_special_char($id);?>').fontIconPicker({
				theme: 'fip-bootstrap'
				});
					// Add the event on the button
				$('#e9_buttons_<?php echo cs_allow_special_char($id);?> button').on('click', function(e) {
						
						e.preventDefault();
						// Show processing message
						$(this).prop('disabled', true).html('<i class="icon-cog demo-animate-spin"></i> Please wait...');
						$.ajax({
							url: '<?php echo get_template_directory_uri();?>/include/assets/icon/js/selection.json',
							type: 'GET',
							dataType: 'json'
						})
						.done(function(response) {
							// Get the class prefix
							var classPrefix = response.preferences.fontPref.prefix,
								icomoon_json_icons = [],
								icomoon_json_search = [];
							$.each(response.icons, function(i, v) {
								icomoon_json_icons.push( classPrefix + v.properties.name );
								if ( v.icon && v.icon.tags && v.icon.tags.length ) {
									icomoon_json_search.push( v.properties.name + ' ' + v.icon.tags.join(' ') );
								} else {
									icomoon_json_search.push( v.properties.name );
								}
							});
							// Set new fonts on fontIconPicker
							e9_element.setIcons(icomoon_json_icons, icomoon_json_search);
							// Show success message and disable
							$('#e9_buttons_<?php echo cs_allow_special_char($id);?> button').removeClass('btn-primary').addClass('btn-success').text('Successfully loaded icons').prop('disabled', true);
						})
						.fail(function() {
							// Show error message and enable
							$('#e9_buttons_<?php echo cs_allow_special_char($id);?> button').removeClass('btn-primary').addClass('btn-danger').text('Error: Try Again?').prop('disabled', false);
						});
						e.stopPropagation();
					});
				jQuery("#e9_buttons_<?php echo cs_allow_special_char($id);?> button").click();
			});
				
		</script>
		<input type="text" id="e9_element_<?php echo cs_allow_special_char($id);?>" name="<?php echo cs_allow_special_char($name);?>[]" value="<?php echo cs_allow_special_char($icon_value);?>"/>
		<span id="e9_buttons_<?php echo cs_allow_special_char($id);?>" style="display:none">
			<button autocomplete="off" type="button" class="btn btn-primary">Load from IcoMoon selection.json</button>
		</span>
	<?php 
		$fontawesome = ob_get_clean();
		echo cs_allow_special_char($fontawesome);
	}
}

// Fontawsome icon box for category
if ( ! function_exists( 'cs_fontawsome_icons_box_cat') ) {
	function cs_fontawsome_icons_box_cat($icon_value='',$id='',$name=''){
		ob_start();
		?>
		<script>
            jQuery(document).ready(function($) {
			var e9_element = $('#e9_element_<?php echo cs_allow_special_char($id);?>').fontIconPicker({
				theme: 'fip-bootstrap'
				});
					// Add the event on the button
				$('#e9_buttons_<?php echo cs_allow_special_char($id);?> button').on('click', function(e) {
						
						e.preventDefault();
						// Show processing message
						$(this).prop('disabled', true).html('<i class="icon-cog demo-animate-spin"></i> Please wait...');
						$.ajax({
							url: '<?php echo get_template_directory_uri();?>/include/assets/icon/js/selection.json',
							type: 'GET',
							dataType: 'json'
						})
						.done(function(response) {
							// Get the class prefix
							var classPrefix = response.preferences.fontPref.prefix,
								icomoon_json_icons = [],
								icomoon_json_search = [];
							$.each(response.icons, function(i, v) {
								icomoon_json_icons.push( classPrefix + v.properties.name );
								if ( v.icon && v.icon.tags && v.icon.tags.length ) {
									icomoon_json_search.push( v.properties.name + ' ' + v.icon.tags.join(' ') );
								} else {
									icomoon_json_search.push( v.properties.name );
								}
							});
							// Set new fonts on fontIconPicker
							e9_element.setIcons(icomoon_json_icons, icomoon_json_search);
							// Show success message and disable
							$('#e9_buttons_<?php echo cs_allow_special_char($id);?> button').removeClass('btn-primary').addClass('btn-success').text('Successfully loaded icons').prop('disabled', true);
						})
						.fail(function() {
							// Show error message and enable
							$('#e9_buttons_<?php echo cs_allow_special_char($id);?> button').removeClass('btn-primary').addClass('btn-danger').text('Error: Try Again?').prop('disabled', false);
						});
						e.stopPropagation();
					});
				jQuery("#e9_buttons_<?php echo cs_allow_special_char($id);?> button").click();
			});
				
		</script>
		<input type="text" id="e9_element_<?php echo cs_allow_special_char($id);?>" name="<?php echo cs_allow_special_char($name);?>" value="<?php echo cs_allow_special_char($icon_value);?>"/>
		<span id="e9_buttons_<?php echo cs_allow_special_char($id);?>" style="display:none">
			<button autocomplete="off" type="button" class="btn btn-primary">Load from IcoMoon selection.json</button>
		</span>
	<?php 
		$fontawesome = ob_get_clean();
		echo cs_allow_special_char($fontawesome);
	}
}

// Fontawsome icon box for Theme Options
if ( ! function_exists( 'cs_fontawsome_theme_options') ) {
	function cs_fontawsome_theme_options($icon_value='',$id='',$name=''){
		ob_start();
		?>
		<script>
            jQuery(document).ready(function($) {
				
				var e9_element = $('#e9_element_<?php echo cs_allow_special_char($id);?>').fontIconPicker({
				theme: 'fip-bootstrap'
				});
					// Add the event on the button
				$('#e9_buttons_<?php echo cs_allow_special_char($id);?> button').on('click', function(e) {
						e.preventDefault();
						// Show processing message
						$(this).prop('disabled', true).html('<i class="icon-cog demo-animate-spin"></i> Please wait...');
						$.ajax({
							url: '<?php echo get_template_directory_uri();?>/include/assets/icon/js/selection.json',
							type: 'GET',
							dataType: 'json'
						})
						.done(function(response) {
							// Get the class prefix
							var classPrefix = response.preferences.fontPref.prefix,
								icomoon_json_icons = [],
								icomoon_json_search = [];
							$.each(response.icons, function(i, v) {
								icomoon_json_icons.push( classPrefix + v.properties.name );
								if ( v.icon && v.icon.tags && v.icon.tags.length ) {
									icomoon_json_search.push( v.properties.name + ' ' + v.icon.tags.join(' ') );
								} else {
									icomoon_json_search.push( v.properties.name );
								}
							});
							// Set new fonts on fontIconPicker
							e9_element.setIcons(icomoon_json_icons, icomoon_json_search);
							// Show success message and disable
							$('#e9_buttons_<?php echo cs_allow_special_char($id);?> button').removeClass('btn-primary').addClass('btn-success').text('Successfully loaded icons').prop('disabled', true);
						})
						.fail(function() {
							// Show error message and enable
							$('#e9_buttons_<?php echo cs_allow_special_char($id);?> button').removeClass('btn-primary').addClass('btn-danger').text('Error: Try Again?').prop('disabled', false);
						});
						e.stopPropagation();
					});
				
				jQuery("#e9_buttons_<?php echo cs_allow_special_char($id);?> button").click();
			});
				
		</script>
		<input type="text" id="e9_element_<?php echo cs_allow_special_char($id);?>" name="<?php echo cs_allow_special_char($name);?>[]" value="<?php echo cs_allow_special_char($icon_value);?>"/>
		<span id="e9_buttons_<?php echo cs_allow_special_char($id);?>" style="display:none">
			<button autocomplete="off" type="button" class="btn btn-primary">Load from IcoMoon selection.json</button>
		</span>
	<?php 
	
		$fontawesome = ob_get_clean();
		return $fontawesome;
	}
}

// Team Dynamic Fields List
if ( ! function_exists( 'cs_team_dynamic_fields_section' ) ) {
	function cs_team_dynamic_fields_section($post_id=''){
			global $post, $cs_xmlObject, $counter_dynamic_fields, $directory_dynamic_fields_title, $directory_dynamic_fields_description,$cs_theme_options;
			if(isset($post_id) && !empty($post_id)){
				$counter_dynamic_fields = $post_id;
				$cs_directory = get_post_meta($post_id, "team", true);
				if ( $cs_directory <> "" ) {
					$cs_xmlObject = new SimpleXMLElement($cs_directory);
					
					
				}	
			} else {
				$counter_dynamic_fields = $post->ID;	
			}
			if(!isset($cs_xmlObject))
				$cs_xmlObject = new stdClass();
			?>
        <input type="hidden" name="dynamic_post_dynamic_fields" value="1" />
	 
	  <script>
		jQuery(document).ready(function($) {
			/*$("#total_dynamic_fieldss").sortable({
				cancel : 'td div.table-form-elem'
			});*/
		});
	 </script>
      <ul class="form-elements">
            <li class="to-label"><?php _e('Add Dynamic Field','goalklub');?></li>
            <li class="to-button"><a href="javascript:_createpop('add_dynamic_fields_title','filter')" class="button"><?php _e('Add Dynamic Field','goalklub');?></a> </li>
       </ul>
	  <div class="cs-list-table">
      <table class="to-table" border="0" cellspacing="0">
		<thead>
		  <tr>
			<th style="width:80%;">Title</th>
			<th style="width:80%;" class="centr"><?php _e('Actions','goalklub');?></th>
            <th style="width:0%;" class="centr"></th>
		  </tr>
		</thead>
		<tbody id="total_dynamic_fieldss">
		  <?php
				if ( isset($cs_xmlObject->dynamic_fieldss) && is_object($cs_xmlObject) && count($cs_xmlObject->dynamic_fieldss)>0) {
					foreach ( $cs_xmlObject->dynamic_fieldss as $dynamic_fieldss ){
						 $directory_dynamic_fields_title = $dynamic_fieldss->dynamic_fields_title;
						 $directory_dynamic_fields_description = $dynamic_fieldss->dynamic_fields_description;
						 cs_add_dynamic_fields_to_list();
						 $counter_dynamic_fields++;
					}
				}
				else{
					if(isset($cs_theme_options['player_fields']) and is_array($cs_theme_options['player_fields']) and $cs_theme_options['player_fields'] <> ''){
						$i=0;
						foreach ( $cs_theme_options['player_fields'] as $dynamic_fields ){
							 $directory_dynamic_fields_title = $dynamic_fields;
							 $directory_dynamic_fields_description = $cs_theme_options['player_field_values'][$i];
							 cs_add_dynamic_fields_to_list();
							 $counter_dynamic_fields++;
							 $i++;
						}
					}
				}
			?>
		</tbody>
	  </table>
      </div>
	  <div id="add_dynamic_fields_title" style="display: none;">
		<div class="cs-heading-area">
		  <h5> <i class="icon-plus-circle"></i><?php _e('dynamic_fields Settings','goalklub');?>  </h5>
		  <span class="cs-btnclose" onClick="javascript:removeoverlay('add_dynamic_fields_title','append')"> <i class="icon-times"></i></span> </div>
		<ul class="form-elements">
		  <li class="to-label">
			<label><?php _e('Title','goalklub');?></label>
		  </li>
		  <li class="to-field">
			<input type="text" id="dynamic_fields_title" name="dynamic_fields_title" value="Title" />
		  </li>
		</ul>
		<ul class="form-elements">
		  <li class="to-label">
			<label><?php _e('Dynamic Fields Value','goalklub');?></label>
		  </li>
		  <li class="to-field">
            <input type="text" id="dynamic_fields_description" name="dynamic_fields_description" value="Value" />
		  </li>
		</ul>
		<ul class="form-elements noborder">
		  <li class="to-label"></li>
		  <li class="to-field">
			<input type="button" value="Add Dynamic Fields to List" onClick="add_dynamic_fields_to_list('<?php echo esc_js(admin_url('admin-ajax.php'));?>', '<?php echo esc_js(get_template_directory_uri());?>')" />
		  </li>
		</ul>
	  </div>
	<?php
	}
}

/**
 * @Add dynamic_fields List
 *
 *
 */
if ( ! function_exists( 'cs_add_dynamic_fields_to_list' ) ) {
	function cs_add_dynamic_fields_to_list(){
		global $counter_dynamic_fields, $directory_dynamic_fields_title,$directory_dynamic_fields_description;
		foreach ($_POST as $keys=>$values) {
			$$keys = $values;
		}
	?>
    <tr class="parentdelete" id="edit_track<?php echo force_back($counter_dynamic_fields); ?>">
      <td id="subject-title<?php echo esc_attr($counter_dynamic_fields)?>" style="width:80%;"><?php echo force_back($directory_dynamic_fields_title);?></td>
      <td class="centr" style="width:20%;"><a href="javascript:_createpop('edit_track_form<?php echo esc_js($counter_dynamic_fields)?>','filter')" class="actions edit">&nbsp;</a> <a href="#" class="delete-it btndeleteit actions delete">&nbsp;</a></td>
      <td style="width:0"><div  id="edit_track_form<?php echo esc_attr($counter_dynamic_fields);?>" style="display: none;" class="table-form-elem">
          <div class="cs-heading-area">
            <h5 style="text-align: left;"><?php _e('Dynamic Fields Settings','goalklub');?></h5>
            <span onclick="javascript:removeoverlay('edit_track_form<?php echo esc_js($counter_dynamic_fields)?>','append')" class="cs-btnclose"> <i class="icon-times"></i></span>
            <div class="clear"></div>
          </div>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php _e('Dynamic Fields Title','goalklub');?></label>
            </li>
            <li class="to-field">
              <input type="text" name="dynamic_fields_title_array[]" value="<?php echo force_back(htmlspecialchars($directory_dynamic_fields_title)); ?>" id="dynamic_fields_track_title<?php echo esc_attr($counter_dynamic_fields)?>" />
            </li>
          </ul>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php _e('Dynamic Fields Value','goalklub');?></label>
            </li>
            <li class="to-field">
              <input type="text" name="dynamic_fields_description_array[]" value="<?php echo htmlspecialchars($directory_dynamic_fields_description)?>" id="dynamic_fields_track_description<?php echo esc_attr($counter_dynamic_fields)?>" />
            </li>
          </ul>
          <ul class="form-elements noborder">
            <li class="to-label">
              <label></label>
            </li>
            <li class="to-field">
              <input type="button" value="Update Dynamic Fields" onclick="update_title(<?php echo esc_js($counter_dynamic_fields);?>); removeoverlay('edit_track_form<?php echo esc_js($counter_dynamic_fields);?>','append')" />
            </li>
          </ul>
        </div></td>
    </tr>
<?php
		if ( isset($_POST['dynamic_fields_title']) && isset($_POST['cs_add_dynamic_fields_to_list']) ) die();
	}
	add_action('wp_ajax_cs_add_dynamic_fields_to_list', 'cs_add_dynamic_fields_to_list');
}

if ( ! function_exists( 'cs_point_table_seleted' ) ) {
	function cs_point_table_seleted(){
		global $post, $cs_xmlObject, $counter_point_table, $cs_theme_options;
		foreach ($_POST as $keys=>$values) {
			$$keys = $values;
		}
		?>
        <input type="hidden" name="cs_pointtable_fields" value="1" />
	 
	  <script>
		jQuery(document).ready(function($) {
			$("#total_pointtable_fields").sortable({
				cancel : 'td div.table-form-elem'
			});
		});
	  </script>
      <ul class="form-elements">
          <li class="to-label"><?php _e('Add Point Table','goalklub');?></li>
          <li class="to-button"><a href="javascript:_createpop('add_pointtable_title','filter')" class="button"><?php _e('Add Point Table','goalklub');?></a> </li>
      </ul>
	  <div class="cs-list-table">
      <table class="to-table" border="0" cellspacing="0">
		<thead>
		  <tr>
			<th style="width:80%;"><?php _e('Title','goalklub');?></th>
			<th style="width:80%;" class="centr"><?php _e('Actions','goalklub');?></th>
            <th style="width:0%;" class="centr"></th>
		  </tr>
		</thead>
		<tbody id="total_pointtable_fields">
		  
		</tbody>
	  </table>
      </div>
	  <div id="add_pointtable_title" style="display: none;">
		<div class="cs-heading-area">
		  <h5> <i class="icon-plus-circle"></i><?php _e('Point Table Settings','goalklub');?></h5>
		  <span class="cs-btnclose" onClick="javascript:removeoverlay('add_pointtable_title','append')"> <i class="icon-times"></i></span> </div>
          	<?php
			$table_set_value = isset($table_set_value ) ? $table_set_value : '';
			$point_table_i=0;
			if(isset($cs_theme_options['table_points_columns']) and is_array($cs_theme_options['table_points_columns']) and $cs_theme_options['table_points_columns'] <> ''){
				foreach ( $cs_theme_options['table_points_columns'] as $table_points_column ){
					if($table_points_column == $table_set_value){
						break;
					}
					$point_table_i++;
				}
			}
			
			if(isset($cs_theme_options['table_column_title1'][$point_table_i]) and $cs_theme_options['table_column_title1'][$point_table_i] <> ''){
			?>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title1'][$point_table_i]); ?></label>
              </li>
              <li class="to-field">
                <input type="text" id="point_table_column_title1" name="point_table_column_title1" value="" />
              </li>
            </ul>
			<?php
			}
			if(isset($cs_theme_options['table_column_title2'][$point_table_i]) and $cs_theme_options['table_column_title2'][$point_table_i] <> ''){
			?>
            <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title2'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" id="point_table_column_title2" name="point_table_column_title2" value="" />
            </li>
            </ul>
            <?php
			}
			if(isset($cs_theme_options['table_column_title3'][$point_table_i]) and $cs_theme_options['table_column_title3'][$point_table_i] <> ''){
			?>
            <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title3'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" id="point_table_column_title3" name="point_table_column_title3" value="" />
            </li>
            </ul>
            <?php
			}
			if(isset($cs_theme_options['table_column_title4'][$point_table_i]) and $cs_theme_options['table_column_title4'][$point_table_i] <> ''){
			?>
            <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title4'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" id="point_table_column_title4" name="point_table_column_title4" value="" />
            </li>
            </ul>
            <?php
			}
			if(isset($cs_theme_options['table_column_title5'][$point_table_i]) and $cs_theme_options['table_column_title5'][$point_table_i] <> ''){
			?>
            <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title5'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" id="point_table_column_title5" name="point_table_column_title5" value="" />
            </li>
            </ul>
            <?php
			}
			if(isset($cs_theme_options['table_column_title6'][$point_table_i]) and $cs_theme_options['table_column_title6'][$point_table_i] <> ''){
			?>
            <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title6'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" id="point_table_column_title6" name="point_table_column_title6" value="" />
            </li>
            </ul>
            <?php
			}
			if(isset($cs_theme_options['table_column_title7'][$point_table_i]) and $cs_theme_options['table_column_title7'][$point_table_i] <> ''){
			?>
            <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title7'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" id="point_table_column_title7" name="point_table_column_title7" value="" />
            </li>
            </ul>
            <?php
			}
			if(isset($cs_theme_options['table_column_title8'][$point_table_i]) and $cs_theme_options['table_column_title8'][$point_table_i] <> ''){
			?>
            <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title8'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" id="point_table_column_title8" name="point_table_column_title8" value="" />
            </li>
            </ul>
            <?php
			}
			if(isset($cs_theme_options['table_column_title9'][$point_table_i]) and $cs_theme_options['table_column_title9'][$point_table_i] <> ''){
			?>
            <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title9'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" id="point_table_column_title9" name="point_table_column_title9" value="" />
            </li>
            </ul>
            <?php
			}
			if(isset($cs_theme_options['table_column_title10'][$point_table_i]) and $cs_theme_options['table_column_title10'][$point_table_i] <> ''){
			?>
            <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title10'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" id="point_table_column_title10" name="point_table_column_title10" value="" />
            </li>
            </ul>
            <?php
			}
			?>
          
          <ul class="form-elements">
            <li class="to-label">
              <label><?php _e('Feature','goalklub');?></label>
            </li>
            <li class="to-field">
              <div class="select-style">
                <select name="point_table_column_feature" id="point_table_column_feature" class="dropdown">
                  <option><?php _e('No','goalklub');?></option>
                  <option><?php _e('Yes','goalklub');?></option>
                </select>
              </div>
            </li>
          </ul>
          <ul class="form-elements noborder">
            <li class="to-label"></li>
            <li class="to-field">
              <input type="hidden" id="point_table_i" name="point_table_i" value="<?php echo cs_allow_special_char($point_table_i); ?>" />
              <input type="button" value="Add Point Table" onClick="add_pointtable_to_list('<?php echo esc_js(admin_url('admin-ajax.php'));?>', '<?php echo esc_js(get_template_directory_uri());?>')" />
            </li>
          </ul>
	  </div>
	<?php
	die;
	}
	add_action('wp_ajax_cs_point_table_seleted', 'cs_point_table_seleted');
}

// Point Tables List
if ( ! function_exists( 'cs_point_tables_section' ) ) {
	function cs_point_tables_section($cs_pointtable_set, $post_id=''){
		global $post, $cs_xmlObject, $cs_theme_options, $counter_point_table, $point_table_i, $point_table_column_feature, $point_table_column_title1, $point_table_column_title2, $point_table_column_title3, $point_table_column_title4, $point_table_column_title5, $point_table_column_title6, $point_table_column_title7, $point_table_column_title8, $point_table_column_title9, $point_table_column_title10;
		if(isset($post_id) && !empty($post_id)){
			$counter_point_table = $post_id;
			$cs_pointtable = get_post_meta($post_id, "pointtable", true);
			if ( $cs_pointtable <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($cs_pointtable);
			}	
		} else {
			$counter_point_table = $post->ID;	
		}
		if(!isset($cs_xmlObject))
			$cs_xmlObject = new stdClass();
			
		?>
        <input type="hidden" name="cs_pointtable_fields" value="1" />
	 
	  <script>
		jQuery(document).ready(function($) {
			$("#total_pointtable_fields").sortable({
				cancel : 'td div.table-form-elem'
			});
		});
	  </script>
      <ul class="form-elements">
          <li class="to-label"><?php _e('Add Point Table','goalklub');?></li>
          <li class="to-button"><a href="javascript:_createpop('add_pointtable_title','filter')" class="button"><?php _e('Add Point Table','goalklub');?></a> </li>
      </ul>
	  <div class="cs-list-table">
      <table class="to-table" border="0" cellspacing="0">
		<thead>
		  <tr>
			<th style="width:80%;"><?php _e('Title','goalklub');?></th>
			<th style="width:80%;" class="centr"><?php _e('Actions','goalklub');?></th>
            <th style="width:0%;" class="centr"></th>
		  </tr>
		</thead>
		<tbody id="total_pointtable_fields">
		  <?php
				if ( isset($cs_xmlObject->point_tables) && is_object($cs_xmlObject) && count($cs_xmlObject->point_tables)>0 ) {
					foreach ( $cs_xmlObject->point_tables as $point_table ){
						 $table_set_value = isset($cs_pointtable_set) ? $cs_pointtable_set : '';
						 $point_table_i=0;
						 if(isset($cs_theme_options['table_points_columns']) and is_array($cs_theme_options['table_points_columns']) and $cs_theme_options['table_points_columns'] <> ''){
							foreach ( $cs_theme_options['table_points_columns'] as $table_points_column ){
								if($table_points_column == $table_set_value){
									break;
								}
								$point_table_i++;
							}
						 }
						 $point_table_column_title1 = $point_table->point_table_column_title1;
						 $point_table_column_title2 = $point_table->point_table_column_title2;
						 $point_table_column_title3 = $point_table->point_table_column_title3;
						 $point_table_column_title4 = $point_table->point_table_column_title4;
						 $point_table_column_title5 = $point_table->point_table_column_title5;
						 $point_table_column_title6 = $point_table->point_table_column_title6;
						 $point_table_column_title7 = $point_table->point_table_column_title7;
						 $point_table_column_title8 = $point_table->point_table_column_title8;
						 $point_table_column_title9 = $point_table->point_table_column_title9;
						 $point_table_column_title10 = $point_table->point_table_column_title10;
						 $point_table_column_feature = $point_table->point_table_column_feature;
						 cs_add_point_tables_to_list();
						 $counter_point_table++;
					}
				}
			?>
		</tbody>
	  </table>
      </div>
	  <div id="add_pointtable_title" style="display: none;">
		<div class="cs-heading-area">
		  <h5> <i class="icon-plus-circle"></i><?php _e('Point Table Settings','goalklub');?></h5>
		  <span class="cs-btnclose" onClick="javascript:removeoverlay('add_pointtable_title','append')"> <i class="icon-times"></i></span> </div>
          <?php
		  $table_set_value = isset($cs_pointtable_set) ? $cs_pointtable_set : '';
		  $point_table_i=0;
		  if(isset($cs_theme_options['table_points_columns']) and is_array($cs_theme_options['table_points_columns']) and $cs_theme_options['table_points_columns'] <> ''){
			  foreach ( $cs_theme_options['table_points_columns'] as $table_points_column ){
				  if($table_points_column == $table_set_value){
					  break;
				  }
				  $point_table_i++;
			  }
		  }
		  
		  if(isset($cs_theme_options['table_column_title1'][$point_table_i]) and $cs_theme_options['table_column_title1'][$point_table_i] <> ''){
		  ?>
		  <ul class="form-elements">
			<li class="to-label">
			  <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title1'][$point_table_i]); ?></label>
			</li>
			<li class="to-field">
			  <input type="text" id="point_table_column_title1" name="point_table_column_title1" value="" />
			</li>
		  </ul>
		  <?php
		  }
		  if(isset($cs_theme_options['table_column_title2'][$point_table_i]) and $cs_theme_options['table_column_title2'][$point_table_i] <> ''){
		  ?>
		  <ul class="form-elements">
		  <li class="to-label">
			<label><?php echo cs_allow_special_char($cs_theme_options['table_column_title2'][$point_table_i]); ?></label>
		  </li>
		  <li class="to-field">
			<input type="text" id="point_table_column_title2" name="point_table_column_title2" value="" />
		  </li>
		  </ul>
		  <?php
		  }
		  if(isset($cs_theme_options['table_column_title3'][$point_table_i]) and $cs_theme_options['table_column_title3'][$point_table_i] <> ''){
		  ?>
		  <ul class="form-elements">
		  <li class="to-label">
			<label><?php echo cs_allow_special_char($cs_theme_options['table_column_title3'][$point_table_i]); ?></label>
		  </li>
		  <li class="to-field">
			<input type="text" id="point_table_column_title3" name="point_table_column_title3" value="" />
		  </li>
		  </ul>
		  <?php
		  }
		  if(isset($cs_theme_options['table_column_title4'][$point_table_i]) and $cs_theme_options['table_column_title4'][$point_table_i] <> ''){
		  ?>
		  <ul class="form-elements">
		  <li class="to-label">
			<label><?php echo cs_allow_special_char($cs_theme_options['table_column_title4'][$point_table_i]); ?></label>
		  </li>
		  <li class="to-field">
			<input type="text" id="point_table_column_title4" name="point_table_column_title4" value="" />
		  </li>
		  </ul>
		  <?php
		  }
		  if(isset($cs_theme_options['table_column_title5'][$point_table_i]) and $cs_theme_options['table_column_title5'][$point_table_i] <> ''){
		  ?>
		  <ul class="form-elements">
		  <li class="to-label">
			<label><?php echo cs_allow_special_char($cs_theme_options['table_column_title5'][$point_table_i]); ?></label>
		  </li>
		  <li class="to-field">
			<input type="text" id="point_table_column_title5" name="point_table_column_title5" value="" />
		  </li>
		  </ul>
		  <?php
		  }
		  if(isset($cs_theme_options['table_column_title6'][$point_table_i]) and $cs_theme_options['table_column_title6'][$point_table_i] <> ''){
		  ?>
		  <ul class="form-elements">
		  <li class="to-label">
			<label><?php echo cs_allow_special_char($cs_theme_options['table_column_title6'][$point_table_i]); ?></label>
		  </li>
		  <li class="to-field">
			<input type="text" id="point_table_column_title6" name="point_table_column_title6" value="" />
		  </li>
		  </ul>
		  <?php
		  }
		  if(isset($cs_theme_options['table_column_title7'][$point_table_i]) and $cs_theme_options['table_column_title7'][$point_table_i] <> ''){
		  ?>
		  <ul class="form-elements">
		  <li class="to-label">
			<label><?php echo cs_allow_special_char($cs_theme_options['table_column_title7'][$point_table_i]); ?></label>
		  </li>
		  <li class="to-field">
			<input type="text" id="point_table_column_title7" name="point_table_column_title7" value="" />
		  </li>
		  </ul>
		  <?php
		  }
		  if(isset($cs_theme_options['table_column_title8'][$point_table_i]) and $cs_theme_options['table_column_title8'][$point_table_i] <> ''){
		  ?>
		  <ul class="form-elements">
		  <li class="to-label">
			<label><?php echo cs_allow_special_char($cs_theme_options['table_column_title8'][$point_table_i]); ?></label>
		  </li>
		  <li class="to-field">
			<input type="text" id="point_table_column_title8" name="point_table_column_title8" value="" />
		  </li>
		  </ul>
		  <?php
		  }
		  if(isset($cs_theme_options['table_column_title9'][$point_table_i]) and $cs_theme_options['table_column_title9'][$point_table_i] <> ''){
		  ?>
		  <ul class="form-elements">
		  <li class="to-label">
			<label><?php echo cs_allow_special_char($cs_theme_options['table_column_title9'][$point_table_i]); ?></label>
		  </li>
		  <li class="to-field">
			<input type="text" id="point_table_column_title9" name="point_table_column_title9" value="" />
		  </li>
		  </ul>
		  <?php
		  }
		  if(isset($cs_theme_options['table_column_title10'][$point_table_i]) and $cs_theme_options['table_column_title10'][$point_table_i] <> ''){
		  ?>
		  <ul class="form-elements">
		  <li class="to-label">
			<label><?php echo cs_allow_special_char($cs_theme_options['table_column_title10'][$point_table_i]); ?></label>
		  </li>
		  <li class="to-field">
			<input type="text" id="point_table_column_title10" name="point_table_column_title10" value="" />
		  </li>
		  </ul>
		  <?php
		  }
		  ?>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php _e('Feature','goalklub');?></label>
            </li>
            <li class="to-field">
              <div class="select-style">
                <select name="point_table_column_feature" id="point_table_column_feature" class="dropdown">
                  <option><?php _e('No','goalklub');?></option>
                  <option><?php _e('Yes','goalklub');?></option>
                </select>
              </div>
            </li>
          </ul>
          <ul class="form-elements noborder">
            <li class="to-label"></li>
            <li class="to-field">
              <input type="hidden" id="point_table_i" name="point_table_i" value="<?php echo cs_allow_special_char($point_table_i); ?>" />
              <input type="button" value="Add Point Table" onClick="add_pointtable_to_list('<?php echo esc_js(admin_url('admin-ajax.php'));?>', '<?php echo esc_js(get_template_directory_uri());?>')" />
            </li>
          </ul>
	  </div>
	<?php
	}
}

/**
 * @Add dynamic_fields List
 *
 *
 */
if ( ! function_exists( 'cs_add_point_tables_to_list' ) ) {
	function cs_add_point_tables_to_list(){
		global $counter_point_table, $cs_theme_options, $point_table_i, $point_table_column_feature, $point_table_column_title1, $point_table_column_title2, $point_table_column_title3, $point_table_column_title4, $point_table_column_title5, $point_table_column_title6, $point_table_column_title7, $point_table_column_title8, $point_table_column_title9, $point_table_column_title10;
		foreach ($_POST as $keys=>$values) {
			$$keys = $values;
		}
		$row_title = '-';
		if($point_table_column_title1 <> ''){
			$row_title = $point_table_column_title1;
		}
	?>
    
    <tr class="parentdelete" id="edit_track<?php echo esc_attr($counter_point_table)?>">
      <td id="subject-title<?php echo esc_attr($counter_point_table)?>" style="width:80%;"><?php echo cs_allow_special_char($row_title); ?></td>
      <td class="centr" style="width:20%;"><a href="javascript:_createpop('edit_track_form<?php echo esc_js($counter_point_table)?>','filter')" class="actions edit">&nbsp;</a> <a href="#" class="delete-it btndeleteit actions delete">&nbsp;</a></td>
      <td style="width:0"><div  id="edit_track_form<?php echo esc_attr($counter_point_table);?>" style="display: none;" class="table-form-elem">
          <div class="cs-heading-area">
            <h5 style="text-align: left;"><?php _e('Point Table Settings','goalklub');?></h5>
            <span onclick="javascript:removeoverlay('edit_track_form<?php echo esc_js($counter_point_table)?>','append')" class="cs-btnclose"> <i class="icon-times"></i></span>
            <div class="clear"></div>
          </div>
          <?php
		  
		  if(isset($point_table_column_title1) && isset($cs_theme_options['table_column_title1'][$point_table_i]) && $cs_theme_options['table_column_title1'][$point_table_i] <> ''){
		  ?>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title1'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" name="point_table_column_title1_array[]" value="<?php echo htmlspecialchars($point_table_column_title1)?>" id="point_table_column_title1_array<?php echo esc_attr($counter_point_table)?>" />
            </li>
          </ul>
          <?php
		  }
		  if(isset($point_table_column_title2) && isset($cs_theme_options['table_column_title2'][$point_table_i]) && $cs_theme_options['table_column_title2'][$point_table_i] <> ''){
		  ?>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title2'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" name="point_table_column_title2_array[]" value="<?php echo htmlspecialchars($point_table_column_title2)?>" id="point_table_column_title2_array<?php echo esc_attr($counter_point_table)?>" />
            </li>
          </ul>
          <?php
		  }
		  if(isset($point_table_column_title3) && isset($cs_theme_options['table_column_title3'][$point_table_i]) && $cs_theme_options['table_column_title3'][$point_table_i] <> ''){
		  ?>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title3'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" name="point_table_column_title3_array[]" value="<?php echo htmlspecialchars($point_table_column_title3)?>" id="point_table_column_title3_array<?php echo esc_attr($counter_point_table)?>" />
            </li>
          </ul>
          <?php
		  }
		  if(isset($point_table_column_title4) && isset($cs_theme_options['table_column_title4'][$point_table_i]) && $cs_theme_options['table_column_title4'][$point_table_i] <> ''){
		  ?>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title4'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" name="point_table_column_title4_array[]" value="<?php echo htmlspecialchars($point_table_column_title4)?>" id="point_table_column_title4_array<?php echo esc_attr($counter_point_table)?>" />
            </li>
          </ul>
          <?php
		  }
		  if(isset($point_table_column_title5) && isset($cs_theme_options['table_column_title5'][$point_table_i]) && $cs_theme_options['table_column_title5'][$point_table_i] <> ''){
		  ?>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title5'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" name="point_table_column_title5_array[]" value="<?php echo htmlspecialchars($point_table_column_title5)?>" id="point_table_column_title5_array<?php echo esc_attr($counter_point_table)?>" />
            </li>
          </ul>
          <?php
		  }
		  if(isset($point_table_column_title6) && isset($cs_theme_options['table_column_title6'][$point_table_i]) && $cs_theme_options['table_column_title6'][$point_table_i] <> ''){
		  ?>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title6'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" name="point_table_column_title6_array[]" value="<?php echo htmlspecialchars($point_table_column_title6)?>" id="point_table_column_title6_array<?php echo esc_attr($counter_point_table)?>" />
            </li>
          </ul>
          <?php
		  }
		  if(isset($point_table_column_title7) && isset($cs_theme_options['table_column_title7'][$point_table_i]) && $cs_theme_options['table_column_title7'][$point_table_i] <> ''){
		  ?>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title7'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" name="point_table_column_title7_array[]" value="<?php echo htmlspecialchars($point_table_column_title7)?>" id="point_table_column_title7_array<?php echo esc_attr($counter_point_table)?>" />
            </li>
          </ul>
          <?php
		  }
		  if(isset($point_table_column_title8) && isset($cs_theme_options['table_column_title8'][$point_table_i]) && $cs_theme_options['table_column_title8'][$point_table_i] <> ''){
		  ?>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title8'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" name="point_table_column_title8_array[]" value="<?php echo htmlspecialchars($point_table_column_title8)?>" id="point_table_column_title8_array<?php echo esc_attr($counter_point_table)?>" />
            </li>
          </ul>
          <?php
		  }
		  if(isset($point_table_column_title9) && isset($cs_theme_options['table_column_title9'][$point_table_i]) && $cs_theme_options['table_column_title9'][$point_table_i] <> ''){
		  ?>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title9'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" name="point_table_column_title9_array[]" value="<?php echo htmlspecialchars($point_table_column_title9)?>" id="point_table_column_title9_array<?php echo esc_attr($counter_point_table)?>" />
            </li>
          </ul>
          <?php
		  }
		  if(isset($point_table_column_title10) && isset($cs_theme_options['table_column_title10'][$point_table_i]) && $cs_theme_options['table_column_title10'][$point_table_i] <> ''){
		  ?>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php echo cs_allow_special_char($cs_theme_options['table_column_title10'][$point_table_i]); ?></label>
            </li>
            <li class="to-field">
              <input type="text" name="point_table_column_title10_array[]" value="<?php echo htmlspecialchars($point_table_column_title10)?>" id="point_table_column_title10_array<?php echo esc_attr($counter_point_table)?>" />
            </li>
          </ul>
          <?php
		  }
		  ?>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php _e('Feature','goalklub');?></label>
            </li>
            <li class="to-field">
              <div class="select-style">
                <select name="point_table_column_feature_array[]" id="point_table_column_feature_array<?php echo esc_attr($counter_point_table)?>" class="dropdown">
                  <option <?php if(isset($point_table_column_feature) and $point_table_column_feature == 'No') echo 'selected'; ?>><?php _e('No','goalklub');?></option>
                  <option <?php if(isset($point_table_column_feature) and $point_table_column_feature == 'Yes') echo 'selected'; ?>><?php _e('Yes','goalklub');?></option>
                </select>
              </div>
            </li>
          </ul>
          <ul class="form-elements noborder">
            <li class="to-label">
              <label></label>
            </li>
            <li class="to-field">
              <input type="button" value="Update Point Table" onclick="update_title(<?php echo esc_js($counter_point_table);?>); removeoverlay('edit_track_form<?php echo esc_js($counter_point_table);?>','append')" />
            </li>
          </ul>
        </div></td>
    </tr>
<?php
		if ( isset($_POST['point_table_title']) && isset($_POST['cs_add_point_tables_to_list']) ) die();
	}
	add_action('wp_ajax_cs_add_point_tables_to_list', 'cs_add_point_tables_to_list');
}

/**
 * @Add dynamic_fields List
 *
 *
 */
if ( ! function_exists( 'cs_add_score_to_list' ) ) {
	function cs_add_score_to_list(){
		global $counter_score, $cs_theme_options, $point_table_i,$match_palyer_name,$match_score_time,$match_score_color,$match_score_description;
		foreach ($_POST as $keys=>$values) {
			$$keys = $values;
		}
		
	?>
    <tr class="parentdelete" id="edit_track<?php echo esc_attr($counter_score)?>">
      <td id="subject-title<?php echo esc_attr($counter_score)?>" style="width:30%;"><?php echo cs_allow_special_char($match_palyer_name); ?></td>
      <td id="subject-title<?php echo esc_attr($counter_score)?>" style="width:30%;"><?php echo cs_allow_special_char($match_score_time); ?></td>
      <td class="centr" style="width:20%;"><a href="javascript:_createpop('edit_track_form<?php echo esc_js($counter_score)?>','filter')" class="actions edit">&nbsp;</a> <a href="#" class="delete-it btndeleteit actions delete">&nbsp;</a></td>
      <td style="width:0"><div  id="edit_track_form<?php echo esc_attr($counter_score);?>" style="display: none;" class="table-form-elem">
      
          <div class="cs-heading-area">
            <h5 style="text-align: left;"><?php _e('Match Status','goalklub');?></h5>
            <span onclick="javascript:removeoverlay('edit_track_form<?php echo esc_js($counter_score)?>','append')" class="cs-btnclose"> <i class="icon-times"></i></span>
            <div class="clear"></div>
          </div>
         
          
           <ul class="form-elements">
            <li class="to-label">
              <label><?php _e('Player Name','goalklub');?></label>
            </li>
            <li class="to-field">
              <input type="text" name="match_palyer_name[]" value="<?php echo htmlspecialchars($match_palyer_name)?>" id="match_palyer_name<?php echo esc_attr($counter_score)?>" />
            </li>
          </ul>
          
          <ul class="form-elements">
            <li class="to-label">
              <label><?php _e('Score Time','goalklub');?></label>
            </li>
            <li class="to-field">
              <input type="text" name="match_score_time[]" value="<?php echo htmlspecialchars($match_score_time)?>" id="match_score_time<?php echo esc_attr($counter_score)?>" />
            </li>
          </ul>
          <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Color','goalklub');?></label>
              </li>
              <li class="to-field">
                <input type="text" name="match_score_color[]" class="bg_color" id="match_score_color<?php echo esc_attr($counter_score)?>" value="<?php echo force_back($match_score_color); ?>" />
              </li>
            </ul>
            
         <ul class="form-elements">
		  <li class="to-label">
			<label><?php _e('Description','goalklub');?></label>
		  </li>
		  <li class="to-field">
			<textarea type="text" id="match_score_description<?php echo esc_attr($counter_score)?>" name="match_score_description[]" value="" ><?php echo htmlspecialchars($match_score_description)?></textarea>
		  </li>
		  </ul>
          
          <ul class="form-elements noborder">
            <li class="to-label">
              <label></label>
            </li>
            <li class="to-field">
              <input type="button" value="Update Point Table" onclick="update_title(<?php echo esc_js($counter_score);?>); removeoverlay('edit_track_form<?php echo esc_js($counter_score);?>','append')" />
            </li>
          </ul>
          
        </div></td>
    </tr>
<?php
		if ( isset($_POST['counter_score']) && isset($_POST['counter_score']) ) die();
	}
	add_action('wp_ajax_cs_add_score_to_list', 'cs_add_score_to_list');
}