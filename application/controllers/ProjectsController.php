<?php

class ProjectsController extends Zend_Controller_Action {

    public function init() {
        /*
        $uri = $this->_request->getPathInfo();
        $activeNav = $this->view->navigation()->findByUri($uri);
        $activeNav->active = true;
         */
        $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();
        $uri = $this->_request->getPathInfo();
        $activeNav = $this->view->navigation()->findByUri($baseUrl . $uri);
        $activeNav->active = true;
    }

    public function indexAction() {
        $projects = new Application_Model_ProjectsMapper();
        $this->view->projects = $projects->fetchAll();
    }

    public function addAction() {
        $form = new Application_Form_AddProject();
        $this->view->form = $form;
    }

    public function editAction() {
        $form = new Application_Form_AddProject();
        $this->view->form = $form;
        $this->render('add');
    }

    public function releaseviewAction() {
        $projects = new Application_Model_ProjectsMapper();
        $this->view->projects = $projects->fetchAll();
    }

    public function releaseaddAction() {
        $projects = new Application_Model_ProjectsMapper();
        $this->view->projects = $projects->fetchAll();
    }

    public function releaseeditAction() {
        $projects = new Application_Model_ProjectsMapper();
        $this->view->projects = $projects->fetchAll();
        $this->render('releaseadd');
    }
}
