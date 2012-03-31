<?php

class Application_Form_AddProject extends Zend_Form {

    public function init() {
        $this->setName("addProject");
        $this->setMethod('post');
        $this->addElement('text', 'projectName', array(
            'required' => true, 'label' => 'Project Name:'
        ));
        $this->addElement('select', 'projectType', array(
                        'required' => true, 'label' => 'Project Type:',
                        'multiOptions' => array(
                            '' => 'select', 'AD' => 'Application Development', 'AM' => 'Application Sustainment'
                        )
        ));
        $this->addElement('text', 'startDate', array(
            'required' => true, 'label' => 'Project Start Date:'
        ));
        $this->addElement('text', 'endDate', array(
            'required' => true, 'label' => 'Project End Date:'
        ));
        $this->addElement('select', 'status', array(
                        'required' => true, 'label' => 'Status:',
                        'multiOptions' => array(
                            'select', 'In Process', 'On Hold', 'Completed'
                        )
        ));
        $this->addElement('checkbox', 'active', array(
            'label' => 'Is project Active:'
        ));
        $this->addElement('submit', 'save', array(
            'label' => 'Save'
        ));
    }
}
