<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access

class class_post_grid_shortcodes{
	
	
    public function __construct(){
		
		add_shortcode( 'post_grid', array( $this, 'post_grid_display' ) );

    }
	

	
	
	public function post_grid_display($atts, $content = null ) {
		
/*

			static $w4dev_custom_loop;
			if( !isset($w4dev_custom_loop) ){
				$w4dev_custom_loop = 1;
				}
				
			else{
				$w4dev_custom_loop ++;
				}

*/
				
		
		
			$atts = shortcode_atts(
				array(
					'id' => "",
					///'paging'=> 'pg'. $w4dev_custom_loop,
					), $atts);
	
				$html  = '';
				$post_id = $atts['id'];

/*

				$paging = $atts['paging'];
				unset( $atts['paging'] );

*/


				
				
				//var_dump($w4dev_custom_loop);





				include post_grid_plugin_dir.'/grid-items/variables.php';
				
				


/*

				if( isset($_GET[$paging]) ){
					$paged = (int)$_GET[$paging];
					
					}
					
				else{
					$paged = 1;
					}


*/
					


				
				
				include post_grid_plugin_dir.'/grid-items/query.php';
				include post_grid_plugin_dir.'/grid-items/custom-css.php';				
				//include post_grid_plugin_dir.'/grid-items/lazy.php';					
				

					
	
					
					
				
			$html.='<div class="post-grid-debug"></div>';  // .debug		

				$html.='<div id="post-grid-'.$post_id.'" class="post-grid">';

				if ( $wp_query->have_posts() ) :
				
				$html.='<div class="grid-nav-top">';	
				include post_grid_plugin_dir.'/grid-items/nav-top.php';							
				$html.='</div>';  // .grid-nav-top	
				
				$html.='<div class="grid-items" id="">';
				
				
				$odd_even = 0;
				
				while ( $wp_query->have_posts() ) : $wp_query->the_post();


				if($odd_even%2==0){
					$odd_even_calss = 'even';
					}
				else{
					$odd_even_calss = 'odd';
					}
				$odd_even++;
				
				$html.='<div  class="item mix skin '.$odd_even_calss.' '.$skin.' '.post_grid_term_slug_list(get_the_ID()).'">';

				include post_grid_plugin_dir.'/grid-items/layer-media.php';
				include post_grid_plugin_dir.'/grid-items/layer-content.php';
				include post_grid_plugin_dir.'/grid-items/layer-hover.php';	
				
				$html.='</div>';  // .item		
				
				endwhile;
				wp_reset_query();
				$html.='</div>';  // .grid-items	
				
				$html.='<div class="grid-nav-bottom">';	
							include post_grid_plugin_dir.'/grid-items/nav-bottom.php';
				$html.='</div>';  // .grid-nav-bottom	
				
				//wp_reset_query();
				else:
				$html.='<div class="no-post-found">';
				$html.=__('No Post found',post_grid_textdomain);  // .item	
				$html.='</div>';  // .item					
				
				endif;
				
				//include post_grid_plugin_dir.'/grid-items/scripts.php';	
				
				
				$html.='</div>';  // .post-grid
	
				if($masonry_enable=='yes'){
					$html .= '<script>jQuery(window).load(function(){jQuery("#post-grid-'.$post_id.' .grid-items").masonry({isFitWidth: true}); });</script>';	
					}

				


				return $html;
	
	
	}


	
	
	
	}

new class_post_grid_shortcodes();