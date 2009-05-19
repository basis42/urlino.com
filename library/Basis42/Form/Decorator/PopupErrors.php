<?php

class Basis42_Form_Decorator_PopupErrors extends Zend_Form_Decorator_Errors {
	
	public function render($content) {
		$element = $this->getElement ();
		$view = $element->getView ();
		if (null === $view) {
			return $content;
		}
		
		$errors = $element->getMessages ();
		if (empty ( $errors )) {
			return $content;
		}
		$view->dojo()->enable()
		->requireModule( 'dijit.form.Button' )
		->requireModule ( 'dijit.Dialog' );
		
		$separator = $this->getSeparator ();
		$placement = $this->getPlacement ();
		
		$errors = implode ( " ", $errors );
		$view->headScript()->captureStart();
		
		echo '
		function closeDialog(){
			var confirm = dijit.byId("conf");
			confirm.hide();
		}
		';		
		$view->headScript()->captureEnd();
		
		$view->dojo()->onLoadCaptureStart();
		
echo'
		function() {
		    var dialog = new dijit.Dialog({
		        id: "conf",
		    	title:   "'.$view->translate("POPUP_ERROR").'",
		        style:   "width: 400px;",
		        closable: true,
		        content: "' . $errors . '<br><br><div align=\"center\"><div id=\"closeButton\" dojoType=\"dijit.form.Button\">OK</div></div>"
		    });
		    btn = dijit.byId("closeButton");
		    dojo.connect(btn, "onClick", "closeDialog");
		    
		    dialog.show();
		}
		';
		
		$view->dojo ()->onLoadCaptureEnd ();
		
		return $content;
	
	}

}
?>