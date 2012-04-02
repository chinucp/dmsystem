<?php

class BaseController extends Zend_Controller_Action {

    public function init() {
    	$this->authentication();
    }

    public function indexAction() {

    }
    public function authentication(){
    	$auth = Zend_Auth::getInstance();
    	if ($auth->hasIdentity()) {
			$authData = $auth->getIdentity();
		}else{
			// If authentication failed then go to the login page
			$this->_redirect('/');
		}
    }
    public function fetchRole(){

    }

}
