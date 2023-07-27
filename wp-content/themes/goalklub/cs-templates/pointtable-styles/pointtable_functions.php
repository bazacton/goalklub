<?php
/**
 * File Type: Point Table Shortcode
 */
	

//======================================================================
// Adding Point Table Posts Start
//======================================================================
if (!function_exists('cs_point_table_shortcode')) {
	function cs_point_table_shortcode( $atts ) {
		global $post,$wpdb,$cs_theme_options,$cs_counter_node,$cs_xmlObject;
		$defaults = array('cs_point_table_section_title'=>'','cs_point_table_category' =>'','cs_point_table_filter' =>'','cs_point_table_order'=>'DESC','orderby'=>'ID','cs_point_table_num_post'=>'10','point_table_pagination'=>'','cs_point_table_class' => '','cs_point_table_animation' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		
		$CustomId	= '';
		if ( isset( $cs_point_table_class ) && $cs_point_table_class ) {
			$CustomId	= 'id="'.$cs_point_table_class.'"';
		}
		
		if ( trim($cs_point_table_animation) !='' ) {
			$cs_custom_animation	= 'wow'.' '.$cs_point_table_animation;
		} else {
			$cs_custom_animation	= '';
		}
		$cs_counter_node++;
		ob_start();
		
		if (isset($cs_xmlObject->sidebar_layout) && $cs_xmlObject->sidebar_layout->cs_page_layout <> '' and $cs_xmlObject->sidebar_layout->cs_page_layout <> "none"){				
				$cs_point_table_layout = 'col-md-4';
		}else{
				$cs_point_table_layout = 'col-md-3';	
		}
				
		if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;

		$cs_point_table_num_post	= $cs_point_table_num_post ? $cs_point_table_num_post : '-1';

		$args = array(
			'posts_per_page' 			=> "$cs_point_table_num_post", 
			'post_type' 				=> 'pointtable', 
			'order' 					=> $cs_point_table_order, 
			'orderby' 					=> $orderby, 
			'post_status' 				=> 'publish'
		);
			
		if(isset($_GET['category']) && $_GET['category'] <> '' && $_GET['category'] <> '0'){
			$point_table_category = array('pointtable-category' => $_GET['category']);
			$args = array_merge($args, $point_table_category);
		}else{
			if(isset($cs_point_table_category) && $cs_point_table_category <> '' &&  $cs_point_table_category <> '0'){
				
				if($cs_point_table_filter == 'yes'){
					$first_table_category = '0';
					if(isset($cs_point_table_category) && $cs_point_table_category <> '' &&  $cs_point_table_category <> '0'){
						$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $cs_point_table_category ));
						$categories = get_categories( array('child_of' => "$row_cat->term_id", 'taxonomy' => 'pointtable-category', 'hide_empty' => 1));
					}
					else{
						$categories = get_categories( array('taxonomy' => 'pointtable-category', 'hide_empty' => 1) );
					}
					$counter_cats = 0;
					foreach ($categories as $category) {
						if($counter_cats == 0) $first_table_category = $category->slug;
						$counter_cats++;
					}
					
					$point_table_category = array('pointtable-category' => "$first_table_category");
				}
				else{
					$point_table_category = array('pointtable-category' => "$cs_point_table_category");
				}
				
				$args = array_merge($args, $point_table_category);
			}
		}
		
		$query = new WP_Query( $args );
		$count_post = $query->post_count;
		
		$cs_point_table_num_post = $cs_point_table_num_post ? $cs_point_table_num_post : '-1';

		$args = array(
			'posts_per_page'		=> "$cs_point_table_num_post", 
			'post_type'				=> 'pointtable', 
			'paged'					=> $_GET['page_id_all'], 
			'order'					=> $cs_point_table_order, 
			'orderby'				=> $orderby, 
			'post_status'			=> 'publish'
		);
		
		if(isset($_GET['category']) && $_GET['category'] <> '' && $_GET['category'] <> '0'){
			$point_table_category = array('pointtable-category' => $_GET['category']);
			$args = array_merge($args, $point_table_category);
		}else{
			if(isset($cs_point_table_category) && $cs_point_table_category <> '' &&  $cs_point_table_category <> '0'){
				if($cs_point_table_filter == 'yes'){
					$first_table_category = '0';
					if(isset($cs_point_table_category) && $cs_point_table_category <> '' &&  $cs_point_table_category <> '0'){
						$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $cs_point_table_category ));
						$categories = get_categories( array('child_of' => "$row_cat->term_id", 'taxonomy' => 'pointtable-category', 'hide_empty' => 1));
					}
					else{
						$categories = get_categories( array('taxonomy' => 'pointtable-category', 'hide_empty' => 1) );
					}
					$counter_cats = 0;
					foreach ($categories as $category) {
						if($counter_cats == 0) $first_table_category = $category->slug;
						$counter_cats++;
					}
					
					$point_table_category = array('pointtable-category' => "$first_table_category");
				}
				else{
					$point_table_category = array('pointtable-category' => "$cs_point_table_category");
				}
				$args = array_merge($args, $point_table_category);
			}
		}

		$outerDivStart	= '<div '.$CustomId.' class="col-md-12 '.$cs_custom_animation.'">';
		$outerDivEnd	= '</div>';
		$section_title  = '';
		
		if(isset($cs_point_table_section_title) && trim($cs_point_table_section_title) <> ''){
			$section_title = '<div class="cs-section-title"><h2>'.$cs_point_table_section_title.'</h2></div>';
		}
		
		$query = new WP_Query( $args );
		$post_count = $query->post_count;
				
				
		$admin_ajax_url = "'" . esc_js(admin_url('admin-ajax.php')) . "'";

		
		$all_atts = json_encode( $atts );
		$ac = "'" . $all_atts . "'";		
		
		
		if ( $query->have_posts() ) {
			$postCounter	= 0;
                    	
				echo cs_allow_special_char($outerDivStart);
				echo cs_allow_special_char( $section_title );
				
				if($cs_point_table_filter == 'yes'){
					if(isset($cs_point_table_category) && $cs_point_table_category <> '' &&  $cs_point_table_category <> '0'){
						$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $cs_point_table_category ));
						$categories = get_categories( array('child_of' => "$row_cat->term_id", 'taxonomy' => 'pointtable-category', 'hide_empty' => 1));
					} else {
						$categories = get_categories( array('taxonomy' => 'pointtable-category', 'hide_empty' => 1) );
					}
					echo '<nav class="filter-nav">
						<ul class="cs-filter-menu pull-left">';
							$counter_cats = 0;
							
							foreach ($categories as $category) {
								$term_id = $category->term_id;
								$cat_meta = get_option( "pointtable_cat_$term_id" );
								$cat_icon = '';
								if(isset($cat_meta['icon'])) $cat_icon = '<i class="'.$cat_meta['icon'].'"></i>';
								$active_class = '';
								if(isset($_GET['category']) && $_GET['category'] == $category->slug){
									$active_class = ' class="active"';
								}
								else{
									if(!isset($_GET['category']) && $counter_cats == 0) $active_class = ' class="active"';
								}
//								echo '<li'.$active_class.'><a   href="?category='.$category->slug.'">'.$cat_icon.$category->name.'</a></li>';
								echo '<li'.$active_class.'><a onclick="point_table_tabs(this, '.$admin_ajax_url.', '.htmlentities($ac).', '.$cs_point_table_num_post.');" data-slug="'.$category->slug.'" href="javascript:void(0);">'.$cat_icon.$category->name.'</a></li>';
								$counter_cats++;
							}
						echo '
						</ul>
					</nav>';
				}
			  
				echo "<div id='table_content'>";

				
				$point_tableObject	= new CS_PointTableTemplates();
				
				while ( $query->have_posts() ) : $query->the_post();

				$postCounter++;				
				
				$point_tableObject->cs_point_table_view($atts, $cs_point_table_num_post); 
				  
				endwhile;
				echo "</div>";
				
				
 				echo cs_allow_special_char( $outerDivEnd );
				//==Pagination Start
				if ( $point_table_pagination == "Show Pagination" && $count_post > $cs_point_table_num_post && $cs_point_table_num_post > 0 ) {
					$qrystr = '';
					if ( isset($_GET['page_id']) ) $qrystr .= "&amp;page_id=".$_GET['page_id'];
					if ( isset($_GET['category']) ) $qrystr .= "&amp;category=".$_GET['category'];
					echo cs_pagination($count_post, $cs_point_table_num_post,$qrystr,'Show Pagination');
				}
			   //==Pagination End	
            }
 			
		    wp_reset_postdata();
            
            $post_data = ob_get_clean();
            return $post_data;
         }
    if(function_exists('cs_shortcode_add')){
	cs_shortcode_add( 'cs_point_table', 'cs_point_table_shortcode' );
}
}


	function cs_point_table_ajax_based() {

		$atts = json_decode(stripslashes($_GET['atts']));

		$cs_point_table_num_post = $_GET['cs_point_table_num_post'] ;

		if(empty($cs_point_table_num_post))
		$cs_point_table_num_post = "-1";
				
		$args = array(
			'posts_per_page'		=> "$cs_point_table_num_post", 
			'post_type'				=> 'pointtable', 
			'paged'					=> $_GET['page_id_all'], 
			'order'					=> $cs_point_table_order, 
			'orderby'				=> $orderby, 
			'post_status'			=> 'publish'
		);
		
		if(isset($_GET['categorys']) && $_GET['categorys'] <> '' && $_GET['categorys'] <> '0'){
			$point_table_category = array('pointtable-category' => $_GET['categorys']);
			$args = array_merge($args, $point_table_category);		
		}
		
		$query = new WP_Query( $args );
		$post_count = $query->post_count;
		
		if($query->have_posts()){
		
		$postCounter = 0;
		$output = '';
		
//		$output .= "<div id='loader_div'></div>"; 
		
//		$output .= "<div id='holder-table' syle='position: relative; float: left; width: 100%;'>";
//		$output .= "<div id='overlay' syle='position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);'></div>";
		$point_tableObject = new CS_PointTableTemplates();
		
		while( $query->have_posts() ) {
			
			$query->the_post();
			$postCounter ++;
			$output .= $point_tableObject->cs_point_table_view( $atts, $cs_point_table_num_post );

		}
		
//		$output .= "</div>";
		 
		echo force_back($output) ;
				
		} 
		wp_die();
	}
	

add_action('wp_ajax_cs_point_table_ajax_based','cs_point_table_ajax_based' );
add_action('wp_ajax_nopriv_cs_point_table_ajax_based', 'cs_point_table_ajax_based' );
