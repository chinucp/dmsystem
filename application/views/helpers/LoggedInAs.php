<?php

class Zend_View_Helper_LoggedInAs extends Zend_View_Helper_Abstract {

    public function loggedInAs() {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $username = $auth->getIdentity()->dms_users_username;
            $firstName = $auth->getIdentity()->dms_users_firstname;
            $lastName = $auth->getIdentity()->dms_users_lastname;
            $logoutUrl = $this->view->url(array(
                'controller' => 'index', 'action' => 'logout'
            ), null, true);
            return 'Signed in as: <b>' . ucfirst($firstName) . ' ' . ucfirst($lastName) . '</b>. Click here to<a href="'
                            . $logoutUrl . '">Sign out</a>';
        }
        $request = Zend_Controller_Front::getInstance()->getRequest();
        $controller = $request->getControllerName();
        $action = $request->getActionName();
        if ($controller == 'index' && $action == 'index') {
            return '';
        }
        $loginUrl = $this->view->url(array(
            'controller' => 'index', 'action' => 'index'
        ));
        return '<a href="' . $loginUrl . '">Login</a>';
    }
}
