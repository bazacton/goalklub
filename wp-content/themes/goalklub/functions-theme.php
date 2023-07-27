<?php
// Flexslider function
if ( ! function_exists( 'cs_flex_slider' ) ) {
	function cs_flex_slider($width,$height,$slider_id){
		global $cs_node,$cs_theme_option,$cs_theme_options,$cs_counter_node;
		$cs_counter_node++;
		if($slider_id == ''){
			$slider_id = $cs_node->slider;
		}
		if($cs_theme_option['flex_auto_play'] == 'on'){$auto_play = 'true';}
			else if($cs_theme_option['flex_auto_play'] == ''){$auto_play = 'false';}
			$cs_meta_slider_options = get_post_meta("$slider_id", "cs_meta_slider_options", true); 
		?>
		<!-- Flex Slider -->
		<div id="flexslider<?php echo absint($cs_counter_node); ?>">
		  <div class="flexslider" style="display: none;">
			  <ul class="slides">
				<?php 
					$cs_counter = 1;
					$cs_xmlObject_flex = new SimpleXMLElement($cs_meta_slider_options);
					foreach ( $cs_xmlObject_flex->children() as $as_node ){
 						$image_url = cs_attachment_image_src((int)$as_node->path,$width,$height); 
						?>
                        <li>
                            <figure>
                                <img src="<?php echo esc_url($image_url); ?>" alt="No image">
                                <?php 
								if($as_node->title != '' && $as_node->description != '' || $as_node->title != '' || $as_node->description != ''){ 
								?>         
                                <figcaption>
                                	<div class="container">
                                    <?php 
										if($as_node->title <> ''){
											echo '<h2 class="colr">';
											if($as_node->link <> ''){ 
												 echo '<a href="'.esc_url($as_node->link).'" target="'.esc_attr($as_node->link_target).'">' . esc_attr($as_node->title) . '</a>';
											} else {
												echo esc_attr($as_node->title);
 											}
											echo '</h2>';
                                           	}
											if($as_node->description <> ''){
												echo '<p>';
                                                echo force_back(substr($as_node->description, 0, 220), false);
                                                if ( strlen($as_node->description) > 220 ) echo "...";
												echo '</p>';
                                         }
										?>
									</div>
                                 </figcaption>
                               <?php }?>
                             </figure>
                         </li>
 					<?php 
 					$cs_counter++;
 					}
 				?>
 		 	  </ul>
 		  </div>
 		</div>
 		<?php 
		if ( function_exists( 'cs_enqueue_flexslider_script' ) ) {
			//add_action( 'wp_enqueue_scripts', 'cs_enqueue_flexslider_script' );
			cs_enqueue_flexslider_script();
		}
		
		
		?>
		<!-- Slider height and width -->
		<!-- Flex Slider Javascript Files -->
		<script type="text/javascript">
			cs_flex_slider(<?php echo esc_js($cs_theme_option['flex_animation_speed']); ?>, <?php echo esc_js($cs_theme_option['flex_pause_time']); ?>, <?php echo esc_js($cs_counter_node); ?>, <?php echo esc_js($cs_theme_option['flex_effect']); ?>, <?php echo esc_js($auto_play); ?>);
		</script>
	<?php
	}
}
 

// custom pagination start

if ( ! function_exists( 'cs_pagination' ) ) {

	function cs_pagination($total_records, $per_page, $qrystr = '',$show_pagination='Show Pagination') {

	if($show_pagination<> 'Show Pagination'){
		return;
	} else if($total_records < $per_page){
		return;
	}  else {
	
	
		$html = '';

		$dot_pre = '';

		$dot_more = '';

		$total_page = ceil($total_records / $per_page);
		$page_id_all	= 0;
		if(isset($_GET['page_id_all']) && $_GET['page_id_all'] !=''){
			$page_id_all	= $_GET['page_id_all'];
		}
													
		$loop_start = $page_id_all - 2;

		$loop_end = $page_id_all + 2;

		if ($page_id_all < 3) {

			$loop_start = 1;

			if ($total_page < 5)

				$loop_end = $total_page;

			else

				$loop_end = 5;

		}

		else if ($page_id_all >= $total_page - 1) {

			if ($total_page < 5)

				$loop_start = 1;

			else

				$loop_start = $total_page - 4;

			$loop_end = $total_page;

		}
		$html .= "<div class='col-md-12'><nav class='pagination'><ul>";
        $p= '';
		if ($page_id_all > 1)
        $p = '<img src="'.get_template_directory_uri().'/assets/images/prv-arrow.png" alt="No image" /> Previous';
			$html .= "<li class='pgprev'><a href='?page_id_all=" . ($page_id_all - 1) . "$qrystr' >".$p."</a></li>";

		if ($page_id_all > 3 and $total_page > 5)

			$html .= "<li><a href='?page_id_all=1$qrystr'>1</a></li>";

		if ($page_id_all > 4 and $total_page > 6)

			$html .= "<li> <a>. . .</a> </li>";

		if ($total_page > 1) {

			for ($i = $loop_start; $i <= $loop_end; $i++) {

				if ($i <> $page_id_all)

					$html .= "<li><a href='?page_id_all=$i$qrystr'>" . $i . "</a></li>";

				else

					$html .= "<li><a class='active'>" . $i . "</a></li>";

			}

		}

		if ($loop_end <> $total_page and $loop_end <> $total_page - 1)

			$html .= "<li> <a>. . .</a> </li>";

		if ($loop_end <> $total_page)

			$html .= "<li><a href='?page_id_all=$total_page$qrystr'>$total_page</a></li>";

		if ($page_id_all < $total_records / $per_page)
         
			$html .= "<li class='pgnext'><a class='icon' href='?page_id_all=" . ($page_id_all + 1) . "$qrystr' >".'Next<img src="'.get_template_directory_uri().'/assets/images/next-arrow.png" alt="No image" />'."</a></li>";
		$html .= "</ul></nav></div>";
		return $html;
	}

	}

}

