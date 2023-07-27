<?php
/**
 * The template for displaying Search Result
 */
	get_header();
	global  $cs_theme_option; 
 	if(isset($cs_theme_options['cs_excerpt_length']) && $cs_theme_options['cs_excerpt_length'] <> ''){ $default_excerpt_length = $cs_theme_options['cs_excerpt_length']; }else{ $default_excerpt_length = '255';}; 
			
	$cs_layout 	=  $cs_theme_options['cs_default_page_layout'];
	if ( isset( $cs_layout ) && $cs_layout == "sidebar_left") {
		$cs_layout = "content-right col-md-9";
	} else if ( isset( $cs_layout ) && $cs_layout == "sidebar_right" ) {
		$cs_layout = "content-left col-md-9";
	} else {
		$cs_layout = "col-md-12";
	}
	$cs_sidebar	= $cs_theme_options['cs_default_layout_sidebar'];
			
	$cs_tags_name = 'post_tag';
	$cs_categories_name = 'category';
	if(!isset($GET['page_id'])) $GET['page_id_all']=1;
	
	global $wp_query;
	?>
    <section class="page-section" style=" padding:0;">
        <!-- Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">        
			<?php if ($cs_layout == 'content-right col-md-9'){ ?>
                <div class="content-lt col-md-3"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar) ) : ?><?php endif; ?></div>
            <?php } ?>
            	
   			<div class="<?php echo esc_attr($cs_layout); ?>">
				    <?php
                    $msg = 'Showing result for "'.get_search_query().'"';
					if ( have_posts() ) :
					  echo '<div class="cs-list relevant-search">';
                        echo '<h2>'.esc_html($msg).'</h2>';
					  echo '<div class="cs-seprator"><div class="devider1"></div></div>';
					  echo '<ul>';
                       while ( have_posts() ) : the_post();
                     ?>	
                     	<li>
						<?php 
						if ( is_sticky() ){  echo '<span>'.__('Featured', 'goalklub').'</span>';}
							// echo date_i18n(get_option( 'date_format' ),strtotime(get_the_date())); ?> <?php  //echo cs_get_the_excerpt('50',false);?>
                             <a href="<?php the_permalink(); ?>"><?php echo substr(get_the_title(),0,19) ?>, <strong><?php  echo cs_get_the_excerpt('50',false);?></strong></a>
                     		 <span><?php _e('On','goalklub');echo date_i18n(get_option( 'date_format' ),strtotime(get_the_date())); ?>
                             ,<?php 
								   /* Get All Cats */
									$categories_list = get_the_term_list ( get_the_id(), 'category', '' , ', ', '' );
									if ( $categories_list ){
									  printf( __( '%1$s', 'goalklub'),$categories_list );
									} 
								   // End if Cats 
                                ?></span>
                        </li>
                    <?php  
                    endwhile;
				   echo '</ul></div> ';
                else:
                    cs_fnc_no_result_found(); 
                endif;				
                $qrystr = '';
				if ($wp_query->found_posts > get_option('posts_per_page')) {    
					if ( isset($_GET['s']) ) $qrystr = "&amp;s=".$_GET['s'];
					if ( isset($_GET['page_id']) ) $qrystr .= "&amp;page_id=".$_GET['page_id'];
					echo cs_pagination($wp_query->found_posts,get_option('posts_per_page'), $qrystr);
                }
            ?>             
           </div>
			<?php if ( $cs_layout  == 'content-left col-md-9'){ ?>
               <div class="content-rt col-md-3"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar) ) : ?><?php endif; ?></div>
            <?php } ?> 
        </div>
      </div>
   </section>
<?php
get_footer();
?>
<!-- Columns End -->