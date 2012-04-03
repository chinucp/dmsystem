<?php
/**
 * Model
 * 
 * @category Application_Model_Dbs
 * 
 * This file is used for set/get of all the fields in the tables.
 * 
 */

/**
 * @name Application_Model_Db_Users_Manager 
 * @category   Application_Model_Db
 * 
 * This class enables to set/get the table fields.
 */
class Application_Model_Db_Users_Manager
{
	/**
     * All the required table field names.
     *
     * @var string
     * @access protected
     */
	protected $_id;
	protected $_firstName;
	protected $_lastName;
	protected $_designation;
	protected $_role;
	protected $_aliasName;
	protected $_username;
	protected $_email;
	protected $_status;
	protected $_lastUpdatedDate;

	/**
	 * @name Constructor 
	 * @access public
	 * 
	 * @param $options|array|default=null
	 */
	public function __construct(array $options = null)
	{
		if (is_array($options)) {
			$this->setOptions($options);
		}
	}
	
	/**
	 * @name __set 
	 */
	public function __set($name, $value)
	{
		$method = 'set' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid property');
		}
		$this->$method($value);
	}

	/**
	 * @name __get 
	 */
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid property');
		}
		return $this->$method();
	}
	
	/**
	 * @name setOptions 
	 * @access public
	 * 
	 * @param $options|array
	 * This method calls all the set methods in the array key.
	 */
	public function setOptions(array $options)
	{
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$method = 'set' . ucwords($key);
			if (in_array($method, $methods)) {
				$this->$method($value);
			}
		}
		return $this;
	}
	
	/**
	 * @name all the set/get methods of fields. 
	 * @access public
	 */
	public function setId($id){
		$this->_id = (int) $id;
		return $this;
	}

	public function getId(){
		return $this->_id;
	}

	public function setFirstName($value){
		$this->_firstName = $value;
		return $this;
	}

	public function getFirstName(){
		return $this->_firstName;
	}

	public function setLastName($value){
		$this->_lastName = $value;
		return $this;
	}

	public function getLastName(){
		return $this->_lastName;
	}

	public function setDesignation($value){
		$this->_designation = $value;
		return $this;
	}

	public function getDesignation(){
		return $this->_designation;
	}

	public function setRole($value){
		$this->_role = $value;
		return $this;
	}

	public function getRole(){
		return $this->_role;
	}

	public function setAliasName($value){
		$this->_aliasName = $value;
		return $this;
	}

	public function getAliasName(){
		return $this->_aliasName;
	}

	public function setUsername($value){
		$this->_username = $value;
		return $this;
	}

	public function getUsername(){
		return $this->_username;
	}

	public function setEmail($value){
		$this->_email = $value;
		return $this;
	}

	public function getEmail(){
		return $this->_email;
	}

	public function setStatus($value){
		$this->_status = $value;
		return $this;
	}

	public function getStatus(){
		return $this->_status;
	}

	public function setLastUpdatedDate($value){
		$this->_lastUpdatedDate = $value;
		return $this;
	}

	public function getLastUpdatedDate(){
		return $this->_lastUpdatedDate;
	}
}

