<?php
require_once('fw/handleManager.php');
require_once('user/parameter.php');
class userHandle extends handleManager
{
    public $parameter;
    
    function __construct(){
        $this->parameter = new userParameter();
    }
    
    public function addRow(){
        $this->parameter->setAdd();
        return parent::addRow(T_USER,$this->parameter);
    }
    
    public function updateRow($uid){
        $this->parameter->setUpdate($uid);
        return parent::updateRow(T_USER,$this->parameter);
    }

    public function deleteRow($uid){
        return parent::deleteRow(T_USER,$this->parameter);
    }

}
?>
