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
		$result = $this->_mapper->fetchStoryGraphDetails($projectId,$releaseId);
		foreach($result as $arrAxis){
			$barDatax[] = $arrAxis->dmsProjectsName;
			$barDatay[] = $arrAxis->storypoints;
		}
		//$barDatax=array("Careers Portal","WDW","DCL","DLR");
		//$barDatay=array(120,300,90,75);
		$barTitleArr = array(
				'x'=>"Projects --->",  // x axis title
				'y'=>"No. of Story Points --->", // y axis title
				'm'=>"Projectwise Story Points" // main title
		);
		
		$fileName = $this->_util->graphFileName('storygraph');
		return  $this->drawBarGraph($fileName,$barDatax,$barDatay,$barTitleArr);
	}
	
	public function drawTrend($projectId,$releaseId){
		$result = $this->_mapper->fetchTrendGraphDetails($projectId,$releaseId);
		$lineDatay['Stories'][0] = 'blue';
		$lineDatay['Hours'][0] = 'red';
		$lineDatay['Defects'][0]= 'green';
		foreach($result as $arrAxis){
			$lineDatax[] = $arrAxis->dmsProjectsName;
			$lineDatay['Stories'][1][] = $arrAxis->storypoints;
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
				'm'=>"Projects Trend Graph" // main title
		); // if reqd x and y titles can be set
		$fileName = $this->_util->graphFileName('trendgraph');
		return  $this->drawTrendGraph($fileName,$lineDatax,$lineDatay,$lineTitleArr);
	}
	
	public function drawHour($projectId,$releaseId){
		$result = $this->_mapper->fetchHourGraphDetails($projectId,$releaseId);
		foreach($result as $arrAxis){
			$barDatax[] = $arrAxis->dmsProjectsName;
			$barDatay[] = $arrAxis->hoursWorked;
		}
		$barTitleArr = array(
				'x'=>"Projects --->",  // x axis title
				'y'=>"No. of Hours --->", // y axis title
				'm'=>"Projectwise Hours" // main title
		);
		$util = new Application_Model_Util();
		$fileName = $this->_util->graphFileName('hourgraph');
		return  $this->drawBarGraph($fileName,$barDatax,$barDatay,$barTitleArr);
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
