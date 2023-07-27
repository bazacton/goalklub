<?php
/**
 * File Type: Blog Shortcode
 */
//======================================================================
// Adding Blog Posts Start
//======================================================================
if (!function_exists('cs_blog_shortcode')) {
	function cs_blog_shortcode( $atts ) {
		global $post,$wpdb,$cs_theme_options,$cs_counter_node,$cs_xmlObject;
		$defaults = array('cs_blog_section_title'=>'','cs_blog_view'=>'','cs_blog_cat'=>'','cs_blog_orderby'=>'DESC','orderby'=>'ID','cs_blog_description'=>'yes','cs_blog_excerpt'=>'255','cs_blog_num_post'=>'10','blog_pagination'=>'','cs_blog_class' => '','cs_blog_animation' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		
		$CustomId	= '';
		if ( isset( $cs_blog_class ) && $cs_blog_class ) {
			$CustomId	= 'id="'.$cs_blog_class.'"';
		}
		
		if ( trim($cs_blog_animation) !='' ) {
			$cs_custom_animation	= 'wow'.' '.$cs_blog_animation;
		} else {
			$cs_custom_animation	= '';
		}
		$owlcount = rand(40, 9999999);
		$cs_counter_node++;
		ob_start();
		
		if (isset($cs_xmlObject->sidebar_layout) && $cs_xmlObject->sidebar_layout->cs_page_layout <> '' and $cs_xmlObject->sidebar_layout->cs_page_layout <> "none"){				
				$cs_blog_layout = 'col-md-4';
		}else{
				$cs_blog_layout = 'col-md-3';	
		}
		
		if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;

		$cs_blog_num_post	= $cs_blog_num_post ? $cs_blog_num_post : '-1';
		
		$args = array('posts_per_page' => "-1", 'post_type' => 'post', 'order' => $cs_blog_orderby, 'orderby' => $orderby, 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
		
		if(isset($cs_blog_cat) && $cs_blog_cat <> '' &&  $cs_blog_cat <> '0'){
			$blog_category_array = array('category_name' => "$cs_blog_cat");
			$args = array_merge($args, $blog_category_array);
		}
		

		$query = new WP_Query( $args );
		$count_post = $query->post_count;
		
		$cs_blog_num_post	= $cs_blog_num_post ? $cs_blog_num_post : '-1';
		$args = array('posts_per_page' => "$cs_blog_num_post", 'post_type' => 'post', 'paged' => $_GET['page_id_all'], 'order' => $cs_blog_orderby, 'orderby' => $orderby, 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
		
		if(isset($cs_blog_cat) && $cs_blog_cat <> '' &&  $cs_blog_cat <> '0'){
			$blog_category_array = array('category_name' => "$cs_blog_cat");
			$args = array_merge($args, $blog_category_array);
		}
		
		if ( $cs_blog_cat !='' && $cs_blog_cat !='0'){ 
			$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $cs_blog_cat ));
		}

		$section_title  = '';
		
		if(isset($cs_blog_section_title) && trim($cs_blog_section_title) <> ''){
			$section_title = '<div class="main-title"><div data-test="abc" class="cs-section-title"><h2>'.$cs_blog_section_title.'</h2></div></div>';
		}
			cs_addthis_script_init_method();
		$randomId = cs_generate_random_string('10');
		
		$query 		= new WP_Query( $args );
		$post_count = $query->post_count;
		
		echo cs_allow_special_char($section_title);
		
		if ( isset( $cs_blog_view ) && $cs_blog_view == 'home-list' ) {
			echo '<div class="col-md-12"><div class="widget widget_blog"><ul>';
		}
		
		
		if ( $query->have_posts() ) {  
			$postCounter	= 0;
					 
					  $blogObject	= new CS_BlogTemplates();
					 ?> <div class="row"> <?php
                      while ( $query->have_posts() )  : $query->the_post();
					  		
					  $postCounter++;
					  $last_child = ( $post_count == $postCounter ) ? 'last_child' : '' ;
							if ( $cs_blog_view == 'blog-grid' ) {
								$blogObject->cs_grid_view( $cs_blog_description , $cs_blog_excerpt , $cs_blog_cat , $cs_blog_layout);
							} else if ( $cs_blog_view == 'home-grid' ) {
								$blogObject->cs_home_grid_view( $cs_blog_description , $cs_blog_excerpt , $cs_blog_cat , $cs_blog_layout);
							} else if ( $cs_blog_view == 'home-list' ) {
								$blogObject->cs_home_list_view( $cs_blog_description , $cs_blog_excerpt , $cs_blog_cat , $cs_blog_layout);
							} else if ( $cs_blog_view == 'blog-medium' ) {
								$blogObject->cs_medium_view( $cs_blog_description , $cs_blog_excerpt , $cs_blog_cat );
							} else if ( $cs_blog_view == 'blog-lrg' ) {
								$blogObject->cs_large_view( $cs_blog_description , $cs_blog_excerpt , $cs_blog_cat);
							} else {
								$blogObject->cs_medium_view( $cs_blog_description , $cs_blog_excerpt , $cs_blog_cat);
							}
						
					  endwhile;
					  wp_reset_query();
						  //==Pagination Start
							 if ( $blog_pagination == "Show Pagination" && $count_post > $cs_blog_num_post && $cs_blog_num_post > 0 ) {
								$qrystr = '';
								 if ( isset($_GET['page_id']) ) $qrystr .= "&amp;page_id=".$_GET['page_id'];
								 echo cs_pagination($count_post, $cs_blog_num_post,$qrystr,'Show Pagination');
							 }
						 //==Pagination End	
						?>
					</div>	
					<?php				
              }
            
			if ( isset( $cs_blog_view ) && $cs_blog_view == 'home-list' ) {
				echo '</ul></div></div>';
			}
		    
			wp_reset_postdata();	
                
            $post_data = ob_get_clean();
            return $post_data;
         }
    if(function_exists('cs_shortcode_add')){
        cs_shortcode_add( 'cs_blog', 'cs_blog_shortcode' );
	}
}
