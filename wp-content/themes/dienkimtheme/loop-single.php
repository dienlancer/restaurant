<?php 
if(have_posts()){
    while (have_posts()) {
        the_post();                     
        $post_id= get_the_id();
        $permalink=get_the_permalink($post_id);
        $title=get_the_title($post_id);        
        $content=get_the_content($post_id);        
        $featureImg=get_the_post_thumbnail_url($post_id, 'full');       
        ?>
        <div class="container">
            <h3><?php echo $title; ?></h3> 
            <div class="margin-top-15">
                <?php echo $content; ?>
            </div>      
        </div>        
        <?php
    }
    wp_reset_postdata();    
}
?>