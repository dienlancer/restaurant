<?php 
	/*
	 Template Name: HomePage
	 */	 
     global $zendvn_sp_settings;
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
     ?>
    <?php get_header();     ?>
    <?php if(is_active_sidebar('search-food')):?>
        <?php dynamic_sidebar('search-food')?>
    <?php endif; ?>       
    <div class="container kip">
    	<hr class="search-food-hr margin-top-45" />
    	<form name="frm-search" action="#" method="POST">
    		<div class="search-food-form margin-top-45">
    			<div><input type="text" name="q" placeholder="Tìm theo từ khoá"></div>
    			<div><center><a href="javascript:void(0);"><i class="fa fa-search" aria-hidden="true"></i>Tìm</a></center></div>
    		</div>
    	</form>	
    	<div class="margin-top-45">
    		<ul class="inline-block order">
				<li>
					<i class="icofont icofont-fast-food"></i>
					<p>Select Food</p>
				</li>
				<li>
					<i class="icofont icofont-food-basket"></i>
					<p>Order Food</p>
				</li>
				<li>
					<i class="icofont icofont-fast-delivery"></i>
					<p>Delivery or Take Out</p>
				</li>				
			</ul>
    	</div>
    	<div class="margin-top-5">
    		<div class="line"><center><img src="<?php echo site_url('wp-content/uploads/line.png',null); ?>" /></center></div>
    	</div>			
    </div>
    <?php if(is_active_sidebar('introduce')):?>
        <?php dynamic_sidebar('introduce')?>
    <?php endif; ?>   
    <?php get_footer(); ?>
    <?php wp_footer();?>
</body>
</html>