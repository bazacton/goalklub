<?php
/**
 * The template for Full View Match Detail
 * @copyright Copyright (c) 2014, Chimp Studio 
 */
 global $cs_node,$post,$cs_theme_options,$cs_counter_node,$post_xml;
 
 if ($post_xml <> "") {
	$cs_xmlObject = new SimpleXMLElement($post_xml);
	
	$postname = 'match';
	$match_design_view 		= $cs_xmlObject->match_design_view;
	$cs_match_from_date 	= $cs_xmlObject->cs_match_from_date;
	$cs_match_start_time 	= $cs_xmlObject->cs_match_start_time;
	$cs_match_end_time 		= $cs_xmlObject->cs_match_end_time;
	$cs_match_all_day 		= $cs_xmlObject->cs_match_all_day;
	$cs_match_ticket_title  = $cs_xmlObject->cs_match_ticket_options;
	$cs_match_buy_now 		= $cs_xmlObject->cs_match_buy_now;
	$cs_match_ticket_color  = $cs_xmlObject->cs_match_ticket_color;
	$cs_match_team_1 		= $cs_xmlObject->cs_match_team_1;
	$cs_match_team_2 		= $cs_xmlObject->cs_match_team_2;
	$cs_match_location 		= $cs_xmlObject->cs_match_location;
	$cs_match_team1_score 	= $cs_xmlObject->cs_match_team1_score;
	$cs_match_team2_score	= $cs_xmlObject->cs_match_team2_score;
	$cs_match_summary 		= $cs_xmlObject->cs_match_summary;
	$cs_match_attendance 	= $cs_xmlObject->cs_match_attendance;
	$cs_match_result_status = $cs_xmlObject->cs_match_result_status;
	$cs_match_venue			= $cs_xmlObject->cs_match_venue;
	
} else {
	$cs_xmlObject = new stdClass();
	
	$postname = 'match';
	$match_design_view 			= '';
	$cs_match_from_date 		= '';
	$cs_match_start_time 		= '';
	$cs_match_end_time 			= '';
	$cs_match_all_day 			= '';
	$cs_match_ticket_title 		= '';
	$cs_match_buy_now			= '';
	$cs_match_ticket_color 		= '';
	$cs_match_team_1 			= '';
	$cs_match_team_2 			= '';
	$cs_match_location 			= '';
	$cs_match_team1_score 		= '';
	$cs_match_team2_score 		= '';
	$cs_match_summary 			= '';
	$cs_match_attendance 		= '';
	$cs_match_result_status 	= '';
	$cs_match_venue				= '';
}		
	$matchObject	= new CS_MatchTemplates();
	
	$location			= get_term_by( 'slug', $cs_match_location, 'match-location', 'OBJECT', 'raw' );
	$cs_match_location	= $location->name;
	
	$team_image		= $matchObject->cs_get_category_image( $cs_match_team_1 , 'player-team');
	$team_image_two = $matchObject->cs_get_category_image( $cs_match_team_2 , 'player-team');
	$team_name_1 	= $matchObject->cs_get_team_name( $cs_match_team_1 , 'player-team');
	$team_name_2 	= $matchObject->cs_get_team_name( $cs_match_team_2 , 'player-team');
			
	if ( isset( $cs_match_ticket_color ) &&  $cs_match_ticket_color !='' ) {
		$color	= $cs_match_ticket_color;
		$background	= ' style="background-color:'.$color.' !important; color:#FFF !important;"';
	}
	
	$width 			= 1920;
 	$height 		= 736;
 	$image_url  	= cs_get_post_img_src($post->ID, $width, $height);
 	$section_bg 	= '';
 	if($image_url <> '') $section_bg = 'background:url('.$image_url.') no-repeat; ';
	cs_countdown();
	
	$obj	= $matchObject->cs_get_date_difference( $post->ID );
	$year	= $obj->y;
	$month	= $obj->m + date('m');
	$days	= $obj->d + date('d');
	$hours	= $obj->h + date('H');
	$mins	= $obj->i + date('i');
	$secs	= $obj->s + date('s');
	
