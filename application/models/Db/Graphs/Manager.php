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
 * @name Application_Model_Db_Graph_Manager
 * @category   Application_Model_Db
 *
 * This class enables to set/get the table fields.
 */
class Application_Model_Db_Graphs_Manager extends Application_Model_Db_Graphs_Mapper
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
	
	protected $_storypoints;
	protected $_hoursWorked;
	protected $_defects;
	
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
	 *
	 * @desc Setting private variable value
	 * @param string $name
	 * @param mix $value
	 * @return object $this
	 * @access public
	 */
	public function __set($name,$value){
		$name = '_'.$name;
		if (property_exists($this, $name)) {
			$this->$name = $value;
		}
		return $this;
	}
	/**
	 *
	 * @desc Getting  private variable value
	 * @param string $name
	 * @return  mix [private variable values]
	 * @access public
	 */
	public function __get($name){
		$name = '_'.$name;
		if (property_exists($this, $name)) {
			return $this->$name;
		}
	}

	/**
	 *
	 * @desc Calling to the getter methods and setter methods
	 * @param string $name
	 * @param mix $value
	 * @return mix [get methodname]
	 * @access public
	 */
	public function __call($name,$value='') {
		// check the name start with either get or set
		$request = substr($name,0,3);
		// get the full string starts with get or set
		$attr = lcfirst(substr($name,3));
		if($request == 'get'){
			return $this->$attr;
		}
		if($request == 'set'){
			$this->$attr = $value[0];
		}
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
		foreach ($options as $name => $value) {
			$name = lcfirst(str_replace(' ','',ucwords(str_replace('_', ' ', $name))));
			$this->$name=$value;
		}
	}


}

