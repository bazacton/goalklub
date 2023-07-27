<?php
/**
 * File Type: Match Shortcode
 */
	

//======================================================================
// Adding Match Posts Start
//======================================================================
if (!function_exists('cs_match_shortcode')) {
	function cs_match_shortcode( $atts ) {
		global $post,$wpdb,$cs_theme_options,$cs_counter_node,$cs_xmlObject;
		$defaults = array('cs_match_section_title'=>'','cs_match_view'=>'','cs_match_cat' =>'','cs_match_type' =>'','cs_match_order'=>'DESC','orderby'=>'ID','cs_match_num_post'=>'10','match_pagination'=>'','cs_match_class' => '','cs_match_animation' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		
		date_default_timezone_set('UTC');
		$current_time = strtotime(current_time('m/d/Y H:i', $gmt = 0));
		
		$CustomId	= '';
		if ( isset( $cs_match_class ) && $cs_match_class ) {
			$CustomId	= 'id="'.$cs_match_class.'"';
		}
		
		if ( trim($cs_match_animation) !='' ) {
			$cs_custom_animation	= 'wow'.' '.$cs_match_animation;
		} else {
			$cs_custom_animation	= '';
		}
		$owlcount = rand(40, 9999999);
		$cs_counter_node++;
		ob_start();
		
		if (isset($cs_xmlObject->sidebar_layout) && $cs_xmlObject->sidebar_layout->cs_page_layout <> '' and $cs_xmlObject->sidebar_layout->cs_page_layout <> "none"){				
				$cs_match_layout = 'col-md-4';
		}else{
				$cs_match_layout = 'col-md-3';	
		}
		
		$meta_compare = "";
		$meta_value   = $current_time;
		$meta_key	  = 'cs_match_from_date';
		
		if ( $cs_match_type == "upcoming" ) $meta_compare = ">=";
        else if ( $cs_match_type == "past" ) $meta_compare = "<";
		
		if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;

		$cs_match_num_post	= $cs_match_num_post ? $cs_match_num_post : '-1';
		
		if ( $cs_match_type == "upcoming") {
				
			$args = array(
				'posts_per_page'			=> "-1",
				'post_type'					=> 'match',
				'post_status'				=> 'publish',
				'meta_key'					=> $meta_key,
				'meta_value'				=> $meta_value,
				'meta_compare'				=> $meta_compare,
				'orderby'					=> $orderby,
				'order'						=> $cs_match_order,
			 );
		}else if ( $cs_match_type == "past" ) {
			
			$args = array(
				'posts_per_page'			=> "-1",
				'post_type'					=> 'match',
				'post_status'				=> 'publish',
				'meta_key'					=> $meta_key,
				'meta_value'				=> $meta_value,
				'meta_compare'				=> $meta_compare,
				'orderby'					=> $orderby,
				'order'						=> $cs_match_order,
			);
			
		}
		else{
			$args = array(
				'posts_per_page' 			=> "-1", 
				'post_type' 				=> 'match', 
				'order' 					=> $cs_match_order, 
				'orderby' 					=> $orderby, 
				'post_status' 				=> 'publish'
			);
		}
		if(isset($cs_match_cat) && $cs_match_cat <> '' &&  $cs_match_cat <> '0'){
			$match_cat = array('match-category' => "$cs_match_cat");
			$args = array_merge($args, $match_cat);
		}
		$query = new WP_Query( $args );
		$count_post = $query->post_count;
		
		$cs_match_num_post	= $cs_match_num_post ? $cs_match_num_post : '-1';
		
		if ( $cs_match_type == "upcoming") {
				
			$args = array(
				'posts_per_page' 			=> "$cs_match_num_post", 
				'post_type' 				=> 'match', 
				'paged' 					=> $_GET['page_id_all'], 
				'post_status'				=> 'publish',
				'meta_key'					=> $meta_key,
				'meta_value'				=> $meta_value,
				'meta_compare'				=> $meta_compare,
				'orderby'					=> $orderby,
				'order'						=> $cs_match_order,
			 );
		}else if ( $cs_match_type == "past" ) {
			
			$args = array(
				'posts_per_page' 			=> "$cs_match_num_post", 
				'post_type' 				=> 'match', 
				'paged' 					=> $_GET['page_id_all'], 
				'post_status'				=> 'publish',
				'meta_key'					=> $meta_key,
				'meta_value'				=> $meta_value,
				'meta_compare'				=> $meta_compare,
				'orderby'					=> 'meta_value',
				'order'						=> $cs_match_order,
			);
			
		}
		else{
			$args = array(
				'posts_per_page' 			=> "$cs_match_num_post", 
				'post_type' 				=> 'match', 
				'paged' 					=> $_GET['page_id_all'],
				'meta_key'					=> $meta_key, 
				'order' 					=> $cs_match_order, 
				'orderby'					=> 'meta_value', 
				'post_status' 				=> 'publish'
			);
		}

		if(isset($cs_match_cat) && $cs_match_cat <> '' &&  $cs_match_cat <> '0'){
			$cs_match_cat = array('match-category' => "$cs_match_cat");
			$args = array_merge($args, $cs_match_cat);
		}

		$outerDivStart	= '<div '.$CustomId.' class="col-md-12 '.$cs_custom_animation.'">';
		$outerDivEnd	= '</div>';
		$section_title  = '';
		
		if(isset($cs_match_section_title) && trim($cs_match_section_title) <> ''){
			$section_title = '<div class="cs-section-title"><h2>'.$cs_match_section_title.'</h2></div>';
		}
		
		$query = new WP_Query( $args );
		$post_count = $query->post_count;
		
		 echo cs_allow_special_char($outerDivStart);
		 echo cs_allow_special_char( $section_title );
					  
		if ( $query->have_posts() ) {  
			$postCounter	= 0;
                    	
					
					  $matchObject	= new CS_MatchTemplates();
                      while ( $query->have_posts() )  : $query->the_post();
					  		
					  $postCounter++;
					  $matchDate 			= get_post_meta($post->ID, "cs_match_from_date", true);
					  $currentDate			= strtotime(date('Y-m-d H:i'));
					  
							if ( $cs_match_view == 'list-view' ) {
								
								if ( $postCounter > 1 ){
									if ( $postCounter ==  2 ){
										echo '<div class="event event-listing">';
									}
									
									if( $currentDate > $matchDate ){	
										$matchObject->cs_list_view($atts);
									} else {
										$matchObject->cs_upcomming_list_view($atts);
									}
									
									if ( $postCounter ==  $post_count ){
										echo '</div>';
									}
								
								} else {
									
									if( $currentDate > $matchDate ){	
										$matchObject->cs_featured_view( $atts );
									} else {
										$matchObject->cs_upcomming_featured_view( $atts );
									}
								}
								
							} else if ( $cs_match_view == 'simple-list-view' ) {
								
								if ( $postCounter > 1 ){
									if ( $postCounter ==  2 ){
										echo '<div class="event event-listing-v2">';
									}
									
									if( $currentDate > $matchDate ){	
										$matchObject->cs_simple_view($atts);
									} else {
										$matchObject->cs_upcomming_simple_view($atts);
									}
									
									if ( $postCounter ==  $post_count ){
										echo '</div>';
									}
								
								} else {
									if( $currentDate > $matchDate ){	
										$matchObject->cs_featured_view( $atts );
									} else {
										$matchObject->cs_upcomming_featured_view( $atts );
									}
								}
							
							} else if ( $cs_match_view == 'club-view' ) {
								
								if ( $postCounter > 1 ){
									if ( $postCounter ==  2 ){
										echo '<div class="event event-listing event-results">';
									}
									
									if( $currentDate > $matchDate ){	
										$matchObject->cs_club_view($atts);
									} else {
										$matchObject->cs_upcomming_club_view($atts);
									}
									
									if ( $postCounter ==  $post_count ){
										echo '</div>';
									}
								
								} else {
									if( $currentDate > $matchDate ){	
										$matchObject->cs_featured_view( $atts );
									} else {
										$matchObject->cs_upcomming_featured_view( $atts );
									}
								}
								
							} else {
								
								if ( $postCounter > 1 ){
									if ( $postCounter ==  2 ){
										echo '<div class="event event-listing">';
									}
									
									$matchObject->cs_list_view($atts);
									
									if ( $postCounter ==  $post_count ){
										echo '</div>';
									}
								
								} else {
									
									if( $currentDate > $matchDate ){	
										$matchObject->cs_featured_view( $atts );
									} else {
										$matchObject->cs_upcomming_featured_view( $atts );
									}
								}
								
							} 
						
					  endwhile;
					  wp_reset_query();
					 
            } else {
				echo '<div class="col-md-12">'.__('No Matches Found','goalklub').'</div>';
			}
			
			echo cs_allow_special_char( $outerDivEnd );
            
			//==Pagination Start
			   if ( $match_pagination == "Show Pagination" && $count_post > $cs_match_num_post && $cs_match_num_post > 0 ) {
				  $qrystr = '';
				   if ( isset($_GET['page_id']) ) $qrystr .= "&amp;page_id=".$_GET['page_id'];

				  echo cs_pagination($count_post, $cs_match_num_post,$qrystr,'Show Pagination');
			   }
		   //==Pagination End	
						 
		    wp_reset_postdata();	
                
            $post_data = ob_get_clean();
            return $post_data;
         }
    if(function_exists('cs_shortcode_add')){
        cs_shortcode_add( 'cs_match', 'cs_match_shortcode' );
}
}


//======================================================================
// Adding Upcomming Fixtures Posts Start
//======================================================================
if (!function_exists('cs_upcomming_fixtures_shortcode')) {
	function cs_upcomming_fixtures_shortcode( $atts ) {
		global $post,$wpdb,$cs_theme_options,$cs_counter_node,$cs_xmlObject;
		$defaults = array('cs_fixture_section_title'=>'','cs_fixture_cat' =>'','cs_fixture_view'=>'list-view','cs_fixture_link' =>'','cs_fixture_order'=>'','orderby'=>'ID','cs_fixture_num_post'=>'10','cs_fixture_class' => '','cs_fixture_animation' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		
		date_default_timezone_set('UTC');
		$current_time = strtotime(current_time('m/d/Y H:i', $gmt = 0));
		
		$CustomId	= '';
		if ( isset( $cs_fixture_class ) && $cs_fixture_class ) {
			$CustomId	= 'id="'.$cs_fixture_class.'"';
		}
		
		if ( trim($cs_fixture_animation) !='' ) {
			$cs_custom_animation	= 'wow'.' '.$cs_fixture_animation;
		} else {
			$cs_custom_animation	= '';
		}
		$owlcount = rand(40, 9999999);
		$cs_counter_node++;
		ob_start();
		
		
		$meta_compare = "";
		$meta_value   = $current_time;
		$meta_key	  = 'cs_match_from_date';
		$meta_compare = ">=";
		
		
		if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;

		$cs_fixture_num_post	= $cs_fixture_num_post ? $cs_fixture_num_post : '-1';
		
		$args = array(
				'posts_per_page'			=> "-1",
				'post_type'					=> 'match',
				'post_status'				=> 'publish',
				'meta_key'					=> $meta_key,
				'meta_value'				=> $meta_value,
				'meta_compare'				=> $meta_compare,
				'orderby'					=> $orderby,
				'order'						=> $cs_fixture_order,
			 );
			 
		if(isset($cs_fixture_cat) && $cs_fixture_cat <> '' &&  $cs_fixture_cat <> '0'){
			$match_cat = array('match-category' => "$cs_fixture_cat");
			$args = array_merge($args, $match_cat);
		}
		$query = new WP_Query( $args );
		$count_post = $query->post_count;
		
		$cs_fixture_num_post	= $cs_fixture_num_post ? $cs_fixture_num_post : '-1';
		
		$args = array(
				'posts_per_page' 			=> "$cs_fixture_num_post", 
				'post_type' 				=> 'match', 
				'paged' 					=> $_GET['page_id_all'], 
				'post_status'				=> 'publish',
				'meta_key'					=> $meta_key,
				'meta_value'				=> $meta_value,
				'meta_compare'				=> $meta_compare,
				'orderby'					=> $orderby,
				'order'						=> $cs_fixture_order,
			 );
		
		 
		if(isset($cs_fixture_cat) && $cs_fixture_cat <> '' &&  $cs_fixture_cat <> '0'){
			$cs_fixture_cat = array('match-category' => "$cs_fixture_cat");
			$args = array_merge($args, $cs_fixture_cat);
		}
		$outerDivStart	= '<div '.$CustomId.' class="col-md-12 '.$cs_custom_animation.'">';	
		$outerDivEnd	= '</div>';
 		
		$section_title  = '';
		echo cs_allow_special_char($outerDivStart);
		if(isset($cs_fixture_section_title) && trim($cs_fixture_section_title) <> ''){
			$section_title = '<div class="cs-section-title"><h2>'.$cs_fixture_section_title.'</h2></div>';
			echo cs_allow_special_char($section_title);
		}
		
		
		$query = new WP_Query( $args );
		$post_count = $query->post_count;
		
		
					  
		if ( $query->have_posts() ) {  
			$postCounter	= 0;
			  if($cs_fixture_view=='list-view'){
			    echo '<div class="event event-listing event-samll">';
			  }
			  $matchObject	= new CS_MatchTemplates();
			  while ( $query->have_posts() )  : $query->the_post();
					
			  $postCounter++;
			  if($cs_fixture_view=='list-view'){
			  		$matchObject->cs_upcomming_fixtures_list_view($atts);
			  }elseif($cs_fixture_view=='club-view'){
				  	$matchObject->cs_upcomming_fixtures_club_view($atts);
			  }else{
				  	$matchObject->cs_upcomming_fixtures_list_view($atts);
			  }	
				
			  endwhile;
			  wp_reset_query();
			    
			  if ( isset( $cs_fixture_link ) && $cs_fixture_link !='' ) {
				  echo '<div class="bottom-event-panel">
							<a href="'. $cs_fixture_link .'"><i class="icon-calendar6"></i>'.__('View All Fixtures','goalklub').' </a>
						</div>';
			  }
			  
			  if($cs_fixture_view=='list-view'){
				echo '</div>';
			  }
			
            } else {
				echo '<div class="col-md-12">'.__('No Matches Found','goalklub').'</div>';
			}
			
			echo cs_allow_special_char( $outerDivEnd );
            
		    wp_reset_postdata();	
                
            $post_data = ob_get_clean();
            return $post_data;
         }
    if(function_exists('cs_shortcode_add')){
        cs_shortcode_add( 'cs_upcomming_fixtures', 'cs_upcomming_fixtures_shortcode' );
}
}


if ( ! function_exists( 'cs_step_progress_bar' ) ) { 
	function cs_step_progress_bar($data = array(),$totla_time = 0){
		?> 
       <script type="text/javascript">
			jQuery(document).ready(function($) {
				$= jQuery;
					var i = 1;
					$('.match-progress .circle').removeClass().addClass('circle');
					$('.match-progress .bar').removeClass().addClass('bar');
					setInterval(function() {
						$('.match-progress .circle:nth-of-type(' + i + ')').addClass('active');
	
						$('.match-progress .circle:nth-of-type(' + (i - 1) + ')').removeClass('active').addClass('done');
	
						$('.match-progress .circle:nth-of-type(' + (i - 1) + ') .label').html('&#10003;');
	
						$('.match-progress .bar:nth-of-type(' + (i - 1) + ')').addClass('active');
	
						$('.match-progress .bar:nth-of-type(' + (i - 2) + ')').removeClass('active').addClass('done');
	
						i++;
	
						if (i == 0) {
							$('.match-progress .bar').removeClass().addClass('bar');
							$('.match-progress div.circle').removeClass().addClass('circle');
							i = 1;
						}
					}, 1000);
				});
        </script>
        <?php
		
		$match_array;
		echo '<div class="match-progress">';
		foreach ( $data as $list ){
			 $match_palyer_name = $list->match_palyer_name;
			 $match_score_time = $list->match_score_time;
			 $match_score_color = $list->match_score_color;
			 $match_score_description = $list->match_score_description;
			 $match_array["$match_score_time"]= array('match_palyer_name'=>"$match_palyer_name",'match_score_time'=>"$match_score_time",'match_score_color'=>"$match_score_color",'match_score_description'=>"$match_score_description");
			 
		}
		ksort($match_array);
		$i=0;
		$time_percent = 0;
		foreach($match_array as $key=>$val){
			
			$time_percent = ( $i == 0 ) ? ceil(( $match_array[$key]['match_score_time'] * 100 /$totla_time )  /$totla_time):ceil(( $match_array[$key]['match_score_time'] * 100 /$totla_time ) - $percent);
			echo '<span class="bar done" style="width:'.$time_percent.'%;"></span>
			 		<div class="cs-circle-holder">
					<div class="circle done" style="background-color:'.$match_array[$key]['match_score_color'].'">
						 <span class="title">'.$match_array[$key]['match_palyer_name'].','.$match_array[$key]['match_score_time'].'</span>
					</div></div>';
					$percent = ceil(( $match_array[$key]['match_score_time'] * 100) /$totla_time );
					$i++;
		}
		 echo '</div>';
	
		
	}
}