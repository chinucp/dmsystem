<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        $this->_helper->layout->disableLayout();
        $this->_helper->layout->setLayout('loginlayout');
        /*
        $uri = $this->_request->getPathInfo();
        $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();
        $activeNav = $this->view->navigation()->findByUri($baseUrl.$uri);
        $activeNav->active = true;
         */
    }

    public function indexAction() {
    	$auth = Zend_Auth::getInstance();
        $form = new Application_Form_Login();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                if ($this->_process($form->getValues())) {
                    // We're authenticated! Redirect to the home page
                    $this->_helper->redirector('index', 'dashboard');
                }
            }
        }
        // land to the dashboard if user already logged in
    	if ($auth->hasIdentity()) {
			$this->_redirect('dashboard');
		}
        $this->view->form = $form;
    }

    protected function _process($values) {
        // Get our authentication adapter and check credentials
        $adapter = $this->_getAuthAdapter();
        $adapter->setIdentity($values['username']);
        $adapter->setCredential(md5($values['password']));
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        if ($result->isValid()) {
            $user = $adapter->getResultRowObject();
            $auth->getStorage()->write($user);
            return true;
        }
        return false;
    }

    protected function _getAuthAdapter() {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        $authAdapter->setTableName('dms_users')->setIdentityColumn('dms_users_username')->setCredentialColumn('dms_users_password');
        return $authAdapter;
    }

    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index'); // back to login page
    }
}
