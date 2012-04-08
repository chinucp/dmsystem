<?php
/**
 * Model
 *
 * @category Application_Model_Db
 * @package    Zend_Db_Table_Abstract
 *
 * This file is used to set the current table.
 *
 */

/**
 * @name Application_Model_Db_Graph_Table
 * @category   Application_Model_Db
 * @package    Zend_Db_Table_Abstract
 *
 * The table name is intialized here.
 */
class Application_Model_Db_Graph_Table extends Zend_Db_Table_Abstract
{
	/**
     * tableName.
     *
     * @param string
     * @access public
     */
protected function _setupTableName()
    {
    	$this->_name = empty($tableName) ? 'dms_projects' : $tableName;
        parent::_setupTableName();
    }

}

