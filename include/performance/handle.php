<?php
require_once('fw/handleManager.php');
require_once('performance/parameter.php');
class performanceHandle extends handleManager
{
    public $parameter;
    
    function __construct(){
        $this->parameter = new performanceParameter();
    }
    
    public function addRow($url,$seconds,$result){
        $this->parameter->setAdd($url,$seconds,$result);
        return parent::addRow(T_PERFORMANCE,$this->parameter);
    }
}
?>
