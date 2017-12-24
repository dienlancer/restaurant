<?php 
$product_meta_key = "_zendvn_sp_zaproduct_";                   
global $zController,$zendvn_sp_settings;
$vHtml=new HtmlControl();

$productModel=$zController->getModel("/frontend","ProductModel"); 
/* begin load config contact */
$width=$zendvn_sp_settings["product_width"];    
$height=$zendvn_sp_settings["product_height"];      
$product_number=$zendvn_sp_settings["product_number"];
/* end load config contact */

$the_query=$wp_query;

            // begin phân trang
$totalItemsPerPage=0;
$pageRange=10;
$currentPage=1; 
if(!empty($zendvn_sp_settings["product_number"])){
    $totalItemsPerPage=$product_number;        
}
if(!empty(@$_POST["filter_page"]))          {
    $currentPage=@$_POST["filter_page"];  
}
$productModel->setWpQuery($the_query);   
$productModel->setPerpage($totalItemsPerPage);        
$productModel->prepare_items();               
$totalItems= $productModel->getTotalItems();   
$the_query=$productModel->getItems();                
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
    <div>
        <?php
        if($the_query->have_posts()){
            $k=1;
            while ($the_query->have_posts()){
                $the_query->the_post();     
                $post_id=$the_query->post->ID;                          
                $permalink=get_the_permalink($post_id);
                $title=get_the_title($post_id);
                $excerpt=get_post_meta($post_id,"product_intro",true);
                $excerpt=substr($excerpt, 0,300).'...';         
                $featureImg=get_the_post_thumbnail_url($post_id, 'full');   
                $smallImg=$vHtml->getImage($featureImg);                
                $price=get_post_meta($post_id,$product_meta_key."price",true);
                $sale_price=get_post_meta($post_id,$product_meta_key."sale_price",true);            
                $html_price='';                     
                if((int)@$sale_price > 0){              
                    $price_html ='<span class="price-regular">'.$vHtml->fnPrice($price).'</span>';
                    $sale_price_html='<span class="price-sale">'.$vHtml->fnPrice($sale_price).'</span>' ;                   
                    $html_price='<div >'.$price_html.'</div><div >'.$sale_price_html.'</div>' ;             
                }else{
                    $html_price='<span>'.$vHtml->fnPrice($price).'</span>' ;                    
                }    
                ?>
                <div class="col-lg-3">
                    <div>
                        <img src="<?php echo $smallImg; ?>" />
                    </div>
                </div>
                <?php
                if($k%4==0 || $k==$the_query->post_count){
                    echo '<div class="clr"></div>';
                }   
                $k++;
            }            
        }
        ?>
    </div>
</form>