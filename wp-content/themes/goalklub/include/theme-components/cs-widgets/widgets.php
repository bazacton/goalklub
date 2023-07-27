<?php 
/**
 * Widgets Classes & Functions
 */
 

/**
 * @Facebook widget Class
 *
 *
 */

if ( ! class_exists( 'facebook_module' ) ) { 
    class facebook_module extends WP_Widget {      
        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */
         /**
         * @Facebook Module
         *
         *
         */
		public function __construct() {
					
			parent::__construct(
				'facebook_module', // Base ID
				__( 'CS : Facebook','goalklub' ), // Name
				array( 'classname' => 'facebok_widget', 'description' =>esc_html__('Facebook widget like box total customized with theme.', 'goalklub'), ) // Args
			);
			
		}
        /**
         * @Facebook html Form
         *
         *
         */
         function form($instance) {
                $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
                $title = $instance['title'];
                $pageurl = isset( $instance['pageurl'] ) ? esc_attr( $instance['pageurl'] ) : '';
                $showfaces = isset( $instance['showfaces'] ) ? esc_attr( $instance['showfaces'] ) : '';
                $showstream = isset( $instance['showstream'] ) ? esc_attr( $instance['showstream'] ) : '';
                $showheader = isset( $instance['showheader'] ) ? esc_attr( $instance['showheader'] ) : '';
                $fb_bg_color = isset( $instance['fb_bg_color'] ) ? esc_attr( $instance['fb_bg_color'] ) : '';
                $likebox_height = isset( $instance['likebox_height'] ) ? esc_attr( $instance['likebox_height'] ) : '';         
				
				
				$width = isset( $instance['width'] ) ? esc_attr( $instance['width'] ) : '';   
				$hide_cover = isset( $instance['hide_cover'] ) ? esc_attr( $instance['hide_cover'] ) : '';   
				$show_posts = isset( $instance['show_posts'] ) ? esc_attr( $instance['show_posts'] ) : '';   
				$hide_cta = isset( $instance['hide_cta'] ) ? esc_attr( $instance['hide_cta'] ) : '';   
				$small_header = isset( $instance['small_header'] ) ? esc_attr( $instance['small_header'] ) : '';   
				$adapt_container_width = isset( $instance['adapt_container_width'] ) ? esc_attr( $instance['adapt_container_width'] ) : '';   
	              
            ?>
            <p>
            	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title','goalklub');?>
                	<input class="upcoming" id="<?php echo esc_attr($this->get_field_id('title')); ?>" size='40' name="<?php echo esc_attr($this->                    get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
              </label>
            </p>
            <p>
            	<label for="<?php echo esc_attr($this->get_field_id('pageurl')); ?>"><?php esc_html_e('Page Url','goalklub');?>
                <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('pageurl')); ?>" size='40' name="<?php echo                 esc_attr($this->get_field_name('pageurl')); ?>" type="text" value="<?php echo esc_attr($pageurl); ?>" />
                <br />
                <small><?php esc_html_e('Please enter your page or User profile url example:L','goalklub');?> http://www.facebook.com/profilename OR <br />
                https://www.facebook.com/pages/wxyz/123456789101112 </small><br />
              </label>
            </p>
            
           
            <p>
            	<label for="<?php echo cs_allow_special_char($this->get_field_id('fb_bg_color')); ?>"><?php esc_html_e('Background Color','goalklub');?>
                <input type="text" name="<?php echo cs_allow_special_char($this->get_field_name('fb_bg_color')); ?>" size='4' id="<?php echo cs_allow_special_char($this->get_field_id('fb_bg_color')); ?>"  value="<?php if(!empty($fb_bg_color))
				{ echo cs_allow_special_char($fb_bg_color);} ?>" class="fb_bg_color upcoming"  />
              </label>
            </p>   
            
             <p>
            	<label for="<?php echo cs_allow_special_char($this->get_field_id('width')); ?>"><?php esc_html_e('width','goalklub');?>
                <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('width')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('width')); ?>" type="text" value="<?php echo esc_attr($width); ?>" />
              </label>
            </p>
            
              <p>
            	<label for="<?php echo cs_allow_special_char($this->get_field_id('likebox_height')); ?>"><?php esc_html_e('Like Box Height','goalklub');?>
                <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('likebox_height')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('likebox_height')); ?>" type="text" value="<?php echo esc_attr($likebox_height); ?>" />
              </label>
            </p>
            
              <p>
            	<label for="<?php echo esc_attr($this->get_field_id('hide_cover')); ?>"><?php esc_html_e('Hide Cover','goalklub');?>
                <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('hide_cover')); ?>" name="<?php echo esc_attr($this->get_field_name('hide_cover')); ?>" type="checkbox" <?php if(esc_attr($hide_cover) != '' ){echo 'checked';}?> />
              </label>
            </p>
            
            
              <p>
            	<label for="<?php echo esc_attr($this->get_field_id('showfaces')); ?>"><?php esc_html_e('Show Faces','goalklub');?>
                <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('showfaces')); ?>" name="<?php echo esc_attr($this->get_field_name('showfaces')); ?>" type="checkbox" <?php if(esc_attr($showfaces) != '' ){echo 'checked';}?> />
              </label>
            </p>
            
            
              <p>
            	<label for="<?php echo esc_attr($this->get_field_id('show_posts')); ?>"><?php esc_html_e('Show Posts','goalklub');?>
                <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('show_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('show_posts')); ?>" type="checkbox" <?php if(esc_attr($show_posts) != '' ){echo 'checked';}?> />
              </label>
            </p>
            
            
              <p>
            	<label for="<?php echo esc_attr($this->get_field_id('hide_cta')); ?>"><?php esc_html_e('Hide Cta','goalklub');?>
                <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('hide_cta')); ?>" name="<?php echo esc_attr($this->get_field_name('hide_cta')); ?>" type="checkbox" <?php if(esc_attr($hide_cta) != '' ){echo 'checked';}?> />
              </label>
            </p>
            
              <p>
            	<label for="<?php echo esc_attr($this->get_field_id('small_header')); ?>"><?php esc_html_e('Small Header','goalklub');?>
                <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('small_header')); ?>" name="<?php echo esc_attr($this->get_field_name('small_header')); ?>" type="checkbox" <?php if(esc_attr($small_header) != '' ){echo 'checked';}?> />
              </label>
            </p>
            
                    <p>
            	<label for="<?php echo esc_attr($this->get_field_id('adapt_container_width')); ?>"><?php esc_html_e('Adapt width','goalklub');?>
                <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('adapt_container_width')); ?>" name="<?php echo esc_attr($this->get_field_name('adapt_container_width')); ?>" type="checkbox" <?php if(esc_attr($adapt_container_width) != '' ){echo 'checked';}?> />
              </label>
            </p>
                     
            <?php       
        }        
        /**
         * @Facebook Update Form Data
         *
         *
         */
         function update($new_instance, $old_instance) {    
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['pageurl'] = $new_instance['pageurl'];
			$instance['showfaces'] = $new_instance['showfaces'];    
			$instance['showstream'] = $new_instance['showstream'];
			$instance['showheader'] = $new_instance['showheader'];
			$instance['fb_bg_color'] = $new_instance['fb_bg_color'];        
			$instance['likebox_height'] = $new_instance['likebox_height'];
			
			$instance['width'] = $new_instance['width'];
			$instance['hide_cover'] = $new_instance['hide_cover'];
			$instance['show_posts'] = $new_instance['show_posts'];
			$instance['hide_cta'] = $new_instance['hide_cta'];
			$instance['small_header'] = $new_instance['small_header'];
			$instance['adapt_container_width'] = $new_instance['adapt_container_width'];
		 
 
			return $instance;
        }
        /**
         * @Facebook Widget Display
         *
         *
         */
         function widget($args, $instance) {    
            extract($args, EXTR_SKIP);
            $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			$title = wp_specialchars_decode(stripslashes($title));
            $pageurl = empty($instance['pageurl']) ? ' ' : apply_filters('widget_title', $instance['pageurl']);
            $showfaces = empty($instance['showfaces']) ? ' ' : apply_filters('widget_title', $instance['showfaces']);
            $showstream = empty($instance['showstream']) ? ' ' : apply_filters('widget_title', $instance['showstream']);
            $showheader = empty($instance['showheader']) ? ' ' : apply_filters('widget_title', $instance['showheader']);
            $fb_bg_color = empty($instance['fb_bg_color']) ? ' ' : apply_filters('widget_title', $instance['fb_bg_color']);                        
            $likebox_height = empty($instance['likebox_height']) ? ' ' : apply_filters('widget_title', $instance['likebox_height']);
			
			 $width = empty($instance['width']) ? ' ' : apply_filters('widget_title', $instance['width']);
			 $hide_cover = empty($instance['hide_cover']) ? ' ' : apply_filters('widget_title', $instance['hide_cover']);
			 $show_posts = empty($instance['show_posts']) ? ' ' : apply_filters('widget_title', $instance['show_posts']);
			 $hide_cta = empty($instance['hide_cta']) ? ' ' : apply_filters('widget_title', $instance['hide_cta']);
		     $small_header = empty($instance['small_header']) ? ' ' : apply_filters('widget_title', $instance['small_header']);
			 $adapt_container_width = empty($instance['adapt_container_width']) ? ' ' : apply_filters('widget_title', $instance['adapt_container_width']);
		 
				   
			if(isset($showfaces) AND $showfaces == 'on'){$showfaces ='true';}else{$showfaces = 'false';}
            if(isset($showstream) AND $showstream == 'on'){$showstream ='true';}else{$showstream ='false';}
			
				if(isset($hide_cover) AND $hide_cover == 'on'){$hide_cover ='true';}else{$hide_cover ='false';}
				if(isset($show_posts) AND $show_posts == 'on'){$show_posts ='true';}else{$show_posts ='false';}
				if(isset($hide_cta) AND $hide_cta == 'on'){$hide_cta ='true';}else{$hide_cta ='false';}
				if(isset($small_header) AND $small_header == 'on'){$small_header ='true';}else{$small_header ='false';}
				if(isset($adapt_container_width) AND $adapt_container_width == 'on'){$adapt_container_width ='true';}else{$adapt_container_width ='false';}
		 
				  
           		echo cs_allow_special_char($before_widget);
			?>
            <style scoped>
				.facebookOuter {background-color:<?php echo cs_allow_special_char($fb_bg_color);?>; width:100%;padding:0;float:left;}
				.facebookInner {float: left; width: 100%;}
				.facebook_module, .fb_iframe_widget > span, .fb_iframe_widget > span > iframe { width: 100% !important;}
				.fb_iframe_widget, .fb-like-box div span iframe { width: 100% !important; float: left;}
			</style>
            <?php
            if (!empty($title) && $title <> ' '){
                echo cs_allow_special_char($before_title);
                echo cs_allow_special_char($title);
                echo cs_allow_special_char($after_title);
            }    
        global $wpdb, $post;?>		
        
        	<div id="fb-root"></div>
			<script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
               js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
			
            <?php
	 
		$output  = '';
$output .= '<div style="background:' . esc_attr( $instance['fb_bg_color'] ) . ';" class="fb-like-box" '; 
$output .= ' data-href="'.esc_url($pageurl).'"';
$output .= ' data-width="'.$width.'" ';
$output .= ' data-height="'.$likebox_height.'" ';
$output .= ' data-hide-cover="'.$hide_cover.'" ';
$output .= ' data-show-facepile="'.$showfaces.'" ';
$output .= ' data-show-posts="'.$show_posts.'">';
$output .= ' </div>';
	  	echo cs_allow_special_char($output);
		
	  echo cs_allow_special_char($after_widget);
		}
	}    
}

