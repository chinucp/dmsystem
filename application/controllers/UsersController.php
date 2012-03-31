<?php

class UsersController extends Zend_Controller_Action {

    public function init() {
    }

    public function indexAction() {
        $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();
        $uri = $this->_request->getPathInfo();
        $activeNav = $this->view->navigation()->findByUri($baseUrl . $uri);
        $activeNav->active = true;
    }

    public function addAction() {
        $form = new Application_Form_AddUser();
        $this->view->form = $form;
    }

    public function editAction() {
        $form = new Application_Form_AddUser();
        $this->view->form = $form;
        $this->render('add');
    }
}
