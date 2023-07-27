<?php 
/**
 * File Type: Point Table Templates Class
 */
 

if ( !class_exists('CS_PointTableTemplates') ) {
	
	class CS_PointTableTemplates
	{
		
		function __construct()
		{
			// Constructor Code here..
		}
	
		//======================================================================
		// Point Table View
		//======================================================================
		public function cs_point_table_view($atts, $cs_point_table_num_post) {
			
			global $post, $cs_theme_options;
			
			$cs_point_table = get_post_meta(get_the_ID(), "pointtable", true);
			if ( $cs_point_table <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($cs_point_table);
				$cs_pointtable_records_per_post = $cs_xmlObject->cs_pointtable_records_per_post;
				$cs_pointtable_view_all = $cs_xmlObject->cs_pointtable_view_all;
				$cs_pointtable_set = $cs_xmlObject->cs_pointtable_set;
				
			} else {
				$cs_pointtable_records_per_post = '';
				$cs_pointtable_view_all = '';
				$cs_pointtable_set = '';
				
				if(!isset($cs_xmlObject))
					$cs_xmlObject = new stdClass();
			}
			
			if ( isset($cs_xmlObject->point_tables) and is_object($cs_xmlObject) and count($cs_xmlObject->point_tables)>0 ) {	
			?>
            <table class="table table-condensed table_D3D3D3">
                <thead>
                    <tr>
                    <?php 
					if(isset($cs_theme_options['table_points_columns']) and is_array($cs_theme_options['table_points_columns']) and $cs_theme_options['table_points_columns'] <> ''){
						$point_table_i = 0;
						foreach ( $cs_theme_options['table_points_columns'] as $table_points_column ){
							if($table_points_column == $cs_pointtable_set){
								break;
							}
							$point_table_i++;
						}
                        echo '<th>
                                <span class="box1">#</span>
                              </th>';
                        						
                        $count_columns = 1;
                        for ( $colum_title = 1; $colum_title < 11; $colum_title++ ){
							$table_heads = isset($cs_theme_options['table_column_title'.$colum_title][$point_table_i]) ? $cs_theme_options['table_column_title'.$colum_title][$point_table_i] : '';
                            if(isset($table_heads) && $table_heads <> ''){
                                ?>
                                    <th>
                                        <span class="box1">
                                            <?php echo cs_allow_special_char($table_heads);?>
                                        </span>
                                    </th>
                                <?php
								$count_columns++;
                            }
							
                        }
                    }
					?>
                    </tr>
                 </thead>
                 <tbody>
                  <?php
				  if ( isset($cs_xmlObject->point_tables) && is_object($cs_xmlObject) && count($cs_xmlObject->point_tables)>0 ) {
					  
					  if ( isset($count_columns) ){
						  
					  $cs_point_table_num_post = (int)$cs_point_table_num_post+1;
						  $pointtable_counter_abc = 1;
						  foreach ( $cs_xmlObject->point_tables as $point_table ){
							   
							   $point_table_column_title = array();
							   $point_table_column_title[] = $point_table->point_table_column_title1;
							   $point_table_column_title[] = $point_table->point_table_column_title2;
							   $point_table_column_title[] = $point_table->point_table_column_title3;
							   $point_table_column_title[] = $point_table->point_table_column_title4;
							   $point_table_column_title[] = $point_table->point_table_column_title5;
							   $point_table_column_title[] = $point_table->point_table_column_title6;
							   $point_table_column_title[] = $point_table->point_table_column_title7;
							   $point_table_column_title[] = $point_table->point_table_column_title8;
							   $point_table_column_title[] = $point_table->point_table_column_title9;
							   $point_table_column_title[] = $point_table->point_table_column_title10;
							   $point_table_column_title[] = $point_table->point_table_column_title11;
							   $point_table_column_feature = $point_table->point_table_column_feature;
							   
							   $featured_class = '';
							   if($point_table_column_feature == 'Yes'){
								   $featured_class = ' class="cs-feature"';
							   }
							   
							   echo '<tr'.$featured_class.'><td>'.$pointtable_counter_abc.'</td>';
								  for($count_columns_data = 0; $count_columns_data < ($count_columns-1); $count_columns_data++){
									  $points_table_data_value = $point_table_column_title[$count_columns_data];
									  if(isset($points_table_data_value) && $points_table_data_value <> ''){
										  echo '<td>'.$points_table_data_value.'</td>';
									  } else {
										  echo '<td>-</td>';
									  }
								  }
							  echo '</tr>';

							  $pointtable_counter_abc++;

							  
							  
							  if($cs_point_table_num_post == $pointtable_counter_abc)

								  break;
							  
							  if($cs_pointtable_records_per_post <> '' && $cs_pointtable_records_per_post <> 0 && $cs_pointtable_records_per_post < $pointtable_counter_abc){
								  break;  
							  }
						  }
					  }
					  //------------ 
                  }
                 ?>
                 </tbody>
                 <?php if($cs_pointtable_view_all <> '' and isset($count_columns)){ ?>
                 <tfoot>
                 <tr>
                    <td colspan="<?php echo intval($count_columns+1);?>"> 
                        <!--<a href="<?php //  echo esc_url($cs_pointtable_view_all); ?>">-->
                            <!--<i class="icon-list3"></i>-->
						 <?php // _e("View All",'goalklub'); ?>
                        </a>
                    </td>
                </tr>
                </tfoot>
                <?php } ?>
            </table>
            <?php
			}
			
		}
		//====== (: END END :) ======//
				
	}
}