if (function_exists('cs_widget_register')) {
    cs_widget_register('facebook_module');
}


/**
 * @Flickr widget Class
 *
 *
 */
if ( ! class_exists( 'cs_flickr' ) ) { 
	class cs_flickr extends WP_Widget {	
	
		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
			 
		/**
		 * @init Flickr Module
		 *
		 *
		 */
		 
 public function __construct() {
		
		parent::__construct(
		'cs_flickr', // Base ID
		__( 'CS : Flickr Gallery','goalklub' ), // Name
		array( 'classname' => 'widget-flickr widget-gallery', 'description' =>__('Type a user name to show photos in widget','goalklub') ) // Args
		);
		}  
		 /**
		 * @Flickr html form
		 *
		 *
		 */
		function form($instance){
			$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
			$title = $instance['title'];
			$username = isset( $instance['username'] ) ? esc_attr( $instance['username'] ) : '';
			$no_of_photos = isset( $instance['no_of_photos'] ) ? esc_attr( $instance['no_of_photos'] ) : '';	
		?>
		<p>
            <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"><?php _e('Title','goalklub');?>
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
		</p>
        <p>
            <label for="<?php echo cs_allow_special_char($this->get_field_id('username')); ?>"><?php _e('Flickr username','goalklub');?>
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('username')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('username')); ?>" type="text" value="<?php echo esc_attr($username); ?>" />
            </label>
		</p>
		<p>
            <label for="<?php echo cs_allow_special_char($this->get_field_id('no_of_photos')); ?>"><?php _e('Number of Photos:','goalklub');?>
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('no_of_photos')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('no_of_photos')); ?>" type="text" value="<?php echo esc_attr($no_of_photos); ?>" />
            </label>
		</p>
		<?php
		}
			
		/**
		 * @Flickr update form data
		 *
		 *
		 */
		function update($new_instance, $old_instance){
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['username'] = $new_instance['username'];
			$instance['no_of_photos'] = $new_instance['no_of_photos'];
			
			return $instance;
		}
	
		/**
		 * @Display Flickr widget
		 *
		 *
		 */
		function widget($args, $instance){
			global $cs_theme_options;
			
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			$username = empty($instance['username']) ? ' ' : apply_filters('widget_title', $instance['username']);			
			$no_of_photos = empty($instance['no_of_photos']) ? ' ' : apply_filters('widget_title', $instance['no_of_photos']);	
			if($instance['no_of_photos'] == ""){$instance['no_of_photos'] = '3';}
			
			echo cs_allow_special_char($before_widget);	
			
			if (!empty($title) && $title <> ' '){
				echo cs_allow_special_char($before_title);
				echo cs_allow_special_char($title);
				echo cs_allow_special_char($after_title);
			}
			
			$get_flickr_array = array();
					
			$apiKey = $cs_theme_options['flickr_key'];
			$apiSecret = $cs_theme_options['flickr_secret'];
			
			if($apiKey <> ''){
			
				// Getting transient
				$cachetime = 86400;
				$transient = 'flickr_gallery_data';
				$check_transient = get_transient($transient);
				
				// Get Flickr Gallery saved data
				$saved_data = get_option('flickr_gallery_data');
				
				$db_apiKey = '';
				$db_user_name = '';
				$db_total_photos = '';
				
				if($saved_data <> ''){
					$db_apiKey = isset($saved_data['api_key']) ? $saved_data['api_key'] : '';
					$db_user_name = isset($saved_data['user_name']) ? $saved_data['user_name'] : '';
					$db_total_photos = isset($saved_data['total_photos']) ? $saved_data['total_photos'] : '';
				}
				
				if( $check_transient === false || ($apiKey <> $db_apiKey || $username <> $db_user_name || $no_of_photos <> $db_total_photos) ){ 
				
					$user_id = "https://api.flickr.com/services/rest/?method=flickr.people.findByUsername&api_key=".$apiKey."&username=".$username."&format=json&nojsoncallback=1";
					
					
					$response = wp_remote_get( esc_url_raw( $user_id ),array( 'decompress' => false) );
					$user_info = json_decode( wp_remote_retrieve_body( $response ), true );
				 
					 
								
					if ($user_info['stat'] == 'ok') {
						
						$user_get_id = $user_info['user']['id'];
						
						$get_flickr_array['api_key'] = $apiKey;
						$get_flickr_array['user_name'] = $username;
						$get_flickr_array['user_id'] = $user_get_id;
						
						$url = "https://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos&api_key=".$apiKey."&user_id=".$user_get_id."&per_page=".$no_of_photos."&format=json&nojsoncallback=1";
						
						$response = wp_remote_get( esc_url_raw( $url ) ,array( 'decompress' => false ));
					    $content = json_decode( wp_remote_retrieve_body( $response ), true );
					 	if ($content['stat'] == 'ok') {
							$counter = 0;
							echo '<ul class="gallery-list">';			 				
							foreach ((array)$content['photos']['photo'] as $photo) {
								
								$image_file = "https://farm{$photo['farm']}.staticflickr.com/{$photo['server']}/{$photo['id']}_{$photo['secret']}_s.jpg";
								
								$img_headers = get_headers($image_file);
								if(strpos($img_headers[0], '200') !== false) {
									
									$image_file = $image_file;
								}
								else{
									$image_file = "https://farm{$photo['farm']}.staticflickr.com/{$photo['server']}/{$photo['id']}_{$photo['secret']}_q.jpg";
									$img_headers = get_headers($image_file);
									if(strpos($img_headers[0], '200') !== false) {
										
										$image_file = $image_file;
									}
									else{
										$image_file = get_template_directory_uri().'/assets/images/no_image_thumb.jpg';
									}
								}
								
								echo '<li>';
								echo "<a target='_blank' title='" . $photo['title'] . "' href='https://www.flickr.com/photos/" . $photo['owner'] . "/" . $photo['id'] . "/'>";
								echo "<img alt='".$photo['title']."' src='".$image_file."'>";
								echo "</a>";
								echo '</li>';
														
								$counter++;
								
								$get_flickr_array['photo_src'][] = $image_file;
								$get_flickr_array['photo_title'][] = $photo['title'];
								$get_flickr_array['photo_owner'][] = $photo['owner'];
								$get_flickr_array['photo_id'][] = $photo['id'];
								
							}
							echo '</ul>';
							
							$get_flickr_array['total_photos'] = $counter;
							
							// Setting Transient
							set_transient( $transient, true, $cachetime );
					 update_option('flickr_gallery_data', $get_flickr_array);
							
							if($counter == 0) _e('No result found.', 'goalklub');
						}
						
						else {
							echo 'Error:' . $content['code'] . ' - ' . $content['message'];
						}
					}
					
					else {
						echo 'Error:' . $user_info['code'] . ' - ' . $user_info['message'];
					}
				
				}
				else{
					if( get_option('flickr_gallery_data') <> '' ){
						
						$flick_data = get_option('flickr_gallery_data');
						echo '<ul class="gallery-list">';
							if(isset($flick_data['photo_src'])):
								$i = 0;
								foreach($flick_data['photo_src'] as $ph){
									echo '<li>';
									echo "<a target='_blank' title='" . $flick_data['photo_title'][$i] . "' href='https://www.flickr.com/photos/" . $flick_data['photo_owner'][$i] . "/" . $flick_data['photo_id'][$i] . "/'>";
									echo "<img alt='".$flick_data['photo_title'][$i]."' src='".$flick_data['photo_src'][$i]."'>";
									echo "</a>";
									echo '</li>';
									$i++;
								}
							endif;
						echo '</ul>';
					}
					else{
						_e('No result found.', 'goalklub');
					}
				}
			
			}
			else{
				_e('Please Enter Flickr API key from Theme Options.', 'goalklub');
			}
			echo cs_allow_special_char($after_widget);
			
		}
	}
}

