<?php
/**
 * Model
 *
 * @category Application_Model_Db
 * @package    DMS_Db_Interactions
 *
 * This file is used for all the database interactions.
 *
 */

/**
 * @name Application_Model_Db_Dashboard_Mapper
 * @category   DMS_Db
 * @package    DMS_Db_Interactions
 *
 * This class initiates all the database interaction calls.
 */
class Application_Model_Db_Dashboard_Mapper extends DMS_Db_Interactions
{
	/**
	 * @name Constructor
	 * @access public
	 *
	 * @param $tableName|string|default=null
	 * This sets up the table object.
	 */
	public function __construct($tableName = null)
	{
		empty($tableName) ? $this->setDbTable('Application_Model_Db_Dashboard_Table') : $this->setDbTable('Application_Model_Db_Dashboard_Table', $tableName);
	}

	/**
	 * @desc fetch the last current and next future sprint details
	 * @access public
	 * @param void
	 * @return void
	 */
	public function fetchProjectViewType(){
	
		$projectViewType = array( 'cm'=>'Current Milestone',
				'pm'=>'Past Milestone',
				'um'=>'Upcoming MileStone',
		);
		return $projectViewType;
	
	}
	
	
	/**
	 * @name fetchProjects
	 * @access public
	 *
	 * @param $projectId|int|default null
	 * This method fetches all the items to be displayed in projects view page.
	 */
	public function fetchProjects($projectId = null,$proshowtype='cm')
	{
		$query = array("from" => array("tableName" => array('p' => 'dms_projects'),
    		"colsToBFetched" => array("p.dms_projects_id",
    			 "p.dms_projects_name",
				 "p.dms_projects_objectives",
				 "DATE_FORMAT(s.dms_sprints_start_date, '%d/%m/%Y') AS dms_sprints_start_date",
    			 "DATE_FORMAT(s.dms_sprints_end_date, '%d/%m/%Y') AS dms_sprints_end_date",
    			 "p.dms_projects_active"
    			)
    		),
    		"innerJoin#1" => array("tableName" => array("r" => "dms_releases"),
    			"condition" => "p.dms_projects_id = r.dms_releases_projects_id",
    			"columns" => array("r.dms_releases_name","r.dms_releases_id")
    		),
    		"innerJoin#2" => array("tableName" => array("s" => "dms_sprints"),
    			"condition" => "r.dms_releases_id = s.dms_sprints_releases_id",
    			"columns" => array("s.dms_sprints_name")
    		),
    		"innerJoin#3" => array("tableName" => array("pt" => "dms_project_type"),
    			"condition" => "p.dms_projects_projecttype_id = pt.dms_projecttype_id",
    			"columns" => array("pt.dms_projecttype_name","pt.dms_projecttype_alias")
    		)
    	);
		if($proshowtype == 'pm'){
			$query["where"] = array("condition" => "s.dms_sprints_status_id = 2");
			$query["order"] = array("columns" => array("s.dms_sprints_start_date DESC"));
		}else if($proshowtype == 'um'){
			$query["where"] = array("condition" => "s.dms_sprints_status_id = 3");
			$query["order"] = array("columns" => array("s.dms_sprints_start_date ASC"));
			
		}else{  // for current milestone default
    		$query["where"] = array("condition" => "now( )
					BETWEEN S.dms_sprints_start_date
					AND S.dms_sprints_end_date");
    		$query["order"] = array("columns" => array("s.dms_sprints_start_date ASC"));
		}
    	if (!empty($projectId)) {
    			$query["where"] = array("condition" => "p.dms_projects_id = " . $projectId);   			
    			
    	}
    	
    	$this->formQuery($query);
		return $this->getDisplayItems();
    }


    /**
	 * @name getDisplayItems
	 * @access private
	 *
	 * This method gives you the various display items that you need.
	 */
    private function getDisplayItems()
    {
    	$resultSet = $this->fetchData();

    	$displayItems = array();
        $resultSetArray = $resultSet->toArray();
        foreach ($resultSetArray as $rowArray) {
        	$usersManager = new Application_Model_Db_Dashboard_Manager();
 			$usersManager->setOptions($rowArray);
			$displayItems[] = $usersManager;
		}
		return $displayItems;
    }

    /**
	 * @name formQuery
	 * @access private
	 *
	 * @param $queryParams|array|default=null
	 * This method forms the query array that is used by the fetch operation.
	 */
    private function formQuery(array $queryParams = null)
    {
    	$this->_fetchQuery = $queryParams;

    }

  /**
  * @name clearFetchQuery
  * @access private
  *
  * This method clears the existing fetchQuery.
  */
    private function clearFetchQuery()
    {
        $this->_fetchQuery = array();
    }


}