// pagination end

// Social Share Function

if ( ! function_exists( 'cs_social_share' ) ) {

	function cs_social_share($default_icon='false',$title='true',$post_social_sharing_text = '') {

		global $cs_theme_options;
		$html = '';
 		$twitter 			= $cs_theme_options['cs_twitter_share'];
		$facebook 			= $cs_theme_options['cs_facebook_share'];
		$google_plus 		= $cs_theme_options['cs_google_plus_share'];
		$pinterest 			= $cs_theme_options['cs_pintrest_share'];
		$tumblr 			= $cs_theme_options['cs_tumblr_share'];
		$dribbble 			= $cs_theme_options['cs_dribbble_share'];
		$instagram 			= $cs_theme_options['cs_instagram_share'];
		$share 				= $cs_theme_options['cs_share_share'];
		$stumbleupon 		= $cs_theme_options['cs_stumbleupon_share'];
		$youtube 			= $cs_theme_options['cs_youtube_share'];

		 cs_addthis_script_init_method();

		$html = '';

 
		$path = get_template_directory_uri() . "/include/assets/images/";
 		
		if($twitter=='on' or $facebook=='on' or $google_plus=='on' or $pinterest=='on' or $tumblr=='on' or $dribbble=='on' or $instagram=='on' or $share=='on' or $stumbleupon=='on' or $youtube=='on'){
			  $html  = ''; 
                          
                          $html.='<div class="cs-section-title">';
                          
                          
		      $html .='<h2>'.$post_social_sharing_text.'</h2></div>';
			  if (isset($share) && $share == 'on') {
				  $html .='<a class="cs-btnsharenow btnshare addthis_button_compact share-btn" href="#"><i class="icon-share2"></i>'.__('Share','goalklub').'</a>';
			  }
			  $html .='<div class="socialmedia">';
			  $html .='<ul>';
			  if($default_icon <> '1'){
					  
					if (isset($facebook) && $facebook == 'on') {
						$html .='<li><a class="addthis_button_facebook" data-original-title="Facebook"><i class="icon-facebook2"></i></a></li>';
					}
		
					if (isset($twitter) && $twitter == 'on') {
						$html .='<li><a class="addthis_button_twitter" data-original-title="twitter"><i class="icon-twitter2"></i></a></li>';
					}
		
					if (isset($google_plus) && $google_plus == 'on') { 
						$html .='<li><a class="addthis_button_google" data-original-title="google-plus"><i class="icon-google-plus"></i></a></li>';
					}
		
					if (isset($pinterest ) && $pinterest  == 'on') {
						$html .='<li><a class="addthis_button_pinterest" data-original-title="Pinterest"><i class="icon-pinterest4"></i></a></li>';
					}
		
					if (isset($tumblr) && $tumblr == 'on') { 
						$html .='<li><a class="addthis_button_tumblr" data-original-title="Tumblr"><i class="icon-tumblr"></i></a></li>';
					}
		
					if (isset($dribbble) && $dribbble == 'on') {
						$html .='<li><a class="addthis_button_dribbble" data-original-title="Dribbble"><i class="icon-dribbble2"></i></a></li>';
					}
		
					if (isset($instagram) && $instagram == 'on') {
						$html .='<li><a class="addthis_button_instagram" data-original-title="Instagram"><i class="icon-instagram"></i></a></li>';
					}
					
					if (isset($stumbleupon) && $stumbleupon == 'on') {
						$html .='<li><a class="addthis_button_stumbleupon" data-original-title="stumbleupon"><i class="icon-stumbleupon"></i></a></li>';
					}
					
					if (isset($youtube) && $youtube == 'on') {
						$html .='<li><a class="addthis_button_youtube" data-original-title="Youtube"><i class="icon-youtube"></i></a></li>';
					}
			  }
				 
	  
				  $html .='</ul></div>';
		}
			
			echo force_back($html, true);

	}

}
// Social network

