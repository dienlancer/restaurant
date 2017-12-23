<?php
class ProductController{	
	private $_errors = array();	
	private $_data = array();	
	public function __construct(){	
		$this->dispath_function();
	}	
	public function dispath_function(){
		global $zController;
		$action = $zController->getParams('action');		
		switch ($action){						
			case "add-cart"				: 	$this->addCart();break;
			case "update-cart"			: 	$this->updateCart();break;
			case "contact"				: 	$this->contact();break;	
			case "delete"				: 	$this->deleteCart();break;			
			case "delete-all"			: 	$this->deleteAll();break;
			case "register-member"		: 	$this->registerMember();break;
			case "change-info"			: 	$this->changeInfo();break;
			case "login"				: 	$this->login();break;
			case "logout"				:	$this->logout();break;
			case "checkout"				:	$this->checkout();break;
			case "confirm-checkout"		:	$this->confirmCheckout();break;
			case "register-checkout"	:	$this->registerCheckout();break;
			case "login-checkout"		:	$this->loginCheckout();break;
			case "change-password"		:	$this->changePassword();break;
			case "booking"				:	$this->booking();break;
			case "reservation"			:	$this->reservation();break;
		}		
	}	
	public function addCart(){		
		global $zController;
		if($zController->isPost()){
			$action = $zController->getParams('action');
			if(check_admin_referer($action,'security_code')){
				$vHtml = new HtmlControl();
				$product_id=(int)($zController->getParams("product_id"));
				$product_code=($zController->getParams("product_code"));
				$product_name=($zController->getParams("product_name"));
				$product_image=$zController->getParams("product_image");
				$product_price=(float)($zController->getParams("product_price"));
				$product_quantity=(int)($zController->getParams("product_quantity"));				
				$ssName="vmart";
				$ssValue="zcart";				
				$ssCart 	= $zController->getSession('SessionHelper',$ssName,$ssValue);
				$arrCart = @$ssCart->get($ssValue)["cart"];												
				if($product_id > 0){						
					if(count($arrCart) == 0){
						$arrCart[$product_id]["product_quantity"] = $product_quantity;
					}else{
						if(!isset($arrCart[$product_id])){
							$arrCart[$product_id]["product_quantity"] = $product_quantity;
						}else{					
							$arrCart[$product_id]["product_quantity"] = $arrCart[$product_id]["product_quantity"] + $product_quantity;
						}
					}					
					$arrCart[$product_id]["product_id"]=$product_id;	
					$arrCart[$product_id]["product_code"]=$product_code;
					$arrCart[$product_id]["product_name"]=$product_name;			
					$arrCart[$product_id]["product_image"]=$product_image;					
					$arrCart[$product_id]["product_price"]=$product_price;											
					$product_quantity=(float)$arrCart[$product_id]["product_quantity"];
					$product_total_price=$product_price * $product_quantity;
					$arrCart[$product_id]["product_total_price"]=($product_total_price);
					
					$cart["cart"]=$arrCart;
					$ssCart->set($ssValue,$cart);			
					$pageID = $zController->getHelper('GetPageId')->get('_wp_page_template','zcart.php');	
					$permarlink = get_permalink($pageID);
					wp_redirect($permarlink);
				}
			}		
		}		
	}
	public function updateCart(){		
		global $zController;	
		if($zController->isPost()){
			$action = $zController->getParams('action');		
			if(check_admin_referer($action,'security_code')){
				$arrQTY=$_POST["quantity"];		
				$ssName="vmart";
				$ssValue="zcart";				
				$ssCart 	= $zController->getSession('SessionHelper',$ssName,$ssValue);
				$arrCart = @$ssCart->get($ssValue)["cart"];		
				foreach ($arrCart as $key => $value) {		
					$product_quantity=(int)$arrQTY[$key];
					$product_price = (float)$arrCart[$key]["product_price"];
					$product_total_price=$product_quantity * $product_price;
				 	$arrCart[$key]["product_quantity"]=$product_quantity;
				 	$arrCart[$key]["product_total_price"]=$product_total_price;
				}
				foreach ($arrCart as $key => $value) {
					$product_quantity=(int)$arrCart[$key]["product_quantity"];
					if($product_quantity==0)
						unset($arrCart[$key]);
				}
				$cart["cart"]=$arrCart;
				$ssCart->set($ssValue,$cart);
				if(empty($arrCart))
					$ssCart->reset();
				$pageID = $zController->getHelper('GetPageId')->get('_wp_page_template','zcart.php');	
				$permarlink = get_permalink($pageID);
				wp_redirect($permarlink);
			}						
		}				
	}	
	public function deleteCart(){
		global $zController;	
		$id=(int)($zController->getParams("id"));								
		$ssName="vmart";
		$ssValue="zcart";				
		$ssCart 	= $zController->getSession('SessionHelper',$ssName,$ssValue);
		$arrCart = @$ssCart->get($ssValue)["cart"];	
		unset($arrCart[$id]);				
		$cart["cart"]=$arrCart;
		$ssCart->set($ssValue,$cart);
		if(empty($arrCart))
			$ssCart->reset();
		$pageID = $zController->getHelper('GetPageId')->get('_wp_page_template','zcart.php');	
		$permarlink = get_permalink($pageID);
		wp_redirect($permarlink);
	}	
	public function deleteAll(){
		global $zController;				
		$ssName="vmart";
		$ssValue="zcart";				
		$ssCart 	= $zController->getSession('SessionHelper',$ssName,$ssValue);				
		$ssCart->reset();		
		$pageID = $zController->getHelper('GetPageId')->get('_wp_page_template','zcart.php');	
		$permarlink = get_permalink($pageID);
		wp_redirect($permarlink);
	}
	public function registerMember(){
		global $zController,$wpdb;		
		$flag=true;
		$arrError=array();
		$arrData=array();
		$arrSuccess=array();				
		if($zController->isPost()){		
			$action = $zController->getParams('action');					
			if(check_admin_referer($action,'security_code')){	
				$arrData=$_POST;
				$email=mb_strtolower(trim($_POST["email"]),'UTF-8') ;
				$username=mb_strtolower(trim($_POST["username"]),'UTF-8') ;
				$password=mb_strtolower($_POST["password"],'UTF-8') ;
				$password_confirm=mb_strtolower($_POST["password_confirm"],'UTF-8') ;
				// kiểm tra email hợp lệ			
				if(!preg_match("#^[a-z][a-z0-9_\.]{4,31}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$#",$email )){
					$arrError["email"] = 'Email is invalid';
					$arrData["email"] = '';
					$flag=0;
				}
				if(!preg_match("#^[a-z_][a-z0-9_\.\s]{4,31}$#", $username)){
					$arrError["username"] = 'Username is invalid';
					$arrData["username"] = "";	
					$flag=0;
				}
				if(mb_strlen($password) < 6){
					$arrError["password"] = 'Password is invalid';
					$arrData["password"] = "";
					$arrData["password_confirm"] = "";	
					$flag=0;
				}
				if(strcmp($password, $password_confirm)!=0){
					$arrError["password_confirm"] = 'PasswordConfirm is not matched Password';
					$arrData["password_confirm"] = "";		
					$flag=0;
				}			
				$tbuser = $wpdb->prefix . 'shk_user';			
				$query ="SELECT u.id
						FROM 
						`".$tbuser."` u
						WHERE lower(trim(u.email)) = '".$email."'
					";								
				$lst = $wpdb->get_results($query,ARRAY_A);		
				if(!empty($lst)){
					$arrError["email"] = 'Email đã tồn tại';
					$arrData["email"] = '';
					$flag=0;
				}
				$query =" 
						SELECT u.id
						FROM 
						{$tbuser} u
						WHERE lower(trim(u.username)) = '".$username."'
					";					
				$lst = $wpdb->get_results($query,ARRAY_A);		
				if(!empty($lst)){
					$arrError["username"] = 'Username đã tồn tại';
					$arrData["username"] = '';
					$flag=0;
				}				

				if($flag==true){
					$model = $zController->getModel("/frontend","UserModel");
					$model->save_item();					
					$info=$model->getUserByUsername($username);					
					$id=(int)$info[0]["id"];	
					$ssName="vmuser";
					$ssValue="userlogin";
					$ssUser     = $zController->getSession('SessionHelper',$ssName,$ssValue);							
					$user["userInfo"]=array("username" => $username,"id"=>$id);
					$ssUser->set($ssValue,$user);	
					$pageID = $zController->getHelper('GetPageId')->get('_wp_page_template','account.php');	
					$permarlink = get_permalink($pageID);
					wp_redirect($permarlink);				
				}
			}
		}	
		$zController->_data["data"] = $arrData;
		$zController->_data["error"] = $arrError;			
		$zController->_data["success"] = $arrSuccess;			
	}
	public function changeInfo(){
		global $zController,$wpdb;		
		$flag=true;
		$arrError=array();
		$arrData=array();
		$arrSuccess=array();		
		if($zController->isPost()){		
			$action = $zController->getParams('action');		
			if(check_admin_referer($action,'security_code')){	
				$arrData=$_POST;
				$email=mb_strtolower(trim($_POST["email"]),'UTF-8') ;				
				// kiểm tra email hợp lệ			
				if(!preg_match("#^[a-z][a-z0-9_\.]{4,31}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$#",$email )){
					$arrError["email"] = 'Email is invalid';
					$arrData["email"] = '';
					$flag=0;
				}								
				$id=(int)($_POST["id"]);
				$tbuser = $wpdb->prefix . 'shk_user';			
				$query ="SELECT u.id
						FROM 
						`".$tbuser."` u
						WHERE lower(trim(u.email)) = '".$email."' and u.id != '".$id."'
					";								
				$lst = $wpdb->get_results($query,ARRAY_A);		
				if(!empty($lst)){
					$arrError["email"] = 'Email đã tồn tại';
					$arrData["email"] = '';
					$flag=0;
				}					
				if($flag==true){
					$model = $zController->getModel("/frontend","UserModel");
					$model->update_item();
					$id=(int)($_POST["id"]);
					$info=$model->getUserById($id);			
					$username=trim($info[0]["username"]);													
					$ssName="vmuser";
					$ssValue="userlogin";
					$ssUser     = $zController->getSession('SessionHelper',$ssName,$ssValue);			
					$user["userInfo"]=array("username" => $username,"id"=>$id);
					$ssUser->set($ssValue,$user);			
					$arrSuccess=array("success"=>"Cập nhật thành công");			
				}	 
				$zController->_data["data"] = $arrData;
				$zController->_data["error"] = $arrError;			
				$zController->_data["success"] = $arrSuccess;			
			}
		}						
	}
	public function changePassword(){
		global $zController;
		$flag=true;
		$arrError=array();
		$arrData=array();
		$arrSuccess=array();
		if($zController->isPost()){		
			$action = $zController->getParams('action');		
			if(check_admin_referer($action,'security_code')){	
				$arrData=$_POST;
				$id=(int)$_POST["id"];
				$username=$_POST["username"];
				$password=mb_strtolower($_POST["password"],'UTF-8') ;
                $password_confirm=mb_strtolower($_POST["password_confirm"],'UTF-8') ;     
                if(mb_strlen($password) < 6){
                  $arrError["password"] = 'Password is invalid';
                  $arrData["password"] = "";
                  $arrData["password_confirm"] = ""; 
                  $flag=0;
                }
                if(strcmp($password, $password_confirm)!=0){
                  $arrError["password_confirm"] = 'PasswordConfirm is not matched Password';
                  $arrData["password_confirm"] = "";   
                  $flag=0;
                }    
                if($flag){
                   	$model = $zController->getModel("/frontend","UserModel");
					$model->update_password();        
					$ssName="vmuser";
					$ssValue="userlogin";
					$ssUser     = $zController->getSession('SessionHelper',$ssName,$ssValue);			
					$user["userInfo"]=array("username" => $username,"id"=>$id);
					$ssUser->set($ssValue,$user);	
					$arrSuccess=array("success"=>"Cập nhật thành công");				                                              
                }                   
			}
		}			
		$zController->_data["data"] = $arrData;
		$zController->_data["error"] = $arrError;			
		$zController->_data["success"] = $arrSuccess;				
	}
	public function login(){	
		global $zController;	
		$permarlink="";							
		$pageID=0;
		if($zController->isPost()){	
			$action = $zController->getParams('action');
			if(check_admin_referer($action,'security_code')){
				$username=trim($_POST["username"]);		
				$password=md5($_POST["password"]);					
				$model = $zController->getModel("/frontend","UserModel");		 
				if($model->checkLogin($username,$password)){					
					$info=$model->getUserByUsername($username);
					$id=(int)$info[0]["id"];	
					$ssName="vmuser";
					$ssValue="userlogin";
					$ssUser     = $zController->getSession('SessionHelper',$ssName,$ssValue);			
					$user["userInfo"]=array("username" => $username,"id"=>$id);
					$ssUser->set($ssValue,$user);	
					$pageID = $zController->getHelper('GetPageId')->get('_wp_page_template','account.php');					
				}else{
					$pageID = $zController->getHelper('GetPageId')->get('_wp_page_template','login.php');						
				}	
			}					
		}	
		$permarlink = get_permalink($pageID);							
		wp_redirect($permarlink);						
	}	
	public function logout(){
		global $zController;					
		$ssName="vmuser";
		$ssValue="userlogin";
		$ssUser     = $zController->getSession('SessionHelper',$ssName,$ssValue);	
		$ssUser->reset();
		wp_redirect(site_url());			
	}
	public function checkout(){
		global $zController;	
		$permarlink="";
		$pageID=0;				
		$ssName="vmuser";
		$ssValue="userlogin";
		$ssUser     = $zController->getSession('SessionHelper',$ssName,$ssValue);	
		$arrUser = @$ssUser->get($ssValue)["userInfo"];	
		if(empty($arrUser))
			$pageID = $zController->getHelper('GetPageId')->get('_wp_page_template','login-checkout.php');	
		else
			$pageID = $zController->getHelper('GetPageId')->get('_wp_page_template','checkout.php');	
		$permarlink = get_permalink($pageID);	
		wp_redirect($permarlink);				
	}
	public function confirmCheckout(){
		global $zController,$wpdb;		
		$flag=true;
		$arrError=array();
		$arrData=array();
		$arrSuccess=array();
		if($zController->isPost()){
			$action = $zController->getParams('action');
			if(check_admin_referer($action,'security_code')){	
				$arrData=$_POST;
				$email 				=		mb_strtolower(trim($_POST["email"]),'UTF-8') ;	
				$payment_method		=		mb_strtolower(trim($_POST["payment_method"]),'UTF-8');	
				if(empty($email)){
                  $arrError["email"] = 'Xin vui lòng nhập email';
                  $arrData["email"] = "";                  
                  $flag=0;
                }
                if((int)$payment_method==0){
                  $arrError["payment_method"] = 'Xin vui lòng nhập phương thức thanh toán';
                  $arrData["payment_method"] = "";                  
                  $flag=0;
                }
				// kiểm tra email hợp lệ			
				if(!preg_match("#^[a-z][a-z0-9_\.]{4,31}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$#",$email )){
					$arrError["email"] = 'Email is invalid';
					$arrData["email"] = '';
					$flag=0;
				}								
				$id=(int)($_POST["user_id"]);
				$tbuser = $wpdb->prefix . 'shk_user';			
				$query ="SELECT u.id
						FROM 
						`".$tbuser."` u
						WHERE lower(trim(u.email)) = '".$email."' and u.id != '".$id."'
					";								
				$lst = $wpdb->get_results($query,ARRAY_A);		
				if(!empty($lst)){
					$arrError["email"] = 'Email đã tồn tại';
					$arrData["email"] = '';
					$flag=0;
				}					
				if($flag==true){
					$invoiceModel = $zController->getModel("/frontend","InvoiceModel");		 
					$invoiceModel->createBill();				
					$pageID = $zController->getHelper('GetPageId')->get('_wp_page_template','finished-checkout.php');	
					$permarlink = get_permalink($pageID);										
					wp_redirect($permarlink);	
				}							
			}
		}	
		$zController->_data["data"] = $arrData;
		$zController->_data["error"] = $arrError;			
		$zController->_data["success"] = $arrSuccess;			
	}
	public function registerCheckout(){
		global $zController,$wpdb;		
		$flag=true;
		$arrError=array();
		$arrData=array();
		$arrSuccess=array();	
		if($zController->isPost()){		
			$action = $zController->getParams('action');		
			if(check_admin_referer($action,'security_code')){	
				$arrData=$_POST;
				$email=mb_strtolower(trim($_POST["email"]),'UTF-8') ;
				$username=mb_strtolower(trim($_POST["username"]),'UTF-8') ;
				$password=mb_strtolower($_POST["password"],'UTF-8') ;
				$password_confirm=mb_strtolower($_POST["password_confirm"],'UTF-8') ;
				// kiểm tra email hợp lệ			
				if(!preg_match("#^[a-z][a-z0-9_\.]{4,31}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$#",$email )){
					$arrError["email"] = 'Email is invalid';
					$arrData["email"] = '';
					$flag=0;
				}
				if(!preg_match("#^[a-z_][a-z0-9_\.\s]{4,31}$#", $username)){
					$arrError["username"] = 'Username is invalid';
					$arrData["username"] = "";	
					$flag=0;
				}
				if(mb_strlen($password) < 6){
					$arrError["password"] = 'Password is invalid';
					$arrData["password"] = "";
					$arrData["password_confirm"] = "";	
					$flag=0;
				}
				if(strcmp($password, $password_confirm)!=0){
					$arrError["password_confirm"] = 'PasswordConfirm is not matched Password';
					$arrData["password_confirm"] = "";		
					$flag=0;
				}			
				$tbuser = $wpdb->prefix . 'shk_user';			
				$query ="SELECT u.id
						FROM 
						`".$tbuser."` u
						WHERE lower(trim(u.email)) = '".$email."'
					";								
				$lst = $wpdb->get_results($query,ARRAY_A);		
				if(!empty($lst)){
					$arrError["email"] = 'Email đã tồn tại';
					$arrData["email"] = '';
					$flag=0;
				}
				$query =" 
						SELECT u.id
						FROM 
						{$tbuser} u
						WHERE lower(trim(u.username)) = '".$username."'
					";					
				$lst = $wpdb->get_results($query,ARRAY_A);		
				if(!empty($lst)){
					$arrError["username"] = 'Username đã tồn tại';
					$arrData["username"] = '';
					$flag=0;
				}				
				if($flag==true){					
					$model = $zController->getModel("/frontend","UserModel");
					$model->save_item();
					$username=trim($_POST["username"]);	
					$info=$model->getUserByUsername($username);					
					$id=(int)$info[0]["id"];	
					$ssName="vmuser";
					$ssValue="userlogin";
					$ssUser     = $zController->getSession('SessionHelper',$ssName,$ssValue);			
					$user["userInfo"]=array("username" => $username,"id"=>$id);
					$ssUser->set($ssValue,$user);
					$pageID = $zController->getHelper('GetPageId')->get('_wp_page_template','checkout.php');	
					$permarlink = get_permalink($pageID);									
					wp_redirect($permarlink);				
				}
			}
		}
		$zController->_data["data"] = $arrData;
		$zController->_data["error"] = $arrError;			
		$zController->_data["success"] = $arrSuccess;			
	}
	public function loginCheckout(){	
		global $zController;	
		$permarlink="";							
		if($zController->isPost()){	
			$action = $zController->getParams('action');
			if(check_admin_referer($action,'security_code')){
				$username=trim($_POST["username"]);		
				$password=md5($_POST["password"]);					
				$model = $zController->getModel("/frontend","UserModel");		 
				if($model->checkLogin($username,$password)){			
					$info=$model->getUserByUsername($username);
					$id=(int)$info[0]["id"];	
					$ssName="vmuser";
					$ssValue="userlogin";
					$ssUser     = $zController->getSession('SessionHelper',$ssName,$ssValue);			
					$user["userInfo"]=array("username" => $username,"id"=>$id);
					$ssUser->set($ssValue,$user);
					$pageID = $zController->getHelper('GetPageId')->get('_wp_page_template','checkout.php');	
					$permarlink = get_permalink($pageID);									
				}else{					
					$zController->_data["error"] =array("Đăng nhập không thành công");							
				}	
			}					
		}		
		wp_redirect($permarlink);				
	}	
	public function contact(){	
		global $zController;	
		$data=array();
		$option_name = 'zendvn_sp_setting';
		$data = get_option('zendvn_sp_setting',array());
		if(count($data)==0){
			$data = $zController->getConfig('SettingConfig')->get();
		}		
		$fullname 	=	trim(@$_POST["fullname"]);
		$email 		=	trim(@$_POST['email']);		
		$phone 		=	trim(@$_POST['phone']);
		$title 		=	trim(@$_POST['title']);
		$address 	=	trim(@$_POST['address']);
		$content 	=	trim(@$_POST["content"]);
		/* begin load config contact */
		$smtp_host		= 	@$data['smtp_host'];
		$smtp_port		=	@$data['smtp_port'];
		$smtp_auth		=	@$data['smtp_auth'];
		$encription		=	@$data['encription'];
		$smtp_username	=	@$data['smtp_username'];
		$smtp_password	=	@$data['smtp_password'];
		$email_from		=	@$data['email_from'];
		$email_to		=	@$data['email_to'];
		$to_name		=	@$data['to_name'];
		/* end load config contact */
		$filePhpMailer=PLUGIN_PATH . "scripts" . DS . "phpmailer" . DS . "PHPMailerAutoload.php"	;

		require_once $filePhpMailer;		
        $strMsg="";
        $mail = new PHPMailer;        
        $mail->CharSet = "UTF-8";   
        $mail->isSMTP();             
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = @$smtp_host;
        $mail->Port = @$smtp_port;
        $mail->SMTPSecure = @$encription;
        $mail->SMTPAuth = (int)@$smtp_auth;
        $mail->Username = @$smtp_username;
        $mail->Password = @$smtp_password;
        $mail->setFrom(@$email_from, $fullname);
        $mail->addAddress(@$email_to, @$to_name);
        $mail->Subject = 'Khách hàng '. @$fullname . " - Số điện thoại : " . @$phone ;       
        $strContent=@$content . "\n\n" . " Điện thoại : " . @$phone; 
        $mail->Body=$strContent;   
        if ($mail->send()) {               	
            echo '<script language="javascript" type="text/javascript">alert("Mail gửi thành công");</script>'; 
        }
        else{
        	echo '<script language="javascript" type="text/javascript">alert("Mail gửi không thành công");</script>'; 
        }
        echo "<pre>".print_r($data,true)."</pre>";
        echo "<pre>".print_r($mail,true)."</pre>";die();
        $page_id_contact = $zController->getHelper('GetPageId')->get('_wp_page_template','contact.php');  
        $contact_link = get_permalink($page_id_contact);
        wp_redirect($contact_link);
	}	
	public function booking(){
		global $zController;	
		$data=array();
		$option_name = 'zendvn_sp_setting';
		$data = get_option('zendvn_sp_setting',array());
		$fullname 			=	trim(@$_POST["fullname"]);
		$email 				=	trim(mb_strtolower(@$_POST['email']));		
		$mobile 			=	trim(@$_POST['mobile']);
		$datebooking 		=	trim(@$_POST['datebooking']);
		$timebooking 		=	trim(@$_POST['timebooking']);
		$number_person 		=	trim(@$_POST["number_person"]);
		$smtp_host		= 	@$data['smtp_host'];
		$smtp_port		=	@$data['smtp_port'];
		$smtp_auth		=	@$data['smtp_auth'];
		$encription		=	@$data['encription'];
		$smtp_username	=	@$data['smtp_username'];
		$smtp_password	=	@$data['smtp_password'];		
		$email_to		=	@$data['email_to'];
		$contacted_name	=	@$data['contacted_name'];	
		$filePhpMailer=PLUGIN_PATH . "scripts" . DS . "phpmailer" . DS . "PHPMailerAutoload.php"	;
		require_once $filePhpMailer;		        
		$mail = new PHPMailer;      
		$mail->CharSet = "UTF-8";   
		$mail->isSMTP();             
		$mail->SMTPDebug = 2;
		$mail->Debugoutput = 'html';
		$mail->Host = @$smtp_host;
		$mail->Port = @$smtp_port;
		$mail->SMTPSecure = @$encription;
		$mail->SMTPAuth = (int)@$smtp_auth;
		$mail->Username = @$smtp_username;
		$mail->Password = @$smtp_password;
		$mail->setFrom(@$email, $fullname);
		$mail->addAddress(@$email_to, @$contacted_name);
		$mail->Subject = 'Thông tin đặt bàn từ khách hàng '.$fullname.' - '.$mobile ;       
		$html_content='<h3>Thông tin đặt bàn từ khách hàng '.$fullname.'</h3>';
		$html_content .='<p>Họ và tên : <b>'.$fullname.'</b></p>'; 
		$html_content .='<p>Email : <b>'.$email.'</b></p>'; 
		$html_content .='<p>Mobile : <b>'.$mobile.'</b></p>'; 
		$html_content .='<p>Ngày đặt : <b>'.$datebooking.'</b></p>'; 
		$html_content .='<p>Vào lúc : <b>'.$timebooking.'</b></p>'; 
		$html_content .='<p>Số lượng : <b>'.$number_person.'</b></p>'; 
		$mail->Body=$html_content;
		if ($mail->send()) {               	
            echo '<script language="javascript" type="text/javascript">alert("Đặt bàn hoàn tất");</script>'; 
        }
        else{
        	echo '<script language="javascript" type="text/javascript">alert("Có sự cố trong quá trình gửi dữ liệu");</script>'; 
        }
        wp_redirect(home_url());
	}
	public function reservation(){
		global $zController,$wpdb;		
		$flag=1;
		$arrError=array();
		$arrData=array();
		$success="";	
		if($zController->isPost()){
			$action = $zController->getParams('action');			
			if(check_admin_referer($action,'security_code')){				
				$arrData=$_POST;
				
				$fullname 			=	trim(@$_POST["fullname"]);
				$email 				=	trim(@$_POST['email']);		
				$mobile 			=	trim(@$_POST['mobile']);
				$datebooking 		=	trim(@$_POST['datebooking']);
				$timebooking 		=	trim(@$_POST['timebooking']);
				$number_person 		=	trim(@$_POST["number_person"]);
				$message 			=	trim(@$_POST["message"]);

				if(mb_strlen($fullname) < 6){
					$arrError["fullname"] = 'Họ tên phải chứa từ 6 ký tự trở lên';
					$arrData["fullname"] = "";					
					$flag=0;
				}
				if(!preg_match("#^[a-z][a-z0-9_\.]{4,31}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$#",$email )){
					$arrError["email"] = 'Email không hợp lệ';
					$arrData["email"] = '';
					$flag=0;
				}
				if(mb_strlen($mobile) < 10){
					$arrError["mobile"] = 'Số điện thoại không hợp lệ';
					$arrData["mobile"] = "";					
					$flag=0;
				}
				if(empty($datebooking)){
					$arrError["datebooking"] = 'Ngày đặt bàn không hợp lệ';
					$arrData["datebooking"] = "";					
					$flag=0;
				}
				if(empty($timebooking)){
					$arrError["timebooking"] = 'Thời gian đặt bàn không hợp lệ';
					$arrData["timebooking"] = "";					
					$flag=0;
				}
				if((int)@$number_person == 0){
					$arrError["number_person"] = 'Vui lòng chọn số lượng người tham dự';
					$arrData["number_person"] = "";					
					$flag=0;
				}
				if((int)@$flag==1){
					$data=array();
					$option_name = 'zendvn_sp_setting';
					$data = get_option('zendvn_sp_setting',array());				
					$smtp_host		= 	@$data['smtp_host'];
					$smtp_port		=	@$data['smtp_port'];
					$smtp_auth		=	@$data['smtp_auth'];
					$encription		=	@$data['encription'];
					$smtp_username	=	@$data['smtp_username'];
					$smtp_password	=	@$data['smtp_password'];		
					$email_to		=	@$data['email_to'];
					$contacted_name	=	@$data['contacted_name'];	
					$filePhpMailer=PLUGIN_PATH . "scripts" . DS . "phpmailer" . DS . "PHPMailerAutoload.php"	;
					require_once $filePhpMailer;		        
					$mail = new PHPMailer;      
					$mail->CharSet = "UTF-8";   
					$mail->isSMTP();             
					$mail->SMTPDebug = 2;
					$mail->Debugoutput = 'html';
					$mail->Host = @$smtp_host;
					$mail->Port = @$smtp_port;
					$mail->SMTPSecure = @$encription;
					$mail->SMTPAuth = (int)@$smtp_auth;
					$mail->Username = @$smtp_username;
					$mail->Password = @$smtp_password;
					$mail->setFrom(@$email, $fullname);
					$mail->addAddress(@$email_to, @$contacted_name);
					$mail->Subject = 'Thông tin đặt bàn từ khách hàng '.$fullname.' - '.$mobile ;       
					$html_content='<h3>Thông tin đặt bàn từ khách hàng '.$fullname.'</h3>';
					$html_content .='<p>Họ và tên : <b>'.$fullname.'</b></p>'; 
					$html_content .='<p>Email : <b>'.$email.'</b></p>'; 
					$html_content .='<p>Mobile : <b>'.$mobile.'</b></p>'; 
					$html_content .='<p>Ngày đặt : <b>'.$datebooking.'</b></p>'; 
					$html_content .='<p>Vào lúc : <b>'.$timebooking.'</b></p>'; 
					$html_content .='<p>Số lượng : <b>'.$number_person.'</b></p>'; 
					$html_content .='<p>Message : '.$message.'</p>'; 
					$mail->Body=$html_content;
				}				
				if ($mail->send()) {               	
					$success='Đặt bàn hoàn tất'; 
				}
				else{
					$arrError["contact_error"]='Quá trình gửi dữ liệu gặp sự cố'; 
				}				
			}
		}	
		$zController->_data["data"] = $arrData;
		$zController->_data["error"] = $arrError;			
		$zController->_data["success"] = $success;			
	}
}