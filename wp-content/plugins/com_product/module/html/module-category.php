<?php 
global $zController,$zendvn_sp_settings,$wpdb;
$vHtml=new HtmlControl();
$email_to=$zendvn_sp_settings['email_to'];
$address=$zendvn_sp_settings['address'];
$website=$zendvn_sp_settings['website'];
$telephone=$zendvn_sp_settings['telephone'];
$contaced_name=$zendvn_sp_settings['contacted_name'];
$facebook_url=$zendvn_sp_settings['facebook_url'];
$twitter_url=$zendvn_sp_settings['twitter_url'];
$google_plus=$zendvn_sp_settings['google_plus'];
$youtube_url=$zendvn_sp_settings['youtube_url'];
$instagram_url=$zendvn_sp_settings['instagram_url'];
$pinterest_url=$zendvn_sp_settings['pinterest_url'];     
$width=$zendvn_sp_settings["product_width"];    
$height=$zendvn_sp_settings["product_height"];      
$post_meta_key = "_zendvn_sp_post_";
$page_meta_key = "_zendvn_sp_page_";
$product_meta_key = "_zendvn_sp_zaproduct_";
$title=$instance["title"];
$description=$instance["description"];
$category_id=$instance["category_id"];
$items_per_page=$instance["items_per_page"];
$position=$instance["position"];
switch ($position) {
	case "all-menu":	
	$arrID=array(); 
	if((int)@$category_id==0){
		$terms = get_terms( array(
			'taxonomy' => 'za_category',
			'hide_empty' => false,  ) );	

		if(count($terms) > 0){
			foreach ($terms as $key => $value) {
				$arrID[]=$value->term_id;
			}
		}
	}else{
		$arrID[]=(int)@$category_id;
	}		
	$args = array(
		'post_type' => 'zaproduct',  
		'orderby' => 'date',
		'order'   => 'DESC',  
		'posts_per_page' => $items_per_page,        								
		'tax_query' => array(
			array(
				'taxonomy' => 'za_category',
				'field'    => 'term_id',
				'terms'    => $arrID,									
			),
		),
	);    
	
	$the_query=new WP_Query($args);				
	if($the_query->have_posts()){
		while ($the_query->have_posts()) {
			$the_query->the_post();		
			$post_id=$the_query->post->ID;							
			$permalink=get_the_permalink($post_id);
			$title=get_the_title($post_id);
			$excerpt=get_post_meta($post_id,"intro",true);
			$excerpt=substr($excerpt, 0,300).'...';			
			$featureImg=get_the_post_thumbnail_url($post_id, 'full');
			
		}
		wp_reset_postdata();  
	}
	break;				
}
?>






