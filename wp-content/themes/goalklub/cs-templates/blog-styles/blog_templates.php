<?php
/**
 * File Type: Blog Templates Class
 */
if (!class_exists('CS_BlogTemplates')) {

    class CS_BlogTemplates {

        function __construct() {
            // Constructor Code here..
        }

        //======================================================================
        // Blog Medium View
        //======================================================================
        public function cs_medium_view($description, $excerpt, $category) {
            $post_thumb_view = '';
            global $post;
            $width = '360';
            $height = '360';
            $title_limit = 1000;
            $noImage = '';
            $thumbnail = cs_get_post_img_src($post->ID, $width, $height);

            $post_xml = get_post_meta(get_the_id(), "post", true);
            if ($post_xml <> "") {
                $cs_xmlObject = new SimpleXMLElement($post_xml);
                $post_thumb_view = $cs_xmlObject->post_thumb_view;
            }

            if ($post_thumb_view == 'Single Image' && $thumbnail == '') {
                $noImage = 'no-image';
            }
            ?>

            <div class="col-md-12">
                <!-- Blog Lrg Start -->
                <div class="cs-blog blog-medium <?php echo esc_attr($noImage); ?>">

                    <?php
                    if ($post_thumb_view == 'Single Image') {
                        if (isset($thumbnail) && $thumbnail != '') {
                            ?>
                            <div class="cs-media">
                                <figure>
                                    <a href="<?php echo the_permalink(); ?>"><img alt="blog-grid" src="<?php echo esc_url($thumbnail); ?>"></a>
                                </figure>
                            </div>
                            <?php
                        }
                    } else if ($post_thumb_view == 'Slider') {
                        echo '<div class="cs-media"><figure>';
                        cs_post_flex_slider($width, $height, get_the_id(), 'post-list');
                        echo '</figure></div>';
                    }
                    ?>
                    <section>
                        <div class="title">
                            <ul class="post-option">
                                <li><?php echo cs_featured(); ?><time datetime="<?php echo date_i18n('Y-m-d', strtotime(get_the_date())); ?>"><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?></time></li>
                            </ul>
                            <h2><a href="<?php echo the_permalink(); ?>"><?php
                                    echo substr(get_the_title(), 0, $title_limit);
                                    if (strlen(get_the_title()) > $title_limit) {
                                        echo '...';
                                    }
                                    ?></a></h2>
                        </div>
                        <div class="blog-text">	                              
                            <?php if ($description == 'yes') { ?><p> <?php echo cs_get_the_excerpt($excerpt, 'ture', ''); ?></p><?php } ?> 
                            <div class="cs-seprator">
                                <div class="devider1"></div>
                            </div>
                            <ul class="post-option">
                                <li><?php
                                    $cats = '';
                                    $cats = $this->cs_get_categories($category);
                                    echo cs_allow_special_char($cats);
                                    ?></li>
                            </ul>
                            <a class="btnshare addthis_button_compact" href="#"><i class="icon-export"></i></a>
                        </div>	
                    </section>
                </div>
                <!-- Blog Lrg End -->
            </div>
        
            <?php
        }

        //======================================================================
        // Blog Large View
        //======================================================================
        public function cs_large_view($description, $excerpt, $category) {
            global $post;
            $post_thumb_view = '';
            $width = '816';
            $height = '459';
            $title_limit = 1000;
            $thumbnail = cs_get_post_img_src($post->ID, $width, $height);

            $post_xml = get_post_meta(get_the_id(), "post", true);
            if ($post_xml <> "") {
                $cs_xmlObject = new SimpleXMLElement($post_xml);
                $post_thumb_view = $cs_xmlObject->post_thumb_view;
            }
            ?>

            <div class="col-md-12">
                <!-- Blog Lrg Start -->
                <div class="cs-blog blog-lrg">
                    <?php
                    if ($post_thumb_view == 'Single Image') {
                        if (isset($thumbnail) && $thumbnail != '') {
                            ?>
                            <div class="cs-media">
                                <figure>
                                    <a href="<?php echo the_permalink(); ?>"><img alt="blog-grid" src="<?php echo esc_url($thumbnail); ?>"></a>
                                </figure>
                            </div>
                            <?php
                        }
                    } else if ($post_thumb_view == 'Slider') {
                        echo '<div class="cs-media"><figure>';
                        cs_post_flex_slider($width, $height, get_the_id(), 'post-list');
                        echo '</figure></div>';
                    }
                    ?>
                    <section>
                        <div class="title">
                            <h2><a href="<?php echo the_permalink(); ?>"><?php
                                    echo substr(get_the_title(), 0, $title_limit);
                                    if (strlen(get_the_title()) > $title_limit) {
                                        echo '...';
                                    }
                                    ?></a></h2>
                            <ul class="post-option">

                                <li><?php echo cs_featured(); ?><time datetime="<?php echo date_i18n('Y-m-d', strtotime(get_the_date())); ?>"><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?></time></li>
                            </ul>
                        </div>
                        <div class="blog-text">	                              
                            <?php if ($description == 'yes') { ?><p> <?php echo cs_get_the_excerpt($excerpt, 'ture', ''); ?></p><?php } ?> 
                            <div class="cs-seprator">
                                <div class="devider1"></div>
                            </div>
                            <ul class="post-option">
                                <li> <i class="icon-user9"></i><?php _e('By', 'goalklub'); ?><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author(); ?></a></li>
                                <li> <i class=" icon-list7"></i>
                                    <?php
                                    $cats = $this->cs_get_categories($category);
                                    echo cs_allow_special_char($cats);
                                    ?>
                                </li>
                            </ul>
                            <a class="btnshare addthis_button_compact" href="#"><i class="icon-export"></i></a>
                        </div>	
                    </section>
                </div>
                <!-- Blog Lrg End -->
            </div>

            <?php
        }

        //======================================================================
        // Blog Grid View
        //======================================================================
        public function cs_grid_view($description, $excerpt, $category, $layout) {
            global $post;
            $width = '250';
            $height = '188';
            $title_limit = 1000;
            $post_thumb_view = '';
            $thumbnail = cs_get_post_img_src($post->ID, $width, $height);

            $post_xml = get_post_meta(get_the_id(), "post", true);
            if ($post_xml <> "") {
                $cs_xmlObject = new SimpleXMLElement($post_xml);
                $post_thumb_view = $cs_xmlObject->post_thumb_view;
            }
            $layout = isset($layout) ? $layout : 'col-md-4';
            ?>
            <div class="<?php echo esc_attr($layout); ?>">
                <!-- Blog Lrg Start -->
                <div class="cs-blog cs-blog-grid">
                    <div class="cs-media">
                        <?php
                        if ($post_thumb_view == 'Single Image') {
                            if (isset($thumbnail) && $thumbnail != '') {
                                ?>
                                <figure>
                                    <a href="<?php the_permalink(); ?>"><img alt="blog-grid" src="<?php echo esc_url($thumbnail); ?>"></a>
                                </figure>
                                <?php
                            } else {
                                echo '<figure>
							<a href="' . get_permalink() . '"><img alt="blog-grid" src="' . get_template_directory_uri() . '/assets/images/no-image4x3.jpg"></a>
						  </figure>';
                            }
                        } else if ($post_thumb_view == 'Slider') {
                            echo '<figure>';
                            cs_post_flex_slider($width, $height, get_the_id(), 'post-list');
                            echo '</figure>';
                        }
                        ?>
                    </div>
                    <section>
                        <div class="title">
                            <ul class="post-option">

                                <li><?php echo cs_featured(); ?><time datetime="<?php echo date_i18n('Y-m-d', strtotime(get_the_date())); ?>"><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?></time></li>
                            </ul>
                            <h4><a href="<?php echo the_permalink(); ?>"><?php
                                    echo substr(get_the_title(), 0, $title_limit);
                                    if (strlen(get_the_title()) > $title_limit) {
                                        echo '...';
                                    }
                                    ?></a></h4>
                        </div>
                        <div class="blog-text">	                              
            <?php if ($description == 'yes') { ?><p> <?php echo cs_get_the_excerpt($excerpt, 'ture', ''); ?></p><?php } ?> 
                            <ul class="post-option">
                                <li><?php
                                    $cats = '';
                                    $cats = $this->cs_get_categories($category);
                                    echo cs_allow_special_char($cats);
                                    ?></li>
                            </ul>
                        </div>	
                    </section>
                    <div class="cs-seprator">
                        <div class="devider1"></div>
                    </div>
                </div>
                <!-- Blog Lrg End -->
            </div>     
            <?php
        }

        //======================================================================
        // Blog Grid View
        //======================================================================
        public function cs_home_list_view($description, $excerpt, $category, $layout) {
            global $post;
            $width = '250';
            $height = '188';
            $title_limit = 50;
            $post_thumb_view = '';
            $thumbnail = cs_get_post_img_src($post->ID, $width, $height);

            $post_xml = get_post_meta(get_the_id(), "post", true);
            if ($post_xml <> "") {
                $cs_xmlObject = new SimpleXMLElement($post_xml);
                $post_thumb_view = $cs_xmlObject->post_thumb_view;
            }
            ?>
            <li><i class="fa icon-align-left"></i><a href="<?php echo the_permalink(); ?>"><?php
                    echo substr(get_the_title(), 0, $title_limit);
                    if (strlen(get_the_title()) > $title_limit) {
                        echo '...';
                    }
                    ?>.</a>
                <div class="time">
            <?php echo esc_attr(date_i18n('j', strtotime(get_the_date()))); ?><br><span><?php echo esc_attr(date_i18n('M', strtotime(get_the_date()))); ?></span>
                </div>
            </li>

            <?php
        }

        //======================================================================
        // Blog Grid View
        //======================================================================
        public function cs_home_grid_view($description, $excerpt, $category, $layout) {
            global $post;
            $width = '365';
            $height = '201';
            $title_limit = 32;
            $post_thumb_view = '';
            $thumbnail = cs_get_post_img_src($post->ID, $width, $height);

            $post_xml = get_post_meta(get_the_id(), "post", true);
            if ($post_xml <> "") {
                $cs_xmlObject = new SimpleXMLElement($post_xml);
                $post_thumb_view = $cs_xmlObject->post_thumb_view;
            }
            $layout = 'col-md-4';
            ?>
            <div class="<?php echo esc_attr($layout); ?>">
                <article class="cs-blog blog-grid">
                    <?php
                    if ($post_thumb_view == 'Single Image') {
                        if (isset($thumbnail) && $thumbnail != '') {
                            ?>
                            <figure>
                                <a href="<?php the_permalink(); ?>"><img alt="blog-grid" src="<?php echo esc_url($thumbnail); ?>"></a>
                            </figure>
                            <?php
                        } else {
                            echo '<figure>
							<a href="' . get_permalink() . '"><img alt="blog-grid" src="' . get_template_directory_uri() . '/assets/images/no-image4x3.jpg"></a>
						  </figure>';
                        }
                    } else if ($post_thumb_view == 'Slider') {
                        echo '<figure>';
                        cs_post_flex_slider($width, $height, get_the_id(), 'post-list');
                        echo '</figure>';
                    }
                    ?>
                    <div class="text">
                        <h2>
                            <a href="<?php echo the_permalink(); ?>"><?php
                                echo substr(get_the_title(), 0, $title_limit);
                                if (strlen(get_the_title()) > $title_limit) {
                                    echo '...';
                                }
                                ?><i class="icon-arrow-right9"></i></a>
                        </h2>
                    </div>
                </article>
            </div>

            <?php
        }

        //======================================================================
        // Blog Categories
        //======================================================================
        public function cs_get_categories($cs_blog_cat) {

            global $post, $wpdb;
            if (isset($cs_blog_cat) && $cs_blog_cat != '' && $cs_blog_cat != '0') {
                $row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $cs_blog_cat));
                echo '<a href="' . site_url() . '?cat=' . $row_cat->term_id . '">' . $row_cat->name . '</a>';
            } else {
                /* Get All Categories */
                $before_cat = "";
                $categories_list = get_the_term_list(get_the_id(), 'category', $before_cat, ', ', '');
                if ($categories_list) {
                    printf(__('%1$s', 'goalklub'), $categories_list);
                }
                // End if Categories 
            }
        }

    }

}