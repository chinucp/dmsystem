<?php
require_once('BaseController.php');
class GraphsController extends BaseController
{
	private $_grpahModel;
	private $_mapperModel;

	public function init()
	{
		parent::init();
		Zend_Registry::set('jpgraph',new DMS_Jpgraph_Jpgraph());
		$this->_graphModel = new Application_Model_Db_Graphs_Graph();
		$this->_mapperModel = new Application_Model_Db_Graphs_Mapper();
	}

	public function indexAction()
	{
		$pid= '';
		$params = $this->_request->getParams();
		ob_flush();
		
		$params['gtype'] = isset($params['gtype'])?$params['gtype']:'td';  // show trend graph by default
		$params['pid'] = isset($params['pid'])?$params['pid']:'all';
		$params['rid'] = isset($params['rid'])?$params['rid']:'all';
		$this->view->params = $params;
		
		if('all' != $params['pid']){
			$pid = $params['pid'];
		}
		
		$this->view->projectname = $this->_mapperModel->fetchProjectNames();
		$this->view->releasename = $this->_mapperModel->fetchReleaseNames($pid);
		$this->view->graphtype = $this->_mapperModel->fetchGraphTypes();


		$resultGraph = $this->_graphModel->drawGraph($params);
		$this->view->renderGraph = $resultGraph['graph'];
	}

	public function barchartAction()
	{

	}

	public function linegraphAction()
	{

	}

}

