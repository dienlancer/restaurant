<?php get_header();     ?>
    <div class="tina relative">    
        <div class="oppo">
            <div class="relative">
                <div class="nina">
                    <?php single_cat_title(); ?>
                </div>
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
    <div class="container margin-top-15">
    	<div class="row">
    		<div class="col-lg-4">
    			
    			<div class="ducati">
    				<h3>My account</h3>
    				<div class="margin-top-15">
    					<?php     
    					$args = array( 
    						'menu'              => '', 
    						'container'         => '', 
    						'container_class'   => '', 
    						'container_id'      => '', 
    						'menu_class'        => 'categoryproductmenu', 
    						'menu_id'           => 'category-product-menu', 
    						'echo'              => true, 
    						'fallback_cb'       => 'wp_page_menu', 
    						'before'            => '', 
    						'after'             => '', 
    						'link_before'       => '', 
    						'link_after'        => '', 
    						'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',  
    						'depth'             => 3, 
    						'walker'            => '', 
    						'theme_location'    => 'category-product-menu' 
    					);
    					wp_nav_menu($args);
    					?>   
    					<div class="clr"></div> 
    				</div>
    			</div>

    		</div>
    		<div class="col-lg-8"></div>
    	</div>
    </div>
    <?php get_footer(); ?>
    <?php wp_footer();?>
</body>
</html>