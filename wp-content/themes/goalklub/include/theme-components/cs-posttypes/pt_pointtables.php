<?php
	require_once 'pt_functions.php';

	//adding columns start
    add_filter('manage_pointtable_posts_columns', 'pointtable_columns_add');
	function pointtable_columns_add($columns) {
		$columns['author'] =__('Author','goalklub');
		return $columns;
	}
    add_action('manage_pointtable_posts_custom_column', 'pointtable_columns');
	function pointtable_columns($name) {
		global $post;
		switch ($name) {
			case 'author':
				echo get_the_author();
				break;
		}
	}
	//adding columns end
	if ( ! function_exists( 'cs_pointtable_register' ) ) {
		function cs_pointtable_register() {
			$labels = array(
				'name' =>__('Point Tables','goalklub'),
				'all_items' => __('Point Tables','goalklub'),
				'add_new_item' =>__('Add New Point Table','goalklub'),
				'edit_item' =>__('Edit Point Table','goalklub'),
				'new_item' =>__('New Point Table Item','goalklub'),
				'add_new' =>__('Add New Point Table','goalklub'),
				'view_item' =>__('View Point Table Item','goalklub'),
				'search_items' =>__('Search Point Table','goalklub'),
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
				'menu_icon' => 'dashicons-feedback',
				'rewrite' => true,
				'capability_type' => 'post',
				'has_archive' => false,
				'map_meta_cap' => true,
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title')
			);
            if (function_exists('cs_register_post_type')) {
                cs_register_post_type('pointtable' , $args );
            }

		}
		add_action('init', 'cs_pointtable_register');
	}
		// adding Category start
		  $labels = array(
			'name' => 'Categories',
			'search_items' =>__('Search Point Table Categories','goalklub'),
			'edit_item' =>__('Edit Point Table Category','goalklub'),
			'update_item' =>__('Update Point Table Category','goalklub'),
			'add_new_item' =>__('Add New Category','goalklub'),
			'menu_name' => 'Categories',
		  );
