<?php
// Theme Options Fields
class theme_options_fields{
	
	public function __construct() {
		
	}
	/* get sub-menus */
	public function sub_menu($sub_menu=''){
		$menu_items = '';
		$active = '';
		$menu_items.='<ul class="sub-menu">';
		foreach($sub_menu as $key=>$value){
			if($key == "tab-global-setting"){
				$active = 'active';
			}else{
				$active = '';	
			}
			$menu_items.='<li class="'.$key.' '.$active.' "><a href="#'.$key.'" onClick="toggleDiv(this.hash);return false;">'.esc_attr($value).'</a></li>';
		}
		$menu_items.='</ul>';
		return  $menu_items;
	}
	public function cs_fields($options) {
		global $cs_theme_options; 
		$counter = 0;
		$cs_counter =0;
		$menu = '';
		$output = '';
		$parent_heading = '';
		$style = '';
		foreach ($options as $value) {
			$counter++;
			$val = '';
			 if ( $value['type'] != "heading" ) {
				//$output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";
			 } 
			$select_value = '';                                   
			switch ( $value['type'] ) {
				case "heading":
					$parent_heading = $value['name'];
					$menu .= '<li><a title="'.  $value['name'] .'" href="#"><i class="'.$value["fontawesome"].'"></i><span class="cs-title-menu">'. esc_attr($value['name']) .'</span></a>';
					if(is_array($value['options']) and $value['options'] <> ''){
						$menu .= $this->sub_menu($value['options']);
					}
					$menu .= '</li>';
				break;
				
				case "main-heading":
					$parent_heading = $value['name'];
					$menu .= '<li><a title="'.  $value['name'] .'" href="#'.$value['id'].'" onClick="toggleDiv(this.hash);return false;">
					<i class="'.$value["fontawesome"].'"></i><span class="cs-title-menu">'.  esc_attr($value['name']) .'</span></a>';
					$menu .= '</li>';
				break;
				
				case "sub-heading":
					$cs_counter++;
					if($cs_counter >1){
						$output .='</div>';
					}
					if($value['id'] !='tab-global-setting'){
						$style ='style="display:none;"';
					}
					
					$output .='<div id="'.$value['id'] .'" '.$style.' >';
					$output .='<div class="theme-header">
									<h1>'.$value['name'].'</h1>
							   </div>';
				break;
				case "announcement":
					$cs_counter++;
					$value['std'] = isset($value['std']) ? $value['std'] : '';
					$output.='<div id="'.$value['id'].'" class="alert alert-info fade in nomargin theme_box">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#215;</button>
										<h4>'.force_back($value['name']).'</h4>
										<p>'. force_back($value['std']).'</p>
							 </div>';
				break;
				case "section":
					$output .='<div class="theme-help">
								<h4>'.esc_attr($value['std']).'</h4>
								<div class="clear"></div>
							  </div>';
				break;
				case 'text':
					if (isset($cs_theme_options)) { 
						 if(isset($cs_theme_options[$value['id']])){ 
							$val = $cs_theme_options[$value['id']] ;}else{ $val = $value['std'];} 
					}else{
						$val = $value['std'];
					}
 					//if (isset($std)) { $val = $std; }
					$output .= '<ul class="form-elements" id="'.$value['id'].'_textfield">';
					$output .= '<li class="to-label">
									<label>'.esc_attr($value["name"]).'<span>'.esc_attr($value['hint_text']).'</span></label>
								</li>
								<li class="to-field"><input   name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $val .'" class="vsmall" />';
					$output .= '<p>'.esc_attr($value['desc']).'</p></li>';
					$output .= '</ul>';
				break;
				case 'headerbg slider':
					if (isset($cs_theme_options) and $cs_theme_options <> '') { 
						if(isset($cs_theme_options[$value['id']]) and $cs_theme_options[$value['id']] <> ''){ 
							$select_value =$cs_theme_options[$value['id']]; 
						}else{
							$select_value = $value['std'];
						}
					}else{
						$select_value = $value['std'];
					}
					
					$show = '';
					if(isset($cs_theme_options['cs_headerbg_options']) && $cs_theme_options['cs_headerbg_options']=='Revolution Slider'){
						$show = 'block';
					}else if(isset($cs_theme_options['cs_headerbg_options']) && ($cs_theme_options['cs_headerbg_options']=='None' || $cs_theme_options['cs_headerbg_options']=='Bg Image / bg Color')){
						$show='none';
					}
					$output .= '<ul class="form-elements" id="'.$value['id'].'_1" style="display:'.$show.';">';
					$output .= '<li class="to-label">
									<label>'.esc_attr($value["name"]).'<span>'.esc_attr($value['hint_text']).'</span></label>
								</li>
								<li class="to-field">
								<select  name="'. $value['id'] .'" id="'. $value['id'] .'">';
									if(class_exists('RevSlider') && class_exists('cs_RevSlider')) {
										$slider = new cs_RevSlider();
										$arrSliders = $slider->getAllSliderAliases();
										foreach ( $arrSliders as $key => $entry ) {
											$selected = '';
											 if($select_value != '') {
												 if ( $select_value == $entry['alias']) { $selected = ' selected="selected"';} 
											 } else {
												 if ( isset($value['std']) )
													 if ($value['std'] == $entry['alias']) { $selected = ' selected="selected"'; }
											 }
											$output.= '<option '.$selected.' value="'.$entry['alias'].'">'.$entry['title'].'</option>';
											
										}
									}
					$output .= '</select>';
					$output .= '<p>'.esc_attr($value['desc']).'</p></li>';
					$output .= '</ul>';

				break;
				case 'slider code':
					if (isset($cs_theme_options) and $cs_theme_options <> '') { 
						if(isset($cs_theme_options[$value['id']]) and $cs_theme_options[$value['id']] <> ''){ 
							$select_value =$cs_theme_options[$value['id']]; 
						}else{
							$select_value = $value['std'];
						}
					}else{
						$select_value = $value['std'];
					}
					$show = '';
					if($cs_theme_options['cs_default_header']=='Slider'){
						$show = 'block';
					}else if($cs_theme_options['cs_default_header']=='Breadcrumbs Sub Header' || $cs_theme_options['cs_default_header']=='No sub Header'){
						$show='none';
					}
					$output .= '<ul class="form-elements" id="'.$value['id'].'_1" style="display:'.$show.';">';
					$output .= '<li class="to-label">
									<label>'.esc_attr($value["name"]).'<span>'.esc_attr($value['hint_text']).'</span></label>
								</li>
								<li class="to-field">
								<select name="'. $value['id'] .'" id="'. $value['id'] .'" >';
									if(class_exists('RevSlider') && class_exists('cs_RevSlider')) {
										$slider = new cs_RevSlider();
										$arrSliders = $slider->getAllSliderAliases();
										foreach ( $arrSliders as $key => $entry ) {
											$selected = '';
											 if($select_value != '') {
												 if ( $select_value == $entry['alias']) { $selected = ' selected="selected"';} 
											 } else {
												 if ( isset($value['std']) )
													 if ($value['std'] == $entry['alias']) { $selected = ' selected="selected"'; }
											 }
											 $output.= '<option '.$selected.' value="'.$entry['alias'].'">'.$entry['title'].'</option>';
										}
									}
 					$output .= '</select>';
					$output .= '<p>'.esc_attr($value['desc']).'</p></li>';
					$output .= '</ul>';
 					
				break;
				case 'range':
					if (isset($cs_theme_options)) { 
						 if(isset($cs_theme_options[$value['id']])){ 
							$val = $cs_theme_options[$value['id']] ;}else{ $val = $value['std']; 
						} 
					}else{
						$val = $value['std'];
					}
					//if (isset($std)) { $val = $std; }
					$output .= '<ul class="form-elements" id="'.$value['id'].'_range">';
					$output .= '<li class="to-label">
									<label>'.esc_attr($value["name"]).'<span>'.esc_attr($value['hint_text']).'</span></label>
								</li>
								<li class="to-field">
								<div class="cs-drag-slider" data-slider-min="'.$value['min'].'" data-slider-max="'.$value['max'].'" data-slider-step="1" data-slider-value="'.$val.'">
								</div>
								<input class="cs-range-input" name="'.$value['id'].'" id="'. $value['id'] .'" type="text" value="'. $val .'" class="vsmall" />';
					$output .= '<p>'.esc_attr($value['desc']).'</p></li>';
					$output .= '</ul>';
									  
				break;
				
				case 'textarea':
					$val = $value['std'];
					$std = get_option($value['id']);
					if (isset($cs_theme_options)) { $val = $cs_theme_options[$value['id']]; }
					$output .= '<ul class="form-elements" id="'.$value['id'].'_textarea"> 
									<li class="to-label">
										<label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label>
									</li>
									<li class="to-field">
										<div class="input-sec">
											<textarea rows="10" cols="60" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'">'.wp_specialchars_decode($val).'</textarea>
										</div>
										<div class="left-info"><p>'.esc_attr($value['desc']).'</p></div>
									</li>
							  </ul>';
				break; 
				
				case 'import':
					$val = $value['std'];
					$std = get_option($value['id']);
					if (isset($std)) { $val = $std; }
					$output .= '<ul class="form-elements">
									<li class="to-label">
										<label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label>
									</li>
									<li class="to-field">
										<div class="input-sec">
											<textarea rows="10" cols="60" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" ></textarea>
										</div>
										<div class="left-info"><p>'.esc_attr($value['desc']).'</p></div>
									</li>
							  </ul>';
				break;
				
				case 'export':
					$cs_export_options = get_option('cs_theme_options');
                    if(function_exists('base_64_encode')) { $val_base_encode = base_64_encode(serialize($cs_export_options)); } else { $val_base_encode = ""; }
					$val = $value['std'];
					$std = get_option($value['id']);
					if (isset($std)) { $val = $std; }
					$output .= '<ul class="form-elements">
									<li class="to-label">
										<label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label>
									</li>
									<li class="to-field">
										<div class="input-sec">
											<textarea rows="30" cols="60" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" readonly="readonly">'.$val_base_encode.'</textarea> 
										</div>
										<div class="left-info"><p>'.esc_attr($value['desc']).'</p></div>
									</li>
							  </ul>';
				break;
				
				case "radio":
					if (isset($cs_theme_options)) { 
						$select_value = $cs_theme_options[$value['id']]; 
					}else{
					
					}	
					 foreach ($value['options'] as $key => $option) { 
						 $checked = '';
						   if($select_value != '') {
								if ( $select_value == $option) { $checked = ' checked'; } 
						   } else {
							if ($value['std'] == $option) { $checked = ' checked'; }
						   }
						$output .= '<input type="radio" name="'. $value['id'] .'" value="'. $option .'" '. $checked .' />' . $key .'<br />';
					}
				break;
				
				case "layout":
					global $header_colors;
					
		
					if (isset($cs_theme_options) and $cs_theme_options <> '') { 
						if(isset($cs_theme_options[$value['id']])){ $select_value =$cs_theme_options[$value['id']]; }
					}else{
						$select_value = $value['std'];
					}	
					 $output .= '<ul class="form-elements" id="'.$value['id'].'_layout">
									<li class="to-label">
									  <label>'.$value['name'].'<span>'.$value['hint_text'].'</span></label>
									</li>
									<li class="to-field">
										<div class="input-sec">
											<div class="meta-input pattern">';
												foreach ($value['options'] as $key => $option) {
													$checked = '';
													$custom_class='';
													if($select_value != '') {
	
														if ( $select_value == $key) { $checked = ' checked'; $custom_class='check-list';  } 
													} else {
														if ($value['std'] == $key) { $checked = ' checked';$custom_class='check-list'; }
													}
													$name=$value['id'];
													$output .= '<div class="radio-image-wrapper">
													<input name="'.$value['id'].'" class="radio" type="radio" 
													onclick=select_bg("'.$name.'","'.$key.'","'.get_template_directory_uri().'","") value="'. $key .'" 
													'. $checked .' />
													<label for="radio_'.$key.'"> 
														<span class="ss"><img src="'.get_template_directory_uri().'/include/assets/images/'.$key.'.png" /></span> 
														<span class="'.$custom_class.'" id="check-list">&nbsp;</span>
													</label>
													<span class="title-theme">' . esc_attr($option) .'</span>			
											</div>';
											
										  }
					$output.=' </div></div></li></ul>';
				break;
				case "layout1":
					global $header_colors;
					$header_counter=1;
					if (isset($cs_theme_options)) { 
						if(isset($cs_theme_options[$value['id']])){ $select_value =$cs_theme_options[$value['id']]; }
					}else{
						 $select_value = $value['std'];
					}	
					 $output .= '<ul class="form-elements" id="'.$value['id'].'_layout1">
									<li class="to-label '.$value['class'].'label_left">
									  <label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label>
									</li>
									<li class="to-field '.$value['class'].'input_right">
										<div class="input-sec">
											<div class="meta-input pattern">';
												foreach ($value['options'] as $key => $option) { 
													$checked = '';
													$custom_class='';
													if($select_value != '') {
														if ( $select_value == $option) { $checked = ' checked'; $custom_class='check-list';  } 
													} else {
														if ($value['std'] == $option) { $checked = ' checked';$custom_class='check-list'; }
													}
													$name=$value['id'];
													$output .= '<div class="radio-image-wrapper"><span class="header-counter">'.$header_counter.'</span>
													<input name="'.$value['id'].'" class="radio" type="radio" 
													onclick=select_bg("'.$name.'","'.$option.'","'.get_template_directory_uri().'","'.admin_url('admin-ajax.php').'") value="'. $option .'" 
													'. $checked .' />
													<label for="radio_'.$key.'"> 
														<span class="ss"><img src="'.get_template_directory_uri().'/include/assets/images/'.$option.'.png" /></span> 
														<span class="'.$custom_class.'" id="check-list">&nbsp;</span>
													</label>
													
												</div>';
												$header_counter++;
										  }
					$output.=' </div></div></li></ul>';
				break;
				
				case "horizontal_tab":
				if(isset($cs_theme_options['cs_layout']) and $cs_theme_options['cs_layout']<>'boxed'){
					echo '<style type="text/css"  scoped="scoped">
						.horizontal_tabs,.main_tab{display:none;
						
						}
					
					</style>';
					}
					 $output .= '<div class="horizontal_tabs"><ul>';
					 $i=0;
						foreach($value['options'] as $key=>$val){
							if($i==0){
								$active = 'active';
							}else{
								$active='';
							}
							$output .= '<li class="'.$val.' '.$active.'"><a href="#'.$val.'" onclick="show_hide(this.hash);return false;">'.$key.'</a></li>';
							 $i++;
						}
					$output.='</ul></div>';
				
				break;
				
				case "layout_body":
					global $header_colors;
					$bg_counter = 0;
					if (isset($cs_theme_options) and $cs_theme_options <> '') {
						if(isset($cs_theme_options[$value['id']])){ $select_value =$cs_theme_options[$value['id']]; }else{ $select_value = $value['std']; }
					}else{
						 $select_value = $value['std'];
					}
					if($value['path'] == "background"){
						$image_name="background";
					}else{
						$image_name ="pattern";	
					}	
 					 $output .= '<div class="main_tab"><div class="horizontal_tab" style="display:'.$value['display'].'" id="'.$value['tab'].'"><ul class="form-elements" id="'.$value['id'].'_layout_body">
									<li class="to-label '.$value['class'].'label_left">
									  <label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label>
									</li>
									<li class="to-field '.$value['class'].'input_right">
										<div class="input-sec">
											<div class="meta-input pattern">';
												foreach ($value['options'] as $key => $option) { 
													$checked = '';
													$custom_class='';
													if($select_value != '') {
														if ( $select_value == $option) { $checked = ' checked'; $custom_class='check-list';  } 
													} else {
														if ($value['std'] == $option) { $checked = ' checked';$custom_class='check-list'; }
													}
													$name=$value['id'];
													//if($bg_counter == "10") echo '<div class="sperator"></div>';
													$output .= '<div class="radio-image-wrapper">
													<input name="'.$value['id'].'" class="radio" type="radio" 
													onClick=javascript:select_bg("'.$name.'","'.$option.'","'.get_template_directory_uri().'","") value="'. $option .'" 
													'. $checked .' />
													<label for="radio_'.$key.'"> 
														<span class="ss">
														<img src="'.get_template_directory_uri().'/include/assets/images/'.$value['path'].'/'.$image_name.$bg_counter.'.png" /></span> 
														<span id="check-list" class="'.$custom_class.'">&nbsp;</span>
													</label>
												</div>';
												$bg_counter++;
										  }
					$output.=' </div></div></li></ul></div></div>';
				break;
				case 'select':
					if (isset($cs_theme_options) and $cs_theme_options <> '') { 
						if(isset($cs_theme_options[$value['id']]) and $cs_theme_options[$value['id']] <> ''){ 
							$select_value = $cs_theme_options[$value['id']]; 
						}else{
							$select_value = $value['std'];
						}
					}else{
						$select_value = $value['std'];
					}
							if($select_value=='absolute'){
									if($cs_theme_options['cs_headerbg_options']=='cs_rev_slider'){
												$output .='<style>
																#cs_headerbg_image_upload,#cs_headerbg_color_color,#cs_headerbg_image_box{ display:none;}
																#tab-header-options ul#cs_headerbg_slider_1,#tab-header-options ul#cs_headerbg_options_header{ display:block;}
															</style>';
									}else if($cs_theme_options['cs_headerbg_options']=='cs_bg_image_color'){
											$output .='<style>
															#cs_headerbg_image_upload,#cs_headerbg_color_color,#cs_headerbg_image_box{ display:block;}
															#tab-header-options ul#cs_headerbg_slider_1{ display:none; }
														</style>';
									}else{
												$output .='<style>
															#cs_headerbg_options_header{display:block;}
															#cs_headerbg_image_upload,#cs_headerbg_color_color,#cs_headerbg_image_box{ display:none;}
															#tab-header-options ul#cs_headerbg_slider_1{ display:none; }
														</style>';
									}
							}elseif($select_value=='relative'){
								$output .='<style>
												 #tab-header-options ul#cs_headerbg_slider_1,#tab-header-options ul#cs_headerbg_options_header,#tab-header-options ul#cs_headerbg_image_upload,#tab-header-options ul#cs_headerbg_color_color,#tab-header-options #cs_headerbg_image_box{ display:none;}
											  </style>';
								}
							
							
					
					$output .= ($value['id']=='cs_bgimage_position') ? '<div class="main_tab">':'';
					$select_header_bg = ($value['id']=='cs_header_position') ? 'onchange=javascript:cs_set_headerbg(this.value)':'';
					
					$output .='<ul class="form-elements" id="'.$value['id'].'_select">
								<li class="to-label"><label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label></li>
									<li class="to-field">
									<div class="input-sec">
										<div class="select-style">
										<select '.$select_header_bg.' name="'. $value['id'] .'" id="'. $value['id'] .'">';
										foreach ($value['options'] as $option) {
											$selected = '';
											 if($select_value != '') {
												 if ( $select_value == $option) { $selected = ' selected="selected"';} 
											 } else {
												 if ( isset($value['std']) )
													 if ($value['std'] == $option) { $selected = ' selected="selected"'; }
											 }
											 $output .= '<option'. $selected .' value="'.$option.'">';
											 $output .= $option;
											 $output .= '</option>';
										 } 
										 $output .= '</select></div>
													</div><div class="left-info">
													<p>'.esc_attr($value['desc']).'</p>
											</div>
										</li>
								</ul>';
						$output .=($value['id']=='cs_bgimage_position')? '</div>':'';
				break;
				
				
				case 'category':
					if (isset($cs_theme_options) and $cs_theme_options <> '') { 
						if(isset($cs_theme_options[$value['id']]) and $cs_theme_options[$value['id']] <> ''){ 
							$select_value = $cs_theme_options[$value['id']]; 
						}else{
							$select_value = $value['std'];
						}
					}else{
						$select_value = $value['std'];
					}
					
					$output .='<ul class="form-elements" id="'.$value['id'].'_select">
								<li class="to-label"><label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label></li>
									<li class="to-field">
									<div class="input-sec">
										<div class="select-style">
										<select name="'. $value['id'] .'" id="'. $value['id'] .'"><option value="">'.__('Select Category','goalklub').'</option>'.
											show_all_categories('', '',$select_value, "category").
										'</select></div>
													</div><div class="left-info">
													<p>'.esc_attr($value['desc']).'</p>
											</div>
										</li>
								</ul>';
				break;
				
				
				case 'gfont_select':
				
					if (isset($cs_theme_options) and $cs_theme_options <> '') { 
						if(isset($cs_theme_options[$value['id']]) and $cs_theme_options[$value['id']] <> ''){ 
							$select_value =$cs_theme_options[$value['id']]; 
						}else{
							$select_value = $value['std'];
						}
					}else{
						$select_value = $value['std'];
					}

					$output .= ($value['id']=='cs_bgimage_position') ? '<div class="main_tab">':'';
					$output .='<ul class="form-elements no_border" id="'.$value['id'].'_select">
								<li class="to-label"><label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label></li>
									<li class="to-field">
									<div class="input-sec">
										<div class="select-style">
										<select onchange="cs_google_font_att(\''.admin_url("admin-ajax.php").'\',this.value, \''.$value['id'].'_att\')" name="'. $value['id'] .'" id="'. $value['id'] .'">';
										$output .='<option value="default">'.__('Default Font','goalklub').'</option>';
										$i=0;
										foreach ($value['options'] as $key => $option) {
											$selected = '';
											 if($select_value != '') {
												 if ( $select_value == $key) { $selected = ' selected="selected"';} 
											 } else {
												 if ( isset($value['std']) )
													 if ($value['std'] == $key) { $selected = ' selected="selected"'; }
											 }
											 $output .= '<option'. $selected .' value="'.$option.'">';
											 $output .= $option;
											 $output .= '</option>';
											 $i++;
										 } 
										 $output .= '</select></div>
													</div><div class="left-info">
													<p>'.esc_attr($value['desc']).'</p>
											</div>
										</li>
								</ul>';
								
						$output .=($value['id']=='cs_bgimage_position')? '</div>':'';
		 
				break;
				
				case 'gfont_att_select':
					if (isset($cs_theme_options) and $cs_theme_options <> '') { 
						if(isset($cs_theme_options[$value['id']]) and $cs_theme_options[$value['id']] <> ''){ 
							$select_value =$cs_theme_options[$value['id']];
							$value['options'] = cs_get_google_font_attribute('',$cs_theme_options[str_replace('_att','',$value['id'])]);
							
						}else{
							$select_value = $value['std'];
						}
					}else{
						$select_value = $value['std'];
					}
					$output .= ($value['id']=='cs_bgimage_position') ? '<div class="main_tab">':'';
					$output .='<ul class="form-elements" id="'.$value['id'].'_select">
								<li class="to-label"><label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label></li>
									<li class="to-field">
									<div class="input-sec">
										<div class="select-style">
										<select name="'. $value['id'] .'" id="'. $value['id'] .'">
										<option value="">'.__('Select Attribute','goalklub').'</option>';
										foreach ($value['options'] as $option) {
											$selected = '';
											 if($select_value != '') {
												 if ( $select_value == $option) { $selected = ' selected="selected"';} 
											 } else {
												 if ( isset($value['std']) )
													 if ($value['std'] == $option) { $selected = ' selected="selected"'; }
											 }
											 $output .= '<option'. $selected .' value="'.$option.'">';
											 $output .= $option;
											 $output .= '</option>';
										 } 
										 $output .= '</select></div>
													</div><div class="left-info">
													<p>'.esc_attr($value['desc']).'</p>
											</div>
										</li>
								</ul>';
								
						$output .=($value['id']=='cs_bgimage_position')? '</div>':'';
		 
				break;
	  
				case 'default header':
					if (isset($cs_theme_options) and $cs_theme_options <> '') { 
						if(isset($cs_theme_options[$value['id']])){ $select_value =$cs_theme_options[$value['id']]; }
					}else{
						$select_value = $value['std'];
					}
					
					if($select_value =='Revolution Slider'){
						$output.='<style>
									#tab-sub-header-options ul,#tab-sub-header-options #cs_background_img_box{
										display:none;	
									}
									#tab-sub-header-options #cs_default_header_header,#tab-sub-header-options ul#cs_custom_slider_1{
										display:block;
									}
									</style>';
						
					}elseif($select_value =='Breadcrumbs Sub Header'){
						$output.='<style>
										#tab-sub-header-options ul,#tab-sub-header-options #cs_background_img_box{
										display:block;
									}
									#cs_custom_slider_1,#tab-sub-header-options ul#cs_header_border_color_color{
										display:none;	
									}
									
