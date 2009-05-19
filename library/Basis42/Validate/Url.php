<?php

class Basis42_Validate_Url extends Zend_Validate_Abstract
{
    const INVALID_URL = 'invalidUrl';

    protected $_messageTemplates = array();
    
    function  __construct(){
 	$translate = Zend_Registry::get('Zend_Translate'); 
    $this->_messageTemplates = array(
            self::INVALID_URL              => "'%value%' " . $translate->translate("INVALID_URL"),
        );     
    }
    public function isValid($value)
    {
        $valueString = (string) $value;
        
        $this->_setValue($valueString);

        if (!Zend_Uri::check($value)) {
            $this->_error(self::INVALID_URL);
            return false;
        }
        return true;
    }
} 
?>