if (function_exists('cs_widget_register')) {
    cs_widget_register('cs_flickr');
}



/**
 * @Recent posts widget Class
 *
 *
 */

if ( ! class_exists( 'recentposts' ) ) { 
	class recentposts extends WP_Widget{
	
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
		 
	/**
	 * @init Recent posts Module
	 *
	 *
	 */
   public function __construct() {
		
		parent::__construct(
		'recentposts', // Base ID
		__( 'CS : Recent Posts','goalklub' ), // Name
		array( 'classname' => 'recent_blog_widget', 'description' =>__('Recent Posts from category','goalklub') ) // Args
		);
		} 
	 /**
	 * @Recent posts html form
	 *
	 *
	 */
	 function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
		$select_category = isset( $instance['select_category'] ) ? esc_attr( $instance['select_category'] ) : '';
		$showcount = isset( $instance['showcount'] ) ? esc_attr( $instance['showcount'] ) : '';	
		$thumb = isset( $instance['thumb'] ) ? esc_attr( $instance['thumb'] ) : '';
	?>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"><?php _e('Title','goalklub');?>
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
          </label>
        </p>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('select_category')); ?>"><?php _e('Select Category','goalklub');?>
            <select id="<?php echo cs_allow_special_char($this->get_field_id('select_category')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('select_category')); ?>" style="width:225px">
              <option value="" >All</option>
              <?php
				$categories = get_categories();
				if($categories <> ""){
					foreach ( $categories as $category ) {?>
					  <option <?php if($select_category == $category->slug){echo 'selected';}?> value="<?php echo cs_allow_special_char($category->slug);?>" ><?php echo cs_allow_special_char($category->name);?></option>
					<?php 
					}
				}?>
            </select>
          </label>
        </p>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>"><?php _e('Number of Posts To Display','goalklub');?>
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('showcount')); ?>" type="text" value="<?php echo esc_attr($showcount); ?>" />
          </label>
        </p>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('thumb')); ?>"><?php _e('Display Thumbnails','goalklub');?>
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('thumb')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('thumb')); ?>" value="true" type="checkbox"  <?php if(isset($instance['thumb']) && $instance['thumb']=='true' ) echo 'checked="checked"'; ?> />
          </label>
        </p>
        <?php
        }
		
		/**
		 * @Recent posts update form data
		 *
		 *
		 */
		 function update($new_instance, $old_instance){
			  $instance = $old_instance;
			  $instance['title'] = $new_instance['title'];
			  $instance['select_category'] = $new_instance['select_category'];
			  $instance['showcount'] = $new_instance['showcount'];
			  $instance['thumb'] = $new_instance['thumb'];
			
			  return $instance;
		 }

		 /**
		 * @Display Recent posts widget
		 *
		 *
		 */
		 function widget($args, $instance){
			  global $cs_node;
		
			  extract($args, EXTR_SKIP);
			  $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			  $select_category = empty($instance['select_category']) ? ' ' : apply_filters('widget_title', $instance['select_category']);			
			  $showcount = empty($instance['showcount']) ? ' ' : apply_filters('widget_title', $instance['showcount']);	
			  $thumb = isset( $instance['thumb'] ) ? esc_attr( $instance['thumb'] ) : '';						
			  if($instance['showcount'] == ""){$instance['showcount'] = '-1';}
		
			  echo cs_allow_special_char($before_widget);	
		
			  if (!empty($title) && $title <> ' '){
				  echo cs_allow_special_char($before_title);
				  echo cs_allow_special_char($title);
				  echo cs_allow_special_char($after_title);
			  }
		
		global $wpdb, $post;?>
<?php
			  wp_reset_query();
			  
			   /**
				 * @Display Recent posts
				 *
				 *
				 */
				if(isset($select_category) and $select_category <> ' ' and $select_category <> ''){
					$args = array( 'posts_per_page' => "$showcount",'post_type' => 'post','category_name' => "$select_category", 'ignore_sticky_posts' => 1);
				}else{
					$args = array( 'posts_per_page' => "$showcount",'post_type' => 'post', 'ignore_sticky_posts' => 1);
				}
			  $custom_class='';
			  $custom_query = new WP_Query($args);
			  if ( $custom_query->have_posts() <> "" ) {
				  if($thumb <> true){
					   $custom_class='blog_without_thumb';
				  }else{
					 $custom_class='blog_with_thumb'; 
				  }
				  
				  echo '<ul class="'. $custom_class.'">';
				  while ( $custom_query->have_posts()) : $custom_query->the_post();
				  $post_xml = get_post_meta($post->ID, "post", true);	
				  $cs_xmlObject = new stdClass();
				  $cs_noimage = '';
				  if ( $post_xml <> "" ) {
					  $cs_xmlObject = new SimpleXMLElement($post_xml);
				  }//43
				  
				  if($thumb <> true){
				  ?>
					  <li><i class="fa icon-align-left"></i><a href="<?php the_permalink();?>"><?php echo substr(get_the_title(),0,35); if ( strlen(get_the_title()) > 35) echo "..."; ?></a>
					   <div class="time">
						<?php echo date_i18n('d',strtotime(get_the_date()));?><br><span><?php echo date_i18n('M',strtotime(get_the_date()));?></span>
					   </div>
					  </li>
				  <?php
				  }
				  else{
				  $cs_noimage = '';
				  $width = 150;
				  $height = 150;
				  $image_id = get_post_thumbnail_id( $post->ID );
				  $image_url = cs_attachment_image_src($image_id, $width, $height);
				  if($image_id == ''){
					  $cs_noimage = ' class="no-image"';	
				  }
				  ?>
                  <li<?php echo cs_allow_special_char($cs_noimage); ?>>
                    <?php 
					if($image_id <> ''){
					?>
                    <figure><a href="<?php the_permalink();?>"><img alt="<?php the_title();?>" width="60" height="60" src="<?php echo esc_url($image_url); ?>"></a></figure>
                    <?php 
					}
					?>
                     <div class="infotext"> 
                     <p><?php echo date_i18n(get_option('date_format'),strtotime(get_the_date()));?></p>
                     <a href="<?php the_permalink();?>"><?php echo substr(get_the_title(),0,35); if ( strlen(get_the_title()) > 35) echo "..."; ?></a>
                    </div>
                  </li>
                  <?php
				  }
				  
				endwhile; 
				wp_reset_query();
				echo '</ul>';
				
				}
				else {
					if ( function_exists( 'cs_fnc_no_result_found' ) ) { cs_fnc_no_result_found(false); }

				}
				
			    echo cs_allow_special_char($after_widget);
			  }
		  }
}

