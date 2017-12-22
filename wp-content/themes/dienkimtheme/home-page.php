<?php 
	/*
	 Template Name: HomePage
	 */	 
     global $zendvn_sp_settings;
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
     ?>
    <?php get_header();     ?>
    <?php if(is_active_sidebar('search-food')):?>
        <?php dynamic_sidebar('search-food')?>
    <?php endif; ?>    
    <center><hr class="search-food-hr" />   </center>
    <div class="container kip">    	
    	<form name="frm-search" action="#" method="POST">
    		<div class="search-food-form margin-top-45">
    			<div><input type="text" name="q" placeholder="Tìm theo từ khoá"></div>
    			<div><center><a href="javascript:void(0);"><i class="fa fa-search" aria-hidden="true"></i>Tìm</a></center></div>
    		</div>
    	</form>	
    	<div class="margin-top-45">
    		<ul class="inline-block order">
				<li>
					<i class="icofont icofont-fast-food"></i>
					<p>Select Food</p>
				</li>
				<li>
					<i class="icofont icofont-food-basket"></i>
					<p>Order Food</p>
				</li>
				<li>
					<i class="icofont icofont-fast-delivery"></i>
					<p>Delivery or Take Out</p>
				</li>				
			</ul>
    	</div>
    	<div class="margin-top-5">
    		<div class="line"><center><img src="<?php echo site_url('wp-content/uploads/line.png',null); ?>" /></center></div>
    	</div>			
    </div>
    <?php if(is_active_sidebar('introduce')):?>
        <?php dynamic_sidebar('introduce')?>
    <?php endif; ?>
    <?php if(is_active_sidebar('our-menu')):?>
        <?php dynamic_sidebar('our-menu')?>
    <?php endif; ?>   
    <center><hr class="search-food-hr" /></center>
    <div class="container margin-top-30">
        <script type="text/javascript" language="javascript">
            function openMenu(evt, cityName) {    
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }   
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }   
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
            }
            jQuery(document).ready(function(){
                jQuery("#all-menu").show();
                jQuery("div.tab > button.tablinks:first-child").addClass('active');
            });
        </script>      
        <div class="flex-center-middle">
            <div class="tab">
                <button class="tablinks h-title" onclick="openMenu(event, 'all-menu')">All</button>
                <button class="tablinks h-title" onclick="openMenu(event, 'breakfast-menu')">Breakfast</button>
                <button class="tablinks h-title" onclick="openMenu(event, 'lunch-menu')">Lunch</button>
                <button class="tablinks h-title" onclick="openMenu(event, 'dinner-menu')">Dinner</button>
                <button class="tablinks h-title" onclick="openMenu(event, 'drink-menu')">Drinks</button> 
                <button class="tablinks h-title" onclick="openMenu(event, 'others-menu')">Others</button>                 
                <div class="clr"></div>           
            </div>
        </div>               
        <div id="all-menu" class="tabcontent">
            <?php if(is_active_sidebar('all-menu')):?>
                <?php dynamic_sidebar('all-menu')?>
            <?php endif; ?>
        </div>
        <div id="breakfast-menu" class="tabcontent">
            <?php if(is_active_sidebar('breakfast-menu')):?>
                <?php dynamic_sidebar('breakfast-menu')?>
            <?php endif; ?>
        </div>
        <div id="lunch-menu" class="tabcontent">
            <?php if(is_active_sidebar('lunch-menu')):?>
                <?php dynamic_sidebar('lunch-menu')?>
            <?php endif; ?>
        </div>
        <div id="dinner-menu" class="tabcontent">
            <?php if(is_active_sidebar('dinner-menu')):?>
                <?php dynamic_sidebar('dinner-menu')?>
            <?php endif; ?>
        </div>
        <div id="drink-menu" class="tabcontent">
            <?php if(is_active_sidebar('drink-menu')):?>
                <?php dynamic_sidebar('drink-menu')?>
            <?php endif; ?>
        </div>       
        <div id="others-menu" class="tabcontent">
            <?php if(is_active_sidebar('others-menu')):?>
                <?php dynamic_sidebar('others-menu')?>
            <?php endif; ?>
        </div>   
    </div>
    <div class="container"><hr class="runat" /></div>
    <?php if(is_active_sidebar('popular-dishes')):?>
        <?php dynamic_sidebar('popular-dishes')?>
    <?php endif; ?>
    <center><hr class="search-food-hr" /></center>    
    <?php if(is_active_sidebar('popular-product')):?>
        <?php dynamic_sidebar('popular-product')?>
    <?php endif; ?>        
    <div class="dalat margin-top-45">
        <?php if(is_active_sidebar('reservation')):?>
            <?php dynamic_sidebar('reservation')?>
        <?php endif; ?>
        <center><hr class="search-food-hr"></center>
        <script type="text/javascript" language="javascript">
            jQuery(document).ready(function(){
                jQuery( "input[name='datebooking']" ).datepicker({
                    dateFormat: "dd/mm/yy",
                    defaultDate: "+3d",
                    changeYear: true,
                    changeMonth: true,
                    yearRange: "2000:2015"
                });
                jQuery("input[name='timebooking']").timepicker();
            });            
        </script>        
        <form name="frm-reservation" method="POST" >
            <input type="hidden" name="action" value="booking" />                      
            <?php wp_nonce_field("booking",'security_code',true);?>                                  
            <div class="container margin-top-15 reservation-runz padding-bottom-45">
                <div class="row">
                    <div class="col-lg-4"><div class="relative"><i class="icofont icofont-ui-user"></i><input name="fullname" value="Họ và tên"  class="form-control" type="text"></div></div>
                    <div class="col-lg-4"><div class="relative"><i class="icofont icofont-ui-message"></i><input name="email" value="Email"  class="form-control" type="text"></div></div>
                    <div class="col-lg-4"><div class="relative"><i class="icofont icofont-phone"></i><input name="mobile" value="Số điện thoại"  class="form-control" type="text"></div></div>
                    <div class="clr"></div>
                </div>
                <div class="row margin-top-15">
                    <div class="col-lg-4">
                        <div class="relative">
                            <i class="icofont icofont-ui-calendar"></i><input  name="datebooking"    class="form-control" type="text">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="relative">
                            <i class="icofont icofont-clock-time"></i>
                            <input name="timebooking"  class="form-control" type="text">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="relative">
                            <select name="number_person" class="form-control">
                                <option value="0">Số người</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>  
                <div class="row ruby-readmore margin-top-45">
                    <center><a href="javascript:void(0);" onclick="document.forms['frm-reservation'].submit();">Đặt bàn<i class="icofont icofont-curved-double-right"></i></a></center>                    
                </div>                          
            </div>                    
        </form>        
    </div>   
    <?php if(is_active_sidebar('our-gallery')):?>
        <?php dynamic_sidebar('our-gallery')?>
    <?php endif; ?>
    <center><hr class="search-food-hr" />   </center>
    <?php get_footer(); ?>
    <?php wp_footer();?>
</body>
</html>