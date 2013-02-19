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

    public function updateTimestamp($uid){
        $this->parameter->setUpdateTimestamp($uid);
        return parent::updateRow(T_USER,$this->parameter);
    }

    //user情報は個別に更新される
    public function updateMailRow($uid){
        $this->parameter->setMailUpdate($uid);
        //$this->setDebug();
        return parent::updateRow(T_USER,$this->parameter);
    }

    public function updatePasswordRow($uid){
        $this->parameter->setPasswordUpdate($uid);
        //$this->setDebug();
        return parent::updateRow(T_USER,$this->parameter);
    }

    public function updateNameRow(){
        $this->parameter->setNameUpdate();
        //$this->setDebug();
        return parent::updateRow(T_USER,$this->parameter);
    }

    public function updateStatusRow($uid,$status){
        $this->parameter->setStatusUpdate($uid,$status);
        //$this->setDebug();
        return parent::updateRow(T_USER,$this->parameter);
    }

    public function deleteRow($uid){
        return parent::deleteRow(T_USER,$this->parameter);
    }

}
?>
