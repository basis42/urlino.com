<?php

class Default_Form_ShortUrlCopyForm extends Zend_Form
{
    public function init()
    {
		$this->getView()->dojo()->enable();
		
		$this->getView()->dojo()->onLoadCaptureStart();
		
		echo'
		function() {
			copypaste = dojo.byId("copyPaste");
		    copypaste.select();
			copypaste.focus();
		    }
		';
		$this->getView()->dojo ()->onLoadCaptureEnd ();
		
		// Set the method for the display form to POST
		$this->setAttrib('id', 'copyForm');
		$this->clearDecorators();
		
		$this->setDecorators(array('FormElements','Form'));
		$this->addElementPrefixPath('Basis42_Form_Decorator', 'Basis42/Form/Decorator', 'decorator');
		
        $elem = new Zend_Form_Element_Text('copyPaste');
        
		$server = ereg_replace("www\\.", "", $_SERVER['SERVER_NAME']);
        $elem->setValue('http://'. $server . '/'. $this->getView()->urlObj->getKey());
        	
        $elem->setLabel('URL:')
        	->clearDecorators()
          	->addDecorator('ViewHelper')
        	->addDecorator('PopupErrors')
        	->addDecorator('HtmlTag', array('tag'=>'div', 'id'=>'copyPasteLabel')); 
        
		// Add url element
        $this->addElement($elem);
            
    }
}

?>