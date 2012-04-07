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
 * @name Application_Model_Db_Projects_Manager
 * @category   Application_Model_Db
 *
 * This class enables to set/get the table fields.
 */
class Application_Model_Db_Projects_Manager
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
	public function setDmsProjectsId($id){
		$this->_dmsProjectsId = (int) $id;
		return $this;
	}

	public function getDmsProjectsId(){
		return $this->_dmsProjectsId;
	}

	public function setDmsProjectsName($value){
		$this->_dmsProjectsName = $value;
		return $this;
	}

	public function getDmsProjectsName(){
		return $this->_dmsProjectsName;
	}

	public function setDmsProjecttypeAlias($value){
		$this->_dmsProjecttypeAlias = $value;
		return $this;
	}

	public function getDmsProjecttypeAlias(){
		return $this->_dmsProjecttypeAlias;
	}

	public function setDmsProjecttypeName($value){
		$this->_dmsProjecttypeName = $value;
		return $this;
	}

	public function getDmsProjecttypeName(){
		return $this->_dmsProjecttypeName;
	}

	public function setDmsProjectsStartDate($value){
		$this->_dmsProjectsStartDate = $value;
		return $this;
	}

	public function getDmsProjectsStartDate(){
		return $this->_dmsProjectsStartDate;
	}

	public function setDmsProjectsEndDate($value){
		$this->_dmsProjectsEndDate = $value;
		return $this;
	}

	public function getDmsProjectsEndDate(){
		return $this->_dmsProjectsEndDate;
	}

	public function setDmsProjectsObjectives($value){
		$this->_dmsProjectsObjectives = $value;
		return $this;
	}

	public function getDmsProjectsObjectives(){
		return $this->_dmsProjectsObjectives;
	}

	public function setDmsIndicatorName($value){
		$this->_dmsIndicatorName = $value;
		return $this;
	}

	public function getDmsIndicatorName(){
		return $this->_dmsIndicatorName;
	}

	public function setDmsStatusName($value){
		$this->_dmsStatusName = $value;
		return $this;
	}

	public function getDmsStatusName(){
		return $this->_dmsStatusName;
	}

	public function setDmsProjectsActive($value){
		$this->_dmsProjectsActive = $value;
		return $this;
	}

	public function getDmsProjectsActive(){
		return $this->_dmsProjectsActive;
	}

	public function setDmsReleasesId($id){
		$this->_dmsReleasesId = (int) $id;
		return $this;
	}

	public function getDmsReleasesId(){
		return $this->_dmsReleasesId;
	}

	public function setDmsReleasesName($value){
		$this->_dmsReleasesName = $value;
		return $this;
	}

	public function getDmsReleasesName(){
		return $this->_dmsReleasesName;
	}

	public function setDmsReleasesStartDate($value){
		$this->_dmsReleasesStartDate = $value;
		return $this;
	}

	public function getDmsReleasesStartDate(){
		return $this->_dmsReleasesStartDate;
	}

	public function setDmsReleasesCutoffDate($value){
		$this->_dmsReleasesCutoffDate = $value;
		return $this;
	}

	public function getDmsReleasesCutoffDate(){
		return $this->_dmsReleasesCutoffDate;
	}

	public function setDmsReleasesEndDate($value){
		$this->_dmsReleasesEndDate = $value;
		return $this;
	}

	public function getDmsReleasesEndDate(){
		return $this->_dmsReleasesEndDate;
	}

	public function setDmsReleasesObjectives($value){
		$this->_dmsReleasesObjectives = $value;
		return $this;
	}

	public function getDmsReleasesObjectives(){
		return $this->_dmsReleasesObjectives;
	}

	public function setDmsReleasesRiskinfo($value){
		$this->_dmsReleasesRiskinfo = $value;
		return $this;
	}

	public function getDmsReleasesRiskinfo(){
		return $this->_dmsReleasesRiskinfo;
	}

	public function setDmsReleasesActive($value){
		$this->_dmsReleasesActive = $value;
		return $this;
	}

	public function getDmsReleasesActive(){
		return $this->_dmsReleasesActive;
	}

	public function setDmsSprintsId($id){
		$this->_dmsSprintsId = (int) $id;
		return $this;
	}

	public function getDmsSprintsId(){
		return $this->_dmsSprintsId;
	}

	public function setDmsSprintsName($value){
		$this->_dmsSprintsName = $value;
		return $this;
	}

	public function getDmsSprintsName(){
		return $this->_dmsSprintsName;
	}

	public function setDmsSprintsStartDate($value){
		$this->_dmsSprintsStartDate = $value;
		return $this;
	}

	public function getDmsSprintsStartDate(){
		return $this->_dmsSprintsStartDate;
	}

	public function setDmsSprintsCutoffDate($value){
		$this->_dmsSprintsCutoffDate = $value;
		return $this;
	}

	public function getDmsSprintsCutoffDate(){
		return $this->_dmsSprintsCutoffDate;
	}

	public function setDmsSprintsEndDate($value){
		$this->_dmsSprintsEndDate =  $value;
		return $this;
	}

	public function getDmsSprintsEndDate(){
		return $this->_dmsSprintsEndDate;
	}

	public function setDmsSprintsObjectives($value){
		$this->_dmsSprintsObjectives = $value;
		return $this;
	}

	public function getDmsSprintsObjectives(){
		return $this->_dmsSprintsObjectives;
	}

	public function setDmsSprintsRiskinfo($value){
		$this->_dmsSprintsRiskinfo = $value;
		return $this;
	}

	public function getDmsSprintsRiskinfo(){
		return $this->_dmsSprintsRiskinfo;
	}

	public function setDmsSprintsActive($value){
		$this->_dmsSprintsActive = $value;
		return $this;
	}

	public function getDmsSprintsActive(){
		return $this->_dmsSprintsActive;
	}

	public function setDmsSprintslogId($id){
		$this->_dmsSprintslogId = (int) $id;
		return $this;
	}

	public function getDmsSprintslogId(){
		return $this->_dmsSprintslogId;
	}

	public function setDmsSprintslogEstimated($value){
		$this->_dmsSprintslogEstimated = $value;
		return $this;
	}

	public function DmsSprintslogEstimated(){
		return $this->_dmsSprintslogEstimated;
	}

	public function setDmsSprintslogDev($value){
		$this->_dmsSprintslogDev = $value;
		return $this;
	}

	public function getDmsSprintslogDev(){
		return $this->_dmsSprintslogDev;
	}

	public function setDmsSprintslogTest($value){
		$this->_dmsSprintslogTest = $value;
		return $this;
	}

	public function getDmsSprintslogTest(){
		return $this->_dmsSprintslogTest;
	}

	public function setDmsSprintslogStories($value){
		$this->_dmsSprintslogStories = $value;
		return $this;
	}

	public function getDmsSprintslogStories(){
		return $this->_dmsSprintslogStories;
	}

	public function setDmsSprintslogStorypoints($value){
		$this->_dmsSprintslogStorypoints = $value;
		return $this;
	}

	public function getDmsSprintslogStorypoints(){
		return $this->_dmsSprintslogStorypoints;
	}

	public function setDmsSprintslogMajordefects($value){
		$this->_dmsSprintslogMajordefects = $value;
		return $this;
	}

	public function getDmsSprintslogMajordefects(){
		return $this->_dmsSprintslogMajordefects;
	}

	public function setDmsSprintslogMinordefects($value){
		$this->_dmsSprintslogMinordefects = $value;
		return $this;
	}

	public function getDmsSprintslogMinordefects(){
		return $this->_dmsSprintslogMinordefects;
	}

	public function setDmsSprintslogReworkdev($value){
		$this->_dmsSprintslogReworkdev = $value;
		return $this;
	}

	public function getDmsSprintslogReworkdev(){
		return $this->_dmsSprintslogReworkdev;
	}

	public function setDmsSprintslogReworktest($value){
		$this->_dmsSprintslogReworktest = $value;
		return $this;
	}

	public function getDmsSprintslogReworktest(){
		return $this->_dmsSprintslogReworktest;
	}

	public function setDmsSprintslogNonspe($value){
		$this->_dmsSprintslogNonspe = $value;
		return $this;
	}

	public function getDmsSprintslogNonspe(){
		return $this->_dmsSprintslogNonspe;
	}
}

