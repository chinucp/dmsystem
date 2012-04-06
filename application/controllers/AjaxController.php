<?php
require_once('BaseController.php');

class AjaxController extends BaseController {

    public function init() {
        // Setting up ajax output, creating its helper object and setting action type.
        $this->ajaxOutput();
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('index', 'json')->addActionContext('linkedin', 'json')->initContext('json');
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
		$totalDevHours = 0;
		$totalTestHours = 0;
		$totalReworkHoursDev = 0;
		$totalReworkHoursTest = 0;
		$totalReworkHours = 0;
		$totalMajorDefects = 0;
		$totalMinorDefects = 0;
		$totalDefects = 0;
		$totalNonSpeHours = 0;

        $releaseId = $this->_request->getParam('releaseid');

        $viewPageItems = new Application_Model_Db_Projects_Mapper();
		// Must Pass the id(releases id) for the particular record(s) to be fetched.
		$result = $viewPageItems->fetchProjectSprints($releaseId);

		foreach ($result as $sprints){
		       $totalStories = $totalStories + $sprints->dmsSprintslogStories;
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
                		        'totalDevHours' => $totalDevHours,
                		        'totalTestHours' => $totalTestHours,
                		        'totalReworkHours' => $totalReworkHours,
                		        'totalDefects' => $totalDefects,
                		        'totalMajorDefects' => $totalMajorDefects,
                		        'totalNonSpeHours' => $totalNonSpeHours
		                    );
		echo Zend_Json::encode($moreDetails);
		//$this->_helper->json($moreDetails);
    }
}
