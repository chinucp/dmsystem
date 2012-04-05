<?php
require_once('BaseController.php');
class DashboardController extends BaseController {

    public function init() {
    	parent::init();
    }

    public function indexAction() {
		$dashboard = new Application_Model_DashboardMapper();
        $this->view->projects = $dashboard->fetchProjects();
        
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