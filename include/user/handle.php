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

    public function updateFacetimeRow($uid){
        $this->parameter->setFacetimeUpdate($uid);
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

class autoLoginHandle extends handleManager
{
    public $parameter;
    
    function __construct(){
        $this->parameter = new autoLoginParameter();
    }
    
    public function addRow($uid){
        $this->parameter->setAdd($uid);
        return parent::addRow(T_AUTO,$this->parameter);
    }

    public function updateRow(){
        return parent::updateRow(T_AUTO,$this->parameter);
    }

    public function deleteRow(){
        return parent::deleteRow(T_AUTO,$this->parameter);
    }

    public function deletePassport($passport){
        $this->addCondition('col_passport = \''.$passport.'\'');
        $query = $this->delete(T_AUTO);
        $this->execute($query);
    }

}
?>
