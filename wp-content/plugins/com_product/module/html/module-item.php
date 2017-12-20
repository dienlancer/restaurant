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
if(!empty($instance['item_id'])){
	$arrItemID=explode(",",$instance["item_id"]);
	$title=$instance["title"];
	$description=$instance["description"];
	$position=$instance["position"];
	if(count($arrItemID) > 0){
		switch ($position) {
			case "slideshow":			
			?>
			<script type="text/javascript" language="javascript">        
				jQuery(document).ready(function(){
					jQuery(".slick-slideshow").slick({
						dots: true,
						autoplay:false,
						arrows:false,
						adaptiveHeight:true
					});  
				});     
			</script>
			<div class="slick-slideshow">
				<?php 
				for($i=0;$i<count($arrItemID);$i++) {
					$table = $wpdb->prefix . 'shk_banner';	
					$sql = 'SELECT 	* FROM 	'.$table.' AS p  WHERE 	p.id = '.(int)@$arrItemID[$i] ;
					$result = $wpdb->get_results($sql,ARRAY_A);
					$banner=site_url('/wp-content/uploads/'.$result[0]['image']);
					$link_web=$result[0]['link_web'];
					?>			
					<div><a href="<?php echo $link_web; ?>" target="_blank"><img src="<?php echo $banner; ?>" /></a></div>  
					<?php						
				}
				?>				
			</div>
			<?php
			break;	
			case "banner-page":		
			foreach ($arrItemID as $key => $value) {
				if(!empty($value)){
					$args = array(  		
						'p' => 	(int)@$value,			
						'post_type' => 'page'
					);			
					$the_query = new WP_Query($args);		
					if($the_query->have_posts()){		
						?>
						<div class="logo-banner">
							<div class="container kip">
								<?php 
								while ($the_query->have_posts()) {
									$the_query->the_post();		
									$post_id=$the_query->post->ID;							
									$permalink=get_the_permalink($post_id);
									$title=get_the_title($post_id);
									$excerpt=get_post_meta($post_id,"intro",true);
									$excerpt=substr($excerpt, 0,300).'...';			
									$featureImg=get_the_post_thumbnail_url($post_id, 'full');
									?>
									<div><img src="<?php echo site_url("wp-content/uploads/logo-banner.png"); ?>" /></div>
									<div class="lobo-banner-title"><?php echo $title; ?></div>
									<div class="logo-banner-excerpt"><center><?php echo $excerpt; ?></center></div>
									<?php
								}
								wp_reset_postdata();  
								?>      		
							</div>										
						</div>				
						<?php						
					}
				}				
			}
			break;
		}
	}	
}
?>






