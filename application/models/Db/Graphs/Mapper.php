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
 * @name Application_Model_Db_Graphs_Mapper
 * @category   DMS_Db
 * @package    DMS_Db_Interactions
 *
 * This class initiates all the database interaction calls.
 */
class Application_Model_Db_Graphs_Mapper extends DMS_Db_Interactions
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
		empty($tableName) ? $this->setDbTable('Application_Model_Db_Graphs_Table') : $this->setDbTable('Application_Model_Db_Graphs_Table', $tableName);
	}
	
	protected function fetchAll($sql) {
		$db = Zend_Db_Table::getDefaultAdapter();
		$resultant = $db->query($sql);
		$resultSet = $resultant->fetchAll();
		return $resultSet;
	}
	public function fetchProjectNames(){	
	
		/*$sql = 'SELECT dms_projects_id, dms_projects_name
				FROM dms_projects';
		return $this->fetchall($sql);*/
		
		$query = array("from" => array("tableName" => array('p' => 'dms_projects'),
				"colsToBFetched" => array("p.dms_projects_id","p.dms_projects_name")
								)		
				);
		$this->formQuery($query);
		$resultSet = $this->fetchData();
		$this->getDisplayItems();
		return $resultSet->toArray();
	
	}
	public function fetchReleaseNames($projectId=0){
	
		/* $sql = 'SELECT dms_releases_id, dms_releases_name
				FROM dms_releases AS R 
				INNER JOIN dms_projects AS P ON P.`dms_projects_id` = R.dms_releases_projects_id'
				;
		if(!empty($projectId) and 'all'!=$projectId){
			$sql.= ' WHERE R.dms_releases_projects_id='.$projectId;
		}
		return $this->fetchall($sql); */ 
		
		$query = array("from" => array("tableName" => array('p' => 'dms_projects'),
											"colsToBFetched" => array("p.dms_projects_name")
				),
				"innerJoin#1" => array("tableName" => array("r" => "dms_releases"),
						"condition" => "p.dms_projects_id = r.dms_releases_projects_id",
						"columns" => array("r.dms_releases_id","r.dms_releases_name")
				)
		);
		
		if(!empty($projectId) and 'all'!=$projectId){
			$query["where"] = array("condition" => "r.dms_releases_projects_id  = " . $projectId. " AND r.dms_releases_status_id !=3 AND r.dms_releases_status_id !=5" );
		}else{
			return;
			$query["where"] = array("condition" => "r.dms_releases_status_id !=3 AND r.dms_releases_status_id !=5");
		}
				
		$this->formQuery($query);
		$resultSet = $this->fetchData();
		$this->getDisplayItems();
		return $resultSet->toArray();
	
	}
	public function fetchGraphTypes(){
	
		$graphType = array( 'td'=>'Trend Reports',
							'st'=>'Story Reports',
							'hr'=>'Hours Reports',
							);
		return $graphType;
	
	}
	public function fetchStoryGraphDetails($projectId='all',$releaseId='all'){
	
		/* $sql = 'SELECT dms_projects_name, sum( dms_sprintslog_storypoints ) AS storypoints
				FROM dms_projects, dms_sprints_log, dms_releases, dms_sprints
				WHERE dms_projects.dms_projects_id = dms_releases.dms_releases_projects_id
				AND dms_releases.dms_releases_id = dms_sprints.dms_sprints_releases_id
				AND dms_sprints.dms_sprints_id = dms_sprints_log.dms_sprintslog_sprints_id
				GROUP BY dms_releases.dms_releases_projects_id';
		return $this->fetchall($sql); */
		$query = array("from" => array("tableName" => array('p' => 'dms_projects'),
				"colsToBFetched" => array("p.dms_projects_name"
		
				)
		),
				"innerJoin#1" => array("tableName" => array("r" => "dms_releases"),
						"condition" => "p.dms_projects_id = r.dms_releases_projects_id",
						"columns" => array("r.dms_releases_name")
				),
				"innerJoin#2" => array("tableName" => array("s" => "dms_sprints"),
						"condition" => "r.dms_releases_id = s.dms_sprints_releases_id",
						"columns" => array("s.dms_sprints_name")
		
				),
				"innerJoin#3" => array("tableName" => array("sl" => "dms_sprints_log"),
						"condition" => "s.dms_sprints_id = sl.dms_sprintslog_sprints_id",
						"columns" => array("sum(sl.dms_sprintslog_storypoints) as storypoints",
								"sum( sl.dms_sprintslog_storypoints ) AS storypoints")
		
				)
		);
		$grpFlag= 'all';
		$appendCondition = '';
		if (!empty($projectId) && 'all' != strtolower($projectId)) {
			$query["where"] = array("condition" => "R.dms_releases_projects_id = " . $projectId);
			$grpFlag = 'release';
		}
		if (!empty($releaseId) && 'all' != strtolower($releaseId)) {
			if (!empty($projectId) && 'all' != strtolower($projectId)){
				$appendCondition = " AND R.dms_releases_projects_id = " . $projectId;
			}
			$query["where"] = array("condition" => "R.dms_releases_id  = " . $releaseId.$appendCondition);
			$grpFlag ='sprint';
		}
		if($grpFlag=='release'){
			$query["group"] = array("columns" => array("r.dms_releases_id"));
		}else if($grpFlag=='sprint'){
			$query["group"] = array("columns" => array("s.dms_sprints_id"));
		}else{
			$query["group"] = array("columns" => array("r.dms_releases_projects_id"));
		}
		$this->formQuery($query);
		return $this->getDisplayItems();
	
	}
	public function fetchTrendGraphDetails($projectId='all',$releaseId='all'){
		
		/* $sql = "SELECT dms_projects_name,sum(dms_sprintslog_storypoints) as storypoints, sum(dms_sprintslog_dev)+sum(dms_sprintslog_test)+sum(dms_sprintslog_reworkdev)+sum(dms_sprintslog_reworktest)+sum(dms_sprintslog_nonspe) as hours_worked, sum(dms_sprintslog_majordefects)+sum(dms_sprintslog_minordefects) as defects
				FROM dms_projects,dms_sprints_log, dms_releases, dms_sprints
				WHERE dms_projects.dms_projects_id=dms_releases.dms_releases_projects_id 
				AND dms_releases.dms_releases_id = dms_sprints.dms_sprints_releases_id
				AND dms_sprints.dms_sprints_id = dms_sprints_log.dms_sprintslog_sprints_id 
				GROUP BY dms_releases.dms_releases_projects_id";
		return $this->fetchall($sql); */
		$query = array("from" => array("tableName" => array('p' => 'dms_projects'),
				"colsToBFetched" => array("p.dms_projects_name"
						
				)
				),
				"innerJoin#1" => array("tableName" => array("r" => "dms_releases"),
						"condition" => "p.dms_projects_id = r.dms_releases_projects_id",
						"columns" => array("r.dms_releases_name")
				),
				"innerJoin#2" => array("tableName" => array("s" => "dms_sprints"),
						"condition" => "r.dms_releases_id = s.dms_sprints_releases_id",
						"columns" => array("s.dms_sprints_name")
						
				),
				"innerJoin#3" => array("tableName" => array("sl" => "dms_sprints_log"),
						"condition" => "s.dms_sprints_id = sl.dms_sprintslog_sprints_id",
						"columns" => array("sum(sl.dms_sprintslog_storypoints) as storypoints",
								"sum(sl.dms_sprintslog_dev)+sum(sl.dms_sprintslog_test)+sum(sl.dms_sprintslog_reworkdev)+sum(sl.dms_sprintslog_reworktest)+sum(sl.dms_sprintslog_nonspe) as hours_worked, 
								sum(sl.dms_sprintslog_majordefects)+sum(sl.dms_sprintslog_minordefects) as defects")
						
				)
		);
		
		$grpFlag= 'all';
		$appendCondition = '';
		if (!empty($projectId) && 'all' != strtolower($projectId)) {
			$query["where"] = array("condition" => "R.dms_releases_projects_id = " . $projectId);
			$grpFlag = 'release';
		}
		if (!empty($releaseId) && 'all' != strtolower($releaseId)) {
			if (!empty($projectId) && 'all' != strtolower($projectId)){
				$appendCondition = " AND R.dms_releases_projects_id = " . $projectId;
			}
			$query["where"] = array("condition" => "R.dms_releases_id  = " . $releaseId.$appendCondition);
			$grpFlag ='sprint';
		}
		if($grpFlag=='release'){
			$query["group"] = array("columns" => array("r.dms_releases_id"));
		}else if($grpFlag=='sprint'){
			$query["group"] = array("columns" => array("s.dms_sprints_id"));
		}else{
			$query["group"] = array("columns" => array("r.dms_releases_projects_id"));
		}
		
		$this->formQuery($query);
		return $this->getDisplayItems();
	}
	public function fetchHourGraphDetails($projectId='all',$releaseId='all'){
	
	
		/* $sql = 'SELECT dms_projects_name,sum(dms_sprintslog_dev)+sum(dms_sprintslog_test)+sum(dms_sprintslog_reworkdev)+sum(dms_sprintslog_reworktest)+sum(dms_sprintslog_nonspe) as hours_worked
				FROM dms_projects,dms_sprints_log, dms_releases, dms_sprints
				WHERE dms_projects.dms_projects_id=dms_releases.dms_releases_projects_id 
				AND dms_releases.dms_releases_id = dms_sprints.dms_sprints_releases_id
				AND dms_sprints.dms_sprints_id = dms_sprints_log.dms_sprintslog_sprints_id 
				GROUP BY dms_releases.dms_releases_projects_id;';
		return $this->fetchall($sql); */
		
		$query = array("from" => array("tableName" => array('p' => 'dms_projects'),
				"colsToBFetched" => array("p.dms_projects_name"
		
				)
		),
				"innerJoin#1" => array("tableName" => array("r" => "dms_releases"),
						"condition" => "p.dms_projects_id = r.dms_releases_projects_id",
						"columns" => array("r.dms_releases_name")
				),
				"innerJoin#2" => array("tableName" => array("s" => "dms_sprints"),
						"condition" => "r.dms_releases_id = s.dms_sprints_releases_id",
						"columns" => array("s.dms_sprints_name")
		
				),
				"innerJoin#3" => array("tableName" => array("sl" => "dms_sprints_log"),
						"condition" => "s.dms_sprints_id = sl.dms_sprintslog_sprints_id",
						"columns" => array("sum(sl.dms_sprintslog_storypoints) as storypoints",
								"sum(sl.dms_sprintslog_dev)+sum(sl.dms_sprintslog_test)+sum(sl.dms_sprintslog_reworkdev)+sum(sl.dms_sprintslog_reworktest)+sum(sl.dms_sprintslog_nonspe) as hours_worked")
		
				)
		);
		
		
		$grpFlag= 'all';
		$appendCondition = '';
		if (!empty($projectId) && 'all' != strtolower($projectId)) {
			$query["where"] = array("condition" => "R.dms_releases_projects_id = " . $projectId);
			$grpFlag = 'release';
		}
		if (!empty($releaseId) && 'all' != strtolower($releaseId)) {
			if (!empty($projectId) && 'all' != strtolower($projectId)){
				$appendCondition = " AND R.dms_releases_projects_id = " . $projectId;
			}
			$query["where"] = array("condition" => "R.dms_releases_id  = " . $releaseId.$appendCondition);
			$grpFlag ='sprint';
		}
		if($grpFlag=='release'){
			$query["group"] = array("columns" => array("r.dms_releases_id"));
		}else if($grpFlag=='sprint'){
			$query["group"] = array("columns" => array("s.dms_sprints_id"));
		}else{
			$query["group"] = array("columns" => array("r.dms_releases_projects_id"));
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
        	$usersManager = new Application_Model_Db_Graphs_Manager();
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
