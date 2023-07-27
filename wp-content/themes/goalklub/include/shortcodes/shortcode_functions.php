<?php
//=====================================================================
// Adding mce custom button for short codes start
//=====================================================================
class ShortcodesEditorSelector {
    var $buttonName = 'shortcode';
    function addSelector() {
        add_filter('mce_external_plugins', array($this, 'registerTmcePlugin'));
        add_filter('mce_buttons', array($this, 'registerButton'));
    }
    function registerButton($buttons) {
        array_push($buttons, "separator", $this->buttonName);
        return $buttons;
    }
    function registerTmcePlugin($plugin_array) {
        return $plugin_array;
    }
}

if (!isset($shortcodesES)) {
   $shortcodesES = new ShortcodesEditorSelector();
    add_action('admin_head', array($shortcodesES, 'addSelector'));
}

//=====================================================================
//Bootstrap Coloumn Class
//=====================================================================
if ( ! function_exists( 'cs_custom_column_class' ) ) {
	function cs_custom_column_class($column_size){
		$coloumn_class = 'col-md-12';
		if(isset($column_size) && $column_size <> ''){
			list($top, $bottom) = explode('/', $column_size);
				$width = $top / $bottom * 100;
				$width =(int)$width;
				$coloumn_class = '';
				if(round($width) == '25' || round($width) < 25){
					$coloumn_class = 'col-md-3';			
				} elseif(round($width) == '33' || (round($width) < 33 && round($width) > 25)){
					$coloumn_class = 'col-md-4';	
				} elseif(round($width) == '50' || (round($width) < 50 && round($width) > 33)){
					$coloumn_class = 'col-md-6';	
				} elseif(round($width) == '67' || (round($width) < 67 && round($width) > 50)){
					$coloumn_class = 'col-md-8';	
				} elseif(round($width) == '75' || (round($width) < 75 && round($width) > 67)){
					$coloumn_class = 'col-md-9';	
				} else {
					$coloumn_class = 'col-md-12';
				}
		}
		return $coloumn_class;
	}
}

//=====================================================================
// Column Width
//=====================================================================
if ( ! function_exists( 'cs_custom_column_type' ) ) {
	function cs_custom_column_type($width){
		$coloumn_class = '1/1';
		if(isset($width) && $width <> ''){
			$width = (int)$width;
				if(round($width) == '25' || round($width) < 25){
					$coloumn_class = '1/4';			
				} elseif(round($width) == '33' || (round($width) < 33 && round($width) > 25)){
					$coloumn_class = '1/3';	
				} elseif(round($width) == '50' || (round($width) < 50 && round($width) > 33)){
					$coloumn_class = '1/2';	
				} elseif(round($width) == '67' || (round($width) < 67 && round($width) > 50)){
					$coloumn_class = '2/3';	
				} elseif(round($width) == '75' || (round($width) < 75 && round($width) > 67)){
					$coloumn_class = '3/4';	
				} else {
					$coloumn_class = '1/1';
				}
		}
		return  $coloumn_class;
	}
}


//=====================================================================
// Portfolio Listing Shortcode
//=====================================================================
if (!function_exists('cs_portfolio_listing_shortcode')) {
	function cs_portfolio_listing_shortcode( $atts ) {
		$defaults = array('cs_portfolio_title'=>'', 'cs_portfolio_category'=>'0', 'cs_portfolio_view'=>'portfoliolisting', 'cs_portfolio_featured_category'=>'0', 'cs_portfolio_thumbnail'=>'Yes', 'cs_portfolio_time'=>'Yes', 'cs_portfolio_view_all_link'=>'#', 'cs_portfolio_excerpt'=>'255', 'cs_portfolio_filterables'=>'No', 'cs_portfolio_pagination'=>'Show Pagination','orderby'=>'ID','order'=>'DESC','cs_portfolio_per_page'=>'10','class'=>'cs-portfoliolist','order'=>'DESC','orderby'=>'ID');
		extract( shortcode_atts( $defaults, $atts ) );

		if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;
		ob_start();
		if(isset($cs_portfolio_title) && $cs_portfolio_title <> ''){
			echo esc_attr('<header class="cs-heading-title">
							<h2 class="cs-section-title">'.$cs_portfolio_title.'</h2>
						  </header>');
		}
		$cs_portfolio_pagination = $atts['cs_dcpt_post_pagination'];
		if(isset($atts['cs_dcpt_post_per_page'])){
			$cs_portfolio_per_page = $atts['cs_dcpt_post_per_page'];
		}
		else{
			$cs_portfolio_per_page = '-1';
		}
		
		$portfolio_args_all = array('posts_per_page' => "-1", 'post_type' => 'portfolio', 'post_status' => 'publish');
		if(isset($atts['cs_dcpt_post_category']) && $atts['cs_dcpt_post_category'] <> '' &&  $atts['cs_dcpt_post_category'] <> '0'){
			$cs_portfolio_category = $atts['cs_dcpt_post_category'];
			$portfolio_category_array = array('portfolio-categories' => "$cs_portfolio_category");
			$portfolio_args_all = array_merge($portfolio_args_all, $portfolio_category_array);
		}
		$portfolio_query_all = new WP_Query($portfolio_args_all);
		$portfolio_post_count = $portfolio_query_all->post_count;
		$args = array(
			'post_type' => 'portfolio',
			'paged'  => $_GET['page_id_all'],
			'posts_per_page' => (int)"$cs_portfolio_per_page",
			'order' => "$order",
			'orderby' => "$orderby",
		);
		if(isset($cs_portfolio_category) && $cs_portfolio_category <> '' &&  $cs_portfolio_category <> '0'){
			$portfolio_category_array = array('portfolio-categories' => "$cs_portfolio_category");
			$args = array_merge($args, $portfolio_category_array);
		}
		
		//var_dump($atts);
		
		$filterable = $atts['cs_dcpt_post_filterable'];
		$portfolio_query = new WP_Query( $args );
		if ( $portfolio_query->have_posts() ) { 
			
			cs_filterable();
		?>
        	
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					portfolio_mix();
				});
			</script>
            <?php
			if(isset($atts['cs_dcpt_section_title']) and $atts['cs_dcpt_section_title'] <> ''){
			?>
            <div class="cs-section-title">
                <h2><?php echo force_back($atts['cs_dcpt_section_title']); ?></h2>
            </div>
            <?php
			}
			?>
			<div class="portfoliopage <?php echo esc_html($class.' '.$cs_portfolio_view);?>">
            	<?php
				if( isset($cs_portfolio_category) && ($cs_portfolio_category <> "" && $cs_portfolio_category <> "0")){	
					$categories = get_categories( array('child_of' => "$cs_portfolio_category", 'taxonomy' => 'portfolio-categories') );
				
				}else{
					$categories = get_categories( array('taxonomy' => 'portfolio-categories') );
				}
				
				if(isset($filterable) and $filterable == 'Yes'){
				?>
            	<div class="filter_nav">
                    <ul class="splitter">
                      <li class="filter active" data-filter="all"><a href="#"><?php _e('View All', 'goalklub'); ?></a></li>
                      <?php
					  foreach ($categories as $category) {
					  ?>
                      <li class="filter" data-filter="<?php echo intval($category->term_id); ?>"><a href="#"><?php echo esc_attr($category->cat_name); ?></a></li>
                      <?php
					  }
					  ?>
                    </ul>
                </div>
                <?php
				}
				?>
            	<ul id="list" class="image-grid">
				<?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
						
						global $post;
						$image_id = get_post_thumbnail_id($post->ID);
						if($image_id <> ''){
							$image_url = cs_attachment_image_src(get_post_thumbnail_id($post->ID), 370, 278);
							$full_image_url = cs_attachment_image_src(get_post_thumbnail_id($post->ID), 0, 0);
						}else{
							$image_url = get_template_directory_uri().'/assets/images/no-image4x3.jpg';
							$full_image_url = get_template_directory_uri().'/assets/images/no-image4x3.jpg';
						}
						
						$post_cats = wp_get_object_terms( $post->ID, 'portfolio-categories' );
						$p_cats = '';
						foreach($post_cats as $cats){
							$p_cats = $cats->term_id.' ';
						}
						?>
                        <li data-id="id-<?php echo intval($post->ID); ?>" class="mix <?php echo esc_html($p_cats); ?>">
                            <!-- Article Start -->
                            <article>
                            	<?php if($image_url <> ''){ ?>
                                <figure><a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($image_url); ?>" alt="No image"></a>
                                <?php } ?>
                                    <figcaption>
                                        <div class="figinn lightbox">
                                            <a data-rel="prettyPhoto" href="<?php echo esc_url($full_image_url);?>" class="icon-search-plus"></a>
                                            <a href="<?php the_permalink(); ?>" class="icon-link"></a>
                                        </div>
                                    </figcaption>
                                </figure>
                                <?php
								if(isset($atts['cs_dcpt_post_time']) and $atts['cs_dcpt_post_time'] == 'Yes'){
								?>
                                <div class="text">
                                    <h2><a href="<?php the_permalink(); ?>"><?php echo substr(get_the_title(), 0, 18); echo strlen(get_the_title()) > 18 ? '...' : ''; ?></a></h2>
                                    <?php echo get_the_term_list ( $post->ID, 'portfolio-categories', '<span><i class="icon-plus8"></i>', ', ', '</span>' ); ?>
                                    
                                </div>
                                <?php
								}
								?>
                            </article>
                            <!-- Article End -->
                        </li>
				 <?php endwhile;
				 wp_reset_query();
				 if(isset($filterable) and $filterable <> 'Yes'){
					 $qrystr = '';
					 if ( $cs_portfolio_pagination == "Show Pagination" and $portfolio_post_count > $cs_portfolio_per_page and $cs_portfolio_per_page > 0 ) {
						if ( isset($_GET['page_id']) ) $qrystr = "&page_id=".$_GET['page_id'];
							echo cs_pagination($portfolio_post_count, $cs_portfolio_per_page,$qrystr);
					 }
				 }
				 wp_reset_postdata(); ?>
			</ul>
        </div>
		<?php $portfolios_data = ob_get_clean();
		return $portfolios_data;
		}
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add( 'cs_portfolio', 'cs_portfolio_listing_shortcode' );
}
}

//=====================================================================
//Progress bars Shortcode
//=====================================================================
if (!function_exists('cs_bar_shortcode')) {
	function cs_chart_shortcode($atts, $content = "") {
		$defaults = array('class'=>'cs-chart','percent'=>'50','icon'=>'','title'=>'Title','text'=>'Text Description', 'background_color'=>'#ccc','animate_style'=>'slide');
		extract( shortcode_atts( $defaults, $atts ) );
		$html = '';
		$html .= '<div class="tiny-green" data-loadbar="'.$percent.'" data-loadbar-text="'.$text.'"><p>'.$title.'</p><div '.$style.'></div><span class="infotxt"></span></div>';
		return '<div class="skills"><div class="cs-chart '.$class.' progress_bar">' . $html . '</div><div class="clear"></div></div>';
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('bar', 'cs_chart_shortcode');
}
}
//Skills Shortcode end

//=====================================================================
// Adding Article Box start
//=====================================================================
if (!function_exists('cs_article_box_shortcode')) {
	function cs_article_box_shortcode($atts, $content = "") {
		$defaults = array('class'=>'cs-article-box','image_url'=>'','slogan'=>'','title'=>'','link'=>'','target'=>'_self','animate_style'=>'slide');
		extract( shortcode_atts( $defaults, $atts ) );
		$figure = '';
		$link_tag_start = '';
		$link_tag_end = '';
		if(isset($link) && $link <> ''){
			$link_tag_start = '<a href="'.$link.'" target="'.$target.'" >';
			$link_tag_end = '</a>';
		}
		$figure .= '<figure>';
			if(isset($image_url) && $image_url <> ''){
				$figure .= $link_tag_start.'<img src="'.$image_url.'" alt="'.$title.'"  style="width: '.$width.'px; height: '.$height.'px;" />'.$link_tag_end;
			}
			$figure .= '<figcaption>';
				$figure .= '<h2>'.$link_tag_start.$title.$link_tag_end.'</h2>';
				$figure .= '<h3>'.$slogan.'</h3>';
			$figure .= '</figcaption>';
		$figure .= '</figure>';
		$figure .= '<p>'.do_shortcode($content).'</p>';
		return "<div class='animate-".$animate_style.' '.$class."'>" . $figure . "</div>";
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('article_box', 'cs_article_box_shortcode');
}
}

//=====================================================================
// Adding Brands start
//=====================================================================
if (!function_exists('cs_brands_shortcode')) {
	function cs_brands_shortcode($atts, $content = "") {
		$defaults = array('onclick'=>'open_url','slider_type'=>'horizontal','slider_speed'=>'500','slider_autoplay'=>'true','slider_loop'=>'false','pagination'=>'','buttons_hide'=>'no','partial_view'=>'yes','class'=>'cs-brands-shortcode');
		extract( shortcode_atts( $defaults, $atts ) );
		return "<ul class='".$class."'>" . do_shortcode($content) . "</ul>";
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('brands', 'cs_brands_shortcode');
}
}

