<?php


//=====================================================================
// Match Custom Fields
//=====================================================================
if ( ! function_exists( 'cs_post_match_fields' ) ) {
	function cs_post_match_fields(){
		global $post, $cs_xmlObject;
		$cs_match_from_date = '';
		$post_meta = get_post_meta($post->ID, "match", true);
		$cs_match_from_date = get_post_meta($post->ID, "cs_match_from_date", true);
		cs_enqueue_timepicker_script();
		?>
		<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/include/assets/scripts/ui_multiselect.js"></script>
        <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri();?>/include/assets/css/jquery_ui.css" />
        <link type="text/css" rel="stylesheet"  href="<?php echo get_template_directory_uri();?>/include/assets/css/ui_multiselect.css" />
        <link type="text/css" rel="stylesheet"  href="<?php echo get_template_directory_uri();?>/include/assets/css/common.css" />
		<script type="text/javascript">
			jQuery(function($){
				jQuery(".multiselect").multiselect();
			//	jQuery('#switcher').themeswitcher();
			});
		</script>
		<script>
				 jQuery(function(){
				 jQuery('#cs_match_start_time').datetimepicker({
				  datepicker:false,
						format:'H:i',
						formatTime: 'H:i',
						step:30,
				  onSgow:function( at ){
				   this.setOptions({
					maxTime:jQuery('#cs_match_end_time').val()?jQuery('#cs_match_end_time').val():false
				   })
				  }
				 });
				 jQuery('#cs_match_end_time').datetimepicker({
					datepicker:false,
						format:'H:i',
						formatTime: 'H:i',
						step:30,
				  onShow:function( at ){
				   this.setOptions({
					minTime:jQuery('#cs_match_start_time').val()?jQuery('#cs_match_start_time').val():false
				   })
				  }
				 });
				 jQuery('#from_date').datetimepicker({
				  format:'d-m-Y',
				  onShow:function( ct ){
				   this.setOptions({
					maxDate:jQuery('#to_date').val()?jQuery('#to_date').val():false
				   })
				  },
				  timepicker:false
				 });
				 jQuery('#to_date').datetimepicker({
				  format:'d-m-Y',
				  onShow:function( ct ){
				   this.setOptions({
					minDate:jQuery('#from_date').val()?jQuery('#from_date').val():false
				   })
				  },
				  timepicker:false
				 });
				});
			</script>
	<div class="clear"></div>
	<ul class="form-elements">
	  <li class="to-label">
		<label><?php _e('Match Detail View','goalklub');?></label>
	  </li>
	  <li class="to-field select-style">
		 <select name="match_design_view" id="match_design_view">
         	<option value="fixed" <?php if(isset($cs_xmlObject->match_design_view) && $cs_xmlObject->match_design_view == 'fixed') echo 'selected="selected"';?>><?php _e('Fixed View','goalklub');?></option>
         	<option value="full" <?php if(isset($cs_xmlObject->match_design_view) && $cs_xmlObject->match_design_view == 'full') echo 'selected="selected"';?>><?php _e('Full View','goalklub');?></option>
         </select>
	  </li>
	</ul>
    <div class="clear"></div>
    <ul class="form-elements">
	  <li class="to-label">
		<label><?php _e('Match Date','goalklub');?></label>
	  </li>
	  <li class="to-field short-field">
		<input type="text" id="from_date" name="cs_match_from_date" value="<?php if(isset($cs_xmlObject->cs_match_from_date) && $cs_xmlObject->cs_match_from_date <>'') echo cs_allow_special_char($cs_xmlObject->cs_match_from_date); else echo gmdate("d-m-Y"); ?>" />
	  </li>
	  
	</ul>
	<ul class="form-elements match-day bcmatch_title">
	  <li class="to-label">
		<label><?php _e('Match Time','goalklub');?></label>
	  </li>
	  <li class="to-field">
		<div id="match_time">
		  <div class="input-sec">
			<input id="cs_match_start_time" name="cs_match_start_time" value="<?php if(isset($cs_xmlObject->cs_match_start_time)){echo esc_attr($cs_xmlObject->cs_match_start_time);} else { echo date('H:i');}?>" type="text" class="vsmall" />
			<label class="first-label"><?php _e('Start time','goalklub');?></label>
		  </div>
		  <!--<span class="short">To</span>-->
		  <div class="input-sec">
			<input id="cs_match_end_time" name="cs_match_end_time" value="<?php if(isset($cs_xmlObject->cs_match_start_time)){echo esc_attr($cs_xmlObject->cs_match_end_time);} else { echo date('H:i');}?>" type="text" class="vsmall"  />
			<label class="sec-label"><?php _e('End time','goalklub');?></label>
		  </div>
		  <div class="input-sec">
			<div class="checkbox-list">
			  <div class="checkbox-item">
				<input type="checkbox" style="float: left;" name="cs_match_all_day" value="on" <?php if(isset($cs_xmlObject->cs_match_all_day) && $cs_xmlObject->cs_match_all_day == 'on'){echo "checked";}?> class="styled" /><label style="float: left; margin: 0px 0px 0px 5px; padding: 0px; line-height: 15px;"><?php _e('All Day','goalklub');?></label>
			  </div>
			</div>
			
		  </div>
		</div>
	  </li>
	</ul>
	<div class="clear"></div>
	<ul class="form-elements bcevent_title">
	  <li class="to-label">
		<label> <?php _e('Ticket Option','goalklub');?></label>
	  </li>
	  <li class="to-field">
		<div class="input-sec">
		  <input type="text" id="cs_match_ticket_options" name="cs_match_ticket_options" value="<?php if(isset($cs_xmlObject->cs_match_ticket_options)){echo esc_attr( $cs_xmlObject->cs_match_ticket_options );}?>" />
		  <label><?php _e('Title','goalklub');?></label>
		</div>
		<div class="input-sec">
		  <input type="text" id="cs_match_buy_now" name="cs_match_buy_now" value="<?php if(isset($cs_xmlObject->cs_match_buy_now)){echo esc_attr( $cs_xmlObject->cs_match_buy_now );}?>" />
		  <label><?php _e('Url','goalklub');?></label>
		</div>
	  </li>
	</ul><div class="clear"></div>
    
    <ul class="form-elements">
	  <li class="to-label">
		<label><?php _e('Venue Color','goalklub');?></label>
	  </li>
	  <li class="to-field">
		<div class="input-sec">
		  <input type="text" name="cs_match_ticket_color" value="<?php if(isset($cs_xmlObject->cs_match_ticket_color)){ echo esc_attr( $cs_xmlObject->cs_match_ticket_color );}?>" class="bg_color" />
		</div>
	  </li>
	</ul><div class="clear"></div>
    
    <ul class="form-elements">
	  <li class="to-label">
		<label><?php _e('Team 1','goalklub');?></label>
	  </li>
	  <li class="to-field">
		<div class="input-sec">
		  <div class="select-style">
			<?php $cs_match_team_1 = isset($cs_xmlObject->cs_match_team_1) ? $cs_xmlObject->cs_match_team_1 : ''; ?>
			<select name="cs_match_team_1" class="dropdown">
			  <option value="0"><?php _e('-- Select Team --','goalklub');?></option>
			  <?php show_all_cats('', '', $cs_match_team_1, "player-team");?>
			</select>
		  </div>
		</div>
	  </li>
	</ul>
    
    <ul class="form-elements">
	  <li class="to-label">
		<label><?php _e('Team 2','goalklub');?></label>
	  </li>
	  <li class="to-field">
		<div class="input-sec">
		  <div class="select-style">
			<?php $cs_match_team_2 = isset($cs_xmlObject->cs_match_team_2) ? $cs_xmlObject->cs_match_team_2 : ''; ?>
            <select name="cs_match_team_2" class="dropdown">
			  <option value="0"><?php _e('-- Select Team --','goalklub');?></option>
			  <?php show_all_cats('', '', $cs_match_team_2, "player-team");?>
			</select>
		  </div>
		</div>
	  </li>
	</ul>
    
    <ul class="form-elements">
	  <li class="to-label">
		<label><?php _e('Venue','goalklub');?></label>
	  </li>
	  <li class="to-field">
		<div class="input-sec">
		  <div class="select-style">
			<?php $cs_match_venue = isset($cs_xmlObject->cs_match_venue) ? $cs_xmlObject->cs_match_venue : ''; ?>
            <select name="cs_match_venue" class="dropdown">
			  <option value=""><?php _e('-- Select Venue --','goalklub');?></option>
			  <option value="home" <?php if($cs_match_venue == 'home') echo 'selected'; ?>><?php _e('Home','goalklub');?></option>
              <option value="away" <?php if($cs_match_venue == 'away') echo 'selected'; ?>><?php _e('Away','goalklub');?></option>
              <option value="neutral" <?php if($cs_match_venue == 'neutral') echo 'selected'; ?>><?php _e('Neutral','goalklub');?></option>
			</select>
		  </div>
		</div>
	  </li>
	</ul>
    
    <ul class="form-elements">
	  <li class="to-label">
		<label><?php _e('Location','goalklub');?></label>
	  </li>
	  <li class="to-field">
		<div class="input-sec">
		  <div class="select-style">
			<?php $cs_match_location = isset($cs_xmlObject->cs_match_location) ? $cs_xmlObject->cs_match_location : ''; ?>
            <select name="cs_match_location" class="dropdown">
			  <option value="0"><?php _e('-- Select Team --','goalklub');?></option>
			  <?php show_all_cats('', '', $cs_match_location, "match-location");?>
			</select>
		  </div>
		</div>
	  </li>
	</ul>
    	<?php cs_score_listing_section(); ?>
	<div class="clear"></div>
	<input type="hidden" name="cs_location" value="1" />
	<?php
	}
}