if ( ! function_exists( 'cs_social_network' ) ) {

	function cs_social_network($icon_type='',$tooltip = ''){

		global $cs_theme_options;
		$tooltip_data='';

		if($icon_type=='large'){

			$icon = 'icon-2x';

		} else {

			$icon = '';

		}

			if(isset($tooltip) && $tooltip <> ''){

				$tooltip_data='data-placement-tooltip="tooltip"';

			}

		if ( isset($cs_theme_options['social_net_url']) and count($cs_theme_options['social_net_url']) > 0 ) {

						$i = 0;
						echo '<ul class="socialmedia">';
						foreach ( $cs_theme_options['social_net_url'] as $val ){
							?>
						<?php if($val != ''){?>
        		            <li><a title="link" href="<?php echo esc_url($val);?>" data-original-title="<?php echo cs_allow_special_char($cs_theme_options['social_net_tooltip'][$i]);?>" data-placement="top" <?php echo force_back($tooltip_data, false);?> class="colrhover"  target="_blank"><?php if($cs_theme_options['social_net_awesome'][$i] <> '' && isset($cs_theme_options['social_net_awesome'][$i])){?>
								 
                                 <i style="color:<?php echo cs_allow_special_char($cs_theme_options['social_font_awesome_color'][$i]); ?>;" class="<?php echo esc_attr($cs_theme_options['social_net_awesome'][$i]);?> <?php echo esc_attr($icon);?>"></i>
						<?php } else {?><img src="<?php echo esc_url($cs_theme_options['social_net_icon_path'][$i]);?>" alt="<?php echo esc_attr($cs_theme_options['social_net_tooltip'][$i]);?>" /><?php }?></a></li><?php }
						$i++;}
						echo '</ul>';
		}
	}
}

// Post image attachment function
if ( ! function_exists( 'cs_attachment_image_src' ) ) {
		function cs_attachment_image_src($attachment_id, $width, $height) {		
			$image_url = wp_get_attachment_image_src((int)$attachment_id, array($width, $height), true);		
			 if ($image_url[1] == $width and $image_url[2] == $height)
		
				;
			else
				$image_url = wp_get_attachment_image_src((int)$attachment_id, "full", true);
		
				$parts = explode('/uploads/',$image_url[0]);
		
				if ( count($parts) > 1 ) return $image_url[0];
		
		}
}

// Post image attachment source function
if ( ! function_exists( 'cs_get_post_img_src' ) ) {
	function cs_get_post_img_src($post_id, $width, $height) {
	
		if(has_post_thumbnail()){
			$image_id = get_post_thumbnail_id($post_id);
	
			$image_url = wp_get_attachment_image_src((int)$image_id, array($width, $height), true);
	
			if ($image_url[1] == $width and $image_url[2] == $height) {
	
				return $image_url[0];
	
			} else {
	
				$image_url = wp_get_attachment_image_src((int)$image_id, "full", true);
	
				return $image_url[0];
			}
		}
	}
}

// Get Post image attachment
if ( ! function_exists( 'cs_get_post_img' ) ) {
		function cs_get_post_img($post_id, $width, $height) {
		
			$image_id = get_post_thumbnail_id($post_id);
		
			$image_url = wp_get_attachment_image_src((int)$image_id, array($width, $height), true);
		
			if ($image_url[1] == $width and $image_url[2] == $height) {
		
				return get_the_post_thumbnail($post_id, array($width, $height));
		
			} else {
		
				return get_the_post_thumbnail($post_id, "full");
			}
		}
}

// Get Main background
if ( ! function_exists( 'cs_bg_image' ) ) {
		function cs_bg_image(){
		global $cs_theme_options;
		if ($cs_theme_options['cs_custom_bgimage'] == "" ) {
			if ( isset( $cs_theme_options['cs_bg_image'] )  
				&& $cs_theme_options['cs_bg_image'] != '' 
				and $cs_theme_options['cs_bg_image']!= 'bg0'
				and $cs_theme_options['cs_bg_image']!= 'pattern0'){
					$cs_bg_image = get_template_directory_uri()."/include/assets/images/background/".$cs_theme_options['cs_bg_image'].".png";
				}
			}elseif ($cs_theme_options['cs_custom_bgimage']<>'pattern0') { 
				$cs_bg_image = $cs_theme_options['cs_custom_bgimage'];
			}
		if ( $cs_bg_image <> "" ) {
			return ' style="background:url('.$cs_bg_image.') ' .$cs_theme_options['cs_bgimage_position'].'"';
		}elseif(isset($cs_theme_options['cs_bg_color']) and $cs_theme_options['cs_bg_color'] <> ''){
			return ' style="background:'.$cs_theme_options['cs_bg_color'].'"';
		}
		
	}
}

