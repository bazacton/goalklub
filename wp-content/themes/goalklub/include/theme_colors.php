<?php
/**
 * The template Theme Colors
 */
 
/** 
 * @Set Theme Colors
 *
 *
 */
 
 
 if ( ! function_exists( 'cs_theme_colors' ) ) {
	function cs_theme_colors(){
		global $post,$cs_theme_options,$page_colors;
 		$cs_theme_color = $cs_theme_options['cs_theme_color'];
		$sub_header_border_color = isset($cs_theme_options['cs_sub_header_border_color']) ? $cs_theme_options['cs_sub_header_border_color'] : '';
		$main_header_border_color = isset($cs_theme_options['cs_header_border_color']) ? $cs_theme_options['cs_header_border_color'] : '';
		
		$page_header_style = '';
		$page_header_border_colr = '';
		$page_subheader_border_color = '';
		$page_subheader_text_color = '';
		$cs_page_sidebar_styling_color = '';
		$cs_page_sidebar_title_color = '';
		$cs_page_sidebar_text_color = '';
		if(is_page() || is_single()){
			$cs_post_type = get_post_type($post->ID);
			switch($cs_post_type){
				case 'player':
					$post_type_meta = 'player';
					break;
				case 'post':
					$post_type_meta = 'post';
					break;
				case 'match':
					$post_type_meta = 'match';
					break;
				case 'product':
					$post_type_meta = 'product';
					break;
				default:
					$post_type_meta = 'cs_page_builder';
			}
			
			$cs_page_bulider = get_post_meta($post->ID, "$post_type_meta", true);
			$cs_xmlObject = new stdClass();
			if(isset($cs_page_bulider) && $cs_page_bulider <> ''){
				$cs_xmlObject = new SimpleXMLElement($cs_page_bulider);
				$page_header_style = $cs_xmlObject->header_banner_style;
				$page_header_border_colr = $cs_xmlObject->page_main_header_border_color;
				$page_subheader_border_color = $cs_xmlObject->page_subheader_border_color;
				$page_subheader_text_color = $cs_xmlObject->page_subheader_text_color;
				$page_subheader_bg_color = $cs_xmlObject->page_subheader_color;
				$cs_page_sidebar_styling_color = $cs_xmlObject->cs_page_sidebar_styling_color;
				$cs_page_sidebar_title_color = $cs_xmlObject->cs_page_sidebar_title_color;
				$cs_page_sidebar_text_color = $cs_xmlObject->cs_page_sidebar_text_color;
			}
		}
 ?>
<style type="text/css">
/*!
* Theme Color File */

/*!
* Theme Color */
.cs-color, .cs-colorhover:hover,.top-bar .left-side p i, .post-option li a:hover,.filter-nav li.active a,.prev .left-arrow, .prev-next-post article.next .right-arrow, .prev-next-post article.prev:after,.social-media ul li a:hover, #copyright P a,.footer-tweets ul li .text a,/*.navigation ul .sub-dropdown > li:hover > a,*/ .social-media ul li a:hover i,.post-option li a:hover,
/* ShopButton */.woocommerce ul.products li.product a.add_to_cart_button, .woocommerce-page ul.products li.product a.add_to_cart_button,
.woocommerce #content input.button, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button,.woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button/* ShopButton */,
/*Widget*/.recent_blog_widget ul li a:hover,.widget_team ul li a:hover,.recent_blog_widget ul li a:hover,.widget_result ul li a:hover,.twitter-logo a,.footer-tweets ul li i,  /* Sub Dropdown *//*.navigation ul .sub-dropdown > li:hover > a, .social-media ul li a:hover i,*/ .blog-grid .text h2 i,
.widget_blog ul li i, .prev-next-post a .icon-list8, .pagination li a:hover, .pagination li.pgprev:hover img,
.woocommerce #content table.cart a.remove, .woocommerce table.cart a.remove, .woocommerce-page #content table.cart a.remove, .woocommerce-page table.cart a.remove, .navigation ul .sub-dropdown li:hover a{
 color:<?php echo cs_allow_special_char($cs_theme_color);
?> !important;
}
/*!
* Theme Background Color */
.cs-bg-color,.cs-bgcolor, .cs-bgcolorhover:hover,.navigation ul > li:hover > a, .cs-tags ul li:hover a, .share-btn, .custom-btn,.team-detail figure figcaption header .player-no,.cs-tags ul li a:hover,.share-btn,form p.form-submit input[type="submit"],.team-detail figure figcaption header .player-no,.cs-qoute .cs-auther-name:before, 
/* ShopButton */
.woocommerce #content input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover/* ShopButton */,/*Widget*/.widget_archive ul li:hover, .widget_categories ul li:hover,.widget_pages ul > li:hover > a,.widget_meta ul li:hover,.widget_nav_menu ul > li:hover > a,.tagcloud a:hover,#wp-calendar tbody tr td#today,.widget_calendar thead,.history-list article h4:before,.history-grid article h4:before,.spreater-holder span:before, /* New Class */form p.form-submit input[type="submit"], .main-section .button_style .default, .flat, .main-section .strock, .main-section .three-d,
#footer-sec .signup .user-signup input[type="submit"], .cart-sec span.qnt {
	background-color:<?php echo cs_allow_special_char($cs_theme_color); ?> !important;
}
/*!
* Theme Border Color */
.cs-borcolor, .cs-borcolorhover:hover,.cs-section-title h2:before,.widget-section-title h2:before,
/* ShopButton */.woocommerce ul.products li.product a.add_to_cart_button, .woocommerce-page ul.products li.product a.add_to_cart_button,
.woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button /* ShopButton */,
/* New Class */.cs-section-title h2:before, .filter-nav li.active a, .products li a span:before {
 border-color:<?php echo cs_allow_special_char($cs_theme_color);?> !important;
}

