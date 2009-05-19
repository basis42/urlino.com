<?php

class Default_Form_Url extends Zend_Form
{
    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');
		$this->setAttrib('id', 'urlForm');
		$this->clearDecorators();
		
		$this->setDecorators(array('FormElements','Form'));
		$this->addElementPrefixPath('Basis42_Form_Decorator', 'Basis42/Form/Decorator', 'decorator');
		
        $elem = new Zend_Form_Element_Text('url');
        $elem->setOptions(array(
            'required'   => true,
            'filters'    => array('StringTrim')));
        
        if($elem->getValue() == NULL)
        	$elem->setValue("http://");
        	
        $elem->setLabel('URL:')
        	->clearDecorators()
          	->addDecorator('ViewHelper')
        	->addDecorator('PopupErrors')
          	->addDecorator('Label')
        	->addDecorator('HtmlTag', array('tag'=>'div', 'id'=>'urlLabel')); 
        
		$elem->addPrefixPath('Basis42_Validate', 'Basis42/Validate/', 'validate');
        $elem->addValidator("Url");
        
		// Add url element
        $this->addElement($elem);
            
        $elem = new Zend_Form_Element_Submit('submitButton');
        $elem->setOptions(array(
            'ignore'   => true,
            'label'    => $this->getView()->translate('INDEX_FORM_GETURL')
            ));
		
        $elem->clearDecorators()
          	->addDecorator('ViewHelper')
          	->addDecorator('Errors')
        	->addDecorator('HtmlTag', array('tag'=>'div', 'id'=>'urlSubmit')); 
                
        // Add the submit button
        $this->addElement($elem);
        	
        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'salt' => 'majo',
        ));
    }
}

?>