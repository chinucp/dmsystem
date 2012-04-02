<?php
require_once('BaseController.php');
class DashboardController extends BaseController {

    public function init() {
    	parent::init();
        $uri = $this->_request->getPathInfo();
        $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();
        $activeNav = $this->view->navigation()->findByUri($baseUrl . $uri);
        $activeNav->active = true;

    }

    public function indexAction() {
		$this->_forward('project');
    }

    public function projectAction() {
    	$dashboard = new Application_Model_DashboardMapper();
        $this->view->projects = $dashboard->fetchProjects();
        $this->render('project');
    }

	public function releaseAction() {
    	$dashboard = new Application_Model_DashboardMapper();
        $this->view->projects = $dashboard->fetchRelease();
        $this->render('release');
    }

	public function sprintAction() {
    	$dashboard = new Application_Model_DashboardMapper();
        $this->view->projects = $dashboard->fetchSprint();
        $this->render('sprint');
    }
}