if (function_exists('cs_widget_register')) {
    cs_widget_register('recentposts');
}


/**
 * @Team Players widget Class
 *
 *
 */

if ( ! class_exists( 'team_players' ) ) { 
	class team_players extends WP_Widget{
	
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
		 
	/**
	 * @init Team Players Module
	 *
	 *
	 */
   public function __construct() {
		
		parent::__construct(
		'team_players', // Base ID
		__( 'CS : Team','goalklub' ), // Name
		array( 'classname' => 'widget_team', 'description' => 'Display List of Players from team', ) // Args
		);
		}  
	 /**
	 * @Team Players html form
	 *
	 *
	 */
	 function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
		$select_category = isset( $instance['select_category'] ) ? esc_attr( $instance['select_category'] ) : '';
		$showcount = isset( $instance['showcount'] ) ? esc_attr( $instance['showcount'] ) : '';	
	?>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"><?php _e('Title','goalklub');?>
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
          </label>
        </p>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('select_category')); ?>"><?php _e('Select Team','goalklub');?>
            <select id="<?php echo cs_allow_special_char($this->get_field_id('select_category')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('select_category')); ?>" style="width:225px">
              <option value="" >All</option>
              <?php
				$categories = get_categories('taxonomy=player-team&child_of=0&hide_empty=0');
				if($categories <> ""){
					foreach ( $categories as $category ) {?>
					  <option <?php if($select_category == $category->slug){echo 'selected';}?> value="<?php echo cs_allow_special_char($category->slug);?>" ><?php echo cs_allow_special_char($category->name);?></option>
					<?php 
					}
				}
			  ?>
            </select>
          </label>
        </p>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>"><?php _e('Number of Players To Display','goalklub');?>
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('showcount')); ?>" type="text" value="<?php echo esc_attr($showcount); ?>" />
          </label>
        </p>
        <?php
        }
		
		/**
		 * @Team Players update form data
		 *
		 *
		 */
		 function update($new_instance, $old_instance){
			  $instance = $old_instance;
			  $instance['title'] = $new_instance['title'];
			  $instance['select_category'] = $new_instance['select_category'];
			  $instance['showcount'] = $new_instance['showcount'];
			
			  return $instance;
		 }

		 /**
		 * @Display Team Players widget
		 *
		 *
		 */
		 function widget($args, $instance){
			  global $cs_node;
		
			  extract($args, EXTR_SKIP);
			  $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			  $select_category = empty($instance['select_category']) ? ' ' : apply_filters('widget_title', $instance['select_category']);			
			  $showcount = empty($instance['showcount']) ? ' ' : apply_filters('widget_title', $instance['showcount']);	
			  if($instance['showcount'] == ""){$instance['showcount'] = '-1';}
		
			  echo cs_allow_special_char($before_widget);	
		
			  if (!empty($title) && $title <> ' '){
				  echo cs_allow_special_char($before_title);
				  echo cs_allow_special_char($title);
				  echo cs_allow_special_char($after_title);
			  }
		
		global $wpdb, $post;
		
			  wp_reset_query();
			  
			   /**
				 * @Display Team Players
				 *
				 *
				 */
				if(isset($select_category) and $select_category <> ' ' and $select_category <> ''){
					$args = array( 'posts_per_page' => "$showcount",'post_type' => 'player','player-team' => "$select_category", 'ignore_sticky_posts' => 1);
				}else{
					$args = array( 'posts_per_page' => "$showcount",'post_type' => 'player', 'ignore_sticky_posts' => 1);
				}

			  $custom_query = new WP_Query($args);
			  if ( $custom_query->have_posts() <> "" ) {
				  echo '<ul>';
				  while ( $custom_query->have_posts()) : $custom_query->the_post();
				  $post_xml = get_post_meta($post->ID, "player", true);	
				  $cs_xmlObject = new stdClass();
				  if ( $post_xml <> "" ) {
					  $cs_xmlObject = new SimpleXMLElement($post_xml);
					  $cs_player_position_name = $cs_xmlObject->cs_player_position_name;
					  $cs_player_position_no = $cs_xmlObject->cs_player_position_no;
				  }
				  else{
					  $cs_player_position_name = '';
					  $cs_player_position_no = '';
				  }
				  
				  $cs_noimage = '';
				  $width = 150;
				  $height = 150;
				  $image_id = get_post_thumbnail_id( $post->ID );
				  $image_url = cs_attachment_image_src($image_id, $width, $height);
				  if($image_url == ''){
					  $cs_noimage = ' class="no-image"';	
				  }
				  ?>
                    <li<?php echo cs_allow_special_char($cs_noimage); ?>>
                      <figure><a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($image_url); ?>"></a></figure>
                       <div class="infotext"> 
                       <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                       <?php if($cs_player_position_name <> ''){ ?><p><?php echo cs_allow_special_char($cs_player_position_name); ?></p><?php } if($cs_player_position_no <> ''){ ?><div class="time"><?php echo cs_allow_special_char($cs_player_position_no); ?></div><?php } ?>
                      </div>
                    </li>
				 <?php
				  
				 endwhile;
				 wp_reset_query();
				 echo '</ul>';
				
				 }
				 else {
					if ( function_exists( 'cs_fnc_no_result_found' ) ) { cs_fnc_no_result_found(false); }
				 }
			    echo cs_allow_special_char($after_widget);
			  }
		  }
}

