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
$google_analytics=$zendvn_sp_settings['google_analytics'];
$quantity=0; 
if(count($arrCart) > 0){
    foreach($arrCart as $cart){    
        $quantity+=(int)$cart['product_quantity'];
    }
}
?>    
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
      <!-- begin timepicker -->
      <script src="<?php echo get_template_directory_uri() . '/timepicker/jquery.timepicker.min.js'; ?>"></script>
      <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/timepicker/jquery.timepicker.min.css'; ?>" />
      <!-- end timepicker -->
      <!-- begin font-awesome -->
      <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/css/font-awesome.css'; ?>" />
      <!-- end font-awesome -->
      <!-- begin icofont -->
      <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/icofont/css/icofont.css'; ?>" />
      <!-- end icofont -->
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
      <!-- begin fancybox -->
      <script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/jquery.fancybox.min.js';?>"                 ></script>
      <link href="<?php echo get_template_directory_uri() . '/css/jquery.fancybox.min.css';?>" rel="stylesheet" type="text/css" />
      <!-- end fancybox -->
      <!-- begin tab -->
      <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/css/tab.css'; ?>" />  
      <!-- end tab-->
      <!-- begin accounting -->
      <script src="<?php echo get_template_directory_uri() . '/js/accounting.min.js'; ?>"></script>  
      <!-- end accounting -->
      <!-- begin product -->
      <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/css/product.css'; ?>" />  
      <!-- end product-->
      <!-- begin custom -->
      <script src="<?php echo get_template_directory_uri() . '/js/custom.js'; ?>"></script>    
      <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/css/template.css'; ?>" />
      <!-- end custom -->
      <?php wp_head();?>    
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $google_analytics; ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo $google_analytics; ?>');
</script>
    </head>
<body>
    
<header>    
  <div class="relative">
    <div class="canon">
      <div class="container margin-top-15 rikimaru">
        <div class="row">
          <div class="col-lg-12 no-padding">
            <div class="runoutleft">
              <ul class="inline-block list-style-none top-email">
                <li><a href="javascript:void(0);"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Email : <?php echo $email_to; ?></a></li>
                <li><a href="javascript:void(0);"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp; Phone : <?php echo $telephone; ?></a></li>
                <li><a href="<?php echo $cart_link; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp; Cart</a></li>
                <li><a href="javascript:void(0);">Giỏ hàng&nbsp;(<span class="cart-total"><?php echo $quantity; ?></span>)</a></li>
              </ul>
            </div>
            <div class="runoutright">
              <ul class="inline-block list-style-none top-email">
                <?php                                                              
                    if(empty($arrUser)){
                        ?>
                        <li><a href="<?php echo $register_member_link; ?>" ><i class="fa fa-unlock" aria-hidden="true"></i>&nbsp;Đăng ký</a></li>
                        <li><a href="<?php echo $account_link; ?>" ><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Đăng nhập</a></li>
                        <?php
                    }else{                                     
                        ?>
                        <li><a  href="<?php echo $account_link; ?>"><?php echo $arrUser["username"]; ?></a></li>
                        <li><a  href="<?php echo $security_link; ?>">Đổi mật khẩu</a></li>                                
                        <li><a  href="<?php echo $history_link; ?>">Invoice</a></li>
                        <li><a  href="<?php echo site_url() . "/index.php?action=logout"; ?>">Logout</a></li>
                        <?php                                     
                    }
                    ?>   
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
      <hr class="gach-ngang">
      <div class="container">
        <div class="row riot">
          <div class="viba-logo">
            <div class="logo">
              <center>
                <a href="<?php echo home_url(); ?>">                
                  <img src="<?php echo $customizerGlobal->general_section('site-logo');?>" />
                </a>
              </center> 
            </div>
          </div>
          <div id="smoothmainmenu" class="ddsmoothmenu">
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
              </div>             
          <?php 
                $page_id_reservation = $zController->getHelper('GetPageId')->get('_wp_page_template','reservation.php');  
                $reservation_link = get_permalink($page_id_reservation);
                ?>
                <div class="book-your-table"><a href="<?php echo $reservation_link; ?>">Book your table</a></div>
        </div>
      </div>
    </div>    
    <div class="mobilemenu">
        <div class="container">
            <div>
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>                   
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <?php     
                            $args = array( 
                                'menu'              => '', 
                                'container'         => '', 
                                'container_class'   => '', 
                                'container_id'      => '', 
                                'menu_class'        => 'nav navbar-nav', 
                                'menu_id'           => 'mobile-menu', 
                                'echo'              => true, 
                                'fallback_cb'       => 'wp_page_menu', 
                                'before'            => '', 
                                'after'             => '', 
                                'link_before'       => '', 
                                'link_after'        => '', 
                                'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',  
                                'depth'             => 3, 
                                'walker'            => '', 
                                'theme_location'    => 'mobile-menu' 
                            );
                            wp_nav_menu($args);
                            ?>             
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>    
  </div>

</header>


