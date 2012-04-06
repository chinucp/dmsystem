<?php
require_once('BaseController.php');
class DashboardController extends BaseController {

    public function init() {
    	parent::init();
    }

    public function indexAction() {
		//$dashboard = new Application_Model_DashboardMapper();
		$dashboard = new Application_Model_Db_Dashboard_Mapper();
        $projects  = $dashboard->fetchProjects();

        $this->view->projects  = $projects;
    }

}