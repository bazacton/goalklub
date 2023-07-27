<?php
/**
 * The template for displaying Achive(s) pages
 *
 * @package LMS
 * @since LMS  1.0
 * @Auther Chimp Solutions
 * @copyright Copyright (c) 2014, Chimp Studio 
 */
 
	get_header();

	global $cs_node,$cs_theme_options,$cs_counter_node;
	
	$cs_layout 	= '';
			if(isset($cs_theme_options['cs_excerpt_length']) && $cs_theme_options['cs_excerpt_length'] <> ''){ $default_excerpt_length = $cs_theme_options['cs_excerpt_length']; }else{ $default_excerpt_length = '255';}; 
			
			$cs_layout =isset($cs_theme_options['cs_default_page_layout'])? $cs_theme_options['cs_default_page_layout']:'col-md-12';
			if ( isset( $cs_layout ) && $cs_layout == "sidebar_left") {
				$cs_layout = "content-right col-md-9";
				$custom_height = 390;
			} else if ( isset( $cs_layout ) && $cs_layout == "sidebar_right" ) {
				$cs_layout = "content-left col-md-9";
				$custom_height = 390;
			} else {
				$cs_layout = "col-md-12";
				$custom_height = 390;
			}
			$cs_sidebar	= $cs_theme_options['cs_default_layout_sidebar'];
			
			$cs_tags_name = 'post_tag';
			$cs_categories_name = 'category';
 ?>
	<!-- PageSection Start -->
    <section class="page-section" style=" padding: 0; ">
        <!-- Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
			 	<!--Left Sidebar Starts-->
				<?php if ($cs_layout == 'content-right col-md-9'){ ?>
                    <div class="content-lt col-md-3"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar) ) : ?><?php endif; ?></div>
                <?php } ?>
                <!--Left Sidebar End-->
                
    			<!-- Page Detail Start -->
       			<div class="<?php echo esc_attr($cs_layout); ?>">

                <!-- Blog Post Start -->
                 <?php 
				 
				 					
				 
				 if(is_author()){
					 global $author;
					 $userdata = get_userdata($author);
				 }
				 if(category_description() || is_tag() || (is_author() && isset($userdata->description) && !empty($userdata->description))){
					echo '<div class="widget evorgnizer">';
					if(is_author()){?>
                            <figure><a><?php echo get_avatar($userdata->user_email, apply_filters('CS_author_bio_avatar_size', 70));?></a></figure>
                            <div class="left-sp">
                                <h5><a><?php echo esc_attr($userdata->display_name); ?></a></h5>
                                <p><?php echo force_back($userdata->description, true); ?></p>
                            </div>
					<?php } elseif ( is_category()) {
							$category_description = category_description();
							if ( ! empty( $category_description ) ) {
							?>
							<div class="left-sp">
                                <p><?php  echo category_description();?></p>
                            </div>
                           <?php }?>
					<?php } elseif(is_tag()){  
							$tag_description = tag_description();
							if ( ! empty( $tag_description ) ) {
							?>
							<div class="left-sp">
                                <p><?php echo apply_filters( 'tag_archive_meta', $tag_description );?></p>
                            </div>
						<?php }
					}
					echo '</div>';
				}
                    if (empty($_GET['page_id_all']))
                        $_GET['page_id_all'] = 1;
                    if (!isset($_GET["s"])) {
                        $_GET["s"] = '';
                    }
	
					$description = 'yes';
					$taxonomy = 'category';
					$taxonomy_tag = 'post_tag';
					$args_cat = array();
					
					if(is_author()){
						$args_cat = array('author' => $wp_query->query_vars['author']);
						$post_type = array( 'post', 'player','match','pointtable');
						
					} elseif(is_date()){
						
						if(is_month() || is_year() || is_day() || is_time()){

							$args_cat = array('monthnum' => $wp_query->query_vars['monthnum'],'year' => $wp_query->query_vars['year'],'day' => $wp_query->query_vars['day'],'hour' => $wp_query->query_vars['hour'], 'minute' => $wp_query->query_vars['minute'], 'second' => $wp_query->query_vars['second']);
							
						}


						
						$post_type = array( 'post');
						
					} else if ((isset( $wp_query->query_vars['taxonomy']) && !empty( $wp_query->query_vars['taxonomy'] )) ) {

						$taxonomy = $wp_query->query_vars['taxonomy'];
						$taxonomy_category='';
						$taxonomy_category=$wp_query->query_vars[$taxonomy];
						
						if ( $wp_query->query_vars['taxonomy']=='match-category' || $wp_query->query_vars['taxonomy']=='match-tag') {
							
						  $args_cat = array( $taxonomy => $taxonomy_category);
						  $post_type = 'match';
						  
						} else if ( $wp_query->query_vars['taxonomy']=='player-team' || $wp_query->query_vars['taxonomy']=='player-department' || $wp_query->query_vars['taxonomy']=='player-tag') {
							
						  $args_cat = array( $taxonomy => "$taxonomy_category");
						  $post_type='player';
						  
						} else {
							
							$taxonomy = 'category';
							$args_cat = array();
							$post_type='post';
							
						}
						
					} else if( is_category() ) {
						
						$taxonomy = 'category';
						$args_cat = array();
						$category_blog = $wp_query->query_vars['cat'];
						$post_type='post';
						$args_cat = array( 'cat' => "$category_blog");
					
					} else if ( is_tag() ) {
						
						$taxonomy = 'category';
						$args_cat = array();
						$tag_blog = $wp_query->query_vars['tag'];
						$post_type='post';
						$args_cat = array( 'tag' => "$tag_blog");
					
					} else {
						$taxonomy = 'category';
						$args_cat = array();
						$post_type='post';
					}
					
					$args = array( 
					'post_type'		 => $post_type, 
					'paged'			 => $_GET['page_id_all'],
					'post_status'	 => 'publish', 
					'order'			 => 'ASC',
				);
				
				$args = array_merge( $args_cat, $args );

				$custom_query = new WP_Query( $args );	

				
                 ?>
                <?php 
				
					if ( $custom_query->have_posts() ): 
						cs_addthis_script_init_method();
					?>
					<div class="row">
					<?php
				    while ( $custom_query->have_posts() ) : $custom_query->the_post();
					
					$noImage		= '';
					$width 			= '360';
					$height 		= '360';
					$title_limit 	= 1000;
					
					$cs_excerpt_len = isset($cs_theme_options['cs_excerpt_length'])?$cs_theme_options['cs_excerpt_length']:'255';
					$thumbnail 		= cs_get_post_img_src( $post->ID, $width, $height );
							
					if ( $thumbnail =='' ){
						$noImage	= 'no-image';
					}
					?> 
					
                    <div class="col-md-12">
                      <div class="cs-blog blog-medium <?php echo cs_allow_special_char($noImage);?>">
                      <?php
                                if ( isset( $thumbnail ) && $thumbnail !='' ) {	?>
                                    <div class="cs-media">
                                      <figure>
                                        <a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a>
                                      </figure>
                                    </div>
							   <?php
								}
							   ?>
                            <section>
                                <div class="title">
									
                                <ul class="post-option">
                                   <li><?php cs_featured(); ?><time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date()));?></time></li>
                                </ul>
									
                                <h4><a href="<?php echo the_permalink();?>"><?php echo the_title();?></a></h4>
                                </div>
                                <div class="blog-text">	                              
                                   <p> <?php echo cs_get_the_excerpt($cs_excerpt_len,'ture','');?></p>
                                  <div class="cs-seprator">
                                                    <div class="devider1"></div>
                                                  </div>
                                  <?php  $categories_list = get_the_term_list ( get_the_id(), 'category', '' , ', ', '' ); 
                                           if ( $categories_list ){
                                      ?>
                                  <ul class="post-option">
                                               <?php 
                                     /* Get All Cats */
                                     
                                          echo '<li>';
                                        printf( __( '%1$s', 'goalklub'),$categories_list );
                                        echo ' </li>';
                                         // End if Cats 
                                  ?>
                                </ul>
                                  <?php }
								  
                                  ?>
                                  <a class="btnshare addthis_button_compact" href="#"><i class="icon-export"></i></a>
                                </div>	
                            </section>
					  </div>
                </div>
               
						
                <?php endwhile; 
				wp_reset_query();
				else:
					if ( function_exists( 'cs_fnc_no_result_found' ) ) { cs_fnc_no_result_found(); }
				endif; 
				 
				?>
        		
                <?php
				
					 $qrystr = '';
					// pagination start
						if ($custom_query->found_posts > get_option('posts_per_page')) {
						 if ( isset($_GET['page_id']) ) $qrystr .= "&page_id=".$_GET['page_id'];
						 if ( isset($_GET['author']) ) $qrystr .= "&author=".$_GET['author'];
						 if ( isset($_GET['tag']) ) $qrystr .= "&tag=".$_GET['tag'];
						 if ( isset($_GET['cat']) ) $qrystr .= "&cat=".$_GET['cat'];
						 if ( isset($_GET['match-category']) ) $qrystr .= "&match-category=".$_GET['match-category'];
						 if ( isset($_GET['match-tag']) ) $qrystr .= "&match-tag=".$_GET['match-tag'];
						 if ( isset($_GET['player-team']) ) $qrystr .= "&player-team=".$_GET['player-team'];
						 if ( isset($_GET['player-tag']) ) $qrystr .= "&player-tag=".$_GET['player-tag'];

						 if ( isset($_GET['m']) ) $qrystr .= "&m=".$_GET['m'];
						 
						 if ( function_exists( 'cs_pagination' ) ) {  echo cs_pagination($custom_query->found_posts,get_option('posts_per_page'), $qrystr); }
								
						}
				?>
 </div>
           </div>
        		<!-- Page Detail End -->
                
                <!-- Right Sidebar Start -->
				<?php if ( $cs_layout  == 'content-left col-md-9'){ ?>
				
                   <div class="content-rt col-md-3"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar) ) : ?><?php endif; ?></div>
				   
                <?php } ?>
                <!-- Right Sidebar End -->
          </div>
        </div>
     </section>
<?php get_footer(); ?> 