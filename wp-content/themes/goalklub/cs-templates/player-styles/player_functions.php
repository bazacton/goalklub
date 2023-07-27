<?php
/**
 * File Type: Player Shortcode
 */
//======================================================================
// Adding Player Posts Start
//======================================================================
if (!function_exists('cs_player_shortcode')) {
	function cs_player_shortcode( $atts ) {
		global $post,$wpdb,$cs_theme_options,$cs_counter_node,$cs_xmlObject;
		$defaults = array('cs_player_section_title'=>'','cs_player_view'=>'','cs_player_team' =>'','cs_player_department' =>'','cs_player_filter' =>'','cs_player_order'=>'DESC','orderby'=>'ID','cs_player_num_post'=>'10','player_pagination'=>'','cs_player_class' => '','cs_player_animation' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		
		$CustomId	= '';
		if ( isset( $cs_player_class ) && $cs_player_class ) {
			$CustomId	= 'id="'.$cs_player_class.'"';
		}
		
		if ( trim($cs_player_animation) !='' ) {
			$cs_custom_animation	= 'wow'.' '.$cs_player_animation;
		} else {
			$cs_custom_animation	= '';
		}
		$owlcount = rand(40, 9999999);
		$cs_counter_node++;
		ob_start();
		
		if (isset($cs_xmlObject->sidebar_layout) && $cs_xmlObject->sidebar_layout->cs_page_layout <> '' and $cs_xmlObject->sidebar_layout->cs_page_layout <> "none"){				
				$cs_player_layout = 'col-md-4';
		}else{
				$cs_player_layout = 'col-md-3';	
		}
				
		if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;

		$cs_player_num_post	= $cs_player_num_post ? $cs_player_num_post : '-1';
		
		$args = array(
			'posts_per_page' 			=> "-1", 
			'post_type' 				=> 'player', 
			'order' 					=> $cs_player_order, 
			'orderby' 					=> $orderby, 
			'post_status' 				=> 'publish'
		);
			
		if(isset($_GET['team']) && $_GET['team'] <> '' && $_GET['team'] <> '0'){
			$player_team = array('player-team' => $_GET['team']);
			$args = array_merge($args, $player_team);
		}
		else{
			if(isset($cs_player_team) && $cs_player_team <> '' &&  $cs_player_team <> '0'){
				$player_team = array('player-team' => "$cs_player_team");
				$args = array_merge($args, $player_team);
			}
		}
		if(isset($cs_player_department) && $cs_player_department <> '' &&  $cs_player_department <> '0'){
			$player_department = array('player-department' => "$cs_player_department");
			$args = array_merge($args, $player_department);
		}
		
		$query = new WP_Query( $args );
		$count_post = $query->post_count;
		
		$cs_player_num_post	= $cs_player_num_post ? $cs_player_num_post : '-1';
		
		$args = array(
			'posts_per_page' 			=> "$cs_player_num_post", 
			'post_type' 				=> 'player', 
			'paged' 					=> $_GET['page_id_all'], 
			'order' 					=> $cs_player_order, 
			'orderby'					=> $orderby, 
			'post_status' 				=> 'publish'
		);
		
		if(isset($_GET['team']) && $_GET['team'] <> '' && $_GET['team'] <> '0'){
			$player_team = array('player-team' => $_GET['team']);
			$args = array_merge($args, $player_team);
		}
		else{
			if(isset($cs_player_team) && $cs_player_team <> '' &&  $cs_player_team <> '0'){
				$player_team = array('player-team' => "$cs_player_team");
				$args = array_merge($args, $player_team);
			}
		}
		if(isset($cs_player_department) && $cs_player_department <> '' &&  $cs_player_department <> '0'){
			$player_department = array('player-department' => "$cs_player_department");
			$args = array_merge($args, $player_department);
		}

		$outerDivStart	= '<div '.$CustomId.' class="'.$cs_custom_animation.'">';
		$outerDivEnd	= '</div>';
		$section_title  = '';
		
		if(isset($cs_player_section_title) && trim($cs_player_section_title) <> ''){
			$section_title = '<div class="main-title col-md-12"><div class="cs-section-title"><h2>'.$cs_player_section_title.'</h2></div></div>';
		}
		
		$query = new WP_Query( $args );
		$post_count = $query->post_count;
	
		if ( $query->have_posts() ) {  
			$postCounter	= 0;
                    	
					  echo cs_allow_special_char($outerDivStart);
					  echo cs_allow_special_char( $section_title );
					  
					  if($cs_player_filter == 'yes'){
						  if(isset($cs_player_team) && $cs_player_team <> '' &&  $cs_player_team <> '0'){
							  $row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $cs_player_team ));
							  $categories = get_categories( array('child_of' => "$row_cat->term_id", 'taxonomy' => 'player-team', 'hide_empty' => 1));
						  }
						  else{
							  $categories = get_categories( array('taxonomy' => 'player-team', 'hide_empty' => 1) );
						  }
						  echo '
						  <div class="col-md-12">
							<nav class="filter-nav">
								<ul class="cs-filter-menu pull-left">';
									foreach ($categories as $category) {
										$active_class = '';
										if(isset($_GET['team']) && $_GET['team'] == $category->slug){
											$active_class = ' class="active"';
										}
										echo '<li'.$active_class.'><a href="?team='.$category->slug.'">'.$category->name.'</a></li>';
									}
								echo'
								</ul>
							</nav>
						  </div>';
					  }
		  			if($cs_player_view == 'slider-view'){ echo '<div class="col-md-12"><ul class="owl-carousel cs-theme-carousel owl-'.$owlcount.' cs-prv-next">';}
					
					  $playerObject	= new CS_PlayerTemplates();
                      while ( $query->have_posts() )  : $query->the_post();
					  $postCounter++;
							if ( $cs_player_view == 'grid-view' ) {
								$playerObject->cs_grid_view($atts,$cs_player_layout);
							} else if ( $cs_player_view == 'slider-view' ) {
								$playerObject->cs_slider_view($atts);
							} else {
								$playerObject->cs_grid_view($atts,$cs_player_layout);
							} 
					  endwhile;
					  wp_reset_query();
					  if($cs_player_view == 'slider-view'){ 
					 		 cs_owl_carousel();
					  		echo '</ul></div>';
						?>
                        <script>
						jQuery(document).ready(function($) {
							jQuery('.owl-<?php echo intval($owlcount); ?>').owlCarousel({
							  nav: true,
							  margin: 30,
							  navText: [
								"<i class=' icon-angle-left'></i>",
								"<i class='icon-angle-right'></i>"
							  ],
							  responsive: {
								0: {
								  items: 1 // In this configuration 1 is enabled from 0px up to 479px screen size 
								},
								480: {
								  items: 2, // from 480 to 677 
								  nav: false // from 480 to max 
								},
								678: {
								  items: 3, // from this breakpoint 678 to 959
								  center: false // only within 678 and next - 959
								},
								960: {
								  items: 4, // from this breakpoint 960 to 1199
								  center: false,
								  loop: false
					
								},
								1200: {
								  items: 4
								}
							  }
							});
							});
						  </script>
                        <?php
					  }
					  echo cs_allow_special_char( $outerDivEnd );
					  //==Pagination Start
						 if ( $player_pagination == "Show Pagination" && $count_post > $cs_player_num_post && $cs_player_num_post > 0 and $cs_player_view <> 'slider-view' ) {
							 $qrystr = '';
							 if ( isset($_GET['page_id']) ) $qrystr .= "&amp;page_id=".$_GET['page_id'];
							 if ( isset($_GET['team']) ) $qrystr .= "&amp;team=".$_GET['team'];
							 echo cs_pagination($count_post, $cs_player_num_post,$qrystr,'Show Pagination');
						 }
					 //==Pagination End	
					 ?>                   
            <?php 
            }
            
		    wp_reset_postdata();	
                
            $post_data = ob_get_clean();
            return $post_data;
         }
    if(function_exists('cs_shortcode_add')){
        cs_shortcode_add( 'cs_player', 'cs_player_shortcode' );
}
}
