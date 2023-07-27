<?php
/**
 * The template for Player Detail
 * @copyright Copyright (c) 2014, Chimp Studio 
 */
global $cs_node, $post, $cs_theme_options;

//$cs_theme_options = get_option('cs_theme_options');

$cs_node = new stdClass();
get_header();
$cs_layout = '';
$leftSidebarFlag = false;
$rightSidebarFlag = false;

if (have_posts()):
    while (have_posts()) : the_post();
        $cs_player_team = 'player-team';
        $cs_player_department = 'player-department';
        $postname = 'player';
        $image_url = '';

        $cs_player = get_post_meta($post->ID, "player", true);
        if ($cs_player <> "") {

            $cs_xmlObject = new SimpleXMLElement($cs_player);
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

            if (isset($cs_xmlObject->post_social_sharing))
                $cs_post_social_sharing = $cs_xmlObject->post_social_sharing;
            else
                $cs_post_social_sharing = '';

            if (isset($cs_xmlObject->post_social_sharing_text))
                $post_social_sharing_text = $cs_xmlObject->post_social_sharing_text;
            else
                $post_social_sharing_text = '';

            if (isset($cs_xmlObject->post_author_info_show))
                $cs_post_author_info_show = $cs_xmlObject->post_author_info_show;
            else
                $cs_post_author_info_show = '';

            if (isset($cs_xmlObject->post_pagination_show))
                $post_pagination_show = $cs_xmlObject->post_pagination_show;
            else
                $post_pagination_show = '';

            if ($cs_layout == "left") {
                $cs_layout = "page-content player-editor";
                $custom_height = 360;
                $leftSidebarFlag = true;
            } else if ($cs_layout == "right") {
                $cs_layout = "page-content player-editor";
                $custom_height = 360;
                $rightSidebarFlag = true;
            } else {
                $cs_layout = "";
                $custom_height = 360;
            }
            $postname = 'player';
        } else {
            $cs_layout = $cs_theme_options['cs_single_post_layout'];
            if (isset($cs_layout) && $cs_layout == "sidebar_left") {
                $cs_layout = "page-content player-editor";
                $cs_sidebar_left = $cs_theme_options['cs_single_layout_sidebar'];
                $custom_height = 360;
                $leftSidebarFlag = true;
            } else if (isset($cs_layout) && $cs_layout == "sidebar_right") {
                $cs_layout = "page-content player-editor";
                $cs_sidebar_right = $cs_theme_options['cs_single_layout_sidebar'];
                $custom_height = 360;
                $rightSidebarFlag = true;
            } else {
                $cs_layout = "";
                $custom_height = 360;
            }
            $post_pagination_show = 'on';
            $post_tags_show = '';
            $cs_related_post = '';
            $post_social_sharing = '';
            $post_social_sharing = '';
            $cs_post_author_info_show = '';
            $postname = 'player';
            $cs_post_social_sharing = '';
            $cs_page_sidebar_styling = '';
            $cs_page_sidebar_styling_color = '';
        }
        if ($cs_player <> "") {
            $cs_xmlObject = new SimpleXMLElement($cs_player);
            $cs_player_position_no = $cs_xmlObject->cs_player_position_no;
            $cs_player_position_name = $cs_xmlObject->cs_player_position_name;
            $cs_player_facebook_link = $cs_xmlObject->cs_player_facebook_link;
            $cs_player_twitter_link = $cs_xmlObject->cs_player_twitter_link;
            $cs_player_google_link = $cs_xmlObject->cs_player_google_link;
            $cs_player_pintrest_link = $cs_xmlObject->cs_player_pintrest_link;
            $cs_player_mail_link = $cs_xmlObject->cs_player_mail_link;
            $postname = 'player';
        } else {
            $cs_player_position_no = '';
            $cs_player_position_name = '';
            $cs_player_facebook_link = '';
            $cs_player_twitter_link = '';
            $cs_player_google_link = '';
            $cs_player_pintrest_link = '';
            $cs_player_mail_link = '';
            $postname = 'player';

            if (!isset($cs_xmlObject))
                $cs_xmlObject = new stdClass();
        }

        $width = 374;
        $height = 547;
        $image_id = get_post_thumbnail_id($post->ID);
        $image_url = cs_attachment_image_src($image_id, $width, $height);

        if ($image_url == '') {
            $image_url = get_template_directory_uri() . '/assets/images/no-image4x3.jpg';
        }
        ?>
        <section class="page-section team-detail" style="padding:0;"> 
            <!-- Container -->
            <div class="container"> 
                <!-- Row -->
                <div class="row">     
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

                    <div class="<?php echo esc_attr($cs_layout); ?>"> 

                        <div class="col-md-12">
                            <figure class="detailpost">
                                <?php echo '<img src="' . $image_url . '" alt="' . get_the_title() . '" >'; ?> 
                                <figcaption>
                                    <div class="contant-info cs-team">
                                        <header>
                                            <h1 style="font-size:36px !important; line-height:36px !important; text-transform: uppercase !important; color:#fff !important;"><?php echo the_title(); ?></h1>
                                            <?php
                                            if ($cs_player_position_no <> '') {
                                                ?>
                                                <span class="player-no"><?php echo cs_allow_special_char($cs_player_position_no); ?></span>
                                                <?php
                                            }
                                            ?>
                                        </header>
                                        <div class="cs-seprator">
                                            <div class="devider1"></div>
                                        </div>
                                        <div class="player-info">

                                            <?php
                                            if (isset($cs_xmlObject->dynamic_fieldss) && is_object($cs_xmlObject) && count($cs_xmlObject->dynamic_fieldss) > 0) {
                                                echo '<ul class="left-side">';
                                                foreach ($cs_xmlObject->dynamic_fieldss as $dynamic_field) {
                                                    $dynamic_field_title = $dynamic_field->dynamic_fields_title;

                                                    echo '<li>' . $dynamic_field_title . '</li>';
                                                }
                                                echo '</ul>';

                                                echo '<ul class="right-side">';
                                                foreach ($cs_xmlObject->dynamic_fieldss as $dynamic_field) {
                                                    $dynamic_field_description = $dynamic_field->dynamic_fields_description;

                                                    echo '<li>' . $dynamic_field_description . '</li>';
                                                }
                                                echo '</ul>';
                                            }
                                            ?>

                                        </div>
                                        <div class="socialmedia">
                                            <ul>
                                                <?php
                                                if ($cs_player_facebook_link <> '') {
                                                    ?>
                                                    <li><a href="<?php echo esc_url($cs_player_facebook_link); ?>" data-original-title="Facebook"><i class="icon-facebook7"></i></a></li>
                                                    <?php
                                                }
                                                if ($cs_player_twitter_link <> '') {
                                                    ?>
                                                    <li><a href="<?php echo esc_url($cs_player_twitter_link); ?>" data-original-title="twitter"><i class="icon-twitter2"></i></a></li>
                                                    <?php
                                                }
                                                if ($cs_player_google_link <> '') {
                                                    ?>
                                                    <li><a href="<?php echo esc_url($cs_player_google_link); ?>" data-original-title="google-plus"><i class="icon-google-plus"></i></a></li>
                                                    <?php
                                                }
                                                if ($cs_player_pintrest_link <> '') {
                                                    ?>
                                                    <li><a href="<?php echo esc_url($cs_player_pintrest_link); ?>" data-original-title="pinterest"><i class="icon-pinterest4"></i></a></li>
                                                    <?php
                                                }
                                                if ($cs_player_mail_link <> '') {
                                                    ?>
                                                    <li><a data-original-title="envelope" href="<?php echo esc_url($cs_player_mail_link); ?>"><i class="icon-envelope4"></i></a></li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>

                        <div class="col-md-12">
                            <div class="rich_editor_text blog-editor">
                                <?php
                                the_content();
                                wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'goalklub') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>'));
                                ?>
                            </div>
                        </div>

                        <?php
                        if (isset($cs_post_author_info_show) && $cs_post_author_info_show == 'on') {
                            ?>



                            <div class="col-md-12">
                                <div class="cs-section-title">
                                    <h2><?php if (empty($cs_xmlObject->post_author_info_text))
                    _e('About', 'goalklub');
                else
                    echo cs_allow_special_char($cs_xmlObject->post_author_info_text);
                            ?></h2>
                                </div>
            <?php cs_author_description('show'); ?>    
                            </div>
                            <!-- Col Author End --> 

                        <?php
                        }



                        if (isset($post_tags_show) && $post_tags_show == 'on') {
                            $categories_list = get_the_term_list(get_the_id(), 'player-tag', '<li>', '</li><li>', '</li>');
                            if ($categories_list) {
                                ?>
                                <div class="col-md-12">
                                    <div class="cs-tags">
                                        <div class="cs-section-title"
                <?php if (empty($cs_xmlObject->post_tags_show_text))
                    $post_tags_show_text = __('Tags', 'goalklub');
                else
                    $post_tags_show_text = $cs_xmlObject->post_tags_show_text;
                ?>
                                             <div class="cs-title"><a><h2><?php echo cs_allow_special_char($post_tags_show_text); ?></h2></a></div>
                                            <ul>
                                <?php printf(__('%1$s', 'goalklub'), $categories_list); ?>
                                            </ul>
                                        </div></div>
                               
                                <?php
                            }
                        }
                        ?>

                        <?php if ($cs_post_social_sharing == "on") { ?>
                            <div class="col-md-12">
                                <div class="detail-post">
            <?php cs_social_share(false, true, $post_social_sharing_text); ?>
                                </div>
                            </div>
                        <?php } ?>




        <?php
        if (isset($post_pagination_show) && $post_pagination_show == 'on') {
            $post_pagination_text = $cs_xmlObject->post_pagination_show_title;
            echo '<div class="col-md-12">';
            ?>
                            <div class="cs-section-title">
                                <h2><?php echo esc_attr($post_pagination_text); ?></h2>
                            </div><?php
                            cs_next_prev_custom_links('player');
                            echo '</div>';
                        }
                        if ($cs_related_post == 'on') {
                            if (empty($cs_xmlObject->cs_related_post_title))
                                $cs_related_post_title = __('Related Posts', 'goalklub');
                            else
                                $cs_related_post_title = $cs_xmlObject->cs_related_post_title;
                            $owlcount = rand(40, 9999999);
                            cs_owl_carousel();
                            ?>
                            <div class="col-md-12 post-recent">
                                <div class="cs-section-title">
                                    <h2><?php echo esc_attr($cs_related_post_title); ?></h2>
                                </div>
                                <script type="text/javascript">
                                    jQuery(document).ready(function ($) {
                                        jQuery('.cs-theme-carousel-<?php echo cs_allow_special_char($owlcount); ?>').owlCarousel({
                                            nav: true,
                                            margin: 30,
                                            navText: [
                                                "<i class=' icon-angle-left'></i>",
                                                "<i class='icon-angle-right'></i>"
                                            ],
                                            responsive: {
                                                0: {
                                                    items: 1 // In this configuration 1 is enabled from 0px up to 479px screen size 
                                                },
                                                480: {
                                                    items: 2, // from 480 to 677 
                                                    nav: false // from 480 to max 
                                                },
                                                678: {
                                                    items: 3, // from this breakpoint 678 to 959
                                                    center: false // only within 678 and next - 959
                                                },
                                                960: {
                                                    items: 3, // from this breakpoint 960 to 1199
                                                    center: false,
                                                    loop: false

                                                },
                                                1200: {
                                                    items: 3
                                                }
                                            }
                                        });
                                    });
                                </script>
                                <ul class="row owl-carousel cs-theme-carousel cs-theme-carousel-<?php echo intval($owlcount); ?> cs-prv-next">
                                    <?php
                                    $custom_taxterms = '';
                                    $custom_taxterms = wp_get_object_terms($post->ID, array($cs_player_team, $cs_player_department), array('fields' => 'ids'));
                                    $args = array(
                                        'post_type' => $postname,
                                        'post_status' => 'publish',
                                        'posts_per_page' => -1,
                                        'orderby' => 'DESC',
                                        'tax_query' => array(
                                            'relation' => 'OR',
                                            array(
                                                'taxonomy' => $cs_player_department,
                                                'field' => 'id',
                                                'terms' => $custom_taxterms
                                            ),
                                            array(
                                                'taxonomy' => $cs_player_team,
                                                'field' => 'id',
                                                'terms' => $custom_taxterms
                                            )
                                        ),
                                        'post__not_in' => array($post->ID),
                                    );
                                    $custom_query = new WP_Query($args);
                                    ?>

                                    <?php
                                    while ($custom_query->have_posts()) : $custom_query->the_post();

                                        $cs_player_recomended = '';
                                        $cs_player = get_post_meta($post->ID, "player", true);
                                        if ($cs_player <> "") {
                                            $cs_xmlObject = new SimpleXMLElement($cs_player);
                                            $cs_player_position_no = $cs_xmlObject->cs_player_position_no;
                                            $cs_player_position_name = $cs_xmlObject->cs_player_position_name;
                                        } else {
                                            $cs_player_position_no = '';
                                            $cs_player_position_name = '';

                                            if (!isset($cs_xmlObject))
                                                $cs_xmlObject = new stdClass();
                                        }

                                        $image_id = get_post_thumbnail_id($post->ID);
                                        $image_url = cs_attachment_image_src($image_id, $width, $height);

                                        if ($image_url == '') {
                                            $img_class = 'no-image';
                                            $image_url = get_template_directory_uri() . '/assets/images/no-image4x3.jpg';
                                        } else {
                                            $img_class = '';
                                        }
                                        ?>
                                        <li class="item col-md-4">
                                            <article class="cs-team">
                                                <figure><a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($image_url); ?>"></a></figure>
                                                <div class="text">
                                                    <header>
                                                        <?php
                                                        if ($cs_player_position_no <> '') {
                                                            ?>
                                                            <span class="player-no"><?php echo cs_allow_special_char($cs_player_position_no); ?></span>
                                                                    <?php
                                                                }
                                                                ?>
                                                        <h4><a href="<?php the_permalink(); ?>"><?php
                                                        echo substr(get_the_title(), 0, 30);
                                                        if (strlen(get_the_title()) > 30) {
                                                            echo '...';
                                                        }
                                                        ?></a></h4>
                <?php
                if ($cs_player_position_name <> '') {
                    ?>
                                                            <h6><?php echo cs_allow_special_char($cs_player_position_name); ?></h6>
                                            <?php
                                        }
                                        ?>
                                                    </header>
                                                </div>
                                            </article>
                                        </li>
                            <?php endwhile;
                            wp_reset_postdata();
                            ?>
                                </ul>
                            </div>
                        <?php } ?>
                        <!-- Col Recent Posts End --> 

                        <!-- Col Comments Start -->
                       
                        <!-- Col Comments End --> 

                        <!-- Right Sidebar End -->
                    <?php
                endwhile;
                wp_reset_query();
            endif;
            ?>
                                </div>
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
</section>

<!-- Footer -->
<?php
get_footer();
