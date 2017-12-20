<!DOCTYPE html>
<?php 
global $customizerGlobal;
?>
<html <?php language_attributes();?>>
<head>
    <meta charset="<?php bloginfo('charset')?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php 
        wp_title('|', true,'right');
        bloginfo('name');
        ?>
    </title>    
    <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri() . '/';?>js/html5.js" type="text/javascript"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <script src="<?php echo get_template_directory_uri() . '/js/jquery-3.2.1.js'; ?>"></script>
  <!--begin bootstrap-->
  <script src="<?php echo get_template_directory_uri() . '/js/bootstrap.js'; ?>"></script>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/css/bootstrap.css'; ?>" />
  <!--end bootstrap-->
  <!-- begin jquery-ui -->
  <script src="<?php echo get_template_directory_uri() . '/jquery-ui/jquery-ui.min.js'; ?>"></script>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/jquery-ui/jquery-ui.css'; ?>" />
  <!-- end jquery-ui -->
  <!-- begin font-awesome -->
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/css/font-awesome.css'; ?>" />
  <!-- end font-awesome -->
  <!-- begin youtube -->
  <script src="<?php echo get_template_directory_uri() . '/js/jquery.youtubepopup.min.js'; ?>"></script>  
  <!-- end youtube -->
  <!-- begin ddsmoothmenu -->
  <script src="<?php echo get_template_directory_uri() . '/js/ddsmoothmenu.js'; ?>"></script>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/css/ddsmoothmenu.css'; ?>" />
  <!-- end ddsmoothmenu -->
  <!-- begin slick slider -->
  <script src="<?php echo get_template_directory_uri() . '/slick/slick.min.js'; ?>"></script>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/slick/slick.css'; ?>" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/slick/slick-theme.css'; ?>" />
  <!-- end slick slider -->
  <!-- begin owl_carousel -->
  <script src="<?php echo get_template_directory_uri() . '/owl-carousel/owl.carousel.js'; ?>"></script>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/owl-carousel/assets/owl.carousel.css'; ?>" />  
  <!-- end owl_carousel -->
  <!-- begin elevatezoom -->
  <script src="<?php echo get_template_directory_uri() . '/js/jquery.elevatezoom-3.0.8.min.js'; ?>"></script>  
  <!-- end elevatezoom -->
  <!-- begin tab -->
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/css/tab.css'; ?>" />  
  <!-- end tab-->
  <!-- begin accounting -->
  <script src="<?php echo get_template_directory_uri() . '/js/accounting.min.js'; ?>"></script>  
  <!-- end accounting -->
  <!-- begin tab -->
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/css/product.css'; ?>" />  
  <!-- end tab-->
  <!-- begin custom -->
  <script src="<?php echo get_template_directory_uri() . '/js/custom.js'; ?>"></script>    
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/css/template.css'; ?>" />
  <!-- end custom -->
    <?php wp_head();?>    
    
</head>
<body>
    <?php
/*require_once get_template_directory()."/check-page.php";
new CheckPage();*/ 
global $zController,$zendvn_sp_settings;
$zController->getController("/frontend","ProductController");
$page_id_register_member = $zController->getHelper('GetPageId')->get('_wp_page_template','register-member.php');  
$page_id_account = $zController->getHelper('GetPageId')->get('_wp_page_template','account.php');
$page_id_security = $zController->getHelper('GetPageId')->get('_wp_page_template','security.php');  
$page_id_history = $zController->getHelper('GetPageId')->get('_wp_page_template','history.php');  
$page_id_cart = $zController->getHelper('GetPageId')->get('_wp_page_template','zcart.php');   
$page_id_search = $zController->getHelper('GetPageId')->get('_wp_page_template','search.php');          
$register_member_link = get_permalink($page_id_register_member);
$account_link = get_permalink($page_id_account);
$security_link=get_permalink($page_id_security);
$history_link=get_permalink($page_id_history );
$cart_link=get_permalink($page_id_cart );
$search_link = get_permalink($page_id_search);  
$ssName="vmuser";
$ssNameCart="vmart";
$ssValue="userlogin";
$ssValueCart="zcart";
$arrUser=array();
$ssUser     = $zController->getSession('SessionHelper',$ssName,$ssValue);
$ssCart     = $zController->getSession('SessionHelper',$ssNameCart,$ssValueCart);
$arrUser = @$ssUser->get($ssValue)["userInfo"];
$arrCart = @$ssCart->get($ssValueCart)["cart"];   
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
$quantity=0; 
if(count($arrCart) > 0){
    foreach($arrCart as $cart){    
        $quantity+=(int)$cart['product_quantity'];
    }
}
?>    
<header>    
  <div class="relative">
    <div class="canon">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 no-padding">
            <div class="runoutleft">
              <ul class="inline-block list-style-none top-email">
                <li><a href="javascript:void(0);"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Email : <?php echo $email_to; ?></a></li>
                <li><a href="javascript:void(0);"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp; Phone : <?php echo $telephone; ?></a></li>
                <li><a href="<?php echo $cart_link; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp; Cart</a></li>
              </ul>
            </div>
            <div class="runoutright">
              <ul class="inline-block list-style-none top-email">
                <li><a href="<?php echo $account_link; ?>"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;My account</a></li>
                <li><a href="<?php echo $facebook_url; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo $twitter_url; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo $google_plus; ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo $instagram_url; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo $pinterest_url; ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo $youtube_url; ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <hr class="gach-ngang"></hr>
      <div class="container">
        <div class="row flex-center-middle">
          <div class="col-lg-2 no-padding">
            <div class="logo">
              <center>
                <a href="<?php echo home_url(); ?>">                
                  <img src="<?php echo $customizerGlobal->general_section('site-logo');?>" />
                </a>
              </center> 
            </div>
          </div>
          <div class="col-lg-10 no-padding ">
            <div class="menu flex-center-middle">
              <div class="col-lg-9 no-padding"><div id="smoothmainmenu" class="ddsmoothmenu">
                <?php     
                $args = array( 
                  'menu'              => '', 
                  'container'         => '', 
                  'container_class'   => '', 
                  'container_id'      => '', 
                  'menu_class'        => 'mainmenu', 
                  'menu_id'           => 'main-menu', 
                  'echo'              => true, 
                  'fallback_cb'       => 'wp_page_menu', 
                  'before'            => '', 
                  'after'             => '', 
                  'link_before'       => '', 
                  'link_after'        => '', 
                  'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',  
                  'depth'             => 3, 
                  'walker'            => '', 
                  'theme_location'    => 'main-menu' 
                );
                wp_nav_menu($args);
                ?>   
                <div class="clr"></div>
              </div>             
            </div>
              <div class="col-lg-3 no-padding ">
                <div class="book-your-table"><a href="javascript:void(0);">Book your table</a></div>
              </div>                    
            </div>        
          </div>
        </div>
      </div>
    </div>
    <?php if(is_active_sidebar('slideshow')):?>
        <?php dynamic_sidebar('slideshow')?>
    <?php endif; ?>
  </div>
</header>


