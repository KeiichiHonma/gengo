<?php
require_once('fw/handleManager.php');
require_once('partner/inquiry/parameter.php');
class inquiryHandle extends handleManager
{
    public $parameter;
    
    function __construct(){
        $this->parameter = new inquiryParameter();
    }
    
    public function addRow(){
        $this->parameter->setAdd();
        return parent::addRow(T_PARTNER_INQUIRY,$this->parameter);
    }
}
?>
