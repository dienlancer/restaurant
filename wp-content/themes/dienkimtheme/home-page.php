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
    <?php get_footer(); ?>
    <?php wp_footer();?>
</body>
</html>