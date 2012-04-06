<?php
/**
 * Controller
 *
 * @category Controller
 * @package    BaseController
 *
 * This file actions required for the project page.
 *
 */

/**
 * Include the basecontroller which contains the common and necessary methods for all.
 */
require_once('BaseController.php');

/**
 * @name ProjectsController
 * @category   Controller
 * @package    BaseController
 *
 * This class contains the different actions for projects page.
 */
class ProjectsController extends BaseController {

    public function init() {
    	parent::init();
    }

    /**
	 * @name indexAction
	 * @access public
	 *
	 * This method controls projects page.
	 */
    public function indexAction() {

		$viewPageItems = new Application_Model_Db_Projects_Mapper();
		// Pass the id for the particular record to be fetched. If not all the genuine records will be fetched.
		$this->view->viewPageItems = $viewPageItems->fetchProjects();
    }

    /**
	 * @name releasesAction
	 * @access public
	 *
	 * This method controls release page.
	 */
    public function releasesAction() {

        $projectsId = $this->_request->getParam('projectsId');
    	$viewPageItems = new Application_Model_Db_Projects_Mapper();
		// Must Pass the id(project id) for the particular record(s) to be fetched.
		$this->view->viewPageItems = $viewPageItems->fetchProjectReleases($projectsId);
    }

    /**
	 * @name sprintsAction
	 * @access public
	 *
	 * This method controls sprints page.
	 */
    public function sprintsAction() {

    	$viewPageItems = new Application_Model_Db_Projects_Mapper();
		// Must Pass the id(releases id) for the particular record(s) to be fetched.
		$this->view->viewPageItems = $viewPageItems->fetchProjectSprints($releasesId);
    }
}
