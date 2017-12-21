<?php
class Module{	
	private $_module_options = array();	
	public function __construct(){		
		$this->_module_options = array(																				
					"loadModuleCategory" 					=> true,	
					"loadModuleItem" 				=> true,							
				);
		foreach ($this->_module_options as $key => $val){	
			if($val == true){
				add_action('widgets_init',array($this,$key));
			}
		}
	}			
	public function loadModuleCategory(){
		require_once PLUGIN_PATH . DS . 'module'. DS .'module-category.php';		
		register_widget('ModuleCategory');
	}
	public function loadModuleItem(){
		require_once PLUGIN_PATH . DS . 'module'. DS .'module-item.php';		
		register_widget('ModuleItem');
	}
}