									</style>';
						}else{
							$output.='<style>
									#tab-sub-header-options ul,#tab-sub-header-options #cs_background_img_box{
										display:none;	
									}
									#tab-sub-header-options ul#cs_default_header_header,#tab-sub-header-options ul#cs_header_border_color_color{
										display:block;
									}
									</style>';
						}
					
					$output .= '<ul class="form-elements" id="'.$value['id'].'_header">
									<li class="to-label"><label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label></li>
									<li class="to-field">
									<div class="input-sec">
										<div class="select-style">
										<select onchange=javascript:cs_show_slider(this.value) name="'. $value['id'] .'" id="'. $value['id'] .'">';
										foreach ($value['options'] as $option) {
											$selected = '';
											 if($select_value != '') {
												 if ( $select_value == $option) { $selected = ' selected="selected"';} 
											 } else {
												 if ( isset($value['std']) )
													 if ($value['std'] == $option) { $selected = ' selected="selected"'; }
											 }
											 $output .= '<option'. $selected .' value="'.$option.'">';
											 $output .= $option;
											 $output .= '</option>';
										 } 
										 $output .= '</select></div>
													</div><div class="left-info">
													<p>'.esc_attr($value['desc']).'</p>
											</div>
										</li>
								</ul>';
								
				break;
				
				
				case 'select':
                    if (isset($cs_theme_options) and $cs_theme_options <> '') {
                        if (isset($cs_theme_options[$value['id']]) and $cs_theme_options[$value['id']] <> '') {
                            $select_value = $cs_theme_options[$value['id']];
                        } else {
                            $select_value = $value['std'];
                        }
                    } else {
                        $select_value = $value['std'];
                    }
                    if ($select_value == 'absolute') {
                        if ($cs_theme_options['cs_headerbg_options'] == 'cs_rev_slider') {
                            $output .='<style scoped="scoped">
																#cs_headerbg_image_upload,#cs_headerbg_color_color,#cs_headerbg_image_box{ display:none;}
																#tab-header-options ul#cs_headerbg_slider_1,#tab-header-options ul#cs_headerbg_options_header{ display:block;}
															</style>';
                        } else if ($cs_theme_options['cs_headerbg_options'] == 'cs_bg_image_color') {
                            $output .='<style scoped="scoped">
															#cs_headerbg_image_upload,#cs_headerbg_color_color,#cs_headerbg_image_box{ display:block;}
															#tab-header-options ul#cs_headerbg_slider_1{ display:none; }
														</style>';
                        } else {
                            $output .='<style scoped="scoped">
															#cs_headerbg_options_header{display:block;}
															#cs_headerbg_image_upload,#cs_headerbg_color_color,#cs_headerbg_image_box{ display:none;}
															#tab-header-options ul#cs_headerbg_slider_1{ display:none; }
														</style>';
                        }
                    } elseif ($select_value == 'relative') {
                        $output .='<style scoped="scoped">
												 #tab-header-options ul#cs_headerbg_slider_1,#tab-header-options ul#cs_headerbg_options_header,#tab-header-options ul#cs_headerbg_image_upload,#tab-header-options ul#cs_headerbg_color_color,#tab-header-options #cs_headerbg_image_box{ display:none;}
											  </style>';
                    }



                    $output .= ($value['id'] == 'cs_bgimage_position') ? '<div class="main_tab">' : '';
                    $select_header_bg = ($value['id'] == 'cs_header_position') ? 'onchange=javascript:cs_set_headerbg(this.value)' : '';

                    $output .='<ul class="form-elements" id="' . $value['id'] . '_select">
								<li class="to-label"><label>' . esc_attr($value['name']) . '<span>' . esc_attr($value['hint_text']) . '</span></label></li>
									<li class="to-field">
									<div class="input-sec">
										<div class="select-style">
										<select ' . $select_header_bg . ' name="' . $value['id'] . '" id="' . $value['id'] . '">';
                    foreach ($value['options'] as $option) {
                        $selected = '';
                        if ($select_value != '') {
                            if ($select_value == $option) {
                                $selected = ' selected="selected"';
                            }
                        } else {
                            if (isset($value['std']))
                                if ($value['std'] == $option) {
                                    $selected = ' selected="selected"';
                                }
                        }
                        $output .= '<option' . $selected . ' value="' . $option . '">';
                        $output .= $option;
                        $output .= '</option>';
                    }
                    $output .= '</select></div>
													</div><div class="left-info">
													<p>' . esc_attr($value['desc']) . '</p>
											</div>
										</li>
								</ul>';
                    $output .=($value['id'] == 'cs_bgimage_position') ? '</div>' : '';
                    break;


                case 'select_values':
                    if (isset($cs_theme_options) and $cs_theme_options <> '') {
                        if (isset($cs_theme_options[$value['id']]) and $cs_theme_options[$value['id']] <> '') {
                            $select_value = $cs_theme_options[$value['id']];
                        } else {
                            $select_value = $value['std'];
                        }
                    } else {
                        $select_value = $value['std'];
                    }

                    $output .= ($value['id'] == 'cs_bgimage_position') ? '<div class="main_tab">' : '';
                    $select_header_bg = ($value['id'] == 'cs_header_position') ? 'onchange=javascript:cs_set_headerbg(this.value)' : '';

                    $cs_search_display = '';
                    if ($value['id'] == 'cs_search_by_location') {
                        $cs_directory_location_suggestions = isset($cs_theme_options['cs_directory_location_suggestions']) ? $cs_theme_options['cs_directory_location_suggestions'] : '';
                        $cs_search_display = $cs_directory_location_suggestions == 'Website' ? 'block' : 'none';
                    }
                    if ($value['id'] == 'cs_search_by_location_city') {
                        $cs_search_by_location = isset($cs_theme_options['cs_search_by_location']) ? $cs_theme_options['cs_search_by_location'] : '';
                        $cs_search_display = $cs_search_by_location == 'single_city' ? 'block' : 'none';
                    }
                    $output .='<ul class="form-elements" id="' . $value['id'] . '_select" style="display:' . $cs_search_display . ';">
                                <li class="to-label"><label>' . esc_attr($value['name']) . '<span>' . $value['hint_text'] . '</span></label></li>
                                    <li class="to-field">
                                    <div class="input-sec">
                                        <div class="select-style">';
                    $cs_change_function = (isset($value['change']) && $value['change'] == 'yes') ? ' onchange="' . $value['id'] . '_change(this.value)"' : '';
                    $output .='<select ' . $select_header_bg . ' name="' . $value['id'] . '"' . $cs_change_function . ' id="' . $value['id'] . '">';
                    foreach ($value['options'] as $key => $option) {
                        $selected = '';
                        if ($select_value != '') {
                            if ($select_value == $key) {
                                $selected = ' selected="selected"';
                            }
                        } else {
                            if (isset($value['std']))
                                if ($value['std'] == $key) {
                                    $selected = ' selected="selected"';
                                }
                        }
                        $output .= '<option' . $selected . ' value="' . esc_html($key) . '">';
                        $output .= $option;
                        $output .= '</option>';
                    }
                    $output .= '</select></div>
                                                    </div><div class="left-info">
                                                    <p>' . esc_attr($value['desc']) . '</p>
                                            </div>
                                        </li>
                                </ul>';
                    $output .=($value['id'] == 'cs_bgimage_position') ? '</div>' : '';
                    break;

                case 'gfont_select':

                    if (isset($cs_theme_options) and $cs_theme_options <> '') {
                        if (isset($cs_theme_options[$value['id']]) and $cs_theme_options[$value['id']] <> '') {
                            $select_value = $cs_theme_options[$value['id']];
                        } else {
                            $select_value = $value['std'];
                        }
                    } else {
                        $select_value = $value['std'];
                    }

                    $output .= ($value['id'] == 'cs_bgimage_position') ? '<div class="main_tab">' : '';
                    $output .='<ul class="form-elements no_border" id="' . $value['id'] . '_select">
								<li class="to-label"><label>' . esc_attr($value['name']) . '<span>' . esc_attr($value['hint_text']) . '</span></label></li>
									<li class="to-field">
									<div class="input-sec">
										<div class="select-style">
										<select onchange="cs_google_font_att(\'' . admin_url("admin-ajax.php") . '\',this.value, \'' . $value['id'] . '_att\')" name="' . $value['id'] . '" id="' . $value['id'] . '">';
                    $output .='<option value="default">Default Font</option>';
                    $i = 0;
                    foreach ($value['options'] as $key => $option) {
                        $selected = '';
                        if ($select_value != '') {
                            if ($select_value == $key) {
                                $selected = ' selected="selected"';
                            }
                        } else {
                            if (isset($value['std']))
                                if ($value['std'] == $key) {
                                    $selected = ' selected="selected"';
                                }
                        }
                        $output .= '<option' . $selected . ' value="' . $option . '">';
                        $output .= $option;
                        $output .= '</option>';
                        $i++;
                    }
                    $output .= '</select></div>
													</div><div class="left-info">
													<p>' . esc_attr($value['desc']) . '</p>
											</div>
										</li>
								</ul>';

                    $output .=($value['id'] == 'cs_bgimage_position') ? '</div>' : '';

                    break;
				case 'default header background':
					if (isset($cs_theme_options) and $cs_theme_options <> '') { 
						if(isset($cs_theme_options[$value['id']])){ $select_value =$cs_theme_options[$value['id']]; }
					}else{
						$select_value = $value['std'];
					}
				
					 
					$output .= '<ul class="form-elements" id="'.$value['id'].'_header">
									<li class="to-label"><label>'.$value['name'].'<span>'.$value['hint_text'].'</span></label></li>
									<li class="to-field">
									<div class="input-sec">
										<div class="select-style">
										<select onchange=javascript:cs_set_headerbg(this.value) name="'. $value['id'] .'" id="'. $value['id'] .'">';
										foreach ($value['options'] as $key =>$option) {
											$selected = '';
											 if($select_value != '') {
												 if ( $select_value == $key) { $selected = ' selected="selected"';} 
											 } else {
												 if ( isset($value['std']) )
													 if ($value['std'] == $key) { $selected = ' selected="selected"'; }
											 }
											 $output .= '<option'. $selected .' value="'.$key.'">';
											 $output .= $option;
											 $output .= '</option>';
										 } 
										 $output .= '</select></div>
													</div><div class="left-info">
													<p>'.esc_attr($value['desc']).'</p>
											</div>
										</li>
								</ul>';
								
				break;				
	
				case 'default padding':
					
					if (isset($cs_theme_options) and $cs_theme_options <> '') { 
						if(isset($cs_theme_options[$value['id']])){ $select_value = $cs_theme_options[$value['id']]; }
					}else{
						$select_value = $value['std'];
					}?>						
					<?php if ($select_value == 'default') {?>
						<style type="text/css"  scoped="scoped">
							#cs_sh_paddingtop_range {
								display:none;
							}
							#cs_sh_paddingbottom_range {
								display:none;
							}
						</style>
					<?php }?>
                    <?php 
					
						
					$output .= '<ul class="form-elements" id="'.$value['id'].'_header">
									<li class="to-label"><label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label></li>
									<li class="to-field">
									<div class="input-sec">
										<div class="select-style">
										<select onchange=javascript:cs_hide_show_toggle(this.value,"theme_options","theme_options") name="'. $value['id'] .'" id="'. $value['id'] .'">';
										foreach ($value['options'] as $option) {
											$selected = '';
											 if($select_value != '') {
												 if ( $select_value == $option) { $selected = ' selected="selected"';} 
											 } else {
												 if ( isset($value['std']) )
													 if ($value['std'] == $option) { $selected = ' selected="selected"'; }
											 }
											 $output .= '<option'. $selected .' value="'.$option.'">';
											 $output .= $option;
											 $output .= '</option>';
										 } 
										 $output .= '</select></div>
													</div><div class="left-info">
													<p>'.esc_attr($value['desc']).'</p>
											</div>
										</li>
								</ul>';
		
				break;
				
				case 'select_sidebar':
					if (isset($cs_theme_options) and $cs_theme_options <> '') { 
						if(isset($cs_theme_options[$value['id']])){ $select_value =$cs_theme_options[$value['id']]; }
					}else{
						$select_value = $value['std'];
					}
					$output .= '<ul class="form-elements"><li class="to-label"><label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label></li>
									<li class="to-field">
									<div class="input-sec">
										<div class="select-style">
										<select name="'. $value['id'] .'" id="'. $value['id'] .'">';
											$output .= '<option>select sidebar</option>';
											if(is_array($value['options']['sidebar'])):
											foreach ($value['options']['sidebar'] as $option) {
												$selected = '';
												if($select_value != '') {
													if ( $select_value == $option) { $selected = ' selected="selected"';} 
												} else {
													if ( isset($value['std']) )
														 if ($value['std'] == $option) { $selected = ' selected="selected"'; 
													}
												}
												$output .= '<option '.$selected .'>';
												$output .= $option;
												$output .= '</option>';
											} 
											endif;
										$output .= '</select></div>
											</div><div class="left-info">
												<p>'.esc_attr($value['desc']).'</p>
											</div>
									</li>
								</ul>';
		 
				break;
		
				case 'mailchimp':
					if (isset($cs_theme_options) and $cs_theme_options <> '') { 
						if(isset($cs_theme_options[$value['id']])){ $select_value =$cs_theme_options[$value['id']]; }
					}else{
						$select_value = $value['std'];
					}	
					 
					$output .= '<ul class="form-elements"><li class="to-label"><label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label></li>
									<li class="to-field">
									<div class="input-sec">
										<div class="select-style">
										<select name="'. $value['id'] .'" id="'. $value['id'] .'">';
										foreach ($value['options'] as $option_key=>$option) {
											$selected = '';
											 if($select_value != '') {
												 if ( $select_value == $option_key) { $selected = ' selected="selected"';} 
											 } else {
												 if ( isset($value['std']) )
													 if ($value['std'] == $option_key) { $selected = ' selected="selected"'; }
											 }
											 $output .= '<option'. $selected .' value="'.$option_key.'">';
											 $output .= $option;
											 $output .= '</option>';
										 } 
										 $output .= '</select></div>
													</div><div class="left-info">
													<p>'.esc_attr($value['desc']).'</p>
											</div>
										</li>
								</ul>';
		 
				break;
				
				case "wpml": 
				   $saved_std = '';
				   $std = '';
				  if ( function_exists('icl_object_id') ) {
					  if (isset($cs_theme_options)) { 
						if(isset($cs_theme_options[$value['id']])){ $saved_std =$cs_theme_options[$value['id']]; }
					  }else{
						 $std = $value['std']; 
					  }
					   $checked = '';
						if(!empty($saved_std)) {
							if($saved_std == 'on') {
							$checked = 'checked="checked"';
							}
							else{
							   $checked = '';
							}
						}
						elseif( $std == 'on') {
						   $checked = 'checked="checked"';
						}
						else {
							$checked = '';
						}
						$output .= '<ul class="form-elements">
									  <li class="to-label">
									  <label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label>
									  </li>
									  <li class="to-field"><div class="input-sec"><label class="pbwp-checkbox">
									  <input type="hidden" name="'.  $value['id'] .'" value="off" />
									  <input type="checkbox" class="myClass"  name="'.  $value['id'] .'" id="'. $value['id'] .'" '. $checked .' />
									  <span class="pbwp-box"></span>
									  </label></div><div class="left-info">
										  <p>'.esc_attr($value['desc']).'</p>
									  </div></li>
									</ul>';
						
				  }
				  break;
				case "checkbox": 
				   $saved_std = '';
				   $std = '';
				  if (isset($cs_theme_options)) { 
					if(isset($cs_theme_options[$value['id']])){ $saved_std =$cs_theme_options[$value['id']]; }
				  }else{
					 $std = $value['std']; 
				  }
				   $checked = '';
					if(!empty($saved_std)) {
						if($saved_std == 'on') {
						$checked = 'checked="checked"';
						}
						else{
						   $checked = '';
						}
					}
					elseif( $std == 'on') {
					   $checked = 'checked="checked"';
					}
					else {
						$checked = '';
					}
					$output .= '<ul class="form-elements" id="'.$value['id'].'_checkbox">
								  <li class="to-label">
								  <label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label>
								  </li>
								  <li class="to-field"><div class="input-sec"><label class="pbwp-checkbox">
								  <input type="hidden" name="'.  $value['id'] .'" value="off" />
								  <input type="checkbox" class="myClass"  name="'.  $value['id'] .'" id="'. $value['id'] .'" '. $checked .' />
								  <span class="pbwp-box"></span>
								  </label></div><div class="left-info">
									  <p>'.esc_attr($value['desc']).'</p>
								  </div></li>
								</ul>';
				break;
				case "multicheck":
					$std =  $value['std'];         
					foreach ($value['options'] as $key => $option) {
					$of_key = $value['id'] . '_' . $key;
					$saved_std = get_option($of_key);
					if(!empty($saved_std)) 
					{ 
						  if($saved_std == 'true'){
							 $checked = 'checked="checked"';  
						  } 
						  else{
							  $checked = '';     
						  }    
					} 
					elseif( $std == $key) {
					   $checked = 'checked="checked"';
					}
					else {
						$checked = '';                                                                                    }
					$output .= '<input type="checkbox" name="'. $of_key .'" id="'. $of_key .'" value="true" '. $checked .' /><label for="'. $of_key .'">'. $option .'</label><br />';
												
					}
				break;
				
				case "color":
					$val = $value['std'];
					if (isset($cs_theme_options)) { 
						if(isset($cs_theme_options[$value['id']])){ $val =$cs_theme_options[$value['id']]; }
					}else{
						$std = $value['std'];
						if($std != ''){
							$val = $std;
						}
					}
					$output .= '<ul class="form-elements" id="'.$value['id'].'_color">
									<li class="to-label">
									  <label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label>
									</li>
									<li class="to-field">
									  <div class="input-sec">
									  <input type="text" name="'.$value['id'].'" id="'.$value['id'].'" value="'.$val.'" class="bg_color" data-default-color="'.$val.'" /></div>
									  <div class="left-info">
										  <p>'.esc_attr($value['desc']).'</p>
									  </div>
									</li>
								</ul>';
				break;
				case "check_color":
					$val = $value['std'];
					if (isset($cs_theme_options)) { 
						if(isset($cs_theme_options[$value['id']])){ $val =$cs_theme_options[$value['id']]; }
					}else{
						$std = $value['std'];
						if($std != ''){
							$val = $std;
						}
					}
					$check_val = '';
					if (isset($cs_theme_options)) { 
						if(isset($cs_theme_options[$value['id'].'_switch'])){ $check_val =$cs_theme_options[$value['id'].'_switch']; }
					}else{
						$check_val='off';
					}
					$checked = '';
					if($check_val == 'on') {
						$checked = 'checked="checked"';
					}
					else{
					   $checked = '';
					}
					$output .= '<ul class="form-elements" id="'.$value['id'].'_check_color">
									<li class="to-label">
									  <label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label>
									</li>
									<li class="to-field">
									  <div class="input-sec">
									  <input type="text" name="'.$value['id'].'" id="'.$value['id'].'" value="'.$val.'" class="bg_color" data-default-color="'.$val.'" />
									  <label class="pbwp-checkbox" style="float:right;margin-top:3px !important;right:60px;">
										<input type="hidden" name="'.$value['id'].'_switch" value="off" />
										<input type="checkbox" class="myClass"  name="'.$value['id'] .'_switch" id="'.$value['id'].'_switch" '. $checked .' />
										<span class="pbwp-box"></span>
									 </label> 
									  </div>
									  <div class="left-info">
										  <p>'.esc_attr($value['desc']).'</p>
									  </div>
									</li>
									
								</ul>';
				break;
				case "upload":
					$cs_counter++;
					
					if (isset($cs_theme_options) and $cs_theme_options <> '' && isset($cs_theme_options[$value['id']])) { 
						 $val =$cs_theme_options[$value['id']];
					}else{
						$val = $value['std'];
					}
					$display=($val<>''?'display':'none');
					if(isset($value['tab'])){
						$output .='<div class="main_tab"><div class="horizontal_tab" style="display:'.$value['display'].'" id="'.$value['tab'].'">';
					}
					$output .= '<ul class="form-elements" id="'.$value['id'].'_upload">
								  <li class="to-label">
									 <label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label>
								  </li>
								  <li class="to-field">
									<input id="'.$value['id'].'" name="'.$value['id'].'" type="hidden" class="" value="'.$val.'"/>
									<label class="browse-icon">
									<input name="'.$value['id'].'"  type="button" class="uploadMedia left" value="'.__('Browse','goalklub').'"/></label>
								  </li>
								</ul>';
					//if($val <> ''){			
					$output .= '<div class="page-wrap" style="overflow:hidden;display:'.$display.'" id="'.$value['id'].'_box" >
								  <div class="gal-active">
									<div class="dragareamain" style="padding-bottom:0px;">
									  <ul id="gal-sortable">
										<li class="ui-state-default" id="">
										  <div class="thumb-secs"> <img src="'.$val.'"  id="'.$value['id'].'_img"  />
											<div class="gal-edit-opts"> <a href=javascript:del_media("'.$value['id'].'") class="delete"></a> </div>
										  </div>
										</li>
									  </ul>
									</div>
								  </div>
								</div>';
					if(isset($value['tab'])){
						$output.='</div></div>';	
					}	
				break;
				case "upload logo":
					$cs_counter++;
					
					if (isset($cs_theme_options) and $cs_theme_options <> '') { 
						 $val =$cs_theme_options[$value['id']];
					}else{
						$val = $value['std'];
					}
					$display=($val<>''?'display':'none');
					if(isset($value['tab'])){
						$output .='<div class="main_tab"><div class="horizontal_tab" style="display:'.$value['display'].'" id="'.$value['tab'].'">';
					}
					$output .= '<ul class="form-elements" id="'.$value['id'].'_upload">
								  <li class="to-label">
									 <label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label>
								  </li>
								  <li class="to-field">
								  <div class="page-wrap" style="overflow:hidden;display:'.$display.'" id="'.$value['id'].'_box" >
								  <div class="gal-active">
									<div class="dragareamain" style="padding-bottom:0px;">
									  <ul id="gal-sortable">
										<li class="ui-state-default" id="">
										  <div class="thumb-secs"> <img src="'.$val.'"  id="'.$value['id'].'_img"  />
											<div class="gal-edit-opts"> <a href=javascript:del_media("'.$value['id'].'") class="delete"></a> </div>
										  </div>
										</li>
									  </ul>
									</div>
								  </div>
								</div>
									<input id="'.$value['id'].'" name="'.$value['id'].'" type="hidden" class="" value="'.$val.'"/>
									<label class="browse-icon">
									<input name="'.$value['id'].'"  type="button" class="uploadMedia left" value="'.__('Browse','goalklub').'"/></label>
								  </li>
								</ul>';
					//if($val <> ''){			
					
					if(isset($value['tab'])){
						$output.='</div></div>';	
					}
					//}
					/* $logo ='logo';
					 $output .= '<ul class="form-elements"><li class="to-label"><label>'.$value["name"].'</label></li>
								<li class="to-field"><div class="input-sec">
								<input id="'.$value['id'].'" name="'.$value['id'].'" value="'.$val.'" type="hidden" class="small {validate:{accept:\'jpg|jpeg|gif|png|bmp\'}}" />';
					$output .= '<label class="cs-browse"><input id="log" name="'.$value['id'].'" type="button" class="uploadfile left" value="Browse"/></label>
					</div><div class="left-info"><p>'.$value["desc"].'</p></div></li>';
					if($val<>''){
					$output .= "<li class='to-field'><div class='thumb-preview' id='".$value['id']."_img_div'>
					<img src='".$val."' /> <a href='#' onClick=javascript:cs_remove_image('".$value['id']."') class='del'></a> </div></li>";
					};
					$output .= "</ul>"; */
				break;
				
				case "upload font":
					$cs_counter++;
					
					if (isset($cs_theme_options) and $cs_theme_options <> '') { 
						 $val = $cs_theme_options[$value['id']];
					}else{
						$val = $value['std'];
					}
					$display=($val<>''?'display':'none');
					
					$output .= '<ul class="form-elements" id="'.$value['id'].'_upload">
								  <li class="to-label">
									 <label>'.esc_attr($value['name']).'<span>'.esc_attr($value['hint_text']).'</span></label>
								  </li>
								  <li class="to-field">
									<input id="'.$value['id'].'" name="'.$value['id'].'" type="text" class="" value="'.$val.'"/>
									<label class="browse-icon">
										<input name="'.$value['id'].'" type="button" class="uploadMedia left" value="'.__('Browse','goalklub').'"/>
									</label>
								  </li>
								</ul>';
					
				break;
								
				case 'select_dashboard':
					if (isset($cs_theme_options) and $cs_theme_options <> '') { 
						if(isset($cs_theme_options[$value['id']])){ $select_value =$cs_theme_options[$value['id']]; }
					}else{
						$select_value = $value['std'];
					}
				  $args = array(
							  'depth'            => 0,
							  'child_of'     => 0,
							  'sort_order'   => 'ASC',
							  'sort_column'  => 'post_title',
							  'show_option_none' => 'Please select a page',
							  'hierarchical' => '1',
							  'exclude'      => '',
							  'include'      => '',
							  'meta_key'     => '',
							  'meta_value'   => '',
							  'authors'      => '',
							  'exclude_tree' => '',
							  'selected'         => $select_value,
							  'echo'             => 0,
							  'name'             => $value['id'],
							  'post_type' => 'page'
						  );
					
					$output .= '<ul class="form-elements"><li class="to-label"><label>'.$value['name'].'<span>'.$value['hint_text'].'</span></label></li>
									<li class="to-field">
									<div class="select-style">'.
										wp_dropdown_pages($args)
									.'</div></li></ul>';	
					
				break;
				
				case "upload favicon":
					$val = $value['std'];
					$std = get_option($value['id']);
					
					if(isset($std)){
						$val = $std;
					}
					$output .= '<ul class="form-elements"><li class="to-label"><label>'.esc_attr($value["name"]).'<span>'.esc_attr($value['hint_text']).'</span></label></li><li class="to-field"><div class="input-sec"><input id="'.$value['id'].'" name="'.$value['id'].'" value="'.$val.'" type="hidden" />';
					$output .= '<label class="cs-browse"><input id="log" name="'.$value['id'].'" type="button" class="uploadfile left" value="'.__('Browse','goalklub').'"/><i class="icon-upload"></i></label></div></li></ul>';
					
				break;
				case "sidebar":
					$val = $value['std'];
					//$std = get_option($value['id']);
					if ( isset($cs_theme_options['sidebar']) and count($cs_theme_options['sidebar']) > 0 ) {
						$val['sidebar'] = $cs_theme_options['sidebar'];
					}
					if (isset($val['sidebar']) and count($val['sidebar']) > 0 and $val['sidebar'] <>''){
						$display ='block';
					}else{
						$display='none';	
					}
					$output .= '<ul class="form-elements">
									<li class="to-label">
										<label>'.esc_attr($value['name']).'</label>
									</li>
									<li class="to-field">
										<input class="small" type="text" name="sidebar_input" id="sidebar_input"/>
										<input type="button" value="'.__('Add Sidebar','goalklub').'" onclick="javascript:add_sidebar()" />
										<p>'.__('Please enter the desired title of sidebar','goalklub').'</p>
									</li>
								</ul>
								<div class="clear"></div>
								<div class="sidebar-area" style="display:'.$display.'">
									<div class="theme-help">
									  <h4 style="padding-bottom:0px;">'.__('Already Added Sidebars','goalklub').'</h4>
									  <div class="clear"></div>
									</div>
									<div class="boxes">
										<table class="to-table" border="0" cellspacing="0">
										<thead>
											<tr>
												<th>'.__('Side Bar Name','goalklub').'</th>
												<th class="centr">'.__('Actions','goalklub').'</th>
											</tr>
										</thead>
										<tbody id="sidebar_area">';
											if ( $display =='block' ){
												$i=1;
												foreach($val['sidebar'] as $sidebar){
													$output.='<tr id="sidebar_'.$i.'">
														<td><input type="hidden" name="sidebar[]" value="'.$sidebar.'" />'.$sidebar.'</td>
														<td class="centr"> <a class="remove-btn" onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:cs_div_remove(\'sidebar_'.$i.'\')" data-toggle="tooltip" data-placement="top" title="Remove"><i class="icon-cross3"></i></a>
													</td>
												</tr>';
											$i++;
											}
										};
										$output.='</tbody>
										</table>
									</div>
								</div>';
				break;
				case "networks":
					if (isset($cs_theme_options) and $cs_theme_options <> '') {
						
						if(!isset($cs_theme_options['social_net_awesome']) and !isset($cs_theme_options['social_net_awesome'])){
							$network_list='';
							$display='none';
						}
						else{
							$network_list = $cs_theme_options['social_net_awesome'];
							$social_net_tooltip = $cs_theme_options['social_net_tooltip'];
							$social_net_icon_path = $cs_theme_options['social_net_icon_path'];
							$social_net_url = $cs_theme_options['social_net_url'];
							$social_font_awesome_color = $cs_theme_options['social_font_awesome_color'];
							$display='block';	
						}
					}else{
						$val = $value['options'];
						$std = $value['id'];
						$display='block';
						$network_list = $val['social_net_awesome'];
						$social_net_tooltip = $val['social_net_tooltip'];
						$social_net_icon_path = $val['social_net_icon_path'];
						$social_net_url = $val['social_net_url'];
						$social_font_awesome_color = $val['social_font_awesome_color'];
					}
					$output.='<ul class="form-elements">
								<li class="to-label">
								  <label>'.__('Title','goalklub').'</label>
								  
								</li>
								<li class="to-field">
								  <input class="small" type="text" id="social_net_tooltip_input" />
								  <p>'.__('Please enter text for icon','goalklub').'</p>
								</li>
								<li class="full">&nbsp;</li>
								<li class="to-label">
								  <label>'.__('Url','goalklub').'</label>
								</li>
								<li class="to-field">
								  <input class="small" type="text" id="social_net_url_input"  />
								  <p>'.__('Please enter Full Url','goalklub').'</p>
								</li>
								<li class="full">&nbsp;</li>
								<li class="to-label">
								  <label>'.__('Icon Path','goalklub').'</label>
								</li>
								<li class="to-field">
								<div class="input-sec">
								  <input id="social_net_icon_path_input" type="hidden" class="small" onblur="javascript:update_image("social_net_icon_path_input_img_div")" />
								</div>
								  <label class="browse-icon"><input id="social_net_icon_path_input" name="social_net_icon_path_input" type="button" class="uploadMedia left" value="'.__('Browse','goalklub').'"/></label>
							   </li>
								<li style="padding: 10px 0px 20px;" class="full">
								 <ul id="cs_infobox_networks'.$counter.'">
									<li class="to-label">
									  <label>'.__('IcoMoon Icon','goalklub').'</label>
									</li>
									<li class="to-field">'.cs_fontawsome_theme_options("","networks".$counter,'social_net_awesome_input').'</li>
								 </ul>
								</li>
								
							  <li class="to-label">
								<label>'.__('Icon Color','goalklub').'<span></span></label>
							  </li>
							  <li class="to-field">
								<div class="input-sec">
								<input type="text" name="social_font_awesome_color" id="social_font_awesome_color" value="#eee" class="bg_color" data-default-color="#eee" /></div>
								<div class="left-info">
									<p></p>
								</div>
							  </li>
								
								<li class="full">&nbsp;</li>
								
								
								<li class="to-label"></li>
								<li class="to-field" style="width:100%;">
								  <input type="button" value="'.__('Add', 'goalklub').'" onclick=javascript:cs_add_social_icon("'.admin_url("admin-ajax.php").'") style="float:right;" />
								</li>
							  </ul>
							  <div class="clear"></div>
							  <div class="social-area" style="display:'.$display.'">
							  <div class="theme-help">
								<h4 style="padding-bottom:0px;">'.__('Already Added Social Icons','goalklub').'</h4>
								<div class="clear"></div>
							  </div>
							  <div class="boxes">
							  <table class="to-table" border="0" cellspacing="0">
								  <thead>
									<tr>
									  <th>'.__('Icon Path','goalklub').'</th>
									  <th>'.__('Network Name','goalklub').'</th>
									  <th>'.__('Url','goalklub').'</th>
									  <th class="centr">'.__('Actions','goalklub').'</th>
									</tr>
								  </thead>
								  <tbody id="social_network_area">';
							  $i=0;
							  if($network_list<>''){
							  foreach($network_list as $network){
								  if(isset($network_list[$i]) || isset($network_list[$i])){
									  
											  $output.='<tr id="del_'.str_replace(' ','-',$social_net_tooltip[$i]).'"><td>';
											  if(isset($network_list[$i]) and $network_list[$i]<>''){
											  $output .= '<i style="color:'.$social_font_awesome_color[$i].';" class="fa '.$network_list[$i].' fa-2x"></i>';
											  }else{
												 $output.='<img width="50" src="' .$social_net_icon_path[$i]. '">'; 
											  }
											  $output .= '</td><td>'.$social_net_tooltip[$i].'</td>';
											  $output .= '<td><a href="#">'.$social_net_url[$i].'</a></td>';
											  $output .= '<td class="centr"> 
															  <a class="remove-btn" onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:social_icon_del(\''.str_replace(' ','-',$social_net_tooltip[$i]).'\')" data-toggle="tooltip" data-placement="top" title="Remove">
															  <i class="icon-cross3"></i></a>
															  <a href="javascript:cs_toggle(\''.str_replace(' ','-',$social_net_tooltip[$i]).'\')" data-toggle="tooltip" data-placement="top" title="Edit">
																<i class="icon-pencil6"></i>
															  </a>
														  </td></tr>';
														  
											$output.='<tr id="'.str_replace(' ','-',$social_net_tooltip[$i]).'" style="display:none">
													  <td colspan="3"><div class="form-edit-area"><ul class="form-elements">
													  <li><a onclick="cs_toggle(\''.str_replace(' ','-',$social_net_tooltip[$i]).'\')" class="close-btn"><i class="icon-times"></i></a></li>
															<li class="to-label">
															<label>'.__('Title','goalklub').'</label>
														  </li>
														  <li class="to-field">
															<input class="small" type="text" id="social_net_tooltip" name="social_net_tooltip[]" value="'.$social_net_tooltip[$i].'"  />
															<p>'.__('Please enter text for icon tooltip.','goalklub').'</p>
														  </li>
														  <li class="full">&nbsp;</li>
														  <li class="to-label">
															<label>'.__('Url','goalklub').'</label>
														  </li>
														  <li class="to-field">
															<input class="small" type="text" id="social_net_url" name="social_net_url[]" value="'.$social_net_url[$i].'"/>
															<p>'.__('Please enter Full Url','goalklub').'</p>
														  </li>
														  <li class="full">&nbsp;</li>
														  <li class="to-label">
															<label>'.__('Icon Path','goalklub').'</label>
														  </li>
														  <li class="to-field">
															<input id="social_net_icon_path'.$i.'" name="social_net_icon_path[]" value="'.$social_net_icon_path[$i].'" type="text" class="small" />
															<label class="browse-icon"><input id="social_net_icon_path'.$i.'" name="social_net_icon_path'.$i.'" type="button" class="uploadMedia left" value="'.__('Browse','goalklub').'"/></label>
														  </li>
														  
														  <li class="full">&nbsp;</li>
														  <li style="padding: 0px 0px 20px;" class="full">
															 <ul id="cs_infobox_theme_options'.$i.'">
																<li class="to-label">
																  <label>'.__('IcoMoon Icon','goalklub').'</label>
																</li>
																<li class="to-field">'.cs_fontawsome_theme_options($network_list[$i],"theme_options".$i,'social_net_awesome').'																
																</li>
															 </ul>
															</li>
														  <li class="to-label">
															<label>'.__('Icon Color','goalklub').'<span></span></label>
														  </li>
														  <li class="to-field">
															<div class="input-sec">
															<input type="text" name="social_font_awesome_color[]" id="social_font_awesome_color" value="'.$social_font_awesome_color[$i].'" class="bg_color" data-default-color="'.$social_font_awesome_color[$i].'" /></div>
															<div class="left-info">
																<p></p>
															</div>
														  </li>
														</ul></div></td>
													</tr>';
									  }
								  $i++;
								 }
							  }
							  
					$output .= '</tbody></table></div></div>';
					//$output .= '<input id="log" name="'.$value['id'].'" type="button" class="uploadfile left" value="Browse"/>';
					
				break;
				case "player_fields":
					if (isset($cs_theme_options) and $cs_theme_options <> '') {
						
						if(!isset($cs_theme_options['player_fields'])){
							$player_fields='';
							$display='none';
						}
						else{
							$player_fields = $cs_theme_options['player_fields'];
							$player_field_values = $cs_theme_options['player_field_values'];
							$display='block';	
						}
					}else{
						$val = $value['options'];
						$std = $value['id'];
						$display='block';
						$player_fields = $val['player_fields'];
						$player_field_values = $val['player_field_values'];
					}
					$output.='<ul class="form-elements">
								<li class="to-label">
								  <label>'.__('Field','goalklub').'</label>
								</li>
								<li class="to-field">
								  <input class="small" type="text" id="player_field_input" />
								  <p>'.__('Please enter Player Field Name','goalklub').'</p>
								</li>
								<li class="full">&nbsp;</li>
								<li class="to-label">
								  <label>'.__('Value','goalklub').'</label>
								</li>
								<li class="to-field">
								  <input class="small" type="text" id="player_field_value_input"  />
								  <p>'.__('Please enter Player Field Value.','goalklub').'</p>
								</li>
								<li class="full">&nbsp;</li>
								
								<li class="to-label"></li>
								<li class="to-field" style="width:100%;">
								  <input type="button" value="'.__('Add', 'goalklub').'" onclick=javascript:cs_add_player_fields("'.admin_url("admin-ajax.php").'") style="float:right;" />
								</li>
							  </ul>
							  <div class="clear"></div>
							  <div class="player-fields-area" style="display:'.$display.'">
							  <div class="theme-help">
								<h4 style="padding-bottom:0px;">'.__('Already Added Fields','goalklub').'</h4>
								<div class="clear"></div>
							  </div>
							  <div class="boxes">
							  <table class="to-table" border="0" cellspacing="0">
								  <thead>
									<tr>
									  <th>'.__('Field','goalklub').'</th>
									  <th>'.__('Value','goalklub').'</th>
									</tr>
								  </thead>
								  <tbody id="cs_player_fields">';
							  $i=0;
							  if($player_fields<>''){
							  foreach($player_fields as $field){
								  if(isset($player_fields[$i]) || isset($player_fields[$i])){
									  
											  $output.='<tr id="del_'.cs_slugify_text($player_fields[$i]).'">';
											  $output .= '<td>'.$player_fields[$i].'</td>';
											  $output .= '<td>'.$player_field_values[$i].'</td>';
											  $output .= '<td class="centr"> 
															  <a class="remove-btn" onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:social_icon_del(\''.cs_slugify_text($player_fields[$i]).'\')" data-toggle="tooltip" data-placement="top" title="Remove">
															  <i class="icon-cross3"></i></a>
															  <a href="javascript:cs_toggle(\''.cs_slugify_text($player_fields[$i]).'\')" data-toggle="tooltip" data-placement="top" title="Edit">
																<i class="icon-pencil6"></i>
															  </a>
														  </td></tr>';
														  
											$output.='<tr id="'.cs_slugify_text($player_fields[$i]).'" style="display:none">
													  <td colspan="3"><ul class="form-elements">
													  <li><a onclick="cs_toggle(\''.cs_slugify_text($player_fields[$i]).'\')"><img src="'.get_template_directory_uri().'/include/assets/images/close-red.png" /></a></li>
															<li class="to-label">
															<label>'.__('Field','goalklub').'</label>
														  </li>
														  <li class="to-field">
															<input class="small" type="text" id="player_fields" name="player_fields[]" value="'.$player_fields[$i].'"  />
															<p>'.__('Please enter Player Field Name','goalklub').'</p>
														  </li>
														  <li class="full">&nbsp;</li>
														  <li class="to-label">
															<label>'.__('Value','goalklub').'</label>
														  </li>
														  <li class="to-field">
															<input class="small" type="text" id="player_field_values" name="player_field_values[]" value="'.$player_field_values[$i].'"/>
															<p>'.__('Please enter Player Field Value','goalklub').'</p>
														  </li>
														</ul></td>
													</tr>';
									  }
								  $i++;
								 }
							  }
							  
					$output .= '</tbody></table></div></div>';
					
				break;
				case "table_points_columns":
					if (isset($cs_theme_options) and $cs_theme_options <> '') {
						
						if(!isset($cs_theme_options['table_points_columns'])){
							$table_points_columns='';
							$display='none';
						}
						else{
							$table_points_columns = $cs_theme_options['table_points_columns'];
							$table_column_title1 = $cs_theme_options['table_column_title1'];
							$table_column_title2 = $cs_theme_options['table_column_title2'];
							$table_column_title3 = $cs_theme_options['table_column_title3'];
							$table_column_title4 = $cs_theme_options['table_column_title4'];
							$table_column_title5 = $cs_theme_options['table_column_title5'];
							$table_column_title6 = $cs_theme_options['table_column_title6'];
							$table_column_title7 = $cs_theme_options['table_column_title7'];
							$table_column_title8 = $cs_theme_options['table_column_title8'];
							$table_column_title9 = $cs_theme_options['table_column_title9'];
							$table_column_title10 = $cs_theme_options['table_column_title10'];
							$display='block';	
						}
					}else{
						$val = $value['options'];
						$std = $value['id'];
						$display='block';
						$table_points_columns = $cs_theme_options['table_points_columns'];
						$table_column_title1 = $cs_theme_options['table_column_title1'];
						$table_column_title2 = $cs_theme_options['table_column_title2'];
						$table_column_title3 = $cs_theme_options['table_column_title3'];
						$table_column_title4 = $cs_theme_options['table_column_title4'];
						$table_column_title5 = $cs_theme_options['table_column_title5'];
						$table_column_title6 = $cs_theme_options['table_column_title6'];
						$table_column_title7 = $cs_theme_options['table_column_title7'];
						$table_column_title8 = $cs_theme_options['table_column_title8'];
						$table_column_title9 = $cs_theme_options['table_column_title9'];
						$table_column_title10 = $cs_theme_options['table_column_title10'];
					}
					$output.='<ul class="form-elements">
								<li class="to-label">
								  <label>'.__('Column Title','goalklub').'</label>
								</li>
								<li class="to-field">
								  <input class="small" type="text" id="table_points_columns_input" />
								</li>
								<li class="full">&nbsp;</li>
								<li class="to-label">
								  <label>'.__('Table Column Title 1','goalklub').'</label>
								</li>
								<li class="to-field">
								  <input class="small" type="text" id="table_column_title1_input"  />
								</li>
								<li class="full">&nbsp;</li>
								<li class="to-label">
								  <label>'.__('Table Column Title 2','goalklub').'</label>
								</li>
								<li class="to-field">
								  <input class="small" type="text" id="table_column_title2_input"  />
								</li>
								<li class="full">&nbsp;</li>
								<li class="to-label">
								  <label>'.__('Table Column Title 3','goalklub').'</label>
								</li>
								<li class="to-field">
								  <input class="small" type="text" id="table_column_title3_input"  />
								</li>
								<li class="full">&nbsp;</li>
								<li class="to-label">
								  <label>'.__('Table Column Title 4','goalklub').'</label>
								</li>
								<li class="to-field">
								  <input class="small" type="text" id="table_column_title4_input"  />
								</li>
								<li class="full">&nbsp;</li>
								<li class="to-label">
								  <label>'.__('Table Column Title 5','goalklub').'</label>
								</li>
								<li class="to-field">
								  <input class="small" type="text" id="table_column_title5_input"  />
								</li>
								<li class="full">&nbsp;</li>
								<li class="to-label">
								  <label>'.__('Table Column Title 6','goalklub').'</label>
								</li>
								<li class="to-field">
								  <input class="small" type="text" id="table_column_title6_input"  />
								</li>
								<li class="full">&nbsp;</li>
								<li class="to-label">
								  <label>'.__('Table Column Title 7','goalklub').'</label>
								</li>
								<li class="to-field">
								  <input class="small" type="text" id="table_column_title7_input"  />
								</li>
								<li class="full">&nbsp;</li>
								<li class="to-label">
								  <label>'.__('Table Column Title 8','goalklub').'</label>
								</li>
								<li class="to-field">
								  <input class="small" type="text" id="table_column_title8_input"  />
								</li>
								<li class="full">&nbsp;</li>
								<li class="to-label">
								  <label>'.__('Table Column Title 9','goalklub').'</label>
								</li>
								<li class="to-field">
								  <input class="small" type="text" id="table_column_title9_input"  />
								</li>
								<li class="full">&nbsp;</li>
								<li class="to-label">
								  <label>'.__('Table Column Title 10','goalklub').'</label>
								</li>
								<li class="to-field">
								  <input class="small" type="text" id="table_column_title10_input"  />
								</li>
								<li class="full">&nbsp;</li>
								
								<li class="to-label"></li>
								<li class="to-field" style="width:100%;">
								  <input type="button" value="'.__('Add', 'goalklub').'" onclick=javascript:cs_add_table_columns("'.admin_url("admin-ajax.php").'") style="float:right;" />
								</li>
							  </ul>
							  <div class="clear"></div>
							  <div class="table-columns-area" style="display:'.$display.'">
							  <div class="theme-help">
								<h4 style="padding-bottom:0px;">'.__('Already Added Columns','goalklub').'</h4>
								<div class="clear"></div>
							  </div>
							  <div class="boxes">
							  <table class="to-table" border="0" cellspacing="0">
								  <thead>
									<tr>
									  <th>'.__('Column Title','goalklub').'</th>
									</tr>
								  </thead>
								  <tbody id="cs_table_columns_fields">';
							  $i=0;
							  if($table_points_columns<>''){
							  foreach($table_points_columns as $field){
								  if(isset($table_points_columns[$i])){
									  
											  $output.='<tr id="del_'.cs_slugify_text($table_points_columns[$i]).'">';
											  $output .= '<td>'.$table_points_columns[$i].'</td>';
											  $output .= '<td class="centr"> 
															  <a class="remove-btn" onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:social_icon_del(\''.cs_slugify_text($table_points_columns[$i]).'\')" data-toggle="tooltip" data-placement="top" title="Remove">
															  <i class="icon-cross3"></i></a>
															  <a href="javascript:cs_toggle(\''.cs_slugify_text($table_points_columns[$i]).'\')" data-toggle="tooltip" data-placement="top" title="Edit">
																<i class="icon-pencil6"></i>
															  </a>
														  </td></tr>';
														  
											$output.='<tr id="'.cs_slugify_text($table_points_columns[$i]).'" style="display:none">
													  <td colspan="3"><ul class="form-elements">
													  <li><a onclick="cs_toggle(\''.cs_slugify_text($table_points_columns[$i]).'\')"><img src="'.get_template_directory_uri().'/include/assets/images/close-red.png" /></a></li>
														  <li class="to-label">
															<label>'.__('Column Title','goalklub').'</label>
														  </li>
														  <li class="to-field">
															<input class="small" type="text" id="table_points_columns" name="table_points_columns[]" value="'.$table_points_columns[$i].'"  />
														  </li>
														  <li class="full">&nbsp;</li>
														  <li class="to-label">
															<label>'.__('Table Column Title 1','goalklub').'</label>
														  </li>
														  <li class="to-field">
															<input class="small" type="text" id="table_column_title1" name="table_column_title1[]" value="'.$table_column_title1[$i].'"/>
														  </li>
														  <li class="full">&nbsp;</li>
														  <li class="to-label">
															<label>'.__('Table Column Title 2','goalklub').'</label>
														  </li>
														  <li class="to-field">
															<input class="small" type="text" id="table_column_title2" name="table_column_title2[]" value="'.$table_column_title2[$i].'"/>
														  </li>
														  <li class="full">&nbsp;</li>
														  <li class="to-label">
															<label>'.__('Table Column Title 3','goalklub').'</label>
														  </li>
														  <li class="to-field">
															<input class="small" type="text" id="table_column_title3" name="table_column_title3[]" value="'.$table_column_title3[$i].'"/>
														  </li>
														  <li class="full">&nbsp;</li>
														  <li class="to-label">
															<label>'.__('Table Column Title 4','goalklub').'</label>
														  </li>
														  <li class="to-field">
															<input class="small" type="text" id="table_column_title4" name="table_column_title4[]" value="'.$table_column_title4[$i].'"/>
														  </li>
														  <li class="full">&nbsp;</li>
														  <li class="to-label">
															<label>'.__('Table Column Title 5','goalklub').'</label>
														  </li>
														  <li class="to-field">
															<input class="small" type="text" id="table_column_title5" name="table_column_title5[]" value="'.$table_column_title5[$i].'"/>
														  </li>
														  <li class="full">&nbsp;</li>
														  <li class="to-label">
															<label>'.__('Table Column Title 6','goalklub').'</label>
														  </li>
														  <li class="to-field">
															<input class="small" type="text" id="table_column_title6" name="table_column_title6[]" value="'.$table_column_title6[$i].'"/>
														  </li>
														  <li class="full">&nbsp;</li>
														  <li class="to-label">
															<label>'.__('Table Column Title 7','goalklub').'</label>
														  </li>
														  <li class="to-field">
															<input class="small" type="text" id="table_column_title7" name="table_column_title7[]" value="'.$table_column_title7[$i].'"/>
														  </li>
														  <li class="full">&nbsp;</li>
														  <li class="to-label">
															<label>'.__('Table Column Title 8','goalklub').'</label>
														  </li>
														  <li class="to-field">
															<input class="small" type="text" id="table_column_title8" name="table_column_title8[]" value="'.$table_column_title8[$i].'"/>
														  </li>
														  <li class="full">&nbsp;</li>
														  <li class="to-label">
															<label>'.__('Table Column Title 9','goalklub').'</label>
														  </li>
														  <li class="to-field">
															<input class="small" type="text" id="table_column_title9" name="table_column_title9[]" value="'.$table_column_title9[$i].'"/>
														  </li>
														  <li class="full">&nbsp;</li>
														  <li class="to-label">
															<label>'.__('Table Column Title 10','goalklub').'</label>
														  </li>
														  <li class="to-field">
															<input class="small" type="text" id="table_column_title10" name="table_column_title10[]" value="'.$table_column_title10[$i].'"/>
														  </li>
														</ul></td>
													</tr>';
									  }
								  $i++;
								 }
							  }
							  
					$output .= '</tbody></table></div></div>';
					
				break;
				$output .= '</div>';
			} 
			// if TYPE is an array, formatted into smaller inputs... ie smaller values
		}
		$output .= '</div>';
		//update_option('cs_theme_reset',$reset_data);
		return array($output,$menu);
	 }
	
}