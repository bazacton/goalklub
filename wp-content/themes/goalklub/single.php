<?php
/**
 * The template for displaying all single posts
 */
 	global $cs_node,$post,$cs_theme_options,$cs_counter_node;
	
	$cs_uniq = rand(40, 9999999);
	if ( is_single() ) {
		cs_set_post_views($post->ID);
	}	
	$cs_node = new stdClass();
  	get_header();
 	$cs_layout = '';
	$leftSidebarFlag	= false;
	$rightSidebarFlag	= false;
	?>
<!-- PageSection Start -->

<section class="page-section" style=" padding: 0; "> 
  <!-- Container -->
  <div class="container"> 
    <!-- Row -->
    <div class="row">
      <div class="section-fullwidth">
      <?php
	if (have_posts()):
		while (have_posts()) : the_post();	
		$cs_tags_name = 'post_tag';
		$cs_categories_name = 'category';
		$postname = 'post';
		$image_url = cs_get_post_img_src($post->ID, 844, 475);	

		$post_xml = get_post_meta($post->ID, "post", true);	
		
	
			if ( $post_xml <> "" ) {
			
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				
				$cs_layout 			= $cs_xmlObject->sidebar_layout->cs_page_layout;
				$cs_sidebar_left 	= $cs_xmlObject->sidebar_layout->cs_page_sidebar_left;
				$cs_sidebar_right   = $cs_xmlObject->sidebar_layout->cs_page_sidebar_right;
				if(isset($cs_xmlObject->cs_related_post))
					$cs_related_post = $cs_xmlObject->cs_related_post;
				else 
					$cs_related_post = '';
				
				if(isset($cs_xmlObject->cs_post_tags_show))
					$post_tags_show = $cs_xmlObject->cs_post_tags_show;
				else 
					$post_tags_show = '';
				
				if(isset($cs_xmlObject->post_social_sharing))
					$cs_post_social_sharing = $cs_xmlObject->post_social_sharing;
				else 
					$cs_post_social_sharing = '';
				
				if(isset($cs_xmlObject->cs_post_author_info_show))
					 $cs_post_author_info_show = $cs_xmlObject->cs_post_author_info_show;
				else 
					$cs_post_author_info_show = '';

				if ( $cs_layout == "left") {
					$cs_layout = "page-content blog-editor";
					$custom_height = 459;
					$leftSidebarFlag	= true;
				}
				else if ( $cs_layout == "right" ) {
					$cs_layout = "page-content blog-editor";
					$custom_height = 459;
					$rightSidebarFlag	= true;
				}
				else {
					$cs_layout = "col-md-12";
					$custom_height = 459;
				}
				$postname = 'post';
			}else{
				$cs_layout 	=  $cs_theme_options['cs_single_post_layout'];
				if ( isset( $cs_layout ) && $cs_layout == "sidebar_left") {
					$cs_layout = "page-content blog-editor";
					$cs_sidebar_left	= $cs_theme_options['cs_single_layout_sidebar'];
					$custom_height = 459;
					$leftSidebarFlag	= true;
				} else if ( isset( $cs_layout ) && $cs_layout == "sidebar_right" ) {
					$cs_layout = "page-content blog-editor";
					$cs_sidebar_right	= $cs_theme_options['cs_single_layout_sidebar'];
					$custom_height = 459;
					$rightSidebarFlag	= true;
				} else {
					$cs_layout = "col-md-12";
					$custom_height = 459;
				}
  				$post_pagination_show = 'on';
				$post_tags_show = '';
				$cs_related_post = '';
				$post_social_sharing = '';
				$post_social_sharing = '';
				$cs_post_author_info_show = '';
				$postname = 'post';
				$cs_post_social_sharing = '';
			}
			
			if ($post_xml <> "") {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$post_view = $cs_xmlObject->post_thumb_view;
				$inside_post_view = $cs_xmlObject->inside_post_thumb_view;
				$post_video = $cs_xmlObject->inside_post_thumb_video;
				$post_audio = $cs_xmlObject->inside_post_thumb_audio;
				$post_slider = $cs_xmlObject->inside_post_thumb_slider;
				$post_featured_image = $cs_xmlObject->inside_post_featured_image_as_thumbnail;
				$cs_related_post = $cs_xmlObject->cs_related_post;
				$cs_post_social_sharing = $cs_xmlObject->post_social_sharing;
				$post_tags_show = $cs_xmlObject->post_tags_show;
				$post_pagination_show = $cs_xmlObject->post_pagination_show;
				$cs_post_author_info_show = $cs_xmlObject->post_author_info_show;
				$postname = 'post';
				
			} else {
				$cs_xmlObject = new stdClass();
				$post_view = '';
				$post_video = '';
				$post_audio = '';
				$post_slider = '';
				$post_slider_type = '';
				$cs_related_post = '';
				$post_pagination_show = '';
				$image_url = '';
				$width = 0;
				$height = 0;
				$image_id = 0;
				$cs_post_author_info_show = '';
				$postname = 'post';
				
				$cs_xmlObject->post_social_sharing = '';
			}		
		$custom_height  = 459;	
		$width 			= 816;
		$height 		= 459;
		$image_url 		= cs_get_post_img_src($post->ID, $width, $height);
		?>
      <!--Left Sidebar Starts-->
      <?php if ($leftSidebarFlag == true){ ?>
      <aside class="page-sidebar">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_left) ) : ?>
        <?php endif; ?>
      </aside>
      <?php } ?>
      <!--Left Sidebar End--> 
      
      <!-- Blog Detail Start -->
      <div class="<?php echo esc_attr($cs_layout); ?>"> 
        <!-- Blog Start --> 
        <!-- Row -->
          <div class="col-md-12">
            <div class="post-option-panel">
          
              <ul class="post-option">			  
				<?php if ( $cs_post_author_info_show == "on" ) { ?>
				  
					<li> <i class="icon-user9"></i><?php _e( 'By ', 'goalklub' ); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></li>
                                        
				<?php } ?>
				 
                 <li> <i class=" icon-list7"></i>
					 
                 <?php 
				 
                    if ( isset($cs_blog_cat) && $cs_blog_cat !='' && $cs_blog_cat !='0' ){
						
                        echo '<a href="'.site_url().'?cat='.$row_cat->term_id.'">'.$row_cat->name.'</a>';
						
                     } else {
						 
                          $categories_list = get_the_term_list ( get_the_id(), 'category', '' , ', ', '' );
						  
                          if ( $categories_list ){
                            printf( __( '%1$s', 'goalklub'),$categories_list );
                          }
						  
                     }
                    ?>
                 </li>
                  <li><time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n(get_option('date_format'),strtotime(get_the_date()));?></time></li>
              </ul>
            </div>
            <?php 
				if (isset($inside_post_view) and $inside_post_view <> '') {
					if( $inside_post_view == "Slider"){
						echo ' <figure class="detailpost blog-editor">';
							cs_post_flex_slider($width,$height,get_the_id(),'post');
						echo '</figure>';
					} else if ($inside_post_view == "Single Image" && $image_url <> '') { 
						echo '<figure class="detailpost blog-editor">';
							echo '<img src="'.$image_url.'" alt="No image" >';
						echo '</figure>';
					} elseif ( $inside_post_view == "Video" and $post_video <> '' and $inside_post_view <> '' ) {
					   	$url = parse_url($post_video);
                        $global_SERVER_NAME = '';
					   	if(function_exists('cs_glob_server')){
                            $global_SERVER_NAME = cs_glob_server('SERVER_NAME');
                        }
					   	if($url['host'] == $global_SERVER_NAME) {?>
					<?php
							echo do_shortcode('[video width="'.$width.'" height="'.$height.'" mp4="'.$post_video.'"][/video]');
					  } else {
							$video	= wp_oembed_get($post_video,array('height' => $custom_height));
							$search = array('webkitallowfullscreen', 'mozallowfullscreen', 'frameborder="0"');
							echo  str_replace($search,'',$video);
					  }
 				} elseif ($inside_post_view == "Audio" and $inside_post_view <> ''){  
				?>
                     <figure class="detailpost blog-editor">
                      <?php echo do_shortcode('[audio mp3="'.$post_audio.'"][/audio]');?>
                     </figure>
            <?php    
				}
            }
			?>
          </div>
          <div class="col-md-12">
            <div class="rich_editor_text blog-editor">
            	<?php 
					the_content();
					wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'goalklub' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
				?>
            </div>
          </div>
          
          <!-- Col Tags Start -->
 <?php if (isset($post_tags_show) && $post_tags_show == 'on') {

                            if (empty($cs_xmlObject->post_tags_show_text))
                                $post_tag_text = __('Tags', 'goalklub');
                            else
                                $post_tag_text = $cs_xmlObject->post_tags_show_text;
                            ?>


                            <div class="col-md-12">
                                <div class="cs-section-title">
                                    <h2><?php echo esc_attr($post_tag_text); ?></h2>
                                </div>

                                <?php
                                $categories_list = get_the_term_list(get_the_id(), 'post_tag', '<li>', '</li><li>', '</li>');

                                if ($categories_list) {
                                    ?>

                                   
                                        <div class="cs-tags">
                                            <ul><?php printf(__('%1$s', 'goalklub'), $categories_list); ?></ul>
                                        </div>
                                    
                            </div>
                                    <?php
                                }
                            }
		  ?>             
  
          <!-- Col Social Share -->
          <?php  
		  	  
			if ($cs_post_social_sharing == "on"){
				?>
               <div class="col-md-12">
                <div class="detail-post">                   
					<?php
                    if ( empty($cs_xmlObject->post_social_sharing_text) ) $post_social_sharing_text = __('Share', 'goalklub'); else $post_social_sharing_text = $cs_xmlObject->post_social_sharing_text;
                    cs_social_share(false,true,$post_social_sharing_text);
                    ?>
                </div>
              </div>
			<?php
		 }
		  ?>

          <!-- Post Button Start-->
          <div class="col-md-12">
                                <?php
                                if (isset($post_pagination_show) && $post_pagination_show == 'on') {
                                    
                                     if (empty($cs_xmlObject->post_pagination_show_title))
                                            $post_pagination_text = __('Share', 'goalklub');
                                        else
                                            $post_pagination_text = $cs_xmlObject->post_pagination_show_title;?>
                                         <div class="cs-section-title" >
                                                <h2>
                                                    <?php echo force_back($post_pagination_text); ?>
                                                </h2>
                                            </div>
                                    
                                    
                                    
                                    <?php
                                    cs_next_prev_custom_links('post');
                                }
                                ?>
                            </div>
          
          <!-- Col Author Start -->
          <?php if(isset($cs_post_author_info_show) &&  $cs_post_author_info_show == 'on'){ ?>
          <div class="col-md-12">
              <div class="cs-section-title" >
					  <h2>
						  <?php
						  if(isset($cs_xmlObject->post_author_info_text) && $cs_xmlObject->post_author_info_text != ''){
							  if(function_exists('cs_special_function')){
								echo cs_special_function($cs_xmlObject->post_author_info_text);
							  }
						  } 
						  ?>
					  </h2>
				  </div>
			 <?php cs_author_description('show');?>    
          </div>
          <!-- Col Author End --> 
          
          <?php } ?>

          <!-- Col Recent Posts Start -->
          <?php if($cs_related_post =='on'){
						if ( empty($cs_xmlObject->cs_related_post_title) ) $cs_related_post_title = __('Related Posts', 'goalklub'); else $cs_related_post_title = $cs_xmlObject->cs_related_post_title;
						
						 ?>
          <div class="col-md-12 post-recent">
			  
            <div class="cs-section-title">
              <h2><?php echo esc_attr($cs_related_post_title);?></h2>
            </div>
			  
            <div class="row">
              <?php 
				  $custom_taxterms='';
				  $width  = 250;
				  $height = 188;
				  $custom_taxterms = wp_get_object_terms( $post->ID, array($cs_categories_name, $cs_tags_name), array('fields' => 'ids') );
				  $args = array(
					  'post_type' => $postname,
					  'post_status' => 'publish',
					  'posts_per_page' => 3,
					  'orderby' => 'DESC',
					  'tax_query' => array(
						  'relation' => 'OR',
						  array(
							  'taxonomy' => $cs_tags_name,
							  'field' => 'id',
							  'terms' => $custom_taxterms
						  ),
						  array(
							  'taxonomy' => $cs_categories_name,
							  'field' => 'id',
							  'terms' => $custom_taxterms
						  )
					  ),
					  'post__not_in' => array ($post->ID),
				  );
				 $custom_query = new WP_Query($args);
				 while ($custom_query->have_posts()) : $custom_query->the_post();
					$image_url = cs_get_post_img_src($post->ID, $width, $height);
					
					if($image_url == ''){
						$img_class = 'no-image';	
						$image_url	= get_template_directory_uri().'/assets/images/no-image4x3.jpg';
					}else{
						$img_class  = '';
					}						 
					?>
             
              	<div class="col-md-4">
                  <!-- Article -->
                  <div class="cs-blog cs-blog-grid"> 
                    <?php if($image_url <> ""){?>
                    <div class="cs-media">
                       <figure class="<?php echo esc_attr($img_class);?>"><a href="<?php the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url($image_url);?>"></a>
                       </figure>
                    </div>
                    <?php }?>
                    <section>
                      <div class="title">
                        <ul class="post-option">
						 <li><time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n(get_option('date_format'),strtotime(get_the_date()));?></time></li>
                        </ul>
                          <h4><a href="<?php echo the_permalink();?>"><?php echo get_the_title();?></a></h4>
                       </div>
                    </section>
                  </div>
                  <!-- Article Close -->
              </div>
              <?php endwhile; wp_reset_postdata(); ?>
          </div>
          </div>
       <?php } ?>
          <!-- Col Recent Posts End --> 
          
          <!-- Col Comments Start -->
		  <?php comments_template('', true); ?>
          <!-- Col Comments End --> 
          
          <!-- Blog Post End --> 
        <!-- Blog End --> 
       <!-- Blog Detail End --> 
      <!-- Right Sidebar Start --> 
		
      <!-- Right Sidebar End -->
      <?php endwhile;   
	  wp_reset_query();
		endif; ?>
        
    </div>
    <?php if ($rightSidebarFlag == true){ ?>
      		<aside class="page-sidebar">
       			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_right) ) : endif; ?>
      		</aside>
      <?php } ?>
  </div>
  </div>
</section>
<!-- PageSection End --> 
<!-- Footer -->
<?php get_footer(); ?>