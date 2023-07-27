<?php
	require_once 'pt_functions.php';
	
	//adding columns start
    add_filter('manage_match_posts_columns', 'match_columns_add');
	function match_columns_add($columns) {
		$columns['author'] =__('Author','goalklub');
		return $columns;
	}
    add_action('manage_match_posts_custom_column', 'match_columns');
	function match_columns($name) {
		global $post;
		switch ($name) {
			case 'author':
				echo get_the_author();
				break;
		}
	}
	
	//adding columns end
	if ( ! function_exists( 'cs_match_register' ) ) {
		function cs_match_register() {
			$labels = array(
				'name' => __('Match','goalklub'),
				'all_items' => __('Match','goalklub'),
				'add_new_item' =>__('Add New Match','goalklub'),
				'edit_item' =>__('Edit Match','goalklub'),
				'new_item' =>__('New Match Item','goalklub'),
				'add_new' =>__('Add New Match','goalklub'),
				'view_item' =>__('View Match Item','goalklub'),
				'search_items' =>__('Search Match','goalklub'),
				'not_found' =>__('Nothing found','goalklub'),
				'not_found_in_trash' =>__('Nothing found in Trash','goalklub'),
				'parent_item_colon' => ''
			);
			
			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'menu_icon' => 'dashicons-admin-site',
				'rewrite' => true,
				'capability_type' => 'post',
				'has_archive' => false,
				'map_meta_cap' => true,
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title','editor','thumbnail','comments')
			);

            if (function_exists('cs_register_post_type')) {
                cs_register_post_type('match' , $args);
            }
		}
		add_action('init', 'cs_match_register');
	}
		// adding cat start
		  $labels = array(
			'name' =>__('Match Categories','goalklub'),
			'search_items' =>__('Search Match Categories','goalklub'),
			'edit_item' =>__('Edit Match Category','goalklub'),
			'update_item' =>__('Update Match Category','goalklub'),
			'add_new_item' =>__('Add New Category','goalklub'),
			'menu_name' =>__('Categories','goalklub'),
		  );
if (function_exists('cs_register_taxonomy')) {
    cs_register_taxonomy('match-category',array('match'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'show_admin_column' => true,
        'rewrite' => array( 'slug' => 'match-category' ),
    ));
}

		// adding cat end
		
		// adding Location start
		  $labels = array(
			'name' => 'Match Locations',
			'search_items' =>__('Search Match Locations','goalklub'),
			'edit_item' =>__('Edit Match Location','goalklub'),
			'update_item' =>__('Update Match Location','goalklub'),
			'add_new_item' =>__('Add New Location','goalklub'),
			'menu_name' =>__('Locations','goalklub'),
		  );
if (function_exists('cs_register_taxonomy')) {
    cs_register_taxonomy('match-location',array('match'), array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'match-location' ),
    ));
}

		// adding Location end
		
		// adding tag start
		  $labels = array(
			'name' => 'Match Tags',
			'singular_name' => 'match-tag',
			'search_items' =>__('Search Tags','goalklub'),
			'popular_items' =>__('Popular Tags','goalklub'),
			'all_items' =>__('All Tags','goalklub'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' =>__('Edit Tag','goalklub'),
			'update_item' =>__('Update Tag','goalklub'),
			'add_new_item' =>__('Add New Tag','goalklub'),
			'new_item_name' =>__('New Tag Name','goalklub'),
			'separate_items_with_commas' =>__('Separate tags with commas','goalklub'),
			'add_or_remove_items' =>__('Add or remove tags','goalklub'),
			'choose_from_most_used' =>__('Choose from the most used tags','goalklub'),
			'menu_name' => 'Tags',
		  );
if (function_exists('cs_register_taxonomy')) {
    cs_register_taxonomy('match-tag','match',array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array( 'slug' => 'match-tag' ),
    ));
}

		// adding tag end

	// adding course meta info start
