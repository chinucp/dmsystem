<?php
require_once('BaseController.php');
class GraphsController extends BaseController
{

	public function init()
	{
		parent::init();
		Zend_Registry::set('jpgraph',new DMS_Jpgraph_Jpgraph());
	}

	public function indexAction()
	{
		
	}
	
	public function barchartAction()
	{
		
	}
	
	public function linegraphAction()
	{
		
	}

}

