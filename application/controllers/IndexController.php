<?php

class IndexController extends Zend_Controller_Action {
	
	public function init() {
		/* Initialize action controller here */
	}
	
	public function indexAction() {

		$request = $this->getRequest ();
		$key = $request->getParam ( "urlKey" );

		if ($key != "url" && $key != "") {

			$url = new Default_Model_Url ( );
			$url->findByKey ( $key );
			if($url->getUrl()){
				$event = new Default_Model_UrlEvent();
				$event->setUrlId($url->getId());
				$event->save();
				$this->_redirect ( $url->getUrl (), array( "code" => 301) );
			}
			else{
				// TODO: implement Error Message from invalid URL
				$this->_redirect ();
			}
		} 
		else {
			$this->HandleForm ( $request );
		}
	}
		
	public function showAction() {
		$request = $this->getRequest ();
		$key = $request->getParam ( "urlKey" );

		$model = new Default_Model_Url ( );
		$model->findByKey ( $key );
		$this->view->urlObj = $model;
		$this->HandleForm ( $request );

		$this->view->copyPasteForm = new Default_Form_ShortUrlCopyForm();
	}
	
	private function HandleForm($request) {
		$form = new Default_Form_Url ( );
		
		if ($request->isPost ()) {
			
			$redirector = $this->_helper->getHelper ( 'redirector' );
			
			if ($form->isValid ( $request->getPost ())) {
				
				$model = new Default_Model_Url ( $form->getValues () );
				
				$random = new Basis42_String_Random ( );
				
				$model->setKey ( $random->getRandomString ( 6 ) );
				$model->save ();
				
				$redirector->gotoSimpleAndExit ( 'show', 'index', 'default', array ('urlKey' => $model->getKey () ) );
			}
		}
		$this->view->form = $form;
	}
	
	
}





