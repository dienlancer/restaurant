<?php 
     global $zendvn_sp_settings,$customizerGlobal;
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
<footer class="padding-top-15 padding-bottom-45">
	<div class="container">
    <div class="row">
      <div class="col-lg-3">
       <div class="myaccountbox margin-top-15">
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
   <div class="col-lg-3">
     <div class="myaccountbox margin-top-15">
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
 <div class="col-lg-3">
   <div class="myaccountbox margin-top-15">
    <?php if(is_active_sidebar('working-time')):?>
          <?php dynamic_sidebar('working-time')?>
        <?php endif; ?>  
  </div>
</div> 
<div class="col-lg-3">
 <div class="myaccountbox margin-top-15">
  <h3>Address</h3>
  <div class="margin-top-15">
    <ul class="address">
      <li><a href="javascript:void(0);"><i class="icofont icofont-social-google-map"></i><?php echo $address; ?></a></li>
      <li><a href="javascript:void(0);"><i class="icofont icofont-phone"></i><?php echo $telephone; ?></a></li>
      <li><a href="javascript:void(0);"><i class="icofont icofont-ui-message"></i><?php echo $email_to; ?></a></li>
    </ul>   
  </div>
</div>
</div> 
<div class="clr"></div>
</div>   
<hr class="ximaxa" />
<div class="row padding-top-45">
  <div class="col-lg-3">
<center><a href="<?php echo home_url(); ?>">                
        <img src="<?php echo $customizerGlobal->general_section('site-logo');?>" />
      </a></center>
      
    
  </div>
  <div class="col-lg-6 no-padding-left">
    <div class="alex">
      <?php if(is_active_sidebar('copyright')):?>
      <?php dynamic_sidebar('copyright')?>
    <?php endif; ?>  
    </div>    
  </div>
  <div class="col-lg-3">
    <div>
      <center>
        <ul class="inline-block list-style-none top-email">                
                <li><a href="<?php echo $facebook_url; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo $twitter_url; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo $google_plus; ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo $instagram_url; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo $pinterest_url; ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo $youtube_url; ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
              </ul>
      </center>
      
    </div>
  </div>
</div>
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
