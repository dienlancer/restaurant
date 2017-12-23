<?php 
global $zController,$zendvn_sp_settings;    
$vHtml=new HtmlControl();
$productModel=$zController->getModel("/frontend","ProductModel"); 
$the_query=$wp_query;
$totalItemsPerPage=0;
$pageRange=10;
$currentPage=1; 
if(!empty($zendvn_sp_settings["article_number"])){
    $totalItemsPerPage=$zendvn_sp_settings["article_number"];        
}
if(!empty(@$_POST["filter_page"]))          {
    $currentPage=@$_POST["filter_page"];  
}
$productModel->setWpQuery($the_query);   
$productModel->setPerpage($totalItemsPerPage);        
$productModel->prepare_items();               
$totalItems= $productModel->getTotalItems();               
$arrPagination=array(
  "totalItems"=>$totalItems,
  "totalItemsPerPage"=>$totalItemsPerPage,
  "pageRange"=>$pageRange,
  "currentPage"=>$currentPage   
);    
$pagination=$zController->getPagination("Pagination",$arrPagination); 
?>
<form  method="post"  class="frm" name="frm">
    <input type="hidden" name="filter_page" value="1" /> 
    <div class="tina relative">    
        <div class="oppo">
            <div class="relative">
                <div class="nina"><?php single_cat_title(); ?>            </div>
                <div class="tma"></div>
            </div>            
        </div>    
        <div>
            <script type="text/javascript" language="javascript">        
                jQuery(document).ready(function(){
                    jQuery(".linda").slick({
                        dots: true,
                        autoplay:true,
                        arrows:false,
                        adaptiveHeight:true,
                        loop:true
                    });  
                });     
            </script>
            <div class="linda">
                <div class="lumberjack">                            
                    <img src="<?php echo site_url('wp-content/uploads/banner-top.jpg'); ?>" />                               
                </div>
            </div>
        </div>       
    </div> 
    <div class="hexa padding-top-5 padding-bottom-15">
        <div class="container">
            <div class="row">                
                <div>
                    <?php 
                    if($the_query->have_posts()){    
                        $k=1  ;                            
                        while ($the_query->have_posts()){
                            $the_query->the_post();     
                            $post_id=$the_query->post->ID;                          
                            $permalink=get_the_permalink($post_id);
                            $title=get_the_title($post_id);
                            $excerpt=get_post_meta($post_id,"article_intro",true);
                            $excerpt=substr($excerpt, 0,300).'...';         
                            $content=get_the_content($post_id);
                            $featureImg=get_the_post_thumbnail_url($post_id, 'full');                           
                            ?>
                            <div class="col-lg-4 no-padding-left">
                                <div class="main-blog-box margin-top-30">
                                    <div class="blog-box-img">
                                        <center>
                                            <figure>
                                                <a href="<?php echo $permalink; ?>"><img src="<?php echo $featureImg; ?>" /></a>
                                            </figure>
                                        </center>
                                    </div>
                                    <div class="blog-box padding-left-15 padding-right-15 padding-top-15 padding-bottom-15">
                                        <h3 class="blog-title"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></h3>
                                        <div class="margin-top-15 blog-excerpt"><?php echo $excerpt; ?></div>
                                        <div class="about-us-readmore-2 margin-top-15">                                         
                                            <a href="<?php echo $permalink; ?>">Xem thêm<i class="icofont icofont-curved-double-right"></i></a>
                                        </div>
                                    </div>                                      
                                </div>
                            </div>                            
                            <?php
                            if($k%3 ==0 || $k==$the_query->post_count){
                                echo '<div class="clr"></div>';
                            }
                            $k++;
                        }
                        wp_reset_postdata();                        
                    }
                    ?>
                </div>                
            </div>
            <div class="row">
                    <?php echo $pagination->showPagination();            ?>
                    <div class="clr"></div>
            </div>
        </div>
    </div>
</form>



