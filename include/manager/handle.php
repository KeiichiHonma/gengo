<?php
require_once('fw/handleManager.php');
require_once('manager/parameter.php');
class managerHandle extends handleManager
{
    public $parameter;

    function __construct(){
        $this->parameter = new managerParameter();
    }
    
    public function addRow(){
        $this->parameter->setAdd();
        return parent::addRow(T_MANAGER,$this->parameter);
    }

    public function updateRow($mid){
        $this->parameter->setUpdate($mid);
        return parent::updateRow(T_MANAGER,$this->parameter);
    }

    public function updateTimestamp($mid){
        $this->parameter->setUpdateTimestamp($mid);
        return parent::updateRow(T_MANAGER,$this->parameter);
    }

    //manager情報は個別に更新される
    public function updateMailRow($mid){
        $this->parameter->setMailUpdate($mid);
        //$this->setDebug();
        return parent::updateRow(T_MANAGER,$this->parameter);
    }

    public function updatePasswordRow($mid){
        $this->parameter->setPasswordUpdate($mid);
        //$this->setDebug();
        return parent::updateRow(T_MANAGER,$this->parameter);
    }

    //学校のみ表示名変更可能
    public function updateNameRow(){
        $this->parameter->setNameUpdate();
        //$this->setDebug();
        return parent::updateRow(T_MANAGER,$this->parameter);
    }

    public function deleteRow($mid){
        return parent::deleteRow(T_MANAGER,$this->parameter);
    }

}
?>
