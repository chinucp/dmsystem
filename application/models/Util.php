<?php

class Application_Model_Util
{
	
	public function __construct(array $options = null)
	{
		
	}

	public function graphFileName($suffix=''){
		$authSession = new Application_Model_Auth();
		$user = $authSession->getAuthName();
		
		//return $user.'_'.$suffix;
		return $user.'_'.$suffix.'_'.microtime();
	}
	
}

