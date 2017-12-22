<?php 
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
<footer class="padding-top-45 padding-bottom-45">
	<div class="container">
   <div class="col-lg-3 no-padding-left">
     <div class="myaccountbox">
      <h3>My account</h3>
       <div class="margin-top-15">
         <?php     
         $args = array( 
          'menu'              => '', 
          'container'         => '', 
          'container_class'   => '', 
          'container_id'      => '', 
          'menu_class'        => 'myaccountmenu', 
          'menu_id'           => 'myaccount-menu', 
          'echo'              => true, 
          'fallback_cb'       => 'wp_page_menu', 
          'before'            => '', 
          'after'             => '', 
          'link_before'       => '', 
          'link_after'        => '', 
          'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',  
          'depth'             => 3, 
          'walker'            => '', 
          'theme_location'    => 'myaccount-menu' 
        );
         wp_nav_menu($args);
         ?>   
         <div class="clr"></div> 
       </div>
     </div>
   </div> 
   <div class="col-lg-3 no-padding-left">
     <div class="myaccountbox">
      <h3>Information</h3>
       <div class="margin-top-15">
         <?php     
         $args = array( 
          'menu'              => '', 
          'container'         => '', 
          'container_class'   => '', 
          'container_id'      => '', 
          'menu_class'        => 'myaccountmenu', 
          'menu_id'           => 'information-menu', 
          'echo'              => true, 
          'fallback_cb'       => 'wp_page_menu', 
          'before'            => '', 
          'after'             => '', 
          'link_before'       => '', 
          'link_after'        => '', 
          'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',  
          'depth'             => 3, 
          'walker'            => '', 
          'theme_location'    => 'information-menu' 
        );
         wp_nav_menu($args);
         ?>   
         <div class="clr"></div> 
       </div>
     </div>
   </div> 
   <div class="col-lg-3 no-padding-left">
     <div class="myaccountbox">
      <h3>Working time</h3>
       <div class="margin-top-30">
        <font color="#ffffff">
          <?php if(is_active_sidebar('working-time')):?>
            <?php dynamic_sidebar('working-time')?>
          <?php endif; ?>  
        </font>         
       </div>
     </div>
   </div> 
   <div class="col-lg-3 no-padding-left"></div> 
 </div>
</footer>
<div class="modal fade modal-add-cart" id="modal-alert-add-cart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header relative">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
      </div>
      <div class="modal-body">

      </div>      
    </div>
  </div>
</div>
