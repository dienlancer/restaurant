<?php
require_once get_template_directory() . DS . 'inc'.DS.'customizer.php';

global $customizerGlobal;
$customizerGlobal = new CustomizerControl();
add_filter( 'nav_menu_link_attributes', 'wp_nav_menu_link', 10, 3 );
function wp_nav_menu_link( $atts, $item, $args ) {	
	if(in_array("current-menu-item", $item->classes)){
		$class = 'active'; 
    	$atts['class'] = $class;    
	}
    return $atts;
}
add_action('init', 'zendvn_theme_register_menus');
function zendvn_theme_register_menus(){
	register_nav_menus(
		array(						
			'main-menu' 			=> __('MainMenu'),
			'mobile-menu' 			=> __('MobileMenu'),					
			'myaccount-menu' 			=> __('MyAccountMenu'),			
			'information-menu' 			=> __('InformationMenu'),			
			'category-product-menu' 			=> __('CategoryProductMenu'),			
		)
	);
}
add_action('after_setup_theme', 'zendvn_theme_support');
function zendvn_theme_support(){
	add_theme_support( 'post-formats', array('aside','image','gallery','video','audio') );
	add_theme_support('post-thumbnails');
	add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	
	
}
add_action('widgets_init', 'zendvn_theme_widgets_init');
function zendvn_theme_widgets_init(){	
	$themeName="dienkimtheme";	
	register_sidebar(array(
		'name'          => __( 'Slideshow', $themeName ),
		'id'            => 'slideshow',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'MainLogo', $themeName ),
		'id'            => 'main-logo',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'BannerPage', $themeName ),
		'id'            => 'banner-page',		
		'class'         => '',
		'before_widget' => '<div class="serif">',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
		'after_widget'  => '</div>'				
	));
	register_sidebar(array(
		'name'          => __( 'Order delivery and take out', $themeName ),
		'id'            => 'order-delivery-and-take-out',		
		'class'         => '',
		'before_widget' => '<div class="remotherer">',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
		'after_widget'  => '</div>'				
	));
	register_sidebar(array(
		'name'          => __( 'Introduce', $themeName ),
		'id'            => 'introduce',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'OurMenu', $themeName ),
		'id'            => 'our-menu',		
		'class'         => '',
		'before_widget' => '<div class="remotherer">',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
		'after_widget'  => '</div>'				
	));
	register_sidebar(array(
		'name'          => __( 'AllMenu', $themeName ),
		'id'            => 'all-menu',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'BreakfastMenu', $themeName ),
		'id'            => 'breakfast-menu',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'LunchMenu', $themeName ),
		'id'            => 'lunch-menu',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'DinnerMenu', $themeName ),
		'id'            => 'dinner-menu',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'DrinkMenu', $themeName ),
		'id'            => 'drink-menu',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'OthersMenu', $themeName ),
		'id'            => 'others-menu',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'OurPopularDishes', $themeName ),
		'id'            => 'popular-dishes',		
		'class'         => '',
		'before_widget' => '<div class="remotherer">',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
		'after_widget'  => '</div>'						
	));
	register_sidebar(array(
		'name'          => __( 'PopularProduct', $themeName ),
		'id'            => 'popular-product',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'Reservation', $themeName ),
		'id'            => 'reservation',		
		'class'         => '',
		'before_widget' => '<div class="remotherer">',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
		'after_widget'  => '</div>'						
	));
	register_sidebar(array(
		'name'          => __( 'OurGallery', $themeName ),
		'id'            => 'our-gallery',		
		'class'         => '',
		'before_widget' => '<div class="remotherer">',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
		'after_widget'  => '</div>'					
	));
	register_sidebar(array(
		'name'          => __( 'GalleryImage', $themeName ),
		'id'            => 'gallery-image',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'OurBlog', $themeName ),
		'id'            => 'our-blog',		
		'class'         => '',
		'before_widget' => '<div class="remotherer">',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
		'after_widget'  => '</div>'					
	));
	register_sidebar(array(
		'name'          => __( 'Blog', $themeName ),
		'id'            => 'blog',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'EmailSubscribeIntroduce', $themeName ),
		'id'            => 'email-subscribe-introduce',		
		'class'         => '',
		'before_widget' => '<div class="tiato">',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => '</div>'				
	));
	register_sidebar(array(
		'name'          => __( 'EmailSubscribe', $themeName ),
		'id'            => 'email-subscribe',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'WorkingTime', $themeName ),
		'id'            => 'working-time',		
		'class'         => '',
		'before_widget' => '<div class="jimbabue">',
		'before_title'  => '<h3 class="diva">',
		'after_title'   => '</h3>',
		'after_widget'  => '</div>'				
	));
	register_sidebar(array(
		'name'          => __( 'Copyright', $themeName ),
		'id'            => 'copyright',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
	register_sidebar(array(
		'name'          => __( 'BannerCategoryProduct', $themeName ),
		'id'            => 'banner-catgory-product',		
		'class'         => '',
		'before_widget' => '<div class="margin-top-15 talaba">',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => '</div>'				
	));
}
add_action("wp_enqueue_scripts",function(){
	wp_deregister_script("jquery");
	wp_deregister_script("jquery-migrate");
});
add_action('wp_footer', 'footer_script_code');
add_action('wp_head', 'header_script_code');
function header_script_code(){
	$strScript='<script type="text/javascript" language="javascript">
        ddsmoothmenu.init({
            mainmenuid: "smoothmainmenu", 
            orientation: "h", 
            classname: "ddsmoothmenu",
            contentsource: "markup" 
        });         
    </script>';
    echo $strScript;
}
function footer_script_code(){
	$strScript= '<script type=\'text/javascript\'>
	var wpexLocalize = {
		"mobileMenuOpen" : "Browse Categories",
		"mobileMenuClosed" : "Close navigation",
		"homeSlideshow" : "false",
		"homeSlideshowSpeed" : "7000",
		"UsernamePlaceholder" : "Username",
		"PasswordPlaceholder" : "Password",
		"enableFitvids" : "true"
	};	
	</script>
	';
	echo $strScript;
}
