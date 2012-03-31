<?php

class HomeController extends Zend_Controller_Action {

    public function init() {
        $uri = $this->_request->getPathInfo();
        $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();
        $activeNav = $this->view->navigation()->findByUri($baseUrl . $uri);
        $activeNav->active = true;
    }

    public function indexAction() {
        $request = $this->getRequest();
        $projectId = $request->getParam('projectId');
        $this->view->assign("projectId", $projectId);

        $projects = new Application_Model_ProjectsMapper();
        $this->view->projects = $projects->fetchAll();
    }
}