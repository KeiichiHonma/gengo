<?php
require_once('fw/handleManager.php');
require_once('call/parameter.php');
class callHandle extends handleManager
{
    public $parameter;

    function __construct(){
        $this->parameter = new callParameter();
    }
    
    public function addRow($type,$uid,$mid){
        $this->parameter->setAdd($type,$uid,$mid);
        
        //return parent::addDebug(T_CALL,$this->parameter);
        return parent::addRow(T_CALL,$this->parameter);
    }

    public function updateRow($cid){
        $this->parameter->setUpdate($cid);
        return parent::updateRow(T_CALL,$this->parameter);
    }

    public function updateManager($cid,$mid){
        $this->parameter->setManagerUpdate($cid,$mid);
        return parent::updateRow(T_CALL,$this->parameter);
    }

    public function updateFinish($cid,$mid){
        $this->parameter->setFinishUpdate($cid,$mid);
        return parent::updateRow(T_CALL,$this->parameter);
    }

    public function deleteRow($mid){
        return parent::deleteRow(T_CALL,$this->parameter);
    }

}
?>
