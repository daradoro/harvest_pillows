<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access







//$offset = ( $paged - 1 ) * $posts_per_page;


if(isset($_GET['keyword'])){
	
	$keyword = $_GET['keyword'];
	
	}



	
	
//echo '<pre>'.var_export(get_queried_object()).'</pre>';



if (is_category() || is_tag() || is_tax() ) {
	
	$term = get_queried_object();

	$taxonomy = $term->taxonomy;
	$terms = $term->term_id;	

	$tax_query[] = array(
						'taxonomy' => $taxonomy,
						'field'    => 'id',
						'terms'    => $terms,
												
						);
	}





//var_dump($paged);
//echo '<br />';
//var_dump($offset);
//echo '<br />';


// echo '<pre>'.var_export($query_parameter, true).'</pre>';







	$default_query = array (
			'post_type' => $post_types,
			'post_status' => $post_status,
			's' => $keyword,
			'post__not_in' => $exclude_post_id,
			'order' => $query_order,	
			'orderby' => $query_orderby,
			'meta_key' => $query_orderby_meta_key,
			'posts_per_page' => (int)$posts_per_page,
			'paged' => (int)$paged,
			'offset' => $offset,
			//'tax_query' => $tax_query,
			//'meta_query' => $meta_query,

			);
			

		
	//$query_merge = array_merge($default_query, $query_parameter);


	$wp_query = new WP_Query($default_query);




	
	
	
	
	
	
	
	
	
	
	