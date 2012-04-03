<?php
/**
 * DMS Library
 * 
 * @category DMS
 * @package    DMS_Db
 * 
 * This file is used to establish database connection.
 * 
 */

/**
 * @name DMS_Db_Adapter 
 * @category   DMS
 * @package    DMS_Db
 * 
 * This class setups a new default db adapter after closing the existing one.
 */
class DMS_Db_Adapter
{
	/**
     * The new db adapter name.
     *
     * @var string
     * @access private
     */
	private $_newAdapter;
	
	/**
     * The new db parameters.
     *
     * @var array
     * @access private
     */
	private $_newParams = array();
	
	/**
     * Entire db connection parameters.
     *
     * @var array
     * @access private
     */	
	private $_dbParams = array();	
	
	/**
	 * @name setDbConnection 
	 * @access public
	 * 
	 * @param $newDbParams|(string|array)|default=null
	 * This method closes the current connection and establishes a new connection/sets up new default adapter.
	 */
	public function setDbConnection($newDbParams = null)
	{
		
		// First close the existing connection.
		$this->closeDbConnection();
		// Set the default connection parameters.
    	$this->setDefaultDbParams();
    	
    	// If we have recieved new db parameters then set those.
		if (!empty($newDbParams)) {
			$this->setDbParams($newDbParams);
		}
		
		// Now get connected.
		$this->getConnected();			
    }
    
	/**
	 * @name closeDbConnection 
	 * @access public
	 * 
	 * This method closes the connection.
	 */
    public function closeDbConnection()
    {
    	
    	// Get the default adapter and close it.
    	$dbAdapter = Zend_Db_Table_Abstract::getDefaultAdapter();
    	$dbAdapter->closeConnection();
    }
    
	/**
	 * @name setDefaultDbParams 
	 * @access private
	 * 
	 * This method sets the default connection parameters.
	 */
    private function setDefaultDbParams()
    {
    	
    	// Get and set the connection params from registry. If not get it from config, store it to registry and also use it.
    	if (!Zend_Registry::isRegistered('dbParams')) {
    		$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini');
    		$this->_dbParams['adapter'] = $this->_newAdapter = $config->db->adapter;
    		$this->_dbParams['params'] = $this->_newParams = $config->db->params->toArray();
    		Zend_Registry::set('dbParams', $this->_dbParams);
    	} else {
    		$this->_dbParams = Zend_Registry::get('dbParams');
    		$this->_newAdapter = $dbParams['adapter'];
    		$this->_newParams = $dbParams['params'];
    	}
    }
    
	/**
	 * @name setDbParams
	 * @access private
	 * 
	 * @param $newDbParams|(string|array)
	 * This method sets the new connection parameters.
	 */
    private function setDbParams($newDbParams)
    {
    	// If only Database name has to be changed.
    	if (is_string($newDbParams)) {
    		$this->_newParams['dbname'] = $newDbParams;
    	} else if (is_array($newDbParams)) {    	
	    	// If the parameters are genuine then only set it.
	    	if (!empty($newDbParams['adapter']) && is_string($newDbParams['adapter']) && !empty($newDbParams['params']) && is_array($newDbParams['adapter'])) {
	    		$this->_newAdapter = $newDbParams['adapter'];
	    		$this->_newParams = $newDbParams['params'];
	    	}
    	}
    }
    
	/**
	 * @name getConnected
	 * @access private
	 * 
	 * This method establishes teh connection and sets the default adapter.
	 */
    private function getConnected()
    {
	    try {
	        $db = Zend_Db::factory($this->_newAdapter, $this->_newParams);
	        Zend_Db_Table_Abstract::setDefaultAdapter($db);
	    } catch (Zend_Db_Adapter_Exception $e) {
	        throw new Exception($e->getMessage());
	    } catch (Zend_Exception $e) {
	        throw new Exception($e->getMessage());
	    }    	
    }

}

