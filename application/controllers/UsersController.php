<?php
require_once('BaseController.php');
class UsersController extends BaseController
{

	public function init()
	{
		parent::init();

	}

	public function indexAction()
	{
		$viewPageItems = new Application_Model_Db_Users_Mapper();

		$this->view->viewPageItems = $viewPageItems->fetchViewPageItems();
        print_r($this->view->viewPageItems);

		$this->view->userTypeItems = $viewPageItems->fetchAddPageUserTypeItems();
        print_r($this->view->userTypeItems);

        $this->view->desigsItems = $viewPageItems->fetchAddPageDesigsItems();
        print_r($this->view->desigsItems);

        $this->view->desigsItems = $viewPageItems->fetchAddPageRolesItems();
        print_r($this->view->desigsItems);
        die;
	}


}