if (function_exists('cs_meta_boxes')) {
    cs_meta_boxes('cs_meta_match_add');
}

	function cs_meta_match_add(){
        if (function_exists('cs_meta_box')) {
            cs_meta_box('cs_meta_match', __('Match Options','goalklub'), 'cs_meta_match', 'match', 'normal', 'high');
        }
	}
	function cs_meta_match( $post ) {
		global $post,$cs_xmlObject, $cs_theme_options;
		//$cs_theme_options=get_option('cs_theme_options');
		$course_post_id = $post->ID;
		$cs_builtin_seo_fields =$cs_theme_options['cs_builtin_seo_fields'];
		$cs_header_position =$cs_theme_options['cs_header_position'];
		$cs_match = get_post_meta($post->ID, "match", true);
		if ( $cs_match <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($cs_match);
			
			$cs_match_team1_score = $cs_xmlObject->cs_match_team1_score;
			$cs_match_team2_score = $cs_xmlObject->cs_match_team2_score;
			$cs_match_summary = $cs_xmlObject->cs_match_summary;
			$cs_match_attendance = $cs_xmlObject->cs_match_attendance;
			$cs_match_result_status = $cs_xmlObject->cs_match_result_status;
		} else {
			
			$cs_match_team1_score = '';
			$cs_match_team2_score = '';
			$cs_match_summary = '';
			$cs_match_attendance = '';
			$cs_match_result_status = '';
			
			if(!isset($cs_xmlObject))
				$cs_xmlObject = new stdClass();
		}
				
		cs_enqueue_timepicker_script();
		?>		
		<div class="page-wrap page-opts left" style="overflow:hidden; position:relative; height: 1432px;">
			<div class="option-sec" style="margin-bottom:0;">
				<div class="opt-conts">
					<div class="elementhidden">
						<div class="tabs vertical">
							<nav class="admin-navigtion">
								<ul id="myTab" class="nav nav-tabs">
                                                                    
                                                                        <li class="active"><a data-toggle="tab" href="#tab-match-settings-cs-match"><i class="icon-params"></i><?php _e('Match Options','goalklub'); ?></a></li>
                                                                       <li><a data-toggle="tab" href="#tab-match-settings-cs-result"><i class="icon-shield2"></i><?php _e('Result Options','goalklub'); ?></a></li>
                                                                    <?php if($cs_header_position == 'absolute'){?>
                 						<li><a href="#tab-header-position-settings" data-toggle="tab"><i class="icon-header"></i><?php _e('Header Absolute','goalklub');?></a></li>
                 					<?php }?>
									
									<li><a href="#tab-subheader-options" data-toggle="tab"><i class="icon-header"></i> <?php _e('Sub Header','goalklub');?> </a></li>
									
									<?php if($cs_builtin_seo_fields == 'on'){?>
									<li><a href="#tab-seo-advance-settings" data-toggle="tab"><i class="icon-dribbble6"></i> <?php _e('Seo Options','goalklub');?></a></li>
									<?php }?>
                                                                        
                                                                        
                                                                        
                                                                        <li ><a href="#tab-general-settings" data-toggle="tab"><i class="icon-gear"></i><?php _e('General','goalklub');?></a></li>
                                
                                    
                                    
                                    
                                    
                                 
 							  </ul>
						  </nav>
							<div class="tab-content">
							<div id="tab-subheader-options" class="tab-pane fade">
								<?php cs_subheader_element();?>
							</div>
							<div id="tab-general-settings" class="tab-pane fade">
								<?php 
									cs_general_settings_element();
									cs_sidebar_layout_options();
								?>
							</div>
 							<?php if($cs_builtin_seo_fields == 'on'){?>
							<div id="tab-seo-advance-settings" class="tab-pane fade">
								<?php cs_seo_settitngs_element();?>
							</div>
							<?php }
                            if($cs_header_position == 'absolute'){?>
                             <div id="tab-header-position-settings" class="tab-pane fade">
                                 <?php cs_header_postition_element();?>
                            </div>
                            <?php } ?>
                            
                            <div id="tab-match-settings-cs-match" class="tab-pane fade active in">
                            	<?php cs_post_match_fields(); ?>
                            </div>
                            
                            <div id="tab-match-settings-cs-result" class="tab-pane fade">
                            	<ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Team 1 Score','goalklub');?></label>
                                  </li>
                                  <li class="to-field">
                                    <div class="input-sec">
                                        <input type="text" id="cs_match_team1_score" name="cs_match_team1_score" value="<?php if(isset($cs_match_team1_score) && $cs_match_team1_score <> '') echo cs_allow_special_char($cs_match_team1_score)?>" />
                                    </div>
                                  </li>
                                </ul>
                            
                            	<ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Team 2 Score','goalklub');?></label>
                                  </li>
                                  <li class="to-field">
                                    <div class="input-sec">
                                        <input type="text" id="cs_match_team2_score" name="cs_match_team2_score" value="<?php if(isset($cs_match_team2_score) && $cs_match_team2_score <> '') echo cs_allow_special_char($cs_match_team2_score)?>" />
                                    </div>
                                  </li>
                                </ul>
                           
                            	<ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Summary','goalklub');?></label>
                                  </li>
                                  <li class="to-field">
                                    <div class="input-sec">
                                        <textarea id="cs_match_summary" name="cs_match_summary"><?php if(isset($cs_match_summary) && $cs_match_summary <> '') echo cs_allow_special_char($cs_match_summary)?></textarea>
                                    </div>
                                  </li>
                                </ul>
                           
                            	<ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Attendance','goalklub');?></label>
                                  </li>
                                  <li class="to-field">
                                    <div class="input-sec">
                                        <input type="text" id="cs_match_attendance" name="cs_match_attendance" value="<?php if(isset($cs_match_attendance) && $cs_match_attendance <> '') echo cs_allow_special_char($cs_match_attendance)?>" />
                                    </div>
                                  </li>
                                </ul>
                            
                            	<ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Status','goalklub');?></label>
                                  </li>
                                  <li class="to-field">
                                    <div class="input-sec">
                                        <input type="text" id="cs_match_result_status" name="cs_match_result_status" value="<?php if(isset($cs_match_result_status) && $cs_match_result_status <> '') echo cs_allow_special_char($cs_match_result_status)?>" />
                                    </div>
                                  </li>
                                </ul>
                            </div>
                            
 						  </div>
						</div>
					  </div>
					</div>
				<input type="hidden" name="match_meta_form" value="1" />
			</div>
		</div>
		<div class="clear"></div>
	<?php 
    }
 	// Course Meta option save
	if ( isset($_POST['match_meta_form']) and $_POST['match_meta_form'] == 1 ) {
		add_action( 'save_post', 'cs_meta_match_save' );  
		function cs_meta_match_save( $post_id ){  
			$sxe = new SimpleXMLElement("<match></match>");
			
			if (empty($_POST['cs_match_from_date'])){ $_POST['cs_match_from_date'] = "";}
			if (empty($_POST['cs_match_start_time'])){ $_POST['cs_match_start_time'] = "";}
			if (empty($_POST['cs_match_end_time'])){ $_POST['cs_match_end_time'] = "";}
			if (empty($_POST['cs_match_all_day'])){ $_POST['cs_match_all_day'] = "";}
			if (empty($_POST['cs_match_ticket_options'])){ $_POST['cs_match_ticket_options'] = "";}
			if (empty($_POST['cs_match_buy_now'])){ $_POST['cs_match_buy_now'] = "";}
			if (empty($_POST['cs_match_ticket_color'])){ $_POST['cs_match_ticket_color'] = "";}
			if (empty($_POST['cs_match_team_1'])){ $_POST['cs_match_team_1'] = "";}
			if (empty($_POST['cs_match_team_2'])){ $_POST['cs_match_team_2'] = "";}
			if (empty($_POST['cs_match_location'])){ $_POST['cs_match_location'] = "";}
			if (empty($_POST['cs_match_venue'])){ $_POST['cs_match_venue'] = "";}
			if (!isset($_POST['cs_match_team1_score'])){ $_POST['cs_match_team1_score'] = "";}
			if (!isset($_POST['cs_match_team2_score'])){ $_POST['cs_match_team2_score'] = "";}
			if (empty($_POST['cs_match_summary'])){ $_POST['cs_match_summary'] = "";}
			if (empty($_POST['cs_match_attendance'])){ $_POST['cs_match_attendance'] = "";}
			if (empty($_POST['cs_match_result_status'])){ $_POST['cs_match_result_status'] = "";}
			if (empty($_POST['match_design_view'])){ $_POST['match_design_view'] = "";}
			
						
			$sxe->addChild('cs_match_from_date', $_POST['cs_match_from_date']);
			$sxe->addChild('cs_match_start_time', $_POST['cs_match_start_time']);
			$sxe->addChild('cs_match_end_time', $_POST['cs_match_end_time']);
			$sxe->addChild('cs_match_all_day', $_POST['cs_match_all_day']);
			$sxe->addChild('cs_match_ticket_options', $_POST['cs_match_ticket_options']);
			$sxe->addChild('cs_match_buy_now', $_POST['cs_match_buy_now']);
			$sxe->addChild('cs_match_ticket_color', $_POST['cs_match_ticket_color']);
			$sxe->addChild('cs_match_team_1', $_POST['cs_match_team_1']);
			$sxe->addChild('cs_match_team_2', $_POST['cs_match_team_2']);
			$sxe->addChild('cs_match_location', $_POST['cs_match_location']);
			$sxe->addChild('cs_match_venue', $_POST['cs_match_venue']);
			$sxe->addChild('cs_match_team1_score', $_POST['cs_match_team1_score']);
			$sxe->addChild('cs_match_team2_score', $_POST['cs_match_team2_score']);
			$sxe->addChild('cs_match_summary', $_POST['cs_match_summary']);
			$sxe->addChild('cs_match_attendance', $_POST['cs_match_attendance']);
			$sxe->addChild('cs_match_result_status', $_POST['cs_match_result_status']);
			$sxe->addChild('match_design_view', $_POST['match_design_view']);
			if(isset($_POST['match_palyer_name'])){
				$i=0;
				foreach($_POST['match_palyer_name'] as $player){
					$team = $sxe->addChild('score_list');
					if (empty($_POST['match_palyer_name'][$i])){ $_POST['match_palyer_name'][$i] = '';}
					if (empty($_POST['match_score_time'][$i])){ $_POST['match_score_time'][$i] = '';}
					if (empty($_POST['match_score_color'][$i])){ $_POST['match_score_color'][$i] = '';}
					if (empty($_POST['match_score_description'][$i])){ $_POST['match_score_description'][$i] = '';}

					$team->addChild('match_palyer_name', htmlspecialchars($_POST['match_palyer_name'][$i]) );
					$team->addChild('match_score_time', htmlspecialchars($_POST['match_score_time'][$i]) );
					$team->addChild('match_score_color', $_POST['match_score_color'][$i] );
					$team->addChild('match_score_description', htmlspecialchars($_POST['match_score_description'][$i]) );
					
					$i++;
				}
			}
			
			$sxe = cs_page_options_save_xml($sxe);
			
			if ( isset ( $_POST["cs_match_from_date"] ) && $_POST["cs_match_from_date"] != '') {
				$cs_match_from_date = $_POST["cs_match_from_date"].' '.$_POST["cs_match_start_time"];
				update_post_meta( $post_id, 'cs_match_from_date', strtotime($cs_match_from_date));
			}
						
			update_post_meta( $post_id, 'match', $sxe->asXML() );
		}
	}
	// adding Match meta info end
 ?>