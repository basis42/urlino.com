<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

	protected function _initDoctype() {
		$this->bootstrap ( 'view' );
		$view = $this->getResource ( 'view' );
		$view->doctype ( 'XHTML1_STRICT' );
	}
	protected function _initi18n() {
		$translate = new Zend_Translate('csv', APPLICATION_PATH . '/languages/lang_en.csv', 'en');
		$translate->addTranslation(APPLICATION_PATH . '/languages/lang_de.csv', 'de');
		$session = new Zend_Session_Namespace();
		if($session->locale != NULL){
			$translate->setLocale($session->locale);
		}
		else{
			$translate->setLocale("browser");
		}
		Zend_Registry::set('Zend_Translate', $translate);
		
	}
	protected function _initHelperPath(){
		$view = $this->getResource ( 'view' );
		$view->addHelperPath('Zend/Dojo/View/Helper/', 'Zend_Dojo_View_Helper');
	}
	protected function _initAutoload() {
		$autoloader = Zend_Loader_Autoloader::getInstance(); 
		$autoloader->registerNamespace('Basis42');
		
		$autoloader = new Zend_Application_Module_Autoloader ( array ('namespace' => 'Default_', 'basePath' => dirname ( __FILE__ ) ) );
		return $autoloader;
	}

		public function run(){
        
		$front   = $this->getResource('FrontController');
        $default = $front->getDefaultModule();
        if (null === $front->getControllerDirectory($default)) {
            throw new Zend_Application_Bootstrap_Exception(
                'No default controller directory registered with front controller'
            );
        }
        $front->setParam('bootstrap', $this);
        
        $router = $front->getRouter();
        $router->addRoute('index', new Zend_Controller_Router_Route(':urlKey',
                                     array('controller' => 'index',
                                           'action' => 'index')));
        
		$request = new Zend_Controller_Request_Http();
        $front->setRequest($request);
        
        $front->dispatch();

	}
	
}