//=====================================================================
// Adding Brands item
//=====================================================================
if (!function_exists('cs_brand_item_shortcode')) {
	function cs_brand_item_shortcode($atts, $content = "") {
		$defaults = array('title'=>'Title','image_url'=>'', 'width'=>'500','height'=>'300','url'=>'#','caption'=>'','target'=>'_self','animate'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$figure = '';
		$link_tag_start = '';
		$link_tag_end = '';
		if(isset($url) && $url <> ''){
			$link_tag_start = '<a href="'.$url.'" target="'.$target.'" >';
			$link_tag_end = '</a>';
		}
		$figure .= '<figure>';
			if(isset($image_url) && $image_url <> ''){
				$figure .= $link_tag_start.'<img src="'.$image_url.'" alt="'.$title.'"  style="width: '.$width.'px; height: '.$height.'px;" />'.$link_tag_end;
			}
			$figure .= '<figcaption>';
				$figure .= '<h2>'.$link_tag_start.$title.$link_tag_end.'</h2>';
				$figure .= '<p>'.do_shortcode($content).'</p>';
			$figure .= '</figcaption>';
		$figure .= '</figure>';
		return "<li>". $figure . "</li>";
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('brand-item', 'cs_brand_item_shortcode');
}
}


//=====================================================================
// Adding icon start
//=====================================================================
if (!function_exists('cs_icon_shortcode')) {
	function cs_icon_shortcode($atts, $content = "") {
			$defaults = array( 'border' => '','color' => '','bgcolor' => '','type' => '','cs_custom_class'=>'cs-tooltip-shortcode', 'cs_custom_animation'=>'', 'cs_custom_animation_duration'=>'1');
			extract( shortcode_atts( $defaults, $atts ) );
			
			$CustomId	= '';
			if ( isset( $cs_custom_class ) && $cs_custom_class ) {
				$CustomId	= 'id="'.$cs_custom_class.'"';
			}
		
			if ( trim($cs_custom_animation) !='' ) {
				$cs_quote_animation	= 'wow'.' '.$cs_custom_animation;
			} else {
				$cs_custom_animation	= '';
			}
			$icon_border = "";
			if ( $border == "yes" ){ $icon_border = "icon-border";}
		$html = '<i '.$CustomId.' class="'.$cs_custom_class.' '.$cs_custom_animation.' '.$type.' '.$size.' '.$icon_border. ' '. $class.'" style="color:'.$color.'; animation-duration: '.$cs_custom_animation_duration.'s; background-color:'.$bgcolor.'"></i>';
		return $html;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('icon', 'cs_icon_shortcode');
}
}
// adding icon end

//=====================================================================
// Adding code start
//=====================================================================
if (!function_exists('cs_code_shortcode')) {
	function cs_code_shortcode($atts, $content = "") {
		$defaults = array( 'title' => 'Title','content' => '','class'=>'cs-code-shortcode');
		extract( shortcode_atts( $defaults, $atts ) );
		$content = str_replace("<br />", "", $content);
		$title ='<h2 class="section-title">'.$title.'</h2>';
		$html = $title . '<div class="code-element '.$class.'"><pre>' . $content . '</pre></div>';
		return $html . '<div class="clear"></div>';
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('code', 'cs_code_shortcode');
}
}
// adding code end

//=====================================================================
// Listing pages shortcode
//=====================================================================
if (!function_exists('cs_category_render')) {
	function cs_category_render($atts, $content = ""){
		global $post;
		$defaults = array('icon' => '', 'label' => '', 'no_categories'=>'', 'seperator'=>'' );
		ob_start();
		//$cs_categories_name = get_post_meta($cs_dcpt_post_type, 'cs_categories_name', true);
		if(isset($seperator) && $seperator <> ''){
			$seperator = $seperator;
		}
		
		$args=array(
			  'name' => (string)get_post_type($post->ID),
			  'post_type' => 'dcpt',
			  'post_status' => 'publish',
			  'showposts' => 1,
			);
 			$get_posts = get_posts($args);
			if($get_posts){
				$dcpt_id = (int)$get_posts[0]->ID;
				$cs_categories_name = get_post_meta($dcpt_id, 'cs_categories_name', true);
				$before_cat = '';
				if($icon){
					$before_cat .= $icon;
				}
				if($label){
					$before_cat .= ' '.$label;
				}
				
				$categories_listtt = get_the_term_list ( $post->ID, strtolower($cs_categories_name), $before_cat, $seperator, '' );
				if ( $categories_listtt ){
					printf( __( '%1$s', 'goalklub'),$categories_listtt );
				}
			}
		$category_data = ob_get_clean();
		return $category_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_category', 'cs_category_render');
}
}

//=====================================================================
// Listing pages shortcode
//=====================================================================
if (!function_exists('cs_tags_render')) {
	function cs_tags_render($atts, $content = ""){
		global $post,$cs_xmlObject;
		$defaults = array('icon' => '', 'label' => '', 'seperator'=>'' );
		ob_start();
		if(isset($cs_xmlObject->cs_post_tags_show) && $cs_xmlObject->cs_post_tags_show == 'on'){
			if(isset($seperator) && $seperator <> ''){
				$seperator = $seperator;
			}
			$args=array(
				  'name' => (string)get_post_type($post->ID),
				  'post_type' => 'dcpt',
				  'post_status' => 'publish',
				  'showposts' => 1,
				);
				$get_posts = get_posts($args);
				if($get_posts){
					$dcpt_id = (int)$get_posts[0]->ID;
					$cs_tags_name = get_post_meta($dcpt_id, 'cs_tags_name', true);
					$before_cat = '';
					if($icon){
						$before_cat .= $icon;
					}
					if($label){
						$before_cat .= ' '.$label;
					}
					$tags_listtt = get_the_term_list ( $post->ID, strtolower($cs_tags_name), $before_cat, $seperator, '' );
					if ( $tags_listtt ){
						printf( __( '%1$s', 'goalklub'),$tags_listtt );
					}
				}
		}	
		$tags_data = ob_get_clean();
		return $tags_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_tag', 'cs_tags_render');
}
}

//=====================================================================
// get shortcode content
//=====================================================================
if (!function_exists('cs_content_render')) {
	function cs_content_render($atts, $content = ""){
		global $post;
		ob_start();
		 the_content();
		 wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'goalklub' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
		$content_data = ob_get_clean();
		return $content_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_content', 'cs_content_render');
}
}

//=====================================================================
// get post attachement
//=====================================================================
if (!function_exists('cs_post_attachment_render')) {
	function cs_post_attachment_render($atts, $content = ""){
		global $post,$cs_xmlObject;
		ob_start();
		$post_attachment = '';
		$args = array(
		   'post_type' => 'attachment',
		   'numberposts' => -1,
		   'post_status' => null,
		   'post_parent' => $post->ID
		  );
		  $attachments = get_posts( $args );
			if ( $attachments ) {
		 ?>
                <div class="cs-media-attachment mediaelements-post">
                <?php 
                foreach ( $attachments as $attachment ) {
					$attachment_title = apply_filters( 'the_title', $attachment->post_title );
					$type = get_post_mime_type( $attachment->ID );
					if($type=='image/jpeg'){
					  ?>
					<a <?php if ( $attachment_title <> '' ) { echo 'data-title="'.$attachment_title.'"'; }?> href="<?php echo esc_url($attachment->guid); ?>" data-rel="<?php echo "prettyPhoto[gallery1]"?>" class="me-imgbox"><?php echo wp_get_attachment_image( $attachment->ID, array(240,180),true ) ?></a>
					<?php
					
					} elseif($type=='audio/mpeg') {
						?>
						<!-- Button to trigger modal --> 
						<a href="#audioattachment<?php echo intval($attachment->ID);?>" role="button" data-toggle="modal" class="iconbox"><i class="icon-microphone"></i></a> 
						<!-- Modal -->
						<div class="modal fade" id="audioattachment<?php echo intval($attachment->ID);?>" tabindex="-1" role="dialog" aria-hidden="true">
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							  </div>
							  <div class="modal-body">
								<audio style="width:100%;" src="<?php echo esc_url($attachment->guid); ?>" type="audio/mp3" controls="controls"></audio>
							  </div>
							</div>
							<!-- /.modal-content --> 
						  </div>
						</div>
						<?php
					} elseif($type=='video/mp4') {
					 ?>
					<a href="#videoattachment<?php echo intval($attachment->ID);?>" role="button" data-toggle="modal" class="iconbox"><i class="icon-video-camera"></i></a>
					<div class="modal fade" id="videoattachment<?php echo intval($attachment->ID);?>" tabindex="-1" role="dialog" aria-hidden="true">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						  </div>
						  <div class="modal-body">
							<video width="100%" height="360" poster="">
							  <source src="<?php echo esc_url($attachment->guid); ?>" type="video/mp4" title="mp4">
							</video>
						  </div>
						</div>
						<!-- /.modal-content --> 
					  </div>
					</div>
					<?php
					}
                }
                ?>
                </div>
                <?php  }
		$post_attachment_data = ob_get_clean();
		return $post_attachment_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_post_attachment', 'cs_post_attachment_render');
}
}

//=====================================================================
// Author's related posts
//=====================================================================
if (!function_exists('cs_get_related_athor_posts')) {
	function cs_get_related_athor_posts($num_of_post) {
		global $authordata, $post;
		$post_type = get_post_type($post->ID);
		$authors_posts = get_posts( array( 'author' => $authordata->ID, 'post_type' => $post_type, 'post__not_in' => array( $post->ID ), 'posts_per_page' => $num_of_post ) );
		$output = '<ul>';
		foreach ( $authors_posts as $authors_post ) {
			$output .= '<li><a href="' . get_permalink( $authors_post->ID ) . '">' . apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) . '</a></li>';
		}
		$output .= '</ul>';
		return $output;
	}
}

//=====================================================================
// Author's posts
//=====================================================================
if (!function_exists('cs_post_author_render')) {
	function cs_post_author_render($atts, $content = ""){
		global $post,$cs_xmlObject,$authordata;
		$defaults = array('thumbnail' => 'on','thumbnail_size' => '70','biographical' => 'off','social' => 'off','related_post' => 'on','num_of_post' => '4' );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		if (isset($cs_xmlObject->cs_post_author_info_show) && $cs_xmlObject->cs_post_author_info_show == 'on') {
	 	?>
			<!-- About Author -->
			<div class="cs-content-wrap">
                <header class="cs-heading-title">
                  <h2 class=" cs-section-title"><?php _e('About','goalklub');?> <?php _e('Author','goalklub');?></h2>
                </header>
				<div class="about-author">
                    <?php if(isset($thumbnail) && $thumbnail == 'on'){?>
					 <figure><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="float-left"><?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('CS_author_bio_avatar_size', $thumbnail_size)); ?></a></figure>
                     <?php }?>
					 <div class="text">
						<h4><a class="colrhover" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author(); ?></a></h4>
						<span></span>
                        <?php if(isset($thumbnail) && $thumbnail == 'on'){?>
							<p><?php the_author_meta('description'); ?></p>
                        <?php }?>
                        <?php if(isset($social) && $social == 'on'){?>
                            <ul class="socialmedia group">
                                 <?php if(get_the_author_meta('facebook') <> ''){?>
                                <li><a href="http://facebook.com/<?php the_author_meta('facebook'); ?>"><i class="icon-facebook"></i></a></li>
                                <?php } ?>
                                <?php if(get_the_author_meta('twitter') <> ''){?>
                                <li><a href="http://twitter.com/<?php the_author_meta('twitter'); ?>"><i class="icon-twitter"></i></a></li>
                                <?php } ?>
                                <li class="share"><a href="#"><?php _e('View All Posts','goalklub');?></a></li>
                           </ul>
                        <?php }?>
					</div>
				</div>
                <?php if(isset($related_post) && $related_post == 'on'){
						
                		echo cs_get_related_athor_posts($num_of_post);
                 }?>
			</div>    
		   <!-- About Author End -->
		<?php	 
		}
		$coments_data = ob_get_clean();
		return $coments_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_author_description', 'cs_post_author_render');}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_author_detail', 'cs_post_author_render');}
}

//=====================================================================
// Links Render
//=====================================================================
if (!function_exists('cs_edit_link_render')) {
	function cs_edit_link_render($atts, $content = ""){
		global $post;
		ob_start();
		edit_post_link( __( 'Edit','goalklub'), '<li>', '</li>' );
		$edit_post_data = ob_get_clean();
		return $edit_post_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_edit', 'cs_edit_link_render');
}
}

//=====================================================================
// next prev posts links
//=====================================================================
if (!function_exists('cs_next_previous_post_render')) {
	function cs_next_previous_post_render($atts, $content = ""){
		global $post, $cs_xmlObject;
		$defaults = array('post_type' => 'post' );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		if(isset($cs_xmlObject->post_pagination_show) &&  $cs_xmlObject->post_pagination_show == 'on'){cs_next_prev_custom_links();}
		$cs_next_previous_data = ob_get_clean();
		return $cs_next_previous_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_next_previous', 'cs_next_previous_post_render');
}}

//=====================================================================
// post share button
//=====================================================================
if (!function_exists('cs_share_render')) {
	function cs_share_render($atts, $content = ""){
		global $post, $cs_xmlObject;
		$defaults = array('title'=>'Share', 'icon' => 'fa-share-square-o', 'class'=>'btnshare' );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		if ($cs_xmlObject->cs_post_social_sharing == "on"){
			cs_addthis_script_init_method();
			echo '<a class="addthis_button_compact '.$class.'" href="#"><i class="'.$icon.'"></i>'.$title.'</a>';
		}

		$share_data = ob_get_clean();
		return $share_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_share', 'cs_share_render');
}
}

