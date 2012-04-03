<?php

class BaseController extends Zend_Controller_Action {
	public $authSession;

    public function init() {
    	$this->authSession = new Application_Model_Auth();
    	// selection of navigation menu
    	$this->navigationSelection();

    	// check for authectication for each controller call
		$this->authentication();
		

    }

    public function indexAction() {

    }
    /**
     * @desc highlighting the navigation menu
     * @param void
     * @return void
     */
    protected function navigationSelection(){
       	$uri = $this->_request->getPathInfo();
        $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();
        $activeNav = $this->view->navigation()->findByUri($baseUrl . $uri);
        $activeNav->active = true;
    }
    /**
     *
     * @desc check for authenticated user
     * @param void
     * @return void
     *
     */
    protected function authentication(){
    	$auth = Zend_Auth::getInstance();
    	if ($auth->hasIdentity()) {
			$authData = $auth->getIdentity();
			$this->authSession->setRole($authData->user_types_id);
			$this->authSession->setAuthId($authData->id);
			$this->authSession->setAuthName($authData->username);
		}else{
			// If authentication failed then go to the login page
			$this->_redirect('/');
		}
    }
   
    

}
