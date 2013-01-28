<?php
require_once('fw/handleManager.php');
require_once('inquiry/parameter.php');
class inquiryHandle extends handleManager
{
    public $parameter;
    
    function __construct(){
        $this->parameter = new inquiryParameter();
    }
    
    public function addRow(){
        $this->parameter->setAdd();
        return parent::addRow(T_INQUIRY,$this->parameter);
    }
}
?>