//=====================================================================
// Get related posts
//=====================================================================
if (!function_exists('cs_related_post_render')) {
	function cs_related_post_render($atts, $content = ""){
		global $post, $cs_xmlObject;
		ob_start();
		if (isset($cs_xmlObject->cs_related_post) && $cs_xmlObject->cs_related_post == 'on') {
			$postname = get_post_type($post->ID);
			$cs_category = cs_taxanomy_name($postname,'category');
			$cs_tags = cs_taxanomy_name($postname,'tags');

		?>
      <div class="cs-blog blog-grid">
        <?php if ($cs_xmlObject->var_pb_post_related_title <> '') {
        echo '<header class="cs-heading-title">
          <h2 class="cs-section-title heading-color">'.$cs_xmlObject->var_pb_post_related_title.'</h2>
        </header>';
        }?>
        <div class="cs-related-post">
          <?php 
		   $custom_taxterms='';
		   $custom_taxterms = wp_get_object_terms( $post->ID, array($cs_category,$cs_tags), array('fields' => 'ids') );
			// arguments
			$args = array(
			'post_type' => $postname,
			'post_status' => 'publish',
			'posts_per_page' => 3, // you may edit this number
			'orderby' => 'DESC',
			'tax_query' => array(
				'relation' => 'OR',
				array(
					'taxonomy' => $cs_tags,
					'field' => 'id',
					'terms' => $custom_taxterms
				),
				array(
					'taxonomy' => $cs_category,
					'field' => 'id',
					'terms' => $custom_taxterms
				)
			),
			'post__not_in' => array ($post->ID),
			); 
			//print_r($args);
		$custom_query = new WP_Query($args);
		if($custom_query->have_posts()):
		while ( $custom_query->have_posts() ): $custom_query->the_post(); 
			$image_url = cs_attachment_image_src(get_post_thumbnail_id($post->ID), '280','200');
			$no_image = '';
			if($image_url == ""){
					$no_image = 'no-img';
			}
			 ?>
		<!-- Element Size Start -->
			  <article <?php post_class($no_image); ?>>
				<figure>
				  <?php if($image_url <> ""){?>
				  <a href="<?php the_permalink();?>"><img src="<?php echo esc_url($image_url);?>" alt="No image"></a>
				  <?php }?>
				</figure>
				<!-- Text Section -->
				<div class="text-sec">
				  <h4 class="post-title heading-color"><a href="<?php the_permalink();?>">
					<?php if ( strlen(get_the_title()) > 50){echo substr(get_the_title(),0,50);} else { the_title();} if ( strlen(get_the_title()) > 50) echo  "...";?>
					</a></h4>
			 
				</div>
				<!-- Text Section --> 
			  </article>
          <!-- Element Size End -->
          <?php endwhile; endif; wp_reset_postdata();?>
        </div>
      </div>
      <?php }
		$related_data = ob_get_clean();
		return $related_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_related_post', 'cs_related_post_render');
}
}

//=====================================================================
// Post comments
//=====================================================================
if (!function_exists('cs_comments_render')) {
	function cs_comments_render($atts, $content = ""){
		global $post;
		ob_start();
		comments_template('', true);
		$coments_data = ob_get_clean();
		return $coments_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_comments', 'cs_comments_render');
}
}

//=====================================================================
// Post author
//=====================================================================
if (!function_exists('cs_author_render')) {
	function cs_author_render($atts, $content = ""){
		global $post;
		ob_start();
		printf( __('%s','goalklub'), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'" >'.get_the_author().'</a>' );
		$author_data = ob_get_clean();
		return $author_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_author', 'cs_author_render');
}
}

//=====================================================================
// Post date
//=====================================================================
if (!function_exists('cs_postdate_render')) {
	function cs_postdate_render($atts, $content = ""){
		global $post;
		$defaults = array('date_format' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		if(isset($date_format) || $date_format <> ''){
			$date_format = $date_format;
		} else {
			$date_format = get_option( 'date_format' );
		}
		
		ob_start();
		?>
        <time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n(get_option( 'date_format' ),strtotime(get_the_date()));?></time>
		<?php
		$postdate_data = ob_get_clean();
		return $postdate_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_postdate', 'cs_postdate_render');
}
}

//=====================================================================
// Post Excerpt
//=====================================================================
if (!function_exists('cs_excerpt_render')) {
	function cs_excerpt_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array('read_more' => 'true', 'read_more_text' =>__('Read More','goalklub') );
		ob_start();
		$cs_node->cs_dcpt_excerpt=(int)$cs_node->cs_dcpt_excerpt;
		 if(isset($cs_node->cs_dcpt_excerpt) && $cs_node->cs_dcpt_excerpt > 0){?>
            <p><?php  echo cs_get_the_excerpt($cs_node->cs_dcpt_excerpt,$read_more, $read_more_text);?></p>
         <?php }
		$postexcerpt_data = ob_get_clean();
		return $postexcerpt_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_excerpt', 'cs_excerpt_render');
}
}

//=====================================================================
// Post Title
//=====================================================================
if (!function_exists('cs_title_render')) {
	function cs_title_render($atts, $content = ""){
		global $post;
		$defaults = array( 'link' => 'yes', 'chars' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		if($link == 'yes'){
			echo '<a href="'.get_permalink().'">';
		}
		if(!empty($chars) && strlen(get_the_title())>$chars){
			echo substr(get_the_title(),0,$chars);
			echo '...';
		} else {
			the_title();
		}
		if($link == 'yes'){
			echo '</a>';
		}
		$posttitle_data = ob_get_clean();
		return $posttitle_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_title', 'cs_title_render');
}
}


//=====================================================================
// Post Image
//=====================================================================
if (!function_exists('cs_image_render')) {
	function cs_image_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'alt' => '', 'height' => '300', 'width' => '300', 'link' => 'yes' );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		$image_url = cs_get_post_img_src($post->ID, $width, $height);
		if (isset($image_url) && !empty($image_url)){
			echo '<figure>';
			if($link == 'yes'){
				echo '<a href="'.get_permalink().'">';
			}
			if(!empty($image_url)){
				echo '<img src="'.$image_url.'" alt="No image">';
			}
			if($link == 'yes'){
				echo '</a>';
			}
			echo '</figure>';
		}
		$posttitle_data = ob_get_clean();
		return $posttitle_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_image', 'cs_image_render');
}
}

//=====================================================================
// Post Fields
//=====================================================================
if ( ! function_exists( 'cs_stickyfields_render' ) ) {
	function cs_stickyfields_render($atts, $content = ""){
		global $post,$cs_node,$cs_xmlObject;
		$defaults = array( 'title' => '','icon'=>'','count'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		$post_name = get_post_type($post->ID);
		$post_ID = cs_get_parent_custom_posttype_id($post_name);
		$custom_fields = '';
		$cs_dcpt_custom_fields = '';
		$cs_dcpt_custom_fields = get_post_meta($post_ID, "cs_dcpt_custom_fields", true);
		if ( $cs_dcpt_custom_fields <> "" ) {
			$cs_customfields_object = new SimpleXMLElement($cs_dcpt_custom_fields);
			$custom_field_counter = 0;
			if(isset($cs_customfields_object->custom_fields_elements) && $cs_customfields_object->custom_fields_elements == '1'){
				if(count($cs_customfields_object)>1){
					global $cs_xmlObject;
					foreach ( $cs_customfields_object->children() as $cs_field_node ){
						if(isset($cs_field_node->cs_customfield_sticky) && $cs_field_node->cs_customfield_sticky == 'yes'){
							$icon_class = '';
							$label = $cs_field_node->cs_customfield_label;
							$name = $cs_field_node->cs_customfield_name;
							$icon_class = $cs_field_node->cs_customfield_icon;
							$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
							if ( $post_xml <> "" ) {
								$cs_xmlObject = new SimpleXMLElement($post_xml);
							}
							$custom_fields .= '<li>';
							if($icon == 'yes' && $icon_class <> ''){
								$custom_fields .= '<i class="'.$icon_class.'"></i>';
							}
							if($label){
								$custom_fields .= $label;
								$custom_fields .= ': ';
							}
							if(isset($name)){
								$custom_fields .= $cs_xmlObject->$name;
							}
							$custom_fields .= '</li>';
							if(isset($count) && $custom_field_counter == $count){
								break;
							}
							$custom_field_counter++;
						}
					} 
				}
			}
		}
		return $custom_fields;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_stickyfields', 'cs_stickyfields_render');
}
}

//=====================================================================
// featured post title
//=====================================================================
if ( ! function_exists( 'cs_featured_render' ) ) {
	function cs_featured_render($atts, $content = ""){
		$defaults = array( 'title' => 'Featured');
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		if ( is_sticky() ){
			echo '<span class="cs-featured">'.$title.'</span>';
		}
		$postfeatured_data = ob_get_clean();
		return $postfeatured_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_featured', 'cs_featured_render');
}
}

//=====================================================================
// Rating
//=====================================================================
if ( ! function_exists( 'cs_rating_render' ) ) {
	function cs_rating_render($atts, $content = ""){
		$defaults = array( 'rating_percentage' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		$rating_percent = 0;
		$rating_percent = $rating_percentage*20;
		echo '<div class="cs-rating"><span style="width:'.$rating_percentage.'%" class="rating-box"></span></div>';
		
		$postfeatured_data = ob_get_clean();
		return $postfeatured_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_rating', 'cs_rating_render');
}
}

//=====================================================================
// attachments
//=====================================================================
if ( ! function_exists( 'cs_mediaattachments_render' ) ) {
	function cs_mediaattachments_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'icon' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$media_attachment = '';
		if($icon){
			$media_attachment .= '<i class="'.$icon.'"></i>';
		}
		if(count($cs_xmlObject->gallery)>0){
			$media_attachment .= count($cs_xmlObject->gallery);
		}
		return $media_attachment;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_mediaattachments', 'cs_mediaattachments_render');
}
}

//=====================================================================
// Model
//=====================================================================
if ( ! function_exists( 'cs_model_render' ) ) {
	function cs_model_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'title' => '', 'model' => '', 'icon' => 'fa-check');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_model = '';
		if($icon){
			$cs_model .= '<i class="'.$icon.'"></i>';
		}
		if($title){
			$cs_model .= $title;
		}
		if(isset($cs_xmlObject->dynamic_post_sale_model) && $cs_xmlObject->dynamic_post_sale_model <> ''){
			$cs_model .= $cs_xmlObject->dynamic_post_sale_model;
		}
		return $cs_model;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_model', 'cs_model_render');
}
}

//=====================================================================
// post sale milage
//=====================================================================
if ( ! function_exists( 'cs_milage_render' ) ) {
	function cs_milage_render(){
		global $post,$cs_node;
		$defaults = array( 'title' => '', 'milage' => '', 'icon' => 'fa-check');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_milage = '';
		if($icon){
			$cs_milage .= '<i class="'.$icon.'"></i>';
		}
		if($title){
			$cs_milage .= $title;
		}
		if(isset($cs_xmlObject->dynamic_post_sale_milage) && $cs_xmlObject->dynamic_post_sale_milage <> ''){
			$cs_milage .= $cs_xmlObject->dynamic_post_sale_milage;
		}
		return $cs_milage;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_milage', 'cs_milage_render');
}
}

//=====================================================================
// post price
//=====================================================================
if ( ! function_exists( 'cs_price_render' ) ) {
	function cs_price_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'title' => '', 'old_price' => '', 'new_price' => '', 'icon' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_price = '<span>';
		if($title){
			$cs_price .= $title;
		}
		if($icon){
			$cs_price .= '<i class="icon-'.$icon.'"></i>';
		}
		if($title){
			$cs_price .= $title;
		}
		if(isset($cs_xmlObject->dynamic_post_sale_oldprice) && $cs_xmlObject->dynamic_post_sale_oldprice <> ''){
			$cs_price .= '<span>'.$cs_xmlObject->dynamic_post_sale_oldprice.'</span>';
		}
		if(isset($cs_xmlObject->dynamic_post_sale_newprice) && $cs_xmlObject->dynamic_post_sale_newprice <> ''){
			$cs_price .= '<big>'.$cs_xmlObject->dynamic_post_sale_newprice.'</big>';
		}
		$cs_price .= '</span>';
		return '<div class="cs-carprice">'.$cs_price.'</div>';
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_price', 'cs_price_render');
}
}

//=====================================================================
// custom email
//=====================================================================
if ( ! function_exists( 'cs_custom_email_render' ) ) {
	function cs_custom_email_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_custom_email = '';
		if($title){
			$cs_custom_email .= $title;
		}
		if($icon){
			$cs_custom_email .= '<i class="icon-'.$icon.'"></i>';
		}
		if(isset($name)){
			$cs_custom_email .= $cs_xmlObject->$name;
		}
		return $cs_custom_email;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_email', 'cs_custom_email_render');
}
}

//=====================================================================
// custom text
//=====================================================================
if ( ! function_exists( 'cs_custom_text_render' ) ) {
	function cs_custom_text_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'name' => '', 'title' => '',  'icon'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_custom_text = '';
		if($icon){
			$cs_custom_text .= '<i class="'.$icon.'"></i>';
		}
		if($title){
			$cs_custom_text .= $title;
		}
		if(isset($name)){
			$cs_custom_text .= $cs_xmlObject->$name;
		}
		return $cs_custom_text;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_text', 'cs_custom_text_render');
}
}

