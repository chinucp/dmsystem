<?php

class Zend_View_Helper_HasAccess extends Zend_View_Helper_Abstract
{
    private $_acl;
    public function hasAccess($action)
    {
    	$authSession = new Application_Model_Auth();
    	$role = $authSession->getRole();
    	$controller = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();
        if (!$this->_acl) {
            $this->_acl = Zend_Controller_Front::getInstance()->getPlugin('ACC_Controller_Plugin_Acl');
    	}

    	return $this->_acl->hasAccess($role, $controller, $action);
    }
}