if (function_exists('cs_widget_register')) {
    cs_widget_register('team_players');
}

/**
 * @Matches widget Class
 *
 *
 */

if ( ! class_exists( 'cs_matches' ) ) { 
	class cs_matches extends WP_Widget{
	
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
		 
	/**
	 * @init Matches Module
	 *
	 *
	 */
   public function __construct() {
		
		parent::__construct(
		'cs_matches', // Base ID
		__( 'CS : Matches','goalklub' ), // Name
		array( 'classname' => 'widget_result', 'description' => 'Display List of Matches', ) // Args
		);
		}  
	 /**
	 * @Matches html form
	 *
	 *
	 */
	 function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
		$select_category = isset( $instance['select_category'] ) ? esc_attr( $instance['select_category'] ) : '';
		$select_type = isset( $instance['select_type'] ) ? esc_attr( $instance['select_type'] ) : '';
		$showcount = isset( $instance['showcount'] ) ? esc_attr( $instance['showcount'] ) : '';	
	?>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"><?php _e('Title','goalklub');?>
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
          </label>
        </p>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('select_category')); ?>"><?php _e('Select Category','goalklub');?>
            <select id="<?php echo cs_allow_special_char($this->get_field_id('select_category')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('select_category')); ?>" style="width:225px">
              <option value="" >All</option>
              <?php
				$categories = get_categories('taxonomy=match-category&child_of=0&hide_empty=0');
				if($categories <> ""){
					foreach ( $categories as $category ) {?>
					  <option <?php if($select_category == $category->slug){echo 'selected';}?> value="<?php echo cs_allow_special_char($category->slug);?>" ><?php echo cs_allow_special_char($category->name);?></option>
					<?php 
					}
				}
			  ?>
            </select>
          </label>
        </p>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('select_type')); ?>"><?php _e('Type','goalklub');?>
            <select id="<?php echo cs_allow_special_char($this->get_field_id('select_type')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('select_type')); ?>" style="width:225px">
              <option <?php if($select_type == 'upcoming'){echo 'selected';}?> value="upcoming"><?php _e('Upcoming Matches','goalklub');?></option>
              <option <?php if($select_type == 'past'){echo 'selected';}?> value="past"><?php _e('Past Matches','goalklub');?></option>
            </select>
          </label>
        </p>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>"><?php _e('Number of Matches To Display','goalklub');?>
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('showcount')); ?>" type="text" value="<?php echo esc_attr($showcount); ?>" />
          </label>
        </p>
        <?php
        }
		
		/**
		 * @Matches update form data
		 *
		 *
		 */
		 function update($new_instance, $old_instance){
			  $instance = $old_instance;
			  $instance['title'] = $new_instance['title'];
			  $instance['select_category'] = $new_instance['select_category'];
			  $instance['select_type'] = $new_instance['select_type'];
			  $instance['showcount'] = $new_instance['showcount'];
			
			  return $instance;
		 }

		 /**
		 * @Display Matches widget
		 *
		 *
		 */
		 function widget($args, $instance){
			  global $cs_node;
		
			  extract($args, EXTR_SKIP);
			  $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			  $select_category = empty($instance['select_category']) ? ' ' : apply_filters('widget_title', $instance['select_category']);
			  $select_type = empty($instance['select_type']) ? ' ' : apply_filters('widget_title', $instance['select_type']);			
			  $showcount = empty($instance['showcount']) ? ' ' : apply_filters('widget_title', $instance['showcount']);	
			  if($instance['showcount'] == ""){$instance['showcount'] = '-1';}
				
			  echo cs_allow_special_char($before_widget);	
		
			  if (!empty($title) && $title <> ' '){
				  echo cs_allow_special_char($before_title);
				  echo cs_allow_special_char($title);
				  echo cs_allow_special_char($after_title);
			  }
		
			  global $wpdb, $post;
		
			  wp_reset_query();
			  
			   /**
				 * @Display Matches
				 *
				 *
				 */
				
				date_default_timezone_set('UTC');
				$current_time = strtotime(current_time('d-m-Y H:i', $gmt = 0));
				$orderby		= 'cs_match_from_date';
		        $order			= 'ASC';
				if ( $select_type == "upcoming" ) $meta_compare = ">";
				else if ( $select_type == "past" ) $meta_compare = "<";
				
				if(isset($select_category) and $select_category <> ' ' and $select_category <> ''){
					$args = array( 
								'posts_per_page' => "$showcount",
								'post_type' => 'match',
								'match-category' => "$select_category",
								'meta_key' => 'cs_match_from_date',
								'meta_value' => $current_time,
								'meta_compare' => $meta_compare,
                                'orderby'      => $orderby,
								'order' =>  $order,
								'ignore_sticky_posts' => 1
							);
				}else{
					$args = array( 
								'posts_per_page' => "$showcount",
								'post_type' => 'match', 
								'meta_key' => 'cs_match_from_date',
								'meta_value' => $current_time,
								'meta_compare' => $meta_compare,
								'orderby'      => $orderby,
								'order' =>  $order,
								'ignore_sticky_posts' => 1
							);
				}

			  $custom_query = new WP_Query($args);
			  if ( $custom_query->have_posts() <> "" ) {
				  echo '<ul>';
				  while ( $custom_query->have_posts()) : $custom_query->the_post();
				  
				  $cs_match_from_date = get_post_meta($post->ID, "cs_match_from_date", true);
				  
				  $post_xml = get_post_meta($post->ID, "match", true);	
				  $cs_xmlObject = new stdClass();
				  if ( $post_xml <> "" ) {
					  $cs_xmlObject = new SimpleXMLElement($post_xml);
					  $cs_match_team_1 = $cs_xmlObject->cs_match_team_1;
					  $cs_match_team_2 = $cs_xmlObject->cs_match_team_2;
					  $cs_match_venue = $cs_xmlObject->cs_match_venue;
					  $cs_match_team1_score = $cs_xmlObject->cs_match_team1_score;
					  $cs_match_team2_score = $cs_xmlObject->cs_match_team2_score;
				  }
				  else{
					  $cs_match_team_1 = '';
					  $cs_match_team_2 = '';
					  $cs_match_venue = '';
					  $cs_match_team1_score = '';
					  $cs_match_team2_score = '';
				  }
				  
				  ?>
                    <li>
                      <?php
					  if( $cs_match_venue <> '' ){
						if($cs_match_venue == 'home'){
							echo '<span style="background:#579f4b;">'.__('H','goalklub').' </span>';
						}
						else if($cs_match_venue == 'neutral'){
							echo '<span style="background:#579f4b;">'.__('N','goalklub').' </span>';
						}
						else{
							echo '<span>A</span>';
						}
					  }
					  ?>
                        <div class="infotext">
                          <?php
						  if($cs_match_team_1 <> '' && $cs_match_team_2 <> ''){
							  $team_1 = get_term_by( 'slug', $cs_match_team_1, 'player-team' );
							  $team_2 = get_term_by( 'slug', $cs_match_team_2, 'player-team' );
							  
							  if($select_type == 'past'){
								  echo '<a href="'.get_permalink().'">v '.$team_2->name.'</a>';
							  }
							  else{
								  echo '<a href="'.get_permalink().'">'.$team_1->name.' v '.$team_2->name.'</a>';
							  }
						  }
						  else{
							  echo '<a href="'.get_permalink().'">'.get_the_title().'</a>';
						  }
						  ?>
                        <time><?php echo date_i18n(get_option('date_format'), ($cs_match_from_date)); ?> <?php echo date_i18n('H:i', ($cs_match_from_date)); ?></time>
                      </div>
                      <?php
					  if($select_type == 'past'){
						if($cs_match_team1_score <> '' and $cs_match_team2_score <> ''){
					  ?>
                        <div class="match-result"><?php echo cs_allow_special_char($cs_match_team1_score . '-' . $cs_match_team2_score); ?></div>
                      <?php
						}
					  }
					  ?>
                   </li>
				 <?php
				 
				 endwhile;
				 wp_reset_query();
				 echo '</ul>';
				
				 }
				 else {
					if ( function_exists( 'cs_fnc_no_result_found' ) ) { cs_fnc_no_result_found(false); }
				 }
			    echo cs_allow_special_char($after_widget);
			  }
		  }
}