//=====================================================================
// custom textarea 
//=====================================================================
if ( ! function_exists( 'cs_custom_textarea_render' ) ) {
	function cs_custom_textarea_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'name' => '', 'title' => '',  'icon'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_custom_text = '';
		if($icon){
			$cs_custom_text .= '<i class="'.$icon.'"></i>';
		}
		if(isset($title) && $title <> ''){
			$cs_custom_text .= $title;
		}
		if(isset($name)){
			$cs_custom_text .= $cs_xmlObject->$name;
		}
		return $cs_custom_text;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_textarea', 'cs_custom_text_render');
}
}

//=====================================================================
// custom radio
//=====================================================================
if ( ! function_exists( 'cs_custom_radio_render' ) ) {
	function cs_custom_radio_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_custom_radio = '';
		if($icon){
			$cs_custom_radio .= '<i class="'.$icon.'"></i>';
		}
		if($title){
			$cs_custom_radio .= $title;
		}
		if(isset($name)){
			$cs_custom_radio .= $cs_xmlObject->$name;
		}
		return $cs_custom_radio;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_radio', 'cs_custom_radio_render');
}
}

//=====================================================================
// post date
//=====================================================================
if ( ! function_exists( 'cs_date_render' ) ) {
	function cs_date_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'name' => '', 'title' => '',  'icon'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_custom_date = '';
		if($icon){
			$cs_custom_date .= '<i class="'.$icon.'"></i>';
		}
		if($title){
			$cs_custom_date .= $title;
		}
		if(isset($name)){
			$cs_custom_date .= $cs_xmlObject->$name;
		}
		return $cs_custom_date;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_date', 'cs_date_render');
}
}

//=====================================================================
// multi select option
//=====================================================================
if ( ! function_exists( 'cs_multiselect_render' ) ) {
	function cs_multiselect_render($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_multiselect = '';
		if($icon){
			$cs_multiselect .= '<i class="'.$icon.'"></i>';
		}
		if($title){
			$cs_multiselect .= $title;
		}
		if(isset($name)){
			$name = trim($name);
			$cs_multiselect .= $cs_xmlObject->$name;
		}
		return $cs_multiselect;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_multiselect', 'cs_multiselect_render');
}
}

//=====================================================================
// post url
//=====================================================================
if ( ! function_exists( 'cs_url_render' ) ) {

	function cs_url_render($atts, $content = ""){
		
		global $post,$cs_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_url_render = '';
		if($icon){
			$cs_url_render .= '<i class="'.$icon.'"></i>';
		}
		if($title){
			$cs_url_render .= $title;
		}
		
		if(isset($name)){
			$name = trim($name);
			$cs_url_render .= $cs_xmlObject->$name;
		}
		return $cs_url_render;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_url', 'cs_url_render');
}
}

//=====================================================================
// count media attachments
//=====================================================================
if ( ! function_exists( 'cs_mediaattachment_count_render' ) ) {

	function cs_mediaattachment_count_render($atts, $content = ""){
		
		global $post,$cs_node;
		$defaults = array( 'title' => '', 'icon'=>'fa-camera');
		extract( shortcode_atts( $defaults, $atts ) );
		
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_mediaattachment_count .= '<i class="'.$icon.'"></i> <span class="viewcount cs-bg-color">'.count($cs_xmlObject->gallery).'</span>';
		return $cs_mediaattachment_count;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_mediaattachment_count', 'cs_mediaattachment_count_render');
}
}

if ( ! function_exists( 'cs_map_location_link_render' ) ) {

	function cs_map_location_link_render($atts, $content = ""){
		
		global $post;
		$defaults = array( 'icon' => 'fa-map-marker', 'link'=>'#map');
		extract( shortcode_atts( $defaults, $atts ) );
		
		$cs_map_location .= '<a href="'.get_permalink().$link.'"><i class="'.$icon.'"></i></a>';
		return $cs_map_location;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_map_location', 'cs_map_location_link_render');
}
}

//=====================================================================
// get location address
//=====================================================================
if ( ! function_exists( 'cs_location_address_render' ) ) {

	function cs_location_address_render($atts, $content = ""){
		global $post;
		$defaults = array( 'icon' => 'fa-map-marker', 'link'=>'#map');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_location_address = '';
		if(isset($cs_xmlObject->dynamic_post_location_address_icon)){
			$cs_location_address .= '<i class="'.$cs_xmlObject->dynamic_post_location_address_icon.'"></i>';
		}
		if(isset($cs_xmlObject->dynamic_post_location_address)){
			$cs_location_address .= $cs_xmlObject->dynamic_post_location_address;
		}
		return $cs_location_address;

	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_location_address', 'cs_location_address_render');
}
}

//=====================================================================
// post hidden
//=====================================================================
if ( ! function_exists( 'cs_hidden_render' ) ) {

	function cs_hidden_render($atts, $content = ""){
		
		global $post,$cs_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_hidden = '';
		if($icon){
			$cs_hidden .= '<i class="'.$icon.'"></i>';
		}
		if($title){
			$cs_hidden .= $title;
		}
		
		if(isset($name)){
			$name = trim($name);
			$cs_hidden .= $cs_xmlObject->$name;
		}
		return $cs_hidden;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_hidden', 'cs_hidden_render');
}
}

//=====================================================================
// post dropdown option
//=====================================================================
if ( ! function_exists( 'cs_post_dropdown_render' ) ) {

	function cs_post_dropdown_render($atts, $content = ""){
		
		global $post,$cs_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon'=>'');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_post_dropdown = '';
		if($icon){
			$cs_post_dropdown .= '<i class="'.$icon.'"></i>';
		}
		if($title){
			$cs_post_dropdown .= $title;
		}
		if(isset($name)){
			$name = trim($name);
			$cs_post_dropdown .= $cs_xmlObject->$name;
		}
		return $cs_post_dropdown;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_dropdown', 'cs_post_dropdown_render');
}
}

//=====================================================================
// buy tickers
//=====================================================================
if ( ! function_exists( 'cs_buytickets_render' ) ) {

	function cs_buytickets_render($atts, $content = ""){
		global $post;
		$defaults = array( 'icon' => 'fa-map-marker', 'title'=>'', 'link'=>'#map');
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta($post->ID, "dynamic_cusotm_post", true);
		global $cs_xmlObject;
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
		}
		$cs_location_address = '';
		if(isset($cs_xmlObject->dynamic_post_location_address_icon)){
			$cs_location_address .= '<i class="'.$cs_xmlObject->dynamic_post_location_address_icon.'"></i>';
		}
		if(isset($cs_xmlObject->dynamic_post_location_address)){
			$cs_location_address .= $cs_xmlObject->dynamic_post_location_address;
		}
		return $cs_location_address;

	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_buytickets', 'cs_buytickets_render');
}
}

//=====================================================================
// user wishlist
//=====================================================================
if ( ! function_exists( 'cs_wishlist_render' ) ) {
	function cs_wishlist_render($atts, $content = ""){
		global $post;
		$defaults = array( 'icon' => 'fa-plus', 'title'=>'Save');
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		cs_wishlist($icon,$title);
		$post_data = ob_get_clean();
		return $post_data;

	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_wishlist', 'cs_wishlist_render');
}
}

//=====================================================================
// wishlist listing
//=====================================================================
if ( ! function_exists( 'cs_wishlist_listing_render' ) ) {
	function cs_wishlist_listing_render($atts, $content = ""){
		global $post;
		$defaults = array( 'icon' => 'fa-plus', 'title'=>'Save');
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		cs_user_wishlist();
		$post_data = ob_get_clean();
		return $post_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_wishlisting', 'cs_wishlist_listing_render');
}
}

//=====================================================================
// like counter
//=====================================================================
if ( ! function_exists( 'cs_likecounter_render' ) ) {
	function cs_likecounter_render($atts, $content = ""){
		global $post;
		$defaults = array( 'icon' => 'fa-plus', 'title'=>'Save');
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		cs_likes_counter();
		$post_data = ob_get_clean();
		return $post_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_likecounter', 'cs_likecounter_render');
}
}
//=====================================================================
// User Rating 
//=====================================================================
if ( ! function_exists( 'cs_user_rating_render' ) ) {
	function cs_user_rating_render($atts, $content = ""){
		global $post;
		$defaults = array( 'icon' => 'fa-plus', 'title'=>'Save');
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		cs_likes_counter();
		$post_data = ob_get_clean();
		return $post_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_user_rating', 'cs_user_rating_render');
}
}

//=====================================================================
// DCPT names
//=====================================================================
if ( ! function_exists( 'cs_shortcode_dcpt_names' ) ) {
	function cs_shortcode_dcpt_names(){
	global $post;
	$dcpt_elements_array = array();
	$cs_query = new WP_Query(array('post_type' => array('dcpt')));
		while ($cs_query->have_posts()) : $cs_query->the_post();
			$dcpt_elements_array[$post->post_name] = array(
							'title'=>$post->post_title,
							'name'=>'page_element',
							'categories'=>'loops',
					 );
		endwhile;
		wp_reset_postdata();
		wp_reset_query();
		return $dcpt_elements_array;
	}
}

