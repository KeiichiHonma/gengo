<?php
require_once('fw/formManager.php');
class performanceForm extends formManager
{
    private $form = array
    (
    );

    public function getJob(){
        return $this->job;
    }
    public function getForm(){
        return parent::getForm($this->form,$this);
    }

    public function assignForm(){
        parent::assignForm($this->form,$this);
    }
}
?>