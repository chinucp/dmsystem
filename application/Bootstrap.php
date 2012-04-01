<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
    /**
     * Initializes the Zend Navigation from an XML configuration file.
     */

    protected function _initNavigation() {
        /*
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();

        $config = new Zend_Config_Xml(APPLICATION_PATH. '/configs/navigation.xml', 'nav');
        $navigation = new Zend_Navigation($config);
        $view->navigation($navigation);
         */
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');
        $navigation = new Zend_Navigation($config);
        $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();
        foreach ($navigation->getPages() as $page) :
            $page->uri = $baseUrl . $page->uri;
        endforeach;
        $view->navigation($navigation);
    }

    protected function _initAutoload() {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'Application', 'basePath' => APPLICATION_PATH,
        ));
        return $autoloader;
    }

    protected function _initLoadAclIni() {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/acl.ini');
        Zend_Registry::set('acl', $config);
    }

    protected function _initAclControllerPlugin() {
        $this->bootstrap('frontcontroller');
        $this->bootstrap('loadAclIni');
        $front = Zend_Controller_Front::getInstance();
        $aclPlugin = new ACC_Controller_Plugin_Acl(new ACC_Controller_Helper_Acl());
        $front->registerPlugin($aclPlugin);
    }
}