//=====================================================================
// Shortcode Array Start
//=====================================================================
if ( ! function_exists( 'cs_shortcode_names' ) ) {
	function cs_shortcode_names(){
	global $post;
	$dcpt_elements_array = array();


		$shortcode_array = array(
		          'accordion'=>array(
						'title'=>__('Accordion','goalklub'),
						'name'=>'accordion',
						'icon'=>'icon-list-ul',
						'categories'=>'commonelements',
				 ),

				 'blog'=>array(
						'title'=>__('Blog','goalklub'),
						'name'=>'blog',
						'icon'=>'icon-newspaper3',
						'categories'=>'loops',
				 ),
			
				 'button'=>array(
						'title'=>__('Button','goalklub'),
						'name'=>'button',
						'icon'=>'icon-heart6',
						'categories'=>'commonelements',
				 ),
				 'call_to_action'=>array(
						'title'=>__('Call to Action','goalklub'),
						'name'=>'call_to_action',
						'icon'=>'icon-info-circle',
						'categories'=>'commonelements',
				 ),
				
			
				 'clients'=>array(
						'title'=>__('Clients','goalklub'),
						'name'=>'clients',
						'icon'=>'icon-users5',
						'categories'=>'loops',
				 ),
				 'club_history'=>array(
						'title'=>__('Club History','goalklub'),
						'name'=>'club_history',
						'icon'=>'icon-hand-o-right',
						'categories'=>'loops',
				 ),
				 'contactus'=>array(
					'title'=>__('Form','goalklub'),
					'name'=>'contactus',
					'icon'=>'icon-building-o',
					'categories'=>'contentblocks',
				 ),
				 'counter'=>array(
						'title'=>__('Counter','goalklub'),
						'name'=>'counter',
						'icon'=>'icon-clock-o',
						'categories'=>'commonelements',
				 ),
				 'contactinfo'=>array(
						'title'			=>__('Contact Info','goalklub'),
						'name'			=>'contactinfo',
						'icon'			=>'icon-sliders',
						'categories'	=>'contentblocks',
				 ),
			 	'contentslider'=>array(
						'title'			=>__('Content Slider','goalklub'),
						'name'			=>'contentslider',
						'icon'=>'icon-sliders',
						'categories'	=>'loops',
				 ),
				 'divider'=>array(
						'title'=>__('Divider','goalklub'),
						'name'=>'divider',
						'icon'=>'icon-ellipsis-h',
						'categories'=>'typography misc',
				 ),
				  'dropcap'=>array(
						'title'=>__('Drop cap','goalklub'),
						'name'=>'dropcap',
						'icon'=>'icon-bold',
						'categories'=>'typography misc',
				 ),
				 'flex_column'=>array(
						'title'=>__('Column','goalklub'),
						'name'=>'flex_column',
						'icon'=>'icon-columns',
						'categories'=>'typography misc',
				 ),
				 'heading'=>array(
						'title'=>__('Heading','goalklub'),
						'name'=>'heading',
						'icon'=>'icon-h-square',
						'categories'=>'typography misc',
				 ),
				 'highlight'=>array(
						'title'=>__('Highlight','goalklub'),
						'name'=>'highlight',
						'icon'=>'icon-pencil3',
						'categories'=>'typography misc',
				 ),
				 'icons'=>array(
						'title'=>__('Icons','goalklub'),
						'name'=>'icons',
						'icon'=>'icon-happy',
						'categories'=>' contentblocks',
				 ),
				 'infobox'=>array(
						'title'=>__('Info box','goalklub'),
						'name'=>'infobox',
						'icon'=>'icon-info-circle',
						'categories'=>' contentblocks',
				 ),
				 'image'=>array(
						'title'=>__('Image Frame','goalklub'),
						'name'=>'image',
						'icon'=>'icon-picture2',
						'categories'=>'mediaelement',
				 ),
				 'list'=>array(
						'title'=>__('List','goalklub'),
						'name'=>'list',
						'icon'=>'icon-list-ol',
						'categories'=>'typography misc	',
				 ),
				 'map'=>array(
						'title'=>__('Map','goalklub'),
						'name'=>'map',
						'icon'=>'icon-globe4',
						'categories'=>'contentblocks',
				 ),
				 'match'=>array(
						'title'=>__('Match','goalklub'),
						'name'=>'match',
						'icon'=>'icon-envelope3',
						'categories'=>'loops',
				 ),
				 'upcomming_fixtures'=>array(
						'title'=>__('Upcoming Fixtures','goalklub'),
						'name'=>'upcomming_fixtures',
						'icon'=>'icon-megaphone3',
						'categories'=>'loops',
				 ),	
				 'mesage'=>array(
						'title'=>__('Message','goalklub'),
						'name'=>'mesage',
						'icon'=>'fa-envelope',
						'categories'=>'typography misc	',
				 ),
				
				 'offerslider'=>array(
						'title'=>__('Offer slider','goalklub'),
						'name'=>'offerslider',
						'icon'=>' icon-trophy',
						'categories'=>' contentblocks',
				 ),
				 'player'=>array(
						'title'=>__('Team Players','goalklub'),
						'name'=>'player',
						'icon'=>'icon-list-alt',
						'categories'=>'loops',
				 ),
				 'point_table'=>array(
						'title'=>__('Point Tables','goalklub'),
						'name'=>'point_table',
						'icon'=>'icon-list-alt',
						'categories'=>'loops',
				 ),
				 'progressbars'=>array(
						'title'=>__('Progress bars','goalklub'),
						'name'=>'progressbars',
						'icon'=>'icon-list-alt',
						'categories'=>' commonelements',
				 ),
				 'piecharts'=>array(
						'title'=>__('Pie charts','goalklub'),
						'name'=>'piecharts',
						'icon'=>'icon-piechart',
						'categories'=>'commonelements',
				 ),
				 'promobox'=>array(
						'title'=>__('Promo box','goalklub'),
						'name'=>'promobox',
						'icon'=>'icon-browser',
						'categories'=>' mediaelement',
				 ),
				 'pricetable'=>array(
						'title'=>__('Price table','goalklub'),
						'name'=>'pricetable',
						'icon'=>'icon-table',
						'categories'=>'commonelements',
				 ),
				  'quote'=>array(
						'title'=>__('Quote','goalklub'),
						'name'=>'quote',
						'icon'=>'icon-quote-right',
						'categories'=>'typography misc',
				 ),
				 'register'=>array(
						'title'=>__('Register','goalklub'),
						'name'=>'register',
						'icon'=>'icon-external-link',
						'categories'=>'commonelements',
				 ),
				  'slider'=>array(
						'title'=>__('Slider','goalklub'),
						'name'=>'slider',
						'icon'=>'icon-sliders',
						'categories'=>'loops',
				 ),
				  'services'=>array(
						'title'=>__('Services','goalklub'),
						'name'=>'services',
						'icon'=>'icon-check-square-o',
						'categories'=>' commonelements',
				 ),
				'teams'=>array(
						'title'=>__('Team','goalklub'),
						'name'=>'teams',
						'icon'=>'icon-user',
						'categories'=>'loops misc',
				 ),
				 'tooltip'=>array(
						'title'=>__('Tooltip','goalklub'),
						'name'=>'tooltip',
						'icon'=>'icon-comment-o',
						'categories'=>'typography misc',
				 ),
				 /*'contact'=>array(
						'title'=>'Form',
						'name'=>'contact',
						'categories'=>'typography contentblocks loops',
				 ),
				 'parallax'=>array(
						'title'=>'Parallax',
						'name'=>'parallax',
						'categories'=>'commonelements',
				 ),*/
				 'tabs'=>array(
						'title'=>__('Tabs','goalklub'),
						'name'=>'tabs',
						'icon'=>'icon-list-alt',
						'categories'=>'commonelements',
				 ),
				 'toggle'=>array(
						'title'=>__('Toggle','goalklub'),
						'name'=>'toggle',
						'icon'=>'icon-toggle-right',
						'categories'=>'commonelements',
				 ),
				  'testimonials'=>array(
						'title'=>__('Testimonials','goalklub'),
						'name'=>'testimonials',
						'icon'=>'icon-comments-o',
						'categories'=>'typography misc',
				 ),
				 'table'=>array(
						'title'=>__('Table','goalklub'),
						'name'=>'table',
						'icon'=>'icon-th',
						'categories'=>'commonelements',
				 ),
				 'tweets'=>array(
						'title'=>__('Tweets','goalklub'),
						'name'=>'tweets',
						'icon'=>'icon-twitter',
						'categories'=>'loops',
				 ),
				 'video'=>array(
						'title'=>__('Video','goalklub'),
						'name'=>'video',
						'icon'=>'icon-play-circle',
						'categories'=>'mediaelement',
				 ),
				 'spacer'=>array(
						'title'=>__('Spacer','goalklub'),
						'name'=>'spacer',
						'icon'=>'icon-arrows-v',
						'categories'=>'commonelements',
				 ), 
				 'faq'=>array(
						'title'=>__('FAQ','goalklub'),
						'name'=>'faq',
						'icon'=>'icon-question-circle',
						'categories'=>'typography',
				 ),
				
		);
		
		ksort($shortcode_array);
		return $shortcode_array;
	}
}

//=====================================================================
// Shortcode Buttons
//=====================================================================
add_action('media_buttons','cs_shortcode_popup',11);
// 
if ( ! function_exists( 'cs_shortcode_popup' ) ) {
	function cs_shortcode_popup($die = 0, $shortcode='shortcode'){
		$i = 1;
		$style='';
		if ( isset($_POST['action']) ) {
			$name = $_POST['action'];
			$cs_counter = $_POST['counter'];
			$randomno = cs_generate_random_string('5');
			$rand = rand(1,999);
			$style='';
		} else {
			$name = '';
			$cs_counter = '';
			$rand = rand(1,999);
			$randomno = cs_generate_random_string('5');
			if(isset($_REQUEST['action']))
				$name = $_REQUEST['action'];
			$style='style="display:none;"';
		}
		$cs_page_elements_name = array();
		$cs_page_elements_name = cs_shortcode_names();
 
 		$cs_page_categories_name =  cs_elements_categories();
		
	?> 
		<div class="cs-page-composer  <?php echo sanitize_html_class($shortcode);?> composer-<?php echo intval($rand) ?>" id="composer-<?php echo intval($rand) ?>" style="display:none">
			<div class="page-elements">
			<div class="cs-heading-area">
				 <h5>
					<i class="icon-plus7"></i><?php _e('Add Element','goalklub');?>
				</h5>
				<span class='cs-btnclose' onclick='javascript:removeoverlay("composer-<?php echo esc_js($rand) ?>","append")'><i class="icon-cross3"></i></span>
			</div>
			<script>
				jQuery(document).ready(function($){
					cs_page_composer_filterable('<?php echo esc_js($rand)?>');
				});
			</script>
		 <div class="cs-filter-content shortcode">
			<p><input type="text" id="quicksearch<?php echo intval($rand) ?>" placeholder="<?php _e('Search','goalklub');?> " /></p>
			  <div class="cs-filtermenu-wrap">
				<h6><?php _e('Filter by','goalklub');?></h6>
				<ul class="cs-filter-menu" id="filters<?php echo intval($rand) ?>">
				  <li data-filter="all" class="active"><?php _e('Show all','goalklub');?></li>
                  <?php foreach($cs_page_categories_name as $key=>$value){
				  		echo '<li data-filter="'.$key.'">'.$value.'</li>';
					}?>
				</ul>
			  </div>
				<div class="cs-filter-inner" id="page_element_container<?php echo intval($rand) ?>">
                	<?php foreach($cs_page_elements_name as $key=>$value){
                    		echo '<div class="element-item '.$value['categories'].'">';
                              $icon = isset($value['icon']) ? $value['icon'] : 'accordion-icon'; ?>
                              <a href='javascript:cs_shortocde_selection("<?php echo esc_js($key);?>","<?php echo admin_url('admin-ajax.php');?>","composer-<?php echo intval($rand) ?>")'><?php cs_page_composer_elements($value['title'], $icon)?></a>
                          </div>
                    <?php }?>
				</div>
			  </div>
			</div>
			<div class="cs-page-composer-shortcode"></div>
		</div>
	   <?php 
		if(isset($shortcode) && $shortcode <> ''){
			?>
			<a class="button" href="javascript:_createpop('composer-<?php echo esc_js($rand) ?>', 'filter')"><i class="icon-plus7"></i><?php _e('CS: Insert shortcode','goalklub');?></a>
			<?php
		}
	}
}

//=====================================================================
// Column Size Dropdown Function Start
//=====================================================================
if ( ! function_exists( 'cs_shortcode_element_size' ) ) {
	function cs_shortcode_element_size($column_size =''){
		?>
			<ul class="form-elements">
                <li class="to-label"><label><?php _e('Size','goalklub');?></label></li>
                <li class="to-field select-style">
                    <select class="column_size" id="column_size" name="column_size[]">
                        <option value="1/1" <?php if($column_size == '1/1'){echo 'selected="selected"';}?>><?php _e('Full width','goalklub');?></option>
                        <option value="1/2" <?php if($column_size == '1/2'){echo 'selected="selected"';}?>><?php _e('One half','goalklub');?></option>
                        <option value="1/3" <?php if($column_size == '1/3'){echo 'selected="selected"';}?>><?php _e('One third','goalklub');?></option
                        ><option value="2/3" <?php if($column_size == '2/3'){echo 'selected="selected"';}?>><?php _e('Two third','goalklub');?></option>
                        <option value="1/4" <?php if($column_size == '1/4'){echo 'selected="selected"';}?>><?php _e('One fourth','goalklub');?></option>
                        <option value="3/4" <?php if($column_size == '3/4'){echo 'selected="selected"';}?>><?php _e('Three fourth','goalklub');?></option>
                    </select>
                    <p><?php _e('Select column width. This width will be calculated depend page width','goalklub');?></p>
                </li>                  
            </ul>
		<?php
	}
}
// Column Size Dropdown Function end

//=====================================================================
// Animation Styles
//=====================================================================
function cs_animation_style(){
	return $animation_style = array(
						'Entrances'=>array('slideDown'=>'slideDown','slideUp'=>'slideUp','slideLeft'=>'slideLeft','slideRight'=>'slideRight','slideExpandUp'=>'slideExpandUp','expandUp'=>'expandUp','expandOpen'=>'expandOpen','bigEntrance'=>'bigEntrance','hatch'=>'hatch'),
						'Misc'=>array('floating'=>'floating','tossing'=>'tossing','pullUp'=>'pullUp','pullDown'=>'pullDown','stretchLeft'=>'stretchLeft','stretchRight'=>'stretchRight'),
						'Attention Seekers'=>array('bounce'=>'bounce','flash'=>'flash','pulse'=>'pulse','rubberBand'=>'rubberBand','shake'=>'shake','swing'=>'swing','tada'=>'tada','wobble'=>'wobble'),
						'Bouncing Entrances'=>array('bounceIn'=>'bounceIn','bounceInDown'=>'bounceInDown','bounceInLeft'=>'bounceInLeft','bounceInRight'=>'bounceInRight','bounceInUp'=>'bounceInUp'),
                 		'Fading Entrances'=>array('fadeIn'=>'fadeIn','fadeInDown'=>'fadeInDown','fadeInDownBig'=>'fadeInDownBig','fadeInLeft'=>'fadeInLeft','fadeInLeftBig'=>'fadeInRight','fadeInRightBig'=>'fadeInRightBig','fadeInUp'=>'fadeInUp','fadeInUpBig'=>'fadeInUpBig'),
						'Flippers'=>array('flip'=>'flip','flipInX'=>'flipInX','flipInY'=>'flipInY'),
						'Lightspeed'=>array('lightSpeedIn'=>'lightSpeedIn'),
						 'Rotating Entrances'=>array('rotateIn'=>'rotateIn','rotateInDownLeft'=>'rotateInDownLeft','rotateInDownRight'=>'rotateInDownRight','rotateInUpLeft'=>'rotateInUpLeft','rotateInUpRight'=>'rotateInUpRight'),
						'Specials'=>array('hinge'=>'hinge','rollIn'=>'rollIn'),
						'Zoom Entrances'=>array('zoomIn'=>'zoomIn','zoomInDown'=>'zoomInDown','zoomInLeft'=>'zoomInLeft','zoomInRight'=>'zoomInRight','zoomInUp'=>'zoomInUp'),
						);	
}

//=====================================================================
// Custom Class and Animations Function Start
//=====================================================================
if ( ! function_exists( 'cs_shortcode_custom_classes' ) ) {
	function cs_shortcode_custom_classes($cs_custom_class = '',$cs_custom_animation='',$cs_custom_animation_duration='1'){
		?>
        	<ul class="form-elements">
                <li class="to-label"><label><?php _e('Custom ID','goalklub');?></label></li>
                <li class="to-field">
                    <input type="text" name="cs_custom_class[]" class="txtfield"  value="<?php echo sanitize_text_field($cs_custom_class); ?>" />
                    <p><?php _e('Use this option if you want to use specified Class for this element','goalklub');?>	</p>
                </li>
            </ul>
            <?php $custom_animation_array = array('fade'=>'Fade','slide'=>'Slide','left-slide'=>'left Slide');?>
            
            <ul class="form-elements">
                <li class="to-label"><label><?php _e('Animation Class','goalklub');?> <?php echo sanitize_text_field($cs_custom_animation);?></label></li>
                <li class="to-field select-style">
                	<select class="dropdown" name="cs_custom_animation[]">
                    	<option value=""><?php _e('Animation Class','goalklub');?></option>
                        <?php 
								$animation_array = cs_animation_style();
								foreach($animation_array as $animation_key=>$animation_value){
									echo '<optgroup label="'.$animation_key.'">';	
									foreach($animation_value as $key=>$value){
										$active_class = '';
										if($cs_custom_animation == $key){$active_class = 'selected="selected"';}
										echo '<option value="'.$key.'" '.$active_class.'>'.$value.'</option>';
									}
								}
						?>
                      </select>
                      <p><?php _e('Select Entrance animation type from the dropdown','goalklub');?> </p>
                </li>
            </ul>
        <?php
	}
}
// Custom Class and Animations Function end