if (function_exists('cs_register_taxonomy')) {
    cs_register_taxonomy('pointtable-category',array('pointtable'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'show_admin_column' => true,
        'rewrite' => array( 'slug' => 'pointtable-category' ),
    ));
}
		// adding Category end		

	// adding Point Table meta info start
    if (function_exists('cs_meta_boxes')) {
        cs_meta_boxes('cs_meta_pointtable_add');
    }

	function cs_meta_pointtable_add(){
        if (function_exists('cs_meta_box')) {
            cs_meta_box('cs_meta_pointtable', __('Point Table Options','goalklub'), 'cs_meta_pointtable', 'pointtable', 'normal', 'high');
        }
	}
	function cs_meta_pointtable( $post ) {
		global $post, $cs_xmlObject, $cs_theme_options;
		//$cs_theme_options = get_option('cs_theme_options');
		$cs_builtin_seo_fields = $cs_theme_options['cs_builtin_seo_fields'];
		$cs_header_position = $cs_theme_options['cs_header_position'];
		$cs_pointtable = get_post_meta($post->ID, "pointtable", true);
		if ( $cs_pointtable <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($cs_pointtable);
			$cs_pointtable_records_per_post = $cs_xmlObject->cs_pointtable_records_per_post;
			$cs_pointtable_view_all = $cs_xmlObject->cs_pointtable_view_all;
			$cs_pointtable_set = $cs_xmlObject->cs_pointtable_set;
			
		} else {
			$cs_pointtable_records_per_post = '';
			$cs_pointtable_view_all = '';
			$cs_pointtable_set = '';
			
			if(!isset($cs_xmlObject))
				$cs_xmlObject = new stdClass();
		}
				
		?>		
		<div class="page-wrap page-opts left" style="overflow:hidden; position:relative; height: 1432px;">
			<div class="option-sec" style="margin-bottom:0;">
				<div class="opt-conts">
					<div class="elementhidden">
						<div class="tabs vertical">
							<nav class="admin-navigtion">
								<ul id="myTab" class="nav nav-tabs">
									<li class="active"><a href="#tab-general-settings" data-toggle="tab"><i class="icon-cog"></i><?php _e('General','goalklub'); ?></a></li>
									<li><a href="#tab-subheader-options" data-toggle="tab"><i class="icon-indent"></i><?php _e('Sub Header','goalklub'); ?></a></li>
									<?php if($cs_header_position == 'absolute'){?>
                 						<li><a href="#tab-header-position-settings" data-toggle="tab"><i class="icon-header"></i><?php _e('Header Absolute','goalklub'); ?></a></li>
                 					<?php }?>
									<?php if($cs_builtin_seo_fields == 'on'){?>
									<li><a href="#tab-seo-advance-settings" data-toggle="tab"><i class="icon-dribbble6"></i><?php _e('Seo Options','goalklub'); ?></a></li>
									<?php }?>
                                    <li><a data-toggle="tab" href="#tab-pointtables-settings-cs-pointtables"><i class="icon-briefcase"></i><?php _e('Point Table Options','goalklub'); ?></a></li>
                                    <li><a data-toggle="tab" href="#tab-pointtables-settings-cs-dynamic-fields"><i class="icon-briefcase"></i><?php _e('Point Table Fields','goalklub'); ?></a></li>
 							  </ul>
						  </nav>
							<div class="tab-content">
							<div id="tab-subheader-options" class="tab-pane fade">
								<?php cs_subheader_element();?>
							</div>
							<div id="tab-general-settings" class="tab-pane fade active in">
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
                            <div id="tab-pointtables-settings-cs-pointtables" class="tab-pane fade">
								
                                <div class="clear"></div>
                                <ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Record Per Post', 'goalklub'); ?></label>
                                  </li>
                                  <li class="to-field short-field">
                                    <input type="text" id="cs_pointtable_records_per_post" name="cs_pointtable_records_per_post" value="<?php if(isset($cs_pointtable_records_per_post) && $cs_pointtable_records_per_post <> '') echo cs_allow_special_char($cs_pointtable_records_per_post)?>" />
                                  </li>
                                </ul>
                                
                                <ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('View All Url', 'goalklub'); ?></label>
                                  </li>
                                  <li class="to-field short-field">
                                    <input type="text" id="cs_pointtable_view_all" name="cs_pointtable_view_all" value="<?php if(isset($cs_pointtable_view_all) && $cs_pointtable_view_all <> '') echo cs_allow_special_char($cs_pointtable_view_all)?>" />
                                  </li>
                                </ul>
                                
                            </div>
                            
                            <div id="tab-pointtables-settings-cs-dynamic-fields" class="tab-pane fade">
                            	<ul class="form-elements">
                                  <li class="to-label">
                                    <label><?php _e('Point Table Columns','goalklub');?></label>
                                  </li>
                                  <li class="to-field">
                                    <div class="input-sec">
                                      <?php
									   $falg = false; 
									   if($cs_pointtable_set != '' && $cs_theme_options['table_points_columns'] != '' && is_array($cs_theme_options['table_points_columns']) && in_array($cs_pointtable_set, $cs_theme_options['table_points_columns'])){
											$falg = true;
										 }
									  if ( isset($cs_xmlObject->point_tables) and count($cs_xmlObject->point_tables)>0 and $falg) {
									  ?>
                                      <input type="text" name="cs_pointtable_set" readonly="readonly" value="<?php if(isset($cs_pointtable_set) && $cs_pointtable_set <> '') echo cs_allow_special_char($cs_pointtable_set)?>" />
                                      <div class="left-info"><p><?php _e('Table Heading name. If you want to change table columns heading, Then you have to delete the points','goalklub');?></p></div>
									  <?php
									  }
									  else{
									  ?>
                                      <div class="select-style">
                                        <select name="cs_pointtable_set" class="dropdown" onchange="cs_point_table_seleted(this.value, '<?php echo esc_js(admin_url('admin-ajax.php'));?>', '<?php echo esc_js(get_template_directory_uri());?>')">
                                          <?php 
										  if(isset($cs_theme_options['table_points_columns']) and is_array($cs_theme_options['table_points_columns']) and $cs_theme_options['table_points_columns'] <> ''){
											  $i=0;
                                              $selected = '';
                                              if(count($cs_theme_options['table_points_columns']) == 1){
                                                  $selected = 'selected="selected"';
                                              }
                                              echo '<option '.$selected.'>'.__('Please Select', 'goalklub').'</option>';
											  foreach ( $cs_theme_options['table_points_columns'] as $columns ){
										  ?>
                                                  <option<?php if($cs_pointtable_set == $columns) { echo ' selected'; } ?>><?php echo cs_allow_special_char($columns); ?></option>
                                          <?php
												  $i++;
											  }
										  }
										  ?>
                                        </select>
                                      </div>
                                      <?php
									  }
									  ?>
                                    </div>
                                  </li>
                                </ul>
                                <?php
								if ( isset($cs_xmlObject->point_tables) and count($cs_xmlObject->point_tables)>0 and $falg) {
									cs_point_tables_section($cs_pointtable_set); 
								}
								else{
									echo '<div id="total_selected_pointtable_fields"></div>';
								}
								?>
                            </div>
                            
 						  </div>
						</div>
					  </div>
					</div>
				<input type="hidden" name="cspointtable_meta_form" value="1" />
			</div>
		</div>
		<div class="clear"></div>
	<?php 
    }
 	// Course Meta option save
	if ( isset($_POST['cspointtable_meta_form']) and $_POST['cspointtable_meta_form'] == 1 ) {
		add_action( 'save_post', 'cs_meta_pointtable_save' );  
		function cs_meta_pointtable_save( $post_id ){  
			$sxe = new SimpleXMLElement("<pointtable></pointtable>");
			if (empty($_POST['cs_pointtable_records_per_post'])){ $_POST['cs_pointtable_records_per_post'] = '';}
			if (empty($_POST['cs_pointtable_view_all'])){ $_POST['cs_pointtable_view_all'] = '';}
			if (empty($_POST['cs_pointtable_set'])){ $_POST['cs_pointtable_set'] = '';}
			
			
			$sxe->addChild('cs_pointtable_records_per_post', $_POST['cs_pointtable_records_per_post']);
			$sxe->addChild('cs_pointtable_view_all', $_POST['cs_pointtable_view_all']);
			$sxe->addChild('cs_pointtable_set', $_POST['cs_pointtable_set']);
			
			$point_table_counter = 0;
			if (isset($_POST['cs_pointtable_fields']) && $_POST['cs_pointtable_fields'] == '1' && isset($_POST['point_table_column_title1_array']) && is_array($_POST['point_table_column_title1_array'])) {
				foreach ( $_POST['point_table_column_title1_array'] as $type ){
					$point_table_list = $sxe->addChild('point_tables');
					
					if (!isset($_POST['point_table_column_title1_array'][$point_table_counter])){ $_POST['point_table_column_title1_array'][$point_table_counter] = '';}
					if (!isset($_POST['point_table_column_title2_array'][$point_table_counter])){ $_POST['point_table_column_title2_array'][$point_table_counter] = '';}
					if (!isset($_POST['point_table_column_title3_array'][$point_table_counter])){ $_POST['point_table_column_title3_array'][$point_table_counter] = '';}
					if (!isset($_POST['point_table_column_title4_array'][$point_table_counter])){ $_POST['point_table_column_title4_array'][$point_table_counter] = '';}
					if (!isset($_POST['point_table_column_title5_array'][$point_table_counter])){ $_POST['point_table_column_title5_array'][$point_table_counter] = '';}
					if (!isset($_POST['point_table_column_title6_array'][$point_table_counter])){ $_POST['point_table_column_title6_array'][$point_table_counter] = '';}
					if (!isset($_POST['point_table_column_title7_array'][$point_table_counter])){ $_POST['point_table_column_title7_array'][$point_table_counter] = '';}
					if (!isset($_POST['point_table_column_title8_array'][$point_table_counter])){ $_POST['point_table_column_title8_array'][$point_table_counter] = '';}
					if (!isset($_POST['point_table_column_title9_array'][$point_table_counter])){ $_POST['point_table_column_title9_array'][$point_table_counter] = '';}
					if (!isset($_POST['point_table_column_title10_array'][$point_table_counter])){ $_POST['point_table_column_title10_array'][$point_table_counter] = '';}
					if (!isset($_POST['point_table_column_feature_array'][$point_table_counter])){ $_POST['point_table_column_feature_array'][$point_table_counter] = '';}
					
					$point_table_list->addChild('point_table_column_title1', htmlspecialchars($_POST['point_table_column_title1_array'][$point_table_counter]) );
					$point_table_list->addChild('point_table_column_title2', htmlspecialchars($_POST['point_table_column_title2_array'][$point_table_counter]) );
					$point_table_list->addChild('point_table_column_title3', htmlspecialchars($_POST['point_table_column_title3_array'][$point_table_counter]) );
					$point_table_list->addChild('point_table_column_title4', htmlspecialchars($_POST['point_table_column_title4_array'][$point_table_counter]) );
					$point_table_list->addChild('point_table_column_title5', htmlspecialchars($_POST['point_table_column_title5_array'][$point_table_counter]) );
					$point_table_list->addChild('point_table_column_title6', htmlspecialchars($_POST['point_table_column_title6_array'][$point_table_counter]) );
					$point_table_list->addChild('point_table_column_title7', htmlspecialchars($_POST['point_table_column_title7_array'][$point_table_counter]) );
					$point_table_list->addChild('point_table_column_title8', htmlspecialchars($_POST['point_table_column_title8_array'][$point_table_counter]) );
					$point_table_list->addChild('point_table_column_title9', htmlspecialchars($_POST['point_table_column_title9_array'][$point_table_counter]) );
					$point_table_list->addChild('point_table_column_title10', htmlspecialchars($_POST['point_table_column_title10_array'][$point_table_counter]) );
					$point_table_list->addChild('point_table_column_feature', htmlspecialchars($_POST['point_table_column_feature_array'][$point_table_counter]) );
					$point_table_counter++;
				}
				
			}
			
			$sxe = cs_page_options_save_xml($sxe);
			
			update_post_meta( $post_id, 'pointtable', $sxe->asXML() );
	
		}
	}
		// adding Point Table meta info end

 ?>