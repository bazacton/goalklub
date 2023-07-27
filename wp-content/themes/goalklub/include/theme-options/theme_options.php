<?php
// Theme option function
if ( ! function_exists( 'cs_options_page' ) ) {
	function cs_options_page(){
		global $cs_theme_options,$options;
		//$cs_theme_options=get_option('cs_theme_options');
		
	?>
		<div class="theme-wrap fullwidth">
			<div class="inner">
				<div class="outerwrapp-layer">
					<div class="loading_div">
						<i class="icon-circle-o-notch icon-spin"></i>
						<br>
						<?php esc_html_e('Saving changes...','goalklub');?>
					</div>
					<div class="form-msg">
						<i class="icon-check-circle-o"></i>
						<div class="innermsg"></div>
					</div>
				</div>
				<div class="row">   
					<form id="frm" method="post">
						<?php 
							$theme_options_fields = new theme_options_fields();
							$return = $theme_options_fields->cs_fields($options);
						?>
						<div class="col1">
							<nav class="admin-navigtion">
								<div class="logo">
									<a href="#" class="logo1"><img src="<?php echo get_template_directory_uri()?>/include/assets/images/logo-themeoption.png" /></a>
									<a href="#" class="nav-button"><i class="icon-params"></i></a>
								</div>
								<ul>
									<?php  echo force_back($return[1],true); ?>
								</ul>
							</nav>
						</div>
						<div class="col2">
							<?php  echo force_back($return[0],true); /* Settings */ ?>
						</div>
						<div class="clear"></div>
						<div class="footer">
							<input type="button" id="submit_btn" name="submit_btn" class="bottom_btn_save" value="<?php _e('Save All Settings','goalklub');?>" onclick="javascript:theme_option_save('<?php echo admin_url('admin-ajax.php')?>', '<?php echo get_template_directory_uri();?>');" />
							<input type="hidden" name="action" value="theme_option_save"  />
							<input class="bottom_btn_reset" name="reset" type="button" value="<?php _e('Reset All Options','goalklub');?>"
							onclick="javascript:cs_rest_all_options('<?php echo esc_js(admin_url('admin-ajax.php'))?>', '<?php echo esc_js(get_template_directory_uri())?>');" />
						</div>
				  </form>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<!--wrap-->
		<script type="text/javascript">
			// Sub Menus Show/hide
			jQuery(document).ready(function($) {
				jQuery(".sub-menu").parent("li").addClass("parentIcon");
				$("a.nav-button").click(function() {
					$(".admin-navigtion").toggleClass("navigation-small");
				});
				
				$("a.nav-button").click(function() {
					$(".inner").toggleClass("shortnav");
				});
				
				$(".admin-navigtion > ul > li > a").click(function() {
					var a = $(this).next('ul')
					$(".admin-navigtion > ul > li > a").not($(this)).removeClass("changeicon")
					$(".admin-navigtion > ul > li ul").not(a) .slideUp();
					$(this).next('.sub-menu').slideToggle();
					$(this).toggleClass('changeicon');
				});
			});
			
			function show_hide(id){
				var link = id.replace('#', '');
				jQuery('.horizontal_tab').fadeOut(0);
				jQuery('#'+link).fadeIn(400);
			}
			
			function toggleDiv(id) { 
				jQuery('.col2').children().hide();
				jQuery(id).show();
				location.hash = id+"-show";
				var link = id.replace('#', '');
				jQuery('.categoryitems li').removeClass('active');
				jQuery(".menuheader.expandable") .removeClass('openheader');
				jQuery(".categoryitems").hide();
				jQuery("."+link).addClass('active');
				jQuery("."+link) .parent("ul").show().prev().addClass("openheader");
			}
			jQuery(document).ready(function() {
				jQuery(".categoryitems").hide();
				jQuery(".categoryitems:first").show();
				jQuery(".menuheader:first").addClass("openheader");
				jQuery(".menuheader").live('click', function(event) {
					if (jQuery(this).hasClass('openheader')){
						jQuery(".menuheader").removeClass("openheader");
						jQuery(this).next().slideUp(200);
						return false;
					}
					jQuery(".menuheader").removeClass("openheader");
					jQuery(this).addClass("openheader");
					jQuery(".categoryitems").slideUp(200);
					jQuery(this).next().slideDown(200); 
					return false;
				});
				
				var hash = window.location.hash.substring(1);
				var id = hash.split("-show")[0];
				if (id){
					jQuery('.col2').children().hide();
					jQuery("#"+id).show();
					jQuery('.categoryitems li').removeClass('active');
					jQuery(".menuheader.expandable") .removeClass('openheader');
					jQuery(".categoryitems").hide();
					jQuery("."+id).addClass('active');
					jQuery("."+id) .parent("ul").slideDown(300).prev().addClass("openheader");
				} 
			});
			jQuery(function($) {
				$( "#cs_launch_date" ).datepicker({
					defaultDate: "+1w",
					dateFormat: "dd/mm/yy",
					changeMonth: true,
					numberOfMonths: 1,
					onSelect: function( selectedDate ) {
						$( "#cs_launch_date" ).datepicker( "option", "minDate", selectedDate );
					}
				});
			});
		</script>
		<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri())?>/include/assets/css/jquery_ui_datepicker.css">
		<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri())?>/include/assets/css/jquery_ui_datepicker_theme.css">
	<?php
	}
}

