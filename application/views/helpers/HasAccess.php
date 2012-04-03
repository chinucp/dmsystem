<?php

class Zend_View_Helper_HasAccess extends Zend_View_Helper_Abstract
{
    private $_acl;
    public function hasAccess($action)
    {
    	$role = $this->view->fetchRole();
    	$controller = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();
        if (!$this->_acl) {
            $this->_acl = Zend_Controller_Front::getInstance()->getPlugin('Acl');
           // echo '<pre>';print_r($this->_acl);
        }

        //return $this->_acl->isAllowed($role, $controller, $action);
    }
}