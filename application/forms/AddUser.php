<?php

class Application_Form_AddUser extends Zend_Form {

    public function init() {
        $this->setName("addUser");
        $this->setMethod('post');
        $this->addElement('text', 'firstName', array(
            'required' => true, 'label' => 'First Name:'
        ));
        $this->addElement('submit', 'save', array(
            'label' => 'Save'
        ));
    }
}
