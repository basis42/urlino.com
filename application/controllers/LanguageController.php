<?php

class LanguageController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		$request = $this->getRequest ();
		$lang = $request->getParam("locale");
		$locale = new Zend_Locale($lang);
		Zend_Registry::set('Zend_Locale', $locale);

		$session = new Zend_Session_Namespace();
		$session->locale = $locale;
		
		$redirector = $this->_helper->getHelper ( 'redirector' );
		
		$redirector->gotoSimpleAndExit ( 'index', 'index', 'default' );

    }


}