// Background Count function
if ( ! function_exists( 'cs_bgcount' ) ) {
	 function cs_bgcount($name,$count) {
		for($i=0; $i<=$count; $i++){
			$pattern['option'.$i] = $name.$i;
		}
		return $pattern;
	 }
}
add_action('init','cs_theme_option');
if ( ! function_exists( 'cs_theme_option' ) ) {
	function cs_theme_option(){
		global $options,$header_colors,$cs_theme_options;
		//$cs_theme_options=get_option('cs_theme_options');
		$on_off_option =  array("show" => "on","hide"=>"off"); 
		$navigation_style = array("left" => "left","center"=>"center","right"=>"right");
		$google_fonts =array('google_font_family_name'=>array('','',''),'google_font_family_url'=>array('','',''));
		$social_network =array('social_net_icon_path'=>array('','','',''),'social_net_awesome'=>array('icon-facebook8','icon-twitter7','icon-googleplus8','icon-pinterest5'),'social_net_url'=>array('https://www.facebook.com/','https://www.twitter.com/','https://plus.google.com/','https://www.pintrest.com/'),'social_net_tooltip'=>array('Facebook','Twitter','Google Plus','Pintrest'),'social_font_awesome_color'=>array('#484848','#484848','#484848','#484848'));
		$player_fields =array('player_fields'=>array('NATIONALITY','D.O.B','HEIGHT','WEIGHT'),'player_field_values'=>array('ENGLISH','20/06/1978','1.84 M','89 KG'));
		$tablepoints_columns =array('table_points_columns'=>array('Column Set 1','Column Set 2'),'table_column_title1'=>array('Column 1','Column 1'),'table_column_title2'=>array('Column 2','Column 2'),'table_column_title3'=>array('Column 3','Column 3'),'table_column_title4'=>array('Column 4','Column 4'),'table_column_title5'=>array('Column 5','Column 5'),'table_column_title6'=>array('Column 6',''),'table_column_title7'=>array('Column 7',''),'table_column_title8'=>array('',''),'table_column_title9'=>array('',''),'table_column_title10'=>array('',''));
		
		$sidebar =array('sidebar' => array('default_pages'=>'Default Pages','blogs_sidebar'=>'Blogs Sidebar','pages_sidebar'=>'Pages Sidebar','contact'=>'Contact','team_detail'=>'Team Detail','shop'=>'Shop','matches'=>'Matches','match_detail'=>'Match Detail'));
		$menus_locations = array_flip(get_nav_menu_locations());
		$breadcrumb_option = array("option1" => "option1","option2"=>"option2","option3"=>"option3");
		$deafult_sub_header = array('breadcrumbs_sub_header'=>'Breadcrumbs Sub Header','slider'=>'Revolution Slider','no_header'=>'No sub Header');
		$padding_sub_header = array('Default'=>'default','Custom'=>'custom');
		//Menus List
		$menu_option = get_registered_nav_menus();
		foreach($menu_option as $key=>$menu){
			$menu_location = $key;
			$menu_locations = get_nav_menu_locations();
			$menu_object = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);
			$menu_name[] = (isset($menu_object->name) ? $menu_object->name : '');
		}
		//Mailchimp List
		$mail_chimp_list[]='';
		if(isset($cs_theme_options['cs_mailchimp_key'])){
			$mailchimp_option = $cs_theme_options['cs_mailchimp_key'];
			$mc_list = cs_mailchimp_list($mailchimp_option);
			if(is_array($mc_list) && isset($mc_list['data'])){
				if($mc_list <> ''){
					foreach($mc_list['data'] as $list){
						$mail_chimp_list[$list['id']]=$list['name'];
					}
				}
		 	}
		}	
		
		//google fonts array
		$g_fonts = cs_googlefont_list(); 

		$g_fonts_atts = cs_get_google_font_attribute();
		
		global $cs_theme_options;
		if (isset($cs_theme_options) and $cs_theme_options <> '') {
			if(isset($cs_theme_options['sidebar']) and count($cs_theme_options['sidebar'])>0){
				$cs_sidebar =array('sidebar'=>$cs_theme_options['sidebar']);
			}elseif(!isset($cs_theme_options['sidebar'])){
				$cs_sidebar = array('sidebar'=>array());
			}
		}else{
			$cs_sidebar=$sidebar;
		}
		
		// All Teams Array
		$team_args = array(
			'hide_empty' => 0,
			'taxonomy' => 'player-team'
		);
		
	 	// Set the Options Array
		$options = array();
		$header_colors= cs_header_setting();
		/* general setting options */
		$options[] = array(	
					"name" =>__('General','goalklub'),
					"fontawesome" => 'icon-gear',
					"type" => "heading",
					"options" => array(
						'tab-global-setting'=>__('global','goalklub'),
						'tab-header-options'=>__('Header','goalklub'),
						'tab-home-announcment-options'=>__('Home announcement','goalklub'),
						'tab-sub-header-options'=>__('Sub Header','goalklub'),
						'tab-footer-options'=>__('Footer','goalklub'),
						'tab-social-setting'=>__('social icons','goalklub'),
						'tab-social-network'=>__('social sharing','goalklub'),
						'tab-custom-code'=>__('custom code','goalklub'),
						'player-fields'=>__('Player Fields','goalklub'),
						'table-points-columns'=>__('Table Points Columns','goalklub'),
					) 
				);
		$options[] = array( 
					"name" =>__("color",'goalklub'),
					"fontawesome" => 'icon-palette',
					"hint_text" => "",
					"type" => "heading",
					
					"options" => array(
						'tab-general-color'=>__('general','goalklub'),
						'tab-header-color'=>__('Header','goalklub'),
						'tab-footer-color'=>__('Footer','goalklub'),
						'tab-heading-color'=>__('headings','goalklub'),
					) 
				);
	$options[] = array( 
					"name" =>__("typography / fonts",'goalklub'),
					"fontawesome" => 'icon-font',
					"desc" => "",
					"hint_text" => "",
					"type" => "heading",
					"options" => array(
						'tab-custom-font'=>__('Custom Font','goalklub'),
						'tab-font-family'=>__('font family','goalklub'),
						'tab-font-size'=>__('font size','goalklub'),
					) 
				);					
	$options[] = array(	
					"name" =>__("sidebar",'goalklub'),
					"fontawesome" => 'icon-columns',
					"id" => "tab-sidebar",
					"std" => "",
					"type" => "main-heading",
					"options" => ''
				);
	$options[] = array(	
					"name" =>__("SEO",'goalklub'),
					"fontawesome" => 'icon-global',
					"id" => "tab-seo",
					"std" => "",
					"type" => "main-heading",
					"options" => ""
				);	
	$options[] = array( 
					"name" =>__("global",'goalklub'),
					"id" => "tab-global-setting",
					"type" => "sub-heading"
				);
	$options[] = array( 
					"name" =>__("Layout",'goalklub'),
					"desc" => "",
					"hint_text" =>__("Layout type",'goalklub'),
					"id" =>   "cs_layout",
					"std" =>  "full_width",
					"options" => array(
						"boxed" =>__("Boxed",'goalklub'),
						"full_width"=>__("Full width",'goalklub'),
					),
					"type" => "layout",
				);		
				
	$options[] = array( 
					"name" => "",
					"id" =>   "cs_horizontal_tab",
					"class" =>  "horizontal_tab",
					"type" => "horizontal_tab",
					"std" => "",
					"options" => array('Background'=>'background_tab','Pattern'=>'pattern_tab','Custom Image'=>'custom_image_tab')
				);

	$options[] = array( 
					"name" =>__("Background image",'goalklub'),
					"desc" => "",
					"hint_text" =>__("Choose from Predefined Background images.",'goalklub'),
					"id" =>   "cs_bg_image",
					"class" =>  "cs_background_",
					"path" => "background",
					"tab"=>"background_tab",
					"std" =>  "bg1",
					"type" => "layout_body",
					"display"=>"block",
					"options" => cs_bgcount('bg','10')
				);
				
	$options[] = array( "name" =>__("Background pattern",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Choose from Predefined Pattern images.",'goalklub'),
						"id" =>   "cs_bg_image",
						"class" =>  "cs_background_",
						"path" => "patterns",
						"tab"=>"pattern_tab",
						"std" =>  "bg1",
						"type" => "layout_body",
						"display"=>"none",
						"options" => cs_bgcount('pattern','27') 					
					);
	$options[] = array( 
					"name" =>__("Custom image",'goalklub'),
					"desc" => "",
					"hint_text" =>__("This option can be used only with Boxed Layout.",'goalklub'),
					"id" =>   "cs_custom_bgimage",
					"std" =>  "",
					"tab"=>"custom_image_tab",
					"display"=>"none",
					"type" => "upload logo"
				);
	$options[] = array( "name" =>__("Background image position",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Choose image position for body background",'goalklub'),
						"id" =>   "cs_bgimage_position",
						"std" =>  "Center Repeat",
						"type" => "select",
						"options" =>array(
							"option1" =>__("No-repeat Center Top",'goalklub'),
							"option2"=>__("Repeat Center Top",'goalklub'),
							"option3"=>__("No-repeat Center",'goalklub'),
							"option4"=>__("Repeat Center",'goalklub'),
							"option5"=>__("No-repeat left Top",'goalklub'),
							"option6"=>__("Repeat left Top",'goalklub'),
							"option7"=>__("No-repeat Fixed Center",'goalklub'),
							"option8"=>__("No-repeat Fixed Center / Cover",'goalklub')
						)
					);	
	$options[] = array( "name" =>__("Custom favicon",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Custom favicon for your site.",'goalklub'),
						"id" =>   "cs_custom_favicon",
						"std" =>  get_template_directory_uri()."/assets/images/favicon.png",
						"type" => "upload logo"
					);
	$options[] = array( "name" =>__("Matches Time Format",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Select the time format for Matches",'goalklub'),
						"id" =>   "cs_time_formate",
						"std" => "12 hour",
						"type" => "select",
						"options" => array('12 hour'=>'12 hour','24 hour'=>'24 hour'),
					);

	$options[] = array( "name" =>__("Smooth Scroll",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Lightweight Script for Page Scrolling animation",'goalklub'),
						"id" =>   "cs_smooth_scroll",
						"std" => "off",
						"type" => "checkbox",
						"options" => $on_off_option
					);
	
	$options[] = array( "name" =>__("RTL",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Turn RTL On/Off here for Right to Left languages like Arabic etc.",'goalklub'),
						"id" =>   "cs_style_rtl",
						"std" => "off",
						"type" => "checkbox",
						"options" => $on_off_option
					);
					
	$options[] = array( "name" =>__("Responsive",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set responsive design layout for mobile devices On/Off here",'goalklub'),
						"id" =>   "cs_responsive",
						"std" => "on",
						"type" => "checkbox",
						"options" => $on_off_option
					);
					
	// end global setting tab					
	// Header top strip option end
	// Header options start
	$options[] = array( "name" =>__("header",'goalklub'),
						"id" => "tab-header-options",
						"type" => "sub-heading"
					);
	$options[] = array( "name" =>__("Attention for Header Position!",'goalklub'),
						"id" => "header_postion_attention",
						/*"std"=>"<strong>Relative Position:</strong> The element is positioned relative to its normal position. The header is positioned above the content. <br> <strong>Absolute Position:</strong> The element is positioned relative to its first positioned. The header is positioned on the content.",*/
						"type" => "announcement"
					);
					
	$options[] = array( "name" =>__("Logo",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Upload your custom logo in .png .jpg .gif formats only.",'goalklub'),
						"id" =>   "cs_custom_logo",
						"std" => get_template_directory_uri()."/assets/images/logo.png",
						"type" => "upload logo"
					);
	$options[] = array( "name" =>__("Logo Height",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set exact logo height otherwise logo will not display normally",'goalklub'),
						"id" => "cs_logo_height",
						"min" => '0',
						"max" => '100',
						"std" => "73",
						"type" => "range"
					);				
	$options[] = array( "name" =>__("logo width",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set exact logo width otherwise logo will not display normally",'goalklub'),
						"id" => "cs_logo_width",
						"min" => '0',
						"max" => '252',
						"std" => "238",
						"type" => "range"
					);				
	
	$options[] = array( "name" =>__("Logo margin top and bottom",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Logo spacing/margin from top and bottom.",'goalklub'),
						"id" => "cs_logo_margintb",
						"min" => '0',
						"max" => '200',
						"std" => "0",
						"type" => "range"
					);	
	$options[] = array( "name" =>__("Logo margin left and right",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Logo spacing/margin from left and right.",'goalklub'),
						"id" => "cs_logo_marginlr",
						"min" => '0',
						"max" => '200',
						"std" => "0",
						"type" => "range"
					);										

 	/* header element settings*/
 	
	$options[] = array( "name" =>__("Header Elements",'goalklub'),
						"id" => "tab-header-options",
						"std" =>__("Header Elements",'goalklub'),
						"type" => "section",
						"options" => ""
					);	
	$options[] = array( "name" =>__("Main Search",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set header search On/Off. Allow user to search site content.",'goalklub'),
						"id" =>   "cs_search",
						"std" => "on",
						"type" => "checkbox",
						"options" => $on_off_option
					);
					

						
	$options[] = array( "name" =>__("Sticky Header On/Off",'goalklub'),
						"desc" => "",
						"id" =>   "cs_sitcky_header_switch",
						"hint_text" =>__("If you enable this option , header will be fixed on top of your browser window.",'goalklub'),
						"std" => "off",
						"type" => "checkbox",
						"options" => $on_off_option
					);
	$options[] = array( "name" =>__("Tagline Text",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Enable/Disable Header Tagline Text",'goalklub'),
						"id" =>   "cs_header_tagline_switch",
						"std" => "on",
						"type" => "checkbox",
						"options" => $on_off_option);
	$options[] = array( "name" =>__("Social Icon",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Enable/Disable social icon. Add icons from General > social icon",'goalklub'),
						"id" =>   "cs_socail_icon_switch",
						"std" => "off",
						"type" => "checkbox",
						"options" => $on_off_option);

						
	$options[] = array( "name" =>"Header Position Settings",
						"id" => "tab-header-options",
						"std" =>__("Header Position Settings",'goalklub'),
						"type" => "section",
						"options" => ""
					);
	$options[] = array( "name" =>__("Select Header Position",'goalklub'),
					"desc" =>__("Make header position fixed as Absolute or move it",'goalklub'),
					"hint_text" =>__("Select header position as Absolute OR Relative",'goalklub'),
					"id" =>   "cs_header_position",
					"std" => "relative",
					"type" => "select",
					"options" => array('absolute'=>'absolute','relative'=>'relative')
				);
	$options[] = array( "name" =>__("Header Background",'goalklub'),
					"desc" => "",
					"hint_text" =>__("Header settings made here will be implemented on default pages.",'goalklub'),
					"id" =>   "cs_headerbg_options",
					"std" => "Default Header Background",
					"type" => "default header background",
					"options" => array('none'=>'None','cs_rev_slider'=>'Revolution Slider','cs_bg_image_color'=>'Bg Image / bg Color')
			);				
 	$options[] = array( "name" =>__("Revolution Slider",'goalklub'),
						"desc" => "",
						"hint_text" => "<p>Please select Revolution Slider if already included in package. Otherwise buy Sliders from <a href='http://codecanyon.net/' target='_blank'>Codecanyon</a>. But its optional</p>",
						"id" =>   "cs_headerbg_slider",
						"std" => "",
						"type" => "headerbg slider",
						"options" => ''
					);
	$options[] = array( "name" =>__("Background Image",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Upload your custom background image in .png .jpg .gif formats only.",'goalklub'),
						"id" =>   "cs_headerbg_image",
						"std" =>  "",
						"type" => "upload"
					);
	$options[] = array( "name" =>__("Background Color",'goalklub'),
						"desc" => "",
						"hint_text" =>__("set header background color.",'goalklub'),
						"id" =>   "cs_headerbg_color",
						"std" => "",
						"type" => "color"
					);
	$options[] = array( "name" =>__("Header Top Strip",'goalklub'),
						"id" => "tab-header-options",
						"std" =>__("Header Top Strip",'goalklub'),
						"type" => "section",
						"options" => ""
					);					
	$options[] = array( "name" =>__("Header Strip",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Enable/Disable header top strip.",'goalklub'),
						"id" =>   "cs_header_top_strip",
						"std" => "off",
						"type" => "checkbox",
						"options" => $on_off_option);				
	
	$options[] = array( "name" =>__("WPML",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set WordPress Multi Language switcher On/Off in header",'goalklub'),
						"id" =>   "cs_wpml_switch",
						"std" => "on",
						"type" => "checkbox",
						"options" => $on_off_option
					);
					
	$options[] = array( "name" =>__("Cart Count",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Enable/Disable Woocommerce Cart Count.",'goalklub'),
						"id" =>   "cs_woocommerce_switch",
						"std" => "on",
						"type" => "checkbox",
						"options" => $on_off_option);
						
	$options[] = array( "name" =>__("Short Text",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Write phone no, email or address for Header top strip",'goalklub'),
						"id" =>   "cs_header_strip_tagline_text",
						"std" => '<p><i class="icon-envelope4"></i><a href="#">sales@yoursite.com</a></p>
                        <p><i class="icon-phone8"></i>(424) 123-0045</p>
                        <p><i class="icon-skype3"></i>Your_Skype</p>',
						"type" => "textarea");
	
	/* Home Announcment element settings*/
	$options[] = array( "name" =>__("Home announcement",'goalklub'),
						"id" => "tab-home-announcment-options",
						"type" => "sub-heading"
					);
	$options[] = array( "name" =>__("Announcement",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Enable/Disable announcement on home page",'goalklub') ,
						"id" =>   "cs_announcment_switch",
						"std" => "on",
						"type" => "checkbox",
						"options" => $on_off_option);
	$options[] = array( 
					"name" =>__("Announcement Title",'goalklub'),
					"desc" => "",
					"hint_text" =>__("Set Announcement Title",'goalklub'),
					"id" =>   "cs_announcment_title",
					"std" =>  "Latest News",
					"type" => "text",
				);					
	$options[] = array( "name" =>__("Announcement Category",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Select Announcement Category.",'goalklub'),
						"id" =>   "cs_announcment_cat",
						"std" => "",
						"type" => "category");
	$options[] = array( 
					"name" =>__("Post Count",'goalklub'),
					"desc" => "",
					"hint_text" =>__("Set Announcement Post Count",'goalklub'),
					"id" =>   "cs_announcment_count",
					"std" =>  "5",
					"type" => "text",
				);
						
	
	
	/* sub header element settings*/
	
	$options[] = array( "name" =>__("sub header",'goalklub'),
						"id" => "tab-sub-header-options",
						"type" => "sub-heading"
					);
	/*$options[] = array( "name" => "Announcement!",
						"id" => "sub_header_announcement",
						"std"=>"Change this and that and try again. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.",
						"type" => "announcement"
					);*/
					
	$options[] = array( "name" =>__("Default",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Sub Header settings made here will be implemented on all pages.",'goalklub'),
						"id" =>   "cs_default_header",
						"std" => "Breadcrumbs Sub Header",
						"type" => "default header",
						"options" => $deafult_sub_header
					);
	$options[] = array( "name" =>__("Content Padding",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Choose default or custom padding for sub header content.",'goalklub'),
						"id" =>   "subheader_padding_switch",
						"std" => "Default",
						"type" => "default padding",
						"options" => $padding_sub_header
					);
					
	$options[] = array( "name" =>__("Header Border Color",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_header_border_color",
						"std" => "",
						"type" => "color"
					);
					
	$options[] = array( "name" =>__("Revolution Slider",'goalklub'),
						"desc" => "",
						"hint_text" => "<p>Please select Revolution Slider if already included in package. Otherwise buy Sliders from <a href='http://codecanyon.net/' target='_blank'>Codecanyon</a>. But its optional</p>",
						"id" =>   "cs_custom_slider",
						"std" => "",
						"type" => "slider code",
						"options" => ''
					);
	$options[] = array( "name" =>__("Padding Top",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set custom padding for sub header content top area.",'goalklub'),
						"id" => "cs_sh_paddingtop",
						"min" => '0',
						"max" => '200',
						"std" => "45",
						"type" => "range"
					);
	$options[] = array( "name" =>__("Padding Bottom",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set custom padding for sub header content bottom area.",'goalklub'),
						"id" => "cs_sh_paddingbottom",
						"min" => '0',
						"max" => '200',
						"std" => "45",
						"type" => "range"
					);					
	$options[] = array( "name" =>__("Content Text Align",'goalklub'),
						"desc" => "",
						"hint_text" =>__("select the text Alignment for sub header content.",'goalklub'),
						"id" =>   "cs_title_align",
						"std" => "left",
						"type" => "select",
						"options" => $navigation_style
					);
	$options[] = array( "name" =>__("Page Title",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set page title On/Off in sub header",'goalklub'),
						"id" => "cs_title_switch",
						"std" => "on",
						"type" => "checkbox"
					);
	
					
	$options[] = array( "name" =>__("Breadcrumbs",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_breadcrumbs_switch",
						"std" => "off",
						"type" => "checkbox"
					);
	
	$options[] = array( "name" =>__("Background Color",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_sub_header_bg_color",
						"std" => "#f5f5f5",
						"type" => "color"
					);	
	$options[] = array( "name" =>__("Text Color",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_sub_header_text_color",
						"std" => "#fff",
						"type" => "color"
					);	
	$options[] = array( "name" =>__("Border Color",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_sub_header_border_color",
						"std" => "",
						"type" => "color"
					);			
	$options[] = array( "name" =>__("Background",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Background Image",'goalklub'),
						"id" =>   "cs_background_img",
						"std" => "",
						"type" => "upload logo"
					);			

	$options[] = array( "name" =>__("Parallax",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_parallax_bg_switch",
						"std" => "on",
						"type" => "checkbox"
					);				
	
	// start footer options	
				
	$options[] = array( "name" =>__("Footer Options",'goalklub'),
						"id" => "tab-footer-options",
						"type" => "sub-heading"
						);						
	$options[] = array( "name" =>__("Footer section",'goalklub'),
						"desc" => "",
						"hint_text" =>__("enable/disable footer area",'goalklub'),
						"id" => "cs_footer_switch",
						"std" => "on",
						"type" => "checkbox"
					);			
	$options[] = array( "name" =>__("Footer Widgets",'goalklub'),
						"desc" => "",
						"hint_text" =>__("enable/disable footer widget area",'goalklub'),
						"id" => "cs_footer_widget",
						"std" => "off",
						"type" => "checkbox"
					);					
	
		
	$options[] = array( "name" =>__("Social Icons",'goalklub'),
						"desc" => "",
						"hint_text" => __("Enable/disable Social Icons",'goalklub'),
						"id" => "cs_sub_footer_social_icons",
						"std" => "off",
						"type" => "checkbox");						
		
						
	$options[] = array( "name" =>__("footer logo",'goalklub'),
						"desc" => "",
						"hint_text" =>__("set custom footer logo",'goalklub'),
						"id" =>   "cs_footer_logo",
						"std" => get_template_directory_uri()."/assets/images/footer-logo.png",
						"type" => "upload logo");
						
	$options[] = array( "name" =>__("Footer Background Image",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set custom Footer Background Image",'goalklub'),
						"id" =>   "cs_footer_background_image",
						"std" => get_template_directory_uri()."/assets/images/copyright-bg.png",
						"type" => "upload logo");		
									
	$options[] = array( "name" =>__("copyright text",'goalklub'),
						"desc" => "",
						"hint_text" =>__("write your own copyright text",'goalklub'),
						"id" => "cs_copy_right",
						"std" => "&copy; 2019 Theme Options Wordpress All rights reserved.",
						"type" => "textarea"
					);
					
	$options[] = array( "name" =>"Footer Twitter Options",
						"id" => "tab-footer-twitter-options",
						"std" =>__("Footer Twitter Options",'goalklub'),
						"type" => "section",
						"options" => ""
					);
	
	$options[] = array( "name" =>__("Footer Twitter Background Color",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set Footer Twitter Background Color",'goalklub'),
						"id" => "cs_footer_tweet_bgcolor",
						"std" => "#fff",
						"type" => "color"
					);
										
	$options[] = array( "name" =>__("footer twitter",'goalklub'),
						"desc" => "",
						"hint_text" =>__("set footer twitter on/off",'goalklub'),
						"id" =>   "cs_footer_twitter",
						"std" => "off",
						"type" => "checkbox");
						
	$options[] = array( 
					"name" =>__("twitter username",'goalklub'),
					"desc" => "",
					"hint_text" =>__("set footer twitter username",'goalklub'),
					"id" =>   "cs_footer_twitter_username",
					"std" =>  "",
					"type" => "text",
				);
	
	$options[] = array( 
					"name" =>__("twitter no. of tweets",'goalklub'),
					"desc" => "",
					"hint_text" =>__("set number of tweets such as 5",'goalklub'),
					"id" =>   "cs_footer_twitter_num_tweets",
					"std" =>  "",
					"type" => "text",
				);
				
	// End footer tab setting
	/* general colors*/				
	$options[] = array( "name" =>__("general colors",'goalklub'),
						"id" => "tab-general-color",
						"type" => "sub-heading"
						);	
	$options[] = array( "name" =>__("Theme Color",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Choose theme skin color",'goalklub'),
						"id" => "cs_theme_color",
						"std" => "#EF2743",
						"type" => "color"
					);
					
	$options[] = array( "name" =>__("Background Color",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Choose Body Background Color",'goalklub'),
						"id" => "cs_bg_color",
						"std" => "#ffffff",
						"type" => "color"
					);
					
	$options[] = array( "name" =>__("Body Text Color",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Choose text color",'goalklub'),
						"id" => "cs_text_color",
						"std" => "#444444",
						"type" => "color"
					);	
					
	// start top strip tab options
	$options[] = array( "name" =>__("header colors",'goalklub'),
						"id" => "tab-header-color",
						"type" => "sub-heading"
						);	
	$options[] = array( "name" =>__("top strip colors",'goalklub'),
						"id" => "tab-top-strip-color",
						"std" =>__("Top Strip",'goalklub'),
						"type" => "section",
						"options" => ""
						);
	$options[] = array( "name" =>__("Background Color",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Change Top Strip background color",'goalklub'),
						"id" => "cs_topstrip_bgcolor",
						"std" => "#000",
						"type" => "color"
					);
					
	$options[] = array( "name" =>__("Text Color",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Change Top Strip text color",'goalklub'),
						"id" => "cs_topstrip_text_color",
						"std" => "#999",
						"type" => "color"
					);
					
	$options[] = array( "name" =>__("Link Color",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Change Top Strip link color",'goalklub'),
						"id" => "cs_topstrip_link_color",
						"std" => "#ffffff",
						"type" => "color"
					);
					
						
	// end top stirp tab options
	// start header color tab options
	$options[] = array( "name" =>__("Header Colors",'goalklub'),
						"id" => "tab-header-color",
						"std" =>__("Header Colors",'goalklub'),
						"type" => "section",
						"options" => ""
						);
						
	$options[] = array( "name" =>__("Text Color",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Change Header Text color",'goalklub'),
						"id" => "cs_header_text_clr",
						"std" => "#999",
						"type" => "color"
					);
	$options[] = array( "name" =>__("Background Color",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Change Header background color",'goalklub'),
						"id" => "cs_header_bgcolor",
						"std" => "#0b0b0b",
						"type" => "color"
					);											
	$options[] = array( "name" =>__("Navigation Background Color",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Change Header Navigation Background color",'goalklub'),
						"id" => "cs_nav_bgcolor",
						"std" => "#080808",
						"type" => "color"
					);
					
	
					
	 $options[] = array( "name" =>__("Menu Link color",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Change Header Menu Link color",'goalklub'),
						"id" => "cs_menu_color",
						"std" => "#ffffff",
						"type" => "color"
					);
					
	$options[] = array( "name" =>__("Menu Active Link color",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Change Header Menu Active Link color",'goalklub'),
						"id" => "cs_menu_active_color",
						"std" => "#fff",
						"type" => "color"
					);
					

	$options[] = array( "name" =>__("Submenu Background",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Change Submenu Background color",'goalklub'),
						"id" => "cs_submenu_bgcolor",
						"std" => "#090f17",
						"type" => "color",
					);
			
	$options[] = array( "name" =>__("Submenu Link Color",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Change Submenu Link color",'goalklub'),
						"id" => "cs_submenu_color",
						"std" => "#fff",
						"type" => "color"
					);
					
	$options[] = array( "name" =>__("Submenu Hover Link Color",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Change Submenu Hover Link color",'goalklub'),
						"id" => "cs_submenu_hover_color",
						"std" => "#d7233c",
						"type" => "color"
					);
	
	$options[] = array( "name" =>__("Announcement Colors",'goalklub'),
						"id" => "tab-announcment-color",
						"std" =>__("Announcement Colors",'goalklub'),
						"type" => "section",
						"options" => ""
						);
	$options[] = array( "name" =>__("Background Color",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Change Announcement background color",'goalklub'),
						"id" => "cs_announcment_bgcolor",
						"std" => "#1a1a1a",
						"type" => "color"
					);
	$options[] = array( "name" =>__("Text Color",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Change Announcement Text color",'goalklub'),
						"id" => "cs_announcment_txtcolor",
						"std" => "#fff",
						"type" => "color"
					);
	
	/* footer colors*/				
	$options[] = array( "name" =>__("footer colors",'goalklub'),
						"id" => "tab-footer-color",
						"type" => "sub-heading"
						);								
	$options[] = array( "name" =>__("Footer Background Color",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_footerbg_color",
						"std" => "#F0F0F0",
						"type" => "color"
					);
	
	$options[] = array( "name" =>__("Footer Title Color",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_title_color",
						"std" => "#000000",
						"type" => "color"
					);
					
	$options[] = array( "name" =>__("Footer Text Color",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_footer_text_color",
						"std" => "#444444",
						"type" => "color"
					);
					
	$options[] = array( "name" =>__("Footer Link Color",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_link_color",
						"std" => "#d7233c",
						"type" => "color"
					);
	
	$options[] = array( "name" =>__("Footer Widget Background Color",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_sub_footerbg_color",
						"std" => "#f0f0f0",
						"type" => "color"
					);
	
	$options[] = array( "name" =>__("copyright text",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_copyright_text_color",
						"std" => "#fff",
						"type" => "color"
					);
	
	/* heading colors*/				
	$options[] = array( "name" =>__("heading colors",'goalklub'),
						"id" => "tab-heading-color",
						"type" => "sub-heading"
						);								
	$options[] = array( "name" =>__("heading h1",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_h1_color",
						"std" => "#000000",
						"type" => "color"
					);
	
	$options[] = array( "name" =>__("heading h2",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_h2_color",
						"std" => "#000000",
						"type" => "color"
					);
	
	$options[] = array( "name" =>__("heading h3",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_h3_color",
						"std" => "#000000",
						"type" => "color"
					);
	
	$options[] = array( "name" =>__("heading h4",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_h4_color",
						"std" => "#000000",
						"type" => "color"
					);
	
	$options[] = array( "name" =>__("heading h5",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_h5_color",
						"std" => "#000000",
						"type" => "color"
					);
	
	$options[] = array( "name" =>__("heading h6",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_h6_color",
						"std" => "#000000",
						"type" => "color"
					);
																																																				
	// end header color tab options	
	
	/* start custom font family */
	$options[] = array( "name" =>__("Custom Fonts",'goalklub'),
						"id" => "tab-custom-font",
						"type" => "sub-heading"
						);
						
	$options[] = array( "name" =>__("Custom Font .woff",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Custom font for your site upload .woff format file.",'goalklub'),
						"id" =>   "cs_custom_font_woff",
						"std" =>  "",
						"type" => "upload font"
					);
					
	$options[] = array( "name" =>__("Custom Font .ttf",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Custom font for your site upload .ttf format file.",'goalklub'),
						"id" =>   "cs_custom_font_ttf",
						"std" =>  "",
						"type" => "upload font"
					);
					
	$options[] = array( "name" =>__("Custom Font .svg",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Custom font for your site upload .svg format file.",'goalklub'),
						"id" =>   "cs_custom_font_svg",
						"std" =>  "",
						"type" => "upload font"
					);
					
	$options[] = array( "name" =>__("Custom Font .eot",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Custom font for your site upload .eot format file.",'goalklub'),
						"id" =>   "cs_custom_font_eot",
						"std" =>  "",
						"type" => "upload font"
					);	
									
	/* start font family */
	$options[] = array( "name" =>__("font family",'goalklub'),
						"id" => "tab-font-family",
						"type" => "sub-heading"
						);
	$options[] = array( "name" =>__("Content Font",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set fonts for Body text",'goalklub'),
						"id" =>   "cs_content_font",
						"std" => "Roboto",
						"type" => "gfont_select",
						"options" => $g_fonts
					);
	$options[] = array( "name" => __("Content Font Attribute",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set Font Attribute",'goalklub'),
						"id" =>   "cs_content_font_att",
						"std" => "",
						"type" => "gfont_att_select",
						"options" => $g_fonts_atts
					);
	$options[] = array( "name" =>__("Main Menu Font",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set font for main Menu. It will be applied to sub menu as well",'goalklub'),
						"id" =>   "cs_mainmenu_font",
						"std" => "Roboto",
						"type" => "gfont_select",
						"options" => $g_fonts
					);
	$options[] = array( "name" =>__("Main Menu Font Attribute",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set Font Attribute",'goalklub'),
						"id" =>   "cs_mainmenu_font_att",
						"std" => "",
						"type" => "gfont_att_select",
						"options" => $g_fonts_atts
					);
	$options[] = array( "name" =>__("Headings Font",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Select font for Headings. It will apply on all posts and pages headings",'goalklub'),
						"id" =>   "cs_heading_font",
						"std" => "Cabin",
						"type" => "gfont_select",
						"options" => $g_fonts
					);
	$options[] = array( "name" =>__("Headings Font Attribute",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set Font Attribute",'goalklub'),
						"id" =>   "cs_heading_font_att",
						"std" => "",
						"type" => "gfont_att_select",
						"options" => $g_fonts_atts
					);					
	$options[] = array( "name" =>__("Widget Headings Font",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set font for Widget Headings",'goalklub'),
						"id" =>   "cs_widget_heading_font",
						"std" => "Cabin",
						"type" => "gfont_select",
						"options" => $g_fonts
					);
					
	$options[] = array( "name" =>__("Widget Headings Font Attribute",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set Font Attribute",'goalklub'),
						"id" =>   "cs_widget_heading_font_att",
						"std" => "",
						"type" => "gfont_att_select",
						"options" => $g_fonts_atts
					);								
	 /* start font size */
	$options[] = array( "name" =>__("Font size",'goalklub'),
						"id" => "tab-font-size",
						"type" => "sub-heading"
						);
	 
	$options[] = array( "name" =>__("Content",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_content_size",
						"min" => '6',
						"max" => '50',
						"std" => "14",
						"type" => "range"
					);
	$options[] = array( "name" =>__("Main Menu",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_mainmenu_size",
						"min" => '6',
						"max" => '50',
						"std" => "12",
						"type" => "range"
					);
	$options[] = array( "name" =>__("Heading 1",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_1_size",
						"min" => '6',
						"max" => '50',
						"std" => "32",
						"type" => "range"
					);
	$options[] = array( "name" =>__("Heading 2",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_2_size",
						"min" => '6',
						"max" => '50',
						"std" => "20",
						"type" => "range"
					);
	$options[] = array( "name" =>__("Heading 3",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_3_size",
						"min" => '6',
						"max" => '50',
						"std" => "18",
						"type" => "range"
					);	
	$options[] = array( "name" =>__("Heading 4",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_4_size",
						"min" => '6',
						"max" => '50',
						"std" => "16",
						"type" => "range"
					);
	$options[] = array( "name" =>__("Heading 5",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_5_size",
						"min" => '6',
						"max" => '50',
						"std" => "14",
						"type" => "range"
					);
	$options[] = array( "name" =>__("Heading 6",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_heading_6_size",
						"min" => '6',
						"max" => '50',
						"std" => "12",
						"type" => "range"
					);
					
	$options[] = array( "name" =>__("Widget Heading",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_widget_heading_size",
						"min" => '6',
						"max" => '50',
						"std" => "15",
						"type" => "range"
					);		
	$options[] = array( "name" =>__("Section Title",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_section_title_size",
						"min" => '6',
						"max" => '50',
						"std" => "18",
						"type" => "range"
					);	
																							
	/* social icons setting*/					
	$options[] = array( "name" =>__("social icons",'goalklub'),
						"id" => "tab-social-setting",
						"type" => "sub-heading"
						);			
	$options[] = array( "name" =>__("Social Network",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_social_network",
						"std" => "",
						"type" => "networks",
						"options" => $social_network
					); 
	/* social icons end*/	
	/* social Network setting*/					
					
	$options[] = array( "name" =>__("social Sharing",'goalklub'),
						"id" => "tab-social-network",
						"type" => "sub-heading"
						);
	$options[] = array( "name" =>__("Facebook",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_facebook_share",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("Twitter",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_twitter_share",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("Google Plus",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_google_plus_share",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("Pinterest",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_pintrest_share",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("Tumblr",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_tumblr_share",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("Dribbble",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_dribbble_share",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("Instagram",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_instagram_share",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("StumbleUpon",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_stumbleupon_share",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("youtube",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_youtube_share",
						"std" => "on",
						"type" => "checkbox");
	
	$options[] = array( "name" =>__("share more",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_share_share",
						"std" => "on",
						"type" => "checkbox");
	
	/* social network end*/
	
	
	
	/* custom code setting*/	
	$options[] = array( "name" =>__("custom code",'goalklub'),
						"id" => "tab-custom-code",
						"type" => "sub-heading"
					);
	$options[] = array( "name" =>__("Custom Css",'goalklub'),
						"desc" => "",
						"hint_text" =>__("write you custom css without style tag",'goalklub'),
						"id" => "cs_custom_css",
						"std" => "",
						"type" => "textarea"
					);
						
	$options[] = array( "name" =>__("Custom JavaScript",'goalklub'),
						"desc" => "",
						"hint_text" =>__("write you custom js without script tag",'goalklub'),
						"id" => "cs_custom_js",
						"std" => "",
						"type" => "textarea"
					);
	
	$options[] = array( "name" =>__("Player Fields",'goalklub'),
						"id" => "player-fields",
						"type" => "sub-heading"
					);
					
	$options[] = array( "name" =>__("Player Fields",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_player_fields",
						"std" => "",
						"type" => "player_fields",
						"options" => $player_fields
					);
	
	$options[] = array( "name" =>__("Table Points Columns",'goalklub'),
						"id" => "table-points-columns",
						"type" => "sub-heading"
					);
					
	$options[] = array( "name" =>__("Table Points Columns",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" => "cs_table_points_columns",
						"std" => "",
						"type" => "table_points_columns",
						"options" => $tablepoints_columns
					);
					
	/* sidebar tab */
	$options[] = array( "name" =>__("sidebar",'goalklub'),
						"id" => "tab-sidebar",
						"type" => "sub-heading"
					);
	$options[] = array( "name" =>__("Sidebar",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Select a sidebar from the list already given. (Nine pre-made sidebars are given)",'goalklub'),
						"id" => "cs_sidebar",
						"std" => $sidebar,
						"type" => "sidebar",
						"options" => $sidebar
					);
	
	$options[] = array( "name" =>__("post layout",'goalklub'),
						"id" => "cs_non_metapost_layout",
						"std" =>__("single post layout",'goalklub'),
						"type" => "section",
						"options" => ""
						);				
	$options[] = array( "name" =>__("Single Post Layout",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Use this option to set default layout. It will be applied to all posts",'goalklub'),
						"id" =>   "cs_single_post_layout",
						"std" =>__("sidebar_right",'goalklub'),
						"type" => "layout",
						"options" => array(
							"no_sidebar" =>__("full width",'goalklub'),
							"sidebar_left"=>__("sidebar left",'goalklub'),
							"sidebar_right"=>__("sidebar right",'goalklub'),
							)
						);
					
	$options[] = array( "name" =>__("Single Layout Sidebar",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Select Single Post Layout of your choice for sidebar layout. You cannot select it for full width layout",'goalklub'),
						"id" =>   "cs_single_layout_sidebar",
						"std" => "Blogs Sidebar",
						"type" => "select_sidebar",
						"options" => $cs_sidebar
					);
					
	$options[] = array( "name" =>__("default pages",'goalklub'),
						"id" => "default_pages",
						"std" =>__("default pages",'goalklub'),
						"type" => "section",
						"options" => ""
						);
	$options[] = array( "name" =>__("Default Pages Layout",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set Sidebar for all pages like Search, Author Archive, Category Archive etc",'goalklub'),
						"id" =>   "cs_default_page_layout",
						"std" => "sidebar_right",
						"type" => "layout",
						"options" => array(
							"no_sidebar" =>__("full width",'goalklub'),
							"sidebar_left"=>__("sidebar left",'goalklub'),
							"sidebar_right"=>__("sidebar right",'goalklub'),
							)
						);					
	$options[] = array( "name" =>__("Sidebar",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Select pre-made sidebars for default pages on sidebar layout. Full width layout cannot have sidebars",'goalklub'),
						"id" =>   "cs_default_layout_sidebar",
						"std" =>__("Blogs Sidebar","goalklub"),
						"type" => "select_sidebar",
						"options" => $cs_sidebar
					);
	
	$options[] = array( "name" =>__("Excerpt",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Set excerpt length/limit from here. It controls text limit for post's content",'goalklub'),
						"id" => "cs_excerpt_length",
						"std" => "255",
						"type" => "text"
					);		
	
	/* seo */
	$options[] = array( "name" =>__("SEO",'goalklub'),
						"id" => "tab-seo",
						"type" => "sub-heading"
						);
		/*$options[] = array( "name" => "<b>Attention for External SEO Plugins!</b>",
						"id" => "header_postion_attention",
						"std"=>" <strong> If you are using any external SEO plugin, Turn OFF these options. </strong>",
						"type" => "announcement"
					);*/

	$options[] = array( "name" =>__("Built-in SEO fields",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Turn SEO options On/Off",'goalklub'),
						"id" => "cs_builtin_seo_fields",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("Meta Description",'goalklub'),
						"desc" => "",
						"hint_text" =>__("HTML attributes that explain the contents of web pages commonly used on search engine result pages (SERPs) for pages snippets",'goalklub'),
						"id" => "cs_meta_description",
						"std" => "",
						"type" => "text"
					);
					
	$options[] = array( "name" =>__("Meta Keywords",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Attributes of meta tags, a list of comma-separated words included in the HTML of a Web page that describe the topic of that page",'goalklub'),
						"id" => "cs_meta_keywords",
						"std" => "",
						"type" => "text"
					);
					
	$options[] = array( "name" =>__( "Google Analytics",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Google Analytics is a service offered by Google that generates detailed statistics about a website's traffic, traffic sources, measures conversions and sales. Paste Google Analytics code here",'goalklub'),
						"id" => "cs_google_analytics",
						"std" => "",
						"type" => "textarea"
					);
					
	/* maintenance mode*/				
	$options[] = array( "name" =>__("Maintenance Mode",'goalklub'),
						"fontawesome" => 'icon-tasks',
						"id" => "tab-maintenace-mode",
						"std" => "",
						"type" => "main-heading",
						"options" => ""
						);	
	$options[] = array( "name" =>__("Maintenance Mode",'goalklub'),
						"id" => "tab-maintenace-mode",
						"type" => "sub-heading"
						);
	$options[] = array( "name" =>__("Maintenace Page",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Users will see Maintenance page & logged in Admin will see normal site.",'goalklub'),
						"id" => "cs_maintenance_page_switch",
						"std" => "off",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("Show Logo",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Show/Hide logo on Maintenance. Logo can be uploaded from General > Header in CS Theme options.",'goalklub'),
						"id" => "cs_maintenance_logo_switch",
						"std" => "on",
						"type" => "checkbox");
						
	$options[] = array( "name" =>__("Maintenance Text",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Text for Maintenance page. Insert some basic HTML or use shortcodes here.",'goalklub'),
						"id" => "cs_maintenance_text",
						"std" => "<h1>Sorry, We are down for maintenance </h1><p>We're currently under maintenance, if all goes as planned we'll be back in</p>",
						"type" => "textarea"
					);
					
	$options[] = array( "name" =>__("About Us Text",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Text for Maintenance About Us.","goalklub"),
						"id" => "cs_maintenance_about_text",
						"std" => "<h1>About Us</h1><h6>Quisque consectetur tellus non orci rutrum, vel molestie nunc pharetra. Duis fringilla fringilla ligula, vitae aliquet quam varius vitae. Sed ac neque maximus, hendrerit nulla sit amet, euismod est.</h6><p>Sed eu turpis non risus auctor imperdiet a in arcu. In mollis mauris ut libero laoreet, sit amet maximus nibh varius. Fusce mollis nunc purus, condimentum porttitor magna porttitor eget. Pellentesque vulputate odio sapien, ut tincidunt dui eleifend non. Maecenas dignissim malesuada gravida. Sed sed tempor risus. Sed pretium blandit purus, eu viverra est faucibus in. Maecenas pretium mauris diam, vitae ullamcorper nulla ornare sed. ras vitae egestas risus, sit amet gravida mauris. Mauris congue finibus urna vehicula auctor. Vivamus molestie neque ut est tincidunt vehicula. Suspendisse suscipit sem nunc, vitae fermentum mi aliquam eget. </p>",
						"type" => "textarea"
					);
					
	$options[] = array( "name" =>__("Launch Date",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Estimated date for completion of site on Maintenance page.",'goalklub'),
						"id" => "cs_launch_date",
						"std" => gmdate("d/m/Y"),
						"type" => "text"
					);
											
	/* api options tab*/
	$options[] = array( "name" =>__("api settings",'goalklub'),
						"fontawesome" => 'icon-tools3',
						"id" => "tab-api-options",
						"std" => "",
						"type" => "main-heading",
						"options" => ""
						);
	//Start Twitter Api	
	$options[] = array( "name" =>__("all api settings",'goalklub'),
						"id" => "tab-api-options",
						"type" => "sub-heading"
						);
	$options[] = array( "name" =>__("Twitter",'goalklub'),
						"id" => "Twitter",
						"std" => "Twitter",
						"type" => "section",
						"options" => ""
						);								
		/*$options[] = array( "name" =>__("Attention for API Settings!",'goalklub'),
						"id" => "header_postion_attention",
						"std"=>__("API Settings allows admin of the site to show their activity on site semi-automatically. Set your social account API once, it will be update your social activity automatically on your site.",'goalklub'),
						"type" => "announcement"
					);*/
	$options[] = array( "name" =>__("Show Twitter",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Turn Twitter option On/Off",'goalklub'),
						"id" => "cs_twitter_api_switch",
						"std" => "off",
						"type" => "checkbox"); 
	$options[] = array("name" => __("Cache Time Limit", 'goalklub'),
            "desc" => "",
            "hint_text" => "Please enter the time limit in minutes for refresh cache",
            "id" => "cs_cache_limit_time",
            "std" => "",
            "type" => "text");
        
     $options[] = array("name" => __("Number of tweet", 'goalklub'),
            "desc" => "",
            "hint_text" => "Please enter number of tweet that you get from twitter for chache file.",
            "id" => "cs_tweet_num_post",
            "std" => "",
            "type" => "text");

      $options[] = array("name" => __("Date Time Formate", 'goalklub'),
            "desc" => "",
            "hint_text" => __("Select date time formate for every tweet.", 'goalklub'),
            "id" => "cs_twitter_datetime_formate",
            "std" => "",
            "type" => "select_values",
            "options" => array(
                'default' => __('Displays November 06 2012', 'goalklub'),
                'eng_suff' => __('Displays 6th November', 'goalklub'),
                'ddmm' => __('Displays 06 Nov', 'goalklub'),
                'ddmmyy' => __('Displays 06 Nov 2012', 'goalklub'),
                'full_date' => __('Displays Tues 06 Nov 2012', 'goalklub'),
                'time_since' => __('Displays in hours, minutes etc', 'goalklub'),
            )
        );
						
	$options[] = array( "name" =>__("Consumer Key",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" =>   "cs_consumer_key",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" =>__("Consumer Secret",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Insert consumer key. To get your account key, <a href='https://dev.twitter.com/' target='_blank'>Click Here </a>",'goalklub'),
						"id" =>   "cs_consumer_secret",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" =>__("Access Token",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Insert Twitter Access Token for permissions. When you create your Twitter App, you get this Token",'goalklub'),
						"id" =>   "cs_access_token",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" =>__("Access Token Secret",'goalklub'),
						"desc" => "",
						"hint_text" =>__("Insert Twitter Access Token Secret here. When you create your Twitter App, you get this Token",'goalklub'),
						"id" =>   "cs_access_token_secret",
						"std" => "",
						"type" => "text");
	//end Twitter Api

	//start mailChimp api
	$options[] = array( "name" =>__("Mail Chimp",'goalklub'),
						"id" => "mailchimp",
						"std" =>__("Mail Chimp",'goalklub'),
						"type" => "section",
						"options" => ""
						);	
	$options[] = array( "name" =>__("Mail Chimp Key",'goalklub'),
						"desc" =>__("Enter a valid Mail Chimp API key here to get started. Once you've done that, you can use the MailChimp Widget from the Widgets menu. You will need to have at least MailChimp list set up before the using the widget. You can get your mailchimp activation key","goalklub"),
						"hint_text" => "Get your mailchimp key by <a href='https://login.mailchimp.com/' target='_blank'>Clicking Here </a>",
						"id" =>   "cs_mailchimp_key",
						"std" => "90f86a57314446ddbe87c57acc930ce8-us2",
						"type" => "text"
						);
						
	$options[] = array( "name" =>__("MailChimp List",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" =>   "cs_mailchimp_list",
						"std" => "on",
						"type" => "mailchimp",
						"options" => $mail_chimp_list
					);
					
	$options[] = array( "name" =>__("Flickr API Setting",'goalklub'),
						"id" => "flickr_api_setting",
						"std" =>__("Flickr API Setting",'goalklub'),
						"type" => "section",
						"options" => ""
						);					
	$options[] = array( "name" =>__("Flickr key",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" =>   "flickr_key",
						"std" => "",
						"type" => "text");
	$options[] = array( "name" =>__("Flickr secret",'goalklub'),
						"desc" => "",
						"hint_text" => "",
						"id" =>   "flickr_secret",
						"std" => "",
						"type" => "text");

    $options[] = array( "name" =>__("Google API Setting",'goalklub'),
        "id" => "google_api_setting",
        "std" =>__("Google API Setting",'goalklub'),
        "type" => "section",
        "options" => ""
    );

    $options[] = array( "name" =>__("Google Api Key",'goalklub'),
        "desc" => "",
        "hint_text" => "",
        "id" =>   "google_api_key",
        "std" => "",
        "type" => "text");
    
	// import and export theme options tab
	$options[] = array( "name" =>__("import & export",'goalklub'),
						"fontawesome" => 'icon-database',
						"id" => "tab-import-export-options",
						"std" => "",
						"type" => "main-heading",
						"options" => ""
					);	
	$options[] = array( "name" =>__("import & export",'goalklub'),
						"id" => "tab-import-export-options",
						"type" => "sub-heading"
						);	
	$options[] = array( "name" =>__("Export",'goalklub'),
						"desc" => "",
						"hint_text" =>__("If you want to make changes in your site or want to preserve your current settings, Export them code by saving this code with you. You can restore your settings by pasting this code in Import section below",'goalklub'),
						"id" => "cs_export_theme_options",
						"std" => "",
						"type" => "export"
					);	
				
	$options[] = array( "name" =>__("Import",'goalklub'),
						"desc" =>__("Import theme options",'goalklub'),
						"hint_text" =>__("To Import your settings, paste the code that you got in above area and saved it with you",'goalklub'),
						"id" => "cs_import_theme_options",
						"std" => "",
						"type" => "import"
					);
					
	update_option('cs_theme_data',$options); 
	//update_option('cs_theme_options',$options); 					  
	}
}
// saving all the theme options start
/**
*
*
* Header Colors Setting
 */
 
function cs_header_setting(){
	global $header_colors;
	  $header_colors = array();
			  $header_colors['header_colors'] =array(
					  'header_1'=>array(
						  'color' =>array( 
							  	'cs_topstrip_bgcolor'   		=> '#000000',
							 	'cs_topstrip_text_color' 		=> '#999999',
								'cs_topstrip_link_color'  		=> '#ef2743',
							 	'cs_header_bgcolor'   			=> '#0B0B0B',
							 	'cs_nav_bgcolor'   			 	=> '#080808',
							 	'cs_menu_color'    				=> '#ffffff',
							 	'cs_menu_active_color'  		=> '#ffffff',
							 	'cs_submenu_bgcolor'  			=> '#090F17',
							 	'cs_submenu_color'   			=> '#FFFFFF',
							 	'cs_submenu_hover_color' 		=> '#ef2743',
						  ),
						  'logo' =>array(
							  'cs_logo_with'			=> 	'252',
							  'cs_logo_height'			=> 	'73',
							  'cs_logo_margintb' 		=> 	'0',
							  'cs_logo_marginlr' 		=> 	'0',
						  )
				  ),
			  );
			  	
			  return $header_colors;
}