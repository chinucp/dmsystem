<?php
// Define path to application directory
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
// Define application environment
defined('APPLICATION_ENV')
                || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));
define('LIBRARY_PATH',realpath(APPLICATION_PATH . '/../library'));
define('GRAPH_PATH',realpath(APPLICATION_PATH . '/../public/tmp/'));
// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    LIBRARY_PATH, get_include_path(),
)));

// timezone for an American in California
date_default_timezone_set('Asia/Kolkata');

/** Zend_Application */
require_once 'Zend/Application.php';
// Create application, bootstrap, and run
$application = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
$application->bootstrap()->run();
