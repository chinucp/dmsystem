<?php
class ACC_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract {

	/**
	 *
	 * @var Zend_Auth
	 */
	protected $_auth;

	protected $_acl;
	protected $_action;
	protected $_controller;
	protected $_currentRole;

	public function __construct(Zend_Acl $acl, array $options = array()) {
		$this->_auth = Zend_Auth::getInstance();
		$this->_acl = $acl;

	}

	public function preDispatch(Zend_Controller_Request_Abstract $request) {

		$this->_init($request);

		// if the current user role is not allowed to do something
		if (!$this->_acl->isAllowed($this->_currentRole, $this->_controller, $this->_action)) {
			if ('level4' == $this->_currentRole) {
				$request->setControllerName('index');
				//$request->setActionName('login');
			} else {
				$request->setControllerName('error');
				$request->setActionName('error');
			}
		}
	}

	protected function _init($request) {
		$this->_action = $request->getActionName();
		$this->_controller = $request->getControllerName();
		$this->_currentRole = $this->_getCurrentUserRole();
	}

	protected function _getCurrentUserRole() {

		if ($this->_auth->hasIdentity()) {
			$authData = $this->_auth->getIdentity();
			$role = isset($authData->user_types_id)?strtolower('level'.$authData->user_types_id): 'level4';
		} else {
			$role = 'level4';
		}

		return $role;
	}

}