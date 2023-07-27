<?php
/**
 * File Type: Player Page Builder Element
 */


//======================================================================
// Player html form for page builder start
//======================================================================
if ( ! function_exists( 'cs_pb_player' ) ) {
	function cs_pb_player($die = 0){
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
			$PREFIX = 'cs_player';
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array('cs_player_section_title'=>'','cs_player_view'=>'','cs_player_team' =>'','cs_player_department' =>'','cs_player_filter' =>'','cs_player_order'=>'DESC','orderby'=>'ID','cs_player_num_post'=>'10','player_pagination'=>'','cs_player_class' => '','cs_player_animation' => '');
			if(isset($output['0']['atts']))
				$atts = $output['0']['atts'];
			else 
				$atts = array();
			$player_element_size = '50';
			foreach($defaults as $key=>$values){
				if(isset($atts[$key]))
					$$key = $atts[$key];
				else 
					$$key =$values;
			 }
			$name = 'cs_pb_player';
			$coloumn_class = 'column_'.$player_element_size;
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
	?>
    <div id="<?php echo esc_attr( $name.$cs_counter );?>_del" class="column  parentdelete <?php echo esc_attr( $coloumn_class );?> <?php echo esc_attr( $shortcode_view );?>" item="player" data="<?php echo element_size_data_array_index($player_element_size)?>">
      <?php cs_element_setting($name,$cs_counter,$player_element_size);?>
      <div class="cs-wrapp-class-<?php echo intval( $cs_counter )?> <?php echo esc_attr( $shortcode_element );?>" id="<?php echo esc_attr( $name.$cs_counter )?>" data-shortcode-template="[cs_player {{attributes}}]"  style="display: none;">
        <div class="cs-heading-area">
          <h5><?php _e('Edit Player Options','goalklub');?></h5>
          <a href="javascript:removeoverlay('<?php echo esc_js( $name.$cs_counter );?>','<?php echo esc_js( $filter_element );?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
        <div class="cs-pbwp-content">
          <div class="cs-wrapp-clone cs-shortcode-wrapp">
            <?php
             if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
            <ul class="form-elements">
                <li class="to-label"><label><?php _e('Section Title','goalklub');?></label></li>
                <li class="to-field">
                    <input  name="cs_player_section_title[]" type="text"  value="<?php echo esc_attr( $cs_player_section_title )?>"   />
                </li>                  
             </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Player Design Views','goalklub');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
				    <select name="cs_player_view[]" class="dropdown">
                      <option value="grid-view" <?php if($cs_player_view == 'grid-view'){echo 'selected="selected"';}?>><?php _e('Grid View','goalklub');?></option>
                      <option value="slider-view" <?php if($cs_player_view == 'slider-view'){echo 'selected="selected"';}?>><?php _e('Slider View','goalklub');?></option>
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
                <label><?php _e('Choose Team','goalklub');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
                    <select name="cs_player_team[]" class="dropdown">
                      <option value="0"><?php _e('-- Select Team --','goalklub');?></option>
                      <?php show_all_cats('', '', $cs_player_team, "player-team");?>
                    </select>
                  </div>
                </div>
                <div class="left-info">
                  <p><?php _e('Please select Team to show posts. If you dont select Team it will display all posts','goalklub');?></p>
                </div>
              </li>
            </ul>
            
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Choose Department','goalklub');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
                    <select name="cs_player_department[]" class="dropdown">
                      <option value="0"><?php _e('-- Select Department --','goalklub');?></option>
                      <?php show_all_cats('', '', $cs_player_department, "player-department");?>
                    </select>
                  </div>
                </div>
                <div class="left-info">
                  <p><?php _e('Please select Department to show posts. If you dont select Department it will display all posts','goalklub');?></p>
                </div>
              </li>
            </ul>
            
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Filterable','goalklub');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
                    <select name="cs_player_filter[]" class="dropdown" >
                      <option <?php if($cs_player_filter=="yes")echo "selected";?> value="yes"><?php _e('Yes','goalklub');?></option>
                      <option <?php if($cs_player_filter=="no")echo "selected";?> value="no"><?php _e('No','goalklub');?></option>
                    </select>
                  </div>
                </div>
              </li>
            </ul>
                          
            <div id="Player-listing<?php echo intval($cs_counter);?>" >
              <ul class="form-elements">
                <li class="to-label">
                  <label><?php _e('Player Order','goalklub');?></label>
                </li>
                <li class="to-field">
                  <div class="input-sec">
                    <div class="select-style">
                      <select name="cs_player_order[]" class="dropdown" >
                        <option <?php if($cs_player_order=="ASC")echo "selected";?> value="ASC"><?php _e('Asc','goalklub');?></option>
                        <option <?php if($cs_player_order=="DESC")echo "selected";?> value="DESC"><?php _e('DESC','goalklub');?></option>
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
                  <input type="text" name="cs_player_num_post[]" class="txtfield" value="<?php echo esc_attr( $cs_player_num_post ); ?>" />
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
                <select name="player_pagination[]" class="dropdown">
                  <option <?php if($player_pagination=="Show Pagination")echo "selected";?> ><?php _e('Show Pagination','goalklub');?></option>
                  <option <?php if($player_pagination=="Single Page")echo "selected";?> ><?php _e('Single Page','goalklub');?></option>
                </select>
              </li>
            </ul>
            <?php 
                if ( function_exists( 'cs_shortcode_custom_classes' ) ) {
                    cs_shortcode_custom_dynamic_classes($cs_player_class,$cs_player_animation,'','cs_player');
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
                <input type="hidden" name="cs_orderby[]" value="player" />
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
	add_action('wp_ajax_cs_pb_player', 'cs_pb_player');
}