<?php 
global $cs_theme_options;
if(!isset($global_var_set)){
	$cs_theme_options=get_option('cs_theme_options');
}

$cs_theme_options['cs_layout']=isset($cs_theme_options['cs_layout']) ? $cs_theme_options['cs_layout']:'';
$cs_theme_options['cs_bg_image']=isset($cs_theme_options['cs_bg_image']) ? $cs_theme_options['cs_bg_image']:'';
$cs_theme_options['cs_custom_bgimage']=isset($cs_theme_options['cs_custom_bgimage']) ? $cs_theme_options['cs_custom_bgimage']:'';
$cs_theme_options['cs_bgimage_position']=isset($cs_theme_options['cs_bgimage_position']) ? $cs_theme_options['cs_bgimage_position']:'';
$cs_theme_options['cs_custom_favicon']=isset($cs_theme_options['cs_custom_favicon']) ? $cs_theme_options['cs_custom_favicon']:'';
$cs_theme_options['cs_time_formate']=isset($cs_theme_options['cs_time_formate']) ? $cs_theme_options['cs_time_formate']:'';
$cs_theme_options['cs_smooth_scroll']=isset($cs_theme_options['cs_smooth_scroll']) ? $cs_theme_options['cs_smooth_scroll']:'';
$cs_theme_options['cs_style_rtl']=isset($cs_theme_options['cs_style_rtl']) ? $cs_theme_options['cs_style_rtl']:'';
$cs_theme_options['cs_responsive']=isset($cs_theme_options['cs_responsive']) ? $cs_theme_options['cs_responsive']:'';
$cs_theme_options['cs_custom_logo']=isset($cs_theme_options['cs_custom_logo']) ? $cs_theme_options['cs_custom_logo']:'';
$cs_theme_options['cs_logo_height']=isset($cs_theme_options['cs_logo_height']) ? $cs_theme_options['cs_logo_height']:'';
$cs_theme_options['cs_logo_width']=isset($cs_theme_options['cs_logo_width']) ? $cs_theme_options['cs_logo_width']:'';
$cs_theme_options['cs_logo_margintb']=isset($cs_theme_options['cs_logo_margintb']) ? $cs_theme_options['cs_logo_margintb']:'';
$cs_theme_options['cs_logo_marginlr']=isset($cs_theme_options['cs_logo_marginlr']) ? $cs_theme_options['cs_logo_marginlr']:'';
$cs_theme_options['cs_search']=isset($cs_theme_options['cs_search']) ? $cs_theme_options['cs_search']:'';
$cs_theme_options['cs_sitcky_header_switch']=isset($cs_theme_options['cs_sitcky_header_switch']) ? $cs_theme_options['cs_sitcky_header_switch']:'';
$cs_theme_options['cs_header_tagline_switch']=isset($cs_theme_options['cs_header_tagline_switch']) ? $cs_theme_options['cs_header_tagline_switch']:'';
$cs_theme_options['cs_socail_icon_switch']=isset($cs_theme_options['cs_socail_icon_switch']) ? $cs_theme_options['cs_socail_icon_switch']:'';
$cs_theme_options['cs_header_position']=isset($cs_theme_options['cs_header_position']) ? $cs_theme_options['cs_header_position']:'';
$cs_theme_options['cs_headerbg_options']=isset($cs_theme_options['cs_headerbg_options']) ? $cs_theme_options['cs_headerbg_options']:'';
$cs_theme_options['cs_headerbg_slider']=isset($cs_theme_options['cs_headerbg_slider']) ? $cs_theme_options['cs_headerbg_slider']:'';
$cs_theme_options['cs_headerbg_image']=isset($cs_theme_options['cs_headerbg_image']) ? $cs_theme_options['cs_headerbg_image']:'';
$cs_theme_options['cs_headerbg_color']=isset($cs_theme_options['cs_headerbg_color']) ? $cs_theme_options['cs_headerbg_color']:'';
$cs_theme_options['cs_header_top_strip']=isset($cs_theme_options['cs_header_top_strip']) ? $cs_theme_options['cs_header_top_strip']:'';
$cs_theme_options['cs_wpml_switch']=isset($cs_theme_options['cs_wpml_switch']) ? $cs_theme_options['cs_wpml_switch']:'';
$cs_theme_options['cs_woocommerce_switch']=isset($cs_theme_options['cs_woocommerce_switch']) ? $cs_theme_options['cs_woocommerce_switch']:'';
$cs_theme_options['cs_header_strip_tagline_text']=isset($cs_theme_options['cs_header_strip_tagline_text']) ? $cs_theme_options['cs_header_strip_tagline_text']:'';
$cs_theme_options['cs_announcment_switch']=isset($cs_theme_options['cs_announcment_switch']) ? $cs_theme_options['cs_announcment_switch']:'';
$cs_theme_options['cs_announcment_title']=isset($cs_theme_options['cs_announcment_title']) ? $cs_theme_options['cs_announcment_title']:'';
$cs_theme_options['cs_announcment_cat']=isset($cs_theme_options['cs_announcment_cat']) ? $cs_theme_options['cs_announcment_cat']:'';
$cs_theme_options['cs_announcment_count']=isset($cs_theme_options['cs_announcment_count']) ? $cs_theme_options['cs_announcment_count']:'';
$cs_theme_options['cs_default_header']=isset($cs_theme_options['cs_default_header']) ? $cs_theme_options['cs_default_header']:'';
$cs_theme_options['subheader_padding_switch']=isset($cs_theme_options['subheader_padding_switch']) ? $cs_theme_options['subheader_padding_switch']:'';
$cs_theme_options['cs_header_border_color']=isset($cs_theme_options['cs_header_border_color']) ? $cs_theme_options['cs_header_border_color']:'';
$cs_theme_options['cs_custom_slider']=isset($cs_theme_options['cs_custom_slider']) ? $cs_theme_options['cs_custom_slider']:'';
$cs_theme_options['cs_sh_paddingtop']=isset($cs_theme_options['cs_sh_paddingtop']) ? $cs_theme_options['cs_sh_paddingtop']:'';
$cs_theme_options['cs_sh_paddingbottom']=isset($cs_theme_options['cs_sh_paddingbottom']) ? $cs_theme_options['cs_sh_paddingbottom']:'';
$cs_theme_options['cs_title_align']=isset($cs_theme_options['cs_title_align']) ? $cs_theme_options['cs_title_align']:'';
$cs_theme_options['cs_title_switch']=isset($cs_theme_options['cs_title_switch']) ? $cs_theme_options['cs_title_switch']:'';
$cs_theme_options['cs_breadcrumbs_switch']=isset($cs_theme_options['cs_breadcrumbs_switch']) ? $cs_theme_options['cs_breadcrumbs_switch']:'';
$cs_theme_options['cs_sub_header_bg_color']=isset($cs_theme_options['cs_sub_header_bg_color']) ? $cs_theme_options['cs_sub_header_bg_color']:'';
$cs_theme_options['cs_sub_header_text_color']=isset($cs_theme_options['cs_sub_header_text_color']) ? $cs_theme_options['cs_sub_header_text_color']:'';
$cs_theme_options['cs_sub_header_border_color']=isset($cs_theme_options['cs_sub_header_border_color']) ? $cs_theme_options['cs_sub_header_border_color']:'';
$cs_theme_options['cs_background_img']=isset($cs_theme_options['cs_background_img']) ? $cs_theme_options['cs_background_img']:'';
$cs_theme_options['cs_parallax_bg_switch']=isset($cs_theme_options['cs_parallax_bg_switch']) ? $cs_theme_options['cs_parallax_bg_switch']:'';
$cs_theme_options['cs_footer_switch']=isset($cs_theme_options['cs_footer_switch']) ? $cs_theme_options['cs_footer_switch']:'';
$cs_theme_options['cs_footer_widget']=isset($cs_theme_options['cs_footer_widget']) ? $cs_theme_options['cs_footer_widget']:'';
$cs_theme_options['cs_sub_footer_social_icons']=isset($cs_theme_options['cs_sub_footer_social_icons']) ? $cs_theme_options['cs_sub_footer_social_icons']:'';
$cs_theme_options['cs_footer_logo']=isset($cs_theme_options['cs_footer_logo']) ? $cs_theme_options['cs_footer_logo']:'';
$cs_theme_options['cs_footer_background_image']=isset($cs_theme_options['cs_footer_background_image']) ? $cs_theme_options['cs_footer_background_image']:'';
$cs_theme_options['cs_copy_right']=isset($cs_theme_options['cs_copy_right']) ? $cs_theme_options['cs_copy_right']:'';
$cs_theme_options['cs_footer_tweet_bgcolor']=isset($cs_theme_options['cs_footer_tweet_bgcolor']) ? $cs_theme_options['cs_footer_tweet_bgcolor']:'';
$cs_theme_options['cs_footer_twitter']=isset($cs_theme_options['cs_footer_twitter']) ? $cs_theme_options['cs_footer_twitter']:'';
$cs_theme_options['cs_footer_twitter_username']=isset($cs_theme_options['cs_footer_twitter_username']) ? $cs_theme_options['cs_footer_twitter_username']:'';
$cs_theme_options['cs_footer_twitter_num_tweets']=isset($cs_theme_options['cs_footer_twitter_num_tweets']) ? $cs_theme_options['cs_footer_twitter_num_tweets']:'';
$cs_theme_options['cs_theme_color']=isset($cs_theme_options['cs_theme_color']) ? $cs_theme_options['cs_theme_color']:'';
$cs_theme_options['cs_bg_color']=isset($cs_theme_options['cs_bg_color']) ? $cs_theme_options['cs_bg_color']:'';
$cs_theme_options['cs_text_color']=isset($cs_theme_options['cs_text_color']) ? $cs_theme_options['cs_text_color']:'';
$cs_theme_options['cs_topstrip_bgcolor']=isset($cs_theme_options['cs_topstrip_bgcolor']) ? $cs_theme_options['cs_topstrip_bgcolor']:'';
$cs_theme_options['cs_topstrip_text_color']=isset($cs_theme_options['cs_topstrip_text_color']) ? $cs_theme_options['cs_topstrip_text_color']:'';
$cs_theme_options['cs_topstrip_link_color']=isset($cs_theme_options['cs_topstrip_link_color']) ? $cs_theme_options['cs_topstrip_link_color']:'';
$cs_theme_options['cs_header_text_clr']=isset($cs_theme_options['cs_header_text_clr']) ? $cs_theme_options['cs_header_text_clr']:'';
$cs_theme_options['cs_header_bgcolor']=isset($cs_theme_options['cs_header_bgcolor']) ? $cs_theme_options['cs_header_bgcolor']:'';
$cs_theme_options['cs_nav_bgcolor']=isset($cs_theme_options['cs_nav_bgcolor']) ? $cs_theme_options['cs_nav_bgcolor']:'';
$cs_theme_options['cs_menu_color']=isset($cs_theme_options['cs_menu_color']) ? $cs_theme_options['cs_menu_color']:'';
$cs_theme_options['cs_menu_active_color']=isset($cs_theme_options['cs_menu_active_color']) ? $cs_theme_options['cs_menu_active_color']:'';
$cs_theme_options['cs_submenu_bgcolor']=isset($cs_theme_options['cs_submenu_bgcolor']) ? $cs_theme_options['cs_submenu_bgcolor']:'';
$cs_theme_options['cs_submenu_color']=isset($cs_theme_options['cs_submenu_color']) ? $cs_theme_options['cs_submenu_color']:'';
$cs_theme_options['cs_submenu_hover_color']=isset($cs_theme_options['cs_submenu_hover_color']) ? $cs_theme_options['cs_submenu_hover_color']:'';
$cs_theme_options['cs_announcment_bgcolor']=isset($cs_theme_options['cs_announcment_bgcolor']) ? $cs_theme_options['cs_announcment_bgcolor']:'';
$cs_theme_options['cs_announcment_txtcolor']=isset($cs_theme_options['cs_announcment_txtcolor']) ? $cs_theme_options['cs_announcment_txtcolor']:'';
$cs_theme_options['cs_footerbg_color']=isset($cs_theme_options['cs_footerbg_color']) ? $cs_theme_options['cs_footerbg_color']:'';
$cs_theme_options['cs_title_color']=isset($cs_theme_options['cs_title_color']) ? $cs_theme_options['cs_title_color']:'';
$cs_theme_options['cs_footer_text_color']=isset($cs_theme_options['cs_footer_text_color']) ? $cs_theme_options['cs_footer_text_color']:'';
$cs_theme_options['cs_link_color']=isset($cs_theme_options['cs_link_color']) ? $cs_theme_options['cs_link_color']:'';
$cs_theme_options['cs_sub_footerbg_color']=isset($cs_theme_options['cs_sub_footerbg_color']) ? $cs_theme_options['cs_sub_footerbg_color']:'';
$cs_theme_options['cs_copyright_text_color']=isset($cs_theme_options['cs_copyright_text_color']) ? $cs_theme_options['cs_copyright_text_color']:'';
$cs_theme_options['cs_heading_h1_color']=isset($cs_theme_options['cs_heading_h1_color']) ? $cs_theme_options['cs_heading_h1_color']:'';
$cs_theme_options['cs_heading_h2_color']=isset($cs_theme_options['cs_heading_h2_color']) ? $cs_theme_options['cs_heading_h2_color']:'';
$cs_theme_options['cs_heading_h3_color']=isset($cs_theme_options['cs_heading_h3_color']) ? $cs_theme_options['cs_heading_h3_color']:'';
$cs_theme_options['cs_heading_h4_color']=isset($cs_theme_options['cs_heading_h4_color']) ? $cs_theme_options['cs_heading_h4_color']:'';
$cs_theme_options['cs_heading_h5_color']=isset($cs_theme_options['cs_heading_h5_color']) ? $cs_theme_options['cs_heading_h5_color']:'';
$cs_theme_options['cs_heading_h6_color']=isset($cs_theme_options['cs_heading_h6_color']) ? $cs_theme_options['cs_heading_h6_color']:'';
$cs_theme_options['cs_custom_font_woff']=isset($cs_theme_options['cs_custom_font_woff']) ? $cs_theme_options['cs_custom_font_woff']:'';
$cs_theme_options['cs_custom_font_ttf']=isset($cs_theme_options['cs_custom_font_ttf']) ? $cs_theme_options['cs_custom_font_ttf']:'';
$cs_theme_options['cs_custom_font_svg']=isset($cs_theme_options['cs_custom_font_svg']) ? $cs_theme_options['cs_custom_font_svg']:'';
$cs_theme_options['cs_custom_font_eot']=isset($cs_theme_options['cs_custom_font_eot']) ? $cs_theme_options['cs_custom_font_eot']:'';
$cs_theme_options['cs_content_font']=isset($cs_theme_options['cs_content_font']) ? $cs_theme_options['cs_content_font']:'';
$cs_theme_options['cs_content_font_att']=isset($cs_theme_options['cs_content_font_att']) ? $cs_theme_options['cs_content_font_att']:'';
$cs_theme_options['cs_mainmenu_font']=isset($cs_theme_options['cs_mainmenu_font']) ? $cs_theme_options['cs_mainmenu_font']:'';
$cs_theme_options['cs_mainmenu_font_att']=isset($cs_theme_options['cs_mainmenu_font_att']) ? $cs_theme_options['cs_mainmenu_font_att']:'';
$cs_theme_options['cs_heading_font']=isset($cs_theme_options['cs_heading_font']) ? $cs_theme_options['cs_heading_font']:'';
$cs_theme_options['cs_heading_font_att']=isset($cs_theme_options['cs_heading_font_att']) ? $cs_theme_options['cs_heading_font_att']:'';
$cs_theme_options['cs_widget_heading_font']=isset($cs_theme_options['cs_widget_heading_font']) ? $cs_theme_options['cs_widget_heading_font']:'';
$cs_theme_options['cs_widget_heading_font_att']=isset($cs_theme_options['cs_widget_heading_font_att']) ? $cs_theme_options['cs_widget_heading_font_att']:'';
$cs_theme_options['cs_content_size']=isset($cs_theme_options['cs_content_size']) ? $cs_theme_options['cs_content_size']:'';
$cs_theme_options['cs_mainmenu_size']=isset($cs_theme_options['cs_mainmenu_size']) ? $cs_theme_options['cs_mainmenu_size']:'';
$cs_theme_options['cs_heading_1_size']=isset($cs_theme_options['cs_heading_1_size']) ? $cs_theme_options['cs_heading_1_size']:'';
$cs_theme_options['cs_heading_2_size']=isset($cs_theme_options['cs_heading_2_size']) ? $cs_theme_options['cs_heading_2_size']:'';
$cs_theme_options['cs_heading_3_size']=isset($cs_theme_options['cs_heading_3_size']) ? $cs_theme_options['cs_heading_3_size']:'';
$cs_theme_options['cs_heading_4_size']=isset($cs_theme_options['cs_heading_4_size']) ? $cs_theme_options['cs_heading_4_size']:'';
$cs_theme_options['cs_heading_5_size']=isset($cs_theme_options['cs_heading_5_size']) ? $cs_theme_options['cs_heading_5_size']:'';
$cs_theme_options['cs_heading_6_size']=isset($cs_theme_options['cs_heading_6_size']) ? $cs_theme_options['cs_heading_6_size']:'';
$cs_theme_options['cs_widget_heading_size']=isset($cs_theme_options['cs_widget_heading_size']) ? $cs_theme_options['cs_widget_heading_size']:'';
$cs_theme_options['cs_section_title_size']=isset($cs_theme_options['cs_section_title_size']) ? $cs_theme_options['cs_section_title_size']:'';
$cs_theme_options['social_net_awesome_input']=isset($cs_theme_options['social_net_awesome_input']) ? $cs_theme_options['social_net_awesome_input']:'';
$cs_theme_options['social_font_awesome_color']=isset($cs_theme_options['social_font_awesome_color']) ? $cs_theme_options['social_font_awesome_color']:'';
$cs_theme_options['social_net_tooltip']=isset($cs_theme_options['social_net_tooltip']) ? $cs_theme_options['social_net_tooltip']:'';
$cs_theme_options['social_net_url']=isset($cs_theme_options['social_net_url']) ? $cs_theme_options['social_net_url']:'';
$cs_theme_options['social_net_icon_path']=isset($cs_theme_options['social_net_icon_path']) ? $cs_theme_options['social_net_icon_path']:'';
$cs_theme_options['social_net_awesome']=isset($cs_theme_options['social_net_awesome']) ? $cs_theme_options['social_net_awesome']:'';
$cs_theme_options['cs_facebook_share']=isset($cs_theme_options['cs_facebook_share']) ? $cs_theme_options['cs_facebook_share']:'';
$cs_theme_options['cs_twitter_share']=isset($cs_theme_options['cs_twitter_share']) ? $cs_theme_options['cs_twitter_share']:'';
$cs_theme_options['cs_google_plus_share']=isset($cs_theme_options['cs_google_plus_share']) ? $cs_theme_options['cs_google_plus_share']:'';
$cs_theme_options['cs_pintrest_share']=isset($cs_theme_options['cs_pintrest_share']) ? $cs_theme_options['cs_pintrest_share']:'';
$cs_theme_options['cs_tumblr_share']=isset($cs_theme_options['cs_tumblr_share']) ? $cs_theme_options['cs_tumblr_share']:'';
$cs_theme_options['cs_dribbble_share']=isset($cs_theme_options['cs_dribbble_share']) ? $cs_theme_options['cs_dribbble_share']:'';
$cs_theme_options['cs_instagram_share']=isset($cs_theme_options['cs_instagram_share']) ? $cs_theme_options['cs_instagram_share']:'';
$cs_theme_options['cs_stumbleupon_share']=isset($cs_theme_options['cs_stumbleupon_share']) ? $cs_theme_options['cs_stumbleupon_share']:'';
$cs_theme_options['cs_youtube_share']=isset($cs_theme_options['cs_youtube_share']) ? $cs_theme_options['cs_youtube_share']:'';
$cs_theme_options['cs_share_share']=isset($cs_theme_options['cs_share_share']) ? $cs_theme_options['cs_share_share']:'';
$cs_theme_options['cs_custom_css']=isset($cs_theme_options['cs_custom_css']) ? $cs_theme_options['cs_custom_css']:'';
$cs_theme_options['cs_custom_js']=isset($cs_theme_options['cs_custom_js']) ? $cs_theme_options['cs_custom_js']:'';
$cs_theme_options['player_fields']=isset($cs_theme_options['player_fields']) ? $cs_theme_options['player_fields']:'';
$cs_theme_options['player_field_values']=isset($cs_theme_options['player_field_values']) ? $cs_theme_options['player_field_values']:'';
$cs_theme_options['table_points_columns']=isset($cs_theme_options['table_points_columns']) ? $cs_theme_options['table_points_columns']:'';
$cs_theme_options['table_column_title1']=isset($cs_theme_options['table_column_title1']) ? $cs_theme_options['table_column_title1']:'';
$cs_theme_options['table_column_title2']=isset($cs_theme_options['table_column_title2']) ? $cs_theme_options['table_column_title2']:'';
$cs_theme_options['table_column_title3']=isset($cs_theme_options['table_column_title3']) ? $cs_theme_options['table_column_title3']:'';
$cs_theme_options['table_column_title4']=isset($cs_theme_options['table_column_title4']) ? $cs_theme_options['table_column_title4']:'';
$cs_theme_options['table_column_title5']=isset($cs_theme_options['table_column_title5']) ? $cs_theme_options['table_column_title5']:'';
$cs_theme_options['table_column_title6']=isset($cs_theme_options['table_column_title6']) ? $cs_theme_options['table_column_title6']:'';
$cs_theme_options['table_column_title7']=isset($cs_theme_options['table_column_title7']) ? $cs_theme_options['table_column_title7']:'';
$cs_theme_options['table_column_title8']=isset($cs_theme_options['table_column_title8']) ? $cs_theme_options['table_column_title8']:'';
$cs_theme_options['table_column_title9']=isset($cs_theme_options['table_column_title9']) ? $cs_theme_options['table_column_title9']:'';
$cs_theme_options['table_column_title10']=isset($cs_theme_options['table_column_title10']) ? $cs_theme_options['table_column_title10']:'';
$cs_theme_options['sidebar_input']=isset($cs_theme_options['sidebar_input']) ? $cs_theme_options['sidebar_input']:'';
$cs_theme_options['sidebar']=isset($cs_theme_options['sidebar']) ? $cs_theme_options['sidebar']:'';
$cs_theme_options['cs_single_post_layout']=isset($cs_theme_options['cs_single_post_layout']) ? $cs_theme_options['cs_single_post_layout']:'';
$cs_theme_options['cs_single_layout_sidebar']=isset($cs_theme_options['cs_single_layout_sidebar']) ? $cs_theme_options['cs_single_layout_sidebar']:'';
$cs_theme_options['cs_default_page_layout']=isset($cs_theme_options['cs_default_page_layout']) ? $cs_theme_options['cs_default_page_layout']:'';

