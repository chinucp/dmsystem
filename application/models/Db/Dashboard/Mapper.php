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
	 * @param $options|array|default=null
	 * This sets up the table object.
	 */
	public function __construct(array $options = null)
	{
		$this->setDbTable('Application_Model_Db_Dashboard_Table');
	}

	/**
	 * @name fetchViewPageItems
	 * @access public
	 *
	 * This method fetches all the items to be displayed in view page.
	 */
	public function fetchViewPageItems()
	{
		$this->formQuery();
		return $this->getDisplayItems();
    }

    /**
	 * @name fetchAddPageUserTypeItems
	 * @access public
	 *
	 * This method fetches all the usertypes to be displayed add page listbox.
	 */
	public function fetchAddPageUserTypeItems()
	{
		$this->clearFetchQuery();
		$this->formQuery(array("from" => array("tableName" => array('ut' => 'user_types'),
    			"colsToBFetched" => array("id","alias_name")
    			),
    			"where" => array("condition" => "ut.deleted != 1"),
    			"order" => array("columns" => "ut.sort_order ASC")

    		)
    	);
		return $this->getDisplayItems();
    }

    /**
	 * @name fetchAddPageDesigsItems
	 * @access public
	 *
	 * This method fetches all the designations to be displayed add page listbox.
	 */
	public function fetchAddPageDesigsItems()
	{
		$this->clearFetchQuery();
		$this->formQuery(array("from" => array("tableName" => array('d' => 'designations'),
    			"colsToBFetched" => array("id",
    				"designation"
    				)
    			),
    			"where" => array("condition" => "d.deleted != 1"),
    			"order" => array("columns" => "d.sort_order ASC")

    		)
    	);
		return $this->getDisplayItems();
    }

    /**
	 * @name fetchAddPageRolesItems
	 * @access public
	 *
	 * This method fetches all the roles to be displayed add page listbox.
	 */
	public function fetchAddPageRolesItems()
	{
		$this->clearFetchQuery();
		$this->formQuery(array("from" => array("tableName" => array('r' => 'roles'),
    			"colsToBFetched" => array("id",
    				"role"
    				)
    			),
    			"where" => array("condition" => "r.deleted != 1"),
    			"order" => array("columns" => "r.sort_order ASC")
    		)
    	);
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
 			 $usersManager = new Application_Model_Db_Users_Manager();
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
    	if (!empty($queryParams) && is_array($queryParams)) {
    		$this->_fetchQuery = $queryParams;
    	} else {
    		$this->_fetchQuery = array("from" => array("tableName" => array('u' => 'users'),
    			"colsToBFetched" => array("id",
    				"first_name",
    				"last_name",
    				"username",
    				"email",
    				"status"
    				)
    			),
    			"leftJoin#1" => array("tableName" => array("d" => "designations"),
    				"condition" => "u.designations_id = d.id",
    				"columns" => array("designation")
    			),
    			"leftJoin#2" => array("tableName" => array("ut" => "user_types"),
    				"condition" => "u.user_types_id = ut.id",
    				"columns" => array("alias_name")
    			),
    			"leftJoin#3" => array("tableName" => array("r" => "roles"),
    				"condition" => "u.roles_id = r.id",
    				"columns" => array("role")
    			),
    			"where" => array("condition" => "u.deleted != 1"),
    			"order" => array("columns" => array("u.first_name ASC", "u.last_name ASC"))

    		);
    	}
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
