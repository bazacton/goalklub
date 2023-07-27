<?php
	require_once 'pt_functions.php';

	//adding columns start
    add_filter('manage_player_posts_columns', 'player_columns_add');
	function player_columns_add($columns) {
		$columns['author'] = 'Author';
		return $columns;
	}
    add_action('manage_player_posts_custom_column', 'player_columns');
	function player_columns($name) {
		global $post;
		switch ($name) {
			case 'author':
				echo get_the_author();
				break;
		}
	}
	//adding columns end
	if ( ! function_exists( 'cs_player_register' ) ) {
		function cs_player_register() {
			$labels = array(
				'name' =>__('Players','goalklub'),
				'all_items' => __('Players','goalklub'),
				'add_new_item' =>__('Add New Player','goalklub'),
				'edit_item' =>__('Edit Player','goalklub'),
				'new_item' =>__('New Player Item','goalklub'),
				'add_new' =>__('Add New Player','goalklub'),
				'view_item' =>__('View Player Item','goalklub'),
				'search_items' =>__('Search Player','goalklub'),
				'not_found' =>__( 'Nothing found','goalklub'),
				'not_found_in_trash' =>__('Nothing found in Trash','goalklub'),
				'parent_item_colon' => ''
			);
			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'menu_icon' => 'dashicons-groups',
				'rewrite' => true,
				'capability_type' => 'post',
				'has_archive' => false,
				'map_meta_cap' => true,
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title','editor','thumbnail','comments')
			);

            if (function_exists('cs_register_post_type')) {
                cs_register_post_type('player' , $args);
            }

		}
		add_action('init', 'cs_player_register');
	}
		// adding Team start
		  $labels = array(
			'name' =>__('Player Teams','goalklub'),
			'search_items' =>__('Search Player Teams','goalklub'),
			'edit_item' =>__('Edit Player Team','goalklub'),
			'update_item' =>__('Update Player Team','goalklub'),
			'add_new_item' =>__('Add New Team','goalklub'),
			'menu_name' =>__('Teams','goalklub'),
		  );
if (function_exists('cs_register_taxonomy')) {
    cs_register_taxonomy('player-team',array('player'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'show_admin_column' => true,
        'rewrite' => array( 'slug' => 'player-team' ),
    ));
}

		// adding Team end
		
		// adding Tags start
		  $labels = array(
			'name' =>__('Player Tags','goalklub'),
			'search_items' =>__('Search Player Tags','goalklub'),
			'edit_item' =>__('Edit Player Tag','goalklub'),
			'update_item' =>__('Update Player Tag','goalklub'),
			'add_new_item' =>__('Add New Tag','goalklub'),
			'menu_name' =>__('Tags','goalklub'),
		  );
if (function_exists('cs_register_taxonomy')) {
    cs_register_taxonomy('player-tag',array('player'), array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'show_admin_column' => true,
        'rewrite' => array( 'slug' => 'player-tag' ),
    ));
}


		// adding Team end
		
		// adding Department start
		  $labels = array(
			'name' =>__('Player Departments','goalklub'),
			'search_items' =>__('Search Player Departments','goalklub'),
			'edit_item' =>__('Edit Player Department','goalklub'),
			'update_item' =>__('Update Player Department','goalklub'),
			'add_new_item' =>__('Add New Department','goalklub'),
			'menu_name' =>__('Departments','goalklub'),
		  );
if (function_exists('cs_register_taxonomy')) {
    cs_register_taxonomy('player-department',array('player'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'show_admin_column' => true,
        'rewrite' => array( 'slug' => 'player-department' ),
    ));
}


		// adding Department end
		

	// adding Player meta info start