if (function_exists('cs_widget_register')) {
    cs_widget_register('cs_matches');
}

/**
 * @MailChimp widget Class
 *
 *
 */

if ( ! class_exists( 'cs_mailchimp' ) ) { 
	class cs_mailchimp extends WP_Widget{
	
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
		 
	/**
	 * @init MailChimp Module
	 *
	 *
	 */
 
	 	  public function __construct() {
		
		parent::__construct(
		'cs_mailchimp', // Base ID
		__( 'CS : MailChimp','goalklub' ), // Name
		array( 'classname' => 'widget-newsletter', 'description' =>__('MailChimp Newsletter Widget','goalklub') ) // Args
		);
		} 
	 /**
	 * @MailChimp html form
	 *
	 *
	 */
	 function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
		$description = isset( $instance['description'] ) ? esc_attr( $instance['description'] ) : '';
	?>
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"><?php _e('Title','goalklub');?>
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
          </label>
        </p>
        
        <p>
          <label for="<?php echo cs_allow_special_char($this->get_field_id('description')); ?>"><?php _e('Description','goalklub');?> :
            <textarea class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('description')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('description')); ?>"><?php echo cs_allow_special_char($description); ?></textarea>
          </label>
        </p>
        
        <?php
        }
		
		/**
		 * @MailChimp update form data
		 *
		 *
		 */
		 function update($new_instance, $old_instance){
			  $instance = $old_instance;
			  $instance['title'] = $new_instance['title'];
			  $instance['description'] = $new_instance['description'];
			
			  return $instance;
		 }

		 /**
		 * @Display MailChimp widget
		 *
		 *
		 */
		 function widget($args, $instance){
			  global $cs_node;
		
			  extract($args, EXTR_SKIP);
			  $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			  $description = empty($instance['description']) ? ' ' : apply_filters('widget_title', $instance['description']);
				
			  echo cs_allow_special_char($before_widget);	
		
			  if (!empty($title) && $title <> ' '){
				  echo cs_allow_special_char($before_title);
				  echo cs_allow_special_char($title);
				  echo cs_allow_special_char($after_title);
			  }
		
			  global $wpdb, $post;
		
			  wp_reset_query();
			  
			   /**
				 * @Display MailChimp
				 *
				 *
				 */
				 if(isset($description) and $description <> ''){
					echo '<p>'.$description.'</p>';
				 }
				if ( function_exists( 'cs_custom_mailchimp' ) ) { echo cs_custom_mailchimp(); }
				
			    echo cs_allow_special_char($after_widget);
			  }
		  }
}

