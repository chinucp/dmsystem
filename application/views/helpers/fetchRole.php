<?php

class Zend_View_Helper_FetchRole extends Zend_View_Helper_Abstract
{

    public function fetchRole()
    {
       $role = new Zend_Session_Namespace("auth");
	   return $role->name;
    }
}