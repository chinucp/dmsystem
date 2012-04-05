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
 * @name Application_Model_Db_Projects_Mapper
 * @category   DMS_Db
 * @package    DMS_Db_Interactions
 *
 * This class initiates all the database interaction calls.
 */
class Application_Model_Db_Projects_Mapper extends DMS_Db_Interactions
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
		empty($tableName) ? $this->setDbTable('Application_Model_Db_Projects_Table') : $this->setDbTable('Application_Model_Db_Projects_Table', $tableName);
	}

	/**
	 * @name fetchProjects
	 * @access public
	 *
	 * @param $projectId|int|default null
	 * This method fetches all the items to be displayed in projects view page.
	 */
	public function fetchProjects($projectId = null)
	{
		$query = array("from" => array("tableName" => array('p' => 'dms_projects'),
    		"colsToBFetched" => array("dms_projects_id",
    			"dms_projects_name",
    			"DATE_FORMAT(dms_projects_start_date, '%d/%m/%Y') AS dms_projects_start_date",
    			"DATE_FORMAT(dms_projects_end_date, '%d/%m/%Y') AS dms_projects_end_date",
    			"dms_projects_objectives",
				"dms_projects_active"
    			)
    		),
    		"leftJoin#1" => array("tableName" => array("pt" => "dms_project_type"),
    			"condition" => "p.dms_projects_projecttype_id = pt.dms_projecttype_id",
    			"columns" => array("dms_projecttype_name",
    			"dms_projecttype_alias")
    		),
    		"leftJoin#2" => array("tableName" => array("i" => "dms_indicator"),
    			"condition" => "p.dms_projects_indicator_id = i.dms_indicator_id",
    			"columns" => array("dms_indicator_name")
    		),
    		"leftJoin#3" => array("tableName" => array("s" => "dms_status"),
    			"condition" => "p.dms_projects_status_id = s.dms_status_id",
    			"columns" => array("dms_status_name")
    		)
    	);
    	if (!empty($projectId)) {
    			$query["where"] = array("condition" => "p.dms_projects_id = " . $projectId);
    	}
    	$query["order"] = array("columns" => array("p.dms_projects_name ASC"));
		$this->formQuery($query);
		return $this->getDisplayItems();
    }

    /**
	 * @name fetchProjectReleases
	 * @access public
	 *
	 * @param $projectId|int
	 * This method fetches all releases under a particular project.
	 */
	public function fetchProjectReleases($projectId)
	{
		$query = array("from" => array("tableName" => array('r' => 'dms_releases'),
    		"colsToBFetched" => array("dms_releases_id",
    			"dms_releases_name",
    			"DATE_FORMAT(dms_releases_start_date, '%d/%m/%Y') AS dms_releases_start_date",
    			"DATE_FORMAT(dms_releases_cutoff_date, '%d/%m/%Y') AS dms_releases_cutoff_date",
    			"DATE_FORMAT(dms_releases_end_date, '%d/%m/%Y') AS dms_releases_end_date",
				"dms_releases_objectives",
				"dms_releases_riskinfo",
				"dms_releases_active"
    			)
    		),
    		"leftJoin#1" => array("tableName" => array("i" => "dms_indicator"),
    			"condition" => "r.dms_releases_indicator_id = i.dms_indicator_id",
    			"columns" => array("dms_indicator_name")
    		),
    		"leftJoin#2" => array("tableName" => array("s" => "dms_status"),
    			"condition" => "r.dms_releases_projects_id = s.dms_status_id",
    			"columns" => array("dms_status_name")
    		),
    		"where" => array("condition" => "r.dms_releases_projects_id = " . $projectId),
    		"order" => array("columns" => array("r.dms_releases_name ASC"))

    	);
		$this->formQuery($query);
		return $this->getDisplayItems();
    }

    /**
	 * @name fetchProjectSprints
	 * @access public
	 *
	 * @param $releasesId|int
	 * This method fetches all the sprints under a particular release.
	 */
	public function fetchProjectSprints($releasesId)
	{
		$query = array("from" => array("tableName" => array('sp' => 'dms_sprints'),
    		"colsToBFetched" => array("dms_sprints_id",
    			"dms_sprints_name",
    			"DATE_FORMAT(dms_sprints_start_date, '%d/%m/%Y') AS dms_sprints_start_date",
    			"DATE_FORMAT(dms_sprints_cutoff_date, '%d/%m/%Y') AS dms_sprints_cutoff_date",
    			"DATE_FORMAT(dms_sprints_end_date, '%d/%m/%Y') AS dms_sprints_end_date",
				"dms_sprints_objectives",
				"dms_sprints_riskinfo",
				"dms_sprints_active"
    			)
    		),
    		"leftJoin#1" => array("tableName" => array("sl" => "dms_sprints_log"),
    			"condition" => "sp.dms_sprints_id = sl.dms_sprintslog_sprints_id",
    			"columns" => array("dms_sprintslog_estimated",
	    		"dms_sprintslog_dev",
	    		"dms_sprintslog_test",
	    		"dms_sprintslog_stories",
	    		"dms_sprintslog_storypoints",
	    		"dms_sprintslog_majordefects",
	    		"dms_sprintslog_minordefects",
	    		"dms_sprintslog_reworkdev",
	    		"dms_sprintslog_reworktest",
	    		"dms_sprintslog_nonspe"
    			)
    		),
    		"leftJoin#2" => array("tableName" => array("i" => "dms_indicator"),
    			"condition" => "sp.dms_sprints_indicator_id = i.dms_indicator_id",
    			"columns" => array("dms_indicator_name")
    		),
    		"leftJoin#3" => array("tableName" => array("s" => "dms_status"),
    			"condition" => "sp.dms_sprints_status_id = s.dms_status_id",
    			"columns" => array("dms_status_name")
    		),
    		"where" => array("condition" => "sp.dms_sprints_releases_id = " . $releasesId),
    		"order" => array("columns" => array("sp.dms_sprints_name ASC"))

    	);
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
 			 $usersManager = new Application_Model_Db_Projects_Manager();
			foreach ($rowArray as $column => $value) {
				$column = str_replace('_', '', $column);
            	$usersManager->$column = $value;
			}
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

    /**
	 * @name addItem
	 * @access public
	 *
	 * This method adds the data to table.
	 */
    public function addItem()
    {

    }

    /**
	 * @name updateItem
	 * @access public
	 *
	 * This method method updates the data to table.
	 */
    public function updateItem()
    {

    }

    /**
	 * @name deleteItem
	 * @access public
	 *
	 * This method method delete the data from table.
	 */
    public function deleteItem()
    {

    }
}