$cs_theme_options['cs_default_layout_sidebar']=isset($cs_theme_options['cs_default_layout_sidebar']) ? $cs_theme_options['cs_default_layout_sidebar']:'';

$cs_theme_options['cs_excerpt_length']=isset($cs_theme_options['cs_excerpt_length']) ? $cs_theme_options['cs_excerpt_length']:'';
$cs_theme_options['cs_builtin_seo_fields']=isset($cs_theme_options['cs_builtin_seo_fields']) ? $cs_theme_options['cs_builtin_seo_fields']:'';
$cs_theme_options['cs_meta_description']=isset($cs_theme_options['cs_meta_description']) ? $cs_theme_options['cs_meta_description']:'';
$cs_theme_options['cs_meta_keywords']=isset($cs_theme_options['cs_meta_keywords']) ? $cs_theme_options['cs_meta_keywords']:'';
$cs_theme_options['cs_google_analytics']=isset($cs_theme_options['cs_google_analytics']) ? $cs_theme_options['cs_google_analytics']:'';
$cs_theme_options['cs_maintenance_page_switch']=isset($cs_theme_options['cs_maintenance_page_switch']) ? $cs_theme_options['cs_maintenance_page_switch']:'';
$cs_theme_options['cs_maintenance_logo_switch']=isset($cs_theme_options['cs_maintenance_logo_switch']) ? $cs_theme_options['cs_maintenance_logo_switch']:'';
$cs_theme_options['cs_maintenance_text']=isset($cs_theme_options['cs_maintenance_text']) ? $cs_theme_options['cs_maintenance_text']:'';
$cs_theme_options['cs_maintenance_about_text']=isset($cs_theme_options['cs_maintenance_about_text']) ? $cs_theme_options['cs_maintenance_about_text']:'';
$cs_theme_options['cs_launch_date']=isset($cs_theme_options['cs_launch_date']) ? $cs_theme_options['cs_launch_date']:'';
$cs_theme_options['cs_twitter_api_switch']=isset($cs_theme_options['cs_twitter_api_switch']) ? $cs_theme_options['cs_twitter_api_switch']:'';
$cs_theme_options['cs_cache_limit_time']=isset($cs_theme_options['cs_cache_limit_time']) ? $cs_theme_options['cs_cache_limit_time']:'';
$cs_theme_options['cs_tweet_num_post']=isset($cs_theme_options['cs_tweet_num_post']) ? $cs_theme_options['cs_tweet_num_post']:'';
$cs_theme_options['cs_twitter_datetime_formate']=isset($cs_theme_options['cs_twitter_datetime_formate']) ? $cs_theme_options['cs_twitter_datetime_formate']:'';
$cs_theme_options['cs_consumer_key']=isset($cs_theme_options['cs_consumer_key']) ? $cs_theme_options['cs_consumer_key']:'';
$cs_theme_options['cs_consumer_secret']=isset($cs_theme_options['cs_consumer_secret']) ? $cs_theme_options['cs_consumer_secret']:'';
$cs_theme_options['cs_access_token']=isset($cs_theme_options['cs_access_token']) ? $cs_theme_options['cs_access_token']:'';
$cs_theme_options['cs_access_token_secret']=isset($cs_theme_options['cs_access_token_secret']) ? $cs_theme_options['cs_access_token_secret']:'';
$cs_theme_options['cs_mailchimp_key']=isset($cs_theme_options['cs_mailchimp_key']) ? $cs_theme_options['cs_mailchimp_key']:'';
$cs_theme_options['cs_mailchimp_list']=isset($cs_theme_options['cs_mailchimp_list']) ? $cs_theme_options['cs_mailchimp_list']:'';
$cs_theme_options['flickr_key']=isset($cs_theme_options['flickr_key']) ? $cs_theme_options['flickr_key']:'';
$cs_theme_options['flickr_secret']=isset($cs_theme_options['flickr_secret']) ? $cs_theme_options['flickr_secret']:'';
$cs_theme_options['google_api_key']=isset($cs_theme_options['google_api_key']) ? $cs_theme_options['google_api_key']:'';
$cs_theme_options['cs_import_theme_options']=isset($cs_theme_options['cs_import_theme_options']) ? $cs_theme_options['cs_import_theme_options']:'';
$cs_theme_options['action']=isset($cs_theme_options['action']) ? $cs_theme_options['action']:'';
?>