// Main wrapper class function
if ( ! function_exists( 'cs_wrapper_class' ) ) {
		function cs_wrapper_class(){
			global $cs_theme_options;
		
			if ( isset($_POST['cs_layout']) ) {
		
				$_SESSION['lmssess_layout_option'] = $_POST['cs_layout'];
				
				echo cs_allow_special_char($_SESSION['lmssess_layout_option']);
		
			}
			elseif ( isset($_SESSION['lmssess_layout_option']) and !empty($_SESSION['lmssess_layout_option'])){
		
				echo cs_allow_special_char($_SESSION['lmssess_layout_option']);
			}
			else {
				echo cs_allow_special_char($cs_theme_options['cs_layout']);
				$_SESSION['lmssess_layout_option']='';
			}
		}
}

// custom sidebar start



function widget_sidebar_registered(){
    $cs_theme_sidebar = get_option('cs_theme_options');
if ( isset($cs_theme_sidebar['sidebar']) and !empty($cs_theme_sidebar['sidebar'])) {


	foreach ( $cs_theme_sidebar['sidebar'] as $sidebar ){
		$sidebar_id =strtolower(str_replace(' ','_',$sidebar));
		//foreach ( $parts as $val ) {

            register_sidebar(array(

                'name' => $sidebar,

                'id' => $sidebar_id,

                'description' =>__('This widget will be displayed on right side of the page','goalklub'),

                'before_widget' => '<div class="widget element-size-100 %2$s">',

                'after_widget' => '</div>',

                'before_title' => '<div class="widget-section-title"><h2>',

                'after_title' => '</h2></div>'

            ));

	}

}
// custom sidebar end

//primary widget

    register_sidebar(array(
        'name' => __('Primary Sidebar', 'goalklub'),
        'id' => 'sidebar-1',
        'description' => __('Main sidebar that appears on the right.', 'goalklub'),
        'before_widget' => '<article class="element-size-100 group widget %2$s">',
        'after_widget' => '</article>',
        'before_title' => '<div class="widget-section-title"><h2>',
        'after_title' => '</h2></div>'
    ));
    /**
     * @footer widget Area
     *
     *
     */

    register_sidebar(array(
        'name' => 'Footer Widget',
        'id' => 'footer-widget-1',
        'description' => __('This Widget Show the Content in Footer Area', 'goalklub'),
        'before_widget' => '<aside class="col-md-4 widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<div class="widget-section-title"><h2>',
        'after_title' => '</h2></div>'
    ));
}

add_action( 'widgets_init', 'widget_sidebar_registered' );




if (!function_exists('cs_comment')) :

     /**

     * Template for comments and pingbacks.
     *
     * To override this walker in a child theme without modifying the comments template
     * simply create your own cs_comment(), and that function will be used instead.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     */

	function cs_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;

	$args['reply_text'] = 'Reply';
 	switch ( $comment->comment_type ) :

		case '' :

	?>

		<li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" <?php //comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <div class="thumblist" id="comment-<?php comment_ID(); ?>">
                <ul>
                    <li>
                    	<header>
                            <figure class="blog-comment">
                                 <a><?php echo get_avatar( $comment, 60 ); ?></a>
                            </figure>
                        	<h6><a href="<?php get_comment_author_url(); ?>"><?php comment_author(  ); ?></a></h6>
                        	<span><?php printf( __( '<span>%1$s</span>', 'goalklub' ), get_comment_date().'<br/> '.get_comment_time()); ?></span>
                        </header>

                        <div class="text">
                            <?php if ( $comment->comment_approved == '0' ) : ?>
                                <p><div class="comment-awaiting-moderation colr"><?php _e( 'Your comment is awaiting moderation.', 'goalklub' ); ?></div></p>
                            <?php endif; ?>
                            <?php comment_text(); ?><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth) ) ); ?>
                        </div>
                    </li>
                </ul>
            </div>

	<?php
		break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
	<p><?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'goalklub' ), ' ' ); ?></p>
	<?php
		break;
		endswitch;
	}
 	endif;

 /* Under Construction Page */

