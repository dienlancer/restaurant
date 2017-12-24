<?php 
$meta_key = "_zendvn_sp_zaproduct_";                   
global $zController,$zendvn_sp_settings;    
$vHtml=new HtmlControl();

$productModel=$zController->getModel("/frontend","ProductModel"); 
/* begin load config contact */
$width=$zendvn_sp_settings["product_width"];    
$height=$zendvn_sp_settings["product_height"];      
$product_number=$zendvn_sp_settings["product_number"];
/* end load config contact */
        
$query=$wp_query;

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
$productModel->setWpQuery($query);   
$productModel->setPerpage($totalItemsPerPage);        
$productModel->prepare_items();               
$totalItems= $productModel->getTotalItems();   
$query=$productModel->getItems();                
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
    
</form>