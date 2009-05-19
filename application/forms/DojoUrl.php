<?php
class Default_Form_DojoUrl extends Zend_Dojo_Form{
    public function init()
    {
		$this->setAttrib('id', 'urlForm');
		$this->clearDecorators();
		
		$elem = new Zend_Dojo_Form_Element_ValidationTextBox("url", array(
            'required'   => true,
            'filters'    => array('StringTrim')));
        
        if($elem->getValue() == NULL)
        	$elem->setValue("http://");
        	
        $elem->setLabel('URL:')
        ->clearDecorators()
        	->addDecorator('Errors')
        	->addDecorator('Label')
        ->addDecorator('HtmlTag', array('tag'=>'div', 'id'=>'urlLabel')); 
        
		$elem->addPrefixPath('Basis42_Validate', 'Basis42/Validate/', 'validate');
        $elem->addValidator("Url");
        
		// Add url element
        $this->addElement($elem);
		
    	$this->addElement('Button',
    		'foo',
		    array(
		        'label' => 'Button Label',
		    )
		);
    }
}

?>