if ( ! function_exists( 'cs_under_construction' ) ) {

	function cs_under_construction(){

		global $cs_theme_options, $post, $cs_uc_options;
 		$cs_uc_options = get_option('cs_theme_options');
   		if(isset($post)){ $page_name = $post->post_name;  }else{ $page_name = ''; }
		if ( ($cs_uc_options['cs_maintenance_page_switch'] == "on" and !(is_user_logged_in())) or $page_name == "pf-under-construction") {
		
		?>
		<script>
			jQuery(function($){
				$('#underconstrucion').css({'min-height':(($(window).height())-0)+'px'});
			
				$(window).resize(function(){
				$('#underconstrucion').css({'min-height':(($(window).height())-0)+'px'});
				});
			});
        </script>
<div class="wrapper"> 
  
  <!--//  Header //--> 
  <!--//  Header //-->
  <div class="clear"></div>
  <!--//  Main Section  //--> 
  <!--//  Header //-->
      <main id="main-content">
        <div class="main-section">
          <section class="page-section" style="background:url(<?php echo get_template_directory_uri(); ?>/assets/images/bg-top.jpg) no-repeat; padding-top:95px; background-size:cover; position:relative; min-height:689px; margin-top:-40px;">
          <div class="cons-icon-area">
            <figure> <?php if(isset($cs_uc_options['cs_maintenance_logo_switch']) and $cs_uc_options['cs_maintenance_logo_switch'] == "on"){ cs_logo(); } else { echo '<i class="icon-gear"></i>';}?></figure>
          <div class="cons-text-wrapp">
             <?php
              if ($cs_uc_options['cs_maintenance_text']) {
                  echo stripslashes(wp_specialchars_decode($cs_uc_options['cs_maintenance_text']));
              } else {
                  ?>
                  <h2><?php _e('Sorry, We are down for maintenance','goalklub'); ?></h2>
                  <p><?php _e('We\'re currently under maintenance, if all goes as planned we\'ll be back in','goalklub'); ?></p>
                  <?php
              }
              ?>
            </div>
                    <?php 
                         $launch_date = trim($cs_uc_options['cs_launch_date']);
                         $launch_date = str_replace('/', '-', $launch_date);
                         $year = date("Y", strtotime($launch_date));
                         $month = date_i18n("m", strtotime($launch_date));
                         $month_event_c = date_i18n("M", strtotime($launch_date));							
                         $day = date_i18n("d", strtotime($launch_date));
                         $time_left = date_i18n("H,i,s", strtotime($launch_date));
                       ?>
                        
                                       <script type="text/javascript" src="<?php echo esc_js(get_template_directory_uri().'/assets/scripts/jquery.countdown.js'); ?>"></script>
                                       <script>
                                            function cs_mailchimp_submit(theme_url,counter,admin_url){
                                                'use strict';
                                                $ = jQuery;
                                                $('#btn_newsletter_'+counter).hide();
                                                $('#process_'+counter).html('<div id="process_newsletter_'+counter+'"><i class="icon-refresh icon-spin"></i></div>');
                                                $.ajax({
                                                    type:'POST', 
                                                    url: admin_url,
                                                    data:$('#mcform_'+counter).serialize()+'&action=cs_mailchimp', 
                                                    success: function(response) {
                                                        $('#mcform_'+counter).get(0).reset();
                                                        $('#newsletter_mess_'+counter).fadeIn(600);
                                                        $('#newsletter_mess_'+counter).html(response);
                                                        $('#btn_newsletter_'+counter).fadeIn(600);
                                                        $('#process_'+counter).html('');
                                                    }
                                                });
                                            }
                                            jQuery(function () {
                                                var austDay = new Date();
                                                //austDay = new Date(austDay.getFullYear() + 1, 1 - 1, 26);
                                                austDay = new Date(<?php echo esc_js($year); ?>,<?php echo esc_js($month); ?>-1,<?php echo esc_js($day); ?>);
                                                
                                                jQuery('#countdown_underconstruction').countdown({
                                                    until: austDay,
                                                     format: 'wdhms',
                                                    layout: '<div class="main-digit-wrapp"><span class="digit-wrapp"><span class="cs-digit">{w10}</span><span class="cs-digit">{w1}</span></span><span class="countdown-period">Weeks</span></div>' +
                                                    '<div class="main-digit-wrapp"><span class="digit-wrapp"><span class="cs-digit">{d10}</span><span class="cs-digit">{d1}</span></span><span class="countdown-period">days</span></div>' +
                                                    '<div class="main-digit-wrapp"><span class="digit-wrapp"><span class="cs-digit">{h10}</span><span class="cs-digit">{h1}</span></span><span class="countdown-period">hours</span></div>' +
                                                    '<div class="main-digit-wrapp"><span class="digit-wrapp"><span class="cs-digit">{m10}</span><span class="cs-digit">{m1}</span></span><span class="countdown-period">minutes</span></div>' +
                                                    '<div class="main-digit-wrapp"><span class="digit-wrapp"><span class="cs-digit">{s10}</span><span class="cs-digit">{s1}</span></span><span class="countdown-period">seconds</span></div>' 
                                                });
                                            });
                                        </script>
                                       <div id="countdownwrapp">
                                            <div id="countdown_underconstruction"></div>
                                       </div>
          </div>
           </section> 
          <section class="page-section" style="padding-top:25px;">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="under-wrapp"> 
                    <div class="cons-text-wrapp">
						
                      <?php
					  
                        if(isset($cs_uc_options['cs_maintenance_about_text']) and $cs_uc_options['cs_maintenance_about_text'] <>''){
                            echo stripslashes(wp_specialchars_decode($cs_uc_options['cs_maintenance_about_text']));
                        }
						
                        if ( function_exists('cs_custom_mailchimp_maintenance' ) ) {
                                    echo cs_custom_mailchimp_maintenance();
                        }
                         
                       if ( function_exists( 'cs_social_network' ) ) {
                            echo '<div class="social-media">';
                                    cs_social_network(); 
                            echo '</div>';
                          }
							
                           ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </main>
</div>
  		 <?php
         die();
		 }
	}
}