if (function_exists('cs_widget_register')) {
    cs_widget_register('cs_mailchimp');
}

/**
 * @Twitter Tweets widget Class
 *
 *
 */
if ( ! class_exists( 'cs_twitter_widget' ) ) { 
	class cs_twitter_widget extends WP_Widget {
		
		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
			 
		/**
		 * @init Twitter Module
		 *
		 *
		 */
	 
	 public function __construct() {
		
		parent::__construct(
		'cs_twitter_widget', // Base ID
		__( 'CS : Twitter Widget','goalklub' ), // Name
		array( 'classname' => 'twitter_widget', 'description' => 'Twitter Widget', ) // Args
		);
		} 
		
		/**
		 * @Twitter html form
		 *
		 *
		 */
		 function form($instance) {
			$instance = wp_parse_args((array) $instance, array('title' => ''));
			$title = $instance['title'];
			$username = isset($instance['username']) ? esc_attr($instance['username']) : '';
			$numoftweets = isset($instance['numoftweets']) ? esc_attr($instance['numoftweets']) : '';
 		?>
            <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> <span><?php _e('Title','goalklub');?> </span>
              <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
            <label for="screen_name">User Name<span class="required">(*)</span>: </label>
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('username')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('username')); ?>" type="text" value="<?php echo esc_attr($username); ?>" />
            <label for="tweet_count">
            <span><?php _e('Nums of Tweets','goalklub');?> </span>
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('numoftweets')); ?>" size="2" name="<?php echo cs_allow_special_char($this->get_field_name('numoftweets')); ?>" type="text" value="<?php echo esc_attr($numoftweets); ?>" />
            <div class="clear"></div>
            </label>
            <?php
		}
		/**
		 * @Twitter update form data 
		 *
		 *
		 */
		 function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['username'] = $new_instance['username'];
			$instance['numoftweets'] = $new_instance['numoftweets'];
			
 			return $instance;
		 }
 
		
		function widget($args, $instance) {
            global $cs_theme_options, $cs_twitter_arg;
			
			$cs_twitter_api_switch = isset($cs_theme_options['cs_twitter_api_switch']) ? $cs_theme_options['cs_twitter_api_switch'] : '';
            $cs_twitter_arg['consumerkey'] = isset($cs_theme_options['cs_consumer_key']) ? $cs_theme_options['cs_consumer_key'] : '';
            $cs_twitter_arg['consumersecret'] = isset($cs_theme_options['cs_consumer_secret']) ? $cs_theme_options['cs_consumer_secret'] : '';
            $cs_twitter_arg['accesstoken'] = isset($cs_theme_options['cs_access_token']) ? $cs_theme_options['cs_access_token'] : '';
            $cs_twitter_arg['accesstokensecret'] = isset($cs_theme_options['cs_access_token_secret']) ? $cs_theme_options['cs_access_token_secret'] : '';
            $cs_cache_limit_time = isset($cs_theme_options['cs_cache_limit_time']) ? $cs_theme_options['cs_cache_limit_time']: '';
            $cs_tweet_num_from_twitter = isset($cs_theme_options['cs_tweet_num_post']) ? $cs_theme_options['cs_tweet_num_post'] : '';
            $cs_twitter_datetime_formate = isset($cs_theme_options['cs_twitter_datetime_formate']);
            
            if ($cs_cache_limit_time == '') {
                $cs_cache_limit_time = 60;
            }
            if ($cs_twitter_datetime_formate == '') {
                $cs_twitter_datetime_formate = 'time_since';
            }
            if ($cs_tweet_num_from_twitter == '') {
                $cs_tweet_num_from_twitter = 5;
            }
			if($cs_twitter_api_switch == 'on'){
            extract($args, EXTR_SKIP);
            $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
            $title = wp_specialchars_decode(stripslashes($title));
            $username = $instance['username'];
            $numoftweets = $instance['numoftweets'];
            if ($numoftweets == '') {
                $numoftweets = 2;
            }
            echo cs_allow_special_char($before_widget);
            // WIDGET display CODE Start
            if (!empty($title) && $title <> ' ') {
                echo cs_allow_special_char($before_title . $title . $after_title);
            }
            if (strlen($username) > 1) {
				if($cs_twitter_arg['consumerkey'] <> '' && $cs_twitter_arg['consumersecret'] <> '' &&  $cs_twitter_arg['accesstoken'] <> '' && $cs_twitter_arg['accesstokensecret'] <> '')
				{
					require_once get_template_directory() . '/include/theme-components/cs-twitter/display-tweets.php';
                	display_tweets($username,$cs_twitter_datetime_formate , $cs_tweet_num_from_twitter, $numoftweets, $cs_cache_limit_time);
				}
				else
				{
					echo '<p>'.__('Please Set Twitter API','goalklub').'</p>';
				}
                
            }
			echo cs_allow_special_char($after_widget);
        }
	}
 	}
}

if (function_exists('cs_widget_register')) {
    cs_widget_register('cs_twitter_widget');
}


/**
 * @latest reviews widget Class
 *
 *
 */
class contactinfo extends WP_Widget{
	
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
		 
