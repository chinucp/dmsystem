<?php

class Application_Model_Projects
{
	protected $_id;
	protected $_projectName;
	protected $_projectType;
	protected $_currentMilestone;
	protected $_startDate;
	protected $_endDate;


	public function __construct(array $options = null)
	{
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

	public function setId($id){
		$this->_id = (int) $id;
		return $this;
	}

	public function getId(){
		return $this->_id;
	}

	public function setProjectName($value){
		$this->_projectName = $value;
		return $this;
	}

	public function getProjectName(){
		return $this->_projectName;
	}

	public function setProjectType($value){
		$this->_projectType = $value;
		return $this;
	}

	public function getProjectType(){
		return $this->_projectType;
	}

	public function setCurrentMilestone($value){
		$this->_currentMilestone = $value;
		return $this;
	}

	public function getCurrentMilestone(){
		return $this->_currentMilestone;
	}

	public function setStartDate($value){
		$this->_startDate = $value;
		return $this;
	}

	public function getStartDate(){
		return $this->_startDate;
	}

	public function setEndDate($value){
		$this->_endDate = $value;
		return $this;
	}

	public function getEndDate(){
		return $this->_endDate;
	}
}