//404 page markeup
if ( ! function_exists( 'cs_page_404' ) ) {

	function cs_page_404(){
		global $cs_theme_options, $post; 
 		?>
        <!DOCTYPE html>
        <html <?php language_attributes(); ?>>
        <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
       <title><?php wp_title( '|', true, 'right' ); ?></title>
         <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/style.css';?>" type="text/css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/css/bootstrap.min.css';?>" />
        <link href="<?php echo get_template_directory_uri() . '/assets/css/iconmoon.css';?>" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/css/color.css';?>" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/css//bootstrap-theme.css';?>" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/css/themetypo.css';?>" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/css/responsive.css';?>" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/css/widget.css';?>" />
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        </head>
        <body>
        	<!--//  Wrapper //-->
            <div class="wrapper"> 
              <!--//  Header //--> 
              <!--//  Header //-->
              <main id="main-content">
                <div class="main-section"> 
                  <!--// PageContent Start //-->
                  <section class="page-section">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="page-not-found">
                              <div class="cs-section-title">
                                <h2>404<span style="font-size:40px; color:#999"> Error </span> </h2>
                              </div>
                              <div class="cs-content404">
                                    <h2><?php _e('Page not found','goalklub')?></h2>
                                    <div class="cs-seprator">
                                  <div class="devider1"></div>
                                </div>
                                <p> <?php _e('Sorry, but the page that you requested doesn\'t exist.','goalklub')?> </p>
                                <a href="<?php echo home_url(); ?>"> <?php _e('Back to home page','goalklub')?></a>
                                <div class="clear"></div>
                                <div class="cs-search-area">
                                  
                                  <form id="searchform" method="get" action="<?php echo home_url()?>"  role="search">
                                        <input type="text" name="s" id="searchinput" value="<?php _e('Search News','goalklub'); ?>" onblur="if(this.value == '') { this.value ='<?php _e('Search News','goalklub'); ?>'; }" onfocus="if(this.value =='<?php _e('Search News','goalklub'); ?>') { this.value = ''; }"  >
                                         <label class="search-submit">
                                          <input type="submit" value="" name="submit">
                                            </label>
                                      </form>
                                </div>
                                <?php 
                                    echo '<div class="social-media">';
                                            if ( function_exists( 'cs_social_network' ) ) { cs_social_network(); }
                                    echo '</div>';
                                ?>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </main>
            </div>
<!--//  Wrapper //--> 
            
        </body>
        </html>
	<?php }
}

