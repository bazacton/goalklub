<?php
/**
 * The template for Match Detail
 * @copyright Copyright (c) 2014, Chimp Studio 
 */
global $cs_node, $post, $cs_theme_options, $cs_counter_node, $post_xml;

$cs_uniq = rand(40, 9999999);
if (is_single()) {
    cs_set_post_views($post->ID);
}
$cs_node = new stdClass();
get_header();
$cs_layout = '';
$leftSidebarFlag = false;
$rightSidebarFlag = false;
?>
<!-- PageSection Start -->
<?php
if (have_posts()):
    while (have_posts()) : the_post();
        $cs_tags_name = 'match-tag';
        $cs_categories_name = 'match-category';
        $postname = 'match';
        $image_url = cs_get_post_img_src($post->ID, 820, 462);

        $post_xml = get_post_meta($post->ID, "match", true);
        if ($post_xml <> "") {

            $cs_xmlObject = new SimpleXMLElement($post_xml);
            $cs_layout = $cs_xmlObject->sidebar_layout->cs_page_layout;
            $cs_sidebar_left = $cs_xmlObject->sidebar_layout->cs_page_sidebar_left;
            $cs_sidebar_right = $cs_xmlObject->sidebar_layout->cs_page_sidebar_right;
            $cs_page_sidebar_styling = $cs_xmlObject->cs_page_sidebar_styling;
            $cs_page_sidebar_styling_color = $cs_xmlObject->cs_page_sidebar_styling_color;

            if (isset($cs_xmlObject->cs_related_post))
                $cs_related_post = $cs_xmlObject->cs_related_post;
            else
                $cs_related_post = '';

            if (isset($cs_xmlObject->post_tags_show))
                $post_tags_show = $cs_xmlObject->post_tags_show;
            else
                $post_tags_show = '';

            if (isset($cs_xmlObject->post_pagination_show))
                $post_pagination_show = $cs_xmlObject->post_pagination_show;
            else
                $post_pagination_show = '';

            if (isset($cs_xmlObject->post_social_sharing))
                $cs_post_social_sharing = $cs_xmlObject->post_social_sharing;
            else
                $cs_post_social_sharing = '';

            if ($cs_layout == "left") {
                $cs_layout = "page-content";
                $leftSidebarFlag = true;
            } else if ($cs_layout == "right") {
                $cs_layout = "page-content";
                $rightSidebarFlag = true;
            } else {
                $cs_layout = "col-md-12";
            }
            $postname = 'post';
        } else {
            $cs_layout = $cs_theme_options['cs_single_post_layout'];
            if (isset($cs_layout) && $cs_layout == "sidebar_left") {
                $cs_layout = "page-content";
                $cs_sidebar_left = $cs_theme_options['cs_single_layout_sidebar'];
                $leftSidebarFlag = true;
            } else if (isset($cs_layout) && $cs_layout == "sidebar_right") {
                $cs_layout = "page-content";
                $cs_sidebar_right = $cs_theme_options['cs_single_layout_sidebar'];
                $rightSidebarFlag = true;
            } else {
                $cs_layout = "col-md-12";
            }
            $post_pagination_show = 'on';
            $post_tags_show = '';
            $cs_related_post = '';
            $post_social_sharing = '';
            $post_social_sharing = '';
            $cs_post_author_info_show = '';
            $postname = 'match';
            $cs_post_social_sharing = '';
        }
        if ($post_xml <> "") {
            $cs_xmlObject = new SimpleXMLElement($post_xml);

            $postname = 'match';
            $match_design_view = $cs_xmlObject->match_design_view;
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
            $cs_xmlObject = new stdClass();

            $postname = 'match';
            $match_design_view = '';
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
        }

        $matchDate = get_post_meta($post->ID, "cs_match_from_date", true);

        if (isset($match_design_view) && $match_design_view == 'full') {

            $currentDate = strtotime(date('Y-m-d H:i'));
            if ($currentDate > $matchDate) {
                get_template_part('cs-templates/match-styles/match', 'fullPastView');
            } else {
                get_template_part('cs-templates/match-styles/match', 'fullUpcommingView');
            }
        }
        ?>


        <section class="page-section team-detail" style=" padding: 0; "> 
            <!-- Container -->
            <div class="container"> 
                <!-- Row -->
                <div class="row">
                    <!--Left Sidebar Starts-->

                    <?php
                    if ($leftSidebarFlag == true) {
                        $cs_sidebar_class = '';
                        $cs_sidebar_style = '';
                        if ($cs_page_sidebar_styling == 'box') {
                            $cs_sidebar_class = 'box';
                        } else if ($cs_page_sidebar_styling == 'color') {
                            $cs_sidebar_class = 'sidebar-color';
                        }
                        ?>
                        <aside class="page-sidebar <?php echo cs_allow_special_char($cs_sidebar_class); ?>">
                            <?php if ($cs_page_sidebar_styling == 'box') { ?><div class="sidebar-border"><?php } ?>
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_left)) : ?>
                                    <?php if ($cs_page_sidebar_styling == 'box') { ?></div><?php } ?>
                            <?php endif; ?>
                        </aside>
                    <?php } ?>
                    <!--Left Sidebar End--> 

                    <!-- Match Detail Start -->
                    <div class="<?php echo esc_attr($cs_layout); ?>"> 
                        <!-- Row -->
                        <?php
                        if (isset($match_design_view) && $match_design_view == 'fixed') {
                            $currentDate = strtotime(date('Y-m-d H:i'));
                            if ($currentDate > $matchDate) {
                                get_template_part('cs-templates/match-styles/match', 'fixedPastView');
                            } else {
                                get_template_part('cs-templates/match-styles/match', 'fixedUpcommingView');
                            }
                        }
                        ?>
                        <div class="col-md-12">
                            <div class="rich_editor_text blog-editor lightbox">
                                <?php
                                the_content();
                                wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'goalklub') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>'));
                                ?>
                            </div>
                        </div>
                        <!-- Col Tags Start -->
                        <?php
                        if (isset($post_tags_show) && $post_tags_show == 'on') {?>
                            
                          
                    

                            <?php
                            $categories_list = get_the_term_list(get_the_id(), 'match-tag', '<li>', '</li><li>', '</li>');
                            
                            
                            
                            if ($categories_list) {
                                ?>
                                <div class="col-md-12">
                                     <div class="cs-section-title">
                            <?php   $tag_text = $cs_xmlObject->post_tags_show_text;
                            ?>
                            <h2><?php echo force_back($tag_text); ?></h2>
                            
                         </div>
                                    <div class="cs-tags">
                                        <ul><?php printf(__('%1$s', 'goalklub'), $categories_list); ?></ul>
                                    </div>
                                </div>
                                <?php
                        }}
                        
                        ?> 

                        <!-- Col Social Share -->
                        <?php
                        if ($cs_post_social_sharing == "on") {
                            ?>
                            <div class="col-md-12">
                                
                                    
                                    <?php
                                    if (empty($cs_xmlObject->post_social_sharing_text))
                                        $post_social_sharing_text = __('Share', 'goalklub');
                                    else
                                        $post_social_sharing_text = $cs_xmlObject->post_social_sharing_text;
                                    
                                    cs_social_share(false, true, $post_social_sharing_text);
                                    ?>
                                       
                                    </div>
                            
                        <?php } ?>

                        <!-- Post Button Start-->
                        <?php
                        if (isset($post_pagination_show) && $post_pagination_show == 'on') {
                            echo '<div class="col-md-12">';
                            echo '<div class="cs-section-title">';

                            $pagination_text = $cs_xmlObject->post_pagination_show_title;
                            ?>
                            <h2><?php echo force_back($pagination_text); ?></h2>

                            <?php
                            echo '</div>';
                            cs_next_prev_custom_links('match');
                            echo '</div>';
                        }
                        ?>


                        <!-- Col Recent Posts Start -->
                        <?php
                        if ($cs_related_post == 'on') {
                            if (empty($cs_xmlObject->cs_related_post_title))
                                $cs_related_post_title = __('Related Posts', 'goalklub');
                            else
                                $cs_related_post_title = $cs_xmlObject->cs_related_post_title;
                            ?>
                            <div class="col-md-12 post-recent">
                                <div class="cs-section-title">
                                    <h2><?php echo esc_attr($cs_related_post_title); ?></h2>
                                </div>
                                <div class="row">
                                    <?php
                                    $cs_tags_name = 'match-tag';
                                    $cs_categories_name = 'match-category';
                                    $postname = 'match';

                                    $custom_taxterms = '';
                                    $width = 250;
                                    $height = 188;
                                    $custom_taxterms = wp_get_object_terms($post->ID, array($cs_categories_name, $cs_tags_name), array('fields' => 'ids'));
                                    $args = array(
                                        'post_type' => $postname,
                                        'post_status' => 'publish',
                                        'posts_per_page' => 3,
                                        'orderby' => 'DESC',
                                        'post__not_in' => array($post->ID),
                                    );

                                    if (is_array($custom_taxterms) && !empty($custom_taxterms)) {

                                        $tax_query['tax_query'] = array(
                                            'relation' => 'OR',
                                            array(
                                                'taxonomy' => $cs_tags_name,
                                                'field' => 'id',
                                                'terms' => $custom_taxterms
                                            ),
                                            array(
                                                'taxonomy' => $cs_categories_name,
                                                'field' => 'id',
                                                'terms' => $custom_taxterms
                                            )
                                        );
                                        $args = array_merge($args, $tax_query);
                                    }
                                    $custom_query = new WP_Query($args);
                                    while ($custom_query->have_posts()) : $custom_query->the_post();
                                        $image_url = cs_get_post_img_src($post->ID, $width, $height);

                                        if ($image_url == '') {
                                            $img_class = 'no-image';
                                            $image_url = get_template_directory_uri() . '/assets/images/no-image4x3.jpg';
                                        } else {
                                            $img_class = '';
                                        }
                                        ?>

                                        <div class="col-md-4">
                                            <!-- Article -->
                                            <div class="cs-blog cs-blog-grid"> 
                                                <?php if ($image_url <> "") { ?>
                                                    <div class="cs-media">
                                                        <figure class="<?php echo esc_attr($img_class); ?>"><a href="<?php the_permalink(); ?>"><img alt="blog-grid" src="<?php echo esc_url($image_url); ?>"></a>
                                                        </figure>
                                                    </div>
                                                <?php } ?>
                                                <section>
                                                    <div class="title">
                                                        <ul class="post-option">
                                                            <li><time datetime="<?php echo date_i18n('Y-m-d', strtotime(get_the_date())); ?>"><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?></time></li>
                                                        </ul>
                                                        <h4><a href="<?php echo the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
                                                    </div>
                                                </section>
                                            </div>
                                            <!-- Article Close -->
                                        </div>
                                        <?php
                                    endwhile;
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- Col Recent Posts End --> 

                        <!-- Col Comments Start -->
                        <?php comments_template('', true); ?>
                        <!-- Col Comments End --> 

                        <?php
                    endwhile;
                    wp_reset_query();
                endif;
                ?>
            </div>
            <?php
            if ($rightSidebarFlag == true) {
                $cs_sidebar_class = '';
                $cs_sidebar_style = '';
                if ($cs_page_sidebar_styling == 'box') {
                    $cs_sidebar_class = 'box';
                } else if ($cs_page_sidebar_styling == 'color') {
                    $cs_sidebar_class = 'sidebar-color';
                }
                ?>
                <aside class="page-sidebar <?php echo cs_allow_special_char($cs_sidebar_class); ?>">
                    <?php if ($cs_page_sidebar_styling == 'box') { ?><div class="sidebar-border"><?php } ?>
                        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_right)) : endif; ?>
                        <?php if ($cs_page_sidebar_styling == 'box') { ?></div><?php } ?>
                </aside>
            <?php } ?>

        </div>
    </div>
</div>
</section>
<!-- Footer -->
<?php get_footer(); 
?>