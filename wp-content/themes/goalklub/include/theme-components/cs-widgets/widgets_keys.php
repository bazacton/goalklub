<?php
if(!function_exists('cs_activate_widget')){
	
	function cs_activate_widget(){
		
		$sidebars_widgets = get_option('sidebars_widgets');
	
	/********************** Footer Siderbar Setting Start **********************/
	
		 /* ---- Footer Contact Us --- */
		/*----------------------------*/
			$footer_contactinfo = array();
			$footer_contactinfo[1] = array(
				'title' =>'',
				'image_url' => get_template_directory_uri().'/assets/images/footer-logo.png',
				'address' => 'GoalKlub <br>2345 Setwant natrer, 1234,<br>Washington. United States.<br>(401) 1234 567',
				'phone' => 'Phone: <a href="tel:+44 1234 5678">(0044) 1234 5678</a>',
				'fax' => 'Fax: <a href="tel:+44 1234 5678">(0044) 1234 5678</a>',
				'email' => 'Email: <a href="mailto:hello@awaken.com">hello@awaken.com</a>',
			);						
			$footer_contactinfo['_multiwidget'] = '1';
			update_option('widget_contactinfo',$footer_contactinfo);
			$footer_contactinfo = get_option('widget_contactinfo');
			krsort($footer_contactinfo);
			foreach($footer_contactinfo as $key1=>$val1){
				$footer_contactinfo_key = $key1;
				if(is_int($footer_contactinfo_key)){
					break;
				}
			}
		/* ---- Footer Sidebar text widget ---- */
		/*---------------------------*/
			$text_widget = array();
			
			$text_widget[1] = array(
				'title' =>__('About Us','goalklub'),
				'text' => '<h3>'.__('Rash that more and Disrespect fully grunt less. Through tarantula before wherever','goalklub').'</h3><br/>
							<p>'.__('Before wherever frog far across ubiquitously and rash that more and disrespect fully grunt less. Best Through tarantula before wherever frog far across ubiquitously and rash that more and disrespect fully','goalklub').'</p><br/>
							
							Address : 269 Main Street<br/>
							London England<br/>
							Call : +1800-222-3333<br/>',
			);						
			$text_widget['_multiwidget'] = '1';
			update_option('widget_text',$text_widget);
			$text_widget = get_option('widget_text');
			krsort($text_widget);
			foreach($text_widget as $key1=>$val1){
				$text_key1 = $key1;
				if(is_int($text_key1)){
					break;
				}
			}
			
		/* ---- Footer Mailchimp text widget ---- */
		/*---------------------------*/
			$cs_mailchimp = array();
			$cs_mailchimp[1] = array(
				'title' =>__('Weekly NewsLetter','goalklub'),
				'description' =>__('Through tarantula before wherever frog far across ubiquitously and rash that more and disrespectful.','goalklub')
			);						
			$cs_mailchimp['_multiwidget'] = '1';
			update_option('widget_cs_mailchimp',$cs_mailchimp);
			$cs_mailchimp = get_option('widget_cs_mailchimp');
			krsort($cs_mailchimp);
			foreach($cs_mailchimp as $key1=>$val1){
				$cs_mailchimp_key1 = $key1;
				if(is_int($cs_mailchimp_key1)){
					break;
				}
			}
		 
		
		 /* ---- Footer Flickr Gallery --- */
		/*----------------------------*/
			$footer_flickr_gallery = array();
			
			$footer_flickr_gallery[2] = array(
					"title"		=>__('Flickr Gallery','goalklub'),
					"username" 	=> 'dspn',
					"no_of_photos" => '12',
					);					
			$footer_flickr_gallery['_multiwidget'] = '1';
			update_option('widget_cs_flickr',$footer_flickr_gallery);
			$footer_flickr_gallery = get_option('widget_cs_flickr');
			krsort($footer_flickr_gallery);
			foreach($footer_flickr_gallery as $key1=>$val1){
				$footer_flickr_gallery_key = $key1;
				if(is_int($footer_flickr_gallery_key)){
					break;
				}
			} 
		
		 /* ---- Footer Contact Form Widget --- */
		/*----------------------------*/
			$footer_contact_form = array();
			$footer_contact_form[1] = array(
					"title"		=>__('Leave us a Message','goalklub'),
					"contact_email" 	=> get_bloginfo('admin_email'),
					"contact_succ_msg" => 'Message Sent Successfully.',
					);					
			$footer_contact_form['_multiwidget'] = '1';
			update_option('widget_cs_contact_msg',$footer_contact_form);
			$footer_contact_form = get_option('widget_cs_contact_msg');
			krsort($footer_contact_form);
			foreach($footer_contact_form as $key1=>$val1){
				$footer_contact_form_key = $key1;
				if(is_int($footer_contact_form_key)){
					break;
				}
			}

		 /* ---- Default Sidebar Facebook widget setting --- */
		/*----------------------------------*/
	
			$facebook_module = array();
			$facebook_module[1] = array(
					"title"		=>__('Facebook','goalklub'),
					"pageurl" 	=> "https://www.facebook.com/envato",
					"showfaces" => "on",
					"showstream" => "",
					"likebox_height" => "295",
					"fb_bg_color" => "#ffffff",
					);						
			$facebook_module['_multiwidget'] = '1';
			update_option('widget_facebook_module',$facebook_module);
			$facebook_module = get_option('widget_facebook_module');
			krsort($facebook_module);
			foreach($facebook_module as $key1=>$val1) {
				$facebook_module_key = $key1;
				if(is_int($facebook_module_key)) {
					break;
				}
			}
		
		 /* ---- Default Sidebar Twitter widget setting ----- */
		/*-----------------------------------*/
			$cs_twitter_widget = array();
			$cs_twitter_widget[1] = array(
					"title"		=>__('Twitter','goalklub'),
					"username" 	=>	"envato",
					"numoftweets" => "3",
					);						
			$cs_twitter_widget['_multiwidget'] = '1';
			update_option('widget_cs_twitter_widget',$cs_twitter_widget);
			$cs_twitter_widget = get_option('widget_cs_twitter_widget');
			krsort($cs_twitter_widget);
			foreach($cs_twitter_widget as $key1=>$val1){
				$cs_twitter_widget_key = $key1;
				if(is_int($cs_twitter_widget_key)){
					break;
				}
			}
		
		 /* ---- Event Sidebar Search widget setting --- */
		/*--------------------------------*/
			$search = array();
			$search[1] = array(
				"title"		=>	'',
			);
	
			$search['_multiwidget'] = '1';
			update_option('widget_search',$search);
			$search = get_option('widget_search');
			krsort($search);
			foreach($search as $key1=>$val1){
				$search_key = $key1;
				if(is_int($search_key)){
					break;
				}
			}
		
		 /* ---- calendar --- */
		/*--------------------------------*/
			$calendar = array();
			$calendar[1] = array(
				"title"		=>	'Caledar',
			);
	
			$calendar['_multiwidget'] = '1';
			update_option('widget_calendar',$calendar);
			$calendar = get_option('widget_calendar');
			krsort($calendar);
			foreach($calendar as $key1=>$val1){
				$calendar_key = $key1;
				if(is_int($calendar_key)){
					break;
				}
			}
		
	
		 /* ---- Event Sidebar Twitter widget setting --- */
		/*--------------------------------*/
			$event_twitter_widget = array();
			$event_twitter_widget[2] = array(
					"title"		=>	'TWITTER FEEDS',
					"username" 	=>	"envato",
					"numoftweets" => "3",
					);						
			$event_twitter_widget['_multiwidget'] = '1';
			update_option('widget_cs_twitter_widget',$event_twitter_widget);
			$event_twitter_widget = get_option('widget_cs_twitter_widget');
			krsort($event_twitter_widget);
			foreach($event_twitter_widget as $key1=>$val1){
				$event_twitter_widget_key = $key1;
				if(is_int($event_twitter_widget_key)){
					break;
				}
			}
			
		 /* ---- Blog Sidebar Recent Posts --- */
		/*----------------------------*/
			$blog_recent_post = array();
			$blog_recent_post[1] = array(
					"title"		=>__('Recent Blog','goalklub'),
					"select_category" 	=> '',
					"showcount" => '4',
					"thumb" => true
					);					
			$blog_recent_post['_multiwidget'] = '1';
			update_option('widget_recentposts',$blog_recent_post);
			$blog_recent_post = get_option('widget_recentposts');
			krsort($blog_recent_post);
			foreach($blog_recent_post as $key1=>$val1){
				$blog_recent_post_key = $key1;
				if(is_int($blog_recent_post_key)){
					break;
				}
			}
		
		/* ---- Blog Sidebar Cats --- */
		/*----------------------------*/
			$blog_cats = array();
			$blog_cats[1] = array(
					"title"		=>__('BLOG CATEGORIES','goalklub'),
					"dropdown" 	=> '',
					"count" => '',
					"hierarchical" => ''
					);					
			$blog_cats['_multiwidget'] = '1';
			update_option('widget_categories',$blog_cats);
			$blog_cats = get_option('widget_categories');
			krsort($blog_cats);
			foreach($blog_cats as $key1=>$val1){
				$blog_cats_key = $key1;
				if(is_int($blog_cats_key)){
					break;
				}
			}
		
		/* ---- Archive--- */
		/*--------------------------------*/
			$blog_archives = array();
			$blog_archives[1] = array(
					"title"		=>__('Archives','goalklub'),
					"dropdown" 	=>	false,
					"count" => false,
					);						
			$blog_archives['_multiwidget'] = '1';
			update_option('widget_archives',$blog_archives);
			$blog_archives = get_option('widget_archives');
			krsort($blog_archives);
			foreach($blog_archives as $key1=>$val1){
				$blog_archives_key = $key1;
				if(is_int($blog_archives_key)){
					break;
				}
			}
			
		 /* ---- Blog Sidebar text widget ---- */
		/*---------------------------*/
			$text = array();
			$text = get_option('widget_text');
			$text[2] = array(
				'title' => 'TEXT WIDGET',
				'text' => 'Bhat sneered vivaciously that thus are they poroise uncriti cal gosh and be to the that thus are much and vivaciously that thus are they poroise uncritical gosh and be to thvivaci ously that thus are they Bhat sneered vivaciously that thus are they.',
			);						
			$text['_multiwidget'] = '1';
			update_option('widget_text',$text);
			$text = get_option('widget_text');
			krsort($text);
			foreach($text as $key1=>$val1){
				$text_key = $key1;
				if(is_int($text_key)){
					break;
				}
			}
			
		 /* ------  Blog Sidebar Tags ----- */
		/*--------------------------------*/
			$tag_cloud = array();
	
			$tag_cloud[1] = array(
	
			"title"		=>	'TAG CLOUD',
			"taxonomy" => 'post_tag',
			);
	
			$tag_cloud['_multiwidget'] = '1';
			update_option('widget_tag_cloud',$tag_cloud);
			$tag_cloud = get_option('widget_tag_cloud');
			krsort($tag_cloud);
			foreach($tag_cloud as $key1=>$val1){
				$tag_cloud_key = $key1;
				if(is_int($tag_cloud_key)){
					break;
				}
			}
		
		 /* ---- Blog Sidebar Twitter widget setting --- */
		/*--------------------------------*/
			$blog_twitter_widget = array();
			$blog_twitter_widget[3] = array(
					"title"		=>	'TWITTER FEEDS',
					"username" 	=>	"envato",
					"numoftweets" => "3",
					);						
			$blog_twitter_widget['_multiwidget'] = '1';
			update_option('widget_cs_twitter_widget',$blog_twitter_widget);
			$blog_twitter_widget = get_option('widget_cs_twitter_widget');
			krsort($blog_twitter_widget);
			foreach($blog_twitter_widget as $key1=>$val1){
				$blog_twitter_widget_key = $key1;
				if(is_int($blog_twitter_widget_key)){
					break;
				}
			}
		
	 /* ---- Upcoming match --- */
		/*--------------------------------*/
			$upcoming_match = array();
			$upcoming_match[1] = array(
					"title"		=>	'Upcoming Matches',
					"select_category" 	=>	"",
					"select_type" 	=>	"upcoming",
					"showcount" => "4",
					);						
			$upcoming_match['_multiwidget'] = '1';
			update_option('widget_cs_matches',$upcoming_match);
			$upcoming_match = get_option('widget_cs_matches');
			krsort($upcoming_match);
			foreach($upcoming_match as $key1=>$val1){
				$upcoming_match_key = $key1;
				if(is_int($upcoming_match_key)){
					break;
				}
			}	
			
	/* ---- Our Team--- */
		/*--------------------------------*/
			$our_team = array();
			$our_team[1] = array(
					"title"		=>	'Our Team',
					"select_category" 	=>	"",
					"showcount" => "4",
					);						
			$our_team['_multiwidget'] = '1';
			update_option('widget_team_players',$our_team);
			$our_team = get_option('widget_team_players');
			krsort($our_team);
			foreach($our_team as $key1=>$val1){
				$our_team_key = $key1;
				if(is_int($our_team_key)){
					break;
				}
			}	
	
	 /* ----  Match Gallery --- */
		/*----------------------------*/
			$match_photos = array();
			$match_photos = get_option('widget_cs_flickr');
			$match_photos[3] = array(
					"title"		=>	'Match Photos',
					"username" 	=> 'dspn',
					"no_of_photos" => '12',
					);					
			$match_photos['_multiwidget'] = '1';
			update_option('widget_cs_flickr',$match_photos);
			$match_photos = get_option('widget_cs_flickr');
			krsort($match_photos);
			foreach($match_photos as $key1=>$val1){
				$match_photos_key = $key1;
				if(is_int($match_photos_key)){
					break;
				}
			} 
		
	 /* ---- Match Detail Latest Posts --- */
		/*----------------------------*/
			$match_recent_posts = array();
			$match_recent_posts = get_option('widget_recentposts');
			$match_recent_posts[2] = array(
					"title"		=>	'Latest News',
					"select_category" 	=> '',
					"showcount" => '4',
					"thumb" => true
					);					
			$match_recent_posts['_multiwidget'] = '1';
			update_option('widget_recentposts',$match_recent_posts);
			$match_recent_posts = get_option('widget_recentposts');
			krsort($match_recent_posts);
			foreach($match_recent_posts as $key1=>$val1){
				$match_recent_posts_key = $key1;
				if(is_int($match_recent_posts_key)){
					break;
				}
			}
			
		/* ---- Archive--- */
		/*--------------------------------*/
			$match_archives = array();
			$match_archives = get_option('widget_archives');
			$match_archives[2] = array(
					"title"		=>	'Match Played',
					"dropdown" 	=>	false,
					"count" => true,
					);						
			$match_archives['_multiwidget'] = '1';
			update_option('widget_archives',$match_archives);
			$match_archives = get_option('widget_archives');
			krsort($match_archives);
			foreach($match_archives as $key1=>$val1){
				$match_archives_key = $key1;
				if(is_int($match_archives_key)){
					break;
				}
			}
			
		
		/* ---- Our Team--- */
		/*--------------------------------*/
			$our_team = array();
			$our_team = get_option('widget_team_players');
			$our_team[2] = array(
					"title"		=>	'Featured Team',
					"select_category" 	=>	"",
					"showcount" => "4",
					);						
			$our_team['_multiwidget'] = '1';
			update_option('widget_team_players',$our_team);
			$our_team = get_option('widget_team_players');
			krsort($our_team);
			foreach($our_team as $key1=>$val1){
				$our_team_key2 = $key1;
				if(is_int($our_team_key2)){
					break;
				}
			}
		
		 /* ---- Upcoming match --- */
		/*--------------------------------*/
			$upcoming_match = array();
			$upcoming_match = get_option('widget_cs_matches');
			$upcoming_match[2] = array(
					"title"		=>	'Result',
					"select_category" 	=>	"",
					"select_type" 	=>	"past",
					"showcount" => "4",
					);						
			$upcoming_match['_multiwidget'] = '1';
			update_option('widget_cs_matches',$upcoming_match);
			$upcoming_match = get_option('widget_cs_matches');
			krsort($upcoming_match);
			foreach($upcoming_match as $key1=>$val1){
				$upcoming_match_key2 = $key1;
				if(is_int($upcoming_match_key2)){
					break;
				}
			}
			
		 /* ---- Upcoming match --- */
		/*--------------------------------*/
			$upcoming_match = array();
			$upcoming_match = get_option('widget_cs_matches');
			$upcoming_match[3] = array(
					"title"		=>	'Played Matches',
					"select_category" 	=>	"",
					"select_type" 	=>	"upcoming",
					"showcount" => "5",
					);						
			$upcoming_match['_multiwidget'] = '1';
			update_option('widget_cs_matches',$upcoming_match);
			$upcoming_match = get_option('widget_cs_matches');
			krsort($upcoming_match);
			foreach($upcoming_match as $key1=>$val1){
				$upcoming_match_key3 = $key1;
				if(is_int($upcoming_match_key3)){
					break;
				}
			}
			
	/* ----  Add widgets in sidebars  --- */
	/*-----------------------------------*/
		$sidebars_widgets['default_pages'] = array();
		$sidebars_widgets['blogs_sidebar'] = array("recentposts-$blog_recent_post_key", "categories-$blog_cats_key","recentposts-$match_recent_posts_key","archives-$blog_archives_key", "calendar-$calendar_key","cs_flickr-$footer_flickr_gallery_key");
		$sidebars_widgets['pages_sidebar'] = array();
		$sidebars_widgets['contact'] = array("text-$text_key1","facebook_module-$facebook_module_key","cs_flickr-$footer_flickr_gallery_key");
		$sidebars_widgets['team_detail'] = array("team_players-$our_team_key2","cs_matches-$upcoming_match_key2","cs_matches-$upcoming_match_key3");
		$sidebars_widgets['shop'] = array();
		$sidebars_widgets['matches'] = array("cs_matches-$our_team_key","team_players-$our_team_key","recentposts-$match_recent_posts_key","cs_flickr-$match_photos_key",);
		$sidebars_widgets['match_detail'] = array("search-$search_key","cs_matches-$our_team_key","team_players-$our_team_key","cs_flickr-$match_photos_key","recentposts-$match_recent_posts_key","facebook_module-$facebook_module_key", "archives-$match_archives_key");
		$sidebars_widgets['footer-widget-1'] = array("text-$text_key1","cs_flickr-$footer_flickr_gallery_key", "cs_mailchimp-$cs_mailchimp_key1");
		
		update_option('sidebars_widgets',$sidebars_widgets); //save widget informations
	
	}
}