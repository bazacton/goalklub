<?php
/**
 * The template for Home page
 
 */
 
 get_header();
 global $cs_node,$cs_theme_options,$cs_counter_node;

	if(isset($cs_theme_options['cs_excerpt_length']) && $cs_theme_options['cs_excerpt_length'] <> ''){ $default_excerpt_length = $cs_theme_options['cs_excerpt_length']; }else{ $default_excerpt_length = '255';}; 
			
	$cs_layout 	=  $cs_theme_options['cs_default_page_layout'];
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
       <section class="page-section" style="padding:0;">
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
					<?php if ( have_posts() ) : cs_addthis_script_init_method(); ?>
                    <?php /* The loop */
                       if (empty($_GET['page_id_all']))
                              $_GET['page_id_all'] = 1;
                          if (!isset($_GET["s"])) {
                              $_GET["s"] = '';
                          }
                    ?>
					<div class="row">
					<?php
					while ( have_posts() ) : the_post(); 
					$width 			 = '372';
					$height 		 = '279';
					$title_limit 	 = 1000;
					$thumbnail 		 = cs_get_post_img_src( $post->ID, $width, $height );
					$description 	 = 'yes'; 
					$excerpt 		 = isset($cs_theme_options['cs_excerpt_length'])?$cs_theme_options['cs_excerpt_length']:'255'; 
					$post_thumb_view = 'Single Image';
					$post_xml 		 = get_post_meta(get_the_id(), "post", true);
					if ( $post_xml <> "" ) {
						$cs_xmlObject = new SimpleXMLElement($post_xml);
						$post_thumb_view = $cs_xmlObject->post_thumb_view;	
					}
					
					$noImage		= '';
					if ( $thumbnail =='' ){
						$noImage	= 'no-image';
					}
                    
                     ?>
					 
                     <div class="col-md-12">
                      <div class="cs-blog blog-medium <?php echo cs_allow_special_char($noImage);?>">
                        <?php if ( $post_thumb_view == 'Single Image' ){
                                if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
                                    <div class="cs-media">
                                      <figure>
                                        <a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a>
                                      </figure>
                                    </div>
                            <?php }
                              } else if ($post_thumb_view == 'Slider') {
                                    echo '<figure>';
                                    cs_featured();
                                    cs_post_flex_slider($width,$height,get_the_id(),'post-list');
                                    echo '</figure>';
                              } 
                         ?>
                        	<section>
                                  <div class="title">
                                        <ul class="post-option">
                                           <li><?php cs_featured(); ?><time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n(get_option('date_format'),strtotime(get_the_date()));?></time></li>
                                        </ul>
                                  		<h4><a href="<?php echo the_permalink();?>"><?php echo the_title();?></a></h4>
                                  </div>
                                  <div class="blog-text">	                              
                                     <p> <?php echo cs_get_the_excerpt($excerpt,'ture','');?></p>
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
                   
                    <?php 
                        endwhile; 
				
						wp_reset_query();
                    else:
                         if ( function_exists( 'cs_fnc_no_result_found' ) ) { cs_fnc_no_result_found(); }
                    endif; 
                    ?>
                    
					<?php
                        $qrystr = '';
                        if ( isset($_GET['page_id']) ) $qrystr .= "&page_id=".$_GET['page_id'];
						if ($wp_query->found_posts > get_option('posts_per_page')) {
						   if ( function_exists( 'cs_pagination' ) ) { echo cs_pagination(wp_count_posts()->publish,get_option('posts_per_page'), $qrystr); } 
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
<?php 

	

get_footer(); ?>