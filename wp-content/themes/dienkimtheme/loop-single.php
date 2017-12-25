<div class="tina relative">        
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
            <div class="lumberjack"><img src="<?php echo site_url('wp-content/uploads/banner-top.jpg'); ?>" /></div>
        </div>
    </div>       
</div> 
<?php 
if(have_posts()){
    while (have_posts()) {
        the_post();                     
        $post_id= get_the_id();
        $permalink=get_the_permalink($post_id);
        $title=get_the_title($post_id);        
        $excerpt='';
        $excerpt=get_post_meta($post_id,"page_intro",true);
        if(empty($excerpt)){
            $excerpt=get_post_meta($post_id,"article_intro",true);
        }
        $content=get_the_content($post_id);        
        $featureImg=get_the_post_thumbnail_url($post_id, 'full');       
        ?>
        <div class="hexa padding-top-45 padding-bottom-45">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h3 class="hexa-title">
                            <?php echo $title; ?>
                        </h3>
                        <div class="about-us-excerpt"><?php echo $excerpt; ?></div>
                        <hr class="about-us-hr" />
                        <div class="about-us-content margin-top-30"><?php echo $content; ?></div>    
                    </div>                    
                </div>            
            </div>  
        </div>            
        <?php
    }
    wp_reset_postdata();    
}
?>