//=====================================================================
// Dynamic Custom Class and Animations Function Start
//=====================================================================
if ( ! function_exists( 'cs_shortcode_custom_dynamic_classes' ) ) {
	function cs_shortcode_custom_dynamic_classes($cs_custom_class = '',$cs_custom_animation='',$cs_custom_animation_duration='1',$prefix){
		?>
        	<ul class="form-elements">
                <li class="to-label"><label><?php _e('Custom ID','goalklub');?></label></li>
                <li class="to-field">
                    <input type="text" name="<?php echo sanitize_text_field($prefix);?>_class[]" class="txtfield"  value="<?php echo sanitize_text_field($cs_custom_class)?>" />
                    <p><?php _e('Use this option if you want to use specified id for this element','goalklub');?></p>
                </li>
            </ul>

            <?php $custom_animation_array = array('fade'=>'Fade','slide'=>'Slide','left-slide'=>'left Slide');?>
			
            <ul class="form-elements">
                <li class="to-label"><label><?php _e('Animation Class','goalklub');?> <?php echo sanitize_text_field($cs_custom_animation);?></label></li>
				
                <li class="to-field select-style">
                	<select class="dropdown" name="<?php echo sanitize_text_field($prefix);?>_animation[]">
                    	<option value=""><?php _e('Select Animation','goalklub');?></option>
                        <?php 
								$animation_array = cs_animation_style();
								foreach($animation_array as $animation_key=>$animation_value){
									echo '<optgroup label="'.$animation_key.'">';	
									foreach($animation_value as $key=>$value){
										$active_class = '';
										if($cs_custom_animation == $key){$active_class = 'selected="selected"';}
										echo '<option value="'.$key.'" '.$active_class.'>'.$value.'</option>';
									}
								}
						
						?>
                      </select>
                      <p><?php _e('Select Entrance animation type from the dropdown','goalklub');?></p>
                </li>
				
            </ul>  
        <?php
	}
}
// Dynamic Custom Class and Animations Function end


//=====================================================================
// Members Listing Shortcode Function
//=====================================================================
if ( ! function_exists( 'cs_members_listing' ) ) {
	function cs_members_listing($atts, $content = ""){
		global $post,$cs_node;
		$defaults = array( 'column_size' => '1/1', 'var_pb_members_title' => '', 'var_pb_members_roles'=>'','var_pb_members_profile_inks' => '', 'var_pb_members_pagination' => 'single', 'var_pb_members_per_page' => '-1', 'cs_custom_class' => '', 'cs_custom_animation' => '', 'cs_custom_animation_duration' => '1', );
		extract( shortcode_atts( $defaults, $atts ) );
		$coloumn_class = cs_custom_column_class($column_size);
		ob_start();
		 $qrystr = '';
          if ( $cs_dcpt_post_pagination == "Show Pagination" and $count_post > $cs_dcpt_post_per_page and $cs_dcpt_post_per_page > 0) {
				if ( isset($_GET['page_id']) ) $qrystr = "&page_id=".$_GET['page_id'];
					echo cs_pagination($count_post, $cs_dcpt_post_per_page,$qrystr);
        }
		$memberspost_data = ob_get_clean();
		return $memberspost_data;
	}
	if(function_exists('cs_shortcode_add')){ cs_shortcode_add('cs_memberssss', 'cs_members_listing');
}
}