.devider1:after {
	border-top-color: <?php echo cs_allow_special_char($cs_theme_color); ?> !important;
}

<?php if($cs_theme_options['cs_default_header']=='No sub Header' and !is_page() and !is_single()){ ?>
	.main-navbar {
	border-bottom:1px solid <?php echo cs_allow_special_char($main_header_border_color); ?> ;
	}
<?php
}
if((is_page() || is_single()) and ($page_header_style == 'breadcrumb_header' and $page_subheader_border_color <> '')){
	?>
	.breadcrumb-sec {
		border-top: 1px solid <?php echo cs_allow_special_char($page_subheader_border_color); ?>;
		border-bottom: 1px solid <?php echo cs_allow_special_char($page_subheader_border_color); ?>;
	}
	<?php
}
else{
	if($sub_header_border_color <> ''){
	?>
		.breadcrumb-sec {
			border-top: 1px solid <?php echo cs_allow_special_char($sub_header_border_color); ?>;
			border-bottom: 1px solid <?php echo cs_allow_special_char($sub_header_border_color); ?>;
		}
	<?php
	}
}

if((is_page() || is_single()) and ($page_header_style == 'no-header' and $page_header_border_colr <> '')){
	?>
	#main-header {
		border-bottom: 1px solid <?php echo cs_allow_special_char($page_header_border_colr); ?>;
	}
	<?php
}
else{
	if(isset($cs_theme_options['cs_default_header']) and $cs_theme_options['cs_default_header'] == 'No sub Header'){
		if($main_header_border_color <> ''){
		?>
			#main-header {
				border-bottom: 1px solid <?php echo cs_allow_special_char($main_header_border_color); ?>;
			}
		<?php
		}
	}
}

if((is_page() || is_single()) and ($page_header_style == 'breadcrumb_header' and $page_subheader_text_color <> '')){
	?>
	.breadcrumbs, .breadcrumbs li, .breadcrumbs li a {
		color: <?php echo cs_allow_special_char($page_subheader_text_color); ?> !important;
	}
	<?php
}
else{
	if(isset($cs_theme_options['cs_sub_header_text_color']) and $cs_theme_options['cs_sub_header_text_color'] <> ''){
	?>
		.breadcrumbs, .breadcrumbs li, .breadcrumbs li a {
			color: <?php echo cs_allow_special_char($cs_theme_options['cs_sub_header_text_color']); ?> !important;
		}
	<?php
	}
}
if((is_page() || is_single()) and ($cs_page_sidebar_styling_color <> '')){
	?>
	.sidebar-color.page-sidebar:before {
		background-color: <?php echo cs_allow_special_char($cs_page_sidebar_styling_color); ?> !important;
	}
	<?php
}

