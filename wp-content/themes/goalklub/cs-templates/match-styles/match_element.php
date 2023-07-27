<?php
/**
 * File Type: Match Page Builder Element
 */


//======================================================================
// Match html form for page builder start
//======================================================================
if ( ! function_exists( 'cs_pb_match' ) ) {
	function cs_pb_match($die = 0){
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
			$PREFIX = 'cs_match';
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array('cs_match_section_title'=>'','cs_match_view'=>'','cs_match_cat' =>'','cs_match_type' =>'','cs_match_order'=>'DESC','orderby'=>'ID','cs_match_num_post'=>'10','match_pagination'=>'','cs_match_class' => '','cs_match_animation' => '');
			if(isset($output['0']['atts']))
				$atts = $output['0']['atts'];
			else 
				$atts = array();
			$match_element_size = '50';
			foreach($defaults as $key=>$values){
				if(isset($atts[$key]))
					$$key = $atts[$key];
				else 
					$$key =$values;
			 }
			$name = 'cs_pb_match';
			$coloumn_class = 'column_'.$match_element_size;
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
	?>
    <div id="<?php echo esc_attr( $name.$cs_counter );?>_del" class="column  parentdelete <?php echo esc_attr( $coloumn_class );?> <?php echo esc_attr( $shortcode_view );?>" item="match" data="<?php echo element_size_data_array_index($match_element_size)?>">
      <?php cs_element_setting($name,$cs_counter,$match_element_size);?>
      <div class="cs-wrapp-class-<?php echo intval( $cs_counter )?> <?php echo esc_attr( $shortcode_element );?>" id="<?php echo esc_attr( $name.$cs_counter )?>" data-shortcode-template="[cs_match {{attributes}}]"  style="display: none;">
        <div class="cs-heading-area">
          <h5><?php _e('Edit Match Options','goalklub');?></h5>
          <a href="javascript:removeoverlay('<?php echo esc_js( $name.$cs_counter );?>','<?php echo esc_js( $filter_element );?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
        <div class="cs-pbwp-content">
          <div class="cs-wrapp-clone cs-shortcode-wrapp">
            <?php
             if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
            <ul class="form-elements">
                <li class="to-label"><label><?php _e('Section Title','goalklub');?></label></li>
                <li class="to-field">
                    <input  name="cs_match_section_title[]" type="text"  value="<?php echo esc_attr( $cs_match_section_title )?>"   />
                </li>                  
             </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Match Design Views','goalklub');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
				    <select name="cs_match_view[]" class="dropdown">
                      <option value="list-view" <?php if($cs_match_view == 'list-view'){echo 'selected="selected"';}?>><?php _e('List View','goalklub');?></option>
                      <option value="simple-list-view" <?php if($cs_match_view == 'simple-list-view'){echo 'selected="selected"';}?>><?php _e('Simple List view','goalklub');?></option>
                      <option value="club-view" <?php if($cs_match_view == 'club-view'){echo 'selected="selected"';}?>><?php _e('Club View','goalklub');?></option>
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
                <label><?php _e('Choose Category','goalklub');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
                    <select name="cs_match_cat[]" class="dropdown">
                      <option value="0"><?php _e('-- Select Category --','goalklub');?></option>
                      <?php show_all_cats('', '', $cs_match_cat, "match-category");?>
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
                <label><?php _e('Choose Match Type','goalklub');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
                    <select name="cs_match_type[]" class="dropdown">
                      <option <?php if($cs_match_type=="all")echo "selected";?> value="all"><?php _e('All','goalklub');?></option>
                      <option <?php if($cs_match_type=="upcoming")echo "selected";?> value="upcoming"><?php _e('Upcoming','goalklub');?></option>
                      <option <?php if($cs_match_type=="past")echo "selected";?> value="past"><?php _e('Past','goalklub');?></option>
                    </select>
                  </div>
                </div>
                <div class="left-info">
                  <p><?php _e('Please select category to show posts. If you dont select category it will display all posts','goalklub');?></p>
                </div>
              </li>
            </ul>
            
            <div id="Match-listing<?php echo intval($cs_counter);?>" >
              <ul class="form-elements">
                <li class="to-label">
                  <label><?php _e('Match Order','goalklub');?></label>
                </li>
                <li class="to-field">
                  <div class="input-sec">
                    <div class="select-style">
                      <select name="cs_match_order[]" class="dropdown" >
                        <option <?php if($cs_match_order=="ASC")echo "selected";?> value="ASC"><?php _e('Asc','goalklub');?></option>
                        <option <?php if($cs_match_order=="DESC")echo "selected";?> value="DESC"><?php _e('DESC','goalklub');?></option>
                      </select>
                    </div>
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
                  <input type="text" name="cs_match_num_post[]" class="txtfield" value="<?php echo esc_attr( $cs_match_num_post ); ?>" />
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
                <select name="match_pagination[]" class="dropdown">
                  <option <?php if($match_pagination=="Show Pagination")echo "selected";?> ><?php _e('Show Pagination','goalklub');?></option>
                  <option <?php if($match_pagination=="Single Page")echo "selected";?> ><?php _e('Single Page','goalklub');?></option>
                </select>
              </li>
            </ul>
            <?php 
                if ( function_exists( 'cs_shortcode_custom_classes' ) ) {
                    cs_shortcode_custom_dynamic_classes($cs_match_class,$cs_match_animation,'','cs_match');
                }
            ?>
            <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){?>
            <ul class="form-elements insert-bg">
              <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js( str_replace('cs_pb_','',$name) );?>','<?php echo esc_js( $name.$cs_counter )?>','<?php echo esc_js( $filter_element );?>')" ><?php _e('Insert','goalklub'); ?></a> </li>
            </ul>
            <div id="results-shortocde"></div>
            <?php } else {?>
            <ul class="form-elements">
              <li class="to-label"></li>
              <li class="to-field">
                <input type="hidden" name="cs_orderby[]" value="match" />
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
	add_action('wp_ajax_cs_pb_match', 'cs_pb_match');
}

//======================================================================
// Upcoming Fixtures html form for page builder start
//======================================================================
if ( ! function_exists( 'cs_pb_upcomming_fixtures' ) ) {
	function cs_pb_upcomming_fixtures($die = 0){
		global $cs_node, $post;
		$shortcode_element 		= '';
		$filter_element 		= 'filterdrag';
		$shortcode_view 		= '';
		$output 				= array();
		$counter 				= $_POST['counter'];
		$cs_counter 			= $_POST['counter'];
		if ( isset($_POST['action']) && !isset($_POST['shortcode_element_id']) ) {
			$POSTID = '';
			$shortcode_element_id = '';
		} else {
			$POSTID 				= $_POST['POSTID'];
			$shortcode_element_id 	= $_POST['shortcode_element_id'];
			$shortcode_str 			= stripslashes ($shortcode_element_id);
			$PREFIX 				= 'cs_upcomming_fixtures';
			$parseObject 			= new ShortcodeParse();
			$output 				= $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array('cs_fixture_section_title'=>'','cs_fixture_cat' =>'','cs_fixture_view'=>'list-view','cs_fixture_link' =>'','cs_fixture_order'=>'DESC','orderby'=>'ID','cs_fixture_num_post'=>'10','cs_fixture_class' => '','cs_fixture_animation' => '');
			if(isset($output['0']['atts']))
				$atts = $output['0']['atts'];
			else 
				$atts = array();
			$fixture_element_size = '25';
			foreach($defaults as $key=>$values){
				if(isset($atts[$key]))
					$$key = $atts[$key];
				else 
					$$key =$values;
			 }
			$name = 'cs_pb_upcomming_fixtures';
			$coloumn_class = 'column_'.$fixture_element_size;
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
	?>
<div id="<?php echo esc_attr( $name.$cs_counter );?>_del" class="column  parentdelete <?php echo esc_attr( $coloumn_class );?> <?php echo esc_attr( $shortcode_view );?>" item="upcomming_fixtures" data="<?php echo element_size_data_array_index($fixture_element_size)?>">
      <?php cs_element_setting($name,$cs_counter,$fixture_element_size);?>
      <div class="cs-wrapp-class-<?php echo intval( $cs_counter )?> <?php echo esc_attr( $shortcode_element );?>" id="<?php echo esc_attr( $name.$cs_counter )?>" data-shortcode-template="[cs_upcomming_fixtures {{attributes}}]"  style="display: none;">
        <div class="cs-heading-area">
          <h5><?php _e('Edit Upcoming Fixtures Options','goalklub');?></h5>
          <a href="javascript:removeoverlay('<?php echo esc_js( $name.$cs_counter );?>','<?php echo esc_js( $filter_element );?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
        <div class="cs-pbwp-content">
          <div class="cs-wrapp-clone cs-shortcode-wrapp">
            <?php
             if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
            <ul class="form-elements">
                <li class="to-label"><label><?php _e('Section Title','goalklub');?></label></li>
                <li class="to-field">
                    <input  name="cs_fixture_section_title[]" type="text"  value="<?php echo esc_attr( $cs_fixture_section_title )?>"   />
                </li>                  
             </ul>
             <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Upcomming Fixtures Views','goalklub');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
				    <select name="cs_fixture_view[]" class="dropdown">
                      <option value="list-view" <?php if($cs_fixture_view == 'list-view'){echo 'selected="selected"';}?>><?php _e('List View','goalklub');?></option>
                      <option value="club-view" <?php if($cs_fixture_view == 'club-view'){echo 'selected="selected"';}?>><?php _e('Club View','goalklub');?></option>
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
                <label><?php _e('Choose Category','goalklub');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
                    <select name="cs_fixture_cat[]" class="dropdown">
                      <option value="0"><?php _e('-- Select Category --','goalklub');?></option>
                      <?php show_all_cats('', '', $cs_fixture_cat, "match-category");?>
                    </select>
                  </div>
                </div>
                <div class="left-info">
                  <p><?php _e('Please select category to show posts. If you dont select category it will display all posts','goalklub');?></p>
                </div>
              </li>
            </ul>
            <div id="Match-listing<?php echo intval($cs_counter);?>" >
              <ul class="form-elements">
                <li class="to-label">
                  <label><?php _e('Match Order','goalklub');?></label>
                </li>
                <li class="to-field">
                  <div class="input-sec">
                    <div class="select-style">
                      <select name="cs_fixture_order[]" class="dropdown" >
                        <option <?php if($cs_fixture_order=="ASC")echo "selected";?> value="ASC"><?php _e('Asc','goalklub');?></option>
                        <option <?php if($cs_fixture_order=="DESC")echo "selected";?> value="DESC"><?php _e('DESC','goalklub');?></option>
                      </select>
                    </div>
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
                  <input type="text" name="cs_fixture_num_post[]" class="txtfield" value="<?php echo esc_attr( $cs_fixture_num_post ); ?>" />
                </div>
                <div class="left-info">
                  <p><?php _e('To display all the records, leave this field blank','goalklub');?></p>
                </div>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('View All Fixture Link','goalklub');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <input type="text" name="cs_fixture_link[]" class="txtfield" value="<?php echo esc_url( $cs_fixture_link ); ?>" />
                </div>
                <div class="left-info">
                  <p>Example : http://www.example.com</p>
                </div>
              </li>
            </ul>
            <?php 
                if ( function_exists( 'cs_shortcode_custom_classes' ) ) {
                    cs_shortcode_custom_dynamic_classes($cs_fixture_class,$cs_fixture_animation,'','cs_fixture');
                }
            ?>
            <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){?>
			  
            <ul class="form-elements insert-bg">
              <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js( str_replace('cs_pb_','',$name) );?>','<?php echo esc_js( $name.$cs_counter )?>','<?php echo esc_js( $filter_element );?>')" ><?php _e('Insert','goalklub');?></a> </li>
            </ul>
            <div id="results-shortocde"></div>
            <?php } else {?>
            <ul class="form-elements">
              <li class="to-label"></li>
              <li class="to-field">
                <input type="hidden" name="cs_orderby[]" value="upcomming_fixtures" />
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
	add_action('wp_ajax_cs_pb_upcomming_fixtures', 'cs_pb_upcomming_fixtures');
}