<?php
/**
 * @name Application_Model_Db_Graphs_Graph
 *
 * This class initiates all the database interaction calls.
 */
class Application_Model_Db_Graphs_Graph extends Application_Model_Db_Graphs_GraphMapper
{
	protected $_jpgraph;
	protected $_util;
	protected $_mapper;

	/**
	 * @name Constructor
	 * @access public
	 *
	 * @param $tableName|string|default=null
	 * This sets up the table object.
	 */
	public function __construct($tableName = null)
	{
		$this->_jpgraph = new DMS_Jpgraph_Jpgraph();
		$this->_util = new Application_Model_Util();
		$this->_mapper = new Application_Model_Db_Graphs_Mapper();
	}

	public function drawStory($projectId,$releaseId){
	    $responseData['releases'] = $this->_mapper->fetchReleaseNames($projectId);
		$result = $this->_mapper->fetchStoryGraphDetails($projectId,$releaseId);
		if($projectId!='all' && $releaseId=='all'){
			$name = 'dmsReleasesName';
			$titleX = 'Release';
		}else if($projectId!='all' && $releaseId!='all'){
			$name ='dmsSprintsName';
			$titleX = 'Sprint';
		}else if( $projectId=='all' && $releaseId!='all'){
			$name ='dmsSprintsName';
			$titleX = 'Sprint';
		}else{
			$name = 'dmsProjectsName';
			$titleX = 'Project';
		}

		foreach($result as $arrAxis){
			$barDatax[] = $arrAxis->$name;
			$barDatay[] = $arrAxis->storypoints;
		}
		//echo '<pre>';print_r($barDatax);print_r($barDatay);
		//$barDatax=array("Careers Portal","WDW","DCL","DLR");
		//$barDatay=array(120,300,90,75);
		$barTitleArr = array(
				'x'=>$titleX."s-->",  // x axis title
				'y'=>"No. of Story Points --->", // y axis title
				'm'=>"Story Points" // main title
		);

		$fileName = $this->_util->graphFileName('storygraph');
		$responseData['graph'] = $this->drawBarGraph($fileName,$barDatax,$barDatay,$barTitleArr);
		return $responseData;
	}

	public function drawTrend($projectId,$releaseId){
	    $responseData['releases'] = $this->_mapper->fetchReleaseNames($projectId);
		$result = $this->_mapper->fetchTrendGraphDetails($projectId,$releaseId);
		if($projectId!='all' && $releaseId=='all'){
			$name = 'dmsReleasesName';
			//$titleX = 'Release';
		}else if($projectId!='all' && $releaseId!='all'){
			$name ='dmsSprintsName';
			//$titleX = 'Sprint';
		}else if( $projectId=='all' && $releaseId!='all'){
			$name ='dmsSprintsName';
			//$titleX = 'Sprint';
		}else{
			$name = 'dmsProjectsName';
			//$titleX = 'Project';
		}

		$lineDatay['Story Points'][0] = '#808000';
		$lineDatay['Hours'][0] = '#00CED1';
		$lineDatay['Defects'][0]= '#C71585';
		foreach($result as $arrAxis){
			$lineDatax[] = $arrAxis->$name;
			$lineDatay['Story Points'][1][] = $arrAxis->storypoints;
			$lineDatay['Hours'][1][] = $arrAxis->hoursWorked;
			$lineDatay['Defects'][1][] = $arrAxis->defects;
		}

		/* $lineDatax=array("Careers Portal","WDW","DCL","DLR");
		$lineDatay = array(
				"Stories"=> array("blue",array(28,19,18,23)),
				"Hours"=> array("red",array(14,18,33,29)),
				"Defects"=> array("green",array(14,20,15,25))
		); */


		$lineTitleArr = array(
				'm'=>"Trend Graph" // main title
		); // if reqd x and y titles can be set
		$fileName = $this->_util->graphFileName('trendgraph');
		$responseData['graph'] = $this->drawTrendGraph($fileName,$lineDatax,$lineDatay,$lineTitleArr);
		return $responseData;
	}

	public function drawHour($projectId,$releaseId){
	    $responseData['releases'] = $this->_mapper->fetchReleaseNames($projectId);
		$result = $this->_mapper->fetchHourGraphDetails($projectId,$releaseId);
		if($projectId!='all' && $releaseId=='all'){
			$name = 'dmsReleasesName';
			$titleX = 'Release';
		}else if($projectId!='all' && $releaseId!='all'){
			$name ='dmsSprintsName';
			$titleX = 'Sprint';
		}else if( $projectId=='all' && $releaseId!='all'){
			$name ='dmsSprintsName';
			$titleX = 'Sprint';
		}else{
			$name = 'dmsProjectsName';
			$titleX = 'Project';
		}
		foreach($result as $arrAxis){
			$barDatax[] = $arrAxis->$name;
			$barDatay[] = $arrAxis->hoursWorked;
		}
		$barTitleArr = array(
				'x'=>$titleX."s-->",  // x axis title
				'y'=>"No. of Hours --->", // y axis title
				'm'=>"Hours" // main title
		);
		$util = new Application_Model_Util();
		$fileName = $this->_util->graphFileName('hourgraph');
		$responseData['graph'] = $this->drawBarGraph($fileName,$barDatax,$barDatay,$barTitleArr);
		return $responseData;
	}


	public function drawGraph($params=array()){

		$graphType = isset($params['gtype'])?$params['gtype']:'td';  // show trend graph by default
		$projectId = isset($params['pid'])?$params['pid']:'all';
		$releaseId = isset($params['rid'])?$params['rid']:'all';
		switch($graphType){
			case 'td':
					return $this->drawTrend($projectId,$releaseId);
					break;
			case 'st':
					return $this->drawStory($projectId,$releaseId);
					break;
			case 'hr':
					return $this->drawHour($projectId,$releaseId);
					break;
		}
	}
}