//=====================================================================
// Shortcode Add box Ajax Function
//=====================================================================
if ( ! function_exists( 'cs_shortcode_element_ajax_call' ) ) {
	function cs_shortcode_element_ajax_call(){?>
	<?php 	
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element']){
			if($_POST['shortcode_element'] == 'services'){
				$rand_id = rand(8,7777);
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo intval( $rand_id);?>">
					<header><h4><i class='icon-arrows'></i><?php _e('Service','goalklub');?></h4> <a href='#' class='deleteit_node'><i class='icon-minus8-circle'></i><?php _e('Remove','goalklub');?></a></header>
                    
                    <?php if ( function_exists( 'cs_shortcode_element_size' ) ) {cs_shortcode_element_size();}?>
					<ul class='form-elements'>
						<li class='to-label'><label><?php _e('Service Title','goalklub');?></label></li>
						<li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='service_title[]' /></div>
						<div class='left-info'><p><?php _e('Title of the Service','goalklub');?></p></div>
						</li>
					</ul>
					<ul class='form-elements'>
						<li class='to-label'><label><?php _e('Service View','goalklub');?></label></li>
						<li class='to-field select-style'> <div class='input-sec'><select name='service_type[]' class='dropdown'>
                        <option value='size_large'><?php _e('Large Boxed','goalklub');?></option>
                        <option value='size_large_normal'><?php _e('Large Normal','goalklub');?></option>
                        <option value='size_circle'><?php _e('Circle','goalklub');?></option>
                        <option  value="size_medium" ><?php _e('Medium','goalklub');?></option>
                        <option value='size_small'><?php _e('Small','goalklub');?></option>
                        </select></div>
						<div class='left-info'><p><?php _e('Type of the Service','goalklub');?></p></div>
						</li>
					</ul>
					 <ul class='form-elements' id="<?php echo intval( $rand_id);?>">
							<li class='to-label'><label><?php _e('Choose Icon','goalklub');?></label></li>
							<li class="to-field">
								<?php cs_fontawsome_icons_box('',$rand_id,'cs_service_icon');?>
							</li>
					</ul>
                    <ul class="form-elements">
                        <li class="to-label"><label><?php _e('Icon Postion','goalklub');?></label></li>
                        <li class="to-field select-style">
                            <select class="service_icon_postion" name="service_icon_postion[]">
                                <option value="left"><?php _e('left','goalklub');?></option>
                                <option value="right"><?php _e('Right','goalklub');?></option>
                                <option value="top"><?php _e('Top','goalklub');?></option>
                                <option value="center"><?php _e('Center','goalklub');?></option>
                            </select>
                        </li>                  
                    </ul>
                    <ul class="form-elements">
                        <li class="to-label"><label><?php _e('Icon Type','goalklub');?></label></li>
                        <li class="to-field select-style">
                            <select class="service_icon_type" name="service_icon_type[]">
                                <option value="circle"><?php _e('Circle','goalklub');?></option>
                                <option value="square"><?php _e('Square','goalklub');?></option>
                            </select>
                        </li>                  
                    </ul>
                    <ul class="form-elements">
                          <li class="to-label">
                            <label><?php _e('Service Background Image','goalklub');?></label>
                          </li>
                          <li class="to-field">
                            <input id="service_bg_image<?php echo intval( $rand_id);?>" name="service_bg_image[]" type="hidden" class="" value=""/>
                            <input name="service_bg_image<?php echo intval( $rand_id);?>"  type="button" class="uploadMedia left" value="<?php _e('Browse','goalklub');?>"/>
                          </li>
                        </ul>
                        <div class="page-wrap" style="overflow:hidden; display:none;?>" id="service_bg_image<?php echo intval( $rand_id);?>_box" >
                          <div class="gal-active">
                            <div class="dragareamain" style="padding-bottom:0px;">
                              <ul id="gal-sortable">
                                <li class="ui-state-default" id="">
                                  <div class="thumb-secs"> <img src="<?php echo esc_url($service_bg_image);?>"  id="service_bg_image<?php echo intval( $rand_id);?>_img" width="100" height="150"  />
                                    <div class="gal-edit-opts"> <a   href="javascript:del_media('service_bg_image<?php echo intval( $rand_id);?>')" class="delete"></a> </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
					<ul class='form-elements'>
						<li class='to-label'><label><?php _e('Service Url','goalklub');?></label></li>
						<li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='service_link_url[]' /></div>
						<div class='left-info'><p><?php _e('Service Url','goalklub');?></p></div>
						</li>
					</ul>
                    <ul class="form-elements">
                        <li class="to-label"><label><?php _e('Border','goalklub');?></label></li>
                        <li class="to-field select-style">
                            <select class="service_border" id="service_border" name="service_border[]">
                                <option value="yes"><?php _e('Yes','goalklub');?></option>
                                <option value="no"><?php _e('No','goalklub');?></option>
                            </select>
                        </li>                  
                    </ul>
					<ul class='form-elements'>
						<li class='to-label'><label><?php _e('Service Text','goalklub');?></label></li>
						<li class='to-field'> <div class='input-sec'><textarea class='txtfield' data-content-text="cs-shortcode-textarea" name='service_text[]'></textarea></div>
						</li>
					</ul>
                    <ul class="form-elements">
                        <li class="to-label"><label><?php _e('Divider','goalklub');?></label></li>
                        <li class="to-field select-style">
                            <select class="service_divider" name="service_divider[]">
                                <option value="yes"><?php _e('Yes','goalklub');?></option>
                                <option value="no"><?php _e('No','goalklub');?></option>
                            </select>
                        </li>                  
                    </ul>
                    <ul class="form-elements">
                        <li class="to-label"><label><?php _e('Icon Color','goalklub');?></label></li>
                        <li class="to-field">
                            <input type="text" name="service_icon_color[]" class="bg_color"  value="" />
                        </li>
                    </ul>
                    <ul class="form-elements">
                        <li class="to-label"><label><?php _e('Icon Background Color','goalklub');?></label></li>
                        <li class="to-field">
                            <input type="text" name="service_icon_bg_color[]" class="bg_color"  value="" />
                        </li>
                    </ul>
                  	 <ul class="form-elements">
                        <li class="to-label"><label><?php _e('Custom ID','goalklub');?></label></li>
                        <li class="to-field">
                            <input type="text" name="service_class[]" class="txtfield"  value="" />
                        </li>
                     </ul>
                    <ul class="form-elements">
                        <li class="to-label"><label><?php _e('Animation Class','goalklub');?> </label></li>
                        <li class="to-field select-style">
                            <select class="dropdown" name="service_animation[]">
                                <option value=""><?php _e('Select Animation','goalklub');?></option>
                                <?php 
                                    $animation_array = cs_animation_style();
                                    foreach($animation_array as $animation_key=>$animation_value){
                                        echo '<optgroup label="'.$animation_key.'">';	
                                        foreach($animation_value as $key=>$value){
                                            echo '<option value="'.$key.'" >'.$value.'</option>';
                                        }
                                    }
                                
                                 ?>
                              </select>
                        </li>
                    </ul>
				</div>
				<?php     
			} 
			else if($_POST['shortcode_element'] == 'accordions'){
				 $rand_id = rand(5,999);
				?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo intval( $rand_id);?>">
                        <header><h4><i class='icon-arrows'></i><?php _e('Accordion','goalklub');?></h4> <a href='#' class='deleteit_node'><i class='icon-minus8-circle'></i><?php _e('Remove','goalklub');?></a></header>
                        <ul class='form-elements'>
                            <li class='to-label'><label><?php _e('Active','goalklub');?></label></li>
                            <li class='to-field select-style'> <select name='accordion_active[]'><option value="no"><?php _e('No','goalklub');?></option><option value="yes"><?php _e('Yes','goalklub');?></option></select>
                            <div class='left-info'>
                              <p><?php _e('You can set the section that is active here by select dropdown','goalklub');?></p>
                            </div>
                            </li>
                        </ul>
                        <ul class='form-elements'>
                            <li class='to-label'><label><?php _e('Accordion Title','goalklub');?></label></li>
                            <li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='accordion_title[]' /></div>
                            <div class='left-info'>
                              <p><?php _e('Enter accordion title','goalklub');?></p>
                            </div>
                            </li>
                        </ul>
                        <ul class='form-elements' id="<?php echo intval($rand_id);?>">
							<li class='to-label'><label><?php _e('Choose Icon','goalklub');?></label></li>
							<li class="to-field">
                                    <?php cs_fontawsome_icons_box('',$rand_id,'cs_accordian_icon');?>
                                    
                                    <div class='left-info'>
                                      <p><?php _e('select the IcoMoon Icons you would like to add to your menu items','goalklub');?></p>
                                    </div>
                            </li>
                        </ul>
                        <ul class='form-elements'>
                            <li class='to-label'><label><?php _e('Accordion Text','goalklub');?></label></li>
                            <li class='to-field'> <div class='input-sec'><textarea class='txtfield' data-content-text="cs-shortcode-textarea" name='accordion_text[]'></textarea></div>
                            <div class='left-info'>
                              <p><?php _e('Enter your content','goalklub');?></p>
                            </div>
                            </li>
                        </ul>
                    </div>
                <?php	
			
		
		    }
			else if($_POST['shortcode_element'] == 'faq'){
				 $rand_id = rand(5,999);
				?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo intval( $rand_id);?>">
                        <header><h4><i class='icon-arrows'></i><?php _e('FAQ','goalklub');?></h4> <a href='#' class='deleteit_node'><i class='icon-minus8-circle'></i><?php _e('Remove','goalklub');?></a></header>
                        <ul class='form-elements'>
                            <li class='to-label'><label><?php _e('Active','goalklub');?></label></li>
                            <li class='to-field select-style'> <select name='faq_active[]'><option value="no"><?php _e('No','goalklub');?></option><option value="yes"><?php _e('Yes','goalklub');?></option></select>
                            </li>
                        </ul>
                        <ul class='form-elements'>
                            <li class='to-label'><label><?php _e('Faq Title','goalklub');?></label></li>
                            <li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='faq_title[]' /></div>
                            </li>
                        </ul>
                        <ul class='form-elements' id="<?php echo intval( $rand_id);?>">
							<li class='to-label'><label><?php _e('Choose Icon','goalklub');?></label></li>
							<li class="to-field">
                                    <?php cs_fontawsome_icons_box('',$rand_id,'cs_faq_icon');?>
                            </li>
                        </ul>
                        <ul class='form-elements'>
                            <li class='to-label'><label><?php _e('Faq Text','goalklub');?></label></li>
                            <li class='to-field'> <div class='input-sec'><textarea class='txtfield' data-content-text="cs-shortcode-textarea" name='faq_text[]'></textarea></div>
                            </li>
                        </ul>
                    </div>
                <?php	
				
		 }
		 
		 else if($_POST['shortcode_element'] == 'club_history'){
				 $rand_id = rand(5,999);
				?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo intval( $rand_id);?>">
                        <header><h4><i class='icon-arrows'></i><?php _e('Club History','goalklub');?></h4> <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php _e('Remove','goalklub');?></a></header>
                        
                        <ul class='form-elements'>
                            <li class='to-label'><label><?php _e('Title','goalklub');?></label></li>
                            <li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='club_history_title[]' /></div>
                            </li>
                        </ul>
                        
                        <ul class="form-elements">
                          <li class="to-label">
                            <label><?php _e('Image','goalklub');?></label>
                          </li>
                          <li class="to-field">
                            <input id="club_history_image<?php echo esc_attr($rand_id);?>" name="cs_club_history_image[]" type="hidden" class="" value=""/>
                            <input name="club_history_image<?php echo esc_attr($rand_id);?>"  type="button" class="uploadMedia left" value="<?php _e('Browse','goalklub');?>"/>
                          </li>
                        </ul>
                        <div class="page-wrap" style="overflow:hidden; display: none;" id="club_history_image<?php echo esc_attr($rand_id);?>_box" >
                          <div class="gal-active">
                            <div class="dragareamain" style="padding-bottom:0px;">
                              <ul id="gal-sortable">
                                <li class="ui-state-default" id="">
                                  <div class="thumb-secs"> <img src="" id="club_history_image<?php echo esc_attr($rand_id);?>_img" width="100" height="150"  />
                                    <div class="gal-edit-opts"> <a href="javascript:del_media('club_history_image<?php echo esc_attr($rand_id);?>')" class="delete"></a> </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        
            			<ul class='form-elements' id="cs_infobox_<?php echo esc_attr($_POST['shortcode_element'].$rand_id);?>">
                          <li class='to-label'>
                            <label><?php _e('Choose Icon','goalklub');?></label>
                          </li>
                          <li class="to-field">
                            <?php cs_fontawsome_icons_box( '' ,$_POST['shortcode_element'].$rand_id,'club_history_icon');?>
                            <div class='left-info'><p> <?php _e('Select the IcoMoon Icons you would like to add.','goalklub');?></p></div>
                          </li>
                        </ul>
                        
                        <ul class='form-elements'>
                          <li class='to-label'>
                            <label><?php _e('Year','goalklub');?></label>
                          </li>
                          <li class='to-field'>
                            <div class='input-sec'>
                              <div class='input-sec'><input class='txtfield' type='text' name='club_history_year[]' value="" /></div>
                              <div class='left-info'>
                                <p><?php _e('Enter Club History Year','goalklub');?></p>
                              </div>
                            </div>
                          </li>
                        </ul>
                        
                        <ul class='form-elements'>
                            <li class='to-label'><label><?php _e('Text','goalklub');?></label></li>
                            <li class='to-field'> <div class='input-sec'><textarea class='txtfield' data-content-text="cs-shortcode-textarea" name='club_history_text[]'></textarea></div>
                            </li>
                        </ul>
                    </div>
                <?php	
				
		 }
		    else if($_POST['shortcode_element'] == 'register'){
				 $rand_id = rand(5,999);
				?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo intval( $rand_id);?>">
                        <header><h4><i class='icon-arrows'></i><?php _e('Register','goalklub');?></h4> <a href='#' class='deleteit_node'><i class='icon-minus8-circle'></i><?php _e('Remove','goalklub');?></a></header>
                        <ul class='form-elements'>
                            <li class='to-label'><label><?php _e('Register Title','goalklub');?></label></li>
                            <li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='register_title[]' /></div>
                            </li>
                        </ul>
                        
                        <ul class='form-elements'>
                            <li class='to-label'><label><?php _e('User Role','goalklub');?></label></li>
                            <li class='to-field'> <div class="select-style"><select name='register_role[]'><option value="subscriber"><?php _e('Subscriber','goalklub');?></option><option value="staff"><?php _e('Staff','goalklub');?></option><option value="member"><?php _e('Member','goalklub');?></option><option value="instructor"><?php _e('Instructor','goalklub');?></option>
                            <option value="customer"><?php _e('Customer','goalklub');?></option><option value="contributor"><?php _e('Contributor','goalklub');?></option><option value="author"><?php _e('Author','goalklub');?></option><option value="editor"><?php _e('Editor','goalklub');?></option><option value="administrator"><?php _e('Administrator','goalklub');?></option></select></div>
                            </li>
                        </ul>
                        
                        <ul class='form-elements'>
                            <li class='to-label'><label><?php _e('Register Text','goalklub');?></label></li>
                            <li class='to-field'> <div class='input-sec'><textarea class='txtfield' data-content-text="cs-shortcode-textarea" name='register_text[]'></textarea></div>
                            </li>
                        </ul>
                    </div>
                <?php
					
		} 
			else if($_POST['shortcode_element'] == 'tabs'){
				$rand_id = rand(40, 9999999);
			?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp add_tabs  cs-pbwp-content'  id="cs_infobox_<?php echo intval( $rand_id);?>">
								<header><h4><i class='icon-arrows'></i><?php _e('Tab','goalklub');?></h4> <a href='#' class='deleteit_node'><i class='icon-minus8-circle'></i><?php _e('Remove','goalklub');?></a></header>
								<ul class='form-elements'>
									<li class='to-label'><label><?php _e('Active','goalklub');?></label></li>
									<li class='to-field'> 
                                    	<div class="select-style"><select name='tab_active[]'><option value="no"><?php _e('No','goalklub');?></option><option value="yes"><?php _e('Yes','goalklub');?></option></select></div>
                                        <div class='left-info'>
                                          <p><?php _e('You can set the section that is active here by select dropdown','goalklub');?></p>
                                        </div>
									</li>
								</ul>
								<ul class='form-elements'>
									<li class='to-label'><label><?php _e('Tab Title','goalklub');?></label></li>
									<li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='tab_title[]' /></div>
									</li>
								</ul>
                                <ul class='form-elements' id="<?php echo intval( $rand_id);?>">
                                	<li class='to-label'><label><?php _e('Choose Icon','goalklub');?></label></li>
                                	<li class="to-field">
                                        <?php cs_fontawsome_icons_box('',$rand_id,'cs_tab_icon');?>
                                        <div class='left-info'>
                                          <p><?php _e('select the IcoMoon Icons you would like to add to your menu items','goalklub');?> </p>
                                        </div>
                                	</li>
                                </ul>
                                <ul class='form-elements'>
									<li class='to-label'><label><?php _e('Tab Text','goalklub');?></label></li>
									<li class='to-field'> <div class='input-sec'><textarea class='txtfield' data-content-text="cs-shortcode-textarea" name='tab_text[]'></textarea></div>
                                    <div class='left-info'>
                                      <p><?php _e('Enter tab body content here','goalklub');?></p>
                                    </div>
									</li>
								</ul>
							</div>
                <?php	
			}
			else if($_POST['shortcode_element'] == 'testimonials'){
				 $rand_id = rand(5,999);
				?>
                    <div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content'  id="cs_infobox_<?php echo intval( $rand_id);?>">
                        <header><h4><i class='icon-arrows'></i><?php _e('Testimonial','goalklub');?></h4> <a href='#' class='deleteit_node'><i class='icon-minus8-circle'></i><?php _e('Remove','goalklub');?></a></header>
                        <ul class='form-elements'>
                            <li class='to-label'><label><?php _e('Text','goalklub');?></label></li>
                            <li class='to-field'> <div class='input-sec'><textarea class='txtfield' data-content-text="cs-shortcode-textarea" name='testimonial_text[]'></textarea></div>
                            </li>
                        </ul>
                        <ul class='form-elements'>
                            <li class='to-label'><label><?php _e('Author','goalklub');?></label></li>
                            <li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='testimonial_author[]' /></div></li>
                        </ul>
                        <ul class='form-elements'>
                            <li class='to-label'><label><?php _e('Company','goalklub');?></label></li>
                            <li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='testimonial_company[]' /></div>
                            <div class='left-info'><p><?php _e('Company Name','goalklub');?></p></div>
                            </li>
                        </ul>
                        <ul class="form-elements">
                          <li class="to-label">
                            <label><?php _e('Background Image','goalklub');?></label>
                          </li>
                          <li class="to-field">
                            <input id="testimonial_img<?php echo intval( $rand_id);?>" name="testimonial_img[]" type="hidden" class="" value=""/>
                            <input name="testimonial_img<?php echo intval( $rand_id);?>"  type="button" class="uploadMedia left" value="<?php _e('Browse','goalklub');?>"/>
                          </li>
                        </ul>
                        <div class="page-wrap" style="overflow:hidden; display:none" id="testimonial_img<?php echo intval( $rand_id);?>_box" >
                          <div class="gal-active">
                            <div class="dragareamain" style="padding-bottom:0px;">
                              <ul id="gal-sortable">
                                <li class="ui-state-default" id="">
                                  <div class="thumb-secs"> <img src=""  id="testimonial_img<?php echo intval( $rand_id);?>_img" width="100" height="150"  />
                                    <div class="gal-edit-opts"> <a   href="javascript:del_media('testimonial_img<?php echo intval( $rand_id);?>')" class="delete"></a> </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                </div>
                <?php	
			} 
			else if($_POST['shortcode_element'] == 'counter'){
				$counter_count = rand(40, 9999999);
				?>
                <div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo intval($counter_count);?>">
                        <header><h4><i class='icon-arrows'></i><?php _e('Counter','goalklub');?></h4> <a href='#' class='deleteit_node'><i class='icon-minus8-circle'></i><?php _e('Remove','goalklub');?></a></header>
                        <ul class="form-elements">
                            <li class="to-label"><label><?php _e('Counter Title','goalklub');?></label></li>
                            <li class="to-field"><input type="text"  name="counter_title[]"  class="txtfield"  /></li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label><?php _e('Type','goalklub');?></label></li>
                            <li class="to-field">
                                <div class="select-style">
                                    <select name="counter_style[]" class="dropdown" >
                                        <option value="one" ><?php _e('Counter Style One','goalklub');?></option>
                                        <option value="two" ><?php _e('Counter Style Two','goalklub');?></option>
                                        <option value="three" ><?php _e('Counter Style Three','goalklub');?></option>
                                        <option value="four" ><?php _e('Counter Style Four','goalklub');?></option>
                                     </select>
                                 </div>
                            </li>
                        </ul>
                        
                        <ul class="form-elements">
                            <li class="to-label"><label><?php _e('Choose Icon','goalklub');?></label></li>
                            <li class="to-field">
                                <div class="select-style">
                                    <select name="counter_icon_type[]" class="dropdown" onchange="cs_counter_image(this.value,'<?php echo esc_js($counter_count)?>','')">
                                        <option <?php if($counter_item->counter_icon_type=="icon")echo "selected";?> value="icon" ><?php _e('Icon','goalklub');?></option>
                                        <option <?php if($counter_item->counter_icon_type=="image")echo "selected";?> value="image" ><?php _e('Image','goalklub');?></option>
                                     </select>
                                 </div>
                            </li>
                        </ul>
                        
                        <div class="selected_icon_type" id="selected_icon_type<?php echo intval($counter_count)?>">
                        	 <ul class='form-elements' id="<?php echo intval($counter_count);?>">
								<li class='to-label'><label><?php _e('Choose Icon','goalklub');?></label></li>
								<li class="to-field">
                                     <?php cs_fontawsome_icons_box('',$counter_count,'counter_icon');?>
                            	</li>
                         </ul>
                         	<ul class="form-elements">
                                <li class="to-label"><label><?php _e('Icon Color','goalklub');?></label></li>
                                <li><input type="text"  name="icon_color[]"  class="bg_color"  /></li>
                            </ul>
                        </div>
                        <div class="selected_image_type" id="selected_image_type<?php echo intval($counter_count)?>" style="display:none">
                       		<ul class="form-elements">
                              <li class="to-label">
                                <label><?php _e('Image','goalklub');?></label>
                              </li>
                              <li class="to-field">
                                <input id="cs_counter_logo<?php echo intval($counter_count)?>" name="cs_counter_logo[]" type="hidden" class="" value=""/>
                                <input name="cs_counter_logo<?php echo intval($counter_count)?>"  type="button" class="uploadMedia left" value="<?php _e('Browse','goalklub');?>"/>
                              </li>
                            </ul>
                            <div class="page-wrap" style="overflow:hidden; display:<?php echo 'none';?>" id="cs_counter_logo<?php echo intval($counter_count)?>_box" >
                              <div class="gal-active">
                                <div class="dragareamain" style="padding-bottom:0px;">
                                  <ul id="gal-sortable">
                                    <li class="ui-state-default" id="">
                                      <div class="thumb-secs"> <img src="<?php echo cs_allow_special_char($counter_count);?>"  id="cs_counter_logo<?php echo intval($counter_count)?>_img" width="100" height="150"  />
                                        <div class="gal-edit-opts"> <a   href="javascript:del_media('cs_counter_logo<?php echo esc_js($counter_count)?>')" class="delete"></a> </div>
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
        				</div>
						
                        <ul class="form-elements">
                            <li class="to-label"><label><?php _e('Background Color','goalklub');?></label></li>
                            <li><input type="text"  name="counter_bg_color[]" class="bg_color" value="" /></li>
                        </ul>
                                        
                        <ul class="form-elements">
                            <li class="to-label"><label><?php _e('Numbers','goalklub');?></label></li>
                            <li class="to-field"><input type="text" name="counter_numbers[]" class="txtfield" value="" /></li>
                        </ul>
                      	<ul class="form-elements">
                            <li class="to-label"><label><?php _e('Count Text Color','goalklub');?></label></li>
                            <li><input type="text" name="counter_text_color[]" class="bg_color" /></li>
                        </ul>
                        
                        <ul class="form-elements">
                            <li class="to-label"><label><?php _e('Link Title','goalklub');?></label></li>
                            <li class="to-field"><input type="text" name="counter_icon_linktitle[]" class="txtfield" /></li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label><?php _e('Link','goalklub');?></label></li>
                            <li class="to-field"><input type="text" name="counter_icon_linkurl[]" class="txtfield"/></li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label><?php _e('Button Color','goalklub');?></label></li>
                            <li><input type="text"  name="counter_link_bgcolor[]" class="bg_color"  /></li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label><?php _e('Text','goalklub');?></label></li>
                            <li class="to-field"><textarea type="text" name="counter_text[]" class="txtfield" data-content-text="cs-shortcode-textarea" /><?php echo cs_allow_special_char($counter_text)?></textarea></li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label><?php _e('Custom ID','goalklub');?></label></li>
                            <li class="to-field">
                                <input type="text" name="coutner_class[]" class="txtfield"  value="" />
                            </li>
                         </ul>
                       
                        <ul class="form-elements">
                            <li class="to-label"><label><?php _e('Animation Class','goalklub');?> </label></li>
                            <li class="to-field select-style">
                                <select class="dropdown" name="coutner_animation[]">
                                    <option value=""><?php _e('Select Animation','goalklub');?></option>
                                    <?php 
									
                                        $animation_array = cs_animation_style();
                                        foreach($animation_array as $animation_key=>$animation_value){
                                            echo '<optgroup label="'.$animation_key.'">';	
                                            foreach($animation_value as $key=>$value){
                                                echo '<option value="'.$key.'" >'.$value.'</option>';
                                            }
                                        }
                                    
                                     ?>
                                  </select>
                            </li>
                        </ul>
                      
                	</div>
                <?php	} 
			else if ($_POST['shortcode_element'] == 'list'){
							$rand_id = rand(40, 9999999);
						?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo intval($rand_id);?>">
                            <header><h4><i class='icon-arrows'></i><?php _e('List Item(s)','goalklub');?></h4> <a href='#' class='deleteit_node'><i class='icon-minus8-circle'></i><?php _e('Remove','goalklub');?></a></header>
                            <ul class='form-elements'>
                                <li class='to-label'><label><?php _e('List Item','goalklub');?></label></li>
                                <li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='cs_list_item[]' data-content-text="cs-shortcode-textarea" /></div>
                                </li>
                            </ul> 
                            <ul class='form-elements' id="<?php echo intval( $rand_id);?>">
								<li class='to-label'><label><?php _e('Choose Icon','goalklub');?></label></li>
								<li class="to-field">
                                <?php cs_fontawsome_icons_box('',$rand_id,'cs_list_icon');?>
                            </li>
                         </ul>
                    </div>
                <?php	
			}  
			else if ($_POST['shortcode_element'] == 'infobox_items'){
					$rand_id = rand(40, 9999999);
				?>
                    <div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo intval( $rand_id);?>">
                            <header><h4><i class='icon-arrows'></i><?php _e('Infobox Item(s)','goalklub');?></h4>
                                <a href='#' class='deleteit_node'>
                                    <i class='icon-minus8-circle'></i><?php _e('Remove','goalklub');?>
                                </a>
                            </header>
                            
                             <ul class='form-elements' id="<?php echo intval( $rand_id);?>">
								<li class='to-label'><label><?php _e('Choose Icon','goalklub');?></label></li>
								<li class="to-field">
                                        <?php cs_fontawsome_icons_box('',$rand_id,'cs_infobox_list_icon');?>
                            </li>
                         </ul>
                         <ul class='form-elements'>
                            <li class='to-label'><label><?php _e('Icon Color','goalklub');?></label></li>
                            <li class='to-field'> <div class='input-sec'><input class='bg_color' type='text' name='cs_infobox_list_color[]' /></div>
                            </li>
                        </ul> 
                        <ul class='form-elements'>
                            <li class='to-label'><label><?php _e('Title','goalklub');?></label></li>
                            <li class='to-field'> <div class='input-sec'><input class='txtfield' type='text' name='cs_infobox_list_title[]' /></div>
                            </li>
                        </ul>
                         <ul class='form-elements'>
                            <li class='to-label'><label><?php _e('Short Description','goalklub');?></label></li>
                            <li class='to-field'> <div class='input-sec'><textarea name='cs_infobox_list_description[]' rows="8" cols="20" data-content-text="cs-shortcode-textarea" /></textarea></div>
                            </li>
                        </ul> 
                       <?php /*?> <ul class='form-elements'>
                            <li class='to-label'><label>Text Color:</label></li>
                            <li class='to-field'> <div class='input-sec'><input class='bg_color' type='text' name='cs_infobox_list_text_color[]' /></div>
                            </li>
                        </ul> <?php */?>
                    </div>
                <?php	
			} 
			else if ($_POST['shortcode_element'] == 'audio'){
				$rand_id = 'clinets_'.rand(40, 9999999);
				?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo intval( $rand_id);?>">
                        <header><h4><i class='icon-arrows'></i><?php _e('Album Item(s)','goalklub');?></h4> <a href='#' class='deleteit_node'><i class='icon-minus8-circle'></i><?php _e('Remove','goalklub');?></a></header>
                        <ul class="form-elements">
                            <li class="to-label"><label><?php _e('Track Title','goalklub');?></label></li>
                            <li class="to-field">
                                <input type="text" id="cs_album_track_title" name="cs_album_track_title[]" value="Track Title" />
                            </li>
                        </ul>
                        
                        <ul class="form-elements">
                            <li class="to-label"><label><?php _e('Track MP3 Url','goalklub');?></label></li>
                            <li class="to-field">
                                <input id="cs_album_track_mp3_url" name="cs_album_track_mp3_url[]" value="" type="text" class="small" />
                                <!--<input id="custom_media_upload" name="cs_album_track_mp3_url" type="button" class="uploadfile left" value="Browse"/>-->
                            </li>
                        </ul>
                        
                </div>
                <?php	
			}
			else if ($_POST['shortcode_element'] == 'clients'){
				$clients_count = 'clinets_'.rand(40, 9999999);
				?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo cs_allow_special_char($clients_count);?>">
                        <header><h4><i class='icon-arrows'></i><?php _e('Client','goalklub');?></h4> <a href='#' class='deleteit_node'><i class='icon-minus8-circle'></i><?php _e('Remove','goalklub');?></a></header>
                        
                        <ul class="form-elements">
                            <li class="to-label"><label><?php _e('Website Link','goalklub');?></label></li>
                            <li class="to-field">
                                <div class="input-sec"> <input type="text" id="cs_website_url" class="" name="cs_website_url[]" value="" /></div>
                                <div class="left-info"><p>e.g. http://yourdomain.com/</p></div>
                            </li>
                        </ul>
                        <ul class="form-elements">
                          <li class="to-label">
                            <label><?php _e('Client Logo','goalklub');?></label>
                          </li>
                          <li class="to-field">
                            <input id="cs_client_logo<?php echo cs_allow_special_char($clients_count)?>" name="cs_client_logo[]" type="hidden" class="" value=""/>
                            <input name="cs_client_logo<?php echo cs_allow_special_char($clients_count)?>"  type="button" class="uploadMedia left" value="<?php _e('Browse','goalklub');?>"/>
                          </li>
                        </ul>
                        <div class="page-wrap" style="overflow:hidden; display:<?php echo 'none';?>" id="cs_client_logo<?php echo cs_allow_special_char($clients_count)?>_box" >
                          <div class="gal-active">
                            <div class="dragareamain" style="padding-bottom:0px;">
                              <ul id="gal-sortable">
                                <li class="ui-state-default" id="">
                                  <div class="thumb-secs"> <img src="<?php echo cs_allow_special_char($clients_count);?>"  id="cs_client_logo<?php echo cs_allow_special_char($clients_count);?>_img" width="100" height="150"  />
                                    <div class="gal-edit-opts"> <a   href="javascript:del_media('cs_client_logo<?php echo cs_allow_special_char($clients_count)?>')" class="delete"></a> </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                </div>
                <?php	
			}
			else if ($_POST['shortcode_element'] == 'progressbars'){
				$rand_id = rand(40, 9999999);
				?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content' id="cs_infobox_<?php echo intval( $rand_id);?>">
                        <header><h4><i class='icon-arrows'></i><?php _e('Progress bars','goalklub');?></h4> <a href='#' class='deleteit_node'><i class='icon-minus8-circle'></i><?php _e('Remove','goalklub');?></a></header>
                        <ul class="form-elements">
                            <li class="to-label"><label><?php _e('Progress Bars Title','goalklub');?></label></li>
                            <li class="to-field">
                                <input type="text" name="progressbars_title[]" class="txtfield" value="" />
                            </li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label><?php _e('Skill (in percentage)','goalklub');?></label></li>
                            <li class="to-field">
                                <div class="cs-drag-slider" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value=""></div>
                                <input  class="cs-range-input"  name="progressbars_percentage[]" type="text" value=""   />
                                <p><?php _e('Set the Skill (In %)','goalklub');?></p>
                            </li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label"><label><?php _e('Progress Bars Color','goalklub');?></label></li>
                            <li class="to-field">
                                <input type="text" name="progressbars_color[]" class="bg_color" value="#000" />
                            </li>
                        </ul>
                </div>
                <?php	
			}
			else if ($_POST['shortcode_element'] == 'offerslider'){
				$offer_count = 'offer_'.rand(40, 9999999);
				?>
                	<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo intval($offer_count);?>">
                        <header><h4><i class='icon-arrows'></i><?php _e('Offer Slider Item','goalklub');?></h4> <a href='#' class='deleteit_node'><i class='icon-minus8-circle'></i><?php _e('Remove','goalklub');?></a></header>
                        <ul class="form-elements">
                          <li class="to-label">
                            <label><?php _e('Image','goalklub');?></label>
                          </li>
                          <li class="to-field">
                            <input id="cs_slider_image<?php echo intval($offer_count)?>" name="cs_slider_image[]" type="hidden" class="" value=""/>
                            <input name="cs_slider_image<?php echo intval($offer_count)?>"  type="button" class="uploadMedia left" value="<?php _e('Browse','goalklub');?>"/>
                          </li>
                        </ul>
                        <div class="page-wrap" style="overflow:hidden; display:<?php echo 'none';?>" id="cs_slider_image<?php echo intval($offer_count) ?>_box"  >
                          <div class="gal-active">
                            <div class="dragareamain" style="padding-bottom:0px;">
                              <ul id="gal-sortable">
                                <li class="ui-state-default" id="">
                                  <div class="thumb-secs"> <img src=""  id="cs_slider_image<?php echo intval($offer_count)?>_img" width="100" height="150"  />
                                    <div class="gal-edit-opts"> <a   href="javascript:del_media('cs_slider_image<?php echo esc_js($offer_count) ?>')" class="delete"></a> </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <ul class="form-elements">
                          <li class="to-label">
                            <label><?php _e('Title','goalklub');?></label>
                          </li>
                          <li class="to-field">
                            <input type="text" name="cs_slider_title[]" class="txtfield" value="" />
                          </li>
                        </ul>
                        <ul class="form-elements">
                          <li class="to-label">
                            <label><?php _e('Content(s)','goalklub');?></label>
                          </li>
                          <li class="to-field">
                            <textarea name="cs_slider_contents[]" data-content-text="cs-shortcode-textarea"></textarea>
                          </li>
                        </ul>
                        <ul class="form-elements">
                          <li class="to-label">
                            <label><?php _e('Link','goalklub');?></label>
                          </li>
                          <li class="to-field">
                            <input type="text" name="cs_readmore_link[]" class="txtfield" value="" />
                          </li>
                        </ul>
                        <ul class="form-elements">
                          <li class="to-label">
                            <label><?php _e('Link Title','goalklub');?></label>
                          </li>
                          <li class="to-field">
                            <input type="text" name="cs_offerslider_link_title[]" class="txtfield" value="" />
                          </li>
                        </ul>
                </div>
                <?php	
			}  
		}
		exit;
	}
	add_action('wp_ajax_cs_shortcode_element_ajax_call', 'cs_shortcode_element_ajax_call');
}