?>
<div class="col-md-12">
	<div class="featured-event event-editor " style=" <?php echo cs_allow_special_char($section_bg); ?>">
     <style>
		.post-<?php echo esc_attr( $post->ID );?> span.win:before {
			background: none repeat scroll 0 0 <?php echo cs_allow_special_char($color);?> !important;
		}
		.post-<?php echo esc_attr( $post->ID );?> .featured-event {
			background:url('<?php echo esc_url( $image_url );?>') no-repeat;
		}
	</style>
<div class="countdownit">
  <div id="matchCountdown"></div>
</div>
  <div class="cs-sc-team">
    <ul>
      <li>
        <figure>sdf
		  <?php if ( isset( $team_image ) && $team_image !='' ){?> 
           <a><img alt="No image" src="<?php echo esc_url( $team_image );?>"></a>
          <?php }?>
          <?php if ( isset( $team_name_1 ) && $team_name_1 !='' ){?> 
            <figcaption><a><?php echo esc_attr( $team_name_1 );?></figcaption></a>
          <?php }?>
        </figure>
        </li>
        <li>
        <div class="match-score">
          <small><?php _e('VS', 'goalklub');
		  
		  $background = '';
		  ?></small>
          <span <?php echo force_back($background, false);?>><?php echo esc_attr( ucwords( substr( $cs_match_venue, 0, 1 ) ) );?></span>
        </div>
        </li>
        <li class="right-side">
          <figure>
			  <?php if ( isset( $team_image_two ) && $team_image_two !='' ){?> 
               <a><img alt="No image" src="<?php echo esc_url( $team_image_two );?>"></a>
              <?php }?>
              <?php if ( isset( $team_name_2 ) && $team_name_2 !='' ){?> 
                <figcaption><a><?php echo esc_attr( $team_name_2 );?></a></figcaption>
              <?php }?>
          </figure>
        </li>
      </ul>
    </div>
    <div class="bottom-event-panel">
      <ul class="post-option">
        <li><?php $matchObject->cs_get_categories();?></li>
        <li><i class=" icon-calendar11"></i>
            <?php 
                  echo esc_attr( date_i18n( get_option( 'date_format' ),strtotime( $cs_match_from_date ) ) );
                  
                 if ( isset( $cs_match_all_day ) && $cs_match_all_day == 'on' ){
                      _e('All Day', 'goalklub');
                  } else {
                      if( isset( $cs_match_start_time ) && $cs_match_start_time <> ''){
                          $match_str_time = $matchObject->cs_format_date($cs_match_start_time);
						  echo cs_allow_special_char($match_str_time) . ' ';
                      }
                      if(isset($cs_match_end_time) && $cs_match_end_time <> ''){
                        /*_e(' - ', 'goalklub');*/
                          $match_end_time = $matchObject->cs_format_date($cs_match_end_time);
						  echo cs_allow_special_char($match_end_time) . ' ';
                      }
                 }
             ?>
        </li>
        
        <?php if ( isset( $cs_match_location ) && $cs_match_location !='' ){?> 
        <li><i class=" icon-location6"></i><?php echo esc_attr( ucwords( $cs_match_location ) );?></li>
        <?php }?>
      </ul>
      <a <?php echo force_back($background, false);?> href="<?php echo esc_url( $cs_match_buy_now );?>" class="ticket-btn cs-bgcolor">
	  <?php  echo force_back($cs_match_ticket_title = isset($cs_match_ticket_title) ?  $cs_match_ticket_title : __('Tickets','goalklub'));?></a>
    </div>
 </div>
</div>
<script>
   jQuery(function () {
	  var austDay = new Date();
	  austDay = new Date(austDay.getFullYear() + <?php echo intval( $year );?>, <?php echo intval( $month );?>-1, <?php echo intval( $days );?>, <?php echo intval( $hours );?>, <?php echo intval( $mins );?>, <?php echo intval( $secs );?>);
	  jQuery('#matchCountdown').countdown({until: austDay});
	  jQuery('#year').text(austDay.getFullYear());

	});
</script>