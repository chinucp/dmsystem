<?php

class ProjectsController extends Zend_Controller_Action {

    public function init() {


    }

    public function indexAction() {

        // For navigation
        $uri = $this->_request->getPathInfo();
        $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();
        $activeNav = $this->view->navigation()->findByUri($baseUrl . $uri);
        $activeNav->active = true;

        // Listing all projects.
        $projects = new Application_Model_ProjectsMapper();
        $this->view->projects = $projects->fetchAll();

        $db = Zend_Db_Table::getDefaultAdapter();
        $select = new Zend_Db_Select($db);

        // Fetch users
        // TODO get User type dynamically based on user login
        $currentUserType = 1;
        $select->from('users', array(
            'user_types_id', 'first_name', 'last_name'
        ))->where("user_types_id > $currentUserType")->order('first_name');
        $users = $db->query($select)->fetchAll();
        $this->view->users = $users;

        $select = new Zend_Db_Select($db);

        //Fetch Status
        $select->from('project_statuses', array(
            'id', 'status'
        ))->order('sort_order');
        $statuses = $db->query($select)->fetchAll();
        $this->view->statuses = $statuses;

        // Fetch Project types.
        $select = new Zend_Db_Select($db);
        $select->from('project_types', array(
            'id', 'type'
        ))->order('sort_order');
        $projectTypes = $db->query($select)->fetchAll();
        $this->view->projectTypes = $projectTypes;
    }

    public function addAction() {

        $db = Zend_Db_Table::getDefaultAdapter();

        // Form submit action. Insert new project.
        $request = $this->getRequest();
        if ($request->isPost()) {
            // Insert to DB.
            $stmt = $db->query("INSERT INTO `projects` (`id`,
            											`project_types_id`,
            											`project_statuses_id`,
            											`name`,
            											`description`,
            											`start_date`,
            											`end_date`,
            											`status`,
            											`last_updated_date`,
            											`effective_end_date`)
            								VALUES (NULL,
            											'".$request->projectType."',
            											'".$request->status."',
            											'".$request->projectName."',
            											'".$request->description."',
            											'".date("Y-m-d", strtotime($request->startDate))."',
            											'".date("Y-m-d", strtotime($request->endDate))."',
            											'1',
            											CURRENT_TIMESTAMP,
            											'0000-00-00'
            									);");
        }
        // Redirect to Projects list page.
        $this->_helper->redirector('index', 'projects');
    }

    public function editAction() {
        $form = new Application_Form_AddProject();
        $this->view->form = $form;
        $this->render('add');
    }

    public function releaseviewAction() {
        $projects = new Application_Model_ProjectsMapper();
        $this->view->projects = $projects->fetchAll();
    }

    public function releaseaddAction() {
        $projects = new Application_Model_ProjectsMapper();
        $this->view->projects = $projects->fetchAll();
    }

    public function releaseeditAction() {
        $projects = new Application_Model_ProjectsMapper();
        $this->view->projects = $projects->fetchAll();
        $this->render('releaseadd');
    }
}