if($cs_page_sidebar_title_color <> '' || $cs_page_sidebar_text_color){
	?>
	.sidebar-color .widget-section-title h2,.sidebar-color .widget a {
		color: <?php echo cs_allow_special_char($cs_page_sidebar_title_color); ?> !important;
	}
	.sidebar-color .widget p,.sidebar-color .widget span,.sidebar-color .widget ul li,.sidebar-color .widget .infotext,.sidebar-color .widget i {
		color: <?php echo cs_allow_special_char($cs_page_sidebar_text_color); ?> !important;
	}
	<?php
}
?>

</style>
<?php } 
}


/** 
 * @Set Header color Css
 *
 *
 */
if ( ! function_exists( 'cs_header_color' ) ) {
	function cs_header_color(){
		global $cs_theme_options;
		
		$cs_header_bgcolor	= (isset($cs_theme_options['cs_header_bgcolor']) and $cs_theme_options['cs_header_bgcolor']<>'') ? $cs_theme_options['cs_header_bgcolor']: '';
		
		$cs_nav_bgcolor =  (isset($cs_theme_options['cs_nav_bgcolor']) and $cs_theme_options['cs_nav_bgcolor']<>'') ? $cs_theme_options['cs_nav_bgcolor']: '';
		
		$cs_menu_color = (isset($cs_theme_options['cs_menu_color']) and $cs_theme_options['cs_menu_color']<>'') ? $cs_theme_options['cs_menu_color']:'';
		
		$cs_menu_active_color = (isset($cs_theme_options['cs_menu_active_color']) and $cs_theme_options['cs_menu_active_color']<>'') ? $cs_theme_options['cs_menu_active_color']: '';
		
		$cs_submenu_bgcolor = (isset($cs_theme_options['cs_submenu_bgcolor']) and $cs_theme_options['cs_submenu_bgcolor']<>'' ) ? $cs_theme_options['cs_submenu_bgcolor']: '';
		
		$cs_submenu_color = (isset($cs_theme_options['cs_submenu_color']) and $cs_theme_options['cs_submenu_color']<>'') ? $cs_theme_options['cs_submenu_color']: '';
		
		$cs_submenu_hover_color = (isset($cs_theme_options['cs_submenu_hover_color']) and $cs_theme_options['cs_submenu_hover_color']<>'') ? $cs_theme_options['cs_submenu_hover_color']: '';
		
		$cs_header_text_clr = (isset($cs_theme_options['cs_header_text_clr']) and $cs_theme_options['cs_header_text_clr']<>'') ? $cs_theme_options['cs_header_text_clr']: '';

		$cs_topstrip_bgcolor = (isset($cs_theme_options['cs_topstrip_bgcolor']) and $cs_theme_options['cs_topstrip_bgcolor']<>'') ? $cs_theme_options['cs_topstrip_bgcolor']: '';
		
		$cs_topstrip_text_color = (isset($cs_theme_options['cs_topstrip_text_color']) and $cs_theme_options['cs_topstrip_text_color']<>'') ? $cs_theme_options['cs_topstrip_text_color']: '';
		
		$cs_topstrip_link_color = (isset($cs_theme_options['cs_topstrip_link_color']) and $cs_theme_options['cs_topstrip_link_color']<>'') ? $cs_theme_options['cs_topstrip_link_color']: '';
		
		$cs_menu_activ_bg = (isset($cs_theme_options['cs_theme_color'])) ? $cs_theme_options['cs_theme_color']: '';
		
		/* logo margins*/
		$cs_logo_margintb = (isset($cs_theme_options['cs_logo_margintb']) and  $cs_theme_options['cs_logo_margintb'] <> '') ? $cs_theme_options['cs_logo_margintb']: '0';
		$cs_logo_marginlr = (isset($cs_theme_options['cs_logo_marginlr']) and  $cs_theme_options['cs_logo_marginlr'] <> '') ? $cs_theme_options['cs_logo_marginlr']: '0';

		/* font family */
		$cs_content_font = (isset($cs_theme_options['cs_content_font'])) ? $cs_theme_options['cs_content_font']: '';
		$cs_content_font_att = (isset($cs_theme_options['cs_content_font_att'])) ? $cs_theme_options['cs_content_font_att']: '';
		
		$cs_mainmenu_font = (isset($cs_theme_options['cs_mainmenu_font'])) ? $cs_theme_options['cs_mainmenu_font']: '';
		$cs_mainmenu_font_att = (isset($cs_theme_options['cs_mainmenu_font_att'])) ? $cs_theme_options['cs_mainmenu_font_att']: '';
		
		$cs_heading_font = (isset($cs_theme_options['cs_heading_font'])) ? $cs_theme_options['cs_heading_font']: '';
		$cs_heading_font_att = (isset($cs_theme_options['cs_heading_font_att'])) ? $cs_theme_options['cs_heading_font_att']: '';
		
		$cs_widget_heading_font = (isset($cs_theme_options['cs_widget_heading_font'])) ? $cs_theme_options['cs_widget_heading_font']: '';
		$cs_widget_heading_font_att = (isset($cs_theme_options['cs_widget_heading_font_att'])) ? $cs_theme_options['cs_widget_heading_font_att']: '';
		
		// setting content fonts
		$cs_content_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $cs_content_font_att);
		
		$cs_content_font_atts = cs_get_font_att_array($cs_content_fonts);
		
		// setting main menu fonts
		$cs_mainmenu_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $cs_mainmenu_font_att);
		
		$cs_mainmenu_font_atts = cs_get_font_att_array($cs_mainmenu_fonts);
		
		// setting heading fonts
		$cs_heading_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $cs_heading_font_att);
		
		$cs_heading_font_atts = cs_get_font_att_array($cs_heading_fonts);
		
		// setting widget heading fonts
		$cs_widget_heading_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $cs_widget_heading_font_att);
		
		$cs_widget_heading_font_atts = cs_get_font_att_array($cs_widget_heading_fonts);
 		
		/* font size */
		$cs_content_size = (isset($cs_theme_options['cs_content_size'])) ? $cs_theme_options['cs_content_size']: '';
		$cs_mainmenu_size = (isset($cs_theme_options['cs_mainmenu_size'])) ? $cs_theme_options['cs_mainmenu_size']: '';
		$cs_heading_1_size = (isset($cs_theme_options['cs_heading_1_size'])) ? $cs_theme_options['cs_heading_1_size']: '';
		$cs_heading_2_size = (isset($cs_theme_options['cs_heading_2_size'])) ? $cs_theme_options['cs_heading_2_size']: '';
		$cs_heading_3_size = (isset($cs_theme_options['cs_heading_3_size'])) ? $cs_theme_options['cs_heading_3_size']: '';
		$cs_heading_4_size = (isset($cs_theme_options['cs_heading_4_size'])) ? $cs_theme_options['cs_heading_4_size']: '';
		$cs_heading_5_size = (isset($cs_theme_options['cs_heading_5_size'])) ? $cs_theme_options['cs_heading_5_size']: '';
		$cs_heading_6_size = (isset($cs_theme_options['cs_heading_6_size'])) ? $cs_theme_options['cs_heading_6_size']: '';
		
		/* font Color */
		$cs_heading_h1_color = (isset($cs_theme_options['cs_heading_h1_color']) and $cs_theme_options['cs_heading_h1_color'] <> '') ? $cs_theme_options['cs_heading_h1_color']: '';
		$cs_heading_h2_color = (isset($cs_theme_options['cs_heading_h2_color']) and $cs_theme_options['cs_heading_h2_color'] <> '') ? $cs_theme_options['cs_heading_h2_color']: '';
		$cs_heading_h3_color = (isset($cs_theme_options['cs_heading_h3_color']) and $cs_theme_options['cs_heading_h3_color'] <> '') ? $cs_theme_options['cs_heading_h3_color']: '';
		$cs_heading_h4_color = (isset($cs_theme_options['cs_heading_h4_color']) and $cs_theme_options['cs_heading_h4_color'] <> '') ? $cs_theme_options['cs_heading_h4_color']:'';
		$cs_heading_h5_color = (isset($cs_theme_options['cs_heading_h5_color']) and $cs_theme_options['cs_heading_h5_color'] <> '') ? $cs_theme_options['cs_heading_h5_color']: '';
		$cs_heading_h6_color = (isset($cs_theme_options['cs_heading_h6_color']) and $cs_theme_options['cs_heading_h6_color'] <> '') ? $cs_theme_options['cs_heading_h6_color']: '';
		$cs_text_color = $cs_theme_options['cs_text_color'];
 		
		
		$cs_widget_heading_size = (isset($cs_theme_options['cs_widget_heading_size'])) ? $cs_theme_options['cs_widget_heading_size']: '';
		$cs_section_title_size = (isset($cs_theme_options['cs_section_title_size'])) ? $cs_theme_options['cs_section_title_size']: '';
		
		if(
			( isset( $cs_theme_options['cs_custom_font_woff'] ) && $cs_theme_options['cs_custom_font_woff'] <> '' ) &&
			( isset( $cs_theme_options['cs_custom_font_ttf'] ) && $cs_theme_options['cs_custom_font_ttf'] <> '' ) &&
			( isset( $cs_theme_options['cs_custom_font_svg'] ) && $cs_theme_options['cs_custom_font_svg'] <> '' ) &&
			( isset( $cs_theme_options['cs_custom_font_eot'] ) && $cs_theme_options['cs_custom_font_eot'] <> '' )
		):
		
		$font_face_html = "
		@font-face {
			font-family: 'cs_custom_font';
			src: url('".$cs_theme_options['cs_custom_font_eot']."');
			src:
				url('".$cs_theme_options['cs_custom_font_eot']."?#iefix') format('eot'),
				url('".$cs_theme_options['cs_custom_font_woff']."') format('woff'),
				url('".$cs_theme_options['cs_custom_font_ttf']."') format('truetype'),
				url('".$cs_theme_options['cs_custom_font_svg']."#cs_custom_font') format('svg');
			font-weight: 400;
			font-style: normal;
		}";
		
        $custom_font = true; else: $custom_font = false; endif;
 	?>
		<style type="text/css">
			<?php 
				if($custom_font == true){
					echo cs_allow_special_char($font_face_html);
				}
				else{
					echo cs_get_font_family($cs_content_font, $cs_content_font_att);
					echo cs_get_font_family($cs_mainmenu_font, $cs_mainmenu_font_att);
					echo cs_get_font_family($cs_heading_font, $cs_heading_font_att);
					echo cs_get_font_family($cs_widget_heading_font, $cs_widget_heading_font_att);
				}
			?>
	.cs-section-title h2{
		font-size:<?php echo intval($cs_section_title_size) ?>px !important;
	
	}		
	body,.main-section p {
		<?php 
		if($custom_font == true){
			echo 'font-family: cs_custom_font;';
			echo 'font-size: '.$cs_content_size.';';
		}
		else{
			echo cs_font_font_print($cs_content_font_atts, $cs_content_size, $cs_content_font);
		}
		?>
 		color:<?php echo cs_allow_special_char($cs_text_color);?>;
	}
	header .logo{
		margin:<?php echo cs_allow_special_char($cs_logo_margintb);?>px <?php echo cs_allow_special_char($cs_logo_marginlr);?>px !important;
   	}
	.nav li a,header .btn-style1,.footer-nav ul li a {
		<?php 
		if($custom_font == true){
			echo 'font-family: cs_custom_font;';
			echo 'font-size: '.$cs_mainmenu_size.';';
		}
		else{
			echo cs_font_font_print($cs_mainmenu_font_atts, $cs_mainmenu_size, $cs_mainmenu_font, true);
		}
		?>
	}
 	h1{
	<?php 
	if($custom_font == true){
		echo 'font-family: cs_custom_font;';
		echo 'font-size: '.$cs_heading_1_size.';';
	}
	else{
		echo cs_font_font_print($cs_heading_font_atts, $cs_heading_1_size, $cs_heading_font, true);
	}
	 
	?>}
	h2{
	<?php 
	if($custom_font == true){
		echo 'font-family: cs_custom_font;';
		echo 'font-size: '.$cs_heading_2_size.';';
	}
	else{
		echo cs_font_font_print($cs_heading_font_atts, $cs_heading_2_size, $cs_heading_font, true);
	}
	
	?>}
	h3{
	<?php 
	if($custom_font == true){
		echo 'font-family: cs_custom_font;';
		echo 'font-size: '.$cs_heading_3_size.';';
	}
	else{
		echo cs_font_font_print($cs_heading_font_atts, $cs_heading_3_size, $cs_heading_font, true);
	}
	
	?>}
	h4{
	<?php 
	if($custom_font == true){
		echo 'font-family: cs_custom_font;';
		echo 'font-size: '.$cs_heading_4_size.';';
	}
	else{
		echo cs_font_font_print($cs_heading_font_atts, $cs_heading_4_size, $cs_heading_font, true);
	}
	
	?>}
	h5{
	<?php 
	if($custom_font == true){
		echo 'font-family: cs_custom_font;';
		echo 'font-size: '.$cs_heading_5_size.';';
	}
	else{
		echo cs_font_font_print($cs_heading_font_atts, $cs_heading_5_size, $cs_heading_font, true);
	}
	
	?>}
	h6{
	<?php 
	if($custom_font == true){
		echo 'font-family: cs_custom_font;';
		echo 'font-size: '.$cs_heading_6_size.';';
	}
	else{
		echo cs_font_font_print($cs_heading_font_atts, $cs_heading_6_size, $cs_heading_font, true);
	}
	
	?>}
	
	.main-section h1, .main-section h1 a {color: <?php echo cs_allow_special_char($cs_heading_h1_color);?> !important;}
	.main-section h2, .main-section h2 a{color: <?php echo cs_allow_special_char($cs_heading_h2_color);?> !important;}
	.main-section h3, .main-section h3 a{color: <?php echo cs_allow_special_char($cs_heading_h3_color);?> !important;}
	.main-section h4, .main-section h4 a{color: <?php echo cs_allow_special_char($cs_heading_h4_color);?> !important;}
	.main-section h5, .main-section h5 a{color: <?php echo cs_allow_special_char($cs_heading_h5_color);?> !important;}
	.main-section h6, .main-section h6 a{color: <?php echo cs_allow_special_char($cs_heading_h6_color);?> !important;}
	.widget-section-title h2 {
		<?php
		if($custom_font == true){
			echo 'font-family: cs_custom_font;';
			echo 'font-size: '.$cs_widget_heading_size.';';
		}
		else{
			echo cs_font_font_print($cs_widget_heading_font_atts, $cs_widget_heading_size, $cs_widget_heading_font, true);
		}
		?>
	}
	.top-bar,#lang_sel ul ul {background-color:<?php echo cs_allow_special_char($cs_topstrip_bgcolor);?>;}
	#lang_sel ul ul:before { border-bottom-color: <?php echo cs_allow_special_char($cs_topstrip_bgcolor);?>; }
	.top-bar p{color:<?php echo cs_allow_special_char($cs_topstrip_text_color);?> !important;}
	.top-bar a,.cs-users i{color:<?php echo cs_allow_special_char($cs_topstrip_link_color);?> !important;}
  
	.main-navbar {background:<?php echo cs_allow_special_char($cs_nav_bgcolor);?> !important;}
	.search-top input[type="text"],.search-top:after,.logo-section .left-side p{color:<?php echo cs_allow_special_char($cs_header_text_clr);?> !important;}
	.navigation ul > li > a,li.parentIcon a:after,.cs-user,.cs-user-login {color:<?php echo cs_allow_special_char($cs_menu_color);?> !important;}
	.navigation ul  > li > .sub-dropdown,.navigation ul  >  li > .sub-dropdown > li > .sub-dropdown,.mega-grid{ background-color:<?php echo cs_allow_special_char($cs_submenu_bgcolor);?> !important;}
	.navigation  .sub-dropdown li a{color:<?php echo cs_allow_special_char($cs_submenu_color);?> !important;}
	.navigation ul .sub-dropdown > li:hover > a,ul ul li.current-menu-ancestor.parentIcon > a:after,ul ul li.parentIcon:hover > a:after {border-bottom-color:<?php echo cs_allow_special_char($cs_submenu_hover_color);?>;color:<?php echo cs_allow_special_char($cs_submenu_hover_color);?> !important;}
	.navigation ul > li.current-menu-item > a,.navigation ul > li.current-menu-ancestor > a,.navigation ul > li:hover > a,li.current-menu-ancestor.parentIcon > a:after,li.parentIcon:hover > a:after {color:<?php echo cs_allow_special_char($cs_menu_active_color);?> !important;}
	.navigation .navbar-nav > .active > a:before, .navigation .navbar-nav > li > a:before{ border-bottom-color:<?php echo cs_allow_special_char($cs_menu_active_color);?> !important; }
	.cs-user,.cs-user-login { border-color:<?php echo cs_allow_special_char($cs_menu_active_color);?> !important; }
	{
		box-shadow: 0 4px 0 <?php echo cs_allow_special_char($cs_topstrip_bgcolor); ?> inset !important;
	}
	.header_2 .nav > li:hover > a,.header_2 .nav > li.current-menu-ancestor > a {
       
	}
	.logo-section, .main-head {
		background: <?php echo cs_allow_special_char( $cs_header_bgcolor); ?> !important;
	}
	</style>
