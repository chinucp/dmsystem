<?php

class MilestonesController extends Zend_Controller_Action
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

		$milestones = new Application_Model_MilestonesMapper();
		$this->view->milestones = $milestones->fetchAll();
    }


}