// Point Tables List
if ( ! function_exists( 'cs_score_listing_section' ) ) {
	function cs_score_listing_section(){
		global $post, $cs_xmlObject, $cs_theme_options, $counter_score,$match_palyer_name,$match_score_time,$match_score_color,$match_score_description;
		$counter_score = 44;
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
			$("#total_scorelist_fields").sortable({
				cancel : 'td div.table-form-elem'
			});
		});
	  </script>
      <ul class="form-elements">
          <li class="to-label"><?php _e('Add Score List','goalklub');?></li>
          <li class="to-button"><a href="javascript:_createpop('add_scorelist_title','filter')" class="button"><?php _e('Add Score List','goalklub');?></a> </li>
      </ul>
	  <div class="cs-list-table">
      <table class="to-table" border="0" cellspacing="0">
		<thead>
		  <tr>
			<th style="width:30%;"><?php _e('Player Name','goalklub');?></th>
            <th style="width:30%;"><?php _e('Score Time','goalklub');?></th>
			<th style="width:80%;" class="centr"><?php _e('Actions','goalklub');?></th>
            <th style="width:0%;" class="centr"></th>
		  </tr>
		</thead>
		<tbody id="total_scorelist_fields">
		  <?php
				if ( isset($cs_xmlObject->score_list) && is_object($cs_xmlObject) && count($cs_xmlObject->score_list)>0 ) {
					foreach ( $cs_xmlObject->score_list as $list ){
						
						 
						 $match_palyer_name = $list->match_palyer_name;
						 $match_score_time = $list->match_score_time;
						 $match_score_color = $list->match_score_color;
						 $match_score_description = $list->match_score_description;
						 cs_add_score_to_list();
						 $counter_score++;
					}
				}
			?>
		</tbody>
	  </table>
      </div>
	  <div id="add_scorelist_title" style="display: none;">
		<div class="cs-heading-area">
		  <h5> <i class="icon-plus-circle"></i><?php _e('Match Status','goalklub');?></h5>
		  <span class="cs-btnclose" onClick="javascript:removeoverlay('add_scorelist_title','append')"> <i class="icon-times"></i></span> </div>
          <?php
		  $point_table_i=0;

		  ?>
          <ul class="form-elements">
		  <li class="to-label">
			<label><?php _e('Player Name','goalklub');?></label>
		  </li>
		  <li class="to-field">
			<input type="text" id="match_palyer_name" name="match_palyer_names" value="" />
		  </li>
		  </ul>
		  <ul class="form-elements">
		  <li class="to-label">
			<label><?php _e('Score Time','goalklub');?></label>
		  </li>
		  <li class="to-field">
			<input type="text" id="match_score_time" name="match_score_times" value="" />
		  </li>
		  </ul>
          
          <ul class="form-elements">
          <li class="to-label">
            <label><?php _e('Color','goalklub');?></label>
          </li>
          <li class="to-field">
            <input type="text" id="match_score_color" name="match_score_colors" class="bg_color" value="" />
          </li>
        </ul>
          <ul class="form-elements">
		  <li class="to-label">
			<label><?php _e('Description','goalklub');?></label>
		  </li>
		  <li class="to-field">
			<textarea type="text" id="match_score_description" name="match_score_descriptions" value="" ></textarea>
		  </li>
		  </ul>
          <ul class="form-elements noborder">
            <li class="to-label"></li>
            <li class="to-field">
              <input type="hidden" id="point_table_i" name="point_table_i" value="<?php echo cs_allow_special_char($point_table_i); ?>" />
              <input type="button" value="Add Point Table" onClick="add_score_to_list('<?php echo esc_js(admin_url('admin-ajax.php'));?>', '<?php echo esc_js(get_template_directory_uri());?>')" />
            </li>
          </ul>
	  </div>
	<?php
	}
}
?>