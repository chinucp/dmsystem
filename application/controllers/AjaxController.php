<?php
require_once('BaseController.php');

class AjaxController extends BaseController {

    public function init() {
        // Setting up ajax output, creating its helper object and setting action type.
        $this->ajaxOutput();
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('index', 'json')
        			->addActionContext('releasemodal', 'json')
        			->addActionContext('generate-graph', 'html')
        			->addActionContext('filter-dashboard-projects', 'html')
        			->initContext('json');
    }
    /**
     *  To disable layout during Ajax Output.
     */

    private function ajaxOutput() {
        unset($this->view->constants);
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
    }

    public function releasemodalAction() {
        $this->ajaxOutput();
        //$this->view->linkHtml = $this->view->partial('');

        $totalStories = 0;
        $totalStoryPoints = 0;
		$totalDevHours = 0;
		$totalTestHours = 0;
		$totalReworkHoursDev = 0;
		$totalReworkHoursTest = 0;
		$totalReworkHours = 0;
		$totalMajorDefects = 0;
		$totalMinorDefects = 0;
		$totalDefects = 0;
		$totalNonSpeHours = 0;

        $releaseId = $this->_request->getParam('rid');

        $viewPageItems = new Application_Model_Db_Projects_Mapper();
		// Must Pass the id(releases id) for the particular record(s) to be fetched.
		$result = $viewPageItems->fetchProjectSprints($releaseId);

		foreach ($result as $sprints){
		       $totalStories = $totalStories + $sprints->dmsSprintslogStories;
		       $totalStoryPoints = $totalStoryPoints + $sprints->dmsSprintslogStorypoints;
		       $totalDevHours = $totalDevHours + $sprints->dmsSprintslogDev;
		       $totalTestHours = $totalTestHours + $sprints->dmsSprintslogTest;
		       $totalReworkHoursDev = $totalReworkHoursDev + $sprints->dmsSprintslogReworkdev;
		       $totalReworkHoursTest = $totalReworkHoursTest + $sprints->dmsSprintslogReworktest;
		       $totalReworkHours = $totalReworkHours + $totalReworkHoursTest + $totalReworkHoursDev;
		       $totalMajorDefects = $totalMajorDefects + $sprints->dmsSprintslogMajordefects;
		       $totalMinorDefects = $totalMinorDefects + $sprints->dmsSprintslogMinordefects;
		       $totalDefects = $totalDefects + $totalMajorDefects + $totalMinorDefects;
		       $totalNonSpeHours = $totalNonSpeHours + $sprints->dmsSprintslogNonspe;
		}

		$moreDetails = array(	'totalStories' => $totalStories,
								'totalStoryPoints' => $totalStoryPoints,
                		        'totalDevHours' => $totalDevHours,
                		        'totalTestHours' => $totalTestHours,
                		        'totalReworkHours' => $totalReworkHours,
                		        'totalDefects' => $totalDefects,
                		        'totalMajorDefects' => $totalMajorDefects,
                		        'totalNonSpeHours' => $totalNonSpeHours
		                    );

		$this->_helper->json($moreDetails);
		// This started not working !!! Reason no idea !
		//echo Zend_Json::encode($moreDetails);

    }

    public function generateGraphAction() {
    	$this->ajaxOutput();
    	ob_flush();
    	$params = $this->_request->getParams();
    	$graph = new Application_Model_Db_Graphs_Graph();
    	$this->_helper->json($graph->drawGraph($params));
    }

    public function filterDashboardProjectsAction(){
    	$this->ajaxOutput();
    	$params = $this->_request->getParams();
    	$proshowtype = isset($params['proshowtype'])?$params['proshowtype']:'cm';

    	$dashboard = new Application_Model_Db_Dashboard_Mapper();
    	$projects  = $dashboard->fetchProjects('',$proshowtype);
    	//echo '<pre>';print_r($projects);die;
    	$this->view->projects  = $projects;
    	$this->render('dashboard/records','',true);
    }
}
