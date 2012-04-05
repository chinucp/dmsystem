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
class Application_Model_Db_Users_Manager extends Application_Model_Db_ManagerMapper
{
	/**
     * All the required table field names.
     *
     * @var string
     * @access protected
     */
	protected $_dmsProjectsId;
	protected $_dmsProjectsName;
	protected $_dmsProjecttypeName;
	protected $_dmsProjecttypeAlias;
	protected $_dmsProjectsStartDate;
	protected $_dmsProjectsEndDate;
	protected $_dmsProjectsObjectives;
	protected $_dmsIndicatorName;
	protected $_dmsStatusName;
	protected $_dmsProjectsActive;
	protected $_dmsReleasesId;
	protected $_dmsReleasesName;
	protected $_dmsReleasesStartDate;
	protected $_dmsReleasesCutoffDate;
	protected $_dmsReleasesEndDate;
	protected $_dmsReleasesObjectives;
	protected $_dmsReleasesRiskinfo;
	protected $_dmsReleasesActive;
	protected $_dmsSprintsId;
	protected $_dmsSprintsName;
	protected $_dmsSprintsStartDate;
	protected $_dmsSprintsCutoffDate;
	protected $_dmsSprintsEndDate;
	protected $_dmsSprintsObjectives;
	protected $_dmsSprintsRiskinfo;
	protected $_dmsSprintsActive;
	protected $_dmsSprintslogId;
	protected $_dmsSprintslogEstimated;
	protected $_dmsSprintslogDev;
	protected $_dmsSprintslogTest;
	protected $_dmsSprintslogStories;
	protected $_dmsSprintslogStorypoints;
	protected $_dmsSprintslogMajordefects;
	protected $_dmsSprintslogMinordefects;
	protected $_dmsSprintslogReworkdev;
	protected $_dmsSprintslogReworktest;
	protected $_dmsSprintslogNonspe;

	/**
	 * @name Constructor
	 * @access public
	 *
	 * @param $options|array|default=null
	 */
	public function __construct()
	{

	}


}

