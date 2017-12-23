<?php 
global $zendvn_sp_settings;
$map_url=$zendvn_sp_settings['ban_do'];
?>
<div class="tina relative">    
    <div class="oppo">
        <div class="relative">
            <div class="nina">
                <?php 
                if(have_posts()){                                   
                    while (have_posts()) {
                        the_post();                                                                                     
                        the_title();
                    }
                    wp_reset_postdata();                                
                }
                ?>            
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
<div class="hexa padding-top-5 padding-bottom-15">
    <div class="container">
        <div class="row">                
            <div class="col-lg-4 no-padding-left">
                <?php                       
                if(have_posts()){                                   
                    while (have_posts()) {
                        the_post();                                                                                     
                        the_content( null, false );
                    }
                    wp_reset_postdata();                                
                }
                ?>                                  
            </div>
            <div class="col-lg-8 no-padding-left">
                <?php 
                $args = array(          
                    'name' => 'thong-tin-lien-he',
                    'post_type'=>'page'
                );
                $query = new WP_Query($args);       
                if($query->have_posts()){                                   
                    while ($query->have_posts()) {
                        $query->the_post();     
                        $post_id=$query->post->ID;                          
                        $permalink=get_the_permalink($post_id);
                        $title=get_the_title($post_id);
                        $content=get_the_content( $post_id );
                        $excerpt=substr(get_the_excerpt( $post_id ), 0,200).'...';          
                        $featureImg=wp_get_attachment_url(get_post_thumbnail_id($post_id));                     
                        echo $content;
                    }
                    wp_reset_postdata();                                
                }
                ?>                      
            </div>
            <div class="clr"></div>        
        </div>  
        <div class="row margin-top-15">
            <iframe src="<?php echo $map_url; ?>" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>                
    </div>
</div>