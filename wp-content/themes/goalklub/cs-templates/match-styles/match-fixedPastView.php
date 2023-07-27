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

	$date_time_diff = strtotime($cs_match_end_time) -  strtotime($cs_match_start_time);
	$t_hours = date('H',$date_time_diff);
	$t_minuts = date('i',$date_time_diff);
	$totla_time = ($t_hours * 60) + $t_minuts;
	
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
?>
<div class="col-md-12">
<div style=" <?php echo cs_allow_special_char($section_bg); ?>" class="featured-event">
	 <style>
		.post-<?php echo esc_attr( $post->ID );?> span.win:before {
			background: none repeat scroll 0 0 <?php echo cs_allow_special_char($color);?> !important;
		}
		.post-<?php echo esc_attr( $post->ID );?> .featured-event {
			background:url('<?php echo esc_url( $image_url );?>') no-repeat;
		}
	</style>
    <div class="cs-sc-team">
        <ul>
            <li>
                <figure>asd
				  <?php if ( isset( $team_image ) && $team_image !='' ){?> 
                   <a><img alt="No image" src="<?php echo esc_url( $team_image );?>"></a>
                  <?php }?>
                  <?php if ( isset( $team_name_1 ) && $team_name_1 !='' ){?> 
                    <figcaption><a><?php echo esc_attr( $team_name_1 );?></a></figcaption>
                  <?php }?>
                </figure>
            </li>
            <li>
              <div class="match-score">
                <span <?php echo force_back($background, false);?>><?php echo esc_attr( ucwords( substr( $cs_match_venue, 0, 1 ) ) );?></span>
                <strong><?php echo esc_attr( $cs_match_team1_score );?><small>:</small><?php echo esc_attr( $cs_match_team2_score );?></strong>
               <?php if ( isset( $cs_match_attendance ) && $cs_match_attendance !='' ){?> 
                <ul>
                    <li><i class="icon-group"></i><?php esc_html_e('Attendance','goalklub');?><?php echo esc_attr( $cs_match_attendance );?></li>
                </ul>
               <?php }?>
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
    <div class="cs-rating">
         <span class="win" <?php echo force_back($background, false);?>><?php echo esc_attr( $cs_match_result_status );?></span>
				<?php
                        if ( isset($cs_xmlObject->score_list) && is_object($cs_xmlObject) && count($cs_xmlObject->score_list)>0 ) {
                                    cs_step_progress_bar($cs_xmlObject->score_list,$totla_time);
							}
                ?>
	</div>
    <div style="background: rgba(0, 0, 0, 0.5);" class="bottom-event-panel">
        <ul class="post-option">
          		<li><?php $matchObject->cs_get_categories('');?></li>
                <li><i class=" icon-calendar11"></i>
                    <?php 
                          echo esc_attr( date_i18n( get_option( 'date_format' ),strtotime( $cs_match_from_date ) ) ).' ';
                          
                         if ( isset( $cs_match_all_day ) && $cs_match_all_day == 'on' ){
                              _e('All Day', 'goalklub');
                          } else {
                              if( isset( $cs_match_start_time ) && $cs_match_start_time <> ''){
                                  $match_str_time = $matchObject->cs_format_date($cs_match_start_time);
								  echo cs_allow_special_char($match_str_time);
                              }
                              if(isset($cs_match_end_time) && $cs_match_end_time <> ''){
                              
                                  $match_end_time = $matchObject->cs_format_date($cs_match_end_time);
								   echo cs_allow_special_char($match_end_time);
                              }
                         }
                     ?>
                </li>
                
                <?php if ( isset( $cs_match_location ) && $cs_match_location !='' ){?> 
                <li><i class=" icon-location6"></i><?php echo esc_attr( ucwords( $cs_match_location ) );?></li>
                <?php }?>
        </ul>
    </div>
</div>
</div>