	/**
	 * @init Contact Info Module
	 *
	 *
	 */
	 
 
		  public function __construct() {
		
		parent::__construct(
		'contactinfo', // Base ID
		__( 'CS : Contact info','goalklub' ), // Name
		array( 'classname' => 'widget_text', 'description' =>__('Footer Contact Information','goalklub') ) // Args
		);
		} 
	/**
	 * @Contact Info html form
	 *
	 *
	 */
	function form($instance){
		$instance = wp_parse_args( (array) $instance );
		$title 	= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$image_url 	= isset( $instance['image_url'] ) ? esc_attr( $instance['image_url'] ) : '';	
		$address 	= isset( $instance['address'] ) ? esc_attr( $instance['address'] ) : '';	
		$phone 		= isset( $instance['phone'] ) ? esc_attr( $instance['phone'] ) : '';
		$fax 		= isset( $instance['fax'] ) ? esc_attr( $instance['fax'] ) : '';	
		$email 		= isset( $instance['email'] ) ? esc_attr( $instance['email'] ) : '';
		$website	= isset( $instance['website'] ) ? esc_attr( $instance['website'] ) : '';
		$randomID   = rand(40, 9999999);
 	?>
    <p style="margin-top:0px; float:left;">
     	<label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> <span><?php _e('Title','goalklub');?> </span>
              <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
            </p>
    <ul class="form-elements-widget">
    	
      <li class="to-label" style="margin-top:20px;">
        <label><?php _e('Image','goalklub');?></label>
      </li>
      <li class="to-field">
        <input id="form-widget_cs_widget_logo<?php echo absint($randomID)?>" name="<?php echo cs_allow_special_char($this->get_field_name('image_url')); ?>" type="hidden" class="" value="<?php echo esc_url($image_url); ?>"/>
        <label class="browse-icon" style="width:100%;">
        <input name="form-widget_cs_widget_logo<?php echo absint($randomID)?>"  type="button" class="uploadMedia left" value="<?php _e('Browse','goalklub');?>"/>
        </label>
      </li>
    </ul>
    <div class="page-wrap"  id="form-widget_cs_widget_logo<?php echo absint($randomID);?>_box" style="margin-top:10px; margin-bottom:10px; float:left; overflow:hidden; display:<?php echo cs_allow_special_char($image_url)&& cs_allow_special_char($image_url) !='' ? 'inline' : 'none';?>">
      <div class="gal-active">
        <div class="dragareamain" style="padding-bottom:0px;">
          <ul id="gal-sortable" style="margin-bottom:0px;">
            <li class="ui-state-default" style="margin:6px">
              <div class="thumb-secs"> <img src="<?php echo cs_allow_special_char($image_url); ?>"  id="form-widget_cs_widget_logo<?php echo absint($randomID);?>_img" style="max-height:80px; max-width:180px"  />
                <div class="gal-edit-opts"> <a   href="javascript:del_media('form-widget_cs_widget_logo<?php echo absint($randomID)?>')" class="delete"></a> </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
            
	<p style="margin-top:0px; float:left;">
		<label for="<?php echo cs_allow_special_char($this->get_field_id('address')); ?>"><?php _e('Address','goalklub');?> <br />
			<textarea cols="20" rows="5" id="<?php echo cs_allow_special_char($this->get_field_id('address')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('address')); ?>" style="width:315px"><?php echo esc_attr($address); ?></textarea>
		</label>
	</p>
	<p style="margin-top:0px; float:left;">
		<label for="<?php echo cs_allow_special_char($this->get_field_id('phone')); ?>"><?php _e('Phone','goalklub');?> <br />
			<input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('phone')); ?>" size="40"
            name="<?php echo cs_allow_special_char($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr($phone); ?>" />
		</label>
     </p>
     
     <p style="margin-top:0px; float:left;">
        <label for="<?php echo cs_allow_special_char($this->get_field_id('fax')); ?>"><?php _e('Fax','goalklub');?><br />
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('fax')); ?>" size="40" 
            name="<?php echo cs_allow_special_char( $this->get_field_name('fax')); ?>" type="text" value="<?php echo esc_attr($fax); ?>" />
        </label>
    </p>
    
    <p style="margin-top:0px; float:left;">
        <label for="<?php echo cs_allow_special_char($this->get_field_id('email')); ?>"><?php _e('Email','goalklub');?><br />
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('email')); ?>" size="40" 
            name="<?php echo cs_allow_special_char($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
        </label>
    </p>
    
    <p style="margin-top:0px; float:left;">
        <label for="<?php echo cs_allow_special_char($this->get_field_id('website')); ?>"><?php _e('Website','goalklub');?> <br />
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('website')); ?>" size="40" 
            name="<?php echo cs_allow_special_char($this->get_field_name('website')); ?>" type="text" value="<?php echo esc_attr($website); ?>" />
        </label>
    </p>
	<?php
	}
	
	/**
	 * @Update Info html form
	 *
	 *
	 */
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] 	= $new_instance['title'];
		$instance['image_url'] 	= $new_instance['image_url'];
		$instance['address']   	= $new_instance['address'];
		$instance['phone']     	= $new_instance['phone'];
		$instance['fax']       	= $new_instance['fax'];
		$instance['email']     	= $new_instance['email'];
		$instance['website']   	= $new_instance['website'];
 		return $instance;
	}
	
	/**
	 * @Widget Info html form
	 *
	 *
	 */
	function widget($args, $instance){
		global $px_node;
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$image_url = empty($instance['image_url']) ? '' : apply_filters('widget_title', $instance['image_url']);
		$address = empty($instance['address']) ? '' : apply_filters('widget_title', $instance['address']);		
		$phone = empty($instance['phone']) ? '' : apply_filters('widget_title', $instance['phone']);
		$fax = empty($instance['fax']) ? '' : apply_filters('widget_title', $instance['fax']);
		$email = empty($instance['email']) ? '' : apply_filters('widget_title', $instance['email']);
		$website = empty($instance['website']) ? '' : apply_filters('widget_title', $instance['website']);
		echo cs_allow_special_char($before_widget);	
		if (!empty($title) && $title <> ' '){
				echo cs_allow_special_char($before_title . $title . $after_title);
		}
		if ( isset ( $image_url ) && $image_url != '' ) {
			echo '<div class="logo"><a href="'.esc_url( home_url() ).'"><img src="'.$image_url.'" alt="No image" /></a></div>';
		}
         
			echo '<ul class="group">';
			if(isset($address) and $address<>''){
				echo '<li><i class="icon icon-list3"></i><p>'.do_shortcode(wp_specialchars_decode(nl2br($address))).'</p></li>';
			}
			if(isset($phone) and $phone<>''){
				echo '<li><i class="icon icon-arrow-down12"></i><p>'.__('Phone','goalklub').wp_specialchars_decode($phone).'</p></li>';
			}
			if(isset($fax) and $fax<>''){
				echo '<li><i class="icon icon-circle-full"></i><p>'.__('Fax','goalklub').wp_specialchars_decode($fax).'</p></li>';
			}
			if(isset($email) and $email<>''){
				echo '<li><i class="icon icon-envelope-o"></i><p>'.__('Email','goalklub').wp_specialchars_decode($email).'</p></li>';
			}
			if(isset($website) and $website<>''){
				echo '<li><i class="icon icon-steam-square"></i><p>'.wp_specialchars_decode($website).'</p></li>';
			}
			echo '</ul>';
			

    echo cs_allow_special_char($after_widget);
	}
}

if (function_exists('cs_widget_register')) {
    cs_widget_register('contactinfo');
}
