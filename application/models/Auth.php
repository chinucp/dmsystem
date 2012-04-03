<?php

class Application_Model_Auth
{
	private $_role;	
	protected $_userid;
	protected $_rolename;
	protected $_username;
	

	public function __construct(array $options = null)
	{
		$this->_role = new Zend_Session_Namespace("auth");		
		if (is_array($options)) {
			$this->setOptions($options);
		}
	}

	public function __set($name, $value)
	{
		$method = 'set' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid property');
		}
		return $this->$method();
	}

	public function setOptions(array $options)
	{
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (in_array($method, $methods)) {
				$this->$method($value);
			}
		}
		return $this;
	}

	/************************************************************/

	public function setRole($roleid=''){
		$this->_role->_rolename = 'level'.$roleid;
	}
	public function setAuthId($id=''){
		$this->_role->_userid = $id;
	}
	public function setAuthName($name=''){
		$this->_role->_username = $name;
	}
	public function getRole(){
		return $this->_role->_rolename;
	}
	public function getAuthId(){
		return $this->_role->_userid;
	}
	public function getAuthName(){
		return $this->_role->_username;
	}
}