<?php
	}
}



/** 
 * @Set Footer colors
 *
 *
 */
if ( ! function_exists( 'cs_footer_color' ) ) {
	function cs_footer_color(){
		global $cs_theme_options;
		$cs_footerbg_color = (isset($cs_theme_options['cs_footerbg_color']) and $cs_theme_options['cs_footerbg_color'] <> '') ? $cs_theme_options['cs_footerbg_color']: '';
		
		$cs_footerbg_image = (isset($cs_theme_options['cs_footer_background_image']) and $cs_theme_options['cs_footer_background_image'] <> '') ? $cs_theme_options['cs_footer_background_image']: '';
		
		$cs_title_color = (isset($cs_theme_options['cs_title_color']) and $cs_theme_options['cs_title_color'] <> '') ? $cs_theme_options['cs_title_color']: '';
		
		$cs_footer_text_color = (isset($cs_theme_options['cs_footer_text_color']) and $cs_theme_options['cs_footer_text_color'] <> '') ? $cs_theme_options['cs_footer_text_color']: '';
		
		$cs_link_color = (isset($cs_theme_options['cs_link_color']) and $cs_theme_options['cs_link_color'] <> '') ? $cs_theme_options['cs_link_color']: '';
		
		$cs_sub_footerbg_color = (isset($cs_theme_options['cs_sub_footerbg_color']) and $cs_theme_options['cs_sub_footerbg_color'] <> '') ? $cs_theme_options['cs_sub_footerbg_color']: '';
		
		$tweet_bg_color = (isset($cs_theme_options['cs_footer_tweet_bgcolor']) && $cs_theme_options['cs_footer_tweet_bgcolor'] <> '')? $cs_theme_options['cs_footer_tweet_bgcolor'] :'#1dcaff';
		
		$cs_copyright_text_color = (isset($cs_theme_options['cs_copyright_text_color']) and $cs_theme_options['cs_copyright_text_color'] <> '') ? $cs_theme_options['cs_copyright_text_color']: '';
?>
<style type="text/css">
        footer#footer-sec, footer#footer-sec:before,.footer-tweets {
            background-color:<?php echo cs_allow_special_char($cs_sub_footerbg_color); ?> !important;
        }
		footer.group {
            background-image:url("<?php echo cs_allow_special_char($cs_footerbg_image); ?>") !important;
        }
        #copyright {
            background:url(<?php echo esc_url($cs_footerbg_image); ?>) <?php echo cs_allow_special_char($cs_footerbg_color); ?> !important;
        }
        #copyright p {
            color:<?php echo cs_allow_special_char($cs_copyright_text_color); ?> !important;
        }
		#footer-sec a,#footer-sec .widget-form ul li input[type="submit"],#footer-sec .tagcloud a,#footer-sec .widget ul li a, #footer-sec li,#copyright a {
            color:<?php echo cs_allow_special_char($cs_link_color); ?> !important;
        }
       #footer-sec .widget h2, #footer-sec .widget h5,#footer-sec h2,#footer-sec h3,#footer-sec h4,#footer-sec h5,#footer-sec h6 {
            color:<?php echo cs_allow_special_char($cs_title_color); ?> !important;
        }
        #footer-sec .widget ul li,#footer-sec .widget p, #footer-sec .widget_calendar tr td,#footer-sec,#footer-sec .col-md-3 p,footer .widget_latest_post .post-options li,footer .widget i,.widget-form ul li i,footer .widget_rss li,footer .widget_recent_comments span {
            color:<?php echo cs_allow_special_char($cs_footer_text_color); ?> !important;
        }
		.footer-tweets ul li .text,.footer-tweets ul li .text:before{
			background:<?php echo cs_allow_special_char($tweet_bg_color); ?> !important;
		}
    </style>
<?php 
}
}