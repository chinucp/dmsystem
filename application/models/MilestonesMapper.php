<?php

class Application_Model_MilestonesMapper
{

protected $_dbTable;

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

	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->setDbTable('Application_Model_DbTable_Milestones');
		}
		return $this->_dbTable;
	}

	public function save(Application_Model_Milestones $milestones)
	{
		$data = array(
		/*'id' => $stores->getId(),*/
            'projectId' => $milestones->getProjectId(),
            'milestone' => $milestones->getMilestone(),
			'plannedDate' => $milestones->getPlannedDate(),
			'forecastDate' => $milestones->getForecastDate(),
			'comments' => $milestones->getComments(),
			'achievements' => $milestones->getAchievements(),
			'keyIssues' => $milestones->getKeyIssues(),
			'planForNextPeriod' => $milestones->getPlanForNextPeriod(),
			'summary' => $milestones->getSummary(),
		);

		if (null === ($id = $milestones->getId())) {
			unset($data['id']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('id = ?' => $id));
		}
	}

	public function find($id, Application_Model_Milestones $milestones)
	{
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)) {
			return;
		}
		$row = $result->current();
		$milestones->setId($row->id)
				->setProjectId($row->projectId)
				->setMilestone($row->milestone)
				->setMilestoneType($row->milestoneType)
				->setPlannedDate($row->plannedDate)
				->setForecastDate($row->forecastDate)
				->setComments($row->comments)
				->setAchievements($row->achievements)
				->setKeyIssues($row->keyIssues)
				->setPlanForNextPeriod($row->planForNextPeriod)
				->setSummary($row->summary);
	}

	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$entries   = array();
		foreach ($resultSet as $row) {
			$entry = new Application_Model_Milestones();
			$entry->setId($row->id)
				->setProjectId($row->projectId)
				->setMilestone($row->milestone)
				->setMilestoneType($row->milestoneType)
				->setPlannedDate($row->plannedDate)
				->setForecastDate($row->forecastDate)
				->setComments($row->comments)
				->setAchievements($row->achievements)
				->setKeyIssues($row->keyIssues)
				->setPlanForNextPeriod($row->planForNextPeriod)
				->setSummary($row->summary);
			$entries[] = $entry;
		}
		return $entries;
	}
}

