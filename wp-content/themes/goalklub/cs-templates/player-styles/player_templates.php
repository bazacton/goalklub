<?php 
/**
 * File Type: Player Templates Class
 */
 

if ( !class_exists('CS_PlayerTemplates') ) {
	
	class CS_PlayerTemplates
	{
		function __construct()
		{
			// Constructor Code here..
		}
	
		//======================================================================
		// Player Classic View
		//======================================================================
		public function cs_grid_view($atts,$cs_layout='col-md-4') {
			global $post;
			
			$cs_player = get_post_meta(get_the_ID(), "player", true);
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
				
			$width = '262';
			$height = '385';
			$title_limit = 1000;
			$image_id = get_post_thumbnail_id( $post->ID );
			$image_url = cs_attachment_image_src($image_id, $width, $height);
			
			if ( $image_url == '') {
				$image_url	= get_template_directory_uri().'/assets/images/no-image4x3.jpg';
			}
			?>
            <div class="<?php echo cs_allow_special_char( $cs_layout);?>">
              <article class="cs-team">
                <figure><a href="<?php the_permalink();?>"><img alt="<?php the_title();?>" src="<?php echo esc_url( $image_url );?>"></a></figure>
                <div class="text">
                  <header>
                    <?php
					if($cs_player_position_no <> ''){
					?>
                    <span class="player-no"><?php //echo cs_allow_special_char($cs_player_position_no); ?></span>
                    <?php
					}
					?>
                    <h4><a href="<?php the_permalink();?>"><?php echo substr(get_the_title(), 0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h4>
                    <?php
					if($cs_player_position_name <> ''){
					?>
                    <h6><?php echo cs_allow_special_char($cs_player_position_name); ?></h6>
                    <?php
					}
					?>
                  </header>
                </div>
              </article>
            </div>
            <?php
			
		}
		//===========//
		
		
		//======================================================================
		// Player Modern View
		//======================================================================
		public function cs_slider_view($atts) {
			global $post;

			$cs_player = get_post_meta(get_the_ID(), "player", true);
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
				
			$width = '262';
			$height = '385';
			$title_limit = 30;
			$image_id = get_post_thumbnail_id( $post->ID );
			$image_url = cs_attachment_image_src($image_id, $width, $height);
			if ( $image_url == '') {
				$image_url	= get_template_directory_uri().'/assets/images/no-image4x3.jpg';
			}
			?>
                    <li class="item col-md-3">
                     <article class="cs-team">
                     <?php if($image_url<>''){ ?>
                         <figure><a href="<?php the_permalink();?>"><img alt="<?php the_title();?>" src="<?php echo esc_url( $image_url );?>"></a></figure>
                     <?php } ?>
                          <div class="text">
                            <header>
                              <?php
								if($cs_player_position_no <> ''){
								echo '<span class="player-no">'. $cs_player_position_no.'</span>';
								}
								?>
                              <h4><a href="<?php the_permalink();?>"><?php echo substr(get_the_title(), 0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h4>
                             <?php
							 	 if($cs_player_position_name <> ''){
                                  echo '<h6>'.$cs_player_position_name.'</h6>';
                                }
                                ?>
                            </header>
                          </div>
                      </article>
                    </li>
            <?php
			
		}
		//===========//
		
	}
}