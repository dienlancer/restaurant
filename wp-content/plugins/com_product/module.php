<?php
class Module{	
	private $_module_options = array();	
	public function __construct(){		
		$this->_module_options = array(																				
					"loadModuleCommon" 					=> true,	
					"loadModuleItem" 				=> true,							
				);
		foreach ($this->_module_options as $key => $val){	
			if($val == true){
				add_action('widgets_init',array($this,$key));
			}
		}
	}			
	public function loadModuleCommon(){
		require_once PLUGIN_PATH . DS . 'module'. DS .'module-common.php';		
		register_widget('ModuleCommon');
	}
	public function loadModuleItem(){
		require_once PLUGIN_PATH . DS . 'module'. DS .'module-item.php';		
		register_widget('ModuleItem');
	}
}