if (function_exists('cs_meta_boxes')) {
    cs_meta_boxes('cs_meta_player_add');
}

	function cs_meta_player_add(){
        if (function_exists('cs_meta_box')) {
            cs_meta_box('cs_meta_player', __('Player Options','goalklub'), 'cs_meta_player', 'player', 'normal', 'high' );
        }
	}
	function cs_meta_player( $post ) {
		global $post, $cs_xmlObject, $cs_theme_options;
		//$cs_theme_options = get_option('cs_theme_options');
		$cs_builtin_seo_fields = $cs_theme_options['cs_builtin_seo_fields'];
		$cs_header_position = $cs_theme_options['cs_header_position'];
		$cs_player = get_post_meta($post->ID, "player", true);
		if ( $cs_player <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($cs_player);
			$cs_player_position_no = $cs_xmlObject->cs_player_position_no;
			$cs_player_position_name = $cs_xmlObject->cs_player_position_name;
			$cs_player_facebook_link = $cs_xmlObject->cs_player_facebook_link;
			$cs_player_twitter_link = $cs_xmlObject->cs_player_twitter_link;
			$cs_player_google_link = $cs_xmlObject->cs_player_google_link;
			$cs_player_pintrest_link = $cs_xmlObject->cs_player_pintrest_link;
			$cs_player_mail_link = $cs_xmlObject->cs_player_mail_link;
			
		} else {
			$cs_player_position_no = '';
			$cs_player_position_name = '';
			$cs_player_facebook_link = '';
			$cs_player_twitter_link = '';
			$cs_player_google_link = '';
			$cs_player_pintrest_link = '';
			$cs_player_mail_link = '';			
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
                                                                    
                                                                    
                                                                    <li class="active"><a data-toggle="tab" href="#tab-players-settings-cs-players"><i class="icon-params"></i><?php _e('Player Options','goalklub'); ?></a></li>
                                                                    
                                                                    
                                                                      <li><a data-toggle="tab" href="#tab-players-settings-cs-dynamic-fields"><i class="icon-shield2"></i><?php _e('Player Fields','goalklub'); ?></a></li>
                                                                    <?php if($cs_header_position == 'absolute'){?>
                 						<li><a href="#tab-header-position-settings" data-toggle="tab"><i class="icon-header"></i><?php _e('Header Absolute','goalklub'); ?></a></li>
                 					<?php }?>
									
									
									
									
                                    
                                                                        
                                                                        <li><a href="#tab-subheader-options" data-toggle="tab"><i class="icon-indent"></i><?php _e('Sub Header','goalklub'); ?></a></li>
                                                                        <?php if($cs_builtin_seo_fields == 'on'){?>
									<li><a href="#tab-seo-advance-settings" data-toggle="tab"><i class="icon-dribbble6"></i><?php _e('Seo Options','goalklub'); ?></a></li>
									<?php }?>
                                                                        
                                                                        <li><a href="#tab-general-settings" data-toggle="tab"><i class="icon-gear"></i><?php _e('General','goalklub'); ?></a></li>
                                                                        
                                                                        
                                                                        
                                                                        
                                  
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
                            <div id="tab-players-settings-cs-players" class="tab-pane fade active in">
								
                                <div class="clear"></div>
                                
                                <ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Position Name', 'goalklub'); ?></label>
                                  </li>
                                  <li class="to-field short-field">
                                    <input type="text" id="cs_player_position_name" name="cs_player_position_name" value="<?php if(isset($cs_player_position_name) && $cs_player_position_name <> '') echo cs_allow_special_char($cs_player_position_name)?>" />
                                  </li>
                                </ul>
                                
                                <ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Position no.', 'goalklub'); ?></label>
                                  </li>
                                  <li class="to-field short-field">
                                    <input type="text" id="cs_player_position_no" name="cs_player_position_no" value="<?php if(isset($cs_player_position_no) && $cs_player_position_no <> '') echo cs_allow_special_char($cs_player_position_no)?>" />
                                  </li>
                                </ul>
                                
                                <ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Facebook', 'goalklub'); ?></label>
                                  </li>
                                  <li class="to-field short-field">
                                    <input type="text" id="cs_player_facebook_link" name="cs_player_facebook_link" value="<?php if(isset($cs_player_facebook_link) && $cs_player_facebook_link <> '') echo cs_allow_special_char($cs_player_facebook_link)?>" />
                                  </li>
                                </ul>
                                
                                <ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Twitter', 'goalklub'); ?></label>
                                  </li>
                                  <li class="to-field short-field">
                                    <input type="text" id="cs_player_twitter_link" name="cs_player_twitter_link" value="<?php if(isset($cs_player_twitter_link) && $cs_player_twitter_link <> '') echo cs_allow_special_char($cs_player_twitter_link)?>" />
                                  </li>
                                </ul>
                                
                                <ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Google Plus', 'goalklub'); ?></label>
                                  </li>
                                  <li class="to-field short-field">
                                    <input type="text" id="cs_player_google_link" name="cs_player_google_link" value="<?php if(isset($cs_player_google_link) && $cs_player_google_link <> '') echo cs_allow_special_char($cs_player_google_link)?>" />
                                  </li>
                                </ul>
                                
                                <ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Pinterest', 'goalklub'); ?></label>
                                  </li>
                                  <li class="to-field short-field">
                                    <input type="text" id="cs_player_pintrest_link" name="cs_player_pintrest_link" value="<?php if(isset($cs_player_pintrest_link) && $cs_player_pintrest_link <> '') echo cs_allow_special_char($cs_player_pintrest_link)?>" />
                                  </li>
                                </ul>
                                
                                <ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Mail', 'goalklub'); ?></label>
                                  </li>
                                  <li class="to-field short-field">
                                    <input type="text" id="cs_player_mail_link" name="cs_player_mail_link" value="<?php if(isset($cs_player_mail_link) && $cs_player_mail_link <> '') echo cs_allow_special_char($cs_player_mail_link)?>" />
                                  </li>
                                </ul>
                                
                            </div>
                            
                            <div id="tab-players-settings-cs-dynamic-fields" class="tab-pane fade">
                            	<?php cs_team_dynamic_fields_section(); ?>
                            </div>
                            
 						  </div>
						</div>
					  </div>
					</div>
				<input type="hidden" name="csplayer_meta_form" value="1" />
			</div>
		</div>
		<div class="clear"></div>
	<?php 
    }
 	// Course Meta option save
	if ( isset($_POST['csplayer_meta_form']) and $_POST['csplayer_meta_form'] == 1 ) {
		add_action( 'save_post', 'cs_meta_player_save' );  
		function cs_meta_player_save( $post_id ){  
			$sxe = new SimpleXMLElement("<player></player>");
			if (empty($_POST['cs_player_position_name'])){ $_POST['cs_player_position_name'] = '';}
			if (empty($_POST['cs_player_position_no'])){ $_POST['cs_player_position_no'] = '';}
			if (empty($_POST['cs_player_facebook_link'])){ $_POST['cs_player_facebook_link'] = '';}
			if (empty($_POST['cs_player_twitter_link'])){ $_POST['cs_player_twitter_link'] = '';}
			if (empty($_POST['cs_player_google_link'])){ $_POST['cs_player_google_link'] = '';}
			if (empty($_POST['cs_player_pintrest_link'])){ $_POST['cs_player_pintrest_link'] = '';}
			if (empty($_POST['cs_player_mail_link'])){ $_POST['cs_player_mail_link'] = '';}			
			$sxe->addChild('cs_player_position_name', $_POST['cs_player_position_name']);
			$sxe->addChild('cs_player_position_no', $_POST['cs_player_position_no']);
			$sxe->addChild('cs_player_facebook_link', $_POST['cs_player_facebook_link']);
			$sxe->addChild('cs_player_twitter_link', $_POST['cs_player_twitter_link']);
			$sxe->addChild('cs_player_google_link', $_POST['cs_player_google_link']);
			$sxe->addChild('cs_player_pintrest_link', $_POST['cs_player_pintrest_link']);
			$sxe->addChild('cs_player_mail_link', $_POST['cs_player_mail_link']);			
			$dynamic_fields_counter = 0;
			if (isset($_POST['dynamic_post_dynamic_fields']) && $_POST['dynamic_post_dynamic_fields'] == '1' && isset($_POST['dynamic_fields_title_array']) && is_array($_POST['dynamic_fields_title_array'])) {
				foreach ( $_POST['dynamic_fields_title_array'] as $type ){
					$dynamic_fields_list = $sxe->addChild('dynamic_fieldss');
					$dynamic_fields_list->addChild('dynamic_fields_title', htmlspecialchars($_POST['dynamic_fields_title_array'][$dynamic_fields_counter]) );
					$dynamic_fields_list->addChild('dynamic_fields_description', htmlspecialchars($_POST['dynamic_fields_description_array'][$dynamic_fields_counter]) );
					$dynamic_fields_counter++;
				}
			}			
			$sxe = cs_page_options_save_xml($sxe);			
			update_post_meta( $post_id, 'player', $sxe->asXML() );	
		}
	}
		// adding Player meta info end

 ?>