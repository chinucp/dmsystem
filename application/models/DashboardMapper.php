<?php

class Application_Model_DashboardMapper {

    protected function fetchAll($sql) {
    	$db = Zend_Registry::get('dbAdapter');
    	$resultant = $db->query($sql);
    	$resultSet = $resultant->fetchAll();

	    return $resultSet;
    }

    public function fetchProjects(){

			$sql = 'SELECT P.id, PT.type, P.name,P.description, R.release, S.sprint, S.start_date, S.end_date
					FROM `projects` AS P
					INNER JOIN `releases` AS R ON P.id = R.projects_id
					INNER JOIN `sprints` AS S ON R.id = S.releases_id
					INNER JOIN `project_types` AS PT ON P.project_types_id = PT.id
					WHERE
					now( )
					BETWEEN S.start_date
					AND S.end_date';
			return $this->fetchall($sql);
    }
	public function fetchRelease(){

			$sql = 'SELECT R.id,R.objective, R.release, R.risk, R.start_date, R.end_date
					FROM `releases` AS R
					INNER JOIN `indicators` AS I ON R.indicators_id = I.id
					WHERE
					R.projects_id= 1
					AND now( )
					BETWEEN R.start_date
					AND R.end_date';
			return $this->fetchall($sql);
    }
	public function fetchSprint(){

			$sql = 'SELECT P.id, PT.type, P.name, R.release, S.sprint, S.start_date, S.end_date
				FROM `projects` AS P, `releases` AS R, `sprints` AS S, `project_types` AS PT
				WHERE P.id = R.projects_id
				AND R.id = S.releases_id
				AND now( )
				BETWEEN S.start_date
				AND S.end_date
				AND P.project_types_id = PT.id';
			return $this->fetchall($sql);
    }
}
