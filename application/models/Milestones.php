<?php

class Application_Model_Milestones
{
	protected $_id;
	protected $_projectId;
	protected $_milestone;
	protected $_milestoneType;
	protected $_plannedDate;
	protected $_forecastDate;
	protected $_comments;
	protected $_achievements;
	protected $_keyIssues;
	protected $_planForNextPeriod;
	protected $_summary;

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

	public function setId($id){
		$this->_id = (int) $id;
		return $this;
	}
	public function getId(){
		return $this->_id;
	}

	public function setProjectId($projectId){
		$this->_projectId;
		return $this;
	}

	public function getProjectId(){
		return $this->_projectId;
	}

	public function setMilestone($value){
		$this->_milestone = $value;
		return $this;
	}

	public function getMilestone(){
		return $this->_milestone;
	}

	public function setMilestoneType($value){
		$this->_milestoneType = $value;
		return $this;
	}

	public function getMilestoneType(){
		return $this->_milestoneType;
	}

	public function setPlannedDate($value){
		$this->_plannedDate = $value;
		return $this;
	}

	public function getPlannedDate(){
		return $this->_plannedDate;
	}

	public function setForecastDate($value){
		$this->_forecastDate = $value;
		return $this;
	}

	public function getForecastDate(){
		return $this->_forecastDate;
	}


	public function setComments($value){
		$this->_comments = $value;
		return $this;
	}

	public function getComments(){
		return $this->_comments;
	}

	public function setAchievements($value){
		$this->_achievements = $value;
		return $this;
	}

	public function getAchievements(){
		return $this->_achievements;
	}

	public function setKeyIssues($value){
		$this->_keyIssues = $value;
		return $this;
	}

	public function getKeyIssues(){
		return $this->_keyIssues;
	}

	public function setPlanForNextPeriod($value){
		$this->_planForNextPeriod = $value;
		return $this;
	}

	public function getPlanForNextPeriod(){
		return $this->_planForNextPeriod;
	}

	public function setSummary($value){
		$this->_summary = $value;
		return $this;
	}

	public function getSummary(){
		return $this->_summary;
	}


}