// breadcrumb function
/*if ( ! function_exists( 'cs_breadcrumbs' ) ) { 
	function cs_breadcrumbs() {
		global $wp_query, $cs_theme_options,$post;
		/* === OPTIONS ===  
		$text['home']     = 'Home'; // text for the 'Home' link
		$text['category'] = '%s'; // text for a category page
		$text['search']   = '%s'; // text for a search results page
		$text['tag']      = '%s'; // text for a tag page
		$text['author']   = '%s'; // text for an author page
		$text['404']      = 'Error 404'; // text for the 404 page
	
		$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$showOnHome  = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$delimiter   = ''; // delimiter between crumbs
		$before      = '<li class="active">'; // tag before the current crumb
		$after       = '</li>'; // tag after the current crumb
		/* === END OF OPTIONS ===  
		 $current_page = __('Current Page','goalklub');
		$homeLink = home_url() . '/';
		$linkBefore = '<li>';
		$linkAfter = '</li>';
		$linkAttr = '';
		$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
		$linkhome = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
	
		if (is_home() || is_front_page()) {
	
			if ($showOnHome == "1") echo '<div class="breadcrumbs"><ul>'.$before.'<a href="' . $homeLink . '">' . $text['home'] . '</a>'.$after.'</ul></div>';
	
		} else {
			//echo '<div class="breadcrumbs"><ul>' . sprintf($linkhome, $homeLink, $text['home']) . $delimiter;
			if ( is_category() ) {
				$thisCat = get_category(get_query_var('cat'), false);
				if ($thisCat->parent != 0) {
					$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					echo esc_attr($cats);
				}
				echo cs_allow_special_char($before . sprintf($text['category'], single_cat_title('', false)) . $after);
			} elseif ( is_search() ) {
				echo cs_allow_special_char($before . sprintf($text['search'], get_search_query()) . $after);
			} elseif ( is_day() ) {
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
				echo cs_allow_special_char($before . get_the_time('d') . $after);
			} elseif ( is_month() ) {
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo cs_allow_special_char($before . get_the_time('F') . $after);
			} elseif ( is_year() ) {
				echo cs_allow_special_char($before . get_the_time('Y') . $after);
			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
					if ($showCurrent == 1) echo cs_allow_special_char($delimiter . $before . $current_page . $after);
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, $delimiter);
					if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					echo cs_allow_special_char($cats);
					if ($showCurrent == 1) echo cs_allow_special_char($before . $current_page . $after);
				}
			} elseif ( !is_single() && !is_page() && get_post_type() <> '' && get_post_type() != 'post' && get_post_type() <> 'events' && !is_404() ) {
					$post_type = get_post_type_object(get_post_type());
					echo cs_allow_special_char($before . $post_type->labels->singular_name . $after);
			} elseif (isset($wp_query->query_vars['taxonomy']) && !empty($wp_query->query_vars['taxonomy'])){
				$taxonomy = $taxonomy_category = '';
				$taxonomy = $wp_query->query_vars['taxonomy'];
				echo cs_allow_special_char($before . $wp_query->query_vars[$taxonomy] . $after);
			}elseif ( is_page() && !$post->post_parent ) {
				if ($showCurrent == 1) echo cs_allow_special_char($before . get_the_title() . $after);
	
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo cs_allow_special_char($breadcrumbs[$i]);
					if ($i != count($breadcrumbs)-1) echo cs_allow_special_char($delimiter);
				}
				if ($showCurrent == 1) echo cs_allow_special_char($delimiter . $before . get_the_title() . $after);
	
			} elseif ( is_tag() ) {
				echo cs_allow_special_char($before . sprintf($text['tag'], single_tag_title('', false)) . $after);
	
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo cs_allow_special_char($before . sprintf($text['author'], $userdata->display_name) . $after);
	
			} elseif ( is_404() ) {
				echo cs_allow_special_char($before . $text['404'] . $after);
			}
			
			//echo "<pre>"; print_r($wp_query->query_vars); echo "</pre>";
			if ( get_query_var('paged') ) {
				// if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				// echo __('Page', 'goalklub') . ' ' . get_query_var('paged');
				// if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
			}
			echo '</ul></div>';
	
		}

	}
//}*/
/** 
 * @Footer Logo 
 *
 *
 */
 
 if ( ! function_exists( 'cs_breadcrumbs' ) ) { 
	function cs_breadcrumbs() {
		global $wp_query, $cs_theme_options,$post;
		/* === OPTIONS === */
		$text['home']     = 'Home'; // text for the 'Home' link
		$text['category'] = '%s'; // text for a category page
		$text['search']   = '%s'; // text for a search results page
		$text['tag']      = '%s'; // text for a tag page
		$text['author']   = '%s'; // text for an author page
		$text['404']      = 'Error 404'; // text for the 404 page
	
		$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$showOnHome  = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$delimiter   = ''; // delimiter between crumbs
		$before      = '<li class="active">'; // tag before the current crumb
		$after       = '</li>'; // tag after the current crumb
		/* === END OF OPTIONS === */
		 $current_page = __('Current Page','goalklub');
		$homeLink = home_url() . '/';
		$linkBefore = '<li>';
		$linkAfter = '</li>';
		$linkAttr = '';
		$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
		$linkhome = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
	
		if (is_home() || is_front_page()) {
	
			if ($showOnHome == "1") echo '<div class="breadcrumbs"><ul>'.$before.'<a href="' . $homeLink . '">' . $text['home'] . '</a>'.$after.'</ul></div>';
	
		} else {
			echo '<div class="breadcrumbs"><ul>' . sprintf($linkhome, $homeLink, $text['home']) . $delimiter;
			if ( is_category() ) {
				$thisCat = get_category(get_query_var('cat'), false);
				if ($thisCat->parent != 0) {
					$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					echo esc_attr($cats);
				}
				echo cs_allow_special_char($before . sprintf($text['category'], single_cat_title('', false)) . $after);
			} elseif ( is_search() ) {
				echo cs_allow_special_char($before . sprintf($text['search'], get_search_query()) . $after);
			} elseif ( is_day() ) {
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
				echo cs_allow_special_char($before . get_the_time('d') . $after);
			} elseif ( is_month() ) {
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo cs_allow_special_char($before . get_the_time('F') . $after);
			} elseif ( is_year() ) {
				echo cs_allow_special_char($before . get_the_time('Y') . $after);
			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					$current_page = get_the_title();
					printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
					if ($showCurrent == 1) echo cs_allow_special_char($delimiter . $before . $current_page . $after);
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, $delimiter);
					$current_page = get_the_title();
					if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					echo cs_allow_special_char($cats);
					if ($showCurrent == 1) echo cs_allow_special_char($before . $current_page . $after);
				}
			} elseif ( !is_single() && !is_page() && get_post_type() <> '' && get_post_type() != 'post' && get_post_type() <> 'events' && !is_404() ) {
					$post_type = get_post_type_object(get_post_type());
					echo cs_allow_special_char($before . $post_type->labels->singular_name . $after);
			} elseif (isset($wp_query->query_vars['taxonomy']) && !empty($wp_query->query_vars['taxonomy'])){
				$taxonomy = $taxonomy_category = '';
				$taxonomy = $wp_query->query_vars['taxonomy'];
				echo cs_allow_special_char($before . $wp_query->query_vars[$taxonomy] . $after);
			}elseif ( is_page() && !$post->post_parent ) {
				if ($showCurrent == 1) echo cs_allow_special_char($before . get_the_title() . $after);
	
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo cs_allow_special_char($breadcrumbs[$i]);
					if ($i != count($breadcrumbs)-1) echo cs_allow_special_char($delimiter);
				}
				if ($showCurrent == 1) echo cs_allow_special_char($delimiter . $before . get_the_title() . $after);
	
			} elseif ( is_tag() ) {
				echo cs_allow_special_char($before . sprintf($text['tag'], single_tag_title('', false)) . $after);
	
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo cs_allow_special_char($before . sprintf($text['author'], $userdata->display_name) . $after);
	
			} elseif ( is_404() ) {
				echo cs_allow_special_char($before . $text['404'] . $after);
			}
			
			//echo "<pre>"; print_r($wp_query->query_vars); echo "</pre>";
			if ( get_query_var('paged') ) {
				// if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				// echo __('Page', 'goalklub') . ' ' . get_query_var('paged');
				// if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
			}
			echo '</ul></div>';
	
		}
	

	}
}
if ( ! function_exists( 'cs_footer_logo' ) ) {
	function cs_footer_logo(){
		global $cs_theme_options;
		$logo = isset($cs_theme_options['cs_footer_logo']) ? $cs_theme_options['cs_footer_logo'] : '';
		if($logo <> ''){
			echo '<div class="footer_icon"><a href="'.home_url().'"><img src="'.$logo.'" alt="'.get_bloginfo('name').'"></a></div>';
		}
	}
}

