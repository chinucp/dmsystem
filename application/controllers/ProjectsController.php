<?php

class ProjectsController extends Zend_Controller_Action
{

	public function init()
	{	/*
		$uri = $this->_request->getPathInfo();
		$activeNav = $this->view->navigation()->findByUri($uri);
		$activeNav->active = true;
		*/

		$uri = $this->_request->getPathInfo();
		$baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();
		$activeNav = $this->view->navigation()->findByUri($baseUrl.$uri);
		$activeNav->active = true;

	}

	public function indexAction()
	{
		$projects = new Application_Model_ProjectsMapper();
		$this->view->projects = $projects->fetchAll();

	}

	public function addAction(){


	}

}

