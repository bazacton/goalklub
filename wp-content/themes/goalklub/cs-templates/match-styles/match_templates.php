<?php
/**
 * File Type: Match Templates Class
 * @copyright Copyright (c) 2014, Chimp Studio
 */

if (!class_exists('CS_MatchTemplates')) {

	class CS_MatchTemplates {

		function __construct() {
			// Constructor Code here..
		}

		//======================================================================
		// Match Featured View
		//======================================================================
		public function cs_featured_view($atts) {
			global $post;
			$cs_match = get_post_meta(get_the_ID(), "match", true);
			if ($cs_match != "") {
				$cs_xmlObject = new SimpleXMLElement($cs_match);
				$cs_match_from_date = $cs_xmlObject->cs_match_from_date;
				$cs_match_start_time = $cs_xmlObject->cs_match_start_time;
				$cs_match_end_time = $cs_xmlObject->cs_match_end_time;
				$cs_match_all_day = $cs_xmlObject->cs_match_all_day;
				$cs_match_ticket_title = $cs_xmlObject->cs_match_ticket_options;
				$cs_match_buy_now = $cs_xmlObject->cs_match_buy_now;
				$cs_match_ticket_color = $cs_xmlObject->cs_match_ticket_color;
				$cs_match_team_1 = $cs_xmlObject->cs_match_team_1;
				$cs_match_team_2 = $cs_xmlObject->cs_match_team_2;
				$cs_match_location = $cs_xmlObject->cs_match_location;
				$cs_match_team1_score = $cs_xmlObject->cs_match_team1_score;
				$cs_match_team2_score = $cs_xmlObject->cs_match_team2_score;
				$cs_match_summary = $cs_xmlObject->cs_match_summary;
				$cs_match_attendance = $cs_xmlObject->cs_match_attendance;
				$cs_match_result_status = $cs_xmlObject->cs_match_result_status;
				$cs_match_venue = $cs_xmlObject->cs_match_venue;

			} else {
				$cs_match_from_date = '';
				$cs_match_start_time = '';
				$cs_match_end_time = '';
				$cs_match_all_day = '';
				$cs_match_ticket_title = '';
				$cs_match_buy_now = '';
				$cs_match_ticket_color = '';
				$cs_match_team_1 = '';
				$cs_match_team_2 = '';
				$cs_match_location = '';
				$cs_match_team1_score = '';
				$cs_match_team2_score = '';
				$cs_match_summary = '';
				$cs_match_attendance = '';
				$cs_match_result_status = '';
				$cs_match_venue = '';

				if (!isset($cs_xmlObject)) {
					$cs_xmlObject = new stdClass();
				}

			}

			$location = get_term_by('name', $cs_match_location, 'match-location', 'OBJECT', 'raw');
			if (is_array($location) && isset($location->name)){
				$cs_match_location = $location->name;
			}
			$team_image = $this->cs_get_category_image($cs_match_team_1, 'player-team');
			$team_image_two = $this->cs_get_category_image($cs_match_team_2, 'player-team');
			$team_name_1 = $this->cs_get_team_name($cs_match_team_1, 'player-team');
			$team_name_2 = $this->cs_get_team_name($cs_match_team_2, 'player-team');

			$background = '';

			if (isset($cs_match_ticket_color) && $cs_match_ticket_color != '') {
				$color = $cs_match_ticket_color;
				$background = ' style="background-color:' . $color . ' !important; color:#FFF !important;"';
			}

			$width = '850';
			$height = '259';
			$image_url = cs_get_post_img_src($post->ID, $width, $height);
			$section_bg = '';
			if ($image_url != '') {
				$section_bg = 'background:url(' . $image_url . ') no-repeat; ';
			}

			?>
            <div class="post-<?php echo esc_attr($post->ID); ?>">
             <div class="featured-event" style=" <?php echo cs_allow_special_char($section_bg); ?>">
             <?php if (isset($cs_match_result_status) && $cs_match_result_status != '') {?>
                <style>
					.post-<?php echo esc_attr($post->ID); ?> span.win:before {
						background: none repeat scroll 0 0 <?php echo cs_allow_special_char($color); ?> !important;
					}
				</style>
                <span class="win" <?php echo force_back($background, false); ?>><?php echo esc_attr($cs_match_result_status); ?></span>
             <?php }?>
                <div class="cs-sc-team">
                    <ul>
                        <li>
                            <figure>
                                <?php if (isset($team_image) && $team_image != '') {?>
                                	<a href="<?php echo the_permalink(); ?>"><img alt="No image" src="<?php echo esc_url($team_image); ?>"></a>
                                <?php }?>
                                <?php if (isset($team_name_1) && $team_name_1 != '') {?>
                                	<figcaption><a href="<?php echo the_permalink(); ?>"><?php echo esc_attr($team_name_1); ?></a></figcaption>
                                <?php }?>
                            </figure>
                        </li>
                        <li>
                            <div class="match-score">
                                <span <?php echo force_back($background, false); ?>><?php echo esc_attr(ucwords(substr($cs_match_venue, 0, 1))); ?></span>
                                <strong><?php echo esc_attr($cs_match_team1_score); ?><small>:</small><?php echo esc_attr($cs_match_team2_score); ?></strong>
								<?php if (isset($cs_match_attendance) && $cs_match_attendance != '') {?>
                                <ul>
                                    <li><i class="icon-group"></i><?php esc_html_e('Attendance', 'goalklub');?><?php echo esc_attr($cs_match_attendance); ?></li>
                                </ul>
                                <?php }?>
                            </div>
                        </li>
                        <li class="right-side">
                           <figure>
                                <?php if (isset($team_image_two) && $team_image_two != '') {?>
                                	<a href="<?php echo the_permalink(); ?>"><img alt="No image" src="<?php echo esc_url($team_image_two); ?>"></a>
                                <?php }?>
                                <?php if (isset($team_name_2) && $team_name_2 != '') {?>
                                	<figcaption><a href="<?php echo the_permalink(); ?>"><?php echo esc_attr($team_name_2); ?></a></figcaption>
                                <?php }?>
                            </figure>
                        </li>
                    </ul>
                </div>
                <div class="bottom-event-panel">
                    <ul class="post-option">
                        <li><?php $this->cs_get_categories($atts['cs_match_cat']);?></li>
                        <li><i class=" icon-calendar11"></i>
							
							<?php
							echo esc_attr(date_i18n(get_option('date_format'), strtotime($cs_match_from_date))) . ' ';

			if (isset($cs_match_all_day) && $cs_match_all_day == 'on') {
				_e('All Day', 'goalklub');
			} else {
				if (isset($cs_match_start_time) && $cs_match_start_time != '') {
					$match_str_time = $this->cs_format_date($cs_match_start_time);
					echo cs_allow_special_char($match_str_time) . ' ';
				}
				if (isset($cs_match_end_time) && $cs_match_end_time != '') {
					//_e(' - ', 'goalklub');
					$match_end_time = $this->cs_format_date($cs_match_end_time);
					echo ' ' . cs_allow_special_char($match_end_time);
				}
			}
			?>
                        </li>
                        <?php if (isset($cs_match_location) && $cs_match_location != '') {?>
                        <li><i class=" icon-location6"></i><?php echo esc_attr(ucwords($cs_match_location)); ?></li>
                        <?php }?>
                    </ul>
                </div>
               </div>
            </div>

		<?php
}

		//======================================================================
		// Match Featured View
		//======================================================================
		public function cs_upcomming_featured_view($atts) {
			global $post;

			$cs_match = get_post_meta(get_the_ID(), "match", true);
			if ($cs_match != "") {
				$cs_xmlObject = new SimpleXMLElement($cs_match);
				$cs_match_from_date = $cs_xmlObject->cs_match_from_date;
				$cs_match_start_time = $cs_xmlObject->cs_match_start_time;
				$cs_match_end_time = $cs_xmlObject->cs_match_end_time;
				$cs_match_all_day = $cs_xmlObject->cs_match_all_day;
				$cs_match_ticket_title = $cs_xmlObject->cs_match_ticket_options;
				$cs_match_buy_now = $cs_xmlObject->cs_match_buy_now;
				$cs_match_ticket_color = $cs_xmlObject->cs_match_ticket_color;
				$cs_match_team_1 = $cs_xmlObject->cs_match_team_1;
				$cs_match_team_2 = $cs_xmlObject->cs_match_team_2;
				$cs_match_location = $cs_xmlObject->cs_match_location;
				$cs_match_team1_score = $cs_xmlObject->cs_match_team1_score;
				$cs_match_team2_score = $cs_xmlObject->cs_match_team2_score;
				$cs_match_summary = $cs_xmlObject->cs_match_summary;
				$cs_match_attendance = $cs_xmlObject->cs_match_attendance;
				$cs_match_result_status = $cs_xmlObject->cs_match_result_status;
				$cs_match_venue = $cs_xmlObject->cs_match_venue;

			} else {
				$cs_match_from_date = '';
				$cs_match_start_time = '';
				$cs_match_end_time = '';
				$cs_match_all_day = '';
				$cs_match_ticket_title = '';
				$cs_match_buy_now = '';
				$cs_match_ticket_color = '';
				$cs_match_team_1 = '';
				$cs_match_team_2 = '';
				$cs_match_location = '';
				$cs_match_team1_score = '';
				$cs_match_team2_score = '';
				$cs_match_summary = '';
				$cs_match_attendance = '';
				$cs_match_result_status = '';
				$cs_match_venue = '';

				if (!isset($cs_xmlObject)) {
					$cs_xmlObject = new stdClass();
				}

			}

			$location = get_term_by('name', $cs_match_location, 'match-location', 'OBJECT', 'raw');
			if(is_array($location) && isset( $location->name)){
				$cs_match_location = $location->name;
			}

			$team_image = $this->cs_get_category_image($cs_match_team_1, 'player-team');
			$team_image_two = $this->cs_get_category_image($cs_match_team_2, 'player-team');
			$team_name_1 = $this->cs_get_team_name($cs_match_team_1, 'player-team');
			$team_name_2 = $this->cs_get_team_name($cs_match_team_2, 'player-team');

			if (isset($cs_match_ticket_color) && $cs_match_ticket_color != '') {
				$color = $cs_match_ticket_color;
				$background = ' style="background-color:' . $color . ' !important; color:#FFF !important;"';
			}

			$width = '850';
			$height = '259';
			$image_url = cs_get_post_img_src($post->ID, $width, $height);
			$section_bg = '';
			if ($image_url != '') {
				$section_bg = 'background:url(' . $image_url . ') no-repeat; ';
			}

			cs_countdown();
			$obj = $this->cs_get_date_difference($post->ID);

			$year = $obj->y;
			$month = $obj->m + date('m');
			$days = $obj->d + date('d');
			$hours = $obj->h + date('H');
			$mins = $obj->i + date('i');
			$secs = $obj->s + date('s');
			$cs_counter = cs_generate_random_string(3);
			$color = '';
			?>
            <div class="cs-upcomming post-<?php echo esc_attr($post->ID); ?>">
                <div class="featured-event event-editor hello 3" style=" <?php echo cs_allow_special_char($section_bg); ?>">
                 <style scoped>
                    .post-<?php echo esc_attr($post->ID); ?> span.win:before {
                        background: none repeat scroll 0 0 <?php echo cs_allow_special_char($color); ?> !important;
                    }

                </style>
            <div class="countdownit">
              <div id="matchCountdown_<?php echo esc_attr($cs_counter); ?>"></div>
            </div>
              <div class="cs-sc-team">
                <ul>
                  <li>
                    <figure>
                      <?php if (isset($team_image) && $team_image != '') {?>
                       <a href="<?php echo the_permalink(); ?>"><img alt="No image" src="<?php echo esc_url($team_image); ?>"></a>
                      <?php }

			$background = '';
			?>
                      <?php if (isset($team_name_1) && $team_name_1 != '') {?>
                       <figcaption><a href="<?php echo the_permalink(); ?>"><?php echo esc_attr($team_name_1); ?>dad</a></figcaption>
                      <?php }?>
                    </figure>
                    </li>
                    <li>
                    <div class="match-score">
                      <small>VS<!--< ?php _e('VS', 'goalklub');?>--></small>
                      <span <?php echo force_back($background, false); ?>><?php echo esc_attr(ucwords(substr($cs_match_venue, 0, 1))); ?></span>
                    </div>
                    </li>
                    <li class="right-side">
                      <figure>
                          <?php if (isset($team_image_two) && $team_image_two != '') {?>
                           <a href="<?php echo the_permalink(); ?>"><img alt="No image" src="<?php echo esc_url($team_image_two); ?>"></a>
                          <?php }?>
                          <?php if (isset($team_name_2) && $team_name_2 != '') {?>
                            <figcaption><a href="<?php echo the_permalink(); ?>"><?php echo esc_attr($team_name_2); ?></a></figcaption>
                          <?php }?>
                      </figure>
                    </li>
                  </ul>
                </div>
                <div class="bottom-event-panel">
                  <ul class="post-option">
                    <li><?php $this->cs_get_categories($atts['cs_match_cat']);?></li>
                    <li><i class=" icon-calendar11"></i>
                        <?php
echo esc_attr(date_i18n(get_option('date_format'), strtotime($cs_match_from_date))) ;
?><span>
			<?php
			if (isset($cs_match_all_day) && $cs_match_all_day == 'on') {
				_e('All Day', 'goalklub');
				

				

			} else {
				if (isset($cs_match_start_time) && $cs_match_start_time != '') {
					$match_str_time = $this->cs_format_date($cs_match_start_time);
					echo cs_allow_special_char($match_str_time) . ' ';
				}
				if (isset($cs_match_end_time) && $cs_match_end_time != '') {
					/*_e(' - ', 'goalklub');*/
					$match_end_time = $this->cs_format_date($cs_match_end_time);
					echo '-' . cs_allow_special_char($match_end_time);
				}
			}
			?></span>
                    </li>

                    <?php if (isset($cs_match_location) && $cs_match_location != '') {?>
                    <li><i class=" icon-location6"></i><?php echo esc_attr(ucwords($cs_match_location)); ?></li>
                    <?php }?>
                  </ul>
                </div>
              </div>
            </div>
			<script>
               jQuery(function () {
                  var austDay = new Date();
                  austDay = new Date(austDay.getFullYear() + <?php echo intval($year); ?>, <?php echo intval($month); ?>-1, <?php echo intval($days); ?>, <?php echo intval($hours); ?>, <?php echo intval($mins); ?>, <?php echo intval($secs); ?>);
                  jQuery('#matchCountdown_<?php echo esc_attr($cs_counter); ?>').countdown({until: austDay});
                  jQuery('#year').text(austDay.getFullYear());

                });
            </script>
		<?php
}

		//======================================================================
		// Match Time Formate
		//======================================================================
		public function cs_format_date($time) {
			global $cs_theme_options;
			if (isset($cs_theme_options['cs_time_formate']) && $cs_theme_options['cs_time_formate'] == '24 hour') {
				return date('H:i', strtotime($time));
			} else if (isset($cs_theme_options['cs_time_formate']) && $cs_theme_options['cs_time_formate'] == '12 hour') {
				return date('g:i', strtotime($time));
			} else {
				return date('g:i', strtotime($time));
			}

		}

		//======================================================================
		// Get Category Image
		//======================================================================
		public function cs_get_category_image($slug, $taxonomy) {
			global $post, $cs_theme_options;
			$team_image = '';
			$object = get_term_by('slug', $slug, $taxonomy, 'OBJECT', 'raw');
			if (isset($object->term_id)) {$t_id = $object->term_id;} else { $t_id = "";}
			$cat_meta = get_option("team_image_$t_id");
			return $team_image = $cat_meta['icon'];
		}

		//======================================================================
		// Get Tean Name
		//======================================================================
		public function cs_get_team_name($slug, $taxonomy) {
			global $post, $cs_theme_options;
			$team_name = '';
			$object = get_term_by('slug', $slug, $taxonomy, 'OBJECT', 'raw');
			$team_name = $object->name;
			return $team_name;
		}

		//======================================================================
		// Match Time Formate
		//======================================================================
		public function cs_get_date_difference($post_id) {
			global $post;

			$post_id = $post_id ? $post_id : $post->ID;
			$matchDate = get_post_meta($post_id, "cs_match_from_date", true);
			$matchDate = date('Y-m-d H:i', $matchDate);
			$currentDate = new DateTime(date('Y-m-d H:i'));
			$matchDate = new DateTime($matchDate);
			$obj = $matchDate->diff($currentDate);
			return $obj;
		}

		//======================================================================
		// Match List View
		//======================================================================
		public function cs_list_view($atts) {
			global $post;

			$cs_match = get_post_meta(get_the_ID(), "match", true);
			if ($cs_match != "") {
				$cs_xmlObject = new SimpleXMLElement($cs_match);
				$cs_match_from_date = $cs_xmlObject->cs_match_from_date;
				$cs_match_start_time = $cs_xmlObject->cs_match_start_time;
				$cs_match_end_time = $cs_xmlObject->cs_match_end_time;
				$cs_match_all_day = $cs_xmlObject->cs_match_all_day;
				$cs_match_ticket_title = $cs_xmlObject->cs_match_ticket_options;
				$cs_match_buy_now = $cs_xmlObject->cs_match_buy_now;
				$cs_match_ticket_color = $cs_xmlObject->cs_match_ticket_color;
				$cs_match_team_1 = $cs_xmlObject->cs_match_team_1;
				$cs_match_team_2 = $cs_xmlObject->cs_match_team_2;
				$cs_match_location = $cs_xmlObject->cs_match_location;
				$cs_match_team1_score = $cs_xmlObject->cs_match_team1_score;
				$cs_match_team2_score = $cs_xmlObject->cs_match_team2_score;
				$cs_match_summary = $cs_xmlObject->cs_match_summary;
				$cs_match_attendance = $cs_xmlObject->cs_match_attendance;
				$cs_match_result_status = $cs_xmlObject->cs_match_result_status;
				$cs_match_venue = $cs_xmlObject->cs_match_venue;

			} else {
				$cs_match_from_date = '';
				$cs_match_start_time = '';
				$cs_match_end_time = '';
				$cs_match_all_day = '';
				$cs_match_ticket_title = '';
				$cs_match_buy_now = '';
				$cs_match_ticket_color = '';
				$cs_match_team_1 = '';
				$cs_match_team_2 = '';
				$cs_match_location = '';
				$cs_match_team1_score = '';
				$cs_match_team2_score = '';
				$cs_match_summary = '';
				$cs_match_attendance = '';
				$cs_match_result_status = '';
				$cs_match_venue = '';

				if (!isset($cs_xmlObject)) {
					$cs_xmlObject = new stdClass();
				}

			}

			$location = get_term_by('name', $cs_match_location, 'match-location', 'OBJECT', 'raw');
			$cs_match_location = $location->name;

			$team_image = $this->cs_get_category_image($cs_match_team_1, 'player-team');
			$team_image_two = $this->cs_get_category_image($cs_match_team_2, 'player-team');
			$team_name_1 = $this->cs_get_team_name($cs_match_team_1, 'player-team');
			$team_name_2 = $this->cs_get_team_name($cs_match_team_2, 'player-team');

			if (isset($cs_match_ticket_color) && $cs_match_ticket_color != '') {
				$color = $cs_match_ticket_color;
				$background = ' style="background-color:' . $color . ' !important; color:#FFF !important;"';
			}

			$width = '850';
			$height = '259';
			$image_url = cs_get_post_img_src($post->ID, $width, $height);
			?>
            <article class="post-<?php echo esc_attr($post->ID); ?>">
                    <div class="calendar-date">
                        <span <?php echo force_back($background, false); ?>><?php echo esc_attr(ucwords(substr($cs_match_venue, 0, 1))); ?></span>
                        <time><?php echo esc_attr($cs_match_team1_score); ?></time>
                    </div>
                    <div class="text">
                        <?php if (isset($cs_match_result_status) && $cs_match_result_status != '') {?>
						<style scoped>
                            .post-<?php echo esc_attr($post->ID); ?> span.win:before {
                                background: none repeat scroll 0 0 <?php echo cs_allow_special_char($color); ?> !important;
                            }
							.post-<?php echo esc_attr($post->ID); ?> {
								border-left: 2px solid <?php echo cs_allow_special_char($color); ?> !important;

							}
                        </style>
                        <span class="win" <?php echo force_back($background, false); ?>><?php echo esc_attr($cs_match_result_status); ?></span>
                        <?php }?>
                        <h2>
                            <?php if (isset($team_name_1) && $team_name_1 != '') {?>
                            <a href="<?php echo the_permalink(); ?>"><?php echo esc_attr($team_name_1); ?></a>
                            <?php }?>

                            <span><?php esc_html_e('VS', 'goalklub');?></span>

							<?php if (isset($team_name_2) && $team_name_2 != '') {?>
                            <a href="<?php echo the_permalink(); ?>"><?php echo esc_attr($team_name_2); ?></a>
                            <?php }?>
                        </h2>
                        <ul class="post-option">
                            <li><?php $this->cs_get_categories($atts['cs_match_cat']);?></li>
                            <li><i class=" icon-calendar11"></i>
                            	<?php

			echo esc_attr(date_i18n(get_option('date_format'), strtotime($cs_match_from_date))) . ' ';
			if (isset($cs_match_all_day) && $cs_match_all_day == 'on') {
				_e('All Day', 'goalklub');
			} else {
				if (isset($cs_match_start_time) && $cs_match_start_time != '') {
					$match_str_time = $this->cs_format_date($cs_match_start_time);
					echo cs_allow_special_char($match_str_time) . ' ';
				}
				if (isset($cs_match_end_time) && $cs_match_end_time != '') {
					/*_e(' - ', 'goalklub');*/

					$match_end_time = $this->cs_format_date($cs_match_end_time);
					echo ' ' . cs_allow_special_char($match_end_time);
				}
			}
			?>
                            </li>

							<?php if (isset($cs_match_location) && $cs_match_location != '') {?>
                            	<li><i class=" icon-location6"></i><?php echo esc_attr(ucwords($cs_match_location)); ?></li>
                            <?php }?>
                        </ul>
                    </div>
                    <div class="match-result"><span><?php echo esc_attr($cs_match_team2_score); ?></span></div>
                </article>

		<?php
}

		//======================================================================
		// Match List View
		//======================================================================
		public function cs_upcomming_list_view($atts) {
			global $post;

			$cs_match = get_post_meta(get_the_ID(), "match", true);
			if ($cs_match != "") {
				$cs_xmlObject = new SimpleXMLElement($cs_match);
				$cs_match_from_date = $cs_xmlObject->cs_match_from_date;
				$cs_match_start_time = $cs_xmlObject->cs_match_start_time;
				$cs_match_end_time = $cs_xmlObject->cs_match_end_time;
				$cs_match_all_day = $cs_xmlObject->cs_match_all_day;
				$cs_match_ticket_title = $cs_xmlObject->cs_match_ticket_options;
				$cs_match_buy_now = $cs_xmlObject->cs_match_buy_now;
				$cs_match_ticket_color = $cs_xmlObject->cs_match_ticket_color;
				$cs_match_team_1 = $cs_xmlObject->cs_match_team_1;
				$cs_match_team_2 = $cs_xmlObject->cs_match_team_2;
				$cs_match_location = $cs_xmlObject->cs_match_location;
				$cs_match_team1_score = $cs_xmlObject->cs_match_team1_score;
				$cs_match_team2_score = $cs_xmlObject->cs_match_team2_score;
				$cs_match_summary = $cs_xmlObject->cs_match_summary;
				$cs_match_attendance = $cs_xmlObject->cs_match_attendance;
				$cs_match_result_status = $cs_xmlObject->cs_match_result_status;
				$cs_match_venue = $cs_xmlObject->cs_match_venue;

			} else {
				$cs_match_from_date = '';
				$cs_match_start_time = '';
				$cs_match_end_time = '';
				$cs_match_all_day = '';
				$cs_match_ticket_title = '';
				$cs_match_buy_now = '';
				$cs_match_ticket_color = '';
				$cs_match_team_1 = '';
				$cs_match_team_2 = '';
				$cs_match_location = '';
				$cs_match_team1_score = '';
				$cs_match_team2_score = '';
				$cs_match_summary = '';
				$cs_match_attendance = '';
				$cs_match_result_status = '';
				$cs_match_venue = '';

				if (!isset($cs_xmlObject)) {
					$cs_xmlObject = new stdClass();
				}

			}

			$team_image = $this->cs_get_category_image($cs_match_team_1, 'player-team');
			$team_image_two = $this->cs_get_category_image($cs_match_team_2, 'player-team');
			$team_name_1 = $this->cs_get_team_name($cs_match_team_1, 'player-team');
			$team_name_2 = $this->cs_get_team_name($cs_match_team_2, 'player-team');

			if (isset($cs_match_ticket_color) && $cs_match_ticket_color != '') {
				$color = $cs_match_ticket_color;
				$background = ' style="background-color:' . $color . ' !important; color:#FFF !important;"';
			}

			$width = '850';
			$height = '259';
			$image_url = cs_get_post_img_src($post->ID, $width, $height);
			?>
            <article class="post-<?php echo esc_attr($post->ID); ?> event-fixtures">
                <div class="calendar-date">
                    <style scoped>
						.post-<?php echo esc_attr($post->ID); ?> span.win:before {
							background: none repeat scroll 0 0 <?php echo cs_allow_special_char($color); ?> !important;
						}
						.post-<?php echo esc_attr($post->ID); ?> {
							border-left: 2px solid <?php echo cs_allow_special_char($color); ?> !important;

						}
					</style>
                    <span <?php echo force_back($background, false); ?>><?php echo esc_attr(ucwords(substr($cs_match_venue, 0, 1))); ?></span>
                    <figure>
						<?php if (isset($team_image) && $team_image != '') {?>
                            <a href="<?php echo the_permalink(); ?>"><img alt="No image" src="<?php echo esc_url($team_image); ?>"></a>
                        <?php }?>
                    </figure>
                </div>
                <div class="text">
                    <h2>
                        <?php if (isset($team_name_1) && $team_name_1 != '') {?>
                        <a href="<?php echo the_permalink(); ?>"><?php echo esc_attr($team_name_1); ?></a>
                        <?php }?>

                        <span><?php esc_html_e('VS', 'goalklub');?></span>

                        <?php if (isset($team_name_2) && $team_name_2 != '') {?>
                        <a href="<?php echo the_permalink(); ?>"><?php echo esc_attr($team_name_2); ?></a>
                        <?php }?>
                    </h2>
                    <ul class="post-option">
                        <li><?php $this->cs_get_categories($atts['cs_match_cat']);?></li>
                        <li><i class=" icon-calendar11"></i>
                            <?php

			echo esc_attr(date_i18n(get_option('date_format'), strtotime($cs_match_from_date))) . ' '; ?>
		<span>	<?php

			if (isset($cs_match_all_day) && $cs_match_all_day == 'on') {
				_e('All Day', 'goalklub');
			} else {
				if (isset($cs_match_start_time) && $cs_match_start_time != '') {
					$match_str_time = $this->cs_format_date($cs_match_start_time);
					echo cs_allow_special_char($match_str_time) . ' ';
				}
				if (isset($cs_match_end_time) && $cs_match_end_time != '') {
					/* _e(' - ', 'goalklub');*/
					$match_end_time = $this->cs_format_date($cs_match_end_time);
					
					echo '- ',cs_allow_special_char($match_end_time) . ' ';
				}
			}
			?> </span>
                        </li>

                        <?php if (isset($cs_match_location) && $cs_match_location != '') {?>
                            <li><i class=" icon-location6"></i><?php echo esc_attr(ucwords($cs_match_location)); ?></li>
                        <?php }?>
                    </ul>
                </div>
                <div class="match-result">
                   <figure>
						<?php if (isset($team_image_two) && $team_image_two != '') {?>
                            <a href="<?php echo the_permalink(); ?>"><img alt="No image" src="<?php echo esc_url($team_image_two); ?>"></a>
                        <?php }?>
                    </figure>
                </div>
            </article>
		<?php
}

		//======================================================================
		// Match Simple list View
		//======================================================================
		public function cs_club_view($atts) {
			global $post;

			$cs_match = get_post_meta(get_the_ID(), "match", true);
			if ($cs_match != "") {
				$cs_xmlObject = new SimpleXMLElement($cs_match);
				$cs_match_from_date = $cs_xmlObject->cs_match_from_date;
				$cs_match_start_time = $cs_xmlObject->cs_match_start_time;
				$cs_match_end_time = $cs_xmlObject->cs_match_end_time;
				$cs_match_all_day = $cs_xmlObject->cs_match_all_day;
				$cs_match_ticket_title = $cs_xmlObject->cs_match_ticket_options;
				$cs_match_buy_now = $cs_xmlObject->cs_match_buy_now;
				$cs_match_ticket_color = $cs_xmlObject->cs_match_ticket_color;
				$cs_match_team_1 = $cs_xmlObject->cs_match_team_1;
				$cs_match_team_2 = $cs_xmlObject->cs_match_team_2;
				$cs_match_location = $cs_xmlObject->cs_match_location;
				$cs_match_team1_score = $cs_xmlObject->cs_match_team1_score;
				$cs_match_team2_score = $cs_xmlObject->cs_match_team2_score;
				$cs_match_summary = $cs_xmlObject->cs_match_summary;
				$cs_match_attendance = $cs_xmlObject->cs_match_attendance;
				$cs_match_result_status = $cs_xmlObject->cs_match_result_status;
				$cs_match_venue = $cs_xmlObject->cs_match_venue;

			} else {
				$cs_match_from_date = '';
				$cs_match_start_time = '';
				$cs_match_end_time = '';
				$cs_match_all_day = '';
				$cs_match_ticket_title = '';
				$cs_match_buy_now = '';
				$cs_match_ticket_color = '';
				$cs_match_team_1 = '';
				$cs_match_team_2 = '';
				$cs_match_location = '';
				$cs_match_team1_score = '';
				$cs_match_team2_score = '';
				$cs_match_summary = '';
				$cs_match_attendance = '';
				$cs_match_result_status = '';
				$cs_match_venue = '';

				if (!isset($cs_xmlObject)) {
					$cs_xmlObject = new stdClass();
				}

			}

			$team_image = $this->cs_get_category_image($cs_match_team_1, 'player-team');
			$team_image_two = $this->cs_get_category_image($cs_match_team_2, 'player-team');
			$team_name_1 = $this->cs_get_team_name($cs_match_team_1, 'player-team');
			$team_name_2 = $this->cs_get_team_name($cs_match_team_2, 'player-team');

			if (isset($cs_match_ticket_color) && $cs_match_ticket_color != '') {
				$color = $cs_match_ticket_color;
				$background = ' style="background-color:' . $color . ' !important; color:#FFF !important;"';
			}

			$width = '850';
			$height = '259';
			$image_url = cs_get_post_img_src($post->ID, $width, $height);
			?>

            <article class="post-<?php echo esc_attr($post->ID); ?>">
            <style scoped>
                .post-<?php echo esc_attr($post->ID); ?>{
                    border-left: 2px solid <?php echo cs_allow_special_char($color); ?> !important;

                }
            </style>
                <div style="border-right:none;" class="calendar-date">
                    <span <?php echo force_back($background, false); ?>><?php echo esc_attr(ucwords(substr($cs_match_venue, 0, 1))); ?></span>
                    <?php if (isset($team_image) && $team_image != '') {?>
                    <figure>
                         <a href="<?php echo the_permalink(); ?>"><img alt="No image" src="<?php echo esc_url($team_image); ?>"></a>
                    </figure>
                    <?php }?>
                </div>
                <div style="text-align:left;" class="text">
                    <h2>
                        <span><?php esc_html_e('VS', 'goalklub');?></span>
                        <?php if (isset($team_name_2) && $team_name_2 != '') {?>
                        	<a href="<?php echo the_permalink(); ?>"><?php echo esc_attr($team_name_2); ?></a>
                        <?php }?>
                    </h2>
                    <ul class="post-option">
                      		<li><?php $this->cs_get_categories($atts['cs_match_cat']);?></li>
                            <li><i class=" icon-calendar11"></i>
                            	<?php

			echo esc_attr(date_i18n(get_option('date_format'), strtotime($cs_match_from_date))) . ' ';
			if (isset($cs_match_all_day) && $cs_match_all_day == 'on') {
				_e('All Day', 'goalklub');
			} else {
				if (isset($cs_match_start_time) && $cs_match_start_time != '') {

					$match_str_time = $this->cs_format_date($cs_match_start_time);
					echo cs_allow_special_char($match_str_time) . ' ';
				}
				if (isset($cs_match_end_time) && $cs_match_end_time != '') {
					/*_e(' - ', 'goalklub');*/
					$match_end_time = $this->cs_format_date($cs_match_end_time);
					echo ' ' . cs_allow_special_char($match_end_time);
				}
			}
			?>
                            </li>

							<?php if (isset($cs_match_location) && $cs_match_location != '') {?>
                            	<li><i class=" icon-location6"></i><?php echo esc_attr(ucwords($cs_match_location)); ?></li>
                            <?php }?>
                    </ul>
                </div>
                <div class="match-result"><span><?php echo esc_attr($cs_match_team1_score); ?>-<?php echo esc_attr($cs_match_team2_score); ?></span></div>
           </article>
        <?php
}

		//======================================================================
		// Match Simple list View
		//======================================================================
		public function cs_upcomming_club_view($atts) {
			global $post;

			$cs_match = get_post_meta(get_the_ID(), "match", true);
			if ($cs_match != "") {
				$cs_xmlObject = new SimpleXMLElement($cs_match);
				$cs_match_from_date = $cs_xmlObject->cs_match_from_date;
				$cs_match_start_time = $cs_xmlObject->cs_match_start_time;
				$cs_match_end_time = $cs_xmlObject->cs_match_end_time;
				$cs_match_all_day = $cs_xmlObject->cs_match_all_day;
				$cs_match_ticket_title = $cs_xmlObject->cs_match_ticket_options;
				$cs_match_buy_now = $cs_xmlObject->cs_match_buy_now;
				$cs_match_ticket_color = $cs_xmlObject->cs_match_ticket_color;
				$cs_match_team_1 = $cs_xmlObject->cs_match_team_1;
				$cs_match_team_2 = $cs_xmlObject->cs_match_team_2;
				$cs_match_location = $cs_xmlObject->cs_match_location;
				$cs_match_team1_score = $cs_xmlObject->cs_match_team1_score;
				$cs_match_team2_score = $cs_xmlObject->cs_match_team2_score;
				$cs_match_summary = $cs_xmlObject->cs_match_summary;
				$cs_match_attendance = $cs_xmlObject->cs_match_attendance;
				$cs_match_result_status = $cs_xmlObject->cs_match_result_status;
				$cs_match_venue = $cs_xmlObject->cs_match_venue;

			} else {
				$cs_match_from_date = '';
				$cs_match_start_time = '';
				$cs_match_end_time = '';
				$cs_match_all_day = '';
				$cs_match_ticket_title = '';
				$cs_match_buy_now = '';
				$cs_match_ticket_color = '';
				$cs_match_team_1 = '';
				$cs_match_team_2 = '';
				$cs_match_location = '';
				$cs_match_team1_score = '';
				$cs_match_team2_score = '';
				$cs_match_summary = '';
				$cs_match_attendance = '';
				$cs_match_result_status = '';
				$cs_match_venue = '';

				if (!isset($cs_xmlObject)) {
					$cs_xmlObject = new stdClass();
				}

			}

			$location = get_term_by('name', $cs_match_location, 'match-location', 'OBJECT', 'raw');
			$cs_match_location = $location->name;

			$team_image = $this->cs_get_category_image($cs_match_team_1, 'player-team');
			$team_image_two = $this->cs_get_category_image($cs_match_team_2, 'player-team');
			$team_name_1 = $this->cs_get_team_name($cs_match_team_1, 'player-team');
			$team_name_2 = $this->cs_get_team_name($cs_match_team_2, 'player-team');

			if (isset($cs_match_ticket_color) && $cs_match_ticket_color != '') {
				$color = $cs_match_ticket_color;
				$background = ' style="background-color:' . $color . ' !important; color:#FFF !important;"';
			}

			$width = '850';
			$height = '259';
			$image_url = cs_get_post_img_src($post->ID, $width, $height);
			?>
            <article class="post-<?php echo esc_attr($post->ID); ?> event-fixtures">
                <style scoped>
					.post-<?php echo esc_attr($post->ID); ?>{
						border-left: 2px solid <?php echo cs_allow_special_char($color); ?> !important;

					}
                </style>
                <div style="border-right:none;" class="calendar-date">
                    <span <?php echo force_back($background, false); ?>><?php echo esc_attr(ucwords(substr($cs_match_venue, 0, 1))); ?></span>
                     <figure>
						<?php if (isset($team_image) && $team_image != '') {?>
                            <a href="<?php echo the_permalink(); ?>"><img alt="No image" src="<?php echo esc_url($team_image); ?>"></a>
                        <?php }?>
                    </figure>
                </div>
                <div style="text-align:left;" class="text">
                    <h2>
                        <span><?php esc_html_e('VS', 'goalklub');?></span>
                        <a href="<?php echo the_permalink(); ?>"><?php echo esc_attr($team_name_2); ?></a>
                    </h2>
                    <ul class="post-option">
                       <li><?php $this->cs_get_categories($atts['cs_match_cat']);?></li>
                       <li><i class=" icon-calendar11"></i>
                            <?php

			echo esc_attr(date_i18n(get_option('date_format'), strtotime($cs_match_from_date))) . ' ';
			if (isset($cs_match_all_day) && $cs_match_all_day == 'on') {
				_e('All Day', 'goalklub');
			} else {
				if (isset($cs_match_start_time) && $cs_match_start_time != '') {
					$match_str_time = $this->cs_format_date($cs_match_start_time);
					echo cs_allow_special_char($match_str_time) . ' ';
				}
				if (isset($cs_match_end_time) && $cs_match_end_time != '') {
					/*_e(' - ', 'goalklub');*/
					$match_end_time = $this->cs_format_date($cs_match_end_time);
					echo ' ' . cs_allow_special_char($match_end_time);
				}
			}
			?>
                        </li>

                        <?php if (isset($cs_match_location) && $cs_match_location != '') {?>
                            <li><i class=" icon-location6"></i><?php echo esc_attr(ucwords($cs_match_location)); ?></li>
                        <?php }?>
                    </ul>
                </div>
                <?php $d = $cs_match_ticket_title ? $cs_match_ticket_title : 'Tickets' ?>
                <a class="ticket-btn cs-bgcolor"><?php echo esc_html($d);?></a>
            </article>
        <?php
}

		//======================================================================
		// Match Simple View
		//======================================================================
		public function cs_simple_view($atts) {
			global $post;

			$cs_match = get_post_meta(get_the_ID(), "match", true);
			if ($cs_match != "") {
				$cs_xmlObject = new SimpleXMLElement($cs_match);
				$cs_match_from_date = $cs_xmlObject->cs_match_from_date;
				$cs_match_start_time = $cs_xmlObject->cs_match_start_time;
				$cs_match_end_time = $cs_xmlObject->cs_match_end_time;
				$cs_match_all_day = $cs_xmlObject->cs_match_all_day;
				$cs_match_ticket_title = $cs_xmlObject->cs_match_ticket_options;
				$cs_match_buy_now = $cs_xmlObject->cs_match_buy_now;
				$cs_match_ticket_color = $cs_xmlObject->cs_match_ticket_color;
				$cs_match_team_1 = $cs_xmlObject->cs_match_team_1;
				$cs_match_team_2 = $cs_xmlObject->cs_match_team_2;
				$cs_match_location = $cs_xmlObject->cs_match_location;
				$cs_match_team1_score = $cs_xmlObject->cs_match_team1_score;
				$cs_match_team2_score = $cs_xmlObject->cs_match_team2_score;
				$cs_match_summary = $cs_xmlObject->cs_match_summary;
				$cs_match_attendance = $cs_xmlObject->cs_match_attendance;
				$cs_match_result_status = $cs_xmlObject->cs_match_result_status;
				$cs_match_venue = $cs_xmlObject->cs_match_venue;

			} else {
				$cs_match_from_date = '';
				$cs_match_start_time = '';
				$cs_match_end_time = '';
				$cs_match_all_day = '';
				$cs_match_ticket_title = '';
				$cs_match_buy_now = '';
				$cs_match_ticket_color = '';
				$cs_match_team_1 = '';
				$cs_match_team_2 = '';
				$cs_match_location = '';
				$cs_match_team1_score = '';
				$cs_match_team2_score = '';
				$cs_match_summary = '';
				$cs_match_attendance = '';
				$cs_match_result_status = '';
				$cs_match_venue = '';

				if (!isset($cs_xmlObject)) {
					$cs_xmlObject = new stdClass();
				}

			}

			$location = get_term_by('name', $cs_match_location, 'match-location', 'OBJECT', 'raw');
			$cs_match_location = $location->name;

			$team_image = $this->cs_get_category_image($cs_match_team_1, 'player-team');
			$team_image_two = $this->cs_get_category_image($cs_match_team_2, 'player-team');
			$team_name_1 = $this->cs_get_team_name($cs_match_team_1, 'player-team');
			$team_name_2 = $this->cs_get_team_name($cs_match_team_2, 'player-team');

			if (isset($cs_match_ticket_color) && $cs_match_ticket_color != '') {
				$color = $cs_match_ticket_color;
				$background = ' style="background-color:' . $color . ' !important; color:#FFF !important;"';
			}

			$width = '850';
			$height = '259';
			$image_url = cs_get_post_img_src($post->ID, $width, $height);
			?>
			<article class="post-<?php echo esc_attr($post->ID); ?>">
                <style scoped>
					.post-<?php echo esc_attr($post->ID); ?> {
						border-left: 2px solid <?php echo cs_allow_special_char($color); ?> !important;

					}
				</style>
                <ul class="post-option">
                    <li>
                        <span <?php echo force_back($background, false); ?>><?php echo esc_attr(ucwords(substr($cs_match_venue, 0, 1))); ?></span>
                        <?php
echo esc_attr(date_i18n(get_option('date_format'), strtotime($cs_match_from_date))) . ' ';
			?>
                    </li>
                </ul>
                <div class="text">
                    <h2><a href="<?php echo the_permalink(); ?>"><?php echo esc_attr($team_name_1); ?></a><?php esc_html_e(' V', 'goalklub');?> <a href="<?php echo the_permalink(); ?>"><?php echo esc_attr($team_name_2); ?></a></h2>
                    <ul class="post-option">
                       <li><?php $this->cs_get_categories($atts['cs_match_cat']);?></li>

                       <?php if (isset($cs_match_location) && $cs_match_location != '') {?>
                            <li><i class=" icon-location6"></i><?php echo esc_attr(ucwords($cs_match_location)); ?></li>
                       <?php }?>
                    </ul>
                </div>
                <div class="match-result"><span style="color:<?php  if($color) { echo force_back($color); }else{ echo force_back('#579f4b'); } ?>"><?php echo esc_attr($cs_match_team1_score); ?> - <?php echo esc_attr($cs_match_team2_score); ?></span></div>
            </article>
        <?php
}

		//======================================================================
		// Match Upcomming Simple View
		//======================================================================
		public function cs_upcomming_simple_view($atts) {
			global $post;

			$cs_match = get_post_meta(get_the_ID(), "match", true);
			if ($cs_match != "") {
				$cs_xmlObject = new SimpleXMLElement($cs_match);
				$cs_match_from_date = $cs_xmlObject->cs_match_from_date;
				$cs_match_start_time = $cs_xmlObject->cs_match_start_time;
				$cs_match_end_time = $cs_xmlObject->cs_match_end_time;
				$cs_match_all_day = $cs_xmlObject->cs_match_all_day;
				$cs_match_ticket_title = $cs_xmlObject->cs_match_ticket_options;
				$cs_match_buy_now = $cs_xmlObject->cs_match_buy_now;
				$cs_match_ticket_color = $cs_xmlObject->cs_match_ticket_color;
				$cs_match_team_1 = $cs_xmlObject->cs_match_team_1;
				$cs_match_team_2 = $cs_xmlObject->cs_match_team_2;
				$cs_match_location = $cs_xmlObject->cs_match_location;
				$cs_match_team1_score = $cs_xmlObject->cs_match_team1_score;
				$cs_match_team2_score = $cs_xmlObject->cs_match_team2_score;
				$cs_match_summary = $cs_xmlObject->cs_match_summary;
				$cs_match_attendance = $cs_xmlObject->cs_match_attendance;
				$cs_match_result_status = $cs_xmlObject->cs_match_result_status;
				$cs_match_venue = $cs_xmlObject->cs_match_venue;

			} else {
				$cs_match_from_date = '';
				$cs_match_start_time = '';
				$cs_match_end_time = '';
				$cs_match_all_day = '';
				$cs_match_ticket_title = '';
				$cs_match_buy_now = '';
				$cs_match_ticket_color = '';
				$cs_match_team_1 = '';
				$cs_match_team_2 = '';
				$cs_match_location = '';
				$cs_match_team1_score = '';
				$cs_match_team2_score = '';
				$cs_match_summary = '';
				$cs_match_attendance = '';
				$cs_match_result_status = '';
				$cs_match_venue = '';

				if (!isset($cs_xmlObject)) {
					$cs_xmlObject = new stdClass();
				}

			}

			$team_image = $this->cs_get_category_image($cs_match_team_1, 'player-team');
			$team_image_two = $this->cs_get_category_image($cs_match_team_2, 'player-team');
			$team_name_1 = $this->cs_get_team_name($cs_match_team_1, 'player-team');
			$team_name_2 = $this->cs_get_team_name($cs_match_team_2, 'player-team');

			if (isset($cs_match_ticket_color) && $cs_match_ticket_color != '') {
				$color = $cs_match_ticket_color;
				$background = ' style="background-color:' . $color . ' !important; color:#FFF !important;"';
			}

			$width = '850';
			$height = '259';
			$image_url = cs_get_post_img_src($post->ID, $width, $height);
			?>
			<article class="post-<?php echo esc_attr($post->ID); ?> event-fixtures">
				<style scoped>
                    .post-<?php echo esc_attr($post->ID); ?> span.win:before {
                        background: none repeat scroll 0 0 <?php echo cs_allow_special_char($color); ?> !important;
                    }
                    .post-<?php echo esc_attr($post->ID); ?>{
                        border-left: 2px solid <?php echo cs_allow_special_char($color); ?> !important;

                    }
                </style>
                <ul class="post-option">
                    <li>
                        <span <?php echo force_back($background, false); ?>><?php echo esc_attr(ucwords(substr($cs_match_venue, 0, 1))); ?></span>
                       <?php

			echo esc_attr(date_i18n(get_option('date_format'), strtotime($cs_match_from_date))) . ' ';

			?>
                    </li>
                </ul>
                <div class="text">
                    <h2>
                        <a href="<?php echo the_permalink(); ?>"><?php the_title();?></a>
                    </h2>
                    <ul class="post-option">
                       <li><?php $this->cs_get_categories($atts['cs_match_cat']);?></li>
                       <?php if (isset($cs_match_location) && $cs_match_location != '') {?>
                            <li><i class=" icon-location6"></i><?php echo esc_attr(ucwords($cs_match_location)); ?></li>
                       <?php }?>
                    </ul>
                </div>
                 <a href="<?php echo esc_url($cs_match_buy_now); ?>" class="ticket-btn cs-bgcolor">
				 <?php echo force_back($cs_match_ticket_title = isset($cs_match_ticket_title) ? $cs_match_ticket_title : __('Tickets', 'goalklub')); ?></a>
            </article>

        <?php
}

		//======================================================================
		// Match Upcomming Fixtures List View
		//======================================================================
		public function cs_upcomming_fixtures_list_view($atts) {
			global $post;

			$cs_match = get_post_meta(get_the_ID(), "match", true);
			if ($cs_match != "") {
				$cs_xmlObject = new SimpleXMLElement($cs_match);
				$cs_match_from_date = $cs_xmlObject->cs_match_from_date;
				$cs_match_start_time = $cs_xmlObject->cs_match_start_time;
				$cs_match_end_time = $cs_xmlObject->cs_match_end_time;
				$cs_match_all_day = $cs_xmlObject->cs_match_all_day;
				$cs_match_ticket_title = $cs_xmlObject->cs_match_ticket_options;
				$cs_match_buy_now = $cs_xmlObject->cs_match_buy_now;
				$cs_match_ticket_color = $cs_xmlObject->cs_match_ticket_color;
				$cs_match_team_1 = $cs_xmlObject->cs_match_team_1;
				$cs_match_team_2 = $cs_xmlObject->cs_match_team_2;
				$cs_match_location = $cs_xmlObject->cs_match_location;
				$cs_match_team1_score = $cs_xmlObject->cs_match_team1_score;
				$cs_match_team2_score = $cs_xmlObject->cs_match_team2_score;
				$cs_match_summary = $cs_xmlObject->cs_match_summary;
				$cs_match_attendance = $cs_xmlObject->cs_match_attendance;
				$cs_match_result_status = $cs_xmlObject->cs_match_result_status;
				$cs_match_venue = $cs_xmlObject->cs_match_venue;

			} else {
				$cs_match_from_date = '';
				$cs_match_start_time = '';
				$cs_match_end_time = '';
				$cs_match_all_day = '';
				$cs_match_ticket_title = '';
				$cs_match_buy_now = '';
				$cs_match_ticket_color = '';
				$cs_match_team_1 = '';
				$cs_match_team_2 = '';
				$cs_match_location = '';
				$cs_match_team1_score = '';
				$cs_match_team2_score = '';
				$cs_match_summary = '';
				$cs_match_attendance = '';
				$cs_match_result_status = '';
				$cs_match_venue = '';

				if (!isset($cs_xmlObject)) {
					$cs_xmlObject = new stdClass();
				}

			}

			$team_image = $this->cs_get_category_image($cs_match_team_1, 'player-team');
			$team_image_two = $this->cs_get_category_image($cs_match_team_2, 'player-team');
			$team_name_1 = $this->cs_get_team_name($cs_match_team_1, 'player-team');
			$team_name_2 = $this->cs_get_team_name($cs_match_team_2, 'player-team');

			if (isset($cs_match_ticket_color) && $cs_match_ticket_color != '') {
				$color = $cs_match_ticket_color;
				$background = ' style="background-color:' . $color . ' !important; color:#FFF !important;"';
			}

			$width = '850';
			$height = '259';
			$image_url = cs_get_post_img_src($post->ID, $width, $height);
			?>
			<article class="cs-upcomming-fixtures post-<?php echo esc_attr($post->ID); ?>">
                 <style scoped>
                    .post-<?php echo esc_attr($post->ID); ?> span.win:before {
                        background: none repeat scroll 0 0 <?php echo cs_allow_special_char($color); ?> !important;
                    }
                   .post-<?php echo esc_attr($post->ID); ?> {
						border-left: 3px solid <?php echo cs_allow_special_char($color); ?> !important;

					}
                </style>

                <div class="calendar-date">
                    <figure>
                        <?php if (isset($team_image) && $team_image != '') {?>
                       		<a href="<?php echo the_permalink(); ?>"><img alt="No image" src="<?php echo esc_url($team_image); ?>"></a>
                        <?php }?>
                    </figure>
                </div>
                <div class="text">
                    <h2>
                        <?php if (isset($team_name_1) && $team_name_1 != '') {?>
                        <a href="<?php echo the_permalink(); ?>"><?php echo esc_attr($team_name_1); ?></a>
                        <?php }?>

                        <span><?php _e('VS', 'goalklub');?></span>

                        <?php if (isset($team_name_2) && $team_name_2 != '') {?>
                        <a href="<?php echo the_permalink(); ?>"><?php echo esc_attr($team_name_2); ?></a>
                        <?php }?>
                    </h2>
                    <ul class="post-option">
                        <li><time>
                        	<?php
echo esc_attr(date_i18n('d/m/Y', strtotime($cs_match_from_date))) . ' ';

			if (isset($cs_match_all_day) && $cs_match_all_day == 'on') {
				_e('All Day', 'goalklub');
			} else {
				if (isset($cs_match_start_time) && $cs_match_start_time != '') {

					$match_str_time = $this->cs_format_date($cs_match_start_time);
					echo cs_allow_special_char($match_str_time) . ' ';
				}
				if (isset($cs_match_end_time) && $cs_match_end_time != '') {
					/* _e(' - ', 'goalklub');*/

					$match_end_time = $this->cs_format_date($cs_match_end_time);
					echo ' ' . cs_allow_special_char($match_end_time);
				}
			}
			?>

                        </time></li>
                    </ul>
                </div>
                <div class="match-result">
                    <figure>
                       <?php if (isset($team_image_two) && $team_image_two != '') {?>
                       		<a href="<?php echo the_permalink(); ?>"><img alt="No image" src="<?php echo esc_url($team_image_two); ?>"></a>
                       <?php }?>
                    </figure>
                </div>
           </article>
        <?php
}

		//======================================================================
		// Match Upcomming Fixtures Club View
		//======================================================================
		public function cs_upcomming_fixtures_club_view($atts) {
			global $post;

			$cs_match = get_post_meta(get_the_ID(), "match", true);
			if ($cs_match != "") {
				$cs_xmlObject = new SimpleXMLElement($cs_match);
				$cs_match_from_date = $cs_xmlObject->cs_match_from_date;
				$cs_match_start_time = $cs_xmlObject->cs_match_start_time;
				$cs_match_end_time = $cs_xmlObject->cs_match_end_time;
				$cs_match_all_day = $cs_xmlObject->cs_match_all_day;
				$cs_match_ticket_title = $cs_xmlObject->cs_match_ticket_options;
				$cs_match_buy_now = $cs_xmlObject->cs_match_buy_now;
				$cs_match_ticket_color = $cs_xmlObject->cs_match_ticket_color;
				$cs_match_team_1 = $cs_xmlObject->cs_match_team_1;
				$cs_match_team_2 = $cs_xmlObject->cs_match_team_2;
				$cs_match_location = $cs_xmlObject->cs_match_location;
				$cs_match_team1_score = $cs_xmlObject->cs_match_team1_score;
				$cs_match_team2_score = $cs_xmlObject->cs_match_team2_score;
				$cs_match_summary = $cs_xmlObject->cs_match_summary;
				$cs_match_attendance = $cs_xmlObject->cs_match_attendance;
				$cs_match_result_status = $cs_xmlObject->cs_match_result_status;
				$cs_match_venue = $cs_xmlObject->cs_match_venue;

			} else {
				$cs_match_from_date = '';
				$cs_match_start_time = '';
				$cs_match_end_time = '';
				$cs_match_all_day = '';
				$cs_match_ticket_title = '';
				$cs_match_buy_now = '';
				$cs_match_ticket_color = '';
				$cs_match_team_1 = '';
				$cs_match_team_2 = '';
				$cs_match_location = '';
				$cs_match_team1_score = '';
				$cs_match_team2_score = '';
				$cs_match_summary = '';
				$cs_match_attendance = '';
				$cs_match_result_status = '';
				$cs_match_venue = '';

				if (!isset($cs_xmlObject)) {
					$cs_xmlObject = new stdClass();
				}

			}

			$team_image = $this->cs_get_category_image($cs_match_team_1, 'player-team');
			$team_image_two = $this->cs_get_category_image($cs_match_team_2, 'player-team');
			$team_name_1 = $this->cs_get_team_name($cs_match_team_1, 'player-team');
			$team_name_2 = $this->cs_get_team_name($cs_match_team_2, 'player-team');
			cs_countdown();
			$obj = $this->cs_get_date_difference($post->ID);

			$year = $obj->y;
			$month = $obj->m + date('m');
			$days = $obj->d + date('d');
			$hours = $obj->h + date('H');
			$mins = $obj->i + date('i');
			$secs = $obj->s + date('s');
			$cs_counter = cs_generate_random_string(3);

			if (isset($cs_match_ticket_color) && $cs_match_ticket_color != '') {
				$color = $cs_match_ticket_color;
				$background = ' style="background-color:' . $color . ' !important; color:#FFF !important;"';
			}

			$width = '850';
			$height = '259';
			$image_url = cs_get_post_img_src($post->ID, $width, $height);
			?>
            <div class="featured-event small-featured">
                <div class="countdown">
                  <div id="defaultCountdown<?php echo esc_attr($cs_counter); ?>"></div>
                </div>
                <div class="cs-sc-team">
                  <ul>
                      <li>
                          <figure>
								  <?php if (isset($team_image) && $team_image != '') {?>
                                        <a href="<?php echo the_permalink(); ?>"><img alt="No image" src="<?php echo esc_url($team_image); ?>"></a>
                                 <?php }
			if (isset($team_name_1) && $team_name_1 != '') {?>
                                		<figcaption><a href="<?php echo the_permalink(); ?>"><?php echo esc_attr($team_name_1); ?></a></figcaption>
                                <?php }?>
                            </figure>
                        </li>
                        <li class="vs">
                          <div class="match-score">
                          <small><?php _e('VS', 'goalklub');?></small>
                          <?php if ($cs_match_venue != '') {echo '<span>' . $cs_match_venue . '</span>';}?>
                          </div>
                        </li>
                        <li class="right-side">
                            <figure>

                                <?php if (isset($team_image_two) && $team_image_two != '') {?>
                                        <a href="<?php echo the_permalink(); ?>"><img alt="No image" src="<?php echo esc_url($team_image_two); ?>"></a>
                                   <?php }
			if (isset($team_name_2) && $team_name_2 != '') {?>
                                		<figcaption><a href="<?php echo the_permalink(); ?>"><?php echo esc_attr($team_name_2); ?></a></figcaption>
                                <?php }?>
                            </figure>
                        </li>
                    </ul>
                </div>
                <div class="bottom-event-panel">
                    <p><?php $this->cs_get_categories($atts['cs_fixture_cat'], false);

			echo ' ' . esc_attr(date_i18n(get_option('date_format'), strtotime($cs_match_from_date))) . ' ';

			if (isset($cs_match_all_day) && $cs_match_all_day == 'on') {
				_e('All Day', 'goalklub');
			} else {
				if (isset($cs_match_start_time) && $cs_match_start_time != '') {

					$match_str_time = $this->cs_format_date($cs_match_start_time);
					echo cs_allow_special_char($match_str_time);
                                          echo ' - ';
				}
                               
				if (isset($cs_match_end_time) && $cs_match_end_time != '') {
					/*_e(' - ', 'goalklub');*/

					$match_end_time = $this->cs_format_date($cs_match_end_time);
					echo cs_allow_special_char($match_end_time) . ' ';
				}
			}
			?></p>
								<?php if ( isset( $cs_match_location ) && $cs_match_location != '' ) { ?>
									<span>
										<?php echo esc_attr( ucwords( str_replace("-"," ",$cs_match_location ))); ?>
									</span>
								<?php } ?>
                </div>
            </div>

             <script>
               jQuery(function () {
                  var austDay = new Date();
                  austDay = new Date(austDay.getFullYear() + <?php echo intval($year); ?>, <?php echo intval($month); ?>-1, <?php echo intval($days); ?>, <?php echo intval($hours); ?>, <?php echo intval($mins); ?>, <?php echo intval($secs); ?>);

                  jQuery('#defaultCountdown<?php echo esc_attr($cs_counter); ?>').countdown({until: austDay});
                  jQuery('#year').text(austDay.getFullYear());

                });
            </script>

        <?php
}

		//======================================================================
		// Match Categories
		//======================================================================
		public function cs_get_categories($category = '', $icon = true) {

			global $wpdb, $post;

			/* Get All Tags */
			if ($icon == true) {
				$before_cat = '<i class=" icon-flag5"></i> ';
			} else {
				$before_cat = '';
			}
			$categories_list = get_the_term_list(get_the_id(), 'match-category', $before_cat, ', ', '');
			if ($categories_list) {
				printf(__('%1$s', 'goalklub'), $categories_list);
			}
			// End if Tags

		}

	}
}