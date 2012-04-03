<?php
/**
 * DMS Library
 *
 * @category DMS
 * @package    DMS_Db
 *
 * This file is used for database interaction.
 *
 */

/**
 * @name DMS_Db_Interactions
 * @category   DMS
 * @package    DMS_Db
 *
 * This class makes whole the db intrecation like select,insert,update,delete etc.
 */

class DMS_Db_Interactions
{
	/**
     * The current table object.
     *
     * @var object
     * @access protected
     */
	protected $_dbTable;

	/**
     * The current fetch Query.
     *
     * @var array
     * @access protected
     */
	protected $_fetchQuery = array();

	/**
     * The current add Query.
     *
     * @var array
     * @access protected
     */
	protected $_addQuery = array();

	/**
     * The current update Query.
     *
     * @var array
     * @access protected
     */
	protected $_updateQuery = array();

	/**
     * The current delete Query.
     *
     * @var array
     * @access protected
     */
	protected $_deleteQuery = array();

	/**
	 * @name setDbTable
	 * @access public
	 *
	 * @param $dbTable|object
	 * This method closes the current connection and establishes a new connection/sets up new default adapter.
	 */
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
		return $this;
    }

	/**
	 * @name getDbTable
	 * @access public
	 *
	 * This method returns the table object.
	 */
    public function getDbTable()
    {
        return $this->_dbTable;
    }

    /**
	 * @name fetchData
	 * @access public
	 *
	 * This method forms the basic select query and fetches the row set.
	 */
    public function fetchData()
    {
    	foreach ($this->_fetchQuery as $key => $value) {
    		$pos = strpos($key, '#');
    		$key = $pos ? substr($key, 0, $pos) : $key;
    		switch ($key) {
	    		case "from":
	    			if (empty($value)) {
	    				$select = $this->_dbTable->select(Zend_Db_Table::SELECT_WITH_FROM_PART);
	    			} else {
	    				$select = $this->_dbTable->select();
	    				$select->from($value["tableName"], $value["colsToBFetched"]);
	    			}
	    			$select->setIntegrityCheck(false);
	    			break;
	    		case "innerJoin":
	    				$select->joinInner($value["tableName"], $value["condition"], $value["columns"]);
	    			break;
	    		case "leftJoin":
	    				$select->joinLeft($value["tableName"], $value["condition"], $value["columns"]);
		    		break;
	    		case "rightJoin":
		    			$select->joinRight($value["tableName"], $value["condition"], $value["columns"]);
	    			break;
	    		case "fullJoin":
	    				$select->joinFull($value["tableName"], $value["condition"], $value["columns"]);
	    			break;
	    		case "crossJoin":
		    			$select->joinCross($value["tableName"], $value["condition"], $value["columns"]);
	    			break;
	    		case "naturalJoin":
		    			$select->joinNatural($value["tableName"], $value["condition"], $value["columns"]);
	    			break;
	    		case "where":
	    			$select->where($value["condition"]);
	    			break;
	    		case "orWhere":
	    			$select->orWhere($value["condition"]);
	    			break;
	    		case "group":
	    			$select->group($value["column"]);
	    			break;
	    		case "order":
	    			$select->order($value["columns"]);
	    			break;
	    		case "limit":
	    			$select->limit($value["count"], $value["offset"]);
	    			break;
	    		case "having":
	    			$select->having($value["condition"]);
	    			break;
	    		default:
	    			break;
	    	}
    	}

//        $sql = $select->__toString();
//		echo "$sql\n";die;

        $rowSet = $this->_dbTable->fetchAll($select);

        return $rowSet;
    }
}