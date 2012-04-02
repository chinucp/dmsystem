<?php
require_once('BaseController.php');
class UsersController extends BaseController
{

	public function init()
	{	/*
		$uri = $this->_request->getPathInfo();
		$activeNav = $this->view->navigation()->findByUri($uri);
		$activeNav->active = true;
		*/
		parent::init();
		$uri = $this->_request->getPathInfo();
		$baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();
		$activeNav = $this->view->navigation()->findByUri($baseUrl.$uri);
		$activeNav->active = true;
	}

	public function indexAction()
	{
		// action body
	}


}