// Footer Twitter
if ( ! function_exists( 'cs_footer_twitter' ) ) {
	function cs_footer_twitter(){
		
		global $cs_theme_options;
		$username = $cs_theme_options['cs_footer_twitter_username'];
		$numoftweets = $cs_theme_options['cs_footer_twitter_num_tweets'];
		$tweet_clr = $cs_theme_options['cs_footer_text_color'];
		$rand_id = rand(45, 645645);
		$html ='';
		//$html = '<div class="twitter-section">';
		$html .= "<div class='flexslider flexslider".$rand_id."'>";
		$html .= cs_get_tweets($username, $numoftweets,$tweet_clr);
		$html.='</div>';
		 cs_enqueue_flexslider_script();
				$html.='<script type="text/javascript">
						jQuery(document).ready(function(){
							jQuery(".flexslider'.$rand_id.'").flexslider({
								animation: "fade",
								slideshow: true,
								slideshowSpeed: 7000,
								animationDuration: 600,
								smoothHeight : true,
								prevText:"<em class=\'icon-angle-up\'></em>",
								nextText:"<em class=\'icon-angle-down\'></em>",
								start: function(slider) {
									jQuery(".flexslider").fadeIn();
								}
							});
						});
					</script>';
		echo cs_allow_special_char($html);
	}
}
